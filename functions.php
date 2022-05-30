<?php
/**
 * urban_flavours functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package urban_flavours
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require __DIR__ . '/inc/twilio.php';
if ( ! function_exists( 'urban_flavours_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function urban_flavours_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on urban_flavours, use a find and replace
		 * to change 'urban_flavours' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'urban_flavours', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-header' => esc_html__( 'Primary', 'urban_flavours' ),
			'menu-footer' => esc_html__( 'Footer', 'urban_flavours' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'urban_flavours_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

        //add_theme_support( 'woocommerce' );
        //add_theme_support( 'wc-product-gallery-zoom' );
        //add_theme_support( 'wc-product-gallery-lightbox' );
        //add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'urban_flavours_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function urban_flavours_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'urban_flavours_content_width', 640 );
}
add_action( 'after_setup_theme', 'urban_flavours_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function urban_flavours_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'urban_flavours' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'urban_flavours' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'urban_flavours_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function urban_flavours_scripts() {
	wp_enqueue_style( 'urban_flavours-style', get_stylesheet_uri() );

    wp_enqueue_style( 'urban_flavours-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'urban_flavours-jquery-ui-css', get_template_directory_uri() . '/css/jquery-ui.min.css' );
    wp_enqueue_style( 'urban_flavours-dropzone', 'https://rawgit.com/enyo/dropzone/master/dist/dropzone.css' );
    //wp_enqueue_style( 'urban_flavours-timepicker-addon', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css' );
    wp_enqueue_style( 'urban_flavours-fonts.googleapis', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto:100,100i,300,300i,400,400i,500,500i,700i,900,900i&display=swap&subset=cyrillic,greek,latin-ext,vietnamese' );
    wp_enqueue_style( 'urban_flavours-fonts.googleapis2', 'https://fonts.googleapis.com/css?family=Poppins:100,100i,200,300,300i,400,400i,500,600,700,800,900&display=swap' );
    wp_enqueue_style( 'urban_flavours-fonts.googleapis3', 'https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&display=swap&subset=cyrillic-ext,greek,greek-ext,latin-ext' );
    wp_enqueue_style( 'urban_flavours-fonts.googleapis4', 'https://fonts.googleapis.com/css?family=Karla:400,700&display=swap&subset=latin-ext' );
    wp_enqueue_style( 'urban_flavours-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
    wp_enqueue_style( 'urban_flavours-elegant-icons', get_template_directory_uri() . '/css/elegant-icons.min.css' );
    wp_enqueue_style( 'urban_flavours-pe-icon-7-stroke', get_template_directory_uri() . '/css/pe-icon-7-stroke.css' );
    wp_enqueue_style( 'urban_flavours-pe-icon-social', get_template_directory_uri() . '/css/pe-icon-social.css' );
    wp_enqueue_style( 'urban_flavours-social-style', get_template_directory_uri() . '/css/social-style.min.css' );
    wp_enqueue_style( 'urban_flavours-main-style', get_template_directory_uri() . '/css/styles.css' );
    wp_enqueue_style( 'urban_flavours-custom-style', get_template_directory_uri() . '/css/custom.css' );

    wp_enqueue_script( 'urban_flavours-popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), time(), true );
    wp_script_add_data( 'urban_flavours-popper-js', 'integrity', 'sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' );
    wp_script_add_data( 'urban_flavours-popper-js', 'crossorigin', 'anonymous' );
    wp_enqueue_script( 'urban_flavours-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), time(), true );
    wp_enqueue_script( 'urban_flavours-jquery-ui-js', get_template_directory_uri() . '/js/jquery-ui.min.js', array('jquery'), time(), true );
    wp_enqueue_script( 'urban_flavours-jquery-ui-timepicker-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js', array('jquery'), time(), true );
    wp_enqueue_script( 'urban_flavours-dropzone-js', 'https://rawgit.com/enyo/dropzone/master/dist/dropzone.js', array('jquery'), time(), true );
    wp_enqueue_script( 'urban_flavours-chosen-js', get_template_directory_uri() . '/js/chosen.jquery.min.js', array('jquery'), time(), true );
    wp_enqueue_script( 'urban_flavours-slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), time(), true );
    wp_enqueue_script( 'urban_flavours-infinite-scroll-js', 'https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js', array('jquery'), time(), true );

    wp_enqueue_script( 'urban_flavours-maps.google-js', 'http://maps.google.com/maps/api/js?key=AIzaSyABBWqAYGvIu7J-Pl3avbJNBskryX4n0WY', array('jquery'), time(), true );

    wp_enqueue_script( 'urban_flavours-google-map-js', get_template_directory_uri() . '/js/google-map.js', array('jquery'), time(), true );

    /*if(is_woocommerce()){
        wp_enqueue_script( 'urban_flavours-bootstrap-slider-js', get_template_directory_uri() . '/js/bootstrap-slider.js', array('jquery'), time(), true );
    }*/

    wp_enqueue_script( 'urban_flavours-functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), time(), true );

	$loaded_jsvars = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'homeurl' => trailingslashit(home_url()),
		'logout_url' => wp_logout_url(),
		'r_status' => !empty($GLOBALS['success']) ? $GLOBALS['success'] : '',
	);
	/*if(!empty($_GET['product_id'])){
		$loaded_jsvars['product_id'] = $_GET['product_id'];
	}
    if(!empty($_GET['strength'])){
        $loaded_jsvars['strength'] = $_GET['strength'];
    }*/
    wp_localize_script( 'jquery', 'js_var', $loaded_jsvars );
}
add_action( 'wp_enqueue_scripts', 'urban_flavours_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( is_home() ) {
        $classes[] = 'home-page';
    }
    return $classes;
}
function remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'advanced-custom-fields/acf.php' ] );
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );

// ACF Option Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Footer Settings',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Home Page',
        'menu_title'	=> 'Home Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'News Page',
        'menu_title'	=> 'News Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Rewards Page',
        'menu_title'	=> 'Rewards Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Contact Page',
        'menu_title'	=> 'Contact Page',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Age Verification PopUp',
        'menu_title'	=> 'Age Verification PopUp',
        'parent_slug'	=> 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Email & SMS Settings',
        'menu_title'	=> 'Email & SMS Settings',
        'parent_slug'	=> 'theme-general-settings',
    ));

}

/*function cus_find_matching_product_variation( $product, $attributes ) {
    foreach( $attributes as $key => $value ) {
        if( strpos( $key, 'attribute_' ) === 0 ) {
            continue;
        }
        unset( $attributes[ $key ] );
        $attributes[ sprintf( 'attribute_%s', $key ) ] = $value;
    }
    if( class_exists('WC_Data_Store') ) {
        $data_store = WC_Data_Store::load( 'product' );
        return $data_store->find_matching_product_variation( $product, $attributes );
    } else {
        return $product->get_matching_variation( $attributes );
    }
}

function update_add_to_cart_url(){
    if($_POST['variation_id']){
        $url = get_bloginfo('url').'/?add-to-cart='.$_POST['variation_id'];
        echo json_encode(array('status' => 1, 'url' => $url));
    }
    echo json_encode(array('status' => 0));
    exit();
}
add_action('wp_ajax_update_add_to_cart_url', 'update_add_to_cart_url');
add_action('wp_ajax_nopriv_update_add_to_cart_url', 'update_add_to_cart_url');*/

