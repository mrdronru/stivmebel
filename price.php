<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/markdown-helpers.php';

$page        = 'price';
$title       = 'Цены';
$description = 'Стоимость корпусной мебели на заказ: шкафы от 89 000 руб./п.м., кухни от 109 000 руб./п.м. Индивидуальный расчёт после замера. Ответы на частые вопросы.';
$extra_css   = ['pricestyle.css'];
include 'header.php';

// FAQ грузится и парсится из faq.md на каждый заход — редактировать вопросы
// можно прямо в этом файле текстом, без пересборки и без правки PHP/HTML.
$faqItems = file_exists(__DIR__ . '/faq.md')
    ? parseFaqMarkdown(file_get_contents(__DIR__ . '/faq.md'))
    : [];
?>

<!-- ── HERO ── -->
<section class="price-hero">
  <p class="section-label">Цены</p>
  <h1>Сколько стоит <em>мебель на заказ</em></h1>
  <p class="price-hero-lead">
    Точная стоимость зависит от размеров, материалов и наполнения — её мы считаем после бесплатного замера.
    Ниже — ориентиры по бюджету и ответы на вопросы, которые чаще всего задают перед заказом.
  </p>
</section>

<!-- ── PRICE TEXT + PHOTOS ── -->
<section id="price-intro">
  <div class="price-intro-text reveal">
    <p>Стоимость корпусной мебели формируется индивидуально — исходя из архитектуры пространства, выбранных материалов, уровня фурнитуры и сложности реализации. Мы специализируемся на изготовлении мебели под заказ и не работаем с типовыми решениями.</p>
    <p>Каждый проект — это продуманная система хранения, адаптированная под ваш интерьер, образ жизни и требования к эстетике и функциональности.</p>

    <p class="price-intro-budget-label">Для понимания уровня бюджета:</p>
    <div class="price-rows">
      <div class="price-row">
        <div>
          <div class="price-row-name">Шкафы и шкафы-купе</div>
          <span class="price-row-desc">Встроенные и корпусные, любые системы дверей</span>
        </div>
        <div class="price-row-value">от 89 000 ₽ / п.м.</div>
      </div>
      <div class="price-row">
        <div>
          <div class="price-row-name">Кухни</div>
        </div>
        <div class="price-row-value">от 99 500 ₽ / п.м.</div>
      </div>
      <div class="price-row">
        <div>
          <div class="price-row-name">Гардеробные</div>
          <span class="price-row-desc">Система хранения под ваши вещи и привычки</span>
        </div>
        <div class="price-row-value">от 62 000 ₽ / п.м.</div>
      </div>
      <div class="price-row">
        <div>
          <div class="price-row-name">Детские комнаты, столы и стеллажи</div>
        </div>
        <div class="price-row-value">расчёт после замера</div>
      </div>
      <div class="price-row">
        <div>
          <div class="price-row-name">Прихожие</div>
        </div>
        <div class="price-row-value">от 89 000 ₽ / п.м.</div>
      </div>
    </div>

    <p>Это ориентиры для проектов с использованием качественных материалов, надёжной фурнитуры и аккуратной сборки. В зависимости от задач, уровня оснащения и дизайнерских решений стоимость может быть выше.</p>
    <p>Мы не стремимся сделать «дешевле любой ценой» — наша задача создать мебель, которая прослужит годы и будет выглядеть актуально.</p>
    <p class="price-intro-cta-text">Обратитесь к нам, чтобы получить персональный расчёт и обсудить ваш проект.</p>

    <button class="btn-primary" onclick="openContactPopup()">Получить расчёт</button>
  </div>

  <div class="price-photos reveal" style="transition-delay: 0.15s;">
    <div class="price-photo-placeholder">
      <img src="images/p01.jpg" alt="Мебель на заказ — пример работы">
    </div>
    <div class="price-photo-placeholder">
      <img src="images/p02.jpg" alt="Мебель на заказ — пример работы">
    </div>
    <div class="price-photo-placeholder">
      <img src="images/p03.jpg" alt="Мебель на заказ — пример работы">
    </div>
  </div>
</section>

<!-- ── FACTORS ── -->
<section id="price-factors">
  <div class="factors-header reveal">
    <p class="section-label">Из чего складывается цена</p>
    <h2 class="section-title">Что влияет<br>на <em>стоимость</em></h2>
  </div>
  <div class="factors-grid reveal" style="transition-delay: 0.1s;">
    <div class="factor-item">
      <div class="factor-num">01</div>
      <div class="factor-title">Размеры</div>
      <div class="factor-text">Чем больше погонных метров и сложнее конфигурация, тем выше стоимость материалов и работы.</div>
    </div>
    <div class="factor-item">
      <div class="factor-num">02</div>
      <div class="factor-title">Материалы</div>
      <div class="factor-text">Плиты Egger, фасады Alvic и Cleaf — класс материала напрямую влияет на цену за метр.</div>
    </div>
    <div class="factor-item">
      <div class="factor-num">03</div>
      <div class="factor-title">Наполнение</div>
      <div class="factor-text">Выдвижные системы, подъёмники, подсветка и другая функциональная начинка считаются отдельно.</div>
    </div>
    <div class="factor-item">
      <div class="factor-num">04</div>
      <div class="factor-title">Фурнитура</div>
      <div class="factor-text">Петли и направляющие Blum и Hettich надёжнее и дороже бюджетных аналогов, но служат дольше.</div>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section id="price-faq">
  <div class="faq-header reveal">
    <p class="section-label">Частые вопросы</p>
    <h2 class="section-title">Ответы на <em>частые вопросы</em></h2>
  </div>
  <div class="faq-list reveal" style="transition-delay: 0.1s;">
    <?php foreach ($faqItems as $item): ?>
    <div class="faq-item">
      <button class="faq-question" onclick="toggleFaq(this)">
        <?php echo $item['question']; ?>
        <span class="faq-icon"></span>
      </button>
      <div class="faq-answer">
        <?php echo $item['answer_html']; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ── CTA ── -->
<section id="price-cta">
  <h2 class="section-title">Узнаем точную <em>цену вашего проекта?</em></h2>
  <p class="price-cta-text">
    Оставьте контакт — мы бесплатно замерим, обсудим задачи и пришлём расчёт с конкретными суммами.
  </p>
  <div class="price-cta-actions">
    <button class="btn-primary" onclick="openContactPopup()">Бесплатный замер</button>
    <a href="<?php echo SITE_PHONE_HREF; ?>" class="btn-secondary"><?php echo SITE_PHONE; ?></a>
  </div>
</section>

<script>
  function toggleFaq(btn) {
    const item = btn.closest('.faq-item');
    const answer = item.querySelector('.faq-answer');
    const isOpen = item.classList.contains('open');

    document.querySelectorAll('.faq-item.open').forEach(other => {
      if (other !== item) {
        other.classList.remove('open');
        other.querySelector('.faq-answer').style.maxHeight = null;
      }
    });

    if (isOpen) {
      item.classList.remove('open');
      answer.style.maxHeight = null;
    } else {
      item.classList.add('open');
      answer.style.maxHeight = answer.scrollHeight + 'px';
    }
  }
</script>

<?php include 'footer.php'; ?>
