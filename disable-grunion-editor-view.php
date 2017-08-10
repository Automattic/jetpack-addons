<?php
/*
 * Plugin Name: Disable Jetpack Contact Form Editor View
 * Plugin URI: https://jetpack.com
 * Description: Disables the new Jetpack Contact Form Editor View.
 * Author: George Stephanis
 * Version: 1.0
 * Author URI: https://stephanis.info
 * License: GPL2+
 */
add_filter( 'tmp_grunion_allow_editor_view', '__return_false' );
