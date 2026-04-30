<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Admin | Glow & Groom"; ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Main Styles -->
    <link rel="stylesheet" href="css/style.css?v=1.2">
    <link rel="stylesheet" href="css/admin.css?v=1.0">
</head>
<body class="admin-body">
    <?php include_once 'includes/db.php'; ?>
    
    <header class="admin-top-bar">
        <div class="container admin-nav-flex">
            <a href="admin_dashboard.php" class="admin-logo">
                <img src="assets/images/logo (2).png" alt="Logo">
                <span>Admin Portal</span>
            </a>
            
            <div class="admin-top-links">
                <span class="welcome-text">Welcome back, <strong>Admin</strong></span>
                <a href="auth.php?logout=1" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <style>
    .admin-top-bar { background: var(--primary); color: white; padding: 15px 0; border-bottom: 2px solid var(--accent); }
    .admin-nav-flex { display: flex; justify-content: space-between; align-items: center; }
    .admin-logo { display: flex; align-items: center; gap: 15px; text-decoration: none; color: white; }
    .admin-logo img { height: 40px; width: 40px; border-radius: 50%; filter: brightness(0) invert(1); }
    .admin-logo span { font-family: 'Playfair Display', serif; font-size: 20px; letter-spacing: 1px; }
    .admin-top-links { display: flex; align-items: center; gap: 30px; }
    .welcome-text { font-size: 13px; opacity: 0.8; }
    .logout-btn { background: var(--accent); color: white; padding: 8px 20px; border-radius: 50px; text-decoration: none; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; transition: var(--transition); }
    .logout-btn:hover { background: white; color: var(--primary); }
    .admin-body { background: #f8f9fa; }
    </style>
