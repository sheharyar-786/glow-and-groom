<?php 
include 'includes/db.php';
include 'includes/auth_guard.php';

$user_id = $_SESSION['user_id'];

// Fetch Cart Items for Review
$query = "SELECT c.quantity, p.* FROM cart c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    header("Location: shop.php");
    exit();
}

$subtotal = 0;
$items = [];
while($item = mysqli_fetch_assoc($result)) {
    $subtotal += ($item['price'] * $item['quantity']);
    $items[] = $item;
}
$shipping = 250;
$total = $subtotal + $shipping;

// Handle Order Placement
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);

    // Create Order
    $order_query = "INSERT INTO orders (user_id, total_amount, shipping_address, city, phone, payment_method) 
                    VALUES ('$user_id', '$total', '$address', '$city', '$phone', '$payment')";
    
    if (mysqli_query($conn, $order_query)) {
        $order_id = mysqli_insert_id($conn);
        
        // Add Items
        foreach ($items as $item) {
            $pid = $item['id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$pid', '$qty', '$price')");
        }

        // Clear Cart
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");

        header("Location: account.php?order_success=1");
        exit();
    } else {
        $message = "<p class='error-msg'>Error placing order. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | Glow & Groom</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body style="background: #fdfaf7;">

    <header class="checkout-header" style="background: white; padding: 20px 0; border-bottom: 1px solid #eee;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="index.php" style="text-decoration: none; color: var(--primary); font-family: 'Playfair Display', serif; font-size: 24px;">GLOW & GROOM</a>
            <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: #777;">🔒 Secure Checkout</div>
        </div>
    </header>

    <main class="checkout-container container" style="display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 60px; padding: 60px 0;">
        <div class="checkout-forms">
            <form action="checkout.php" method="POST">
                <section class="checkout-step" style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow); margin-bottom: 30px;">
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 30px;">1. Delivery Details</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="input-group" style="grid-column: span 2;">
                            <label style="display: block; font-size: 11px; text-transform: uppercase; font-weight: 700; margin-bottom: 10px;">Street Address</label>
                            <input type="text" name="address" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 11px; text-transform: uppercase; font-weight: 700; margin-bottom: 10px;">City</label>
                            <input type="text" name="city" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                        <div class="input-group">
                            <label style="display: block; font-size: 11px; text-transform: uppercase; font-weight: 700; margin-bottom: 10px;">Phone Number</label>
                            <input type="tel" name="phone" required style="width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                        </div>
                    </div>
                </section>

                <section class="checkout-step" style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow); margin-bottom: 30px;">
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 30px;">2. Payment Method</h3>
                    <div class="payment-options" style="display: flex; gap: 20px;">
                        <label style="flex: 1; border: 2px solid var(--accent); padding: 20px; border-radius: 12px; cursor: pointer; display: flex; gap: 15px; align-items: center;">
                            <input type="radio" name="payment" value="COD" checked>
                            <div class="pay-text">
                                <strong style="display: block; font-size: 14px;">Cash on Delivery</strong>
                                <span style="font-size: 11px; color: #777;">Pay when you receive the package</span>
                            </div>
                        </label>
                        <label style="flex: 1; border: 2px solid #eee; padding: 20px; border-radius: 12px; cursor: pointer; display: flex; gap: 15px; align-items: center; opacity: 0.6;">
                            <input type="radio" name="payment" value="Card" disabled>
                            <div class="pay-text">
                                <strong style="display: block; font-size: 14px;">Credit / Debit Card</strong>
                                <span style="font-size: 11px; color: #c0392b;">Currently unavailable</span>
                            </div>
                        </label>
                    </div>
                </section>

                <button type="submit" class="checkout-btn" style="width: 100%; background: var(--primary); color: white; border: none; padding: 20px; border-radius: 50px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; transition: var(--transition);">Complete Purchase • <?php echo number_format($total); ?> PKR</button>
            </form>
        </div>

        <aside class="order-review" style="position: sticky; top: 40px;">
            <div class="review-box" style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow);">
                <h3 style="font-family: 'Playfair Display', serif; font-size: 20px; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">Your Selections</h3>
                <div class="review-items" style="margin-bottom: 30px;">
                    <?php foreach($items as $item): ?>
                    <div class="review-item" style="display: flex; gap: 15px; margin-bottom: 20px; align-items: center;">
                        <img src="<?php echo $item['image_url']; ?>" alt="" style="width: 60px; height: 60px; border-radius: 8px; object-fit: cover; background: #f9f9f9;">
                        <div style="flex-grow: 1;">
                            <p style="font-size: 14px; font-weight: 600; margin-bottom: 2px;"><?php echo $item['name']; ?></p>
                            <span style="font-size: 11px; color: #777;">Quantity: <?php echo $item['quantity']; ?></span>
                        </div>
                        <p style="font-size: 14px; font-weight: 700;"><?php echo number_format($item['price'] * $item['quantity']); ?> PKR</p>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="review-calc" style="border-top: 2px dashed #eee; padding-top: 25px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px; color: #777;">
                        <span>Subtotal</span>
                        <span><?php echo number_format($subtotal); ?> PKR</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 25px; font-size: 14px; color: #777;">
                        <span>Shipping (Fixed)</span>
                        <span><?php echo number_format($shipping); ?> PKR</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 20px; font-weight: 700; color: var(--primary);">
                        <span>Total</span>
                        <span><?php echo number_format($total); ?> PKR</span>
                    </div>
                </div>
            </div>
        </aside>
    </main>

</body>
</html>