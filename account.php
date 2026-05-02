<?php 
include 'includes/db.php';
include 'includes/auth_guard.php';

// Get user info from session
$user_id = $_SESSION['user_id'];

// Fetch user routine data
$u_query = "SELECT * FROM users WHERE id = '$user_id'";
$u_res = mysqli_query($conn, $u_query);
$user = mysqli_fetch_assoc($u_res);

$userName = $user['first_name'] . ' ' . $user['last_name'];
$userInitial = substr($user['first_name'], 0, 1);
$saved_skin = $user['saved_skin_type'];
$saved_concern = $user['saved_concern'];

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

        <?php if(isset($_GET['routine_saved'])): ?>
            <div style="background: #eaf3fa; color: #3498db; padding: 20px; border-radius: 12px; margin-bottom: 30px; border: 1px solid rgba(52, 152, 219, 0.2);">
                <strong>✨ Saved!</strong> Your personalized routine has been updated.
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

        <div class="routine-banner" style="margin-top: 50px; background: linear-gradient(135deg, var(--primary), #2c3e3e); color: white; padding: 40px; border-radius: 20px; display: flex; justify-content: space-between; align-items: center;">
            <div class="banner-text">
                <?php if($saved_skin): ?>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 10px;">Your Custom Routine: <?php echo $saved_skin; ?></h4>
                    <p style="opacity: 0.8; font-size: 14px;">Focused on: <strong><?php echo $saved_concern; ?></strong></p>
                <?php else: ?>
                    <h4 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 10px;">Build Your Custom Routine</h4>
                    <p style="opacity: 0.8; font-size: 14px;">Our AI diagnostic analyzes your skin to find your perfect match.</p>
                <?php endif; ?>
            </div>
            <a href="routine-builder.php" class="btn" style="background: var(--accent); color: white; border: none; padding: 15px 30px; font-size: 11px;"><?php echo $saved_skin ? 'Update Quiz' : 'Start Quiz'; ?></a>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>