<?php
// includes/header.php
require_once __DIR__ . '/helpers.php';
secure_session_start();

// Calculate the base path dynamically to avoid path issues
$script = $_SERVER['SCRIPT_NAME'];
$dir = dirname($script);
$dir = str_replace('\\', '/', $dir);

$root = $dir;
$folders_to_strip = ['/views', '/controllers', '/authentication', '/includes'];
foreach ($folders_to_strip as $folder) {
    if (substr($root, -strlen($folder)) === $folder) {
        $root = substr($root, 0, -strlen($folder));
    }
}
$baseUrl = rtrim($root, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Secure Admin Portal for the portfolio website. Managed by Izaz Uddin.">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Admin - Izaz Uddin'; ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Administrative Styling -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/admin/css/styles.css">
</head>
<body class="admin-body">
