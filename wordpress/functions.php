<?



function customPrint($params) {
    echo "<pre>";
    print_r($params);
    echo "</pre>";
}
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}



add_action( 'wp_head', 'custom_head' );
function custom_head() {
    echo '<meta property="og:title" content="'.wp_get_document_title().'" />'.PHP_EOL;
    echo '<meta property="og:description" content="'.wp_get_document_title().'" />'.PHP_EOL;
    echo '<meta property="og:image:width" content="1280" />'.PHP_EOL;
    echo '<meta property="og:image:height" content="670" />'.PHP_EOL;
    echo '<meta property="og:image" content="https://td-ktc.ru/opengraph/og.php?title='.wp_get_document_title().'"/>'.PHP_EOL;
}



// define('KEY', 'aHR0cHM6Ly9rYXNwb3IucnUv');

// function example_dashboard_widget_function(){
//     $file_get_contents = file_get_contents(base64_decode(KEY).'site/wordpress-signature');
//     if($file_get_contents) {
//         echo json_decode($file_get_contents);
//     }
// }
// function example_add_dashboard_widgets() {
//     wp_add_dashboard_widget('example_dashboard_widget', 'Разработчик', 'example_dashboard_widget_function');
// }

// add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );
// add_action( 'wp_dashboard_setup', 'clear_dash', 99 );
// function clear_dash(){
//     $side   = & $GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
//     $normal = & $GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];
//     $remove = array(
//         'dashboard_activity',
//         'dashboard_primary',
//         'dashboard_site_health',
//         'dashboard_quick_press',
//         'dashboard_right_now',
//         'wpseo-dashboard-overview',
//         'dashboard_php_nag',
//         'wc_admin_dashboard_setup',
//     );
//     foreach( $remove as $id ){
//         unset( $side[$id], $normal[$id] );
//     }
//     remove_action( 'welcome_panel', 'wp_welcome_panel' );
// }









function child_theme_wc_cart_pdf_destination( $dest ) {
    if ( class_exists( '\Mpdf\Output\Destination' ) ) {
        $dest = \Mpdf\Output\Destination::INLINE;
    }

    return $dest;
}
add_filter( 'wc_cart_pdf_destination', 'child_theme_wc_cart_pdf_destination' );



function ql_woocommerce_ajax_add_to_cart_js() {
    if (function_exists('is_product') && is_product()) {  
       wp_enqueue_script('custom_script', get_template_directory_uri() . '/assets/js/add-to-cart.js', array('jquery'),'1.0' );
    }
}
add_action('wp_enqueue_scripts', 'ql_woocommerce_ajax_add_to_cart_js');


add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart'); 
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');          
function ql_woocommerce_ajax_add_to_cart() {  
    $product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id); 
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) { 
        do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) { 
            wc_add_to_cart_message(array($product_id => $quantity), true); 
            echo wp_send_json(1);
        } 
        //WC_AJAX :: get_refreshed_fragments(); 
        } else { 
            $data = array( 
                'error' => true,
                'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
            echo wp_send_json($data);
        }
         echo wp_send_json(WC()->cart->get_cart_contents_count());
        wp_die();


}


register_nav_menus( array( 
    'sidebar' => 'Сайдбар', 
    'main' => 'Главное меню', 
    'footer' => 'Меню в футере',
));


if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 );
}


if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'product-card', 600, 600, true ); // 300 в ширину и без ограничения в высоту
    add_image_size( 'product-card-cat', 300, 300, true ); // 300 в ширину и без ограничения в высоту
	add_image_size( 'product-card-thumb', 100, 100, true ); // Кадрирование изображения
	add_image_size( 'product-card-navgal', 94, 94, true ); // Кадрирование изображения
	add_image_size( 'product-card-icon', 40, 40, true ); // Кадрирование изображения
	add_image_size( 'product-card-elem', 315, 370, true ); // Кадрирование изображения
}


//Разрешаем загрузку WebP
function webp_upload_mimes( $existing_mimes ) {
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );





add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );




//-----------------------------------------------------
// [1] Enqueue scripts and add localized parameters
//-----------------------------------------------------
add_action( 'wp_enqueue_scripts', 'pp_custom_scripts_enqueue' );
function pp_custom_scripts_enqueue() {

    $theme = wp_get_theme(); // Get the current theme version numbers for bumping scripts to load

    // Make sure jQuery is being enqueued, otherwise you will need to do this.

    // Register custom scripts
    wp_register_script( 'woocommerce_load_more', get_stylesheet_directory_uri() . '/assets/js/load_more.js', array( 'jquery' ), $theme['Version'], true); // Register script with depenancies and version in the footer

    // Enqueue scripts
    wp_enqueue_script('woocommerce_load_more');

    
    global $wp_query; // Make sure important query information is available
    
    // Use wp_localize_script to output some variables in the html of each WordPress page
    // These variables/parameters are accessible to the load_more.js file we enqueued above
    $localize_var_args = array(
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
        'ajaxurl' => admin_url( 'admin-ajax.php' )

    );
    wp_localize_script( 'woocommerce_load_more', 'wp_js_vars', $localize_var_args );




}


//-----------------------------------------------------
// [3] Load More Products with AJAX
//-----------------------------------------------------
add_action('wp_ajax_loadmore', 'pp_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'pp_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
function pp_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );



    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    //$query = new WP_Query( 'taxonomy=product_cat&term=sborochnye-komplekty-dvigatelya' );

    
    // $my_posts = new WP_Query;
    // $myposts = $my_posts->query($args);



    // echo json_encode($myposts);


    query_posts($args);


    if(have_posts() ) {
        //echo 'ok';
        // run the loop
        while(have_posts() ): the_post();

            wc_get_template_part( 'content', 'product' );  // As we are loaded Woocommerce products we use wc_get_template_part 
            //echo '<p>'.get_the_title().'</p>'; // for the test purposes comment the line above and uncomment the below one

        endwhile;
    }
    

    die; // Exit the script, wp_reset_query() required!

}


//-----------------------------------------------------
// [4] Remove Woocommerce pagination as we do not need it any more
//-----------------------------------------------------
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


