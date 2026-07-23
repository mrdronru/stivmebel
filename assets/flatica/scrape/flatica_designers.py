"""
scrape_flatica_designers.py — проходит по странице списка дизайнеров на flatica.ru
(бесконечная прокрутка), заходит в каждый профиль и собирает контакты
(телефон, email, соцсети) + краткую характеристику профиля (только дизайн
или дизайн + сопровождение/реализация проекта).

Профили без единого способа связи (нет ни телефона, ни email, ни соцсетей)
пропускаются.

Зависимости:
    pip install playwright beautifulsoup4
    playwright install chromium

Использование:
    python scrape_flatica_designers.py "https://flatica.ru/professionals/speciality.dizayn-interyera~city.moskva"
    python scrape_flatica_designers.py "https://flatica.ru/professionals/speciality.dizayn-interyera~region.moskovskaja-oblast~city.all"

Необязательные параметры:
    --max-profiles N     ограничить количество профилей (по умолчанию — без лимита)
    --out FILE.csv        путь к выходному CSV (по умолчанию designers.csv)
    --headless=false      открыть браузер видимым (полезно для отладки)

Важно:
    Скрипт делает паузы между запросами и не параллелит их, чтобы не
    создавать чрезмерную нагрузку на сайт. Перед массовым использованием
    стоит свериться с пользовательским соглашением flatica.ru
    (https://flatica.ru/docs/terms-of-service.pdf) — вы используете
    скрипт на свой страх и риск.
"""

from playwright.sync_api import sync_playwright
from bs4 import BeautifulSoup
import sys
import re
import csv
import time
import random
from urllib.parse import urlparse, urljoin

# ─── Вывод одновременно в консоль и в файл (debug.log) ─────────────────────
# Так весь лог сразу сохраняется в файл — не нужно вручную копировать вывод
# из консоли, можно просто прислать файл.
LOG_PATH = "debug.log"


class _Tee:
    def __init__(self, *streams):
        self.streams = streams

    def write(self, data):
        for s in self.streams:
            s.write(data)

    def flush(self):
        for s in self.streams:
            s.flush()


_log_file = open(LOG_PATH, "w", encoding="utf-8")
sys.stdout = _Tee(sys.__stdout__, _log_file)
sys.stderr = _Tee(sys.__stderr__, _log_file)
print(f"[Полный лог этого запуска также сохраняется в {LOG_PATH}]")

# ─── Аргументы командной строки ────────────────────────────────────────────

USAGE = (
    "Использование: python scrape_flatica_designers.py <URL списка> "
    "[--max-profiles N] [--out FILE.csv] [--profiles FILE.csv] [--fresh] [--headless=false] [--debug]\n"
    'Пример: python scrape_flatica_designers.py "https://flatica.ru/professionals/speciality.dizayn-interyera~city.moskva" --max-profiles 50 --debug\n'
    "\n"
    "Resume: журнал состояния хранится в profiles.csv (колонка status: пусто=не обработан,\n"
    "✓=с контактами, ⤫=без контактов). Повторный запуск той же командой ПРОДОЛЖАЕТ обход с\n"
    "первой необработанной строки, не пересобирая список заново. Флаг --fresh начинает с нуля\n"
    "(пересобирает список и перезаписывает profiles.csv)."
)

if len(sys.argv) < 2:
    print(USAGE)
    sys.exit(1)

LIST_URL = None
MAX_PROFILES = None
OUT_PATH = "designers.csv"
PROFILES_PATH = "profiles.csv"   # журнал состояния обхода (все URL + статус + данные)
HEADLESS = True
DEBUG = False
FRESH = False                    # --fresh: начать сбор с нуля, игнорируя существующий profiles.csv

