

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Success</title>
    <link rel="stylesheet" href="assets/css/booking_success.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Booking Successful!</h1>
            <p>Your booking has been confirmed. Your reference number is:</p>
            <div class="booking-reference">
                <?php echo htmlspecialchars($bookingReference); ?>
            </div>
            <a href="index.php" class="btn btn-primary">
                <i class="fas fa-home"></i> Return to Homepage
            </a>
        </div>
    </div>
    <script src="assets/js/booking_success.js"></script>

</body>
</html>