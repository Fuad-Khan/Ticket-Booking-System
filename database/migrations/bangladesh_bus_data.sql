
-- Additional Data for Routes
INSERT INTO `Routes` (`route_id`, `source`, `destination`, `distance`) VALUES
(7, 'Dhaka', 'Rajshahi', 245),
(8, 'Dhaka', 'Rangpur', 300),
(9, 'Dhaka', 'Mymensingh', 120),
(10, 'Rajshahi', 'Naogaon', 110),
(11, 'Rangpur', 'Dinajpur', 80),
(12, 'Barisal', 'Patuakhali', 95);

-- Additional Data for Route_Stops
INSERT INTO `Route_Stops` (`stop_id`, `route_id`, `stop_name`, `stop_order`) VALUES
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
(35, 12, 'Patuakhali', 3);

-- Additional Data for Buses
INSERT INTO `Buses` (`bus_id`, `bus_name`, `bus_type`, `total_seats`, `coach_number`, `route_id`) VALUES
(9, 'Desh Travels', 'AC', 40, 'DT-908', 7),
(10, 'Nabil Paribahan', 'Non-AC', 36, 'NP-100', 8),
(11, 'Shyamoli Paribahan', 'AC', 40, 'SP-101', 9),
(12, 'Hanif Enterprise', 'AC', 38, 'HE-110', 10),
(13, 'Green Line', 'Non-AC', 36, 'GL-202', 11),
(14, 'Ena Transport', 'AC', 40, 'ET-115', 12);

-- Additional Data for Schedules
INSERT INTO `Schedules` (`schedule_id`, `bus_id`, `departure_time`, `arrival_time`, `price`) VALUES
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
(46, 14, '2025-04-22 20:00:00', '2025-04-22 22:30:00', 420.00);
