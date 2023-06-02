-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 05:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sowms`
--

-- --------------------------------------------------------

--
-- Table structure for table `boolrecord`
--

CREATE TABLE `boolrecord` (
  `id` int(11) NOT NULL,
  `pon` varchar(50) NOT NULL,
  `record_stat` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `pon` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `unitcost` varchar(50) NOT NULL,
  `totalcost` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `arrived` varchar(50) NOT NULL,
  `withdrew` varchar(50) NOT NULL,
  `stock` varchar(50) NOT NULL,
  `waiting` varchar(50) NOT NULL,
  `remaining` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `arrived_status` varchar(50) NOT NULL,
  `withdraw_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `event` varchar(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `name`, `username`, `event`, `date`) VALUES
(1, 'rex rex', 'rex', 'login', '2023-05-28 23:29:41'),
(2, 'rex rex', 'rex', 'login', '2023-05-28 23:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `id` int(11) NOT NULL,
  `office_name` varchar(50) NOT NULL,
  `office_email` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`id`, `office_name`, `office_email`, `date_added`) VALUES
(3, 'Chancellor', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:17:10'),
(4, 'Finance Management System', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:17:45'),
(5, 'Human Resource', 'Human Resource', '2023-04-11 15:17:55'),
(6, 'Registrar', 'Registrar', '2023-04-11 15:18:05'),
(7, 'General Education', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:18:12'),
(8, 'BAC', 'plaza.richard.csucc@gmail.com', '2023-04-11 15:18:21'),
(9, 'Guidance and Counselling', 'rexcabutaje28@gmail.com', '2023-04-11 15:18:29'),
(10, 'Supply', 'Supply', '2023-04-11 15:18:36'),
(11, 'Campus Publication', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:18:47'),
(12, 'QUAMS', 'QUAMS', '2023-04-11 15:18:54'),
(13, 'RDE', 'RDE', '2023-04-11 15:19:01'),
(14, 'CEIT', 'rexcabutaje28@gmail.com', '2023-04-11 15:19:15'),
(15, 'Clinic', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:19:27'),
(16, 'Library', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:19:36'),
(17, 'CTHM office', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:19:44'),
(18, 'Computer Laboratory', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:19:51'),
(19, 'MAED', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:19:59'),
(20, 'Records', 'Records', '2023-04-11 15:20:06'),
(21, 'General Services', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:20:18'),
(22, 'DLHS', 'rex.cabutaje@csucc.edu.ph', '2023-04-11 15:20:25'),
(23, 'MIS', 'MIS', '2023-04-11 15:20:33'),
(24, 'Planning', 'Planning', '2023-04-11 15:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `pon`
--

CREATE TABLE `pon` (
  `id` int(11) NOT NULL,
  `pon` varchar(50) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trans_arrived`
--

CREATE TABLE `trans_arrived` (
  `id` int(11) NOT NULL,
  `entry_no` varchar(50) NOT NULL,
  `pon` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `unitcost` varchar(50) NOT NULL,
  `arrived` varchar(50) NOT NULL,
  `withdrew_qty` varchar(50) NOT NULL,
  `remaining` varchar(50) NOT NULL,
  `totalcost` varchar(50) NOT NULL,
  `waiting` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  `sent_date` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `withdraw_by` varchar(50) NOT NULL,
  `end_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `accesstype` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `app_password` varchar(50) NOT NULL,
  `email_full_name` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `accesstype`, `status`, `email`, `app_password`, `email_full_name`, `date`) VALUES
(1, 'Administrator', '', 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Superadmin', 'Active', 'rexcabutaje28@gmail.com', 'jbwc gbjo ukbk nbch', 'RICHARD', '2023-05-28 22:02:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pon`
--
ALTER TABLE `pon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trans_arrived`
--
ALTER TABLE `trans_arrived`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pon`
--
ALTER TABLE `pon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trans_arrived`
--
ALTER TABLE `trans_arrived`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
