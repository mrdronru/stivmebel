const pptxgen = require("pptxgenjs");

const p = new pptxgen();
p.layout = "LAYOUT_WIDE"; // 13.33 x 7.5
p.theme = { headFontFace: "Inter", bodyFontFace: "Inter" };

// Palette
const BLACK = "141414";
const GREY  = "6E6B64";
const GREY2 = "9B978F";
const LIGHT = "F6F5F2";
const HAIR  = "E4E2DC";
const OLIVE = "5A5F46";
const WHITE = "FFFFFF";

const F = "Inter";
const W = 13.333, H = 7.5;
const M = 0.75; // margin

const wordmark = (s, opts = {}) =>
  s.addText("СТИВ ИНТЕРЬЕРЫ", Object.assign({
    x: M, y: 0.55, w: 4, h: 0.3, fontFace: F, fontSize: 11, bold: true,
    color: BLACK, charSpacing: 4, margin: 0, valign: "middle",
  }, opts));

const sectionTitle = (s, txt, sub) => {
  s.addText(txt, { x: M, y: 0.62, w: W - 2 * M, h: 0.75, fontFace: F, fontSize: 34,
    bold: true, color: BLACK, margin: 0, valign: "top", charSpacing: -0.4 });
  if (sub) s.addText(sub, { x: M, y: 1.42, w: 9.6, h: 0.55, fontFace: F, fontSize: 15,
    color: GREY, margin: 0, valign: "top", lineSpacingMultiple: 1.25 });
};

// ============================================================ S1 — Cover
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  s.addImage({ path: "assets/cover.jpg", x: 5.333, y: 0, w: 8.0, h: 7.5,
    sizing: { type: "cover", w: 8.0, h: 7.5 } });

  wordmark(s);

  s.addText([
    { text: "Производственный", options: { breakLine: true } },
    { text: "партнёр", options: { breakLine: true } },
    { text: "для дизайнеров", options: { breakLine: true } },
    { text: "интерьера", options: {} },
  ], { x: M, y: 1.95, w: 4.4, h: 2.6, fontFace: F, fontSize: 31, bold: true,
    color: BLACK, margin: 0, valign: "top", lineSpacingMultiple: 1.12, charSpacing: -0.4 });

  s.addText("Корпусная, встроенная и нестандартная мебель по дизайн-проектам.",
    { x: M, y: 4.62, w: 3.9, h: 0.95, fontFace: F, fontSize: 15, color: GREY,
      margin: 0, valign: "top", lineSpacingMultiple: 1.35 });

  s.addText("Реализуем проекты так,\nкак они задуманы.",
    { x: M, y: 5.95, w: 4.2, h: 0.95, fontFace: F, fontSize: 19, bold: true,
      color: OLIVE, margin: 0, valign: "bottom", lineSpacingMultiple: 1.2 });
}

// ============================================================ S2 — Почему
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  sectionTitle(s, "Почему дизайнеры работают с нами",
    "Понимаем: мебельный подрядчик становится частью вашей репутации перед клиентом.");

  const cards = [
    ["01", "Работаем по договору", "Предсказуемые сроки.\nПисьменные гарантии."],
    ["02", "Работаем по вашему процессу", "Не заставляем менять привычную схему работы."],
    ["03", "Нестандартные решения", "Размеры. Материалы.\nКонструкции."],
    ["04", "Один ответственный", "Берём на себя координацию производства и смежных исполнителей."],
  ];
  const cw = 5.79, ch = 2.18, gx = 0.32, gy = 0.32, x0 = M, y0 = 2.45;
  cards.forEach((c, i) => {
    const x = x0 + (i % 2) * (cw + gx);
    const y = y0 + Math.floor(i / 2) * (ch + gy);
    s.addShape("roundRect", { x, y, w: cw, h: ch, fill: { color: LIGHT },
      line: { type: "none" }, rectRadius: 0.07 });
    s.addText(c[0], { x: x + 0.42, y: y + 0.36, w: 1, h: 0.28, fontFace: F,
      fontSize: 11, bold: true, color: OLIVE, charSpacing: 2, margin: 0 });
    s.addText(c[1], { x: x + 0.42, y: y + 0.76, w: cw - 0.84, h: 0.42, fontFace: F,
      fontSize: 17.5, bold: true, color: BLACK, margin: 0, valign: "top", charSpacing: -0.2 });
    s.addText(c[2], { x: x + 0.42, y: y + 1.26, w: cw - 1.0, h: 0.75, fontFace: F,
      fontSize: 13, color: GREY, margin: 0, valign: "top", lineSpacingMultiple: 1.3 });
  });
}

