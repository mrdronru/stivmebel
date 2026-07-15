<?php
require_once __DIR__ . '/config.php';
$page        = 'about';
$title       = 'О нас: производство мебели на заказ в Москве';
$description = 'Станислав — основатель Стив Интерьеры. С 2012 года делаем корпусную мебель на заказ в Москве и МО: кухни, шкафы, гардеробные. 300+ проектов, гарантия 2 года.';
$extra_css   = ['aboutstyle.css'];
include 'header.php';
?>

<!-- ── HERO ── -->
<section class="about-hero">
  <div class="about-hero-left">
    <p class="about-eyebrow">Стив Интерьеры · Москва</p>
    <h1 class="about-hero-title">Меня зовут<br>Станислав.<br><em>Я делаю мебель.</em></h1>
    <p class="about-hero-lead">
      Кухни, шкафы, гардеробные и корпусная мебель на заказ — с замером, проектом и монтажом под ключ. 
      Работаю в Москве и Московской области с 2012 года.
    </p>
    <div class="hero-actions">
      <button class="btn-primary" onclick="openContactPopup()">Обсудить проект</button>
      <a href="catalog" class="btn-secondary">Посмотреть работы</a>
    </div>
  </div>
  <div class="about-hero-right">
    <div class="video-circle-outer">
      <div class="video-circle-wrap">
        <div class="video-circle-ring"></div>
        <div class="video-circle">
          <video id="helloVideo" src="hello.mp4" playsinline muted preload="metadata"></video>
          <div class="video-circle-play" id="videoPlayBtn">
            <div class="play-icon-circle">
              <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
                <path d="M8 5l10 6-10 6V5z" fill="currentColor"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="video-badge">
        <div class="video-badge-name">Станислав</div>
        <div class="video-badge-role">Основатель · Стив Интерьеры</div>
      </div>
    </div>
  </div>
</section>

<!-- ── ПОЧЕМУ МЫ ── -->
<section class="about-section dark">
  <div class="about-section-inner">
    <div class="why-grid">
      <div class="why-left">
        <p class="section-label why-label">Наши принципы</p>
        <h2 class="section-title">Почему<br>выбирают <em>нас</em></h2>
        <p>Мы не просто делаем мебель — мы берём на себя весь процесс, чтобы вы получили результат без лишних хлопот.</p>
      </div>
      <div class="why-items">
        <div class="why-item">
          <div class="why-item-line"></div>
          <div class="why-item-title">Точность до миллиметра</div>
          <div class="why-item-text">Нестандартные размеры, скошенные потолки, ниши — изготовим мебель под любую планировку.</div>
        </div>
        <div class="why-item">
          <div class="why-item-line"></div>
          <div class="why-item-title">3D-проект бесплатно</div>
          <div class="why-item-text">Разработаем дизайн-проект с визуализацией до старта производства — вы увидите результат заранее.</div>
        </div>
        <div class="why-item">
          <div class="why-item-line"></div>
          <div class="why-item-title">Под ключ без хлопот</div>
          <div class="why-item-text">Замер, проект, производство, доставка, монтаж. При необходимости привлекаем электриков и сантехников.</div>
        </div>
        <div class="why-item">
          <div class="why-item-line"></div>
          <div class="why-item-title">Работаем по договору</div>
          <div class="why-item-text">Фиксированная цена, сроки и материалы — всё прописано. Никаких неожиданных доплат.</div>
        </div>
        <div class="why-item">
          <div class="why-item-line"></div>
          <div class="why-item-title">Срок службы от 10 лет</div>
          <div class="why-item-text">Европейские комплектующие Blum и Hettich, плиты Egger, фасады Alvic и Cleaf.</div>
        </div>
        <div class="why-item">
          <div class="why-item-line"></div>
          <div class="why-item-title">Гарантия 2 года</div>
          <div class="why-item-text">Замер и доставка по Москве и ближнему Подмосковью — бесплатно. Гарантия на мебель — 2 года.</div>
        </div>
      </div>
    </div>

    <!-- Цифры -->
    <div class="results-grid">
      <div class="result-item">
        <div class="result-num">300+</div>
        <div class="result-label">выполненных проектов</div>
      </div>
      <div class="result-item">
        <div class="result-num">45</div>
        <div class="result-label">рабочих дней<br>срок изготовления</div>
      </div>
      <div class="result-item">
        <div class="result-num">2 года</div>
        <div class="result-label">гарантия<br>на мебель</div>
      </div>
    </div>
  </div>
