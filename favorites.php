<?php
require_once __DIR__ . '/config.php';
$page        = 'favorites';
$title       = 'Мне понравилось';
$description = 'Фотографии, которые вы отметили в каталоге Стив Интерьеры. Отправьте их нам — обсудим, как воплотить в вашем интерьере.';
$extra_css   = ['gallerystyle.css', 'favoritesstyle.css'];
include 'header.php';
?>

<!-- HEADER -->
<div class="gallery-header fav-header">
  <div>
    <h1 class="gallery-title">Мне <em>понравилось</em></h1>
    <p class="gallery-hint" style="text-align:left;max-width:400px;">Фотографии которые вы отметили в каталоге. Отправьте их нам — обсудим детали.</p>
  </div>
  <a href="catalog" class="btn-secondary fav-to-catalog">← Вернуться в каталог</a>
</div>

<!-- ПУСТОЕ СОСТОЯНИЕ -->
<div class="fav-empty" id="favEmpty" style="display:none">
  <div class="fav-empty-inner">
    <div class="fav-empty-icon">
      <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
        <path d="M24 6L29.2 17.6L42 18.9L32.8 27.6L35.4 40.2L24 33.6L12.6 40.2L15.2 27.6L6 18.9L18.8 17.6L24 6Z"
          stroke="var(--ink-10)" stroke-width="2" stroke-linejoin="round"/>
      </svg>
    </div>
    <p class="fav-empty-title">Вы ещё ничего не отметили</p>
    <p class="fav-empty-sub">Откройте каталог, выберите понравившиеся работы — они появятся здесь</p>
    <a href="catalog" class="btn-primary" style="display:inline-block;margin-top:2rem;">Перейти в каталог</a>
  </div>
</div>

<!-- СЕТКА ИЗБРАННОГО -->
<div class="gallery-grid" id="favGrid"></div>

<!-- ПАНЕЛЬ ОТПРАВКИ -->
<div class="inquiry-bar" id="favBar">
  <div class="inquiry-bar-left">
    <div class="inquiry-count" id="favCount">0</div>
    <div class="inquiry-text">
      <strong id="favLabel">фото отмечено</strong>
      <span>Отправьте нам — обсудим, как это воплотить</span>
    </div>
    <div class="inquiry-thumbs" id="favThumbs"></div>
  </div>
  <div class="inquiry-bar-right">
    <button class="btn-clear" onclick="clearAllFavorites()">Очистить всё</button>
    <button class="btn-send" onclick="openFavModal()">Обсудить проект</button>
  </div>
</div>

<!-- ЛАЙТБОКС -->
<div class="lightbox" id="lightbox" onclick="closeLightboxOnBg(event)">
  <div class="lightbox-inner">
    <button class="lightbox-close" onclick="closeLightbox()" aria-label="Закрыть">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M15 5L5 15M5 5l10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <button class="lightbox-nav lightbox-prev" onclick="lightboxNav(-1)" aria-label="Назад">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <button class="lightbox-nav lightbox-next" onclick="lightboxNav(1)" aria-label="Вперёд">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 3l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <div class="lightbox-actions">
      <button class="lightbox-select-btn active" id="lightboxRemoveBtn" onclick="removeCurrent()">✕ Убрать из избранного</button>
    </div>
  </div>
</div>

<!-- МОДАЛ ОТПРАВКИ -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOnBg(event)">
  <div class="modal">
    <button class="modal-close" onclick="closeFavModal()" aria-label="Закрыть">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M14 4L4 14M4 4l10 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <div id="modalForm">
      <h2 class="modal-title">Обсудить проект</h2>
      <p class="modal-sub">Отправим вам ориентировочную стоимость в течение дня</p>
      <div class="modal-selected-imgs" id="modalSelectedImgs"></div>
      <div class="modal-field">
        <label>Имя</label>
        <input type="text" id="mName" placeholder="Как к вам обращаться">
        <span class="field-error" id="mNameError">Заполните поле</span>
      </div>
      <div class="modal-field">
        <label>Телефон</label>
        <input type="tel" id="mPhone" placeholder="+7 (___) ___-__-__">
        <span class="field-error" id="mPhoneError">Заполните поле</span>
      </div>
      <div class="modal-field">
        <label>Комментарий (необязательно)</label>
        <textarea id="mComment" placeholder="Размеры, материалы, пожелания..."></textarea>
      </div>
      <button id="mSubmitBtn" class="btn-send" style="width:100%;margin-top:0.5rem;" onclick="submitFavModal()">Отправить</button>
      <p class="modal-note">Нажимая «Отправить», вы соглашаетесь с <a href="soglasie" target="_blank" rel="noopener">обработкой персональных данных</a> для связи по вашему запросу.</p>
    </div>
    <div class="modal-success" id="modalSuccess" style="display:none">
      <div class="modal-success-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5 12L9.5 16.5L19 7" stroke="var(--gold)" stroke-width="1.5" stroke-linecap="round"/></svg>
      </div>
      <div class="modal-success-title">Заявка отправлена</div>
      <p class="modal-success-text">Мы получили ваши фото и контакт.<br>Перезвоним в течение двух часов в рабочее время.</p>
      <a href="<?php echo SITE_PHONE_HREF; ?>" class="btn-primary" onclick="ymGoal(\'click_phone\')" style="display:inline-block;margin-top:2rem;"><?php echo SITE_PHONE; ?></a>
    </div>
  </div>
</div>

