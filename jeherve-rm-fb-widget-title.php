<?php
/**
 * Plugin Name: Remove link from Jetpack's Facebook Like Box widget
 * Plugin URI: http://wordpress.org/plugins/jetpack
 * Description: Remove link from Jetpack's Facebook Like Box widget
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremy.hu
 * License: GPL2+
 */

function jeherve_custom_fb_title( $likebox_widget_title, $title, $page_url ) {
	return esc_html( $title );
}
add_filter( 'jetpack_facebook_likebox_title', 'jeherve_custom_fb_title', 10, 3 );