function fetchData($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

add_action('init',function (){
    if(isset($_POST['mailchimp_email']) && !empty($_POST['mailchimp_email'])){
        $msg = '';
        $api_key = get_field('mailchimp_api_key', 'option');
        $list_id = get_field('mailchimp_list_id', 'option');
        $email = isset($_POST['mailchimp_email']) ? $_POST['mailchimp_email'] : '';
        $status = 'subscribed';
        if($email) {
            $data = array(
                'apikey'        => $api_key,
                'email_address' => $email,
                'status'     => $status
            );
            // URL to request
            $API_URL =   'https://' . substr($api_key,strpos($api_key,'-') + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address']));

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $API_URL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data) );
            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result);
            if( $response->status == 400 ){
                //foreach( $response->errors as $error ) {
                $msg = 'Please enter a real email address.';
                //}
            } elseif( $response->status == 'subscribed' ){
                $msg = 'Thank you. You have already subscribed.';
            }elseif( $response->status == 'pending' ){
                $msg = 'You subscription is Pending. Please check your email.';
            }
        }
        //echo $msg;
    }
});

/*remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

function add_my_custom_schedule( $schedules ) {
    $schedules['every_five_minutes'] = array(
        'interval' => 300,
        'display' => __('Once every five minutes')
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'add_my_custom_schedule' );

add_action('init','check_cron_schedule', 99);
function check_cron_schedule(){
    //echo wp_next_scheduled( 'check_for_product_min_max_price' );
    //echo wp_next_scheduled( 'send_pending_notification_email' );
    //echo wp_clear_scheduled_hook('send_pending_notification_email');die();
    if ( !wp_next_scheduled( 'check_for_product_min_max_price' ) ) {
        wp_schedule_event(time(), 'every_five_minutes', 'check_for_product_min_max_price');
    }

    if ( !wp_next_scheduled( 'send_pending_notification_email' ) ) {
        wp_schedule_event(time(), 'twicedaily', 'send_pending_notification_email');
    }
}

add_action('send_pending_notification_email','send_user_notification_email');

function send_user_notification_email(){
    global $wpdb;
    $table_registration = $wpdb->prefix . 'registration_step_data';
    $sql = "SELECT * FROM $table_registration WHERE status = 0";
    $results = $wpdb->get_results( $sql );

    if(!empty($results)){
        $sub = get_field('user_reminder_email_subject','option');
        $subject = $sub ? $sub : 'Reminder!';
        $message = get_email_template('template-parts/email/user-reminder-email');
        $home_url = get_bloginfo('url').'/sign-up/';
        $nonce = wp_create_nonce( 'back-user' );
        foreach ($results as $res){
            $id = $res->id;
            $user_email = $res->user_email;
            $form_data = unserialize($res->form_data);
            $status = $res->status;
            $a_args = array(
                'home_url' => $home_url,
                //'full_name' => $form_data['full-name'],
                'full_name' => $form_data['first-name'].' '.$form_data['last-name'],
                'res_id' => $id,
                'nonce' => $nonce,
            );
            send_email_notification($user_email, $subject, $message, $a_args);

            //Send SMS
            $allow_text_message = $form_data['allow_text_message'];
            $user_phone = $form_data['phone'];

            $send_sms = get_field('send_sms','option');
            if($send_sms == 'All Users' && $allow_text_message == 1) {
                $user_message = get_field('reminder_text_for_registration','option');
                send_msg_notification($user_phone, $user_message);
            }

            $wpdb->update(
                $table_registration,
                array(
                    'status' => 1
                ),
                array( 'id' => $id ),
                array(
                    '%d'
                ),
                array( '%d' )
            );
        }
    }
}*/

/*add_action('check_for_product_min_max_price','check_for_product_min_max_price_function');
function check_for_product_min_max_price_function(){
    $first_val = wpq_get_min_price_per_product_cat();
    $last_val = (int)wpq_get_max_price_per_product_cat();
    $last_val = max(array(100, $last_val));
    update_option( 'first_val', $first_val );
    update_option( 'last_val', $last_val );
}

function wpq_get_min_price_per_product_cat() {
    global $wpdb;
    $sql = "SELECT  MIN( meta_value+0 ) as minprice FROM {$wpdb->posts} INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id) INNER JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id) WHERE {$wpdb->posts}.post_type = 'product' AND {$wpdb->posts}.post_status = 'publish' AND {$wpdb->postmeta}.meta_key = '_price'";
    return $wpdb->get_var($sql);
}

function wpq_get_max_price_per_product_cat() {
    global $wpdb;
    $sql = "SELECT  MAX( meta_value+0 ) as maxprice FROM {$wpdb->posts} INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id) INNER JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id) WHERE {$wpdb->posts}.post_type = 'product' AND {$wpdb->posts}.post_status = 'publish' AND {$wpdb->postmeta}.meta_key = '_price'";
    return $wpdb->get_var($sql);
}*/

/*function filter_category_listing_product(){
    global $wpdb;
    $price_range = json_decode($_POST['price_range']);

    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'posts_per_page'        => 3,
    );

    $meta_query = array(
        'relation' => 'AND',
    );
    $price_args = array(
        'key' => '_price',
        'value' => $price_range,
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC'
    );
    $meta_query[] = $price_args;
    if(!empty($_POST['strength'])){
        //$strength_args = array(
            //'key' => 'strength',
            //'value' => ''.$_POST['strength'].'',
            //'compare' => '=',
        //);
        //$meta_query[] = $strength_args;

        if ( $_POST['strength'] == 'Highest THC' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'thc';
            $args['order'] = 'DESC';
        } elseif( $_POST['strength'] == 'Lowest THC' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'thc';
            $args['order'] = 'ASC';
        } elseif( $_POST['strength'] == 'Highest CBD' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'cbd';
            $args['order'] = 'DESC';
        } elseif( $_POST['strength'] == 'Lowest CBD' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'cbd';
            $args['order'] = 'ASC';
        }

    }

    $args['meta_query'] =  $meta_query;

    //if(!empty($_POST['order_by'])){
    if( !empty($_POST['order_by']) && empty($_POST['strength']) ){
        if($_POST['order_by'] == 'best-selling'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
        }
        if($_POST['order_by'] == 'popularity'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
        }
        if($_POST['order_by'] == 'rating'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_wc_average_rating';
        }
        if($_POST['order_by'] == 'high-to-low'){
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            $args['meta_key'] = '_price';
        }
        if($_POST['order_by'] == 'low-to-high'){
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            $args['meta_key'] = '_price';
        }
        if($_POST['order_by'] == 'latest'){
            $args['orderby'] = 'ID';
            $args['order'] = 'DESC';
        }
    }

    $output = '';
    $show_categories_on_shop_page = get_field('show_categories_on_shop_page', 'option');
    if(empty($show_categories_on_shop_page)) {
        $show_categories_on_shop_page = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
            'number' => 3,
            'parent' => 0
        ));
    }
    if(!empty($show_categories_on_shop_page)):
        foreach ($show_categories_on_shop_page as $term):
            $term_link = get_term_link( $term );
            if(!empty($_POST['strength'])){
                $term_link = $term_link.'?strength='.$_POST['strength'];
            }
            $args['tax_query'] =  array(
                array(
                    'taxonomy'      => 'product_cat',
                    'field' => 'term_id',
                    'terms'         => $term->term_id,
                    'operator'      => 'IN'
                )
            );
            $products = new WP_Query($args);
            if ( $products->have_posts() ) :
                $output .= '<div class="cat-title text-center">';
                    $output .= '<h6 class="green-text">'.$term->name.'</h6>';
                $output .= '</div>';
                $output .= '<ul class="products columns-3 ">';
                    while ( $products->have_posts() ) : $products->the_post();
                        global $product;
                        $output .= '<li class="post-'.$product->get_id().' product type-product status-publish entry product-type-'.$product->get_type().'">';
                        $output .= '<a href="'.$product->get_permalink().'" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
                                $output .=  $product->get_image('woocommerce_thumbnail');
                                $output .= '<h6 class="woocommerce-loop-product__title">'.$product->get_name().'</h6>';
                                if($product->get_type() == 'variable'):
                                    $output .= '<span class="price"><span class="woocommerce-Price-amount amount">from <span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().'</span> '.$product->get_price().'</span></span>';
                                else:
                                    $output .= '<span class="price">'.$product->get_price_html().'</span>';
                                endif;
                        $output .= '</a>';
                        $output .= '</li>';
                    endwhile;
                    wp_reset_query();
                $output .= '</ul>';
                //if($products->post_count > 3):
                if($term->count > 3):
                    $output .= '<a href="'.$term_link.'" class="btn load-more ">LOAD MORE '.$term->name.' <i aria-hidden="true" class="arrow_carrot-2down d-block"></i></a>';
                endif;
            endif;
        endforeach;
    endif;
    echo json_encode(array('status' => 1, 'output' => $output));
    exit();
}
add_action('wp_ajax_filter_category_listing_product', 'filter_category_listing_product');
add_action('wp_ajax_nopriv_filter_category_listing_product', 'filter_category_listing_product');*/



