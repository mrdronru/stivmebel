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
      <h1 class="l-h1">Мебель, которая точно<br>подходит <em>вашей квартире.</em></h1>
      <p class="l-lead">Изготавливаем кухни, шкафы и гардеробные по индивидуальным размерам. Перед началом производства показываем проект, фиксируем стоимость в договоре и ведём проект от замера до монтажа.</p>
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
      <p class="l-district-text">Мы не стараемся сделать мебель максимально дешёвой. Вместо этого выбираем материалы и фурнитуру, которые сохраняют внешний вид и работают без проблем долгие годы.</p>
      <p class="l-district-text" style="margin-top:1rem;">Используем плиты Egger, фасады Alvic и Cleaf, а также фурнитуру Blum и Hettich с плавным закрыванием и большим ресурсом работы.</p>
      <p class="l-district-text" style="margin-top:1rem;">Перед запуском производства согласовываем проект до мелочей, чтобы после установки всё оказалось именно таким, как вы ожидали.</p>

      <p class="l-district-text" style="margin-top:1.75rem;">
        <strong>Стоимость кухни обычно начинается от 300 000 ₽.</strong><br>
        Шкафы — <?php echo price_from('wardrobes'); ?> за погонный метр, гардеробные — <?php echo price_from('closets'); ?> за погонный метр.
      </p>
      <p class="l-district-text" style="margin-top:0.75rem;">Итоговая цена зависит от размеров, выбранных материалов, наполнения и сложности проекта. После согласования всех деталей стоимость фиксируется в договоре и больше не меняется.</p>

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
      <div style="text-align:center; margin-top:3rem;">
        <button class="btn-primary" onclick="openQuiz()">Получить проект и расчёт</button>
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
        <button class="btn-primary" onclick="openQuiz()">Рассчитать мой проект</button>
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
  <section class="l-portfolio" style="padding-top:0;">
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
      <div style="margin-top:1rem;">
        <button class="l-cta-phone" style="background:none;border:none;cursor:pointer;font:inherit;" onclick="openContactPopup()">Написать нам</button>
        <span style="margin:0 0.75rem; opacity:0.4;">·</span>
        <a href="<?php echo SITE_PHONE_HREF; ?>"
           class="l-cta-phone"
           onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
      </div>
    </div>
  </section>

  <!-- ── КВИЗ (7 шагов + экран входа) ── -->
  <div id="quizOverlay" class="lq-overlay" onclick="if(event.target===this)closeQuiz()">
    <div class="lq-modal" role="dialog" aria-modal="true" aria-label="Рассчитать стоимость мебели">
      <button class="lq-close" onclick="closeQuiz()" aria-label="Закрыть">&times;</button>

      <!-- Прогресс-бар -->
      <div class="lq-progress"><div class="lq-progress-bar" id="quizProgress"></div></div>

      <!-- Шаг 0: Экран входа -->
      <div class="lq-step" data-step="0">
        <p class="lq-question">Рассчитаем стоимость мебели для вашей квартиры</p>
        <p class="lq-contact-hint">Ответьте на несколько вопросов. Это займёт около минуты. После этого мы подготовим предварительную оценку проекта.</p>
        <button class="lq-submit" onclick="startQuiz()" style="margin-top:1.5rem;">Начать</button>
      </div>

      <!-- Шаг 1: Что нужно -->
      <div class="lq-step" data-step="1" style="display:none">
        <p class="lq-step-label">Шаг 1 из 7</p>
        <p class="lq-question">Что хотите сделать?</p>
        <div class="lq-options">
          <button class="lq-option" data-key="type" data-val="Кухню">Кухню</button>
          <button class="lq-option" data-key="type" data-val="Шкаф">Шкаф</button>
          <button class="lq-option" data-key="type" data-val="Гардеробную">Гардеробную</button>
          <button class="lq-option" data-key="type" data-val="Несколько предметов мебели">Несколько предметов мебели</button>
        </div>
      </div>

      <!-- Шаг 2: Помещение (пропускается, если выбрана Кухня) -->
      <div class="lq-step" data-step="2" style="display:none">
        <p class="lq-step-label">Шаг 2 из 7</p>
        <p class="lq-question">Для какого помещения нужна мебель?</p>
        <div class="lq-options">
          <button class="lq-option" data-key="room" data-val="Кухня">Кухня</button>
          <button class="lq-option" data-key="room" data-val="Прихожая">Прихожая</button>
          <button class="lq-option" data-key="room" data-val="Спальня">Спальня</button>
          <button class="lq-option" data-key="room" data-val="Гостиная">Гостиная</button>
          <button class="lq-option" data-key="room" data-val="Несколько помещений">Несколько помещений</button>
        </div>
      </div>

      <!-- Шаг 3: Размер помещения -->
      <div class="lq-step" data-step="3" style="display:none">
        <p class="lq-step-label">Шаг 3 из 7</p>
        <p class="lq-question">Какой примерно размер помещения?</p>
        <div class="lq-options">
          <button class="lq-option" data-key="area" data-val="До 8 м²">До 8 м²</button>
          <button class="lq-option" data-key="area" data-val="8–15 м²">8–15 м²</button>
          <button class="lq-option" data-key="area" data-val="Более 15 м²">Более 15 м²</button>
          <button class="lq-option" data-key="area" data-val="Несколько помещений">Несколько помещений</button>
        </div>
      </div>

      <!-- Шаг 4: Задача -->
      <div class="lq-step" data-step="4" style="display:none">
        <p class="lq-step-label">Шаг 4 из 7</p>
        <p class="lq-question">Какая задача сейчас самая важная?</p>
        <div class="lq-options">
          <button class="lq-option" data-key="task" data-val="Максимально использовать пространство">Максимально использовать пространство</button>
          <button class="lq-option" data-key="task" data-val="Сделать красивый интерьер">Сделать красивый интерьер</button>
          <button class="lq-option" data-key="task" data-val="Добавить больше хранения">Добавить больше хранения</button>
          <button class="lq-option" data-key="task" data-val="Заменить старую мебель">Заменить старую мебель</button>
        </div>
      </div>

      <!-- Шаг 5: Бюджет -->
      <div class="lq-step" data-step="5" style="display:none">
        <p class="lq-step-label">Шаг 5 из 7</p>
        <p class="lq-question">На какой ориентир по стоимости рассчитываете?</p>
        <div class="lq-options">
          <button class="lq-option" data-key="budget" data-val="До 300 000 ₽">До 300 000 ₽</button>
          <button class="lq-option" data-key="budget" data-val="300 000–500 000 ₽">300 000–500 000 ₽</button>
          <button class="lq-option" data-key="budget" data-val="500 000–800 000 ₽">500 000–800 000 ₽</button>
          <button class="lq-option" data-key="budget" data-val="Более 800 000 ₽">Более 800 000 ₽</button>
          <button class="lq-option" data-key="budget" data-val="Пока сложно оценить">Пока сложно оценить</button>
        </div>
      </div>

      <!-- Шаг 6: Срок -->
      <div class="lq-step" data-step="6" style="display:none">
        <p class="lq-step-label">Шаг 6 из 7</p>
        <p class="lq-question">Когда планируете заказать мебель?</p>
        <div class="lq-options">
          <button class="lq-option" data-key="timing" data-val="Уже сейчас">Уже сейчас</button>
          <button class="lq-option" data-key="timing" data-val="Через 1–2 месяца">Через 1–2 месяца</button>
          <button class="lq-option" data-key="timing" data-val="Пока присматриваюсь">Пока присматриваюсь</button>
        </div>
      </div>

      <!-- Шаг 7: Контакт -->
      <div class="lq-step" data-step="7" style="display:none">
        <p class="lq-step-label">Шаг 7 из 7</p>
        <p class="lq-question">Куда отправить предварительный расчёт?</p>
        <p class="lq-contact-hint">Выберите удобный способ связи. Мы ответим там, где вам комфортно.</p>
        <div class="lq-contact-form">
          <input type="text" class="hp-field" id="quizWebsite" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
          <input class="lq-input" type="text" id="quizName" placeholder="Введите имя" autocomplete="given-name">
          <span class="lq-err" id="quizNameErr" style="display:none">Введите имя</span>
          <div class="lq-contact-methods">
            <button class="lq-method" data-method="phone" onclick="selectMethod('phone')"><span class="lq-method-icon">📞</span> Телефон</button>
            <button class="lq-method" data-method="whatsapp" onclick="selectMethod('whatsapp')"><span class="lq-method-icon">💬</span> WhatsApp</button>
            <button class="lq-method" data-method="telegram" onclick="selectMethod('telegram')"><span class="lq-method-icon">✈️</span> Telegram</button>
            <button class="lq-method" data-method="max" onclick="selectMethod('max')"><span class="lq-method-icon">📱</span> Макс</button>
            <button class="lq-method" data-method="email" onclick="selectMethod('email')"><span class="lq-method-icon">📧</span> Email</button>
          </div>
          <div id="quizContactFields" style="display:none">
            <input class="lq-input" type="tel"   id="quizPhone"    placeholder="+7 (___) ___-__-__" style="display:none" autocomplete="tel">
            <input class="lq-input" type="tel"   id="quizWhatsapp" placeholder="+7 (___) ___-__-__" style="display:none" autocomplete="tel">
            <input class="lq-input" type="text"  id="quizTelegram" placeholder="@username"          style="display:none" autocomplete="off">
            <input class="lq-input" type="tel"   id="quizMax"      placeholder="+7 (___) ___-__-__" style="display:none" autocomplete="tel">
            <input class="lq-input" type="email" id="quizEmail"    placeholder="email@example.com"  style="display:none" autocomplete="email">
          </div>
          <span class="lq-err" id="quizContactErr" style="display:none">Выберите способ связи</span>
          <button class="lq-submit" id="quizSubmitBtn" onclick="submitQuiz()">Получить расчёт</button>
        </div>
      </div>

      <!-- Шаг 8: Спасибо -->
      <div class="lq-step lq-success" data-step="8" style="display:none">
        <div class="lq-success-icon">✓</div>
        <p class="lq-success-title">Спасибо! Заявка отправлена</p>
        <p class="lq-success-text">Мы получили информацию по вашему проекту. Свяжемся с вами в ближайшее рабочее время, чтобы уточнить детали и подготовить расчёт. Пока ждёте — можете посмотреть наши реализованные проекты.</p>
        <a href="catalog" class="lq-success-link">Смотреть проекты →</a>
      </div>

      <button class="lq-back" id="quizBack" onclick="quizBack()" style="display:none">← Назад</button>
    </div>
  </div>

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

  (function() {
    var answers = {};
    var current = 0;
    var TOTAL = 7; // содержательных шагов, без экрана входа и без «спасибо»
    var LAST_CONTENT_STEP = 7;
    var THANKS_STEP = 8;
    var selectedMethod = null;
    var roomSkipped = false; // true, если шаг 2 был пропущен из-за выбора «Кухню» на шаге 1
    var methodFields = {
      phone:    { id: 'quizPhone',    label: 'Телефон' },
      whatsapp: { id: 'quizWhatsapp', label: 'WhatsApp' },
      telegram: { id: 'quizTelegram', label: 'Telegram' },
      max:      { id: 'quizMax',      label: 'Макс' },
      email:    { id: 'quizEmail',    label: 'Email' }
    };

    function step(n) { return document.querySelector('.lq-step[data-step="' + n + '"]'); }

    window.openQuiz = function() {
      answers = {}; current = 0; selectedMethod = null; roomSkipped = false;
      document.querySelectorAll('.lq-option').forEach(function(b){ b.classList.remove('lq-option--selected'); });
      document.querySelectorAll('.lq-method').forEach(function(b){ b.classList.remove('lq-method--active'); });
      document.getElementById('quizName').value = '';
      Object.values(methodFields).forEach(function(f){
        var el = document.getElementById(f.id);
        if (el) { el.value = ''; el.style.display = 'none'; }
      });
      document.getElementById('quizContactFields').style.display = 'none';
      showStep(0);
      document.getElementById('quizOverlay').classList.add('lq-overlay--open');
      document.body.style.overflow = 'hidden';
      if (typeof ymGoal === 'function') ymGoal('quiz_open');
    };

    window.startQuiz = function() { showStep(1); };

    window.closeQuiz = function() {
      document.getElementById('quizOverlay').classList.remove('lq-overlay--open');
      document.body.style.overflow = '';
    };

    function showStep(n) {
      document.querySelectorAll('.lq-step').forEach(function(s){ s.style.display = 'none'; });
      var s = step(n);
      if (s) s.style.display = '';
      var pct = (n <= 0) ? 0 : Math.round(((n - 1) / TOTAL) * 100);
      document.getElementById('quizProgress').style.width = pct + '%';
      document.getElementById('quizBack').style.display = (n > 1 && n <= LAST_CONTENT_STEP) ? '' : 'none';
      current = n;
    }

    window.quizBack = function() {
      if (current <= 1) return;
      // Если шаг 2 был пропущен (выбрали «Кухню»), с шага 3 назад идём сразу на шаг 1
      if (current === 3 && roomSkipped) { showStep(1); return; }
      showStep(current - 1);
    };

    document.querySelectorAll('.lq-option').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var key = this.dataset.key;
        var val = this.dataset.val;
        answers[key] = val;
        var siblings = this.closest('.lq-options').querySelectorAll('.lq-option');
        siblings.forEach(function(b){ b.classList.remove('lq-option--selected'); });
        this.classList.add('lq-option--selected');
        if (current >= 4 && typeof ymGoal === 'function') ymGoal('quiz_step_' + current);

        // Шаг 1 → «Кухню»: помещение и так очевидно, пропускаем шаг 2
        if (current === 1 && key === 'type' && val === 'Кухню') {
          answers.room = 'Кухня';
          roomSkipped = true;
          setTimeout(function() { showStep(3); }, 220);
          return;
        }
        if (current === 1) { roomSkipped = false; }

        setTimeout(function() { showStep(current + 1); }, 220);
      });
    });

    window.selectMethod = function(method) {
      selectedMethod = method;
      document.querySelectorAll('.lq-method').forEach(function(b){
        b.classList.toggle('lq-method--active', b.dataset.method === method);
      });
      Object.keys(methodFields).forEach(function(m){
        var el = document.getElementById(methodFields[m].id);
        el.style.display = m === method ? '' : 'none';
      });
      document.getElementById('quizContactFields').style.display = '';
      document.getElementById('quizContactErr').style.display = 'none';
      document.getElementById(methodFields[method].id).focus();
    };

    ['quizPhone', 'quizWhatsapp', 'quizMax'].forEach(function(id) {
      document.getElementById(id).addEventListener('input', function() {
        if (typeof window.formatPhone === 'function') window.formatPhone(this);
      });
    });

    window.submitQuiz = function() {
      var name       = document.getElementById('quizName').value.trim();
      var nameErr    = document.getElementById('quizNameErr');
      var contactErr = document.getElementById('quizContactErr');
      var ok = true;

      nameErr.style.display    = 'none';
      if (contactErr) contactErr.style.display = 'none';

      if (!name) { nameErr.style.display = ''; ok = false; }

      var contactValue = '';
      if (!selectedMethod) {
        if (contactErr) contactErr.style.display = '';
        ok = false;
      } else {
        var fieldEl = document.getElementById(methodFields[selectedMethod].id);
        contactValue = fieldEl ? fieldEl.value.trim() : '';
        if (!contactValue) {
          if (contactErr) { contactErr.textContent = 'Заполните поле'; contactErr.style.display = ''; }
          ok = false;
        } else if ((selectedMethod === 'phone' || selectedMethod === 'whatsapp' || selectedMethod === 'max') &&
                   contactValue.replace(/\D/g, '').length < 10) {
          if (contactErr) { contactErr.textContent = 'Введите корректный номер'; contactErr.style.display = ''; }
          ok = false;
        } else if (selectedMethod === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(contactValue)) {
          if (contactErr) { contactErr.textContent = 'Введите корректный email'; contactErr.style.display = ''; }
          ok = false;
        }
      }
      if (!ok) return;

      var btn = document.getElementById('quizSubmitBtn');
      btn.disabled = true;
      btn.textContent = 'Отправляем…';

      var comment = [];
      if (answers.type)   comment.push('Тип: ' + answers.type);
      if (answers.room)   comment.push('Помещение: ' + answers.room);
      if (answers.area)   comment.push('Площадь: ' + answers.area);
      if (answers.task)   comment.push('Задача: ' + answers.task);
      if (answers.budget) comment.push('Бюджет: ' + answers.budget);
      if (answers.timing) comment.push('Срок: ' + answers.timing);
      comment.push('Способ связи: ' + methodFields[selectedMethod].label + ' — ' + contactValue);

      var phoneVal = (selectedMethod === 'phone' || selectedMethod === 'whatsapp' || selectedMethod === 'max') ? contactValue : '';

      fetch('send.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
          name: name,
          phone: phoneVal || contactValue,
          type: answers.type || '',
          comment: comment.join(' / '),
          source: 'quiz-mos',
          website: (document.getElementById('quizWebsite') || {}).value || ''
        })
      })
      .then(function(r){ return r.json(); })
      .then(function(data) {
        if (data.ok) {
          if (typeof ymGoal === 'function') ymGoal('quiz_complete');
          showStep(THANKS_STEP);
          document.getElementById('quizBack').style.display = 'none';
          document.getElementById('quizProgress').style.width = '100%';
        } else {
          btn.disabled = false;
          btn.textContent = 'Попробовать ещё раз';
        }
      })
      .catch(function() {
        btn.disabled = false;
        btn.textContent = 'Попробовать ещё раз';
      });
    };

  })();
  </script>

</main>

<?php include 'footer.php'; ?>
