// ── Утилита форматирования телефона (используется во всех формах) ──
// Очистка состояния ошибки поля выполняется отдельно в каждом месте вызова —
// эта функция отвечает только за маску ввода.
window.formatPhone = function(input) {
  let v = input.value.replace(/\D/g, '');
  if (v.startsWith('7') || v.startsWith('8')) v = v.slice(1);
  let out = '';
  if (v.length > 0) out = '+7 (' + v.slice(0, 3);
  if (v.length >= 4) out += ') ' + v.slice(3, 6);
  if (v.length >= 7) out += '-' + v.slice(6, 8);
  if (v.length >= 9) out += '-' + v.slice(8, 10);
  input.value = out;
};

// ── Scroll reveal ──
const reveals = document.querySelectorAll('.reveal');
if (reveals.length) {
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('visible'); revealObserver.unobserve(e.target); }
    });
  }, { threshold: 0.12 });
  reveals.forEach(el => revealObserver.observe(el));
}

// ── Nav shrink on scroll ──
const nav = document.getElementById('mainNav');
if (nav) {
  window.addEventListener('scroll', () => {
    const isMob = window.innerWidth <= 900;
    nav.style.padding = window.scrollY > 60
      ? (isMob ? '0.7rem 1.5rem' : '0.8rem 4rem')
      : (isMob ? '1rem 1.5rem'  : '1.2rem 4rem');
  });
}

// ── Burger menu ── (функции глобальные, чтобы onclick в header работал)
const burger = document.getElementById('navBurger');
const drawer = document.getElementById('navDrawer');
let drawerOpen = false;

window.openDrawer = function() {
  drawerOpen = true;
  drawer.style.display = 'flex';
  requestAnimationFrame(() => drawer.classList.add('open'));
  burger.classList.add('open');
  document.body.style.overflow = 'hidden';
};
window.closeDrawer = function() {
  drawerOpen = false;
  drawer.classList.remove('open');
  burger.classList.remove('open');
  document.body.style.overflow = '';
  setTimeout(() => { if (!drawerOpen) drawer.style.display = 'none'; }, 300);
};

if (burger && drawer) {
  burger.addEventListener('click', () => drawerOpen ? window.closeDrawer() : window.openDrawer());
  document.querySelectorAll('.drawer-link').forEach(l => l.addEventListener('click', window.closeDrawer));
}

