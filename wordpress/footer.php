<?
load_template(TEMPLATEPATH . '/parts/modals.php');
?>


<? 
/*
if(!isset($_COOKIE['modal_cookies'])) :?>
<div class="modal-cookies" id="modal-cookies">
    <button class="modal-cookies__is-close" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1">
            <path d="M20 20L4 4m16 0L4 20"></path>
        </svg>
    </button>
    <div class="modal-cookies__caption">Мы используем файлы cookie, чтобы пользование сайтом было удобнее. Подробнее в <a href='/wp-content/uploads/2021/09/polzovatelskoe_soglashenie_td_ktc_ru.pdf'>политике об обработке персональных данных</a>
    </div>
    <span class="modal-cookies__btn">Понятно
    </span>
</div>
<? 

endif; 
*/?>

<!-- end sQ-->
        <footer class="footer">
            <div class="footer__body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-auto col-xl-3 order-md-4">
                            <a class="footer__logo d-block d-md-none" href="/"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/logo.svg" alt=""/>
                            </a>
                            <ul class="footer__contacts">
                                <li><a class="link-white" href="tel:+78007008572">8 (800) 700-85-72</a></li>
                                <li class="tel-n-social"><a class="strong" href="tel:+79600799544">8 (960) 079-95-44</a>
                                    <div class="soc">
                                        <a class="soc__item soc__item--telegram" href="https://t.me/td_ktc" target="_blank"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/telegtam.svg" alt=""/>
                                        </a>
                                        <a class="soc__item soc__item--viber" href="https://wa.me/79600799544" target="_blank"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/whatsapp.svg" alt=""/>
                                        </a>
                                        <a class="soc__item soc__item--whatsapp" href="https://viber.click/79600799544" target="_blank"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/viber.svg" alt=""/>
                                        </a>
                                    </div>
                                </li>
                                <li><a class="link-modal-js" href="#modal-recall">Заказать звонок</a></li>
                                <li><a class="link-secondary2" href="mailto:zapchasty-kama@yandex.ru">zapchasty-kama@yandex.ru</a></li>
                            </ul>
                        </div>
                        <div class="col col-xl-3 order-md-3">
                            <div class="footer__location">
                                <ul>
                                    <li> 
                                        <div class="footer__adress text-white">г. Набережные Челны, пр-т КАМАЗа, 22/3
                                        </div>
                                    </li>
                                    <li>Пн-пт: с&nbsp;8:00 до&nbsp;17:00 мск</li>
                                    <li>Сб: с&nbsp;8:00 до&nbsp;12:00 мск</li>
                                    <li>Вс: выходной</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-auto col-xl-3 order-md-1">
                            <a class="footer__logo d-none d-md-block" href="/"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/logo.svg" alt=""/>
                            </a>
                            <ul class="footer__legal">
                                <li>ОГРН 1171690042347</li>
                                <li>ИНН 1650348340</li>
                                <li>КПП 165001001</li>
                            </ul>
                        </div>
                        <div class="col-lg-3 d-none d-lg-block order-md-2">
                            
                            <?
                            wp_nav_menu( [
                                'theme_location'  => 'footer',
                                'menu'            => '',
                                'container'       => 'nav',
                                'container_class' => 'footer__menu',
                                'container_id'    => '',
                                'menu_class'      => '',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul>%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => '',
                            ] );
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__info">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg">
                            <div class="footer__copyright text-white">© ООО ТД «КАМАТЕХЦЕНТР» <?= date("Y") ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-auto text-center">
                            <a target="_blank" class="footer__policy link-secondary2" href="https://td-ktc.ru/wp-content/uploads/2021/09/polzovatelskoe_soglashenie_td_ktc_ru.pdf">Политика обработки персональных данных
                            </a>
                        </div>
                        <div class="col-12 col-lg">
                            <div class="footer__developer">Создание сайта – <a rel="nofollow" class="link-white" target="_blank" href="https://t.me/arts_man">Artsman</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__warning">
                <div class="container">
                    <p>Обращаем Ваше внимание на то, что данный Интернет-сайт носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации. ООО ТД КамаТехЦентр предлагает оригинальные запасные части для автомобилей КАМАЗ, а также продукцию заводов-смежников, которые не имеют отношения к торговой марке КАМАЗ. Все товары приобретены официально, при этом ООО ТД КамаТехЦентр не является официальным дилером ПАО Камаз. Упоминание КАМАЗ на данном сайте говорит о применяемости предлагаемых запасных частей к автомобилям марки КАМАЗ.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- end modals-->
    <link href="<?= bloginfo('template_directory'); ?>/assets/libs/animate.css/animate.min.css" rel="stylesheet"/>
    <!-- modal libs-->
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.cookie.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/@fancyapps/ui/fancybox.umd.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/fslightbox/index.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/js/jquery.readall.min.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/wowjs/wow.min.js"></script>
    <!-- modal libs-->
    <!-- slider libs-->
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/swiper/swiper-bundle.min.js"> </script>
    <!-- /slider libs-->
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/inputmask/inputmask.min.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/libs/hc-sticky/hc-sticky.js"></script>
    <script src="<?= bloginfo('template_directory'); ?>/assets/js/common.js"></script>
    <link href="<?= bloginfo('template_directory'); ?>/assets/css/custom.css" rel="stylesheet"/>
    <style>
        .wpcf7-response-output, .woocommerce-product-gallery__trigger {
            display:none;
        }
        .wpcf7-list-item {
            margin: 0 !important;
        }
        .form-wrap__input-wrap textarea {
            height: 100px;
        }
    </style>

    <script>
        document.body.classList.add('loaded');
        var wow = new WOW({
            mobile: false,
            animateClass: 'animate__animated'
        });

        window.onload = function () {
            if (!sessionStorage.getItem('key') == 1) {
                window.setTimeout(function () {
                    wow.init();
                }, 500);
                sessionStorage.setItem('key', 1);
                console.log(1);
            }
        };

        if (sessionStorage.getItem('key') == 1) {
            document.body.classList.remove('loaded_hiding');
            wow.init();
            console.log(0);
        }

        var thisurl = window.location.pathname;
        if($('#hidden_url')) {
           $('#hidden_url').val('http://td-ktc.ru/'+thisurl);
        }
        
        <?php
        for($i=1; $i<7;$i++) 
        { ?>
            if(document.querySelector( '#modal-id-<?= $i ?>' )) 
            {
                var wpcf7Elm_<?= $i ?> = document.querySelector( '#modal-id-<?= $i ?>' );
                wpcf7Elm_<?= $i ?>.addEventListener( 'wpcf7mailsent', function( event ) {
                    Fancybox.close(true);
                    Fancybox.show([{ src: "#modal-gratitude", type: "inline" }]);
                }, false );
            }
        <? 
         }
        ?>

            
        $('.modal-cookies__is-close').click(function() {
            closeCookieModal();
        });
        
        $('.modal-cookies__btn').click(function() {
            closeCookieModal();
        });
        
        
        
        function closeCookieModal() {
            document.cookie = "modal_cookies=close; path=/";
            
            $('#modal-cookies').addClass('d-none');
        }
      
        
    </script>


<?php wp_footer(); ?>

</body>
</html>