</section>

<?php
// Отзывы: фото и видео вперемешку из testimonials/, сортировка по номеру в имени файла.
// Если папка пуста — секция ниже просто не выводится.
$testimonial_files = glob(__DIR__ . '/testimonials/*.{jpg,jpeg,JPG,JPEG,png,PNG,mp4,MP4}', GLOB_BRACE) ?: [];
sort($testimonial_files);
$testimonials = array_map(function($f) {
    $name = basename($f);
    $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    return [
        'file' => $name,
        'type' => $ext === 'mp4' ? 'video' : 'photo',
    ];
}, $testimonial_files);
?>

<?php if ($testimonials): ?>
<!-- ── ОТЗЫВЫ ── -->
<section class="about-section">
  <div class="about-section-inner">
    <p class="section-label">Отзывы</p>
    <h2 class="section-title">Что говорят <em>клиенты</em></h2>
    <div class="testimonials-strip" id="testimonialsStrip">
      <?php foreach ($testimonials as $i => $t): ?>
      <div class="testimonial-item" data-type="<?php echo $t['type']; ?>" data-src="testimonials/<?php echo htmlspecialchars($t['file']); ?>" data-index="<?php echo $i; ?>">
        <?php if ($t['type'] === 'video'): ?>
        <video class="testimonial-media" src="testimonials/<?php echo htmlspecialchars($t['file']); ?>" preload="metadata" muted playsinline></video>
        <div class="testimonial-play">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7 4l9 6-9 6V4z" fill="currentColor"/></svg>
        </div>
        <?php else: ?>
        <img class="testimonial-media" width="220" height="280" src="testimonials/<?php echo htmlspecialchars($t['file']); ?>" alt="Отзыв клиента" loading="lazy">
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Лайтбокс отзывов (фото и видео) -->
<div class="testimonial-lightbox" id="testimonialLightbox" onclick="closeTestimonialLightboxOnBg(event)">
  <div class="testimonial-lightbox-inner">
    <button class="lightbox-close" onclick="closeTestimonialLightbox()" aria-label="Закрыть">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M5 5l12 12M17 5L5 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <button class="testimonial-lightbox-nav testimonial-lightbox-prev" onclick="testimonialLightboxNav(-1)" aria-label="Предыдущее">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M14 4l-8 7 8 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <div class="testimonial-lightbox-media-wrap">
      <img class="testimonial-lightbox-img" id="testimonialLightboxImg" src="" alt="Отзыв клиента">
      <video class="testimonial-lightbox-video" id="testimonialLightboxVideo" controls playsinline></video>
    </div>
    <button class="testimonial-lightbox-nav testimonial-lightbox-next" onclick="testimonialLightboxNav(1)" aria-label="Следующее">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M8 4l8 7-8 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
  </div>
</div>
<?php endif; ?>

