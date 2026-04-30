<?php 
include 'includes/frontend_guard.php';
include 'includes/db.php';
$pageTitle = "Glow & Groom | Premium Beauty for Men & Women";
include 'includes/header.php'; 
?>

    <section class="hero">
        <div class="hero-split women" data-aos="fade-right">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2 data-aos="zoom-out" data-aos-delay="300">Glow</h2>
                <p data-aos="fade-up" data-aos-delay="500">Radiance defined for her.</p>
                <a href="shop.php?gender=women" class="btn" data-aos="fade-up" data-aos-delay="700">Shop Women</a>
            </div>
        </div>
        <div class="hero-split men" data-aos="fade-left">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h2 data-aos="zoom-out" data-aos-delay="400">Groom</h2>
                <p data-aos="fade-up" data-aos-delay="600">Precision care for him.</p>
                <a href="shop.php?gender=men" class="btn" data-aos="fade-up" data-aos-delay="800">Shop Men</a>
            </div>
        </div>
    </section>

    <section class="featured-products container" style="padding: 60px 0;">
        <div class="section-header text-center" style="margin-bottom: 60px;">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 42px; margin-bottom: 15px;">The Essentials</h2>
            <p style="color: #777; letter-spacing: 2px; text-transform: uppercase; font-size: 12px;">Curated for your daily ritual</p>
        </div>
        
        <div class="product-grid">
            <?php
            $featured_query = "SELECT * FROM products WHERE is_featured = 1 LIMIT 3";
            $featured_res = mysqli_query($conn, $featured_query);
            $delay = 0;
            while($product = mysqli_fetch_assoc($featured_res)):
            ?>
            <div class="product-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <div class="product-img">
                    <a href="product.php?id=<?php echo $product['id']; ?>">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" style="max-width: 100%; height: auto;">
                    </a>
                    <button class="quick-add">Add to Bag +</button>
                </div>
                <div class="product-info">
                    <span class="product-cat"><?php echo $product['gender']; ?> • <?php echo $product['category']; ?></span>
                    <h3 class="product-name"><a href="product.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: inherit;"><?php echo $product['name']; ?></a></h3>
                    <p class="product-price"><?php echo number_format($product['price']); ?> PKR</p>
                </div>
            </div>
            <?php 
            $delay += 200;
            endwhile; 
            ?>
        </div>
    </section>

    <section class="routine-cta" style="background: var(--primary); color: white; padding: 100px 0; position: relative; overflow: hidden;">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 2;">
            <div style="max-width: 500px;">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 50px; margin-bottom: 20px;">Built for You.</h2>
                <p style="font-size: 16px; opacity: 0.8; margin-bottom: 40px; line-height: 1.8;">Our AI-powered routine builder analyzes your skin type and concerns to create a personalized care plan that actually works.</p>
                <a href="routine-builder.php" class="btn">Build My Routine</a>
            </div>
            <div class="cta-image" style="width: 45%;" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?q=80&w=800&auto=format&fit=crop" alt="Skincare" style="width: 100%; border-radius: 20px; box-shadow: 0 30px 60px rgba(0,0,0,0.3);">
            </div>
        </div>
        <div style="position: absolute; top: -50%; right: -10%; width: 50%; height: 200%; background: radial-gradient(circle, rgba(212, 163, 115, 0.15) 0%, transparent 70%); z-index: 1;"></div>
    </section>

<?php 
include 'includes/footer.php'; 
?>