<?php
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @version  3.2.7
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 * @link     http://laravel.com
 */

// --------------------------------------------------------------
// Tick... Tock... Tick... Tock...
// --------------------------------------------------------------
define('LARAVEL_START', microtime(true));

// --------------------------------------------------------------
// Indicate that the request is from the web.
// --------------------------------------------------------------
$web = true;

// --------------------------------------------------------------
// Set the core Laravel path constants.
// --------------------------------------------------------------
require '../paths.php';

// --------------------------------------------------------------
// Unset the temporary web variable.
// --------------------------------------------------------------
unset($web);

// --------------------------------------------------------------
// Set environment variable.
// --------------------------------------------------------------
$server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';

switch( $server_name )
{
    //-----------------------------------------------------
    // Development Environment
    case 'lc.hiprodv3':
        $_SERVER['LARAVEL_ENV'] = 'development';
    break;
    //-----------------------------------------------------
    // Default to production
    default: 
        $_SERVER['LARAVEL_ENV'] = 'production'; 
    break;
    //-----------------------------------------------------
}

// Set the LARAVEL_ENV constant
define('LARAVEL_ENV', $_SERVER['LARAVEL_ENV']);

// --------------------------------------------------------------
// Unset the temporary server name variable.
// --------------------------------------------------------------
unset($server_name);

// --------------------------------------------------------------
// Launch Laravel.
// --------------------------------------------------------------
require path('sys').'laravel.php';