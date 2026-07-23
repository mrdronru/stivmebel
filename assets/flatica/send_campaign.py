# -*- coding: utf-8 -*-
"""
send_campaign.py — рассылка холодных писем с прогревом домена и учётом
прогресса прямо в CSV (та же таблица, где хранится текст писем и статусы).

Как это работает:
  - Читает campaign.csv (или другой файл, указанный первым аргументом).
  - Отправляет только строки, где sent_date ПУСТОЙ и subject/body ЗАПОЛНЕНЫ.
  - Учитывает график прогрева: чем больше писем УЖЕ отправлено с этого
    ящика за всё время (по всем строкам файла), тем больше можно отправить
    сегодня — но не больше дневного лимита на сегодняшний "день прогрева".
  - Между письмами — случайная пауза (по умолчанию 3-8 минут).
  - Отправляет только в рабочие часы буднего дня (по умолчанию 10:00-18:00,
    пн-пт) — вне этого окна скрипт просто ничего не делает и завершается.
  - После КАЖДОГО отправленного письма сразу дозаписывает sent_date и
    status='sent' обратно в CSV — если скрипт упадёт или его прервут,
    прогресс не потеряется.
  - Есть --dry-run (ничего не отправляет, только показывает, что бы сделал)
    и --limit N (отправить не больше N писем за этот запуск, для теста).

Зависимости: только стандартная библиотека Python (smtplib, email, csv).

Настройка (переменные окружения — пароль никогда не хранится в файле):
    set SMTP_HOST=mail.hosting.reg.ru      (или export на Linux/Mac)
    set SMTP_PORT=465
    set SMTP_USER=you@stivinteriors.ru
    set SMTP_PASSWORD=пароль_от_ящика
    set SENDER_NAME=имя_отправителя

Использование:
    python send_campaign.py campaign1.csv --dry-run
    python send_campaign.py campaign1.csv --limit 3
    python send_campaign.py campaign1.csv
"""

import csv
import os
import sys
import ssl
import smtplib
import time
import random
import argparse
import fcntl
from datetime import datetime, date
from email.mime.text import MIMEText
from email.header import Header
from email.utils import formataddr

# ─── Блокировка от параллельного запуска ───────────────────────────────────
# Если предыдущий запуск (например, растянувшийся из-за медленной сети)
# ещё не завершился, а cron уже дёрнул скрипт снова — новый запуск не
# должен трогать CSV одновременно со старым. Держим открытый файл с
# эксклюзивной блокировкой на всё время работы скрипта; если она уже
# занята — тихо выходим, ничего не делая.
LOCK_PATH = "send_campaign.lock"
_lock_file_handle = None  # держим ссылку, чтобы файл не закрылся раньше времени


def acquire_lock():
    global _lock_file_handle
    _lock_file_handle = open(LOCK_PATH, "w")
    try:
        fcntl.flock(_lock_file_handle, fcntl.LOCK_EX | fcntl.LOCK_NB)
    except BlockingIOError:
        print(f"[{datetime.now()}] Другой процесс send_campaign.py уже выполняется. Выхожу, ничего не делаю.")
        sys.exit(0)

# ─── Вывод одновременно в консоль и в файл send_log.txt ────────────────────
LOG_PATH = "send_log.txt"


class _Tee:
    def __init__(self, *streams):
        self.streams = streams

    def write(self, data):
        for s in self.streams:
            s.write(data)

    def flush(self):
        for s in self.streams:
            s.flush()


_log_file = open(LOG_PATH, "a", encoding="utf-8")
sys.stdout = _Tee(sys.__stdout__, _log_file)
sys.stderr = _Tee(sys.__stderr__, _log_file)

# ─── Настройки прогрева и темпа отправки ───────────────────────────────────

# День прогрева считается от ДАТЫ ПЕРВОЙ ОТПРАВКИ по всему файлу (не от
# сегодняшнего дня скрипта) — так что можно останавливаться и продолжать,
# график не собьётся.