add_action('init', function (){
    if( isset($_POST['form_type']) ) {

        if (!empty($_POST['contact-name'])) {
            $contact_name = 'Name: ' . sanitize_text_field($_POST['contact-name']);
        }
        if (!empty($_POST['contact-email'])) {
            $contact_email = 'Email: ' . sanitize_text_field($_POST['contact-email']);
        }
        if (!empty($_POST['contact-message'])) {
            $contact_message = 'Message: ' . sanitize_text_field($_POST['contact-message']);
        }
        if (!empty($_POST['contact-order-number'])) {
            $contact_order_number = 'Order Number: ' . sanitize_text_field($_POST['contact-order-number']);
        }

        if ($_POST['form_type'] == 'order-support') {
            $emailTo = get_field('order_support', 'option');

        } elseif ($_POST['form_type'] == 'website-error') {
            $emailTo = get_field('website_error', 'option');

        } else {
            $emailTo = get_field('general_inquiry', 'option');
        }

        $SubjectType = $_POST['form_type'];
        $subject = ucfirst(str_replace("-", ' ', $SubjectType));


        $body = '<!doctype html>
        <html>
        <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <style>
                /* -------------------------------------
                    GLOBAL RESETS
                ------------------------------------- */
        
                /*All the styling goes here*/
        
                img {
                    border: none;
                    -ms-interpolation-mode: bicubic;
                    max-width: 100%;
                }
        
                body {
                    background-color: #f6f6f6;
                    font-family: sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                    padding: 0;
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                }
        
                table {
                    border-collapse: separate;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    width: 100%; }
                table td {
                    font-family: sans-serif;
                    font-size: 14px;
                    vertical-align: top;
                }
        
                /* -------------------------------------
                    BODY & CONTAINER
                ------------------------------------- */
        
                .body {
                    background-color: #f6f6f6;
                    width: 100%;
                }
        
                /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                .container {
                    display: block;
                    margin: 0 auto !important;
                    /* makes it centered */
                    max-width: 580px;
                    padding: 10px;
                    width: 580px;
                }
        
                /* This should also be a block element, so that it will fill 100% of the .container */
                .content {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    max-width: 580px;
                    padding: 10px;
                }
        
                /* -------------------------------------
                    HEADER, FOOTER, MAIN
                ------------------------------------- */
                .main {
                    background: #ffffff;
                    border-radius: 3px;
                    width: 100%;
                }
        
                .wrapper {
                    box-sizing: border-box;
                    padding: 20px;
                }
        
                .content-block {
                    padding-bottom: 10px;
                    padding-top: 10px;
                }
        
                .footer {
                    clear: both;
                    margin-top: 10px;
                    text-align: center;
                    width: 100%;
                }
                .footer td,
                .footer p,
                .footer span,
                .footer a {
                    color: #999999;
                    font-size: 12px;
                    text-align: center;
                }
        
                /* -------------------------------------
                    TYPOGRAPHY
                ------------------------------------- */
                h1,
                h2,
                h3,
                h4 {
                    color: #000000;
                    font-family: sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    margin: 0;
                    margin-bottom: 30px;
                }
        
                h1 {
                    font-size: 35px;
                    font-weight: 300;
                    text-align: center;
                    text-transform: capitalize;
                }
        
                p,
                ul,
                ol {
                    font-family: sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    margin: 0;
                    margin-bottom: 15px;
                }
                p li,
                ul li,
                ol li {
                    list-style-position: inside;
                    margin-left: 5px;
                }
        
                a {
                    color: #3498db;
                    text-decoration: underline;
                }
        
                /* -------------------------------------
                    BUTTONS
                ------------------------------------- */
                .btn {
                    box-sizing: border-box;
                    width: 100%; }
                .btn > tbody > tr > td {
                    padding-bottom: 15px; }
                .btn table {
                    width: auto;
                }
                .btn table td {
                    background-color: #ffffff;
                    border-radius: 5px;
                    text-align: center;
                }
                .btn a {
                    background-color: #ffffff;
                    border: solid 1px #3498db;
                    border-radius: 5px;
                    box-sizing: border-box;
                    color: #3498db;
                    cursor: pointer;
                    display: inline-block;
                    font-size: 14px;
                    font-weight: bold;
                    margin: 0;
                    padding: 12px 25px;
                    text-decoration: none;
                    text-transform: capitalize;
                }
        
                .btn-primary table td {
                    background-color: #3498db;
                }
        
                .btn-primary a {
                    background-color: #3498db;
                    border-color: #3498db;
                    color: #ffffff;
                }
        
                /* -------------------------------------
                    OTHER STYLES THAT MIGHT BE USEFUL
                ------------------------------------- */
                .last {
                    margin-bottom: 0;
                }
        
                .first {
                    margin-top: 0;
                }
        
                .align-center {
                    text-align: center;
                }
        
                .align-right {
                    text-align: right;
                }
        
                .align-left {
                    text-align: left;
                }
        
                .clear {
                    clear: both;
                }
        
                .mt0 {
                    margin-top: 0;
                }
        
                .mb0 {
                    margin-bottom: 0;
                }
        
                .preheader {
                    color: transparent;
                    display: none;
                    height: 0;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                    mso-hide: all;
                    visibility: hidden;
                    width: 0;
                }
        
                .powered-by a {
                    text-decoration: none;
                }
        
                hr {
                    border: 0;
                    border-bottom: 1px solid #f6f6f6;
                    margin: 20px 0;
                }
        
                /* -------------------------------------
                    RESPONSIVE AND MOBILE FRIENDLY STYLES
                ------------------------------------- */
                @media only screen and (max-width: 620px) {
                    table[class=body] h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important;
                    }
                    table[class=body] p,
                    table[class=body] ul,
                    table[class=body] ol,
                    table[class=body] td,
                    table[class=body] span,
                    table[class=body] a {
                        font-size: 16px !important;
                    }
                    table[class=body] .wrapper,
                    table[class=body] .article {
                        padding: 10px !important;
                    }
                    table[class=body] .content {
                        padding: 0 !important;
                    }
                    table[class=body] .container {
                        padding: 0 !important;
                        width: 100% !important;
                    }
                    table[class=body] .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important;
                    }
                    table[class=body] .btn table {
                        width: 100% !important;
                    }
                    table[class=body] .btn a {
                        width: 100% !important;
                    }
                    table[class=body] .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important;
                    }
                }
        
                /* -------------------------------------
                    PRESERVE THESE STYLES IN THE HEAD
                ------------------------------------- */
                @media all {
                    .ExternalClass {
                        width: 100%;
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                        line-height: 100%;
                    }
                    .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important;
                    }
                    .btn-primary table td:hover {
                        background-color: #34495e !important;
                    }
                    .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important;
                    }
                }
        
            </style>
        </head>
        <body class="">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
            
                <table role="presentation" class="main">
            
                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td>' . $contact_name . '</td>
                    </tr>
                    <tr>
                        <td>' . $contact_email . '</td>
                    </tr>
                    <tr>
                        <td>' . $contact_order_number . '</td>
                    </tr>
                    <tr>
                        <td>' . $contact_message . '</td>
                    </tr>
                    <!-- END MAIN CONTENT AREA -->
                </table>            
             
        </body>
        </html>';
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: Urban Flavours <' . get_option('admin_email') . '>';
        wp_mail($emailTo, $subject, $body, $headers);
    }
});

