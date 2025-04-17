-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2025 at 02:16 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `seat_numbers` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `passenger_name` varchar(100) DEFAULT NULL,
  `passenger_mobile` varchar(20) DEFAULT NULL,
  `passenger_gender` varchar(10) DEFAULT NULL,
  `booking_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cancellation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `schedule_id`, `seat_numbers`, `total_price`, `status`, `passenger_name`, `passenger_mobile`, `passenger_gender`, `booking_date`, `cancellation_date`) VALUES
(1, 33, 2, '1,2', 2400.00, 'confirmed', 'Anik Kumar Ray Roni', 'kk', 'male', '2025-04-15 22:59:56', NULL),
(2, 33, 2, '1,2', 2400.00, 'confirmed', 'Anik Kumar Ray Roni', 'kk', 'male', '2025-04-15 23:05:26', NULL),
(3, 33, 2, '1,2', 2400.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-15 23:28:32', NULL),
(4, 33, 1, '1,2', 2400.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-15 23:47:18', NULL),
(5, 33, 2, '7', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-15 23:58:11', NULL),
(6, 33, 3, '19', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 00:14:09', NULL),
(7, 33, 14, '3,7,12,14', 4800.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 00:34:42', NULL),
(8, 33, 2, '35', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 00:35:37', NULL),
(9, 33, 2, '35', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 00:39:14', NULL),
(10, 33, 2, '35', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 00:43:08', NULL),
(11, 33, 17, '17,18', 2200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 00:53:33', NULL),
(12, 33, 5, '34,35', 2200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 01:01:50', NULL),
(13, 33, 14, '30', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 01:05:16', NULL),
(14, 33, 14, '30', 1200.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 01:06:09', NULL),
(15, 33, 14, '10,23', 2400.00, 'confirmed', 'Fuad Khan k', '01726121880', 'male', '2025-04-16 01:28:33', NULL),
(16, 33, 1, '5,6', 2400.00, 'confirmed', 'Anik Kumar Ray Roni', 'kk', 'male', '2025-04-16 02:10:39', NULL),
(17, 33, 12, '9,10', 1600.00, 'confirmed', 'Fuad Khan', '016323556485', 'male', '2025-04-16 12:15:59', NULL),
(18, 33, 1, '9,10', 2400.00, 'confirmed', 'Fuad Khan', '016323556485', 'male', '2025-04-16 12:27:04', NULL),
(19, 33, 1, '7,8', 2400.00, 'confirmed', 'Anik Kumar Ray Roni', 'kk', 'male', '2025-04-16 12:40:24', NULL);

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
  `passenger_info` text DEFAULT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`booking_id`, `user_id`, `schedule_id`, `seat_numbers`, `total_price`, `passenger_info`, `booking_status`, `created_at`) VALUES
(2, 33, 1, '33', 1200.00, '', 'Pending', '2025-04-14 20:19:38'),
(3, 33, 19, '3', 1100.00, '', 'Pending', '2025-04-14 20:20:07'),
(4, 33, 19, '3', 1100.00, '', 'Pending', '2025-04-14 20:23:27'),
(5, 33, 19, '3', 1100.00, '', 'Pending', '2025-04-14 20:24:46'),
(6, 33, 16, '34,35', 2400.00, '', 'Pending', '2025-04-15 11:43:09'),
(7, 33, 16, '34,35', 2400.00, '', 'Pending', '2025-04-15 11:43:13'),
(8, 33, 16, '34,35', 2400.00, '', 'Pending', '2025-04-15 11:43:21'),
(9, 33, 1, '17,18', 2400.00, '', 'Pending', '2025-04-15 11:43:57'),
(10, 33, 13, '14', 1200.00, NULL, 'Pending', '2025-04-15 12:54:32'),
(11, 33, 13, '14,15,16,17,21', 6000.00, NULL, 'Pending', '2025-04-15 12:54:41'),
(12, 33, 17, '32,33,34,35,37,38,40', 7700.00, NULL, 'Pending', '2025-04-15 12:56:12'),
(13, 33, 17, '32,33,34,35,37,38,40', 7700.00, NULL, 'Pending', '2025-04-15 12:57:43'),
(14, 33, 17, '32,33,34,35,37,38,40', 7700.00, NULL, 'Pending', '2025-04-15 12:57:48'),
(15, 33, 17, '32,33,34,35,37,38,40', 7700.00, NULL, 'Pending', '2025-04-15 12:59:15'),
(16, 33, 17, '32,33,34,35,37,38,40', 7700.00, NULL, 'Pending', '2025-04-15 13:00:38'),
(17, 33, 13, '33', 1200.00, NULL, 'Pending', '2025-04-15 13:04:41'),
(18, 33, 13, '19', 1200.00, NULL, 'Pending', '2025-04-15 13:04:55'),
(19, 33, 13, '40', 1200.00, NULL, 'Pending', '2025-04-15 13:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `Buses`
--

CREATE TABLE `Buses` (
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `bus_type` varchar(50) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `coach_number` varchar(20) NOT NULL,
  `route_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Buses`
--

INSERT INTO `Buses` (`bus_id`, `bus_name`, `bus_type`, `total_seats`, `coach_number`, `route_id`) VALUES
(1, 'Green Line', '', 36, '', 1),
(2, 'Shohagh Paribahan', '', 40, '', 1),
(3, 'Ena Transport', '', 32, '', 2),
(4, 'Hanif Enterprise', '', 36, '', 2),
(5, 'Soudia Coach', '', 40, '', 3),
(6, 'Eagle Paribahan', '', 36, '', 4),
(7, 'Saintmartin Travels', '', 32, '', 5),
(8, 'S Alam Paribahan', '', 40, '', 6),
(9, 'Desh Travels', 'AC', 40, 'DT-908', 7),
(10, 'Nabil Paribahan', 'Non-AC', 36, 'NP-100', 8),
(11, 'Shyamoli Paribahan', 'AC', 40, 'SP-101', 9),
(12, 'Hanif Enterprise', 'AC', 38, 'HE-110', 10),
(13, 'Green Line', 'Non-AC', 36, 'GL-202', 11),
(14, 'Ena Transport', 'AC', 40, 'ET-115', 12),
(15, 'Shyamoli Paribahan', 'AC', 40, 'SP-205', 13),
(16, 'Sakura Transport', 'Non-AC', 36, 'SK-101', 14),
(17, 'National Travels', 'AC', 38, 'NT-303', 15),
(18, 'Eagle Paribahan', 'Non-AC', 40, 'EP-404', 17),
(19, 'Unique Service', 'AC', 36, 'US-505', 19),
(20, 'TR Travels', 'Non-AC', 32, 'TR-606', NULL),
(21, 'Bablu Enterprise', 'AC', 40, 'BE-707', NULL),
(22, 'Pallabi Super', 'Non-AC', 36, 'PS-808', NULL),
(23, 'S Alam Paribahan', 'AC', 38, 'SA-909', NULL),
(24, 'Nabil Paribahan', 'Non-AC', 40, 'NP-010', NULL);

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

--
-- Dumping data for table `Payments`
--

INSERT INTO `Payments` (`payment_id`, `booking_id`, `amount`, `payment_method`, `payment_status`, `transaction_id`, `created_at`) VALUES
(5, NULL, 2400.00, 'Credit Card', 'Completed', 'TXN1744724099536', '2025-04-15 13:34:59'),
(6, NULL, 2400.00, 'Credit Card', 'Completed', 'TXN1744724282302', '2025-04-15 13:38:02'),
(7, NULL, 2400.00, 'Credit Card', 'Completed', 'TXN1744724801864', '2025-04-15 13:46:41'),
(8, NULL, 2400.00, 'Credit Card', 'Completed', 'TXN1744725734209', '2025-04-15 14:02:14'),
(9, NULL, 3600.00, 'Credit Card', 'Completed', 'TXN1744726524667', '2025-04-15 14:15:24');

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
(6, 'Khulna', 'Barisal', 120),
(7, 'Dhaka', 'Rajshahi', 245),
(8, 'Dhaka', 'Rangpur', 300),
(9, 'Dhaka', 'Mymensingh', 120),
(10, 'Rajshahi', 'Naogaon', 110),
(11, 'Rangpur', 'Dinajpur', 80),
(12, 'Barisal', 'Patuakhali', 95),
(13, 'Dhaka', 'Bandarban', 320),
(14, 'Dhaka', 'Rangamati', 280),
(15, 'Dhaka', 'Pabna', 160),
(16, 'Dhaka', 'Noakhali', 150),
(17, 'Chittagong', 'Bandarban', 90),
(18, 'Chittagong', 'Rangamati', 70),
(19, 'Sylhet', 'Sunamganj', 60),
(20, 'Khulna', 'Satkhira', 110),
(21, 'Rajshahi', 'Chapai Nawabganj', 80),
(22, 'Barisal', 'Jhalokati', 45);

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
(14, 3, 'Khulna', 5),
(15, 7, 'Dhaka', 1),
(16, 7, 'Tangail', 2),
(17, 7, 'Sirajganj', 3),
(18, 7, 'Rajshahi', 4),
(19, 8, 'Dhaka', 1),
(20, 8, 'Gazipur', 2),
(21, 8, 'Bogura', 3),
(22, 8, 'Rangpur', 4),
(23, 9, 'Dhaka', 1),
(24, 9, 'Gazipur', 2),
(25, 9, 'Trishal', 3),
(26, 9, 'Mymensingh', 4),
(27, 10, 'Rajshahi', 1),
(28, 10, 'Natore', 2),
(29, 10, 'Naogaon', 3),
(30, 11, 'Rangpur', 1),
(31, 11, 'Thakurgaon', 2),
(32, 11, 'Dinajpur', 3),
(33, 12, 'Barisal', 1),
(34, 12, 'Bakerganj', 2),
(35, 12, 'Patuakhali', 3),
(36, 13, 'Dhaka', 1),
(37, 13, 'Narayanganj', 2),
(38, 13, 'Comilla', 3),
(39, 13, 'Chittagong', 4),
(40, 13, 'Cox\'s Bazar', 5),
(41, 13, 'Bandarban', 6),
(42, 14, 'Dhaka', 1),
(43, 14, 'Narsingdi', 2),
(44, 14, 'Bhairab', 3),
(45, 14, 'Kishoreganj', 4),
(46, 14, 'Rangamati', 5),
(47, 15, 'Dhaka', 1),
(48, 15, 'Tangail', 2),
(49, 15, 'Sirajganj', 3),
(50, 15, 'Pabna', 4),
(51, 17, 'Chittagong', 1),
(52, 17, 'Patia', 2),
(53, 17, 'Chandanaish', 3),
(54, 17, 'Bandarban', 4),
(55, 19, 'Sylhet', 1),
(56, 19, 'South Surma', 2),
(57, 19, 'Sunamganj', 3);

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
(34, 8, '2025-04-20 19:00:00', '2025-04-20 21:30:00', 600.00),
(35, 9, '2025-04-22 06:00:00', '2025-04-22 11:30:00', 1000.00),
(36, 9, '2025-04-22 15:00:00', '2025-04-22 20:30:00', 1000.00),
(37, 10, '2025-04-22 07:00:00', '2025-04-22 13:00:00', 1050.00),
(38, 10, '2025-04-22 16:00:00', '2025-04-22 22:00:00', 1050.00),
(39, 11, '2025-04-22 08:00:00', '2025-04-22 10:30:00', 400.00),
(40, 11, '2025-04-22 17:00:00', '2025-04-22 19:30:00', 400.00),
(41, 12, '2025-04-22 09:00:00', '2025-04-22 12:00:00', 500.00),
(42, 12, '2025-04-22 18:00:00', '2025-04-22 21:00:00', 500.00),
(43, 13, '2025-04-22 10:00:00', '2025-04-22 12:30:00', 450.00),
(44, 13, '2025-04-22 19:00:00', '2025-04-22 21:30:00', 450.00),
(45, 14, '2025-04-22 11:00:00', '2025-04-22 13:30:00', 420.00),
(46, 14, '2025-04-22 20:00:00', '2025-04-22 22:30:00', 420.00),
(47, 1, '2025-05-01 08:00:00', '2025-05-01 12:30:00', 1200.00),
(48, 1, '2025-05-01 14:00:00', '2025-05-01 18:30:00', 1200.00),
(49, 1, '2025-05-02 08:00:00', '2025-05-02 12:30:00', 1200.00),
(50, 2, '2025-05-01 07:30:00', '2025-05-01 12:00:00', 1100.00),
(51, 2, '2025-05-02 13:30:00', '2025-05-02 18:00:00', 1100.00),
(52, 11, '2025-05-03 06:00:00', '2025-05-03 11:00:00', 900.00),
(53, 11, '2025-05-04 15:00:00', '2025-05-04 20:00:00', 900.00),
(54, 15, '2025-05-05 07:00:00', '2025-05-05 13:00:00', 1500.00),
(55, 16, '2025-05-06 08:00:00', '2025-05-06 12:30:00', 1000.00),
(56, 17, '2025-05-07 09:00:00', '2025-05-07 12:00:00', 800.00),
(57, 18, '2025-05-08 10:00:00', '2025-05-08 14:00:00', 950.00),
(58, 19, '2025-05-09 11:00:00', '2025-05-09 13:30:00', 600.00),
(59, 1, '2025-05-10 08:00:00', '2025-05-10 12:30:00', 1300.00),
(60, 2, '2025-05-11 07:30:00', '2025-05-11 12:00:00', 1200.00),
(61, 11, '2025-05-12 06:00:00', '2025-05-12 11:00:00', 950.00),
(62, 1, '2025-05-13 20:00:00', '2025-05-14 00:30:00', 1400.00),
(63, 2, '2025-05-14 21:00:00', '2025-05-15 01:30:00', 1300.00),
(64, 11, '2025-05-15 22:00:00', '2025-05-16 03:00:00', 1100.00),
(65, 1, '2025-04-17 08:00:00', '2025-04-17 12:30:00', 1200.00),
(66, 1, '2025-04-17 14:00:00', '2025-04-17 18:30:00', 1200.00),
(67, 1, '2025-04-18 08:00:00', '2025-04-18 12:30:00', 1200.00),
(68, 1, '2025-04-18 14:00:00', '2025-04-18 18:30:00', 1200.00),
(69, 1, '2025-04-19 08:00:00', '2025-04-19 12:30:00', 1200.00),
(70, 1, '2025-04-19 14:00:00', '2025-04-19 18:30:00', 1200.00),
(71, 1, '2025-04-20 08:00:00', '2025-04-20 12:30:00', 1200.00),
(72, 1, '2025-04-20 14:00:00', '2025-04-20 18:30:00', 1200.00),
(73, 1, '2025-04-21 08:00:00', '2025-04-21 12:30:00', 1200.00),
(74, 1, '2025-04-21 14:00:00', '2025-04-21 18:30:00', 1200.00),
(75, 1, '2025-04-22 08:00:00', '2025-04-22 12:30:00', 1200.00),
(76, 1, '2025-04-22 14:00:00', '2025-04-22 18:30:00', 1200.00),
(77, 1, '2025-04-23 08:00:00', '2025-04-23 12:30:00', 1200.00),
(78, 1, '2025-04-23 14:00:00', '2025-04-23 18:30:00', 1200.00),
(79, 1, '2025-04-24 08:00:00', '2025-04-24 12:30:00', 1200.00),
(80, 1, '2025-04-24 14:00:00', '2025-04-24 18:30:00', 1200.00),
(81, 1, '2025-04-25 08:00:00', '2025-04-25 12:30:00', 1200.00),
(82, 1, '2025-04-25 14:00:00', '2025-04-25 18:30:00', 1200.00),
(83, 1, '2025-04-26 08:00:00', '2025-04-26 12:30:00', 1200.00),
(84, 1, '2025-04-26 14:00:00', '2025-04-26 18:30:00', 1200.00),
(85, 1, '2025-04-27 08:00:00', '2025-04-27 12:30:00', 1200.00),
(86, 1, '2025-04-27 14:00:00', '2025-04-27 18:30:00', 1200.00),
(87, 1, '2025-04-28 08:00:00', '2025-04-28 12:30:00', 1200.00),
(88, 1, '2025-04-28 14:00:00', '2025-04-28 18:30:00', 1200.00),
(89, 1, '2025-04-29 08:00:00', '2025-04-29 12:30:00', 1200.00),
(90, 1, '2025-04-29 14:00:00', '2025-04-29 18:30:00', 1200.00),
(91, 1, '2025-04-30 08:00:00', '2025-04-30 12:30:00', 1200.00),
(92, 1, '2025-04-30 14:00:00', '2025-04-30 18:30:00', 1200.00),
(93, 2, '2025-04-17 07:30:00', '2025-04-17 12:00:00', 1100.00),
(94, 2, '2025-04-17 13:30:00', '2025-04-17 18:00:00', 1100.00),
(95, 2, '2025-04-18 07:30:00', '2025-04-18 12:00:00', 1100.00),
(96, 2, '2025-04-18 13:30:00', '2025-04-18 18:00:00', 1100.00),
(97, 2, '2025-04-19 07:30:00', '2025-04-19 12:00:00', 1100.00),
(98, 2, '2025-04-19 13:30:00', '2025-04-19 18:00:00', 1100.00),
(99, 2, '2025-04-20 07:30:00', '2025-04-20 12:00:00', 1100.00),
(100, 2, '2025-04-20 13:30:00', '2025-04-20 18:00:00', 1100.00),
(101, 2, '2025-04-21 07:30:00', '2025-04-21 12:00:00', 1100.00),
(102, 2, '2025-04-21 13:30:00', '2025-04-21 18:00:00', 1100.00),
(103, 2, '2025-04-22 07:30:00', '2025-04-22 12:00:00', 1100.00),
(104, 2, '2025-04-22 13:30:00', '2025-04-22 18:00:00', 1100.00),
(105, 2, '2025-04-23 07:30:00', '2025-04-23 12:00:00', 1100.00),
(106, 2, '2025-04-23 13:30:00', '2025-04-23 18:00:00', 1100.00),
(107, 2, '2025-04-24 07:30:00', '2025-04-24 12:00:00', 1100.00),
(108, 2, '2025-04-24 13:30:00', '2025-04-24 18:00:00', 1100.00),
(109, 2, '2025-04-25 07:30:00', '2025-04-25 12:00:00', 1100.00),
(110, 2, '2025-04-25 13:30:00', '2025-04-25 18:00:00', 1100.00),
(111, 2, '2025-04-26 07:30:00', '2025-04-26 12:00:00', 1100.00),
(112, 2, '2025-04-26 13:30:00', '2025-04-26 18:00:00', 1100.00),
(113, 2, '2025-04-27 07:30:00', '2025-04-27 12:00:00', 1100.00),
(114, 2, '2025-04-27 13:30:00', '2025-04-27 18:00:00', 1100.00),
(115, 2, '2025-04-28 07:30:00', '2025-04-28 12:00:00', 1100.00),
(116, 2, '2025-04-28 13:30:00', '2025-04-28 18:00:00', 1100.00),
(117, 2, '2025-04-29 07:30:00', '2025-04-29 12:00:00', 1100.00),
(118, 2, '2025-04-29 13:30:00', '2025-04-29 18:00:00', 1100.00),
(119, 2, '2025-04-30 07:30:00', '2025-04-30 12:00:00', 1100.00),
(120, 2, '2025-04-30 13:30:00', '2025-04-30 18:00:00', 1100.00),
(121, 3, '2025-04-17 09:00:00', '2025-04-17 13:00:00', 900.00),
(122, 3, '2025-04-17 15:00:00', '2025-04-17 19:00:00', 900.00),
(123, 3, '2025-04-18 09:00:00', '2025-04-18 13:00:00', 900.00),
(124, 3, '2025-04-18 15:00:00', '2025-04-18 19:00:00', 900.00),
(125, 3, '2025-04-19 09:00:00', '2025-04-19 13:00:00', 900.00),
(126, 3, '2025-04-19 15:00:00', '2025-04-19 19:00:00', 900.00),
(127, 3, '2025-04-20 09:00:00', '2025-04-20 13:00:00', 900.00),
(128, 3, '2025-04-20 15:00:00', '2025-04-20 19:00:00', 900.00),
(129, 3, '2025-04-21 09:00:00', '2025-04-21 13:00:00', 900.00),
(130, 3, '2025-04-21 15:00:00', '2025-04-21 19:00:00', 900.00),
(131, 3, '2025-04-22 09:00:00', '2025-04-22 13:00:00', 900.00),
(132, 3, '2025-04-22 15:00:00', '2025-04-22 19:00:00', 900.00),
(133, 3, '2025-04-23 09:00:00', '2025-04-23 13:00:00', 900.00),
(134, 3, '2025-04-23 15:00:00', '2025-04-23 19:00:00', 900.00),
(135, 3, '2025-04-24 09:00:00', '2025-04-24 13:00:00', 900.00),
(136, 3, '2025-04-24 15:00:00', '2025-04-24 19:00:00', 900.00),
(137, 3, '2025-04-25 09:00:00', '2025-04-25 13:00:00', 900.00),
(138, 3, '2025-04-25 15:00:00', '2025-04-25 19:00:00', 900.00),
(139, 3, '2025-04-26 09:00:00', '2025-04-26 13:00:00', 900.00),
(140, 3, '2025-04-26 15:00:00', '2025-04-26 19:00:00', 900.00),
(141, 3, '2025-04-27 09:00:00', '2025-04-27 13:00:00', 900.00),
(142, 3, '2025-04-27 15:00:00', '2025-04-27 19:00:00', 900.00),
(143, 3, '2025-04-28 09:00:00', '2025-04-28 13:00:00', 900.00),
(144, 3, '2025-04-28 15:00:00', '2025-04-28 19:00:00', 900.00),
(145, 3, '2025-04-29 09:00:00', '2025-04-29 13:00:00', 900.00),
(146, 3, '2025-04-29 15:00:00', '2025-04-29 19:00:00', 900.00),
(147, 3, '2025-04-30 09:00:00', '2025-04-30 13:00:00', 900.00),
(148, 3, '2025-04-30 15:00:00', '2025-04-30 19:00:00', 900.00),
(149, 1, '2025-04-17 22:00:00', '2025-04-18 02:30:00', 1400.00),
(150, 1, '2025-04-18 22:00:00', '2025-04-19 02:30:00', 1400.00),
(151, 1, '2025-04-19 22:00:00', '2025-04-20 02:30:00', 1400.00),
(152, 1, '2025-04-20 22:00:00', '2025-04-21 02:30:00', 1400.00),
(153, 1, '2025-04-21 22:00:00', '2025-04-22 02:30:00', 1400.00),
(154, 1, '2025-04-22 22:00:00', '2025-04-23 02:30:00', 1400.00),
(155, 1, '2025-04-23 22:00:00', '2025-04-24 02:30:00', 1400.00),
(156, 1, '2025-04-24 22:00:00', '2025-04-25 02:30:00', 1400.00),
(157, 1, '2025-04-25 22:00:00', '2025-04-26 02:30:00', 1400.00),
(158, 1, '2025-04-26 22:00:00', '2025-04-27 02:30:00', 1400.00),
(159, 1, '2025-04-27 22:00:00', '2025-04-28 02:30:00', 1400.00),
(160, 1, '2025-04-28 22:00:00', '2025-04-29 02:30:00', 1400.00),
(161, 1, '2025-04-29 22:00:00', '2025-04-30 02:30:00', 1400.00),
(162, 1, '2025-04-30 22:00:00', '2025-05-01 02:30:00', 1400.00),
(163, 2, '2025-04-17 21:30:00', '2025-04-18 02:00:00', 1300.00),
(164, 2, '2025-04-18 21:30:00', '2025-04-19 02:00:00', 1300.00),
(165, 2, '2025-04-19 21:30:00', '2025-04-20 02:00:00', 1300.00),
(166, 2, '2025-04-20 21:30:00', '2025-04-21 02:00:00', 1300.00),
(167, 2, '2025-04-21 21:30:00', '2025-04-22 02:00:00', 1300.00),
(168, 2, '2025-04-22 21:30:00', '2025-04-23 02:00:00', 1300.00),
(169, 2, '2025-04-23 21:30:00', '2025-04-24 02:00:00', 1300.00),
(170, 2, '2025-04-24 21:30:00', '2025-04-25 02:00:00', 1300.00),
(171, 2, '2025-04-25 21:30:00', '2025-04-26 02:00:00', 1300.00),
(172, 2, '2025-04-26 21:30:00', '2025-04-27 02:00:00', 1300.00),
(173, 2, '2025-04-27 21:30:00', '2025-04-28 02:00:00', 1300.00),
(174, 2, '2025-04-28 21:30:00', '2025-04-29 02:00:00', 1300.00),
(175, 2, '2025-04-29 21:30:00', '2025-04-30 02:00:00', 1300.00),
(176, 2, '2025-04-30 21:30:00', '2025-05-01 02:00:00', 1300.00);

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
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `schedule_id` (`schedule_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Buses`
--
ALTER TABLE `Buses`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Routes`
--
ALTER TABLE `Routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `Schedules`
--
ALTER TABLE `Schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

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
