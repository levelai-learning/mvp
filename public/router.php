<?php
/**
 * LevelAI — PHP built-in server router
 * Usage: php -S localhost:8080 router.php
 */
define('BASE_PATH', __DIR__);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Strip trailing slash (except root)
if ($uri !== '/' && str_ends_with($uri, '/')) {
    $uri = rtrim($uri, '/');
}

// Route /onboard/ paths
if (preg_match('#^/onboard/(step[1-5])\.php$#', $uri, $m)) {
    include __DIR__ . '/onboard/' . $m[1] . '.php';
    return true;
}

// Serve static assets
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff2?|ttf)$/', $uri)) {
    return false; // Let built-in server handle static files
}

// Top-level PHP pages
$allowed = ['index', 'home', 'schedule', 'task', 'break', 'settings'];
$page    = trim($uri, '/') ?: 'index';
$page    = preg_replace('/\.php$/', '', $page);

if (in_array($page, $allowed)) {
    include __DIR__ . '/' . $page . '.php';
    return true;
}

// 404
http_response_code(404);
include __DIR__ . '/index.php';
return true;
