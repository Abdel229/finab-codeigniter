<?php
  echo view('partials/doc_header');
  echo view('partials/header');
?>
<div class="wrapper">
  <main class="main">
    <section class="firstface programme">
        <div class="container">
            <div class="firstface__content">
                <div class="firstface__content__img">
                    <img src="<?= base_url('images/svg/finab_head.svg') ?>" alt="finab_head">
                </div>
                <h1>PROGRAMMATION DU FINAB</h1>
            </div>
        </div>
    </section>
    <section class="programme-box">
        <div class="container">
            <div class="programme-box__content">
                <div class="programme-box__top">
                    <div class="programme-box__top__left">
                        <img src="<?= base_url('images/programme_banner.png') ?>" alt="programme_banner">
                    </div>
                    <div class="programme-box__top__right">
                        <p>
                        Après une première édition courronée de succès, le Festival International des Arts du Bénin (FInAB) revient pour une deuxième édition, mettant en lumière la richesse artistique du Bénin et de l'Afrique. Du 23 au 28 avril 2024, Cotonou, Ouidah et Porto-Novo accueilleront plus de 100 000 visiteurs du monde entier, venant pour partager leur passion pour les arts. Cette année, le FInAB accueille une multitude d'artistes invités, des musiciens aux peintres, des stylistes aux plasticiens, offrant une diversité de styles et d'approches artistiques. Explorez notre riche programme qui célèbre la diversité culturelle à travers des concerts, des expositions, des conférences et bien plus encore.
                        </p>
                        <p>
                        Rejoignez-nous pour une célébration inoubliable de la créativité et de la connexion artistique, incarnant le thème inspirant de cette édition : "Cultures en dialogue : un voyage au cœur de la diversité".
                        </p>
                        <a href="<?= base_url('documents/programs/2024.pdf') ?>" target="_blank">Téléchargez notre programme !</a>
                    </div>
                </div>
                <div class="programme-box__bottom">
                    <h2>Pour plus DE détails du programme 2024</h2>
                    <div class="programme-box__bottom__search">
                        <span>Filtrage par date</span>
                        <select name="programme_search" id="programmeSearch">
                            <option value="23-04-2024">23-04-2024</option>
                            <option value="24-04-2024">24-04-2024</option>
                            <option value="25-04-2024">25-04-2024</option>
                            <option value="26-04-2024">26-04-2024</option>
                            <option value="27-04-2024">27-04-2024</option>
                            <option value="28-04-2024">28-04-2024</option>
                        </select>
                    </div>
                    <div class="programme-box__bottom__list" id="programmeList">
                        <a href="<?= base_url('images/programs/2024/j1-1.jpeg') ?>" class="programme-box__bottom__item active" data-day="23-04-2024" data-fancybox="23-04-2024">
                            <img src="<?= base_url('images/programs/2024/j1-1.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-1.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-1.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-2.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-2.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-3.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-3.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-4.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-4.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-inv1.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-inv1.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-other.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-other.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel1.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel1.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel2.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel2.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel3.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel3.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel4.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel4.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel5.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel5.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel6.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel6.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j2-panel7.jpeg') ?>" class="programme-box__bottom__item" data-day="24-04-2024">
                            <img src="<?= base_url('images/programs/2024/j2-panel7.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j3-1.jpeg') ?>" class="programme-box__bottom__item" data-day="25-04-2024">
                            <img src="<?= base_url('images/programs/2024/j3-1.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j4-panel1.jpeg') ?>" class="programme-box__bottom__item" data-day="26-04-2024">
                            <img src="<?= base_url('images/programs/2024/j4-panel1.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j4-panel2.jpeg') ?>" class="programme-box__bottom__item" data-day="26-04-2024">
                            <img src="<?= base_url('images/programs/2024/j4-panel2.jpeg') ?>" alt="program">
                        </a>
                        <a href="<?= base_url('images/programs/2024/j5-panel1.jpeg') ?>" class="programme-box__bottom__item" data-day="27-04-2024">
                            <img src="<?= base_url('images/programs/2024/j5-panel1.jpeg') ?>" alt="program">
                        </a>
                        <div class="empty-alert">
                            <p>Aucune information disponible!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </main>
</div>

<?php
  echo view('partials/footer');
  echo view('partials/doc_footer');
?>
