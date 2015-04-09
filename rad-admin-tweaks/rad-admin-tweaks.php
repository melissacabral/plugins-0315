<?php 
/*
Plugin Name: Admin Panel Tweaks
Description:  Modifies the Admin panel and login screens
Plugin URI: http://site-where-plugin-is-hosted.com
Author: Melissa Cabral
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
*/

/**
 * Style the Login / Register Forms
 * @since  0.1
 */
add_action( 'login_enqueue_scripts', 'rad_login_css' );
function rad_login_css(){
	$path = plugins_url( 'css/login-style.css', __FILE__ );
	wp_enqueue_style( 'login-styles', $path );
}

/**
 * Change the wordpress.org link on the login logo link
 */
add_filter( 'login_headerurl', 'rad_logo_url'  );
function rad_logo_url(){
	return home_url(); //the home page of our site
}

add_filter( 'login_headertitle', 'rad_logo_title' );
function rad_logo_title(){
	return 'Go back Home to ' . get_bloginfo('name');
}

/**
 * Hide the admin dashboard widgets you don't need
 */
add_action( 'wp_dashboard_setup', 'rad_remove_dash_widgets' );
function rad_remove_dash_widgets(){
				//inspect to find the ID 	screen 		column
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
}

/**
 * Custom Dashboard Widget
 */
add_action( 'wp_dashboard_setup', 'rad_dash_widget' );
function rad_dash_widget(){
	wp_add_dashboard_widget( 'dashboard_rad_help', 'Helpful Information', 'rad_widget_content' );
}

//callback for the content of the widget
function rad_widget_content(){
	//show an RSS feed
	wp_widget_rss_output( 'http://wordpress.melissacabral.com/feed/', array(
		'items' 		=> 7,
		'show_summary' 	=> true,
		'show_date'		=> true,
		'show_author'	=> true,
	) );
}
/**
 * Remove WordPress menu from admin bar
 * @link https://codex.wordpress.org/Toolbar 
 */
add_action( 'admin_bar_menu', 'rad_remove_wp_menu', 999 );
function rad_remove_wp_menu( $wp_admin_bar ){
	$wp_admin_bar->remove_node( 'wp-logo' );

	//add a toolbar item
	$wp_admin_bar->add_node( array(
		'id' 	=> 'contact-me',
		'title' => 'Contact Me',
		'href' 	=> 'http://melissacabral.com',
		'parent' => 'top-secondary', //right side
		'meta'	=> array( 'class' => 'contact-menu-item' ),
	) );
}


