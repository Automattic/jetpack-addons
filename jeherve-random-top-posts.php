<?php
/**
 * Plugin Name: Random Top Posts.
 * Plugin URI: https://jeremy.hu
 * Description: Replace the posts displayed in the Top Posts Widget by a list of random posts, that all include images.
 * Author: Jeremy Herve
 * Version: 1.0.0
 * Author URI: https://jeremy.hu
 * License: GPL2+
 */

/**
 * Random list of Top Posts.
 *
 * @see https://wordpress.org/support/topic/top-posts-pages-widget-jetpack/#post-8481882
 *
 * @param array $posts Array of the most popular posts.
 * @param array $post_ids Array of Post IDs.
 * @param string $count Number of Top Posts we want to display.
 */
function jeherve_random_top_posts( $posts, $post_ids, $count ) {
	/**
	 * Let's run the query and look for new random posts every 10 minutes.
	 * We don't want to run that query on each page load,
	 * since looking for random posts is expensive.
	 */
	$data_from_cache = get_transient( 'jeherve_random_top_posts' );
	if ( false === $data_from_cache ) {
		// Start from an empty list of posts.
		$post_ids = array();

		// Set up a counter.
		$counter = 0;

		/**
		 * Get an array of random post IDs.
		 * We'll query for twice the amount of posts we actually need.
		 * This way we're sure to always have enough posts, even when some get excluded
		 * because they don't include any images.
		 */
		$rand_query = new WP_Query(
			array(
				'orderby'        => 'rand',
				'posts_per_page' => $count * 2,
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'has_password'   => false,
			)
		);
		while ( $rand_query->have_posts() ) {
			$rand_query->the_post();

			// Check if that post ID has an image.
			$image = Jetpack_PostImages::get_image( $rand_query->post->ID, array( 'fallback_to_avatars' => false ) );
			if ( ! is_array( $image ) ) {
				continue;
			}

			$post_ids[] = $rand_query->post->ID;
			$counter++;

			if ( $counter == $count ) {
				break; // only need to load and show x number of posts.
			}
		}
		wp_reset_postdata();

		// Now build a brand new array of posts based on those post IDs.
		$posts = array();
		foreach ( (array) $post_ids as $post_id ) {
			$post = get_post( $post_id );

			if ( ! $post ) {
				continue;
			}

			// Both get HTML stripped etc on display.
			if ( empty( $post->post_title ) ) {
				$title_source = $post->post_content;
				$title = wp_html_excerpt( $title_source, 50 );
				$title .= '&hellip;';
			} else {
				$title = $post->post_title;
			}

			$permalink = get_permalink( $post->ID );

			$post_type = 'post';

			$posts[] = compact( 'title', 'permalink', 'post_id', 'post_type' );

			// Create a transient to save our posts for 10 minutes.
			set_transient( 'jeherve_random_top_posts', $posts, 10 * MINUTE_IN_SECONDS );
		}
	} else {
		$posts = $data_from_cache;
	}
	return $posts;
}
add_filter( 'jetpack_widget_get_top_posts', 'jeherve_random_top_posts', 10, 3 );
