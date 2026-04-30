<?php 
include 'includes/frontend_guard.php';
include 'includes/db.php';
$pageTitle = "Search Results | Glow & Groom";
include 'includes/header.php'; 
include 'includes/auth_guard.php';
?>

    <main class="search-page container">
        <header class="search-header">
            <form action="search.php" method="GET" class="search-bar-large">
                <input type="text" name="q" placeholder="Search for products, concerns, or routines..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
            <p class="search-meta">Showing results for <strong>"<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : 'Serum'; ?>"</strong></p>
        </header>

        <section class="product-grid">
            <?php
            $q = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';
            if ($q) {
                $query = "SELECT * FROM products WHERE name LIKE '%$q%' OR description LIKE '%$q%' OR category LIKE '%$q%'";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while($p = mysqli_fetch_assoc($result)) {
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
                    }
                } else {
                    echo "<p style='grid-column: 1/-1; text-align: center; padding: 40px;'>No products found matching \"$q\".</p>";
                }
            } else {
                echo "<p style='grid-column: 1/-1; text-align: center; padding: 40px;'>Enter a search term to find products.</p>";
            }
            ?>
        </section>
    </main>

<?php 
include 'includes/footer.php'; ?>