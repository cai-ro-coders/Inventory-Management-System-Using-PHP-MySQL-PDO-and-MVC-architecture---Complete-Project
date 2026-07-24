<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'inventorydb');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_CHARSET', 'utf8mb4');

define('APP_NAME', 'Inventory Management System');
define('APP_URL', 'http://localhost:8888/devproject/InventoryManagementSystem');
define('APP_ROOT', dirname(__DIR__));
define('UPLOAD_PATH', APP_ROOT . '/assets/uploads/');
define('UPLOAD_URL', APP_URL . '/assets/uploads/');

define('TIMEZONE', 'Asia/Manila');
define('CURRENCY', '₱');
define('TAX_RATE', 12);
define('INVOICE_PREFIX', 'INV-');
define('LOW_STOCK_LIMIT', 10);

date_default_timezone_set(TIMEZONE);
session_start();