/*function variable_product_ajax_add_to_cart(){
    $attribute = stripslashes(html_entity_decode($_POST['attribute']));
    $attribute_array = json_decode($attribute, true);
    $pid = $_POST['pid'];
    $variation_id = $_POST['vid'];
    $quantity = $_POST['quantity'];
    if($variation_id) {
        WC()->cart->add_to_cart( $pid, $quantity, $variation_id, $attribute_array );
        echo json_encode(array('view_cart' => '<a href="'.get_bloginfo('url').'/cart/" class="added_to_cart wc-forward d-inline-block ml-2 black-text viw-crd" title="View cart">View cart</a>'));
    }
    exit();
}

add_action('wp_ajax_variable_product_ajax_add_to_cart', 'variable_product_ajax_add_to_cart');
add_action('wp_ajax_nopriv_variable_product_ajax_add_to_cart', 'variable_product_ajax_add_to_cart');


function load_all_products_by_category(){
    $curpageid = $_POST['curpageid'];
    $show_num_of_itm_def = $_POST['show_num_of_itm_def'];
    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'posts_per_page'        => $show_num_of_itm_def,
        'offset' => $curpageid * $show_num_of_itm_def,
        'tax_query'             => array(
            array(
                'taxonomy'      => $_POST['taxonomy'],
                'field' => 'term_id',
                'terms'         => $_POST['trmid'],
                'operator'      => 'IN'
            )
        )
    );
    $output = '';
    $nomoretoload = 0;
    $products = new WP_Query($args);
    if ( $products->have_posts() ) :
        while ( $products->have_posts() ) : $products->the_post();
            global $product;
            $output .= '<li class="post-'.$product->get_id().' product type-product status-publish entry product-type-'.$product->get_type().'">';
            $output .= '<a href="'.$product->get_permalink().'" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
            $output .=  $product->get_image('woocommerce_thumbnail');
            $output .= '<h6 class="woocommerce-loop-product__title">'.$product->get_name().'</h6>';
            if($product->get_type() == 'variable'):
                $output .= '<span class="price"><span class="woocommerce-Price-amount amount">from <span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().'</span> '.$product->get_price().'</span></span>';
            else:
                $output .= '<span class="price">'.$product->get_price_html().'</span>';
            endif;
            $output .= '</a>';
            $output .= '</li>';
        endwhile;
        if($products->post_count < $show_num_of_itm_def){
            $nomoretoload = 1;
        }
        $curpageid++;
        wp_reset_query();
    endif;
    echo json_encode(array('status' => 1, 'output' => $output, 'curpageid' => $curpageid, 'nomoretoload' => $nomoretoload));
    exit();
}
add_action('wp_ajax_load_all_products_by_category', 'load_all_products_by_category');
add_action('wp_ajax_nopriv_load_all_products_by_category', 'load_all_products_by_category');


function filter_single_category_product(){
    global $wpdb;
    $price_range = json_decode($_POST['price_range']);
    $taxonomy = $_POST['taxonomy'];
    $trmid = $_POST['trmid'];

    $args = array(
        'post_type'             => 'product',
        'post_status'           => 'publish',
        'posts_per_page'        => -1,
    );

    $meta_query = array(
        'relation' => 'AND',
    );
    $price_args = array(
        'key' => '_price',
        'value' => $price_range,
        'compare' => 'BETWEEN',
        'type' => 'NUMERIC'
    );
    $meta_query[] = $price_args;
    if(!empty($_POST['strength'])){
        //$strength_args = array(
            //'key' => 'strength',
            //'value' => ''.$_POST['strength'].'',
            //'compare' => '=',
        //);
        //$meta_query[] = $strength_args;


        if ( $_POST['strength'] == 'Highest THC' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'thc';
            $args['order'] = 'DESC';
        } elseif( $_POST['strength'] == 'Lowest THC' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'thc';
            $args['order'] = 'ASC';
        } elseif( $_POST['strength'] == 'Highest CBD' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'cbd';
            $args['order'] = 'DESC';
        } elseif( $_POST['strength'] == 'Lowest CBD' ) {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'cbd';
            $args['order'] = 'ASC';
        }
    }

    $args['meta_query'] =  $meta_query;

    //if(!empty($_POST['order_by'])){
    if(!empty($_POST['order_by']) && empty($_POST['strength'])){
        if($_POST['order_by'] == 'best-selling'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
        }
        if($_POST['order_by'] == 'popularity'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order'] = 'DESC';
        }
        if($_POST['order_by'] == 'rating'){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_wc_average_rating';
        }
        if($_POST['order_by'] == 'high-to-low'){
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            $args['meta_key'] = '_price';
        }
        if($_POST['order_by'] == 'low-to-high'){
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            $args['meta_key'] = '_price';
        }
        if($_POST['order_by'] == 'latest'){
            $args['orderby'] = 'ID';
            $args['order'] = 'DESC';
        }
    }

    $output = '';

    $args['tax_query'] =  array(
        array(
            'taxonomy'      => $taxonomy,
            'field' => 'term_id',
            'terms'         => $trmid,
            'operator'      => 'IN'
        )
    );

    $products = new WP_Query($args);

    if ( $products->have_posts() ) :
        while ( $products->have_posts() ) : $products->the_post();
            global $product;
            $output .= '<li class="post-'.$product->get_id().' product type-product status-publish entry product-type-'.$product->get_type().'">';
            $output .= '<a href="'.$product->get_permalink().'" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
            $output .=  $product->get_image('woocommerce_thumbnail');
            $output .= '<h6 class="woocommerce-loop-product__title">'.$product->get_name().'</h6>';
            if($product->get_type() == 'variable'):
                $output .= '<span class="price"><span class="woocommerce-Price-amount amount">from <span class="woocommerce-Price-currencySymbol">'.get_woocommerce_currency_symbol().'</span> '.$product->get_price().'</span></span>';
            else:
                $output .= '<span class="price">'.$product->get_price_html().'</span>';
            endif;
            $output .= '</a>';
            $output .= '</li>';
        endwhile;
        wp_reset_query();
    endif;
    echo json_encode(array('status' => 1, 'output' => $output));
    exit();
}
add_action('wp_ajax_filter_single_category_product', 'filter_single_category_product');
add_action('wp_ajax_nopriv_filter_single_category_product', 'filter_single_category_product');

remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);


function save_review(){
    $pid = $_POST['pid'];
    $rate_value = $_POST['rate_value'];
    $reviewer_name = sanitize_text_field($_POST['reviewer_name']);
    $user_email = sanitize_text_field($_POST['reviewer_email']);
    $comment = sanitize_textarea_field($_POST['comment']);
    $uid = get_current_user_id();
    //$userdata = get_userdata( $uid );
    //$user_email = $userdata->user_email;


    $time = current_time('mysql');

    $data = array(
        'comment_post_ID' => $pid,
        'comment_author' => $reviewer_name,
        'comment_author_email' => $user_email,
        'comment_author_url' => '',
        'comment_content' => $comment,
        'comment_type' => 'review',
        'comment_parent' => 0,
        'user_id' => $uid,
        'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
        'comment_agent' => $_SERVER['HTTP_USER_AGENT'],
        'comment_date' => $time,
        'comment_approved' => 0,
    );

    $comment_id = wp_insert_comment($data);
    if($comment_id){
        add_comment_meta( $comment_id, 'rating', $rate_value );
        add_comment_meta( $comment_id, 'verified', 0 );
        echo json_encode(array('status' => 1));
    }else {
        echo json_encode(array('status' => 2));
    }
    exit();
}

add_action('wp_ajax_save_review', 'save_review');
add_action('wp_ajax_nopriv_save_review', 'save_review');

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields', 100 );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    //echo '<pre>';
    //print_r($fields);
    //echo '</pre>';
    $fields['billing']['billing_first_name'] = array(
        'label'     => __('First name', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide')
    );

    $fields['billing']['billing_last_name'] = array(
        'label'     => __('Last name', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide')
    );

    unset($fields['billing']['billing_company']);

    $fields['billing']['billing_phone'] = array(
        'label'     => __('Phone', 'woocommerce'),
        'required'  => true,
        'priority'     => 31,
    );

    $fields['billing']['billing_email'] = array(
        'label'     => __('Email Address', 'woocommerce'),
        'required'  => true,
        'priority'     => 32,
    );

    $fields['billing']['billing_address_1'] = array(
        'label'     => __('Address', 'woocommerce'),
        'required'  => true,
    );

    $fields['billing']['billing_postcode'] = array(
        'label' => 'Postcode / ZIP',
        'required' => 1,
        'class' => array('form-row-wide','address-field'),
        'validate' => array('postcode'),
        'autocomplete' => 'postal-code',
        'priority' => 91
    );

    $fields['order']['order_comments'] = array(
        'type' => 'textarea',
        'class' => array('notes'),
        'label' => 'ORDER NOTES',
        'placeholder' => '',
        'priority' => 92
    );

    //echo '<pre>';
    //print_r($fields);
    //echo '</pre>';

    return $fields;
}

function check_authentication(){
    $logname = sanitize_text_field($_POST['logname']);
    $pwd = sanitize_text_field($_POST['pwd']);
    $user = get_user_by( 'login', $logname );
    $user1 = get_user_by( 'email', $logname );

    $status = get_user_meta($user->ID,'status', true);
    if(empty($status)){
        $status = get_user_meta($user1->ID,'status', true);
    }
    if($status == 'unapproved'){
        echo json_encode(array('status' => 3));
    }elseif($status == 'inactive'){
        echo json_encode(array('status' => 4));
    }else{
        if ((!empty($user) || !empty($user1)) && (wp_check_password($pwd, $user->data->user_pass, $user->ID) || wp_check_password($pwd, $user1->data->user_pass, $user1->ID))) {
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 2));
        }
    }
    exit();
}

add_action('wp_ajax_nopriv_check_authentication', 'check_authentication');

function my_login_redirect( $redirect_to, $request, $user ) {
    if (isset($user->roles) && is_array($user->roles)) {
        if (in_array('customer', $user->roles) || in_array('subscriber', $user->roles)) {
            $redirect_to =  get_bloginfo('url').'/my-account';
        }
    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
    $url = get_bloginfo('url').'/login';
    wp_redirect( $url );
    exit();
}


function norcanna_change_upload_path(){
    return trailingslashit( WP_CONTENT_DIR ) . 'uploads/image/';
}
function norcanna_change_upload_url(){
    return trailingslashit(content_url()) . 'uploads/image/';
}

function original_resize( $uploadedfile, $width=500, $height=500, $imgRESIZE=true ){
    $image_editor = wp_get_image_editor( $uploadedfile );
    if ( ! is_wp_error( $image_editor ) ) {
        if($imgRESIZE == true){
            $w_RESIZE = $width;
            $h_RESIZE = $height;
            $file_info = pathinfo($uploadedfile);
            $dir = trailingslashit($file_info['dirname']);
            $file_name = $file_info['basename'];
            $ext = $file_info['extension'];
            $file_name_without_ext = str_replace('.'.$ext, '', $file_name);
            $new_name = $dir . $file_name_without_ext . '-thumb'. '.' . $ext;

            $sizeORIG = $image_editor->get_size();

            if( ( isset( $sizeORIG['width'] ) && $sizeORIG['width'] > $w_RESIZE ) || ( isset( $sizeORIG['height'] ) && $sizeORIG['height'] > $h_RESIZE ) ) {
                $image_editor->resize( $w_RESIZE, $h_RESIZE, false );
                $image_editor->set_quality(80);
                $image_editor->save( $new_name );
            }
        }
    }
}

add_action('wp_ajax_nopriv_id_image_upload', 'urban_flavours_id_image_upload');
add_action('wp_ajax_id_image_upload', 'urban_flavours_id_image_upload');
function urban_flavours_id_image_upload(){
    if(!empty($_POST['action']) && $_POST['action'] === 'id_image_upload'  && !empty($_FILES)){

//		define('DOING_AJAX', true);
        $response = array(
            'type' => 'error'
        );
        add_filter( 'pre_option_upload_path', 'urban_flavours_change_upload_path');
        add_filter( 'pre_option_upload_path', 'urban_flavours_change_upload_url');

        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        $uploadedfile = $_FILES['image'];
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

        // Avatar image upload
        global  $current_user;
        update_user_meta($current_user->ID, 'photo_id', $movefile['url']);

        if ( $movefile && ! isset( $movefile['error'] ) ) {
            original_resize($movefile['file'], 100, 100);
            $response['type'] = 'success';
            $response['data'] = $movefile;
        } else {
            $response['msg'] = $movefile['error'];
        }
        remove_filter( 'pre_option_upload_path', 'urban_flavours_change_upload_path');
        remove_filter( 'pre_option_upload_path', 'urban_flavours_change_upload_url');
        wp_send_json( $response );
    }elseif(!empty($_POST['action']) && $_POST['action'] === 'id_image_upload' &&  $_POST['id'] === 'dz_upload4' && $_POST['image'] === 'undefined'){
        $response['type'] = 'success';
        $response['upload_image'] = '';
        wp_send_json( $response );
    }
}

function wp_registration_step_data_table_create() {

    if ( is_admin() && isset($_GET['activated'] )) {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'registration_step_data';

        $sql = "CREATE TABLE $table_name (
		id int(11) NOT NULL AUTO_INCREMENT,
		user_email varchar(50) NOT NULL,
		form_data text NOT NULL,
		created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		status int(2) NOT NULL,
		PRIMARY KEY (id)
	) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

}

add_action("after_switch_theme", "wp_registration_step_data_table_create");

function save_registration_data(){
    global $wpdb;
    $table_registration = $wpdb->prefix . 'registration_step_data';

    $full_name = sanitize_text_field($_POST['fname']);
    $birth_date = sanitize_text_field($_POST['birthdate']);
    $user_email = sanitize_text_field($_POST['email']);
    $user_phone = sanitize_text_field($_POST['phone']);
    $zip_code = sanitize_text_field($_POST['zipcode']);
    $user_password = sanitize_text_field($_POST['userpassword']);
    $address = sanitize_text_field($_POST['address']);
    $front_side = $_POST['front_side'];
    $back_side = $_POST['back_side'];
    $medical_id = $_POST['medical_id'];
    $photo_id = $_POST['photo_id'];
    $allow_text_message = $_POST['allow_text_message'];

    if (!empty($full_name))
        $user_name = preg_replace('/\s+/', '', $user_email);

    $user_id = username_exists($user_name);
    if (!$user_id && email_exists($user_email) == false) {
        $userdata = array(
            'user_pass' => $user_password,
            'user_login' => $user_name,
            'user_email' => $user_email,
            'display_name' => $full_name,
            'role' => 'subscriber'
        );
        $user_id = wp_insert_user($userdata);
        if ($user_id) {
            update_user_meta($user_id, 'full_name', $full_name);
            update_user_meta($user_id, 'birth_date', $birth_date);
            update_user_meta($user_id, 'user_phone', $user_phone);
            update_user_meta($user_id, 'zip_code', $zip_code);
            update_user_meta($user_id, 'address', $address);
            update_user_meta($user_id, 'front_side', $front_side);
            update_user_meta($user_id, 'back_side', $back_side);
            update_user_meta($user_id, 'medical_id', $medical_id);
            update_user_meta($user_id, 'photo_id', $photo_id);
            update_user_meta($user_id, 'allow_text_message', $allow_text_message);
            //update_user_meta($user_id, 'expired_date', $expired_date);
            update_user_meta($user_id, 'status', 'unapproved');
            update_user_meta($user_id, 'registered_on', date('Y-m-d H:i:s'));

            $full_name_array = explode(' ', $full_name);
            if (is_array($full_name_array) && count($full_name_array) > 1) {
                update_user_meta($user_id, 'billing_first_name', $full_name_array[0]);
                update_user_meta($user_id, 'first_name', $full_name_array[0]);
                update_user_meta($user_id, 'billing_last_name', $full_name_array[1]);
                update_user_meta($user_id, 'last_name', $full_name_array[1]);
            } else {
                update_user_meta($user_id, 'billing_first_name', $full_name);
                update_user_meta($user_id, 'first_name', $full_name);
            }

            update_user_meta($user_id, 'billing_email', $user_email);
            update_user_meta($user_id, 'billing_country', 'US');
            update_user_meta($user_id, 'billing_state', 'CA');
            update_user_meta($user_id, 'billing_phone', $user_phone);
            update_user_meta($user_id, 'billing_postcode', $zip_code);
            update_user_meta($user_id, 'billing_address_1', $address);


            $registration_notification_email_send = get_field('registration_notification_email_send', 'option');
            if ($registration_notification_email_send) {
                $send_to_admin = get_field('admin_email', 'option');
                if (empty($send_to_admin))
                    $send_to_admin = get_option('admin_email');
                $send_to_user = $user_email;
                $nonce = wp_create_nonce('approve-user');
                $admn_subject = get_field('registration_email_subject_to_admin', 'option');
                $admin_subject = $admn_subject ? $admn_subject : 'New user registration';
                $usr_subject = get_field('registration_email_subject_to_user', 'option');
                $user_subject = $usr_subject ? $usr_subject : 'Registration complete';

                $admin_message = get_email_template('template-parts/email/admin-register-email');
                $user_message = get_email_template('template-parts/email/user-register-email');

                $user_list_page = admin_url('users.php');
                $a_args = array(
                    'user_id' => $user_id,
                    'nonce' => $nonce,
                    'user_list_page' => $user_list_page
                );

                $u_args = array(
                    'full_name' => $full_name
                );

                send_email_notification($send_to_admin, $admin_subject, $admin_message, $a_args, $send_to_user);
                send_email_notification($send_to_user, $user_subject, $user_message, $u_args);

            }
            //Send SMS
            $send_sms = get_field('send_sms', 'option');
            if ($send_sms == 'All Users' && $allow_text_message == 1) {
                $user_message = get_field('sms_text_for_registration', 'option');
                send_msg_notification($user_phone, $user_message);
            }

            $wpdb->delete(
                $table_registration,
                array(
                    'user_email' => $user_email
                ),
                array(
                    '%s'
                )
            );

            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 2));
        }
    } else {
        echo json_encode(array('status' => 3));
    }

    exit();
}

add_action('wp_ajax_nopriv_save_registration_data', 'save_registration_data');*/


