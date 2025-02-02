<?php
// backend/auth.php
session_start();

// Check if the user is not logged in (i.e., no user_id in session)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header('Location: ../frontend/login.php');
    exit();
}
?>
