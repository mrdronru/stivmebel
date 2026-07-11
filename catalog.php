<?php
require_once __DIR__ . '/config.php';
$page        = 'gallery';
$title       = 'Каталог: кухни, шкафы и гардеробные на заказ';
$description = 'Фотогалерея выполненных работ Стив Интерьеры: кухни, шкафы-купе, гардеробные, прихожие, детские на заказ. Отметьте понравившиеся — обсудим детали.';
$extra_css   = ['gallerystyle.css'];

// Автоматически собираем список файлов галереи из папки gallery/
$gallery_files = glob('gallery/*.{jpg,jpeg,JPG,JPEG,webp,WEBP}', GLOB_BRACE) ?: [];
sort($gallery_files);

// ── Категории — те же подписи, что раньше использовались в JS для alt-текста ──
$category_labels = [
    'kitchen'  => 'Кухня на заказ',
    'wardrobe' => 'Шкаф или гардеробная на заказ',
    'kids'     => 'Детская комната на заказ',
    'hallway'  => 'Прихожая на заказ',
    'other'    => 'Мебель на заказ',
];

// Разбор имени файла: NNNN-category.ext → category (поддерживает разделители - и _)
function parseGalleryFilename(string $filename): string {
    $base = preg_replace('/\.[^.]+$/', '', $filename);
    if (preg_match('/^\d{4}[-_](.+)$/', $base, $m)) {
        return strtolower($m[1]);
    }
    return 'other';
}

include 'header.php';
?>

<!-- HEADER -->
<div class="gallery-header">
  <h1 class="gallery-title">Наши <em>работы</em></h1>
  <p class="gallery-hint">Нажмите на фото, чтобы рассмотреть подробнее. Отметьте понравившиеся — и мы обсудим, как воплотить это в вашем доме.</p>
</div>

<!-- FILTERS -->
<div class="gallery-filters">
  <button class="filter-btn active" data-filter="all">Все работы</button>
  <button class="filter-btn" data-filter="kitchen">Кухни</button>
  <button class="filter-btn" data-filter="wardrobe">Шкафы и гардеробные</button>
  <button class="filter-btn" data-filter="kids">Детские</button>
  <button class="filter-btn" data-filter="hallway">Прихожие</button>
  <button class="filter-btn" data-filter="other">Другое</button>
</div>

<!-- GRID -->
<!--
  Добавляйте картинки по образцу: NNNN-category.jpg в папку gallery/
  category: kitchen | wardrobe | kids | hallway | other
  Карточки генерируются на сервере (SSR) — видны поисковым роботам без JS.
-->
<div class="gallery-grid" id="galleryGrid">
  <?php foreach ($gallery_files as $file): ?>
    <?php
    $filename = basename($file);
    $category = parseGalleryFilename($filename);
    $alt      = $category_labels[$category] ?? 'Мебель на заказ';
    ?>
    <div class="gallery-item" data-category="<?php echo htmlspecialchars($category); ?>" data-img="gallery/<?php echo htmlspecialchars($filename); ?>">
      <img src="gallery/<?php echo htmlspecialchars($filename); ?>" alt="<?php echo htmlspecialchars($alt); ?>" loading="lazy">
      <div class="gallery-item-overlay">
        <button class="gallery-item-action" type="button">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1L8.8 5.1L13.3 5.5L10 8.4L11 12.8L7 10.4L3 12.8L4 8.4L0.7 5.5L5.2 5.1L7 1Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>
          Отметить
        </button>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div class="gallery-empty" id="galleryEmpty" style="<?php echo $gallery_files ? 'display:none' : ''; ?>">Работ в этой категории пока нет</div>

