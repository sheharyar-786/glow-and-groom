<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = strtolower(str_replace(' ', '-', $name));
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    $skin_type = mysqli_real_escape_string($conn, $_POST['skin_type']);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    $query = "INSERT INTO products (name, slug, description, price, category, gender, skin_type_match, image_url, is_featured) 
              VALUES ('$name', '$slug', '$description', '$price', '$category', '$gender', '$skin_type', '$image_url', '$is_featured')";

    if (mysqli_query($conn, $query)) {
        header("Location: admin_products.php?success=1");
        exit();
    } else {
        $message = "<p class='error-msg'>Error adding product: " . mysqli_error($conn) . "</p>";
    }
}

$pageTitle = "Add New Product | Glow & Groom Admin";
include 'includes/admin_header.php'; 
?>

<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="css/contact.css"> <!-- Reusing form styles -->

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
            <a href="admin_products.php" class="btn-text" style="margin-bottom: 20px; display: inline-block;">← Back to Products</a>
            <h1>Add New Product</h1>
            <p>Fill in the details to add a new item to the store</p>
        </div>

        <?php echo $message; ?>

        <form action="admin_product_add.php" method="POST" class="pro-form">
            <div class="form-row">
                <div class="input-group">
                    <label>Product Name</label>
                    <input type="text" name="name" required placeholder="e.g. Volcanic Clay Face Wash">
                </div>
                <div class="input-group">
                    <label>Price (PKR)</label>
                    <input type="number" name="price" required placeholder="e.g. 1500">
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="Serums">Serums</option>
                        <option value="Facial">Facial</option>
                        <option value="Facemask">Facemask</option>
                        <option value="Perfume">Perfume</option>
                        <option value="Skincare">Skincare</option>
                        <option value="Grooming">Grooming</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Unisex">Unisex</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label>Skin Type / Variety</label>
                    <select name="skin_type" required>
                        <option value="All">All Skin Types</option>
                        <option value="Oily">Oily Skin</option>
                        <option value="Dry">Dry Skin</option>
                        <option value="Combination">Combination Skin</option>
                        <option value="Sensitive">Sensitive Skin</option>
                        <option value="Normal">Normal Skin</option>
                        <option value="Acne-Prone">Acne-Prone</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Image URL (from assets/serums...)</label>
                    <input type="text" name="image_url" required placeholder="assets/serums women/images.jpg">
                </div>
            </div>

            <div class="input-group">
                <label>Description</label>
                <textarea name="description" rows="4" required placeholder="Describe the product benefits and ingredients..."></textarea>
            </div>

            <div class="input-group checkbox-group" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_featured" id="is_featured" style="width: auto;">
                <label for="is_featured" style="margin-bottom: 0;">Mark as Featured Product</label>
            </div>

            <button type="submit" class="send-btn" style="width: 100%; margin-top: 30px;">Publish Product</button>
        </form>
    </section>
</main>

<?php include 'includes/admin_footer.php'; ?>
