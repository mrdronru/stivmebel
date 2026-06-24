<?php
require_once __DIR__ . '/config.php';
$page        = '';   // главная — ни один пункт не активен
$title       = 'Корпусная мебель на заказ · Москва';
$description = 'Проектируем и изготавливаем кухни, шкафы, гардеробные в Москве и МО. Замер бесплатно, 3D-проект, монтаж под ключ. Точность до 1 мм. Гарантия 2 года. С 2012 года.';
include 'header.php';
?>

<!-- HERO -->
<section id="hero" style="padding: 0;">
  <div class="hero-left">
    <p class="hero-eyebrow">Корпусная мебель на заказ · Москва</p>
    <div class="hero-title-wrap">
      <h1 class="hero-title" id="heroTitle">Мебель, которую не нужно <em>переделывать</em></h1>
    </div>
    <p class="hero-sub">
      Проектируем и изготавливаем кухни, шкафы, гардеробные и другую корпусную мебель.
      Точность монтажа — до 1 мм. Вы принимаете готовый результат и не участвуете в процессе.
    </p>
    <div class="hero-actions">
      <button class="btn-primary" onclick="openContactPopup()">Бесплатный замер</button>
      <a href="#process" class="btn-secondary">Как мы работаем</a>
    </div>
  </div>
  <div class="hero-right">
    <div class="carousel" id="heroCarousel">
      <div class="carousel-track" id="carouselTrack">
        <div class="carousel-slide"><img src="images/k01.jpg" alt="Кухня на заказ" loading="eager"></div>
        <div class="carousel-slide"><img src="images/k02.jpg" alt="Современная кухня" loading="lazy"></div>
        <div class="carousel-slide"><img src="images/k03.jpg" alt="Гардеробная" loading="lazy"></div>
        <div class="carousel-slide"><img src="images/k04.jpg" alt="Шкаф на заказ" loading="lazy"></div>
        <div class="carousel-slide"><img src="images/k05.jpg" alt="Спальня" loading="lazy"></div>
        <div class="carousel-slide"><img src="images/k06.jpg" alt="Гостиная" loading="lazy"></div>
        <div class="carousel-slide"><img src="images/k07.jpg" alt="Детская" loading="lazy"></div>
        <div class="carousel-slide"><img src="images/k08.jpg" alt="Прихожая" loading="lazy"></div>
      </div>
      <button class="carousel-arrow carousel-prev" onclick="carouselMove(-1)" aria-label="Предыдущий слайд">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M11 14L6 9L11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <button class="carousel-arrow carousel-next" onclick="carouselMove(1)" aria-label="Следующий слайд">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M7 4L12 9L7 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </button>
      <div class="carousel-dots" id="carouselDots"></div>
    </div>
    <div class="hero-badge">
      <div class="hero-badge-text">на рынке</div>
      <div class="hero-badge-num">с 2012 года</div>
    </div>
  </div>
</section>

<!-- PHILOSOPHY -->
<section id="philosophy">
  <div class="reveal" style="transition-delay: 0.2s;">
    <blockquote class="philosophy-quote">
      «Хорошая мебель не заметна. Она просто создаёт уют и работает каждый день, как должна.»
    </blockquote>
  </div>
  <div class="philosophy-text reveal">
    <p class="section-label">Подход</p>
    <div class="gold-line"></div>
    <p>Большинство сложностей в производстве мебели возникают из-за разрыва между тем, что договорились сделать, и тем, что получилось в итоге. Мы устраняем этот разрыв.</p>
    <p>За вами закрепляется персональный менеджер, который ведёт проект от замера до приёмки. Вы всегда знаете, на каком этапе находится ваш заказ, и можете задать вопрос напрямую ответственному человеку.</p>
    <p>Мы работаем с европейскими комплектующими — фурнитурой Blum и Hettich, плитами Egger, фасадами Alvic и Cleaf — потому что знаем: материал определяет срок службы мебели.</p>
  </div>
</section>

