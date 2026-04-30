<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bag | Glow & Groom</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

    <main class="cart-page container">
        <div class="cart-header">
            <h1>Your Shopping Bag</h1>
            <p>2 Items in your cart</p>
        </div>

        <div class="cart-flex">
            <section class="cart-items">
                <div class="cart-item">
                    <div class="item-img">
                        <img src="https://via.placeholder.com/120x150" alt="Product">
                    </div>
                    <div class="item-details">
                        <div class="item-main">
                            <h3>Volcanic Clay Face Wash</h3>
                            <p class="item-meta">Category: Men's Skincare</p>
                        </div>
                        <div class="item-qty">
                            <button>-</button>
                            <span>1</span>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="item-price-remove">
                        <p class="price">1,250 PKR</p>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>

                <div class="cart-item">
                    <div class="item-img">
                        <img src="https://via.placeholder.com/120x150" alt="Product">
                    </div>
                    <div class="item-details">
                        <div class="item-main">
                            <h3>Vitamin C Glow Serum</h3>
                            <p class="item-meta">Category: Women's Treatment</p>
                        </div>
                        <div class="item-qty">
                            <button>-</button>
                            <span>1</span>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="item-price-remove">
                        <p class="price">2,200 PKR</p>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>
            </section>

            <aside class="cart-summary">
                <div class="summary-box">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>3,450 PKR</span>
                    </div>
                    <div class="summary-row">
                        <span>Estimated Shipping</span>
                        <span>250 PKR</span>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <span>3,700 PKR</span>
                    </div>
                    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
                    <p class="secure-text">🔒 Secure Checkout Guaranteed</p>
                </div>
            </aside>
        </div>
    </main>

</body>
</html>