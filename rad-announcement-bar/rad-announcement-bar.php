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
		$values = get_option( 'rad_announcement_bar' );
	?>
	<!-- Rad Announcement Bar by Melissa Cabral -->
	<div id="rad-announcement-bar">
		<span>
			<?php echo $values['message'] ?>  
			<a href="<?php echo $values['link'] ?>">Click Here!</a>
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

// Bonus! add options
/**
 * Add a page to the admin (under settings)
 */
add_action( 'admin_menu', 'rad_announcement_bar_page' );
function rad_announcement_bar_page(){
	add_options_page( 'Announcement Bar Settings', 'Announcement Bar', 'manage_options',
		'rad-bar',  'rad_announcement_bar_html' );
}

//callback for content
function rad_announcement_bar_html(){
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
add_action( 'admin_init' , 'rad_announcement_settings' );
function rad_announcement_settings(){
					//  Group name 			DB row name 	sanitizing function
	register_setting( 'rad_announcement_bar_group', 'rad_announcement_bar', 'rad_bar_opt_sanitize' );
}

function rad_bar_opt_sanitize($input){
	$clean['message'] = wp_filter_nohtml_kses( $input['message'] );
	$clean['link'] = wp_filter_nohtml_kses( $input['link'] );
	return $clean;
}

//no close php
