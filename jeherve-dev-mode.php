<?php
/**
 * Plugin Name: Jetpack's Development mode
 * Plugin URI: http://jetpack.me/support/development-mode/
 * Description: Enable Jetpack's development mode
 * Author: Jeremy Herve
 * Version: 1.0
 * Author URI: http://jeremy.hu
 * License: GPL2+
 */

add_filter( 'jetpack_development_mode', '__return_true' );
