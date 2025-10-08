<?php

/*
|--------------------------------------------------------------------------
| Simple Health Check for Vercel
|--------------------------------------------------------------------------
*/

// Basic PHP info and environment check
$response = [
    'status' => 'OK',
    'php_version' => PHP_VERSION,
    'timestamp' => date('Y-m-d H:i:s'),
    'server_info' => [
        'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'] ?? 'not set',
        'SCRIPT_NAME' => $_SERVER['SCRIPT_NAME'] ?? 'not set',
        'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? 'not set',
    ],
    'environment' => [
        'APP_ENV' => $_ENV['APP_ENV'] ?? 'not set',
        'APP_DEBUG' => $_ENV['APP_DEBUG'] ?? 'not set',
        'DATABASE_URL' => isset($_ENV['DATABASE_URL']) ? 'set' : 'not set',
    ],
    'files_exist' => [
        'public/index.php' => file_exists(__DIR__ . '/../public/index.php'),
        'bootstrap/app.php' => file_exists(__DIR__ . '/../bootstrap/app.php'),
        'vendor/autoload.php' => file_exists(__DIR__ . '/../vendor/autoload.php'),
    ]
];

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);