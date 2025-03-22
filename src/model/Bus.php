<?php
require_once __DIR__ . '/../config/database.php';

class Bus {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    // Get all buses
    public function getAllBuses() {
        $stmt = $this->pdo->query("SELECT * FROM Buses");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get bus by ID
    public function getBusById($bus_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Buses WHERE bus_id = :bus_id");
        $stmt->execute(['bus_id' => $bus_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add a new bus
    public function addBus($bus_name, $total_seats, $route_id) {
        $stmt = $this->pdo->prepare("INSERT INTO Buses (bus_name, total_seats, route_id) VALUES (:bus_name, :total_seats, :route_id)");
        $stmt->execute([
            'bus_name' => $bus_name,
            'total_seats' => $total_seats,
            'route_id' => $route_id
        ]);
        return $this->pdo->lastInsertId();
    }

    // Update bus details
    public function updateBus($bus_id, $bus_name, $total_seats, $route_id) {
        $stmt = $this->pdo->prepare("UPDATE Buses SET bus_name = :bus_name, total_seats = :total_seats, route_id = :route_id WHERE bus_id = :bus_id");
        $stmt->execute([
            'bus_id' => $bus_id,
            'bus_name' => $bus_name,
            'total_seats' => $total_seats,
            'route_id' => $route_id
        ]);
        return $stmt->rowCount();
    }

    // Delete a bus
    public function deleteBus($bus_id) {
        $stmt = $this->pdo->prepare("DELETE FROM Buses WHERE bus_id = :bus_id");
        $stmt->execute(['bus_id' => $bus_id]);
        return $stmt->rowCount();
    }
}
?>