<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if(get_field('related_products')):?>

<section class="sSimilar section" id="sSimilar">
    <div class="container">
        <div class="section-title">
            <div class="h4">Похожие товары</div>
            <div class="section-title__arrows">
                <div class="swiper-button-hand swiper-button-hand-prev swiper-button-prev">
                    <svg class="icon icon-chevron-left ">
                        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#chevron-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-hand swiper-button-hand-next swiper-button-next">
                    <svg class="icon icon-chevron-right ">
                        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#chevron-right"></use>
                    </svg>
                </div>
            </div>
        </div>
        <div class="sSimilar__slider sSimilar__slider--js swiper-container">
            <div class="swiper-wrapper">
                <?php foreach (get_field('related_products') as $related_product ) :
                $post_object = get_post( $related_product->ID);
                setup_postdata( $GLOBALS['post'] =& $post_object );
                $src = get_the_post_thumbnail_url($post_object->ID, 'full');
                $prod = new WC_Product($post_object->ID);
                ?>
                <div class="sSimilar__slide swiper-slide"> 
                    <div class=" ">
                        <a class="card-item bg-wrap" href="<? the_permalink(); ?>">
                            <!-- picture-->
                            <picture class="picture-bg"> 
                                <? if($src) :?>
                                    <img class="object-fit-js" src="<?=$src ?>" alt="" loading="lazy"/>
                                <? else :?>
                                    <img class="object-fit-js" src="/wp-content/uploads/2021/12/cover-1.png" alt="" loading="lazy"/>
                                <? endif; ?>

                            </picture>
                            <!-- /picture-->
                            <div class="card-item__caption">
                                <div class="card-item__title">
                                    <? the_title() ;?>
                                </div>
                                <div class="card-item__price h5">
                                    <?= $prod->get_price_html() ?>
                                </div>
                                <div class="card-item__btn-wrap">
                                    <div class="card-item__btn btn-js">
                                        Подробнее
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <? endforeach; 
                wp_reset_postdata();
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
<? else: ?>
    <? if ( $related_products ) : ?>
    <!-- start sSimilar-->
    <section class="sSimilar section" id="sSimilar">
        <div class="container">
            <div class="section-title">
                <div class="h4">Похожие товары</div>
                <div class="section-title__arrows">
                    <div class="swiper-button-hand swiper-button-hand-prev swiper-button-prev">
                        <svg class="icon icon-chevron-left ">
                            <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#chevron-left"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-hand swiper-button-hand-next swiper-button-next">
                        <svg class="icon icon-chevron-right ">
                            <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#chevron-right"></use>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="sSimilar__slider sSimilar__slider--js swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $related_products as $related_product ) :
    				$post_object = get_post( $related_product->get_id() );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    $src = get_the_post_thumbnail_url($post_object->ID, 'full');
                    $prod = new WC_Product($post_object->ID);
                    ?>
                    <div class="sSimilar__slide swiper-slide"> 
                        <div class=" ">
                            <a class="card-item bg-wrap" href="<? the_permalink(); ?>">
                                <!-- picture-->
                                <picture class="picture-bg"> 
                                <? if($src) :?>
                                    <img class="object-fit-js" src="<?=$src ?>" alt="" loading="lazy"/>
                                <? else :?>
                                    <img class="object-fit-js" src="/wp-content/uploads/2021/12/cover-1.png" alt="" loading="lazy"/>
                                <? endif; ?>
                                </picture>
                                <!-- /picture-->
                                <div class="card-item__caption">
                                    <div class="card-item__title">
                                        <? the_title() ;?>
                                    </div>
                                    <div class="card-item__price h5">
                                        <?= $prod->get_price_html() ?>
                                    </div>
                                    <div class="card-item__btn-wrap">
                                        <div class="card-item__btn btn-js">
                                            Подробнее
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <? endforeach; 
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <? endif; ?>
<? endif; ?>