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
}