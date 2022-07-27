<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$attachment_ids = $product->get_gallery_image_ids();


if ( $attachment_ids && $product->get_image_id() ) {
    echo '<div class="sCard__slider sCard__slider--js swiper-container"><div class="swiper-wrapper">';
	foreach ( $attachment_ids as $attachment_id ) {
        $src = wp_get_attachment_image_url($attachment_id, 'product-card');
        $src_full = wp_get_attachment_image_url($attachment_id, 'full');
        echo '<div class="sCard__slide swiper-slide">';
        echo '<a class="sCard__img-wrap" href="'.$src_full.'" data-fslightbox="sCard-gallery">';
        echo '<img src="'.$src.'" alt=""/>';
        echo '</a>';
        echo '</div>';
	}

    foreach(get_field('videogallery') as $video) {
        echo '<div class="sCard__slide swiper-slide"><div class="sCard__video-wrap"><video class="fillItUp video" id="bgvid" playsinline="playsinline" muted="muted" loop="loop"><source src="'.$video['video'].'" type="video/mp4" loading="lazy"/></video></div></div>';
    }


    echo '</div></div>';
    echo '<div class="sCard__slider-thumbs sCard__slider-thumbs--js swiper-container"><div class="swiper-wrapper">';
    foreach ( $attachment_ids as $attachment_id ) {
        $src_navgal = wp_get_attachment_image_url($attachment_id, 'product-card-navgal');
        echo '<div class="sCard__slide swiper-slide"><div class="sCard__img-wrap">';
        echo '<img src="'.$src_navgal.'" alt=""/>';
        echo '</div></div>';
	}

    foreach(get_field('videogallery') as $video) {
        echo '<div class="sCard__slide swiper-slide"><div class="sCard__img-wrap"><img src="'.$video['preview'].'" alt=""/><img class="icon" src="/wp-content/themes/kamacentr/assets/img/svg/play.svg" alt=""/></div></div>';
    }
    echo '</div></div>';
}
else {
    echo '<div class="sCard__slider sCard__slider--js swiper-container"><div class="swiper-wrapper">';
    echo '<div class="sCard__slide swiper-slide">';
    echo '<a class="sCard__img-wrap" href="/wp-content/uploads/woocommerce-placeholder.png" data-fslightbox="sCard-gallery">';
    echo '<img src="/wp-content/uploads/woocommerce-placeholder.png" alt=""/>';
    echo '</a>';
    echo '</div>';
    echo '</div></div>';
}