<!-- ── КАК МЫ РАБОТАЕМ ── -->
<section class="about-section cream">
  <div class="about-section-inner">
    <div class="process-title-block">
      <div>
        <p class="section-label">Этапы работы</p>
        <h2 class="section-title">Как устроен<br><em>процесс</em></h2>
      </div>
      <p class="process-lead">
        Приезжаем с образцами и ноутбуком, рисуем проект прямо у вас — 
        и дальше всё происходит без вашего участия, пока не придёт время принимать готовую мебель.
      </p>
    </div>
    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-dot">01</div>
        <div class="timeline-content">
          <div class="timeline-title">Замер с образцами</div>
          <div class="timeline-text">Приезжаем в согласованное время с образцами материалов, инструментами и ноутбуком. Снимаем точные размеры.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">02</div>
        <div class="timeline-content">
          <div class="timeline-title">3D-модель на месте</div>
          <div class="timeline-text">Создаём объёмную модель прямо во время визита — вы видите будущую мебель до того, как подпишете договор.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">03</div>
        <div class="timeline-content">
          <div class="timeline-title">Выбор материалов и договор</div>
          <div class="timeline-text">Подбираем материалы, цвета и механизмы, рассчитываем точную стоимость. Заключаем договор с предоплатой 65%.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">04</div>
        <div class="timeline-content">
          <div class="timeline-title">Дизайн-проект и эскиз</div>
          <div class="timeline-text">В течение нескольких дней разрабатываем дизайн-проект. После вашего утверждения подписываем Эскиз и Спецификацию.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">05</div>
        <div class="timeline-content">
          <div class="timeline-title">Производство — до 45 рабочих дней</div>
          <div class="timeline-text">Заказ уходит в производство. Вы не занимаетесь ничем — мы контролируем каждый этап.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">06</div>
        <div class="timeline-content">
          <div class="timeline-title">Доставка</div>
          <div class="timeline-text">Доставляем в согласованный день. При доставке оплачивается 25% от стоимости мебели.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">07</div>
        <div class="timeline-content">
          <div class="timeline-title">Монтаж</div>
          <div class="timeline-text">Устанавливаем в удобный для вас день. Уборка после монтажа входит в работу.</div>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-dot">08</div>
        <div class="timeline-content">
          <div class="timeline-title">Приёмка и гарантия</div>
          <div class="timeline-text">Подписываем Акт приёма-передачи, оплачивается монтаж (10% от стоимости мебели). Гарантия 2 года.</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="about-section">
  <div class="about-section-inner">
    <div class="cta-block">
      <blockquote class="cta-quote">
        «Заказывать мебель — это доверять. Я отношусь к этому серьёзно.»
      </blockquote>
      <div class="cta-right">
        <p>
          Представьте: утром вы находите вещи там, где оставили. Гостей приглашаете сами — потому что хотите похвастаться. 
          За рабочим столом больше нет хаоса из проводов и бумаг. Просто потому что наконец есть место для всего.
        </p>
        <p>
          Оставьте контакт — я свяжусь, чтобы обсудить ваш проект без спешки и давления. 
          Просто поговорим о том, что важно именно вам.
        </p>
        <div class="cta-actions">
          <button class="btn-primary" onclick="openContactPopup()">Оставить заявку</button>
          <a href="<?php echo SITE_PHONE_HREF; ?>" class="btn-secondary" onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Видео в круге
  const video = document.getElementById('helloVideo');
  const playBtn = document.getElementById('videoPlayBtn');

  playBtn.addEventListener('click', () => {
    if (video.paused) {
      video.muted = false;
      video.play();
      playBtn.classList.add('hidden');
    } else {
      video.pause();
      playBtn.classList.remove('hidden');
    }
  });

  video.addEventListener('ended', () => {
    playBtn.classList.remove('hidden');
  });

  // ── Лайтбокс отзывов ──
  const testimonialItems = Array.from(document.querySelectorAll('.testimonial-item'));
  let testimonialIndex = 0;

  if (testimonialItems.length) {
    testimonialItems.forEach(item => {
      item.addEventListener('click', () => openTestimonialLightbox(item));
    });
  }

  function openTestimonialLightbox(item) {
    testimonialIndex = testimonialItems.indexOf(item);
    document.getElementById('testimonialLightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
    showTestimonialAt(testimonialIndex);
  }

  function showTestimonialAt(i) {
    const item = testimonialItems[i];
    const type = item.dataset.type;
    const src  = item.dataset.src;
    const img  = document.getElementById('testimonialLightboxImg');
    const vid  = document.getElementById('testimonialLightboxVideo');

    vid.pause();
    if (type === 'video') {
      img.style.display = 'none';
      vid.style.display = 'block';
      vid.src = src;
      vid.play();
    } else {
      vid.style.display = 'none';
      vid.removeAttribute('src');
      img.style.display = 'block';
      img.src = src;
    }
  }

  window.closeTestimonialLightbox = function() {
    document.getElementById('testimonialLightbox').classList.remove('open');
    document.body.style.overflow = '';
    document.getElementById('testimonialLightboxVideo').pause();
  };

  window.closeTestimonialLightboxOnBg = function(e) {
    if (e.target.id === 'testimonialLightbox') closeTestimonialLightbox();
  };

  window.testimonialLightboxNav = function(dir) {
    testimonialIndex = (testimonialIndex + dir + testimonialItems.length) % testimonialItems.length;
    showTestimonialAt(testimonialIndex);
  };

  document.addEventListener('keydown', (e) => {
    if (!document.getElementById('testimonialLightbox')?.classList.contains('open')) return;
    if (e.key === 'ArrowLeft')  testimonialLightboxNav(-1);
    if (e.key === 'ArrowRight') testimonialLightboxNav(1);
    if (e.key === 'Escape')     closeTestimonialLightbox();
  });

  </script>

<?php include 'footer.php'; ?>
