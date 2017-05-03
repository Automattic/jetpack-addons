<?php
/*
 * Plugin Name: Disable Jetpack Open Graph tags
 * Plugin URI: http://wordpress.org/plugins/jetpack/
 * Description: Disables Jetpack Open Graph tags
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremy.hu
 * License: GPL2+
 */
add_filter( 'jetpack_enable_open_graph', '__return_false', 99 );
