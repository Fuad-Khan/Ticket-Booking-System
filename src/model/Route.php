<?php
error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';

class Route {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Find routes that contain both source and destination stops in correct order
    public function findRoutesBetweenStops($sourceStop, $destinationStop) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT r.route_id, r.source, r.destination, r.distance
                FROM Routes r
                INNER JOIN Route_Stops rs1 ON r.route_id = rs1.route_id
                INNER JOIN Route_Stops rs2 ON r.route_id = rs2.route_id
                WHERE rs1.stop_name = :source 
                AND rs2.stop_name = :destination
                AND rs1.stop_order < rs2.stop_order
                GROUP BY r.route_id
            ");
            
            $stmt->execute([
                ':source' => $sourceStop,
                ':destination' => $destinationStop
            ]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Route search error: " . $e->getMessage());
            return [];
        }
    }

    public function getAllRoutes() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM Routes ORDER BY source, destination");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Routes fetch error: " . $e->getMessage());
            return [];
        }
    }

    // Additional CRUD operations as needed...
}