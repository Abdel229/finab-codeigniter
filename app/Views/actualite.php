<?php
echo view('partials/doc_header');
echo view('partials/header');
?>
<div class="wrapper">
  <main class="main">
    <section class="pg-first-face">
      <div class="container">
        <div class="pg-first-face__inner">
          <div class="pg-first-face__blackImg wow animate__animated animate__backInDown">
            <img src="<?= base_url('images/svg/finab_head.svg') ?>" class="finab-head" alt="finab-head">
          </div>
          <h1 class="h1 pg-title">ACTUALITES</h1>
        </div>
      </div>
    </section>

    <section class="partner-section section-default-therm actualite-section">
      <div class="container">
        <div class="partner-section__inner actualite-inner">
          <h2 class="actualite-inner__h2">NOTRE ACTUALITES</h2>
          <hr class="actualite-inner_hr">
          <p class="actualite-inner__text">Tout ce que vous devez savoir sur finab</p>
        </div>

        <div class="actualite__content" id="actualite_content" data-news-data="<?= json_encode($actualites) ?>">
          <div class="actualite__content__filter">
            <div class="actualite__content__filter_search">
              <!-- <p class="actualite__content__filter__search__p">Recherche par date</p>-->
              <div class="search-container">
                <i class="icon icon-search" class="search-icon"></i>
                <input type="search" class="" placeholder="Recherche..." id="search-input" />
              </div>
            </div>
            <!--
            <div class="actualite__content__date-filter">
              <p class="actualite__content__date-filter__p">Filtrage par période</p>
              <div class="date-input">
                <i class="icon icon-calendar"></i>
                <input type="text" class="actualite__content__date-filter__input" placeholder="Début" id="end" name="trip-end">
              </div>
            </div>
-->
          </div>

          <div class="actualite__content__news_paginate">
            <div class="actualite__content__news" id="news-container">
              <?php foreach ($actualites as $actualite) : ?>
                <a href="<?=base_url('single-actualite/'.$actualite['id'])?>" class="single_new">
                  <div class="single_new_img">
                    <img src="<?=base_url($actualite['img'])?>" alt="Image de l'article">
                  </div>
                  <p class="single_new_text"><?= $actualite['title']?></p>
                  <div class="single_new_date">
                    <i class="icon icon-calendar"></i>
                    <p class="single_new_date_p"><?= $actualite['date_pub']?></p>
                  </div>
                </a>
              <?php endforeach; ?>
            </div>
            <div class="pagination-container" id="pagination-container"></div>
          </div>
        </div>
      </div>
    </section>
</div>
<?php
echo view('partials/footer');
echo view('partials/doc_footer');
?>