args = sys.argv[1:]
i = 0
while i < len(args):
    arg = args[i]
    if arg.startswith("--max-profiles"):
        if "=" in arg:
            MAX_PROFILES = int(arg.split("=", 1)[1])
        else:
            i += 1
            if i >= len(args):
                print("[ERROR] После --max-profiles нужно указать число.")
                sys.exit(1)
            MAX_PROFILES = int(args[i])
    elif arg.startswith("--out"):
        if "=" in arg:
            OUT_PATH = arg.split("=", 1)[1]
        else:
            i += 1
            if i >= len(args):
                print("[ERROR] После --out нужно указать имя файла.")
                sys.exit(1)
            OUT_PATH = args[i]
    elif arg.startswith("--profiles"):
        if "=" in arg:
            PROFILES_PATH = arg.split("=", 1)[1]
        else:
            i += 1
            if i >= len(args):
                print("[ERROR] После --profiles нужно указать имя файла.")
                sys.exit(1)
            PROFILES_PATH = args[i]
    elif arg == "--fresh":
        FRESH = True
    elif arg.startswith("--headless=false"):
        HEADLESS = False
    elif arg.startswith("--headless"):
        # --headless без =false, либо с опечаткой в значении
        print(f"[ERROR] Флаг {arg!r} не распознан. Чтобы открыть видимый браузер, используйте ровно '--headless=false'.")
        sys.exit(1)
    elif arg == "--debug":
        DEBUG = True
    elif arg.startswith("-"):
        # Похоже на попытку флага (в т.ч. опечатка вроде одного дефиса
        # или подчёркивания вместо дефиса) — явно сообщаем об этом,
        # а не подставляем этот аргумент вместо URL.
        print(f"[ERROR] Неизвестный флаг: {arg!r}")
        print("        Доступные флаги: --max-profiles N, --out FILE.csv, --profiles FILE.csv, --fresh, --headless=false, --debug")
        print(USAGE)
        sys.exit(1)
    else:
        if LIST_URL is not None:
            print(f"[ERROR] Получено два значения без флага: {LIST_URL!r} и {arg!r}. URL списка должен быть только один.")
            print(USAGE)
            sys.exit(1)
        LIST_URL = arg.strip()
    i += 1

if not LIST_URL:
    print("[ERROR] Не указан URL списка дизайнеров.")
    print(USAGE)
    sys.exit(1)

parsed = urlparse(LIST_URL)
if parsed.scheme not in ("http", "https") or not parsed.netloc:
    print(f"[ERROR] Некорректный URL: {LIST_URL}")
    sys.exit(1)

BASE = f"{parsed.scheme}://{parsed.netloc}"

PROFILE_DELAY = (1.0, 2.0)  # случайная пауза между визитами в профили (вежливость к серверу)

# ─── Ключевые слова для характеристики профиля ─────────────────────────────
# Если в описании/услугах встречаются такие слова — считаем, что дизайнер
# занимается не только чертежами, но и сопровождением/реализацией проекта.
FULL_SERVICE_KEYWORDS = [
    "реализац", "автор", "надзор", "комплектац", "под ключ", "шеф-монтаж",
    "сопровожд", "ремонт", "строительн", "монтаж", "закупк", "подрядчик",
    "бригад", "смет", "поставщик",
]
# Слова, указывающие именно на furniture/мебельный интерес — можно
# расширить при необходимости.
FURNITURE_KEYWORDS = ["мебел", "гардероб", "кухн", "шкаф", "стол"]


def classify_profile(text: str) -> str:
    """Грубая эвристика: только дизайн-проект или дизайн + сопровождение/реализация."""
    low = text.lower()
    hits = [kw for kw in FULL_SERVICE_KEYWORDS if kw in low]
    if hits:
        return "Дизайн + сопровождение/реализация (" + ", ".join(sorted(set(hits))[:4]) + ")"
    return "Только дизайн-проект"


def extract_phone_from_wa(html: str) -> str:
    """Достаём номер телефона из ссылки вида https://wa.me/79991234567"""
    m = re.search(r"wa\.me/(\d{10,15})", html)
    if not m:
        return ""
    digits = m.group(1)
    # Форматируем как +7 ...
    if digits.startswith("7") or digits.startswith("8"):
        digits = "7" + digits[1:]
    return "+" + digits


# Строки-мусор, которые нужно выкинуть из блока отзывов (рейтинги, даты,
# служебные подписи), чтобы остался только текст самих отзывов.
_REVIEW_NOISE_PATTERNS = [
    re.compile(r"^\d+([.,]\d+)?$"),                       # "5", "4.98"
    re.compile(r"^\d{1,2}/[А-Яа-яЁё]+/\d{4}$"),            # "22/Июнь/2026"
    re.compile(r"^Закреплен экспертом$", re.I),
    re.compile(r"^Сначала новые$", re.I),
    re.compile(r"^Оставить отзыв$", re.I),
    re.compile(r"^Отзывы о:.*$", re.I),
    re.compile(r"^(Качество работы|Коммуникация|Стоимость)$", re.I),
    re.compile(r"^Показать (ещ[её]|полностью)$", re.I),
    re.compile(r"^\d+\s*отзыв", re.I),
]


