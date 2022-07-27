<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>

<div class="page-head">
    <div class="container">
        <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' » '); ?>
        <div class="row">
            <div class="col">
                <h1><? the_title(); ?></h1>
            </div>
            <div class="col-auto">
                
            </div>
        </div>
    </div>
</div>


<?do_action( 'woocommerce_cart_is_empty' );

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<p class="return-to-shop">
		<a class="form-wrap__btn btn btn-primary" href="/catalog/">Перейти в каталог</a>
	</p>
<?php endif; ?>
