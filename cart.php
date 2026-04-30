<?php 
include 'includes/db.php';
include 'includes/auth_guard.php';

$user_id = $_SESSION['user_id'];

// Fetch Cart Items
$query = "SELECT c.id as cart_id, c.quantity, p.* FROM cart c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = '$user_id'";
$result = mysqli_query($conn, $query);

$subtotal = 0;

$pageTitle = "Your Shopping Bag | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/cart.css">';
include 'includes/header.php'; 
?>

<main class="cart-page container">
    <div class="cart-header" data-aos="fade-down">
        <h1>Shopping Bag</h1>
        <p>Review your selections before checkout</p>
    </div>

    <?php if(mysqli_num_rows($result) > 0): ?>
    <div class="cart-flex">
        <div class="cart-items" data-aos="fade-right">
            <?php while($item = mysqli_fetch_assoc($result)): 
                $item_total = $item['price'] * $item['quantity'];
                $subtotal += $item_total;
            ?>
            <div class="cart-item">
                <div class="item-img">
                    <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['name']; ?>">
                </div>
                <div class="item-details">
                    <div class="item-main">
                        <h3><?php echo $item['name']; ?></h3>
                        <p class="item-meta"><?php echo $item['category']; ?> • <?php echo $item['gender']; ?></p>
                    </div>
                    <div class="item-qty">
                        Quantity: <?php echo $item['quantity']; ?>
                    </div>
                </div>
                <div class="item-price-remove">
                    <p class="price"><?php echo number_format($item_total); ?> PKR</p>
                    <a href="cart_action.php?remove=<?php echo $item['cart_id']; ?>" class="remove-btn">Remove Item</a>
                </div>
            </div>
            <?php endwhile; ?>
            
            <div class="cart-footer-actions">
                <a href="shop.php" class="btn-text">← Continue Shopping</a>
                <a href="cart_action.php?clear=1" class="btn-text" style="color: #999;">Clear Shopping Bag</a>
            </div>
        </div>

        <aside class="cart-summary" data-aos="fade-left">
            <div class="summary-box">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span><?php echo number_format($subtotal); ?> PKR</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Calculated at next step</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span><?php echo number_format($subtotal); ?> PKR</span>
                </div>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
                <p class="secure-text">🔒 Secure Checkout Guaranteed</p>
            </div>
        </aside>
    </div>
    <?php else: ?>
    <div class="empty-cart" data-aos="zoom-in">
        <div class="icon">🛍️</div>
        <h2>Your bag is empty</h2>
        <p>Looks like you haven't added anything to your collection yet.</p>
        <a href="shop.php" class="btn">Explore the Collection</a>
    </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>