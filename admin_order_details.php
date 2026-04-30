<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

$oid = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;

// Fetch Order Info
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT o.*, u.first_name, u.last_name, u.email FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = '$oid'"));

if (!$order) {
    header("Location: admin_orders.php");
    exit();
}

// Fetch Order Items
$items = mysqli_query($conn, "SELECT oi.*, p.name, p.image_url FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = '$oid'");

$pageTitle = "Order Details #$oid | Glow & Groom Admin";
include 'includes/admin_header.php'; 
?>

<link rel="stylesheet" href="css/admin.css">

<main class="admin-container container">
    <aside class="admin-sidebar">
        <div class="admin-profile">
            <div class="admin-avatar">A</div>
            <h3>Administrator</h3>
            <p>Master Control</p>
        </div>
        <nav class="admin-nav">
            <a href="admin_dashboard.php">Overview</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_orders.php" class="active">Orders</a>
            <a href="admin_profile.php">Profile Settings</a>
            <a href="auth.php?logout=1" class="logout">Logout</a>
        </nav>
    </aside>

    <section class="admin-content">
        <div class="admin-header">
            <a href="admin_orders.php" class="btn-text" style="margin-bottom: 20px; display: inline-block;">← Back to Orders</a>
            <h1>Order Details #GG-<?php echo str_pad($oid, 4, '0', STR_PAD_LEFT); ?></h1>
            <p>Order placed on <?php echo date('F d, Y \a\t h:i A', strtotime($order['created_at'])); ?></p>
        </div>

        <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 40px;">
            <div class="order-items-card" style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow);">
                <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 30px;">Products Ordered</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid #eee;">
                            <th style="text-align: left; padding: 15px 0; font-size: 12px; color: #999; text-transform: uppercase;">Product</th>
                            <th style="text-align: center; padding: 15px 0; font-size: 12px; color: #999; text-transform: uppercase;">Qty</th>
                            <th style="text-align: right; padding: 15px 0; font-size: 12px; color: #999; text-transform: uppercase;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($item = mysqli_fetch_assoc($items)): ?>
                        <tr style="border-bottom: 1px solid #f9f9f9;">
                            <td style="padding: 20px 0;">
                                <div class="product-cell">
                                    <img src="<?php echo $item['image_url']; ?>" alt="" style="width: 50px; height: 50px; border-radius: 8px;">
                                    <span><?php echo $item['name']; ?></span>
                                </div>
                            </td>
                            <td style="text-align: center;"><?php echo $item['quantity']; ?></td>
                            <td style="text-align: right; font-weight: 700;"><?php echo number_format($item['price'] * $item['quantity']); ?> PKR</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="padding: 20px 0; text-align: right; font-weight: 600;">Total Amount:</td>
                            <td style="padding: 20px 0; text-align: right; font-size: 20px; font-weight: 700; color: var(--primary);"><?php echo number_format($order['total_amount']); ?> PKR</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="customer-info-card" style="background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow); height: fit-content;">
                <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 30px;">Customer Information</h3>
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; color: #999; margin-bottom: 5px;">Name</label>
                    <p style="font-weight: 600;"><?php echo $order['first_name'] . " " . $order['last_name']; ?></p>
                </div>
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; color: #999; margin-bottom: 5px;">Email</label>
                    <p style="font-weight: 600;"><?php echo $order['email']; ?></p>
                </div>
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; color: #999; margin-bottom: 5px;">Phone</label>
                    <p style="font-weight: 600;"><?php echo $order['phone']; ?></p>
                </div>
                <div style="margin-bottom: 25px;">
                    <label style="display: block; font-size: 11px; text-transform: uppercase; color: #999; margin-bottom: 5px;">Shipping Address</label>
                    <p style="font-weight: 600; line-height: 1.5;"><?php echo $order['shipping_address']; ?>,<br><?php echo $order['city']; ?></p>
                </div>
                <div>
                    <label style="display: block; font-size: 11px; text-transform: uppercase; color: #999; margin-bottom: 5px;">Payment Method</label>
                    <p style="font-weight: 700; color: var(--accent);"><?php echo $order['payment_method']; ?></p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/admin_footer.php'; ?>
