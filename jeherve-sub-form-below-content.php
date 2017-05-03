<?php
/**
 * Plugin Name: Jetpack Subscription form
 * Description: Add a Jetpack Subscription form to the bottom of each post, on single posts.
 * Plugin URL: http://wordpress.org/plugins/jetpack/
 * Version: 1.0
 * Author: Jeremy Herve
 * Author URI: http://jeremy.hu/
 * License: GPL2+
 */
/**
 * This only happens if the Jetpack plugin is active, if the Subscriptions module is active, and if we're viewing a single post.
 *
 * @return string $content Post Content.
 */
function jeherve_insert_subs( $content ) {
	if (
		class_exists( 'Jetpack' )
		&& method_exists( 'Jetpack', 'get_active_modules' )
		& in_array( 'subscriptions', Jetpack::get_active_modules() )
		&& is_single()
	) {
		return $content . do_shortcode( '[jetpack_subscription_form]' );
	} else {
		return $content;
	}
}
add_filter( 'the_content', 'jeherve_insert_subs', 99 );
