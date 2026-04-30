<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

$message = "";
if (isset($_POST['update_status'])) {
    $oid = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    if (mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE id = '$oid'")) {
        $message = "<p class='success-msg'>Order #$oid updated to $status.</p>";
    }
}

$pageTitle = "Manage Orders | Glow & Groom Admin";
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
            <h1>Order Management</h1>
            <p>Track and fulfill customer purchases</p>
        </div>

        <?php echo $message; ?>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT o.*, u.first_name, u.last_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.id DESC");
                    while($o = mysqli_fetch_assoc($res)):
                    ?>
                    <tr>
                        <td>#GG-<?php echo str_pad($o['id'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo $o['first_name'] . " " . $o['last_name']; ?></td>
                        <td><?php echo number_format($o['total_amount']); ?> PKR</td>
                        <td>
                            <form action="admin_orders.php" method="POST" style="display: flex; gap: 10px; align-items: center;">
                                <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                <select name="status" class="status-select" style="padding: 5px; border-radius: 5px; border: 1px solid #ddd; font-size: 12px;">
                                    <option value="Pending" <?php echo $o['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Shipped" <?php echo $o['status'] == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                                    <option value="Delivered" <?php echo $o['status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                                    <option value="Cancelled" <?php echo $o['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                                <button type="submit" name="update_status" class="update-btn">Update</button>
                            </form>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($o['created_at'])); ?></td>
                        <td>
                            <a href="admin_order_details.php?id=<?php echo $o['id']; ?>" class="btn-text">View Details</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<style>
.status-select { background: #fafafa; }
.update-btn { background: var(--primary); color: white; border: none; padding: 5px 12px; border-radius: 5px; font-size: 10px; font-weight: 700; text-transform: uppercase; cursor: pointer; transition: var(--transition); }
.update-btn:hover { background: var(--accent); }
</style>

<?php include 'includes/admin_footer.php'; ?>
