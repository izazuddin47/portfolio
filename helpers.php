<?php
// includes/helpers.php

/**
 * Starts a secure PHP session.
 */
function secure_session_start() {
    if (session_status() === PHP_SESSION_NONE) {
        // Set secure cookie parameters
        session_sec_cookie_setup();
        session_start();
    }
}

/**
 * Configure secure session cookies.
 */
function session_sec_cookie_setup() {
    $cookieParams = session_get_cookie_params();
    
    // Determine if connection is secure (HTTPS)
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') 
              || ($_SERVER['SERVER_PORT'] == 443);
              
    session_set_cookie_params([
        'lifetime' => 0, // Session cookie (expires when browser closes)
        'path'     => $cookieParams['path'],
        'domain'   => $cookieParams['domain'],
        'secure'   => $secure,
        'httponly' => true, // Prevents JavaScript XSS access to session cookie
        'samesite' => 'Strict' // Mitigates CSRF attacks
    ]);
    
    // Set custom session name for security (obfuscates default PHP PHPSESSID)
    session_name('PORTFOLIO_ADMIN_SESSION');
}

/**
 * Sanitizes user input to prevent XSS.
 *
 * @param mixed $data
 * @return mixed
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(trim(stripslashes($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Generates a cryptographically secure CSRF token.
 *
 * @return string
 */
function generate_csrf_token() {
    secure_session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validates a CSRF token.
 *
 * @param string|null $token
 * @return bool
 */
function validate_csrf_token($token) {
    secure_session_start();
    if (!isset($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Sets a flash message to display on the next page request.
 *
 * @param string $key
 * @param string $message
 * @param string $type (success, danger, warning, info)
 */
function set_flash_message($key, $message, $type = 'info') {
    secure_session_start();
    $_SESSION['flash'][$key] = [
        'message' => $message,
        'type'    => $type
    ];
}

/**
 * Checks if a flash message exists.
 *
 * @param string $key
 * @return bool
 */
function has_flash_message($key) {
    secure_session_start();
    return isset($_SESSION['flash'][$key]);
}

/**
 * Retrieves and clears a flash message.
 *
 * @param string $key
 * @return array|null
 */
function get_flash_message($key) {
    secure_session_start();
    if (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}
