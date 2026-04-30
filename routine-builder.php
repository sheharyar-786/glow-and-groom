<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Routine | Glow & Groom</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body class="quiz-body">

    <header class="quiz-header">
        <a href="index.php" class="back-home">← Back to Store</a>
        <div class="logo">GLOW & GROOM</div>
        <div class="progress-container">
            <div class="progress-bar" id="progress"></div>
        </div>
    </header>

    <main class="quiz-wrapper">
        <div class="quiz-step active" id="step1">
            <span class="step-count">Question 01</span>
            <h2>Who are we shopping for?</h2>
            <div class="options-grid">
                <button class="option-card" onclick="nextStep(2)">
                    <div class="icon">✨</div>
                    <h3>Women</h3>
                </button>
                <button class="option-card" onclick="nextStep(2)">
                    <div class="icon">🧔</div>
                    <h3>Men</h3>
                </button>
            </div>
        </div>

        <div class="quiz-step" id="step2">
            <span class="step-count">Question 02</span>
            <h2>How does your skin feel midday?</h2>
            <div class="options-grid">
                <button class="option-card" onclick="nextStep(3)">
                    <h3>Oily / Shiny</h3>
                    <p>Mostly on the forehead and nose.</p>
                </button>
                <button class="option-card" onclick="nextStep(3)">
                    <h3>Dry / Tight</h3>
                    <p>Feels flaky or needs moisture often.</p>
                </button>
                <button class="option-card" onclick="nextStep(3)">
                    <h3>Combination</h3>
                    <p>Oily in some spots, dry in others.</p>
                </button>
            </div>
        </div>

        <div class="quiz-step" id="step3">
            <div class="loader-content">
                <h2>Analyzing your skin type...</h2>
                <div class="spinner"></div>
            </div>
        </div>
    </main>

    <script src="js/quiz.js"></script>
</body>
</html>