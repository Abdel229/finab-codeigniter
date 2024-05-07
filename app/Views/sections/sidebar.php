<aside class="dashboard__left aside">
    <div class="aside__top">
        <img src="<?=base_url('2023/img/logo/logo.png')?>" alt="logo">
    </div>
    <div class="aside__bottom">
        <ul class="aside__bottom__list">
            <li class="aside__bottom__item">
                <a href="<?=base_url('/admin')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/admin" || $_SERVER['REQUEST_URI']=="/articles/store")?"active":"");?>">
                    <i class="icon icon-article"></i>
                    Articles
                </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/admin/galeries')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/admin/galeries" || $_SERVER['REQUEST_URI']=="/galleries/store")?"active":"");?>">
                    <i class="icon icon-gallery"></i>
                    Galeries
                </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/admin/categories')?>" class="aside__bottom__item__link <?=(($_SERVER['REQUEST_URI']=="/admin/categories") || strpos($_SERVER['REQUEST_URI'],'article_categorie'))?"active":"";?>">
                <i class="icon icon-category"></i>
                Catégories article
            </a>
            </li>
            <li class="aside__bottom__item">
                <a href="<?=base_url('/admin/categories-gallerie')?>" class="aside__bottom__item__link <?=((strpos($_SERVER['REQUEST_URI'],'galleries_category'))?"active":"");?>">
                <i class="icon icon-category"></i>
                Catégories gallerie
            </a>
            </li>
        </ul>
    </div>
</aside>