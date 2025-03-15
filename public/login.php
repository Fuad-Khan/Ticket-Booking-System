<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen

require_once __DIR__ . '/../src/utils/Session.php';
require_once __DIR__ . '/../src/utils/Helpers.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $emailOrPhone = Helpers::sanitize($_POST['email_or_phone']); 
    $password = $_POST['password'];

    $loginMessage = AuthController::loginUser($emailOrPhone, $password); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bus Ticket Booking</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($loginMessage)) : ?>
            <p class="error-message"><?php echo $loginMessage; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
    <label for="email_or_phone">Email or Phone:</label>
    <input type="text" id="email_or_phone" name="email_or_phone" required> 

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
</form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
        <p><a href="forgot-password.php">Forgot Password?</a></p>
        <button class="btn-home" onclick="window.location.href='index.php';">Back to Home</button>
    </div>
</body>
</html>



