<?php 
include 'includes/admin_guard.php';
include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$message = "";

// Fetch current data
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $profile_image = mysqli_real_escape_string($conn, $_POST['profile_image']);
    $new_password = $_POST['new_password'];
    
    $update_query = "UPDATE users SET email = '$email', profile_image = '$profile_image'";
    
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query .= ", password = '$hashed_password'";
    }
    
    $update_query .= " WHERE id = '$user_id'";
    
    if (mysqli_query($conn, $update_query)) {
        $message = "<p class='success-msg'>Profile updated successfully.</p>";
        // Refresh data
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'"));
    } else {
        $message = "<p class='error-msg'>Error updating profile: " . mysqli_error($conn) . "</p>";
    }
}

$pageTitle = "My Profile | Glow & Groom Admin";
include 'includes/admin_header.php'; 
?>

<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="css/contact.css">

<main class="admin-container container">
    <aside class="admin-sidebar">
        <div class="admin-profile">
            <div class="admin-avatar">
                <?php if($user['profile_image']): ?>
                    <img src="<?php echo $user['profile_image']; ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                <?php else: ?>
                    A
                <?php endif; ?>
            </div>
            <h3>Administrator</h3>
            <p>Master Control</p>
        </div>
        <nav class="admin-nav">
            <a href="admin_dashboard.php">Overview</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_profile.php" class="active">Profile Settings</a>
            <a href="auth.php?logout=1" class="logout">Logout</a>
        </nav>
    </aside>

    <section class="admin-content">
        <div class="admin-header">
            <h1>Account Settings</h1>
            <p>Manage your administrative credentials and profile</p>
        </div>

        <?php echo $message; ?>

        <form action="admin_profile.php" method="POST" class="pro-form" style="max-width: 600px;">
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="input-group">
                <label>Profile Image URL</label>
                <input type="text" name="profile_image" value="<?php echo $user['profile_image']; ?>" placeholder="https://images.unsplash.com/...">
            </div>

            <div class="input-group">
                <label>New Password (Leave blank to keep current)</label>
                <input type="password" name="new_password" placeholder="••••••••">
            </div>

            <button type="submit" class="send-btn" style="width: 100%; margin-top: 30px;">Update Account</button>
        </form>
    </section>
</main>

<?php include 'includes/admin_footer.php'; ?>
