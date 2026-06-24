<?php
require_once __DIR__ . '/config.php';
/**
 * build.php — генератор HTML-страниц из MD-файлов для раздела «Азбука»
 * Запуск: php build.php
 *
 * Читает файлы из abc/*.md
 * Генерирует страницы в abc/*.html
 * Генерирует abc/index.json — индекс для abcd.php
 * Генерирует sitemap.xml — карта сайта (старая переименовывается с датой)
 */

// ── Настройки ──
define('ABC_DIR',      __DIR__ . '/abc');
define('TEMPLATE_DIR', __DIR__);

require_once __DIR__ . '/markdown-helpers.php';

// ── HTML-шаблон страницы термина ──
// Использует настоящие header.php/footer.php через include + output buffering,
// а не отдельную копию шаблона — так любое изменение в header.php/footer.php
// автоматически подхватывается статьями Азбуки без необходимости синхронизировать
// их вручную (как раньше с heredoc-копией шаблона прямо в этом файле).
function renderArticlePage(array $meta, string $bodyHtml, array $allTerms): string {
    $titleRaw = $meta['title'] ?? 'Термин';
    $short    = htmlspecialchars($meta['short'] ?? '', ENT_QUOTES);
    $slug     = $meta['slug'] ?? '';

    // Соседние термины (пред/след)
    $slugs = array_column($allTerms, 'slug');
    $pos   = array_search($slug, $slugs);
    $prev  = $pos > 0                    ? $allTerms[$pos - 1] : null;
    $next  = $pos < count($slugs) - 1   ? $allTerms[$pos + 1] : null;

    $prevLink = $prev ? "<a href=\"{$prev['slug']}.html\" class=\"abc-nav-link abc-nav-prev\">← {$prev['title']}</a>" : '<span></span>';
    $nextLink = $next ? "<a href=\"{$next['slug']}.html\" class=\"abc-nav-link abc-nav-next\">{$next['title']} →</a>" : '<span></span>';

    // Переменные, которые ожидают header.php/footer.php.
    // $title здесь — НЕэкранированная строка: header.php сам применяет
    // htmlspecialchars к ней (и к $page_title на её основе), поэтому передавать
    // уже экранированную строку привело бы к двойному экранированию (&amp;amp;).
    // $basePath = '../' — страницы Азбуки лежат в подпапке abc/.
    // $canonical_path — явный путь для og:url/canonical, так как при генерации
    // из CLI $_SERVER['REQUEST_URI'] не определён (см. PROJECT.md).
    $basePath       = '../';
    $page           = 'abc';
    $title          = $titleRaw . ' · Азбука';
    $description    = $meta['short'] ?? '';
    $extra_css      = ['abcstyle.css'];
    $canonical_path = 'abc/' . $slug . '.html';

    ob_start();
    include TEMPLATE_DIR . '/header.php';
    ?>

<div class="abc-article-wrap">
  <div class="abc-article-back">
    <a href="../abcd.php" class="nav-back">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
      Азбука
    </a>
  </div>

  <article class="abc-article">
    <header class="abc-article-header">
      <p class="abc-article-letter"><?php echo htmlspecialchars($meta['letter'] ?? '?', ENT_QUOTES); ?></p>
      <h1 class="abc-article-title"><?php echo htmlspecialchars($titleRaw, ENT_QUOTES); ?></h1>
      <p class="abc-article-short"><?php echo $short; ?></p>
    </header>
    <div class="abc-article-body">
      <?php echo $bodyHtml; ?>
    </div>
  </article>

  <div class="abc-article-cta">
    <div class="abc-cta-text">
      <p class="abc-cta-title">Достаточно теории. Давайте к практике.</p>
      <p class="abc-cta-sub">Посмотрите наши работы или запишитесь на бесплатный замер — приедем, обмерим, сделаем проект.</p>
    </div>
    <div class="abc-cta-actions">
      <button class="btn-primary" onclick="openContactPopup()">Записаться на замер</button>
      <a href="../catalog.php" class="btn-secondary">Смотреть галерею →</a>
    </div>
  </div>

  <nav class="abc-article-nav">
    <?php echo $prevLink; ?>
    <?php echo $nextLink; ?>
  </nav>
</div>

    <?php
    include TEMPLATE_DIR . '/footer.php';
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (window.favStorage) window.favStorage.updateCounter();
    });
    </script>
<?php
    return ob_get_clean();
}

