<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/my-bookings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php include __DIR__ . '/../src/views/header.php'; ?>
    <div class="bookings-container">
        <h2>My Bookings</h2>
        <div class="booking-card">
            <p><strong>Bus Name:</strong> Green Line</p>
            <p><strong>Route:</strong> Dhaka to Chittagong</p>
            <p><strong>Departure Time:</strong> 08:00 AM, 2023-12-01</p>
            <p><strong>Seats:</strong> A1, A2</p>
            <p><strong>Status:</strong> Confirmed</p>
        </div>
    </div>

 <?php include __DIR__ . '/../src/views/footer_sub.php'; ?>
</body>
</html>