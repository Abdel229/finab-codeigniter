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
          <h1 class="h1 pg-title"><?= $data['title'] ?></h1>
        </div>
      </div>
    </section>
    <section class="partner-section section-default-therm">
      <div class="container">
        <div class="partner-section__inner">
          <h2 class="h2 partner-section__title"><?= $data['subtitle'] ?></h2>

          <div class="partner-section__presentation">
            <div class="partner-section__presentation-img">
              <img src="<?= base_url($data['principal_img']) ?>"/>
            </div>
            <div class="partner-section__presentation-content">
              <?php
              $reasons=json_decode($data['reasons']);
              ?>
              <h3 class="h3 partner-section__presentation-content-title"><?=count($reasons)?> Bonne<?= count($reasons)>1?'s':'' ?> raison<?= count($reasons)>1?'s':'' ?> pour devenir partenaire du FINAB</h3>
              <ul class="partner-section__presentation-content-list">
                <?php foreach($reasons as $reason): ?>
                <li class="partner-section__presentation-content-list-item">
                    <?=$reason?>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="partner-section__presentation-text">
            <p><?= $data['mini_text'] ?></p>
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