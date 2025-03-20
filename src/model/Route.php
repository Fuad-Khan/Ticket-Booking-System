<?php
require_once __DIR__ . '/../config/database.php';

class Route {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Get all routes
    public function getAllRoutes() {
        $stmt = $this->pdo->query("SELECT * FROM Routes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get route by ID
    public function getRouteById($route_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Routes WHERE route_id = :route_id");
        $stmt->execute(['route_id' => $route_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new route
    public function addRoute($source, $destination, $distance) {
        $stmt = $this->pdo->prepare("INSERT INTO Routes (source, destination, distance) VALUES (:source, :destination, :distance)");
        $stmt->execute([
            'source' => $source,
            'destination' => $destination,
            'distance' => $distance
        ]);
        return $this->pdo->lastInsertId();
    }

    // Update route details
    public function updateRoute($route_id, $source, $destination, $distance) {
        $stmt = $this->pdo->prepare("UPDATE Routes SET source = :source, destination = :destination, distance = :distance WHERE route_id = :route_id");
        $stmt->execute([
            'route_id' => $route_id,
            'source' => $source,
            'destination' => $destination,
            'distance' => $distance
        ]);
        return $stmt->rowCount();
    }

    // Delete a route
    public function deleteRoute($route_id) {
        $stmt = $this->pdo->prepare("DELETE FROM Routes WHERE route_id = :route_id");
        $stmt->execute(['route_id' => $route_id]);
        return $stmt->rowCount();
    }
}
?>