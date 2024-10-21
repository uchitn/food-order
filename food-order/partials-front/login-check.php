<?php
// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Authorization access control
// Check whether the user is logged in or not
if (!isset($_SESSION['user'])) {
    // User is not logged in
    // Redirect to login page with a message
    $_SESSION['no-login-message'] = "<div style='color:red'>Please login to access Admin Panel.</div>";
    
    // Redirect to login page
    header('location:'.SITEURL.'admin/login.php');
    exit();
}
?>
