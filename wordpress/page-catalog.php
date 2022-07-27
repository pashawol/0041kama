<?php get_header(); ?>

<!-- start sCategories-->
<section class="sCategories section" id="sCategories">
    <div class="container">
        <div class="section-title text-center">
            <h1>Каталог товаров</h1>
        </div>
        <div class="row">
            <? foreach(getCatalog() as $cat) :?>
            <div class="col-6 col-md-4 col-lg-3">
                <a class="category-item" href="<?=$cat['url'] ?>">
                    <div class="category-item__img-wrap">
                        <!-- picture-->
                        <picture> 
                            <source type="image/webp" srcset="<?=$cat['image'] ?>"/>
                            <img src="<?=$cat['image'] ?>" alt="" loading="lazy"/>
                        </picture>
                        <!-- /picture-->
                    </div>
                    <div class="category-item__caption">
                        <div class="category-item__title">
                            <?=$cat['title'] ?>
                        </div>
                        <div class="category-item__amount text-secondary">
                            <?=$cat['term'] ?> товаров
                        </div>
                    </div>
                </a>
            </div>
            <? endforeach; ?>
        </div>
    </div>
</section>
<!-- end sCategories-->


<?
get_footer();
