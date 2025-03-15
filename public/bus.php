<?php
session_start();
// Before redirecting to login page
$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Set a flag to show the login message
    $login_message = "Please log in before checkout.";
} else {
    $login_message = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Tickets - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/bus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> <!-- Font Link -->
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <!-- Display login message if not logged in -->
    <?php if ($login_message): ?>
        <div class="login-message">
            <p class="message-text"><?= htmlspecialchars($login_message) ?></p>
            <a href="login.php" class="btn-login">Go to Login</a>
        </div>
    <?php endif; ?>

    <div class="hero">
        <h1>Bus Tickets</h1>
        <p>Book your bus tickets online.</p>
    </div>

    <!-- Your existing code for the bus listings -->
    <div class="search-form">
        <form action="bus.php" method="GET">
            <div class="form-group">
                <input type="text" name="source" placeholder="From City" 
                       value="<?= htmlspecialchars($_GET['source'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="destination" placeholder="To City" 
                       value="<?= htmlspecialchars($_GET['destination'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="date" name="date" 
                       value="<?= htmlspecialchars($_GET['date'] ?? date('Y-m-d')) ?>" 
                       min="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" class="btn-search">Search Buses</button>
        </form>
    </div>

    <div class="bus-listings">
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php elseif (!empty($buses)): ?>
            <?php foreach ($buses as $bus): ?>
                <div class="bus-card">
                    <div class="bus-info">
                        <h3><?= htmlspecialchars($bus['bus_name']) ?></h3>
                        <div class="route">
                            <span class="source"><?= htmlspecialchars($bus['source']) ?></span>
                            <span class="arrow">➔</span>
                            <span class="destination"><?= htmlspecialchars($bus['destination']) ?></span>
                        </div>
                        <div class="timing">
                            <span><?= date('h:i A', strtotime($bus['departure_time'])) ?></span> - 
                            <span><?= date('h:i A', strtotime($bus['arrival_time'])) ?></span>
                        </div>
                    </div>
                    <div class="bus-price">
                        <div class="price">৳<?= $bus['price'] ?></div>
                        <a href="book.php?schedule_id=<?= $bus['schedule_id'] ?>" class="btn-book">Book Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>

    <script src="assets/js/script.js"></script>
    <script>
        // Set minimum date for date picker
        document.querySelector('input[type="date"]').min = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>
