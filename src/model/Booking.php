<?php
// src/model/Booking.php

require_once __DIR__ . '/../config/database.php';

class Booking {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Create a new booking
    public function createBooking($userId, $scheduleId, $seatNumbers, $totalPrice) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO Bookings (user_id, schedule_id, seat_numbers, total_price, booking_status)
                VALUES (:user_id, :schedule_id, :seat_numbers, :total_price, 'Pending')
            ");
            
            $stmt->execute([
                ':user_id' => $userId,
                ':schedule_id' => $scheduleId,
                ':seat_numbers' => $seatNumbers,
                ':total_price' => $totalPrice
            ]);
            
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Booking creation error: " . $e->getMessage());
            return false;
        }
    }

    // Get booking by ID
    public function getBookingById($bookingId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT b.*, u.name as user_name, u.email, u.phone,
                       s.departure_time, s.arrival_time, s.price,
                       bu.bus_name, bu.total_seats,
                       r.source, r.destination
                FROM Bookings b
                JOIN Users u ON b.user_id = u.user_id
                JOIN Schedules s ON b.schedule_id = s.schedule_id
                JOIN Buses bu ON s.bus_id = bu.bus_id
                JOIN Routes r ON bu.route_id = r.route_id
                WHERE b.booking_id = :booking_id
            ");
            
            $stmt->execute([':booking_id' => $bookingId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Booking fetch error: " . $e->getMessage());
            return false;
        }
    }

    // Update booking status
    public function updateBookingStatus($bookingId, $status) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE Bookings 
                SET booking_status = :status 
                WHERE booking_id = :booking_id
            ");
            
            return $stmt->execute([
                ':booking_id' => $bookingId,
                ':status' => $status
            ]);
        } catch (PDOException $e) {
            error_log("Booking status update error: " . $e->getMessage());
            return false;
        }
    }

    // Get all bookings for a user
    public function getUserBookings($userId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT b.*, s.departure_time, s.arrival_time, s.price,
                       bu.bus_name, r.source, r.destination
                FROM Bookings b
                JOIN Schedules s ON b.schedule_id = s.schedule_id
                JOIN Buses bu ON s.bus_id = bu.bus_id
                JOIN Routes r ON bu.route_id = r.route_id
                WHERE b.user_id = :user_id
                ORDER BY b.created_at DESC
            ");
            
            $stmt->execute([':user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("User bookings fetch error: " . $e->getMessage());
            return [];
        }
    }

    // Get all bookings (for admin)
    public function getAllBookings() {
        try {
            $stmt = $this->pdo->query("
                SELECT b.*, u.name as user_name, u.email,
                       s.departure_time, s.arrival_time,
                       bu.bus_name, r.source, r.destination
                FROM Bookings b
                JOIN Users u ON b.user_id = u.user_id
                JOIN Schedules s ON b.schedule_id = s.schedule_id
                JOIN Buses bu ON s.bus_id = bu.bus_id
                JOIN Routes r ON bu.route_id = r.route_id
                ORDER BY b.created_at DESC
            ");
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("All bookings fetch error: " . $e->getMessage());
            return [];
        }
    }

    
}
?>