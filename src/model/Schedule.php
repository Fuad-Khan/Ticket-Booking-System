<?php
class Schedule {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get all schedules
    public function getAllSchedules() {
        $stmt = $this->pdo->query("SELECT * FROM Schedules");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get schedule by ID
    public function getScheduleById($scheduleId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Schedules WHERE schedule_id = :schedule_id");
        $stmt->execute([':schedule_id' => $scheduleId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get schedules by bus ID
    public function getSchedulesByBusId($busId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Schedules WHERE bus_id = :bus_id");
        $stmt->execute([':bus_id' => $busId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Search buses by source, destination, and date
    public function searchBuses($source, $destination, $date) {
        $stmt = $this->pdo->prepare("
            SELECT b.bus_id, b.bus_name, r.source, r.destination, 
                   s.departure_time, s.arrival_time, s.price, s.schedule_id
            FROM Schedules s
            JOIN Buses b ON s.bus_id = b.bus_id
            JOIN Routes r ON b.route_id = r.route_id
            WHERE r.source LIKE :source AND r.destination LIKE :destination 
                  AND DATE(s.departure_time) = :date
            ORDER BY s.departure_time
        ");
        $stmt->execute([
            ':source' => "%$source%",
            ':destination' => "%$destination%",
            ':date' => $date,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new schedule
    public function addSchedule($busId, $departureTime, $arrivalTime, $price) {
        $stmt = $this->pdo->prepare("
            INSERT INTO Schedules (bus_id, departure_time, arrival_time, price)
            VALUES (:bus_id, :departure_time, :arrival_time, :price)
        ");
        return $stmt->execute([
            ':bus_id' => $busId,
            ':departure_time' => $departureTime,
            ':arrival_time' => $arrivalTime,
            ':price' => $price,
        ]);
    }

    // Update a schedule
    public function updateSchedule($scheduleId, $busId, $departureTime, $arrivalTime, $price) {
        $stmt = $this->pdo->prepare("
            UPDATE Schedules
            SET bus_id = :bus_id, departure_time = :departure_time, 
                arrival_time = :arrival_time, price = :price
            WHERE schedule_id = :schedule_id
        ");
        return $stmt->execute([
            ':bus_id' => $busId,
            ':departure_time' => $departureTime,
            ':arrival_time' => $arrivalTime,
            ':price' => $price,
            ':schedule_id' => $scheduleId,
        ]);
    }

    // Delete a schedule
    public function deleteSchedule($scheduleId) {
        $stmt = $this->pdo->prepare("DELETE FROM Schedules WHERE schedule_id = :schedule_id");
        return $stmt->execute([':schedule_id' => $scheduleId]);
    }
}
?>