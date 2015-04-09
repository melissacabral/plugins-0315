<?php
/*
Plugin Name: Products Custom Post Type
Description: Adds the ability to have a product catalog
Author: Melissa Cabral
Version: 0.1
License: GPLv3
*/

/**
 * Register 'Product' post type
 */
add_action( 'init', 'rad_setup_products' );
function rad_setup_products(){
	// no capital letters, spaces or special characters in the CPT name
	register_post_type( 'product', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'menu_position' => 5,
		'menu_icon'		=> 'dashicons-cart',
		'supports'		=> array( 'title', 'editor', 'thumbnail', 
								'custom-fields', 'revisions', 'excerpt' ),
		'labels'		=> array(
			//These will show up in the admin panel
			'name' 			=> 'Products',
			'singular_name' => 'Product',
			'add_new_item'	=> 'Add New Product',
			'not_found'		=> 'No Products Found',
		),
	) );

	//add the Brand taxonomy to products
	register_taxonomy( 'brand', 'product', array(
		'hierarchical' 		=> true,  //checklist interface, can have parent/child terms
		'show_admin_column' => true,  //makes it appear in the edit products list
		'labels' 			=> array(
				'name' 			=> 'Brands',
				'singular_name' => 'Brand',
				'add_new_item'	=> 'Add New Brand',
				'search_items'	=> 'Search Brands',
			),
	) );
	//add the feature taxonomy to products
	register_taxonomy( 'feature', 'product', array(
		'hierarchical' 		=> false,  //flat list, behaves like tags
		'show_admin_column' => true,  //makes it appear in the edit products list
		'sort'				=> true, //preserve the order that the terms are added
		'labels' 			=> array(
				'name' 			=> 'Features',
				'singular_name' => 'Feature',
				'add_new_item'	=> 'Add New Feature',
				'search_items'	=> 'Search Features',
			),
	) );
} //end products setup

/**
 * Fix 404 errors when the plugin activates
 * @since  0.1
 */
function rad_rewrite_flush(){
	//setup the product and taxos first
	rad_setup_products();
	//then fix the htaccess file
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'rad_rewrite_flush' );