function send_email_notification($to,$subject,$body = NULL, $args = array(), $from = NULL){

    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    if($from !== NULL) {
        $headers[] = 'From: Urban Flavours <' . $from . '>';
    }else{
        $headers[] = 'From: Urban Flavours <' . get_field('admin_email', 'option') . '>';
    }

    //$headers = array('Content-Type: text/html; charset=UTF-8');

    if(!empty($args) && $body !== NULL){
        foreach($args as $key => $value){
            $body = str_replace('{'.strtoupper($key).'}', $value, $body);
        }
    }

    wp_mail($to, $subject, $body, $headers);
}

function get_email_template($template){
    ob_start();
    get_template_part( $template );
    return ob_get_clean();
}

/*function modify_user_table_column( $column ) {
    $column['status'] = 'Status';
    return $column;
}
add_filter( 'manage_users_columns', 'modify_user_table_column' );

function modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'status' :
            $user_meta=get_userdata($user_id);
            $user_roles=$user_meta->roles;

            if($user_roles[0] != 'administrator'):
                $status = get_user_meta($user_id, 'status', true);
                if($status === 'unapproved') {
                    $output = '<span style="color:red">Unapproved</span>';
                }
                if($status === 'active') {
                    $output = '<span style="color:green">Active</span>';
                }
                if($status === 'inactive') {
                    $output = '<span style="color:purple">Inactive</span>';
                }
                return $output;
            endif;
            break;
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'modify_user_table_row', 10, 3 );


function custom_user_profile_fields($user) {
    $user_meta = get_user_meta($user->ID);
    $birth_date = $user_meta['birth_date'][0] ? $user_meta['birth_date'][0] : '';
    $user_phone = $user_meta['user_phone'][0] ? $user_meta['user_phone'][0] : '';
    $zip_code = $user_meta['zip_code'][0] ? $user_meta['zip_code'][0] : '';
    $address = $user_meta['address'][0] ? $user_meta['address'][0] : '';
    $front_side = $user_meta['front_side'][0] ? $user_meta['front_side'][0] : '';
    $back_side = $user_meta['back_side'][0] ? $user_meta['back_side'][0] : '';
    $medical_id = $user_meta['medical_id'][0] ? $user_meta['medical_id'][0] : '';
    $photo_id = $user_meta['photo_id'][0] ? $user_meta['photo_id'][0] : '';
    $status = $user_meta['status'][0] ? $user_meta['status'][0] : '';
    if(!empty($birth_date)):
        ?>
        <h2>Registration Information</h2>
        <table class="form-table">
            <?php if(!empty($birth_date)):?>
                <tr>
                    <th>
                        <label for="user_birth_date"><?php _e('Birth Date'); ?></label>
                    </th>
                    <td>
                        <span class="user_birth_date"><?php echo date('d M, Y',strtotime($birth_date)); ?></span>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($user_phone)):?>
                <tr>
                    <th>
                        <label for="user_user_phone"><?php _e('Phone'); ?></label>
                    </th>
                    <td>
                        <span class="user_user_phone"><?php echo $user_phone; ?></span>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($zip_code)):?>
                <tr>
                    <th>
                        <label for="user_zip_code"><?php _e('Zip Code'); ?></label>
                    </th>
                    <td>
                        <span class="user_zip_code"><?php echo $zip_code; ?></span>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($address)):?>
                <tr>
                    <th>
                        <label for="user_address"><?php _e('Address'); ?></label>
                    </th>
                    <td>
                        <span class="user_address"><?php echo $address; ?></span>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($front_side)):?>
                <tr>
                    <th>
                        <label for="user_front_side"><?php _e('Front Side'); ?></label>
                    </th>
                    <td>
                        <a class="fancybox" rel="group" href="<?php echo $front_side; ?>"><img src="<?php echo $front_side; ?>" width="70px"></a>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($back_side)):?>
                <tr>
                    <th>
                        <label for="user_back_side"><?php _e('Back Side'); ?></label>
                    </th>
                    <td>
                        <a class="fancybox" rel="group" href="<?php echo $back_side; ?>"><img src="<?php echo $back_side; ?>" width="70px"></a>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($medical_id)):?>
                <tr>
                    <th>
                        <label for="user_medical_id"><?php _e('Medical ID'); ?></label>
                    </th>
                    <td>
                        <a class="fancybox" rel="group" href="<?php echo $medical_id; ?>"><img src="<?php echo $medical_id; ?>" width="70px"></a>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($photo_id)):?>
                <tr>
                    <th>
                        <label for="user_photo_id"><?php _e('Photo ID'); ?></label>
                    </th>
                    <td>
                        <a class="fancybox" rel="group" href="<?php echo $photo_id; ?>"><img src="<?php echo $photo_id; ?>" width="70px"></a>
                    </td>
                </tr>
            <?php endif;?>
            <?php if(!empty($status)):?>
                <tr>
                    <th>
                        <label for="user_birth_date"><?php _e('Current Status'); ?></label>
                    </th>
                    <td>
                        <select name="user_status">
                            <option value="unapproved" <?php if(!empty($status) && $status == 'unapproved'){?>selected<?php };?>>Unapproved</option>
                            <option value="active" <?php if(!empty($status) && $status == 'active'){?>selected<?php };?>>Active</option>
                            <option value="inactive" <?php if(!empty($status) && $status == 'inactive'){?>selected<?php };?>>Inactive</option>
                    </td>
                </tr>
            <?php endif;?>
        </table>
    <?php
    endif;
}

add_action('show_user_profile', 'custom_user_profile_fields', 100, 1);
add_action('edit_user_profile', 'custom_user_profile_fields', 100, 1);


add_action('edit_user_profile_update', 'update_user_status_data');

function update_user_status_data($user_id) {
    $userdata = get_userdata( $user_id );
    $user_email = $userdata->user_email;

    $full_name = get_user_meta($user_id, 'full_name', true);

    update_user_meta($user_id, 'status', $_POST['user_status']);

    if($_POST['user_status'] == 'active') {
        $approve_notification_email_send = get_field('approve_notification_email_send', 'option');
        if ($approve_notification_email_send) {
            $sub = get_field('approve_notification_email_subject','option');
            $subject = $sub ? $sub : 'Account approved.';
            $message = get_email_template('template-parts/email/user-approve-email');
            $u_args = array(
                'full_name' => $full_name
            );
            send_email_notification($user_email, $subject, $message, $u_args);
        }

        //Send SMS

        $allow_text_message = get_user_meta($user_id, 'allow_text_message', true);
        $user_phone = get_user_meta($user_id, 'user_phone', true);

        $send_sms = get_field('send_sms','option');
        if($send_sms == 'All Users' && $allow_text_message == 1) {
            $user_message = get_field('sms_text_for_approve_account','option');
            send_msg_notification($user_phone, $user_message);
        }
    }

    //Send SMS
    if($_POST['user_status'] == 'inactive') {
        $allow_text_message = get_user_meta($user_id, 'allow_text_message', true);
        $user_phone = get_user_meta($user_id, 'user_phone', true);

        $send_sms = get_field('send_sms','option');
        if($send_sms == 'All Users' && $allow_text_message == 1) {
            $user_message = get_field('sms_text_when_inactive_user','option');
            send_msg_notification($user_phone, $user_message);
        }
    }
}*/

