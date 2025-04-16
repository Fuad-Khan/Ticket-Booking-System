<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';

class Bus {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getBusesByRoute($route_id) {
        $stmt = $this->db->prepare("SELECT * FROM Buses WHERE route_id = ?");
        $stmt->execute([$route_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBusById($bus_id) {
        $stmt = $this->db->prepare("
            SELECT b.*, r.source, r.destination 
            FROM Buses b
            LEFT JOIN Routes r ON b.route_id = r.route_id
            WHERE b.bus_id = ?
        ");
        $stmt->execute([$bus_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>