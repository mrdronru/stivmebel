<?php
require_once __DIR__ . '/config.php';
$page        = '';
$title       = 'Согласие на обработку персональных данных';
$description = 'Согласие на обработку персональных данных пользователей сайта Стив Интерьеры.';
include 'header.php';
?>

<div class="legal-wrap">
  <div class="legal-back">
    <a href="/" class="nav-back">
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
      На главную
    </a>
  </div>

  <article class="legal-article">
    <header class="legal-header">
      <h1 class="legal-title">Согласие на обработку<br><em>персональных данных</em></h1>
    </header>

    <div class="legal-body">

      <h2>Термины и определения</h2>

      <p><strong>Сайты «Стив Интерьеры» (далее — «Сайт»)</strong> — совокупность информации, текстов, графических элементов, дизайна, изображений, фото и видеоматериалов и иных результатов интеллектуальной деятельности, а также программ для ЭВМ, содержащихся в информационной системе, обеспечивающей доступность такой информации в сети Интернет, объединённых единым адресным пространством доменов, включающее, но не ограничивающееся доменными именами https://stivinteriors.ru/ и https://stivmebel.ru/.</p>

      <p><strong>Оператор</strong> — ИП Филиппович С. А., ИНН 745221837993, ОГРНИП 322665800019030, владелец и правообладатель Сайта, который самостоятельно или совместно с другими лицами организующие и/или осуществляющие обработку персональных данных, а также определяющие цели обработки персональных данных, состав персональных данных, подлежащих обработке, действия (операции), совершаемые с персональными данными.</p>

      <p><strong>Заказ</strong> — оформленная заявка пользователя на покупку товара/услуги Оператора в форме обратной связи.</p>

      <p><strong>Пользователь</strong> — субъект персональных данных, любой посетитель Сайта.</p>

      <p><strong>Персональные данные</strong> — любая информация, относящаяся прямо или косвенно к определённому или определяемому Пользователю Сайта.</p>

      <p><strong>Обратная связь</strong> — информационно-консультационная услуга, осуществляемая Оператором в форме проведения письменной/устной консультации и ответов на вопросы через средства электронной коммуникации, указанные на Сайте: телефонный звонок, электронная почта, мессенджеры и т.п.</p>

      <p>1) Любое физическое или юридическое лицо, оформляя Заказ, оплачивая Заказ, запрашивая консультацию на Сайте, используя функционал Сайта, действуя свободно, своей волей и в своём интересе, а также подтверждая свою дееспособность, предоставляет Оператору во исполнение требований ч. 1 ст. 18 Федерального закона от 13 марта 2006 г. № 38-ФЗ «О рекламе», своё согласие на получение рекламно-информационной рассылки об услугах (сервисах) Оператора, а именно: рассылок о мероприятиях, контенте, акциях и др. информационного и рекламного характера следующими способами:</p>

      <ul>
        <li>sms-рассылки на номер телефона, указанный при оформлении Заказа или при запросе консультации;</li>
        <li>рассылка на адрес электронной почты, указанной при оформлении Заказа или запросе консультации.</li>
      </ul>

      <p>2) Пользователь уведомлён о том, что в любой момент в течение всего срока действия Согласия, он вправе отписаться от рекламно-новостной рассылки следующими способами:</p>

      <ul>
        <li>Перейдя по специальной ссылке «Отписаться от рассылки» в рассылаемых письмах;</li>
        <li>Путём направления соответствующего запроса через Обратную связь Оператора.</li>
      </ul>

      <p>3) Настоящее согласие действует до поступления требования субъекта персональных данных о прекращении обработки персональных данных в соответствии с ч. 2 ст. 15 Федерального закона от 27.07.2006 № 152-ФЗ «О персональных данных», либо до момента прекращения обработки Оператором персональных данных в соответствии с условиями Политики конфиденциальности Оператора, размещённой на Сайте.</p>

      <h2>Реквизиты Оператора</h2>

      <p>ИП Филиппович С. А., ИНН 745221837993, ОГРНИП 322665800019030<br>
      Адрес: 109052, г. Москва, Рязанский проспект, дом 2/1 корпус 3, кв. 96М</p>

      <p>
        Телефон: <a href="<?php echo SITE_PHONE_HREF; ?>"><?php echo SITE_PHONE; ?></a><br>
        Telegram: <a href="<?php echo SOCIAL_TG; ?>" target="_blank" rel="noopener"><?php echo SOCIAL_TG; ?></a><br>
        E-mail: <a href="<?php echo SITE_EMAIL_HREF; ?>"><?php echo SITE_EMAIL; ?></a>
      </p>

    </div>

    <div class="legal-related">
      <a href="politika" class="legal-related-link">Политика конфиденциальности →</a>
    </div>
  </article>
</div>

<style>
.legal-wrap {
  max-width: 760px;
  margin: 0 auto;
  padding: 8rem 2rem 6rem;
}
.legal-back { margin-bottom: 3rem; }
.legal-header {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid var(--ink-10);
}
.legal-title {
  font-family: var(--serif);
  font-size: var(--fs-hero);
  font-weight: 300;
  line-height: 1.1;
  color: var(--ink);
}
.legal-title em { font-style: italic; color: var(--gold); }
.legal-body h2 {
  font-family: var(--serif);
  font-size: clamp(1.3rem, 2.2vw, 1.7rem);
  font-weight: 300;
  color: var(--ink);
  margin: 2.5rem 0 1rem;
  line-height: 1.2;
}
.legal-body p {
  font-size: var(--fs-sm);
  font-weight: 300;
  color: var(--ink-60);
  line-height: 1.85;
  margin-bottom: 1.2rem;
}
.legal-body ul {
  margin: 0 0 1.5rem 1.2rem;
}
.legal-body li {
  font-size: var(--fs-sm);
  font-weight: 300;
  color: var(--ink-60);
  line-height: 1.75;
  margin-bottom: 0.4rem;
}
.legal-body strong { font-weight: 400; color: var(--ink); }
.legal-body a { color: var(--gold); text-decoration: none; transition: opacity 0.2s; }
.legal-body a:hover { opacity: 0.75; }
.legal-related {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid var(--ink-10);
}
.legal-related-link {
  font-size: var(--fs-xs);
  font-weight: 400;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--ink-60);
  text-decoration: none;
  transition: color 0.25s;
}
.legal-related-link:hover { color: var(--ink); }
@media (max-width: 900px) {
  .legal-wrap { padding: 6rem 1.5rem 4rem; }
}
</style>

<?php include 'footer.php'; ?>