function send_msg_notification($to, $body){
    $to = '+' . str_replace('+', '', $to);
    $data = array(
        'to' => $to,
		//'to' => '+8801712304436',
        'body' => $body,
        'from' => true,
    );
    $twl = new Twilio_Integration(false, $data);
    return $twl->sendMessage();
}

/*add_filter( 'woocommerce_my_account_my_orders_query', 'custom_my_account_orders_query', 20, 1 );
function custom_my_account_orders_query( $args ) {
    $args['limit'] = -1;
    return $args;
}*/

//Add Ajax Actions
function advance_search(){
    $search_term = esc_attr( $_POST['keyword'] );
    if(!empty($search_term)):
        $output = $productImage = '';

        $pageArgs = array(
            'posts_per_page' => -1,
            'post_type' => array( 'page' ),
            's' => $search_term
        );

        $pagesLoop = new WP_Query( $pageArgs );

        if ( $pagesLoop->have_posts() ) {

            $output .= '<div class="search-padding">';

            $output .= '<h6 class="text-uppercase">Pages</h6>';

            $page_count = 1;

            while ($pagesLoop->have_posts()) : $pagesLoop->the_post();

                // Page Data
                if ($page_count <= 2) {
                    $page_count++;

                    $title = get_the_title();
                    $keys= explode(" ",$search_term);
                    $title = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="highlight">\0</span>', $title);

                    $output .= '<div class="search-faq fa-style"><p><a href="' . get_the_permalink() . '"><i class="fa fa-question"></i> ' . $title . '</a></p></div>';
                }


            endwhile;
            wp_reset_postdata();

            if ($pagesLoop->post_count > 2){
                $output .= ' <div class="show-more-search"><span><span></span></span><a href="'.get_bloginfo('url').'?s='.$search_term.'&p_type=page">Show all ' . $pagesLoop->post_count . ' results</a></div>';
            }
            $output .= '</div>';
        }
    endif;
    echo json_encode(array('output' => $output));
    exit();

}