def clean_reviews_text(raw: str, max_chars: int = 1800) -> str:
    lines = [l.strip() for l in raw.split("\n") if l.strip()]
    kept, total = [], 0
    for line in lines:
        if any(p.match(line) for p in _REVIEW_NOISE_PATTERNS):
            continue
        if len(line) < 25:
            continue  # короткие строки — почти наверняка не текст отзыва (имя, лайк и т.п.)
        kept.append(line)
        total += len(line)
        if total >= max_chars:
            break
    return " / ".join(kept)


def extract_rating_info(text: str):
    """Рейтинг и число отзывов из шапки профиля, напр. '4.98 ★★★★★ 43 отзыва'
    или просто '5 ★★★★★ 62 отзыва' (целый рейтинг без десятичных)."""
    m = re.search(r"(\d(?:\.\d{1,2})?)\D{0,40}?(\d+)\s*отзыв", text)
    if m:
        return m.group(1), m.group(2)
    return "", ""


# Строки-кнопки, которые иногда остаются прилипшими к началу текста после
# клика (сам текст уже раскрыт, но подпись кнопки осталась в DOM рядом).
_LEADING_BUTTON_NOISE = re.compile(
    r"^(Читать (дальше|далее)|Показать (ещ[её]|полностью)|Скрыть)\s*\n?", re.I
)


def strip_leading_button_noise(text: str) -> str:
    prev = None
    while prev != text:
        prev = text
        text = _LEADING_BUTTON_NOISE.sub("", text.strip())
    return text


_PROJECT_NOISE_PATTERNS = [
    re.compile(r"^\d+(\s*\(\d+\s*в\s*фотопотоке\))?$"),   # "9", "91 (90 в фотопотоке)"
    re.compile(r"^\(\d+\s*в\s*фотопотоке\)$"),              # "(28 в фотопотоке)" отдельной строкой
    re.compile(r"^г[.\s]", re.I),                          # "г Москва", "г. Сочи"
    re.compile(r"^Адрес не указан$", re.I),
    re.compile(r"^Показать (ещ[её]|полностью)$", re.I),
    re.compile(r"^Проекты\s*(\(\d+\))?$", re.I),
    re.compile(r"^Альбомы идей$", re.I),
    re.compile(r"^Поделиться$", re.I),
    re.compile(r"^Сохранить$", re.I),
]


def parse_project_titles(chunk: str) -> list:
    """Вытаскивает вероятные названия проектов из содержимого вкладки
    'Проекты': отсекаем явный мусор (числа фото, город, кнопки), а не
    требуем точного дублирования строки — на реальных карточках портфолио
    название может встречаться и один раз (в отличие от общих виджетов
    сайта, которые дублировали текст)."""
    lines = [l.strip() for l in chunk.split("\n") if l.strip()]
    titles = []
    for l in lines:
        if any(p.match(l) for p in _PROJECT_NOISE_PATTERNS):
            continue
        if len(l) < 8:
            continue
        titles.append(l)
    # убираем подряд идущие точные повторы (если сайт всё же дублирует)
    collapsed = []
    for t in titles:
        if not collapsed or collapsed[-1] != t:
            collapsed.append(t)
    # убираем повторы вообще, сохраняя порядок появления
    seen, uniq = set(), []
    for t in collapsed:
        if t not in seen:
            seen.add(t)
            uniq.append(t)
    return uniq


STALL_LIMIT = 4             # сколько подряд докруток без новой порции считаем "конец списка"
MAX_SCROLL_ITERS = 5000     # аварийный потолок на число докруток, чтобы не зациклиться навечно
LOAD_WAIT_MAX = 20.0        # сколько максимум ждать новую порцию после докрутки (сайт иногда "задумывается" дольше 10 сек)
LOAD_POLL_INTERVAL = 1.0    # с каким шагом опрашивать страницу во время ожидания


def count_profile_cards(page) -> int:
    """Число карточек профилей в DOM прямо сейчас. Это более надёжный признак
    подгрузки новой порции, чем высота документа: высота может не измениться
    из-за ленивых картинок/перекомпоновки, а число ссылок на /pro/ растёт
    ровно тогда, когда действительно добавились новые профили."""
    try:
        return page.evaluate('document.querySelectorAll(\'a[href^="/pro/"]\').length')
    except Exception:
        return 0


