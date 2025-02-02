<?php
// Set session lifetime to 9 hours (9 * 60 * 60 seconds = 32400 seconds)
$lifetime = 60 * 60 * 9; // 32400 seconds

// Configure session cookie parameters
session_set_cookie_params([
    'lifetime' => $lifetime,
    'path' => '/',
    'domain' => '', // Adjust if you have a specific domain
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
    'httponly' => true,
    'samesite' => 'Lax' // Change to 'Strict' if necessary
]);

// Ensure session data is kept as long as the cookie lifetime
ini_set('session.gc_maxlifetime', $lifetime);

// Start the session
session_start();

// If the session is newly created, store the creation time
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > $lifetime) {
    // If more than 9 hours have passed, destroy the session and redirect to login
    session_unset();
    session_destroy();
    header("Location: /frontend/login.php?timeout=1");
    exit();
}

// Now check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /frontend/login.php");
    exit();
}
?>
