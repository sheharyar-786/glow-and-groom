<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Add to Cart
if (isset($_POST['product_id'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $qty = isset($_POST['qty']) ? mysqli_real_escape_string($conn, $_POST['qty']) : 1;

    // Check if item already exists in cart
    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + $qty WHERE user_id = '$user_id' AND product_id = '$product_id'");
    } else {
        mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$qty')");
    }
    header("Location: cart.php");
    exit();
}

// Remove from Cart
if (isset($_GET['remove'])) {
    $cart_id = mysqli_real_escape_string($conn, $_GET['remove']);
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$cart_id' AND user_id = '$user_id'");
    header("Location: cart.php");
    exit();
}

// Clear Cart
if (isset($_GET['clear'])) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    header("Location: cart.php");
    exit();
}
?>