<!-- INQUIRY BAR -->
<div class="inquiry-bar" id="inquiryBar">
  <div class="inquiry-bar-left">
    <div class="inquiry-count" id="inquiryCount">0</div>
    <div class="inquiry-text">
      <strong id="inquiryLabel">фото отмечено</strong>
      <span>Отправьте нам — обсудим, как это воплотить</span>
    </div>
    <div class="inquiry-thumbs" id="inquiryThumbs"></div>
  </div>
  <div class="inquiry-bar-right">
    <button class="btn-clear" onclick="clearSelection()">Сбросить</button>
    <button class="btn-send" onclick="openModal()">Обсудить с нами</button>
  </div>
</div>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" onclick="closeLightboxOnBg(event)">
  <div class="lightbox-inner">
    <button class="lightbox-close" onclick="closeLightbox()">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none"><path d="M4 4L18 18M18 4L4 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
    <button class="lightbox-nav lightbox-prev" onclick="lightboxNav(-1)">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M11 14L6 9L11 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <button class="lightbox-nav lightbox-next" onclick="lightboxNav(1)">
      <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M7 4L12 9L7 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <div class="lightbox-actions">
      <button class="lightbox-select-btn" id="lightboxSelectBtn" onclick="toggleFromLightbox()">Отметить это фото</button>
      <span class="lightbox-hint">или листайте дальше</span>
    </div>
  </div>
</div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOnBg(event)">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 4L16 16M16 4L4 16" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
    </button>
    <div id="modalForm">
      <div class="modal-title">Хочу что-то подобное</div>
      <p class="modal-sub">Вы отметили вдохновляющие фото — теперь расскажите немного о себе, и мы свяжемся, чтобы обсудить детали.</p>
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
        <textarea id="mComment" placeholder="Расскажите о вашем пространстве, пожеланиях или сроках — любые детали помогут нам подготовиться к разговору"></textarea>
      </div>
      <button id="mSubmitBtn" class="btn-send" style="width:100%;margin-top:0.5rem;" onclick="submitModal()">Отправить</button>
      <p class="modal-note">Нажимая «Отправить», вы соглашаетесь с <a href="soglasie" target="_blank" rel="noopener">обработкой персональных данных</a> для связи по вашему запросу.</p>
    </div>
    <div class="modal-success" id="modalSuccess" style="display:none">
      <div class="modal-success-icon">
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 10L8 14L16 6" stroke="#B8975A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div class="modal-success-title">Заявка отправлена</div>
      <p class="modal-success-text">Мы получили ваши фото и контакт.<br>Перезвоним в течение двух часов в рабочее время.</p>
    </div>
  </div>
</div>

