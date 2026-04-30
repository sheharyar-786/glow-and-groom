<?php 
include 'includes/db.php';

$ids = isset($_GET['ids']) ? explode(',', mysqli_real_escape_string($conn, $_GET['ids'])) : [];
$products = [];

if (!empty($ids)) {
    $id_list = implode("','", $ids);
    $q = "SELECT * FROM products WHERE id IN ('$id_list')";
    $res = mysqli_query($conn, $q);
    while($p = mysqli_fetch_assoc($res)) {
        $products[] = $p;
    }
}

$pageTitle = "Compare Products | Glow & Groom";
include 'includes/header.php'; 
?>

<main class="compare-page container" style="padding: 100px 0;">
    <div class="section-header text-center" style="margin-bottom: 60px;">
        <h1 style="font-family: 'Playfair Display', serif; font-size: 48px;">Compare Selections</h1>
        <p style="color: #777; letter-spacing: 2px; text-transform: uppercase; font-size: 12px;">Finding the perfect match for your skin</p>
    </div>

    <?php if(!empty($products)): ?>
    <div class="compare-table-wrapper" style="overflow-x: auto;">
        <table class="compare-table" style="width: 100%; border-collapse: collapse; background: white; border-radius: 20px; overflow: hidden; box-shadow: var(--shadow);">
            <thead>
                <tr>
                    <th style="width: 200px; padding: 40px; background: #fafafa; text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 2px;">Features</th>
                    <?php foreach($products as $p): ?>
                    <th style="padding: 40px; text-align: center; min-width: 300px;">
                        <img src="<?php echo $p['image_url']; ?>" alt="" style="width: 150px; height: 150px; object-fit: cover; border-radius: 15px; margin-bottom: 20px;">
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 20px;"><?php echo $p['name']; ?></h3>
                    </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr style="border-top: 1px solid #eee;">
                    <td style="padding: 30px; font-weight: 700; color: var(--primary);">Price</td>
                    <?php foreach($products as $p): ?>
                    <td style="padding: 30px; text-align: center; font-size: 18px; font-weight: 600; color: var(--accent);"><?php echo number_format($p['price']); ?> PKR</td>
                    <?php endforeach; ?>
                </tr>
                <tr style="border-top: 1px solid #eee;">
                    <td style="padding: 30px; font-weight: 700; color: var(--primary);">Category</td>
                    <?php foreach($products as $p): ?>
                    <td style="padding: 30px; text-align: center;"><?php echo $p['category']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr style="border-top: 1px solid #eee;">
                    <td style="padding: 30px; font-weight: 700; color: var(--primary);">For</td>
                    <?php foreach($products as $p): ?>
                    <td style="padding: 30px; text-align: center;"><?php echo $p['gender']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr style="border-top: 1px solid #eee;">
                    <td style="padding: 30px; font-weight: 700; color: var(--primary);">Description</td>
                    <?php foreach($products as $p): ?>
                    <td style="padding: 30px; text-align: center; font-size: 14px; color: #777; line-height: 1.6;"><?php echo $p['description']; ?></td>
                    <?php endforeach; ?>
                </tr>
                <tr style="border-top: 1px solid #eee;">
                    <td></td>
                    <?php foreach($products as $p): ?>
                    <td style="padding: 40px; text-align: center;">
                        <a href="product.php?id=<?php echo $p['id']; ?>" class="btn" style="padding: 12px 30px; font-size: 11px;">View Full Details</a>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="empty-state text-center" style="padding: 80px 0;">
        <h2>Select products to compare</h2>
        <p style="color: #777; margin-bottom: 30px;">Choose items from the shop to see their features side-by-side.</p>
        <a href="shop.php" class="btn">Go to Shop</a>
    </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