<!-- SERVICES -->
<section id="services">
  <div class="services-header reveal">
    <div>
      <h2 class="section-title">Мы изготавливаем все виды <em>корпусной мебели</em></h2>
    </div>
    <p class="services-desc">Работаем с любыми планировками — угловыми, нестандартными, со скошенными потолками и нишами. Разработаем оптимальное решение под ваше пространство.</p>
  </div>
  <div class="services-grid reveal" style="transition-delay: 0.2s;">
    <a href="catalog.php" class="service-item">
      <img src="images/m01.jpg" alt="Кухня на заказ" loading="lazy">
      <div class="service-overlay">
        <div class="service-name">Кухни</div>
        <div class="service-desc">Под ключ: проект, производство, монтаж, подключение техники.</div>
        <span class="service-btn">Посмотреть работы</span>
      </div>
    </a>
    <a href="catalog.php" class="service-item">
      <img src="images/m02.jpg" alt="Шкаф-купе на заказ" loading="lazy">
      <div class="service-overlay">
        <div class="service-name">Шкафы-купе</div>
        <div class="service-desc">Встроенные и корпусные, любые системы раздвижных дверей.</div>
        <span class="service-btn">Посмотреть работы</span>
      </div>
    </a>
    <a href="catalog.php" class="service-item">
      <img src="images/m03.jpg" alt="Гардеробная на заказ" loading="lazy">
      <div class="service-overlay">
        <div class="service-name">Гардеробные</div>
        <div class="service-desc">Проектируем систему хранения с учётом ваших вещей и привычек.</div>
        <span class="service-btn">Посмотреть работы</span>
      </div>
    </a>
    <a href="catalog.php" class="service-item">
      <img src="images/m04.jpg" alt="Детская комната на заказ" loading="lazy">
      <div class="service-overlay">
        <div class="service-name">Детские комнаты</div>
        <div class="service-desc">Шкафы, стеллажи, рабочие зоны — растём вместе с ребёнком.</div>
        <span class="service-btn">Посмотреть работы</span>
      </div>
    </a>
    <a href="catalog.php" class="service-item">
      <img src="images/m05.jpg" alt="Столы и стеллажи на заказ" loading="lazy">
      <div class="service-overlay">
        <div class="service-name">Столы и стеллажи</div>
        <div class="service-desc">Рабочие места, обеденные группы, библиотеки, детская мебель.</div>
        <span class="service-btn">Посмотреть работы</span>
      </div>
    </a>
    <a href="catalog.php" class="service-item">
      <img src="images/m06.jpg" alt="Прихожая на заказ" loading="lazy">
      <div class="service-overlay">
        <div class="service-name">Прихожие</div>
        <div class="service-desc">Комбинируем хранение, зеркала и освещение в единую систему.</div>
        <span class="service-btn">Посмотреть работы</span>
      </div>
    </a>
  </div>
</section>

<!-- PROCESS -->
<section id="process">
  <div class="process-header reveal">
    <div>
      <h2 class="section-title">Как мы <em>работаем</em></h2>
    </div>
    <p class="process-sub">Пять шагов от первого звонка до финальной приёмки. На каждом этапе — конкретный ответственный и зафиксированные сроки.</p>
  </div>
  <div class="process-steps reveal" style="transition-delay: 0.2s;">
    <div class="process-step">
      <!-- Замер: рулетка/линейка -->
      <div class="step-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="8" width="18" height="8" rx="1"/>
          <line x1="7" y1="8" x2="7" y2="11"/><line x1="11" y1="8" x2="11" y2="13"/>
          <line x1="15" y1="8" x2="15" y2="11"/><line x1="19" y1="8" x2="19" y2="11"/>
        </svg>
      </div>
      <div class="step-title">Замер</div>
      <div class="step-desc">Выезжаем в удобное для вас время. Фиксируем все нюансы помещения.</div>
    </div>
    <div class="process-step">
      <!-- Проект: карандаш + линии -->
      <div class="step-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/>
        </svg>
      </div>
      <div class="step-title">Проект</div>
      <div class="step-desc">Разрабатываем 3D-визуализацию и согласовываем каждую деталь.</div>
    </div>
    <div class="process-step">
      <!-- Договор: документ -->
      <div class="step-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="12" y2="17"/>
        </svg>
      </div>
      <div class="step-title">Договор</div>
      <div class="step-desc">Фиксируем стоимость, состав и сроки. Без скрытых доплат.</div>
    </div>
    <div class="process-step">
      <!-- Производство: шестерня -->
      <div class="step-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3"/>
          <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
        </svg>
      </div>
      <div class="step-title">Производство</div>
      <div class="step-desc">Контроль качества на каждом этапе изготовления на нашем производстве.</div>
    </div>
    <div class="process-step">
      <!-- Монтаж: гаечный ключ -->
      <div class="step-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
        </svg>
      </div>
      <div class="step-title">Монтаж</div>
      <div class="step-desc">Точность установки до 1 мм. Уборка после монтажа входит в стоимость.</div>
    </div>
  </div>
