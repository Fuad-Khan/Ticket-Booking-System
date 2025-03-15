<?php
require_once __DIR__ . '/../src/utils/Session.php';
require_once __DIR__ . '/../src/utils/Helpers.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

Session::start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = Helpers::sanitize($_POST['name']);
    $email = Helpers::sanitize($_POST['email']);
    $phone = Helpers::sanitize($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $error = AuthController::registerUser($name, $email, $phone, $password);
    }

    if (empty($error)) {
        Helpers::redirect('/login.php?registered=true');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($error)): ?>
            <p class="error"> <?= $error ?> </p>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" required>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
        <button class="btn-home" onclick="window.location.href='index.php';">Back to Home</button>
    </div>
</body>
</html>


