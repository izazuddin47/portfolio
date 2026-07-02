<?php
// controllers/AuthController.php

class AuthController {
    /**
     * @var PDO
     */
    private $db;

    /**
     * @var Admin
     */
    private $adminModel;

    /**
     * AuthController constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db) {
        $this->db = $db;
        require_once __DIR__ . '/../models/Admin.php';
        $this->adminModel = new Admin($db);
        require_once __DIR__ . '/../includes/helpers.php';
    }

    /**
     * Handles Admin Registration.
     *
     * @param array $post POST parameters
     * @return array Validation errors array
     */
    public function handleRegister(array $post) {
        $errors = [];

        // Fetch inputs, sanitizing basic string inputs
        $fullName = trim($post['full_name'] ?? '');
        $username = trim($post['username'] ?? '');
        $email    = trim($post['email'] ?? '');
        $password = $post['password'] ?? '';
        $confirmPassword = $post['confirm_password'] ?? '';

        // Validation checks
        if (empty($fullName)) {
            $errors['full_name'] = 'Full Name is required.';
        } elseif (strlen($fullName) < 3 || strlen($fullName) > 100) {
            $errors['full_name'] = 'Full Name must be between 3 and 100 characters.';
        }

        if (empty($username)) {
            $errors['username'] = 'Username is required.';
        } elseif (!preg_match('/^[a-zA-Z0-9_]{3,30}$/', $username)) {
            $errors['username'] = 'Username must be 3-30 characters long and contain only letters, numbers, or underscores.';
        }

        if (empty($email)) {
            $errors['email'] = 'Email Address is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long.';
        }

        if ($password !== $confirmPassword) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        // If no basic validation errors, check database constraints
        if (empty($errors)) {
            if ($this->adminModel->usernameExists($username)) {
                $errors['username'] = 'Username is already taken.';
            }
            if ($this->adminModel->emailExists($email)) {
                $errors['email'] = 'Email address is already registered.';
            }
        }

        // Insert new admin if validation passes
        if (empty($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            $success = $this->adminModel->create([
                'full_name' => $fullName,
                'username'  => $username,
                'email'     => $email,
                'password'  => $hashedPassword
            ]);

            if ($success) {
                // Set flash message and redirect to login page
                set_flash_message('register_success', 'Registration successful! You can now log in.', 'success');
                $this->redirect('/authentication/login.php');
            } else {
                $errors['general'] = 'Registration failed due to a database error. Please try again.';
            }
        }

        return $errors;
    }

    /**
     * Handles Admin Login.
     *
     * @param array $post POST parameters
     * @return array Validation errors array
     */
    public function handleLogin(array $post) {
        $errors = [];

        $login    = trim($post['login'] ?? '');
        $password = $post['password'] ?? '';

        if (empty($login)) {
            $errors['login'] = 'Username or Email is required.';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        }

        if (empty($errors)) {
            // Find record matching either username or email
            $admin = $this->adminModel->findByUsernameOrEmail($login);

            if ($admin && password_verify($password, $admin['password'])) {
                // Start a secure session
                secure_session_start();

                // Regenerate session id to secure against session fixation
                session_regenerate_id(true);

                // Populate session data
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id']        = $admin['id'];
                $_SESSION['admin_username']  = $admin['username'];
                $_SESSION['admin_fullname']  = $admin['full_name'];
                $_SESSION['admin_email']     = $admin['email'];

                // Redirect to protected dashboard
                $this->redirect('/views/dashboard_view.php');
            } else {
                $errors['general'] = 'Invalid username/email or password.';
            }
        }

        return $errors;
    }

    /**
     * Handles secure session destruction (Logout).
     *
     * @return void
     */
    public function handleLogout() {
        secure_session_start();

        // Clear all session variables
        $_SESSION = [];

        // Expire the session cookie explicitly
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Terminate session
        session_destroy();

        // Redirect back to login
        $this->redirect('/authentication/login.php');
    }

    /**
     * Performs clean redirections, keeping directory structures aligned.
     *
     * @param string $path Absolute path context relative to project root
     * @return void
     */
    private function redirect(string $path) {
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

        $root = rtrim($root, '/');
        header("Location: " . $root . $path);
        exit();
    }
}
