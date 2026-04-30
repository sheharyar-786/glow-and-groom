<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

// Fetch stats
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];
$product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
$featured_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products WHERE is_featured = 1"))['count'];

$pageTitle = "Admin Dashboard | Glow & Groom";
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
            <a href="admin_dashboard.php" class="active">Overview</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_orders.php">Orders</a>
            <a href="auth.php?logout=1" class="logout">Logout</a>
        </nav>
    </aside>

    <section class="admin-content">
        <div class="admin-header">
            <h1>Dashboard Overview</h1>
            <p>Real-time statistics for Glow & Groom</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-label">Total Users</span>
                <span class="stat-value"><?php echo $user_count; ?></span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Total Products</span>
                <span class="stat-value"><?php echo $product_count; ?></span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Featured Items</span>
                <span class="stat-value"><?php echo $featured_count; ?></span>
            </div>
        </div>

        <div class="recent-products">
            <div class="section-top">
                <h2>Recent Products</h2>
                <a href="admin_products.php" class="btn-text">Manage All</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recent_res = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC LIMIT 5");
                    while($p = mysqli_fetch_assoc($recent_res)):
                    ?>
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="<?php echo $p['image_url']; ?>" alt="">
                                <span><?php echo $p['name']; ?></span>
                            </div>
                        </td>
                        <td><?php echo number_format($p['price']); ?> PKR</td>
                        <td><?php echo $p['category']; ?></td>
                        <td><span class="status <?php echo $p['is_featured'] ? 'featured' : 'standard'; ?>">
                            <?php echo $p['is_featured'] ? 'Featured' : 'Standard'; ?>
                        </span></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include 'includes/admin_footer.php'; ?>
