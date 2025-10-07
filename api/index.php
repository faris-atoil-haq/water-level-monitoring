<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Function Entry Point
|--------------------------------------------------------------------------
|
| This file serves as the entry point for Vercel's serverless functions.
| It forwards all requests to Laravel's public/index.php file.
|
*/

// Set the correct document root for Laravel
$_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../public';

// Ensure the script name is set correctly for Laravel routing
if (!isset($_SERVER['SCRIPT_NAME'])) {
    $_SERVER['SCRIPT_NAME'] = '/api/index.php';
}

// Set the correct script filename
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';

// Forward to Laravel's main entry point
require_once __DIR__ . '/../public/index.php';