</section>

<!-- ADVANTAGES -->
<section id="advantages">
  <div class="adv-left reveal">
    <h2 class="section-title">Нас выбирают<br>за <em>результат</em></h2>
    <div class="gold-line" style="margin-top: 2rem;"></div>
    <p style="font-size: var(--fs-xs); color: var(--ink-60); line-height: 1.8; max-width: 280px;">
      Сделано за один раз. Сделано правильно. Вы получаете мебель точно такой, как договорились — и спокойствие вместо переделок.
    </p>
  </div>
  <div class="adv-list reveal" style="transition-delay: 0.15s;">
    <div class="adv-item">
      <div class="adv-num">1 мм</div>
      <div class="adv-title">Точность монтажа</div>
      <div class="adv-text">Собственные специалисты, работающие только с нашей мебелью.</div>
    </div>
    <div class="adv-item">
      <div class="adv-num">EU</div>
      <div class="adv-title">Европейские комплектующие</div>
      <div class="adv-text">Фурнитура Blum и Hettich, плиты Egger, фасады Alvic и Cleaf.</div>
    </div>
    <div class="adv-item">
      <div class="adv-num">0 ₽</div>
      <div class="adv-title">Замер и консультация</div>
      <div class="adv-text">Выезд специалиста и разработка проекта — бесплатно.</div>
    </div>
    <div class="adv-item">
      <div class="adv-num">1</div>
      <div class="adv-title">Персональный менеджер</div>
      <div class="adv-text">Один человек ведёт ваш проект от начала до конца. Прямой номер.</div>
    </div>
    <div class="adv-item">
      <div class="adv-num">100%</div>
      <div class="adv-title">Контроль на каждом этапе</div>
      <div class="adv-text">Производство, качество материалов, монтаж — всё под постоянным контролем.</div>
    </div>
    <div class="adv-item">
      <div class="adv-num">2 года</div>
      <div class="adv-title">Гарантия</div>
      <div class="adv-text">На всю мебель и комплектующие. Устраним любой дефект за свой счёт.</div>
    </div>
  </div>
</section>

<!-- REVIEWS (Яндекс Карты) -->
<section id="reviews">
  <div class="reviews-header reveal">
    <div>
      <p class="section-label">Отзывы</p>
      <h2 class="section-title">Нам доверяют<br><em>клиенты</em></h2>
    </div>
    <div class="reviews-badge-wrap">
      <iframe src="https://yandex.ru/sprav/widget/rating-badge/152572712181?type=rating" width="150" height="50" frameborder="0" style="border:none;" loading="lazy"></iframe>
    </div>
  </div>
  <div class="reviews-grid reveal" style="transition-delay: 0.15s;">
    <div class="review-card">
      <div class="review-card-stars">★★★★★</div>
      <p class="review-card-text">Заказывала встроенные шкафы и не ожидала такого слаженного результата: команда работала чётко, материалы и итоговая сборка — на хорошем уровне, а советы по выбору решений оказались по делу.</p>
      <div class="review-card-author">Марина А., Яндекс Карты</div>
    </div>
    <div class="review-card">
      <div class="review-card-stars">★★★★★</div>
      <p class="review-card-text">Обращалась по реставрации мебели — порадовали сроки, качество и адекватная стоимость. Новые фасады сделали точно по задаче, и они хорошо вписались в существующий интерьер.</p>
      <div class="review-card-author">Ирина А., Яндекс Карты</div>
    </div>
  </div>
  <a href="https://yandex.ru/maps/org/stiv_interyery/152572712181/reviews/" target="_blank" rel="noopener" class="reviews-link">
    <div class="reviews-link-icon">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 2C7.6 2 4 5.6 4 10c0 6 8 12 8 12s8-6 8-12c0-4.4-3.6-8-8-8z" stroke="#B8975A" stroke-width="1.3"/><circle cx="12" cy="10" r="2.5" stroke="#B8975A" stroke-width="1.3"/></svg>
    </div>
    Все отзывы на Яндекс Картах
  </a>
