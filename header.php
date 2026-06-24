<?php
require_once __DIR__ . '/config.php';
/**
 * header.php — общая шапка сайта
 * Подключается на каждой странице: <?php include 'header.php'; ?>
 *
 * Переменная $page используется для подсветки активного пункта меню:
 * Установите в начале страницы: $page = 'about'; // или gallery, video, contact
 *
 * Переменная $basePath — префикс для всех относительных ссылок и подключаемых
 * файлов (style.css, favicon, about.php и т.д.). По умолчанию пустая строка —
 * подходит для страниц в корне сайта. Для страниц в подпапках (например,
 * /abc/term.html) установите $basePath = '../' перед include.
 */
$basePath = $basePath ?? '';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
    (function(m,e,t,r,i,k,a){
      m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
      m[i].l=1*new Date();
      for(var j=0;j<document.scripts.length;j++){if(document.scripts[j].src===r){return;}}
      k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window,document,'script','https://mc.yandex.ru/metrika/tag.js?id=' + <?php echo YANDEX_METRIKA_ID; ?> + '','ym');
    ym(<?php echo YANDEX_METRIKA_ID; ?>,'init',{ssr:true,webvisor:true,clickmap:true,ecommerce:"dataLayer",referrer:document.referrer,url:location.href,accurateTrackBounce:true,trackLinks:true});
  </script>
  <noscript><div><img src="https://mc.yandex.ru/watch/<?php echo YANDEX_METRIKA_ID; ?>" style="position:absolute;left:-9999px;" alt=""/></div></noscript>
  <!-- /Yandex.Metrika counter -->

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
    $page_title = isset($title) ? $title . ' · Стив Интерьеры' : 'Стив Интерьеры · Корпусная мебель на заказ';
    $page_description = isset($description)
      ? $description
      : 'Корпусная мебель на заказ в Москве и МО. Кухни, шкафы, гардеробные. Замер, 3D-проект и монтаж под ключ. Гарантия 2 года. Стив Интерьеры.';
  ?>
  <title><?php echo htmlspecialchars($page_title, ENT_QUOTES); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES); ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES); ?>">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="ru_RU">
  <meta property="og:url" content="<?php echo rtrim(SITE_URL, '/') . '/' . ltrim($canonical_path ?? ($_SERVER['REQUEST_URI'] ?? ''), '/'); ?>">
  <meta property="og:image" content="<?php echo SITE_URL; ?>/og-image.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:site_name" content="<?php echo SITE_NAME; ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo rtrim(SITE_URL, '/') . '/' . ltrim($canonical_path ?? strtok($_SERVER['REQUEST_URI'] ?? '/', '?'), '/'); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500&display=swap" rel="stylesheet">
  <script src="<?php echo $basePath; ?>favorites-storage.js"></script>
  <link rel="stylesheet" href="<?php echo $basePath; ?>style.css">
  <?php if (isset($extra_css)): foreach ($extra_css as $css): ?>
  <link rel="stylesheet" href="<?php echo $basePath; ?><?php echo $css; ?>">
  <?php endforeach; endif; ?>
  <link rel="icon" href="<?php echo $basePath; ?>favicon.ico" type="image/x-icon">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $basePath; ?>favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $basePath; ?>favicon-16x16.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $basePath; ?>apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $basePath; ?>favicon-192x192.png">

  <!-- Schema.org: LocalBusiness -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FurnitureStore",
    "name": "<?php echo SITE_NAME; ?>",
    "description": "<?php echo htmlspecialchars($page_description, ENT_QUOTES); ?>",
    "url": "<?php echo SITE_URL; ?>",
    "telephone": "<?php echo SITE_PHONE; ?>",
    "email": "<?php echo SITE_EMAIL; ?>",
    "areaServed": {
      "@type": "AdministrativeArea",
      "name": "Москва и Московская область"
    },
    "sameAs": [
      "<?php echo SOCIAL_VK; ?>",
      "<?php echo SOCIAL_TG; ?>"
    ]
  }
  </script>

  <?php if (isset($extra_head)) echo $extra_head; ?>