// ── Генерация sitemap.xml ──
function generateSitemap(array $terms): string {
    // Статические страницы сайта
    // changefreq и priority подобраны под мебельный сайт-визитку:
    // главная и каталог — высокий приоритет, меняются реже,
    // страницы Азбуки — низкий приоритет, меняются редко
    $staticPages = [
        ['loc' => '',           'changefreq' => 'weekly',  'priority' => '1.0'],
        ['loc' => 'about.php',  'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => 'catalog.php','changefreq' => 'weekly',  'priority' => '0.9'],
        ['loc' => 'video.php',  'changefreq' => 'weekly',  'priority' => '0.7'],
        ['loc' => 'price.php',  'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => 'abcd.php',   'changefreq' => 'weekly',  'priority' => '0.7'],
    ];

    $baseUrl = rtrim(SITE_URL, '/');
    $today   = date('Y-m-d');

    $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Статические страницы
    foreach ($staticPages as $page) {
        $loc = $baseUrl . ($page['loc'] ? '/' . $page['loc'] : '/');
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        $xml .= "    <lastmod>{$today}</lastmod>\n";
        $xml .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
        $xml .= "    <priority>{$page['priority']}</priority>\n";
        $xml .= "  </url>\n";
    }

    // Страницы Азбуки
    foreach ($terms as $term) {
        $loc = $baseUrl . '/abc/' . $term['slug'] . '.html';
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        $xml .= "    <lastmod>{$today}</lastmod>\n";
        $xml .= "    <changefreq>monthly</changefreq>\n";
        $xml .= "    <priority>0.5</priority>\n";
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>' . "\n";
    return $xml;
}

// ── Сохранение sitemap с архивированием старого ──
function saveSitemap(string $xml): void {
    $sitemapPath = __DIR__ . '/sitemap.xml';

    // Если старый sitemap существует — переименовать с датой и временем
    if (file_exists($sitemapPath)) {
        $timestamp   = date('Y-m-d_H-i-s');
        $archivePath = __DIR__ . '/sitemap_' . $timestamp . '.xml';
        rename($sitemapPath, $archivePath);
        echo "→ Старый sitemap сохранён как: sitemap_{$timestamp}.xml\n";
    }

    file_put_contents($sitemapPath, $xml);
}

// ── Основной цикл ──
$files = glob(ABC_DIR . '/*.md');
if (!$files) {
    echo "Нет MD-файлов в папке abc/\n";
    exit(1);
}

$terms = [];

// Первый проход — собрать все термины для индекса и навигации
foreach ($files as $file) {
    $content = file_get_contents($file);
    $parsed  = parseFrontmatter($content);
    $meta    = $parsed['meta'];
    if (empty($meta['title']) || empty($meta['slug'])) {
        echo "⚠ Пропущен (нет title/slug): " . basename($file) . "\n";
        continue;
    }
    $terms[] = [
        'title'  => $meta['title'],
        'slug'   => $meta['slug'],
        'letter' => $meta['letter'] ?? '?',
        'short'  => $meta['short']  ?? '',
        'file'   => $file,
        'meta'   => $meta,
        'body'   => $parsed['body'],
    ];
}

// Сортировать по русскому алфавиту, потом латиница
usort($terms, function($a, $b) {
    return mb_strtolower($a['title']) <=> mb_strtolower($b['title']);
});

// Упрощённый индекс для JSON
$index = array_map(fn($t) => [
    'title'  => $t['title'],
    'slug'   => $t['slug'],
    'letter' => $t['letter'],
    'short'  => $t['short'],
], $terms);

// Сохранить индекс
file_put_contents(ABC_DIR . '/index.json', json_encode($index, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
echo "✓ Индекс: abc/index.json (" . count($index) . " терминов)\n";

// Второй проход — генерировать HTML
foreach ($terms as $term) {
    $bodyHtml = parseMarkdown($term['body']);
    $html     = renderArticlePage($term['meta'], $bodyHtml, $index);
    $outFile  = ABC_DIR . '/' . $term['slug'] . '.html';
    file_put_contents($outFile, $html);
    echo "✓ " . $term['slug'] . '.html  — ' . $term['title'] . "\n";
}

// Генерировать и сохранить sitemap
$sitemapXml = generateSitemap($index);
saveSitemap($sitemapXml);
echo "✓ sitemap.xml — " . (count($index) + 5) . " URL (" . count($index) . " статей Азбуки + 5 статических страниц)\n";

echo "\nГотово! Сгенерировано " . count($terms) . " страниц.\n";
echo "Запустите снова после добавления новых MD-файлов.\n";
