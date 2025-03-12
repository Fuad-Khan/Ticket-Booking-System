<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOnlineShop</title>
    <link rel="stylesheet" href="assets/css/header.css">

   
</head>
<body>

<!-- Header Section -->
<header>
    <div class="logo">
        <h1><a href="index.php">Take Your Ticket</a></h1>
    </div>

    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php"><i class="fas fa-user"></i> Dashboard</a>
            <a href="profile.php"><i class="fas fa-user"></i> Dashboard</a>
            <a href="#about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
            <a href="dashboard.php"><i class="fas fa-user"></i> Dashboard</a>
            <a href="#about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
        <?php endif; ?>
    </nav>
</header>

</body>
</html>