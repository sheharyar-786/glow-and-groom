<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volcanic Clay Face Wash | Glow & Groom</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
</head>
<body>

    <main class="product-page container">
        <div class="product-gallery">
            <div class="main-image">
                <img src="https://via.placeholder.com/600x700" id="current-img" alt="Product">
            </div>
            <div class="thumb-grid">
                <img src="https://via.placeholder.com/100" class="thumb active" onclick="changeImg(this.src)">
                <img src="https://via.placeholder.com/100" class="thumb" onclick="changeImg(this.src)">
                <img src="https://via.placeholder.com/100" class="thumb" onclick="changeImg(this.src)">
            </div>
        </div>

        <div class="product-details">
            <nav class="breadcrumb">Home / Men / Skincare</nav>
            <h1 class="product-title">Volcanic Clay Face Wash</h1>
            <p class="product-price">1,250 PKR</p>
            
            <div class="product-description">
                <p>Deeply detoxify your pores with our mineral-rich volcanic clay. Designed specifically for oily and combination skin to remove excess sebum without stripping moisture.</p>
            </div>

            <div class="purchase-actions">
                <div class="qty-selector">
                    <button onclick="updateQty(-1)">-</button>
                    <input type="number" value="1" id="qty" readonly>
                    <button onclick="updateQty(1)">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Bag — 1,250 PKR</button>
            </div>

            <div class="info-accordion">
                <div class="accordion-item">
                    <button class="accordion-header">How to Use <span>+</span></button>
                    <div class="accordion-content">Apply a pea-sized amount to damp skin. Massage in circular motions for 60 seconds. Rinse with lukewarm water.</div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-header">Key Ingredients <span>+</span></button>
                    <div class="accordion-content">Activated Charcoal, Kaolin Clay, Vitamin E, and Organic Aloe Vera.</div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/main.js"></script>
</body>
</html>