// ============================================================ S3 — Что можем реализовать
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  sectionTitle(s, "Что можем реализовать",
    "Изготавливаем мебель по индивидуальным проектам — от стандартных изделий до сложных нестандартных решений.");

  const cols = [
    ["Корпуса", ["ЛДСП", "МДФ", "Шпон"]],
    ["Фасады", ["ЛДСП", "ПВХ", "Эмаль", "Пластик", "Шпон", "Массив"]],
    ["Дополнительно", ["Металл", "Стекло", "Подсветка"]],
    ["Производство", ["Собственный покрасочный цех", "Собственный сборочный участок", "Партнёры по ЧПУ-обработке"]],
  ];
  const cw = 2.83, gx = 0.2, x0 = M, y0 = 2.6;
  cols.forEach((c, i) => {
    const x = x0 + i * (cw + gx);
    s.addText(c[0].toUpperCase(), { x, y: y0, w: cw, h: 0.3, fontFace: F, fontSize: 11,
      bold: true, color: OLIVE, charSpacing: 2, margin: 0 });
    s.addShape("line", { x, y: y0 + 0.52, w: cw - 0.35, h: 0,
      line: { color: HAIR, width: 1 } });
    const items = c[1].map((t, j) => ({ text: t,
      options: { breakLine: true, paraSpaceAfter: 10 } }));
    s.addText(items, { x, y: y0 + 0.78, w: cw - 0.2, h: 3.6, fontFace: F, fontSize: 15,
      color: BLACK, margin: 0, valign: "top", lineSpacingMultiple: 1.15 });
  });
}

// ============================================================ S4–6 — Кейсы
const caseSlide = (num, photo, caption) => {
  const s = p.addSlide();
  s.background = { color: WHITE };

  // Photo right 60%, caption below
  s.addImage({ path: photo, x: 5.333, y: 0, w: 8.0, h: 6.62,
    sizing: { type: "cover", w: 8.0, h: 6.62 } });
  s.addText(caption, { x: 5.55, y: 6.82, w: 7.55, h: 0.4, fontFace: F, fontSize: 11,
    color: GREY, margin: 0, valign: "top", lineSpacingMultiple: 1.25 });

  // Left card
  const x = M;
  s.addText("КЕЙС " + num, { x, y: 0.75, w: 2, h: 0.28, fontFace: F, fontSize: 11,
    bold: true, color: OLIVE, charSpacing: 2, margin: 0 });
  s.addText("Название объекта", { x, y: 1.18, w: 4.1, h: 0.5, fontFace: F, fontSize: 23,
    bold: true, color: BLACK, margin: 0, charSpacing: -0.3 });
  s.addText("Москва  ·  — м²", { x, y: 1.72, w: 4.1, h: 0.3, fontFace: F, fontSize: 13,
    color: GREY, margin: 0 });

  const block = (label, body, y, h) => {
    s.addText(label, { x, y, w: 4.1, h: 0.26, fontFace: F, fontSize: 10.5, bold: true,
      color: GREY2, charSpacing: 2, margin: 0 });
    s.addText(body, { x, y: y + 0.3, w: 4.1, h, fontFace: F, fontSize: 14.5,
      color: BLACK, margin: 0, valign: "top", lineSpacingMultiple: 1.3 });
  };
  block("ИЗГОТОВИЛИ", "Кухня  ·  Гардеробная\nТВ-зона  ·  Прихожая", 2.5, 0.85);
  block("МАТЕРИАЛЫ", "Шпон  ·  Эмаль  ·  Металл", 3.85, 0.4);
  block("СРОК ИЗГОТОВЛЕНИЯ", "— недель", 4.85, 0.4);
  block("МОНТАЖ", "— дней", 5.85, 0.4);
};

caseSlide("01", "assets/case1.jpg", "Кухня  —  краткая особенность проекта (плейсхолдер)");
caseSlide("02", "assets/case2.jpg", "Кухня  —  краткая особенность проекта (плейсхолдер)");
caseSlide("03", "assets/case3.jpg", "Детская  —  краткая особенность проекта (плейсхолдер)");

// ============================================================ S7 — Процесс
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  sectionTitle(s, "Как строится работа");

  const steps = ["Проект", "Расчёт", "Замеры", "Спецификация", "Производство", "Монтаж", "Сдача"];
  const x0 = 1.0, x1 = W - 1.0, y = 4.0;
  s.addShape("line", { x: x0, y, w: x1 - x0, h: 0, line: { color: HAIR, width: 1.25 } });
  const step = (x1 - x0) / (steps.length - 1);
  steps.forEach((t, i) => {
    const cx = x0 + i * step;
    s.addShape("ellipse", { x: cx - 0.055, y: y - 0.055, w: 0.11, h: 0.11,
      fill: { color: OLIVE }, line: { type: "none" } });
    s.addText(String(i + 1).padStart(2, "0"), { x: cx - 0.6, y: y - 0.75, w: 1.2, h: 0.3,
      fontFace: F, fontSize: 10.5, color: GREY2, align: "center", margin: 0, charSpacing: 1.5 });
    s.addText(t, { x: cx - 0.95, y: y + 0.28, w: 1.9, h: 0.35, fontFace: F, fontSize: 13.5,
      color: BLACK, align: "center", margin: 0 });
  });
}