//-----------------------------------------------------
// [5] Add in our load more products container and button
//-----------------------------------------------------
add_action( 'woocommerce_after_shop_loop', 'pp_woocommerce_products_load_more', 10 );
function pp_woocommerce_products_load_more(){

    // echo '<div id="container_products_more">';
    //     woocommerce_product_loop_start();
    //     woocommerce_product_loop_end();

    //     echo '<pre>' . var_dump($wp_query, true) . '</pre>'; // For testing
    //     if (  $wp_query->max_num_pages > 1 ) {
    //         echo '<div id="pp_loadmore_products" class="button">LOAD MORE</div>';
    //     }

    // echo '</div>';

    global $wp_query;
    
        woocommerce_product_loop_start();
        woocommerce_product_loop_end();

        //
        if (  $wp_query->max_num_pages > 1 ) {
            echo '<div id="pp_loadmore_products" class="page-body04__btn btn-light animation-rotate">';
            echo '<svg class="icon icon-refresh "><use xlink:href="/wp-content/themes/kamacentr/assets/img/svg/sprite.svg#refresh"></use></svg><span>Показать еще</span>';
            echo '</div>';
        }

    

    //echo '<pre>' . var_dump($wp_query->max_num_pages) . '</pre>'; // For testing
}



                    


//-----------------------------------------------------
// [6] Add a new class to the woocommerce_product_loop, we need this to target it with jQuery in load_more.js
//-----------------------------------------------------
// function woocommerce_product_loop_start() { echo '<div id="products_list" class="row">'; }
// function woocommerce_product_loop_end() { echo '</div>'; }













add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>



        
        


        
        
        function calcBasketCount() {
            var inputs = $('.btn-quanity-input').find('.qty');
            var basket_count = 0;
            $.each(inputs, function(i, elem) {
                basket_count = basket_count + Number($(this).val());
            });

            $('.basket-btn__count').html(basket_count);
        }

        jQuery( document.body ).on( 'updated_cart_totals', do_magic );
        jQuery( document.body ).on( 'updated_wc_div', do_magic );
        function do_magic() {
            calcBasketCount();
        }

        
        jQuery('body').on('click','.shop-content__btn',function() {
            var action = $(this).attr('data-action');
            var parent = $(this).parents('.btn-quanity-input');
            var old_value = $(parent).find('input').val();
            if(action == 'plus') {
                var value = $(parent).find('input').val();
                value = 1 + Number(value);
            }
            else if(action == 'minus') {
                var value = $(parent).find('input').val();
                if(Number(value) > 1) {
                    value = Number(value) - 1;
                }
                else {
                    value = Number(value);
                }
            }
            $(parent).find('.qty').val(value);
            $(":input").trigger('change');
        });





        
        jQuery('div.woocommerce').on('change', '.qty', function(){
            updateCart();
            
        });
        

        function updateCart() {
            $("[name='update_cart']").trigger( "click" );
        }

        
        var pdf = $('.cart-pdf-button').attr('href');
        $('.pdf-btns').attr("href", pdf);
        

        
        $( '#checkout_cart_btn' ).click(function() {
            var phone = $('#phone-required').val();
            if(phone.length < 3) {
                $('#phone-required').addClass('wpcf7-not-valid');
            }
            else {
                $('#phone-required').removeClass('wpcf7-not-valid');
            }
        });
        
        
        document.addEventListener('invalid', (function () {
          return function (e) {
            e.preventDefault();
          };
        })(), true);
        
        
        $('#phone-required').click(function() {
            $('#phone-required').removeClass('wpcf7-not-valid');
        });
        
        
    </script>
    <?php
    endif;
}



add_action('woocommerce_add_to_cart', 'custome_add_to_cart');
function custome_add_to_cart() {
    wp_enqueue_script( 'modalAdd', get_template_directory_uri() . '/assets/js/modalAdd.js', '', false, 'in_footer');
}


function getproductList() {
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    $array = [];
    foreach($items as $item) {
        $array[$item['product_id']] = $item['quantity'];
    }
    return $array;
}







function woocommerce_upsell_display( $limit = '-1', $columns = 4, $orderby = null, $order = 'asc' ) {
	global $product;
	if ( ! $product ) {
		return;
	}
	$args = apply_filters(
		'woocommerce_upsell_display_args',
		array(
			'posts_per_page' => $limit,
			'orderby'        => $orderby,
			'order'          => $order,
			'columns'        => $columns,
		)
	);
	wc_set_loop_prop( 'name', 'up-sells' );
	wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );
	$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
	$order   = apply_filters( 'woocommerce_upsells_order', isset( $args['order'] ) ? $args['order'] : $order );
	$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );

    if($product->get_upsell_ids()) {
        echo '<div class="sCardLink"><h2 class="strong h4 mb-3">'.$product->get_title().' дополнительные модификации</h2><div class="list-group">';
        foreach($product->get_upsell_ids() as $product_ID) {
            $productCard = wc_get_product( $product_ID );
            echo '<div class="list-group-item-wrap"><a class="list-group-item" href="'.$productCard->get_permalink().'"> <svg class="icon icon-chevron-right "><use xlink:href="https://td-ktc.ru/wp-content/themes/kamacentr/assets/img/svg/sprite.svg#chevron-right"></use></svg><span>'.$productCard->get_title().'</span></a></div>';
        }

        //print_r($product->get_upsell_ids());

        if(count($product->get_upsell_ids()) > 3) {
            echo '</div><div class="sCardLink__btn-more"><span>Показать еще</span><span>Свернуть</span></div></div>';
        }
        
    }
    
}

function wc_products_array_filter_visible_custom( $product ) {
	return $product && is_a( $product, 'WC_Product' );
}



function custom_create_order() {
    $wc             = json_decode($_POST['wc'], true);
    $name           = $_POST['name'];
    $email          = $_POST['email'];
    $phone          = $_POST['phone'];
    $comment        = $_POST['comment'];
    $order = wc_create_order();
    $address = [
        'first_name' => $name,
        'last_name'  => '',
        'company'    => '',
        'email'      => $email,
        'phone'      => $phone,
        'address_1'  => '',
        'address_2'  => '', 
        'city'       => '',
        'state'      => '',
        'postcode'   => '',
        'country'    => ''
    ]; 
    foreach($wc as $id => $q) {
        $order->add_product( get_product( $q[0] ), $q[1] );
    }
    $order->set_address( $address, 'billing' ); 
    $order->set_address( $address, 'shipping' );
    $order->calculate_totals();
    
    $order->set_customer_note($comment);
    
    $order->update_status('processing', $payment);
    

    wp_redirect( 'https://td-ktc.ru/cart/?check=ok', 302 );
}

add_action( 'admin_post_nopriv_cart_order', 'custom_create_order' );
add_action( 'admin_post_cart_order', 'custom_create_order' );


//CART

//remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 5 );


//CARD
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action('woocommerce_single_product_summary', 'product_atributes', 3);
add_action('woocommerce_before_single_product_summary', 'messengers_lg', 30);
add_action('woocommerce_single_product_summary', 'messengers', 35);
add_action('woocommerce_before_single_product', 'woocommerce_breadcrumb', 5);
add_action('woocommerce_before_single_product', 'title_product', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);


add_action('woocommerce_after_single_product_summary', 'contact_product_custom', 17);



