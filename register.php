<?php
// authentication/register.php

// Bootstrap database connection
$db = require_once __DIR__ . '/../config/db.php';

// Bootstrap helper utilities and session security
require_once __DIR__ . '/../includes/helpers.php';
secure_session_start();

// Redirect to dashboard if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: ../views/dashboard_view.php");
    exit();
}

// Bootstrap AuthController
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController($db);

$errors = [];
$postData = [];

// Handle registration request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postData = $_POST;
    
    // CSRF Token Validation
    $csrfToken = $_POST['csrf_token'] ?? '';
    if (validate_csrf_token($csrfToken)) {
        // Dispatch parameters to controller
        $errors = $authController->handleRegister($_POST);
    } else {
        $errors['general'] = 'Security validation failed (Invalid CSRF token). Please refresh and try again.';
    }
}

// Load the Registration View template
require_once __DIR__ . '/../views/register_view.php';
