<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';

class Schedule {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Get schedules for a bus with price
    public function getSchedulesByBus($busId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM Schedules 
                WHERE bus_id = :bus_id
                ORDER BY departure_time
            ");
            
            $stmt->execute([':bus_id' => $busId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Schedule search error: " . $e->getMessage());
            return [];
        }
    }

    // Additional CRUD operations...
}