<?php
// src/controllers/BookingController.php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../model/Booking.php';
require_once __DIR__ . '/../model/Payment.php';
require_once __DIR__ . '/../utils/Helpers.php';
require_once __DIR__ . '/../utils/Session.php';

class BookingController {
    private $bookingModel;
    private $paymentModel;

    public function __construct() {
        $this->bookingModel = new Booking();
        $this->paymentModel = new Payment();
        Session::start();
    }

    // Create a new booking
    public function createBooking($userId, $scheduleId, $seatNumbers, $totalPrice) {
        try {
            // Validate inputs
            if (empty($userId) || empty($scheduleId) || empty($seatNumbers) || empty($totalPrice)) {
                throw new Exception("All fields are required");
            }

            // Create the booking
            $bookingId = $this->bookingModel->createBooking($userId, $scheduleId, $seatNumbers, $totalPrice);
            
            if (!$bookingId) {
                throw new Exception("Failed to create booking");
            }

            return $bookingId;
        } catch (Exception $e) {
            error_log("BookingController createBooking error: " . $e->getMessage());
            Session::set('booking_error', $e->getMessage());
            return false;
        }
    }

    // Get booking details
    public function getBookingDetails($bookingId) {
        try {
            if (empty($bookingId)) {
                throw new Exception("Booking ID is required");
            }

            $booking = $this->bookingModel->getBookingById($bookingId);
            
            if (!$booking) {
                throw new Exception("Booking not found");
            }

            return $booking;
        } catch (Exception $e) {
            error_log("BookingController getBookingDetails error: " . $e->getMessage());
            Session::set('booking_error', $e->getMessage());
            return false;
        }
    }

    // Get all bookings for a user
    public function getUserBookings($userId) {
        try {
            if (empty($userId)) {
                throw new Exception("User ID is required");
            }

            return $this->bookingModel->getUserBookings($userId);
        } catch (Exception $e) {
            error_log("BookingController getUserBookings error: " . $e->getMessage());
            Session::set('booking_error', $e->getMessage());
            return [];
        }
    }

    // Cancel a booking
    public function cancelBooking($bookingId, $userId) {
        try {
            if (empty($bookingId) || empty($userId)) {
                throw new Exception("Booking ID and User ID are required");
            }

            // Verify the booking belongs to the user
            $booking = $this->bookingModel->getBookingById($bookingId);
            if (!$booking || $booking['user_id'] != $userId) {
                throw new Exception("Booking not found or doesn't belong to you");
            }

            // Check if booking can be cancelled (not already cancelled or completed)
            if ($booking['booking_status'] == 'Cancelled') {
                throw new Exception("Booking is already cancelled");
            }

            // Update booking status
            $success = $this->bookingModel->updateBookingStatus($bookingId, 'Cancelled');
            
            if (!$success) {
                throw new Exception("Failed to cancel booking");
            }

            // If payment exists, mark it as failed
            $payment = $this->paymentModel->getPaymentByBookingId($bookingId);
            if ($payment) {
                $this->paymentModel->updatePaymentStatus($payment['payment_id'], 'Failed');
            }

            return true;
        } catch (Exception $e) {
            error_log("BookingController cancelBooking error: " . $e->getMessage());
            Session::set('booking_error', $e->getMessage());
            return false;
        }
    }

    // Admin: Get all bookings
    public function getAllBookings() {
        try {
            // Check if admin is logged in (you might want to add admin authentication)
            if (!Session::exists('admin_logged_in')) {
                throw new Exception("Unauthorized access");
            }

            return $this->bookingModel->getAllBookings();
        } catch (Exception $e) {
            error_log("BookingController getAllBookings error: " . $e->getMessage());
            Session::set('admin_error', $e->getMessage());
            return [];
        }
    }

    // Admin: Update booking status
    public function updateBookingStatus($bookingId, $status) {
        try {
            // Check if admin is logged in
            if (!Session::exists('admin_logged_in')) {
                throw new Exception("Unauthorized access");
            }

            if (empty($bookingId) || empty($status)) {
                throw new Exception("Booking ID and status are required");
            }

            $validStatuses = ['Pending', 'Confirmed', 'Cancelled'];
            if (!in_array($status, $validStatuses)) {
                throw new Exception("Invalid booking status");
            }

            $success = $this->bookingModel->updateBookingStatus($bookingId, $status);
            
            if (!$success) {
                throw new Exception("Failed to update booking status");
            }

            return true;
        } catch (Exception $e) {
            error_log("BookingController updateBookingStatus error: " . $e->getMessage());
            Session::set('admin_error', $e->getMessage());
            return false;
        }
    }
}
?>