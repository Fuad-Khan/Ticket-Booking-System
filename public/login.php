<?php
session_start();
require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/utils/Session.php';
require_once __DIR__ . '/../src/utils/Helpers.php';
require_once __DIR__ . '/../src/models/User.php';

// Redirect to dashboard if user is already logged in
if (Session::has('user_id')) {
    Helpers::redirect('/dashboard.php');
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = Helpers::sanitize($_POST['email']);
    $password = $_POST['password'];

    $userModel = new User($pdo);
    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        Session::set('user_id', $user['user_id']);
        Helpers::redirect('/dashboard.php');
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

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
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>

    <script src="assets/js/script.js"></script>
</body>
</html>