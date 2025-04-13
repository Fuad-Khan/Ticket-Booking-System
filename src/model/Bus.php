<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';

class Bus {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Get buses by route ID
    public function getBusesByRoute($routeId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM Buses 
                WHERE route_id = :route_id
            ");
            
            $stmt->execute([':route_id' => $routeId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Bus search error: " . $e->getMessage());
            return [];
        }
    }

    public function getAllBuses() {
        try {
            $stmt = $this->pdo->query("
                SELECT b.*, r.source, r.destination 
                FROM Buses b
                LEFT JOIN Routes r ON b.route_id = r.route_id
                ORDER BY b.bus_name
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Buses fetch error: " . $e->getMessage());
            return [];
        }
    }

    // Additional CRUD operations...
}