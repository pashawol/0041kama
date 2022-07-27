<?php
/**
 * WC Cart PDF template
 *
 * @package wc-cart-pdf
 */

/**
 * Before template hook
 *
 * @since 1.0.4
 * @package dkjensen/wc-cart-pdf
 */
do_action( 'wc_cart_pdf_before_template' );

$customer = wc_cart_pdf_get_customer();
$logo     = get_option( 'wc_cart_pdf_logo', get_option( 'woocommerce_email_header_image' ) );
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,800;1,900&display=swap" rel="stylesheet">


<div class="wc_cart_pdf_template">
	<?php if ( $logo ) { ?>

		<div id="template_header_image">
			<p style="margin-top: 0; text-align: <?php echo esc_attr( get_option( 'wc_cart_pdf_logo_alignment', 'center' ) ); ?>;">
				<img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo get_option( 'wc_cart_pdf_logo_width' ) ? esc_attr( get_option( 'wc_cart_pdf_logo_width' ) ) . 'px' : 'auto'; ?>;" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
			</p>
		</div>

	<?php } ?>
	
    
    
    <h1 style="margin-bottom:-00px;">Корзина</h1>
    
	<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
		

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                        
                        
                        
                        <table>
                        <tr>
						<td width="120">
                            
                            
                            
                            
						<?php

                    
                    
                        $src = wp_get_attachment_image_url($_product->get_image_id(), 'product-card-navgal');

						?>
                            
                            <img width="90" src="<? echo $src ?>">
                           
                            
                            
						</td>

						<td>
                            
                            <h3 class="bold">
						      <?= $_product->get_name() ?>
                            </h3>
                            <br>
                            <h4>Цена: 
                                <? echo number_format(get_post_meta($cart_item['product_id'] , '_price', true), 0, '.', ' '); ?> руб.</h4>
                            
                            
						</td>
                        </tr>
                        </table>
						
                        
                        
                        
                        
                        
                        
					</div>
					<?php
				}
			}
			?>

		

			<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<div class="text-right">
                    <h2>Итого: <? echo number_format(WC()->cart->cart_contents_total, 0, '.', ' '); ?> руб.</h2>
                </div>
            
            

			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>
	<div id="template_footer">
		www.td-ktc.ru
	</div>
</div>

<?php
/**
 * After template hook
 *
 * @since 1.0.4
 */
do_action( 'wc_cart_pdf_after_template' );
