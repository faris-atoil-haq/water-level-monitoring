<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Bootstrap
|--------------------------------------------------------------------------
|
| Minimal configuration for Vercel deployment
|
*/

// Only create essential directories if they don't exist
$essentialPaths = ['/tmp/views', '/tmp/storage/logs'];

foreach ($essentialPaths as $path) {
    if (!file_exists($path)) {
        @mkdir($path, 0755, true);
    }
}