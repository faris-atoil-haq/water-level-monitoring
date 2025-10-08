<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Function Entry Point with Debug
|--------------------------------------------------------------------------
*/

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Set the correct document root for Laravel
    $_SERVER['DOCUMENT_ROOT'] = __DIR__ . '/../public';

    // Ensure the script name is set correctly for Laravel routing
    if (!isset($_SERVER['SCRIPT_NAME'])) {
        $_SERVER['SCRIPT_NAME'] = '/api/index.php';
    }

    // Set the correct script filename
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';

    // Check if Laravel's public/index.php exists
    $laravelEntry = __DIR__ . '/../public/index.php';
    if (!file_exists($laravelEntry)) {
        throw new Exception("Laravel entry point not found: " . $laravelEntry);
    }

    // Forward to Laravel's main entry point
    require_once $laravelEntry;

} catch (Exception $e) {
    // Return detailed error for debugging
    http_response_code(500);
    echo json_encode([
        'error' => 'Vercel Function Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'trace' => $e->getTraceAsString()
    ]);
} catch (Error $e) {
    // Handle PHP fatal errors
    http_response_code(500);
    echo json_encode([
        'error' => 'PHP Fatal Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}