<?php
require_once __DIR__ . '/../models/Bus.php';

class BusController {
    private $busModel;

    public function __construct() {
        $this->busModel = new Bus();
    }

    // Get all buses
    public function getAllBuses() {
        $buses = $this->busModel->getAllBuses();

        if ($buses) {
            return [
                'status' => 'success',
                'data' => $buses
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'No buses found.'
            ];
        }
    }

    // Get bus by ID
    public function getBusById($bus_id) {
        $bus = $this->busModel->getBusById($bus_id);

        if ($bus) {
            return [
                'status' => 'success',
                'data' => $bus
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Bus not found.'
            ];
        }
    }

    // Add a new bus
    public function addBus($bus_name, $total_seats, $route_id) {
        $bus_id = $this->busModel->addBus($bus_name, $total_seats, $route_id);

        if ($bus_id) {
            return [
                'status' => 'success',
                'message' => 'Bus added successfully!',
                'bus_id' => $bus_id
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to add bus.'
            ];
        }
    }

    // Update bus details
    public function updateBus($bus_id, $bus_name, $total_seats, $route_id) {
        $result = $this->busModel->updateBus($bus_id, $bus_name, $total_seats, $route_id);

        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Bus updated successfully!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to update bus.'
            ];
        }
    }

    // Delete a bus
    public function deleteBus($bus_id) {
        $result = $this->busModel->deleteBus($bus_id);

        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Bus deleted successfully!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to delete bus.'
            ];
        }
    }
}
?>