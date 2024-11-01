<?php
if ( ! function_exists( 'get_plugin_data' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$this_plugin    = get_plugin_data( SLP_GFL_FILE, false, false );
$min_wp_version = '5.0';

if ( ! defined( 'SLP_GFL_VERSION' ) ) ( define( 'SLP_GFL_VERSION', $this_plugin['Version'] ) );

if ( ! defined( 'SLPLUS_PLUGINDIR' ) ) {
	add_action(
		'admin_notices',
		create_function(
			'',
			"echo '<div class=\"error\"><p>" .
			sprintf(
				__( '%s requires Store Locator Plus to function properly. ', 'slp-gravity-forms-locations' ),
				$this_plugin['Name']
			) . '<br/>' .
			__( 'This plugin has been deactivated.', 'slp-gravity-forms-locations' ) .
			__( 'Please install Store Locator Plus.', 'slp-gravity-forms-locations' ) .
			"</p></div>';"
		)
	);
	deactivate_plugins( plugin_basename( SLP_GFL_FILE ) );

	return;
}

global $wp_version;
if ( version_compare( $wp_version, $min_wp_version, '<' ) ) {
	add_action(
		'admin_notices',
		create_function(
			'',
			"echo '<div class=\"error\"><p>" .
			sprintf(
				__( '%s requires WordPress %s to function properly. ', 'slp-gravity-forms-locations' ),
				$this_plugin['Name'],
				$min_wp_version
			) .
			__( 'This plugin has been deactivated.', 'slp-gravity-forms-locations' ) .
			__( 'Please upgrade WordPress.', 'slp-gravity-forms-locations' ) .
			"</p></div>';"
		)
	);
	deactivate_plugins( plugin_basename( SLP_GFL_FILE ) );

	return;
}

// Go forth and sprout your tentacles...
// Get some Store Locator Plus sauce.
//
require_once( SLP_GFL_REL_DIR . 'include/SLP_Gravity_Forms_Locations.php' );
SLP_Gravity_Forms_Locations::init();
