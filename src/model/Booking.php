<?php
// src/model/Booking.php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';


class Booking {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }
    public function createBooking($user_id, $schedule_id, $seat_numbers, $total_price, $status = 'Pending', $passenger_name = '', $passenger_mobile = '', $passenger_gender = '') {
        $sql = "INSERT INTO bookings 
                (user_id, schedule_id, seat_numbers, total_price, status, passenger_name, passenger_mobile, passenger_gender, booking_date) 
                VALUES (:user_id, :schedule_id, :seat_numbers, :total_price, :status, :passenger_name, :passenger_mobile, :passenger_gender, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':schedule_id', $schedule_id);
        $stmt->bindParam(':seat_numbers', $seat_numbers);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':passenger_name', $passenger_name);
        $stmt->bindParam(':passenger_mobile', $passenger_mobile);
        $stmt->bindParam(':passenger_gender', $passenger_gender);
        
        return $stmt->execute() ? $this->db->lastInsertId() : false;
    }


    public function getBookedSeats($schedule_id) {
        $stmt = $this->db->prepare("
            SELECT seat_numbers FROM bookings  
            WHERE schedule_id = ? AND status = 'Confirmed'  
        ");
        $stmt->execute([$schedule_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

// In src/model/Booking.php
public function getUserBookings($user_id) {
    $sql = "SELECT 
                b.booking_id,
                b.user_id,
                b.schedule_id,
                b.seat_numbers,
                b.total_price,
                b.status,
                b.passenger_name,
                b.passenger_mobile,
                b.passenger_gender,
                b.booking_date,
                s.departure_time,
                s.arrival_time,
                s.price as schedule_price,
                bu.bus_name
                /* Removed bu.bus_number as it doesn't exist */
            FROM bookings b
            JOIN Schedules s ON b.schedule_id = s.schedule_id
            JOIN Buses bu ON s.bus_id = bu.bus_id
            WHERE b.user_id = :user_id
            ORDER BY b.booking_date DESC";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
public function cancelBooking($booking_id) {
    $sql = "UPDATE bookings SET status = 'Cancelled', cancellation_date = NOW() WHERE booking_id = :booking_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
    return $stmt->execute();
}
    public function getById($booking_id) {
        $stmt = $this->db->prepare("SELECT * FROM Bookings WHERE booking_id = ?");
        $stmt->execute([$booking_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>