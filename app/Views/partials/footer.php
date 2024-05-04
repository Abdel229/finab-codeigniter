<footer class="footer">
  <div class="footer__top">
    <div class="container">
      <div class="footer__top__content">
        <div class="footer__top__left">
          <a href="/"><img src="<?= base_url('images/logo.svg') ?>" alt="logo"></a>
        </div>
        <div class="footer__top__right">
          <ul class="footer__menu">
            <li class="footer__menu__item"><a href="/" class="active">Accueil</a></li>
            <li class="footer__menu__item"><a href="#">FinAB</a></li>
            <li class="footer__menu__item"><a href="2023/partenaire.php">Programmation</a></li>
            <li class="footer__menu__item"><a href="2023/programme.php">Sponsoring & partenaires</a></li>
            <li class="footer__menu__item"><a href="2023/media.php">Actualités</a></li>
            <li class="footer__menu__item"><a href="2023/portfolio.php">Médiathèque</a></li>
            <li class="footer__menu__item"><a href="2023/contact.php">Contact</a></li>
          </ul>
          <div class="footer__top__right__bottom">
            <ul>
              <li>
                <div class="footer__top__right__bottom-row">
                <i class="icon icon-localisation"></i>
                <div class="footer__top__right__bottom-row-list">BÉNIN - C/7004, Haie Vive, Cotonou</div>
                </div>
              </li>
              <li>
                <div class="footer__top__right__bottom-row">
                  <i class="icon icon-phone"></i>
                  <div class="footer__top__right__bottom-row-list">
                    <a href="tel:0022991436363">+(229) 91- 43 - 63 -  63</a>
                    <a href="tel:0022955726060">+(229) 55 - 72 - 60 - 60</a>
                  </div>
                </div>
              </li>
              <li>
              <div class="footer__top__right__bottom-row">
                <i class="icon icon-email"></i>
                <div class="footer__top__right__bottom-row-list">
                  <a href="mailto:welcome@finab.bj">welcome@finab.bj</a>
                </div>
                </div>
              </li>
            </ul>
            <div class="footer__top__right__bottom__topic">
              <p>Thème de l'édition 2024:</p>
              <p><< Identité et multiculturalisme : impacts sur les industries culturelles créatives en Afrique. >></p>
            </div>
            <div class="footer__top__right__bottom__form">
              <form action="subscriptionMail.php" method='post' id='newsletterForm'>
                <label for="newsletter">Abonnez-vous À notre newsletter</label>
                <div>
                  <input type="email" name="email" placeholder="Votre email" id='email_footer'>
                  <button type="submit">S’abonner</button>
                </div>
                  <span class="error_message" id='error_email_footer'></span>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer__bottom">
    <div class="container">
      <div class="footer__bottom__content">
        <p><a href="https://www.finab.bj">© www.finab.bj</a> - Tous droit réservés</p>
        <div class="footer__bottom__center">
          <div class="footer__bottom__center-label">Suivez-nous sur nos réseaux sociaux</div>
          <div class="footer__bottom__rs">
            <a href="https://www.facebook.com/finabbj"><i class="icon icon-facebook"></i></a>
            <a href="https://www.instagram.com/finab.bj/"><i class="icon icon-instagram"></i></a>
            <a href="https://twitter.com/finabbj"><i class="icon icon-twitter-x"></i></a>
            <a href="https://www.youtube.com/channel/UCFWi_KjtltyPxeiwZz7Wvkg"><i class="icon icon-youtube"></i></a>
            <a href="https://www.linkedin.com/company/festival-international-des-arts-du-b%C3%A9nin/"><i class="icon icon-linkedin"></i></a>
          </div>
        </div>
        <div class="footer__bottom__author">Réalisé par <span class="footer__bottom__author-name">KevinpakCode</span></div>
      </div>
    </div>
  </div>
</footer>