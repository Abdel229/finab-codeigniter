<?php
  echo view('partials/doc_header');
  echo view('partials/header');
?>
<div class="wrapper">
  <main class="main pg-media">
    <section class="pg-first-face">
      <div class="container">
        <div class="pg-first-face__inner">
          <div class="pg-first-face__blackImg wow animate__animated animate__backInDown">
            <img src="<?= base_url('images/svg/finab_head.svg')?>"  class="finab-head" alt="finab-head">
          </div>
          <h1 class="h1 pg-title">Médiathèque</h1>
        </div>
      </div>
    </section>
    <section class="pg-media-section">
      <div class="container">
        <h2 class="h2 pg-media-section__title">Le FInAB d’après la presse</h2>
        <div class="h2-subtitle">
          Plongez dans l'univers captivant du FInAB à travers une collection riche en images,
          vidéos, articles et témoignages qui capturent l'essence de notre événement culturel majeur. 
          Explorez des moments forts des éditions précédentes,
          découvrez les artistes talentueux qui ont participé à notre festival.
        </div>
        <div class="pg-media-section__search-box">
          <!-- <label class="pg-media-section__search-box-label">Filter par presse</label>
          <div class="cpn-select">
            <input type="text" name="selected-media" class="cpn-select__reel-field">
            <i class="icon icon-angle-arrown-bottom"></i>
            <buttom class="cpn-select__field" data-id="field">Tous</buttom>
            <ul class="cpn-select__list">
              <li class="cpn-select__list-item" data-value="agence_ecofin">Agence ecofin</li>
              <li class="cpn-select__list-item" data-value="financial_afrik">Financial Afrik</li>
              <li class="cpn-select__list-item" data-value="apa_news">APA News</li>
              <li class="cpn-select__list-item" data-value="agfrica_radio">Africa Radio </li>
              <li class="cpn-select__list-item" data-value="jeune_afrique">Jeune Afrique</li>
              <li class="cpn-select__list-item" data-value="tv5_monde">Tv5 Monde</li>
              <li class="cpn-select__list-item" data-value="rfi">RFI</li>
              <li class="cpn-select__list-item" data-value="music_in_africa">Music in africa</li>
              <li class="cpn-select__list-item" data-value="a_plus_afrique">A+ Afrique </li>
              <li class="cpn-select__list-item" data-value="la_nation">La nation</li>
              <li class="cpn-select__list-item" data-value="matin_libre">Matin libre</li>
            </ul>
          </div> -->
        </div>
        <div class="media-list">
          <div class="media-list__item" data-name="">
            <a href="https://www.jeuneafrique.com/1418947/economie/le-beninois-ulrich-adjovi-serial-entrepreneur-du-divertissement/" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-01.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">Jeune Afrique</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="https://information.tv5monde.com/video/culture-premiere-edition-du-festival-international-des-arts-du-benin" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-02.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">Tv5 Monde</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="https://www.musicinafrica.net/fr/magazine/finab-lart-latout-du-benin-pour-mieux-se-vendre-linternational" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-03.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">Music in africa</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="#" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-04.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">Financial Afrik</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="#" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-05.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">APA News</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="https://www.africaradio.com/benin-le-finab-est-la-fete-de-l-amour-de-l-art-des-passionnes-de-notre-patrimoine-culturel-ulrich-adjovi" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-06.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">Africa Radio</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="#" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-07.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">Matin libre</div>
              </div>
            </a>
          </div>
          <div class="media-list__item" data-name="">
            <a href="https://musique.rfi.fr/musique-africaine/20230220-benin-six-jours-deffervescence-musicale-finab" class="media-list__item-link" target="_blank">
              <div class="media-list__item-img">
                <img src="<?= base_url('images/press/new-08.png')?>" />
              </div>
              <div class="media-list__item-infos">
                <div class="media-list__item-name">RFI</div>
              </div>
            </a>
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