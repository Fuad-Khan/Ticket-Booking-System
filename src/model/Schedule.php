<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';

class Schedule {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getSchedulesByBus($bus_id) {
        $stmt = $this->db->prepare("SELECT * FROM Schedules WHERE bus_id = ? ORDER BY departure_time");
        $stmt->execute([$bus_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getScheduleById($schedule_id) {
        $stmt = $this->db->prepare("SELECT * FROM Schedules WHERE schedule_id = ?");
        $stmt->execute([$schedule_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
}
?>