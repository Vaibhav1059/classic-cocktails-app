<?php
// Include the master config file
require_once 'Config/config.php';
$error = '';
$success = '';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the main database
    $conn = dbConnect('main');

    // Get form data and sanitize it
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);

    // --- Validation ---
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Check if email already exists
        $checkEmailQuery = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $checkEmailQuery);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = "An account with this email already exists.";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user using prepared statements to prevent SQL injection
            $insertQuery = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $hashed_password);

            if (mysqli_stmt_execute($stmt)) {
                // On success, redirect to the login page
                header("Location: login.php?status=success");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cocktails</title>
    <link rel="stylesheet" href="Public/CSS/login-register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="Public/Images/log.jpeg" sizes="16x16" >
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <span class="coffee-icon"><i class="fas fa-feather-alt"></i></span>
                <h1>Create Account</h1>
                <p>Join our club to get the best coffee experience.</p>
                <?php if ($error): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
            <form id="register-form" method="post" action="register.php">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-at"></i>
                    <input type="email" id="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <div class="input-group">
                    <i class="fas fa-check-circle"></i>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <button type="submit">Sign Up</button>
                <div class="card-footer">
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="Public/JS/style.js"></script>
</body>
</html>