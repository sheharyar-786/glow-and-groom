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
        <!-- Step 1: Gender -->
        <div class="quiz-step active" id="step1">
            <span class="step-count">Question 01</span>
            <h2>Who are we shopping for?</h2>
            <div class="options-grid">
                <button class="option-card" onclick="selectOption('gender', 'women', 2)">
                    <div class="icon">✨</div>
                    <h3>Women</h3>
                </button>
                <button class="option-card" onclick="selectOption('gender', 'men', 2)">
                    <div class="icon">🧔</div>
                    <h3>Men</h3>
                </button>
            </div>
        </div>

        <!-- Step 2: Skin Type -->
        <div class="quiz-step" id="step2">
            <span class="step-count">Question 02</span>
            <h2>How does your skin feel midday?</h2>
            <div class="options-grid">
                <button class="option-card" onclick="selectOption('skin_type', 'Oily', 3)">
                    <h3>Oily / Shiny</h3>
                    <p>Mostly on the forehead and nose.</p>
                </button>
                <button class="option-card" onclick="selectOption('skin_type', 'Dry', 3)">
                    <h3>Dry / Tight</h3>
                    <p>Feels flaky or needs moisture often.</p>
                </button>
                <button class="option-card" onclick="selectOption('skin_type', 'Combination', 3)">
                    <h3>Combination</h3>
                    <p>Oily in some spots, dry in others.</p>
                </button>
                <button class="option-card" onclick="selectOption('skin_type', 'Sensitive', 3)">
                    <h3>Sensitive</h3>
                    <p>Easily irritated or prone to redness.</p>
                </button>
            </div>
        </div>

        <!-- Step 3: Primary Concern -->
        <div class="quiz-step" id="step3">
            <span class="step-count">Question 03</span>
            <h2>What is your primary goal?</h2>
            <div class="options-grid">
                <button class="option-card" onclick="finishQuiz('Anti-Aging')">
                    <h3>Anti-Aging</h3>
                    <p>Reducing fine lines and wrinkles.</p>
                </button>
                <button class="option-card" onclick="finishQuiz('Brightening')">
                    <h3>Brightening</h3>
                    <p>Reducing dark spots and dullness.</p>
                </button>
                <button class="option-card" onclick="finishQuiz('Hydration')">
                    <h3>Hydration</h3>
                    <p>Deep moisture and barrier repair.</p>
                </button>
            </div>
        </div>

        <!-- Step 4: Loading -->
        <div class="quiz-step" id="step4">
            <div class="loader-content">
                <h2 id="status-text">Analyzing your skin profile...</h2>
                <div class="spinner"></div>
            </div>
        </div>
    </main>

    <script>
        let quizData = {
            gender: '',
            skin_type: '',
            concern: ''
        };

        function selectOption(key, value, next) {
            quizData[key] = value;
            showStep(next);
        }

        function showStep(step) {
            document.querySelectorAll('.quiz-step').forEach(el => el.classList.remove('active'));
            document.getElementById('step' + step).classList.add('active');
            let progress = (step / 4) * 100;
            document.getElementById('progress').style.width = progress + '%';
        }

        function finishQuiz(concern) {
            quizData.concern = concern;
            showStep(4);
            
            setTimeout(() => {
                document.getElementById('status-text').innerText = "Matching with curated products...";
            }, 1000);

            setTimeout(() => {
                const params = new URLSearchParams(quizData).toString();
                window.location.href = 'quiz_results.php?' + params;
            }, 2500);
        }
    </script>
</body>
</html>