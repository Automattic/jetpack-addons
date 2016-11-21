<?php
/*
 * Plugin Name: Delete Jetpack options
 * Plugin URI: http://wordpress.org/plugins/jetpack/
 * Description: Delete your Jetpack Options.
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jetpack.me
 * License: GPL2+
 * Text Domain: jetpack
 * Domain Path: /languages/
 */

function jeherve_delete_jp_options() {
	delete_option( 'jetpack_options' );
	delete_option( 'jetpack_private_options' );
}
add_action( 'admin_init', 'jeherve_delete_jp_options' );
