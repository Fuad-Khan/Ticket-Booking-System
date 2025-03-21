<?php
require_once __DIR__ . '/../models/Route.php';

class RouteController {
    private $routeModel;

    public function __construct() {
        $this->routeModel = new Route();
    }

    // Get all routes
    public function getAllRoutes() {
        $routes = $this->routeModel->getAllRoutes();

        if ($routes) {
            return [
                'status' => 'success',
                'data' => $routes
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'No routes found.'
            ];
        }
    }

    // Get route by ID
    public function getRouteById($route_id) {
        $route = $this->routeModel->getRouteById($route_id);

        if ($route) {
            return [
                'status' => 'success',
                'data' => $route
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Route not found.'
            ];
        }
    }

    // Add a new route
    public function addRoute($source, $destination, $distance) {
        $route_id = $this->routeModel->addRoute($source, $destination, $distance);

        if ($route_id) {
            return [
                'status' => 'success',
                'message' => 'Route added successfully!',
                'route_id' => $route_id
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to add route.'
            ];
        }
    }

    

    
}
?>