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
    <link href="<?= bloginfo('template_directory'); ?>/style.css" rel="stylesheet"/>
	<?php wp_head(); ?>
</head>
    <style>body.loaded_hiding {  opacity: 0; pointer-events: none;  } .loaded_hiding:not(.loaded)::before { display: none; }</style>
    
    <body class="loaded_hiding page-404" data-bg="404.jpg">
        