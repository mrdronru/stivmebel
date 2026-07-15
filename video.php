<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/markdown-helpers.php';
$page        = 'video';
$title       = 'Видео наших работ: монтаж кухонь и шкафов';
$description = 'Видео о процессе создания корпусной мебели: монтаж кухонь, шкафов, гардеробных. Смотрите, как мы работаем — от замера до финальной приёмки.';
$extra_css   = ['videostyle.css'];
$canonical_path = 'video'; // страница делит имя с папкой video/ и доступна
                           // и как /video, и как /video/ — canonical всегда без слеша

// Автоматически собираем список видео из папки video/.
// Для каждого NNNN.mp4 ищем одноимённый NNNN.md с описанием (title + текст).
// Если .md нет — видео всё равно показывается, просто без подписи.
$video_files = glob(__DIR__ . '/video/*.mp4') ?: [];
sort($video_files); // сортировка по имени файла = по номеру NNNN

$videos = [];
foreach ($video_files as $file) {
    $id = basename($file, '.mp4'); // "0001"

    $videoTitle = '';
    $videoDesc  = '';
    $mdPath = __DIR__ . '/video/' . $id . '.md';
    if (file_exists($mdPath)) {
        $parsed = parseFrontmatter(file_get_contents($mdPath));
        $videoTitle = $parsed['meta']['title'] ?? '';
        $videoDesc  = trim(preg_replace('/<[^>]+>/', '', parseMarkdown($parsed['body'])));
    }

    $videos[] = [
        'id'    => $id,
        'title' => $videoTitle,
        'desc'  => $videoDesc,
    ];
}
include 'header.php';
?>

<h1 class="sr-only">Видео наших работ: монтаж кухонь, шкафов и гардеробных</h1>

<!-- FEED -->
<div class="video-feed" id="videoFeed">
  <?php foreach ($videos as $v): ?>
    <?php
    $src      = 'video/' . $v['id'] . '.mp4';
    $poster   = 'video/' . $v['id'] . '.jpg';
    $hasMeta  = $v['title'] !== '' || $v['desc'] !== '';
    ?>
    <div class="video-item" data-src="<?php echo htmlspecialchars($src); ?>">
      <img class="video-poster lazy-poster" width="1080" height="1920" data-src="<?php echo htmlspecialchars($poster); ?>" alt="<?php echo htmlspecialchars($v['title']); ?>">
      <noscript><img class="video-poster" width="1080" height="1920" src="<?php echo htmlspecialchars($poster); ?>" alt="<?php echo htmlspecialchars($v['title']); ?>"></noscript>
      <video class="video-player" preload="none" playsinline muted loop></video>
      <div class="video-gradient"></div>
      <?php if ($hasMeta): ?>
      <div class="video-meta">
        <?php if ($v['title'] !== ''): ?><div class="video-title"><?php echo htmlspecialchars($v['title']); ?></div><?php endif; ?>
        <?php if ($v['desc'] !== ''): ?><div class="video-desc"><?php echo htmlspecialchars($v['desc']); ?></div><?php endif; ?>
      </div>
      <?php endif; ?>
      <div class="muted-badge" id="muted-<?php echo htmlspecialchars($v['id']); ?>">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 6h3l4-3v10l-4-3H2V6z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M13 5l-4 6M9 5l4 6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
        Без звука
      </div>
      <div class="video-controls">
        <button class="ctrl-btn btn-playpause" title="Пауза / Воспроизведение"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M6 4l8 5-8 5V4z" fill="currentColor"/></svg></button>
        <button class="ctrl-btn btn-mute" title="Звук"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 6h3l4-3v10l-4-3H2V6z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M13 5l-4 6M9 5l4 6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg></button>
      </div>
      <button class="video-play-btn" aria-label="Воспроизвести">
        <div class="video-play-icon"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M6 4l8 5-8 5V4z" fill="currentColor"/></svg></div>
      </button>
      <div class="video-progress"><div class="video-progress-bar"></div></div>
    </div>
  <?php endforeach; ?>
</div>
<script>
// ═══════════════════════════════════════════════════════
// Карточки видео генерируются на сервере (PHP, см. начало файла) —
// здесь только навешиваем поведение на уже существующие в DOM элементы.
// Список читается из video/ через PHP glob() при каждой загрузке страницы.
// Чтобы добавить видео: положите NNNN.mp4 + NNNN.jpg (обложка) в video/.
// Чтобы добавить подпись: создайте NNNN.md рядом, формат:
//   ---
//   title: Название видео
//   ---
//   Текст описания.
// Без NNNN.md видео всё равно покажется, просто без подписи.
// ═══════════════════════════════════════════════════════

