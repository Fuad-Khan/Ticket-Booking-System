-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2025 at 10:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `seat_numbers` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Buses`
--

CREATE TABLE `Buses` (
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE `Notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('Sent','Read') DEFAULT 'Sent',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Routes`
--

CREATE TABLE `Routes` (
  `route_id` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `distance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Route_Stops`
--

CREATE TABLE `Route_Stops` (
  `stop_id` int(11) NOT NULL,
  `route_id` int(11) DEFAULT NULL,
  `stop_name` varchar(100) NOT NULL,
  `stop_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Schedules`
--

CREATE TABLE `Schedules` (
  `schedule_id` int(11) NOT NULL,
  `bus_id` int(11) DEFAULT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `name`, `email`, `phone`, `password`, `created_at`) VALUES
(9, 'Rashed', 'rashed@email.com', '01601162088', '$2y$10$rIZVU6wxwHX/MR/FxyK59OqYKk7eyHoxHDkv.3gd3cwuxxOcnI41K', '2025-03-14 10:55:44'),
(10, 'Roni', 'roni@email.com', '01726121800', '$2y$10$tmYp7eeSWEQOpRKqzPDEy.Z6HNWdikPiD//Qcdgpr2KH4QC2FRpeO', '2025-03-14 10:57:17'),
(19, 'Fuad Khan', 'fuadkhan183@gmail.com', '01601102043', '$2y$10$psv1l/v4GJ3f50ipASKhM.djV7fsWzE4C9rHjdrRMeI6ZyCosVK2W', '2025-03-14 13:43:16'),
(22, 'MK', 'fuad#@gmail.com', '01726121000', '$2y$10$l3aw6RmV5Nlg7bVZ2ydV3.M/zKkfdt6gM1QXvUxz/YQrU.IlI/Gxu', '2025-03-14 15:37:22'),
(27, 'John Doe', 'johndoe@example.com', '+123456789', '$2y$10$q6KncroAUNW3ULDonylBzOWw3KNi6rw39Nn92QMk7wxEfwIwJWBKm', '2025-03-15 09:13:29'),
(29, 'New User', 'newuser@example.com', '+9876543210', '$2y$10$y8HE8iZl3uPuIhwsAhUx5.L18mS1d.ywfMX1NRiav6HscvwG8LAJ6', '2025-03-15 09:26:15'),
(30, 'ddd', 'dddddddd@dddddddd', '01601162049', '$2y$10$/pRqyiCWSMsafvmJEHjAkeBDshWFEW8o2ZuX4l1PHOLFOOzpwfdWG', '2025-03-20 15:42:44'),
(31, 'jjjjjjjj', 'jjjjjjj@jjjjjj.com', '01601162993', '$2y$10$KyG9BgiVribiPe17.6EXB.LpzlQbrRl.jaX1PntXXczUwpQ3mLYBG', '2025-03-22 06:06:41'),
(32, 'YKSG2, Room-221, Block A', 'khan35-88@diu.edu.bd', '01726121770', '$2y$10$Q.E52cv42rXSeSVz6jhsMOsFZf7RmEmhUZSeYq0ckXUMqAfUlTrNi', '2025-04-02 06:28:07'),
(33, 'MK', 'khan35-883@diu.edu.bd', '01726121880', '$2y$10$2eTpborwnv9Cqu5hLBFPOO2v8YJQrGY3KXYi4P6RGULsqGnuu5hGq', '2025-04-02 09:26:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `Buses`
--
ALTER TABLE `Buses`
  ADD PRIMARY KEY (`bus_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `Routes`
--
ALTER TABLE `Routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  ADD PRIMARY KEY (`stop_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Buses`
--
ALTER TABLE `Buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Routes`
--
ALTER TABLE `Routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Schedules`
--
ALTER TABLE `Schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `Bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Bookings_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `Schedules` (`schedule_id`) ON DELETE CASCADE;

--
-- Constraints for table `Buses`
--
ALTER TABLE `Buses`
  ADD CONSTRAINT `Buses_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `Routes` (`route_id`) ON DELETE CASCADE;

--
-- Constraints for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD CONSTRAINT `Notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `Payments`
--
ALTER TABLE `Payments`
  ADD CONSTRAINT `Payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `Bookings` (`booking_id`) ON DELETE CASCADE;

--
-- Constraints for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  ADD CONSTRAINT `Route_Stops_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `Routes` (`route_id`) ON DELETE CASCADE;

--
-- Constraints for table `Schedules`
--
ALTER TABLE `Schedules`
  ADD CONSTRAINT `Schedules_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `Buses` (`bus_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
