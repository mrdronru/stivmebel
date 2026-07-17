<?php
/**
 * Общий квиз-модал для всех лендингов (land-ng, land-mos, ...).
 * Раньше на каждом лендинге была своя копия квиза, и они успели разойтись
 * (разное число шагов, разные вопросы, разные способы связи). Теперь один
 * файл — версия, которая была на land-mos (лучше: экран-приветствие,
 * вопрос про задачу вместо стиля, skip-логика для шага «помещение»).
 *
 * Перед include ОБЯЗАТЕЛЬНО задать $quiz_source — уходит в send.php как
 * source, по нему видно (в Telegram и в Метрике), с какой страницы пришла
 * заявка:
 *
 *   <?php $quiz_source = 'quiz-ng'; include 'quiz.php'; ?>
 *
 * Если $quiz_source не задан — используется 'quiz' (не рекомендуется для
 * новых страниц, но не ломается).
 */
$quiz_source = $quiz_source ?? 'quiz';
?>
<!-- ── КВИЗ (общий, quiz.php; 7 шагов + экран входа) ── -->
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
var QUIZ_SOURCE = <?php echo json_encode($quiz_source); ?>;

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
        source: QUIZ_SOURCE,
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
