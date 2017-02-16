<?php
/**
 * Plugin Name: Jetpack - Use Old Connection Flow
 * Plugin URI: https://jetpack.com
 * Description: Use the older connection flow for Jetpack
 * Version: 1.0
 * Author: Brandon Kraft
 * License: GPLv2 or later
 */
function jetpackcom_juocf(){
	return 'jetpack';
}
add_filter( 'jetpack_auth_type', 'jetpackcom_juocf', 100 );