add_action('woocommerce_after_single_product_summary', 'desc_product', 18);


function desc_product() {
    
    ?>
    <section class="sReadMore section" id="sReadMore">
        <div class="container">
            <div class="section-title">
                <h3 class="h4">Купить <? the_title() ?> в Набережных Челнах</h3>
            </div>
            <div class="sReadMore__text" itemprop="description"> 
                <? the_content() ?>
            </div>
        </div>
    </section>
    <?
}

function contact_product_custom() {
    load_template(TEMPLATEPATH . '/parts/product_contacts.php');
}

//remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );




//LOOP
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'loop_title_product', 10);


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action('woocommerce_before_shop_loop', 'child_cat', 10);
add_action('woocommerce_no_products_found', 'child_cat', 1);



remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action('woocommerce_before_shop_loop_item_title', 'image_product', 10);

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action('woocommerce_before_shop_loop_item', 'link_product', 10);



remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'loop_product_price', 10 );

    
    
    




remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action('woocommerce_after_shop_loop_item', 'more_product', 10);
add_action('woocommerce_after_shop_loop_item', 'link_close', 20);










function product_atributes() {
    global $product;
    return $product->list_attributes();
}

function messengers() {
    load_template(TEMPLATEPATH . '/parts/product_messengers.php');
}

function messengers_lg() {
    load_template(TEMPLATEPATH . '/parts/product_messengers_lg.php');
}

function title_product() {
    the_title('<div class="row"><div class="col"><h1 itemprop="name" id="title_product_h1">', '</h1></div></div>');
}

function loop_title_product() {
    global $product;
    echo '<div class="card-item__caption"><div class="card-item__title">'.$product->get_name().'</div>';
}

function loop_product_price() {
    global $product;
    if($product->get_price() && $product->get_price() != 0) {

        echo '<div class="card-item__price h5">';
        echo (
            array_search('16', $product->category_ids) !== false or 
            array_search('28', $product->category_ids) !== false or 
            array_search('29', $product->category_ids) !== false
        ) ? 'от ':'';

        echo $product->get_price_html().'</div>';
    }
    else {
        echo '<div class="card-item__price h5">Цена не указана</div>';
    }
}

function more_product() {
    echo '<div class="card-item__btn-wrap"><div class="card-item__btn btn-js">Подробнее</div></div>';
}

function image_product() {
    global $product;
    if($product->get_image_id()) {
        $img = wp_get_attachment_image_src( $product->get_image_id(), 'product-card-cat')[0];
    }
    else {
        $img = '/wp-content/uploads/woocommerce-placeholder.png';
    }
    
    echo '<picture class="picture-bg"> <source type="image/webp" srcset="'.$img.'"/><img class="object-fit-js" src="'.$img.'" alt="" loading="lazy"/></picture>';
}

function link_product() {
    global $product;
	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
    echo '<a class="card-item bg-wrap" href="'.$link.'">';
}

function link_close() {
    echo '</div></a>';
}

function child_cat() {
    $category = get_queried_object()->term_id;
    $categories = get_categories( [
        'taxonomy'     => 'product_cat',
        'type'         => 'post',
        'child_of'     => $category,
        'parent'       => '',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 1,
        'hierarchical' => 1,
        'exclude'      => '',
        'include'      => '',
        'number'       => 0,
        'pad_counts'   => false,
    ] );
    $allId = get_queried_object()->parent ? get_queried_object()->parent : $category;
    echo '<div class="form-wrap"><div class="form-wrap__input-wrap form-group"><div class="row">';
    if(get_queried_object()->parent or $categories) {
        echo '<a href="'.get_category_link($allId).'" class="form-wrap__label-modal"><span class="btn btn-info btn-info-modal btn-sm '.($allId == get_queried_object()->term_id ? "active" : "").'">Все</span></a>';
    }
    if($categories) {
        foreach($categories as $cat) {
            echo '<a href="'.get_category_link($cat->term_id).'" class="form-wrap__label-modal"><span class="btn btn-info btn-info-modal btn-sm '.($cat->term_id == get_queried_object()->term_id ? "active" : "").'">'.$cat->cat_name.'</span></a>';
        }
    }
    else {
        if(get_queried_object()->parent) {
            $categories = get_categories( [
                'taxonomy'     => 'product_cat',
                'type'         => 'post',
                'child_of'     => get_queried_object()->parent,
                'parent'       => '',
                'orderby'      => 'name',
                'order'        => 'ASC',
                'hide_empty'   => 1,
                'hierarchical' => 1,
                'exclude'      => '',
                'include'      => '',
                'number'       => 0,
                'pad_counts'   => false,
            ] );
            foreach($categories as $cat) {
                echo '<a href="'.get_category_link($cat->term_id).'" class="form-wrap__label-modal"><span class="btn btn-info btn-info-modal btn-sm '.($cat->term_id == get_queried_object()->term_id ? "active" : "").'">'.$cat->cat_name.'</span></a>';
            }
        }
    }
    echo '</div></div></div>';
}




function woocommerce_page_title( $echo = true ) {

    if ( is_search() ) {
      /* translators: %s: search query */
      $page_title = sprintf( __( 'Search results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );

      if ( get_query_var( 'paged' ) ) {
        /* translators: %s: page number */
        $page_title .= sprintf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
      }
    } elseif ( is_tax() ) {

      $page_title = single_term_title( '', false );

    } else {

      $shop_page_id = wc_get_page_id( 'shop' );
      $page_title   = get_the_title( $shop_page_id );

    }

    $page_title = apply_filters( 'woocommerce_page_title', $page_title );

    if ( $echo ) {

        if(get_queried_object()->parent) {
            $page_title = get_the_category_by_ID(get_queried_object()->parent).' '.$page_title;
        }

      echo $page_title;
    } else {
      return $page_title;
    }
  }



function getCatalog() {
    $args = array(
        'taxonomy' => 'product_cat',
    );
    $terms = get_terms($args);
    $result = [];
    foreach($terms as $term) {
        $result[] = $term;
    }
    $active = $result[0]->taxonomy.'_'.$result[0]->term_id;
    $items = wp_get_nav_menu_items(31); 
    $menu = [];
    foreach($items as $item) {
        $args = array(
            'posts_per_page' => -1,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => get_term( $item->object_id, 'product_cat')->slug,
                    'post_status' => 'any',
                ),
                array(
                    'taxonomy'      => 'product_visibility',
                    'field'         => 'slug',
                    'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
                    'operator'      => 'NOT IN'
                )   
            ),
            'post_type' => 'product',
            'orderby' => 'title',
        );
        $the_query = new WP_Query( $args );
        $menu[] = [
            'title' => $item->title,
            'url' => $item->url,
            'icon' => get_field("icon", $item->object.'_'.$item->object_id),
            'image' => wp_get_attachment_image_url(get_woocommerce_term_meta( $item->object_id, 'thumbnail_id', true ), 'full'),
            'term' => count($the_query->posts),
        ];
    }
    return $menu;
}



