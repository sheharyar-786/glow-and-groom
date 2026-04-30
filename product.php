<?php 
include 'includes/frontend_guard.php';
include 'includes/db.php';

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;
$query = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header("Location: shop.php");
    exit();
}

// Handle Review Submission
$review_msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user_id = $_SESSION['user_id'];
    
    $ins = "INSERT INTO reviews (product_id, user_id, rating, comment) VALUES ('$id', '$user_id', '$rating', '$comment')";
    if (mysqli_query($conn, $ins)) {
        $review_msg = "<p class='success-msg'>Thank you for your review!</p>";
    }
}

$pageTitle = $product['name'] . " | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/product.css">';
include 'includes/header.php'; 
?>

<main class="product-page container">
    <div class="product-gallery">
        <div class="main-image">
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="thumb-grid">
            <img src="<?php echo $product['image_url']; ?>" class="thumb active">
            <img src="https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?q=80&w=300&h=300&auto=format&fit=crop" class="thumb">
        </div>
    </div>

    <div class="product-details">
        <nav class="breadcrumb">Shop / <?php echo $product['category']; ?> / <?php echo $product['gender']; ?></nav>
        <h1 class="product-title"><?php echo $product['name']; ?></h1>
        <span class="product-price"><?php echo number_format($product['price']); ?> PKR</span>
        
        <div class="product-description">
            <p><?php echo $product['description']; ?></p>
        </div>

        <form action="cart_action.php" method="POST" class="purchase-actions">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <div class="qty-selector">
                <button type="button" onclick="this.parentNode.querySelector('input').stepDown()">-</button>
                <input type="number" name="qty" value="1" min="1" max="10">
                <button type="button" onclick="this.parentNode.querySelector('input').stepUp()">+</button>
            </div>
            <button type="submit" class="add-to-cart-btn">Add to Bag</button>
        </form>

        <div class="info-accordion">
            <div class="accordion-item">
                <button class="accordion-header">Ingredients <span>+</span></button>
                <div class="accordion-content">
                    <p>Natural volcanic clay, charcoal, Vitamin E, and organic essential oils. Paraben-free and cruelty-free.</p>
                </div>
            </div>
            <div class="accordion-item">
                <button class="accordion-header">How to Use <span>+</span></button>
                <div class="accordion-content">
                    <p>Apply a small amount to damp skin, massage in circular motions, and rinse thoroughly. Use twice daily.</p>
                </div>
            </div>
        </div>

        <!-- Social Proof Section -->
        <section class="reviews-section" style="margin-top: 80px;">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; margin-bottom: 30px;">Customer Reviews</h2>
            
            <?php echo $review_msg; ?>

            <div class="reviews-list">
                <?php
                $rev_query = "SELECT r.*, u.first_name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = '$id' ORDER BY r.created_at DESC";
                $rev_res = mysqli_query($conn, $rev_query);
                if (mysqli_num_rows($rev_res) > 0):
                    while($rev = mysqli_fetch_assoc($rev_res)):
                ?>
                <div class="review-card" style="padding: 25px; background: #fafafa; border-radius: 12px; margin-bottom: 20px;">
                    <div class="review-top" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="font-size: 14px;"><?php echo $rev['first_name']; ?></strong>
                        <div class="stars" style="color: #d4a373;">
                            <?php for($i=0; $i<$rev['rating']; $i++) echo "★"; ?>
                        </div>
                    </div>
                    <p style="font-size: 14px; color: #666;"><?php echo $rev['comment']; ?></p>
                </div>
                <?php 
                    endwhile; 
                else:
                    echo "<p>No reviews yet. Be the first to share your thoughts!</p>";
                endif;
                ?>
            </div>

            <?php if(isset($_SESSION['user_id'])): ?>
            <div class="add-review" style="margin-top: 50px; background: #fff; padding: 30px; border: 1px solid #eee; border-radius: 15px;">
                <h3 style="font-family: 'Playfair Display', serif; margin-bottom: 20px;">Leave a Review</h3>
                <form action="product.php?id=<?php echo $id; ?>" method="POST">
                    <div class="input-group" style="margin-bottom: 20px;">
                        <label>Rating</label>
                        <select name="rating" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                            <option value="5">5 Stars - Amazing</option>
                            <option value="4">4 Stars - Very Good</option>
                            <option value="3">3 Stars - Good</option>
                            <option value="2">2 Stars - Fair</option>
                            <option value="1">1 Star - Poor</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Your Experience</label>
                        <textarea name="comment" required rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;" placeholder="What did you think about this product?"></textarea>
                    </div>
                    <button type="submit" class="send-btn" style="margin-top: 20px; width: 100%;">Submit Review</button>
                </form>
            </div>
            <?php else: ?>
            <p style="margin-top: 40px; text-align: center; font-size: 14px; color: #888;">Please <a href="auth.php" style="color: #d4a373; font-weight: 700;">login</a> to leave a review.</p>
            <?php endif; ?>
        </section>
    </div>
</main>

<script>
// Simple Accordion Toggle
document.querySelectorAll('.accordion-header').forEach(button => {
    button.addEventListener('click', () => {
        const item = button.parentElement;
        item.classList.toggle('active');
        const content = button.nextElementSibling;
        content.style.display = content.style.display === 'block' ? 'none' : 'block';
    });
});
</script>

<?php include 'includes/footer.php'; ?>