# писем в день по дням прогрева начальный вариант [5, 5, 8, 8, 12, 12, 15, 18, 20, 20, 25, 25, 30]
WARMUP_SCHEDULE = [30, 40]

DEFAULT_DAILY_CAP_AFTER_SCHEDULE = 40  # когда график прогрева закончился

MIN_DELAY_MINUTES = 3
MAX_DELAY_MINUTES = 8

SEND_WINDOW_START_HOUR = 10
SEND_WINDOW_END_HOUR = 18
SEND_ONLY_WEEKDAYS = True  # пн-пт

# Резервный список колонок — используется только если у CSV почему-то нет
# заголовка. В норме реальный порядок колонок берётся из самого файла
# (reader.fieldnames), поэтому любые новые столбцы, например profile_url,
# сохраняются при перезаписи и не ломают запись.
FIELDNAMES = [
    "name", "email", "city", "phone", "website", "hook_source", "variant",
    "subject", "body", "sent_date", "replied", "reply_notes", "status", "qa_flag",
]


def load_env_config():
    host = os.environ.get("SMTP_HOST", "mail.hosting.reg.ru")
    port = int(os.environ.get("SMTP_PORT", "465"))
    user = os.environ.get("SMTP_USER")
    password = os.environ.get("SMTP_PASSWORD")
    sender_name = os.environ.get("SENDER_NAME", "Александр")

    missing = [n for n, v in [("SMTP_USER", user), ("SMTP_PASSWORD", password)] if not v]
    if missing:
        print(f"[ERROR] Не заданы переменные окружения: {', '.join(missing)}")
        print("        Задайте их перед запуском, например (Windows PowerShell):")
        print('        $env:SMTP_USER="you@stivinteriors.ru"')
        print('        $env:SMTP_PASSWORD="пароль_от_ящика"')
        sys.exit(1)

    return host, port, user, password, sender_name


def is_within_send_window(now: datetime) -> bool:
    if SEND_ONLY_WEEKDAYS and now.weekday() >= 5:  # 5=суббота, 6=воскресенье
        return False
    return SEND_WINDOW_START_HOUR <= now.hour < SEND_WINDOW_END_HOUR


def warmup_day_index(rows: list) -> int:
    """День прогрева (0-based) считаем от самой ранней даты в sent_date."""
    sent_dates = [
        datetime.strptime(r["sent_date"], "%Y-%m-%d").date()
        for r in rows
        if r.get("sent_date", "").strip()
    ]
    if not sent_dates:
        return 0
    first_day = min(sent_dates)
    return (date.today() - first_day).days


def todays_cap(rows: list) -> int:
    day_idx = warmup_day_index(rows)
    if day_idx < len(WARMUP_SCHEDULE):
        return WARMUP_SCHEDULE[day_idx]
    return DEFAULT_DAILY_CAP_AFTER_SCHEDULE


def sent_today_count(rows: list) -> int:
    today_str = date.today().strftime("%Y-%m-%d")
    return sum(1 for r in rows if r.get("sent_date", "").strip() == today_str)


def send_one(host, port, user, password, sender_name, to_email, subject, body):
    msg = MIMEText(body, "plain", "utf-8")
    msg["Subject"] = Header(subject, "utf-8")
    msg["From"] = formataddr((str(Header(sender_name, "utf-8")), user))
    msg["To"] = to_email

    context = ssl.create_default_context()
    with smtplib.SMTP_SSL(host, port, context=context, timeout=30) as server:
        server.login(user, password)
        server.sendmail(user, [to_email], msg.as_string())


