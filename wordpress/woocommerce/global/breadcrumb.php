<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {
	echo $wrap_before;
    echo '<nav class="swiper-container breadcrumb-slider--js" aria-label="breadcrumb">';
    echo '<ol class="breadcrumb swiper-wrapper" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">';
    $i = 1;
	foreach ( $breadcrumb as $key => $crumb ) {
		echo $before;
		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
            echo '<li class="swiper-slide breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">';
			echo '<a itemprop="item" href="' . esc_url( $crumb[1] ) . '">';
            echo '<span itemprop="name">'.esc_html( $crumb[0] ).'</span>';
            echo '<meta itemprop="position" content="'.$i.'"/></a>';
            echo '</li>';
		} else {
			echo '<li class="swiper-slide breadcrumb-item active" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">';
			echo '<a itemprop="item" href="' . esc_url( $crumb[1] ) . '">';
            echo '<span itemprop="name">'.esc_html( $crumb[0] ).'</span>';
            echo '<meta itemprop="position" content="'.$i.'"/></a>';
            echo '</li>';
		}
		echo $after;
        $i++;
	}
    echo '</ol></nav>';
	echo $wrap_after;
}