// ── Carousel (только index.php) ──
const carouselEl = document.getElementById('heroCarousel');
if (carouselEl) {
  const heroTitles = [
    'Мебель, которую не нужно <em>переделывать</em>',
    'Пространство, в котором <em>всё на своём месте</em>',
    'Сделано один раз. <em>Сделано правильно.</em>',
    'Ваш интерьер — точно так, <em>как вы задумали</em>',
    'Корпусная мебель без компромиссов и <em>сюрпризов</em>',
    'Спроектируем. Изготовим. <em>Сдадим без замечаний.</em>',
    'Детали решают всё. Мы думаем <em>о каждой из них.</em>',
    'Мы делаем мебель. Вы получаете <em>спокойствие.</em>'
  ];
  let currentSlide = 0;
  const totalSlides = heroTitles.length;
  const track = document.getElementById('carouselTrack');
  const dotsContainer = document.getElementById('carouselDots');
  const heroTitleEl = document.getElementById('heroTitle');
  const heroWrap = heroTitleEl ? heroTitleEl.parentElement : null;
  let autoTimer;

  // Фиксируем высоту враппера по максимальному варианту текста
  if (heroWrap && heroTitleEl) {
    function fixWrapHeight() {
      let maxH = 0;
      const orig = heroTitleEl.innerHTML;
      heroTitleEl.style.position = 'absolute';
      heroTitleEl.style.visibility = 'hidden';
      heroTitleEl.style.width = heroWrap.clientWidth + 'px';
      heroTitles.forEach(t => {
        heroTitleEl.innerHTML = t;
        maxH = Math.max(maxH, heroTitleEl.offsetHeight);
      });
      heroTitleEl.innerHTML = orig;
      heroTitleEl.style.position = '';
      heroTitleEl.style.visibility = '';
      heroTitleEl.style.width = '';
      heroWrap.style.minHeight = (maxH + 4) + 'px';
    }
    // Запускаем после того как анимация fadeUp закончится (0.8s + 0.4s delay)
    setTimeout(fixWrapHeight, 1300);
    window.addEventListener('resize', fixWrapHeight);
  }

  for (let i = 0; i < totalSlides; i++) {
    const dot = document.createElement('button');
    dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
    dot.setAttribute('aria-label', 'Слайд ' + (i + 1));
    dot.addEventListener('click', () => { clearInterval(autoTimer); goToSlide(i); startAuto(); });
    dotsContainer.appendChild(dot);
  }

  function updateTitle(n) {
    heroTitleEl.classList.add('fading');
    setTimeout(() => { heroTitleEl.innerHTML = heroTitles[n]; heroTitleEl.classList.remove('fading'); }, 320);
  }

  function goToSlide(n) {
    currentSlide = (n + totalSlides) % totalSlides;
    track.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';
    document.querySelectorAll('.carousel-dot').forEach((d, i) => d.classList.toggle('active', i === currentSlide));
    updateTitle(currentSlide);
  }

  window.carouselMove = function(dir) { clearInterval(autoTimer); goToSlide(currentSlide + dir); startAuto(); };
  function startAuto() { autoTimer = setInterval(() => goToSlide(currentSlide + 1), 4500); }
  startAuto();
  carouselEl.addEventListener('mouseenter', () => clearInterval(autoTimer));
  carouselEl.addEventListener('mouseleave', startAuto);
}

// ── Форма в секции #contact (только index.php) ──
const fname = document.getElementById('fname');
if (fname) {
  document.getElementById('fname').addEventListener('input', function() {
    if (this.value.trim()) { this.style.borderBottomColor = ''; document.getElementById('fname-error').classList.remove('visible'); }
  });
  document.getElementById('fphone').addEventListener('input', function() {
    window.formatPhone(this);
    if (this.value.trim()) { this.style.borderBottomColor = ''; document.getElementById('fphone-error').classList.remove('visible'); }
  });

  window.submitForm = async function() {
    const name    = document.getElementById('fname').value.trim();
    const phone   = document.getElementById('fphone').value.trim();
    const type    = document.getElementById('ftype').value;
    const comment = document.getElementById('fcomment') ? document.getElementById('fcomment').value.trim() : '';
    let valid = true;

    if (!name)  { document.getElementById('fname').style.borderBottomColor = '#C0392B'; document.getElementById('fname-error').classList.add('visible'); valid = false; }
    else        { document.getElementById('fname').style.borderBottomColor = ''; document.getElementById('fname-error').classList.remove('visible'); }
    if (!phone) { document.getElementById('fphone').style.borderBottomColor = '#C0392B'; document.getElementById('fphone-error').classList.add('visible'); valid = false; }
    else        { document.getElementById('fphone').style.borderBottomColor = ''; document.getElementById('fphone-error').classList.remove('visible'); }
    if (!valid) return;

    const btn = document.getElementById('fsubmit');
    btn.textContent = 'Отправляем...'; btn.disabled = true;
    try {
      const r = await fetch('send.php', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({name,phone,type,comment,source:'main'}) });
      if (!r.ok) throw new Error();
      document.getElementById('contactForm').style.display = 'none';
      if (typeof ymGoal === 'function') ymGoal('form_submit');
      const s = document.getElementById('formSuccess');
      s.style.cssText = 'display:flex;flex-direction:column;align-items:center;';
    } catch(e) { btn.textContent = 'Ошибка — попробуйте ещё раз'; btn.disabled = false; }
  };
}

// Обновить счётчик избранного в nav при загрузке
document.addEventListener('DOMContentLoaded', function() {
  if (window.favStorage) window.favStorage.updateCounter();
});
