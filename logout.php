<?php
// authentication/logout.php

// Bootstrap database connection
$db = require_once __DIR__ . '/../config/db.php';

// Bootstrap helper utilities
require_once __DIR__ . '/../includes/helpers.php';

// Bootstrap AuthController
require_once __DIR__ . '/../controllers/AuthController.php';
$authController = new AuthController($db);

// Process secure logout
$authController->handleLogout();
