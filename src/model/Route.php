<?php
class Route {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all routes
    public function getAllRoutes() {
        $stmt = $this->pdo->query("SELECT * FROM Routes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get route by ID
    public function getRouteById($routeId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Routes WHERE route_id = :route_id");
        $stmt->execute([':route_id' => $routeId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new route
    public function addRoute($source, $destination, $distance) {
        $stmt = $this->pdo->prepare("
            INSERT INTO Routes (source, destination, distance)
            VALUES (:source, :destination, :distance)
        ");
        return $stmt->execute([
            ':source' => $source,
            ':destination' => $destination,
            ':distance' => $distance,
        ]);
    }

    // Update a route
    public function updateRoute($routeId, $source, $destination, $distance) {
        $stmt = $this->pdo->prepare("
            UPDATE Routes
            SET source = :source, destination = :destination, distance = :distance
            WHERE route_id = :route_id
        ");
        return $stmt->execute([
            ':source' => $source,
            ':destination' => $destination,
            ':distance' => $distance,
            ':route_id' => $routeId,
        ]);
    }

    // Delete a route
    public function deleteRoute($routeId) {
        $stmt = $this->pdo->prepare("DELETE FROM Routes WHERE route_id = :route_id");
        return $stmt->execute([':route_id' => $routeId]);
    }
}
?>