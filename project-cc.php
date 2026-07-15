<?php
require_once __DIR__ . '/config.php';
$title       = 'Проект: шкаф с трёхметровыми фасадами · ЖК «Сердце Столицы»';
$description = 'Разбор реализованного проекта Стив Интерьеры: шкаф с цельными фасадами высотой 3 метра. Задача, конструктивные ограничения, решения, чертежи, результат, фото и видео.';
$extra_css   = ['projectstyle.css'];
include 'header.php';
?>

<!-- HERO: что это за проект и почему он необычный -->
<section class="project-hero">
  <div class="project-hero-inner">
    <p class="project-eyebrow">Наши проекты</p>
    <h1 class="project-title">Шкаф с трёхметровыми фасадами</h1>
    <p class="project-sub">ЖК «Сердце Столицы», Москва · спальня</p>
    <p class="project-intro">В этом проекте требовалось изготовить шкаф с цельными трёхметровыми фасадами без доборов и сохранить замысел дизайнера, несмотря на несколько конструктивных ограничений.</p>
    <div class="project-hero-stat">
      <span class="project-hero-num">3,0&nbsp;м</span>
      <span class="project-hero-label">высота цельных полотен фасадов, без добора и швов</span>
    </div>
  </div>
</section>

<!-- ВИДЕО: как это выглядит вживую -->
<section class="project-section project-section-alt">
  <div class="project-inner">
    <h2 class="project-h2">Видео-обзор</h2>
    <video class="project-video" controls preload="metadata" poster="video/0010.jpg" playsinline>
      <source src="video/0010.mp4" type="video/mp4">
      Ваш браузер не поддерживает видео. <a href="video/0010.mp4">Скачать ролик</a>.
    </video>
  </div>
</section>

<!-- ЗАДАЧА: что хотели сделать и почему это было сложно -->
<section class="project-section">
  <div class="project-inner">
    <h2 class="project-h2">Задача</h2>
    <p>Мы гордимся этим проектом: в нём было решено немало творческих и технических задач. Главная в том, что шкаф задуман с цельными трёхметровыми фасадами от пола до потолка. Стандартная плита МДФ для такой высоты не подходит, поэтому взяли материал увеличенного формата.</p>
    <p>Высота была не единственным ограничением:</p>
    <ul class="project-list">
      <li>слева, вплотную к будущему шкафу, уже стояло зеркало с консолью. Распашная дверь при открывании упиралась бы в консоль;</li>
      <li>дизайнер задумал горизонтальную интегрированную ручку во всю ширину фасадов. Такая фрезеровка ослабляет полотно;</li>
      <li>для одежды требовались вешалки особой формы - такие изготавливаются только на заказ, под конкретный проект.</li>
    </ul>
  </div>
</section>

<!-- ПРОЕКТ: как это спроектировали -->
<section class="project-section project-section-alt">
  <div class="project-inner">
    <h2 class="project-h2">Проект</h2>
    <p>Перед изготовлением была разработана конструкция шкафа и внутреннее наполнение. На чертежах показано расположение секций, фасадов и внутренних элементов.</p>
    <div class="project-plans">
      <figure class="project-plan">
        <img src="projects/cc-plan-1.png" width="937" height="746" alt="Чертёж фасадов шкафа" loading="lazy">
        <figcaption><strong>Чертёж фасадов.</strong> Интегрированная ручка по всей длине фасадов.</figcaption>
      </figure>
      <figure class="project-plan">
        <img src="projects/cc-plan-2.png" width="972" height="782" alt="Чертёж наполнения шкафа" loading="lazy">
        <figcaption><strong>Чертёж наполнения.</strong> Организация внутренних секций.</figcaption>
      </figure>
    </div>
  </div>
</section>

<!-- РЕШЕНИЯ: какие решения приняли -->
<section class="project-section">
  <div class="project-inner">
    <h2 class="project-h2">Решения</h2>
    <div class="project-cards">
      <div class="project-card">
        <h3>Увеличенная высота фасадов</h3>
        <p>Плита МДФ толщиной 22&nbsp;мм увеличенной высоты - 3&nbsp;660&nbsp;мм. Три метра двери без единого стыка.</p>
      </div>
      <div class="project-card">
        <h3>Конструкция дверей у консоли</h3>
        <p>Место деления двери рассчитано так, чтобы к нему приходил бок консоли. Двери открываются свободно, а стык читается как проектный шов.</p>
      </div>
      <div class="project-card">
        <h3>Усиление фасадов</h3>
        <p>В каждом фасаде два выпрямителя; петли расположены так, чтобы держать зону фрезеровки. Полотно осталось прочным.</p>
      </div>
      <div class="project-card">
        <h3>Индивидуальное наполнение</h3>
        <p>Штанги изготовлены по нашим чертежам: под размеры секций и вещи владелицы.</p>
      </div>
      <div class="project-card">
        <h3>Бережная доставка</h3>
        <p>Трёхметровые полотна в эмали ехали на объект в индивидуальной обрешётке.</p>
      </div>
    </div>
  </div>
