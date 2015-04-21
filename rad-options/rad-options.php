<?php 
/*
Plugin Name: Company Info Settings
Description:  Adds a page to the admin panel under settings
Plugin URI: http://site-where-plugin-is-hosted.com
Author: Melissa Cabral
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
*/

/**
 * Add a page to the admin (under settings)
 */
add_action( 'admin_menu', 'rad_options_page' );
function rad_options_page(){
	add_options_page( 'Company Information', 'Company Info', 'manage_options', 
		'company-info',  'rad_options_html' );
}

//callback for content
function rad_options_html(){
	//security check!
	if( current_user_can( 'manage_options' ) ){
		//include the form
		include( plugin_dir_path( __FILE__ ) . 'rad-form.php' );
	}else{
		wp_die('You do not have permission to see this page.');
	}
}

/**
 * Create a group of options that are allowed in the options table
 */
add_action( 'admin_init' , 'rad_create_settings' );
function rad_create_settings(){
					//  Group name 			DB row name 	sanitizing function
	register_setting( 'rad_options_group', 'rad_options', 'rad_opt_sanitize' );
}

function rad_opt_sanitize($input){
	$clean['phone'] = wp_filter_nohtml_kses( $input['phone'] );
	$clean['email'] = wp_filter_nohtml_kses( $input['email'] );

	$allowed_tags = array( 
		'br' => array(), 
		'p' => array(), 
	);
	$clean['address'] = wp_kses( $input['address'], $allowed_tags );
	return $clean;
}

/**
 * Bonus Shortcodes!
 */

// Make the [phone] shortcode
add_shortcode( 'phone', 'rad_short_phone' );
function rad_short_phone(){
	$values = get_option('rad_options');
	return '<b>' . $values['phone'] . '</b>';
}

// Make the [email] shortcode
add_shortcode( 'email', 'rad_short_email' );
function rad_short_email(){
	$values = get_option('rad_options');
	return '<a href="mailto:' . $values['email'] . '">' . $values['email'] . '</a>';
}