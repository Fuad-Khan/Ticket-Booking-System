<?php
// src/model/Payment.php

require_once __DIR__ . '/../config/database.php';

class Payment {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Create a payment record
    public function createPayment($bookingId, $amount, $paymentMethod, $transactionId = null) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO Payments (booking_id, amount, payment_method, transaction_id)
                VALUES (:booking_id, :amount, :payment_method, :transaction_id)
            ");
            
            $stmt->execute([
                ':booking_id' => $bookingId,
                ':amount' => $amount,
                ':payment_method' => $paymentMethod,
                ':transaction_id' => $transactionId
            ]);
            
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Payment creation error: " . $e->getMessage());
            return false;
        }
    }

    // Update payment status
    public function updatePaymentStatus($paymentId, $status, $transactionId = null) {
        try {
            $params = [
                ':payment_id' => $paymentId,
                ':status' => $status
            ];
            
            $sql = "UPDATE Payments SET payment_status = :status";
            
            if ($transactionId) {
                $sql .= ", transaction_id = :transaction_id";
                $params[':transaction_id'] = $transactionId;
            }
            
            $sql .= " WHERE payment_id = :payment_id";
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Payment status update error: " . $e->getMessage());
            return false;
        }
    }

    // Get payment by ID
    public function getPaymentById($paymentId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.*, b.booking_id, b.user_id, b.total_price,
                       u.name as user_name, u.email
                FROM Payments p
                JOIN Bookings b ON p.booking_id = b.booking_id
                JOIN Users u ON b.user_id = u.user_id
                WHERE p.payment_id = :payment_id
            ");
            
            $stmt->execute([':payment_id' => $paymentId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Payment fetch error: " . $e->getMessage());
            return false;
        }
    }

    // Get payment by booking ID
    public function getPaymentByBookingId($bookingId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM Payments 
                WHERE booking_id = :booking_id
            ");
            
            $stmt->execute([':booking_id' => $bookingId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Payment by booking fetch error: " . $e->getMessage());
            return false;
        }
    }

    // Get all payments (for admin)
    public function getAllPayments() {
        try {
            $stmt = $this->pdo->query("
                SELECT p.*, b.booking_id, b.user_id, b.total_price,
                       u.name as user_name, u.email
                FROM Payments p
                JOIN Bookings b ON p.booking_id = b.booking_id
                JOIN Users u ON b.user_id = u.user_id
                ORDER BY p.created_at DESC
            ");
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("All payments fetch error: " . $e->getMessage());
            return [];
        }
    }

    // Add to src/model/Payment.php
public function getPaymentsByStatus($status) {
    try {
        $stmt = $this->pdo->prepare("
            SELECT p.*, b.booking_id, b.user_id, b.total_price,
                   u.name as user_name, u.email
            FROM Payments p
            JOIN Bookings b ON p.booking_id = b.booking_id
            JOIN Users u ON b.user_id = u.user_id
            WHERE p.payment_status = :status
            ORDER BY p.created_at DESC
        ");
        
        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Payments by status fetch error: " . $e->getMessage());
        return [];
    }
}
}
?>