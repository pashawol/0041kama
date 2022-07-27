<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}


if($product->get_availability()['class'] == 'in-stock') {
    echo "<p class='stock'>В наличии</p>";
}
else {
    echo "<p class='stock'>По предзаказу</p>";
}

//echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>
	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
    <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
        <div class="sCard__buttons">
            <div class="row">
                <div class="col-6 col-lg-12 col-xl-6">
                    <a class="sCard__btn btn btn-primary link-modal-js"  href="#modal-request">
                        Оставить заявку
                    </a>
                </div>
                <div class="col-6 col-lg-12 col-xl-6">
                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="sCard__btn btn btn-outline-primary add-to-cart-ajax">
                    <svg class="icon icon-basket ">
                        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#basket"></use>
                    </svg>В корзину
                    </button>
                </div>
            </div>
        </div>
        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
<?php endif; ?>