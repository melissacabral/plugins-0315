<?php
/*
Plugin Name: Rad Announcement Bar
Description:  Adds an eye-catching bar to the top of the page
Plugin URI: http://site-where-plugin-is-hosted.com
Author: Melissa Cabral
Author URI: http://melissacabral.com
Version: 0.1
License: GPLv3
*/

/**
 * Add HTML Output to the bottom of every page
 */
add_action( 'wp_footer', 'rad_bar_html' );
function rad_bar_html(){
	//only show on home page
	if( is_front_page() ):
	?>
	<!-- Rad Announcement Bar by Melissa Cabral -->
	<div id="rad-announcement-bar">
		<span>
			This is a really important announcement!  
			<a href="#">Click Here!</a>
		</span>
	</div>
	<?php
	endif;
}

/**
 * Attach style sheet
 */
add_action( 'wp_enqueue_scripts', 'rad_bar_styles' );
function rad_bar_styles(){
	if( is_front_page() ):
		//get url
		$url = plugins_url( 'css/rad-announcement-style.css', __FILE__ );
		//put it on the page
		wp_enqueue_style( 'rad-bar-style', $url );
	endif;
}


//no close php