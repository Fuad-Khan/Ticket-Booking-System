<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/forgot-password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-container">
        <h2>Forgot Password</h2>
        <form action="forgot-password.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <button type="submit" class="btn-submit">Reset Password</button>
        </form>
        <p>Remember your password? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>