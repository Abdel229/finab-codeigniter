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
                        <img src="<?= base_url('images/svg/finab_head.svg') ?>" class="finab-head" alt="finab-head">
                    </div>
                    <h1 class="h1 pg-title">Galleries d'images</h1>
                </div>
            </div>
        </section>
        <section class="partner-section section-default-therm">
            <div class="container">
                <div class="category-container">
                    <div class="programme-box__bottom__search">
                        <p class="gallerie-categorie"><?= isset($activeCategory) ? $activeCategory['name']:'Tout' ?></p>
                        <span>Filtrage par catégorie</span>
                        <select name="programme_search" id="programmeSearch">
                            <option value="" data-href="<?= base_url('galleries') ?>">Tout</option>
                            <?php foreach ($allCategories as $categorie) : ?>
                                <option value="" data-href="<?= base_url('galleries/per-category/' . $categorie['id']) ?>" <?= isset($activeCategory) && $activeCategory['id'] == $categorie['id'] ? 'selected' : '' ?>>
                                    <?= $categorie['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="">
                        <?php foreach ($data as $item) : ?>
                            <?php foreach ($item['galleries'] as $gallery) : ?>
                                <div style="display:flex">
                                    <p class="gallerie-categorie"><?=$item['category']['name']?></p>
                                </div>
                                <div class="gallerie__list">
                                <a href="<?= $gallery['img_principales'] ?>" data-fancybox="<?= $gallery['name'] ?>" class="column__gallerie__list" data-title="<?= $gallery['name'] ?>">
                                    <img src="<?= base_url($gallery['img_principales']) ?>" alt="distinction_img">
                                    <p class="img-title"><?=$gallery['name']?></p>
                                </a>
                                <?php foreach ($item['images'] as $image) : ?>
                                    <a href="<?= $image['img'] ?>" data-fancybox="<?= $gallery['name'] ?>" class="column__gallerie__list" data-title="<?= $gallery['name'] ?>">
                                        <img src="<?= base_url($image['img']) ?>" alt="distinction_img">
                                        <p class="img-title"><?=$gallery['name']?></p>
                                    </a>
                                <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php echo view('sections/last-events'); ?>
    </main>
</div>
<?php
echo view('partials/footer');
echo view('partials/doc_footer');
?>