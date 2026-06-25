<?php
require_once __DIR__ . '/config.php';
$page           = '';
$title          = 'Мебель для новостройки в Нижегородском · Стив Интерьеры';
$description    = 'Делаем кухни и шкафы на заказ для жителей ЖК Среда, Аквилон Бисайд и ЖК Профит. Знаем планировки этих домов. Замер бесплатно.';
$robots         = 'noindex, follow';
$extra_css      = ['land-ng.css'];
$canonical_path = 'land-ng';
include 'header.php';
?>

<main class="l-wrap">

  <!-- ── HERO ── -->
  <section class="l-hero">
    <img class="l-hero-bg" src="images/k03.jpg" alt="Кухня на заказ в новостройке" loading="eager">
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
      <p class="l-district-text">Все три комплекса — монолит, предчистовая отделка, открытые планировки. Квартиры сдаются без мебели — и именно здесь начинается наша работа. Мы уже делали кухни и шкафы в этих домах, знаем их метраж и пропорции, и сразу считаем точно — без поправок после замера.</p>
      <div class="l-jk-list">
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>ЖК Среда</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>ЖК Аквилон Бисайд</span></div>
        <div class="l-jk-item"><span class="l-jk-dot"></span><span>ЖК Профит</span></div>
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
            <div class="l-utp-title">Один исполнитель — от замера до сдачи</div>
            <div class="l-utp-text">Нет цепочки посредников. Тот, кто приехал на замер, — тот же, кто делает проект и контролирует монтаж.</div>
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
            <div class="l-utp-title">Замер бесплатно — в день обращения</div>
            <div class="l-utp-text">Приедем в удобное время, снимем точные размеры. Без предоплаты и без обязательств с вашей стороны.</div>
          </div>
        </div>
        <div class="l-utp-item">
          <div class="l-utp-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="l-utp-body">
            <div class="l-utp-title">Выезжаем по всей Москве и МО</div>
            <div class="l-utp-text">Работаем в любом районе — не только рядом. Нижегородский, Текстильщики, Выхино, другие — всё доступно.</div>
          </div>
        </div>
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
      </div>
      <div class="l-work">
        <div class="l-work-img">
          <img src="images/k04.jpg" alt="Шкаф-купе на заказ" loading="lazy">
        </div>
      </div>
      <div class="l-work">
        <div class="l-work-img">
          <img src="images/k06.jpg" alt="Гардеробная на заказ" loading="lazy">
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
      <img src="images/m01.jpg" alt="" loading="lazy" aria-hidden="true">
      <div class="l-cta-overlay"></div>
    </div>
    <div class="l-cta-content">
      <h2 class="l-cta-title">Запишитесь на<br>бесплатный замер</h2>
      <p class="l-cta-sub">Приедем, посмотрим пространство, привезём образцы. Цена — до начала работ, в договоре.</p>
      <button class="l-cta-btn" onclick="openContactPopup()">Записаться</button>
      <a href="tel:<?php echo SITE_PHONE_HREF; ?>"
         class="l-cta-phone"
         onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    </div>
  </section>

  <!-- ── КВИЗ ── -->
  <div id="quizOverlay" class="lq-overlay" onclick="if(event.target===this)closeQuiz()">
    <div class="lq-modal" role="dialog" aria-modal="true" aria-label="Рассчитать стоимость мебели">
      <button class="lq-close" onclick="closeQuiz()" aria-label="Закрыть">&times;</button>

      <!-- Прогресс-бар -->
      <div class="lq-progress">
        <div class="lq-progress-bar" id="quizProgress"></div>
      </div>

      <div class="lq-body" id="quizBody">

        <!-- ШАГ 1: Что нужно -->
        <div class="lq-step" data-step="1">
          <p class="lq-step-label">Шаг 1 из 6</p>
          <h3 class="lq-question">Что вам нужно сделать?</h3>
          <div class="lq-options">
            <button class="lq-option" data-key="type" data-val="Кухня">Кухня</button>
            <button class="lq-option" data-key="type" data-val="Шкаф-купе">Шкаф-купе</button>
            <button class="lq-option" data-key="type" data-val="Гардеробная">Гардеробная</button>
            <button class="lq-option" data-key="type" data-val="Несколько предметов">Несколько предметов</button>
          </div>
        </div>

        <!-- ШАГ 2: Площадь -->
        <div class="lq-step" data-step="2" style="display:none">
          <p class="lq-step-label">Шаг 2 из 6</p>
          <h3 class="lq-question">Какой метраж помещения?</h3>
          <div class="lq-options">
            <button class="lq-option" data-key="area" data-val="До 8 м²">До 8 м²</button>
            <button class="lq-option" data-key="area" data-val="8–12 м²">8–12 м²</button>
            <button class="lq-option" data-key="area" data-val="12–18 м²">12–18 м²</button>
            <button class="lq-option" data-key="area" data-val="Больше 18 м²">Больше 18 м²</button>
          </div>
        </div>

        <!-- ШАГ 3: Стиль -->
        <div class="lq-step" data-step="3" style="display:none">
          <p class="lq-step-label">Шаг 3 из 6</p>
          <h3 class="lq-question">Какой стиль вам ближе?</h3>
          <div class="lq-options">
            <button class="lq-option" data-key="style" data-val="Современный">Современный</button>
            <button class="lq-option" data-key="style" data-val="Классика">Классика</button>
            <button class="lq-option" data-key="style" data-val="Минимализм">Минимализм</button>
            <button class="lq-option" data-key="style" data-val="Лофт">Лофт</button>
            <button class="lq-option" data-key="style" data-val="Пока не определился">Пока не определился</button>
          </div>
        </div>

        <!-- ШАГ 4: Бюджет -->
        <div class="lq-step" data-step="4" style="display:none">
          <p class="lq-step-label">Шаг 4 из 6</p>
          <h3 class="lq-question">Ориентировочный бюджет?</h3>
          <div class="lq-options">
            <button class="lq-option" data-key="budget" data-val="До 200 000 ₽">До 200 000 ₽</button>
            <button class="lq-option" data-key="budget" data-val="200–400 000 ₽">200–400 000 ₽</button>
            <button class="lq-option" data-key="budget" data-val="400–700 000 ₽">400–700 000 ₽</button>
            <button class="lq-option" data-key="budget" data-val="Более 700 000 ₽">Более 700 000 ₽</button>
          </div>
        </div>

        <!-- ШАГ 5: Сроки -->
        <div class="lq-step" data-step="5" style="display:none">
          <p class="lq-step-label">Шаг 5 из 6</p>
          <h3 class="lq-question">Когда планируете заказать?</h3>
          <div class="lq-options">
            <button class="lq-option" data-key="timing" data-val="Уже сейчас">Уже сейчас</button>
            <button class="lq-option" data-key="timing" data-val="Через 1–2 месяца">Через 1–2 месяца</button>
            <button class="lq-option" data-key="timing" data-val="Пока присматриваюсь">Пока присматриваюсь</button>
          </div>
        </div>

        <!-- ШАГ 6: Контакт -->
        <div class="lq-step" data-step="6" style="display:none">
          <p class="lq-step-label">Шаг 6 из 6</p>
          <h3 class="lq-question">Как с вами связаться?</h3>
          <p class="lq-contact-hint">Выберите удобный способ — ответим там, где вам комфортно.</p>
          <div class="lq-contact-form">
            <input class="lq-input" id="quizName" type="text" placeholder="Ваше имя" autocomplete="name">
            <p class="lq-err" id="quizNameErr" style="display:none">Введите имя</p>

            <!-- Способы связи -->
            <div class="lq-contact-methods">
              <button class="lq-method" data-method="phone" onclick="selectMethod('phone')">
                <span class="lq-method-icon">📞</span> Телефон
              </button>
              <button class="lq-method" data-method="telegram" onclick="selectMethod('telegram')">
                <span class="lq-method-icon">✈️</span> Telegram
              </button>
              <button class="lq-method" data-method="vk" onclick="selectMethod('vk')">
                <span class="lq-method-icon">📘</span> ВКонтакте
              </button>
              <button class="lq-method" data-method="max" onclick="selectMethod('max')">
                <span class="lq-method-icon">📱</span> Макс
              </button>
              <button class="lq-method" data-method="email" onclick="selectMethod('email')">
                <span class="lq-method-icon">📧</span> Email
              </button>
            </div>

            <!-- Поля ввода — показывается только выбранное -->
            <div id="quizContactFields" style="display:none">
              <input class="lq-input" id="quizPhone"    type="tel"   placeholder="+7 (___) ___-__-__" autocomplete="tel"   style="display:none">
              <input class="lq-input" id="quizTelegram" type="text"  placeholder="@username или номер" autocomplete="off"   style="display:none">
              <input class="lq-input" id="quizVk"       type="text"  placeholder="vk.com/id или @nickname" autocomplete="off" style="display:none">
              <input class="lq-input" id="quizMax"      type="tel"   placeholder="Номер телефона для Макс" autocomplete="tel" style="display:none">
              <input class="lq-input" id="quizEmail"    type="email" placeholder="example@mail.ru"     autocomplete="email" style="display:none">
              <p class="lq-err" id="quizContactErr" style="display:none">Заполните поле</p>
            </div>

            <button class="lq-submit" id="quizSubmitBtn" onclick="submitQuiz()">Получить расчёт</button>
          </div>
        </div>

        <!-- ФИНАЛ -->
        <div class="lq-step lq-success" data-step="7" style="display:none">
          <div class="lq-success-icon">✓</div>
          <h3 class="lq-success-title">Спасибо, заявка получена!</h3>
          <p class="lq-success-text">Свяжемся с вами в течение 2 часов в рабочее время. Пока ждёте — посмотрите наши работы.</p>
          <a href="catalog.php" class="lq-success-link">Смотреть галерею работ →</a>
        </div>

      </div><!-- /lq-body -->

      <!-- Кнопка назад -->
      <button class="lq-back" id="quizBack" onclick="quizBack()" style="display:none">← Назад</button>

    </div>
  </div>

  <script>
  (function() {
    var answers = {};
    var current = 1;
    var TOTAL = 6;
    var selectedMethod = null;
    var methodFields = {
      phone:    { id: 'quizPhone',    label: 'Телефон' },
      telegram: { id: 'quizTelegram', label: 'Telegram' },
      vk:       { id: 'quizVk',       label: 'ВКонтакте' },
      max:      { id: 'quizMax',      label: 'Макс' },
      email:    { id: 'quizEmail',    label: 'Email' }
    };

    function step(n) { return document.querySelector('.lq-step[data-step="' + n + '"]'); }

    window.openQuiz = function() {
      answers = {}; current = 1; selectedMethod = null;
      document.querySelectorAll('.lq-option').forEach(function(b){ b.classList.remove('lq-option--selected'); });
      document.querySelectorAll('.lq-method').forEach(function(b){ b.classList.remove('lq-method--active'); });
      document.getElementById('quizName').value = '';
      Object.values(methodFields).forEach(function(f){
        var el = document.getElementById(f.id);
        if (el) { el.value = ''; el.style.display = 'none'; }
      });
      document.getElementById('quizContactFields').style.display = 'none';
      showStep(1);
      document.getElementById('quizOverlay').classList.add('lq-overlay--open');
      document.body.style.overflow = 'hidden';
      if (typeof ymGoal === 'function') ymGoal('quiz_open');
    };

    window.closeQuiz = function() {
      document.getElementById('quizOverlay').classList.remove('lq-overlay--open');
      document.body.style.overflow = '';
    };

    function showStep(n) {
      document.querySelectorAll('.lq-step').forEach(function(s){ s.style.display = 'none'; });
      var s = step(n);
      if (s) s.style.display = '';
      var pct = Math.round(((n - 1) / TOTAL) * 100);
      document.getElementById('quizProgress').style.width = pct + '%';
      document.getElementById('quizBack').style.display = n > 1 && n <= TOTAL ? '' : 'none';
      current = n;
    }

    window.quizBack = function() { if (current > 1) showStep(current - 1); };

    // Клик по варианту ответа — запись и автопереход
    document.querySelectorAll('.lq-option').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var key = this.dataset.key;
        var val = this.dataset.val;
        answers[key] = val;
        // Подсветить выбранный
        var siblings = this.closest('.lq-options').querySelectorAll('.lq-option');
        siblings.forEach(function(b){ b.classList.remove('lq-option--selected'); });
        this.classList.add('lq-option--selected');
        // Трекинг шага 3+
        if (current >= 3 && typeof ymGoal === 'function') ymGoal('quiz_step_' + current);
        // Пауза для визуального отклика, потом переход
        var self = this;
        setTimeout(function() { showStep(current + 1); }, 220);
      });
    });

    // selectMethod — переключение способа связи
    window.selectMethod = function(method) {
      selectedMethod = method;
      // Кнопки
      document.querySelectorAll('.lq-method').forEach(function(b){
        b.classList.toggle('lq-method--active', b.dataset.method === method);
      });
      // Поля
      Object.keys(methodFields).forEach(function(m){
        var el = document.getElementById(methodFields[m].id);
        el.style.display = m === method ? '' : 'none';
      });
      document.getElementById('quizContactFields').style.display = '';
      document.getElementById('quizContactErr').style.display = 'none';
      document.getElementById(methodFields[method].id).focus();
    };

    // Маска телефона для phone и max
    ['quizPhone', 'quizMax'].forEach(function(id) {
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

      // Валидация способа связи
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
        } else if ((selectedMethod === 'phone' || selectedMethod === 'max') &&
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
      if (answers.area)   comment.push('Площадь: ' + answers.area);
      if (answers.style)  comment.push('Стиль: ' + answers.style);
      if (answers.budget) comment.push('Бюджет: ' + answers.budget);
      if (answers.timing) comment.push('Срок: ' + answers.timing);
      comment.push('Способ связи: ' + methodFields[selectedMethod].label + ' — ' + contactValue);

      // phone передаём отдельно если выбран телефон или макс
      var phoneVal = (selectedMethod === 'phone' || selectedMethod === 'max') ? contactValue : '';

      fetch('<?php echo $basePath; ?>send.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
          name: name,
          phone: phoneVal || contactValue, // send.php требует phone, передаём что есть
          type: answers.type || '',
          comment: comment.join(' / '),
          source: 'quiz'
        })
      })
      .then(function(r){ return r.json(); })
      .then(function(data) {
        if (data.ok) {
          if (typeof ymGoal === 'function') ymGoal('quiz_complete');
          showStep(7);
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

    // Закрытие по Escape обрабатывается в footer.php (общий обработчик сайта)

  })();
  </script>

</main>

<?php include 'footer.php'; ?>
