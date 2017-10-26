<?php
/**
 * Plugin Name: Custom Open Graph URLs
 * Plugin URI: https://wordpress.org/support/topic/sharing-social-share-counts-are-gone/#post-8941087
 * Description: Define custom OG URLs for each one of your posts. If you don't add a custom OG URL, the default one (post permalink) will be used.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 *
 * @package CustomOgUrls
 */

/**
 * Use a custom OG URL tag in Jetpack's Open Graph Meta tags if one is provided in post_meta.
 *
 * @uses https://developer.jetpack.com/hooks/jetpack_open_graph_tags/
 *
 * @param array $tags Array of Open Graph Meta tags.
 * @param array $args Array of image size parameters.
 */
function jeherve_custom_og_url( $tags, $args ) {
	// Are we looking at a single post / page / CPT. If not, bail.
	if ( ! is_singular() ) {
		return $tags;
	}

	// Do we have a post ID? If not, bail.
	$post_id = get_the_ID();
	if ( ! is_int( $post_id ) ) {
		return $tags;
	}

	// Do we have a custom OG URL set as custom_og_url post_meta? Use it.
	$custom_og_url = get_post_meta( $post_id, 'custom_og_url', true );
	if ( ! empty( $custom_og_url ) ) {
		// Remove existing OG URL value.
		unset( $tags['og:url'] );

		// Set our own.
		$tags['og:url'] = esc_url( $custom_og_url );
	} else {
		return $tags;
	}

	// Return tags, modified or not.
	return $tags;
}
add_filter( 'jetpack_open_graph_tags', 'jeherve_custom_og_url', 20, 2 );