// ============================================================ S8 — Отзывы
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  sectionTitle(s, "Что говорят наши клиенты");

  const quotes = [
    "Изготовление и сборка мебели прошла в срок. Я рада, что заказала именно у вас.",
    "От замера до установки фирма работала слаженно и максимально комфортно для клиента.",
    "Профессионализм и умение слышать клиента, что сейчас редкость.",
  ];
  const cw = 3.86, gx = 0.32, y0 = 2.5, ch = 3.9, x0 = M;
  quotes.forEach((q, i) => {
    const x = x0 + i * (cw + gx);
    s.addShape("roundRect", { x, y: y0, w: cw, h: ch, fill: { color: LIGHT },
      line: { type: "none" }, rectRadius: 0.07 });
    s.addText("“", { x: x + 0.4, y: y0 + 0.32, w: 1, h: 0.7, fontFace: "Georgia",
      fontSize: 52, color: OLIVE, margin: 0, valign: "top" });
    s.addText(q, { x: x + 0.42, y: y0 + 1.15, w: cw - 0.84, h: ch - 1.5, fontFace: F,
      fontSize: 15.5, color: BLACK, margin: 0, valign: "top", lineSpacingMultiple: 1.45 });
  });
}

// ============================================================ S9 — Команда
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  sectionTitle(s, "Команда");

  const people = [
    ["assets/team_alexander.jpg", "Александр",
     "Работа с дизайнерами и сопровождение проектов.", "alex@stivinteriors.ru"],
    ["assets/team_stanislav.jpg", "Станислав",
     "Производство и реализация проектов.", "stiv@stivinteriors.ru"],
  ];
  const colw = 3.7, gap = 1.5;
  const x0 = (W - (2 * colw + gap)) / 2;
  people.forEach((pe, i) => {
    const x = x0 + i * (colw + gap);
    const ps = 2.55;
    s.addImage({ path: pe[0], x: x + (colw - ps) / 2, y: 2.25, w: ps, h: ps,
      rounding: false, sizing: { type: "cover", w: ps, h: ps } });
    s.addText(pe[1], { x, y: 5.05, w: colw, h: 0.42, fontFace: F, fontSize: 20,
      bold: true, color: BLACK, align: "center", margin: 0 });
    s.addText(pe[2], { x, y: 5.55, w: colw, h: 0.65, fontFace: F, fontSize: 13.5,
      color: GREY, align: "center", margin: 0, valign: "top", lineSpacingMultiple: 1.3 });
    s.addText(pe[3], { x, y: 6.35, w: colw, h: 0.3, fontFace: F, fontSize: 12,
      color: GREY2, align: "center", margin: 0 });
  });
}

// ============================================================ S10 — Контакты
{
  const s = p.addSlide();
  s.background = { color: WHITE };
  wordmark(s);

  s.addText("Контакты", { x: M, y: 1.45, w: 8, h: 0.75, fontFace: F, fontSize: 34,
    bold: true, color: BLACK, margin: 0, charSpacing: -0.4 });

  const rows = [
    ["ТЕЛЕФОН", "+7 (969) 256 23 23"],
    ["TELEGRAM", "t.me/stiv_interiors"],
    ["ПОЧТА", "alex@stivinteriors.ru"],
    ["САЙТ", "stivmebel.ru"],
  ];
  rows.forEach((r, i) => {
    const y = 2.75 + i * 0.85;
    s.addText(r[0], { x: M, y, w: 2.2, h: 0.3, fontFace: F, fontSize: 10.5, bold: true,
      color: GREY2, charSpacing: 2, margin: 0, valign: "middle" });
    s.addText(r[1], { x: M + 2.3, y: y - 0.06, w: 5.5, h: 0.42, fontFace: F, fontSize: 19,
      bold: true, color: BLACK, margin: 0, valign: "middle" });
  });

  // QR
  s.addImage({ path: "assets/qr.png", x: 10.35, y: 2.7, w: 1.95, h: 1.95 });
  s.addText("Telegram", { x: 10.35, y: 4.75, w: 1.95, h: 0.28, fontFace: F, fontSize: 11,
    color: GREY2, align: "center", margin: 0 });

  s.addText("Будем рады подключиться к вашему следующему проекту.",
    { x: M, y: 6.55, w: 8.5, h: 0.4, fontFace: F, fontSize: 18, bold: true,
      color: OLIVE, margin: 0, valign: "bottom" });
}

p.writeFile({ fileName: "Стив Интерьеры — Презентация для дизайнеров.pptx" })
  .then(() => console.log("written"));
