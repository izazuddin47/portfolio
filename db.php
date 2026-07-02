<?php
require_once __DIR__ . '/../config/db.php';   // 1st include — runs, returns $pdo, but it's thrown away

$db = require_once __DIR__ . '/../config/db.php';   // 2nd include
// config/db.php

// Database configuration constants
if (!defined('DB_HOST')) define('DB_HOST', '127.0.0.1');
if (!defined('DB_PORT')) define('DB_PORT', '3306');
if (!defined('DB_NAME')) define('DB_NAME', 'portfolio_db');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASS')) define('DB_PASS', '');

try {
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // Log the error and show a generic message
    error_log("Database Connection Error: " . $e->getMessage());
    die("Database connection failed. Please check your configuration and ensure MySQL is running.");
}

// Return the connection instance
return $pdo;
