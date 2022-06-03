<?php
/**
 * Plugin Name:     Must Use Local
 * Description:     Adjustments made locally, but not deployed.
 * Version:         0.0.3
 */

namespace MustUseLocal;

// Disable SSL verification locally.
add_filter( 'https_ssl_verify', '__return_false' );

// Treat requests to local domains as external.
add_filter( 'http_request_host_is_external', '__return_true' );

// Load some local Jetpack customizations.
require_once __DIR__ . '/jetpack.php';

// Load some local Mail customizations.
require_once __DIR__ . '/mail.php';

// Load local authorization customizations.
require_once __DIR__ . '/auth.php';

// Load local debugging tools.
require_once __DIR__ . '/debug.php';
