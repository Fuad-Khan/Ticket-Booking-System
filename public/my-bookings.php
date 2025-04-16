<?php
// public/my-bookings.php

require_once __DIR__ . '/../src/config/bootstrap.php';
require_once __DIR__ . '/../src/controllers/BookingController.php';

// Start session and check authentication
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$bookingController = new BookingController();
$bookings = $bookingController->getUserBookings($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Bus Ticket System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .booking-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
            border-left: 5px solid;
        }

        .booking-card:hover {
            transform: translateY(-5px);
        }

        .status-confirmed {
            border-left-color: #28a745;
        }

        .status-cancelled {
            border-left-color: #dc3545;
        }

        .status-pending {
            border-left-color: #ffc107;
        }

        .seat-badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="bi bi-ticket-perforated"></i> My Bookings</h1>
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> New Booking
            </a>
        </div>

        <?php if (empty($bookings)): ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> You don't have any bookings yet.
                <a href="search.php" class="alert-link">Book a bus now</a>.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($bookings as $booking): ?>
                    <div class="col-md-6">
                        <div class="card booking-card status-<?php echo strtolower($booking['status']); ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">
                                            <i class="bi bi-bus-front"></i> <?php echo htmlspecialchars($booking['bus_name']); ?>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <i class="bi bi-clock"></i> <?php echo date('M j, Y g:i A', strtotime($booking['departure_time'])); ?>
                                        </h6>
                                    </div>
                                    <span class="badge bg-<?php
                                                            switch ($booking['status']) {
                                                                case 'Confirmed':
                                                                    echo 'success';
                                                                    break;
                                                                case 'Cancelled':
                                                                    echo 'danger';
                                                                    break;
                                                                default:
                                                                    echo 'warning';
                                                            }
                                                            ?>">
                                        <?php echo htmlspecialchars($booking['status']); ?>
                                    </span>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong><i class="bi bi-geo-alt"></i> Route:</strong></p>
                                        <p class="mb-1"><?php echo date('g:i A', strtotime($booking['departure_time'])); ?> Departure</p>
                                        <p class="mb-1"><?php echo date('g:i A', strtotime($booking['arrival_time'])); ?> Arrival</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1"><strong><i class="bi bi-calendar"></i> Booking Date:</strong>
                                            <?php echo date('M j, Y', strtotime($booking['booking_date'])); ?>
                                        </p>
                                        <p class="mb-1"><strong><i class="bi bi-currency-rupee"></i> Total Price:</strong>
                                            <?php echo number_format($booking['total_price'], 2); ?>
                                         Taka</p>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <p class="mb-1"><strong><i class="bi bi-person"></i> Passenger:</strong>
                                        <?php echo htmlspecialchars($booking['passenger_name']); ?>
                                        <small>(<?php echo htmlspecialchars($booking['passenger_gender']); ?>)</small>
                                    </p>
                                    <p class="mb-1"><strong><i class="bi bi-telephone"></i> Contact:</strong>
                                        <?php echo htmlspecialchars($booking['passenger_mobile']); ?>
                                    </p>
                                </div>

                                <div class="mt-3">
                                    <p class="mb-1"><strong><i class="bi bi-seat"></i> Seats:</strong></p>
                                    <div class="d-flex flex-wrap">
                                        <?php foreach (explode(',', $booking['seat_numbers']) as $seat): ?>
                                            <span class="badge bg-secondary seat-badge">Seat <?php echo $seat; ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="mt-3 d-flex justify-content-between">
                                    <a href="download_ticket.php?booking_id=<?= $booking['booking_id'] ?>"
                                        class="btn btn-sm btn-outline-primary" target="_blank">
                                        <i class="fas fa-print"></i> Download Ticket
                                    </a>

                                    <?php if ($booking['status'] == 'Pending' || $booking['status'] == 'Confirmed'): ?>
                                        <button class="btn btn-sm btn-outline-danger cancel-booking"
                                            data-booking-id="<?php echo $booking['booking_id']; ?>">
                                            <i class="bi bi-x-circle"></i> Cancel Booking
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Cancel Booking Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle"></i> Cancel Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel this booking?</p>
                    <div class="alert alert-warning">
                        <i class="bi bi-info-circle"></i> Cancellation fees may apply as per our policy.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Close
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmCancel">
                        <i class="bi bi-check-lg"></i> Yes, Cancel Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let bookingIdToCancel = null;

            // Set up cancel booking buttons
            document.querySelectorAll('.cancel-booking').forEach(button => {
                button.addEventListener('click', function() {
                    bookingIdToCancel = this.getAttribute('data-booking-id');
                    const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
                    modal.show();
                });
            });

            // Handle confirm cancel
            document.getElementById('confirmCancel').addEventListener('click', function() {
                if (bookingIdToCancel) {
                    fetch('cancel-booking.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'booking_id=' + bookingIdToCancel
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Failed to cancel booking: ' + (data.message || 'Unknown error'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while cancelling the booking');
                        });
                }
            });
        });
    </script>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>
</body>

</html>