-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 11:28 AM
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
-- Database: `student_activity_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `students_info`
--

CREATE TABLE `students_info` (
  `student_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `program` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `remaining_training_days` int(11) DEFAULT 90,
  `remaining_visits` int(11) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_info`
--

INSERT INTO `students_info` (`student_id`, `name`, `program`, `level`, `phone`, `remaining_training_days`, `remaining_visits`) VALUES
(123456, 'Esmail Mostafa Esmail', 'it', '2', '01286336123', 60, 2),
(123456789, 'ahmed ramadon ', 'it', '2', ' 01117416322', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `training_info`
--

CREATE TABLE `training_info` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `training_name` varchar(100) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `proof_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_info`
--

INSERT INTO `training_info` (`id`, `student_id`, `training_name`, `organization`, `start_date`, `end_date`, `proof_image`) VALUES
(1, 123456, 'web_pentest 123', 'red nexus', '2024-02-25', '2024-03-25', 'uploads/template-18698-17288017261168.jpg'),
(2, 123456789, 'web_pentest 123', 'red nexus', '2024-02-04', '2024-03-04', 'uploads/template-18698-17288017261168.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `visit_info`
--

CREATE TABLE `visit_info` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `visit_name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `proof_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit_info`
--

INSERT INTO `visit_info` (`id`, `student_id`, `visit_name`, `location`, `visit_date`, `proof_image`) VALUES
(1, 123456, 'web_pentest1', 'cairo', '2024-05-08', 'uploads/template-18698-17288017261168.jpg'),
(2, 123456, 'web_pentest1', 'cairo', '2024-05-08', 'uploads/template-18698-17288017261168.jpg'),
(3, 123456, 'web_pentest1', 'cairo', '2024-02-25', 'uploads/template-18698-17288017261168.jpg'),
(4, 123456789, 'web_pentest1', 'cairo', '2024-02-25', 'uploads/template-18698-17288017261168.jpg'),
(5, 123456789, 'web_pentest1', 'cairo', '2024-02-25', 'uploads/template-18698-17288017261168.jpg'),
(6, 123456789, 'web_pentest1', 'cairo', '2024-02-25', 'uploads/template-18698-17288017261168.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students_info`
--
ALTER TABLE `students_info`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `training_info`
--
ALTER TABLE `training_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `visit_info`
--
ALTER TABLE `visit_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `training_info`
--
ALTER TABLE `training_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visit_info`
--
ALTER TABLE `visit_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `training_info`
--
ALTER TABLE `training_info`
  ADD CONSTRAINT `training_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students_info` (`student_id`);

--
-- Constraints for table `visit_info`
--
ALTER TABLE `visit_info`
  ADD CONSTRAINT `visit_info_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students_info` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
