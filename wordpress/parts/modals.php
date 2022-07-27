<!-- #modal-in-cart-->
<div class="modal-win request" id="modal-request" style="display: none">
    <div class="form-wrap">
        <?php echo do_shortcode( '[contact-form-7 id="44" title="Оставить заявку" html_id="modal-id-1"]' ); ?>
    </div>
</div>


<div class="modal-win request" id="modal-recall" style="display: none">
    <div class="form-wrap">
        <?php echo do_shortcode( '[contact-form-7 id="113" title="Заказать звонок" html_id="modal-id-2"]' ); ?>
    </div>
</div>


<?  
if(is_product()) :
global $product;
?>
<div class="modal-win short-modal in-cart" id="modal-in-cart" style="display: none">
    <div class="form-wrap">
        <form>
            <div class="h2">Товар добавлен в&nbsp;корзину</div>
            <div id="title_product" class="form-wrap__caption">
                <?=$product->name ?>
            </div>
            <div class="btns">
                <a href="/cart/" class="form-wrap__btn btn btn-primary">
                    Оформить заказ
                </a>
                <div class="form-wrap__btn btn btn-outline-primary modal-close-js">
                    Продолжить покупки
                </div>
            </div>
        </form>
    </div>
</div>
<? endif; ?>


<div class="modal-win short-modal order-cart" id="modal-order-cart" style="display: none">
    <div class="form-wrap">
        <form>
            <div class="h2">Мы приняли ваш заказ</div>
            <div id="title_product" class="form-wrap__caption">
               Мы свяжемся с вами в ближайшее время
            </div>
            <div class="btns">
                <a href="/catalog/" class="form-wrap__btn btn btn-primary">
                    Перейти в каталог
                </a>
                <div class="form-wrap__btn btn btn-outline-primary modal-close-js">
                    Закрыть
                </div>
            </div>
        </form>
    </div>
</div>



<div class="modal-win short-modal" id="modal-gratitude" style="display: none">
    <div class="form-wrap">
        <form>
            <div class="h2">Спасибо за обращение!</div>
            <div class="form-wrap__caption">
                Наш менеджер свяжется с&nbsp;Вами в&nbsp;ближайшее время для уточнения деталей заказа
            </div>
            <div class="form-wrap__btn btn btn-primary modal-close-js">
                Закрыть
            </div>
        </form>
    </div>
</div>

<div class="modal-win city-choose" id="modal-search-list" style="display: none">
    <div class="form-wrap">
        <form>
            <div class="h2">Выберите город</div>
            <div class="form-wrap__input-wrap form-group">
                <input id="input_search_city" class="form-wrap__input form-control input-search" name="text" type="text" placeholder="Ваш город"/>
                
                
                <button class="btn btn--input btn-close-js" type="button">
                    <svg class="icon icon-close ">
                        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#close"></use>
                    </svg>
                </button>
                
                
                
                
            </div>
            <!-- +e.input-wrap-->
            <div class="form-wrap__scroll-list">
                <ul id="list_city">
                
                    
                <?
                if(isset($_COOKIE['region_name'])){
                      echo '<a class="elem_region" data-name="'.$_COOKIE['region_name'].'" href="#"><li class="active">'.$_COOKIE['region_name'].'</li></a>';
                    }else{
                      echo '<a class="elem_region" data-name="Набережные челны" href="#"><li class="active">Набережные челны</li></a>';
                    }
                ?>
                
                
                <a class="elem_region" data-name="Барнаул" href="#"><li>Барнаул</li></a> <a class="elem_region" data-name="Волгоград" href="#"><li>Волгоград</li></a> <a class="elem_region" data-name="Воронеж" href="#"><li>Воронеж</li></a> <a class="elem_region" data-name="Екатеринбург" href="#"><li>Екатеринбург</li></a> <a class="elem_region" data-name="Иркутск" href="#"><li>Иркутск</li></a> <a class="elem_region" data-name="Кемерово" href="#"><li>Кемерово</li></a> <a class="elem_region" data-name="Красноярск" href="#"><li>Красноярск</li></a> <a class="elem_region" data-name="Новосибирск" href="#"><li>Новосибирск</li></a> <a class="elem_region" data-name="Омск" href="#"><li>Омск</li></a> <a class="elem_region" data-name="Оренбург" href="#"><li>Оренбург</li></a> <a class="elem_region" data-name="Пермь" href="#"><li>Пермь</li></a> <a class="elem_region" data-name="Ростов-на-Дону" href="#"><li>Ростов-на-Дону</li></a> <a class="elem_region" data-name="Самара" href="#"><li>Самара</li></a> <a class="elem_region" data-name="Саратов" href="#"><li>Саратов</li></a> <a class="elem_region" data-name="Томск" href="#"><li>Томск</li></a> <a class="elem_region" data-name="Тула" href="#"><li>Тула</li></a> <a class="elem_region" data-name="Тюмень" href="#"><li>Тюмень</li></a> <a class="elem_region" data-name="Улан-Удэ" href="#"><li>Улан-Удэ</li></a> <a class="elem_region" data-name="Хабаровск" href="#"><li>Хабаровск</li></a> <a class="elem_region" data-name="Якутск" href="#"><li>Якутск</li></a>
                    
                    
                </ul>
            </div>
        </form>
    </div>
</div>