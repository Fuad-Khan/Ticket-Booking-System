-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2025 at 09:21 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  ADD PRIMARY KEY (`stop_id`),
  ADD KEY `route_id` (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  MODIFY `stop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Route_Stops`
--
ALTER TABLE `Route_Stops`
  ADD CONSTRAINT `Route_Stops_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `Routes` (`route_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
