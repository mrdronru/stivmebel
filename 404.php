<?php
require_once __DIR__ . '/config.php';
$page           = '';
$title          = 'Страница не найдена · Стив Интерьеры';
$description    = 'Страница не существует или была удалена. Вернитесь на главную.';
$canonical_path = '404';

// Вычисляем $basePath по глубине запрошенного URL.
// /abc/ldsp → глубина 1 → '../'
// /gallery, /404 и т.д. → глубина 0 → ''
$uri_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$depth    = max(0, substr_count(trim($uri_path, '/'), '/'));
$basePath = str_repeat('../', $depth);

http_response_code(404);
include __DIR__ . '/header.php';
?>

<main class="e404-wrap">
  <div class="e404-inner">
    <div class="e404-num">404</div>
    <h1 class="e404-title">Страница не найдена</h1>
    <p class="e404-sub">Возможно, адрес изменился или страница была удалена.<br>Но мебель мы всё равно сделаем.</p>
    <a href="<?php echo $basePath; ?>index.php" class="btn-primary e404-home">На главную</a>

    <div class="e404-nav">
      <a href="<?php echo $basePath; ?>catalog.php" class="e404-link">Каталог работ</a>
      <a href="<?php echo $basePath; ?>price.php" class="e404-link">Цены</a>
      <a href="<?php echo $basePath; ?>video.php" class="e404-link">Видео</a>
      <a href="<?php echo $basePath; ?>abc.php" class="e404-link">Азбука</a>
      <a href="<?php echo $basePath; ?>about.php" class="e404-link">О нас</a>
      <a href="<?php echo $basePath; ?>index.php#contact" class="e404-link">Контакты</a>
    </div>
  </div>
</main>

<style>
.e404-wrap {
  min-height: calc(100vh - 4.5rem);
  margin-top: 4.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--warm-white);
  padding: 4rem 2rem;
}
.e404-inner {
  text-align: center;
  max-width: 540px;
}
.e404-num {
  font-family: var(--serif);
  font-size: clamp(6rem, 15vw, 12rem);
  font-weight: 300;
  line-height: 1;
  color: var(--ink-10);
  margin-bottom: 1rem;
  letter-spacing: -0.02em;
}
.e404-title {
  font-family: var(--serif);
  font-size: clamp(1.8rem, 3vw, 2.6rem);
  font-weight: 300;
  color: var(--ink);
  margin-bottom: 1rem;
}
.e404-sub {
  font-family: var(--sans);
  font-size: var(--fs-sm);
  font-weight: 300;
  color: var(--ink-60);
  line-height: 1.75;
  margin-bottom: 2.5rem;
}
.e404-home {
  display: inline-block;
  margin-bottom: 3rem;
}
.e404-nav {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 0.5rem 1.5rem;
  padding-top: 2rem;
  border-top: 1px solid var(--ink-10);
}
.e404-link {
  font-family: var(--sans);
  font-size: var(--fs-xs);
  font-weight: 400;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--ink-60);
  text-decoration: none;
  transition: color 0.2s;
}
.e404-link:hover { color: var(--gold); }
</style>

<?php include __DIR__ . '/footer.php'; ?>
