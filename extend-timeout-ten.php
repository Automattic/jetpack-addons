<?php
/*
 * Plugin Name: Extend HTTP timeout to 10s
 * Plugin URI: https://jetpack.com
 * Description: Doubles the default HTTP timeout
 * Author: Brandon Kraft
 * Version: 1.0
 * Author URI: https://kraft.blog
 * License: GPL2+
 */
add_filter( 'http_request_timeout', 'bkjp_extend_timeout_ten', 9999 );

function bkjp_extend_timeout_ten( $timeout ){
	return 10;
}
