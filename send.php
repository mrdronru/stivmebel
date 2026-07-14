<?php
/**
 * send.php — обработчик форм сайта Стив Мебель
 * Отправляет заявки в Telegram-бот
 */

session_start(); // до любых header() и вывода
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: https://stivmebel.ru');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// ── Rate limiting: не более 3 заявок в минуту с одного браузера ──
$now = time();
$_SESSION['send_times'] = array_values(array_filter(
    $_SESSION['send_times'] ?? [],
    fn($t) => $now - $t < 60
));
if (count($_SESSION['send_times']) >= 3) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Too many requests. Please wait a moment.']);
    exit;
}
$_SESSION['send_times'][] = $now;

// Настройки загружаются из config.php

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid JSON']);
    exit;
}

// Только trim — htmlspecialchars не нужен для Telegram
function clean($val) {
    return trim((string)$val);
}

// parse_mode не используется — отправляем как обычный текст.
// Так пользовательский ввод (точки, скобки, подчёркивания, обратные слеши и т.д.)
// никогда не может сломать парсинг разметки на стороне Telegram.

$name    = clean($data['name']    ?? '');
$phone   = clean($data['phone']   ?? '');
$type    = clean($data['type']    ?? '');
$comment = clean($data['comment'] ?? '');
$photos  = $data['photos'] ?? [];
$source  = clean($data['source']  ?? 'сайт');

if (!$name || !$phone) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Name and phone required']);
    exit;
}

// Валидация телефона: минимум 10 цифр
// Для квиза с нетелефонным способом связи — пропускаем проверку цифр
$skipPhoneCheck = ($source === 'quiz' && mb_strlen(preg_replace('/\D/', '', $phone)) < 10);
if (!$skipPhoneCheck && mb_strlen(preg_replace('/\D/', '', $phone)) < 10) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Invalid phone number']);
    exit;
}

// Формируем сообщение
if ($source === 'gallery' || $source === 'favorites') $icon = '🖼';
elseif ($source === 'quiz') $icon = '🎯';
else $icon = '📋';
if ($source === 'gallery')       $sourceLabel = 'Галерея';
elseif ($source === 'popup')     $sourceLabel = 'Попап';
elseif ($source === 'favorites') $sourceLabel = 'Избранное';
elseif ($source === 'quiz')      $sourceLabel = 'Квиз';
elseif ($source === 'project-cc') $sourceLabel = 'Страница проекта (Сердце Столицы)';
else                             $sourceLabel = 'Сайт';

$text  = "{$icon} Новая заявка — {$sourceLabel}\n\n";
$text .= "👤 Имя: {$name}\n";
$text .= "📞 Телефон: {$phone}\n";

if ($type)    $text .= "🪑 Тип мебели: {$type}\n";
if ($comment) $text .= "💬 Комментарий: {$comment}\n";

if ($photos && count($photos) > 0) {
    $count = count($photos);
    $names = array_map(fn($p) => basename((string)$p), $photos);
    $text .= "🖼 Фото ({$count}): " . implode(', ', $names) . "\n";
}

$text .= "\n🕐 " . date('d.m.Y H:i');

// Отправка через cURL
$url = "https://api.telegram.org/bot" . TG_TOKEN . "/sendMessage";

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode([
        'chat_id'    => TG_CHAT_ID,
        'text'       => $text,
    ]),
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 10,
]);

$result = curl_exec($ch);
$err    = curl_error($ch);
curl_close($ch);

$resp = $result ? json_decode($result, true) : null;

if ($resp && $resp['ok']) {
    echo json_encode(['ok' => true]);
} else {
    error_log('send.php telegram error: ' . ($err ?: $result));
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Telegram send failed']);
}
