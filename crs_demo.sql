-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 12:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crs_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(40) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `name`) VALUES
('ad@', 'arham');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `name` varchar(40) NOT NULL,
  `contact` int(15) DEFAULT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`name`, `contact`, `email`) VALUES
('user1', 1234567890, 'u1@'),
('user2', 1234567890, 'u2@'),
('user3', 1234567890, 'u3@');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(36) NOT NULL,
  `issue` text NOT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'pending',
  `department` varchar(40) NOT NULL,
  `assigned_to` varchar(30) NOT NULL DEFAULT 'none',
  `employee_feedback` text DEFAULT 'null',
  `citizen_feedback` text NOT NULL DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `name`, `contact`, `email`, `issue`, `status`, `department`, `assigned_to`, `employee_feedback`, `citizen_feedback`) VALUES
(73, 'user1', 1234567890, 'u1@', 'lots of garbage here. please look into this.', 'pending', 'cleanliness', '0', 'null', 'null'),
(74, 'user1', 1234567890, 'u1@', 'roads have potholes. solve asap.', 'pending', 'infrastructure', '0', 'null', 'null'),
(75, 'user1', 1234567890, 'u1@', 'stray dogs making it difficult for kids to go out.', 'pending', 'other', '0', 'null', 'null'),
(76, 'user1', 1234567890, 'u1@', 'mosquito colony near old drainage causing virals.', 're-opened', 'health', '0', 'null', 'null'),
(77, 'user1', 1234567890, 'u1@', 'lots of viral fever within town.', 'resolved', 'health', '0', 'null', 'null'),
(78, 'user2', 1234567890, 'u2@', 'bad condition of railway crossing.', 'pending', 'infrastructure', '0', 'null', 'null'),
(79, 'user2', 1234567890, 'u2@', 'unknown flu spreading across town. issue necessary help.', 'pending', 'health', '0', 'null', 'null'),
(80, 'user3', 1234567890, 'u3@', 'mess created by weekly market needs to be cleaned up asap.', 'pending', 'cleanliness', '0', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `head` varchar(40) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`name`, `email`, `head`) VALUES
('cleanliness', 'c@', 'anuj'),
('health', 'h@', 'atul'),
('infrastructure', 'i@', 'arjun'),
('other', 'o@', 'anurag');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL DEFAULT 'null',
  `contact` int(15) NOT NULL,
  `department` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `name`, `email`, `contact`, `department`) VALUES
(24, 'atul', 'atul@', 0, 'health'),
(25, 'arjun', 'arjun@', 0, 'infrastructure'),
(26, 'anuj', 'anuj@', 0, 'cleanliness'),
(27, 'anurag', 'anurag@', 0, 'other'),
(28, 'arham', 'arham@', 12345678, 'health'),
(32, 'junaid', 'junaid@', 1234567890, 'health');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `email` varchar(40) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'citizen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`email`, `pass`, `role`) VALUES
('ad@', 'ad', 'admin'),
('anuj@', 'a', 'employee'),
('anurag@', 'a', 'employee'),
('arham@', 'a', 'employee'),
('arjun@', 'a', 'employee'),
('atul@', 'a', 'employee'),
('c@', 'c', 'department'),
('h@', 'h', 'department'),
('i@', 'i', 'department'),
('junaid@', 'j', 'employee'),
('o@', 'o', 'department'),
('u1@', 'u', 'citizen'),
('u2@', 'u', 'citizen'),
('u3@', 'u', 'citizen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `email` (`email`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `test` (`department`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`email`) REFERENCES `citizen` (`email`),
  ADD CONSTRAINT `complaints_ibfk_2` FOREIGN KEY (`department`) REFERENCES `department` (`name`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `test` FOREIGN KEY (`department`) REFERENCES `department` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
