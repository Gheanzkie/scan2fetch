-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2026 at 03:26 PM
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
-- Database: `scan2fetch`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `action` varchar(50) NOT NULL COMMENT 'login, logout, create, update, delete, release, approve, register',
  `module` varchar(50) NOT NULL COMMENT 'auth, parent, student, staff, authorization, scan',
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `user_name`, `role`, `action`, `module`, `description`, `ip_address`, `created_at`) VALUES
(82, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-06-09 13:57:28'),
(83, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-06-09 14:11:56'),
(84, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '127.0.0.1', '2026-06-09 14:28:33'),
(85, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '127.0.0.1', '2026-06-09 14:30:29'),
(86, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '127.0.0.1', '2026-06-09 14:30:44'),
(87, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-06-09 14:32:20'),
(88, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-06-09 14:49:59'),
(89, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-06-09 14:54:08'),
(90, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-06-09 14:57:02'),
(91, 1, 'Admin ', 'admin', 'create', 'student', 'Created: Juan Cruz', '::1', '2026-06-09 15:05:43'),
(92, 1, 'Admin ', 'admin', 'create', 'staff', 'Created staff: PEDRO CERNA', '::1', '2026-06-09 15:06:57'),
(93, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-06-09 15:07:05'),
(94, 4, 'PEDRO CERNA', 'staff', 'login', 'auth', 'Staff logged in | Phone: 12345678911', '::1', '2026-06-09 15:07:09'),
(95, 4, 'PEDRO CERNA', 'staff', 'logout', 'auth', 'User logged out', '::1', '2026-06-09 15:08:26'),
(96, 30, 'RIZ LA CRUZ', 'parent', 'login', 'auth', 'Parent logged in | Phone: 12345678910', '::1', '2026-06-09 15:08:33'),
(97, 30, 'RIZ LA CRUZ', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-06-09 15:12:02'),
(98, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-07-20 02:14:32'),
(99, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-07-20 02:30:59'),
(100, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-07-20 02:31:52'),
(101, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-07-20 02:32:14'),
(102, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-07-20 02:42:29'),
(103, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-07-20 03:01:49'),
(104, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-07-20 03:02:04'),
(105, 1, 'Admin ', 'admin', 'update', 'student', 'Updated: Juan Cruz (ID: 30)', '::1', '2026-07-20 05:22:54'),
(106, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Juan Cruz (ID: 30) | SMS sent', '::1', '2026-07-20 05:23:46'),
(107, 1, 'Admin ', 'admin', 'create', 'sub_fetcher', 'Added: Ghean Ghean De La Cruz', '::1', '2026-07-20 05:24:50'),
(108, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Juan Cruz (ID: 30) | SMS sent', '::1', '2026-07-20 05:25:17'),
(109, 1, 'Admin ', 'admin', 'update', 'parent', 'Updated parent: RIZ LA CRUZ (ID: 30)', '::1', '2026-07-20 05:30:58'),
(110, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-07-20 05:31:00'),
(111, 30, 'RIZ LA CRUZ', 'parent', 'login', 'auth', 'Parent logged in | Phone: 1122', '::1', '2026-07-20 05:31:04'),
(112, 30, 'RIZ LA CRUZ', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-07-20 06:08:45'),
(113, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-07-20 06:09:08'),
(114, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-07-20 10:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `mname`, `lname`, `phone`, `password`, `created_at`) VALUES
(1, 'Admin', NULL, '', 'admin', '$2y$10$KiImoTImSTwssZrLWAzEXuu/vaJ1dOsRV45w9HKv/GPxI2K9k67em', '2026-05-28 16:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `fetch_logs`
--

CREATE TABLE `fetch_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Parent who fetched (QR scan)',
  `auth_letter_id` int(11) DEFAULT NULL COMMENT 'If via authorization letter',
  `fetcher_fname` varchar(50) NOT NULL,
  `fetcher_mname` varchar(50) DEFAULT NULL,
  `fetcher_lname` varchar(50) NOT NULL,
  `fetcher_relation` varchar(50) DEFAULT 'Parent',
  `method` enum('QR','LETTER') NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `time_released` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fetch_logs`
--

INSERT INTO `fetch_logs` (`id`, `student_id`, `parent_id`, `auth_letter_id`, `fetcher_fname`, `fetcher_mname`, `fetcher_lname`, `fetcher_relation`, `method`, `staff_id`, `time_released`) VALUES
(27, 30, 30, NULL, 'RIZ', 'DE ', 'LA CRUZ', 'Parent', 'QR', NULL, '2026-07-20 05:23:46'),
(28, 30, 30, NULL, 'RIZ', 'DE ', 'LA CRUZ', 'Parent', 'QR', NULL, '2026-07-20 05:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `qr_code` varchar(100) DEFAULT NULL COMMENT 'Unique QR code for parent',
  `picture` varchar(255) DEFAULT NULL COMMENT 'Parent profile photo',
  `created_by` int(11) DEFAULT NULL COMMENT 'staff or admin id',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `fname`, `mname`, `lname`, `phone`, `password`, `qr_code`, `picture`, `created_by`, `created_at`) VALUES
(30, 'RIZ', 'DE ', 'LA CRUZ', '1122', '$2y$10$i5EkvRRiSoCt7b6Jrc.j3ehf3rzS60n8a6U92gXYcXKCaGQnZHzh2', 'QR-612E64F32CA2', '1784524954_ab1cf74e33de7e6884aa.jpeg', 1, '2026-06-09 15:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `id` int(11) NOT NULL,
  `parent_phone` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) DEFAULT 'sent',
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_logs`
--

INSERT INTO `sms_logs` (`id`, `parent_phone`, `message`, `status`, `sent_at`) VALUES
(25, '12345678910', 'Your child Juan Cruz has been released at 01:23 PM. - BCC Scan2Fetch', 'sent', '2026-07-20 05:23:46'),
(26, '12345678910', 'Your child Juan Cruz has been released at 01:25 PM. - BCC Scan2Fetch', 'sent', '2026-07-20 05:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `fname`, `mname`, `lname`, `phone`, `password`, `created_at`) VALUES
(4, 'PEDRO', 'DELA', 'CERNA', '12345678911', '$2y$10$yCYloT0nF5DZ8.wZZ2XgU.FqtMHZHaIy2wPD/s03q40r.OzlhltgC', '2026-06-09 15:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `grade_section` varchar(20) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL COMMENT 'Student photo',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `grade_section`, `parent_id`, `picture`, `created_by`, `created_at`) VALUES
(30, 'Juan', 'Dela', 'Cruz', 'Grade 6 - A', NULL, '1784524974_331c90e468db6aeac856.jpeg', 1, '2026-06-09 15:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `student_parents`
--

CREATE TABLE `student_parents` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `relation` varchar(50) DEFAULT 'Parent',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_parents`
--

INSERT INTO `student_parents` (`id`, `student_id`, `parent_id`, `relation`, `created_at`) VALUES
(16, 30, 30, 'Parent', '2026-06-09 15:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `sub_fetchers`
--

CREATE TABLE `sub_fetchers` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `qr_code` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_fetchers`
--

INSERT INTO `sub_fetchers` (`id`, `parent_id`, `student_id`, `fname`, `mname`, `lname`, `phone`, `picture`, `qr_code`, `created_by`, `created_at`) VALUES
(4, 30, 30, 'Ghean', 'domingo', 'Ghean De La Cruz', '111', NULL, 'QR-44702C2B5651', 1, '2026-07-20 05:24:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `fetch_logs`
--
ALTER TABLE `fetch_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `auth_letter_id` (`auth_letter_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_ibfk_1` (`parent_id`);

--
-- Indexes for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_parents_ibfk_2` (`parent_id`);

--
-- Indexes for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fetch_logs`
--
ALTER TABLE `fetch_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fetch_logs`
--
ALTER TABLE `fetch_logs`
  ADD CONSTRAINT `fetch_logs_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fetch_logs_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fetch_logs_ibfk_3` FOREIGN KEY (`auth_letter_id`) REFERENCES `authorization_letters` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD CONSTRAINT `student_parents_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_parents_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  ADD CONSTRAINT `sub_fetchers_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub_fetchers_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
