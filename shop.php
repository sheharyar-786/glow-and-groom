<?php 
include 'includes/db.php';
include 'includes/frontend_guard.php';

$gender_filter = isset($_GET['gender']) ? mysqli_real_escape_string($conn, $_GET['gender']) : '';
$category_filter = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
$skin_type_filter = isset($_GET['skin_type']) ? mysqli_real_escape_string($conn, $_GET['skin_type']) : '';
$price_min = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$price_max = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 100000;
$sort = isset($_GET['sort']) ? mysqli_real_escape_string($conn, $_GET['sort']) : 'default';

// Build Query
$query = "SELECT * FROM products WHERE price BETWEEN $price_min AND $price_max";
if ($gender_filter) { 
    $query .= " AND (gender = '$gender_filter' OR gender = 'unisex')"; 
}
if ($category_filter) { $query .= " AND category = '$category_filter'"; }
if ($skin_type_filter) { $query .= " AND skin_type_match = '$skin_type_filter'"; }

// Add Sorting
switch($sort) {
    case 'price_low': $query .= " ORDER BY price ASC"; break;
    case 'price_high': $query .= " ORDER BY price DESC"; break;
    case 'newest': $query .= " ORDER BY id DESC"; break;
    default: $query .= " ORDER BY is_featured DESC, id DESC"; break;
}

$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);

// Helper function for building persistent URLs
function filter_url($params) {
    $current = $_GET;
    foreach($params as $key => $val) {
        if ($val === null) unset($current[$key]);
        else $current[$key] = $val;
    }
    return 'shop.php?' . http_build_query($current);
}

$pageTitle = "The Collection | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/shop.css">';
include 'includes/header.php'; 
?>

