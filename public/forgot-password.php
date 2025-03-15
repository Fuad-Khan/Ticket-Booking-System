<?php
require_once __DIR__ . '/../src/utils/Session.php';
require_once __DIR__ . '/../src/utils/Helpers.php';
require_once __DIR__ . '/../src/utils/Mailer.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = Helpers::sanitize($_POST['email']);
    
    // Call the recoverPassword method from the AuthController
    $message = AuthController::recoverPassword($email);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/css/forgot-password.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>

        <!-- Show success or error message -->
        <?php if (isset($message)): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Forgot password form -->
        <form method="POST" action="forgot-password.php">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">
            </div>

            <button type="submit" class="btn">Send Password Reset Link</button>
        </form>

        <p><a href="login.php">Back to Login</a></p>
    </div>
</body>
</html>
