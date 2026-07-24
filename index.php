<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/app/helpers/Session.php';
require_once __DIR__ . '/app/helpers/Helper.php';
require_once __DIR__ . '/app/controllers/Controller.php';
require_once __DIR__ . '/app/models/Model.php';

Session::init();
$router = require_once __DIR__ . '/routes/web.php';

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$urlPath = parse_url($requestUri, PHP_URL_PATH);
$basePath = dirname($_SERVER['SCRIPT_NAME']);
if ($basePath !== '/' && strpos($urlPath, $basePath) === 0) {
    $urlPath = substr($urlPath, strlen($basePath));
}
$url = trim($urlPath, '/') ?: 'login';
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($url, $method);
