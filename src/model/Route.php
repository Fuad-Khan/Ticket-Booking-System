<?php
error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen

require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../config/database.php';
class Route {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAllRoutes() {
        $stmt = $this->db->query("SELECT * FROM Routes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRouteById($route_id) {
        $stmt = $this->db->prepare("SELECT * FROM Routes WHERE route_id = ?");
        $stmt->execute([$route_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRouteStops($route_id) {
        $stmt = $this->db->prepare("SELECT * FROM Route_Stops WHERE route_id = ? ORDER BY stop_order");
        $stmt->execute([$route_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchRoutes($source, $destination) {
        $stmt = $this->db->prepare("
            SELECT r.* FROM Routes r
            JOIN Route_Stops rs1 ON r.route_id = rs1.route_id
            JOIN Route_Stops rs2 ON r.route_id = rs2.route_id
            WHERE rs1.stop_name LIKE ? AND rs2.stop_name LIKE ? AND rs1.stop_order < rs2.stop_order
        ");
        $stmt->execute(["%$source%", "%$destination%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>