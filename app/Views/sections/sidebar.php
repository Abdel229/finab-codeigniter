<aside class="dashboard__left aside">
    <div class="aside__top">
        <img src="<?=base_url('2023/img/logo/logo.png')?>" alt="logo">
    </div>
    <div class="aside__bottom">
        <ul class="aside__bottom__list ui-dropdown">
            <li class="aside__bottom__item ">
                <a href="#" class="aside__bottom__item__link">
                    <i class="icon icon-article"></i>
                    Accueil
                </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/finab')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/finab" || $_SERVER['REQUEST_URI']=="/finab/edition")?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Finab
                </a>
                <!-- <ul class="submenu">
                    <li class="submenu-item"><a class='submenu-item-link' href="#">Création d'évènement Finab</a></li>
                    <li class="submenu-item">
                        <a class='submenu-item-link' href="#">Finab 2024</a>
                        <ul class="sub-submenu ui-dropdown__list-item-link">
                            <li><a href="#">Présentation</a></li>
                            <li><a href="#">Hommages et Distinctions</a></li>
                            <li><a href="#">Découverte Talents</a></li>
                            <li><a href="#">Partenaires</a></li>
                            <li><a href="#">Evènements</a></li>
                            <li><a href="#">Programmes</a></li>
                            <li><a href="#">Sponsoring et Partenariat</a></li>
                            <li><a href="#">Caractéristiques</a></li>
                        </ul>
                    </li>
                </ul> -->
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/admin')?>" 
                class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/admin" || $_SERVER['REQUEST_URI']=="/articles/store" || $_SERVER['REQUEST_URI']=="/create_article_categories" || $_SERVER['REQUEST_URI']=="/article_categorie/store"|| $_SERVER['REQUEST_URI']=="/articles/update")?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Articles
                </a>
                <!-- <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/admin')?>">Catégories</a>
                        
                    </li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/admin')?>">Liste des articles</a></li>
                </ul> -->
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/admin/galeries')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/admin/galeries" || $_SERVER['REQUEST_URI']=="/galleries/store" || $_SERVER['REQUEST_URI']=="/create_gallery_categories" || $_SERVER['REQUEST_URI']=="/gallery_categorie/store"|| $_SERVER['REQUEST_URI']=="/gallery_categorie/update" || strpos($_SERVER['REQUEST_URI'],'galleries/update'))?"active":"");?>">
                    <i class="icon icon-gallery"></i>
                    Galeries
                </a>
                <!-- <ul class="submenu">
                    <li class="submenu-item"><a href="">Catégories</a>
                        
                    </li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="">Liste des galeries</a></li>
                </ul> -->
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/partner')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/partner" || $_SERVER['REQUEST_URI']=="/partner/list" || strpos($_SERVER['REQUEST_URI'],'partner/demande'))?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Partenariat
                </a>
                <!-- <ul class="submenu">
                    <li class="submenu-item"><a href="">Présentation</a></li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="">Liste des partenaires</a></li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="">Demandes de partenariats</a></li>
                </ul> -->
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/events')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/events" )?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Evènements
                </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/messages')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/messages" )?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Messages
                </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/newsletters')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/newsletters" || $_SERVER['REQUEST_URI']=="/newsletters/followers" || $_SERVER['REQUEST_URI']=="/newsletters/categories")?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Newsletters
                </a>
                <!-- <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/newsletters')?>">Historiques</a></li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/newsletters/followers')?>">Abonnés</a></li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/newsletters/categories')?>">Catégories</a></li>
                </ul> -->
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/contacts')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/contacts" )?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Contacts
                </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/others')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/others" || $_SERVER['REQUEST_URI']=="/others/promotteur" || $_SERVER['REQUEST_URI']=="/others/configuration")?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Autres
                </a>
                <!-- <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/others')?>">Logo</a></li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/others/promotteur')?>">Promotteur</a></li>
                </ul>
                <ul class="submenu">
                    <li class="submenu-item"><a href="<?=base_url('/others/configuration')?>">Configuration</a></li>
                </ul> -->
            </li>
        </ul>
    </div>
</aside>