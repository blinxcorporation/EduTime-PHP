-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2023 at 07:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetable`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(20) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`id`, `department_id`, `department_name`) VALUES
(1, 'DPT01', 'Information Technology'),
(2, 'DPT02', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `hall_details`
--

CREATE TABLE `hall_details` (
  `id` int(11) NOT NULL,
  `hall_id` varchar(20) NOT NULL,
  `hall_name` varchar(255) NOT NULL,
  `hall_capacity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hall_details`
--

INSERT INTO `hall_details` (`id`, `hall_id`, `hall_name`, `hall_capacity`) VALUES
(1, 'room01', 'TB 1', 60),
(2, 'room02', 'TB 2', 150),
(3, 'room03', 'TB 3', 60),
(4, 'room04', 'TB 4', 60),
(5, 'room05', 'TB 5', 60);

-- --------------------------------------------------------

--
-- Table structure for table `lab_details`
--

CREATE TABLE `lab_details` (
  `id` int(11) NOT NULL,
  `lab_id` varchar(20) NOT NULL,
  `lab_name` varchar(255) NOT NULL,
  `lab_capacity` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_details`
--

INSERT INTO `lab_details` (`id`, `lab_id`, `lab_name`, `lab_capacity`) VALUES
(1, 'LAB01', 'LAB I', 55),
(2, 'LAB02', 'LAB II', 55),
(3, 'LAB03', 'LAB III', 55),
(4, 'LAB04', 'LAB IV', 55),
(5, 'LAB05', 'LAB V', 140);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_department_details`
--

CREATE TABLE `lecturer_department_details` (
  `id` int(11) NOT NULL,
  `lec_id` varchar(20) NOT NULL,
  `dpt_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_department_details`
--

INSERT INTO `lecturer_department_details` (`id`, `lec_id`, `dpt_id`) VALUES
(1, 'PF01', 'DPT01'),
(2, 'PF02', 'DPT01');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_details`
--

