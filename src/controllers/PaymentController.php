<?php
// src/controllers/PaymentController.php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../model/Payment.php';
require_once __DIR__ . '/../model/Booking.php';
require_once __DIR__ . '/../utils/Helpers.php';
require_once __DIR__ . '/../utils/Session.php';

class PaymentController {
    private $paymentModel;
    private $bookingModel;

    public function __construct() {
        $this->paymentModel = new Payment();
        $this->bookingModel = new Booking();
        Session::start();
    }

    // Process payment for a booking
    public function processPayment($bookingId, $amount, $paymentMethod, $transactionId = null) {
        try {
            // Validate inputs
            if (empty($bookingId) || empty($amount) || empty($paymentMethod)) {
                throw new Exception("All payment fields are required");
            }

            // Verify the booking exists
            $booking = $this->bookingModel->getBookingById($bookingId);
            if (!$booking) {
                throw new Exception("Booking not found");
            }

            // Check if payment already exists for this booking
            $existingPayment = $this->paymentModel->getPaymentByBookingId($bookingId);
            if ($existingPayment) {
                throw new Exception("Payment already exists for this booking");
            }

            // Create payment record
            $paymentId = $this->paymentModel->createPayment($bookingId, $amount, $paymentMethod, $transactionId);
            
            if (!$paymentId) {
                throw new Exception("Failed to create payment record");
            }

            // If payment is successful immediately (like cash), update status
            if ($paymentMethod == 'Cash') {
                $this->paymentModel->updatePaymentStatus($paymentId, 'Completed');
                $this->bookingModel->updateBookingStatus($bookingId, 'Confirmed');
            }

            return $paymentId;
        } catch (Exception $e) {
            error_log("PaymentController processPayment error: " . $e->getMessage());
            Session::set('payment_error', $e->getMessage());
            return false;
        }
    }

    // Update payment status (for online payments callback)
    public function updatePaymentStatus($paymentId, $status, $transactionId = null) {
        try {
            if (empty($paymentId) || empty($status)) {
                throw new Exception("Payment ID and status are required");
            }

            $validStatuses = ['Pending', 'Completed', 'Failed'];
            if (!in_array($status, $validStatuses)) {
                throw new Exception("Invalid payment status");
            }

            // Update payment status
            $success = $this->paymentModel->updatePaymentStatus($paymentId, $status, $transactionId);
            
            if (!$success) {
                throw new Exception("Failed to update payment status");
            }

            // If payment completed, update booking status
            if ($status == 'Completed') {
                $payment = $this->paymentModel->getPaymentById($paymentId);
                if ($payment) {
                    $this->bookingModel->updateBookingStatus($payment['booking_id'], 'Confirmed');
                }
            }

            return true;
        } catch (Exception $e) {
            error_log("PaymentController updatePaymentStatus error: " . $e->getMessage());
            Session::set('payment_error', $e->getMessage());
            return false;
        }
    }

    // Get payment details
    public function getPaymentDetails($paymentId) {
        try {
            if (empty($paymentId)) {
                throw new Exception("Payment ID is required");
            }

            $payment = $this->paymentModel->getPaymentById($paymentId);
            
            if (!$payment) {
                throw new Exception("Payment not found");
            }

            return $payment;
        } catch (Exception $e) {
            error_log("PaymentController getPaymentDetails error: " . $e->getMessage());
            Session::set('payment_error', $e->getMessage());
            return false;
        }
    }

    // Get payment by booking ID
    public function getPaymentByBooking($bookingId) {
        try {
            if (empty($bookingId)) {
                throw new Exception("Booking ID is required");
            }

            $payment = $this->paymentModel->getPaymentByBookingId($bookingId);
            
            if (!$payment) {
                throw new Exception("No payment found for this booking");
            }

            return $payment;
        } catch (Exception $e) {
            error_log("PaymentController getPaymentByBooking error: " . $e->getMessage());
            Session::set('payment_error', $e->getMessage());
            return false;
        }
    }

    // Admin: Get all payments
    public function getAllPayments() {
        try {
            // Check if admin is logged in
            if (!Session::exists('admin_logged_in')) {
                throw new Exception("Unauthorized access");
            }

            return $this->paymentModel->getAllPayments();
        } catch (Exception $e) {
            error_log("PaymentController getAllPayments error: " . $e->getMessage());
            Session::set('admin_error', $e->getMessage());
            return [];
        }
    }

    // Admin: Get payments by status
    public function getPaymentsByStatus($status) {
        try {
            // Check if admin is logged in
            if (!Session::exists('admin_logged_in')) {
                throw new Exception("Unauthorized access");
            }

            $validStatuses = ['Pending', 'Completed', 'Failed'];
            if (!in_array($status, $validStatuses)) {
                throw new Exception("Invalid payment status");
            }

            return $this->paymentModel->getPaymentsByStatus($status);
        } catch (Exception $e) {
            error_log("PaymentController getPaymentsByStatus error: " . $e->getMessage());
            Session::set('admin_error', $e->getMessage());
            return [];
        }
    }
}
?>