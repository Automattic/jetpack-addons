<?php
/**
 * Plugin Name: Jetpack Only for Admins
 * Plugin URI: http://wordpress.org/plugins/jetpack-only-for-admins/
 * Description: Hides the Jetpack menu for all non-admins
 * Author: Jeremy Herve
 * Version: 1.2
 * Author URI: http://jeremy.hu
 * License: GPL2+
 * Text Domain: jetpack
 */
/**
 * Hide the Jetpack menu to all non-admins.
 */
function jp_rm_menu() {
	if ( class_exists( 'Jetpack' ) && ! current_user_can( 'manage_options' ) && is_admin() && is_user_logged_in() ) {
		remove_menu_page( 'jetpack' );
	}
}
add_action( 'admin_menu', 'jp_rm_menu', 999 );
