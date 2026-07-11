<?php require_once __DIR__ . '/config.php'; ?>
<?php
/**
 * footer.php — общий футер сайта
 * Подключается на каждой странице: <?php include 'footer.php'; ?>
 *
 * Переменная $basePath — префикс для всех относительных ссылок и подключаемых
 * файлов (script.js, send.php, about.php и т.д.). По умолчанию пустая строка —
 * подходит для страниц в корне сайта. Для страниц в подпапках (например,
 * /abc/term.html) установите $basePath = '../' перед include.
 */
$basePath = $basePath ?? '';
?>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div class="footer-logo">Стив <span>Интерьеры</span></div>
    <ul class="footer-nav">
      <li><a href="<?php echo $basePath; ?>about">Подробнее о нас</a></li>
      <li><a href="<?php echo $basePath; ?>catalog">Каталог</a></li>
      <li><a href="<?php echo $basePath; ?>video">Видео</a></li>
      <li><a href="<?php echo $basePath ?: '/'; ?>#contact">Контакты</a></li>
    </ul>
    <div class="footer-right">
      <div class="footer-socials">
        <a href="<?php echo SOCIAL_TG; ?>" class="footer-social-btn" target="_blank" rel="noopener" aria-label="Telegram" onclick="ymGoal('click_telegram')">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M21.9 4.5L18.5 19.3c-.25 1.1-.9 1.38-1.82.86L12 16.9l-2.25 2.17c-.25.25-.46.46-.94.46l.34-4.77 8.7-7.86c.38-.34-.08-.52-.58-.18L5.9 13.94 1.74 12.6c-.9-.28-.92-.9.19-1.33L20.64 3.17c.75-.28 1.4.17 1.26 1.33z" fill="currentColor"/></svg>
        </a>
        <a href="<?php echo SOCIAL_VK; ?>" class="footer-social-btn" target="_blank" rel="noopener" aria-label="ВКонтакте" onclick="ymGoal('click_vk')">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M21.6 7.2c.14-.47 0-.82-.67-.82h-2.2c-.57 0-.83.3-.97.63 0 0-1.13 2.75-2.73 4.54-.52.52-.75.68-1.03.68-.14 0-.35-.16-.35-.63V7.2c0-.57-.16-.82-.64-.82H10c-.36 0-.57.27-.57.52 0 .55.82.68.9 2.22v3.35c0 .72-.13.85-.41.85-.75 0-2.58-2.76-3.66-5.92-.21-.62-.43-.87-1-.87H3.06c-.63 0-.76.3-.76.63 0 .59.76 3.5 3.52 7.35C7.7 17.5 10.2 18.9 12.5 18.9c1.37 0 1.54-.31 1.54-.84v-1.94c0-.63.13-.76.58-.76.33 0 .88.17 2.19 1.43 1.49 1.49 1.73 2.11 2.57 2.11h2.2c.63 0 .95-.31.77-.93-.2-.62-.93-1.52-1.9-2.59-.52-.62-1.3-1.29-1.54-1.62-.33-.42-.23-.61 0-.98 0 0 2.72-3.83 3-5.12z" fill="currentColor"/></svg>
        </a>
        <a href="<?php echo SOCIAL_MAX; ?>" class="footer-social-btn" target="_blank" rel="noopener" aria-label="Max">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M12 3C7.03 3 3 6.81 3 11.5c0 2.7 1.3 5.1 3.3 6.7l-.8 3.3 3.5-1.5c1 .3 2 .5 3 .5 4.97 0 9-3.81 9-8.5S16.97 3 12 3z" stroke="currentColor" stroke-width="6" stroke-linejoin="round" stroke-linecap="round"/></svg>
        </a>
        <a href="<?php echo SITE_PHONE_HREF; ?>" class="footer-social-btn" aria-label="Позвонить нам" onclick="ymGoal('click_phone')">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012 .18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
      <div class="footer-text-links">
        <a href="<?php echo YANDEX_MAPS_URL; ?>" target="_blank" rel="noopener">Мы на картах</a>
        <a href="<?php echo SOCIAL_VK_PAGE; ?>" target="_blank" rel="noopener" onclick="ymGoal('click_vk')">Мы в ВК</a>
        <a href="<?php echo SOCIAL_TG_CHANNEL; ?>" target="_blank" rel="noopener">Мы в Telegram</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="footer-copy"><?php echo SITE_TAGLINE; ?> · © <?php echo date('Y'); ?></div>
    <div class="footer-legal">
      <a href="<?php echo $basePath; ?>politika">Политика конфиденциальности</a>
      <a href="<?php echo $basePath; ?>soglasie">Согласие на обработку данных</a>
    </div>
  </div>
</footer>

<script src="<?php echo $basePath; ?>script.js"></script>

