-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 05:40 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mobile` varchar(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `mobile`, `profile_image`) VALUES
(42, 'admin', 'admin@gmail.com', '$2y$10$cBoV9bJWGXTK/UHgke14pexnSLoxh4DZEDz1C9YFOW3LeWZM9gR9q', '2024-12-17 16:39:27', '999999999', '../uploads/download.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `date_of_journey` date NOT NULL,
  `seats` varchar(255) NOT NULL,
  `total_fare` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Confirmed',
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_number` varchar(13) NOT NULL,
  `route_from` varchar(100) DEFAULT NULL,
  `route_to` varchar(100) DEFAULT NULL,
  `bus_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `route_from` varchar(100) NOT NULL,
  `route_to` varchar(100) NOT NULL,
  `time_of_departure` time NOT NULL,
  `fare` decimal(10,2) NOT NULL,
  `total_seats` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `bus_id` int(11) NOT NULL,
  `bus_number` varchar(30) DEFAULT NULL,
  `booked_seats` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_name`, `route_from`, `route_to`, `time_of_departure`, `fare`, `total_seats`, `created_at`, `bus_id`, `bus_number`, `booked_seats`) VALUES
(49, 'rajkot express', 'rajkot', 'chotila', '23:22:00', 120.00, 45, '2024-12-04 15:50:56', 111, 'GJ 18 ZZ 4563', ''),
(46, 'chotila express', 'chotila', 'rajkot', '08:23:00', 120.00, 45, '2024-12-04 15:49:45', 146, 'GJ 18 ZZ 4883', ''),
(48, 'rajkot local', 'rajkot', 'chotila', '09:24:00', 38.00, 40, '2024-12-04 15:50:36', 364, 'GJ 18 ZZ 6952', ''),
(45, 'chotila local', 'chotila', 'rajkot', '07:22:00', 38.00, 40, '2024-12-04 15:49:17', 521, 'GJ 18 ZZ 4563', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `review_text`, `created_at`) VALUES
(7, 'James Brown', 3, ' \"The ride was decent, but the bus was a bit late and the air conditioning wasn’t working properly. Still, it was an okay trip.\"', '2024-11-22 16:52:06'),
(9, 'David Lee', 2, '\"I was disappointed with my experience. The bus was not as clean as I expected, and there were several delays. I hope they improve in the future.\"', '2024-11-22 16:52:48'),
(11, 'Gautam', 4, 'its very good journey.\r\n', '2024-11-26 17:36:56'),
(12, 'alpha', 3, 'ahahhahaha\r\n', '2024-11-26 17:40:56'),
(13, 'parthvi', 4, 'nice ', '2024-12-05 15:37:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `adhar` varchar(12) NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `adhar`, `age`, `password`, `created_at`, `status`) VALUES
(20, 'Makwana Gautamkumar', 'gmakwana989@rku.ac.in', '8799170882', '651970650114', 19, '$2y$10$KvgokkgLmSwib7xd93dbaehSS0yoF6ibv/UVscFmVA4nV6Z0N7Yki', '2024-11-26 17:35:18', 'ACTIVE'),
(23, 'Dhruvraj', 'dhruvrajj@gmail.com', '8849320184', '651970650114', 19, '$2y$10$GpxY0pL11NRgIr5IbGILv.hgqHH6PR5o6nhym7/pqslFTbsfmeImm', '2024-12-04 16:13:33', 'ACTIVE'),
(24, 'amit makwana', 'amit@gmail.com', '9664544747', '651970650114', 16, '$2y$10$tCkJfMQwa3JIazmjzkFg/uT29mQZcCSj1wf2JICgVzm0Kc/LLQQuG', '2024-12-08 17:04:45', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_number` (`booking_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`bus_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