<main class="shop-page">
    <?php 
    $show_ritual = ($category_filter == 'Serums' || $gender_filter != '');
    if($show_ritual): 
        // Determine image and title based on active filters
        if ($gender_filter == 'men') {
            $ritual_img = 'assets/icons/men using serum.png';
            $ritual_title = "The Gentlemen's Collection";
            $ritual_pos = 'center';
        } else {
            $ritual_img = 'assets/icons/girl using serum.png';
            $ritual_title = "The Radiance Ritual";
            $ritual_pos = 'center';
        }
    ?>
    <section class="shop-ritual-header" data-aos="fade-up" style="background: linear-gradient(rgba(26, 42, 42, 0.5), rgba(26, 42, 42, 0.5)), url('<?php echo $ritual_img; ?>'); background-attachment: fixed; background-size: cover; background-position: <?php echo $ritual_pos; ?>; padding: 180px 0; color: white; text-align: center; margin-bottom: 50px;">
        <div class="container" data-aos="fade-down">
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); display: inline-block; padding: 40px 60px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.2);">
                <span style="text-transform: uppercase; letter-spacing: 5px; font-size: 11px; display: block; margin-bottom: 15px;">Active Collection</span>
                <h1 style="font-family: 'Playfair Display', serif; font-size: 42px; margin: 0;"><?php echo $ritual_title; ?></h1>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <div class="container">
        <div class="shop-grid">
            
            <!-- Sidebar Filters -->
            <aside class="filters-sidebar" data-aos="fade-right">
                <div class="filter-group">
                    <h4>Gender</h4>
                    <div class="filter-options">
                        <a href="<?php echo filter_url(['gender' => null]); ?>" class="filter-label <?php echo !$gender_filter ? 'active' : ''; ?>">All Collections</a>
                        <a href="<?php echo filter_url(['gender' => 'women']); ?>" class="filter-label <?php echo $gender_filter == 'women' ? 'active' : ''; ?>">For Her (Glow)</a>
                        <a href="<?php echo filter_url(['gender' => 'men']); ?>" class="filter-label <?php echo $gender_filter == 'men' ? 'active' : ''; ?>">For Him (Groom)</a>
                    </div>
                </div>

                <div class="filter-group">
                    <h4>Categories</h4>
                    <div class="filter-options">
                        <a href="<?php echo filter_url(['category' => null]); ?>" class="filter-label <?php echo !$category_filter ? 'active' : ''; ?>">All Collections</a>
                        <a href="<?php echo filter_url(['category' => 'Serums']); ?>" class="filter-label <?php echo $category_filter == 'Serums' ? 'active' : ''; ?>">Active Serums</a>
                        <a href="<?php echo filter_url(['category' => 'Facial']); ?>" class="filter-label <?php echo $category_filter == 'Facial' ? 'active' : ''; ?>">Facial Care</a>
                        <a href="<?php echo filter_url(['category' => 'Facemask']); ?>" class="filter-label <?php echo $category_filter == 'Facemask' ? 'active' : ''; ?>">Face Masks</a>
                        <a href="<?php echo filter_url(['category' => 'Perfume']); ?>" class="filter-label <?php echo $category_filter == 'Perfume' ? 'active' : ''; ?>">Luxury Perfumes</a>
                    </div>
                </div>

                <div class="filter-group">
                    <h4>Price Range</h4>
                    <div class="filter-options">
                        <a href="<?php echo filter_url(['min_price' => null, 'max_price' => null]); ?>" class="filter-label <?php echo (!$price_min && $price_max > 50000) ? 'active' : ''; ?>">All Prices</a>
                        <a href="<?php echo filter_url(['min_price' => 0, 'max_price' => 2000]); ?>" class="filter-label <?php echo ($price_max == 2000) ? 'active' : ''; ?>">Under 2,000 PKR</a>
                        <a href="<?php echo filter_url(['min_price' => 2000, 'max_price' => 5000]); ?>" class="filter-label <?php echo ($price_min == 2000) ? 'active' : ''; ?>">2,000 - 5,000 PKR</a>
                        <a href="<?php echo filter_url(['min_price' => 5000, 'max_price' => 10000]); ?>" class="filter-label <?php echo ($price_min == 5000) ? 'active' : ''; ?>">5,000 - 10,000 PKR</a>
                        <a href="<?php echo filter_url(['min_price' => 10000, 'max_price' => 100000]); ?>" class="filter-label <?php echo ($price_min == 10000) ? 'active' : ''; ?>">Above 10,000 PKR</a>
                    </div>
                </div>

                <div class="filter-group">
                    <h4>Skin Type</h4>
                    <div class="filter-options">
                        <a href="<?php echo filter_url(['skin_type' => null]); ?>" class="filter-label <?php echo !$skin_type_filter ? 'active' : ''; ?>">Any Skin Type</a>
                        <a href="<?php echo filter_url(['skin_type' => 'Oily']); ?>" class="filter-label <?php echo $skin_type_filter == 'Oily' ? 'active' : ''; ?>">Oily Skin</a>
                        <a href="<?php echo filter_url(['skin_type' => 'Dry']); ?>" class="filter-label <?php echo $skin_type_filter == 'Dry' ? 'active' : ''; ?>">Dry Skin</a>
                        <a href="<?php echo filter_url(['skin_type' => 'Combination']); ?>" class="filter-label <?php echo $skin_type_filter == 'Combination' ? 'active' : ''; ?>">Combination</a>
                    </div>
                </div>

                <div class="filter-promo">
                    <h5>Find Your Match</h5>
                    <p>Not sure what's right for you? Try our AI routine builder.</p>
                    <a href="routine-builder.php" class="btn">Start Analysis</a>
                </div>
            </aside>

            <!-- Product Listing -->
            <section class="product-listing">
                <div class="shop-results-header" data-aos="fade-down">
                    <div class="results-count">
                        Showing <span><?php echo $count; ?></span> Essential Selections
                    </div>
                    <div class="shop-sort">
                        <select class="sort-select" onchange="location.href=this.value">
                            <option value="<?php echo filter_url(['sort' => 'default']); ?>" <?php echo $sort == 'default' ? 'selected' : ''; ?>>Default Sorting</option>
                            <option value="<?php echo filter_url(['sort' => 'price_low']); ?>" <?php echo $sort == 'price_low' ? 'selected' : ''; ?>>Price: Low to High</option>
                            <option value="<?php echo filter_url(['sort' => 'price_high']); ?>" <?php echo $sort == 'price_high' ? 'selected' : ''; ?>>Price: High to Low</option>
                            <option value="<?php echo filter_url(['sort' => 'newest']); ?>" <?php echo $sort == 'newest' ? 'selected' : ''; ?>>Newest Arrivals</option>
                        </select>
                    </div>
                </div>

                <div class="product-grid">
                    <?php if ($count > 0): while($p = mysqli_fetch_assoc($result)): ?>
                    <article class="product-card" data-aos="fade-up">
                        <div class="product-img">
                            <a href="product.php?id=<?php echo $p['id']; ?>" class="img-wrapper">
                                <img src="<?php echo $p['image_url']; ?>" alt="<?php echo $p['name']; ?>" class="featured-img">
                            </a>
                            <form action="cart_action.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" name="add_to_cart" class="quick-add">Add to Bag +</button>
                            </form>
                        </div>
                        <div class="product-info">
                            <span class="product-cat"><?php echo $p['category']; ?> • <?php echo $p['gender']; ?></span>
                            <h3 class="product-name">
                                <a href="product.php?id=<?php echo $p['id']; ?>" style="text-decoration: none; color: inherit;"><?php echo $p['name']; ?></a>
                            </h3>
                            <p class="product-price"><?php echo number_format($p['price']); ?> PKR</p>
                        </div>
                    </article>
                    <?php endwhile; else: ?>
                    <div class="empty-results">
                        <h2>No matches found</h2>
                        <p>Try adjusting your filters to find your perfect ritual.</p>
                        <a href="shop.php" class="btn" style="border: 1px solid var(--primary); color: var(--primary);">Clear Filters</a>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

        </div>
    </div>
</main>

<style>
/* Local overrides for active states */
.filter-label.active { color: var(--primary); font-weight: 700; border-left: 2px solid var(--accent); padding-left: 20px; }
.filter-label { transition: all 0.3s ease; text-decoration: none; }
</style>

<?php include 'includes/footer.php'; ?>