</section>

<!-- РЕЗУЛЬТАТ: что получилось в итоге -->
<section class="project-section project-section-alt">
  <div class="project-inner">
    <h2 class="project-h2">Результат</h2>
    <ul class="project-list">
      <li>цельные фасады высотой три метра, без доборов и горизонтальных швов;</li>
      <li>замысел дизайнера сохранён полностью: интегрированная ручка и чистые линии;</li>
      <li>двери открываются без помех, зеркало с консолью остались на своём месте;</li>
      <li>внутреннее наполнение выполнено под вещи и задачи владелицы.</li>
    </ul>
  </div>
</section>

<!-- ФОТО: как выглядит готовый проект -->
<section class="project-section">
  <div class="project-inner">
    <h2 class="project-h2">До и после</h2>
    <p>Ниже - фотографии готового проекта после установки.</p>
    <div class="project-gallery">
      <div class="project-tile">
        <img src="projects/cc-before.jpg" width="963" height="1400" alt="Спальня до установки шкафа" loading="lazy">
        <span class="project-tag">до</span>
      </div>
      <?php for ($i = 1; $i <= 7; $i++): $n = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
      <img src="projects/cc-<?php echo $n; ?>.jpg" width="1200" height="1600" alt="Готовый шкаф с трёхметровыми фасадами, фото <?php echo $i; ?>" loading="lazy">
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- ХАРАКТЕРИСТИКИ: ключевые параметры за несколько секунд -->
<section class="project-section project-section-alt">
  <div class="project-inner">
    <h2 class="project-h2">Основные характеристики</h2>
    <dl class="project-facts">
      <div><dt>Высота фасадов</dt><dd>3&nbsp;м</dd></div>
      <div><dt>Материал фасадов</dt><dd>МДФ 22&nbsp;мм, матовая эмаль</dd></div>
      <div><dt>Фурнитура</dt><dd>Blum, Hettich</dd></div>
      <div><dt>Габариты</dt><dd>1&nbsp;900&nbsp;×&nbsp;2&nbsp;900&nbsp;×&nbsp;600&nbsp;мм и 960&nbsp;×&nbsp;2&nbsp;900&nbsp;×&nbsp;500&nbsp;мм</dd></div>
      <div><dt>Срок проекта</dt><dd>6&nbsp;недель</dd></div>
      <div><dt>Тип проекта</dt><dd>шкаф по индивидуальному проекту</dd></div>
    </dl>
  </div>
</section>

<!-- МАТЕРИАЛ: подтверждение деталями -->
<section class="project-section">
  <div class="project-inner">
    <h2 class="project-h2">Материалы</h2>
    <ul class="project-list">
      <li>Корпус: ЛДСП Egger, декор «Лён антрацит».</li>
      <li>Фасады: МДФ 22&nbsp;мм.</li>
      <li>Отделка: матовая эмаль NCS&nbsp;S&nbsp;5500-N.</li>
    </ul>
    <h2 class="project-h2 project-h2-second">Фурнитура и наполнение</h2>
    <ul class="project-list">
      <li>Направляющие: Hettich Quadro, скрытый монтаж.</li>
      <li>Петли: Blum.</li>
      <li>Выдвижная брючница Vita Menage Confort.</li>
      <li>Штанги под одежду индивидуального изготовления.</li>
    </ul>
  </div>
</section>

<!-- CTA: что делать дальше -->
<section class="project-cta">
  <div class="project-inner">
    <h2 class="project-cta-title">Есть похожий проект?</h2>
    <p class="project-cta-text">Пришлите размеры или дизайн-проект. Предложим конструкцию, рассчитаем стоимость и подскажем варианты изготовления.</p>
    <button class="btn-primary project-cta-btn" onclick="openContactPopup()">Рассчитать стоимость проекта</button>
  </div>
</section>

<script>
  // Заявки из попапа на этой странице помечаются как «Страница проекта»,
  // а комментарий предзаполняется (см. openContactPopup в footer.php)
  window.popupSource = 'project-cc';
  window.popupComment = 'Запрос цены шкафа Сердце Столицы';
</script>

<?php include 'footer.php'; ?>
