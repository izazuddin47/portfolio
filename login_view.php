<?php
// views/login_view.php
// Expected in scope: $errors (array), $postData (array)

$pageTitle = 'Admin Login — Izaz Uddin';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/helpers.php';

// Check for successful registration flash messages
$successFlash = get_flash_message('register_success');
?>

<div class="glass-card">
    <div class="admin-brand">
        <!-- Logo links back to the main portfolio index page -->
        <a href="../index.html">
            <img src="../project-img/logo.png" alt="Izaz Uddin Logo">
        </a>
        <h2>Admin <span>Portal</span></h2>
        <p>Login to manage your portfolio</p>
    </div>

    <!-- Success Registration Flash Alert -->
    <?php if ($successFlash): ?>
        <div class="alert-glass alert-glass-success" role="alert">
            <i class="fa-solid fa-circle-check"></i>
            <div><?php echo $successFlash['message']; ?></div>
        </div>
    <?php endif; ?>

    <!-- Login Authentication Error Alert -->
    <?php if (isset($errors['general'])): ?>
        <div class="alert-glass alert-glass-danger" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div><?php echo $errors['general']; ?></div>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" id="loginForm" novalidate>
        <!-- CSRF Protection Token -->
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <!-- Username or Email Input -->
        <div class="form-group-custom">
            <label for="login" class="form-label-custom">Username or Email</label>
            <div class="input-icon-wrap">
                <input type="text" 
                       id="login" 
                       name="login" 
                       class="form-control form-control-custom <?php echo isset($errors['login']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="e.g. izaz_admin or name@email.com" 
                       value="<?php echo htmlspecialchars($postData['login'] ?? ''); ?>" 
                       required>
                <i class="fa-solid fa-user-shield"></i>
                <?php if (isset($errors['login'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['login']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Password Input -->
        <div class="form-group-custom">
            <label for="password" class="form-label-custom">Password</label>
            <div class="input-icon-wrap">
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control form-control-custom <?php echo isset($errors['password']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="••••••••" 
                       required>
                <i class="fa-solid fa-lock"></i>
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Login Submit Button -->
        <button type="submit" class="btn-admin btn-admin-primary mt-2">
            Secure Log In <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </button>
    </form>

    <!-- Option to register direct link -->
    <div class="text-center mt-4">
        <p class="text-muted small mb-0">Don't have an admin account? <a href="register.php">Register here</a></p>
    </div>
</div>

<footer class="admin-footer">
    © 2026 Izaz Uddin. Secure Admin Panel.
</footer>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
