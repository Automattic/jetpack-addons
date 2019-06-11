<?php
/**
 * Plugin Name: Delete Jetpack options
 * Plugin URI: https://github.com/Automattic/Jetpack-addons
 * Description: Delete your Jetpack Options.
 * Author: Automattic
 * Version: 1.1
 * Author URI: https://jetpack.com
 * License: GPL2+
 * Text Domain: jetpack
 * Domain Path: /languages/
 *
 * @package Jetpack_Addons
 */

/**
 * Delete Jetpack options on the site.
 */
function jeherve_delete_jp_options() {
	delete_option( 'jetpack_options' );
	delete_option( 'jetpack_private_options' );

	// Deactivate the plugin.
	deactivate_plugins( plugin_basename( __FILE__ ) );
}
add_action( 'admin_init', 'jeherve_delete_jp_options' );

/**
 * Delete this plugin when it's deactivated,
 * to avoid leaving it on users's sites; it only needs to be triggered once.
 */
function jeherve_delete_jp_options_plugin_now() {
	global $wp_filesystem;
	if ( ! WP_Filesystem() ) {
		// Bail. We don't have the permission to edit files.
		return;
	}

	// Delete the plugin directory.
	$plugin_dir = plugin_dir_path( __FILE__ );
	if ( $wp_filesystem->exists( $plugin_dir ) && $wp_filesystem->is_dir( $plugin_dir ) ) {
		$wp_filesystem->delete( $plugin_dir, true, 'd' );
	}
}
register_deactivation_hook( __FILE__, 'jeherve_delete_jp_options_plugin_now' );
