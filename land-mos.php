<?php
require_once __DIR__ . '/config.php';
$page           = '';
$title          = 'Мебель на заказ в Москве — кухни, шкафы, гардеробные';
$description    = 'Корпусная мебель на заказ в Москве и МО с 2012 года. Собственное производство, материалы Egger, фурнитура Blum и Hettich. Точный расчёт по вашим размерам за 24 часа.';
$robots         = 'noindex, follow';
$extra_css      = ['landing.css'];
$canonical_path = 'land-mos';

// Источник заявок с обычной попап-формы на этой странице — для отчётов вне UTM
$popup_source_js = "window.popupSource = 'land-mos';";

include 'header.php';
?>

<!-- ── ШАПКА ЛЕНДИНГА (упрощённая) ── -->
<header class="ln-nav" id="lnNav">
  <a href="/" class="ln-nav-logo">Стив <span>Интерьеры</span></a>
  <div class="ln-nav-right">
    <a href="<?php echo SITE_PHONE_HREF; ?>" class="ln-nav-phone" onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    <button class="ln-nav-btn" onclick="openQuiz()">Рассчитать стоимость</button>
  </div>
</header>

<main class="l-wrap">

  <!-- ── HERO ── -->
  <section class="l-hero">
    <img class="l-hero-bg" src="gallery/0091-kitchen.jpg" width="1280" height="1600" alt="Кухня на заказ — собственное производство" loading="eager">
    <div class="l-hero-overlay"></div>
    <div class="l-hero-content">
      <p class="l-eyebrow">Москва и Московская область · Собственное производство с 2012 года</p>
      <h1 class="l-h1">Мебель, которая точно<br>вам <em>подходит.</em></h1>
      <p class="l-lead">Кухни, шкафы и гардеробные по вашим размерам. Фиксируем цену в договоре и ведём проект до монтажа.</p>
      <div class="l-hero-btns">
        <button class="l-hero-btn" onclick="openQuiz()">Рассчитать стоимость</button>
        <button class="l-hero-btn l-hero-btn--outline" onclick="openContactPopup()">Написать нам</button>
      </div>
      <p class="l-hero-hint">Достаточно отправить размеры, план квартиры или фотографию помещения. Подскажем возможные решения и подготовим предварительный расчёт в течение суток. Если удобнее — ответим без телефонных звонков.</p>
    </div>
  </section>

  <!-- ── МАТЕРИАЛЫ И СТОИМОСТЬ ── -->
  <section class="l-district">
    <div class="l-district-inner">
      <p class="l-label">Из чего складывается хороший результат</p>
      <h2 class="l-h2">Хорошая мебель начинается не с красивого фасада,<br><em>а с правильной конструкции.</em></h2>
      <p class="l-district-text">Не стремимся сделать мебель максимально дешёвой — выбираем материалы и фурнитуру, которые служат долго: плиты Egger, фасады Alvic и Cleaf, фурнитура Blum и Hettich с плавным закрыванием. Перед производством согласовываем проект до мелочей.</p>

      <p class="l-district-text" style="margin-top:0.5rem;">
        <strong>Кухня — от 300 000 ₽.</strong>
        Шкафы — <?php echo price_from('wardrobes'); ?> за п.м., гардеробные — <?php echo price_from('closets'); ?> за п.м. Точная цена — после согласования размеров и материалов; фиксируется в договоре и не меняется.
      </p>

      <div class="l-jk-list">
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Бесплатный замер</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Бесплатный 3D-проект</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Цена фиксируется в договоре</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Гарантия 2 года</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>300+ реализованных проектов</span></div>
      </div>

      <div style="margin-top:2rem;">
        <button class="btn-primary" onclick="openQuiz()">Узнать стоимость проекта</button>
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
        <p class="l-label">Кто будет заниматься вашим проектом</p>
        <h2 class="l-h2">Здравствуйте!<br>Меня зовут <em>Станислав</em></h2>
        <p class="l-about-body">С 2012 года мы изготавливаем кухни, шкафы, гардеробные и другую корпусную мебель на заказ. Каждый проект начинается с разговора о том, как мебель должна работать именно в вашей квартире.</p>
        <p class="l-about-body">Я лично участвую в каждом проекте — от первых замеров до финальной установки. После заключения договора вы также общаетесь с нами напрямую — без передачи проекта между разными отделами и подрядчиками.</p>
        <p class="l-about-body">Вы всегда знаете, к кому обратиться и кто отвечает за результат.</p>
        <button class="l-about-cta" onclick="openQuiz()">Обсудить мой проект</button>
      </div>
    </div>
  </section>

  <!-- ── ПОЧЕМУ ВЫБИРАЮТ НАС ── -->
  <section class="l-utp">
    <div class="l-utp-inner">
      <p class="l-label">Почему с нами спокойно заказывать мебель</p>
      <div class="l-utp-grid">
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Цена известна заранее</div>
            <div class="l-utp-text">После согласования проекта фиксируем стоимость в договоре. Вам не придётся узнавать о дополнительных расходах уже после начала работы.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM12 12v.01M8 12v.01M16 12v.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M9 3h6M10 3v4M14 3v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Один ответственный человек</div>
            <div class="l-utp-text">Вы общаетесь напрямую с нашей командой. Станислав контролирует проект и отвечает за результат на всех этапах.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Образцы материалов у вас дома</div>
            <div class="l-utp-text">Привозим фасады, образцы плит и варианты фурнитуры, чтобы вы могли выбрать материалы в своём интерьере.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Точный замер перед производством</div>
            <div class="l-utp-text">Проверяем размеры помещения, особенности стен, ниш и коммуникаций перед созданием мебели.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Вы видите результат заранее</div>
            <div class="l-utp-text">Создаём 3D-проект до начала производства. Вы понимаете, как будет выглядеть мебель, и можете внести изменения заранее.</div>
          </div>
        </div>
      </div>
      <div style="text-align:center; margin-top:2.5rem;">
        <button class="l-hero-btn" onclick="openQuiz()">Получить проект и расчёт</button>
      </div>
    </div>
  </section>

  <!-- ── ПОРТФОЛИО (те же 5 работ, что на land-msk) ── -->
  <section class="l-portfolio">
    <div class="l-portfolio-inner">
      <p class="l-label" style="text-align:center; margin-bottom:1rem;">Наши работы</p>
      <h2 class="l-h2" style="text-align:center; margin-bottom:1rem;">Реальные проекты<br><em>для реальных квартир</em></h2>
      <p class="l-district-text" style="text-align:center; max-width:640px; margin:0 auto 3rem;">Каждая мебель начинается с особенностей конкретного помещения: нестандартной планировки, ограниченного пространства или желания сделать хранение удобнее. Показываем реальные проекты и решения, реализованные для наших клиентов.</p>
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
            <img src="gallery/0056-wardrobe.jpg" width="1600" height="1067" alt="Встроенный шкаф-купе" loading="lazy">
          </div>
          <p class="l-pf-cap">Встроенный шкаф-купе: под нестандартную нишу, без зазоров</p>
        </div>
      </div>
      <div class="l-works-cta">
        <a href="catalog" class="btn-secondary" target="_blank" rel="noopener">Посмотреть все проекты</a>
      </div>
    </div>
  </section>

  <!-- ── КАК ВСЁ ПРОИСХОДИТ ── -->
  <section class="l-process">
    <div class="l-process-inner">
      <p class="l-label">Как всё происходит</p>
      <div class="l-steps">
        <div class="l-step">
          <div class="l-step-num">01</div>
          <div class="l-step-body">
            <div class="l-step-title">Знакомимся и делаем замер</div>
            <div class="l-step-text">Вы рассказываете, что хотите получить. Мы приезжаем в удобное время, делаем точный замер помещения и смотрим особенности квартиры.</div>
          </div>
        </div>
        <div class="l-step">
          <div class="l-step-num">02</div>
          <div class="l-step-body">
            <div class="l-step-title">Разрабатываем проект</div>
            <div class="l-step-text"><strong>Вместе с вами</strong> продумываем конструкцию, наполнение и внешний вид мебели. Создаём 3D-визуализацию до начала производства.</div>
          </div>
        </div>
        <div class="l-step">
          <div class="l-step-num">03</div>
          <div class="l-step-body">
            <div class="l-step-title">Согласовываем стоимость</div>
            <div class="l-step-text">После утверждения проекта рассчитываем итоговую стоимость и фиксируем её в договоре.</div>
          </div>
        </div>
        <div class="l-step">
          <div class="l-step-num">04</div>
          <div class="l-step-body">
            <div class="l-step-title">Производим и устанавливаем</div>
            <div class="l-step-text">Изготавливаем мебель на собственном производстве, устанавливаем и регулируем всё до готового результата.</div>
          </div>
        </div>
      </div>
      <p class="l-district-text" style="color:rgba(250,249,246,0.6); margin-top:2.5rem;">Вам не нужно искать разных специалистов и контролировать каждый этап самостоятельно. Мы берём процесс полностью на себя.</p>
      <div style="margin-top:2rem;">
        <button class="l-hero-btn" onclick="openQuiz()">Рассчитать мой проект</button>
      </div>
    </div>
  </section>

  <!-- ── ОТЗЫВЫ (с реальными цитатами) ── -->
  <?php
  $quote_testimonials = [
    ['file' => '002.png', 'type' => 'photo', 'quote' => '«Это идеальная кухня! Мы довольны на 1000 процентов! Огромное спасибо, Стас»', 'author' => 'Инна · ВКонтакте'],
    ['file' => '004.jpg', 'type' => 'photo', 'quote' => '«За Андрея огромное спасибо! Профессионал! Я в восторге от его скрупулёзности»', 'author' => 'Ксения · WhatsApp'],
    ['file' => '005.jpg', 'type' => 'photo', 'quote' => '«Как хозяйка представленной кухни подтверждаю, всё так и было! Результатом наслаждаемся уже третий год»', 'author' => 'Елена · Instagram'],
    ['file' => '006.jpg', 'type' => 'photo', 'quote' => '«Очень довольна своей кухней! Учли все пожелания и сделали ещё лучше, чем я ожидала»', 'author' => 'Клиентка · Instagram'],
    ['file' => '007.jpg', 'type' => 'photo', 'quote' => '«Кухня просто супер! Качество — высший пилотаж! Стас как всегда на высоте»', 'author' => 'Виктория · Telegram'],
    ['file' => '008.png', 'type' => 'photo', 'quote' => '«Вместить в 5 м² всё необходимое и оставить максимум свободного места — задумка была утопичная, но всё получилось»', 'author' => 'Анна · ВКонтакте'],
  ];
  ?>
  <section class="l-portfolio">
    <div class="l-portfolio-inner">
      <p class="l-label" style="text-align:center; margin-bottom:1rem;">Отзывы клиентов</p>
      <h2 class="l-h2" style="text-align:center; margin-bottom:1rem;">Что говорят люди<br><em>после установки мебели</em></h2>
      <p class="l-district-text" style="text-align:center; max-width:640px; margin:0 auto 3rem;">Для нас важно не только изготовить мебель, но и сделать так, чтобы весь процесс прошёл спокойно — от первой встречи до финальной установки.</p>
      <div class="testimonials-grid testimonials-grid--quotes" id="testimonialsStrip">
        <?php foreach ($quote_testimonials as $i => $t): ?>
        <div class="tq-card">
          <div class="testimonial-item" data-type="<?php echo $t['type']; ?>" data-src="testimonials/<?php echo htmlspecialchars($t['file']); ?>" data-index="<?php echo $i; ?>">
            <img class="testimonial-media" width="220" height="280" src="testimonials/<?php echo htmlspecialchars($t['file']); ?>" alt="Отзыв клиента" loading="lazy">
          </div>
          <p class="testimonial-quote"><?php echo htmlspecialchars($t['quote']); ?></p>
          <span class="testimonial-author"><?php echo htmlspecialchars($t['author']); ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="l-works-cta">
        <a href="catalog" class="btn-secondary" target="_blank" rel="noopener">Посмотреть наши проекты</a>
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
      <h2 class="l-cta-title">Расскажите, какую мебель<br>хотите получить</h2>
      <p class="l-cta-sub">Отправьте размеры, планировку или фотографию помещения. Мы посмотрим, что можно сделать, предложим варианты и рассчитаем стоимость проекта. Замер и 3D-проект — бесплатно. Стоимость фиксируется в договоре после согласования проекта.</p>
      <button class="l-cta-btn" onclick="openQuiz()">Получить расчёт проекта</button>
      <div class="l-hero-btns" style="margin-top:1.25rem;">
        <button class="l-hero-btn l-hero-btn--outline" onclick="openContactPopup()">Написать нам</button>
        <a href="<?php echo SITE_PHONE_HREF; ?>"
           class="l-hero-btn l-hero-btn--outline"
           onclick="ymGoal('click_phone')">Позвонить</a>
      </div>
    </div>
  </section>

  <script>
  <?php echo $popup_source_js; ?>

  // ── Видео Станислава ──
  function playAboutVideo() {
    var v = document.getElementById('aboutVideo');
    var btn = document.getElementById('aboutPlayBtn');
    btn.style.display = 'none';
    v.controls = true;
    v.play();
  }

  // ── Открыть отзыв в полном размере (упрощённо, как на land-msk) ──
  (function() {
    var items = Array.from(document.querySelectorAll('.testimonial-item'));
    items.forEach(function(item) {
      item.addEventListener('click', function() {
        window.open(item.dataset.src, '_blank');
      });
    });
  })();
  </script>

  <?php $quiz_source = 'quiz-mos'; include 'quiz.php'; ?>

</main>

<?php include 'footer.php'; ?>