// ─────────────────────────────────────────
// SVG-иконки
// ─────────────────────────────────────────
const ICON_PLAY = `<svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M6 4l8 5-8 5V4z" fill="currentColor"/></svg>`;
const ICON_PAUSE = `<svg width="18" height="18" viewBox="0 0 18 18" fill="none"><rect x="4" y="3" width="3.5" height="12" rx="1" fill="currentColor"/><rect x="10.5" y="3" width="3.5" height="12" rx="1" fill="currentColor"/></svg>`;
const ICON_MUTE = `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 6h3l4-3v10l-4-3H2V6z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M13 5l-4 6M9 5l4 6" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>`;
const ICON_UNMUTE = `<svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 6h3l4-3v10l-4-3H2V6z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/><path d="M11 6.5c.8.5 1.3 1.4 1.3 2.5s-.5 2-1.3 2.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>`;

// ─────────────────────────────────────────
// Привязка поведения к уже отрисованным карточкам
// ─────────────────────────────────────────
const feed = document.getElementById('videoFeed');
let globalMuted = true; // стартуем без звука (autoplay требует muted)

document.querySelectorAll('.video-item').forEach(item => bindControls(item));

// ─────────────────────────────────────────
// Ленивая загрузка обложек
// ─────────────────────────────────────────
const posterObserver = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (!e.isIntersecting) return;
    const img = e.target;
    img.src = img.dataset.src;
    img.removeAttribute('data-src');
    posterObserver.unobserve(img);
  });
}, { rootMargin: '400px 0px', threshold: 0 });

document.querySelectorAll('.lazy-poster').forEach(img => posterObserver.observe(img));

// ─────────────────────────────────────────
// Управление воспроизведением
// ─────────────────────────────────────────
function getVideo(item)    { return item.querySelector('.video-player'); }
function getPoster(item)   { return item.querySelector('.video-poster'); }
function getProgress(item) { return item.querySelector('.video-progress-bar'); }
function getPlayBtn(item)  { return item.querySelector('.btn-playpause'); }

function loadVideo(item) {
  const video = getVideo(item);
  if (!video.src) {
    video.src = item.dataset.src;
    video.load();
  }
}

function playItem(item) {
  loadVideo(item);
  const video = getVideo(item);
  video.muted = globalMuted;
  updateMutedBadge(item);

  video.play().then(() => {
    item.classList.add('playing');
    getPoster(item).classList.add('hidden');
    getPlayBtn(item).querySelector('.video-play-icon').innerHTML = ICON_PAUSE;
    getPlayBtn(item).querySelector('.ctrl-btn.btn-playpause') && (item.querySelector('.btn-playpause').innerHTML = ICON_PAUSE);
    item.querySelector('.btn-playpause').innerHTML = ICON_PAUSE;
  }).catch(() => {});
}

function pauseItem(item) {
  const video = getVideo(item);
  video.pause();
  item.classList.remove('playing');
  item.querySelector('.video-play-icon').innerHTML = ICON_PLAY;
  item.querySelector('.btn-playpause').innerHTML = ICON_PLAY;
}

function updateMutedBadge(item) {
  const badge = item.querySelector('.muted-badge');
  if (badge) badge.classList.toggle('visible', globalMuted);
  const btn = item.querySelector('.btn-mute');
  if (btn) btn.innerHTML = globalMuted ? ICON_MUTE : ICON_UNMUTE;
}

// Прогресс
document.querySelectorAll('.video-item').forEach(item => {
  getVideo(item).addEventListener('timeupdate', () => {
    const v = getVideo(item);
    if (!v.duration) return;
    getProgress(item).style.width = (v.currentTime / v.duration * 100) + '%';
  });
});

