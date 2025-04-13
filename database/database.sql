-- Create Database
CREATE DATABASE bus_booking;
USE bus_booking;

-- 1. Users Table
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Routes Table
CREATE TABLE Routes (
    route_id INT AUTO_INCREMENT PRIMARY KEY,
    source VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    distance FLOAT NOT NULL
);

-- 3. Buses Table
CREATE TABLE Buses (
    bus_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_name VARCHAR(100) NOT NULL,
    total_seats INT NOT NULL,
    route_id INT,
    FOREIGN KEY (route_id) REFERENCES Routes(route_id) ON DELETE CASCADE
);

-- 4. Schedules Table
CREATE TABLE Schedules (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    bus_id INT,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (bus_id) REFERENCES Buses(bus_id) ON DELETE CASCADE
);

-- 5. Bookings Table
CREATE TABLE Bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    schedule_id INT,
    seat_numbers VARCHAR(255) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    booking_status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (schedule_id) REFERENCES Schedules(schedule_id) ON DELETE CASCADE
);

-- 6. Payments Table
CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
    transaction_id VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id) ON DELETE CASCADE
);

-- 7. Notifications Table
CREATE TABLE Notifications (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT NOT NULL,
    status ENUM('Sent', 'Read') DEFAULT 'Sent',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE
);

CREATE TABLE Admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    is_superadmin BOOLEAN DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



-- Create indexes for faster queries
CREATE INDEX idx_username ON Admins(username);
CREATE INDEX idx_email ON Admins(email);


-- Add Route Stops Table
CREATE TABLE Route_Stops (
    stop_id INT AUTO_INCREMENT PRIMARY KEY,
    route_id INT,
    stop_name VARCHAR(100) NOT NULL,
    stop_order INT NOT NULL, -- position in route: 1, 2, 3...
    FOREIGN KEY (route_id) REFERENCES Routes(route_id) ON DELETE CASCADE
);
