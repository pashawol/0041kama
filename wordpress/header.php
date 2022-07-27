<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=575,   maximum-scale=1 , user-scalable=0, shrink-to-fit=no">
    <script>
        let viewport = document.querySelector("meta[name=viewport]");
        var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
        if (is_safari) {
            //- alert(navigator.userAgent);
            function w() {
                this.outerWidth > 575 
                    ? viewport.content = "width=device-width, initial-scale=1.0,  maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" 
                    :  viewport.content = "width=575,   maximum-scale=1 , user-scalable=0, shrink-to-fit=no" 
                //- alert(this.outerWidth + ', '+  viewport.content);
            }
             w();
            window.addEventListener('resize', () => { 
             w();
            }, { passive: true });
        }
    </script>
    
    
    
    <link type="image/ico" href="<?= bloginfo('template_directory'); ?>/assets/img/favicon.ico" rel="shortcut icon">
    <meta name="format-detection" content="telephone=no"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= bloginfo('template_directory'); ?>/assets/css/main.min.css" rel="stylesheet"/>
    <meta name="yandex-verification" content="39cbba5984b70c42" />
    <link href="<?= bloginfo('template_directory'); ?>/style.css" rel="stylesheet"/>
	<?php wp_head(); ?>
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(88946849, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/88946849" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
    <style>body.loaded_hiding {  opacity: 0; pointer-events: none;  } .loaded_hiding:not(.loaded)::before { display: none; }</style>
    
    <body class=" main-page  loaded_hiding" <? echo !is_singular( 'product' ) ? '' : '' ?> >
        
        
        <div class="main-wrapper">
			<div class="menu-mobile menu-mobile--js d-lg-none"> 
				<div class="menu-mobile__inner">
					<div class="search-block">
						<form action="<?php bloginfo( 'url' ); ?>" method="get">
							<button>
								<svg class="icon icon-search-icon ">
									<use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#search-icon"></use>
								</svg>
							</button>
							<input name="s" value="<?=$_GET['s']?>" type="text" placeholder="Поиск по артикулу и названию"/>
						</form>
					</div>
					<a style="opacity: 0;" class="city-link link-modal-js" href="#modal-search-list"> 
						<svg class="icon icon-compass ">
							<use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#compass"></use>
						</svg><span class="getCityName"></span></a>
                    <?
                    wp_nav_menu( [
                        'theme_location'  => 'main',
                        'menu'            => '',
                        'container'       => 'div',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'menu',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => '',
                    ] );
                    ?>
                    
                    
                    
					<div class="header">
						<div class="header__tel-block col-lg-auto">
							<a class="header__link-tel" href="tel:8(800)700-85-72">8 (800) 700-85-72
							</a>
						</div>
						<div class="header__tel-block col-lg-auto">
							<div class="tel-n-social"><a class="strong" href="8(960)079-95-44">8 (960) 079-95-44 </a>
								<div class="soc">
									<a class="soc__item soc__item--telegram" href="https://t.me/td_ktc" target="_blank">
                                        <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/telegtam.svg" alt=""/>
									</a>
									<a class="soc__item soc__item--viber" href="https://wa.me/79600799544" target="_blank">
                                        <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/whatsapp.svg" alt=""/>
									</a>
									<a class="soc__item soc__item--whatsapp" href="https://viber.click/79600799544" target="_blank">
                                        <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/viber.svg" alt=""/>
									</a>
								</div>
							</div>
						</div>
						<div><a class="link-modal-js fw-600" href="#modal-recall">Заказать звонок</a></div>
						<a class="header__link-email" href="mailto:zapchasty-kama@yandex.ru">zapchasty-kama@yandex.ru
						</a>
						<div class="header__addr">г. Набережные Челны, <br> пр-т КАМАЗа, 22/3
						</div>
						<div class="header__time">Пн-пт: с 8:00 до 17:00 мск<br/>Сб: с 8:00 до 12:00 мск<br/>Вс: выходной
						</div>
					</div>
				</div>
			</div>
			<!--  мобильное меню-->
            
            
			<!-- start header-->
			<header class="header" id="header">
				<div class="container">
					<div class="row">
						<div class="col-lg-auto col"><a href="/"><img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/logo-head.svg" alt=""/></a></div>
						<div class="col d-none d-lg-block">
							<a style="opacity: 0;" class="city-link link-modal-js" href="#modal-search-list"> 
								<svg class="icon icon-compass ">
									<use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#compass"></use>
								</svg><span class="getCityName"></span></a>
						</div>
						<div class="header__col col-lg-auto order-lg-0 order-last">
							<div class="header__contact-dropdown header__contact-dropdown--js d-lg-block">
								<div class="container">
									<div class="row">
										<div class="col-auto order-xl-0 order-last d-none d-lg-block">
											<a class="header__link-email" href="mailto:zapchasty-kama@yandex.ru">zapchasty-kama@yandex.ru
											</a>
										</div>
										<div class="header__tel-block col-lg-auto">
											<a class="header__link-tel" href="tel:8(800)700-85-72">8 (800) 700-85-72
											</a>
										</div>
										<div class="header__tel-block col-lg-auto">
											<a class="header__link-tel" href="tel:8(960)079-95-44">8 (960) 079-95-44
											</a>
										</div>
										<div class="col-12 d-xl-none"></div>
										<div class="col-lg-auto order-last">
											<div class="tel-n-social">
												<div class="soc">
													<a class="soc__item soc__item--telegram" href="https://t.me/td_ktc" target="_blank">
                                                        <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/telegtam.svg" alt=""/>
													</a>
													<a class="soc__item soc__item--viber" href="https://wa.me/79600799544" target="_blank">
                                                        <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/whatsapp.svg" alt=""/>
													</a>
													<a class="soc__item soc__item--whatsapp" href="https://viber.click/79600799544" target="_blank">
                                                        <img src="<?= bloginfo('template_directory'); ?>/assets/img/svg/viber.svg" alt=""/>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 d-none d-lg-block"></div>
						<div class="col d-none d-lg-block">
                            <?
                            wp_nav_menu( [
                                'theme_location'  => 'main',
                                'menu'            => '',
                                'container'       => 'div',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'menu',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => '',
                            ] );
                            ?>
						</div>
						<div class="col-auto d-none d-lg-block">
							<div class="search-block">
								<form action="<?php bloginfo( 'url' ); ?>" method="get">
									<button>
										<svg class="icon icon-search-icon ">
											<use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#search-icon"></use>
										</svg>
									</button>
									<input name="s" value="<?=$_GET['s']?>" type="text" placeholder="Поиск по артикулу и названию"/>
								</form>
							</div>
						</div>
                        
						<div class="col-auto">
							<? woocommerce_mini_cart(); ?>
						</div>
                        
                        
						<div class="col-auto d-lg-none">
							<div class="toggle-contact-mobile toggle-contact-mobile--js btn btn-primary">
								<svg class="icon icon-call ">
									<use xlink:href="<?= bloginfo('template_directory'); ?>/assets/img/svg/sprite.svg#call"></use>
								</svg>
							</div>
						</div>
						<div class="col-auto d-lg-none">
							<div class="toggle-menu-mobile toggle-menu-mobile--js btn"><span></span>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- end header-->