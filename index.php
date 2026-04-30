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

    <section class="featured-products container">
        <div class="section-header" data-aos="fade-down">
            <h2>The Essentials</h2>
            <p>Curated for your daily ritual</p>
        </div>
        
        <div class="product-grid">
            <?php
            $featured_query = "SELECT * FROM products WHERE is_featured = 1 LIMIT 3";
            $featured_res = mysqli_query($conn, $featured_query);
            $delay = 0;
            while($product = mysqli_fetch_assoc($featured_res)):
            ?>
            <article class="product-card" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                <div class="product-img">
                    <a href="product.php?id=<?php echo $product['id']; ?>" class="img-wrapper">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="featured-img">
                    </a>
                    <button class="quick-add">Add to Bag +</button>
                </div>
                <div class="product-info">
                    <span class="product-cat"><?php echo $product['gender']; ?> • <?php echo $product['category']; ?></span>
                    <h3 class="product-name"><a href="product.php?id=<?php echo $product['id']; ?>" style="text-decoration: none; color: inherit;"><?php echo $product['name']; ?></a></h3>
                    <p class="product-price"><?php echo number_format($product['price']); ?> PKR</p>
                </div>
            </article>
            <?php 
            $delay += 200;
            endwhile; 
            ?>
        </div>
    </section>

    <section class="routine-cta">
        <div class="container">
            <div class="cta-content" data-aos="fade-right">
                <h2>Built for You.</h2>
                <p>Our AI-powered routine builder analyzes your skin type and concerns to create a personalized care plan that actually works.</p>
                <a href="routine-builder.php" class="btn">Build My Routine</a>
            </div>
            <div class="cta-image" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?q=80&w=800&auto=format&fit=crop" alt="Skincare">
            </div>
        </div>
    </section>

<section class="brand-ritual-section" style="background: linear-gradient(rgba(26, 42, 42, 0.4), rgba(26, 42, 42, 0.4)), url('assets/icons/background scroll.png'); background-attachment: fixed; background-size: cover; background-position: center; padding: 200px 0; color: white; text-align: center;">
    <div class="container" data-aos="zoom-in">
        <div class="ritual-content" style="max-width: 800px; margin: 0 auto; background: rgba(0,0,0,0.3); backdrop-filter: blur(20px); padding: 80px 40px; border-radius: 40px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 40px 100px rgba(0,0,0,0.5);">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 56px; margin-bottom: 25px; letter-spacing: 1px;">Timeless Beauty.</h2>
            <p style="font-size: 20px; line-height: 1.8; opacity: 0.9; margin-bottom: 45px; font-weight: 300;">Discover the intersection of ancient rituals and modern science. Our curated collections are designed to bring out your natural radiance, one ritual at a time.</p>
            <a href="shop.php" class="btn" style="padding: 18px 50px; font-size: 13px;">Experience the Collection</a>
        </div>
    </div>
</section>

<?php 
include 'includes/footer.php'; 
?>