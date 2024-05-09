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
                    <h1>ACTUALITÉS</h1>
                </div>
            </div>
        </section>
        <section class="actuality-detail-box">
            <div class="container">
                <div class="actuality-detail-box__content">
                    <div class="actuality-detail-box__img">
                        <img src="<?= base_url($article['img']) ?>" alt="actuality_detail" id="article-img">
                        <div class="actuality-detail-box__text">
                            <h2 id="article-title"><?= $article['title'] ?></h2>
                            <span id="article-date"><?= $article['date_pub'] ?></span>
                        </div>
                    </div>
                    <div class="actuality-detail-box__description">
                        <!-- <div class="actuality-detail-box__rs">
                        <a href="#"><i class="icon icon-facebook-circle"></i></a>
                        <a href="#"><i class="icon icon-twitter-x"></i></a>
                        <a href="#"><i class="icon icon-instagram"></i></a>
                        <a href="#"><i class="icon icon-whatsapp"></i></a>
                        <a href="#"><i class="icon icon-outline-plus"></i></a>
                    </div> -->
                        <div class="actuality-detail-box__detail" id="article-content">
                            <p><?= $article['description'] ?></p>
                           
                            <?php if (count($links) > 0) : ?>
                                <div  style="display:flex;gap:10px;">
                            <?php foreach ($links as $link) : ?>
                                <div class="single_new_video">
                                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/' . explode('v=', <?=$link['link']?>) . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                </div>
                            <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="same-actuality">
            <div class="container">
                <div class="same-actuality__content">
                    <h2>Autres Articles de la même catégorie</h2>
                    <div class="actualite__content__news" id="similar-article">
                        <?php foreach ($randomArticles as $randomArticle) : ?>
                            <a href="<?= base_url('single-actualite/' . $randomArticle['id']) ?>" class="single_new">
                                <div class="single_new_img">
                                    <img src="<?= base_url($randomArticle['img']) ?>" />
                                </div>
                                <p class="single_new_text">
                                    <?= $randomArticle['title'] ?>
                                </p>
                                <div class="single_new_date">
                                    <i class="icon icon-calendar"></i>
                                    <p class="single_new_date_p"><?= $randomArticle['date_pub'] ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>

                      
                    </div>
                    <div class="same-actuality__seemore">
                        <a href="<?= base_url('/actualite') ?>">
                            VOIR TOUS LES ARTICLES
                            <img src="assets/images/svg/Arrow Bottom Right.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- <main>
    <div class="row_banner">
        <div class="container">
            <div class="name_page_logo">
                <div class="logo_finab">
                    <img src="assets/images/svg/Group02.svg" alt="">
                </div>
                <div class="name_page">
                    <h1>ACTUALITES</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row_section1">
        <div class="container_section1">
            <div class="section1_banner">
                <div class="row_text_date">
                    <p>
                        Partenariat entre la structure bénin excellence et Ecobank Bénin
                    </p>
                    <p>23 Janvier 2023</p>
                </div>
            </div>
            <div class="social_medias_text_content">
                <div class="social_medias">
                    <div class="social_medias_content">
                        <i class="icon icon-facebook-circle"></i>
                        <i class="icon icon-twitter-x"></i>
                        <i class="icon icon-instagram"></i>
                        <i class="icon icon-whatsapp"></i>
                        <i class="icon icon-outline-plus"></i>
                    </div>
                </div>
                <div class="text_content">
                    <p>
                        Lorem ipsum dolor sit amet consectetur. Lectus nascetur id tristique amet 
                        diam sit urna. Morbi massa adipiscing et consectetur netus sed. 
                        At ullamcorper risus quis dolor. Vitae netus purus aliquam ut justo.
                        Lorem ipsum dolor sit amet consectetur. Lectus nascetur id tristique amet 
                        diam sit urna. Morbi massa adipiscing et consectetur netus sed. At ullamcorper 
                        risus quis dolor. Vitae netus purus aliquam ut justo.Lorem ipsum dolor sit 
                        amet consectetur. Lectus nascetur id tristique amet diam sit urna. Morbi 
                        massa adipiscing et consectetur netus sed. At ullamcorper risus quis dolor. 
                    </p>
                    <p>
                        Vitae netus purus aliquam ut justo.Lorem ipsum dolor sit amet consectetur. 
                        Lectus nascetur id tristique amet diam sit urna. Morbi massa adipiscing et consectetur 
                        netus sed. At ullamcorper risus quis dolor. Vitae netus purus aliquam ut justo.Lorem ipsum 
                        dolor sit amet consectetur. Lectus nascetur id tristique amet diam sit urna. Morbi massa
                        adipiscing et consectetur netus sed. At ullamcorper risus quis dolor. Vitae netus purus
                        aliquam ut justo.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur. Lectus nascetur id tristique amet 
                        diam sit urna. Morbi massa adipiscing et consectetur netus sed. 
                        At ullamcorper risus quis dolor. Vitae netus purus aliquam ut justo.
                        Lorem ipsum dolor sit amet consectetur. Lectus nascetur id tristique 
                        amet diam sit urna. Morbi massa adipiscing et consectetur netus sed. 
                        At ullamcorper risus quis dolor. Vitae netus purus aliquam ut justo.Lorem 
                        ipsum dolor sit amet consectetur. Lectus nascetur id tristique amet diam 
                        sit urna. Morbi massa adipiscing et consectetur netus sed. At ullamcorper 
                        risus quis dolor. Vitae netus purus aliquam ut justo.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row_section2">
        <div class="row_section2_title">
            <h2>Autres Articles de la même catégorie</h2>
        </div>
        <div class="row_card_section2">
            <div class="row_card_section2_content">
                <div class="card_section2">
                    <div class="card_section2_content1">
                        <img src="assets/images/svg/image 11.svg" alt="">
                    </div>
                    <div class="card_section2_content2">
                        <div class="card_section2_content2_content">
                            <p>
                                Partenariat entre la structure bénin excellence nariat  entre la structure 
                                la structure bénin excellence nariat   bén...
                            </p>
                            <div class="card_date">
                                <i class="icon icon-calendar"></i>
                                <p>23 janvier 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_section2">
                    <div class="card_section2_content1">
                        <img src="assets/images/svg/image 11.svg" alt="">
                    </div>
                    <div class="card_section2_content2">
                        <div class="card_section2_content2_content">
                            <p>
                                Partenariat entre la structure bénin excellence nariat  entre la structure 
                                la structure bénin excellence nariat   bén...
                            </p>
                            <div class="card_date">
                                <i class="icon icon-calendar"></i>
                                <p>23 janvier 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_section2">
                    <div class="card_section2_content1">
                        <img src="assets/images/svg/image 11.svg" alt="">
                    </div>
                    <div class="card_section2_content2">
                        <div class="card_section2_content2_content">
                            <p>
                                Partenariat entre la structure bénin excellence nariat  entre la structure 
                                la structure bénin excellence nariat   bén...
                            </p>
                            <div class="card_date">
                                <i class="icon icon-calendar"></i>
                                <p>23 janvier 2023</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row_view_more">
                <div class="row_view_more_content">
                    <a href="#">VOIR TOUS LES ARTICLES</a>
                    <img src="assets/images/svg/Arrow Bottom Right.svg" alt="">
                </div>
                
            </div>
        </div>
    </div>
</main>  -->
<?php
echo view('partials/footer.php');
echo view('partials/doc_footer.php');
?>