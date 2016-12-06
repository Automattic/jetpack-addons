<?php
/**
 * Plugin Name:  Only show Jetpack snow on a specific page
 * Plugin URI: http://jetpack.com
 * Description: ID 1051 in this example.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: http://jeremy.hu
 * License: GPL2+
 */
function jeherve_limited_snow() {
	if ( ! is_page( '1051' ) ) {
		wp_dequeue_script( 'snowstorm' );
	}
}
add_action( 'wp_enqueue_scripts', 'jeherve_limited_snow' );
