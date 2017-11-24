<?php
/**
 * Plugin Name: Flush all Jetpack Sitemaps
 * Plugin URI: https://jetpack.com
 * Description: Flush all Jetpack Sitemaps.
 * Version: 1.0.0
 * Author: Automattic
 * Author URI: https://jetpack.com
 * License: GPL2
 */

// See https://github.com/Automattic/jetpack/pull/8238/
function jepackcom_flush_sitemaps() {
	if (
		! class_exists( 'Jetpack' )
		|| ! Jetpack::is_module_active( 'sitemaps' )
		|| ! class_exists( 'Jetpack_Sitemap_Librarian' )
	) {
		return;
	}

	$librarian = new Jetpack_Sitemap_Librarian();
	$librarian->delete_all_stored_sitemap_data();
}
add_action( 'admin_init', 'jepackcom_flush_sitemaps' );
