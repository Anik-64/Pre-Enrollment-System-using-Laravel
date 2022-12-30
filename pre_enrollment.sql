-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 05:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pre_enrollment`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `credit_hour`, `semester`, `dept_id`) VALUES
(2, 'Basic Accounting', 'ACC-101', '3', '1st', 1),
(3, 'Introduction to Computer System Laboratory', 'CSE-110', '2', '1st', 1),
(4, 'Electrical Circuits I', 'EEE-101', '3', '1st', 1),
(5, 'Electrical Circuits I Laboratory', 'EEE-102', '1.5', '1st', 1),
(6, 'General English', 'ENG-101', '3', '1st', 1),
(7, 'Engineering Mathamatics I', 'MAT-105', '3', '1st', 1),
(8, 'Engineering Physics I', 'PHY-101', '3', '1st', 1),
(9, 'Mechanical Engineering Drawing & CAD Laboratory', 'ME-102', '1', '1st', 1),
(10, 'Structured Programming', 'CSE-111', '2', '2nd', 1),
(11, 'Structured Programming Laboratory', 'CSE-112', '2', '2nd', 1),
(12, 'Electronics I', 'EEE-211', '3', '2nd', 1),
(13, 'Electronics I Laboratory', 'EEE-212', '1.5', '2nd', 1),
(14, 'Developing English Skills', 'ENG-103', '2', '2nd', 1),
(15, 'Engineering Mathamatics II', 'MAT-107', '3', '2nd', 1),
(16, 'Engineering Physics II', 'PHY-103', '3', '2nd', 1),
(17, 'Discrete Mathamatics', 'CSE-103', '3', '2nd', 1),
(18, 'Object Oriented Programming', 'CSE-211', '3', '3rd', 1),
(19, 'Object Oriented Programming Laboratory', 'CSE-212', '1.5', '3rd', 1),
(20, 'Data Structure', 'CSE-221', '3', '3rd', 1),
(21, 'Data Structure Laboratory', 'CSE-222', '1.5', '3rd', 1),
(22, 'Digital Electronics', 'EEE-311', '3', '3rd', 1),
(23, 'Digital Electronics Laboratory', 'EEE-312', '1.5', '3rd', 1),
(24, 'Basic Economics', 'ECO-201', '3', '3rd', 1),
(25, 'Engineering Mathamatics III', 'MAT-201', '3', '3rd', 1),
(26, 'Algorithm Design And Analysis', 'CSE-225', '3', '4th', 1),
(27, 'Algorithm Design And Analysis Laboratory', 'CSE-226', '1', '4th', 1),
(28, 'Database Management System', 'CSE-237', '3', '4th', 1),
(29, 'Database Management System Laboratory', 'CSE-238', '1.5', '4th', 1),
(30, 'Signals And Systems', 'EEE-201', '3', '4th', 1),
(31, 'Signals And Systems Laboratory', 'EEE-202', '1', '4th', 1),
(32, 'Industrial & Business Management', 'MGT-203', '3', '4th', 1),
(33, 'Engineering Mathamatics IV', 'MAT-203', '3', '4th', 1),
(34, 'Computational Methods For Engineering Problems', 'CSE-301', '3', '5th', 1),
(35, 'Computational Methods For Engineering Problems Laboratory', 'CSE-302', '1', '5th', 1),
(36, 'Software Engineering & Information System Design', 'CSE-305', '4', '5th', 1),
(37, 'Software Engineering & Information System Design Laboratory', 'CSE-306', '1.5', '5th', 1),
(38, 'Communication Engineering', 'EEE-309', '3', '5th', 1),
(39, 'Communication Engineering Laboratory', 'EEE-310', '1.5', '5th', 1),
(40, 'Microprocessor & Microcontrollers', 'EEE-371', '3', '5th', 1),
(41, 'Microprocessor & Microcontrollers Laboratory', 'EEE-372', '1.5', '5th', 1),
(42, 'Organizational Behavior IV', 'MGT-251', '3', '5th', 1),
(43, 'Artificial Intelligence', 'CSE-317', '3', '6th', 1),
(44, 'Artificial Intelligence Laboratory', 'CSE-318', '1.5', '6th', 1),
(45, 'Operating System', 'CSE-333', '3', '6th', 1),
(46, 'Operating System Laboratory', 'CSE-334', '1.5', '6th', 1),
(47, 'Computer Organization & Architecture', 'CSE-337', '3', '6th', 1),
(48, 'Software Development', 'CSE-338', '2', '6th', 1),
(49, 'Data Communication', 'CSE-364', '3', '6th', 1),
(50, 'Computer Network', 'CSE-367', '3', '6th', 1),
(51, 'Computer Network Laboratory', 'CSE-368', '1.5', '6th', 1),
(52, 'Theory Of Computation', 'CSE-309', '2', '7th', 1),
(53, 'Network And Computer Security', 'CSE-437', '3', '7th', 1),
(54, 'Neural Network & Fuzzy Logic', 'CSE-451', '3', '7th', 1),
(55, 'Neural Network & Fuzzy Logic Laboratory', 'CSE-452', '1', '7th', 1),
(56, 'Computer Graphics & Image Processing', 'CSE-455', '3', '7th', 1),
(57, 'Computer Graphics & Image Processing Laboratory', 'CSE-456', '1', '7th', 1),
(58, 'Control Systems', 'EEE-313', '3', '7th', 1),
(59, 'Control Systems Laboratory', 'EEE-314', '1.5', '7th', 1),
(60, 'Technical Writing & Presentation', 'ENG-401', '2', '7th', 1),
(61, 'Compiler Construction', 'CSE-453', '3', '8th', 1),
(62, 'Compiler Construction Laboratory', 'CSE-454', '1.5', '8th', 1),
(63, 'Machine Learning', 'CSE-457', '3', '8th', 1),
(64, 'Machine Learning Laboratory', 'CSE-458', '1', '8th', 1),
(65, 'Pattern Recognition', 'CSE-459', '3', '8th', 1),
(66, 'Pattern Recognition Laboratory', 'CSE-460', '1', '8th', 1),
(67, 'Contemporary Course of Computer Science', 'CSE-481', '3', '8th', 1),
(68, 'Contemporary Course of Computer Science Laboratory', 'CSE-3482', '1', '8th', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` bigint(20) UNSIGNED NOT NULL,
  `dept_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `dept_abbreviation`, `dept_contact_no`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science & Engineering', 'CSE', '01639221425', NULL, '2022-09-22 14:23:16'),
(3, 'Mechanical Engineering', 'ME', '01639221429', NULL, NULL),
(4, 'Civil Engineering', 'CE', '01521408492', NULL, NULL),
(5, 'Electrical and Electronics Engineering', 'EEE', '01521408455', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `type`, `session_name`, `created_at`, `updated_at`) VALUES
(122, 1803510201675, 2, 'Recourse2semester', 'Fall 2023', NULL, NULL),
(123, 1803510201675, 3, 'Recourse2semester', 'Fall 2023', NULL, NULL),
(124, 1803510201675, 10, 'Regular', 'Fall 2023', NULL, NULL),
(125, 1803510201675, 11, 'Regular', 'Fall 2023', NULL, NULL),
(126, 1803510201675, 12, 'Regular', 'Fall 2023', NULL, NULL),
(127, 1803510201675, 13, 'Regular', 'Fall 2023', NULL, NULL),
(128, 1803510201675, 14, 'Regular', 'Fall 2023', NULL, NULL),
(129, 1803510201675, 15, 'Regular', 'Fall 2023', NULL, NULL),
(130, 1803510201675, 16, 'Regular', 'Fall 2023', NULL, NULL),
(131, 1803510201675, 17, 'Regular', 'Fall 2023', NULL, NULL),
(152, 1803510201683, 2, 'Regular', 'Fall 2023', NULL, NULL),
(153, 1803510201683, 3, 'Regular', 'Fall 2023', NULL, NULL),
(154, 1803510201683, 18, 'Regular', 'Fall 2023', NULL, NULL),
(155, 1803510201683, 19, 'Regular', 'Fall 2023', NULL, NULL),
(156, 1803510201683, 20, 'Regular', 'Fall 2023', NULL, NULL),
(157, 1803510201683, 21, 'Regular', 'Fall 2023', NULL, NULL),
(158, 1803510201683, 22, 'Regular', 'Fall 2023', NULL, NULL),
(159, 1803510201683, 23, 'Regular', 'Fall 2023', NULL, NULL),
(160, 1803510201683, 2, 'Recourse3semester', 'Fall 2023', NULL, NULL),
(161, 1803510201683, 3, 'Recourse3semester', 'Fall 2023', NULL, NULL),
(162, 1803510201683, 18, 'Regular', 'Fall 2023', NULL, NULL),
(163, 1803510201683, 19, 'Regular', 'Fall 2023', NULL, NULL),
(164, 1803510201683, 20, 'Regular', 'Fall 2023', NULL, NULL),
(165, 1803510201683, 21, 'Regular', 'Fall 2023', NULL, NULL),
(166, 1803510201683, 22, 'Regular', 'Fall 2023', NULL, NULL),
(167, 1803510201683, 23, 'Regular', 'Fall 2023', NULL, NULL),
(168, 1803510201683, 24, 'Regular', 'Fall 2023', NULL, NULL),
(169, 1803510201683, 25, 'Regular', 'Fall 2023', NULL, NULL),
(170, 1803510201658, 2, 'Recourse2semester', 'Fall 2023', NULL, NULL),
(171, 1803510201658, 3, 'Recourse2semester', 'Fall 2023', NULL, NULL),
(172, 1803510201658, 10, 'Regular', 'Fall 2023', NULL, NULL),
(173, 1803510201658, 11, 'Regular', 'Fall 2023', NULL, NULL),
(174, 1803510201658, 12, 'Regular', 'Fall 2023', NULL, NULL),
(175, 1803510201658, 13, 'Regular', 'Fall 2023', NULL, NULL),
(176, 1803510201658, 14, 'Regular', 'Fall 2023', NULL, NULL),
(177, 1803510201658, 15, 'Regular', 'Fall 2023', NULL, NULL),
(178, 1803510201658, 16, 'Regular', 'Fall 2023', NULL, NULL),
(179, 1803510201658, 17, 'Regular', 'Fall 2023', NULL, NULL),
(180, 1803510201678, 2, 'Recourse5semester', 'Fall 2023', NULL, NULL),
(181, 1803510201678, 4, 'Recourse5semester', 'Fall 2023', NULL, NULL),
(182, 1803510201678, 34, 'Regular', 'Fall 2023', NULL, NULL),
(183, 1803510201678, 35, 'Regular', 'Fall 2023', NULL, NULL),
(184, 1803510201678, 36, 'Regular', 'Fall 2023', NULL, NULL),
(185, 1803510201678, 37, 'Regular', 'Fall 2023', NULL, NULL),
(186, 1803510201678, 38, 'Regular', 'Fall 2023', NULL, NULL),
(187, 1803510201678, 39, 'Regular', 'Fall 2023', NULL, NULL),
(188, 1803510201678, 40, 'Regular', 'Fall 2023', NULL, NULL),
(189, 1803510201678, 41, 'Regular', 'Fall 2023', NULL, NULL),
(190, 1803510201678, 42, 'Regular', 'Fall 2023', NULL, NULL),
(191, 1803510201689, 4, 'Regular', 'Fall 2023', NULL, NULL),
(192, 1803510201689, 7, 'Regular', 'Fall 2023', NULL, NULL),
(193, 1803510201689, 34, 'Regular', 'Fall 2023', NULL, NULL),
(194, 1803510201689, 35, 'Regular', 'Fall 2023', NULL, NULL),
(195, 1803510201689, 36, 'Regular', 'Fall 2023', NULL, NULL),
(196, 1803510201689, 37, 'Regular', 'Fall 2023', NULL, NULL),
(197, 1803510201689, 38, 'Regular', 'Fall 2023', NULL, NULL),
(198, 1803510201689, 39, 'Regular', 'Fall 2023', NULL, NULL),
(199, 1803510201689, 40, 'Regular', 'Fall 2023', NULL, NULL),
(200, 1803510201689, 4, 'Recourse5semester', 'Fall 2023', NULL, NULL),
(201, 1803510201689, 7, 'Recourse5semester', 'Fall 2023', NULL, NULL),
(202, 1803510201689, 34, 'Regular', 'Fall 2023', NULL, NULL),
(203, 1803510201689, 35, 'Regular', 'Fall 2023', NULL, NULL),
(204, 1803510201689, 36, 'Regular', 'Fall 2023', NULL, NULL),
(205, 1803510201689, 37, 'Regular', 'Fall 2023', NULL, NULL),
(206, 1803510201689, 38, 'Regular', 'Fall 2023', NULL, NULL),
(207, 1803510201689, 39, 'Regular', 'Fall 2023', NULL, NULL),
(208, 1803510201689, 40, 'Regular', 'Fall 2023', NULL, NULL),
(209, 1803510201689, 41, 'Regular', 'Fall 2023', NULL, NULL),
(210, 1803510201689, 42, 'Regular', 'Fall 2023', NULL, NULL),
(211, 1803510201676, 2, 'Recourse3semester', 'Fall 2023', NULL, NULL),
(212, 1803510201676, 18, 'Regular', 'Fall 2023', NULL, NULL),
(213, 1803510201676, 19, 'Regular', 'Fall 2023', NULL, NULL),
(214, 1803510201676, 20, 'Regular', 'Fall 2023', NULL, NULL),
(215, 1803510201676, 21, 'Regular', 'Fall 2023', NULL, NULL),
(216, 1803510201676, 22, 'Regular', 'Fall 2023', NULL, NULL),
(217, 1803510201676, 23, 'Regular', 'Fall 2023', NULL, NULL),
(218, 1803510201676, 24, 'Regular', 'Fall 2023', NULL, NULL),
(219, 1803510201676, 25, 'Regular', 'Fall 2023', NULL, NULL),
(230, 1803510201688, 4, 'Recourse5semester', 'Fall 2023', NULL, NULL),
(231, 1803510201688, 7, 'Recourse5semester', 'Fall 2023', NULL, NULL),
(232, 1803510201688, 34, 'Regular', 'Fall 2023', NULL, NULL),
(233, 1803510201688, 35, 'Regular', 'Fall 2023', NULL, NULL),
(234, 1803510201688, 36, 'Regular', 'Fall 2023', NULL, NULL),
(235, 1803510201688, 37, 'Regular', 'Fall 2023', NULL, NULL),
(236, 1803510201688, 38, 'Regular', 'Fall 2023', NULL, NULL),
(237, 1803510201688, 39, 'Regular', 'Fall 2023', NULL, NULL),
(238, 1803510201688, 40, 'Regular', 'Fall 2023', NULL, NULL),
(239, 1803510201688, 41, 'Regular', 'Fall 2023', NULL, NULL),
(240, 1803510201688, 42, 'Regular', 'Fall 2023', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logout_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `name`, `email`, `login_time`, `duration`, `logout_time`) VALUES
(1, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-09-22 13:17:12', '0m 8s', '2022-09-22 13:17:20'),
(4, 'Anik Sen', 'aniksen@gmail.com', '2022-09-22 17:11:00', '40m 52s', '2022-09-22 17:51:52'),
(5, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-09-22 17:52:19', '47m 10s', '2022-09-22 18:39:29'),
(9, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-26 17:06:37', '0m 23s', '2022-09-26 17:07:00'),
(10, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-26 17:07:13', '17m 58s', '2022-09-26 17:25:11'),
(14, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-28 16:52:28', '58m 10s', '2022-09-28 17:50:38'),
(15, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-29 02:43:37', '12m 2s', '2022-09-29 02:55:39'),
(19, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-29 03:11:07', '3m 26s', '2022-09-29 03:14:33'),
(20, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-09-29 03:19:37', '2h 19m', '2022-09-29 05:38:58'),
(21, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-29 05:39:04', '0m 48s', '2022-09-29 05:39:52'),
(22, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-09-29 05:40:00', '51m 51s', '2022-09-29 06:31:51'),
(26, 'Tonmoy Choudhory', 'tonmoy@gmail.com', '2022-09-29 13:01:25', '1h 54m', '2022-09-29 14:55:54'),
(27, 'Tonmoy Choudhory', 'tonmoy@gmail.com', '2022-09-29 16:10:10', '22m 8s', '2022-09-29 16:32:18'),
(28, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-09-29 16:32:25', '1h 27m', '2022-09-29 18:00:11'),
(29, 'Galib Sikdar', 'galib@gmail.com', '2022-09-29 18:10:28', '1m 54s', '2022-09-29 18:12:22'),
(30, 'Munira Akhtar moni', 'moni@gmail.com', '2022-09-29 18:13:08', '2m 38s', '2022-09-29 18:15:46'),
(31, 'Shrabanti Debi', 'shrabanti@gmail.com', '2022-09-29 18:16:28', '1m 21s', '2022-09-29 18:17:49'),
(32, 'Joya Mallick', 'joya@gmail.com', '2022-09-29 18:17:56', '3m 24s', '2022-09-29 18:21:20'),
(33, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-29 18:21:29', '3m 49s', '2022-09-29 18:25:18'),
(36, 'Saad Iqbal', 'saad@gmail.com', '2022-09-30 11:49:16', '1h 19m', '2022-09-30 13:08:21'),
(37, 'Dhruba das', 'dhrubadas@gmail.com', '2022-09-30 11:51:39', '2h 14m', '2022-09-30 14:06:24'),
(38, 'Mhmd Riyad', 'riyad@gmail.com', '2022-09-30 13:08:46', '35m 31s', '2022-09-30 13:44:17'),
(39, 'Emon Palit', 'emon@gmail.com', '2022-09-30 13:45:04', '7m 6s', '2022-09-30 13:52:10'),
(40, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-09-30 14:04:15', '2m 31s', '2022-09-30 14:06:46'),
(41, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-01 04:42:07', '27m 43s', '2022-10-01 05:09:50'),
(42, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-01 05:53:26', NULL, '2022-10-01 05:53:26'),
(43, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-01 09:31:01', NULL, '2022-10-01 09:31:01'),
(44, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-01 09:31:46', '12m 21s', '2022-10-01 09:44:07'),
(45, 'Tonmoy Choudhory', 'tonmoy@gmail.com', '2022-10-01 09:44:17', '7m 29s', '2022-10-01 09:51:46'),
(46, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-01 09:51:52', '17m 54s', '2022-10-01 10:09:46'),
(47, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-01 13:01:46', '26m 12s', '2022-10-01 13:27:58'),
(48, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-01 16:17:46', NULL, '2022-10-01 16:17:46'),
(49, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-04 18:11:21', '48m 42s', '2022-10-04 19:00:03'),
(50, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-04 19:00:10', '12m 44s', '2022-10-04 19:12:54'),
(51, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-04 21:29:24', NULL, '2022-10-04 21:29:24'),
(52, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-05 17:23:21', NULL, '2022-10-05 17:23:21'),
(53, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-06 13:13:59', '7m 13s', '2022-10-06 13:21:12'),
(54, 'Jhon Wick', 'jhon@gmail.com', '2022-10-06 15:13:33', '1m 34s', '2022-10-06 15:15:07'),
(55, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-07 17:58:05', '1h 11m', '2022-10-07 19:09:14'),
(56, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-07 17:59:35', '1h 9m', '2022-10-07 19:09:01'),
(57, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-08 10:50:07', '1m 38s', '2022-10-08 10:51:45'),
(58, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-08 10:52:08', '1h 40m', '2022-10-08 12:32:16'),
(59, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-08 10:52:25', '1h 24m', '2022-10-08 12:16:35'),
(60, 'Tonmoy Choudhory', 'tonmoy@gmail.com', '2022-10-08 12:17:12', '2m 23s', '2022-10-08 12:19:35'),
(61, 'Joya Mallick', 'joya@gmail.com', '2022-10-08 12:19:50', '9m 3s', '2022-10-08 12:28:53'),
(62, 'Tonmoy Choudhory', 'tonmoy@gmail.com', '2022-10-08 12:29:02', '3m 22s', '2022-10-08 12:32:24'),
(63, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-08 14:02:10', '2h 18m', '2022-10-08 16:20:20'),
(64, 'Mhmd Riyad', 'riyad@gmail.com', '2022-10-08 14:44:24', '1m 8s', '2022-10-08 14:45:32'),
(65, 'Emon Palit', 'emon@gmail.com', '2022-10-08 14:45:51', '2m 54s', '2022-10-08 14:48:46'),
(66, 'Shrabanti Debi', 'shrabanti@gmail.com', '2022-10-08 15:20:15', '43m 51s', '2022-10-08 16:04:06'),
(67, 'Galib Sikdar', 'galib@gmail.com', '2022-10-08 16:04:39', NULL, '2022-10-08 16:04:39'),
(68, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-08 16:20:35', '0m 7s', '2022-10-08 16:20:42'),
(69, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-08 17:48:43', '33m 52s', '2022-10-08 18:22:35'),
(70, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-09 17:07:21', '1h 5m', '2022-10-09 18:13:12'),
(71, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-09 17:39:28', '33m 33s', '2022-10-09 18:13:01'),
(72, 'Anik Majumder', 'anikmajumder303@gmail.com', '2022-10-10 03:06:26', '27m 59s', '2022-10-10 03:34:25'),
(73, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-26 16:44:52', '17m 42s', '2022-10-26 17:02:34'),
(74, 'Sajjad Talukdar', 'sajjad@gmail.com', '2022-10-27 04:54:10', '1h 53m', '2022-10-27 06:47:19'),
(75, 'Dhruba das', 'dhrubadas@gmail.com', '2022-10-27 06:07:56', '39m 10s', '2022-10-27 06:47:06'),
(76, 'Dhruba das', 'dhrubadas@gmail.com', '2022-11-06 10:27:34', '2m 12s', '2022-11-06 10:29:46'),
(77, 'Dhruba das', 'dhrubadas@gmail.com', '2022-11-06 10:29:58', NULL, '2022-11-06 10:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_09_22_170835_create_registrations_table', 1),
(3, '2022_09_22_180017_create_registrations_table', 2),
(4, '2022_09_22_181454_create_login_details_table', 3),
(5, '2022_09_22_192018_create_departments_table', 4),
(6, '2022_09_22_192558_create_teachers_table', 5),
(7, '2022_09_22_231827_create_courses_table', 6),
(8, '2022_09_26_174447_create_sessions_table', 7),
(9, '2022_09_26_175452_create_session_infos_table', 8),
(10, '2022_09_29_152141_create_enrollments_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`student_id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1803510201655, 'Jhon Wick', 'jhon@gmail.com', '$2y$10$9.wewMD.pYPOLVddqhfgsOlQlHiwxM4kUaMOxIIAbaII4O0VcxjIK', 'student', NULL, NULL),
(1803510201658, 'Tonmoy Choudhory', 'tonmoy@gmail.com', '$2y$10$5fypDhyeMgV8GwKPIWjNr.q8zvzSWB/SjwxhmiEX5pguTsoWUoCc6', 'student', '2022-09-24 14:53:57', '2022-09-24 14:53:57'),
(1803510201659, 'Munira Akhtar moni', 'moni@gmail.com', '$2y$10$48NbZyjRVFWf3vmsg.yqF.JlXeuy/W8Jc06m7uYod5Udqq9hMA5wy', 'student', '2022-09-29 18:09:33', '2022-09-29 18:09:33'),
(1803510201675, 'Anik Majumder', 'anikmajumder303@gmail.com', '$2y$10$5JqtO4isuaoNFzghivHZg.XkxHWv94R26y.7/S/I9PsTlLQftDB9G', 'student', '2022-09-22 12:06:52', '2022-10-01 07:06:28'),
(1803510201676, 'Shrabanti Debi', 'shrabanti@gmail.com', '$2y$10$LCMihFl3gn/2bBpgl8f2tO7RbHcZ2MzXt5z7pytaSPmvv6F/u.z.q', 'student', '2022-09-29 18:01:27', '2022-09-29 18:01:27'),
(1803510201677, 'Saad Iqbal', 'saad@gmail.com', '$2y$10$2UkGQleX6W0s.I/.vdXkxOJVvCBxaDNyKLynP9iJA1Zbfhyf1aKUO', 'student', '2022-09-29 18:04:10', '2022-09-29 18:04:10'),
(1803510201678, 'Mhmd Riyad', 'riyad@gmail.com', '$2y$10$wY2gMDTqZ71WG/BCNE568OY2QAz8agdv9G5iTGlT0nwcuo1HKjF4q', 'student', '2022-09-29 18:05:28', '2022-09-29 18:05:28'),
(1803510201683, 'Joya Mallick', 'joya@gmail.com', '$2y$10$9I3S0KBhqucBUwigi6f29uxFWuSn9SCdbyWsmQ9zN9o4aSW8I0uFi', 'student', '2022-09-29 18:02:08', '2022-09-29 18:02:08'),
(1803510201688, 'Sajjad Talukdar', 'sajjad@gmail.com', '$2y$10$mBwglPjRslTxBvx95d5mm.8iH0TmOYPJBxIVJoCo0hcI1pggYytm2', 'student', NULL, NULL),
(1803510201689, 'Emon Palit', 'emon@gmail.com', '$2y$10$ZKuGIXE/u6VLcss9p2eVJOQdeMcH8VVOdY6DAR608e1Yw344TIDRG', 'student', '2022-09-30 13:44:54', '2022-09-30 13:44:54'),
(1803510201690, 'Galib Sikdar', 'galib@gmail.com', '$2y$10$9/JqybC4DxiFA3q0Y6.2Dezo2WjACKii1bhKB8dsyjSXUYrbQXLfW', 'student', '2022-09-29 18:07:57', '2022-09-29 18:07:57'),
(1803510201777, 'Sahanaz siddika', 'sahanaz@gmail.com', '$2y$10$Ib8GwPAPMC.QZlzRBXltzOE/kevY3WEkBRIqBda/ih/7AMHJ/IHv2', 'student', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session_infos`
--

CREATE TABLE `session_infos` (
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session_infos`
--

INSERT INTO `session_infos` (`session_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Spring 2023', 'Inactive', NULL, '2022-09-30 14:03:24'),
(3, 'Fall 2023', 'Active', NULL, '2022-09-30 14:03:26'),
(4, 'Spring 2024', 'Inactive', NULL, '2022-10-01 13:06:58');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` bigint(20) UNSIGNED NOT NULL,
  `t_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$2y$10$q.B99ygMq/IYTJA/f4w.2OD1QVJaWDAu0MIJmAk6GcOV2I1ABD0w2',
  `t_designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'teacher',
  `dept_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `t_name`, `t_email`, `t_password`, `t_designation`, `role`, `dept_id`, `created_at`, `updated_at`) VALUES
(2, 'Dhruba das', 'dhrubadas@gmail.com', '$2y$10$9dlbxgk61gaF3zVAC27PP.L4DICnkag5bks4EjuqOu8tfiNboJ5e2', 'Lecturer', 'admin', 1, NULL, '2022-10-04 19:10:46'),
(3, 'Hafiz uddin', 'hafiz@gmail.com', '$2y$10$q.B99ygMq/IYTJA/f4w.2OD1QVJaWDAu0MIJmAk6GcOV2I1ABD0w2', 'Assistant Professor', 'teacher', 5, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_dept_id_foreign` (`dept_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_student_id_foreign` (`student_id`),
  ADD KEY `enrollments_course_id_foreign` (`course_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `session_infos`
--
ALTER TABLE `session_infos`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `teachers_dept_id_foreign` (`dept_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_infos`
--
ALTER TABLE `session_infos`
  MODIFY `session_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `t_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `registrations` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_dept_id_foreign` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
