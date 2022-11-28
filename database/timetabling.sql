-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2022 at 02:11 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetabling`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(20) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`id`, `department_id`, `department_name`, `date_created`) VALUES
(1, 'DPT001', 'Department of Information Technology', '2022-11-28 15:04:08'),
(2, 'DPT002', 'Department of Computer Science', '2022-11-28 15:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `lab_details`
--

CREATE TABLE `lab_details` (
  `id` int(11) NOT NULL,
  `lab_id` varchar(20) NOT NULL,
  `lab_name` varchar(100) NOT NULL,
  `lab_capacity` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_details`
--

INSERT INTO `lab_details` (`id`, `lab_id`, `lab_name`, `lab_capacity`, `date_created`) VALUES
(1, 'LAB001', 'LAB 1', 55, '2022-11-28 12:10:34'),
(2, 'LAB002', 'LAB 2', 55, '2022-11-28 12:10:34'),
(3, 'LAB003', 'LAB 3', 55, '2022-11-28 12:11:07'),
(4, 'LAB004', 'LAB 4', 55, '2022-11-28 12:11:07'),
(5, 'LAB005', 'LAB 5', 140, '2022-11-28 12:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_department_details`
--

CREATE TABLE `lecturer_department_details` (
  `id` int(11) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `department_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer_department_details`
--

INSERT INTO `lecturer_department_details` (`id`, `lecturer_id`, `department_id`) VALUES
(1, 'PF001', 'DPT001'),
(2, 'PF002', 'DPT001');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_details`
--

CREATE TABLE `lecturer_details` (
  `id` int(11) NOT NULL,
  `pf_number` varchar(20) NOT NULL,
  `lecturer_firstname` varchar(255) NOT NULL,
  `lecturer_lastname` varchar(255) NOT NULL,
  `lecturer_email` varchar(50) NOT NULL,
  `lecturer_phone` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer_details`
--

INSERT INTO `lecturer_details` (`id`, `pf_number`, `lecturer_firstname`, `lecturer_lastname`, `lecturer_email`, `lecturer_phone`, `date_created`) VALUES
(1, 'PF001', 'Dr. Titus', 'Muhambe', 'muhambemukhisa@gmail.com', 752478957, '2022-11-28 15:46:45'),
(2, 'PF002', 'Bethuel', 'Okello', 'okellobethuel23@gmail.com', 785454852, '2022-11-28 15:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_hall_unit_time_details`
--

CREATE TABLE `lecturer_hall_unit_time_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `hall_id` varchar(20) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `start_from` date NOT NULL,
  `end_at` date NOT NULL,
  `weekday` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_school_details`
--

CREATE TABLE `lecturer_school_details` (
  `id` int(11) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `school_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer_school_details`
--

INSERT INTO `lecturer_school_details` (`id`, `lecturer_id`, `school_id`) VALUES
(1, 'PF001', 'SCH001'),
(2, 'PF002', 'SCH001');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_unit_details`
--

CREATE TABLE `lecturer_unit_details` (
  `id` int(11) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `unit_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer_unit_details`
--

INSERT INTO `lecturer_unit_details` (`id`, `lecturer_id`, `unit_id`) VALUES
(1, 'PF001', 'CIT 401');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_halls`
--

CREATE TABLE `lecture_halls` (
  `id` int(11) NOT NULL,
  `hall_id` varchar(20) NOT NULL,
  `hall_name` varchar(255) NOT NULL,
  `hall_capacity` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture_halls`
--

INSERT INTO `lecture_halls` (`id`, `hall_id`, `hall_name`, `hall_capacity`, `date_added`) VALUES
(1, 'HALL001', 'TB 1', 60, '2022-11-28 12:06:37'),
(2, 'HALL002', 'TB 2', 150, '2022-11-28 12:06:37'),
(3, 'HALL003', 'TB 3', 60, '2022-11-28 12:07:37'),
(4, 'HALL004', 'TB 4', 60, '2022-11-28 12:07:37'),
(5, 'HALL005', 'TB 5', 60, '2022-11-28 12:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `school_department_details`
--

CREATE TABLE `school_department_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `department_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_department_details`
--

INSERT INTO `school_department_details` (`id`, `school_id`, `department_id`) VALUES
(1, 'SCH001', 'DPT001'),
(2, 'SCH001', 'DPT002');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `school_id`, `school_name`, `date_created`) VALUES
(1, 'SCH001', 'School of Computing and Informatics', '2022-11-28 15:03:11'),
(2, 'SCH002', 'School of Arts and Social Sciences', '2022-11-28 15:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `school_lab_details`
--

CREATE TABLE `school_lab_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `lab_id` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_lab_details`
--

INSERT INTO `school_lab_details` (`id`, `school_id`, `lab_id`, `date_created`) VALUES
(1, 'SCH001', 'LAB001', '2022-11-28 12:14:33'),
(2, 'SCH001', 'LAB002', '2022-11-28 12:14:33'),
(3, 'SCH001', 'LAB003', '2022-11-28 12:14:49'),
(4, 'SCH001', 'LAB004', '2022-11-28 12:14:49'),
(5, 'SCH001', 'LAB005', '2022-11-28 12:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(20) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_code`, `unit_name`, `date_added`) VALUES
(1, 'CIT 401', 'SOFTWARE PROJECT MANAGEMENT', '2022-11-20 20:01:56'),
(2, 'CIT 403', 'MANAGEMENT INFORMATION SYSTEMS', '2022-11-28 12:50:07'),
(3, 'CIT 405', 'E-COMMERCE', '2022-11-28 12:50:07'),
(4, 'CIT 407', 'IT AND SOCIETY', '2022-11-28 12:51:26'),
(5, 'CIT 409', 'IT PROJECT I', '2022-11-28 12:51:26'),
(6, 'CIT 411', 'DISTRIBUTED SYSTEMS', '2022-11-28 12:52:10'),
(7, 'CIT 415', ' WEB APPLICATION PROGRAMMING', '2022-11-28 12:53:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lab_details`
--
ALTER TABLE `lab_details`
  ADD PRIMARY KEY (`lab_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dpt` (`department_id`),
  ADD KEY `lec` (`lecturer_id`);

--
-- Indexes for table `lecturer_details`
--
ALTER TABLE `lecturer_details`
  ADD PRIMARY KEY (`pf_number`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lecturer_hall_unit_time_details`
--
ALTER TABLE `lecturer_hall_unit_time_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit` (`unit_id`),
  ADD KEY `hall` (`hall_id`),
  ADD KEY `lecd` (`lecturer_id`);

--
-- Indexes for table `lecturer_school_details`
--
ALTER TABLE `lecturer_school_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lec` (`lecturer_id`),
  ADD KEY `sch` (`school_id`);

--
-- Indexes for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lec` (`lecturer_id`),
  ADD KEY `unit` (`unit_id`);

--
-- Indexes for table `lecture_halls`
--
ALTER TABLE `lecture_halls`
  ADD PRIMARY KEY (`hall_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`school_id`),
  ADD KEY `dpt` (`department_id`);

--
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `school_lab_details`
--
ALTER TABLE `school_lab_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schl` (`school_id`),
  ADD KEY `schlab` (`lab_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_code`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_details`
--
ALTER TABLE `lab_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_details`
--
ALTER TABLE `lecturer_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_hall_unit_time_details`
--
ALTER TABLE `lecturer_hall_unit_time_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_school_details`
--
ALTER TABLE `lecturer_school_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecture_halls`
--
ALTER TABLE `lecture_halls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `school_details`
--
ALTER TABLE `school_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_lab_details`
--
ALTER TABLE `school_lab_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD CONSTRAINT `dpt` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lc` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer_details` (`pf_number`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_hall_unit_time_details`
--
ALTER TABLE `lecturer_hall_unit_time_details`
  ADD CONSTRAINT `halld` FOREIGN KEY (`hall_id`) REFERENCES `lecture_halls` (`hall_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lecd` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer_details` (`pf_number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unitd` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_school_details`
--
ALTER TABLE `lecturer_school_details`
  ADD CONSTRAINT `lec` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer_details` (`pf_number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sch` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD CONSTRAINT `lecturer` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer_details` (`pf_number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD CONSTRAINT `department` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `school` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON UPDATE CASCADE;

--
-- Constraints for table `school_lab_details`
--
ALTER TABLE `school_lab_details`
  ADD CONSTRAINT `labid` FOREIGN KEY (`lab_id`) REFERENCES `lab_details` (`lab_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schoolid` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
