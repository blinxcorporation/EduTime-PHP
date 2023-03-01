-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 01, 2023 at 10:14 PM
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
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(11) NOT NULL,
  `academic_year_id` varchar(100) NOT NULL,
  `academic_year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `academic_year_id`, `academic_year`) VALUES
(1, 'YR_019_020', '2019/2020'),
(2, 'YR_020_021', '2020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `id` int(11) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_shortform` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`id`, `course_id`, `course_name`, `course_shortform`, `active`, `date_added`) VALUES
(1, 'CRS_CCS', 'Bachelor of Science in Computer Science', 'CCS', 1, '2023-02-28 15:24:27'),
(2, 'CRS_CCT', 'Bachelor of Science in Computer Technology', 'CCT', 1, '2023-02-28 15:24:36'),
(3, 'CRS_IS', 'Bachelor of Science in Information Systems', 'IS', 1, '2023-02-28 15:40:09'),
(4, 'CRS_IT', 'Bachelor of Science in Information Technology', 'IT', 1, '2023-02-28 15:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `department_course_details`
--

CREATE TABLE `department_course_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_course_details`
--

INSERT INTO `department_course_details` (`id`, `department_id`, `course_id`, `date_added`) VALUES
(1, 'DPT_COMPUTERSCIENCE', 'CRS_CCS', '2023-02-28 15:24:27'),
(2, 'DPT_COMPUTERSCIENCE', 'CRS_CCT', '2023-02-28 15:24:37'),
(5, 'DPT_INFORMATIONTECHNOLOGY', 'CRS_IT', '2023-02-28 15:27:38'),
(7, 'DPT_INFORMATIONTECHNOLOGY', 'CRS_IS', '2023-02-28 15:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `id` int(11) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`id`, `department_id`, `department_name`, `date_created`) VALUES
(2, 'DPT_COMPUTERSCIENCE', 'Computer Science', '2023-02-28 15:15:48'),
(1, 'DPT_INFORMATIONTECHNOLOGY', 'Information Technology', '2023-02-28 15:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `group_year_details`
--

CREATE TABLE `group_year_details` (
  `id` int(11) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `year_id` varchar(100) NOT NULL,
  `group_number` bigint(20) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_year_details`
--

INSERT INTO `group_year_details` (`id`, `course_id`, `year_id`, `group_number`, `date_added`) VALUES
(1, 'CRS_CCS', 'YR_019_020', 40, '2023-03-01 20:24:56'),
(2, 'CRS_IT', 'YR_019_020', 50, '2023-03-01 20:24:56');

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
(3, 'role002', 'Lecturer'),
(4, 'role003', 'Chairperson');

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
  `school_id` varchar(100) NOT NULL,
  `department_id` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_department_details`
--

INSERT INTO `school_department_details` (`id`, `school_id`, `department_id`, `date_updated`) VALUES
(1, 'MSU_COMPUTING', 'DPT_INFORMATIONTECHNOLOGY', '2023-02-28 15:15:22'),
(2, 'MSU_COMPUTING', 'DPT_COMPUTERSCIENCE', '2023-02-28 15:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `school_details`
--

CREATE TABLE `school_details` (
  `id` int(11) NOT NULL,
  `school_id` varchar(100) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_shortform` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_details`
--

INSERT INTO `school_details` (`id`, `school_id`, `school_name`, `school_shortform`, `date_created`) VALUES
(11, 'MSU_AGRICULTURE', 'Agriculture,Food Security and Environmental Sciences', 'Agriculture', '2023-02-20 20:42:28'),
(6, 'MSU_ARTS', 'Arts and Social Sciences', 'Arts', '2023-02-20 20:20:11'),
(7, 'MSU_BUSINESS', 'Business and Economics', 'Business', '2023-02-20 20:23:28'),
(1, 'MSU_COMPUTING', 'Computing and Informatics', 'Computing', '2023-02-20 19:57:41'),
(2, 'MSU_DEVELOPMENT', 'Development and Strategic Planning', 'Development', '2023-02-20 19:57:50'),
(3, 'MSU_EDUCATION', 'Education', 'Education', '2023-02-20 19:58:24'),
(12, 'MSU_MATHEMATICS', 'Mathematics, Statistics and Actuarial Sciences', 'Mathematics', '2023-02-22 10:30:41'),
(8, 'MSU_NURSING', 'Nursing', 'Nursing', '2023-02-20 20:24:14'),
(4, 'MSU_PHARMACY', 'Pharmacy', 'Pharmacy', '2023-02-20 19:59:02'),
(9, 'MSU_PHYSICAL', 'Physical and Biological Studies', 'Physical', '2023-02-20 20:31:34'),
(5, 'MSU_PLANNING', 'Planning and Architecture', 'Planning', '2023-02-20 19:59:44'),
(10, 'MSU_PUBLICHEALTH', 'Public Health and Community Development', 'Public Health', '2023-02-20 20:38:10');

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
-- Table structure for table `unit_course_details`
--

CREATE TABLE `unit_course_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(100) NOT NULL,
  `course_id` varchar(100) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_course_details`
--

INSERT INTO `unit_course_details` (`id`, `unit_id`, `course_id`, `date_updated`) VALUES
(11, 'CIT 101', 'CRS_IT', '2023-03-01 19:26:18'),
(12, 'CIT 103', 'CRS_IT', '2023-03-01 19:26:46'),
(13, 'CIT 105', 'CRS_IT', '2023-03-01 19:27:11'),
(14, 'CIT 107', 'CRS_IT', '2023-03-01 19:27:37'),
(15, 'CIT 109', 'CRS_IT', '2023-03-01 19:28:05'),
(16, 'CIT 111', 'CRS_IT', '2023-03-01 19:28:31'),
(17, 'AEN 105', 'CRS_IT', '2023-03-01 19:28:56'),
(18, 'PHT 112', 'CRS_IT', '2023-03-01 19:29:17'),
(19, 'CIT 102', 'CRS_IT', '2023-03-01 19:29:55'),
(20, 'CIT 104', 'CRS_IT', '2023-03-01 19:30:21'),
(21, 'CIT 106', 'CRS_IT', '2023-03-01 19:30:47'),
(22, 'CIT 108', 'CRS_IT', '2023-03-01 19:31:08'),
(23, 'CIT 110', 'CRS_IT', '2023-03-01 19:31:31'),
(24, 'CIT 112', 'CRS_IT', '2023-03-01 19:31:58'),
(25, 'CIT 114', 'CRS_IT', '2023-03-01 19:32:22'),
(26, 'CIT 116', 'CRS_IT', '2023-03-01 19:32:42'),
(27, 'CIT 201', 'CRS_IT', '2023-03-01 19:33:13'),
(28, 'CIT 203', 'CRS_IT', '2023-03-01 19:33:35'),
(29, 'CIT 205', 'CRS_IT', '2023-03-01 19:33:58'),
(30, 'CIT 207', 'CRS_IT', '2023-03-01 19:34:33'),
(31, 'CIT 209', 'CRS_IT', '2023-03-01 19:34:52'),
(32, 'CIT 211', 'CRS_IT', '2023-03-01 19:35:15'),
(33, 'CIT 213', 'CRS_IT', '2023-03-01 19:35:47'),
(34, 'CIT 215', 'CRS_IT', '2023-03-01 19:36:08'),
(35, 'CIT 202', 'CRS_IT', '2023-03-01 19:36:55'),
(36, 'CIT 204', 'CRS_IT', '2023-03-01 19:37:21'),
(37, 'CIT 206', 'CRS_IT', '2023-03-01 19:37:55'),
(38, 'CIT 208', 'CRS_IT', '2023-03-01 19:38:17'),
(39, 'CIT 210', 'CRS_IT', '2023-03-01 19:38:44'),
(40, 'CIT 212', 'CRS_IT', '2023-03-01 19:39:17'),
(41, 'CIT 214', 'CRS_IT', '2023-03-01 19:39:39'),
(42, 'CIT 216', 'CRS_IT', '2023-03-01 19:40:07'),
(43, 'CIT 301', 'CRS_IT', '2023-03-01 19:40:41'),
(44, 'CIT 305', 'CRS_IT', '2023-03-01 19:41:07'),
(45, 'CIT 307', 'CRS_IT', '2023-03-01 19:41:30'),
(46, 'CIT 309', 'CRS_IT', '2023-03-01 19:41:54'),
(48, 'CIT 311', 'CRS_IT', '2023-03-01 19:42:44'),
(49, 'CIT 313', 'CRS_IT', '2023-03-01 19:43:10'),
(50, 'CIT 315', 'CRS_IT', '2023-03-01 19:43:49'),
(51, 'CIT 317', 'CRS_IT', '2023-03-01 19:44:17'),
(52, 'CIT 319', 'CRS_IT', '2023-03-01 19:44:38'),
(53, 'CIT 302', 'CRS_IT', '2023-03-01 19:45:06'),
(54, 'CIT 304', 'CRS_IT', '2023-03-01 19:45:27'),
(55, 'CIT 312', 'CRS_IT', '2023-03-01 19:45:53'),
(56, 'CIT 318', 'CRS_IT', '2023-03-01 19:46:24'),
(57, 'CIT 306', 'CRS_IT', '2023-03-01 19:47:23'),
(58, 'CIT 308', 'CRS_IT', '2023-03-01 19:47:49'),
(59, 'CIT 310', 'CRS_IT', '2023-03-01 19:48:17'),
(60, 'CIT 314', 'CRS_IT', '2023-03-01 19:48:39'),
(61, 'CIT 316', 'CRS_IT', '2023-03-01 19:49:03'),
(62, 'CIT 320', 'CRS_IT', '2023-03-01 19:49:25'),
(63, 'CIT 322', 'CRS_IT', '2023-03-01 19:49:48'),
(64, 'CIT 401', 'CRS_IT', '2023-03-01 19:51:06'),
(65, 'CIT 405', 'CRS_IT', '2023-03-01 19:52:54'),
(66, 'CIT 409', 'CRS_IT', '2023-03-01 19:53:36'),
(67, 'CIT 411', 'CRS_IT', '2023-03-01 19:54:59'),
(68, 'CIT 403', 'CRS_IT', '2023-03-01 19:55:21'),
(69, 'CIT 407', 'CRS_IT', '2023-03-01 19:55:42'),
(70, 'CIT 413', 'CRS_IT', '2023-03-01 19:56:09'),
(71, 'CIT 415', 'CRS_IT', '2023-03-01 19:57:06'),
(72, 'CIT 419', 'CRS_IT', '2023-03-01 19:58:04'),
(73, 'ABA 424', 'CRS_IT', '2023-03-01 20:45:43'),
(74, 'CIT 402', 'CRS_IT', '2023-03-01 20:46:11'),
(76, 'CIT 406', 'CRS_IT', '2023-03-01 20:47:18'),
(77, 'CIT 408', 'CRS_IT', '2023-03-01 20:48:06'),
(78, 'CIT 410', 'CRS_IT', '2023-03-01 20:48:35'),
(79, 'CIT 412', 'CRS_IT', '2023-03-01 20:49:03'),
(80, 'CIT 414', 'CRS_IT', '2023-03-01 20:49:43'),
(81, 'CIT 416', 'CRS_IT', '2023-03-01 20:50:14'),
(82, 'CIT 418', 'CRS_IT', '2023-03-01 20:50:43'),
(83, 'CIT 420', 'CRS_IT', '2023-03-01 20:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `unit_details`
--

CREATE TABLE `unit_details` (
  `id` int(11) NOT NULL,
  `unit_code` varchar(50) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_type` varchar(50) NOT NULL,
  `unit_active` varchar(20) NOT NULL DEFAULT 'Active',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_details`
--

INSERT INTO `unit_details` (`id`, `unit_code`, `unit_name`, `unit_type`, `unit_active`, `date_added`) VALUES
(63, 'ABA 424', 'Entrepreneurship and Small Business Management', 'Theory', 'Active', '2023-03-01 20:45:43'),
(7, 'AEN 105', 'Communication Skills', 'Theory', 'Active', '2023-03-01 19:28:56'),
(1, 'CIT 101', 'Discrete Structures I', 'Theory', 'Active', '2023-03-01 19:26:18'),
(9, 'CIT 102', 'Probability and statistics', 'Theory', 'Active', '2023-03-01 19:29:55'),
(2, 'CIT 103', 'Mathematics for IT', 'Theory', 'Active', '2023-03-01 19:26:46'),
(10, 'CIT 104', 'Computer Architecture', 'Theory', 'Active', '2023-03-01 19:30:21'),
(3, 'CIT 105', 'Electrical Principles', 'Theory', 'Active', '2023-03-01 19:27:10'),
(11, 'CIT 106', 'Linear Algebra', 'Theory', 'Active', '2023-03-01 19:30:47'),
(4, 'CIT 107', 'Fundamentals of IT', 'Theory', 'Active', '2023-03-01 19:27:37'),
(12, 'CIT 108', 'Object-Oriented Programming I', 'ICT-Practical', 'Active', '2023-03-01 19:31:08'),
(5, 'CIT 109', 'Computer Applications', 'Theory', 'Active', '2023-03-01 19:28:05'),
(13, 'CIT 110', 'Platform technologies I', 'Theory', 'Active', '2023-03-01 19:31:31'),
(6, 'CIT 111', 'Fundamentals of Programming', 'ICT-Practical', 'Active', '2023-03-01 19:28:31'),
(14, 'CIT 112', 'Discrete Structures II', 'Theory', 'Active', '2023-03-01 19:31:57'),
(15, 'CIT 114', 'System Analysis and Design', 'Theory', 'Active', '2023-03-01 19:32:22'),
(16, 'CIT 116', 'Data communications', 'Theory', 'Active', '2023-03-01 19:32:42'),
(17, 'CIT 201', 'Object-Oriented Programming II', 'ICT-Practical', 'Active', '2023-03-01 19:33:13'),
(25, 'CIT 202', 'Computer Aided Design', 'ICT-Practical', 'Active', '2023-03-01 19:36:55'),
(18, 'CIT 203', 'Data Structures and Algorithms', 'Theory', 'Active', '2023-03-01 19:33:35'),
(26, 'CIT 204', 'Networking Administration and Management', 'Theory', 'Active', '2023-03-01 19:37:21'),
(19, 'CIT 205', 'Computer Networks', 'Theory', 'Active', '2023-03-01 19:33:58'),
(27, 'CIT 206', 'Research Methods and Technical Writing', 'Theory', 'Active', '2023-03-01 19:37:55'),
(20, 'CIT 207', 'Web Systems and Technologies', 'ICT-Practical', 'Active', '2023-03-01 19:34:33'),
(28, 'CIT 208', 'Group Project', 'ICT-Practical', 'Active', '2023-03-01 19:38:17'),
(21, 'CIT 209', 'Unix Operating System Fundamentals', 'Theory', 'Active', '2023-03-01 19:34:52'),
(29, 'CIT 210', 'Object Oriented Analysis and Design', 'Theory', 'Active', '2023-03-01 19:38:44'),
(22, 'CIT 211', 'Event Driven Programming', 'ICT-Practical', 'Active', '2023-03-01 19:35:15'),
(30, 'CIT 212', 'Computer Networks lab II', 'ICT-Practical', 'Active', '2023-03-01 19:39:17'),
(23, 'CIT 213', 'Computer Networks Lab I', 'ICT-Practical', 'Active', '2023-03-01 19:35:47'),
(31, 'CIT 214', 'Software Engineering', 'Theory', 'Active', '2023-03-01 19:39:39'),
(24, 'CIT 215', 'Databases Systems', 'Theory', 'Active', '2023-03-01 19:36:08'),
(32, 'CIT 216', 'System Administration and Management', 'Theory', 'Active', '2023-03-01 19:40:07'),
(33, 'CIT 301', 'Design and Analysis of Algorithms', 'Theory', 'Active', '2023-03-01 19:40:41'),
(43, 'CIT 302', 'Human Computer Interaction', 'Theory', 'Active', '2023-03-01 19:45:05'),
(44, 'CIT 304', 'Integrative programming and technologies', 'Theory', 'Active', '2023-03-01 19:45:27'),
(34, 'CIT 305', 'Advanced Database Systems', 'Theory', 'Active', '2023-03-01 19:41:07'),
(47, 'CIT 306', 'Wireless and Mobile Computing', 'Theory', 'Active', '2023-03-01 19:47:23'),
(35, 'CIT 307', 'Information Assurance and Security I', 'Theory', 'Active', '2023-03-01 19:41:30'),
(48, 'CIT 308', 'Web systems and Technologies II', 'ICT-Practical', 'Active', '2023-03-01 19:47:49'),
(36, 'CIT 309', 'IT Project I (Proposal Writing)', 'Theory', 'Active', '2023-03-01 19:41:54'),
(49, 'CIT 310', 'Design Thinking and Human Centered Design', 'Theory', 'Active', '2023-03-01 19:48:17'),
(38, 'CIT 311', 'Information Technology Control and Audit I', 'Theory', 'Active', '2023-03-01 19:42:44'),
(45, 'CIT 312', 'Group Project (Project Implementation)', 'Theory', 'Active', '2023-03-01 19:45:53'),
(39, 'CIT 313', 'Database Administration', 'Theory', 'Active', '2023-03-01 19:43:10'),
(50, 'CIT 314', 'Mobile Programming', 'ICT-Practical', 'Active', '2023-03-01 19:48:39'),
(40, 'CIT 315', 'Computer Networks Lab III', 'ICT-Practical', 'Active', '2023-03-01 19:43:49'),
(51, 'CIT 316', 'Computer Graphics', 'Theory', 'Active', '2023-03-01 19:49:03'),
(41, 'CIT 317', 'Multimedia and Graphics Systems', 'Theory', 'Active', '2023-03-01 19:44:16'),
(46, 'CIT 318', 'Artificial Intelligence', 'Theory', 'Active', '2023-03-01 19:46:23'),
(42, 'CIT 319', 'Software Testing and Measurement', 'Theory', 'Active', '2023-03-01 19:44:38'),
(52, 'CIT 320', 'Simulation and Modelling', 'Theory', 'Active', '2023-03-01 19:49:25'),
(53, 'CIT 322', 'Computer Networks Lab 4', 'ICT-Practical', 'Active', '2023-03-01 19:49:47'),
(54, 'CIT 401', 'Software Project Management', 'Theory', 'Active', '2023-03-01 19:51:06'),
(64, 'CIT 402', 'IT project II', 'ICT-Practical', 'Active', '2023-03-01 20:46:11'),
(58, 'CIT 403', 'Management Information Systems', 'Theory', 'Active', '2023-03-01 19:55:21'),
(55, 'CIT 405', 'E-Commerce', 'Theory', 'Active', '2023-03-01 19:52:54'),
(65, 'CIT 406', 'Social and Professional Issues In IT', 'Theory', 'Active', '2023-03-01 20:47:17'),
(59, 'CIT 407', 'IT and Society', 'Theory', 'Active', '2023-03-01 19:55:42'),
(66, 'CIT 408', 'IT and Development', 'Theory', 'Active', '2023-03-01 20:48:05'),
(56, 'CIT 409', 'IT Project ', 'Theory', 'Active', '2023-03-01 19:53:36'),
(67, 'CIT 410', 'Mobile Technology Applications and M-Commerce', 'Theory', 'Active', '2023-03-01 20:48:35'),
(57, 'CIT 411', 'Distributed Systems', 'Theory', 'Active', '2023-03-01 19:54:59'),
(68, 'CIT 412', 'Mobile Embedded Hardware Platforms & Architectures', 'Theory', 'Active', '2023-03-01 20:49:03'),
(60, 'CIT 413', 'Mobile Devices, Technologies, and Programming', 'ICT-Practical', 'Active', '2023-03-01 19:56:09'),
(69, 'CIT 414', 'Cloud Computing and Emerging Applications', 'Theory', 'Active', '2023-03-01 20:49:43'),
(61, 'CIT 415', 'Web Applications and Programming', 'ICT-Practical', 'Active', '2023-03-01 19:57:06'),
(70, 'CIT 416', 'Network Security', 'Theory', 'Active', '2023-03-01 20:50:14'),
(71, 'CIT 418', 'Authentication Protocols and Biometrics', 'Theory', 'Active', '2023-03-01 20:50:43'),
(62, 'CIT 419', 'Content Development and Management', 'Theory', 'Active', '2023-03-01 19:58:04'),
(72, 'CIT 420', 'Information Systems Innovations & New Technologies', 'Theory', 'Active', '2023-03-01 20:51:08'),
(8, 'PHT 112', 'HIV/AIDS', 'Theory', 'Active', '2023-03-01 19:29:17');

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

-- --------------------------------------------------------

--
-- Table structure for table `unit_semester_details`
--

CREATE TABLE `unit_semester_details` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `semester_id` varchar(20) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_semester_details`
--

INSERT INTO `unit_semester_details` (`id`, `unit_id`, `semester_id`, `date_added`) VALUES
(10, 'CIT 101', 'Y1S1', '2023-03-01 22:26:18'),
(11, 'CIT 103', 'Y1S1', '2023-03-01 22:26:46'),
(12, 'CIT 105', 'Y1S1', '2023-03-01 22:27:11'),
(13, 'CIT 107', 'Y1S1', '2023-03-01 22:27:37'),
(14, 'CIT 109', 'Y1S1', '2023-03-01 22:28:05'),
(15, 'CIT 111', 'Y1S1', '2023-03-01 22:28:31'),
(16, 'AEN 105', 'Y1S1', '2023-03-01 22:28:56'),
(17, 'PHT 112', 'Y1S1', '2023-03-01 22:29:17'),
(18, 'CIT 102', 'Y1S2', '2023-03-01 22:29:55'),
(19, 'CIT 104', 'Y1S2', '2023-03-01 22:30:22'),
(20, 'CIT 106', 'Y1S2', '2023-03-01 22:30:47'),
(21, 'CIT 108', 'Y1S2', '2023-03-01 22:31:08'),
(22, 'CIT 110', 'Y1S2', '2023-03-01 22:31:31'),
(23, 'CIT 112', 'Y1S2', '2023-03-01 22:31:58'),
(24, 'CIT 114', 'Y1S2', '2023-03-01 22:32:22'),
(25, 'CIT 116', 'Y1S2', '2023-03-01 22:32:43'),
(26, 'CIT 201', 'Y2S1', '2023-03-01 22:33:13'),
(27, 'CIT 203', 'Y2S1', '2023-03-01 22:33:35'),
(28, 'CIT 205', 'Y2S1', '2023-03-01 22:33:58'),
(29, 'CIT 207', 'Y2S1', '2023-03-01 22:34:33'),
(30, 'CIT 209', 'Y2S1', '2023-03-01 22:34:53'),
(31, 'CIT 211', 'Y2S1', '2023-03-01 22:35:15'),
(32, 'CIT 213', 'Y2S1', '2023-03-01 22:35:47'),
(33, 'CIT 215', 'Y2S1', '2023-03-01 22:36:09'),
(34, 'CIT 202', 'Y2S2', '2023-03-01 22:36:56'),
(35, 'CIT 204', 'Y2S2', '2023-03-01 22:37:21'),
(36, 'CIT 206', 'Y2S2', '2023-03-01 22:37:55'),
(37, 'CIT 208', 'Y2S2', '2023-03-01 22:38:18'),
(38, 'CIT 210', 'Y2S2', '2023-03-01 22:38:44'),
(39, 'CIT 212', 'Y2S2', '2023-03-01 22:39:17'),
(40, 'CIT 214', 'Y2S2', '2023-03-01 22:39:39'),
(41, 'CIT 216', 'Y2S2', '2023-03-01 22:40:07'),
(42, 'CIT 301', 'Y3S1', '2023-03-01 22:40:41'),
(43, 'CIT 305', 'Y3S1', '2023-03-01 22:41:07'),
(44, 'CIT 307', 'Y3S1', '2023-03-01 22:41:30'),
(45, 'CIT 309', 'Y3S1', '2023-03-01 22:41:54'),
(46, 'CIT 305', 'Y3S1', '2023-03-01 22:42:18'),
(47, 'CIT 311', 'Y3S1', '2023-03-01 22:42:44'),
(48, 'CIT 313', 'Y3S1', '2023-03-01 22:43:10'),
(49, 'CIT 315', 'Y3S1', '2023-03-01 22:43:49'),
(50, 'CIT 317', 'Y3S1', '2023-03-01 22:44:17'),
(51, 'CIT 319', 'Y3S1', '2023-03-01 22:44:38'),
(52, 'CIT 302', 'Y3S2', '2023-03-01 22:45:06'),
(53, 'CIT 304', 'Y3S2', '2023-03-01 22:45:27'),
(54, 'CIT 312', 'Y3S2', '2023-03-01 22:45:53'),
(55, 'CIT 318', 'Y3S2', '2023-03-01 22:46:24'),
(56, 'CIT 306', 'Y3S2', '2023-03-01 22:47:23'),
(57, 'CIT 308', 'Y3S2', '2023-03-01 22:47:49'),
(58, 'CIT 310', 'Y3S2', '2023-03-01 22:48:17'),
(59, 'CIT 314', 'Y3S2', '2023-03-01 22:48:39'),
(60, 'CIT 316', 'Y3S2', '2023-03-01 22:49:03'),
(61, 'CIT 320', 'Y3S2', '2023-03-01 22:49:25'),
(62, 'CIT 322', 'Y3S2', '2023-03-01 22:49:48'),
(63, 'CIT 401', 'Y4S1', '2023-03-01 22:51:06'),
(64, 'CIT 405', 'Y4S1', '2023-03-01 22:52:54'),
(65, 'CIT 409', 'Y4S1', '2023-03-01 22:53:36'),
(66, 'CIT 411', 'Y4S1', '2023-03-01 22:54:59'),
(67, 'CIT 403', 'Y4S1', '2023-03-01 22:55:21'),
(68, 'CIT 407', 'Y4S1', '2023-03-01 22:55:43'),
(69, 'CIT 413', 'Y4S1', '2023-03-01 22:56:09'),
(70, 'CIT 415', 'Y4S1', '2023-03-01 22:57:06'),
(71, 'CIT 419', 'Y4S1', '2023-03-01 22:58:04'),
(72, 'ABA 424', 'Y4S2', '2023-03-01 23:45:43'),
(73, 'CIT 402', 'Y4S2', '2023-03-01 23:46:11'),
(74, 'CIT 403', 'Y4S2', '2023-03-01 23:46:45'),
(75, 'CIT 406', 'Y4S2', '2023-03-01 23:47:18'),
(76, 'CIT 408', 'Y4S2', '2023-03-01 23:48:06'),
(77, 'CIT 410', 'Y4S2', '2023-03-01 23:48:36'),
(78, 'CIT 412', 'Y4S2', '2023-03-01 23:49:03'),
(79, 'CIT 414', 'Y4S2', '2023-03-01 23:49:43'),
(80, 'CIT 416', 'Y4S2', '2023-03-01 23:50:14'),
(81, 'CIT 418', 'Y4S2', '2023-03-01 23:50:43'),
(82, 'CIT 420', 'Y4S2', '2023-03-01 23:51:08');

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
(1, 'PF01', 'Dr', ' Titus ', 'Muhambe', 'muhambemukhisa@gmail.com', 785412562, '41183fc34c443b5ef29622b5bad9021bcdb766c260dc4efc766965d1711a8f710b3f7261', '2022-12-16 19:57:25'),
(2, 'PF02', 'Madam', 'Violet', 'Settim', 'violetsettim@gmail.com', 752452868, '58b94b70faccb444ca0ae2a5dba9be2acdb766c260dc4efc766965d1711a8f710b3f7261', '2022-12-16 19:58:26'),
(3, 'PF03', 'Dr', ' Samuel', 'Oonge', 'oongesamuel12@gmail.com', 752452868, 'eb0434fee150ffbac0777c820714fb1bcdb766c260dc4efc766965d1711a8f710b3f7261', '2022-12-16 20:49:58'),
(4, 'PF04', 'Mr', 'Isaac', 'Owino', 'owino@maseno.ac.ke', 785412541, 'a9750013af3699fe09e7ef855cc73b26cdb766c260dc4efc766965d1711a8f710b3f7261', '2022-12-16 20:55:14'),
(5, 'PF05', 'Mr', 'Benson', 'Makau', 'bensonmakau2000@gmail.com', 758413462, 'fa34efef1fbcadf4c6f2fbdda9e7bad4cdb766c260dc4efc766965d1711a8f710b3f7261', '2023-02-16 20:17:16'),
(6, 'PF06', 'Dr', 'Calvins', 'Otieno', 'calvinsotieno@maseno.ac.ke', 758413462, '318216c3766e84bd7dbc11850ec39d7acdb766c260dc4efc766965d1711a8f710b3f7261', '2023-02-21 11:11:02');

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
(1, 'PF01', 'role003', '2023-02-16 20:22:49'),
(2, 'PF05', 'role001', '2023-02-20 14:39:11');

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
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`academic_year_id`),
  ADD KEY `iddd` (`id`),
  ADD KEY `yearid` (`academic_year`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_name` (`course_name`),
  ADD UNIQUE KEY `course_shortform` (`course_shortform`),
  ADD KEY `idd` (`id`);

--
-- Indexes for table `department_course_details`
--
ALTER TABLE `department_course_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`),
  ADD KEY `dpt` (`department_id`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `group_year_details`
--
ALTER TABLE `group_year_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yearid` (`year_id`),
  ADD KEY `course_id` (`course_id`);

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
  ADD UNIQUE KEY `department_id` (`department_id`),
  ADD KEY `id` (`school_id`);

--
-- Indexes for table `school_details`
--
ALTER TABLE `school_details`
  ADD PRIMARY KEY (`school_id`),
  ADD KEY `schidddd` (`id`);

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
-- Indexes for table `unit_course_details`
--
ALTER TABLE `unit_course_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`unit_id`),
  ADD KEY `cid` (`course_id`);

--
-- Indexes for table `unit_details`
--
ALTER TABLE `unit_details`
  ADD PRIMARY KEY (`unit_code`),
  ADD KEY `iddddddd` (`id`);

--
-- Indexes for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room_id`),
  ADD KEY `unit` (`unit_id`),
  ADD KEY `day_of_the_week` (`weekday_id`),
  ADD KEY `weekday_id` (`weekday_id`),
  ADD KEY `leciddd` (`lecturer_id`),
  ADD KEY `stime_slot` (`time_slot_id`);

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
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department_course_details`
--
ALTER TABLE `department_course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group_year_details`
--
ALTER TABLE `group_year_details`
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
-- AUTO_INCREMENT for table `school_department_details`
--
ALTER TABLE `school_department_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_details`
--
ALTER TABLE `school_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `unit_course_details`
--
ALTER TABLE `unit_course_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `unit_details`
--
ALTER TABLE `unit_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `courses` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dpt` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_year_details`
--
ALTER TABLE `group_year_details`
  ADD CONSTRAINT `gripidd` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yeariddddd` FOREIGN KEY (`year_id`) REFERENCES `academic_year` (`academic_year_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_department_details`
--
ALTER TABLE `lecturer_department_details`
  ADD CONSTRAINT `dptiid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lid` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lecturer_unit_details`
--
ALTER TABLE `lecturer_unit_details`
  ADD CONSTRAINT `lec_id` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `school_department_details`
--
ALTER TABLE `school_department_details`
  ADD CONSTRAINT `dptid` FOREIGN KEY (`department_id`) REFERENCES `department_details` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schid` FOREIGN KEY (`school_id`) REFERENCES `school_details` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_course_details`
--
ALTER TABLE `unit_course_details`
  ADD CONSTRAINT `crsids` FOREIGN KEY (`course_id`) REFERENCES `course_details` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unitsidddd` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_room_time_day_allocation_details`
--
ALTER TABLE `unit_room_time_day_allocation_details`
  ADD CONSTRAINT `day_id` FOREIGN KEY (`weekday_id`) REFERENCES `week_day_details` (`week_day_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lecID` FOREIGN KEY (`lecturer_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room` FOREIGN KEY (`room_id`) REFERENCES `room_details` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stime_slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot_details` (`slot_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unit` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unit_semester_details`
--
ALTER TABLE `unit_semester_details`
  ADD CONSTRAINT `semiddd` FOREIGN KEY (`semester_id`) REFERENCES `semester_details` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uniDD` FOREIGN KEY (`unit_id`) REFERENCES `unit_details` (`unit_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role_details`
--
ALTER TABLE `user_role_details`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `role_details` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`pf_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
