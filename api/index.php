<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If it's the root URL, load index.php
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/../index.php';
    exit;
}

// Construct the full path to the requested file
$file = __DIR__ . '/..' . $uri;

// If it's a PHP file and it exists, load it
if (file_exists($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
    require $file;
    exit;
}

// If it's a directory, try loading its index.php
if (is_dir($file) && file_exists($file . '/index.php')) {
    require $file . '/index.php';
    exit;
}

// If it's a static file (CSS, HTML, JS), read and output it with correct headers
if (file_exists($file) && !is_dir($file)) {
    $mime = mime_content_type($file);
    if (pathinfo($file, PATHINFO_EXTENSION) === 'css') $mime = 'text/css';
    if (pathinfo($file, PATHINFO_EXTENSION) === 'js') $mime = 'application/javascript';
    header("Content-Type: $mime");
    readfile($file);
    exit;
}

// Otherwise 404
http_response_code(404);
echo "404 Not Found";