<script>
  const ICON_REMOVE = `<svg width="13" height="13" viewBox="0 0 13 13" fill="none">
    <path d="M10 3L3 10M3 3l7 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>`;

  // ── Загрузить избранное из localStorage ──
  const favSet = window.favStorage ? window.favStorage.load() : new Set();
  const grid   = document.getElementById('favGrid');
  let lightboxItems = [];
  let lightboxIndex = 0;

  function render() {
    grid.innerHTML = '';
    const items = [...favSet];

    document.getElementById('favEmpty').style.display = items.length === 0 ? 'flex' : 'none';
    document.getElementById('favBar').classList.toggle('visible', items.length > 0);
    document.getElementById('favCount').textContent = items.length;

    items.forEach(src => {
      const div = document.createElement('div');
      div.className = 'gallery-item selected';
      div.dataset.img = src;
      div.innerHTML = `
        <img src="${src}" alt="Мебель на заказ" loading="lazy">
        <div class="gallery-item-overlay">
          <button class="gallery-item-action" type="button">${ICON_REMOVE} Убрать</button>
        </div>`;
      div.querySelector('.gallery-item-action').addEventListener('click', (e) => {
        e.stopPropagation();
        removeFromFav(src);
      });
      div.addEventListener('click', (e) => {
        if (!e.target.closest('.gallery-item-action')) openLightbox(div);
      });
      grid.appendChild(div);
    });

    lightboxItems = [...grid.querySelectorAll('.gallery-item')];

    // Превью в панели
    const thumbs = document.getElementById('favThumbs');
    thumbs.innerHTML = '';
    items.slice(0, 4).forEach(src => {
      const img = document.createElement('img');
      img.src = src; img.className = 'inquiry-thumb';
      img.onclick = () => openFavModal();
      thumbs.appendChild(img);
    });
  }

  function removeFromFav(src) {
    favSet.delete(src);
    if (window.favStorage) window.favStorage.save(favSet);
    if (window.favStorage) window.favStorage.updateCounter();
    render();
  }

  function clearAllFavorites() {
    favSet.clear();
    if (window.favStorage) window.favStorage.save(favSet);
    if (window.favStorage) window.favStorage.updateCounter();
    render();
  }

  // ── Лайтбокс ──
  function openLightbox(item) {
    lightboxItems = [...grid.querySelectorAll('.gallery-item')];
    lightboxIndex = lightboxItems.indexOf(item);
    renderLightbox();
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function renderLightbox() {
    const item = lightboxItems[lightboxIndex];
    if (!item) return;
    document.getElementById('lightboxImg').src = item.querySelector('img').src;
  }
  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeLightboxOnBg(e) {
    if (e.target === document.getElementById('lightbox')) closeLightbox();
  }
  function lightboxNav(dir) {
    lightboxIndex = (lightboxIndex + dir + lightboxItems.length) % lightboxItems.length;
    renderLightbox();
  }
  function removeCurrent() {
    const item = lightboxItems[lightboxIndex];
    if (!item) return;
    closeLightbox();
    removeFromFav(item.dataset.img);
  }
  document.addEventListener('keydown', (e) => {
    const lb = document.getElementById('lightbox');
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape')      closeLightbox();
    if (e.key === 'ArrowLeft')   lightboxNav(-1);
    if (e.key === 'ArrowRight')  lightboxNav(1);
  });

  // ── Модал ──
  function openFavModal() {
    const imgs = document.getElementById('modalSelectedImgs');
    imgs.innerHTML = '';
    [...favSet].forEach(src => {
      const img = document.createElement('img');
      img.src = src; img.className = 'modal-selected-img';
      imgs.appendChild(img);
    });
    document.getElementById('modalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeFavModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeModalOnBg(e) {
    if (e.target === document.getElementById('modalOverlay')) closeFavModal();
  }

  // Маска телефона
  document.getElementById('mPhone').addEventListener('input', function() {
    window.formatPhone(this);
    if (this.value.trim()) {
      this.style.borderBottomColor = '';
      document.getElementById('mPhoneError').classList.remove('visible');
    }
  });
  document.getElementById('mName').addEventListener('input', function() {
    if (this.value.trim()) {
      this.style.borderBottomColor = '';
      document.getElementById('mNameError').classList.remove('visible');
    }
  });

  async function submitFavModal() {
    const nameEl  = document.getElementById('mName');
    const phoneEl = document.getElementById('mPhone');
    const name    = nameEl.value.trim();
    const phone   = phoneEl.value.trim();
    let valid = true;

    if (!name)  { nameEl.style.borderBottomColor  = '#C0392B'; document.getElementById('mNameError').classList.add('visible');  valid = false; }
    else        { nameEl.style.borderBottomColor  = ''; document.getElementById('mNameError').classList.remove('visible'); }
    if (!phone) { phoneEl.style.borderBottomColor = '#C0392B'; document.getElementById('mPhoneError').classList.add('visible'); valid = false; }
    else        { phoneEl.style.borderBottomColor = ''; document.getElementById('mPhoneError').classList.remove('visible'); }
    if (!valid) return;

    const btn = document.getElementById('mSubmitBtn');
    const origText = btn.textContent;
    btn.textContent = 'Отправляем...';
    btn.disabled = true;

    try {
      const r = await fetch('send.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          name, phone,
          comment: document.getElementById('mComment').value.trim(),
          photos: [...favSet],
          source: 'favorites'
        })
      });
      if (!r.ok) throw new Error();
      document.getElementById('modalForm').style.display = 'none';
      const s = document.getElementById('modalSuccess');
      s.style.cssText = 'display:flex;flex-direction:column;align-items:center;text-align:center;';
    } catch {
      btn.textContent = 'Ошибка — попробуйте ещё раз';
      btn.disabled = false;
    }
  }

  // ── Инициализация ──
  render();
</script>

<?php include 'footer.php'; ?>
