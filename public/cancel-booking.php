<?php
// public/cancel-booking.php

require_once __DIR__ . '/../src/config/bootstrap.php';
require_once __DIR__ . '/../src/controllers/BookingController.php';

session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Authentication required']);
    exit();
}

// Check if it's a POST request with booking_id
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['booking_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$bookingController = new BookingController();
$booking_id = (int)$_POST['booking_id'];

// Verify the booking exists and belongs to the user
$booking = $bookingController->getBookingById($booking_id);
if (!$booking || $booking['user_id'] != $_SESSION['user_id']) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Booking not found or access denied']);
    exit();
}

// Check if booking can be cancelled (only Pending or Confirmed status)
if (!in_array($booking['status'], ['Pending', 'Confirmed'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Booking cannot be cancelled']);
    exit();
}

// Attempt to cancel the booking
try {
    $success = $bookingController->cancelBooking($booking_id);
    
    if ($success) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Booking cancelled successfully',
            'status' => 'Cancelled'
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Failed to cancel booking']);
    }
} catch (Exception $e) {
    error_log('Cancellation error: ' . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'An error occurred during cancellation']);
}