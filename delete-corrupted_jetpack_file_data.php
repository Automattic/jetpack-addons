<?php
/**
 * Plugin Name: Delete corrupted the jetpack_file_data_7.6 transient
 * Plugin URI: http://jetpack.com
 * Description: Fix this error when activating Jetpack 7.6: An error of type E_ERROR was caused in line 2637 of the file plugins/jetpack/class.jetpack.php. Error message: Allowed memory size of 536870912 bytes exhausted (tried to allocate 9223372036854775840 bytes)
 * Author: htdat (Automattic)
 * Version: 1.0
 * Author URI: https://github.com/htdat
 * License: GPL2+
 */

/**
 * Delete the jetpack_file_data transient if it's not an arrary.
 */

function htdat_delete_corrupted_jetpack_file_data() {

	$cache_key = 'jetpack_file_data_7.6'; // see https://github.com/Automattic/jetpack/blob/branch-7.6/class.jetpack.php#L2619
	$file_data_option = get_transient( $cache_key );

	if ( ! is_array( $file_data_option) ) {
		delete_transient ($cache_key );
	}
}

add_action( 'admin_init', 'htdat_delete_corrupted_jetpack_file_data' );
