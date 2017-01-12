<?php

/**
 * Plugin Name: Disable Jetpack's Retina handling library
 * Plugin URI: http://jetpack.com
 * Description: Disable Jetpack's Retina handling library.
 * Author: Automattic
 * Version: 1.0.0
 * Author URI: http://jetpack.com
 * License: GPL2+
 */

function jeherve_disable_devicepx() {
	wp_dequeue_script( 'devicepx' );
}
add_action( 'wp_enqueue_scripts', 'jeherve_disable_devicepx' );