<script>
  // ═══════════════════════════════════════════════════════
  // Карточки фото генерируются на сервере (PHP, см. начало файла) —
  // здесь только навешиваем поведение на уже существующие в DOM элементы.
  // Список файлов читается из gallery/ через PHP glob() при каждой загрузке
  // страницы — добавьте файл в папку, он появится автоматически.
  // ═══════════════════════════════════════════════════════

  const ICON_STAR = `<svg width="14" height="14" viewBox="0 0 14 14" fill="none">
    <path d="M7 1L8.8 5.1L13.3 5.5L10 8.4L11 12.8L7 10.4L3 12.8L4 8.4L0.7 5.5L5.2 5.1L7 1Z"
      stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/></svg>`;
  const ICON_CHECK = `<svg width="14" height="14" viewBox="0 0 14 14" fill="none">
    <path d="M2 7L5.5 10.5L12 3.5"
      stroke="#B8975A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

  // ── BIND CLICK НА КАРТОЧКИ ──
  function bindItemClick(item) {
    // клик на всю карточку (кроме кнопки «Отметить») — открыть лайтбокс
    item.addEventListener('click', (e) => {
      if (!e.target.closest('.gallery-item-action')) openLightbox(item);
    });
    // клик на кнопку «Отметить» — выбор, без открытия лайтбокса
    item.querySelector('.gallery-item-action').addEventListener('click', (e) => {
      e.stopPropagation();
      toggleSelect(item);
    });
  }

  // ── STATE — восстанавливаем избранное из localStorage ──
  const selected = window.favStorage ? window.favStorage.load() : new Set();
  let lightboxIndex = 0;
  let visibleItems = [];

  // Навешиваем обработчики на уже существующие (отрисованные PHP) карточки
  getAllItems().forEach(item => bindItemClick(item));

  // Применить сохранённое состояние визуально после привязки обработчиков
  getAllItems().forEach(item => {
    if (selected.has(item.dataset.img)) {
      item.classList.add('selected');
      item.querySelector('.gallery-item-action').innerHTML = `${ICON_CHECK} Отмечено`;
    }
  });
  updateBar();

  function getAllItems() {
    return Array.from(document.querySelectorAll('.gallery-item'));
  }
  function getVisibleItems() {
    return getAllItems().filter(el => el.style.display !== 'none');
  }

  // ── FILTER ──
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const cat = btn.dataset.filter;
      let count = 0;
      getAllItems().forEach(item => {
        const show = cat === 'all' || item.dataset.category === cat;
        item.style.display = show ? '' : 'none';
        if (show) count++;
      });
      document.getElementById('galleryEmpty').style.display = count === 0 ? 'block' : 'none';
    });
  });

  // ── SELECT ──
  function toggleSelect(item) {
    const img = item.dataset.img;
    const action = item.querySelector('.gallery-item-action');
    if (selected.has(img)) {
      selected.delete(img);
      item.classList.remove('selected');
      action.innerHTML = `${ICON_STAR} Отметить`;
    } else {
      selected.add(img);
      item.classList.add('selected');
      action.innerHTML = `${ICON_CHECK} Отмечено`;
    }
    // Сохранить в localStorage и обновить счётчик в nav
    if (window.favStorage) window.favStorage.save(selected);
    if (window.favStorage) window.favStorage.updateCounter();
    updateBar();
  }

  function updateBar() {
    const bar = document.getElementById('inquiryBar');
    const count = selected.size;
    document.getElementById('inquiryCount').textContent = count;
    // "фото" — несклоняемое существительное, глагол с ним не меняется
    // при любом количестве, поэтому подпись постоянна.
    document.getElementById('inquiryLabel').textContent = 'фото отмечено';
    bar.classList.toggle('visible', count > 0);
    const thumbs = document.getElementById('inquiryThumbs');
    thumbs.innerHTML = '';
    Array.from(selected).slice(0, 4).forEach(src => {
      const img = document.createElement('img');
      img.src = src;
      img.className = 'inquiry-thumb';
      img.onclick = () => openModal();
      thumbs.appendChild(img);
    });
  }

  function clearSelection() {
    selected.clear();
    getAllItems().forEach(item => {
      item.classList.remove('selected');
      item.querySelector('.gallery-item-action').innerHTML = `${ICON_STAR} Отметить`;
    });
    if (window.favStorage) window.favStorage.save(selected);
    if (window.favStorage) window.favStorage.updateCounter();
    updateBar();
  }

  // ── LIGHTBOX ──
  function openLightbox(item) {
    visibleItems = getVisibleItems();
    lightboxIndex = visibleItems.indexOf(item);
    renderLightbox();
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function renderLightbox() {
    const item = visibleItems[lightboxIndex];
    if (!item) return;
    const imgEl = item.querySelector('img');
    document.getElementById('lightboxImg').src = imgEl.src;
    const btn = document.getElementById('lightboxSelectBtn');
    const isSelected = selected.has(item.dataset.img);
    btn.textContent = isSelected ? '✓ Фото отмечено' : 'Отметить это фото';
    btn.classList.toggle('active', isSelected);
  }

  function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeLightboxOnBg(e) {
    if (e.target === document.getElementById('lightbox')) closeLightbox();
  }
  function lightboxNav(dir) {
    lightboxIndex = (lightboxIndex + dir + visibleItems.length) % visibleItems.length;
    renderLightbox();
  }
  function toggleFromLightbox() {
    const item = visibleItems[lightboxIndex];
    if (item) { toggleSelect(item); renderLightbox(); }
  }

  document.addEventListener('keydown', e => {
    if (!document.getElementById('lightbox').classList.contains('open')) return;
    if (e.key === 'ArrowLeft')  lightboxNav(-1);
    if (e.key === 'ArrowRight') lightboxNav(1);
    if (e.key === 'Escape')     closeLightbox();
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleFromLightbox(); }
  });

  // ── Touch-свайп в лайтбоксе ──
  (function() {
    const lb = document.getElementById('lightbox');
    let txStart = 0, tyStart = 0;
    lb.addEventListener('touchstart', e => {
      txStart = e.touches[0].clientX;
      tyStart = e.touches[0].clientY;
    }, { passive: true });
    lb.addEventListener('touchend', e => {
      const dx = txStart - e.changedTouches[0].clientX;
      const dy = tyStart - e.changedTouches[0].clientY;
      if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) > 50) {
        lightboxNav(dx > 0 ? 1 : -1);
      }
    }, { passive: true });
  })();

  // ── MODAL ──
  function openModal() {
    const imgs = document.getElementById('modalSelectedImgs');
    imgs.innerHTML = '';
    selected.forEach(src => {
      const img = document.createElement('img');
      img.src = src;
      img.className = 'modal-selected-img';
      imgs.appendChild(img);
    });
    document.getElementById('modalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
  }
  function closeModalOnBg(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
  }

  // ── Отправка данных на сервер ──
  async function sendForm(data) {
    const response = await fetch('send.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
    if (!response.ok) throw new Error('Server error: ' + response.status);
    return response.json();
  }

  async function submitModal() {
    const name    = document.getElementById('mName').value.trim();
    const phone   = document.getElementById('mPhone').value.trim();
    const comment = document.getElementById('mComment') ? document.getElementById('mComment').value.trim() : '';
    let valid = true;

    if (!name) {
      document.getElementById('mName').style.borderBottomColor = '#C0392B';
      document.getElementById('mNameError').classList.add('visible');
      valid = false;
    } else {
      document.getElementById('mName').style.borderBottomColor = '';
      document.getElementById('mNameError').classList.remove('visible');
    }
    if (!phone) {
      document.getElementById('mPhone').style.borderBottomColor = '#C0392B';
      document.getElementById('mPhoneError').classList.add('visible');
      valid = false;
    } else {
      document.getElementById('mPhone').style.borderBottomColor = '';
      document.getElementById('mPhoneError').classList.remove('visible');
    }
    if (!valid) return;

    const btn = document.getElementById('mSubmitBtn');
    const origText = btn.textContent;
    btn.textContent = 'Отправляем...';
    btn.disabled = true;

    try {
      await sendForm({
        name, phone, comment,
        photos: Array.from(selected),
        source: 'gallery'
      });
      document.getElementById('modalForm').style.display = 'none';
      const s = document.getElementById('modalSuccess');
      s.style.display = 'flex';
      s.style.flexDirection = 'column';
      s.style.alignItems = 'center';
    } catch (e) {
      btn.textContent = 'Ошибка — попробуйте ещё раз';
      btn.disabled = false;
      console.error(e);
    }
  }

  // Phone mask — общая утилита из script.js
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
</script>

<?php include 'footer.php'; ?>

<?php
/*
 * ПРИМЕЧАНИЕ ПО ПЕРЕХОДУ С .html НА .php
 * ────────────────────────────────────────
 * Переименуйте файлы на хостинге:
 *   index.html  → index.php
 *   gallery.html → catalog.php
 *   about.html  → about.php
 *   video.html  → video.php
 *
 * Или добавьте в .htaccess строку:
 *   AddType application/x-httpd-php .html
 * — тогда переименовывать не нужно.
 */
?>
