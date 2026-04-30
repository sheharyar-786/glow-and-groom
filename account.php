<?php 
include 'includes/db.php';
include 'includes/auth_guard.php';

// Get user info from session
$user_id = $_SESSION['user_id'];
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Member";
$userInitial = substr($userName, 0, 1);

$pageTitle = "My Account | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/account.css">';
include 'includes/header.php'; 
?>

<main class="account-container container">
    <aside class="account-sidebar">
        <div class="user-welcome">
            <div class="avatar"><?php echo $userInitial; ?></div>
            <h3>Hello, <?php echo $userName; ?></h3>
            <p>Member since <?php echo date('Y'); ?></p>
        </div>
        <nav class="account-nav">
            <a href="account.php" class="active">Order History</a>
            <a href="routine-builder.php">My Saved Routine</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </aside>

    <section class="account-content">
        <?php if(isset($_GET['order_success'])): ?>
            <div style="background: #eafaf1; color: #2ecc71; padding: 20px; border-radius: 12px; margin-bottom: 30px; border: 1px solid rgba(46, 204, 113, 0.2);">
                <strong>🎉 Success!</strong> Your order has been placed successfully.
            </div>
        <?php endif; ?>

        <div id="orders" class="content-section">
            <h2>Your Orders</h2>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $order_query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC";
                    $order_res = mysqli_query($conn, $order_query);
                    if (mysqli_num_rows($order_res) > 0):
                        while($o = mysqli_fetch_assoc($order_res)):
                    ?>
                    <tr>
                        <td>#GG-<?php echo str_pad($o['id'], 4, '0', STR_PAD_LEFT); ?></td>
                        <td><?php echo date('M d, Y', strtotime($o['created_at'])); ?></td>
                        <td><span class="status <?php echo strtolower($o['status']); ?>"><?php echo $o['status']; ?></span></td>
                        <td><?php echo number_format($o['total_amount']); ?> PKR</td>
                    </tr>
                    <?php 
                        endwhile; 
                    else:
                        echo "<tr><td colspan='4' style='text-align: center; padding: 40px;'>You haven't placed any orders yet.</td></tr>";
                    endif;
                    ?>
                </tbody>
            </table>
        </div>

        <div class="routine-banner" style="margin-top: 50px;">
            <div class="banner-text">
                <h4>Your Custom Routine</h4>
                <p>Build your personalized care plan based on your skin type.</p>
            </div>
            <a href="routine-builder.php" class="btn-sm">Start Quiz</a>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>