add_action( 'wp_ajax_advance_search', 'advance_search' );
add_action( 'wp_ajax_nopriv_advance_search', 'advance_search' );

function search_filter($query) {

    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['p_type']) && !empty($_GET['p_type'])):
            $query->set('post_type', $_GET['p_type']);
        endif;
    }

    return $query;
}

add_filter('pre_get_posts', 'search_filter');

/*function edit_registration_data(){
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    $user_login_old = $current_user->user_login;
    $user_email_old = $current_user->user_email;
    $display_name_old = $current_user->display_name;

    $old_front_side = get_user_meta($user_id,'front_side',true);
    $old_back_side = get_user_meta($user_id,'back_side',true);
    $old_medical_id = get_user_meta($user_id,'medical_id',true);

    $full_name = sanitize_text_field($_POST['fname']);
    $birth_date = sanitize_text_field($_POST['birthdate']);
    $user_email = sanitize_text_field($_POST['email']);
    $user_phone = sanitize_text_field($_POST['phone']);
    $zip_code = sanitize_text_field($_POST['zipcode']);
    $user_password = sanitize_text_field($_POST['userpassword']);
    $address = sanitize_text_field($_POST['address']);
    $front_side = $_POST['front_side'];
    $back_side = $_POST['back_side'];
    $medical_id = $_POST['medical_id'];
    $photo_id = $_POST['photo_id'];
    $allow_text_message = $_POST['allow_text_message'];

    if (!empty($full_name))
        $user_name = preg_replace('/\s+/', '', $user_email);


    $userdata = array();
    $userdata['ID'] = $user_id;
    if(!empty($user_password)){
        $userdata['user_pass'] = $user_password;
    }

    if($user_login_old != $user_name){
        $userdata['user_login'] = $user_name;
    }

    if($user_email_old != $user_email){
        $userdata['user_email'] = $user_email;
    }

    if($display_name_old != $full_name){
        $userdata['display_name'] = $full_name;
    }

    if(count($userdata) > 1){
        $user_id = wp_update_user( $userdata );
    }

    update_user_meta($user_id, 'full_name', $full_name);
    update_user_meta($user_id, 'birth_date', $birth_date);
    update_user_meta($user_id, 'user_phone', $user_phone);
    update_user_meta($user_id, 'zip_code', $zip_code);
    update_user_meta($user_id, 'address', $address);
    update_user_meta($user_id, 'front_side', $front_side);
    update_user_meta($user_id, 'back_side', $back_side);
    update_user_meta($user_id, 'medical_id', $medical_id);
    update_user_meta($user_id, 'photo_id', $photo_id);
    update_user_meta($user_id, 'allow_text_message', $allow_text_message);

    $lg = 0;
    if($front_side !== $old_front_side || $back_side !== $old_back_side || (isset($medical_id) && $medical_id !== $old_medical_id) ) {
        update_user_meta($user_id, 'status', 'unapproved');
        $lg = 1;

        $send_to_admin = get_field('admin_email','option');
        // subject
        $subject = 'Upload ID Changed!';
        $subject2 = 'Need Approved!';
        $message = '<html>
        <head>
          <title>Urban Flavours</title>
        </head>
        <body>
            <table>
                <tr>
                    <td><p>Hi,<br/>'.$current_user->display_name.' has changed medical ID. Please check from <a href="'.get_admin_url().'user-edit.php?user_id='.$current_user->ID.'">here</a>.<br/>Thank you</p></td>
                </tr>
            </table>
        </body>
    </html>';
        $message2 = '<html>
        <head>
          <title>Urban Flavours</title>
        </head>
        <body>
            <table>
                <tr>
                    <td><p>Hi '.$current_user->display_name.',<br/> You can\'t log in until admin approve you again.<br/>Thank you</p></td>
                </tr>
            </table>
        </body>
    </html>';
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        $headers[] = 'From: Urban Flavours <'.$current_user->user_email.'>';
        wp_mail($send_to_admin, $subject, $message, $headers);

        $headers2[] = 'Content-Type: text/html; charset=UTF-8';
        $headers2[] = 'From: Urban Flavours <'.$send_to_admin.'>';
        wp_mail($current_user->user_email, $subject2, $message2, $headers2);


    }

    update_user_meta($user_id, 'updated_on', date('Y-m-d H:i:s'));

    $full_name_array = explode(' ', $full_name);
    if (is_array($full_name_array) && count($full_name_array) > 1) {
        update_user_meta($user_id, 'billing_first_name', $full_name_array[0]);
        update_user_meta($user_id, 'first_name', $full_name_array[0]);
        update_user_meta($user_id, 'billing_last_name', $full_name_array[1]);
        update_user_meta($user_id, 'last_name', $full_name_array[1]);
    } else {
        update_user_meta($user_id, 'billing_first_name', $full_name);
        update_user_meta($user_id, 'first_name', $full_name);
    }

    update_user_meta($user_id, 'billing_email', $user_email);
    update_user_meta($user_id, 'billing_country', 'US');
    update_user_meta($user_id, 'billing_state', 'CA');
    update_user_meta($user_id, 'billing_phone', $user_phone);
    update_user_meta($user_id, 'billing_postcode', $zip_code);
    update_user_meta($user_id, 'billing_address_1', $address);
    if($lg){
        echo json_encode(array('status' => 2));
    }else {
        echo json_encode(array('status' => 1));
    }
    exit();
}

add_action('wp_ajax_edit_registration_data', 'edit_registration_data');*/