def main():
    acquire_lock()

    parser = argparse.ArgumentParser()
    parser.add_argument("csv_path")
    parser.add_argument("--dry-run", action="store_true", help="Ничего не отправлять, только показать план")
    parser.add_argument("--limit", type=int, default=None, help="Максимум писем за этот запуск (для теста)")
    parser.add_argument("--ignore-window", action="store_true", help="Игнорировать проверку рабочих часов (для теста)")
    args = parser.parse_args()

    if not args.dry_run:
        host, port, user, password, sender_name = load_env_config()
    else:
        host = port = user = password = None
        sender_name = os.environ.get("SENDER_NAME", "Александр")

    with open(args.csv_path, encoding="utf-8-sig") as f:
        reader = csv.DictReader(f)
        rows = list(reader)
        # Порядок и состав колонок берём из самого файла, чтобы новые поля
        # (например profile_url) сохранялись при перезаписи прогресса.
        fieldnames = reader.fieldnames or FIELDNAMES

    now = datetime.now()
    if not args.ignore_window and not args.dry_run:
        if not is_within_send_window(now):
            print(f"[{now}] Сейчас вне рабочего окна отправки "
                  f"({SEND_WINDOW_START_HOUR}:00-{SEND_WINDOW_END_HOUR}:00, будни). Ничего не делаю.")
            return

    cap_today = todays_cap(rows)
    already_today = sent_today_count(rows)
    remaining_today = max(0, cap_today - already_today)
    if args.limit is not None:
        remaining_today = min(remaining_today, args.limit)

    day_idx = warmup_day_index(rows)
    print(f"[{now}] День прогрева: {day_idx + 1}. Дневной лимит: {cap_today}. "
          f"Уже отправлено сегодня: {already_today}. Осталось на сегодня: {remaining_today}.")

    if remaining_today <= 0:
        print("Дневной лимит на сегодня исчерпан (или уже отправлено больше лимита). Ничего не делаю.")
        return

    to_send = [
        r for r in rows
        if not r.get("sent_date", "").strip()
        and r.get("subject", "").strip()
        and r.get("body", "").strip()
        and r.get("email", "").strip()
    ]

    if not to_send:
        print("Нет строк, готовых к отправке (нужны заполненные subject/body/email и пустой sent_date).")
        return

    batch = to_send[:remaining_today]
    print(f"Готовлюсь отправить {len(batch)} писем в этом запуске.\n")

    sent_count = 0
    for i, row in enumerate(batch, 1):
        if not args.dry_run and not args.ignore_window and not is_within_send_window(datetime.now()):
            print(f"[{datetime.now()}] Рабочее окно закончилось посреди рассылки. "
                  f"Останавливаюсь, отправлено {sent_count}/{len(batch)}. Продолжится в следующем запуске.")
            break

        print(f"[{i}/{len(batch)}] {row['name']} <{row['email']}> — тема: {row['subject']!r}")
        if args.dry_run:
            print("    [dry-run] письмо не отправлено")
        else:
            try:
                send_one(host, port, user, password, sender_name, row["email"], row["subject"], row["body"])
                row["sent_date"] = date.today().strftime("%Y-%m-%d")
                row["status"] = "sent"
                print("    ✓ отправлено")
                sent_count += 1
            except Exception as e:
                row["status"] = "error"
                row["reply_notes"] = f"Ошибка отправки: {e!r}"
                print(f"    [WARN] ошибка отправки: {e!r}")

            # Сохраняем прогресс сразу после каждого письма — если скрипт
            # упадёт или его прервут, уже отправленные письма не потеряются
            # и не уйдут повторно при следующем запуске.
            with open(args.csv_path, "w", newline="", encoding="utf-8-sig") as f:
                writer = csv.DictWriter(f, fieldnames=fieldnames, extrasaction="ignore")
                writer.writeheader()
                writer.writerows(rows)

        if i < len(batch) and not args.dry_run:
            delay_min = random.uniform(MIN_DELAY_MINUTES, MAX_DELAY_MINUTES)
            print(f"    жду {delay_min:.1f} мин перед следующим письмом...")
            time.sleep(delay_min * 60)

    print(f"\n✅ Готово. Отправлено в этом запуске: {sent_count}/{len(batch)}.")
    print(f"   Лог сохранён в {LOG_PATH}")


if __name__ == "__main__":
    main()
