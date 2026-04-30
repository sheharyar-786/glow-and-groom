<?php 
include 'includes/db.php';

$pageTitle = "The Journal | Glow & Groom Skincare Guide";
$extraStyles = '<link rel="stylesheet" href="css/shop.css">'; // Reusing grid styles
include 'includes/header.php'; 
?>

<main class="blog-container container" style="padding: 100px 0;">
    <div class="section-header text-center" style="margin-bottom: 80px;">
        <h1 style="font-family: 'Playfair Display', serif; font-size: 56px; margin-bottom: 20px;">The Journal</h1>
        <p style="color: #777; letter-spacing: 2px; text-transform: uppercase; font-size: 14px;">Expert advice, skincare secrets, and grooming rituals.</p>
    </div>

    <div class="product-grid"> <!-- Reusing grid for blog cards -->
        <?php
        $res = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");
        while($post = mysqli_fetch_assoc($res)):
        ?>
        <article class="product-card shimmer" style="animation: revealUp 1s forwards;">
            <div class="product-img" style="aspect-ratio: 16/9;">
                <a href="post.php?slug=<?php echo $post['slug']; ?>">
                    <img src="<?php echo $post['image_url']; ?>" alt="<?php echo $post['title']; ?>">
                </a>
            </div>
            <div class="product-info" style="text-align: left; padding: 30px 0;">
                <span class="product-cat" style="color: var(--accent);"><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                <h2 class="product-name" style="font-size: 24px; margin: 15px 0;">
                    <a href="post.php?slug=<?php echo $post['slug']; ?>" style="text-decoration: none; color: inherit;"><?php echo $post['title']; ?></a>
                </h2>
                <p style="font-size: 14px; color: #777; line-height: 1.6; margin-bottom: 20px;">
                    <?php echo substr($post['content'], 0, 100); ?>...
                </p>
                <a href="post.php?slug=<?php echo $post['slug']; ?>" class="btn-text">Read More →</a>
            </div>
        </article>
        <?php endwhile; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