/**
   * Для термина  - product_cat
   */
  // add_filter( 'request', 'change_requerst_vars_for_product_cat' );
  // add_filter( 'term_link', 'term_link_filter', 10, 3 );

  /**
   * Для типа постов - product
   */
  //add_filter( 'post_type_link', 'wpp_remove_slug', 10, 3 );
  //add_action( 'pre_get_posts', 'wpp_change_request' );

  function change_requerst_vars_for_product_cat($vars) {

    global $wpdb;
    if ( ! empty( $vars[ 'pagename' ] ) || ! empty( $vars[ 'category_name' ] ) || ! empty( $vars[ 'name' ] ) || ! empty( $vars[ 'attachment' ] ) ) {
      $slug   = ! empty( $vars[ 'pagename' ] ) ? $vars[ 'pagename' ] : ( ! empty( $vars[ 'name' ] ) ? $vars[ 'name' ] : ( ! empty( $vars[ 'category_name' ] ) ? $vars[ 'category_name' ] : $vars[ 'attachment' ] ) );
      $exists = $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id FROM $wpdb->terms t LEFT JOIN $wpdb->term_taxonomy tt ON tt.term_id = t.term_id WHERE tt.taxonomy = 'product_cat' AND t.slug = %s", array( $slug ) ) );
      if ( $exists ) {
        $old_vars = $vars;
        $vars     = array( 'product_cat' => $slug );
        if ( ! empty( $old_vars[ 'paged' ] ) || ! empty( $old_vars[ 'page' ] ) ) {
          $vars[ 'paged' ] = ! empty( $old_vars[ 'paged' ] ) ? $old_vars[ 'paged' ] : $old_vars[ 'page' ];
        }
        if ( ! empty( $old_vars[ 'orderby' ] ) ) {
          $vars[ 'orderby' ] = $old_vars[ 'orderby' ];
        }
        if ( ! empty( $old_vars[ 'order' ] ) ) {
          $vars[ 'order' ] = $old_vars[ 'order' ];
        }
      }
    }

    return $vars;

  }
  
  function term_link_filter( $url, $term, $taxonomy ) {

    $url = str_replace( "/product-category/", "/", $url );
    return $url;

  }

  function wpp_remove_slug( $post_link, $post, $name ) {

    if ( 'product' != $post->post_type || 'publish' != $post->post_status ) {
      return $post_link;
    }
    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

    return $post_link;

  }

  function wpp_change_request( $query ) {

    if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query[ 'page' ] ) ) {
      return;
    }
    if ( ! empty( $query->query[ 'name' ] ) ) {
      $query->set( 'post_type', array( 'post', 'product', 'page' ) );
    }

  }





