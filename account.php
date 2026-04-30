<?php 
$pageTitle = "My Account | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/account.css">';
include 'includes/header.php'; 
include 'includes/auth_guard.php';

// Get user info from session
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "Member";
$userInitial = substr($userName, 0, 1);
?>

    <main class="account-container container">
        <aside class="account-sidebar">
            <div class="user-welcome">
                <div class="avatar"><?php echo $userInitial; ?></div>
                <h3>Hello, <?php echo $userName; ?></h3>
                <p>Member since 2026</p>
            </div>
            <nav class="account-nav">
                <a href="#orders" class="active">Order History</a>
                <a href="#routine">My Saved Routine</a>
                <a href="#addresses">Addresses</a>
                <a href="#settings">Account Settings</a>
                <a href="logout.php" class="logout">Logout</a>
            </nav>
        </aside>

        <section class="account-content">
            <div id="orders" class="content-section">
                <h2>Recent Orders</h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#GG-8492</td>
                            <td>Feb 12, 2026</td>
                            <td><span class="status shipped">Shipped</span></td>
                            <td>3,450 PKR</td>
                            <td><a href="#" class="view-link">View Details</a></td>
                        </tr>
                        <tr>
                            <td>#GG-7210</td>
                            <td>Jan 05, 2026</td>
                            <td><span class="status delivered">Delivered</span></td>
                            <td>1,200 PKR</td>
                            <td><a href="#" class="view-link">View Details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="routine-banner">
                <div class="banner-text">
                    <h4>Your Custom Routine</h4>
                    <p>Based on your latest analysis.</p>
                </div>
                <a href="routine-builder.php" class="btn-sm">Re-take Quiz</a>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>