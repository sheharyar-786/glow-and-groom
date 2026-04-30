<?php
// 1. Database Connection
include 'includes/db.php'; 

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get and Sanitize data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name  = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $skin_type  = mysqli_real_escape_string($conn, string: $_POST['skin_type']);
    $password   = $_POST['password'];

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    
    if (mysqli_num_rows($check) > 0) {
        $message = "<div class='alert error'>Email already exists!</div>";
    } else {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (first_name, last_name, email, password, skin_type) 
                  VALUES ('$first_name', '$last_name', '$email', '$hashed_pass', '$skin_type')";

        if (mysqli_query($conn, $query)) {
            // MAKE SURE YOUR LOGIN FILE IS NAMED auth.php
            header("Location: auth.php?signup=success");
            exit();
        } else {
            // This will tell us if the database rejected the data
            die("Database Error: " . mysqli_error($conn));
        }
    }
}

$pageTitle = "Create Your Account | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/auth.css">';
include 'includes/header.php';
?>

    <main class="auth-container">
        <div class="register-wrapper container">
            <div class="register-header text-center">
                <h2>Join the Club</h2>
            </div>

            <?php echo $message; ?>

            <form action="register-form.php" method="POST" class="pro-form mt-4">
                <div class="form-row">
                    <div class="input-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" required>
                    </div>
                    <div class="input-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" required>
                    </div>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <div class="input-group">
                    <label>Skin Type</label>
                    <select name="skin_type">
                        <option value="none">Choose...</option>
                        <option value="oily">Oily</option>
                        <option value="dry">Dry</option>
                    </select>
                </div>

                <button type="submit" class="auth-btn dark">Create Account</button>
            </form>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>