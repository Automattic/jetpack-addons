<?php
/*
Plugin Name: Fix Jetpack Related Posts
Description: Forces Posts to be considered public by Jetpack
Version: 1.0.1
Author: Jeremy Herve
Author URI: http://jeremy.hu/
Plugin URI: http://jetpack.com/
*/
function jeherve_fix_related() {
	if ( class_exists( 'Jetpack_Options' ) ) {
		Jetpack_Options::update_option( 'public' , true );
	}
}
add_action( 'init', 'jeherve_fix_related' );