</section>

<!-- PRICING -->
<section id="pricing">
  <div class="pricing-text reveal">
    <p class="section-label">Цены</p>
    <h2 class="section-title">Наши <em>цены</em></h2>
    <p>Подробные цены и ответы на частые вопросы — на странице <a href="price.php" style="color: var(--gold);">«Цены»</a>.</p>
    <p>Если кратко, то стоимость рассчитывается индивидуально с учётом размеров, материалов и наполнения.</p>
    <div class="pricing-from">
      <div class="pricing-from-item">
        <span class="pricing-from-num">от 89 000 ₽</span>
        <span class="pricing-from-label">за п.м. — шкафы</span>
      </div>
      <div class="pricing-from-item">
        <span class="pricing-from-num">от 99 500 ₽</span>
        <span class="pricing-from-label">за п.м. — кухни</span>
      </div>
    </div>
    <p>Мы подберём оптимальное решение под ваш бюджет — с использованием надёжной фурнитуры, продуманной эргономики и материалов, рассчитанных на долгий срок службы.</p>
    <a href="price.php" class="btn-secondary">Подробнее о ценах</a>
  </div>
  <div class="pricing-collage reveal" style="transition-delay: 0.15s;">
    <div class="pricing-collage-item">
      <img src="images/m01.jpg" alt="Кухня на заказ — пример работы" loading="lazy">
    </div>
    <div class="pricing-collage-item">
      <img src="images/m02.jpg" alt="Шкаф-купе на заказ — пример работы" loading="lazy">
    </div>
    <div class="pricing-collage-item">
      <img src="images/m04.jpg" alt="Детская комната на заказ — пример работы" loading="lazy">
    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact" style="padding: 0;">
  <div class="contact-left reveal">
    <h2 class="section-title">Обсудим ваш <em>проект?</em></h2>
    <p class="contact-desc">Оставьте контакт — мы перезвоним в течение двух часов в рабочее время и ответим на все вопросы. Ни к чему не обязывает.</p>
    <div class="contact-detail">
      <a href="<?php echo SITE_PHONE_HREF; ?>" class="contact-line">
        <div class="contact-line-icon">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M13.5 10.5L11 10C10.7 10 10.4 10.1 10.2 10.3L8.8 11.7C6.8 10.7 5.3 9.2 4.3 7.2L5.7 5.8C5.9 5.6 6 5.3 6 5L5.5 2.5C5.2 2.2 4.9 2 4.5 2H2.5C2 2 1.5 2.5 1.5 3C1.5 9.3 6.7 14.5 13 14.5C13.5 14.5 14 14 14 13.5V11.5C14 11.1 13.8 10.8 13.5 10.5Z" stroke="#B8975A" stroke-width="1" stroke-linecap="round"/></svg>
        </div>
        <?php echo SITE_PHONE; ?>
      </a>
      <a href="<?php echo SITE_EMAIL_HREF; ?>" class="contact-line">
        <div class="contact-line-icon">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1.5" y="3.5" width="13" height="9" rx="1" stroke="#B8975A" stroke-width="1"/><path d="M1.5 4.5L8 9L14.5 4.5" stroke="#B8975A" stroke-width="1" stroke-linecap="round"/></svg>
        </div>
        <?php echo SITE_EMAIL; ?>
      </a>
      <a href="<?php echo YANDEX_MAPS_URL; ?>" class="contact-line" target="_blank" rel="noopener">
        <div class="contact-line-icon">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1.5C5.5 1.5 3.5 3.5 3.5 6C3.5 9.5 8 14.5 8 14.5C8 14.5 12.5 9.5 12.5 6C12.5 3.5 10.5 1.5 8 1.5Z" stroke="#B8975A" stroke-width="1"/><circle cx="8" cy="6" r="1.5" stroke="#B8975A" stroke-width="1"/></svg>
        </div>
        Москва и Московская область · мы на картах
      </a>
      <a href="<?php echo SOCIAL_VK_PAGE; ?>" class="contact-line" target="_blank" rel="noopener">
        <div class="contact-line-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21.6 7.2c.14-.47 0-.82-.67-.82h-2.2c-.57 0-.83.3-.97.63 0 0-1.13 2.75-2.73 4.54-.52.52-.75.68-1.03.68-.14 0-.35-.16-.35-.63V7.2c0-.57-.16-.82-.64-.82H10c-.36 0-.57.27-.57.52 0 .55.82.68.9 2.22v3.35c0 .72-.13.85-.41.85-.75 0-2.58-2.76-3.66-5.92-.21-.62-.43-.87-1-.87H3.06c-.63 0-.76.3-.76.63 0 .59.76 3.5 3.52 7.35C7.7 17.5 10.2 18.9 12.5 18.9c1.37 0 1.54-.31 1.54-.84v-1.94c0-.63.13-.76.58-.76.33 0 .88.17 2.19 1.43 1.49 1.49 1.73 2.11 2.57 2.11h2.2c.63 0 .95-.31.77-.93-.2-.62-.93-1.52-1.9-2.59-.52-.62-1.3-1.29-1.54-1.62-.33-.42-.23-.61 0-.98 0 0 2.72-3.83 3-5.12z" fill="#B8975A"/></svg>
        </div>
        Мы в ВК
      </a>
      <a href="<?php echo SOCIAL_TG_CHANNEL; ?>" class="contact-line" target="_blank" rel="noopener">
        <div class="contact-line-icon">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M21.9 4.5L18.5 19.3c-.25 1.1-.9 1.38-1.82.86L12 16.9l-2.25 2.17c-.25.25-.46.46-.94.46l.34-4.77 8.7-7.86c.38-.34-.08-.52-.58-.18L5.9 13.94 1.74 12.6c-.9-.28-.92-.9.19-1.33L20.64 3.17c.75-.28 1.4.17 1.26 1.33z" fill="#B8975A"/></svg>
        </div>
        Мы в Telegram
      </a>
    </div>
  </div>
  <div class="contact-right reveal" style="transition-delay: 0.2s;">
    <div id="contactForm">
      <div class="form-title">Оставьте заявку</div>
      <div class="form-sub">Перезвоним в течение 2 часов в рабочее время</div>
      <div class="form-group">
        <label>Имя</label>
        <input type="text" placeholder="Как к вам обращаться" id="fname">
        <span class="field-error" id="fname-error">Заполните поле</span>
      </div>
      <div class="form-group">
        <label>Телефон</label>
        <input type="tel" placeholder="+7 (___) ___-__-__" id="fphone">
        <span class="field-error" id="fphone-error">Заполните поле</span>
      </div>
      <div class="form-group">
        <label>Тип мебели</label>
        <select id="ftype">
          <option value="" disabled selected>Выберите вид мебели</option>
          <option>Кухня</option>
          <option>Шкаф-купе</option>
          <option>Гардеробная</option>
          <option>Кровать</option>
          <option>Прихожая</option>
          <option>Другое</option>
        </select>
      </div>
      <div class="form-group">
        <label>Комментарий (необязательно)</label>
        <textarea id="fcomment" placeholder="Планировка, сроки, особые пожелания..."></textarea>
      </div>
      <button id="fsubmit" class="btn-primary" style="width:100%;margin-top:1rem;" onclick="submitForm()">Отправить заявку</button>
      <p class="form-note">Нажимая «Отправить», вы соглашаетесь с <a href="soglasie.php" target="_blank" rel="noopener">обработкой персональных данных</a> для связи по вашему запросу.</p>
    </div>
    <div id="formSuccess" class="form-success" style="display:none">
      <div class="form-success-icon">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 10L8 14L16 6" stroke="#B8975A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div class="form-success-title">Заявка принята</div>
      <p class="form-success-text">Мы перезвоним вам в течение двух часов.<br>Если удобно — можете позвонить нам сами.</p>
      <a href="<?php echo SITE_PHONE_HREF; ?>" class="btn-primary" style="display:inline-block;margin-top:2rem;"><?php echo SITE_PHONE; ?></a>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
