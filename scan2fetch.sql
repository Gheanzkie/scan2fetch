-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2026 at 06:59 PM
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
(44, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '192.168.1.2', '2026-08-29 14:20:14'),
(45, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '192.168.1.2', '2026-08-29 14:28:00'),
(46, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 13:57:24'),
(47, 1, 'Ghean Cruz', 'admin', 'update', 'teacher', 'Reset password for teacher: SHANA MATILLANO (ID: 3)', '::1', '2026-08-31 13:57:57'),
(48, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 13:58:23'),
(49, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-08-31 13:58:30'),
(50, 3, 'SHANA MATILLANO', 'teacher', 'update', 'parent', 'Reset password and sent via SMS for parent: jea da (ID: 1)', '::1', '2026-08-31 13:59:57'),
(51, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:00:06'),
(52, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 14:00:12'),
(53, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:00:33'),
(54, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:00:38'),
(55, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:01:22'),
(56, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 14:01:27'),
(57, 1, 'Ghean Cruz', 'admin', 'settings', 'settings', 'SMS mode changed to Automatic (scheduled 2026-08-31 22:02:00)', '::1', '2026-08-31 14:01:52'),
(58, 1, 'Ghean Cruz', 'admin', 'notify', 'scan', 'SMS notification sent to jea da for student juan cruz', '::1', '2026-08-31 14:02:03'),
(59, 1, 'Ghean Cruz', 'admin', 'notify', 'scan', 'SMS notification sent to teacher SHANA MATILLANO for student juan cruz', '::1', '2026-08-31 14:02:03'),
(60, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:02:36'),
(61, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:02:54'),
(62, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:03:06'),
(63, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 14:03:11'),
(64, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:03:44'),
(65, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-08-31 14:03:48'),
(66, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:03:57'),
(67, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 14:04:03'),
(68, 1, 'Ghean Cruz', 'admin', 'release', 'scan', 'QR Release | Student: juan cruz (ID: 1) | Parent: jea da | SMS sent', '::1', '2026-08-31 14:05:24'),
(69, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:06:22'),
(70, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:06:28'),
(71, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:06:43'),
(72, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-08-31 14:06:49'),
(73, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:09:23'),
(74, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:09:31'),
(75, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:11:40'),
(76, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-08-31 14:11:45'),
(77, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:30:41'),
(78, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:30:53'),
(79, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:37:59'),
(80, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-08-31 14:38:05'),
(81, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:40:52'),
(82, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:41:05'),
(83, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:48:52'),
(84, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-08-31 14:49:05'),
(85, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:51:16'),
(86, 1, 'jea da', 'parent', 'login', 'auth', 'Parent logged in | Phone: 110417', '::1', '2026-08-31 14:51:28'),
(87, 1, 'jea da', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 14:54:34'),
(88, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 14:54:39'),
(89, 1, 'Ghean Cruz', 'admin', 'create', 'import', 'Imported 50 students + parents from Excel', '::1', '2026-08-31 15:25:33'),
(90, 1, 'Ghean Cruz', 'admin', 'create', 'teacher', 'Created teacher: Ghean rfd (Grade 2 - B)', '::1', '2026-08-31 15:26:30'),
(91, 1, 'Ghean Cruz', 'admin', 'update', 'teacher', 'Updated teacher: Ghean rfd (ID: 4)', '::1', '2026-08-31 15:26:44'),
(92, 1, 'Ghean Cruz', 'admin', 'create', 'staff', 'Created staff: Maria joy', '::1', '2026-08-31 15:56:41'),
(93, 1, 'Ghean Cruz', 'admin', 'update', 'parent', 'Sent passwords to 51 parent(s) who had not received one yet.', '::1', '2026-08-31 16:39:24'),
(94, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 16:41:50'),
(95, 47, 'Jasmine Velasco', 'parent', 'login', 'auth', 'Parent logged in | Phone: 09171000045', '::1', '2026-08-31 16:42:01'),
(96, 47, 'Jasmine Velasco', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 16:42:42'),
(97, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 16:53:26'),
(98, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 16:55:20'),
(99, 47, 'Jasmine Velasco', 'parent', 'login', 'auth', 'Parent logged in | Phone: 09171000045', '::1', '2026-08-31 16:55:31'),
(100, 47, 'Jasmine Velasco', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 16:55:54'),
(101, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 16:55:58');

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
(1, 1, 1, NULL, 'jea', '', 'da', 'Parent', 'QR', NULL, '2026-08-29 14:14:50'),
(2, 1, 1, NULL, 'jea', '', 'da', 'Parent', 'QR', NULL, '2026-08-31 14:05:24');

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
(2, 1, 'admin', 1, 'S5dnUYYoh9BZ0ZuCYPfI4SJkzj59eH9gvh4sR6gSP7mz7mKE8VcX1GsnCYxp2MKIjgSxXIdb9vazQM2FxakNxmUjBHQqmAVWbn3FEEVLMX1FgE2oCKlWf/zvoD0kssMmTygnRQ==', 1, '2026-08-29 22:12:31'),
(3, 47, 'parent', NULL, '/xHD1+JpEwphLrrpY1aI6w7llwwc+0p1Ny1IuJxIiFEeQMsQjtQ/hQCS8GcOLI2tTK5BFY1BoXnNRM0OOSQQ/ze+sFoUErtOD94AmUnc1tbkpccWFA==', 1, '2026-09-01 00:55:50');

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
  `password` varchar(255) DEFAULT NULL,
  `password_sent` tinyint(1) NOT NULL DEFAULT 0,
  `qr_code` varchar(100) DEFAULT NULL COMMENT 'Unique QR code for parent',
  `picture` varchar(255) DEFAULT NULL COMMENT 'Parent profile photo',
  `created_by` int(11) DEFAULT NULL COMMENT 'staff or admin id',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `fname`, `mname`, `lname`, `phone`, `password`, `password_sent`, `qr_code`, `picture`, `created_by`, `created_at`) VALUES
(1, 'jea', 'DE ', 'da', '110417', '$2y$10$BpYiUZry9Tz809E8c3XfruZjFcGreYRckE9dqLMfE0VgjMJDfUlb6', 1, 'QR-8W25Z', '1788012653_928c175ca7a18a59d1c5.jpg', 1, '2026-08-29 14:10:19'),
(2, 'Juan', NULL, 'Dela Cruz', '09171000000', '$2y$10$/72MgT3sCEv4.OurqwNsRehOMl1e38EDGmvy80TmZrazrOtteFGuS', 1, 'QR-S9AS5', NULL, 1, '2026-08-31 15:25:24'),
(3, 'Elena', NULL, 'Ramos', '09171000001', '$2y$10$BbyGUOQEjdpvLxQ/nadfJOQaitANHMkJDoyT7YHkPO182Px7do2G.', 1, 'QR-8WZMK', NULL, 1, '2026-08-31 15:25:25'),
(4, 'Nico', NULL, 'Castillo', '09171000002', '$2y$10$MdLTv0tzFu1t9yXH3wpUIukhwlhPVuG.ZT9mbXgk1d6wkttiahIF2', 1, 'QR-G5Z88', NULL, 1, '2026-08-31 15:25:25'),
(5, 'Grace', NULL, 'Guzman', '09171000003', '$2y$10$W0lmw4hiG8M4Lr0vnkOMj.FHASym0yUlW/ddx4b6OULJs9i9HuKVa', 1, 'QR-WPZ3Q', NULL, 1, '2026-08-31 15:25:25'),
(6, 'Rico', NULL, 'Rosario', '09171000004', '$2y$10$GgFT.SpwDooCyuFE.2UQ7O7QS2HJeqvG18.YHq4boLCUp0c0C7pZK', 1, 'QR-FTQHV', NULL, 1, '2026-08-31 15:25:25'),
(7, 'Daisy', NULL, 'Velasco', '09171000005', '$2y$10$Rjq/NtOXyP/JuN73SWXzu.6Dwmws5CMW9l8TXZwtQy7YzoQ4NKb4i', 1, 'QR-XP77B', NULL, 1, '2026-08-31 15:25:26'),
(8, 'Joey', NULL, 'Smith', '09171000006', '$2y$10$T3YPhw14KGBzH/Lq6vUnCu345RgY/IVZvwHc4HNREjhOFhb4HUB/C', 1, 'QR-Y3G6U', NULL, 1, '2026-08-31 15:25:26'),
(9, 'Maria', NULL, 'Saldana', '09171000007', '$2y$10$3/v8mpfIZH/CA9Nnf2l8COHe7hxE297p6VKHvnHuxMNoEAnkqYFSi', 1, 'QR-8XC2W', NULL, 1, '2026-08-31 15:25:26'),
(10, 'Carlo', NULL, 'Gonzales', '09171000008', '$2y$10$gSfeQcg7Wt96Ta/PxjP.4unNQMOHBqT42A01zynwua1MmQJ5HjYjO', 1, 'QR-CBMT6', NULL, 1, '2026-08-31 15:25:26'),
(11, 'Bianca', NULL, 'Lim', '09171000009', '$2y$10$aHP7/l49/YmECglHq0BV7eNIB8Du8s0QXaZCx9vcaacPQh6NtfOCO', 1, 'QR-TB2KF', NULL, 1, '2026-08-31 15:25:26'),
(12, 'Dennis', NULL, 'Dela Cruz', '09171000010', '$2y$10$Tazy.Ce.zg1LadrXH6Zam.Vp5lygIDHyR7V3RRoSc2IqJJdFcYG5q', 1, 'QR-4PBJA', NULL, 1, '2026-08-31 15:25:26'),
(13, 'Teresa', NULL, 'Ramos', '09171000011', '$2y$10$ptUKQ2J/4u68RDXM/WL5y.RPuAJLBUXuYjmqOvhRXhv506400woRi', 1, 'QR-9MPDY', NULL, 1, '2026-08-31 15:25:27'),
(14, 'Bryan', NULL, 'Castillo', '09171000012', '$2y$10$.bfQYSINFf92hJyK8pVXaOQNYcIHUUxCYQiwBP9QMf4r.ZOmtHWm6', 1, 'QR-B3FF9', NULL, 1, '2026-08-31 15:25:27'),
(15, 'Princess', NULL, 'Guzman', '09171000013', '$2y$10$zTYFelejWxXdbT7svy1t5e75/EyP9t50wC.TtDQFZvlraDyKUSf..', 1, 'QR-6N2Y7', NULL, 1, '2026-08-31 15:25:27'),
(16, 'Nestor', NULL, 'Rosario', '09171000014', '$2y$10$REYBOTXv0JIHjQb2mXrLTeZsCnVwACV3zv7B0AESmGogUCX3dWWna', 1, 'QR-5A2AS', NULL, 1, '2026-08-31 15:25:27'),
(17, 'Rosa', NULL, 'Velasco', '09171000015', '$2y$10$v6exOfaKUSLez8.tVFfCe.hiM2pNozWNaHlza8mV4frkUUVy06792', 1, 'QR-NG9UA', NULL, 1, '2026-08-31 15:25:27'),
(18, 'Ramon', NULL, 'Smith', '09171000016', '$2y$10$PKoGaNlvNR53ZqxDNeECXOtyAHwh07bGFIclM5MJ9tMoe/MPjEAu.', 1, 'QR-PZ34M', NULL, 1, '2026-08-31 15:25:27'),
(19, 'Isabel', NULL, 'Saldana', '09171000017', '$2y$10$GQ1aMd16Tt7CqgKgzDsw9.TesrtmbylXWjYK10wJQ8/PyhSxH8/Am', 1, 'QR-TBESS', NULL, 1, '2026-08-31 15:25:28'),
(20, 'Emilio', NULL, 'Gonzales', '09171000018', '$2y$10$vZzHoZf1f70/rO/AF44qv.17j9osdEE7WJwvXUf/XAcziL3GkDL.a', 1, 'QR-ZGABT', NULL, 1, '2026-08-31 15:25:28'),
(21, 'Kath', NULL, 'Lim', '09171000019', '$2y$10$U8bdHRF5pGLxI2ZisWDHkOZKCi7k.F2KIq580A2QFb6ArMheKt80a', 1, 'QR-E3WFN', NULL, 1, '2026-08-31 15:25:28'),
(22, 'Dan', NULL, 'Dela Cruz', '09171000020', '$2y$10$Gymke7GjJN7CU2JP/96ABOdvU5pnm9/MkKZW6Zf6T5ajT3vSO0zMm', 1, 'QR-DASVB', NULL, 1, '2026-08-31 15:25:28'),
(23, 'Veronica', NULL, 'Ramos', '09171000021', '$2y$10$wzgdIAMXLWq6bMSRAy8fLeDAebdAL2dS6B.jXEtEKEsPkpzQxy7ua', 1, 'QR-3VEYR', NULL, 1, '2026-08-31 15:25:28'),
(24, 'Miguel', NULL, 'Castillo', '09171000022', '$2y$10$sHRdcCwcWT.kXzYkzZmzLu.a4VPwxEUPx9n8XZgY2eBGb8zhEE3KS', 1, 'QR-SWZ5U', NULL, 1, '2026-08-31 15:25:29'),
(25, 'Andrea', NULL, 'Guzman', '09171000023', '$2y$10$SjQvjz6IRYQhwthvXn7Gg.6KOTlKQEL0LbF86ZLEwELCWvoRJsEk2', 1, 'QR-65VKW', NULL, 1, '2026-08-31 15:25:29'),
(26, 'Adrian', NULL, 'Rosario', '09171000024', '$2y$10$CUJk0pDCXYM5W1n.kOAGF.GWCrCyo09319Ii.TBys2AivI.aeMexy', 1, 'QR-AK35V', NULL, 1, '2026-08-31 15:25:29'),
(27, 'Clara', NULL, 'Velasco', '09171000025', '$2y$10$zVVIrftjqGnlVrHE.bisfOFTNySBIV4PDj/KHKa0Xr0MHTx2sKGJe', 1, 'QR-W2QQE', NULL, 1, '2026-08-31 15:25:29'),
(28, 'Renato', NULL, 'Smith', '09171000026', '$2y$10$Ai6Z0ZJj18Hq9ksNmO3ykuwfpxEqAT5WqihDvZfkbi3yq/9nC6NvO', 1, 'QR-KNQ2W', NULL, 1, '2026-08-31 15:25:29'),
(29, 'Shiela', NULL, 'Saldana', '09171000027', '$2y$10$/veU4/8sq3omwzEy6h8IZuVp27ZWlMAwICgCtEbksrWAuZiq40wwW', 1, 'QR-5HUHE', NULL, 1, '2026-08-31 15:25:30'),
(30, 'Romeo', NULL, 'Gonzales', '09171000028', '$2y$10$ZZso0CcbaPG5PDj.7UO3m.Yc2fbobeOXvjGVIjFoiII9FE.RVqaDO', 1, 'QR-3KEUF', NULL, 1, '2026-08-31 15:25:30'),
(31, 'Luz', NULL, 'Lim', '09171000029', '$2y$10$RwoU9.IYbNJGJshqlIXcmuiUjd2m4RdCw.l7bHvoEQRd9stj.zeiq', 1, 'QR-QB4CR', NULL, 1, '2026-08-31 15:25:30'),
(32, 'Marco', NULL, 'Dela Cruz', '09171000030', '$2y$10$HxybzocpyOv2F7Hbhx2yOOBVDrFQmUltk.jBYsLsUT5Q25FvGZ1e6', 1, 'QR-WNAJ7', NULL, 1, '2026-08-31 15:25:30'),
(33, 'Camille', NULL, 'Ramos', '09171000031', '$2y$10$smkmN7bz0s319fCM7yoAe.8RO42n.zoYvVziWp/G2xLBhR7qfF1tW', 1, 'QR-H9JTG', NULL, 1, '2026-08-31 15:25:30'),
(34, 'Victor', NULL, 'Castillo', '09171000032', '$2y$10$3ykaQItjG.TNyD9D0m5wU.6dw1xLicFtx/exvo..aWM4Pj6HqCIhy', 1, 'QR-J3H6X', NULL, 1, '2026-08-31 15:25:31'),
(35, 'Liza', NULL, 'Guzman', '09171000033', '$2y$10$M7NIEiyesiKIAodp9bt9LeIZzk/q/Ae23.RedqdjitqQFQd2iRCgm', 1, 'QR-HMK4W', NULL, 1, '2026-08-31 15:25:31'),
(36, 'Gilbert', NULL, 'Rosario', '09171000034', '$2y$10$R8dGGqlbUR7Aaa/ukw/9pO6zFBSWRnBV3Wt/j0pwYWcflaKjzFWGy', 1, 'QR-YTB5G', NULL, 1, '2026-08-31 15:25:31'),
(37, 'Melanie', NULL, 'Velasco', '09171000035', '$2y$10$ZlbRuRmIXSqXYJG/N1aJMOTnF4HNH14FTwTat0Y3SW0c3/P8a/bOW', 1, 'QR-74WBG', NULL, 1, '2026-08-31 15:25:31'),
(38, 'Pedro', NULL, 'Smith', '09171000036', '$2y$10$XuP5BcHbc.bMUVqcgwIEkulpd0IaYZQDEsSPgaPVg1zrkJkgICGXy', 1, 'QR-Z8NG7', NULL, 1, '2026-08-31 15:25:31'),
(39, 'Sofia', NULL, 'Saldana', '09171000037', '$2y$10$eRWXb1kSGC3a9myF.UcK9u3rUSsq5LqYTApSluVomdejQvwGo3Ho.', 1, 'QR-F75FK', NULL, 1, '2026-08-31 15:25:31'),
(40, 'Leo', NULL, 'Gonzales', '09171000038', '$2y$10$pvPpepC6SRKvpo9DzcuQk.n8aqYmJJNXq7y/Bo08qqB88vwVKecKS', 1, 'QR-9FVHS', NULL, 1, '2026-08-31 15:25:32'),
(41, 'Nina', NULL, 'Lim', '09171000039', '$2y$10$iqIzZDRt9sbi.YEb8bljuugA4qWX3DEv/tCtJhivAzUyaSnMA4O5y', 1, 'QR-EPEWT', NULL, 1, '2026-08-31 15:25:32'),
(42, 'Francis', NULL, 'Dela Cruz', '09171000040', '$2y$10$zN.OGu12OTX3rmiV9UFwV.AoMlD.91ztBWBEOTzvVhEN1iG1rhlMu', 1, 'QR-KRNUG', NULL, 1, '2026-08-31 15:25:32'),
(43, 'Mara', NULL, 'Ramos', '09171000041', '$2y$10$AfoIK8Iu973fGJmO7q8rJuMTBwpK4oPQ8kbz.Vr.rQazbtv.YXT/W', 1, 'QR-GVPTH', NULL, 1, '2026-08-31 15:25:32'),
(44, 'Paul', NULL, 'Castillo', '09171000042', '$2y$10$Q2nhbVShRzBYGAwSYlK.eOBwNaEE2Bej.sla6p1HScggLnXNpYJoq', 1, 'QR-UQJE7', NULL, 1, '2026-08-31 15:25:32'),
(45, 'Ana', NULL, 'Guzman', '09171000043', '$2y$10$5CAlnx9IpYCgBwu.IhQMdeiOrbU4rVQAQGEldjDTGKSi7Asisy.hy', 1, 'QR-X8C38', NULL, 1, '2026-08-31 15:25:32'),
(46, 'Paolo', NULL, 'Rosario', '09171000044', '$2y$10$ikLrrjtJo9gIbWFX9N79kOhFGJDFJ3.e0E/5VLGGwCs0ygrPp7dRG', 1, 'QR-HCU48', NULL, 1, '2026-08-31 15:25:33'),
(47, 'Jasmine', NULL, 'Velasco', '09171000045', '$2y$10$21jKBJHEdGQc2FehrckqVeSrVJpwXbwYLAZgkonIdWTITWwUZ/sbO', 1, 'QR-M4QXP', NULL, 1, '2026-08-31 15:25:33'),
(48, 'Alvin', NULL, 'Smith', '09171000046', '$2y$10$9ZRTit7texQpnw3KPQqkUe2FjLFZrpfVzRSGv78RVFQKQJMwnqXC2', 1, 'QR-4AHM7', NULL, 1, '2026-08-31 15:25:33'),
(49, 'Joy', NULL, 'Saldana', '09171000047', '$2y$10$CQF3XG6/5ifuo4aXESwJf.banRby23O5y3/UP4HTSvIrgTDHBclw.', 1, 'QR-YDHDP', NULL, 1, '2026-08-31 15:25:33'),
(50, 'Erwin', NULL, 'Gonzales', '09171000048', '$2y$10$LiSXv2j50PMY6sQm/rsJXea3FKDmS5Wo6pBykCEtKYaAnD8e8y63i', 1, 'QR-VRXPD', NULL, 1, '2026-08-31 15:25:33'),
(51, 'Angela', NULL, 'Lim', '09171000049', '$2y$10$MebVmpk6uMx.B.r.u9olJ.w5xDECire4nWDJcCxAlSNux8sHgKNfS', 1, 'QR-7EECC', NULL, 1, '2026-08-31 15:25:33');

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
(1, 'sms_mode', 'auto', '2026-08-31 22:01:52'),
(2, 'auto_sms_interval', '60', '2026-08-29 15:04:30'),
(3, 'auto_sms_datetime', '2026-08-31 22:02:00', '2026-08-31 22:01:52'),
(4, 'auto_sms_last_run', '2026-08-31 22:02:00', '2026-08-31 22:02:03');

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
(8, '110417', 'Your child juan cruz has been released at 10:14 PM. - BCC Scan2Fetch', 'sent', '2026-08-29 14:14:50'),
(9, '09995011147', 'Your new Scan2Fetch teacher account password is: Z7VeXXxs (recorded in SMS logs).', 'sent', '2026-08-31 13:57:57'),
(10, '110417', 'Your new Scan2Fetch account password is: 2h3Cs2Ux (recorded in SMS logs).', 'sent', '2026-08-31 13:59:57'),
(11, '110417', 'Reminder: Your child juan cruz has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', '2026-08-31 14:02:03'),
(12, '09995011147', 'Reminder: juan cruz (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', '2026-08-31 14:02:03'),
(13, '110417', 'Your child juan cruz has been released at 10:05 PM. - BCC Scan2Fetch', 'sent', '2026-08-31 14:05:24'),
(14, '09171000000', 'Your Scan2Fetch account password is: De9mBmcK (recorded in SMS logs).', 'sent', '2026-08-31 15:25:24'),
(15, '09171000001', 'Your Scan2Fetch account password is: kMEXcZFj (recorded in SMS logs).', 'sent', '2026-08-31 15:25:25'),
(16, '09171000002', 'Your Scan2Fetch account password is: AvgsyeL3 (recorded in SMS logs).', 'sent', '2026-08-31 15:25:25'),
(17, '09171000003', 'Your Scan2Fetch account password is: 3ktBdU2c (recorded in SMS logs).', 'sent', '2026-08-31 15:25:25'),
(18, '09171000004', 'Your Scan2Fetch account password is: AwKwsT43 (recorded in SMS logs).', 'sent', '2026-08-31 15:25:25'),
(19, '09171000005', 'Your Scan2Fetch account password is: e4ZTmWpt (recorded in SMS logs).', 'sent', '2026-08-31 15:25:26'),
(20, '09171000006', 'Your Scan2Fetch account password is: NZg3Vnvm (recorded in SMS logs).', 'sent', '2026-08-31 15:25:26'),
(21, '09171000007', 'Your Scan2Fetch account password is: 9cWGw5sW (recorded in SMS logs).', 'sent', '2026-08-31 15:25:26'),
(22, '09171000008', 'Your Scan2Fetch account password is: EKmjcxHf (recorded in SMS logs).', 'sent', '2026-08-31 15:25:26'),
(23, '09171000009', 'Your Scan2Fetch account password is: upYhgTha (recorded in SMS logs).', 'sent', '2026-08-31 15:25:26'),
(24, '09171000010', 'Your Scan2Fetch account password is: Hx4RhpqU (recorded in SMS logs).', 'sent', '2026-08-31 15:25:26'),
(25, '09171000011', 'Your Scan2Fetch account password is: gqQGAfmD (recorded in SMS logs).', 'sent', '2026-08-31 15:25:27'),
(26, '09171000012', 'Your Scan2Fetch account password is: eAnjy6UK (recorded in SMS logs).', 'sent', '2026-08-31 15:25:27'),
(27, '09171000013', 'Your Scan2Fetch account password is: rC5AvCGR (recorded in SMS logs).', 'sent', '2026-08-31 15:25:27'),
(28, '09171000014', 'Your Scan2Fetch account password is: GDcSAdps (recorded in SMS logs).', 'sent', '2026-08-31 15:25:27'),
(29, '09171000015', 'Your Scan2Fetch account password is: hqzAE98K (recorded in SMS logs).', 'sent', '2026-08-31 15:25:27'),
(30, '09171000016', 'Your Scan2Fetch account password is: Y8bAfHp3 (recorded in SMS logs).', 'sent', '2026-08-31 15:25:27'),
(31, '09171000017', 'Your Scan2Fetch account password is: ya7GANND (recorded in SMS logs).', 'sent', '2026-08-31 15:25:28'),
(32, '09171000018', 'Your Scan2Fetch account password is: evjkj9kS (recorded in SMS logs).', 'sent', '2026-08-31 15:25:28'),
(33, '09171000019', 'Your Scan2Fetch account password is: wV2ezVxN (recorded in SMS logs).', 'sent', '2026-08-31 15:25:28'),
(34, '09171000020', 'Your Scan2Fetch account password is: Lf98uWRB (recorded in SMS logs).', 'sent', '2026-08-31 15:25:28'),
(35, '09171000021', 'Your Scan2Fetch account password is: ccYmHBfk (recorded in SMS logs).', 'sent', '2026-08-31 15:25:28'),
(36, '09171000022', 'Your Scan2Fetch account password is: 5nna8VUk (recorded in SMS logs).', 'sent', '2026-08-31 15:25:29'),
(37, '09171000023', 'Your Scan2Fetch account password is: skDyewEa (recorded in SMS logs).', 'sent', '2026-08-31 15:25:29'),
(38, '09171000024', 'Your Scan2Fetch account password is: U6sRBgfH (recorded in SMS logs).', 'sent', '2026-08-31 15:25:29'),
(39, '09171000025', 'Your Scan2Fetch account password is: 2ZxvNawT (recorded in SMS logs).', 'sent', '2026-08-31 15:25:29'),
(40, '09171000026', 'Your Scan2Fetch account password is: LgzRBCsz (recorded in SMS logs).', 'sent', '2026-08-31 15:25:29'),
(41, '09171000027', 'Your Scan2Fetch account password is: nsSckRjG (recorded in SMS logs).', 'sent', '2026-08-31 15:25:30'),
(42, '09171000028', 'Your Scan2Fetch account password is: 4ytBcG2Q (recorded in SMS logs).', 'sent', '2026-08-31 15:25:30'),
(43, '09171000029', 'Your Scan2Fetch account password is: fJXLgy2N (recorded in SMS logs).', 'sent', '2026-08-31 15:25:30'),
(44, '09171000030', 'Your Scan2Fetch account password is: Ud8TT2fc (recorded in SMS logs).', 'sent', '2026-08-31 15:25:30'),
(45, '09171000031', 'Your Scan2Fetch account password is: xtGUgmhU (recorded in SMS logs).', 'sent', '2026-08-31 15:25:30'),
(46, '09171000032', 'Your Scan2Fetch account password is: 4Q757hsW (recorded in SMS logs).', 'sent', '2026-08-31 15:25:31'),
(47, '09171000033', 'Your Scan2Fetch account password is: rzhjFAmj (recorded in SMS logs).', 'sent', '2026-08-31 15:25:31'),
(48, '09171000034', 'Your Scan2Fetch account password is: CJ8eWq3X (recorded in SMS logs).', 'sent', '2026-08-31 15:25:31'),
(49, '09171000035', 'Your Scan2Fetch account password is: Ds6dHNTY (recorded in SMS logs).', 'sent', '2026-08-31 15:25:31'),
(50, '09171000036', 'Your Scan2Fetch account password is: x7j2LaTc (recorded in SMS logs).', 'sent', '2026-08-31 15:25:31'),
(51, '09171000037', 'Your Scan2Fetch account password is: uUTDCr6p (recorded in SMS logs).', 'sent', '2026-08-31 15:25:31'),
(52, '09171000038', 'Your Scan2Fetch account password is: ffzVpFsg (recorded in SMS logs).', 'sent', '2026-08-31 15:25:32'),
(53, '09171000039', 'Your Scan2Fetch account password is: na3duFQs (recorded in SMS logs).', 'sent', '2026-08-31 15:25:32'),
(54, '09171000040', 'Your Scan2Fetch account password is: ZPZ3XAxV (recorded in SMS logs).', 'sent', '2026-08-31 15:25:32'),
(55, '09171000041', 'Your Scan2Fetch account password is: 5Wk3VD78 (recorded in SMS logs).', 'sent', '2026-08-31 15:25:32'),
(56, '09171000042', 'Your Scan2Fetch account password is: CeyZN88Y (recorded in SMS logs).', 'sent', '2026-08-31 15:25:32'),
(57, '09171000043', 'Your Scan2Fetch account password is: VpX8uaMq (recorded in SMS logs).', 'sent', '2026-08-31 15:25:32'),
(58, '09171000044', 'Your Scan2Fetch account password is: dJaZjJL8 (recorded in SMS logs).', 'sent', '2026-08-31 15:25:33'),
(59, '09171000045', 'Your Scan2Fetch account password is: msFjpKGr (recorded in SMS logs).', 'sent', '2026-08-31 15:25:33'),
(60, '09171000046', 'Your Scan2Fetch account password is: F7r3v3L8 (recorded in SMS logs).', 'sent', '2026-08-31 15:25:33'),
(61, '09171000047', 'Your Scan2Fetch account password is: WpmswvgT (recorded in SMS logs).', 'sent', '2026-08-31 15:25:33'),
(62, '09171000048', 'Your Scan2Fetch account password is: XEX9JQ4Z (recorded in SMS logs).', 'sent', '2026-08-31 15:25:33'),
(63, '09171000049', 'Your Scan2Fetch account password is: jeUFkYfK (recorded in SMS logs).', 'sent', '2026-08-31 15:25:33'),
(64, '123', 'Your Scan2Fetch teacher account password is: WqEnCfBp (recorded in SMS logs).', 'sent', '2026-08-31 15:26:30'),
(65, '123', 'Your Scan2Fetch staff account password is: h7zzkraJ (recorded in SMS logs).', 'sent', '2026-08-31 15:56:41'),
(66, '110417', 'Your new parent account password is: ZyNQtRBV (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(67, '09171000000', 'Your new parent account password is: PPdx5AR5 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(68, '09171000001', 'Your new parent account password is: FagWRsDU (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(69, '09171000002', 'Your new parent account password is: ax8bvsTv (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(70, '09171000003', 'Your new parent account password is: QFDF3abX (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(71, '09171000004', 'Your new parent account password is: vEP7zJvM (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(72, '09171000005', 'Your new parent account password is: LrU7MypP (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(73, '09171000006', 'Your new parent account password is: EqE8yJnt (recorded in SMS logs).', 'sent', '2026-08-31 16:39:18'),
(74, '09171000007', 'Your new parent account password is: wErdEka4 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(75, '09171000008', 'Your new parent account password is: EMTgc9xM (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(76, '09171000009', 'Your new parent account password is: hV5V4H6c (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(77, '09171000010', 'Your new parent account password is: Wmk2TqNR (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(78, '09171000011', 'Your new parent account password is: N3r7GbPP (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(79, '09171000012', 'Your new parent account password is: auG34DAD (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(80, '09171000013', 'Your new parent account password is: Qrd3Mmm4 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(81, '09171000014', 'Your new parent account password is: T7UVfD4H (recorded in SMS logs).', 'sent', '2026-08-31 16:39:19'),
(82, '09171000015', 'Your new parent account password is: yAvF9hQs (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(83, '09171000016', 'Your new parent account password is: TepVBVn4 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(84, '09171000017', 'Your new parent account password is: UZqsEAnX (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(85, '09171000018', 'Your new parent account password is: csx8E6xK (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(86, '09171000019', 'Your new parent account password is: hJ8xKcPY (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(87, '09171000020', 'Your new parent account password is: 2rW3P9RG (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(88, '09171000021', 'Your new parent account password is: 8sKdUanw (recorded in SMS logs).', 'sent', '2026-08-31 16:39:20'),
(89, '09171000022', 'Your new parent account password is: sPQJgm8e (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(90, '09171000023', 'Your new parent account password is: CbEUNCT9 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(91, '09171000024', 'Your new parent account password is: XtU7x54Z (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(92, '09171000025', 'Your new parent account password is: G6BTAj2D (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(93, '09171000026', 'Your new parent account password is: dWHHHKMj (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(94, '09171000027', 'Your new parent account password is: xkzpJcuK (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(95, '09171000028', 'Your new parent account password is: HdAX3mDb (recorded in SMS logs).', 'sent', '2026-08-31 16:39:21'),
(96, '09171000029', 'Your new parent account password is: VANVC8Bs (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(97, '09171000030', 'Your new parent account password is: fEt66Mz4 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(98, '09171000031', 'Your new parent account password is: CtNHaZDF (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(99, '09171000032', 'Your new parent account password is: Wy5bEGQh (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(100, '09171000033', 'Your new parent account password is: MzL5fDCh (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(101, '09171000034', 'Your new parent account password is: sU3FwQGz (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(102, '09171000035', 'Your new parent account password is: dYujVEQX (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(103, '09171000036', 'Your new parent account password is: CSdtA4YG (recorded in SMS logs).', 'sent', '2026-08-31 16:39:22'),
(104, '09171000037', 'Your new parent account password is: 9YMe5AuM (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(105, '09171000038', 'Your new parent account password is: uWfhAdrc (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(106, '09171000039', 'Your new parent account password is: vguKhakz (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(107, '09171000040', 'Your new parent account password is: s2qcsyqV (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(108, '09171000041', 'Your new parent account password is: EzJDvst2 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(109, '09171000042', 'Your new parent account password is: xYZfBrzW (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(110, '09171000043', 'Your new parent account password is: ZRAKVU28 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(111, '09171000044', 'Your new parent account password is: 8pzC6XQu (recorded in SMS logs).', 'sent', '2026-08-31 16:39:23'),
(112, '09171000045', 'Your new parent account password is: P9y5RR2S (recorded in SMS logs).', 'sent', '2026-08-31 16:39:24'),
(113, '09171000046', 'Your new parent account password is: a3XqypeX (recorded in SMS logs).', 'sent', '2026-08-31 16:39:24'),
(114, '09171000047', 'Your new parent account password is: vBPf9wnA (recorded in SMS logs).', 'sent', '2026-08-31 16:39:24'),
(115, '09171000048', 'Your new parent account password is: mLUw76Z8 (recorded in SMS logs).', 'sent', '2026-08-31 16:39:24'),
(116, '09171000049', 'Your new parent account password is: QCTkeQAW (recorded in SMS logs).', 'sent', '2026-08-31 16:39:24');

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
(2, 1, 3, 'Reminder: juan cruz (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-08-29 22:13:05'),
(3, 1, 1, 'Reminder: Your child juan cruz has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-08-31 22:02:03'),
(4, 1, 3, 'Reminder: juan cruz (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-08-31 22:02:03');

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
  `password` varchar(255) DEFAULT NULL,
  `password_sent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `fname`, `mname`, `lname`, `picture`, `phone`, `password`, `password_sent`, `created_at`) VALUES
(2, 'Maria', 'JOY', 'joy', NULL, '123', '$2y$10$PWTzg98Z8AhCx5Eti109cOCEo4rS4lipILej99lmbDoo674cmwQ7y', 1, '2026-08-31 15:56:41');

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
(1, 'juan', 'dela ', 'cruz', 'Grade 1 - A', '1788012619_e6116c9aef1ded91938f.jpg', 1, '2026-08-29 14:10:19', '2026-08-31 22:02:03'),
(2, 'Maria', NULL, 'Santos', 'Kindergarten - A', NULL, 1, '2026-08-31 15:25:23', NULL),
(3, 'Ana', NULL, 'Garcia', 'Kindergarten - B', NULL, 1, '2026-08-31 15:25:24', NULL),
(4, 'Luz', NULL, 'Flores', 'Grade 1 - A', NULL, 1, '2026-08-31 15:25:25', NULL),
(5, 'Rosa', NULL, 'Villanueva', 'Grade 1 - B', NULL, 1, '2026-08-31 15:25:25', NULL),
(6, 'Elena', NULL, 'Castillo', 'Grade 2 - A', NULL, 1, '2026-08-31 15:25:25', NULL),
(7, 'Sofia', NULL, 'Lopez', 'Grade 2 - B', NULL, 1, '2026-08-31 15:25:25', NULL),
(8, 'Andrea', NULL, 'Rivera', 'Grade 3 - A', NULL, 1, '2026-08-31 15:25:26', NULL),
(9, 'Bianca', NULL, 'Padilla', 'Grade 3 - B', NULL, 1, '2026-08-31 15:25:26', NULL),
(10, 'Jasmine', NULL, 'Ocampo', 'Grade 4 - A', NULL, 1, '2026-08-31 15:25:26', NULL),
(11, 'Camille', NULL, 'Velasco', 'Grade 4 - B', NULL, 1, '2026-08-31 15:25:26', NULL),
(12, 'Isabel', NULL, 'Go', 'Grade 5 - A', NULL, 1, '2026-08-31 15:25:26', NULL),
(13, 'Grace', NULL, 'Duran', 'Grade 5 - B', NULL, 1, '2026-08-31 15:25:26', NULL),
(14, 'Nina', NULL, 'Pineda', 'Grade 6 - A', NULL, 1, '2026-08-31 15:25:27', NULL),
(15, 'Clara', NULL, 'Cabrera', 'Grade 6 - B', NULL, 1, '2026-08-31 15:25:27', NULL),
(16, 'Teresa', NULL, 'Gonzales', 'Kindergarten - A', NULL, 1, '2026-08-31 15:25:27', NULL),
(17, 'Joy', NULL, 'Jimenez', 'Kindergarten - B', NULL, 1, '2026-08-31 15:25:27', NULL),
(18, 'Liza', NULL, 'Morales', 'Grade 1 - A', NULL, 1, '2026-08-31 15:25:27', NULL),
(19, 'Kath', NULL, 'Reyes', 'Grade 1 - B', NULL, 1, '2026-08-31 15:25:27', NULL),
(20, 'Daisy', NULL, 'Mendoza', 'Grade 2 - A', NULL, 1, '2026-08-31 15:25:28', NULL),
(21, 'Mara', NULL, 'Ramos', 'Grade 2 - B', NULL, 1, '2026-08-31 15:25:28', NULL),
(22, 'Shiela', NULL, 'Aquino', 'Grade 3 - A', NULL, 1, '2026-08-31 15:25:28', NULL),
(23, 'Princess', NULL, 'Domingo', 'Grade 3 - B', NULL, 1, '2026-08-31 15:25:28', NULL),
(24, 'Angela', NULL, 'Marquez', 'Grade 4 - A', NULL, 1, '2026-08-31 15:25:28', NULL),
(25, 'Melanie', NULL, 'Delgado', 'Grade 4 - B', NULL, 1, '2026-08-31 15:25:29', NULL),
(26, 'Veronica', NULL, 'Rosario', 'Grade 5 - A', NULL, 1, '2026-08-31 15:25:29', NULL),
(27, 'Maria', NULL, 'Dizon', 'Grade 5 - B', NULL, 1, '2026-08-31 15:25:29', NULL),
(28, 'Ana', NULL, 'Cruz', 'Grade 6 - A', NULL, 1, '2026-08-31 15:25:29', NULL),
(29, 'Luz', NULL, 'Parker', 'Grade 6 - B', NULL, 1, '2026-08-31 15:25:29', NULL),
(30, 'Rosa', NULL, 'Lara', 'Kindergarten - A', NULL, 1, '2026-08-31 15:25:30', NULL),
(31, 'Elena', NULL, 'Saldana', 'Kindergarten - B', NULL, 1, '2026-08-31 15:25:30', NULL),
(32, 'Sofia', NULL, 'Espinoza', 'Grade 1 - A', NULL, 1, '2026-08-31 15:25:30', NULL),
(33, 'Andrea', NULL, 'Hernandez', 'Grade 1 - B', NULL, 1, '2026-08-31 15:25:30', NULL),
(34, 'Bianca', NULL, 'King', 'Grade 2 - A', NULL, 1, '2026-08-31 15:25:30', NULL),
(35, 'Jasmine', NULL, 'Nuñez', 'Grade 2 - B', NULL, 1, '2026-08-31 15:25:31', NULL),
(36, 'Camille', NULL, 'Dela Cruz', 'Grade 3 - A', NULL, 1, '2026-08-31 15:25:31', NULL),
(37, 'Isabel', NULL, 'Torres', 'Grade 3 - B', NULL, 1, '2026-08-31 15:25:31', NULL),
(38, 'Grace', NULL, 'Bautista', 'Grade 4 - A', NULL, 1, '2026-08-31 15:25:31', NULL),
(39, 'Nina', NULL, 'Navarro', 'Grade 4 - B', NULL, 1, '2026-08-31 15:25:31', NULL),
(40, 'Clara', NULL, 'Salazar', 'Grade 5 - A', NULL, 1, '2026-08-31 15:25:31', NULL),
(41, 'Teresa', NULL, 'Guzman', 'Grade 5 - B', NULL, 1, '2026-08-31 15:25:32', NULL),
(42, 'Joy', NULL, 'Cortez', 'Grade 6 - A', NULL, 1, '2026-08-31 15:25:32', NULL),
(43, 'Liza', NULL, 'Santiago', 'Grade 6 - B', NULL, 1, '2026-08-31 15:25:32', NULL),
(44, 'Kath', NULL, 'Manalo', 'Kindergarten - A', NULL, 1, '2026-08-31 15:25:32', NULL),
(45, 'Daisy', NULL, 'Fernandez', 'Kindergarten - B', NULL, 1, '2026-08-31 15:25:32', NULL),
(46, 'Mara', NULL, 'Smith', 'Grade 1 - A', NULL, 1, '2026-08-31 15:25:32', NULL),
(47, 'Shiela', NULL, 'Mercado', 'Grade 1 - B', NULL, 1, '2026-08-31 15:25:33', NULL),
(48, 'Princess', NULL, 'Beltran', 'Grade 2 - A', NULL, 1, '2026-08-31 15:25:33', NULL),
(49, 'Angela', NULL, 'Fajardo', 'Grade 2 - B', NULL, 1, '2026-08-31 15:25:33', NULL),
(50, 'Melanie', NULL, 'Ibarra', 'Grade 3 - A', NULL, 1, '2026-08-31 15:25:33', NULL),
(51, 'Veronica', NULL, 'Lim', 'Grade 3 - B', NULL, 1, '2026-08-31 15:25:33', NULL);

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
(1, 1, 1, 'Parent', '2026-08-29 14:10:19'),
(2, 2, 2, 'Father', '2026-08-31 15:25:24'),
(3, 3, 3, 'Mother', '2026-08-31 15:25:25'),
(4, 4, 4, 'Guardian', '2026-08-31 15:25:25'),
(5, 5, 5, 'Father', '2026-08-31 15:25:25'),
(6, 6, 6, 'Mother', '2026-08-31 15:25:25'),
(7, 7, 7, 'Guardian', '2026-08-31 15:25:26'),
(8, 8, 8, 'Father', '2026-08-31 15:25:26'),
(9, 9, 9, 'Mother', '2026-08-31 15:25:26'),
(10, 10, 10, 'Guardian', '2026-08-31 15:25:26'),
(11, 11, 11, 'Father', '2026-08-31 15:25:26'),
(12, 12, 12, 'Mother', '2026-08-31 15:25:26'),
(13, 13, 13, 'Guardian', '2026-08-31 15:25:27'),
(14, 14, 14, 'Father', '2026-08-31 15:25:27'),
(15, 15, 15, 'Mother', '2026-08-31 15:25:27'),
(16, 16, 16, 'Guardian', '2026-08-31 15:25:27'),
(17, 17, 17, 'Father', '2026-08-31 15:25:27'),
(18, 18, 18, 'Mother', '2026-08-31 15:25:27'),
(19, 19, 19, 'Guardian', '2026-08-31 15:25:28'),
(20, 20, 20, 'Father', '2026-08-31 15:25:28'),
(21, 21, 21, 'Mother', '2026-08-31 15:25:28'),
(22, 22, 22, 'Guardian', '2026-08-31 15:25:28'),
(23, 23, 23, 'Father', '2026-08-31 15:25:28'),
(24, 24, 24, 'Mother', '2026-08-31 15:25:29'),
(25, 25, 25, 'Guardian', '2026-08-31 15:25:29'),
(26, 26, 26, 'Father', '2026-08-31 15:25:29'),
(27, 27, 27, 'Mother', '2026-08-31 15:25:29'),
(28, 28, 28, 'Guardian', '2026-08-31 15:25:29'),
(29, 29, 29, 'Father', '2026-08-31 15:25:30'),
(30, 30, 30, 'Mother', '2026-08-31 15:25:30'),
(31, 31, 31, 'Guardian', '2026-08-31 15:25:30'),
(32, 32, 32, 'Father', '2026-08-31 15:25:30'),
(33, 33, 33, 'Mother', '2026-08-31 15:25:30'),
(34, 34, 34, 'Guardian', '2026-08-31 15:25:31'),
(35, 35, 35, 'Father', '2026-08-31 15:25:31'),
(36, 36, 36, 'Mother', '2026-08-31 15:25:31'),
(37, 37, 37, 'Guardian', '2026-08-31 15:25:31'),
(38, 38, 38, 'Father', '2026-08-31 15:25:31'),
(39, 39, 39, 'Mother', '2026-08-31 15:25:31'),
(40, 40, 40, 'Guardian', '2026-08-31 15:25:32'),
(41, 41, 41, 'Father', '2026-08-31 15:25:32'),
(42, 42, 42, 'Mother', '2026-08-31 15:25:32'),
(43, 43, 43, 'Guardian', '2026-08-31 15:25:32'),
(44, 44, 44, 'Father', '2026-08-31 15:25:32'),
(45, 45, 45, 'Mother', '2026-08-31 15:25:32'),
(46, 46, 46, 'Guardian', '2026-08-31 15:25:33'),
(47, 47, 47, 'Father', '2026-08-31 15:25:33'),
(48, 48, 48, 'Mother', '2026-08-31 15:25:33'),
(49, 49, 49, 'Guardian', '2026-08-31 15:25:33'),
(50, 50, 50, 'Father', '2026-08-31 15:25:33'),
(51, 51, 51, 'Mother', '2026-08-31 15:25:33');

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
  `password` varchar(255) DEFAULT NULL,
  `password_sent` tinyint(1) NOT NULL DEFAULT 0,
  `grade_section` varchar(50) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fname`, `mname`, `lname`, `picture`, `phone`, `password`, `password_sent`, `grade_section`, `created_by`, `created_at`) VALUES
(3, 'SHANA', 'JOY', 'MATILLANO', '1788007862_cec08cf549e13d5b9e37.png', '09995011147', '$2y$10$vfBGvuo7GeDfItoipabvH.tBGf3JNpWFC3z10pXpjlM/N2JcUdcCG', 0, 'Grade 1 - A', 1, '2026-08-29 12:51:02'),
(4, 'Ghean', 'Dela', 'rfd', '1788190004_0d58fcd03898973d0c74.jpg', '123', '$2y$10$EooKnsfRRmfmvCeumqI/hOyWBsqTK7SnUbrZ5EJR99I7t6WZyp/M2', 0, 'Grade 2 - B', 1, '2026-08-31 15:26:30');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `sms_notification_logs`
--
ALTER TABLE `sms_notification_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sub_fetchers`
--
ALTER TABLE `sub_fetchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
