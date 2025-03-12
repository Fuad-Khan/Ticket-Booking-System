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
        <h2>Welcome, John Doe!</h2>
        <div class="dashboard-links">
            <a href="my-bookings.php" class="btn-link">My Bookings</a>
            <a href="profile.php" class="btn-link">Update Profile</a>
            <a href="logout.php" class="btn-link">Logout</a>
        </div>
    </div>

    <?php include __DIR__ . '/../src/views/footer_sub.php'; ?>
</body>
</html>