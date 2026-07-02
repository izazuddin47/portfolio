<?php
// includes/footer.php

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

    <!-- Bootstrap 5 Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Client-side validation logic -->
    <script src="<?php echo $baseUrl; ?>/assets/admin/js/validation.js"></script>
</body>
</html>
