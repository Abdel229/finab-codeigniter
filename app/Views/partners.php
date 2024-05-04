<?php
  echo view('partials/doc_header');
  echo view('partials/header');
?>
<div class="wrapper">
  <main class="main pg-partners">
    <section class="pg-first-face">
      <div class="container">
        <div class="pg-first-face__inner">
          <div class="pg-first-face__blackImg wow animate__animated animate__backInDown">
            <img src="<?= base_url('images/svg/finab_head.svg') ?>"  class="finab-head" alt="finab-head">
          </div>
          <h1 class="h1 pg-title">Sponsoring et Partenariat</h1>
        </div>
      </div>
    </section>
    <section class="partner-section section-default-therm">
      <div class="container">
        <div class="partner-section__inner">
          <h2 class="h2 partner-section__title">Accompagnez le développement des arts et des cultures Africaines, devenez partenaire</h2>

          <div class="partner-section__presentation">
            <div class="partner-section__presentation-img">
              <img src="<?= base_url('images/aff-1.png') ?>"/>
            </div>
            <div class="partner-section__presentation-content">
              <h3 class="h3 partner-section__presentation-content-title">4 Bonnes raisons pour devenir partenaire du FINAB</h3>
              <ul class="partner-section__presentation-content-list">
                <li class="partner-section__presentation-content-list-item">
                    Le FInAB offre une opportunité unique aux entreprises et aux organisations de devenir <strong>des partenaires de premier plan dans la promotion de la culture et des arts</strong> au Bénin en Afrique.
                </li>
                <li class="partner-section__presentation-content-list-item">
                  En tant que partenaire du FInAB, vous êtes assuré d'un partenariat Win-Win, marquant votre présence en cette période de festivité et vous offrant une visibilité accrue auprès d'un public diversifié.
                 </li>
                <li class="partner-section__presentation-content-list-item">
                  Nos offres de partenariat sont conçues sur mesure pour répondre <strong>à vos objectifs spécifiques, que ce soit en termes de visibilité,</strong> d'image de marque, de notoriété, de mise en avant de produit, d'échantillonnage, de ventes, de relations publiques ou d'opérations événementielles. 
                </li>
                <li class="partner-section__presentation-content-list-item">
                  Nous travaillerons en étroite collaboration avec vous pour développer des solutions personnalisées qui mettent en valeur votre engagement envers la culture et les arts, tout en renforçant votre présence sur le marché.
                </li>
              </ul>
            </div>
          </div>
          <div class="partner-section__presentation-text">
            <p>Rejoignez-nous dans cette aventure culturelle et contactez-nous dès aujourd'hui pour explorer les différentes options de partenariat.C’est grâce au soutien précieux de nos partenaires que nous sommes en mesure d'offrir une plateforme dynamique pour célébrer la diversité artistique et stimuler le développement culturel.</p>
            <p>Ensemble, nous pouvons faire une différence significative dans le paysage culturel africain.</p>
          </div>
        </div>

      </div>
    </section>
    <?php echo view('sections/last-events');?>
  </main>
</div>
<?php
  echo view('partials/footer');
  echo view('partials/doc_footer');
?>