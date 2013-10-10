<?php

	/*
	Plugin Name: Wordpress Accessibility Plugin (wpacc)
	Plugin URI: http://invinta.com
	Description: A Wordpress plugin which adds accessible colour options
	Version: 1.0.0
	Author: Invinta
	Author URI: http://invinta.com
	*/

if ( ! is_admin() ) {

	// COOKIE SETTINGS
	// Gets the cookie, checks and sets an expiry date
	$wpacc = $_GET['wpacc'];
	$wpacc_checkCookie = $_COOKIE["WPACC"];
	$expire=time()+60*60*24*30;

	// PLUGIN SETTINGS
	// Plugin folder name and accessibility link
	define("plugin_name", "CubikAccess");
	define("wpacc_option_link", "<a href='".plugins_url()."/". plugin_name ."/inc/accessibility.php' data-install='". site_url() ."' class='wpacc-access-link'>Accessibility options</a>");
	
	// URL REWRITE
	// Masks the URL to the accessibilty page and makes it more friendly
	add_action('generate_rewrite_rules', 'wpacc_link_rewrite');

	function wpacc_link_rewrite() {

		global $wp_rewrite;
		$wpacc_link = plugins_url()."/".plugin_name."/inc/accessibility.php";

		$new_non_wp_rules = array(
			'index.php?(.*)'    => ''. $wpacc_link .'/$1',
		);

		$wp_rewrite->non_wp_rules += $new_non_wp_rules; 

	}

	// Set the cookie
	if($wpacc !='') {
		setcookie("WPACC", "wpacc-". $wpacc ."", $expire);
	}

	// De-Register all styles
	if($wpacc_checkCookie =='wpacc-1') {

		// Do nothing - just display the site

	} else if($wpacc_checkCookie !='') {

		function pm_remove_all_styles() {
		    global $wp_styles;
		    $wp_styles->queue = array();
		}

		add_action('wp_print_styles', 'pm_remove_all_styles', 100);

		// Remove any javascript - but keep jQuery and wpacc_cookie_script
		function wpacc_script_deregister() {
			global $wp_scripts;
			$handles = $wp_scripts->queue;

			foreach($handles as $handle) {
				
				if($handle == 'wpacc_cookie_script' || $handle == 'jquery') {

				} else if ($handle !='') {
					wp_deregister_script($handle);
				}

			}

			// var_dump($handles);

		}

		add_action( 'wp_print_scripts', 'wpacc_script_deregister' );

	}

	// Remove any images if no image option has been selected
	if($wpacc_checkCookie =='wpacc-3' || $wpacc_checkCookie =='wpacc-5') {

		function wpacc_strip_images($content) {
			$content = preg_replace('#<img[^>]*>#i', "" , $content);
			return $content;
		}

		ob_start('wpacc_strip_images');

	}

	// Include the WPACC frontend stylesheet
	wp_enqueue_style( 'wpacc-style', plugins_url( '/inc/wpacc.css', __FILE__ ));

	// Add a class using JS if the cookie is set.
	define( 'COOKIE_VERSION', '1.0.0' );
	add_action( 'wp_enqueue_scripts', 'wpacc_enqueue_script' );

	function wpacc_enqueue_script() {
		wp_enqueue_script( 'wpacc_cookie_script', plugins_url( '/script/cookie.js', __FILE__ ), COOKIE_VERSION, true, array('jquery') );
	}

}

?>
