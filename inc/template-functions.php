<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package urban_flavours
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function urban_flavours_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'urban_flavours_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function urban_flavours_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'urban_flavours_pingback_header' );

function urban_validate_email_function(){
	$email = sanitize_text_field($_POST['email']);
	$response = array(
		'status'=>'success'
	);
	if(email_exists($email) || username_exists($email)){
		$response['status'] = 'error';
	}
	wp_send_json($response);
}

add_action('wp_ajax_nopriv_urban_validate_email', 'urban_validate_email_function');
add_action('wp_ajax_urban_validate_email', 'urban_validate_email_function');


function save_registration_first_step_data(){
	global $wpdb;
	$table_registration = $wpdb->prefix . 'registration_step_data';
	$values = array();
	parse_str($_POST['formdata'], $values);
	$formdata = serialize($values);
	$email = $_POST['email'];
	$email_exist = $wpdb->get_var("SELECT id FROM $table_registration WHERE user_email='$email'");
	if($email_exist != NULL){
		$wpdb->update(
			$table_registration,
			array(
				'form_data' => $formdata,
				'status' => 0
			),
			array( 'user_email' => $email ),
			array(
				'%s',
				'%d'
			),
			array( '%s' )
		);
	}else{
		$res = $wpdb->insert(
			$table_registration,
			array(
				'user_email' => $email,
				'form_data' => $formdata,
				'status' => 0
			),
			array(
				'%s',
				'%s',
				'%d'
			)
		);
	}
	echo json_encode(array('status' => 1));
	exit();
}

add_action('wp_ajax_nopriv_save_registration_first_step_data', 'save_registration_first_step_data');
