<?php 

function mega_store_is_wc($value=''){

	if ( class_exists( 'WooCommerce' ) ) {
		return true;
	}else{
		return false;
	}

}

function mega_store_get_social_block() {
    $new_tab  = get_theme_mod('mega_store_social_new_tab', true);
    $socials = json_decode(get_theme_mod('mega_store_socials'), true);
    $is_all_empty  = true;
    ?>
        <ul class="mgs-links">
            <?php if($socials): foreach ($socials as $key => $social):?>
                <?php if(!empty($social['link']) && !empty($social['icon'])): ?>
                <li><a href="<?php echo esc_url($social['link']); ?>"  <?php echo absint($new_tab)?'target="_blank"':''; ?>><i class="fa <?php echo esc_attr($social['icon']); ?>"></i></a></li>
                <?php endif; ?>
            <?php endforeach;  endif; ?>
        </ul>
    <?php
}

function mega_store_get_contact_block(){
     $top_phone = get_theme_mod('mega_store_top_phone'); if(!empty($top_phone)):?>
    <span class="contact-item contact-mobile"><i class="fa fa-phone"></i><span class="contact-link"><a href="callto:<?php echo esc_attr($top_phone); ?>"><?php echo esc_html($top_phone); ?></a></span></span>
    <?php endif; ?>
    <?php $top_email = get_theme_mod('mega_store_top_email'); if(!empty($top_email)): ?>
    <span class="contact-item contact-email"><i class="fa fa-envelope"></i><span class="contact-link"><a href="mailto:<?php echo esc_attr($top_email); ?>"><?php echo esc_html($top_email); ?></a></span></span>
    <?php endif;
}

function mega_store_get_page_links_html() {
    if (mega_store_is_wc()) {

        global $woocommerce;

        $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
        $links             = array();
        $account_link      = '#';
        if ($myaccount_page_id) {
            $account_link = get_permalink($myaccount_page_id);
        }

        if (is_user_logged_in()) {
            $links['myaccount'] = $account_link;
        } else {
            $links['login']    = $account_link;
            $links['register'] = $account_link;
        }

        $links['cart']     = wc_get_cart_url();
        $links['checkout'] =  wc_get_checkout_url();

        if (is_user_logged_in()) {
            $links['logout'] = wp_logout_url(esc_url(home_url('/')));

            if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
                $links['logout'] = str_replace('http:', 'https:', $links['logout']);
            }
        }

        $links  = apply_filters('mega_store_page_links', $links);
        $lables = mega_store_get_page_labels();
        $html   = '';

        foreach ($links as $key => $link) {
            $html .= sprintf('<li><a class="top-bl-%1$s" href="%2$s"> %3$s </a></li>',
                esc_attr($key),
                esc_url($link),
                wp_kses_post($lables[$key])
            );
        }
        $html = '<ul class="account-links">' . $html . '</ul>';
        return $html;
    }
}

function mega_store_get_page_labels() {
    $lables = array(
        'myaccount' => '<i class="fa fa-user"></i> ' .esc_html__('My Account', 'mega-store'),
        'login'     => '<i class="fa fa-sign-in"></i> ' .esc_html__('Login', 'mega-store'),
        'register'  => '<i class="fa fa-user-plus"></i> ' .esc_html__('Register', 'mega-store'),
        'cart'      => '<i class="fa fa-shopping-basket"></i> ' .esc_html__('Cart', 'mega-store'),
        'checkout'  => '<i class="fa fa-check-circle-o"></i> ' .esc_html__('Checkout', 'mega-store'),
        'wishlist'  => '<i class="fa fa-heart"></i> ' .esc_html__('Wishlist', 'mega-store'),
        'logout'    => '<i class="fa fa-sign-out"></i> ' .esc_html__('Logout', 'mega-store'),
    );

    $lables = apply_filters('mega_store_page_labels', $lables);
    return $lables;
}

