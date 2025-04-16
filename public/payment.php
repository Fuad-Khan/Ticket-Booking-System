<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Check if booking data exists
if (!isset($_SESSION['booking_data'])) {
    header("Location: index.php");
    exit();
}

// Get booking data from session
$booking_data = $_SESSION['booking_data'];
$selected_seats = explode(',', $booking_data['seats']);
$schedule_id = $booking_data['schedule_id'];
$passenger_data = $booking_data['passenger_data'];

// Get schedule and bus details
require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/model/Schedule.php';
require_once __DIR__ . '/../src/model/Bus.php';

$scheduleModel = new Schedule();
$busModel = new Bus();

$schedule = $scheduleModel->getScheduleById($schedule_id);
$bus = $busModel->getBusById($schedule['bus_id']);

// Calculate total amount
$seat_price = $bus['seat_price'];
$total_amount = count($selected_seats) * $seat_price;

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process payment (this would normally connect to a payment gateway)
    
    // For demo purposes, we'll just validate the card details
    $errors = [];
    
    // Validate card number
    if (empty($_POST['card_number']) || !preg_match('/^\d{16}$/', str_replace(' ', '', $_POST['card_number']))) {
        $errors[] = "Please enter a valid 16-digit card number";
    }
    
    // Validate expiry date
    if (empty($_POST['expiry_date']) || !preg_match('/^(0[1-9]|1[0-2])\/?([0-9]{2})$/', $_POST['expiry_date'])) {
        $errors[] = "Please enter a valid expiry date in MM/YY format";
    }
    
    // Validate CVV
    if (empty($_POST['cvv']) || !preg_match('/^\d{3,4}$/', $_POST['cvv'])) {
        $errors[] = "Please enter a valid CVV (3 or 4 digits)";
    }
    
    // Validate card holder name
    if (empty($_POST['card_holder'])) {
        $errors[] = "Please enter the card holder name";
    }
    
    if (empty($errors)) {
        // Payment successful - redirect to booking success
        $_SESSION['payment_success'] = true;
        header("Location: booking_success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="assets/css/payment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="payment-container">
        <div class="payment-summary">
            <h2>Booking Summary</h2>
            <div class="summary-item">
                <span>Bus:</span>
                <span><?= htmlspecialchars($bus['bus_name']) ?></span>
            </div>
            <div class="summary-item">
                <span>Route:</span>
                <span><?= htmlspecialchars($booking_data['source']) ?> to <?= htmlspecialchars($booking_data['destination']) ?></span>
            </div>
            <div class="summary-item">
                <span>Departure:</span>
                <span><?= date('M d, Y h:i A', strtotime($schedule['departure_time'])) ?></span>
            </div>
            <div class="summary-item">
                <span>Selected Seats:</span>
                <span><?= implode(', ', $selected_seats) ?></span>
            </div>
            <div class="summary-item">
                <span>Passenger:</span>
                <span><?= htmlspecialchars($passenger_data['first_name'] . ' ' . $passenger_data['last_name']) ?></span>
            </div>
            <div class="summary-item total">
                <span>Total Amount:</span>
                <span>₹<?= number_format($total_amount, 2) ?></span>
            </div>
        </div>

        <div class="payment-card">
            <h1>Payment Information</h1>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form action="payment.php" method="POST">
                <div class="form-group">
                    <label for="card_number">Card Number*</label>
                    <input type="text" id="card_number" name="card_number" 
                           placeholder="1234 5678 9012 3456" 
                           pattern="\d{16}" 
                           title="16-digit card number" 
                           required>
                    <div class="card-icons">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-amex"></i>
                        <i class="fab fa-cc-discover"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="card_holder">Card Holder Name*</label>
                    <input type="text" id="card_holder" name="card_holder" 
                           placeholder="Name on card" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date*</label>
                        <input type="text" id="expiry_date" name="expiry_date" 
                               placeholder="MM/YY" 
                               pattern="(0[1-9]|1[0-2])\/([0-9]{2})" 
                               title="MM/YY format" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV*</label>
                        <input type="text" id="cvv" name="cvv" 
                               placeholder="123" 
                               pattern="\d{3,4}" 
                               title="3 or 4-digit CVV" 
                               required>
                        <i class="fas fa-question-circle" title="3 or 4-digit code on back of card"></i>
                    </div>
                </div>

                <button type="submit" class="btn-pay">Pay ₹<?= number_format($total_amount, 2) ?></button>
            </form>
            
            <div class="secure-payment">
                <i class="fas fa-lock"></i>
                <span>Secure Payment</span>
                <p>Your payment information is encrypted and secure.</p>
            </div>
        </div>
    </div>
    
    <?php include __DIR__ . '/../src/views/footer.php'; ?>
    
    <script>
        // Format card number input
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '');
            if (value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            e.target.value = value;
        });
        
        // Format expiry date input
        document.getElementById('expiry_date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    </script>
</body>

</html>