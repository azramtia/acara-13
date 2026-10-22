<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Base URL otomatis, mengikuti lokasi folder public di server
// Tiap segmen di-encode agar aman jika nama folder mengandung spasi (mis. "acara 13")
$scriptDir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
define('BASE_URL', implode('/', array_map('rawurlencode', explode('/', $scriptDir))));


require_once __DIR__ . '/../app/Controllers/BaseController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/MahasiswaController.php';
require_once __DIR__ . '/../app/Controllers/DosenController.php';

// Load routes
require_once __DIR__ . '/../routes/web.php';

// Ambil URL
// Decode dulu (%20 -> spasi) supaya cocok dengan SCRIPT_NAME yang sudah ter-decode
$requestUri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Hilangkan base path (folder public) hanya di bagian awal URL
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

if ($basePath !== '/' && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

// Buang trailing slash (kecuali root), pastikan diawali /
$requestUri = '/' . trim($requestUri, '/');

// Routing
if (isset($routes[$requestUri])) {
 
    $controllerName = $routes[$requestUri][0];
    $methodName = $routes[$requestUri][1];

    $controller = new $controllerName();

    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        http_response_code(404);
        echo "Method tidak ditemukan.";
    }

} else {

    http_response_code(404);

    echo "<h1>404 - Halaman Tidak Ditemukan</h1>";
    echo "<p>Route <b>" . htmlspecialchars($requestUri) . "</b> tidak tersedia.</p>";
}