function mega_store_excerpt_more($more) {
    if ( is_admin() ) {
        return $more;
    }
    
    return '';
}
add_filter('excerpt_more', 'mega_store_excerpt_more');

function mega_store_comment_form_fields($fields) {

    $fields['author'] = '<div class="form-group col-md-4"><label  for="name">' . esc_html__('NAME', 'mega-store') . ':</label><input type="text" class="form-control" id="name" name="author" placeholder="' . esc_attr__('Full Name', 'mega-store') . '"></div>';
    $fields['email']  = '<div class="form-group col-md-4"><label for="email">' . esc_html__('EMAIL', 'mega-store') . ':</label><input type="email" class="form-control" id="email" name="email" placeholder="' . esc_attr__('Your Email Address', 'mega-store') . '"></div>';
    $fields['url']    = '<div class="form-group col-md-4"><label  for="url">' . esc_html__('WEBSITE', 'mega-store') . ':</label><input type="text" class="form-control" id="url" name="url" placeholder="' . esc_attr__('Website', 'mega-store') . '"></div>';
    return $fields;
}
add_filter('comment_form_fields', 'mega_store_comment_form_fields');

function mega_store_comment_form_defaults($defaults) {
    $defaults['submit_field']   = '<div class="form-group col-md-4">%1$s %2$s</div>';
    $defaults['comment_field']  = '<div class="form-group col-md-12"><label  for="message">' . esc_html__('COMMENT', 'mega-store') . ':</label><textarea class="form-control" rows="5" id="comment" name="comment" placeholder="' . esc_attr__('Message', 'mega-store') . '"></textarea></div>';
    $defaults['title_reply_to'] = esc_html__('Post Your Reply Here To %s', 'mega-store');
    $defaults['class_submit']   = 'btn btn-theme';
    $defaults['label_submit']   = esc_html__('SUBMIT COMMENT', 'mega-store');
    $defaults['title_reply']    = '<h3 class="post-comments">' .esc_html__('Leave A Comment', 'mega-store') . '</h3>';
    $defaults['role_form']      = 'form';
    return $defaults;

}
add_filter('comment_form_defaults', 'mega_store_comment_form_defaults');

function mega_store_comment($comment, $args, $depth) {
    // get theme data.
    global $comment_data;
    // translations.
    $leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] :__('Reply', 'mega-store');?>
        <div class="col-xs-12 border the-comment">
            <div class="col-xs-2">
            <?php echo get_avatar($comment, $size = '80'); ?>
            </div>
            <div class="col-xs-10">
                <div class="comment-items">
                    <h4 class="comment-item comment-author"><?php comment_author();?></h4>
                    <h5 class="comment-item comment-date">
                        <?php if (('d M  y') == get_option('date_format')): ?>
                        <?php comment_date('F j, Y');?>
                        <?php else: ?>
                        <?php comment_date();?>
                        <?php endif;?>
                        <?php esc_html_e('at', 'mega-store');?>&nbsp;<?php comment_time('g:i a');?>
                    </h5>
                    <?php comment_reply_link(array_merge($args, array('reply_text' => $leave_reply, 'depth' => $depth, 'max_depth' => $args['max_depth'])))?>
                    <?php if ($comment->comment_approved == '0'): ?>
                    <em class="comment-item comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'mega-store');?></em>
                    <?php endif;?>
                </div>
                <div class="comment-text"><?php comment_text();?></div>
            </div>
        </div>
        <?php
}


function mega_store_menu_button ( $items, $args ) {
    $link = get_theme_mod('mega_store_menu_button_link');
    
    if (!empty($link) && $args->theme_location == 'primary' ) {
        $items .= sprintf('<li class="menu-item menu-button"><a class="btn btn-menu-item" href="%s">%s</a></li>', esc_url($link), esc_html(get_theme_mod('mega_store_menu_button_text')));
    }
    
    return $items;
}
add_filter( 'wp_nav_menu_items', 'mega_store_menu_button', 10, 2 );