def nudge_lazy_loader(page):
    """Небольшая прокрутка чуть вверх и снова вниз. Иногда ленивый загрузчик
    не срабатывает, если курсор/скролл уже стоит намертво в самом низу —
    короткий сдвиг «будит» его и провоцирует подгрузку следующей порции."""
    try:
        page.evaluate("window.scrollBy(0, -1500)")
        time.sleep(0.8)
        page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
    except Exception:
        pass


def collect_profile_links_from_html(html: str) -> set:
    """Один финальный разбор полностью прогруженного HTML через BeautifulSoup
    — вместо того чтобы дёргать список ссылок на каждом шаге прокрутки."""
    soup = BeautifulSoup(html, "html.parser")
    links = set()
    for a in soup.find_all("a", href=True):
        href = a["href"]
        if href.startswith("/pro/"):
            links.add(href.split("?")[0].split("#")[0])
    return links


def scroll_and_collect_links(page) -> set:
    """Докручивает до текущего конца страницы, затем ждёт (опрашивая высоту
    документа каждую LOAD_POLL_INTERVAL сек, до LOAD_WAIT_MAX сек) — сайт
    подгружает новую порцию карточек не мгновенно, а с задержкой 5-8 сек,
    поэтому ждём именно появления новой высоты, а не просто фиксированную
    паузу. Ссылки на профили достаются ОДИН РАЗ в конце — из полностью
    прогруженного HTML, тем же способом, что и для страниц профиля."""
    print("Прокручиваю список дизайнеров...")
    stall_count = 0
    iters = 0
    last_count = count_profile_cards(page)  # признак роста — число карточек, а не высота

    # Пытаемся понять заявленное сайтом количество профилей в этой выборке.
    total_hint = None
    try:
        body_text = page.inner_text("body")
        m = re.search(r"(\d[\d\s]{2,6})\s*(дизайнер|специалист|эксперт|результат)", body_text, re.I)
        if m:
            total_hint = int(m.group(1).replace(" ", ""))
            print(f"  сайт указывает примерно {total_hint} профилей в этой выборке")
    except Exception:
        pass

    while stall_count < STALL_LIMIT and iters < MAX_SCROLL_ITERS:
        iters += 1

        # Докручиваем ровно до текущего конца страницы (а не "на глаз" вперёд).
        try:
            page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
        except Exception:
            pass

        # Ждём новую порцию, опрашивая ЧИСЛО КАРТОЧЕК (надёжнее высоты) —
        # сайт отвечает не сразу, иногда дольше 10 секунд, поэтому ждём до
        # LOAD_WAIT_MAX и реагируем на реальное появление новых профилей.
        grew = False
        waited = 0.0
        new_count = last_count
        while waited < LOAD_WAIT_MAX:
            time.sleep(LOAD_POLL_INTERVAL)
            waited += LOAD_POLL_INTERVAL
            new_count = count_profile_cards(page)
            if new_count > last_count:
                grew = True
                break

        # Если за окно ожидания ничего не пришло — прежде чем засчитать простой,
        # пробуем «растолкать» ленивый загрузчик и ждём ещё один короткий цикл.
        if not grew:
            nudge_lazy_loader(page)
            extra = 0.0
            while extra < LOAD_WAIT_MAX / 2:
                time.sleep(LOAD_POLL_INTERVAL)
                extra += LOAD_POLL_INTERVAL
                new_count = count_profile_cards(page)
                if new_count > last_count:
                    grew = True
                    break
            waited += extra

        if grew:
            stall_count = 0
            print(f"  подгрузилась новая порция (карточек {last_count} -> {new_count}, шаг {iters}, ждали {waited:.0f}с)")
        else:
            stall_count += 1
            print(f"  [шаг {iters}] новых карточек не появилось за {waited:.0f}с "
                  f"(карточек по-прежнему {new_count}, попытка {stall_count}/{STALL_LIMIT})")
        last_count = new_count

        # Если задан --max-profiles, не тратим время на докрутку до самого
        # конца списка (там может быть 1500+ профилей) — достаточно текущего
        # числа карточек в DOM.
        if MAX_PROFILES and last_count >= MAX_PROFILES * 1.5:
            print(f"  карточек уже заметно больше --max-profiles ({last_count}) — прекращаю прокрутку раньше конца списка")
            break

    if stall_count >= STALL_LIMIT:
        print(f"  [INFO] {STALL_LIMIT} докрутки подряд без новой порции — считаю, что дошли до конца.")
        if total_hint and last_count < total_hint * 0.9:
            print(f"  [WARN] Собрано карточек ({last_count}) заметно меньше, чем заявлено сайтом (~{total_hint}). "
                  f"Возможно, список всё же не догрузился — стоит перезапустить или ещё увеличить LOAD_WAIT_MAX.")
    elif iters >= MAX_SCROLL_ITERS:
        print(f"  [WARN] Достигнут аварийный лимит в {MAX_SCROLL_ITERS} докруток — остановился принудительно.")

    print("Разбираю полностью загруженную страницу списка...")
    html = page.content()
    seen_links = collect_profile_links_from_html(html)
    print(f"Итого собрано уникальных ссылок на профили: {len(seen_links)}")
    return seen_links


