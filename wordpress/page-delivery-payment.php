<?php get_header();?>
<div class="container container--main">
    <div class="row row--main">
        <? load_template(TEMPLATEPATH . '/parts/sidebar.php'); ?>
        <div class="col-9 col--ph">
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
            <div class="delivery-page">
                <div class="container">
                    <div class="delivery-page__map"><img class="delivery-page__map-russia wow" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-russia.svg" alt="" role="presentation"/><img class="map-truck wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/map-truck.png" data-wow-delay="1.5s" data-wow-duration="2s"/><img class="map-plane wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/map-plane.png" data-wow-delay="2s" data-wow-duration="1s"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point1" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point2" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point3" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point4" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point5" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point6" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point7" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point8" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point9" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point10" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point11" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point12" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point13" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point14" data-wow-delay="1s" alt="" role="presentation"/><img class="delivery-page__map-point wow fadeIn" src="<?= bloginfo('template_directory'); ?>/assets/img/svg/map-point.svg" id="point15" data-wow-delay="1s" alt="" role="presentation"/>
                    </div>
                    <div class="delivery-page__description">
                        <div class="delivery-page__description-title">Доставка
                        </div>
                        <div class="delivery-page__description-text">Осуществляем доставку по&nbsp;всей России от&nbsp;2&nbsp;дней без предоплаты через транспортные компании:
                        </div>
                        <div class="delivery-page__description-list">
                            <ul>
                                <li>Байкал Сервис</li>
                                <li>ПЭК</li>
                                <li>Деловые линии</li>
                                <li>GTD</li>
                                <li>Энергия</li>
                            </ul>
                        </div>
                    </div>
                    <div class="delivery-page__methods">
                        <div class="delivery-page__methods-title">Способы оплаты
                        </div>
                        <div class="delivery-page__methods-text">Оплата осуществляется наличным или безналичным расчетом с&nbsp;НДС.
                        </div><a class="pdf-btns" target="_blank" href="/wp-content/uploads/2021/09/rekvizity-ooo-td-kamatehcentr.pdf"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/pdf.svg"/><span>Реквизиты организации</span></a>
                    </div>
                    <div class="delivery-page__benefit">
                        <div class="row">
                            <div class="col-auto"><img src="<?= bloginfo('template_directory'); ?>/assets/img/benefit-1.png"/></div>
                            <div class="col">
                                <div class="delivery-page__benefit-title">Каждый двигатель отправляется в&nbsp;жесткой упаковке.
                                </div>
                                <div class="delivery-page__benefit-text">Мы&nbsp;используем обрешетку для упаковки двигателя, чтобы исключить возможность повреждения двигателя во&nbsp;время транспортировки.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();