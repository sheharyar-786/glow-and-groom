<?php
session_start();
include 'includes/db.php';

$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Glow & Groom | Premium Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body, html { height: 100%; margin: 0; overflow: hidden; }
        .welcome-screen {
            height: 100vh;
            width: 100%;
            background: linear-gradient(rgba(26, 42, 42, 0.85), rgba(26, 42, 42, 0.85)), url('assets/images/brand.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .welcome-content {
            max-width: 600px;
            padding: 40px;
            animation: fadeIn 1.5s ease-out;
        }
        .brand-logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: white;
            margin: 0 auto 30px;
            padding: 10px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-logo img {
            width: 80%;
            height: auto;
            border-radius: 50%;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }
        p {
            font-size: 14px;
            letter-spacing: 5px;
            text-transform: uppercase;
            opacity: 0.8;
            margin-bottom: 50px;
        }
        .enter-btn {
            display: inline-block;
            padding: 18px 50px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            border-radius: 50px;
            transition: var(--transition);
            box-shadow: 0 10px 30px rgba(212, 163, 115, 0.3);
            font-size: 12px;
        }
        .enter-btn:hover {
            transform: translateY(-5px) scale(1.05);
            background: white;
            color: var(--primary);
        }
        .user-status {
            margin-top: 30px;
            font-size: 14px;
            font-style: italic;
            opacity: 0.6;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="welcome-screen">
        <div class="welcome-content">
            <div class="brand-logo">
                <img src="assets/images/logo (2).png" alt="Glow & Groom">
            </div>
            
            <?php if($isLoggedIn): ?>
                <p>Welcome Back</p>
                <h1><?php echo $userName; ?></h1>
            <?php else: ?>
                <p>Premium Grooming & Beauty</p>
                <h1>Glow & Groom</h1>
            <?php endif; ?>

            <div style="margin-top: 20px;">
                <a href="index.php" class="enter-btn">Enter Experience</a>
            </div>

            <?php if(!$isLoggedIn): ?>
                <div class="user-status">
                    Not a member? <a href="auth.php" style="color: white; font-weight: 700;">Sign In</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
