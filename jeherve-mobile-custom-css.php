<?php
/**
 * Plugin Name: Custom CSS for Jetpack's Mobile Theme
 * Plugin URI: http://jetpack.com
 * Description: Customize Jetpack's Mobile Theme by adding this plugin, and editing style.css inside the plugin.
 * Author: Automattic
 * Version: 1.1.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 *
 * @package Mobile Custom CSS
 */

/**
 * Check if we are on mobile.
 */
function jeherve_is_jetpack_mobile() {

	// Are Jetpack Mobile functions available?
	if ( ! function_exists( 'jetpack_is_mobile' ) ) {
		return false;
	}

	// Is Mobile theme showing?
	if ( isset( $_COOKIE['akm_mobile'] ) && 'false' == $_COOKIE['akm_mobile'] ) {
		return false;
	}

	return jetpack_is_mobile();
}

/**
 * Let's add our custom stylesheet if we're on a mobile device.
 */
function jeherve_mobile_maybe_add_stylesheet() {
	// Register our stylesheet.
	wp_register_style( 'jeherve-mobile-css', plugins_url( 'style.css', __FILE__ ) );

	// On mobile?
	if ( jeherve_is_jetpack_mobile() ) {
		wp_enqueue_style( 'jeherve-mobile-css' );
	}
}
add_action( 'wp_enqueue_scripts', 'jeherve_mobile_maybe_add_stylesheet' );
