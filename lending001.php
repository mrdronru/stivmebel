<?php
require_once __DIR__ . '/config.php';
$page           = '';
$title          = 'Мебель для новостройки в Нижегородском · Стив Интерьеры';
$description    = 'Делаем кухни и шкафы на заказ для жителей ЖК Среда, Аквилон Бисайт и ЖК Профит. Знаем планировки этих домов. Замер бесплатно.';
$extra_css      = ['lending001style.css'];
$canonical_path = 'lending001';
include 'header.php';
?>

<main class="l-wrap">

  <!-- ── HERO: на весь экран, фото за текстом ── -->
  <section class="l-hero">
    <img class="l-hero-bg" src="images/k03.jpg" alt="Кухня на заказ в новостройке" loading="eager">
    <div class="l-hero-overlay"></div>
    <div class="l-hero-content">
      <p class="l-eyebrow">ЖК Среда · Аквилон Бисайт · ЖК Профит</p>
      <h1 class="l-h1">Ключи получены.<br>Осталось <em>мебель.</em></h1>
      <p class="l-lead">Кухни, шкафы и гардеробные на заказ — для квартир в Нижегородском районе. Работали в этих домах, знаем их планировки.</p>
      <button class="l-hero-btn" onclick="openContactPopup()">Бесплатный замер</button>
    </div>
    <div class="l-scroll-hint">
      <span>листайте</span>
      <svg width="12" height="20" viewBox="0 0 12 20" fill="none"><path d="M6 1v18M1 13l5 6 5-6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
  </section>

  <!-- ── ЗНАЕМ РАЙОН ── -->
  <section class="l-district">
    <div class="l-district-inner">
      <p class="l-label">Нижегородский район, ЮВАО</p>
      <h2 class="l-h2">Делали мебель<br>в <em>ваших домах</em></h2>
      <p class="l-district-text">Все три комплекса — один район, одни планировки. Нестандартные ниши, скошенные углы, вентиляционные короба у плиты — мы с этим уже работали и знаем, как сделать так, чтобы мебель встала без зазоров и переделок.</p>
      <div class="l-jk-row">
        <div class="l-jk-tag">ЖК Среда</div>
        <div class="l-jk-tag">Аквилон Бисайт</div>
        <div class="l-jk-tag">ЖК Профит</div>
      </div>
    </div>
  </section>

  <!-- ── ТРИ РАБОТЫ ── -->
  <section class="l-works">
    <div class="l-works-inner">
      <div class="l-work l-work--wide">
        <div class="l-work-img">
          <img src="images/k01.jpg" alt="Кухня на заказ" loading="lazy">
        </div>
        <div class="l-work-meta">
          <span class="l-work-type">Кухня</span>
          <span class="l-work-detail">под потолок · 3,4 п.м.</span>
        </div>
      </div>
      <div class="l-work">
        <div class="l-work-img">
          <img src="images/k04.jpg" alt="Шкаф-купе на заказ" loading="lazy">
        </div>
        <div class="l-work-meta">
          <span class="l-work-type">Шкаф-купе</span>
          <span class="l-work-detail">встроенный · 2 п.м.</span>
        </div>
      </div>
      <div class="l-work">
        <div class="l-work-img">
          <img src="images/k06.jpg" alt="Гардеробная на заказ" loading="lazy">
        </div>
        <div class="l-work-meta">
          <span class="l-work-type">Гардеробная</span>
          <span class="l-work-detail">под ключ · 4,8 п.м.</span>
        </div>
      </div>
    </div>
    <div class="l-works-cta">
      <a href="catalog.php" class="btn-secondary">Все работы в галерее</a>
    </div>
  </section>

  <!-- ── КАК ЭТО РАБОТАЕТ ── -->
  <section class="l-process">
    <div class="l-process-inner">
      <p class="l-label">Как это работает</p>
      <div class="l-steps">
        <div class="l-step">
          <div class="l-step-num">01</div>
          <div class="l-step-body">
            <div class="l-step-title">Замер — бесплатно</div>
            <div class="l-step-text">Приедем в удобное время, снимем точные размеры. Учтём все особенности — короба, ниши, скосы.</div>
          </div>
        </div>
        <div class="l-step">
          <div class="l-step-num">02</div>
          <div class="l-step-body">
            <div class="l-step-title">3D-проект до договора</div>
            <div class="l-step-text">Покажем как будет выглядеть, согласуем детали и цену. Никаких обязательств, пока не устроит результат.</div>
          </div>
        </div>
        <div class="l-step">
          <div class="l-step-num">03</div>
          <div class="l-step-body">
            <div class="l-step-title">Производство и монтаж</div>
            <div class="l-step-text">Делаем сами, без субподрядчиков. Собираем, регулируем, убираем за собой. Принимаете готовый результат.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── CTA ФИНАЛЬНЫЙ ── -->
  <section class="l-cta">
    <div class="l-cta-bg">
      <img src="images/m01.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="l-cta-overlay"></div>
    </div>
    <div class="l-cta-content">
      <h2 class="l-cta-title">Запишитесь на<br>бесплатный замер</h2>
      <p class="l-cta-sub">Приедем, посмотрим пространство и сделаем проект под вашу квартиру.</p>
      <button class="l-cta-btn" onclick="openContactPopup()">Записаться</button>
      <a href="tel:<?php echo SITE_PHONE_HREF; ?>" class="l-cta-phone"><?php echo SITE_PHONE; ?></a>
    </div>
  </section>

</main>

<?php include 'footer.php'; ?>
