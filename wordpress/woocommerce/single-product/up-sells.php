<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $upsells ) : ?>

<pre>
    <? //print_r($upsells); ?>
</pre>


<!-- end sCard-->
<div class="sCardLink">
    <h4 class="strong mb-3">Дополнительные модификации</h4>
    <div class="list-group">
        

        
        <?php foreach ( $upsells as $upsell ) : ?>

            <?php
            $post_object = get_post( $upsell->get_id() );

            setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

            wc_get_template_part( 'content', 'upsale' );
            ?>

        <?php endforeach; ?>
        

    </div>
</div>


	<?php
endif;

wp_reset_postdata();
