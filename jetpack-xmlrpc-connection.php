<?php

namespace Automattic\Jetpack\Temp_Fix_XMLRPC_Connection_7_5;

/*
 * Plugin Name: Jetpack - XML-RPC Connection Helper (for Jetpack 7.5)
 * Author: Automattic
 * Description: This is a temporary fix for a rare Jetpack issue that will be fixed in Jetpack 7.6. This plugin is only useful for sites with Jetpack 7.5.x installed and will automatically deactivate itself when Jetpack 7.6+ is present or in other cases where it is not needed. <strong>You can delete this plugin once Jetpack is successfully connected</strong>.
 * Version: 1.0.0
 * Plugin URI: https://github.com/Automattic/jetpack-addons
 * Author URI: https://jetpack.com/
 * License: GPL2+
 */

function init() {
	if ( ! defined( 'JETPACK__VERSION' ) ) {
		return;
	}

	if (
		\Jetpack::is_active()
	||
		\Jetpack::is_development_version()
	||
		version_compare( JETPACK__VERSION, '7.5', '<' )
	||
		version_compare( '7.6', JETPACK__VERSION, '<=' )
	) {
		add_action( 'admin_init', __NAMESPACE__ . '\\deactivate' );
		return;
	}

	if ( ! defined( 'XMLRPC_REQUEST' ) || ! XMLRPC_REQUEST || ! isset( $_GET['for'] ) || 'jetpack' != $_GET['for'] ) {
		return;
	}

	new \Automattic\Jetpack\Connection\XMLRPC_Connector\XMLRPC_Connector( Jetpack::connection() );
}

function deactivate() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

add_action( 'init', __NAMESPACE__ . '\\init', 20 );
