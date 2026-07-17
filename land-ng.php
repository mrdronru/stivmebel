<?php
require_once __DIR__ . '/config.php';
$page           = '';
$title          = 'Мебель для новостройки в Нижегородском районе';
$description    = 'Делаем кухни и шкафы на заказ для жителей ЖК Среда, Аквилон Бисайд, Профит и др. Знаем планировки этих домов. Замер бесплатно.';
$robots         = 'noindex, follow';
$extra_css      = ['landing.css'];
$canonical_path = 'land-ng';

include 'header.php';
?>

<!-- ── ШАПКА ЛЕНДИНГА (упрощённая) ── -->
<header class="ln-nav" id="lnNav">
  <a href="/" class="ln-nav-logo">Стив <span>Интерьеры</span></a>
  <div class="ln-nav-right">
    <a href="<?php echo SITE_PHONE_HREF; ?>" class="ln-nav-phone" onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    <button class="ln-nav-btn" onclick="openContactPopup()">Бесплатный замер</button>
  </div>
</header>

<main class="l-wrap">

  <!-- ── HERO ── -->
  <section class="l-hero">
    <img class="l-hero-bg" src="images/k03.jpg" width="1200" height="1600" alt="Кухня на заказ в новостройке" loading="eager">
    <div class="l-hero-overlay"></div>
    <div class="l-hero-content">
      <p class="l-eyebrow">ЖК Среда · ЖК Аквилон Бисайд · ЖК Профит</p>
      <h1 class="l-h1">Ключи получены.<br>Пора заказывать <em>мебель.</em></h1>
      <p class="l-lead">Кухни, шкафы и гардеробные на заказ — для квартир в Нижегородском районе. Цена фиксируется в договоре и не меняется.</p>
      <div class="l-hero-btns">
        <button class="l-hero-btn" onclick="openContactPopup()">Бесплатный замер</button>
        <button class="l-hero-btn l-hero-btn--outline" onclick="openQuiz()">Рассчитать стоимость</button>
      </div>
    </div>

  </section>

  <!-- ── ЗНАЕМ РАЙОН ── -->
  <section class="l-district">
    <div class="l-district-inner">
      <p class="l-label">Нижегородский район, ЮВАО</p>
      <h2 class="l-h2">Делали мебель<br>в <em>ваших домах</em></h2>
      <p class="l-district-text">Все три комплекса — монолит, предчистовая отделка, открытые планировки. Квартиры сдаются без мебели — и именно здесь начинается наша работа. Мы уже делали кухни и шкафы в этих домах, знаем их метраж и пропорции, и сразу считаем точно — без поправок после замера.</p>
      <div class="l-jk-list">
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>ЖК Среда</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>ЖК Аквилон Бисайд</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>ЖК Профит</span></div>
      </div>
    </div>
  </section>

  <!-- ── СТАНИСЛАВ ── -->
  <section class="l-about">
    <div class="l-about-inner">
      <div class="l-about-video-wrap">
        <video
          class="l-about-video"
          src="hello.mp4"
          poster="images/hello-poster.jpg"
          playsinline
          preload="none"
          id="aboutVideo"
        ></video>
        <button class="l-about-play" id="aboutPlayBtn" onclick="playAboutVideo()" aria-label="Воспроизвести видео">
          <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><circle cx="14" cy="14" r="13" stroke="currentColor" stroke-width="1.2"/><path d="M11 9.5l9 4.5-9 4.5V9.5z" fill="currentColor"/></svg>
        </button>
      </div>
      <div class="l-about-text">
        <p class="l-label">Кто делает вашу мебель</p>
        <h2 class="l-h2">Меня зовут<br><em>Станислав</em></h2>
        <p class="l-about-body">Я делаю мебель с 2012 года. Кухни, шкафы, гардеробные и корпусная мебель на заказ — с замером, проектом и монтажом под ключ.</p>
        <p class="l-about-body">Живу здесь, в Нижегородском районе. Приеду быстро, знаю планировки ваших домов, и отвечаю за результат лично — и как менеджер, и как мастер.</p>
        <button class="l-about-cta" onclick="openContactPopup()">Бесплатный замер</button>
      </div>
    </div>
  </section>

  <!-- ── УТП ── -->
  <section class="l-utp">
    <div class="l-utp-inner">
      <p class="l-label">Почему выбирают нас</p>
      <div class="l-utp-grid">
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Цена фиксируется в договоре</div>
            <div class="l-utp-text">Называем итоговую сумму до начала работ — и она не меняется. Никаких доплат после замера или в процессе.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM12 12v.01M8 12v.01M16 12v.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M9 3h6M10 3v4M14 3v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Никакого испорченного телефона</div>
            <div class="l-utp-text">Вы общаетесь напрямую с нашей командой. Станислав лично контролирует каждый этап и за всё отвечает лично.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Привозим образцы на дом</div>
            <div class="l-utp-text">Нет шоурума — есть выезд. Привозим фасады, фурнитуру и образцы материалов прямо к вам.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Замер бесплатно — в удобное время</div>
            <div class="l-utp-text">Приедем в удобное время, снимем точные размеры. Без предоплаты и без обязательств с вашей стороны.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Выезжаем по всей Москве и МО</div>
            <div class="l-utp-text">Работаем в любом районе — не только рядом. Нижегородский, Рязанский, Текстильщики, Выхино, другие — всё доступно.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ── ПОРТФОЛИО ── -->
  <section class="l-portfolio">
    <div class="l-portfolio-inner">
      <p class="l-label" style="text-align:center; margin-bottom:3rem;">Наши работы</p>
      <div class="l-portfolio-grid">
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0002-kitchen.jpg" width="1600" height="1067" alt="Кухня в неудобной планировке" loading="lazy">
          </div>
          <p class="l-pf-cap">Кухня в неудобной планировке: вписали так, что не осталось ни сантиметра впустую</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0073-hallway.jpg" width="1600" height="1280" alt="Шкаф в прихожую" loading="lazy">
          </div>
          <p class="l-pf-cap">Шкаф в прихожую: максимум вместимости при минимуме площади</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0091-kitchen.jpg" width="1280" height="1600" alt="Угловая кухня с витринным шкафом" loading="lazy">
          </div>
          <p class="l-pf-cap">Угловая кухня с витринным шкафом: классика, которая не надоедает</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0109-kitchen.jpg" width="1600" height="1067" alt="Кухня по дизайн-проекту" loading="lazy">
          </div>
          <p class="l-pf-cap">Кухня по дизайн-проекту: воплотили точно по чертежам дизайнера</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0147-other.jpg" width="1600" height="1067" alt="ТВ-тумба со скрытой проводкой" loading="lazy">
          </div>
          <p class="l-pf-cap">ТВ-тумба со скрытой проводкой: никаких проводов, всё внутри</p>
        </div>
      </div>
      <div class="l-works-cta">
        <a href="catalog" class="btn-secondary" target="_blank" rel="noopener">Все работы в галерее</a>
      </div>
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
            <div class="l-step-text">Приедем в удобное время, снимем точные размеры. Привезём образцы фасадов и фурнитуры — прямо к вам.</div>
          </div>
        </div>
        <div class="l-step">
          <div class="l-step-num">02</div>
          <div class="l-step-body">
            <div class="l-step-title">3D-проект и фиксация цены</div>
            <div class="l-step-text">Покажем как будет выглядеть, согласуем детали. Итоговая сумма фиксируется в договоре — и больше не меняется.</div>
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
      <img src="images/m01.jpg" width="800" height="1067" alt="" loading="lazy" aria-hidden="true">
      <div class="l-cta-overlay"></div>
    </div>
    <div class="l-cta-content">
      <h2 class="l-cta-title">Запишитесь на<br>бесплатный замер</h2>
      <p class="l-cta-sub">Приедем, посмотрим пространство, привезём образцы. Цена — до начала работ, в договоре.</p>
      <button class="l-cta-btn" onclick="openContactPopup()">Бесплатный замер</button>
      <a href="<?php echo SITE_PHONE_HREF; ?>"
         class="l-cta-phone"
         onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    </div>
  </section>

  <script>
  // ── Видео Станислава ──
  function playAboutVideo() {
    var v = document.getElementById('aboutVideo');
    var btn = document.getElementById('aboutPlayBtn');
    btn.style.display = 'none';
    v.controls = true;
    v.play();
  }
  </script>

  <?php $quiz_source = 'quiz-ng'; include 'quiz.php'; ?>

</main>

<?php include 'footer.php'; ?>
