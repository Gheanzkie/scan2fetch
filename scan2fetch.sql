-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2026 at 01:27 AM
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
(211, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to jea f for student arr arrr', '::1', '2026-08-03 16:20:02'),
(212, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to jea ff for student fdf fdfd', '::1', '2026-08-03 16:20:02'),
(213, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to wawa 2qq for student ee eee', '::1', '2026-08-03 16:20:02'),
(214, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to hghg ghghg for student hfghfhf hfghfh', '::1', '2026-08-03 16:20:02'),
(215, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to gfgf gfgfgf for student fgdf gdgdg', '::1', '2026-08-03 16:20:02'),
(216, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to ertetret tertetert for student 414141 dgdg', '::1', '2026-08-03 16:20:02'),
(217, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:20:33'),
(218, 31, 'jea f', 'parent', 'login', 'auth', 'Parent logged in | Phone: 1122', '::1', '2026-08-03 16:20:40'),
(219, 31, 'jea f', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:20:52'),
(220, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-03 16:20:55'),
(221, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: arr arrr (ID: 31) | Parent: jea f | SMS sent', '::1', '2026-08-03 16:21:05'),
(222, 1, 'Admin ', 'admin', 'decline', 'scan', 'DECLINED | Student: arr arrr (ID: 31) | Parent: jea f | SMS sent', '::1', '2026-08-03 16:21:12'),
(223, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:22:32'),
(224, 31, 'jea f', 'parent', 'login', 'auth', 'Parent logged in | Phone: 1122', '::1', '2026-08-03 16:22:37'),
(225, 31, 'jea f', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:23:09'),
(226, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-03 16:23:13'),
(227, 1, 'Admin ', 'admin', 'create', 'student', 'Created: JAYLIAN ff', '::1', '2026-08-03 16:46:34'),
(228, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to jea ff for student fdf fdfd', '::1', '2026-08-03 16:47:15'),
(229, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to wawa 2qq for student ee eee', '::1', '2026-08-03 16:47:15'),
(230, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to hghg ghghg for student hfghfhf hfghfh', '::1', '2026-08-03 16:47:15'),
(231, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to gfgf gfgfgf for student fgdf gdgdg', '::1', '2026-08-03 16:47:15'),
(232, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to ertetret tertetert for student 414141 dgdg', '::1', '2026-08-03 16:47:15'),
(233, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to shhaa ddd for student JAYLIAN ff', '::1', '2026-08-03 16:47:15'),
(234, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:47:41'),
(235, 38, 'shhaa ddd', 'parent', 'login', 'auth', 'Parent logged in | Phone: 1', '::1', '2026-08-03 16:47:45'),
(236, 38, 'shhaa ddd', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:47:57'),
(237, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-03 16:48:42'),
(238, 1, 'Admin ', 'admin', 'update', 'staff', 'Updated staff: PEDRO CERNA (ID: 4)', '::1', '2026-08-03 16:49:07'),
(239, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:49:09'),
(240, 4, 'PEDRO CERNA', 'staff', 'login', 'auth', 'Staff logged in | Phone: 2', '::1', '2026-08-03 16:49:14'),
(241, 4, 'PEDRO CERNA', 'staff', 'logout', 'auth', 'User logged out', '::1', '2026-08-03 16:49:59'),
(242, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-07 11:54:51'),
(243, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: shhaa ddd (ID: 38)', '::1', '2026-08-07 11:55:38'),
(244, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to jea f for student arr arrr', '::1', '2026-08-07 11:56:39'),
(245, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to jea ff for student fdf fdfd', '::1', '2026-08-07 11:56:39'),
(246, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to wawa 2qq for student ee eee', '::1', '2026-08-07 11:56:39'),
(247, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to hghg ghghg for student hfghfhf hfghfh', '::1', '2026-08-07 11:56:39'),
(248, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to gfgf gfgfgf for student fgdf gdgdg', '::1', '2026-08-07 11:56:39'),
(249, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to ertetret tertetert for student 414141 dgdg', '::1', '2026-08-07 11:56:39'),
(250, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: ertetret tertetert (ID: 37)', '::1', '2026-08-07 11:58:38'),
(251, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: gfgf gfgfgf (ID: 35)', '::1', '2026-08-07 11:58:44'),
(252, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: hghg ghghg (ID: 34)', '::1', '2026-08-07 11:58:49'),
(253, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: wawa 2qq (ID: 33)', '::1', '2026-08-07 11:58:54'),
(254, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: jea ff (ID: 32)', '::1', '2026-08-07 11:58:58'),
(255, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: jea f (ID: 31)', '::1', '2026-08-07 11:59:02'),
(256, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: arr arrr (ID: 31)', '::1', '2026-08-07 11:59:10'),
(257, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: JAYLIAN ff (ID: 38)', '::1', '2026-08-07 11:59:14'),
(258, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: 414141 dgdg (ID: 37)', '::1', '2026-08-07 11:59:19'),
(259, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: fdf fdfd (ID: 32)', '::1', '2026-08-07 11:59:23'),
(260, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: ee eee (ID: 33)', '::1', '2026-08-07 11:59:27'),
(261, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: fgdf gdgdg (ID: 35)', '::1', '2026-08-07 11:59:32'),
(262, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: hfghfhf hfghfh (ID: 34)', '::1', '2026-08-07 11:59:36'),
(263, 1, 'Admin ', 'admin', 'create', 'student', 'Created: gfdg dgg', '::1', '2026-08-07 12:04:17'),
(264, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: gfdg dgg (ID: 39)', '::1', '2026-08-07 12:11:17'),
(265, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: gfdgd gdfgdfgd (ID: 39)', '::1', '2026-08-07 12:11:29'),
(266, 1, 'Admin ', 'admin', 'create', 'student', 'Created: gfdgfd gdgfd', '::1', '2026-08-07 12:13:27'),
(267, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: fdsfsd sdfsdfsd (ID: 40)', '::1', '2026-08-07 12:13:42'),
(268, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: gfdgfd gdgfd (ID: 40)', '::1', '2026-08-07 12:13:49'),
(269, 1, 'Admin ', 'admin', 'create', 'student', 'Created: bcvbvc bcbcb', '::1', '2026-08-07 12:19:02'),
(270, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: bcvbvc bcbcb (ID: 41) with parents and sub-fetchers', '::1', '2026-08-07 12:19:19'),
(271, 1, 'Admin ', 'admin', 'create', 'student', 'Created: bxxvb xbvxbxbx', '::1', '2026-08-07 12:20:26'),
(272, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: bvbcbc bcbcv (ID: 42) with sub-fetchers', '::1', '2026-08-07 12:22:11'),
(273, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: bxxvb xbvxbxbx (ID: 42) with parents and sub-fetchers', '::1', '2026-08-07 12:22:21'),
(274, 1, 'Admin ', 'admin', 'create', 'student', 'Created: bvcbc bcvbcvbc', '::1', '2026-08-07 12:26:47'),
(275, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: bvcbcv bcbcbc (ID: 43) with sub-fetchers. Orphaned students: bvcbc bcvbcvbc', '::1', '2026-08-07 12:26:56'),
(276, 1, 'Admin ', 'admin', 'create', 'student', 'Created: gfdgdf gdfgdgd', '::1', '2026-08-07 12:28:22'),
(277, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: gdfgd gdfgdfgdf (ID: 44) with sub-fetchers. Orphaned students: gfdgdf gdfgdgd', '::1', '2026-08-07 12:28:36'),
(278, 1, 'Admin ', 'admin', 'create', 'student', 'Created: gfdgfd dgdgdgdf', '::1', '2026-08-07 12:30:19'),
(279, 1, 'Admin ', 'admin', 'delete', 'parent', 'Deleted parent: jhjfghgfhfg bnvnvgf (ID: 45) with sub-fetchers. Students deleted: gfdgfd dgdgdgdf', '::1', '2026-08-07 12:30:29'),
(280, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: gfdgdf gdfgdgd (ID: 44) with parents and sub-fetchers', '::1', '2026-08-07 12:31:06'),
(281, 1, 'Admin ', 'admin', 'delete', 'student', 'Deleted: bvcbc bcvbcvbc (ID: 43) with parents and sub-fetchers', '::1', '2026-08-07 12:31:10'),
(282, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-07 12:32:25'),
(283, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-14 11:48:48'),
(284, 1, 'Admin ', 'admin', 'create', 'student', 'Created: jaylia agaga', '::1', '2026-08-14 11:50:25'),
(285, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to jea 43 for student jaylia agaga', '::1', '2026-08-14 11:53:22'),
(286, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-14 11:53:44'),
(287, 46, 'jea 43', 'parent', 'login', 'auth', 'Parent logged in | Phone: 123456', '::1', '2026-08-14 11:53:49'),
(288, 46, 'jea 43', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-14 11:55:03'),
(289, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-14 11:55:07'),
(290, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: jaylia agaga (ID: 46) | Parent: jea 43 | SMS sent', '::1', '2026-08-14 11:58:17');

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
(1, 46, 46, NULL, 'jea', '', '43', 'Parent', 'QR', NULL, '2026-08-14 11:58:14');

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
(46, 'jea', 'DE ', '43', '123456', '$2y$10$EQ0N.sFFp8TKV.XeURMIwewHRjwdDxCNHZGgmzjq37wMif3p/6942', 'QR-3DADFA367F9A', NULL, 1, '2026-08-14 11:50:25');

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
(70, '1122', 'Reminder: Your child arr arrr has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:20:02'),
(71, '1133', 'Reminder: Your child fdf fdfd has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:20:02'),
(72, '1144', 'Reminder: Your child ee eee has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:20:02'),
(73, '111', 'Reminder: Your child hfghfhf hfghfh has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:20:02'),
(74, '11', 'Reminder: Your child fgdf gdgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:20:02'),
(75, '1111', 'Reminder: Your child 414141 dgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:20:02'),
(76, '1122', 'Your child arr arrr has been released at 12:21 AM. - BCC Scan2Fetch', 'sent', '2026-08-03 16:21:05'),
(77, '1122', 'Pickup attempt for arr arrr has been DECLINED at 12:21 AM. - BCC Scan2Fetch', 'sent', '2026-08-03 16:21:12'),
(78, '1133', 'Reminder: Your child fdf fdfd has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:47:15'),
(79, '1144', 'Reminder: Your child ee eee has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:47:15'),
(80, '111', 'Reminder: Your child hfghfhf hfghfh has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:47:15'),
(81, '11', 'Reminder: Your child fgdf gdgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:47:15'),
(82, '1111', 'Reminder: Your child 414141 dgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:47:15'),
(83, '1', 'Reminder: Your child JAYLIAN ff has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-03 16:47:15'),
(84, '1122', 'Reminder: Your child arr arrr has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-07 11:56:39'),
(85, '1133', 'Reminder: Your child fdf fdfd has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-07 11:56:39'),
(86, '1144', 'Reminder: Your child ee eee has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-07 11:56:39'),
(87, '111', 'Reminder: Your child hfghfhf hfghfh has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-07 11:56:39'),
(88, '11', 'Reminder: Your child fgdf gdgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-07 11:56:39'),
(89, '1111', 'Reminder: Your child 414141 dgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-07 11:56:39'),
(90, '123456', 'Reminder: Your child jaylia agaga has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-14 11:53:22'),
(91, '123456', 'Your child jaylia agaga has been released at 07:58 PM. - BCC Scan2Fetch', 'sent', '2026-08-14 11:58:17');

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
(27, 31, 31, 'Reminder: Your child arr arrr has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:20:02'),
(28, 32, 32, 'Reminder: Your child fdf fdfd has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:20:02'),
(29, 33, 33, 'Reminder: Your child ee eee has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:20:02'),
(30, 34, 34, 'Reminder: Your child hfghfhf hfghfh has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:20:02'),
(31, 35, 35, 'Reminder: Your child fgdf gdgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:20:02'),
(32, 37, 37, 'Reminder: Your child 414141 dgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:20:02'),
(33, 32, 32, 'Reminder: Your child fdf fdfd has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:47:15'),
(34, 33, 33, 'Reminder: Your child ee eee has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:47:15'),
(35, 34, 34, 'Reminder: Your child hfghfhf hfghfh has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:47:15'),
(36, 35, 35, 'Reminder: Your child fgdf gdgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:47:15'),
(37, 37, 37, 'Reminder: Your child 414141 dgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:47:15'),
(38, 38, 38, 'Reminder: Your child JAYLIAN ff has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-04 00:47:15'),
(39, 31, 31, 'Reminder: Your child arr arrr has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-07 19:56:39'),
(40, 32, 32, 'Reminder: Your child fdf fdfd has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-07 19:56:39'),
(41, 33, 33, 'Reminder: Your child ee eee has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-07 19:56:39'),
(42, 34, 34, 'Reminder: Your child hfghfhf hfghfh has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-07 19:56:39'),
(43, 35, 35, 'Reminder: Your child fgdf gdgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-07 19:56:39'),
(44, 37, 37, 'Reminder: Your child 414141 dgdg has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-07 19:56:39'),
(45, 46, 46, 'Reminder: Your child jaylia agaga has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-14 19:53:22');

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
(4, 'PEDRO', 'DELA', 'CERNA', '2', '$2y$10$cn37WEvA8GbXn30KM5ANPu73JxTpRN1KBDj3CEsflisKFZ/Kmy7d6', '2026-06-09 15:06:57');

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
(46, 'jaylia', 'de', 'agaga', 'Kindergarten - A', NULL, 1, '2026-08-14 11:50:24', '2026-08-14 19:53:22');

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
(7, 46, 46, 'Parent', '2026-08-14 11:50:25');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `sms_notification_logs`
--
ALTER TABLE `sms_notification_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
