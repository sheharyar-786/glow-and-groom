<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

$message = "";
$id = mysqli_real_escape_string($conn, $_GET['id']);
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'"));

if (!$product) {
    header("Location: admin_products.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    $skin_type = mysqli_real_escape_string($conn, $_POST['skin_type']);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    $query = "UPDATE products SET 
              name = '$name', 
              description = '$description', 
              price = '$price', 
              category = '$category', 
              gender = '$gender', 
              skin_type_match = '$skin_type', 
              image_url = '$image_url', 
              is_featured = '$is_featured' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: admin_products.php?updated=1");
        exit();
    } else {
        $message = "<p class='error-msg'>Error updating product: " . mysqli_error($conn) . "</p>";
    }
}

$pageTitle = "Edit Product | Glow & Groom Admin";
include 'includes/admin_header.php'; 
?>

<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="css/contact.css">

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
            <h1>Edit Product: <?php echo $product['name']; ?></h1>
            <p>Modify the product details below</p>
        </div>

        <?php echo $message; ?>

        <form action="admin_product_edit.php?id=<?php echo $id; ?>" method="POST" class="pro-form">
            <div class="form-row">
                <div class="input-group">
                    <label>Product Name</label>
                    <input type="text" name="name" required value="<?php echo $product['name']; ?>">
                </div>
                <div class="input-group">
                    <label>Price (PKR)</label>
                    <input type="number" name="price" required value="<?php echo $product['price']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="Serums" <?php echo $product['category'] == 'Serums' ? 'selected' : ''; ?>>Serums</option>
                        <option value="Facial" <?php echo $product['category'] == 'Facial' ? 'selected' : ''; ?>>Facial</option>
                        <option value="Facemask" <?php echo $product['category'] == 'Facemask' ? 'selected' : ''; ?>>Facemask</option>
                        <option value="Perfume" <?php echo $product['category'] == 'Perfume' ? 'selected' : ''; ?>>Perfume</option>
                        <option value="Skincare" <?php echo $product['category'] == 'Skincare' ? 'selected' : ''; ?>>Skincare</option>
                        <option value="Grooming" <?php echo $product['category'] == 'Grooming' ? 'selected' : ''; ?>>Grooming</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Gender</label>
                    <select name="gender" required>
                        <option value="Men" <?php echo $product['gender'] == 'Men' ? 'selected' : ''; ?>>Men</option>
                        <option value="Women" <?php echo $product['gender'] == 'Women' ? 'selected' : ''; ?>>Women</option>
                        <option value="Unisex" <?php echo $product['gender'] == 'Unisex' ? 'selected' : ''; ?>>Unisex</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label>Skin Type / Variety</label>
                    <select name="skin_type" required>
                        <option value="All" <?php echo $product['skin_type_match'] == 'All' ? 'selected' : ''; ?>>All Skin Types</option>
                        <option value="Oily" <?php echo $product['skin_type_match'] == 'Oily' ? 'selected' : ''; ?>>Oily Skin</option>
                        <option value="Dry" <?php echo $product['skin_type_match'] == 'Dry' ? 'selected' : ''; ?>>Dry Skin</option>
                        <option value="Combination" <?php echo $product['skin_type_match'] == 'Combination' ? 'selected' : ''; ?>>Combination Skin</option>
                        <option value="Sensitive" <?php echo $product['skin_type_match'] == 'Sensitive' ? 'selected' : ''; ?>>Sensitive Skin</option>
                        <option value="Normal" <?php echo $product['skin_type_match'] == 'Normal' ? 'selected' : ''; ?>>Normal Skin</option>
                        <option value="Acne-Prone" <?php echo $product['skin_type_match'] == 'Acne-Prone' ? 'selected' : ''; ?>>Acne-Prone</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Image URL</label>
                    <input type="text" name="image_url" required value="<?php echo $product['image_url']; ?>">
                </div>
            </div>

            <div class="input-group">
                <label>Description</label>
                <textarea name="description" rows="4" required><?php echo $product['description']; ?></textarea>
            </div>

            <div class="input-group checkbox-group" style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_featured" id="is_featured" style="width: auto;" <?php echo $product['is_featured'] ? 'checked' : ''; ?>>
                <label for="is_featured" style="margin-bottom: 0;">Mark as Featured Product</label>
            </div>

            <button type="submit" class="send-btn" style="width: 100%; margin-top: 30px;">Update Product</button>
        </form>
    </section>
</main>

<?php include 'includes/admin_footer.php'; ?>
