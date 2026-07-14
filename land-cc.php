<?php
require_once __DIR__ . '/config.php';
$page           = '';
$title          = 'Мебель на заказ в ЖК Сердце Столицы · Стив Интерьеры';
$description    = 'Корпусная мебель на заказ для квартир бизнес-класса в ЖК Сердце Столицы. Шкафы, гардеробные, кухни. Нестандартные проекты. Фиксированная цена.';
$robots         = 'noindex, follow';
$extra_css      = ['landing.css'];
$canonical_path = 'land-cc';

include 'header.php';
?>

<!-- ── ШАПКА ЛЕНДИНГА ── -->
<header class="ln-nav" id="lnNav">
  <a href="/" class="ln-nav-logo">Стив <span>Интерьеры</span></a>
  <div class="ln-nav-right">
    <a href="<?php echo SITE_PHONE_HREF; ?>" class="ln-nav-phone" onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    <button class="ln-nav-btn" onclick="openContactPopup()">Обсудить проект</button>
  </div>
</header>

<main class="l-wrap">

  <!-- ── HERO ── -->
  <section class="l-hero lcc-hero">
    <video
      class="l-hero-bg lcc-hero-video"
      id="heroVideo"
      src="video/0010.mp4"
      poster="gallery/0044-wardrobe.jpg"
      autoplay
      muted
      loop
      playsinline
      preload="auto"
      aria-hidden="true"
    ></video>
    <div class="l-hero-overlay lcc-overlay"></div>
    <div class="l-hero-content lcc-hero-content">
      <p class="l-eyebrow">ЖК Сердце Столицы · Хорошёво-Мнёвники</p>
      <h1 class="l-h1 lcc-h1">Есть вещи, которые<br>должны быть <em>безупречными.</em></h1>
      <p class="l-lead lcc-lead">Мы создаём мебель, в которой всё — именно так, как должно быть.</p>
      <div class="l-hero-btns">
        <button class="l-hero-btn" onclick="openContactPopup()">Обсудить проект</button>
        <button class="l-hero-btn l-hero-btn--outline" onclick="openVideoModal()">▶ Видео со звуком</button>
      </div>
    </div>
    <div class="l-scroll-hint">
      <span>листайте</span>
      <svg width="12" height="20" viewBox="0 0 12 20" fill="none"><path d="M6 1v18M1 13l5 6 5-6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
  </section>

  <!-- ── ВИДЕО-ПОПАП ── -->
  <div id="videoModal" class="lcc-video-modal" onclick="if(event.target===this)closeVideoModal()">
    <div class="lcc-video-modal-inner">
      <button class="lcc-video-close" onclick="closeVideoModal()" aria-label="Закрыть">&times;</button>
      <video id="modalVideo" src="video/0010.mp4" controls playsinline></video>
    </div>
  </div>

  <!-- ── КЕЙС ── -->
  <section class="l-district lcc-case">
    <div class="l-district-inner">
      <p class="l-label">Наша работа в вашем доме</p>
      <h2 class="l-h2">Шкаф с трёхметровыми<br>дверями — <em>без антресолей</em></h2>
      <div class="lcc-case-text">
        <p>Настоящее качество редко привлекает внимание. Оно проявляется в другом: когда спустя годы не возникает желания что-то переделать.</p>
        <p>Этот шкаф появился именно так. Три метра высотой. Одно цельное полотно от пола до потолка. Ни одной детали, которая нарушала бы замысел.</p>
        <p>Мы изготовили фасады специально под проект. Продумали то, что останется незаметным для большинства: геометрию, нагрузку, каждый элемент фурнитуры, даже цвет крепежа.</p>
        <p class="lcc-case-quote">Потому что роскошь — это не то, что видно сразу. Это отсутствие вещей, которые могли бы раздражать потом.</p>
      </div>
    </div>
  </section>

  <!-- ── ФОТОГРАФИИ ПРОЕКТА ── -->
  <section class="l-portfolio lcc-portfolio">
    <div class="l-portfolio-inner">
      <div class="lcc-photo-grid">
        <div class="lcc-photo-item">
          <div class="l-pf-img">
            <img src="gallery/0044-wardrobe.jpg" alt="Три метра без компромиссов" loading="lazy">
          </div>
          <p class="l-pf-cap">Три метра без компромиссов</p>
        </div>
        <div class="lcc-photo-item">
          <div class="l-pf-img">
            <img src="gallery/0043-wardrobe.jpg" alt="Создан точно под это пространство" loading="lazy">
          </div>
          <p class="l-pf-cap">Создан точно под это пространство</p>
        </div>
        <div class="lcc-photo-item">
          <div class="l-pf-img">
            <img src="gallery/0045-wardrobe.jpg" alt="Продумано до каждой детали" loading="lazy">
          </div>
          <p class="l-pf-cap">Продумано до каждой детали</p>
        </div>
        <div class="lcc-photo-item">
          <div class="l-pf-img">
            <img src="gallery/0046-wardrobe.jpg" alt="Даже то, что почти незаметно" loading="lazy">
          </div>
          <p class="l-pf-cap">Даже то, что почти незаметно</p>
        </div>
      </div>
      <div class="l-works-cta" style="margin-top:3rem;">
        <a href="catalog" class="btn-secondary" target="_blank" rel="noopener">Все работы в галерее</a>
      </div>
    </div>
  </section>

  <!-- ── ИСТОРИЯ ── -->
  <section class="lcc-story">
    <div class="lcc-story-inner">
      <div class="lcc-story-text">
        <p class="l-label">История проекта</p>
        <blockquote class="lcc-blockquote">«Понравились работы и стиль. Сразу почувствовала, что всё получится»</blockquote>
        <p class="lcc-story-body">Эта фраза прозвучала на первой встрече. Дальше всё было вопросом точности. Не изменить первоначальную идею, не предложить решение «проще», а реализовать её именно такой, какой её задумали.</p>
        <p class="lcc-story-body">Наверное, именно поэтому наши проекты редко требуют переделок. Мы не ищем компромиссы там, где их не должно быть.</p>
      </div>
    </div>
  </section>

  <!-- ── О СТАНИСЛАВЕ ── -->
  <section class="l-about">
    <div class="l-about-inner">
      <div class="l-about-video-wrap lcc-about-photo">
        <img src="images/stas01.png" alt="Станислав — основатель Стив Интерьеры">
      </div>
      <div class="l-about-text">
        <p class="l-label">Кто за этим стоит</p>
        <h2 class="l-h2">Меня зовут<br><em>Станислав</em></h2>
        <p class="l-about-body">Я делаю мебель с 2012 года. Работаю с дизайнерами, архитекторами и напрямую с заказчиками. Берусь за проекты, от которых другие отказываются.</p>
        <p class="l-about-body">За каждым проектом стою лично — и как менеджер, и как мастер. Отвечаю за результат, а не за процесс.</p>
        <button class="l-about-cta" onclick="openContactPopup()">Обсудить проект</button>
      </div>
    </div>
  </section>

  <!-- ── УТП ── -->
  <section class="l-utp">
    <div class="l-utp-inner">
      <p class="l-label">Как мы работаем</p>
      <div class="l-utp-grid">
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Работаем по вашему расписанию</div>
            <div class="l-utp-text">Приезжаем тогда, когда удобно вам. Замер, доставка, монтаж — всё под ваш график.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Берём организацию на себя</div>
            <div class="l-utp-text">Чем лучше проект продуман в начале, тем меньше вопросов возникает потом. Один разговор — и дальше вы просто ждёте результат.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Возможно почти всё</div>
            <div class="l-utp-text">Если у вас есть идея, которую другие сочли сложной — расскажите нам. Не ограничиваем вас типовыми решениями.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Цена фиксируется в договоре</div>
            <div class="l-utp-text">Называем итоговую сумму до начала работ. Она не меняется — ни после замера, ни в процессе.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── ФИНАЛЬНЫЙ CTA ── -->
  <section class="l-cta">
    <div class="l-cta-bg">
      <img src="gallery/0044-wardrobe.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="l-cta-overlay"></div>
    </div>
    <div class="l-cta-content">
      <h2 class="l-cta-title">Обсудим ваш проект</h2>
      <p class="l-cta-sub">Привезём образцы, сделаем замер, предложим решение. Бесплатно и без обязательств.</p>
      <button class="l-cta-btn" onclick="openContactPopup()">Обсудить проект</button>
      <a href="<?php echo SITE_PHONE_HREF; ?>" class="l-cta-phone" onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    </div>
  </section>

  <script>
  function openVideoModal() {
    var modal = document.getElementById('videoModal');
    var video = document.getElementById('modalVideo');
    modal.classList.add('lcc-video-modal--open');
    document.body.style.overflow = 'hidden';
    video.currentTime = 0;
    video.muted = false;
    video.play();
    if (typeof ymGoal === 'function') ymGoal('hero_video_play');
  }
  function closeVideoModal() {
    var modal = document.getElementById('videoModal');
    var video = document.getElementById('modalVideo');
    modal.classList.remove('lcc-video-modal--open');
    document.body.style.overflow = '';
    video.pause();
  }
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeVideoModal();
  });
  </script>

</main>

<?php include 'footer.php'; ?>
