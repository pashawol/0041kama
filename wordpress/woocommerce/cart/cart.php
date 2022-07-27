<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
if(isset($_GET['check'])) {
    global $woocommerce;
    wp_enqueue_script( 'modalAdd', get_template_directory_uri() . '/assets/js/modalAddOrder.js', '', false, 'in_footer');
    $woocommerce->cart->empty_cart( $clear_persistent_cart = true );
}?>

<? do_action( 'woocommerce_before_cart' ); ?>


<div class="page-head">
    <div class="container">
        <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' » '); ?>
        <div class="row">
            <div class="col">
                <h1><? the_title(); ?></h1>
            </div>
            <div class="col-auto">
                <? if(!WC()->cart->is_empty()) :?>
                    <div class="shop-btns">
                        <a class="print-btns" href="javascript:window.print ()">
                            <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/print.svg"/>
                            <span>Распечатать</span>
                        </a>
                        <a target="_blank" class="pdf-btns" href="javascript:window.print ()">
                            <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/pdf.svg"/>
                            <span>Скачать PDF</span>
                        </a>        
                    </div>
                <? endif; ?>  
            </div>
        </div>
    </div>
</div>


<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
    <div class="shop-content">


        <div class="only-for-print">
            <div class="head-row"><img src="https://td-ktc.ru/wp-content/themes/kamacentr/assets/img/svg/logo-head.svg" alt=""/>
                <p>www.td-ktc.ru</p>
            </div>
        </div>


        <div class="print-body">
            <h4 class="only-for-print">Корзина</h4>


	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
            $json = [];
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    
                    $json[] = [(int)$product_id, $cart_item['quantity']];
                    
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->get_permalink( $cart_item ), $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item tr-product <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						

						<td class="product-thumbnail shop-content__td-pic">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    
                        $src = wp_get_attachment_image_url($_product->get_image_id(), 'product-card-navgal');
                    
						if ( ! $product_permalink ) {
							echo $src; // PHPCS: XSS ok.
						} else {

                            $src = $src ? $src : 'https://td-ktc.ru/wp-content/uploads/woocommerce-placeholder.png';
                            printf( '<a href="%s"><picture>%s</picture></a>', esc_url( $product_permalink ), '<img src="'.$src.'">' ); // PHPCS: XSS ok.
                            
							
						}


                        
						?>
						</td>

						<td class="product-name shop-content__td-caption" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                            
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="title" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}
                        


    


						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
                            
                            
                        <div class="price">
                             
                            <? 

                            

                            if($_product->price) {
                                echo 'Цена: ';
                                echo (
                                    array_search('16', $_product->category_ids) !== false or 
                                    array_search('28', $_product->category_ids) !== false or 
                                    array_search('29', $_product->category_ids) !== false
                                ) ? 'от ':'';


                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                            }
                            else {
                                echo 'Цена не указана';
                            }
                        ?>
                            
                        </div>
						</td>

						
						<td class="product-quantity shop-content__td-count" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                            <div class="row btn-quanity-input">
                            

                                <button class="shop-content__btn shop-content__btn--minus" <?= $cart_item['quantity'] == 1 ? 'disabled' : '' ?> data-action="minus" type="button"></button>
                                
                                <?php
                                if ( $_product->is_sold_individually() ) {
                                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                } else {
                                    $product_quantity = woocommerce_quantity_input(
                                        array(
                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $_product->get_max_purchase_quantity(),
                                            'min_value'    => '0',
                                            'product_name' => $_product->get_name(),
                                        ),
                                        $_product,
                                        false
                                    );
                                }

                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                ?>
                                <button class="shop-content__btn shop-content__btn--plus" data-action="plus" type="button"></button>
                            
                            </div>
						</td>
                        
                        <td class="product-remove shop-content__td-close">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><div class="shop-content__div-close"><svg class="icon icon-close "><use xlink:href="/wp-content/themes/kamacentr/assets/img/svg/sprite.svg#close"></use></svg></div></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>
                        
                        


						
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr style="display:none">
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>

            <?php
                /**
                 * Cart collaterals hook.
                 *
                 * @hooked woocommerce_cross_sell_display
                 * @hooked woocommerce_cart_totals - 10
                 */
                do_action( 'woocommerce_cart_collaterals' );
            ?>
        
        
    </div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
    </div>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>


<?php do_action( 'woocommerce_after_cart' ); ?>



<div class="shop-form">
    <h2>Оформление заказа</h2>
    <div class="shop-form__caption">
        Заполните форму, и&nbsp;наш менеджер свяжется с&nbsp;Вами в&nbsp;ближайшее время для уточнения деталей заказа.
    </div>
    <div class="form-wrap">
        <form  id="checkout_cart_from" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
            <input type="hidden" name="action" value="cart_order">
            
            <textarea style="display:none" name="wc"><?= json_encode($json) ?></textarea>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="form-wrap__input-wrap form-group">
                        <input class="form-wrap__input form-control" name="name" type="text" placeholder="Ваше имя"/>
                    </div>
                    <!-- +e.input-wrap-->
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-wrap__input-wrap form-group">
                        <input required class="form-wrap__input form-control" name="phone" type="tel" id="phone-required" placeholder="Ваш телефон"/>
                    </div>
                    <!-- +e.input-wrap-->
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-wrap__input-wrap form-group">
                        <input class="form-wrap__input form-control" name="email" type="email" placeholder="Ваш e-mail"/>
                    </div>
                    <!-- +e.input-wrap-->
                </div>
                <div class="col-12">
                    <div class="form-wrap__input-wrap form-group">
                        <textarea class="form-wrap__input form-control" name="comment" placeholder="Ваш комментарий к заказу"></textarea>
                    </div>
                    <!-- +e.input-wrap-->
                </div>
                <div class="col-md-auto col-12">
                    <input type="submit" id="checkout_cart_btn" class="form-wrap__btn btn btn-primary" value="Оформить заказ">
                    
                    
                </div>
                <div class="col-md col-12">
                    <div class="agreement">
                        <label class="custom-input form-check"><input class="custom-input__input form-check-input" name="checkbox" type="checkbox" checked="checked"/><span class="custom-input__text form-check-label">Я&nbsp;согласен на&nbsp;обработку моих персональных данных в&nbsp;соответствии с&nbsp;<a href="#">Условиями</a></span>
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
