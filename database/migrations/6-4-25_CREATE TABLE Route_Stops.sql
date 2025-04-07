-- Add Route Stops Table
CREATE TABLE Route_Stops (
    stop_id INT AUTO_INCREMENT PRIMARY KEY,
    route_id INT,
    stop_name VARCHAR(100) NOT NULL,
    stop_order INT NOT NULL, -- position in route: 1, 2, 3...
    FOREIGN KEY (route_id) REFERENCES Routes(route_id) ON DELETE CASCADE
);
