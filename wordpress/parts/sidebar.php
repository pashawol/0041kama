<?
    $active = $result[0]->taxonomy.'_'.$result[0]->term_id;
    $items = wp_get_nav_menu_items(31); 
    $menu = [];

    if(is_product()) {
        global $post;
        $terms = get_the_terms( $post->ID, 'product_cat' );
        $product_id_cat = $terms[0]->term_id;
    }
    

    foreach($items as $item) {
        $menu[] = [
            'title' => $item->title,
            'url' => $item->url,
            'icon' => wp_get_attachment_image_url(get_woocommerce_term_meta( $item->object_id, 'thumbnail_id', true ), 'product-card-icon'),
            'active' => (get_queried_object()->term_id == $item->object_id) ? 'active' : ($product_id_cat == $item->object_id) ? 'active' : '',
        ];
    }

?>
<div class="col-3">
    <div class="list-block">
        <div class="list-group">
            <? foreach($menu as $item) :?>
                <a href="<?=$item['url'] ?>" 
                   class="list-group-item 
                          list-group-item-action
                          <?= $item['active']?>
                          ">
                    <picture> 
                        <img width="40" src="<?=$item['icon'] ?>" alt="" loading="lazy"/>
                    </picture>
                    <span><?=$item['title'] ?></span>
                </a>
            <? endforeach; ?>
        </div>
    </div>
</div>