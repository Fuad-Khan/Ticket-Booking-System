

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Failed</title>
    <link rel="stylesheet" href="assets/css/booking_failed.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="failed-container">
        <div class="failed-card">
            <div class="failed-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            <h1>Booking Failed</h1>
            <p>There was an issue processing your booking. Please try again.</p>
            <div class="actions">
            <a href="payment.php" class="btn btn-primary">
                <i class="fas fa-credit-card"></i> Retry Payment
            </a>
                <a href="index.php" class="btn btn-secondary">
             <i class="fas fa-home"></i> Return to Homepage
             </a>
            </div>
        </div>
    </div>

    <script src="assets/js/booking_failed.js"></script>
</body>
</html>