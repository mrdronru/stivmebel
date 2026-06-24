<?php
/**
 * markdown-helpers.php — общий простой Markdown-парсер
 *
 * Используется:
 *  - build.php   — при сборке статичных страниц «Азбуки» (abc/*.md → abc/*.html)
 *  - price.php   — при чтении faq.md «на лету» для блока вопросов-ответов
 *
 * Поддерживает: заголовки # ## ###, списки -/*, таблицы |...|, параграфы,
 * инлайн-разметку **полужирный**, *курсив*, `код`, [текст](ссылка).
 *
 * Изменения здесь применяются сразу везде, где подключён этот файл —
 * отдельно копировать логику парсера в другие файлы не нужно.
 */

function parseMarkdown(string $md): string {
    $lines  = explode("\n", $md);
    $html   = [];
    $inList = false;

    foreach ($lines as $line) {
        // Заголовки
        if (preg_match('/^### (.+)/', $line, $m)) {
            if ($inList) { $html[] = '</ul>'; $inList = false; }
            $html[] = '<h3>' . inlineMarkdown($m[1]) . '</h3>';
        } elseif (preg_match('/^## (.+)/', $line, $m)) {
            if ($inList) { $html[] = '</ul>'; $inList = false; }
            $html[] = '<h2>' . inlineMarkdown($m[1]) . '</h2>';
        } elseif (preg_match('/^# (.+)/', $line, $m)) {
            if ($inList) { $html[] = '</ul>'; $inList = false; }
            $html[] = '<h1>' . inlineMarkdown($m[1]) . '</h1>';
        }
        // Таблицы (строка с |)
        elseif (preg_match('/^\|/', $line)) {
            if ($inList) { $html[] = '</ul>'; $inList = false; }
            if (preg_match('/^\|[-\s|]+\|$/', $line)) {
                // Разделитель таблицы — пропускаем
            } else {
                $cells = array_map('trim', explode('|', trim($line, '|')));
                $isHead = !isset($tableOpen);
                if ($isHead) { $html[] = '<div class="abc-table-wrap"><table><thead><tr>'; $tableOpen = true; }
                else         { $html[] = '<tr>'; }
                foreach ($cells as $cell) {
                    $t = $isHead ? 'th' : 'td';
                    $html[] = "<{$t}>" . inlineMarkdown($cell) . "</{$t}>";
                }
                $html[] = $isHead ? '</tr></thead><tbody>' : '</tr>';
            }
        }
        // Конец таблицы
        elseif (isset($tableOpen) && !preg_match('/^\|/', $line)) {
            $html[] = '</tbody></table></div>';
            unset($tableOpen);
            // Не пропускаем строку — обрабатываем дальше
            goto processLine;
        }
        // Списки
        elseif (preg_match('/^[-*] (.+)/', $line, $m)) {
            if (!$inList) { $html[] = '<ul>'; $inList = true; }
            $html[] = '<li>' . inlineMarkdown($m[1]) . '</li>';
        }
        // Пустая строка
        elseif (trim($line) === '') {
            if ($inList) { $html[] = '</ul>'; $inList = false; }
            else         { $html[] = ''; }
        }
        // Параграф
        else {
            processLine:
            if ($inList) { $html[] = '</ul>'; $inList = false; }
            if (trim($line) !== '') $html[] = '<p>' . inlineMarkdown($line) . '</p>';
        }
    }
    if ($inList) $html[] = '</ul>';
    if (isset($tableOpen)) $html[] = '</tbody></table></div>';

    return implode("\n", $html);
}

function inlineMarkdown(string $s): string {
    $s = htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
    $s = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $s);
    $s = preg_replace('/\*(.+?)\*/',     '<em>$1</em>',         $s);
    $s = preg_replace('/`(.+?)`/',       '<code>$1</code>',     $s);
    $s = preg_replace('/\[(.+?)\]\((.+?)\)/', '<a href="$2">$1</a>', $s);
    return $s;
}

/**
 * parseFaqMarkdown — разбирает MD-файл вида:
 *
 *   ## Вопрос первый?
 *   Ответ на первый вопрос. Можно с **разметкой** и абзацами.
 *
 *   ## Вопрос второй?
 *   Ответ на второй.
 *
 * Каждый заголовок `## ...` начинает новую пару вопрос/ответ — всё, что
 * идёт после него и до следующего `##`, становится ответом (через parseMarkdown,
 * то есть с поддержкой абзацев, списков и инлайн-разметки внутри ответа).
 *
 * Возвращает массив: [['question' => '...', 'answer_html' => '...'], ...]
 */
function parseFaqMarkdown(string $md): array {
    $lines = explode("\n", $md);
    $items = [];
    $currentQuestion = null;
    $currentBody = [];

    foreach ($lines as $line) {
        if (preg_match('/^## (.+)/', $line, $m)) {
            if ($currentQuestion !== null) {
                $items[] = [
                    'question'    => inlineMarkdown($currentQuestion),
                    'answer_html' => parseMarkdown(trim(implode("\n", $currentBody))),
                ];
            }
            $currentQuestion = trim($m[1]);
            $currentBody = [];
        } else {
            $currentBody[] = $line;
        }
    }
    if ($currentQuestion !== null) {
        $items[] = [
            'question'    => inlineMarkdown($currentQuestion),
            'answer_html' => parseMarkdown(trim(implode("\n", $currentBody))),
        ];
    }

    return $items;
}

/**
 * parseFrontmatter — разбирает MD-файл с YAML-подобным заголовком вида:
 *
 *   ---
 *   title: Значение
 *   slug: znachenie
 *   ---
 *
 *   Текст статьи...
 *
 * Используется в build.php (статьи Азбуки) и video.php (описания видео).
 * Возвращает ['meta' => ['title' => ..., 'slug' => ...], 'body' => 'Текст статьи...'].
 * Если файл не начинается с '---', meta будет пустым массивом, а body — весь файл целиком.
 */
function parseFrontmatter(string $content): array {
    if (!str_starts_with($content, '---')) {
        return ['meta' => [], 'body' => $content];
    }
    $end = strpos($content, '---', 3);
    if ($end === false) return ['meta' => [], 'body' => $content];

    $yaml = substr($content, 3, $end - 3);
    $body = trim(substr($content, $end + 3));
    $meta = [];
    foreach (explode("\n", trim($yaml)) as $line) {
        if (preg_match('/^(\w+):\s*(.+)/', $line, $m)) {
            $meta[trim($m[1])] = trim($m[2]);
        }
    }
    return ['meta' => $meta, 'body' => $body];
}
