<?php get_header(); ?>

<div class="container container--main">
    <div class="row row--main">
        <? if ( is_singular( 'product' ) ) {
            woocommerce_content();
        }
        else {
            woocommerce_get_template( 'archive-product.php' );
        } ?>
    </div>
</div>

<? if ( is_singular( 'product' ) ) {
    load_template(TEMPLATEPATH . '/parts/product_footer.php');
}
get_footer();