</head>
<body>

<?php
$nav_links = [
  'about'     => ['href' => $basePath . 'about.php',        'label' => 'Подробнее о нас'],
  'gallery'   => ['href' => $basePath . 'catalog.php',       'label' => 'Каталог'],
  'video'     => ['href' => $basePath . 'video.php',         'label' => 'Видео'],
  'favorites' => ['href' => $basePath . 'favorites.php',     'label' => 'Мне понравилось', 'fav' => true],
  'abc'       => ['href' => $basePath . 'abc.php',           'label' => 'Азбука'],
  'price'     => ['href' => $basePath . 'price.php',         'label' => 'Цены'],
  'contact'   => ['href' => $basePath . 'index.php#contact', 'label' => 'Контакты'],
];
$current = isset($page) ? $page : '';
?>

<!-- NAV -->
<nav id="mainNav">
  <a href="<?php echo $basePath; ?>index.php" class="nav-logo">Стив <span>Интерьеры</span></a>

  <ul class="nav-links">
    <?php foreach ($nav_links as $key => $link): ?>
    <li>
      <a href="<?php echo $link['href']; ?>"<?php if ($current === $key) echo ' class="nav-active"'; ?>>
        <?php echo $link['label']; ?>
        <?php if (!empty($link['fav'])): ?>
        <span class="nav-fav-count" style="display:none">0</span>
        <?php endif; ?>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>

  <div class="nav-socials">
    <a href="<?php echo SOCIAL_TG; ?>" class="nav-social-btn" target="_blank" rel="noopener" aria-label="Telegram">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M21.9 4.5L18.5 19.3c-.25 1.1-.9 1.38-1.82.86L12 16.9l-2.25 2.17c-.25.25-.46.46-.94.46l.34-4.77 8.7-7.86c.38-.34-.08-.52-.58-.18L5.9 13.94 1.74 12.6c-.9-.28-.92-.9.19-1.33L20.64 3.17c.75-.28 1.4.17 1.26 1.33z" fill="currentColor"/></svg>
    </a>
    <a href="<?php echo SOCIAL_VK; ?>" class="nav-social-btn" target="_blank" rel="noopener" aria-label="ВКонтакте">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M21.6 7.2c.14-.47 0-.82-.67-.82h-2.2c-.57 0-.83.3-.97.63 0 0-1.13 2.75-2.73 4.54-.52.52-.75.68-1.03.68-.14 0-.35-.16-.35-.63V7.2c0-.57-.16-.82-.64-.82H10c-.36 0-.57.27-.57.52 0 .55.82.68.9 2.22v3.35c0 .72-.13.85-.41.85-.75 0-2.58-2.76-3.66-5.92-.21-.62-.43-.87-1-.87H3.06c-.63 0-.76.3-.76.63 0 .59.76 3.5 3.52 7.35C7.7 17.5 10.2 18.9 12.5 18.9c1.37 0 1.54-.31 1.54-.84v-1.94c0-.63.13-.76.58-.76.33 0 .88.17 2.19 1.43 1.49 1.49 1.73 2.11 2.57 2.11h2.2c.63 0 .95-.31.77-.93-.2-.62-.93-1.52-1.9-2.59-.52-.62-1.3-1.29-1.54-1.62-.33-.42-.23-.61 0-.98 0 0 2.72-3.83 3-5.12z" fill="currentColor"/></svg>
    </a>
    <a href="<?php echo SOCIAL_MAX; ?>" class="nav-social-btn" target="_blank" rel="noopener" aria-label="Max">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M12 3C7.03 3 3 6.81 3 11.5c0 2.7 1.3 5.1 3.3 6.7l-.8 3.3 3.5-1.5c1 .3 2 .5 3 .5 4.97 0 9-3.81 9-8.5S16.97 3 12 3z" stroke="currentColor" stroke-width="6" stroke-linejoin="round" stroke-linecap="round"/></svg>
    </a>
    <a href="<?php echo SITE_PHONE_HREF; ?>" class="nav-social-btn" aria-label="Позвонить нам">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>

  <button onclick="openContactPopup()" class="nav-cta">Получить консультацию</button>

  <button class="nav-burger" id="navBurger" aria-label="Открыть меню">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- MOBILE DRAWER -->
