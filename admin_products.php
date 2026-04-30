<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

$message = "";
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    if (mysqli_query($conn, "DELETE FROM products WHERE id = '$id'")) {
        $message = "<p class='success-msg'>Product deleted successfully.</p>";
    }
}

$pageTitle = "Manage Products | Glow & Groom Admin";
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
            <a href="admin_products.php" class="active">Products</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_orders.php">Orders</a>
            <a href="auth.php?logout=1" class="logout">Logout</a>
        </nav>
    </aside>

    <section class="admin-content">
        <div class="admin-header">
            <div class="header-flex">
                <div>
                    <h1>Product Management</h1>
                    <p>Add, edit, or remove products from your catalog</p>
                </div>
                <a href="admin_product_add.php" class="btn-pro">Add New Product</a>
            </div>
        </div>

        <?php echo $message; ?>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
                    while($p = mysqli_fetch_assoc($res)):
                    ?>
                    <tr>
                        <td>#<?php echo $p['id']; ?></td>
                        <td>
                            <div class="product-cell">
                                <img src="<?php echo $p['image_url']; ?>" alt="">
                                <span><?php echo $p['name']; ?></span>
                            </div>
                        </td>
                        <td><?php echo $p['category']; ?></td>
                        <td><?php echo number_format($p['price']); ?> PKR</td>
                        <td>
                            <span class="status <?php echo $p['is_featured'] ? 'featured' : 'standard'; ?>">
                                <?php echo $p['is_featured'] ? 'Yes' : 'No'; ?>
                            </span>
                        </td>
                        <td class="actions-cell">
                            <a href="admin_product_edit.php?id=<?php echo $p['id']; ?>" class="edit-link">Edit</a>
                            <a href="admin_products.php?delete=<?php echo $p['id']; ?>" class="delete-link" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<style>
.header-flex { display: flex; justify-content: space-between; align-items: center; }
.btn-pro { background: var(--primary); color: white; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; transition: var(--transition); }
.btn-pro:hover { background: var(--accent); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(212, 163, 115, 0.2); }
.actions-cell { display: flex; gap: 15px; }
.edit-link { color: var(--accent); text-decoration: none; font-weight: 700; }
.delete-link { color: #c0392b; text-decoration: none; font-weight: 700; }
</style>

<?php include 'includes/admin_footer.php'; ?>