# Ссылки на соцсети самой Флатики, которые встречаются в подвале КАЖДОЙ
# страницы — их нужно отфильтровывать, иначе они попадают в каждую строку.
FLATICA_OWN_LINK_MARKERS = [
    "vk.com/flatica",
    "dzen.ru/flatica",
    "t.me/flatica_ru",
    "t.me/flatica_pro",
    "instagram.com/houzz_ru",
    "pinterest.com/flaticaru",
    "max.ru/flatica",
]

SOCIAL_DOMAIN_MAP = [
    ("t.me", "telegram"),
    ("telegram.me", "telegram"),
    ("wa.me", "whatsapp"),
    ("whatsapp.com", "whatsapp"),
    ("vk.com", "vk"),
    ("dzen.ru", "dzen"),
    ("youtube.com", "youtube"),
    ("youtu.be", "youtube"),
    ("instagram.com", "instagram"),
    ("pinterest.com", "other"),
    ("pin.it", "other"),
]

# Домены, которые считаем соцсетями/сервисами-агрегаторами при разборе
# ссылок в профиле (используются и для бакетов, и чтобы не путать их
# с личным сайтом дизайнера).
SOCIAL_DOMAIN_HINTS = (
    "vk.com", "t.me", "wa.me", "youtube.com", "youtu.be", "instagram.com",
    "dzen.ru", "telegram.me", "whatsapp.com", "pinterest.com", "pin.it",
)


def clean_url_tail(url: str) -> str:
    """Обрезает query-string и fragment (utm_*, fbclid, share_to, igsh и т.п. "хвосты")."""
    if not url:
        return url
    return url.split("?", 1)[0].split("#", 1)[0]


def classify_social_link(href: str) -> str:
    """Возвращает название платформы для ссылки, либо 'other', если не распознана."""
    for marker, platform in SOCIAL_DOMAIN_MAP:
        if marker in href:
            return platform
    return "other"


def is_flatica_own_link(href: str) -> bool:
    return any(marker in href for marker in FLATICA_OWN_LINK_MARKERS)


