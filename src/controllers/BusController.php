<?php
error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../model/Bus.php';
require_once __DIR__ . '/../model/Route.php';
require_once __DIR__ . '/../model/Schedule.php';
require_once __DIR__ . '/../utils/Helpers.php';
require_once __DIR__ . '/../utils/Session.php';

class BusController {
    private $busModel;
    private $routeModel;
    private $scheduleModel;

    public function __construct() {
        $this->busModel = new Bus();
        $this->routeModel = new Route();
        $this->scheduleModel = new Schedule();
        Session::start();
    }

    /**
     * Search for available buses between two locations
     */
    public function searchBuses($source, $destination, $date) {
        try {
            // Validate inputs
            $source = Helpers::sanitize($source);
            $destination = Helpers::sanitize($destination);
            $date = Helpers::sanitize($date);

            // Find routes that connect these stops
            $routes = $this->routeModel->findRoutesBetweenStops($source, $destination);
            
            if (empty($routes)) {
                return [
                    'success' => false,
                    'message' => 'No routes found between the selected locations'
                ];
            }

            $availableBuses = [];
            
            foreach ($routes as $route) {
                // Get buses for this route
                $buses = $this->busModel->getBusesByRoute($route['route_id']);
                
                foreach ($buses as $bus) {
                    // Get schedules for this bus on the selected date
                    $schedules = $this->scheduleModel->getSchedulesByBus($bus['bus_id']);
                    
                    foreach ($schedules as $schedule) {
                        // Check if schedule matches the selected date
                        $scheduleDate = date('Y-m-d', strtotime($schedule['departure_time']));
                        
                        if ($scheduleDate === $date) {
                            // Calculate available seats (you'll need to implement this)
                            $bookedSeats = $this->getBookedSeats($schedule['schedule_id']);
                            $availableSeats = $bus['total_seats'] - count($bookedSeats);
                            
                            if ($availableSeats > 0) {
                                $availableBuses[] = [
                                    'bus_id' => $bus['bus_id'],
                                    'bus_name' => $bus['bus_name'],
                                    'total_seats' => $bus['total_seats'],
                                    'available_seats' => $availableSeats,
                                    'schedule_id' => $schedule['schedule_id'],
                                    'departure_time' => $schedule['departure_time'],
                                    'arrival_time' => $schedule['arrival_time'],
                                    'price' => $schedule['price'],
                                    'route_id' => $route['route_id'],
                                    'source' => $route['source'],
                                    'destination' => $route['destination']
                                ];
                            }
                        }
                    }
                }
            }

            if (empty($availableBuses)) {
                return [
                    'success' => false,
                    'message' => 'No available buses found for the selected date'
                ];
            }

            return [
                'success' => true,
                'data' => $availableBuses
            ];

        } catch (Exception $e) {
            error_log("Bus search error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'An error occurred while searching for buses'
            ];
        }
    }

    /**
     * Get booked seats for a schedule
     */
    private function getBookedSeats($scheduleId) {
        try {
            // In a real implementation, you would query the Bookings table
            // This is a placeholder - implement proper database query
            return []; // Return array of booked seat numbers
        } catch (Exception $e) {
            error_log("Error getting booked seats: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get bus details by ID
     */
    public function getBusDetails($busId) {
        try {
            // In a real implementation, you would query the Buses table
            // This is a placeholder - implement proper database query
            return [
                'success' => true,
                'data' => [
                    'bus_id' => $busId,
                    'bus_name' => 'Sample Bus',
                    'total_seats' => 40,
                    'amenities' => ['AC', 'WiFi', 'TV']
                ]
            ];
        } catch (Exception $e) {
            error_log("Error getting bus details: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to get bus details'
            ];
        }
    }

    /**
     * Get seat layout for a bus
     */
    public function getSeatLayout($busId) {
        try {
            // This would typically come from the database
            // Sample layout for a bus with 40 seats (5 rows, 4 columns)
            $rows = 10;
            $cols = 4;
            $layout = [];
            
            for ($i = 1; $i <= $rows; $i++) {
                for ($j = 1; $j <= $cols; $j++) {
                    $seatNumber = ($i - 1) * $cols + $j;
                    $layout[] = [
                        'seat_number' => $seatNumber,
                        'row' => $i,
                        'column' => $j,
                        'type' => 'standard' // Could be 'window', 'aisle', etc.
                    ];
                }
            }
            
            return [
                'success' => true,
                'data' => $layout
            ];
        } catch (Exception $e) {
            error_log("Error getting seat layout: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Failed to get seat layout'
            ];
        }
    }
}