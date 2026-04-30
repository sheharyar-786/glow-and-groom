<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Glow & Groom | Premium Beauty"; ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Main Styles -->
    <link rel="stylesheet" href="css/style.css?v=1.2">
    <?php if(isset($extraStyles)) echo $extraStyles; ?>
</head>
<body>
    <?php include_once 'includes/db.php'; ?>
    
    <header class="main-header">
        <nav class="container">
            <a href="index.php" class="logo">
                <img src="assets/images/logo (2).png" alt="Glow & Groom Logo" style="height: 90px; width: 90px; object-fit: cover; border-radius: 50%; mix-blend-mode: multiply; transition: var(--transition); filter: contrast(1.1); border: 1px solid rgba(0,0,0,0.05);">
            </a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="blog.php">Journal</a></li>
                <li><a href="routine-builder.php" class="highlight">Routine Builder</a></li>
            </ul>
            <div class="nav-icons">
                <a href="search.php" title="Search">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </a>
                <div class="account-links">
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'account.php' : 'auth.php'; ?>" title="Account">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </a>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="logout.php" class="header-logout" title="Logout">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </a>
                    <?php endif; ?>
                </div>
                <a href="cart.php" class="cart-trigger" title="Cart">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </nav>
    </header>
