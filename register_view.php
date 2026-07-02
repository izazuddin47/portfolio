<?php
// views/register_view.php
// Expected in scope: $errors (array), $postData (array)

$pageTitle = 'Admin Registration — Izaz Uddin';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/helpers.php';
?>

<div class="glass-card">
    <div class="admin-brand">
        <!-- Logo links back to the main portfolio index page -->
        <a href="../index.html">
            <img src="../project-img/logo.png" alt="Izaz Uddin Logo">
        </a>
        <h2>Admin <span>Registration</span></h2>
        <p>Register a secure administrator profile</p>
    </div>

    <!-- General Error Banner -->
    <?php if (isset($errors['general'])): ?>
        <div class="alert-glass alert-glass-danger" role="alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div><?php echo $errors['general']; ?></div>
        </div>
    <?php endif; ?>

    <form action="register.php" method="POST" id="registerForm" novalidate>
        <!-- CSRF Protection Token -->
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <!-- Full Name -->
        <div class="form-group-custom">
            <label for="full_name" class="form-label-custom">Full Name</label>
            <div class="input-icon-wrap">
                <input type="text" 
                       id="full_name" 
                       name="full_name" 
                       class="form-control form-control-custom <?php echo isset($errors['full_name']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="e.g. Izaz Uddin" 
                       value="<?php echo htmlspecialchars($postData['full_name'] ?? ''); ?>" 
                       required>
                <i class="fa-solid fa-user"></i>
                <?php if (isset($errors['full_name'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['full_name']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Username -->
        <div class="form-group-custom">
            <label for="username" class="form-label-custom">Username</label>
            <div class="input-icon-wrap">
                <input type="text" 
                       id="username" 
                       name="username" 
                       class="form-control form-control-custom <?php echo isset($errors['username']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="e.g. izaz_admin" 
                       value="<?php echo htmlspecialchars($postData['username'] ?? ''); ?>" 
                       required>
                <i class="fa-solid fa-user-gear"></i>
                <?php if (isset($errors['username'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['username']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Email Address -->
        <div class="form-group-custom">
            <label for="email" class="form-label-custom">Email Address</label>
            <div class="input-icon-wrap">
                <input type="email" 
                       id="email" 
                       name="email" 
                       class="form-control form-control-custom <?php echo isset($errors['email']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="e.g. izazuddin47@gmail.com" 
                       value="<?php echo htmlspecialchars($postData['email'] ?? ''); ?>" 
                       required>
                <i class="fa-solid fa-envelope"></i>
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group-custom">
            <label for="password" class="form-label-custom">Password</label>
            <div class="input-icon-wrap">
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control form-control-custom <?php echo isset($errors['password']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="Min. 8 characters" 
                       required>
                <i class="fa-solid fa-lock"></i>
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group-custom">
            <label for="confirm_password" class="form-label-custom">Confirm Password</label>
            <div class="input-icon-wrap">
                <input type="password" 
                       id="confirm_password" 
                       name="confirm_password" 
                       class="form-control form-control-custom <?php echo isset($errors['confirm_password']) ? 'is-invalid is-invalid-custom' : ''; ?>" 
                       placeholder="Repeat password" 
                       required>
                <i class="fa-solid fa-circle-check"></i>
                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="invalid-feedback invalid-feedback-custom"><?php echo $errors['confirm_password']; ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Register Submit Button -->
        <button type="submit" class="btn-admin btn-admin-primary mt-2">
            Create Account <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </button>
    </form>

    <!-- Option to direct to login page -->
    <div class="text-center mt-4">
        <p class="text-muted small mb-0">Already have an admin account? <a href="login.php">Log in here</a></p>
    </div>
</div>

<footer class="admin-footer">
    © 2026 Izaz Uddin. Admin Registration Panel.
</footer>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
