<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Bootstrap
|--------------------------------------------------------------------------
|
| This file configures Laravel for Vercel's serverless environment.
| It ensures that all file paths point to writable directories.
|
*/

// Ensure writable directories exist in /tmp
$writablePaths = [
    '/tmp/views',
    '/tmp/cache',
    '/tmp/storage',
    '/tmp/storage/logs',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
];

foreach ($writablePaths as $path) {
    if (!file_exists($path)) {
        mkdir($path, 0755, true);
    }
}

// Override storage path for Vercel
if (!function_exists('storage_path_override')) {
    function storage_path_override($path = '') {
        return '/tmp/storage' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

// Set custom storage path for logs
if (isset($_ENV['APP_STORAGE_PATH'])) {
    // This will be used by Laravel's logging system
    putenv('LARAVEL_STORAGE_PATH=' . $_ENV['APP_STORAGE_PATH']);
}