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
      <h1 class="l-h1">Мебель, которая точно вам <em>подходит.</em></h1>
      <p class="l-lead">Кухни, шкафы, гардеробные по вашим размерам. Фиксируем цену в договоре и ведём проект от замера до монтажа.</p>
      <div class="l-hero-btns">
        <button class="l-hero-btn" onclick="openQuiz()">Рассчитать стоимость</button>
        <button class="l-hero-btn l-hero-btn--outline" onclick="openContactPopup()">Написать нам</button>
      </div>
      <p class="l-hero-hint" style="color: var(--ww-60);">Достаточно отправить размеры, план квартиры или фотографию помещения. Подскажем возможные решения и подготовим предварительный расчёт в течение суток. Если удобнее — ответим без телефонных звонков.</p>
    </div>
  </section>

  <!-- ── ПОРТФОЛИО — истории проектов (карточки: фото + заголовок + история) ── -->
  <section class="l-portfolio l-portfolio--stories">
    <div class="l-portfolio-inner">
      <p class="l-label" style="text-align:center; margin-bottom:1rem;">Наши работы</p>
      <h2 class="l-h2" style="text-align:center; margin-bottom:1rem;">Реальные проекты<br><em>для реальных квартир</em></h2>
      <p class="l-district-text" style="text-align:center; max-width:640px; margin:0 auto 3rem;">Мы показываем не только готовую мебель. По каждому проекту рассказываем, какая задача стояла перед помещением, какое решение выбрали и почему именно такое. Каждая работа начинается с особенностей конкретной квартиры: нестандартной планировки, ограниченного пространства или желания сделать хранение удобнее.</p>
      <div class="l-portfolio-grid">
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0002-kitchen.jpg" width="1600" height="1067" alt="Кухня в неудобной планировке" loading="lazy">
          </div>
          <p class="l-pf-cap">Кухня в неудобной планировке</p>
          <p class="l-pf-story">Квартира в новостройке с сильно вытянутой планировкой — хотелось полноценную кухню, а стена под неё, по сути, одна. Кухню пустили вдоль стены, а холодильник вынесли за угол в прихожую и встроили за фасад: снаружи он выглядит обычным шкафом и не портит вид. Так поместилась вся техника и рабочие зоны, не съедая проход.</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0073-hallway.jpg" width="1600" height="1280" alt="Шкаф в прихожую" loading="lazy">
          </div>
          <p class="l-pf-cap">Шкаф в прихожую: максимум вместимости при минимуме площади</p>
          <p class="l-pf-story">Решали две типичные боли прихожих. Электрощитки убрали внутрь шкафа за фасад, а там, где глубина меньше стандартных 60 см, поставили перпендикулярные вешала — вешать одежду можно даже в узкой секции. Наполнение из ящиков и полок собрали под задачи хозяев, а не по типовой схеме.</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0091-kitchen.jpg" width="1280" height="1600" alt="Угловая кухня с витринным шкафом" loading="lazy">
          </div>
          <p class="l-pf-cap">Угловая кухня с витринным шкафом: классика, которая не надоедает</p>
          <p class="l-pf-story">Пожелание было простое — больше света и «эффекта», но без ухода от классики. Предложили стеклянную витрину с подсветкой: она добавляет глубины и вечером работает как мягкий акцент. Саму угловую кухню скомпоновали удобно и без лишнего.</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0109-kitchen.jpg" width="1600" height="1067" alt="Кухня по дизайн-проекту" loading="lazy">
          </div>
          <p class="l-pf-cap">Кухня по дизайн-проекту: воплотили точно по чертежам дизайнера</p>
          <p class="l-pf-story">Слабое место любой угловой секции — ей неудобно пользоваться, а здесь рядом ещё стоял пенал. Не меняя внешний вид из проекта дизайнера, переработали конструкцию углового шкафа и добавили складную дверь — получилось полноценное место хранения. Столешницу смонтировали без пристеночного бортика, как и было задумано.</p>
        </div>
        <div class="l-pf-item">
          <div class="l-pf-img">
            <img src="gallery/0056-wardrobe.jpg" width="1600" height="1067" alt="Комплект мебели для комнаты со скрытыми удобствами" loading="lazy">
          </div>
          <p class="l-pf-cap">Мебель для комнаты: удобства, которые замечаешь не сразу</p>
          <p class="l-pf-story">Спрятали несколько решений, которые не бросаются в глаза, но выручают каждый день. Подсветка зеркала стоит на внутренней стороне дверцы и включается сама, когда шкаф открывается. Под основным столом прячется выдвижной мини-стол — второе рабочее место появляется за секунду; для принтера сделали отдельный выдвижной ящик.</p>
        </div>
      </div>
      <div class="l-works-cta">
        <a href="catalog" class="btn-secondary" target="_blank" rel="noopener">Посмотреть каталог работ</a>
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
        <p class="l-about-body">Не обещаю «идеально» — рассказываю, как будет на самом деле. Если вижу, что какая-то идея будет неудобной или слишком дорогой, честно скажу об этом и предложу альтернативу, объясню, почему.</p>
        <p class="l-about-body">Вы всегда знаете, к кому обратиться и кто отвечает за результат.</p>
        <button class="l-about-cta" onclick="openQuiz()">Обсудить проект</button>
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
        <a href="catalog" class="btn-secondary" target="_blank" rel="noopener">Посмотреть каталог работ</a>
      </div>
    </div>
  </section>

  <!-- ── МАТЕРИАЛЫ И СТОИМОСТЬ ── -->
  <section class="l-district">
    <div class="l-district-inner">
      <p class="l-label">Из чего складывается хороший результат</p>
      <h2 class="l-h2">Хорошая мебель начинается не с красивого фасада,<br><em>а с правильной конструкции.</em></h2>
      <p class="l-district-text">Хорошая мебель должна не только красиво выглядеть, но и быть удобной каждый день. Поэтому мы начинаем не с выбора материалов, а с того, как мебель будет работать именно в вашем доме.</p>
      <p class="l-district-text">Продумываем расположение хранения, открывание дверей и ящиков, удобство использования, особенности помещения и коммуникаций. Именно такие решения редко заметны на фотографиях, но именно они определяют, насколько комфортно пользоваться мебелью спустя годы.</p>
      <p class="l-district-text">Для производства используем материалы и фурнитуру, которые хорошо зарекомендовали себя в ежедневной эксплуатации: плиты Egger, фасады Alvic и Cleaf, фурнитуру Blum и Hettich с плавным закрыванием. Перед запуском в производство согласовываем проект до мелочей, чтобы результат соответствовал ожиданиям.</p>
      <p class="l-district-text">Мы работаем для тех, кому важна не самая низкая цена, а мебель, которая будет радовать каждый день и прослужит долгие годы.</p>

      <p class="l-district-text" style="margin-bottom:0.6rem;"><strong>Ориентир по стоимости:</strong></p>
      <div class="l-jk-list">
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Кухни — <strong><?php echo price_from('kitchens'); ?></strong> за погонный метр</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Шкафы — <strong><?php echo price_from('wardrobes'); ?></strong> за погонный метр</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Гардеробные — <strong><?php echo price_from('closets'); ?></strong> за погонный метр</span></div>
      </div>
      <p class="l-district-text" style="margin-top:1rem;">Точная стоимость рассчитывается после согласования проекта, фиксируется в договоре и не меняется.</p>

      <div class="l-jk-list" style="margin-top:1.5rem;">
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Бесплатный замер</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Подробный 3D-проект</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Цена фиксируется в договоре</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Гарантия 2 года</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>Более 300 реализованных проектов</span></div>
      </div>

      <div style="margin-top:2rem;">
        <button class="btn-primary" onclick="openQuiz()">Узнать стоимость проекта</button>
      </div>
    </div>
  </section>

  <!-- ── ПОЧЕМУ С НАМИ СПОКОЙНО РАБОТАТЬ (выгоды, а не характеристики) ── -->
  <section class="l-utp">
    <div class="l-utp-inner">
      <p class="l-label">Почему с нами спокойно работать</p>
      <div class="l-utp-grid">
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4M12 3C7.03 3 3 7.03 3 12s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Цена фиксируется в договоре</div>
            <div class="l-utp-text">После согласования проекта стоимость фиксируется и не меняется. Если вы не вносите изменения в проект, цена остаётся прежней.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Вы увидите мебель до начала производства</div>
            <div class="l-utp-text">Создаём подробный 3D-проект, чтобы заранее проверить размеры, расположение, материалы и внешний вид. Это позволяет избежать неприятных сюрпризов после изготовления.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM12 12v.01M8 12v.01M16 12v.01" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M9 3h6M10 3v4M14 3v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Один подрядчик на всех этапах</div>
            <div class="l-utp-text">Замер, проектирование, производство и монтаж выполняет одна команда. Не нужно координировать нескольких исполнителей и разбираться, кто отвечает за результат.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Проектируем под вашу квартиру, а не под типовые размеры</div>
            <div class="l-utp-text">Учитываем планировку, ниши, коммуникации, особенности помещения и ваши привычки. Мебель создаётся под конкретное пространство, а не адаптируется из готовых решений.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Остаёмся на связи после установки</div>
            <div class="l-utp-text">Если потребуется регулировка или возникнут вопросы по эксплуатации, вы всегда можете обратиться к нам. Мы не исчезаем после завершения монтажа.</div>
          </div>
        </div>
      </div>
      <div style="text-align:center; margin-top:2.5rem;">
        <button class="l-hero-btn" onclick="openQuiz()">Получить проект и расчёт</button>
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
      <div style="text-align:center; margin-top:2rem;">
        <button class="l-hero-btn" onclick="openQuiz()">Рассчитать мой проект</button>
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
      <p class="l-cta-sub">Отправьте размеры, планировку или фотографию помещения. Мы посмотрим, что можно сделать, предложим варианты и рассчитаем стоимость проекта. Замер — бесплатно. Стоимость фиксируется в договоре после согласования проекта.</p>
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
