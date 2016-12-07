<?php
/**
 * Plugin Name: Custom CSS for Jetpack's Mobile Theme
 * Plugin URI: http://jetpack.com
 * Description: Customize Jetpack's Mobile Theme by adding this plugin, and editing style.css inside the plugin.
 * Author: Automattic
 * Version: 1.1.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 *
 * @package Mobile Custom CSS
 */

/**
 * Check if we are on mobile.
 */
function jeherve_is_jetpack_mobile() {

	// Are Jetpack Mobile functions available?
	if ( ! function_exists( 'jetpack_is_mobile' ) ) {
		return false;
	}

	// Is Mobile theme showing?
	if ( isset( $_COOKIE['akm_mobile'] ) && 'false' == $_COOKIE['akm_mobile'] ) {
		return false;
	}

	return jetpack_is_mobile();
}

/**
 * Let's add our custom stylesheet if we're on a mobile device.
 */
function jeherve_mobile_maybe_add_stylesheet() {
	// On mobile?
	if ( jeherve_is_jetpack_mobile() ) {

		// Are we using 4.7
		if ( function_exists( 'wp_custom_css_cb' ) ) {

			// Let's remove Jetpack's stylesheet overwrite
			remove_action( 'option_stylesheet', 'jetpack_mobile_stylesheet' );

			// Get the desktop theme name.
			$desktop_theme = get_option( 'stylesheet' );

			// Get styles for that theme.
			$styles = wp_get_custom_css( $desktop_theme );

			// Output styles if stylesheet isn't empty
			if ( $styles ) : ?>
				<style type="text/css" id="wp-custom-css">
					<?php echo strip_tags( $styles ); ?>
				</style>
			<?php endif;

		}

	}
}
add_action( 'wp_head', 'jeherve_mobile_maybe_add_stylesheet' );