// ─────────────────────────────────────────
// Кнопки управления
// ─────────────────────────────────────────
function bindControls(item) {
  const video = getVideo(item);

  // Центральная кнопка play
  item.querySelector('.video-play-btn').addEventListener('click', () => {
    video.paused ? playItem(item) : pauseItem(item);
  });

  // Пауза/плей
  item.querySelector('.btn-playpause').addEventListener('click', (e) => {
    e.stopPropagation();
    video.paused ? playItem(item) : pauseItem(item);
  });

  // Звук
  item.querySelector('.btn-mute').addEventListener('click', (e) => {
    e.stopPropagation();
    globalMuted = !globalMuted;
    document.querySelectorAll('.video-item').forEach(it => {
      getVideo(it).muted = globalMuted;
      updateMutedBadge(it);
    });
  });


  // ── Прогресс-бар: перемотка по клику и перетаскиванию ──
  const progressWrap = item.querySelector('.video-progress');
  const progressBar  = item.querySelector('.video-progress-bar');

  function seekTo(clientX) {
    if (!video.duration) return;
    const rect = progressWrap.getBoundingClientRect();
    const ratio = Math.min(Math.max((clientX - rect.left) / rect.width, 0), 1);
    video.currentTime = ratio * video.duration;
    progressBar.style.width = (ratio * 100) + '%';
  }

  let dragging = false;

  progressWrap.addEventListener('mousedown', (e) => {
    e.stopPropagation();
    dragging = true;
    seekTo(e.clientX);
  });
  document.addEventListener('mousemove', (e) => {
    if (!dragging) return;
    seekTo(e.clientX);
  });
  document.addEventListener('mouseup', () => { dragging = false; });

  // Тач на прогресс-баре
  progressWrap.addEventListener('touchstart', (e) => {
    e.stopPropagation();
    seekTo(e.touches[0].clientX);
  }, { passive: true });
  progressWrap.addEventListener('touchmove', (e) => {
    e.stopPropagation();
    seekTo(e.touches[0].clientX);
  }, { passive: true });
}

// ─────────────────────────────────────────
// IntersectionObserver — автоплей при фокусе
// ─────────────────────────────────────────
let currentItem = null;

const videoObserver = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.intersectionRatio >= 0.75) {
      if (currentItem && currentItem !== e.target) pauseItem(currentItem);
      currentItem = e.target;
      playItem(currentItem);
    } else if (e.intersectionRatio < 0.4 && !e.target.querySelector('.video-player').paused) {
      pauseItem(e.target);
    }
  });
}, {
  root: feed,
  threshold: [0.4, 0.75],
});

document.querySelectorAll('.video-item').forEach(item => videoObserver.observe(item));

// ─────────────────────────────────────────
// Колёсико / трекпад — строго по одному
// ─────────────────────────────────────────
const items = Array.from(document.querySelectorAll('.video-item'));
let activeIndex = 0;
let scrolling   = false;
let deltaAcc    = 0;         // накопленная дельта
const THRESHOLD = 80;        // сколько нужно накопить для переключения

function goTo(idx) {
  if (idx < 0 || idx >= items.length || scrolling) return;
  scrolling  = true;
  deltaAcc   = 0;
  activeIndex = idx;

  // Мгновенно выровнять через scrollTop — никакого smooth у контейнера
  const targetTop = items[idx].offsetTop;
  feed.scrollTo({ top: targetTop, behavior: 'instant' });

  // Разблокировать через RAF + небольшой запас
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      setTimeout(() => { scrolling = false; }, 400);
    });
  });
}

feed.addEventListener('wheel', (e) => {
  e.preventDefault();
  e.stopImmediatePropagation();

  if (scrolling) { deltaAcc = 0; return; }

  deltaAcc += e.deltaY;

  if (Math.abs(deltaAcc) >= THRESHOLD) {
    goTo(activeIndex + (deltaAcc > 0 ? 1 : -1));
  }
}, { passive: false, capture: true });

// Свайп тачскрин
let touchStartY = 0;
let touchMoved  = false;
feed.addEventListener('touchstart', (e) => {
  touchStartY = e.touches[0].clientY;
  touchMoved  = false;
}, { passive: true });
feed.addEventListener('touchmove', () => { touchMoved = true; }, { passive: true });
feed.addEventListener('touchend', (e) => {
  if (!touchMoved) return;
  const diff = touchStartY - e.changedTouches[0].clientY;
  if (Math.abs(diff) > 60) goTo(activeIndex + (diff > 0 ? 1 : -1));
}, { passive: true });

// ─────────────────────────────────────────
// Пауза при уходе со страницы
// ─────────────────────────────────────────
document.addEventListener('visibilitychange', () => {
  if (document.hidden && currentItem) pauseItem(currentItem);
  else if (!document.hidden && currentItem) playItem(currentItem);
});

</script>

<script>
// На странице видео body.overflow уже hidden — попап блокирует прокрутку ленты
(function() {
  var _openOrig  = window.openContactPopup;
  var _closeOrig = window.closeContactPopup;
  window.openContactPopup = function() {
    if (_openOrig) _openOrig();
    var feed = document.getElementById('videoFeed');
    if (feed) feed.style.overflow = 'hidden';
  };
  window.closeContactPopup = function() {
    if (_closeOrig) _closeOrig();
    var feed = document.getElementById('videoFeed');
    if (feed) feed.style.overflowY = 'scroll';
  };
})();
</script>
<?php include 'footer.php'; ?>