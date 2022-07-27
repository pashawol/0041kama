<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>


<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="sCard__price">
    <? if($product->get_price() && $product->get_price() != 0) :?>
    Цена: 

    <? echo (
        array_search('16', $product->category_ids) !== false or 
        array_search('28', $product->category_ids) !== false or 
        array_search('29', $product->category_ids) !== false
    ) ? 'от ':''; ?> 

    <meta itemprop="price" content="<?php echo $product->get_price(); ?>">
    <meta itemprop="priceCurrency" content="RUB">
    <link itemprop="availability" href="http://schema.org/InStock">



    <span itemprop="price"><?php echo number_format($product->get_price(), 0, '.', ' ') ?></span>
    <span itemprop="priceCurrency" content="RUB">₽</span>

    <? else :?>
        Цена не указана
    <? endif; ?>
</div>
