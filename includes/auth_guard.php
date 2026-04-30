<?php
/**
 * Auth Guard - Protects pages from unauthorized access
 */
if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect them to the auth page
    header("Location: auth.php");
    exit();
}
