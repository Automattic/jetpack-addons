<?php
/**
 * Plugin Name: Deactivate Jetpack's Mobile Theme Sidebar
 * Plugin URI: http://wordpress.org/plugins/jetpack/
 * Description: Deactivate the sidebar in Jetpack's Mobile Theme
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremy.hu
 * License: GPL2+
 */

function jeherve_rm_minileven_sidebar() {
	if ( 'pub/minileven' == wp_get_theme () ) {
		unregister_sidebar( 'sidebar-1' );
	}
}
add_action( 'widgets_init', 'jeherve_rm_minileven_sidebar', 11 );
