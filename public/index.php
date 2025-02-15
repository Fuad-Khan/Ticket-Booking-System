<?php
// Start session and include database config
session_start();
require_once __DIR__ . '/../src/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Your Ticket - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="hero">
        <h1>Welcome to Take Your Ticket</h1>
        <p>Your one-stop solution for booking tickets online.</p>
    </div>

    <div class="services">
        <div class="service-card" onclick="window.location.href='bus.php'">
            <div class="icon">
                <i class="fas fa-bus"></i>
            </div>
            <h3>Bus Tickets</h3>
            <p>Book bus tickets for your next trip.</p>
        </div>

        <div class="service-card" onclick="window.location.href='train.php'">
            <div class="icon">
                <i class="fas fa-train"></i>
            </div>
            <h3>Train Tickets</h3>
            <p>Find and book train tickets easily.</p>
        </div>

        <div class="service-card" onclick="window.location.href='flight.php'">
            <div class="icon">
                <i class="fas fa-plane"></i>
            </div>
            <h3>Flight Tickets</h3>
            <p>Book domestic and international flights.</p>
        </div>

        <div class="service-card" onclick="window.location.href='movie.php'">
            <div class="icon">
                <i class="fas fa-film"></i>
            </div>
            <h3>Movie Tickets</h3>
            <p>Book tickets for the latest movies.</p>
        </div>

        <div class="service-card" onclick="window.location.href='event.php'">
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h3>Event Tickets</h3>
            <p>Get tickets for concerts, sports, and more.</p>
        </div>
    </div>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>

    <script src="assets/js/script.js"></script>
</body>
</html>