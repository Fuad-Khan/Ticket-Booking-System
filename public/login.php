<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="auth-container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <p><a href="forgot-password.php">Forgot Password?</a></p>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        <button class="btn-home" onclick="window.location.href='index.php';">Back to Home</button>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
