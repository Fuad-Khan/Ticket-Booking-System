<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Get user information from session
$user_name = $_SESSION['user_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>
    
    <div class="dashboard-container">
        <h2>Welcome, <?= htmlspecialchars($user_name) ?>!</h2>
        
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
 

        
        <!-- Main Navigation Links -->
        <div class="dashboard-links">
            <a href="my-bookings.php" class="btn-link">
                <i class="fas fa-ticket-alt"></i>
                <span>My Bookings</span>
            </a>
            <a href="profile.php" class="btn-link">
                <i class="fas fa-user-edit"></i>
                <span>Update Profile</span>
            </a>
            <a href="bus.php" class="btn-link">
                <i class="fas fa-bus"></i>
                <span>Book a Ticket</span>
            </a>
            <a href="logout.php" class="btn-link">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>
</body>
</html>