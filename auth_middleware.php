<?php
// includes/auth_middleware.php
require_once __DIR__ . '/helpers.php';

// Securely start session if not started
secure_session_start();

// Verify user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Dynamically calculate the root path of the project to redirect to login.php
    $script = $_SERVER['SCRIPT_NAME']; // E.g., "/portfolio/views/dashboard_view.php" or "/views/dashboard_view.php"
    $dir = dirname($script);
    $dir = str_replace('\\', '/', $dir);
    
    $root = $dir;
    $folders_to_strip = ['/views', '/controllers', '/authentication', '/includes'];
    foreach ($folders_to_strip as $folder) {
        if (substr($root, -strlen($folder)) === $folder) {
            $root = substr($root, 0, -strlen($folder));
        }
    }
    
    $root = rtrim($root, '/');
    
    // Redirect to login page
    header("Location: " . $root . "/authentication/login.php");
    exit();
}
