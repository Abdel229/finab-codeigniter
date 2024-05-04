<header class="header">
    <div class="container">
    <div class="header__content">
      <a href="/" class="header__logo">
        <img src="<?=base_url('2023/img/logo/logo.png')?>" alt="logo">
      </a>
      <ul class="header__menu" id="header-menu">
        <li class="header__menu__item"><a href="/" class="<?=($_SERVER['REQUEST_URI']=="/")?'active':'';?>">Accueil</a></li>
        <li class="header__menu__item">
            <a href="#" class="header__menu__item-link--acc">FinAB</a>
          <ul class="header__menu-list">
            <li class="header__menu-list-item">
              <a href="/latest">FinAB-2023</a>
            </li>
          </ul>
        </li>
        <li class="header__menu__item"><a href="<?=base_url('programmation')?>" class="<?=($_SERVER['REQUEST_URI']=="/programme.php")?'active':'';?>">Programmation</a></li>
        <li class="header__menu__item"><a href="<?=base_url('partners')?>" class="<?=($_SERVER['REQUEST_URI']=="/partners.php")?'active':'';?>">Sponsoring & partenaires</a></li>
        <li class="header__menu__item"><a href="<?=base_url('actualite')?>" class="<?=($_SERVER['REQUEST_URI']=="/actualite.php")?'active':'';?>">Actualités</a></li>
        <li class="header__menu__item"><a href="<?=base_url('media')?>" class="<?=($_SERVER['REQUEST_URI']=="/media.php")?'active':'';?>">Médiathèque</a></li>
        <li class="header__menu__item"><a href="<?=base_url('contact')?>" class="<?=($_SERVER['REQUEST_URI']=="/contact.php")?'active':'';?>">Contact</a></li>

      </ul>
      <a href="#" class="header__action" id="subcriptionBtn">Inscrivez-vous</a>
      <a href="#" class="header__btnClose" id="js-btn-menu"><span></span></a>
    </div>
  </div>
</header>