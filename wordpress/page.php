<?php get_header(); ?>
<div class="container container--main">
    <div class="row row--main">
        <? load_template(TEMPLATEPATH . '/parts/sidebar.php'); ?>

        <? if(!is_cart()) :?>
        <div class="col-9 col--ph">
            <div class="page-head">
                <div class="container">
                    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' » '); ?>
                    <div class="row">
                        <div class="col">
                            <h1><? the_title(); ?></h1>
                        </div>
                        <div class="col-auto">
                            <? if(is_cart() && ! WC()->cart->is_empty()) :?>
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
            <? the_content(); ?>
        </div>
        <? else :?>
            <div class="col-9 col--ph">
                <? the_content(); ?>
            </div>
        <? endif;?>


    </div>
</div>
<?
get_footer();



