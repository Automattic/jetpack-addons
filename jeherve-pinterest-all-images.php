<?php
/**
 * Plugin Name: Pin all the images
 * Description: Jetpack add-on. Will allow your readers to pin any image on the page, not just the post's featured image.
 * Version: 1.0
 * Author: Jeremy Herve
 * Author URI: http://jeremy.hu/
 * Plugin URI: http://wordpress.org/plugins/jetpack/
 */

function jeherve_all_images_pinterest() {
	return 'buttonBookmark';
}
add_filter( 'jetpack_sharing_pinterest_widget_type', 'jeherve_all_images_pinterest' );
