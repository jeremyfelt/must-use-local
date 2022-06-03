<?php

namespace MustUseLocal\Debug;

add_filter( 'debug_information', __NAMESPACE__ . '\filter_debug_information' );

/**
 * Supplement Site Health information.
 *
 * @param array $info An array of data used on the site health screen.
 * @return array Modified array of data.
 */
function filter_debug_information( $info ) {
	// Check if the xdebug module is loaded by this PHP configuration.
	$info['wp-server']['fields']['xdebug-enabled'] = array(
		'label' => 'Xdebug module enabled?',
		'value' => in_array( 'xdebug', get_loaded_extensions(), true ) ? 'Yes' : 'No',
	);

	// Check if a function provided by xdebug is available for use.
	$info['wp-server']['fields']['xdebug-function'] = array(
		'label' => 'Xdebug function exists?',
		'value' => function_exists( 'xdebug_get_code_coverage' ) ? 'Yes' : 'No',
	);

	$xdebug_mode  = ini_get( 'xdebug.mode' );
	$xdebug_start = ini_get( 'xdebug.start_with_request' );
	$xdebug_port  = ini_get( 'xdebug.client_port' );

	$info['wp-server']['fields']['xdebug-mode'] = array(
		'label' => 'Xdebug mode',
		'value' => $xdebug_mode ? $xdebug_mode : 'Not set',
	);

	$info['wp-server']['fields']['xdebug-start'] = array(
		'label' => 'Xdebug start',
		'value' => $xdebug_start ? $xdebug_start : 'Not set',
	);

	$info['wp-server']['fields']['xdebug-port'] = array(
		'label' => 'Xdebug port',
		'value' => $xdebug_port ? $xdebug_port : 'Not set',
	);

	return $info;
}
