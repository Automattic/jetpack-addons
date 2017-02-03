<?php
/**
 * Plugin Name: Force Jetpack SSO
 * Plugin URI: http://jetpack.com
 * Description: Let Jetpack's SSO module be on all the time.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 */

/**
 * Force activate the SSO module.
 */
function jeherve_force_activate_sso() {
	if (
		class_exists( 'Jetpack' )
		&& ! Jetpack::is_module_active( 'sso' )
	) {
		Jetpack::activate_module( 'sso' );
	}
}
add_action( 'admin_init', 'jeherve_force_activate_sso' );

/**
 * Auto-activate SSO when Jetpack is connected to WordPress.com.
 */
function jeherve_auto_activate_sso() {
	return array( 'sso' );
}
add_filter( 'jeherve_get_default_modules', 'jeherve_auto_activate_sso' );
