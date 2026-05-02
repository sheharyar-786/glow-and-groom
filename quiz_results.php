<?php 
include 'includes/db.php';

$gender = isset($_GET['gender']) ? mysqli_real_escape_string($conn, $_GET['gender']) : 'unisex';
// Smarter Recommendation Engine
$skin_type = isset($_GET['skin_type']) ? mysqli_real_escape_string($conn, $_GET['skin_type']) : 'Normal';
$concern = isset($_GET['concern']) ? mysqli_real_escape_string($conn, $_GET['concern']) : 'Hydration';

// Define categories for a complete ritual
$ritual_steps = [
    'Step 1: Cleanse' => 'Facial',
    'Step 2: Treat' => 'Serums',
    'Step 3: Nourish' => 'Facemask'
];

$recommended_products = [];

foreach ($ritual_steps as $step_name => $cat) {
    // Try to match skin type and gender
    // Priority: Specific skin type match -> 'All' skin type
    $query = "SELECT * FROM products 
              WHERE (gender = '$gender' OR gender = 'unisex') 
              AND category = '$cat' 
              AND (skin_type_match = '$skin_type' OR skin_type_match = 'All')";
    
    // Boost results matching the concern in description or name
    $query .= " ORDER BY (CASE WHEN description LIKE '%$concern%' OR name LIKE '%$concern%' THEN 1 ELSE 2 END) ASC, rand() LIMIT 1";
    
    $res = mysqli_query($conn, $query);
    if ($product = mysqli_fetch_assoc($res)) {
        $product['step_title'] = $step_name;
        $recommended_products[] = $product;
    }
}

$pageTitle = "Your Custom Ritual | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/results.css">';
include 'includes/header.php'; 
?>

<main class="results-page">
    <div class="container">
        <section class="results-intro" data-aos="fade-up">
            <span class="subtitle">Personalized Ritual Found</span>
            <h1>The <?php echo $skin_type; ?> Edit.</h1>
            <p>Based on your profile, we've curated a high-performance ritual focused on <strong><?php echo $concern; ?></strong>. These selections work in synergy to restore and protect your unique skin barrier.</p>
        </section>

        <div class="results-grid">
            <?php if(count($recommended_products) > 0): ?>
                <?php foreach($recommended_products as $product): ?>
                <article class="recommendation-card" data-aos="fade-up">
                    <div class="match-badge"><?php echo $product['step_title']; ?></div>
                    <div class="rec-img-wrapper">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="rec-info">
                        <span class="rec-cat"><?php echo $product['category']; ?> • <?php echo $product['skin_type_match']; ?></span>
                        <h3><?php echo $product['name']; ?></h3>
                        <p class="rec-price"><?php echo number_format($product['price']); ?> PKR</p>
                        <button class="rec-btn" onclick="window.location.href='cart_action.php?add=<?php echo $product['id']; ?>'">Add to My Routine</button>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-results" style="grid-column: span 3; text-align: center; padding: 100px; background: #f9f9f9; border-radius: 40px; border: 2px dashed #eee;">
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 15px;">A Unique Profile.</h3>
                    <p style="color: #888;">We are currently crafting more targeted solutions for your specific type. <br> Explore our <a href="shop.php" style="color: var(--accent); font-weight: 700;">Full Collection</a> for now.</p>
                </div>
            <?php endif; ?>
        </div>

        <section class="bundle-cta" data-aos="zoom-in">
            <div class="cta-inner">
                <h2>Consistency is your power.</h2>
                <p>Skincare is a marathon, not a sprint. Follow this ritual twice daily for 21 days to reveal your most radiant self. We've saved these results to your profile for easy access.</p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="shop.php" class="btn" style="background: white; color: var(--primary); padding: 18px 45px;">Explore All</a>
                    <a href="save_routine_action.php?skin_type=<?php echo $skin_type; ?>&concern=<?php echo $concern; ?>" class="btn" style="background: var(--accent); color: white; border: none; padding: 18px 45px;">Save Routine</a>
                </div>
            </div>
        </section>
    </div>
</main>

<div style="margin-bottom: 150px;"></div>

<?php include 'includes/footer.php'; ?>
