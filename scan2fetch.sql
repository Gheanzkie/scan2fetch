-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2026 at 04:26 PM
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
(22, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 13:27:46'),
(23, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.2', '2026-08-29 13:39:07'),
(24, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:01:39'),
(25, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.2', '2026-08-29 14:01:44'),
(26, 1, 'Admin ', 'admin', 'update', 'password', 'Admin changed their password', '192.168.1.2', '2026-08-29 14:09:01'),
(27, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:09:06'),
(28, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.2', '2026-08-29 14:09:11'),
(29, 1, 'Ghean Cruz', 'admin', 'create', 'student', 'Created: juan cruz', '192.168.1.2', '2026-08-29 14:10:19'),
(30, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:11:28'),
(31, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '192.168.1.2', '2026-08-29 14:11:32'),
(32, 1, 'jea da', 'parent', 'update', 'password', 'Parent changed their password', '192.168.1.2', '2026-08-29 14:11:53'),
(33, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:12:10'),
(34, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.2', '2026-08-29 14:12:13'),
(35, 1, 'Ghean Cruz', 'admin', 'settings', 'settings', 'SMS mode changed to Automatic (scheduled 2026-08-29 22:13:00)', '192.168.1.2', '2026-08-29 14:12:55'),
(36, 1, 'Ghean Cruz', 'admin', 'notify', 'scan', 'SMS notification sent to jea da for student juan cruz', '192.168.1.2', '2026-08-29 14:13:05'),
(37, 1, 'Ghean Cruz', 'admin', 'notify', 'scan', 'SMS notification sent to teacher SHANA MATILLANO for student juan cruz', '192.168.1.2', '2026-08-29 14:13:05'),
(38, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:13:23'),
(39, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '192.168.1.2', '2026-08-29 14:13:28'),
(40, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.13', '2026-08-29 14:14:28'),
(41, 1, 'Ghean Cruz', 'admin', 'release', 'scan', 'QR Release | Student: juan cruz (ID: 1) | Parent: jea da | SMS sent', '192.168.1.13', '2026-08-29 14:14:50'),
(42, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:16:24'),
(43, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.10', '2026-08-29 14:20:08'),
(44, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.2', '2026-08-29 14:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `mname`, `lname`, `picture`, `phone`, `password`, `created_at`) VALUES
(1, 'Ghean', 'De La', 'Cruz', '', 'admin', '$2y$10$i9.Cv8kZ2QBwgWcXhCiqxOz9E2c9CQn0fDFOCIWouhhZlPUnFb9rO', '2026-05-28 16:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `daily_reset_log`
--

CREATE TABLE `daily_reset_log` (
  `id` int(11) NOT NULL,
  `reset_date` date NOT NULL,
  `reset_time` datetime NOT NULL,
  `total_students` int(11) DEFAULT 0,
  `status` varchar(50) DEFAULT 'auto_reset',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 1, 1, NULL, 'jea', '', 'da', 'Parent', 'QR', NULL, '2026-08-29 14:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_role` varchar(20) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `sender_role`, `receiver_id`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'parent', NULL, '4DLg6IKpAhUv9LG1a69sIk7H3iXWHJR+j77AatSGimTBpOHNCWXY1/huBqthHa9zpFVEgVHvuIZ1b9H6OPsNceYnHIfZ6uB2x07vbULxrXwCPt4G1fM9u+Q8vLe7iduUuQv0q+D4LPkbv5Ag/gyx4Ic=', 1, '2026-08-29 22:12:07'),
(2, 1, 'admin', 1, 'S5dnUYYoh9BZ0ZuCYPfI4SJkzj59eH9gvh4sR6gSP7mz7mKE8VcX1GsnCYxp2MKIjgSxXIdb9vazQM2FxakNxmUjBHQqmAVWbn3FEEVLMX1FgE2oCKlWf/zvoD0kssMmTygnRQ==', 1, '2026-08-29 22:12:31');

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
(1, 'jea', 'DE ', 'da', '110417', '$2y$10$gT54ebFkgSPgQDnI9RVSfObG2mI4WzothGDJV221a0h6VWuLOzi2i', 'QR-8W25Z', '1788012653_928c175ca7a18a59d1c5.jpg', 1, '2026-08-29 14:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
(1, 'sms_mode', 'auto', '2026-08-29 22:12:55'),
(2, 'auto_sms_interval', '60', '2026-08-29 15:04:30'),
(3, 'auto_sms_datetime', '2026-08-29 22:13:00', '2026-08-29 22:12:55'),
(4, 'auto_sms_last_run', '2026-08-29 22:13:00', '2026-08-29 22:13:05');

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
(4, '09995011147', 'Your Scan2Fetch teacher account password is: tVdccU5u (recorded in SMS logs).', 'sent', '2026-08-29 12:51:02'),
(5, '110417', 'Your Scan2Fetch account password is: VpEwZTxE (recorded in SMS logs).', 'sent', '2026-08-29 14:10:19'),
(6, '110417', 'Reminder: Your child juan cruz has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-29 14:13:05'),
(7, '09995011147', 'Reminder: juan cruz (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', '2026-08-29 14:13:05'),
(8, '110417', 'Your child juan cruz has been released at 10:14 PM. - BCC Scan2Fetch', 'sent', '2026-08-29 14:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `sms_notification_logs`
--

CREATE TABLE `sms_notification_logs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) DEFAULT 'sent',
  `sent_by` int(11) DEFAULT NULL,
  `sent_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sms_notification_logs`
--

INSERT INTO `sms_notification_logs` (`id`, `student_id`, `parent_id`, `message`, `status`, `sent_by`, `sent_at`) VALUES
(1, 1, 1, 'Reminder: Your child juan cruz has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-29 22:13:05'),
(2, 1, 3, 'Reminder: juan cruz (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-08-29 22:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `picture` varchar(255) DEFAULT NULL COMMENT 'Student photo',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_sms_notification` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `grade_section`, `picture`, `created_by`, `created_at`, `last_sms_notification`) VALUES
(1, 'juan', 'dela ', 'cruz', 'Grade 1 - A', '1788012619_e6116c9aef1ded91938f.jpg', 1, '2026-08-29 14:10:19', '2026-08-29 22:13:05');

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
(1, 1, 1, 'Parent', '2026-08-29 14:10:19');

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

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grade_section` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fname`, `mname`, `lname`, `picture`, `phone`, `password`, `grade_section`, `created_by`, `created_at`) VALUES
(3, 'SHANA', 'JOY', 'MATILLANO', '1788007862_cec08cf549e13d5b9e37.png', '09995011147', '$2y$10$I4f3JyZBamgnXDXDs2fjO.C2biYx.8g74ef6zSJH09R8HrT4sP3U.', 'Grade 1 - A', 1, '2026-08-29 12:51:02');

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
-- Indexes for table `daily_reset_log`
--
ALTER TABLE `daily_reset_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_date` (`reset_date`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_notification_logs`
--
ALTER TABLE `sms_notification_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `parent_id` (`parent_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daily_reset_log`
--
ALTER TABLE `daily_reset_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fetch_logs`
--
ALTER TABLE `fetch_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_notification_logs`
--
ALTER TABLE `sms_notification_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fetch_logs`
--
ALTER TABLE `fetch_logs`
  ADD CONSTRAINT `fk_fetchlogs_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_fetchlogs_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD CONSTRAINT `fk_student_parents_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_parents_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  ADD CONSTRAINT `fk_subfetchers_parent` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_subfetchers_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