function mega_store_get_standard_fonts(){
    return apply_filters(
        'themefarmer_standard_fonts_array', array(
            'Arial, Helvetica, sans-serif',
            'Arial Black, Gadget, sans-serif',
            'Bookman Old Style, serif',
            'Comic Sans MS, cursive',
            'Courier, monospace',
            'Georgia, serif',
            'Garamond, serif',
            'Impact, Charcoal, sans-serif',
            'Lucida Console, Monaco, monospace',
            'Lucida Sans Unicode, Lucida Grande, sans-serif',
            'MS Sans Serif, Geneva, sans-serif',
            'MS Serif, New York, sans-serif',
            'Palatino Linotype, Book Antiqua, Palatino, serif',
            'Tahoma, Geneva, sans-serif',
            'Times New Roman, Times, serif',
            'Trebuchet MS, Helvetica, sans-serif',
            'Verdana, Geneva, sans-serif',
            'Paratina Linotype',
            'Trebuchet MS',
        )
    );
}

function mega_store_get_google_fonts(){
    return apply_filters( 'themefarmer_google_fonts_array', 
        array( 'ABeeZee', 'Abel', 'Abhaya Libre', 'Abril Fatface',  'Alfa Slab One', 'Alice', 'Alike',  'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre', 'Averia Sans Libre', 'Averia Serif Libre', 'Bad Script', 'Bahiana', 'Baloo', 'Baloo Bhai', 'Baloo Bhaijaan', 'Baloo Bhaina', 'Baloo Chettan', 'Baloo Da', 'Baloo Paaji', 'Baloo Tamma', 'Baloo Tammudu', 'Baloo Thambi', 'Balthazar',  'Black Ops One', 'Bokor', 'Bonbon', 'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Brawler', 'Bree Serif', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Bungee', 'Bungee Hairline', 'Bungee Inline', 'Bungee Outline', 'Bungee Shade', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cormorant SC', 'Cormorant Unicase', 'Cormorant Upright', 'Courgette', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round',  'Damion', 'Dancing Script', 'Dangrek',  'Diplomata', 'Diplomata SC', 'Domine', 'Donegal One', 'Doppio One', 'EB Garamond',  'Englebert', 'Enriqueta', 'Erica One', 'Expletus Sans', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Francois One', 'Frank Ruhl Libre', 'Freckle Face', 'Fredericka the Great', 'Fredoka One', 'Freehand', 'Fresca', 'Frijole', 'Fruktur', 'Fugaz One', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gafata', 'Galada', 'Galdeano', 'Galindo', 'Gentium Basic', 'Gentium Book Basic', 'Geo', 'Geostar', 'Geostar Fill', 'Germania One', 'Gidugu', 'Gilda Display', 'Give You Glory',  'Habibi', 'Halant', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanuman', 'Happy Monkey', 'Harmattan',  'IBM Plex Mono', 'IBM Plex Sans', 'IBM Plex Sans Condensed', 'IBM Plex Serif',  'Istok Web', 'Italiana', 'Italianno', 'Itim', 'Jacques Francois', 'Jacques Francois Shadow', 'Jaldi', 'Jim Nightshade', 'Jockey One', 'Jolly Lodger', 'Jomhuria',   'Kumar One Outline', 'Kurale', 'La Belle Aurore', 'Laila', 'Lakki Reddy', 'Lalezar',  'Limelight', 'Linden Hill', 'Lobster', 'Lobster Two', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Lora', 'Love Ya Like A Sister',  'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marko One', 'Marmelad',  'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'Nunito Sans', 'Odor Mean Chey', 'Offside', 'Old Standard TT', 'Oldenburg', 'Oleo Script', 'Oleo Script Swash Caps', 'Open Sans',  'Pangolin', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Pathway Gothic One',  'Playfair Display SC', 'Podkova', 'Poiret One', 'Poller One', 'Poly', 'Pompiere', 'Pontano Sans', 'Poppins', 'Port Lligat Sans', 'Port Lligat Slab', 'Pragati Narrow', 'Quattrocento Sans', 'Questrial', 'Quicksand', 'Quintessential', 'Qwigley', 'Racing Sans One',  'Roboto Slab', 'Rochester', 'Rock Salt', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario',  'Sarpanch', 'Satisfy', 'Scada', 'Scheherazade', 'Schoolbell', 'Scope One', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sonsie One', 'Sorts Mill Goudy',  'Suez One', 'Sumana', 'Sunshiney', 'Supermercado One', 'Sura', 'Suranna', 'Suravaram', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Tangerine', 'Taprom',  'Ubuntu Condensed', 'Ubuntu Mono', 'Ultra', 'Uncial Antiqua', 'Underdog', 'Unica One', 'Voces', 'Volkhov', 'Vollkorn', 'Vollkorn SC', 'Voltaire', 'Waiting for the Sunrise', 'Yanone Kaffeesatz', 'Yantramanav', 'Yatra One', 'Yellowtail', 'Zeyada', 'Zilla Slab')
    );
}

