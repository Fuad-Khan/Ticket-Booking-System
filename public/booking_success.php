<?php
session_start();

// Check if booking data exists
if (!isset($_SESSION['booking_data'])) {
    $_SESSION['error'] = 'No booking data found. Please complete the booking process.';
    header("Location: booking_confirm.php");
    exit();
}

// Get booking data from session
$booking_data = $_SESSION['booking_data'];

// Calculate departure date and time
$departure_time = strtotime($booking_data['schedule']['departure_time']);
$departure_date = date('M d, Y', $departure_time);
$departure_time_formatted = date('h:i A', $departure_time);

// Calculate total price with formatting
$total_price = number_format($booking_data['total_price'], 2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="assets/css/booking_success.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .confirmation-header {
            color: #2ecc71;
            text-align: center;
            margin-bottom: 2rem;
        }

        .booking-details {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }

        .btn-container {
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s;
            margin: 0 0.5rem;
        }

        .btn:hover {
            background: #2980b9;
        }

        .btn-download {
            background: #2ecc71;
        }

        .btn-download:hover {
            background: #27ae60;
        }

        .ticket-icon {
            font-size: 3rem;
            color: #2ecc71;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="confirmation-container">
        <div class="ticket-icon">
            <i class="fas fa-ticket-alt"></i>
        </div>
        <h1 class="confirmation-header">Booking Confirmed!</h1>

        <div class="booking-details">
            <div class="detail-row">
                <span class="detail-label">Booking Reference:</span>
                <span>#<?= htmlspecialchars($booking_data['booking_id']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Passenger Name:</span>
                <span><?= htmlspecialchars($booking_data['passenger']['first_name']) ?> <?= htmlspecialchars($booking_data['passenger']['last_name']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Contact Number:</span>
                <span><?= htmlspecialchars($booking_data['passenger']['mobile']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Bus Name:</span>
                <span><?= htmlspecialchars($booking_data['bus']['bus_name']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Route:</span>
                <span><?= htmlspecialchars($booking_data['schedule']['source']) ?> to <?= htmlspecialchars($booking_data['schedule']['destination']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Departure Date:</span>
                <span><?= $departure_date ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Departure Time:</span>
                <span><?= $departure_time_formatted ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Seat Numbers:</span>
                <span><?= htmlspecialchars(implode(', ', $booking_data['seats'])) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Paid:</span>
                <span><?= $total_price ?> Taka</span>
            </div>
        </div>

        <div class="btn-container">
            <a href="my-bookings.php" class="btn">View My Bookings</a>
            <a href="download_ticket.php?booking_id=<?= $booking_data['booking_id'] ?>" class="btn" target="_blank">
                <i class="fas fa-download"></i> Download Ticket
            </a>
        </div>
    </div>

    <?php
    // Clear booking data from session after displaying
    unset($_SESSION['booking_data']);
    include __DIR__ . '/../src/views/footer.php';
    ?>
</body>

</html>