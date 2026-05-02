<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$skin_type = isset($_GET['skin_type']) ? mysqli_real_escape_string($conn, $_GET['skin_type']) : '';
$concern = isset($_GET['concern']) ? mysqli_real_escape_string($conn, $_GET['concern']) : '';

if (!empty($skin_type) && !empty($concern)) {
    $query = "UPDATE users SET saved_skin_type = '$skin_type', saved_concern = '$concern' WHERE id = '$user_id'";
    if (mysqli_query($conn, $query)) {
        header("Location: account.php?routine_saved=1");
        exit();
    }
}

header("Location: index.php");
exit();
?>