function mega_store_get_font_url($fonts = array()){
    $body_font          = get_theme_mod('mega_store_body_font_family', 'Roboto');
    $body_font_weight   = array( '100', '300', '400', '700', '900' );
    $fonts[$body_font] = $body_font_weight;
    $fonts = apply_filters('mega_store_fonts', $fonts);
    
    if(empty($fonts)){
        return;
    }
    
    $google_fonts = mega_store_get_google_fonts();
    $font_families = array();
    if (!empty($google_fonts) && !empty($fonts)) {
        foreach ($fonts as $font => $weights) {
            if (in_array($font, $google_fonts)) {
                if ( ! empty( $weights ) ) {
                    $font_families[] = $font.':' . implode( ',', $weights );
                }else{
                    $font_families[] = $font;
                }
            }
        }
    }else{
        return;
    }

    if(!empty($font_families)){
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
        );
    
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
        return esc_url_raw( $fonts_url );
    }
    return;
}

function mega_store_add_custom_styles(){
    $style = '';
    $body_font_family          = get_theme_mod('mega_store_body_font_family', 'Roboto');
    $body_font_family          = !empty($body_font_family)?$body_font_family:'Roboto';
    $body_font_size            = get_theme_mod('mega_store_body_font_size', 10);
    if(is_string($body_font_size) && is_array(json_decode($body_font_size, true))){
        $body_font_size = json_decode($body_font_size, true);
        $desk_fs = $body_font_size['desktop']+4;
        $tabl_fs = $body_font_size['tablet'];
        $mobl_fs = $body_font_size['mobile'];
    }else{
        $desk_fs = $body_font_size+4;
    }

    $style .="
        body{
            font-family:'{$body_font_family}', sans-serif;
            font-size:{$desk_fs}px;
        }
    ";
    $style = apply_filters('mega_store_inline_style', $style);
    wp_add_inline_style('mega-store-style', $style);
}
add_action('wp_enqueue_scripts', 'mega_store_add_custom_styles', 31);


function mega_store_blog_layout(){
    if(is_page_template()){
        return;
    }

    if(is_page()){
        $layout = get_theme_mod('mega_store_blog_single_page_layout', 'right');
    }elseif(is_single()){
        $layout = get_theme_mod('mega_store_blog_single_post_layout', 'right');
    }else{
        $layout = get_theme_mod('mega_store_blog_post_index_layout', 'right');
    }
    return mega_store_get_layout_class($layout); 
}

function mega_store_get_layout_class($layout = 'right'){
    $class = 'col-md-9';
    switch ($layout) {
        case 'right':
            $class = 'col-md-9';
            break;
        case 'left':
            $class = 'col-md-9 pull-right';
            break;
        case 'full':
            $class = 'col-md-12';
            break;
        default:
            $class = 'col-md-9';
            break;
    }
    return $class;
}