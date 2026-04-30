<?php 
include 'includes/frontend_guard.php';
$pageTitle = "Shop All Products | Glow & Groom";
include 'includes/header.php'; 
include 'includes/auth_guard.php';
?>

    <main class="shop-container container">
        <aside class="filters">
            <div class="filter-group">
                <h4>Gender</h4>
                <label><input type="checkbox"> Men</label>
                <label><input type="checkbox"> Women</label>
                <label><input type="checkbox"> Unisex</label>
            </div>

            <div class="filter-group">
                <h4>Category</h4>
                <label><input type="checkbox"> Face Wash</label>
                <label><input type="checkbox"> Moisturizers</label>
                <label><input type="checkbox"> Serums</label>
                <label><input type="checkbox"> Beard Care</label>
            </div>

            <div class="filter-group">
                <h4>Skin Type</h4>
                <label><input type="checkbox"> Oily</label>
                <label><input type="checkbox"> Dry</label>
                <label><input type="checkbox"> Sensitive</label>
            </div>
        </aside>

        <section class="product-listing">
            <div class="shop-header">
                <?php
                $gender_filter = isset($_GET['gender']) ? mysqli_real_escape_string($conn, $_GET['gender']) : '';
                $query = "SELECT * FROM products";
                if ($gender_filter) {
                    $query .= " WHERE gender = '$gender_filter'";
                }
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                ?>
                <p>Showing <?php echo $count; ?> Products <?php echo $gender_filter ? "for $gender_filter" : ""; ?></p>
                <select class="sort-dropdown">
                    <option>Newest First</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>

            <div class="product-grid">
                <?php
                if ($count > 0):
                    while($p = mysqli_fetch_assoc($result)): 
                ?>
                <div class="product-card" data-aos="fade-up">
                    <div class="product-img">
                        <a href="product.php?id=<?php echo $p['id']; ?>">
                            <img src="<?php echo $p['image_url']; ?>" alt="<?php echo $p['name']; ?>">
                        </a>
                        <button class="quick-add">Add to Bag +</button>
                    </div>
                    <div class="product-info">
                        <span class="product-cat"><?php echo $p['gender']; ?> • <?php echo $p['category']; ?></span>
                        <h3 class="product-name"><a href="product.php?id=<?php echo $p['id']; ?>" style="text-decoration: none; color: inherit;"><?php echo $p['name']; ?></a></h3>
                        <p class="product-price"><?php echo number_format($p['price']); ?> PKR</p>
                    </div>
                </div>
                <?php 
                    endwhile; 
                else:
                    echo "<p>No products found matching your selection.</p>";
                endif;
                ?>
            </div>
        </section>
    </main>

<?php include 'includes/footer.php'; ?>