CREATE TABLE `lecturer_details` (
  `id` int(11) NOT NULL,
  `pf_number` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_details`
--

INSERT INTO `lecturer_details` (`id`, `pf_number`, `title`, `firstname`, `lastname`, `email`, `phone`, `role`, `password`, `date_created`) VALUES
(1, 'PF01', 'Dr', ' Titus ', 'Muhambe', 'muhambemukhisa@gmail.com', 785412562, 'Chairperson', '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 19:57:25'),
(2, 'PF02', 'Madam', 'Violet', 'Settim', 'violetsettim@gmail.com', 752452868, 'Lecturer', '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 19:58:26'),
(3, 'PF03', 'Dr', ' Samuel', 'Oonge', 'oongesamuel12@gmail.com', 752452868, 'Lecturer', '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 20:49:58'),
(4, 'PF04', 'Mr', 'Jonathan', 'Owino', 'owino@maseno.ac.ke', 785412541, 'Coordinator', '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 20:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_unit_details`
--

CREATE TABLE `lecturer_unit_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_unit_details`
--

INSERT INTO `lecturer_unit_details` (`id`, `unit_id`, `lecturer_id`) VALUES
(1, 'CIT 401', 'PF03'),
(2, 'CIT 411', 'PF04');

-- --------------------------------------------------------

--
-- Table structure for table `practical_unit_room_details`
--

CREATE TABLE `practical_unit_room_details` (
  `id` int(11) NOT NULL,
  `lab_id` varchar(20) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `time_slot_id` varchar(20) NOT NULL,
  `day_of_the_week` varchar(20) NOT NULL,
  `date_allocated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practical_unit_room_details`
--

INSERT INTO `practical_unit_room_details` (`id`, `lab_id`, `unit_id`, `time_slot_id`, `day_of_the_week`, `date_allocated`) VALUES
(1, 'LAB01', 'CIT 409', 'SLT005', 'Wednesday', '2023-02-13 15:23:11');

-- --------------------------------------------------------

--
-- Table structure for table `school_department_details`
--

CREATE TABLE `school_department_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `department_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_department_details`
--

INSERT INTO `school_department_details` (`id`, `school_id`, `department_id`) VALUES
(1, 'SCH01', 'DPT01'),
(2, 'SCH01', 'DPT02');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `school_id`, `school_name`) VALUES
(1, 'SCH01', 'School of Computing and Informatics'),
(2, 'SCH02', 'School of Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `theory_unit_room_details`
--

CREATE TABLE `theory_unit_room_details` (
  `id` int(11) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `time_slot_id` varchar(20) NOT NULL,
  `day_of_the_week` varchar(20) NOT NULL,
  `date_allocated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theory_unit_room_details`
--

INSERT INTO `theory_unit_room_details` (`id`, `room_id`, `unit_id`, `time_slot_id`, `day_of_the_week`, `date_allocated`) VALUES
(1, 'room01', 'CIT 401', 'SLT001', 'Monday', '2023-02-13 15:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `time_slot_details`
--

CREATE TABLE `time_slot_details` (
  `id` int(11) NOT NULL,
  `slot_id` varchar(20) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_slot_details`
--

INSERT INTO `time_slot_details` (`id`, `slot_id`, `start_time`, `end_time`) VALUES
(1, 'SLT001', '07:00AM', '09:00AM'),
(2, 'SLT002', '09:00AM', '11:00AM'),
(3, 'SLT003', '11:00AM', '01:00PM'),
(4, 'SLT004', '01:00PM', '03:00PM'),
(5, 'SLT005', '03:00PM', '05:00PM'),
(6, 'SLT006', '05:00PM', '07:00PM');

-- --------------------------------------------------------

--
-- Table structure for table `unit_details`
--

CREATE TABLE `unit_details` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(20) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_details`
--

INSERT INTO `unit_details` (`id`, `unit_code`, `unit_name`, `unit_type`, `active`) VALUES
(1, 'CIT 401', 'Software Project Management', 'Theory', 1),
(2, 'CIT 409', 'Information Technology Project I', 'Practical', 1),
(3, 'CIT 411', 'Distributed Systems', 'Theory', 1);

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
-- Indexes for table `hall_details`
--
ALTER TABLE `hall_details`
  ADD PRIMARY KEY (`hall_id`),
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
  ADD KEY `lid` (`lec_id`),
  ADD KEY `did` (`dpt_id`);

--
-- Indexes for table `lecturer_details`
--
ALTER TABLE `lecturer_details`
  ADD PRIMARY KEY (`pf_number`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `practical_unit_room_details`
--
ALTER TABLE `practical_unit_room_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab` (`lab_id`),
  ADD KEY `unit` (`unit_id`),
  ADD KEY `slot` (`time_slot_id`);

--
-- Indexes for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idd` (`department_id`),
  ADD KEY `id` (`school_id`);

--
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `theory_unit_room_details`
--
ALTER TABLE `theory_unit_room_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room_id`),
  ADD KEY `unit` (`unit_id`),
  ADD KEY `stime_slot` (`time_slot_id`);

--
-- Indexes for table `time_slot_details`
--
ALTER TABLE `time_slot_details`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `iddd` (`id`);

--
-- Indexes for table `unit_details`
--
ALTER TABLE `unit_details`
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
-- AUTO_INCREMENT for table `hall_details`
--
ALTER TABLE `hall_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `practical_unit_room_details`
--
ALTER TABLE `practical_unit_room_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `theory_unit_room_details`
--
ALTER TABLE `theory_unit_room_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time_slot_details`
--
ALTER TABLE `time_slot_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD CONSTRAINT `dptiid` FOREIGN KEY (`dpt_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lid` FOREIGN KEY (`lec_id`) REFERENCES `lecturer_details` (`pf_number`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD CONSTRAINT `lec_id` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer_details` (`pf_number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `practical_unit_room_details`
--
ALTER TABLE `practical_unit_room_details`
  ADD CONSTRAINT `lab` FOREIGN KEY (`lab_id`) REFERENCES `lab_details` (`lab_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot_details` (`slot_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unitid` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD CONSTRAINT `dptid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schid` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON UPDATE CASCADE;

--
-- Constraints for table `theory_unit_room_details`
--
ALTER TABLE `theory_unit_room_details`
  ADD CONSTRAINT `room` FOREIGN KEY (`room_id`) REFERENCES `hall_details` (`hall_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stime_slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot_details` (`slot_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