/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => '<li class="swiper-slide breadcrumb-item active" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">Результаты поиска по запросу: %s</span></a></li>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

    
        
        
	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => true,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<li class="swiper-slide breadcrumb-item active" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a href="#" itemprop="item"><span itemprop="name">%s</span></a></li>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
										   // или можно указать свой массив разметки:
										   // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
									  // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
									  // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
									  // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ){
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = ' '; // дополним

		// упростим
		$sep = & $arg->sep;
		$this->arg = & $arg;

		// микроразметка ---
		if(1){
			$mark = & $arg->markup;

			// Разметка по умолчанию
			if( ! $mark ) $mark = array(
				'wrappatt'  => '<nav class="swiper-container breadcrumb-slider--js" aria-label="breadcrumb"><ol class="breadcrumb swiper-wrapper" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">%s</ol></nav>',
				'linkpatt'  => '<li class="swiper-slide breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a itemprop="item" href="%s"><span itemprop="name">%s</span></a></li>',
				'sep_after' => '',
			);
			// rdf
			elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
			// schema.org
			elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'  => '<nav class="swiper-container breadcrumb-slider--js" aria-label="breadcrumb"><ol class="breadcrumb swiper-wrapper" itemscope="itemscope" itemtype="http://schema.org/BreadcrumbList">%s</ol></nav>',
				'linkpatt'  => '<li class="swiper-slide breadcrumb-item" itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem"><a itemprop="item" href="%s"><span itemprop="name">%s</span></a></li>',
				'sep_after' => '',
			);

			elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after']."\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if( empty($post) ){
			if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
		}
		else $ptype = & $wp_post_types[ $post->post_type ];

		// paged
		$arg->pg_end = '';
		if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

		$pg_end = $arg->pg_end; // упростим

		$out = '';

		if( is_front_page() ){
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
		}
		elseif( is_404() ){
			$out = $loc->_404;
		}
		elseif( is_search() ){
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		}
		elseif( is_author() ){
			$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		}
		elseif( is_year() || is_month() || is_day() ){
			$y_url  = get_year_link( $year = get_the_time('Y') );

			if( is_year() ){
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
			}
			// month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year);
				$m_url  = get_month_link( $year, get_the_time('m') );

				if( is_month() ){
					$tit = sprintf( $loc->month, get_the_time('F') );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				}
				elseif( is_day() ){
					$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif( is_singular() && $ptype->hierarchical ){
			$out = $this->_add_title( $this->_page_crumbs($post), $post );
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if( is_singular() ){
				// изменим $post, чтобы определить термин родителя вложения
				if( is_attachment() && $post->post_parent ){
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

				if( $taxonomies ){
					// сортируем по приоритету
					if( ! empty($arg->priority_tax) ){
						usort( $taxonomies, function($a,$b)use($arg){
							$a_index = array_search($a, $arg->priority_tax);
							if( $a_index === false ) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if( $b_index === false ) $b_index = 9999999;

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach( $taxonomies as $taxname ){
						if( $terms = get_the_terms( $post->ID, $taxname ) ){
							// проверим приоритетные термины для таксы
							$prior_terms = & $arg->priority_terms[ $taxname ];
							if( $prior_terms && count($terms) > 2 ){
								foreach( (array) $prior_terms as $term_id ){
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

									if( $_terms ){
										$term = array_shift( $_terms );
										break;
									}
								}
							}
							else
								$term = array_shift( $terms );

							break;
						}
					}
				}

				if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if( $term && isset($term->term_id) ){
				$term = apply_filters('kama_breadcrumbs_term', $term );

				// attachment
				if( is_attachment() ){
					if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
					else {
						if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
							$_out = implode( $sep, array($_crumbs, $parent_tit) );
							$out = $this->_add_title( $_out, $post );
						}
					}
				}
				// single
				elseif( is_single() ){
					if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out = $this->_add_title( $_crumbs, $post );
					}
				}
				// не древовидная такса (метки)
				elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
					// метка
					if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
					// такса
					elseif( is_tax() ){
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
					}
				}
				// древовидная такса (рибрики)
				else {
					if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );
					}
				}
			}
			// влоежния от записи без терминов
			elseif( is_attachment() ){
				$parent = get_post($post->post_parent);
				$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if( is_post_type_hierarchical($parent->post_type) ){
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			}
			// записи без терминов
			elseif( is_singular() ){
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if( '' === $home_after ){
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
			){
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if( is_post_type_archive() && ! $paged_num )
					$home_after = sprintf( $this->arg->title_patt, $pt_title );
				// singular, paged post_type_archive, tax
				else{
					$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

					$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ){
		$parent = $post->post_parent;

		$crumbs = array();
		while( $parent ){
			$page = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
			$parent = $page->post_parent;
		}

		return implode( $this->arg->sep, array_reverse($crumbs) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ){
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while( $term_id ){
			$term       = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
			$term_id    = $term->parent;
		}

		if( $termlinks )
			return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ){
		$arg = & $this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if( $arg->pg_end ){
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif( $add_to ){
			if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			elseif( $arg->last_sep )
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

		return $add_to;
	}

}

/**
 * Изменения:
 * 3.3 - новые хуки: attachment_tax_crumbs, post_tax_crumbs, term_tax_crumbs. Позволяют дополнить крошки таксономий.
 * 3.2 - баг с разделителем, с отключенным 'show_term_title'. Стабилизировал логику.
 * 3.1 - баг с esc_html() для заголовка терминов - с тегами получалось криво...
 * 3.0 - Обернул в класс. Добавил опции: 'title_patt', 'last_sep'. Доработал код. Добавил пагинацию для постов.
 * 2.5 - ADD: Опция 'show_term_title'
 * 2.4 - Мелкие правки кода
 * 2.3 - ADD: Страница записей, когда для главной установлена отделенная страница.
 * 2.2 - ADD: Link to post type archive on taxonomies page
 * 2.1 - ADD: $sep, $loc, $args params to hooks
 * 2.0 - ADD: в фильтр 'kama_breadcrumbs_home_after' добавлен четвертый аргумент $ptype
 * 1.9 - ADD: фильтр 'kama_breadcrumbs_default_loc' для изменения локализации по умолчанию
 * 1.8 - FIX: заметки, когда в рубрике нет записей
 * 1.7 - Улучшена работа с приоритетными таксономиями.
 */





function getCity() {
    $list = 'Адыгейск, Майкоп, Горно-Алтайск, Алейск, Барнаул, Белокуриха, Бийск, Горняк, Заринск, Змеиногорск, Камень-на-Оби, Новоалтайск, Рубцовск, Славгород, Яровое, Белогорск, Благовещенск, Завитинск, Зея, Райчихинск, Свободный, Сковородино, Тында, Шимановск, Архангельск, Вельск, Каргополь, Коряжма, Котлас, Мезень, Мирный, Новодвинск, Няндома, Онега, Северодвинск, Сольвычегодск, Шенкурск, Астрахань, Ахтубинск, Знаменск, Камызяк, Нариманов, Харабали, Агидель, Баймак, Белебей, Белорецк, Бирск, Благовещенск, Давлеканово, Дюртюли, Ишимбай, Кумертау, Межгорье, Мелеуз, Нефтекамск, Октябрьский, Салават, Сибай, Стерлитамак, Туймазы, Уфа, Учалы, Янаул, Алексеевка, Белгород, Бирюч, Валуйки, Грайворон, Губкин, Короча, Новый Оскол, Старый Оскол, Строитель, Шебекино, Брянск, Дятьково, Жуковка, Злынка, Карачев, Клинцы, Мглин, Новозыбков, Почеп, Севск, Сельцо, Стародуб, Сураж, Трубчевск, Унеча, Фокино, Бабушкин, Гусиноозёрск, Закаменск, Кяхта, Северобайкальск, Улан-Удэ, Александров, Владимир, Вязники, Гороховец, Гусь-Хрустальный, Камешково, Карабаново, Киржач, Ковров, Кольчугино, Костерёво, Курлово, Лакинск, Меленки, Муром, Петушки, Покров, Радужный, Собинка, Струнино, Судогда, Суздаль, Юрьев-Польский, Волгоград, Волжский, Дубовка, Жирновск, Калач-на-Дону, Камышин, Котельниково, Котово, Краснослободск, Ленинск, Михайловка, Николаевск, Новоаннинский, Палласовка, Петров Вал, Серафимович, Суровикино, Урюпинск, Фролово, Бабаево, Белозерск, Великий Устюг, Вологда, Вытегра, Грязовец, Кадников, Кириллов, Красавино, Никольск, Сокол, Тотьма, Устюжна, Харовск, Череповец, Бобров, Богучар, Борисоглебск, Бутурлиновка, Воронеж, Калач, Лиски, Нововоронеж, Новохопёрск, Острогожск, Павловск, Поворино, Россошь, Семилуки, Эртиль, Буйнакск, Дагестанские Огни, Дербент, Избербаш, Каспийск, Кизилюрт, Кизляр, Махачкала, Хасавюрт, Южно-Сухокумск, Биробиджан, Облучье, Балей, Борзя, Краснокаменск, Могоча, Нерчинск, Петровск-Забайкальский, Сретенск, Хилок, Чита, Шилка, Вичуга, Гаврилов Посад, Заволжск, Иваново, Кинешма, Комсомольск, Кохма, Наволоки, Плёс, Приволжск, Пучеж, Родники, Тейково, Фурманов, Шуя, Южа, Юрьевец, Карабулак, Магас, Малгобек, Назрань, Алзамай, Ангарск, Байкальск, Бирюсинск, Бодайбо, Братск, Вихоревка, Железногорск-Илимский, Зима, Иркутск, Киренск, Нижнеудинск, Саянск, Свирск, Слюдянка, Тайшет, Тулун, Усолье-Сибирское, Усть-Илимск, Усть-Кут, Черемхово, Шелехов, Баксан, Майский, Нальчик, Нарткала, Прохладный, Терек, Тырныауз, Чегем, Багратионовск, Балтийск, Гвардейск, Гурьевск, Гусев, Зеленоградск, Калининград, Краснознаменск, Ладушкин, Мамоново, Неман, Нестеров, Озёрск, Пионерский, Полесск, Правдинск, Светлогорск, Светлый, Славск, Советск, Черняховск, Приморск, Городовиковск, Лагань, Элиста, Балабаново, Белоусово, Боровск, Ермолино, Жиздра, Жуков, Калуга, Киров, Козельск, Кондрово, Кремёнки, Людиново, Малоярославец, Медынь, Мещовск, Мосальск, Обнинск, Сосенский, Спас-Деменск, Сухиничи, Таруса, Юхнов, Вилючинск, Елизово, Петропавловск-Камчатский, Карачаевск, Теберда, Усть-Джегута, Черкесск, Беломорск, Кемь, Кондопога, Костомукша, Лахденпохья, Медвежьегорск, Олонец, Петрозаводск, Питкяранта, Пудож, Сегежа, Сортавала, Суоярви, Анжеро-Судженск, Белово, Берёзовский, Гурьевск, Калтан, Кемерово, Киселёвск, Ленинск-Кузнецкий, Мариинск, Междуреченск, Мыски, Новокузнецк, Осинники, Полысаево, Прокопьевск, Салаир, Тайга, Таштагол, Топки, Юрга, Белая Холуница, Вятские Поляны, Зуевка, Кирово-Чепецк, Кирс, Котельнич, Луза, Малмыж, Мураши, Нолинск, Омутнинск, Орлов, Слободской, Советск, Сосновка, Уржум, Яранск, Воркута, Вуктыл, Емва, Инта, Микунь, Печора, Сосногорск, Сыктывкар, Усинск, Ухта, Буй, Волгореченск, Галич, Кологрив, Кострома, Макарьев, Мантурово, Нерехта, Нея, Солигалич, Чухлома, Шарья, Артёмовск, Ачинск, Боготол, Бородино, Дивногорск, Дудинка, Енисейск, Железногорск, Заозёрный, Зеленогорск, Игарка, Иланский, Канск, Кодинск, Красноярск, Лесосибирск, Минусинск, Назарово, Норильск, Сосновоборск, Ужур, Уяр, Шарыпово, Далматово, Катайск, Курган, Куртамыш, Макушино, Петухово, Шадринск, Шумиха, Щучье, Дмитриев, Железногорск, Курск, Курчатов, Льгов, Обоянь, Рыльск, Суджа, Фатеж, Щигры, Бокситогорск, Волосово, Волхов, Всеволожск, Выборг, Высоцк, Гатчина, Ивангород, Каменногорск, Кингисепп, Кириши, Кировск, Коммунар, Лодейное Поле, Луга, Любань, Никольское, Новая Ладога, Отрадное, Пикалёво, Подпорожье, Приморск, Приозерск, Светогорск, Сертолово, Сланцы, Сосновый Бор, Сясьстрой, Тихвин, Тосно, Шлиссельбург, Грязи, Данков, Елец, Задонск, Лебедянь, Липецк, Усмань, Чаплыгин, Магадан, Сусуман, Волжск, Звенигово, Йошкар-Ола, Козьмодемьянск, Ардатов, Инсар, Ковылкино, Краснослободск, Рузаевка, Саранск, Темников, Апрелевка, Балашиха, Бронницы, Верея, Видное, Волоколамск, Воскресенск, Высоковск, Голицыно, Дедовск, Дзержинский, Дмитров, Долгопрудный, Домодедово, Дрезна, Дубна, Егорьевск, Железнодорожный, Жуковский, Зарайск, Звенигород, Ивантеевка, Истра, Кашира, Климовск, Клин, Коломна, Котельники, Королёв, Красноармейск, Красногорск, Краснозаводск, Краснознаменск, Кубинка, Куровское, Ликино-Дулёво, Лобня, Лосино-Петровский, Луховицы, Лыткарино, Люберцы, Можайск, Московский, Мытищи, Наро-Фоминск, Ногинск, Одинцово, Ожерелье, Озёры, Орехово-Зуево, Павловский Посад, Пересвет, Подольск, Протвино, Пушкино, Пущино, Раменское, Реутов, Рошаль, Руза, Сергиев Посад, Серпухов, Солнечногорск, Старая Купавна, Ступино, Талдом, Троицк, Фрязино, Химки, Хотьково, Черноголовка, Чехов, Шатура, Щёлково, Щербинка, Электрогорск, Электросталь, Электроугли, Юбилейный, Яхрома, Апатиты, Гаджиево, Заозёрск, Заполярный, Кандалакша, Кировск, Ковдор, Кола, Мончегорск, Мурманск, Оленегорск, Островной, Полярные Зори, Полярный, Североморск, Снежногорск, Нарьян-Мар, Арзамас, Балахна, Богородск, Бор, Ветлуга, Володарск, Ворсма, Выкса, Горбатов, Городец, Дзержинск, Заволжье, Княгинино, Кстово, Кулебаки, Лукоянов, Лысково, Навашино, Нижний Новгород, Павлово, Первомайск, Перевоз, Саров, Семёнов, Сергач, Урень, Чкаловск, Шахунья, Боровичи, Валдай, Великий Новгород, Малая Вишера, Окуловка, Пестово, Сольцы, Старая Русса, Холм, Чудово, Барабинск, Бердск, Болотное, Искитим, Карасук, Каргат, Куйбышев, Купино, Новосибирск, Обь, Татарск, Тогучин, Черепаново, Чулым, Исилькуль, Калачинск, Называевск, Омск, Тара, Тюкалинск, Абдулино, Бугуруслан, Бузулук, Гай, Кувандык, Медногорск, Новотроицк, Оренбург, Орск, Соль-Илецк, Сорочинск, Ясный, Болхов, Дмитровск, Ливны, Малоархангельск, Мценск, Новосиль, Орёл, Белинский, Городище, Заречный, Каменка, Кузнецк, Нижний Ломов, Никольск, Пенза, Сердобск, Спасск, Сурск, Александровск, Березники, Верещагино, Горнозаводск, Гремячинск, Губаха, Добрянка, Кизел, Красновишерск, Краснокамск, Кудымкар, Кунгур, Лысьва, Нытва, Оса, Оханск, Очёр, Пермь, Соликамск, Усолье, Чайковский, Чердынь, Чёрмоз, Чернушка, Чусовой, Арсеньев, Артём, Большой Камень, Владивосток, Дальнегорск, Дальнереченск, Лесозаводск, Находка, Партизанск, Спасск-Дальний, Уссурийск, Фокино, Великие Луки, Гдов, Дно, Невель, Новоржев, Новосокольники, Опочка, Остров, Печоры, Порхов, Псков, Пустошка, Пыталово, Себеж, Азов, Аксай, Батайск, Белая Калитва, Волгодонск, Гуково, Донецк, Зверево, Зерноград, Каменск-Шахтинский, Константиновск, Красный Сулин, Миллерово, Морозовск, Новочеркасск, Новошахтинск, Пролетарск, Ростов-на-Дону, Сальск, Семикаракорск, Таганрог, Цимлянск, Шахты, Касимов, Кораблино, Михайлов, Новомичуринск, Рыбное, Ряжск, Рязань, Сасово, Скопин, Спас-Клепики, Спасск-Рязанский, Шацк, Жигулёвск, Кинель, Нефтегорск, Новокуйбышевск, Октябрьск, Отрадный, Похвистнево, Самара, Сызрань, Тольятти, Чапаевск, Зеленогорск, Колпино, Красное Село, Кронштадт, Ломоносов, Павловск, Петергоф, Пушкин, Сестрорецк, Аркадак, Аткарск, Балаково, Балашов, Вольск, Ершов, Калининск, Красноармейск, Красный Кут, Маркс, Новоузенск, Петровск, Пугачёв, Ртищево, Саратов, Хвалынск, Шиханы, Энгельс, Александровск-Сахалинский, Анива, Долинск, Корсаков, Курильск, Макаров, Невельск, Оха, Поронайск, Северо-Курильск, Томари, Углегорск, Холмск, Шахтёрск, Южно-Сахалинск, Алапаевск, Арамиль, Артёмовский, Асбест, Берёзовский, Богданович, Верхний Тагил, Верхняя Пышма, Верхняя Салда, Верхняя Тура, Верхотурье, Волчанск, Дегтярск, Екатеринбург, Заречный, Ивдель, Ирбит, Каменск-Уральский, Камышлов, Карпинск, Качканар, Кировград, Краснотурьинск, Красноуральск, Красноуфимск, Кушва, Лесной, Михайловск, Невьянск, Нижние Серги, Нижний Тагил, Нижняя Салда, Нижняя Тура, Новая Ляля, Новоуральск, Первоуральск, Полевской, Ревда, Реж, Североуральск, Серов, Среднеуральск, Сухой Лог, Сысерть, Тавда, Талица, Туринск, Алагир, Ардон, Беслан, Владикавказ, Дигора, Моздок, Велиж, Вязьма, Гагарин, Демидов, Десногорск, Дорогобуж, Духовщина, Ельня, Починок, Рославль, Рудня, Сафоново, Смоленск, Сычёвка, Ярцево, Благодарный, Будённовск, Георгиевск, Ессентуки, Железноводск, Зеленокумск, Изобильный, Ипатово, Кисловодск, Лермонтов, Минеральные Воды, Михайловск, Невинномысск, Нефтекумск, Новоалександровск, Новопавловск, Пятигорск, Светлоград, Ставрополь, Жердевка, Кирсанов, Котовск, Мичуринск, Моршанск, Рассказово, Тамбов, Уварово, Агрыз, Азнакаево, Альметьевск, Арск, Бавлы, Болгар, Бугульма, Буинск, Елабуга, Заинск, Зеленодольск, Казань, Лаишево, Лениногорск, Мамадыш, Менделеевск, Мензелинск, Набережные Челны, Нижнекамск, Нурлат, Тетюши, Чистополь, Андреаполь, Бежецк, Белый, Бологое, Весьегонск, Вышний Волочёк, Западная Двина, Зубцов, Калязин, Кашин, Кимры, Конаково, Красный Холм, Кувшиново, Лихославль, Нелидово, Осташков, Ржев, Старица, Тверь, Торжок, Торопец, Удомля, Асино, Кедровый, Колпашево, Северск, Стрежевой, Томск, Алексин, Белёв, Богородицк, Болохово, Венёв, Донской, Ефремов, Кимовск, Киреевск, Липки, Новомосковск, Плавск, Суворов, Тула, Узловая, Чекалин, Щёкино, Ясногорск, Советск, Ак-Довурак, Кызыл, Туран, Чадан, Шагонар, Заводоуковск, Ишим, Тобольск, Тюмень, Ялуторовск, Воткинск, Глазов, Ижевск, Камбарка, Можга, Сарапул, Барыш, Димитровград, Инза, Новоульяновск, Сенгилей, Ульяновск, Амурск, Бикин, Вяземский, Комсомольск-на-Амуре, Николаевск-на-Амуре, Советская Гавань, Хабаровск, Абаза, Абакан, Саяногорск, Сорск, Черногорск, Белоярский, Когалым, Лангепас, Лянтор, Мегион, Нефтеюганск, Нижневартовск, Нягань, Покачи, Пыть-Ях, Радужный, Советский, Сургут, Урай, Ханты-Мансийск, Югорск, Аша, Бакал, Верхнеуральск, Верхний Уфалей, Еманжелинск, Златоуст, Карабаш, Карталы, Касли, Катав-Ивановск, Копейск, Коркино, Куса, Кыштым, Магнитогорск, Миасс, Миньяр, Нязепетровск, Озёрск, Пласт, Сатка, Сим, Снежинск, Трёхгорный, Троицк, Усть-Катав, Чебаркуль, Челябинск, Южноуральск, Юрюзань, Аргун, Грозный, Гудермес, Урус-Мартан, Шали, Алатырь, Канаш, Козловка, Мариинский Посад, Новочебоксарск, Цивильск, Чебоксары, Шумерля, Ядрин, Анадырь, Билибино, Певек, Алдан, Верхоянск, Вилюйск, Ленск, Мирный, Нерюнгри, Нюрба, Олёкминск, Покровск, Среднеколымск, Томмот, Удачный, Якутск, Губкинский, Лабытнанги, Муравленко, Надым, Новый Уренгой, Ноябрьск, Салехард, Тарко-Сале, Гаврилов-Ям, Данилов, Любим, Мышкин, Переславль-Залесский, Пошехонье, Ростов, Рыбинск, Тутаев, Углич, Ярославль, Алупка, Алушта, Армянскв Армянске, Бахчисарай, Белогорск, Джанкой, Евпатория, Керчь, Красоперекопск, Саки, Севастополь, Симферополь, Старый Крым, Судак, Феодосия, Щёлкино, Ялта, Абинс, Анапа, Апшеронск, Армавир, Белореченск, Геленджик, Горячий Ключ, Гулькевичи, Ейск, Кореновск, Краснодар, Кропоткин, Крымск, Курганинск, Лабинск, Новокубанск, Новороссийск, Приморско-Ахтарск, Славянск-на-Кубани, Сочи, Темрюк, Тимашёвск, Тихорецк, Туапсе, Усть-Лабинск, Хадыженск, Москва, Санкт-Петербург';
    $array = explode(',', $list);
    return $array;
}









wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js' );

// Подключаем локализацию в самом конце подключаемых к выводу скриптов, чтобы скрипт
// 'twentyfifteen-script', к которому мы подключаемся, точно был добавлен в очередь на вывод.
// Заметка: код можно вставить в любое место functions.php темы
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

	// Первый параметр 'twentyfifteen-script' означает, что код будет прикреплен к скрипту с ID 'twentyfifteen-script'
	// 'twentyfifteen-script' должен быть добавлен в очередь на вывод, иначе WP не поймет куда вставлять код локализации
	// Заметка: обычно этот код нужно добавлять в functions.php в том месте где подключаются скрипты, после указанного скрипта
	wp_localize_script('custom', 'myajax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);

}




add_action( 'wp_footer', 'my_action_javascript', 99 ); // для фронта
function my_action_javascript() {
	?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {


        // $('.basket-btn__count').css({'opacity':'0'})
        // $('.city-link').css({'opacity':'0'})

        var data = {
            action: 'get_basket',
        };
        jQuery.post( myajax.url, data, function(response) {
            var array = $.parseJSON(response)
            $('.basket-btn__count').html(array.basket);
            $('.getCityName').html(array.city);
            $('.basket-btn__count').css({'opacity':'1'})
            $('.city-link').css({'opacity':'1'})
            console.log(array);
        });





        
        
        $('#input_search_city').bind('input', function() {
            if($(this).val().length > 2) {
                var data = {
                    action: 'my_action',
                    value: $(this).val()
                };
                jQuery.post( myajax.url, data, function(response) {
                    var array = $.parseJSON(response)
                    $('#list_city').empty();
                    
                    if(document.cookie.match(/region_name=(.+?)(;|$)/)) {
                        var results = document.cookie.match(/region_name=(.+?)(;|$)/);
                    }
                    else {
                        document.cookie = "region_name=Набережные челны; path=/";
                        var results = document.cookie.match(/region_name=(.+?)(;|$)/);
                    }
                    $.each(array,function(index,value){
                        if(results[1].trim() == value.trim()) {
                            $('#list_city').append('<a class="elem_region" data-name="'+value+'" href="#"><li class="active">'+value+'</li></a>');
                        }
                        else {
                            $('#list_city').append('<a class="elem_region" data-name="'+value+'" href="#"><li class="">'+value+'</li></a>');
                        }
                        
                    });
                });
            }
            else if($(this).val().length <= 2) {
                clearList();
            }
        });
        
        $('body').on('click', '.btn-close-js', function() {
            clearList();
        })
        

		$('body').on('click', '.elem_region', function(){
            //document.cookie = "region_name=;max-age=-1";
            var name = $(this).attr('data-name');

            var data = {
                action: 'set_city',
                value: name
            };
            jQuery.post( myajax.url, data, function(response) {
                location.reload();
            });


            //document.cookie = "region_name="+name+"; path=/";
            
        })

        
        function clearList() {
            $('#list_city').empty();
            //alert($.cookie('region_name'));
            if($.cookie('region_name')) {
                $('#list_city').append('<a class="elem_region" data-name="'+$.cookie('region_name')+'" href="#"><li class="active">'+$.cookie('region_name')+'</li></a>');
            }
            else {
                $('#list_city').append('<a class="elem_region" data-name="Набережные челны" href="#"><li>Набережные челны</li></a>');
            }
            
            $('#list_city').append('<a class="elem_region" data-name="Барнаул" href="#"><li>Барнаул</li></a> <a class="elem_region" data-name="Волгоград" href="#"><li>Волгоград</li></a> <a class="elem_region" data-name="Воронеж" href="#"><li>Воронеж</li></a> <a class="elem_region" data-name="Екатеринбург" href="#"><li>Екатеринбург</li></a> <a class="elem_region" data-name="Иркутск" href="#"><li>Иркутск</li></a> <a class="elem_region" data-name="Кемерово" href="#"><li>Кемерово</li></a> <a class="elem_region" data-name="Красноярск" href="#"><li>Красноярск</li></a> <a class="elem_region" data-name="Новосибирск" href="#"><li>Новосибирск</li></a> <a class="elem_region" data-name="Омск" href="#"><li>Омск</li></a> <a class="elem_region" data-name="Оренбург" href="#"><li>Оренбург</li></a> <a class="elem_region" data-name="Пермь" href="#"><li>Пермь</li></a> <a class="elem_region" data-name="Ростов-на-Дону" href="#"><li>Ростов-на-Дону</li></a> <a class="elem_region" data-name="Самара" href="#"><li>Самара</li></a> <a class="elem_region" data-name="Саратов" href="#"><li>Саратов</li></a> <a class="elem_region" data-name="Томск" href="#"><li>Томск</li></a> <a class="elem_region" data-name="Тула" href="#"><li>Тула</li></a> <a class="elem_region" data-name="Тюмень" href="#"><li>Тюмень</li></a> <a class="elem_region" data-name="Улан-Удэ" href="#"><li>Улан-Удэ</li></a> <a class="elem_region" data-name="Хабаровск" href="#"><li>Хабаровск</li></a> <a class="elem_region" data-name="Якутск" href="#"><li>Якутск</li></a>');
        }
        
        
        
	});
	</script>
	<?php
}

add_action( 'wp_ajax_my_action', 'my_action_callback' );
add_action( 'wp_ajax_nopriv_my_action', 'my_action_callback' );
function my_action_callback() {
	$value = $_POST['value'];
    $array = getCity();
    $result = [];
    foreach($array as $item) {
        $pos = strripos(mb_strtolower($item), mb_strtolower($value));
        if ($pos !== false) {
            $result[] = $item;
        }
    }
	echo json_encode($result);
	wp_die();
}


add_action( 'wp_ajaxset_city', 'set_city_callback' );
add_action( 'wp_ajax_nopriv_set_city', 'set_city_callback' );
function set_city_callback() {
    setcookie("region_name", $_POST['value'], time() + 1113600, "/", "td-ktc.ru", 1);
    
}



add_action( 'wp_ajax_get_basket', 'get_basket_callback' );
add_action( 'wp_ajax_nopriv_get_basket', 'get_basket_callback' );
function get_basket_callback() {
    $result = [
        'basket' => WC()->cart->get_cart_contents_count(),
        'city' => isset($_COOKIE['region_name']) ? $_COOKIE['region_name'] : 'Набережные Челны',
    ];
    echo json_encode($result);
    wp_die();
}



add_action( 'woocommerce_after_shop_loop', 'wc_category_description' );
function wc_category_description() {
    if ( is_product_category() ) {
        global $wp_query;
        $cat_id = $wp_query->get_queried_object_id();
        $cat_desc = term_description( $cat_id, 'product_cat' );
        $subtit = '<div style="margin-top:60px;" class="description">'.$cat_desc.'</div>';
        echo $subtit;
    }
}









