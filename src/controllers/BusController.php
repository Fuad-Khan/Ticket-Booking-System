<?php
require_once __DIR__ . '/../model/Route.php';
require_once __DIR__ . '/../model/Bus.php';
require_once __DIR__ . '/../model/Schedule.php';

class BusController {
    private $routeModel;
    private $busModel;
    private $scheduleModel;

    public function __construct() {
        $this->routeModel = new Route();
        $this->busModel = new Bus();
        $this->scheduleModel = new Schedule();
    }

    public function searchBuses($source, $destination) {
        $routes = $this->routeModel->searchRoutes($source, $destination);
        
        $results = [];
        foreach ($routes as $route) {
            $buses = $this->busModel->getBusesByRoute($route['route_id']);
            
            foreach ($buses as $bus) {
                $schedules = $this->scheduleModel->getSchedulesByBus($bus['bus_id']);
                
                foreach ($schedules as $schedule) {
                    $results[] = [
                        'route' => $route,
                        'bus' => $bus,
                        'schedule' => $schedule
                    ];
                }
            }
        }
        
        return $results;
    }

    public function getBusDetails($bus_id) {
        $bus = $this->busModel->getBusById($bus_id);
        if (!$bus) return null;

        $route = $this->routeModel->getRouteById($bus['route_id']);
        $stops = $this->routeModel->getRouteStops($bus['route_id']);
        $schedules = $this->scheduleModel->getSchedulesByBus($bus_id);

        return [
            'bus' => $bus,
            'route' => $route,
            'stops' => $stops,
            'schedules' => $schedules
        ];
    }

    public function getBusDetailsForSchedule($schedule_id) {
        try {
            // Get the schedule information
            $schedule = $this->scheduleModel->getScheduleById($schedule_id);
            if (!$schedule) {
                return null;
            }

            // Get the bus information
            $bus = $this->busModel->getBusById($schedule['bus_id']);
            if (!$bus) {
                return null;
            }

            // Get the route information
            $route = $this->routeModel->getRouteById($bus['route_id']);
            if (!$route) {
                return null;
            }

            return [
                'bus' => $bus,
                'route' => $route,
                'schedule' => $schedule
            ];
        } catch (Exception $e) {
            error_log("Error getting bus details for schedule: " . $e->getMessage());
            return null;
        }
    }
}
?>