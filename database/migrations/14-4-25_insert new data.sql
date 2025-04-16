-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2025 at 09:25 PM
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

--
-- Dumping data for table `Buses`
--

INSERT INTO `Buses` (`bus_id`, `bus_name`, `total_seats`, `route_id`) VALUES
(1, 'Green Line', 36, 1),
(2, 'Shohagh Paribahan', 40, 1),
(3, 'Ena Transport', 32, 2),
(4, 'Hanif Enterprise', 36, 2),
(5, 'Soudia Coach', 40, 3),
(6, 'Eagle Paribahan', 36, 4),
(7, 'Saintmartin Travels', 32, 5),
(8, 'S Alam Paribahan', 40, 6);

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

--
-- Dumping data for table `Routes`
--

INSERT INTO `Routes` (`route_id`, `source`, `destination`, `distance`) VALUES
(1, 'Dhaka', 'Chittagong', 250),
(2, 'Dhaka', 'Sylhet', 200),
(3, 'Dhaka', 'Khulna', 180),
(4, 'Chittagong', 'Cox\'s Bazar', 100),
(5, 'Sylhet', 'Chittagong', 220),
(6, 'Khulna', 'Barisal', 120);

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

--
-- Dumping data for table `Route_Stops`
--

INSERT INTO `Route_Stops` (`stop_id`, `route_id`, `stop_name`, `stop_order`) VALUES
(1, 1, 'Dhaka', 1),
(2, 1, 'Narayanganj', 2),
(3, 1, 'Comilla', 3),
(4, 1, 'Feni', 4),
(5, 1, 'Chittagong', 5),
(6, 2, 'Dhaka', 1),
(7, 2, 'Kishoreganj', 2),
(8, 2, 'Mymensingh', 3),
(9, 2, 'Sylhet', 4),
(10, 3, 'Dhaka', 1),
(11, 3, 'Faridpur', 2),
(12, 3, 'Magura', 3),
(13, 3, 'Jessore', 4),
(14, 3, 'Khulna', 5);

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

--
-- Dumping data for table `Schedules`
--

INSERT INTO `Schedules` (`schedule_id`, `bus_id`, `departure_time`, `arrival_time`, `price`) VALUES
(1, 1, '2023-12-15 08:00:00', '2023-12-15 12:30:00', 1200.00),
(2, 1, '2023-12-15 14:00:00', '2023-12-15 18:30:00', 1200.00),
(3, 1, '2023-12-15 20:00:00', '2023-12-16 00:30:00', 1200.00),
(4, 2, '2023-12-15 07:30:00', '2023-12-15 12:00:00', 1100.00),
(5, 2, '2023-12-15 13:30:00', '2023-12-15 18:00:00', 1100.00),
(6, 2, '2023-12-15 19:30:00', '2023-12-16 00:00:00', 1100.00),
(7, 3, '2023-12-15 09:00:00', '2023-12-15 13:00:00', 900.00),
(8, 3, '2023-12-15 15:00:00', '2023-12-15 19:00:00', 900.00),
(9, 4, '2023-12-15 08:30:00', '2023-12-15 12:30:00', 950.00),
(10, 4, '2023-12-15 14:30:00', '2023-12-15 18:30:00', 950.00),
(11, 5, '2023-12-15 10:00:00', '2023-12-15 14:00:00', 800.00),
(12, 5, '2023-12-15 16:00:00', '2023-12-15 20:00:00', 800.00),
(13, 1, '2025-04-19 08:00:00', '2025-04-19 12:30:00', 1200.00),
(14, 1, '2025-04-19 14:00:00', '2025-04-19 18:30:00', 1200.00),
(15, 1, '2025-04-20 08:00:00', '2025-04-20 12:30:00', 1200.00),
(16, 1, '2025-04-21 20:00:00', '2025-04-22 00:30:00', 1200.00),
(17, 2, '2025-04-19 07:30:00', '2025-04-19 12:00:00', 1100.00),
(18, 2, '2025-04-20 13:30:00', '2025-04-20 18:00:00', 1100.00),
(19, 2, '2025-04-21 19:30:00', '2025-04-22 00:00:00', 1100.00),
(20, 3, '2025-04-19 09:00:00', '2025-04-19 13:00:00', 900.00),
(21, 3, '2025-04-20 15:00:00', '2025-04-20 19:00:00', 900.00),
(22, 3, '2025-04-21 09:00:00', '2025-04-21 13:00:00', 900.00),
(23, 4, '2025-04-19 08:30:00', '2025-04-19 12:30:00', 950.00),
(24, 4, '2025-04-20 14:30:00', '2025-04-20 18:30:00', 950.00),
(25, 4, '2025-04-21 08:30:00', '2025-04-21 12:30:00', 950.00),
(26, 5, '2025-04-19 10:00:00', '2025-04-19 14:00:00', 800.00),
(27, 5, '2025-04-20 16:00:00', '2025-04-20 20:00:00', 800.00),
(28, 5, '2025-04-21 10:00:00', '2025-04-21 14:00:00', 800.00),
(29, 6, '2025-04-19 11:00:00', '2025-04-19 13:00:00', 500.00),
(30, 6, '2025-04-20 17:00:00', '2025-04-20 19:00:00', 500.00),
(31, 7, '2025-04-19 12:00:00', '2025-04-19 16:00:00', 1000.00),
(32, 7, '2025-04-20 18:00:00', '2025-04-20 22:00:00', 1000.00),
(33, 8, '2025-04-19 13:00:00', '2025-04-19 15:30:00', 600.00),
(34, 8, '2025-04-20 19:00:00', '2025-04-20 21:30:00', 600.00);

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
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Schedules`
--
ALTER TABLE `Schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
