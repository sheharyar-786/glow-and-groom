<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If an admin is logged in, redirect them to the Admin Dashboard
// preventing them from interacting with the normal user interface
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    // Only redirect if they are not already in an admin-specific file
    // (though this guard will only be included in frontend files)
    header("Location: admin_dashboard.php");
    exit();
}
?>
