<?php get_header(); ?>

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
            <div class="contacts-page">
                
                        <div class="container">
                            <div class="contacts-page__title">Основная информация
                            </div>
                            <!-- start sContactInfo-->
                            <div class="sContactInfo section" id="sContactInfo">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 col-xl-3">
                                            <div class="sContactInfo__item">
                                                <div class="sContactInfo__img-wrap"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/contact-info-1.svg" loading="lazy" alt=""/>
                                                </div>
                                                <div class="sContactInfo__caption">
                                                    <div class="sContactInfo__title">Телефоны для заказа
                                                    </div>
                                                    <ul>
                                                        <li><a href="tel:+78007008572">8 (800) 700-85-72</a></li>
                                                        <li><a href="tel:+79600799544">8 (960) 079-95-44</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-xl-3">
                                            <div class="sContactInfo__item">
                                                <div class="sContactInfo__img-wrap"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/contact-info-2.svg" loading="lazy" alt=""/>
                                                </div>
                                                <div class="sContactInfo__caption">
                                                    <div class="sContactInfo__title">Электронная почта
                                                    </div>
                                                    <ul>
                                                        <li><a href="mailto:zapchasty-kama@yandex.ru">zapchasty-kama@yandex.ru</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-xl-3">
                                            <div class="sContactInfo__item">
                                                <div class="sContactInfo__img-wrap"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/contact-info-3.svg" loading="lazy" alt=""/>
                                                </div>
                                                <div class="sContactInfo__caption">
                                                    <div class="sContactInfo__title">Адрес
                                                    </div>
                                                    <ul>
                                                        <li>г. Набережные Челны, пр&minus;т&nbsp;КАМАЗа, 22/3</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-xl-3">
                                            <div class="sContactInfo__item">
                                                <div class="sContactInfo__img-wrap"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/contact-info-4.svg" loading="lazy" alt=""/>
                                                </div>
                                                <div class="sContactInfo__caption">
                                                    <div class="sContactInfo__title">Режим работы
                                                    </div>
                                                    <ul>
                                                        <li>Пн-пт: с 8:00 до 17:00 мск <br> Сб: с 8:00 до 12:00 мск <br> Вс: выходной</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts-page__appeal">
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="contacts-page__appeal-logo">
                                            <svg class="icon icon-logo-icon ">
                                                <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#logo-icon"></use>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="contacts-page__appeal-title">Наша команда готова решить любые Ваши задачи связанные с&nbsp;поставкой высококачественных запасных частей.
                                        </div>
                                        <div class="contacts-page__appeal-respect">С&nbsp;уважением, команда ООО ТД&nbsp;&laquo;КАМАТЕХЦЕНТР&raquo;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts-page__map">
                                <div class="contacts-page__map-title">Расположение на карте
                                </div>
                                <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=2066e304-cee0-4ed2-9cb2-5f6521d5f96c" type="text/javascript"></script>
                                <div class="contacts-page__map-widget" id="map">
                                </div>
                            </div>
                            <div class="contacts-page__requisites">
                                <div class="contacts-page__requisites-head">
                                    <div class="title">Реквизиты организации</div><a target="_blank" class="pdf-btns" href="https://td-ktc.ru/wp-content/uploads/2021/09/rekvizity-ooo-td-kamatehcentr.pdf"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/pdf.svg"/><span>Скачать PDF</span></a>
                                </div>
                                <div class="contacts-page__requisites-table">
                                    <table>
                                            <tr>
                                                <td class="first">Название организации</td>
                                                <td class="second">ООО ТД&nbsp;&laquo;КАМАТЕХЦЕНТР&raquo;</td>
                                            </tr>
                                            <tr>
                                                <td class="first">ОГРН</td>
                                                <td class="second">1171690042347</td>
                                            </tr>
                                            <tr>
                                                <td class="first">ИНН</td>
                                                <td class="second">1650348340</td>
                                            </tr>
                                            <tr>
                                                <td class="first">КПП</td>
                                                <td class="second">165001001</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Юридический адрес</td>
                                                <td class="second">423809, РТ, г. Набережные&nbsp;Челны, пр-т. Мира, д.&nbsp;38, оф.&nbsp;57</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Почтовый адрес</td>
                                                <td class="second">423824, г. Набережные Челны, а/я 24021</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Расчетный счет</td>
                                                <td class="second">40702810629140002978</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Корреспондентский счет</td>
                                                <td class="second">30101810200000000824</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Банк</td>
                                                <td class="second">ФИЛИАЛ &laquo;НИЖЕГОРОДСКИЙ&raquo; АО&nbsp;&laquo;АЛЬФА-БАНК&raquo;</td>
                                            </tr>
                                            <tr>
                                                <td class="first">БИК</td>
                                                <td class="second">042202824</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Директор</td>
                                                <td class="second">Широнин Иван Константинович (на&nbsp;основании устава)</td>
                                            </tr>
                                            <tr>
                                                <td class="first">Телефон</td>
                                                <td class="second">8 (800) 700-85-72</td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
            </div>
            
            <div class="shop-form contacts-form">
                <h2>Форма обратной связи</h2>
                <div class="shop-form__caption">Если вы&nbsp;хотите обратиться с&nbsp;предложением, оставить отзыв или у&nbsp;вас есть вопросы, воспользуйтесь формой ниже:
                </div>
                <div class="form-wrap">
                    <?php echo do_shortcode( '[contact-form-7 id="174" title="Форма обратной связи" html_id="modal-id-6"]' ); ?>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
<?
get_footer();



