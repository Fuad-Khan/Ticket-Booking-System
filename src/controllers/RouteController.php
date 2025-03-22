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

    // Update route details
    public function updateRoute($route_id, $source, $destination, $distance) {
        $result = $this->routeModel->updateRoute($route_id, $source, $destination, $distance);

        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Route updated successfully!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to update route.'
            ];
        }
    }

    // Delete a route
    public function deleteRoute($route_id) {
        $result = $this->routeModel->deleteRoute($route_id);

        if ($result) {
            return [
                'status' => 'success',
                'message' => 'Route deleted successfully!'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to delete route.'
            ];
        }
    }

    
}
?>