<?php
echo view('partials/doc_header');
echo view('partials/header');
if (isset($_SESSION['user_id'])) {
  $session = session();
  $session->destroy();
}
?>
<div class="wrapper">
  <main class="main">
    <section class="banner">
      <div class="container">
        <div class="banner__content">
          <div class="banner__blackImg wow animate__animated animate__backInDown">
            <img src="<?= base_url('images/svg/finab_head.svg') ?>" class="finab-head" alt="finab-head">
          </div>
          <h1 class="home-title wow animate__animated animate__fadeInLeft">FINAB 2024</h1>
          <div class="home-subtitle">Identité et multiculturalisme : impacts sur les industries culturelles créatives en Afrique</div>
          <div class="banner__programme wow animate__animated animate__backInUp">
            <div class="banner__programme-item">
              <i class="icon icon-calendar"></i>
              <span class="text">Du 23 au 28 avril 2024</span>
            </div>
            <div class="banner__programme-item">
              <i class="icon icon-localisation"></i>
              <span class="text">Bénin: Cotonou, Porto-Novo, Ouidah et Abomey</span>
            </div>
          </div>
          <a href="programme.php" class="banner__programme-btn">Consultez notre programme</a>
        </div>
      </div>
    </section>
    <section class="discover">
      <div class="container">
        <div class="discover__content">
          <div class="discover__top">
            <div class="discover__top__left">
              <h2 class="wow animate__animated animate__fadeInLeft" data-wow-delay="0.1s">VENEZ DÉCOUVRIR LA CRÉATIVITÉ CULTURELLE ET ARTISTIQUE AFRICAINE</h2>
              <p class="wow animate__animated animate__backInUp" data-wow-delay="0.3s">La scène béninoise est prête pour une deuxième édition du Festival International des Arts du Bénin, autour de la riche thématique de l'identité et du multiculturalisme : impacts sur les industries culturelles créatives en Afrique. Du 23 au 28 avril 2024, les projecteurs seront braqués sur artistes conviés aux festivités, offrant ainsi une découverte de la richesse et la diversité des expressions artistiques du continent durant cette semaine d’immersion.</p>
              <p class="wow animate__animated animate__backInUp" data-wow-delay="0.5s">Cette édition spéciale promet une palette d'activités variées, que nous avons conçues pour susciter la réflexion, nourrir les débats et célébrer toutes les expressions des identités africaines avec originalité et créativité. Cette deuxième édition du Festival International des Arts du Bénin s'annonce comme une véritable célébration de la diversité, de la créativité et de la résilience africaines, tout en offrant un espace unique pour tisser des liens, partager des expériences et imaginer un avenir culturel plus inclusif et dynamique pour le continent.</p>
              <p class="wow animate__animated animate__backInUp" data-wow-delay="0.7s">Ensemble, nous pouvons faire du Festival International des Arts du Bénin un symbole de l'unité, de la créativité et du progrès pour le Bénin et pour le continent africain. </p>
            </div>
            <div class="discover__top__right wow animate__animated animate__backInRight">
              <div class="video-box-link" id="ytplayer">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/5uH3KJXKLlI?si=YgkoTKjjdBcduKuG" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <span class="video-box-link-btn"></span>
              </div>

            </div>
          </div>
          <div class="discover__bottom">
            <div class="discover__bottom__left wow animate__animated animate__flipInY">
              <div class="discover__bottom__left__img">
                <img src="<?= base_url('images/pdg.png') ?>" alt="pdg">
              </div>
              <p>Ulrich Adjovi</p>
              <span>Promoteur du FINAB.</span>
            </div>
            <div class="discover__bottom__right wow animate__animated animate__fadeInRight">
              <img src="<?= base_url('images/groupeempire-logo.png') ?>" alt="groupeempire">
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="stat">
      <div class="container">
        <div class="stat__content">
          <div class="stat__list">
            <div class="stat__item wow animate__animated animate__fadeInDown" data-wow-delay="0.1s">
              <div class="stat__item__top">+100 000</div>
              <span>Visiteurs</span>
            </div>
            <!-- <div class="stat__item wow animate__animated animate__fadeInDown" data-wow-delay="0.3s">
              <div class="stat__item__top">02</div>
              <span>Conférences de presse <small>(22 Médias présents)</small></span>
            </div> -->
            <div class="stat__item wow animate__animated animate__fadeInDown" data-wow-delay="0.3s">
              <div class="stat__item__top">+140</div>
              <span>Articles</span>
            </div>
            <div class="stat__item wow animate__animated animate__fadeInDown" data-wow-delay="0.5s">
              <div class="stat__item__top">+20</div>
              <span>Médias présents à l’évènement</span>
            </div>
            <div class="stat__item wow animate__animated animate__fadeInDown" data-wow-delay="0.7s">
              <div class="stat__item__top">+100</div>
              <span>Exposants venus de 20 pays</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="distinction">
      <div class="container">
        <div class="distinction__content">
          <h2>HOMMAGES ET DISTINCTIONS</h2>
          <div class="distinction__list js-distinction">
            <div class="distinction__item">
              <div class="distinction__item-img-box">
                <img src="<?= base_url('images/artistes-dist/artiste-dist-03.png') ?>" alt="distinction_img">
              </div>
              <div class="distinction__infos">
                <span>Dominique ZINKPÈ </span>
                <span>Arts Plastiques</span>
                <span><i>BÉnin</i></span>
              </div>
            </div>
            <div class="distinction__item">
              <div class="distinction__item-img-box">
                <img src="<?= base_url('images/artistes-dist/artiste-dist-04.png') ?>" alt="distinction_img">
              </div>
              <div class="distinction__infos">
                <span>Carole Lokossou</span>
                <span><i>BÉnin</i></span>
                <span>Cinéma</span>
              </div>
            </div>
            <div class="distinction__item">
              <div class="distinction__item-img-box">
                <img src="<?= base_url('images/artistes-dist/artiste-dist-02.png') ?>" alt="distinction_img">
              </div>
              <div class="distinction__infos">
                <span>Florisse ADJANOHOUN</span>
                <span>Artiste chanteur</span>
                <span><i>BÉnin</i></span>
              </div>
            </div>
            <div class="distinction__item">
              <div class="distinction__item-img-box">
                <img src="<?= base_url('images/artistes-dist/artiste-dist-01.png') ?>" alt="distinction_img">
              </div>
              <div class="distinction__infos">
                <span>Vincent ahehehinnou</span>
                <span>Artiste chanteur</span>
                <span><i>BÉnin</i></span>
              </div>
            </div>
            <div class="distinction__item">
              <div class="distinction__item-img-box">
                <img src="<?= base_url('images/artistes-dist/artiste-dist-05.png') ?>" alt="distinction_img">
              </div>
              <div class="distinction__infos">
                <span>José Pliya pour Jean Pliya</span>
                <span>Littérature</span>
                <span><i>BÉnin</i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="gallerie">
      <div class="container">
        <div class="gallerie__content">
          <h2>Découvrez notre gallerie d'images pour le FInAB 2024</h2>
          <p class="gallerie__subText">Les manifestations artistiques empreintes d'exclusivité dévoileront un panorama envoûtant d'artistes, tant locaux qu'internationaux</p>
          <div class="gallerie__images-grid">
            <?php foreach ($galleries as $gallery) : ?>
              <div class="gallerie__item" data-fancybox="gallery">
                <a href="<?= base_url($gallery['img_principales']) ?>" class="gallerie__link">
                  <img src="<?= base_url($gallery['img_principales']) ?>" alt="gallerie_img" style="height: auto;">
                  <div class="image-text"><?= $gallery['name'] ?></div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>

        </div>
      </div>
    </section>
    <section class="talent">
      <div class="container">
        <div class="talent__content">
          <h2>Venez découvrir les talents à l’honneur du FInAB 2024</h2>
          <p class="talent__subText">Les manifestations artistiques empreintes d'exclusivité dévoileront un panorama envoûtant d'artistes, tant locaux qu'internationaux</p>
          <div class="distinction__list talent__list js-distinction">
            <a href="<?= base_url('images/artistes-prestation/AP-01.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-01.png') ?>" alt="distinction_img">
            </a>
            <a href="<?= base_url('images/artistes-prestation/AP-02.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-02.png') ?>" alt="distinction_img">
            </a>
            <a href="<?= base_url('images/artistes-prestation/AP-03.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-03.png') ?>" alt="distinction_img">
            </a>
            <a href="<?= base_url('images/artistes-prestation/AP-04.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-04.png') ?>" alt="distinction_img">
            </a>
            <a href="<?= base_url('images/artistes-prestation/AP-05.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-05.png') ?>" alt="distinction_img">
            </a>
            <a href="<?= base_url('images/artistes-prestation/AP-06.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-06.png') ?>" alt="distinction_img">
            </a>
            <a href="<?= base_url('images/artistes-prestation/AP-07.png') ?>" class="distinction__item" data-fancybox="gallery">
              <img src="<?= base_url('images/artistes-prestation/AP-07.png') ?>" alt="distinction_img">
            </a>
          </div>
        </div>
      </div>
    </section>
    <section class="partner">
      <div class="container">
        <div class="partner__content">
          <h2>Nos partenaires</h2>
          <div class="partner__list js-partner">
            <?php if (isset($partners)) : ?>
              <?php foreach ($partners as $partner) : ?>
                <div class="partner__item">
                  <a href="<?= $partner['link'] ?>">
                    <img src="<?= base_url($partner['img']) ?>" alt="partner">
                  </a>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <?php echo view('sections/last-events'); ?>
  </main>
</div>
<script>
  console.log(<?= json_encode($galleries) ?>)
</script>
<?php
echo view('partials/footer');
echo view('partials/doc_footer');
?>