-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2022 at 03:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brs_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bicycles`
--

CREATE TABLE `bicycles` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `isavailable` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bicycles`
--

INSERT INTO `bicycles` (`id`, `name`, `isavailable`) VALUES
(1, 'bicycle 1', 0),
(2, 'bicycle 2', 0),
(3, 'bicycle 3', 1),
(4, 'bicycle 4', 1),
(5, 'bicycle 5', 1),
(6, 'bicycle 6', 1),
(7, 'bicycle 7', 1),
(8, 'bicycle 8', 1),
(9, 'bicycle 9', 1),
(10, 'bicycle 10', 1),
(11, 'bicycle 11', 1),
(12, 'bicycle 12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `req_on` varchar(20) NOT NULL,
  `req_at` varchar(10) NOT NULL DEFAULT '10:00AM',
  `handover_on` varchar(20) DEFAULT NULL,
  `handover_at` varchar(20) DEFAULT NULL,
  `approve` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `bid`, `comment`, `req_on`, `req_at`, `handover_on`, `handover_at`, `approve`) VALUES
(2, 2, 2, 'test', '2022-10-17', '10:00 AM', '2022-10-17', NULL, 0),
(3, 2, 3, 'test bi 3', '2022-10-16', '10:00 AM', '2022-10-20', '2022-10-10', 1),
(4, 2, 4, 'go to the home', '10-16-2022', '10:00 AM', NULL, NULL, 1),
(5, 2, 5, 'test bokking', '10-16-2022', '10:00 AM', '2022-10-25', '23:08', 1),
(6, 2, 3, 'i want tommorow', '10-16-2022', '10:00 AM', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `password` varchar(80) NOT NULL,
  `isadmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `contact`, `password`, `isadmin`) VALUES
(2, '21ug0178', 'kushangayantha001@gmail.com', '0712720033', '$2y$10$8pN7Wy7d39eGAzbRg.fco.sICvEX4D6/GEEN4MhJDiWmjYDnkdWdG', 0),
(7, 'adminbrs', 'admin@brs.lk', '0721021286', '$2y$10$lMoKQkdSKPwWXZv2cvRUTuP333RNjKGG4sY/1Y8LqmnMQMLfTKLLW', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bicycles`
--
ALTER TABLE `bicycles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USERID` (`user_id`),
  ADD KEY `FK_BID` (`bid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bicycles`
--
ALTER TABLE `bicycles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `FK_BID` FOREIGN KEY (`bid`) REFERENCES `bicycles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USERID` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
