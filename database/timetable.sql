-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 19, 2023 at 10:55 AM
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
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`id`, `course_id`, `course_name`, `date_added`) VALUES
(1, 'CRS01', 'Bachelor of Science in Information Technology', '2023-02-16 19:37:50'),
(2, 'CRS02', 'Bachelor of Science in Computer Science', '2023-02-16 19:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `department_course_details`
--

CREATE TABLE `department_course_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_course_details`
--

INSERT INTO `department_course_details` (`id`, `department_id`, `course_id`, `date_added`) VALUES
(1, 'DPT01', 'CRS01', '2023-02-16 19:41:52'),
(2, 'DPT02', 'CRS02', '2023-02-16 19:41:52');

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
-- Table structure for table `lecturer_department_details`
--

CREATE TABLE `lecturer_department_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(20) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_department_details`
--

INSERT INTO `lecturer_department_details` (`id`, `department_id`, `lecturer_id`, `date_created`) VALUES
(1, 'DPT01', 'PF01', '2023-02-16 19:59:56'),
(2, 'DPT01', 'PF02', '2023-02-16 19:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_unit_details`
--

CREATE TABLE `lecturer_unit_details` (
  `id` int(11) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_unit_details`
--

INSERT INTO `lecturer_unit_details` (`id`, `lecturer_id`, `unit_id`, `date_updated`) VALUES
(1, 'PF03', 'CIT 401', '2023-02-16 20:11:58'),
(2, 'PF04', 'CIT 411', '2023-02-16 20:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_details`
--

CREATE TABLE `role_details` (
  `id` int(11) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_details`
--

INSERT INTO `role_details` (`id`, `role_id`, `role_name`) VALUES
(1, 'role001', 'Admin'),
(2, 'role002', 'Coordinator'),
(3, 'role003', 'Lecturer'),
(4, 'role004', 'Chairperson'),
(5, 'role005', 'Dean');

-- --------------------------------------------------------

--
-- Table structure for table `room_details`
--

CREATE TABLE `room_details` (
  `id` int(11) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type` varchar(20) NOT NULL,
  `room_capacity` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_details`
--

INSERT INTO `room_details` (`id`, `room_id`, `room_name`, `room_type`, `room_capacity`, `date_added`) VALUES
(1, 'room01', 'TB 1', 'Standard', 60, '2023-02-16 19:53:36'),
(2, 'room02', 'TB 2', 'Standard', 150, '2023-02-16 19:53:36'),
(3, 'room03', 'TB 3', 'Standard', 60, '2023-02-16 19:53:36'),
(4, 'room04', 'TB 4', 'Standard', 60, '2023-02-16 19:53:36'),
(5, 'room05', 'TB 5', 'Standard', 60, '2023-02-16 19:53:36'),
(6, 'room06', 'LAB I', 'ICT-Labaratory', 55, '2023-02-16 19:53:36'),
(7, 'room07', 'LAB II', 'ICT-Labaratory', 55, '2023-02-16 19:53:36'),
(8, 'room08', 'LAB III', 'ICT-Labaratory', 55, '2023-02-16 19:53:36'),
(9, 'room09', 'LAB IV', 'ICT-Labaratory', 55, '2023-02-16 19:53:36'),
(10, 'room10', 'LAB V', 'ICT-Labaratory', 150, '2023-02-16 19:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `school_department_details`
--

CREATE TABLE `school_department_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(20) NOT NULL,
  `department_id` varchar(20) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_department_details`
--

INSERT INTO `school_department_details` (`id`, `school_id`, `department_id`, `date_updated`) VALUES
(1, 'SCH01', 'DPT01', '2023-02-16 20:12:45'),
(2, 'SCH01', 'DPT02', '2023-02-16 20:12:45');

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
-- Table structure for table `semester_details`
--

CREATE TABLE `semester_details` (
  `id` int(11) NOT NULL,
  `semester_id` varchar(20) NOT NULL,
  `semester_name` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester_details`
--

INSERT INTO `semester_details` (`id`, `semester_id`, `semester_name`, `date_added`) VALUES
(1, 'Y1S1', 'Year 1 Semester 1', '2023-02-17 05:19:33'),
(2, 'Y1S2', 'Year 1 Semester 2', '2023-02-17 05:19:33'),
(3, 'Y2S1', 'Year 2 Semester 1', '2023-02-17 05:19:53'),
(4, 'Y2S2', 'Year 2 Semester 2', '2023-02-17 05:19:53'),
(5, 'Y3S1', 'Year 3 Semester 1', '2023-02-17 05:20:16'),
(6, 'Y3S2', 'Year 3 Semester 2', '2023-02-17 05:20:16'),
(7, 'Y4S1', 'Year 4 Semester 1', '2023-02-17 05:20:39'),
(8, 'Y4S2', 'Year 4 Semester 2', '2023-02-17 05:20:39');

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
(2, 'CIT 409', 'Information Technology Project I', 'ICT-Practical', 1),
(3, 'CIT 411', 'Distributed Systems', 'Theory', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit_room_time_day_allocation_details`
--

CREATE TABLE `unit_room_time_day_allocation_details` (
  `id` int(11) NOT NULL,
  `room_id` varchar(20) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `time_slot_id` varchar(20) NOT NULL,
  `weekday_id` varchar(20) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL,
  `date_allocated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_room_time_day_allocation_details`
--

INSERT INTO `unit_room_time_day_allocation_details` (`id`, `room_id`, `unit_id`, `time_slot_id`, `weekday_id`, `lecturer_id`, `date_allocated`) VALUES
(1, 'room01', 'CIT 401', 'SLT001', 'day01', 'PF01', '2023-02-13 15:12:39'),
(2, 'room02', 'CIT 411', 'SLT004', 'day04', 'PF02', '2023-02-17 05:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `unit_semester_details`
--

CREATE TABLE `unit_semester_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(20) NOT NULL,
  `semester_id` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_semester_details`
--

INSERT INTO `unit_semester_details` (`id`, `unit_id`, `semester_id`, `date_added`) VALUES
(1, 'CIT 401', 'Y4S1', '2023-02-17 08:25:51'),
(2, 'CIT 409', 'Y4S1', '2023-02-17 08:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `pf_number` varchar(20) NOT NULL,
  `user_title` varchar(20) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` int(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `pf_number`, `user_title`, `user_firstname`, `user_lastname`, `user_email`, `user_phone`, `user_password`, `date_created`) VALUES
(1, 'PF01', 'Dr', ' Titus ', 'Muhambe', 'muhambemukhisa@gmail.com', 785412562, '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 19:57:25'),
(2, 'PF02', 'Madam', 'Violet', 'Settim', 'violetsettim@gmail.com', 752452868, '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 19:58:26'),
(3, 'PF03', 'Dr', ' Samuel', 'Oonge', 'oongesamuel12@gmail.com', 752452868, '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 20:49:58'),
(4, 'PF04', 'Mr', 'Isaac', 'Owino', 'owino@maseno.ac.ke', 785412541, '1f13116d6035df7ec880eb8a32ac8c4e', '2022-12-16 20:55:14'),
(5, 'PF05', 'Mr', 'Benson', 'Makau', 'bensonmakau2000@gmail.com', 758413462, '8821fe54f8b9828c97081d56666b6cc9', '2023-02-16 20:17:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_details`
--

CREATE TABLE `user_role_details` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role_details`
--

INSERT INTO `user_role_details` (`id`, `user_id`, `role_id`, `date_created`) VALUES
(1, 'PF01', 'role003', '2023-02-16 20:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `week_day_details`
--

CREATE TABLE `week_day_details` (
  `id` int(11) NOT NULL,
  `week_day_id` varchar(20) NOT NULL,
  `week_day` varchar(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `week_day_details`
--

INSERT INTO `week_day_details` (`id`, `week_day_id`, `week_day`, `date_added`) VALUES
(1, 'day01', 'Monday', '2023-02-16 20:07:00'),
(2, 'day02', 'Tuesday', '2023-02-16 20:07:00'),
(3, 'day03', 'Wednesday', '2023-02-16 20:07:49'),
(4, 'day04', 'Thursday', '2023-02-16 20:07:49'),
(5, 'day05', 'Friday', '2023-02-16 20:08:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `idd` (`id`);

--
-- Indexes for table `department_course_details`
--
ALTER TABLE `department_course_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course` (`course_id`),
  ADD KEY `dpt` (`department_id`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lid` (`lecturer_id`),
  ADD KEY `did` (`department_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `role_details`
--
ALTER TABLE `role_details`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `idd` (`id`);

--
-- Indexes for table `room_details`
--
ALTER TABLE `room_details`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `id` (`id`);

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
-- Indexes for table `semester_details`
--
ALTER TABLE `semester_details`
  ADD PRIMARY KEY (`semester_id`),
  ADD KEY `sid` (`id`);

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
-- Indexes for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room_id`),
  ADD KEY `unit` (`unit_id`),
  ADD KEY `stime_slot` (`time_slot_id`),
  ADD KEY `day_of_the_week` (`weekday_id`),
  ADD KEY `weekday_id` (`weekday_id`),
  ADD KEY `leciddd` (`lecturer_id`);

--
-- Indexes for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unitid` (`unit_id`),
  ADD KEY `semid` (`semester_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`pf_number`),
  ADD UNIQUE KEY `email` (`user_email`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_role_details`
--
ALTER TABLE `user_role_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`user_id`),
  ADD KEY `roleid` (`role_id`);

--
-- Indexes for table `week_day_details`
--
ALTER TABLE `week_day_details`
  ADD PRIMARY KEY (`week_day_id`),
  ADD KEY `idd` (`id`),
  ADD KEY `week_day` (`week_day`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_course_details`
--
ALTER TABLE `department_course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_details`
--
ALTER TABLE `role_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `room_details`
--
ALTER TABLE `room_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `semester_details`
--
ALTER TABLE `semester_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `time_slot_details`
--
ALTER TABLE `time_slot_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `week_day_details`
--
ALTER TABLE `week_day_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department_course_details`
--
ALTER TABLE `department_course_details`
  ADD CONSTRAINT `course` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dpt` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD CONSTRAINT `dptiid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lid` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD CONSTRAINT `lec_id` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD CONSTRAINT `dptid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `schid` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON UPDATE CASCADE;

--
-- Constraints for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  ADD CONSTRAINT `day_id` FOREIGN KEY (`weekday_id`) REFERENCES `week_day_details` (`week_day_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lecID` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `room` FOREIGN KEY (`room_id`) REFERENCES `room_details` (`room_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stime_slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot_details` (`slot_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  ADD CONSTRAINT `sem` FOREIGN KEY (`semester_id`) REFERENCES `semester_details` (`semester_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unitdd` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON UPDATE CASCADE;

--
-- Constraints for table `user_role_details`
--
ALTER TABLE `user_role_details`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `role_details` (`role_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`pf_number`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
