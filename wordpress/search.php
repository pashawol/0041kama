<?php get_header(); ?>
<?
global $wp_query;


$args = array(
  'post_type' => 'product',
  'orderby'        => 'title',
  'order'          => 'ASC',
  'tax_query' => array(
      array(
            'taxonomy'      => 'product_visibility',
            'field'         => 'slug',
            'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
            'operator'      => 'NOT IN'
        )
  )
);



query_posts(
    array_merge(
        $args, // это параметр который добавили мы
        $wp_query->query   // это массив базового запроса текущей страницы
    )
);


//customPrint($wp_query->query_vars);
?>
<!-- end header-->
<div class="page-body04 section" id="page-body04">
    <div class="container">
        <div class="row row--search">
            <div class="col-xl-9 col-12 col--search">
                <div class="page-head">
                    <div class="container">
                        <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' » '); ?>
                        <div class="row">
                            <div class="col">
                                <h1>Результаты поиска</h1>
                            </div>
                            <div class="col-auto">
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="page-body04__input-search">
                    <form action="<?php bloginfo( 'url' ); ?>" method="get">
                    <div class="page-body04__input-wrap form-group">
                        <input class="page-body04__input form-control" name="s" type="text" value="<?=$_GET['s']?>"/>
                        <button>
                            <svg class="icon icon-search-icon ">
                                <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#search-icon"></use>
                            </svg>
                        </button>
                    </div>
                    </form>
                </div>
                
                
                <div class="page-body04__caption-search">
                    <div class="page-body04__title">
                        Вы искали:&nbsp;
                        <span><?=$_GET['s']?></span>
                    </div>
                    <div class="page-body04__count">
                        Найдено на сайте: 
                        <span><?=$wp_query->found_posts ?></span>
                    </div>
                </div>
                
                <div class="page-body04__result">
                    
                    
                    <?php if (have_posts()): while(have_posts()): the_post();?>
                    <a class="page-body04__item" href="<?the_permalink();?>">
                        <span><?the_title();?></span>
                        <svg class="icon icon-arrow ">
                            <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#arrow"></use>
                        </svg>
                    </a>
                    <?php endwhile; else:?>
                        
                    <?php endif;?>
                    
                    
                    
<!--
                    <?php echo the_posts_pagination(array(
                        'mid_size' => 4,
                        'end_size' => 2,
                    ));?>
-->
                    
                    
                    
                </div>
                
                
                <!--
                <div class="page-body04__btn btn-light animation-rotate">
                    <svg class="icon icon-refresh ">
                        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#refresh"></use>
                    </svg><span>Показать еще</span>
                </div>
                -->
                
                
            </div>
            <div class="col-xl-3 col-12 col--help">
                <div class="page-body04__help">
                    <svg class="icon icon-question ">
                        <use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#question"></use>
                    </svg>
                    <h4>Нужна помощь?</h4>
                    <div class="page-body04__caption-help">
                        <div class="span-first">Не&nbsp;можете найти необходимую информацию или&nbsp;товар?</div>
                        <div class="span-second">Вы&nbsp;всегда можете обратиться&nbsp;к нам по контактам&nbsp;указанным ниже. Мы&nbsp;будем рады помочь!</div>
                        <div class="page-body04__contact">
                            <div class="div-first">
                                <div class="span-call">Звонок бесплатный</div><a class="strong" href="tel:+78007008572">8(800)700-85-72</a>
                            </div>
                            <div>
                                <div class="span-mail">По всем вопросам</div><a class="strong" href="mailto:zapchasty-kama@yandex.ru">zapchasty-kama@yandex.ru</a>
                            </div>
                        </div>
                    </div>
                    <button href="#modal-recall" class="btn btn-primary link-modal-js" type="button">Оставить заявку</button>
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?
get_footer();



