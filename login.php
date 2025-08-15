<?php
// Include the master config file (it starts the session)
require_once 'Config/config.php';
$error = '';

// If user is already logged in, redirect them away from login page
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = dbConnect('main');

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Find user by email using a prepared statement
    $query = "SELECT id, fullname, email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // User found, now verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start the session
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["user_email"] = $user['email'];
            $_SESSION["user_fullname"] = $user['fullname'];

            // Redirect to home page
            header("Location: index.php");
            exit();
        } else {
            // Password incorrect
            $error = "The email or password you entered is incorrect.";
        }
    } else {
        // No user found with that email
        $error = "The email or password you entered is incorrect.";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cocktails</title>
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
                <span class="coffee-icon"><i class="fas fa-mug-hot"></i></span>
                <h1>Welcome Back</h1>
                <p>Sign in to continue your coffee journey.</p>
                <?php if ($error): ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
                <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                    <p class="success-message">Registration successful! Please log in.</p>
                <?php endif; ?>
            </div>
            <form id="login-form" method="post" action="login.php">
                <div class="input-group">
                    <i class="fas fa-at"></i>
                    <input type="email" id="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <button type="submit">Log In</button>
                <div class="card-footer">
                    <p>No account yet? <a href="register.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="Public/JS/style.js"></script>
</body>
</html>