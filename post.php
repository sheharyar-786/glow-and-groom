<?php 
include 'includes/db.php';

$slug = isset($_GET['slug']) ? mysqli_real_escape_string($conn, $_GET['slug']) : '';
$query = "SELECT * FROM posts WHERE slug = '$slug'";
$result = mysqli_query($conn, $query);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    header("Location: blog.php");
    exit();
}

$pageTitle = $post['title'] . " | The Journal";
include 'includes/header.php'; 
?>

<main class="post-page container" style="padding: 100px 0; max-width: 900px;">
    <nav class="breadcrumb" style="margin-bottom: 40px; font-size: 11px; text-transform: uppercase; letter-spacing: 2px;">
        <a href="blog.php" style="text-decoration: none; color: var(--accent);">Journal</a> / Article
    </nav>

    <article class="post-content">
        <header class="post-header" style="margin-bottom: 60px;">
            <span style="color: var(--accent); font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 3px;">By <?php echo $post['author']; ?> • <?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
            <h1 style="font-family: 'Playfair Display', serif; font-size: 52px; margin: 20px 0; line-height: 1.2;"><?php echo $post['title']; ?></h1>
        </header>

        <div class="post-main-img" style="margin-bottom: 60px;">
            <img src="<?php echo $post['image_url']; ?>" alt="" style="width: 100%; border-radius: 20px; box-shadow: var(--shadow);">
        </div>

        <div class="post-body" style="font-size: 18px; line-height: 1.8; color: #444;">
            <?php echo nl2br($post['content']); ?>
            
            <p style="margin-top: 50px;">
                Our experts recommend consistent care for the best results. Explore our curated selections for 
                <a href="shop.php?gender=men" style="color: var(--accent); font-weight: 700;">Men</a> and 
                <a href="shop.php?gender=women" style="color: var(--accent); font-weight: 700;">Women</a> 
                to find the perfect products for your ritual.
            </p>
        </div>
    </article>

    <div class="post-footer" style="margin-top: 100px; padding-top: 60px; border-top: 1px solid #eee; text-align: center;">
        <h3 style="font-family: 'Playfair Display', serif; font-size: 28px; margin-bottom: 30px;">Continue Reading</h3>
        <a href="blog.php" class="btn">Back to Journal</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
