<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) ) {
	return;
}
?>


<a class="list-group-item" href="<?=get_permalink( $product->id ) ?>">
    <svg class="icon icon-chevron-right ">
        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#chevron-right"></use>
    </svg>
    <span><?=$product->name ?></span>
</a>
