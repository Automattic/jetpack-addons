<?php
/**
 * Plugin Name: Force Deactivate Jetpack's Sitemaps Module.
 * Plugin URI: https://jetpack.com/support/sitemaps
 * Description: If you have lost access to your site's dashboard, you can use this plugin to deactivate the Sitemaps feature in Jetpack.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 *
 * @package Force Deactivate Sitemaps
 */

/**
 * Drop this plugin to your site's `wp-content/mu-plugins/` folder to activate it on your site,
 * even if you don't have access to your dashboard.
 *
 * Before to use this plugin, you can also contact your hosting provider and ask them if they
 * could allow you to use a more recent version of PHP on your site, like PHP 7,
 * as per WordPress recommendation:
 * https://wordpress.org/about/requirements/
 *
 * If you have more questions, you can contact the Jetpack team here:
 * http://jetpack.com/contact-support/
 */
function jetpack_20170405_force_deactivate_sitemaps() {
	if ( class_exists( 'Jetpack' ) ) {
		Jetpack::deactivate_module( 'sitemaps' );
	}
}
add_action( 'init', 'jetpack_20170405_force_deactivate_sitemaps' );
