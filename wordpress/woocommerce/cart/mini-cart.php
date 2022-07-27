<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<a class="basket-btn" href="/cart/">
    <svg class="icon icon-basket ">
        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#basket"></use>
    </svg>
    
    
    <div style="opacity: 0;" class="basket-btn__count">
        <?//WC()->cart->get_cart_contents_count() ?>
    </div>
    
    
</a>


<?php do_action( 'woocommerce_after_mini_cart' ); ?>