<!-- POPUP FORM (общий для всех страниц) -->
<div id="contactPopup" class="popup-overlay" style="display:none;" onclick="closePopupOnBg(event)">
  <div class="popup-inner">
    <button class="popup-close" onclick="closeContactPopup()" aria-label="Закрыть">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M14 4L4 14M4 4l10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <div id="popupForm">
      <div class="form-title">Оставьте заявку</div>
      <div class="form-sub">Перезвоним в течение 2 часов в рабочее время</div>
      <div class="form-group">
        <label>Имя</label>
        <input type="text" placeholder="Как к вам обращаться" id="pfname">
        <span class="field-error" id="pfname-error">Заполните поле</span>
      </div>
      <div class="form-group">
        <label>Телефон</label>
        <input type="tel" placeholder="+7 (___) ___-__-__" id="pfphone">
        <span class="field-error" id="pfphone-error">Заполните поле</span>
      </div>
      <div class="form-group">
        <label>Тип мебели</label>
        <select id="pftype">
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
        <textarea id="pfcomment" placeholder="Планировка, сроки, особые пожелания..."></textarea>
      </div>
      <button id="pfsubmit" class="btn-primary" style="width:100%;margin-top:1rem;" onclick="submitPopupForm()">Отправить заявку</button>
      <p class="form-note">Нажимая «Отправить», вы соглашаетесь с <a href="<?php echo $basePath; ?>soglasie" target="_blank" rel="noopener">обработкой персональных данных</a> для связи по вашему запросу.</p>
    </div>
    <div id="popupSuccess" class="form-success" style="display:none;">
      <div class="form-success-icon">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 10L8 14L16 6" stroke="#B8975A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div class="form-success-title">Заявка принята</div>
      <p class="form-success-text">Мы перезвоним вам в течение двух часов.<br>Если удобно — можете позвонить нам сами.</p>
      <a href="<?php echo SITE_PHONE_HREF; ?>" class="btn-primary" style="display:inline-block;margin-top:2rem;" onclick="ymGoal('click_phone')"><?php echo SITE_PHONE; ?></a>
    </div>
  </div>
</div>

<script>
function openContactPopup() {
  document.getElementById('contactPopup').style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeContactPopup() {
  document.getElementById('contactPopup').style.display = 'none';
  document.body.style.overflow = '';
}
function closePopupOnBg(e) {
  if (e.target.id === 'contactPopup') closeContactPopup();
}
document.addEventListener('keydown', function(e) {
  if (e.key !== 'Escape') return;
  // Квиз (лендинг) — приоритет
  var quiz = document.getElementById('quizOverlay');
  if (quiz && quiz.classList.contains('lq-overlay--open')) { if (typeof closeQuiz === 'function') closeQuiz(); return; }
  // Обычный попап
  var popup = document.getElementById('contactPopup');
  if (popup && popup.style.display === 'flex') closeContactPopup();
});

// Форматирование телефона и отправка попап-формы
// Хелпер для целей Метрики
function ymGoal(name) {
  if (typeof ym !== 'undefined') ym(<?php echo YANDEX_METRIKA_ID; ?>, 'reachGoal', name);
}

var pfphoneEl = document.getElementById('pfphone');
if (pfphoneEl) {
  pfphoneEl.addEventListener('input', function() {
    if (this.value.trim()) { this.style.borderBottomColor = ''; document.getElementById('pfphone-error').classList.remove('visible'); }
    window.formatPhone(this);
  });
}
var pfnameEl = document.getElementById('pfname');
if (pfnameEl) {
  pfnameEl.addEventListener('input', function() {
    if (this.value.trim()) { this.style.borderBottomColor = ''; document.getElementById('pfname-error').classList.remove('visible'); }
  });
}

function submitPopupForm() {
  var nameEl  = document.getElementById('pfname');
  var phoneEl = document.getElementById('pfphone');
  var name    = nameEl.value.trim();
  var phone   = phoneEl.value.trim();
  var type    = document.getElementById('pftype').value;
  var comment = (document.getElementById('pfcomment') ? document.getElementById('pfcomment').value.trim() : '');
  var valid   = true;

  if (!name)  { nameEl.style.borderBottomColor  = '#C0392B'; document.getElementById('pfname-error').classList.add('visible');  valid = false; }
  else        { nameEl.style.borderBottomColor  = '';         document.getElementById('pfname-error').classList.remove('visible'); }
  if (!phone) { phoneEl.style.borderBottomColor = '#C0392B'; document.getElementById('pfphone-error').classList.add('visible'); valid = false; }
  else        { phoneEl.style.borderBottomColor = '';         document.getElementById('pfphone-error').classList.remove('visible'); }
  if (!valid) return;

  var btn = document.getElementById('pfsubmit');
  btn.textContent = 'Отправляем...'; btn.disabled = true;

  fetch('<?php echo $basePath; ?>send.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name: name, phone: phone, type: type, comment: comment, source: 'popup' })
  }).then(function(r) {
    if (!r.ok) throw new Error();
    document.getElementById('popupForm').style.display = 'none';
    var s = document.getElementById('popupSuccess');
    s.style.cssText = 'display:flex;flex-direction:column;align-items:center;';
    ymGoal('form_submit');
  }).catch(function() {
    btn.textContent = 'Ошибка — попробуйте ещё раз';
    btn.disabled = false;
  });
}
</script>
</body>
</html>
