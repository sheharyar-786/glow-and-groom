<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout | Glow & Groom</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>

    <header class="checkout-header">
        <div class="container flex-center">
            <div class="logo">GLOW & GROOM</div>
            <div class="secure-badge">🔒 Secure Checkout</div>
        </div>
    </header>

    <main class="checkout-container container">
        <div class="checkout-forms">
            <section class="checkout-step">
                <h3>1. Shipping Information</h3>
                <div class="form-grid">
                    <input type="text" placeholder="First Name" class="input-half">
                    <input type="text" placeholder="Last Name" class="input-half">
                    <input type="email" placeholder="Email Address" class="input-full">
                    <input type="text" placeholder="Street Address" class="input-full">
                    <input type="text" placeholder="City" class="input-half">
                    <input type="text" placeholder="Postal Code" class="input-half">
                    <input type="tel" placeholder="Phone Number (for Courier)" class="input-full">
                </div>
            </section>

            <section class="checkout-step">
                <h3>2. Payment Method</h3>
                <div class="payment-options">
                    <label class="payment-card active">
                        <input type="radio" name="payment" checked>
                        <span>Cash on Delivery (COD)</span>
                    </label>
                    <label class="payment-card">
                        <input type="radio" name="payment">
                        <span>Card Payment / JazzCash</span>
                    </label>
                </div>
            </section>

            <button class="complete-order-btn">Complete Purchase</button>
        </div>

        <aside class="order-review">
            <div class="review-box">
                <h3>Order Review</h3>
                <div class="review-items">
                    <div class="review-item">
                        <img src="https://via.placeholder.com/50x60" alt="Product">
                        <div class="item-text">
                            <p>Volcanic Clay Face Wash</p>
                            <span>Qty: 1</span>
                        </div>
                        <p class="item-total">1,250 PKR</p>
                    </div>
                </div>
                <div class="review-calc">
                    <div class="row"><span>Subtotal</span><span>3,450 PKR</span></div>
                    <div class="row"><span>Shipping</span><span>250 PKR</span></div>
                    <div class="row total"><span>Total</span><span>3,700 PKR</span></div>
                </div>
            </div>
        </aside>
    </main>

</body>
</html>