<div class="nav-drawer" id="navDrawer">
  <ul>
    <?php foreach ($nav_links as $key => $link): ?>
    <li>
      <a href="<?php echo $link['href']; ?>" class="drawer-link">
        <?php echo $link['label']; ?>
        <?php if (!empty($link['fav'])): ?>
        <span class="nav-fav-count" style="display:none">0</span>
        <?php endif; ?>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
  <div class="nav-drawer-socials">
    <a href="<?php echo SOCIAL_TG; ?>" class="nav-social-btn" target="_blank" rel="noopener" aria-label="Telegram" style="width:2.5rem;height:2.5rem;">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M21.9 4.5L18.5 19.3c-.25 1.1-.9 1.38-1.82.86L12 16.9l-2.25 2.17c-.25.25-.46.46-.94.46l.34-4.77 8.7-7.86c.38-.34-.08-.52-.58-.18L5.9 13.94 1.74 12.6c-.9-.28-.92-.9.19-1.33L20.64 3.17c.75-.28 1.4.17 1.26 1.33z" fill="currentColor"/></svg>
    </a>
    <a href="<?php echo SOCIAL_VK; ?>" class="nav-social-btn" target="_blank" rel="noopener" aria-label="ВКонтакте" style="width:2.5rem;height:2.5rem;">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M21.6 7.2c.14-.47 0-.82-.67-.82h-2.2c-.57 0-.83.3-.97.63 0 0-1.13 2.75-2.73 4.54-.52.52-.75.68-1.03.68-.14 0-.35-.16-.35-.63V7.2c0-.57-.16-.82-.64-.82H10c-.36 0-.57.27-.57.52 0 .55.82.68.9 2.22v3.35c0 .72-.13.85-.41.85-.75 0-2.58-2.76-3.66-5.92-.21-.62-.43-.87-1-.87H3.06c-.63 0-.76.3-.76.63 0 .59.76 3.5 3.52 7.35C7.7 17.5 10.2 18.9 12.5 18.9c1.37 0 1.54-.31 1.54-.84v-1.94c0-.63.13-.76.58-.76.33 0 .88.17 2.19 1.43 1.49 1.49 1.73 2.11 2.57 2.11h2.2c.63 0 .95-.31.77-.93-.2-.62-.93-1.52-1.9-2.59-.52-.62-1.3-1.29-1.54-1.62-.33-.42-.23-.61 0-.98 0 0 2.72-3.83 3-5.12z" fill="currentColor"/></svg>
    </a>
    <a href="<?php echo SOCIAL_MAX; ?>" class="nav-social-btn" target="_blank" rel="noopener" aria-label="Max" style="width:2.5rem;height:2.5rem;">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M12 3C7.03 3 3 6.81 3 11.5c0 2.7 1.3 5.1 3.3 6.7l-.8 3.3 3.5-1.5c1 .3 2 .5 3 .5 4.97 0 9-3.81 9-8.5S16.97 3 12 3z" stroke="currentColor" stroke-width="6" stroke-linejoin="round" stroke-linecap="round"/></svg>
    </a>
    <a href="<?php echo SITE_PHONE_HREF; ?>" class="nav-social-btn" aria-label="Позвонить нам" style="width:2.5rem;height:2.5rem;">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
  <button onclick="if(typeof openContactPopup==='function'){closeDrawer();openContactPopup();}else{location='<?php echo $basePath; ?>index.php#contact';}" class="nav-drawer-cta drawer-link">Получить консультацию</button>
</div>
