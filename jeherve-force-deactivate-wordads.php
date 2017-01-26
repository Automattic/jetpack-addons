<?php
/**
 * Plugin Name: Force deactivate the Ads module.
 * Plugin URI: http://jetpack.com
 * Description: Force deactivate the Ads module. One-time thing. You can then deactivate and delete this plugin.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 */

/**
 * Force deactivate the Ads module.
 *
 * @see https://github.com/Automattic/jetpack/issues/6168
 */
function jeherve_force_deactivate_wordads() {
	if ( class_exists( 'Jetpack' ) ) {
		Jetpack::deactivate_module( 'wordads' );
	}
}
add_action( 'init', 'jeherve_force_deactivate_wordads' );
