<?php
// authentication/contact_submit.php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$db = require_once __DIR__ . '/../config/db.php';
secure_session_start();

$errors = [];


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit();
}

// CSRF validation
$csrfToken = $_POST['csrf_token'] ?? '';
if (!validate_csrf_token($csrfToken)) {
    $errors['general'] = 'Security validation failed. Please refresh and try again.';
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name)) {
    $errors['name'] = 'Name is required.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'A valid email is required.';
}

if (empty($message) || mb_strlen($message) < 10) {
    $errors['message'] = 'Message must be at least 10 characters.';
}

if (!empty($errors)) {
    // Redirect back with an error flag
    header('Location: ../index.php?contact_error=1');
    exit();
}


$stmt = $db->prepare("INSERT INTO contact_messages (name, email, message, is_read) VALUES (:name, :email, :message, 0)");
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':message' => $message,
]);

header('Location: ../index.php?contact_sent=1');
exit();