function enqueue_admin_script($hook) {
    wp_register_style( 'fancybox_css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css', false );
    wp_enqueue_style( 'fancybox_css' );

    wp_enqueue_script( 'admin_custom_script', get_template_directory_uri() . '/js/admin-script.js' );
    wp_enqueue_script( 'fancybox_js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js' );
}

add_action( 'admin_enqueue_scripts', 'enqueue_admin_script' );


/*function filter_users_by_status($query)
{
    global $pagenow;
    if (is_admin() && 'users.php' == $pagenow) {
        if(isset($_GET['status'])){
            $meta_query = array(
                array(
                    'key' => 'status',
                    'value' => $_GET['status']
                )
            );
            $query->set( 'meta_key', 'status' );
            $query->set( 'meta_query', $meta_query );

            $query->query_vars['orderby'] = 'user_registered';
            $query->query_vars['order']   = 'DESC';

        }

        if(isset($_GET['approve_user']) && wp_verify_nonce( $_GET['_wpnonce'], 'approve-user' )) {
            update_user_meta( $_GET['approve_user'], 'status', 'active' );
            $userdata = get_userdata( $_GET['approve_user'] );
            $user_email = $userdata->user_email;
            //$user_email = 'developer2@puredevs.com';
            $sub = get_field('approve_notification_email_subject','option');
            $subject = $sub ? $sub : 'Account approved.';
            $message = get_email_template('template-parts/email/user-approve-email');
            $full_name = get_user_meta($_GET['approve_user'], 'full_name', true);
            $u_args = array(
                'full_name' => $full_name
            );

            send_email_notification($user_email, $subject, $message, $u_args);

            //Send SMS

            $allow_text_message = get_user_meta($_GET['approve_user'], 'allow_text_message', true);
            $user_phone = get_user_meta($_GET['approve_user'], 'user_phone', true);

            $send_sms = get_field('send_sms','option');
            if($send_sms == 'All Users' && $allow_text_message == 1) {
                $user_message = get_field('sms_text_for_approve_account','option');
                send_msg_notification($user_phone, $user_message);
            }
        }


        $top = $_GET['status_top'];
        $bottom = $_GET['status_bottom'];
        if (!empty($top) OR !empty($bottom)) {
            $section = !empty($top) ? $top : $bottom;
            $meta_query = array (array (
                'key' => 'status',
                'value' => $section,
                'compare' => '='
            ));
            $query->set('meta_query', $meta_query);
        }
    }
}
add_filter('pre_get_users', 'filter_users_by_status');*/

function change_view_link( $actions, $user_object ) {
    if ( current_user_can( 'administrator', $user_object->ID ) ) {
        $actions['view'] = '<a href="'.get_edit_user_link($user_object->ID).'">View</a>';
    }
    return $actions;
}

add_filter( 'user_row_actions', 'change_view_link', 10, 2 );

