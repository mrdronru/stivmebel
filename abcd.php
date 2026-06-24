<?php
require_once __DIR__ . '/config.php';
$page        = 'abc';
$title       = 'Азбука мебельщика';
$description = 'Простым языком о сложных терминах: ЛДСП, МДФ, Blum, Hettich, компакт-плита, HPL, фурнитура и всё что вы слышите от мебельщиков.';
$extra_css   = ['abcstyle.css'];
include 'header.php';

// Загружаем индекс терминов
$indexFile = __DIR__ . '/abc/index.json';
$terms = [];
if (file_exists($indexFile)) {
    $terms = json_decode(file_get_contents($indexFile), true) ?? [];
}
?>

<!-- HEADER -->
<div class="abc-header">
  <div class="abc-header-left">
    <p class="section-label">Справочник</p>
    <h1 class="abc-title">Азбука <em>мебельщика</em></h1>
    <p class="abc-lead">Все термины которые вы слышите от мастеров — простым языком, без воды.</p>
  </div>
  <div class="abc-search-wrap">
    <input
      type="search"
      id="abcSearch"
      class="abc-search"
      placeholder="Найти термин..."
      autocomplete="off"
      aria-label="Поиск по терминам">
    <svg class="abc-search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
      <circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.3"/>
      <path d="M10.5 10.5L14 14" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
    </svg>
  </div>
</div>

<?php if (empty($terms)): ?>
<div style="padding:4rem;text-align:center;color:var(--ink-60);">
  <p>Термины ещё не добавлены. Запустите генерацию страниц.</p>
</div>
<?php else: ?>

<!-- АЛФАВИТНЫЕ ЯКОРЯ -->
<div class="abc-letters" id="abcLetters" aria-label="Алфавитная навигация"></div>

<!-- СПИСОК ТЕРМИНОВ -->
<div class="abc-list" id="abcList">
<?php
// Группируем по букве
$byLetter = [];
foreach ($terms as $term) {
    $letter = $term['letter'] ?? '?';
    $byLetter[$letter][] = $term;
}
ksort($byLetter);
foreach ($byLetter as $letter => $group):
?>
  <div class="abc-group" data-letter="<?php echo htmlspecialchars($letter); ?>">
    <div class="abc-group-letter" id="letter-<?php echo htmlspecialchars($letter); ?>"><?php echo htmlspecialchars($letter); ?></div>
    <div class="abc-group-items">
      <?php foreach ($group as $term): ?>
      <a href="abc/<?php echo htmlspecialchars($term['slug']); ?>.html" class="abc-item">
        <span class="abc-item-title"><?php echo htmlspecialchars($term['title']); ?></span>
        <span class="abc-item-short"><?php echo htmlspecialchars($term['short']); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
<?php endforeach; ?>
</div>

<!-- ПУСТОЙ РЕЗУЛЬТАТ ПОИСКА -->
<div class="abc-no-results" id="abcNoResults" style="display:none">
  <p>Термин не найден. Если хотите — <button onclick="openContactPopup()" class="abc-no-results-link">напишите нам</button>, добавим.</p>
</div>

<?php endif; ?>

<script>
(function() {
  const search   = document.getElementById('abcSearch');
  const list     = document.getElementById('abcList');
  const noResult = document.getElementById('abcNoResults');
  const letters  = document.getElementById('abcLetters');
  if (!search || !list) return;

  // ── Алфавитная навигация ──
  const groups = list.querySelectorAll('.abc-group');
  const usedLetters = new Set();
  groups.forEach(g => usedLetters.add(g.dataset.letter));

  usedLetters.forEach(letter => {
    const btn = document.createElement('a');
    btn.href = '#letter-' + letter;
    btn.className = 'abc-letter-btn';
    btn.textContent = letter;
    btn.addEventListener('click', e => {
      e.preventDefault();
      document.getElementById('letter-' + letter)
        ?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
    letters.appendChild(btn);
  });

  // ── Поиск ──
  search.addEventListener('input', function() {
    const q = this.value.trim().toLowerCase();
    let visible = 0;

    groups.forEach(group => {
      const items = group.querySelectorAll('.abc-item');
      let groupVisible = 0;
      items.forEach(item => {
        const text = item.textContent.toLowerCase();
        const show = !q || text.includes(q);
        item.style.display = show ? '' : 'none';
        if (show) groupVisible++;
      });
      group.style.display = groupVisible > 0 ? '' : 'none';
      visible += groupVisible;
    });

    letters.style.display = q ? 'none' : '';
    noResult.style.display = visible === 0 ? 'block' : 'none';
  });
})();
</script>

<?php include 'footer.php'; ?>