def dedupe_repeated_name(name: str) -> str:
    """Сайт иногда дублирует название в одном узле ('АСК СИГНАЛ АСК СИГНАЛ',
    'Алёна ЧекалинаАлёна Чекалина') — схлопываем повтор."""
    words = name.split()
    n = len(words)
    if n >= 2 and n % 2 == 0 and words[:n // 2] == words[n // 2:]:
        return " ".join(words[:n // 2])
    half = len(name) // 2
    if half > 3 and name[:half] == name[half:]:
        return name[:half]
    return name


def section_text_between(soup: BeautifulSoup, start_id: str, stop_ids: set) -> str:
    """Текст между реальным HTML-якорем id=`start_id` и следующим якорем из
    `stop_ids` — сайт рендерит содержимое вкладок профиля (id="projects",
    id="reviews", id="about") целиком на сервере, кликать не нужно вообще:
    просто идём по DOM от одного якоря до следующего."""
    start = soup.find(id=start_id)
    if start is None:
        return ""
    texts = []
    for el in start.next_elements:
        el_id = getattr(el, "get", None) and el.get("id")
        if el_id and el_id in stop_ids:
            break
        if isinstance(el, str):
            t = el.strip()
            if t:
                texts.append(t)
    return "\n".join(texts)


def extract_about_text(soup: BeautifulSoup, max_chars: int = 1200) -> str:
    raw = section_text_between(soup, "about", {"album"})
    # Убираем повтор самого заголовка вкладки ("Об эксперте") в начале —
    # сам якорь id="about" стоит на этом заголовке, поэтому его текст
    # попадает первой строкой.
    lines = raw.split("\n", 1)
    if lines and lines[0].strip().lower() == "об эксперте":
        raw = lines[1] if len(lines) > 1 else ""
    # Обрезаем длинный список тегов специализации/услуг — это не био,
    # он засоряет поле; если понадобится отдельно, легко вытащить позже.
    for cut_marker in ("Категории специализации", "Услуги"):
        idx = raw.find(cut_marker)
        if idx != -1:
            raw = raw[:idx]
    text = strip_leading_button_noise(raw)
    text = re.sub(r"\s+\n", "\n", text).strip()
    if len(text) > max_chars:
        text = text[:max_chars].rstrip() + "…"
    return text


def extract_projects_text(soup: BeautifulSoup, max_chars: int = 1500) -> str:
    raw = section_text_between(soup, "projects", {"reviews", "about", "album"})
    titles = parse_project_titles(raw)
    joined = " | ".join(titles[:15])
    if len(joined) > max_chars:
        joined = joined[:max_chars].rstrip() + "…"
    return joined


def extract_reviews_text(soup: BeautifulSoup, max_chars: int = 1800) -> str:
    raw = section_text_between(soup, "reviews", {"about", "album"})
    return clean_reviews_text(raw, max_chars)


def scrape_profile(page, url: str) -> dict | None:
    # Профиль рендерится на сервере (SSR) — весь контент вкладок уже есть
    # в HTML при обычной загрузке страницы, кликать по вкладкам не нужно.
    page.goto(url, wait_until="domcontentloaded", timeout=45_000)
    html = page.content()
    soup = BeautifulSoup(html, "html.parser")

    # Имя: реальный заголовок профиля — h2 (например "Дмитрий Красса").
    # h1 на этой странице — задвоенная карточка в подвале
    # ("Дмитрий КрассаДмитрий Красса"), поэтому h1 избегаем.
    name = ""
    h2 = soup.find("h2")
    if h2:
        name = h2.get_text(strip=True)
    if not name:
        h1 = soup.find("h1")
        if h1:
            name = h1.get_text(strip=True)
    name = dedupe_repeated_name(name)

    # Email (обычно не замаскирован, ссылка mailto:)
    email = ""
    mail_tag = soup.find("a", href=lambda h: h and h.startswith("mailto:"))
    if mail_tag:
        email = mail_tag["href"].replace("mailto:", "").strip()

    # Телефон — из ссылки на WhatsApp (сам номер в контактах замаскирован
    # звёздочками и требует клика; в WhatsApp-ссылке он в открытом виде).
    phone = extract_phone_from_wa(html)

    # Сайт / соцсети — раскладываем по платформам, отфильтровывая ссылки
    # самой Флатики (они одинаковые в подвале любой страницы) и обрезая
    # "хвосты" (utm_*, fbclid, share_to, igsh и т.п.).
    website = ""
    social_buckets = {"telegram": [], "whatsapp": [], "vk": [], "dzen": [], "youtube": [], "instagram": [], "other": []}
    for a in soup.find_all("a", href=True):
        href = a["href"] or ""
        if not href or is_flatica_own_link(href):
            continue
        clean_href = clean_url_tail(href)
        if any(d in href for d in SOCIAL_DOMAIN_HINTS):
            platform = classify_social_link(href)
            social_buckets[platform].append(clean_href)
        elif href.startswith("http") and parsed.netloc not in href and "yandex.ru/maps" not in href and not website:
            website = clean_href

    for key in social_buckets:
        social_buckets[key] = " | ".join(dict.fromkeys(social_buckets[key]))

    has_any_social = any(social_buckets.values())

    # Город
    city = ""
    m_city = re.search(r"г\.?\s?[А-ЯЁ][а-яё]+(?:-[А-ЯЁ][а-яё]+)*(?:-на-[А-ЯЁ][а-яё]+)?", html)
    if m_city:
        city = m_city.group(0)

    if not (email or phone or has_any_social):
        return None  # нет ни одного способа связи — пропускаем

    # Рейтинг / число отзывов из шапки профиля
    page_text = soup.get_text(separator=" ")
    rating, review_count = extract_rating_info(page_text)

    # Три отдельных поля-сырья для персонализированных писем — берутся
    # напрямую из соответствующих секций по их реальным id, без кликов.
    about_text = extract_about_text(soup)
    projects_text = extract_projects_text(soup)
    reviews_text = extract_reviews_text(soup)

    if DEBUG:
        found = [k for k, v in [("about", about_text), ("projects", projects_text), ("reviews", reviews_text)] if v]
        missing = [k for k, v in [("about", about_text), ("projects", projects_text), ("reviews", reviews_text)] if not v]
        print(f"    [debug] {name!r}: заполнено {found}, пусто {missing}")

    category = classify_profile(html)

    return {
        "name": name,
        "url": url,
        "city": city,
        "phone": phone,
        "email": email,
        "website": website,
        "telegram": social_buckets["telegram"],
        "whatsapp": social_buckets["whatsapp"],
        "vk": social_buckets["vk"],
        "dzen": social_buckets["dzen"],
        "youtube": social_buckets["youtube"],
        "instagram": social_buckets["instagram"],
        "other_social": social_buckets["other"],
        "category": category,
        "rating": rating,
        "review_count": review_count,
        "about_text": about_text,
        "projects": projects_text,
        "reviews_excerpt": reviews_text,
    }


# ─── Журнал состояния обхода (profiles.csv) ────────────────────────────────
# profiles.csv — единый файл, который делает обход возобновляемым:
#   * колонка url    — адрес профиля (заполняется на этапе сбора списка);
#   * колонка status — пусто = ещё не обходили, "✓" = обошли, есть контакты,
#                      "⤫" = обошли, контактов нет;
#   * остальные колонки — данные профиля (заполняются только для "✓").
# При старте скрипт читает этот файл и обрабатывает только строки с пустым
# status, поэтому прерванный обход продолжается с места остановки.

# Поля с данными профиля (тот же набор, что раньше уходил в designers.csv).
DATA_FIELDS = [
    "name", "city", "phone", "email", "website",
    "telegram", "whatsapp", "vk", "dzen", "youtube", "instagram", "other_social",
    "category", "rating", "review_count", "about_text", "projects", "reviews_excerpt",
]
# Колонки журнала: url и status впереди, затем данные.
PROFILE_FIELDS = ["url", "status"] + DATA_FIELDS
# Колонки итогового designers.csv (совместимость с остальным пайплайном):
# как раньше — name, url, city, ... без status.
DESIGNERS_FIELDS = [
    "name", "url", "city", "phone", "email", "website",
    "telegram", "whatsapp", "vk", "dzen", "youtube", "instagram", "other_social",
    "category", "rating", "review_count", "about_text", "projects", "reviews_excerpt",
]

FLUSH_EVERY = 20  # как часто дозаписывать журнал на диск (баланс скорости и потерь при сбое)


def blank_profile_row(url: str) -> dict:
    row = {k: "" for k in PROFILE_FIELDS}
    row["url"] = url
    return row


def write_profiles_file(path: str, rows: list):
    with open(path, "w", newline="", encoding="utf-8-sig") as f:
        writer = csv.DictWriter(f, fieldnames=PROFILE_FIELDS, extrasaction="ignore")
        writer.writeheader()
        writer.writerows(rows)


def export_designers(path: str, rows: list):
    """Выгружает в designers.csv только строки со статусом '✓' (с контактами)."""
    done = [r for r in rows if r.get("status") == "✓"]
    with open(path, "w", newline="", encoding="utf-8-sig") as f:
        writer = csv.DictWriter(f, fieldnames=DESIGNERS_FIELDS, extrasaction="ignore")
        writer.writeheader()
        for r in done:
            writer.writerow({k: r.get(k, "") for k in DESIGNERS_FIELDS})


def seed_profiles(page) -> list:
    """Первый проход: открыть список, докрутить, собрать ВСЕ ссылки и записать
    их в profiles.csv с пустым статусом — как очередь на обработку."""
    print(f"Открываю список: {LIST_URL}")
    try:
        page.goto(LIST_URL, wait_until="load", timeout=60_000)
    except Exception as e:
        print(f"  [WARN] goto завершился с предупреждением ({e}), продолжаю — страница могла успеть загрузиться.")

    try:
        page.wait_for_selector('a[href^="/pro/"]', timeout=30_000)
    except Exception:
        print("  [WARN] Не дождался карточек профилей за 30с — возможно, сайт отдал капчу или изменил структуру.")

    profile_links = scroll_and_collect_links(page)
    profile_urls = [urljoin(BASE, href) for href in profile_links]
    if MAX_PROFILES:
        profile_urls = profile_urls[:MAX_PROFILES]

    rows = [blank_profile_row(u) for u in profile_urls]
    write_profiles_file(PROFILES_PATH, rows)
    print(f"Список сохранён в {PROFILES_PATH}: {len(rows)} профилей. Начинаю обход.\n")
    return rows


def load_profiles() -> list:
    """Читает существующий profiles.csv и приводит строки к полному набору
    колонок (на случай, если файл был создан старой версией)."""
    with open(PROFILES_PATH, encoding="utf-8-sig") as f:
        rows = list(csv.DictReader(f))
    for r in rows:
        for k in PROFILE_FIELDS:
            r.setdefault(k, "")
    return rows


def cleanup_shared_projects(rows: list):
    """Настоящее портфолио уникально. Если одно значение projects встретилось
    у ≥2 разных '✓'-профилей — это общий блок сайта, а не портфолио: чистим."""
    from collections import Counter
    done = [r for r in rows if r.get("status") == "✓"]
    proj_counts = Counter(r["projects"] for r in done if r["projects"].strip())
    stripped = 0
    for r in done:
        if r["projects"].strip() and proj_counts[r["projects"]] > 1:
            r["projects"] = ""
            stripped += 1
    if stripped:
        print(f"  [INFO] Очищено {stripped} значений 'projects', повторявшихся у разных профилей (общий блок сайта).")
    return stripped


def main():
    with sync_playwright() as pw:
        browser = pw.chromium.launch(headless=HEADLESS)
        page = browser.new_page()
        page.set_viewport_size({"width": 1366, "height": 900})
        page.set_default_navigation_timeout(45_000)

        # ── Сбор списка ЛИБО возобновление из существующего журнала ──────────
        import os
        if os.path.exists(PROFILES_PATH) and not FRESH:
            rows = load_profiles()
            done = sum(1 for r in rows if r.get("status", "").strip())
            pending = len(rows) - done
            print(f"[resume] Найден {PROFILES_PATH}: всего {len(rows)}, уже обработано {done}, "
                  f"осталось {pending}. Продолжаю без пересбора списка.\n")
            if pending == 0:
                print("Все профили уже обработаны. Для нового сбора запустите с --fresh или удалите profiles.csv.")
        else:
            if FRESH and os.path.exists(PROFILES_PATH):
                print(f"[--fresh] Игнорирую существующий {PROFILES_PATH}, собираю список заново.")
            rows = seed_profiles(page)

        # ── Проход по необработанным строкам ─────────────────────────────────
        todo = [r for r in rows if not r.get("status", "").strip()]
        saved = sum(1 for r in rows if r.get("status") == "✓")
        skipped = sum(1 for r in rows if r.get("status") == "⤫")
        since_flush = 0

        for i, row in enumerate(todo, 1):
            url = row["url"]
            print(f"[{i}/{len(todo)}] {url}")
            try:
                data = scrape_profile(page, url)
                errored = False
            except Exception as e:
                print(f"  [WARN] ошибка при обработке: {e} — оставляю на повтор при следующем запуске")
                data, errored = None, True

            if errored:
                # Транзиентная ошибка: статус НЕ проставляем, чтобы resume
                # попробовал профиль снова, а не записал его в пропуски.
                pass
            elif data is None:
                row["status"] = "⤫"
                skipped += 1
                print("  ⤫ пропущен (нет контактов)")
            else:
                row["status"] = "✓"
                for k in DATA_FIELDS:
                    row[k] = data.get(k, "")
                saved += 1
                print(f"  ✓ {data['name']} | тел: {data['phone'] or '—'} | email: {data['email'] or '—'} | {data['category']}")

            since_flush += 1
            if since_flush >= FLUSH_EVERY:
                write_profiles_file(PROFILES_PATH, rows)
                export_designers(OUT_PATH, rows)
                since_flush = 0

            time.sleep(random.uniform(*PROFILE_DELAY))

        # Финальная запись + очистка общих портфолио.
        cleanup_shared_projects(rows)
        write_profiles_file(PROFILES_PATH, rows)
        export_designers(OUT_PATH, rows)

        browser.close()

    remaining = sum(1 for r in rows if not r.get("status", "").strip())
    print(f"\n✅ Готово. С контактами: {saved}. Без контактов: {skipped}. "
          f"Не обработано (ошибки, повтор при resume): {remaining}.")
    print(f"   Журнал: {PROFILES_PATH}   |   Итог с контактами: {OUT_PATH}")


if __name__ == "__main__":
    main()
