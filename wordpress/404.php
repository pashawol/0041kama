<?php include(TEMPLATEPATH . "/header_404.php"); ?>
<div class="main-wrapper">
    <div class="page404">
        <div class="container">
            <div class="page404__logo"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/logo-full.svg" alt="..."/>
            </div>
            <!-- picture-->
            <picture class="pic404"> 
                <source type="image/webp" srcset="<?= bloginfo('template_directory'); ?>/assets/img/@2x/webp/pic404.webp"/><img src="<?= bloginfo('template_directory'); ?>/assets/img/@2x/pic404.jpg" alt="" loading="lazy"/>
            </picture>
            <!-- /picture-->
            <h1>Страница не найдена</h1>
            <div class="page404__caption">Неправильно набран адрес, или такой страницы не&nbsp;существует.
            </div>
            <div class="row row-btn">
                <a class="page404__btn btn btn-primary" href="/">Вернуться на главную
                </a>
            </div>
        </div>
    </div>
</div>
<? include(TEMPLATEPATH . "/footer_404.php");?>
