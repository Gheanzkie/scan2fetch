-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2026 at 03:00 PM
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
(101, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-08-31 16:55:58'),
(102, 1, 'Ghean Cruz', 'admin', 'update', 'teacher', 'Sent passwords to 2 teacher(s) who had not received one yet.', '::1', '2026-08-31 17:05:41'),
(103, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-08-31 17:12:33'),
(104, 1, 'Ghean Cruz', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-01 12:28:17'),
(105, 1, 'Ghean Cruz', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 12:29:28'),
(106, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-01 12:29:34'),
(107, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 12:41:00'),
(108, 46, 'Paolo Rosario', 'parent', 'login', 'auth', 'Parent logged in | Phone: 09171000044', '::1', '2026-09-01 12:41:16'),
(109, 46, 'Paolo Rosario', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 12:42:36'),
(110, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-01 12:42:41'),
(111, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 12:43:27'),
(112, 4, 'Ghean rfd', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 123', '::1', '2026-09-01 12:43:32'),
(113, 4, 'Ghean rfd', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 12:54:56'),
(114, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-01 12:55:08'),
(115, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Angela Fajardo (ID: 49) | Parent: Joy Saldana | SMS sent', '::1', '2026-09-01 13:57:30'),
(116, 1, 'Admin ', 'admin', 'update', 'teacher', 'Sent passwords to 0 teacher(s) who had not received one yet.', '::1', '2026-09-01 14:27:46'),
(117, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 14:29:14'),
(118, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-01 14:42:18'),
(119, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Angela Fajardo (ID: 49) | Parent: Joy Saldana | SMS sent', '::1', '2026-09-01 14:49:03'),
(120, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Angela Fajardo (ID: 49) | Parent: Joy Saldana | SMS sent', '::1', '2026-09-01 14:53:09'),
(121, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Angela Fajardo (ID: 49) | Parent: Joy Saldana | SMS sent', '::1', '2026-09-01 14:54:54'),
(122, 1, 'Admin ', 'admin', 'create', 'scan', 'Started gate scanning session.', '::1', '2026-09-01 15:10:09'),
(123, 1, 'Admin ', 'admin', 'update', 'scan', 'Stopped gate scanning session.', '::1', '2026-09-01 15:10:40'),
(124, 1, 'Admin ', 'admin', 'create', 'scan', 'Started gate scanning session.', '::1', '2026-09-01 15:10:43'),
(125, 1, 'Admin ', 'admin', 'update', 'scan', 'Stopped gate scanning session.', '::1', '2026-09-01 15:11:28'),
(126, 1, 'Admin ', 'admin', 'create', 'scan', 'Started gate scanning session.', '::1', '2026-09-01 15:11:28'),
(127, 1, 'Admin ', 'admin', 'update', 'scan', 'Stopped gate scanning session.', '::1', '2026-09-01 15:13:27'),
(128, 1, 'Admin ', 'admin', 'create', 'scan', 'Started gate scanning session.', '::1', '2026-09-01 15:13:28'),
(129, 1, 'Admin ', 'admin', 'update', 'scan', 'Stopped gate scanning session.', '::1', '2026-09-01 15:18:00'),
(130, 1, 'Admin ', 'admin', 'create', 'scan', 'Started gate scanning session.', '::1', '2026-09-01 15:18:01'),
(131, 1, 'Admin ', 'admin', 'update', 'scan', 'Stopped gate scanning session.', '::1', '2026-09-01 15:18:20'),
(132, 1, 'Admin ', 'admin', 'create', 'scan', 'Started gate scanning session.', '::1', '2026-09-01 15:18:21'),
(133, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 15:26:54'),
(134, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-01 15:27:00'),
(135, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-01 15:27:22'),
(136, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 06:50:50'),
(137, 1, 'Admin ', 'admin', 'create', 'import', 'Imported 50 students + parents from Excel', '::1', '2026-09-12 06:55:12'),
(138, 1, 'Admin ', 'admin', 'update', 'parent', 'Sent passwords to 50 parent(s) who had not received one yet.', '::1', '2026-09-12 06:56:10'),
(139, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 06:57:54'),
(140, 96, 'Paolo Rosario', 'parent', 'login', 'auth', 'Parent logged in | Phone: 09171000044', '::1', '2026-09-12 06:58:05'),
(141, 96, 'Paolo Rosario', 'parent', 'update', 'password', 'Parent changed their password', '::1', '2026-09-12 06:59:10'),
(142, 96, 'Paolo Rosario', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 06:59:16'),
(143, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 06:59:22'),
(144, 1, 'Admin ', 'admin', 'settings', 'settings', 'SMS mode changed to Automatic (scheduled 2026-09-12 15:03:00)', '::1', '2026-09-12 07:02:27'),
(145, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Juan Dela Cruz for student Maria Santos', '::1', '2026-09-12 07:03:02'),
(146, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Elena Ramos for student Ana Garcia', '::1', '2026-09-12 07:03:02'),
(147, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Nico Castillo for student Luz Flores', '::1', '2026-09-12 07:03:02'),
(148, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher SHANA MATILLANO for student Luz Flores', '::1', '2026-09-12 07:03:02'),
(149, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Grace Guzman for student Rosa Villanueva', '::1', '2026-09-12 07:03:02'),
(150, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Rico Rosario for student Elena Castillo', '::1', '2026-09-12 07:03:03'),
(151, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Daisy Velasco for student Sofia Lopez', '::1', '2026-09-12 07:03:03'),
(152, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher Ghean rfd for student Sofia Lopez', '::1', '2026-09-12 07:03:03'),
(153, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Joey Smith for student Andrea Rivera', '::1', '2026-09-12 07:03:03'),
(154, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Maria Saldana for student Bianca Padilla', '::1', '2026-09-12 07:03:03'),
(155, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Carlo Gonzales for student Jasmine Ocampo', '::1', '2026-09-12 07:03:03'),
(156, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Bianca Lim for student Camille Velasco', '::1', '2026-09-12 07:03:03'),
(157, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Dennis Dela Cruz for student Isabel Go', '::1', '2026-09-12 07:03:03'),
(158, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Teresa Ramos for student Grace Duran', '::1', '2026-09-12 07:03:03'),
(159, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Bryan Castillo for student Nina Pineda', '::1', '2026-09-12 07:03:03'),
(160, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Princess Guzman for student Clara Cabrera', '::1', '2026-09-12 07:03:03'),
(161, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Nestor Rosario for student Teresa Gonzales', '::1', '2026-09-12 07:03:03'),
(162, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Rosa Velasco for student Joy Jimenez', '::1', '2026-09-12 07:03:03'),
(163, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Ramon Smith for student Liza Morales', '::1', '2026-09-12 07:03:03'),
(164, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher SHANA MATILLANO for student Liza Morales', '::1', '2026-09-12 07:03:03'),
(165, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Isabel Saldana for student Kath Reyes', '::1', '2026-09-12 07:03:03'),
(166, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Emilio Gonzales for student Daisy Mendoza', '::1', '2026-09-12 07:03:03'),
(167, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Kath Lim for student Mara Ramos', '::1', '2026-09-12 07:03:03'),
(168, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher Ghean rfd for student Mara Ramos', '::1', '2026-09-12 07:03:03'),
(169, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Dan Dela Cruz for student Shiela Aquino', '::1', '2026-09-12 07:03:03'),
(170, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Veronica Ramos for student Princess Domingo', '::1', '2026-09-12 07:03:03'),
(171, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Miguel Castillo for student Angela Marquez', '::1', '2026-09-12 07:03:03'),
(172, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Andrea Guzman for student Melanie Delgado', '::1', '2026-09-12 07:03:03'),
(173, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Adrian Rosario for student Veronica Rosario', '::1', '2026-09-12 07:03:03'),
(174, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Clara Velasco for student Maria Dizon', '::1', '2026-09-12 07:03:03'),
(175, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Renato Smith for student Ana Cruz', '::1', '2026-09-12 07:03:03'),
(176, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Shiela Saldana for student Luz Parker', '::1', '2026-09-12 07:03:03'),
(177, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Romeo Gonzales for student Rosa Lara', '::1', '2026-09-12 07:03:03'),
(178, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Luz Lim for student Elena Saldana', '::1', '2026-09-12 07:03:03'),
(179, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Marco Dela Cruz for student Sofia Espinoza', '::1', '2026-09-12 07:03:03'),
(180, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher SHANA MATILLANO for student Sofia Espinoza', '::1', '2026-09-12 07:03:03'),
(181, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Camille Ramos for student Andrea Hernandez', '::1', '2026-09-12 07:03:03'),
(182, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Victor Castillo for student Bianca King', '::1', '2026-09-12 07:03:03'),
(183, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Liza Guzman for student Jasmine Nuñez', '::1', '2026-09-12 07:03:03'),
(184, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher Ghean rfd for student Jasmine Nuñez', '::1', '2026-09-12 07:03:03'),
(185, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Gilbert Rosario for student Camille Dela Cruz', '::1', '2026-09-12 07:03:03'),
(186, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Melanie Velasco for student Isabel Torres', '::1', '2026-09-12 07:03:03'),
(187, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Pedro Smith for student Grace Bautista', '::1', '2026-09-12 07:03:03'),
(188, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Sofia Saldana for student Nina Navarro', '::1', '2026-09-12 07:03:03'),
(189, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Leo Gonzales for student Clara Salazar', '::1', '2026-09-12 07:03:03'),
(190, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Nina Lim for student Teresa Guzman', '::1', '2026-09-12 07:03:03'),
(191, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Francis Dela Cruz for student Joy Cortez', '::1', '2026-09-12 07:03:03'),
(192, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Mara Ramos for student Liza Santiago', '::1', '2026-09-12 07:03:03'),
(193, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Paul Castillo for student Kath Manalo', '::1', '2026-09-12 07:03:03'),
(194, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Ana Guzman for student Daisy Fernandez', '::1', '2026-09-12 07:03:03'),
(195, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Paolo Rosario for student Mara Smith', '::1', '2026-09-12 07:03:03'),
(196, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher SHANA MATILLANO for student Mara Smith', '::1', '2026-09-12 07:03:03'),
(197, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Jasmine Velasco for student Shiela Mercado', '::1', '2026-09-12 07:03:03'),
(198, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Alvin Smith for student Princess Beltran', '::1', '2026-09-12 07:03:03'),
(199, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Joy Saldana for student Angela Fajardo', '::1', '2026-09-12 07:03:03'),
(200, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to teacher Ghean rfd for student Angela Fajardo', '::1', '2026-09-12 07:03:03'),
(201, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Erwin Gonzales for student Melanie Ibarra', '::1', '2026-09-12 07:03:03'),
(202, 1, 'Admin ', 'admin', 'notify', 'scan', 'SMS notification sent to Angela Lim for student Veronica Lim', '::1', '2026-09-12 07:03:03'),
(203, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:03:25'),
(204, 96, 'Paolo Rosario', 'parent', 'login', 'auth', 'Parent logged in | Phone: 09171000044', '::1', '2026-09-12 07:03:29'),
(205, 96, 'Paolo Rosario', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:03:56'),
(206, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 07:04:01'),
(207, 1, 'Admin ', 'admin', 'update', 'teacher', 'Reset password for teacher: SHANA MATILLANO (ID: 3)', '::1', '2026-09-12 07:04:41'),
(208, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:04:55'),
(209, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 07:05:41'),
(210, 1, 'Admin ', 'admin', 'release', 'scan', 'QR Release | Student: Mara Smith (ID: 96) | Parent: Paolo Rosario | SMS sent', '::1', '2026-09-12 07:07:33'),
(211, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:09:33'),
(212, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 07:09:45'),
(213, 1, 'Admin ', 'admin', 'update', 'teacher', 'Reset password for teacher: SHANA MATILLANO (ID: 3)', '::1', '2026-09-12 07:10:35'),
(214, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:10:52'),
(215, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-09-12 07:10:59'),
(216, 3, 'SHANA MATILLANO', 'teacher', 'delete', 'sms_notification', 'Deleted SMS notification (ID: 233)', '::1', '2026-09-12 07:39:38'),
(217, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:41:08'),
(218, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 07:41:12'),
(219, 1, 'Admin ', 'admin', 'delete', 'sms_log', 'Cleared all SMS logs (229 records removed)', '::1', '2026-09-12 07:52:14'),
(220, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:54:55'),
(221, 3, 'SHANA MATILLANO', 'teacher', 'login', 'auth', 'Teacher logged in | Phone: 09995011147', '::1', '2026-09-12 07:55:03'),
(222, 3, 'SHANA MATILLANO', 'teacher', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 07:55:56'),
(223, 96, 'Paolo Rosario', 'parent', 'login', 'auth', 'Parent logged in | Phone: 09171000044', '::1', '2026-09-12 07:56:20'),
(224, 96, 'Paolo Rosario', 'parent', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 08:07:33'),
(225, 1, 'Admin ', 'admin', 'login', 'auth', 'Admin logged in | Phone: admin', '::1', '2026-09-12 08:07:39'),
(226, 1, 'Admin ', 'admin', 'logout', 'auth', 'User logged out', '::1', '2026-09-12 08:08:07');

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
(1, 'Admin', '', '', '', 'admin', '$2y$10$i9.Cv8kZ2QBwgWcXhCiqxOz9E2c9CQn0fDFOCIWouhhZlPUnFb9rO', '2026-05-28 16:23:06');

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
(7, 96, 96, NULL, 'Paolo', '', 'Rosario', 'Parent', 'QR', NULL, '2026-09-12 07:07:33');

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
(3, 47, 'parent', NULL, '/xHD1+JpEwphLrrpY1aI6w7llwwc+0p1Ny1IuJxIiFEeQMsQjtQ/hQCS8GcOLI2tTK5BFY1BoXnNRM0OOSQQ/ze+sFoUErtOD94AmUnc1tbkpccWFA==', 1, '2026-09-01 00:55:50'),
(4, 46, 'parent', NULL, 'HdW+2suINlYajBo7iJXvyMcDxsjTCoX52CHzuZyc6d9Xo4WqF/tvrpnZzcqvE47Lr/u3bgVCLijdsHGwBSv1PzAnvqxNW7htOS0vP7RpIjdl/c41gTc2MtOEcueDFQI=', 1, '2026-09-01 20:42:23'),
(5, 96, 'parent', NULL, '8qlyN101wnadlleIPx8iBrfjDpjsWqhk3OiB8fWx0HUlMEeBkBchbALCEBVVpVBaBux0zFqum1IJWxPFGT82He4/rbU52XAPBo8JWN+2fFF4eROpUu4=', 1, '2026-09-12 14:58:52');

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
(52, 'Juan', NULL, 'Dela Cruz', '09171000000', '$2y$10$qwySBbPswkYAB4/DLQzfdOJ1vDGVwiEHrVBM/59cX5TUiVx5Tkc4i', 1, 'QR-62GX4', NULL, 1, '2026-09-12 06:55:10'),
(53, 'Elena', NULL, 'Ramos', '09171000001', '$2y$10$3Q5MchPjKp0EFZ3dDpi0TeF.sYuHgoDnm/l.23mEz.PQpropYlmRu', 1, 'QR-7YW4N', NULL, 1, '2026-09-12 06:55:10'),
(54, 'Nico', NULL, 'Castillo', '09171000002', '$2y$10$tRHm2FG/D1eUrqKSNS73BufqypngZeCtFaQ7xkAsYy/Vv.hjat3wS', 1, 'QR-B99NW', NULL, 1, '2026-09-12 06:55:10'),
(55, 'Grace', NULL, 'Guzman', '09171000003', '$2y$10$EDZKSfqOvuHvpio5vax9vOyHqYzIm17bslJpknk98Kwklrsj7RI4O', 1, 'QR-5G3CC', NULL, 1, '2026-09-12 06:55:10'),
(56, 'Rico', NULL, 'Rosario', '09171000004', '$2y$10$kKwftv.hsU31jO1fnU/2zO9V9VOae5WF.YuGe4Gj92Y50eKGDH.xS', 1, 'QR-7M774', NULL, 1, '2026-09-12 06:55:10'),
(57, 'Daisy', NULL, 'Velasco', '09171000005', '$2y$10$uHqV3DLQI21dAmqH9DpaYe8s2sP5TEMX9hBaswt1R9R9ji8lhGygy', 1, 'QR-F9XTM', NULL, 1, '2026-09-12 06:55:11'),
(58, 'Joey', NULL, 'Smith', '09171000006', '$2y$10$tbqH.VbocE3M8mSYAV.gkuXtxJdyc7QFfUeM0GLADJZBXnAWB6Fci', 1, 'QR-TXAC7', NULL, 1, '2026-09-12 06:55:11'),
(59, 'Maria', NULL, 'Saldana', '09171000007', '$2y$10$K9Ja4dPM8CCfBP/6jnQvHO6tbD6ewe7vA/v.XrjXFuR6Na4ezfNKm', 1, 'QR-4SCBN', NULL, 1, '2026-09-12 06:55:11'),
(60, 'Carlo', NULL, 'Gonzales', '09171000008', '$2y$10$8XHGSVvH6jx1UHiKPmD87e2zJmzcO2nyTHUROitNxUonJEZWnlN4O', 1, 'QR-BGXKD', NULL, 1, '2026-09-12 06:55:11'),
(61, 'Bianca', NULL, 'Lim', '09171000009', '$2y$10$zogmfQsbOWmgxevjr0g8Ve55SbrCATWQwfSQohpYGFLVXynDr.gfi', 1, 'QR-5NRYK', NULL, 1, '2026-09-12 06:55:11'),
(62, 'Dennis', NULL, 'Dela Cruz', '09171000010', '$2y$10$RLkLy5riqIg0CpwQOOzWVOIevxZei8I/4Bbfa..zfd.cufY/dOahK', 1, 'QR-CUBYB', NULL, 1, '2026-09-12 06:55:11'),
(63, 'Teresa', NULL, 'Ramos', '09171000011', '$2y$10$2NhI04QJqSPLlNv.4TIWVOxjMd1Jp17jhP6Nsk4kDrlrMIgleyU02', 1, 'QR-U9BQT', NULL, 1, '2026-09-12 06:55:11'),
(64, 'Bryan', NULL, 'Castillo', '09171000012', '$2y$10$ToUao6t0kuuveFju4POB8.q.zx2zJmypQzacfh0f7w4TGVDjkJBvG', 1, 'QR-GSASS', NULL, 1, '2026-09-12 06:55:11'),
(65, 'Princess', NULL, 'Guzman', '09171000013', '$2y$10$Mo6gPExFYd8zNlW27NpTPeHwrA2SAmGiyo9uRWEAswAPfqHBStZWS', 1, 'QR-TDH8C', NULL, 1, '2026-09-12 06:55:11'),
(66, 'Nestor', NULL, 'Rosario', '09171000014', '$2y$10$aPiblsVbBksMP0iFzK/tcOmT18p0GVwwzwb5bZhIRhgHT1iuTFR4e', 1, 'QR-UXVB4', NULL, 1, '2026-09-12 06:55:11'),
(67, 'Rosa', NULL, 'Velasco', '09171000015', '$2y$10$ODpZUmu3paGghc2D4t.wHuNBPsOBrilNWikHM1Swn/Z8jWMa.vj8O', 1, 'QR-YV3YK', NULL, 1, '2026-09-12 06:55:11'),
(68, 'Ramon', NULL, 'Smith', '09171000016', '$2y$10$Fo.j/HY8tyVU9e3J97EbqOEHxLWpWbKNdb6mD8AiYPW.l79xZjPFC', 1, 'QR-G4TV2', NULL, 1, '2026-09-12 06:55:11'),
(69, 'Isabel', NULL, 'Saldana', '09171000017', '$2y$10$HyEjNpMSzYjXCV4qIfJVj.GgkzLAeoFCcSIVYarbNatFODx0pZjj.', 1, 'QR-D6GEF', NULL, 1, '2026-09-12 06:55:11'),
(70, 'Emilio', NULL, 'Gonzales', '09171000018', '$2y$10$ahjzc0Y3xyr7UuR8Pb9IDelKcZUYLGdtYZu4lLixF85kFwNNx1zR.', 1, 'QR-KXK3M', NULL, 1, '2026-09-12 06:55:11'),
(71, 'Kath', NULL, 'Lim', '09171000019', '$2y$10$JsVirKmSHvXSh.IxwTLtM.zFnjLmW0FTH8Kj05qWBHXuf5haoVZCq', 1, 'QR-UDS6A', NULL, 1, '2026-09-12 06:55:11'),
(72, 'Dan', NULL, 'Dela Cruz', '09171000020', '$2y$10$eKrVGcXckErgZyEnWVUAL.Z.tNyjJ3NgzJfkifuAUVpg4oQjABaNa', 1, 'QR-BBH5R', NULL, 1, '2026-09-12 06:55:11'),
(73, 'Veronica', NULL, 'Ramos', '09171000021', '$2y$10$lixZD570u/TYBO2g2a4TwebIdushQ9XKQ4F0Gy0M/jWYnNBZZi.ca', 1, 'QR-UN7WY', NULL, 1, '2026-09-12 06:55:11'),
(74, 'Miguel', NULL, 'Castillo', '09171000022', '$2y$10$qnbyju.OFzSfzL0fHaNPEO/g0xWrCXDFNZGycdz4kVfdgdtWIOSoi', 1, 'QR-VPFG9', NULL, 1, '2026-09-12 06:55:11'),
(75, 'Andrea', NULL, 'Guzman', '09171000023', '$2y$10$o6BN80z16vAxW96ZGrgkoeXL1PWsGpxidp1IIYuK5newoHdjjhxNK', 1, 'QR-UXBH3', NULL, 1, '2026-09-12 06:55:11'),
(76, 'Adrian', NULL, 'Rosario', '09171000024', '$2y$10$Yn2QrKBeEwnv6/CPEF6esuBGMLjS0.4pfLoM7sFP.PVvxnQcsXoW6', 1, 'QR-2W9FQ', NULL, 1, '2026-09-12 06:55:11'),
(77, 'Clara', NULL, 'Velasco', '09171000025', '$2y$10$cDWrlSDiFcHWQuGeefoLm./sayImsTsHe6QzW1L2uCTJPcG2rGoRy', 1, 'QR-S72DJ', NULL, 1, '2026-09-12 06:55:11'),
(78, 'Renato', NULL, 'Smith', '09171000026', '$2y$10$OWtqYyfz2HsgyrE2hRl8NODMRMnaT3fvuByERv0CdQVH3w8wc5daO', 1, 'QR-MBWU7', NULL, 1, '2026-09-12 06:55:11'),
(79, 'Shiela', NULL, 'Saldana', '09171000027', '$2y$10$7gEU76joSvJjjp8WUfLUmuSx9p2VTfqSaTAShSm7PbrOcPylLqiVO', 1, 'QR-R232Q', NULL, 1, '2026-09-12 06:55:11'),
(80, 'Romeo', NULL, 'Gonzales', '09171000028', '$2y$10$6HiYqJIKeFLBZE7Hd7uRTO44jUbfSsPzpSn8elai2VjGr97x.0Uke', 1, 'QR-RF4G3', NULL, 1, '2026-09-12 06:55:11'),
(81, 'Luz', NULL, 'Lim', '09171000029', '$2y$10$0/eUoulzSuIqAypPF3mnxeHkrZqkJKuRvJkrfeygP24h8GUkIW3ue', 1, 'QR-WPCQR', NULL, 1, '2026-09-12 06:55:11'),
(82, 'Marco', NULL, 'Dela Cruz', '09171000030', '$2y$10$gYBqwtyllSrz.34IYvYLVOra2MbGKySzXAmWtXFszNiuNzc5kaIbO', 1, 'QR-U7JVJ', NULL, 1, '2026-09-12 06:55:11'),
(83, 'Camille', NULL, 'Ramos', '09171000031', '$2y$10$j6HKEbmfFMQdwd5u6y2/tu86U3J3KvbwaWeNL2JDvPIGQehxI35e2', 1, 'QR-QTVJ5', NULL, 1, '2026-09-12 06:55:11'),
(84, 'Victor', NULL, 'Castillo', '09171000032', '$2y$10$9czICwihEgJFHo2mL757XeyBjJKIrMAMNedCJWlCCn7iAvlBaOLIm', 1, 'QR-XCVR9', NULL, 1, '2026-09-12 06:55:12'),
(85, 'Liza', NULL, 'Guzman', '09171000033', '$2y$10$vjE7E6CoJpzCBMrx.xinVel4wFqUvJZgdYRpDsqLomU2yJG4hGlt.', 1, 'QR-AKFRF', NULL, 1, '2026-09-12 06:55:12'),
(86, 'Gilbert', NULL, 'Rosario', '09171000034', '$2y$10$2vmfzrlg2aeRC3oRTMf/h.K8vI8b7GwcMUolfqIA8dnytKnDtJNRS', 1, 'QR-T5MMD', NULL, 1, '2026-09-12 06:55:12'),
(87, 'Melanie', NULL, 'Velasco', '09171000035', '$2y$10$iL13IR4q5ysmsgpTRU70GOs.WJWYSKLJQlC8l2rRvvqgTj/HuQwba', 1, 'QR-9WA7W', NULL, 1, '2026-09-12 06:55:12'),
(88, 'Pedro', NULL, 'Smith', '09171000036', '$2y$10$rTBnybu4tELAE2ZjZjtwjeFZVHU.AEq/W74oXo2YtgFRxTELwln9G', 1, 'QR-QHWXP', NULL, 1, '2026-09-12 06:55:12'),
(89, 'Sofia', NULL, 'Saldana', '09171000037', '$2y$10$AP8kch5H2vBkgKzlXxfrde/wS8Pud7e49JrC/QbEfEh2cVQ2VHD5q', 1, 'QR-M58A6', NULL, 1, '2026-09-12 06:55:12'),
(90, 'Leo', NULL, 'Gonzales', '09171000038', '$2y$10$IZOJxh35kzWF8uWLcBfoS.yK7iTeTJOL2kQzV/Ea/GX5evPPhTFUa', 1, 'QR-SEM8A', NULL, 1, '2026-09-12 06:55:12'),
(91, 'Nina', NULL, 'Lim', '09171000039', '$2y$10$dTgBpvNGsEfYeSRgUY2b0uZxBpQX0aU9xdT1y9Dd1nZHaWmBVpwNS', 1, 'QR-B5R2Z', NULL, 1, '2026-09-12 06:55:12'),
(92, 'Francis', NULL, 'Dela Cruz', '09171000040', '$2y$10$1lpTCSh4msDcIX/Z/FMMaO3iBOAzQ5kEfsPv6trrKCN9RhK77nxFW', 1, 'QR-M99K4', NULL, 1, '2026-09-12 06:55:12'),
(93, 'Mara', NULL, 'Ramos', '09171000041', '$2y$10$lp6HLExv6Hfs8fVKnea4iORi7aHlTEWTw46CX92HmXdvVkrueF0oS', 1, 'QR-C9EC4', NULL, 1, '2026-09-12 06:55:12'),
(94, 'Paul', NULL, 'Castillo', '09171000042', '$2y$10$bZEGTvYaPn9fKWERqAcBIOt7O9rEwXVb/s4Y8kV/QChbpEjypUHfm', 1, 'QR-6G5WZ', NULL, 1, '2026-09-12 06:55:12'),
(95, 'Ana', NULL, 'Guzman', '09171000043', '$2y$10$CWnc0l59.n0sW68WUW2d9u0OPQ.Fo6yDP6TXJ0eZMpUg8Mp3IwF5G', 1, 'QR-S6FTD', NULL, 1, '2026-09-12 06:55:12'),
(96, 'Paolo', NULL, 'Rosario', '09171000044', '$2y$10$3cd2iW9HP65Tlx8y7ltQkeu9cPpl9uNpBL3yfXMD8m2qXlRzeybbW', 1, 'QR-MPFKX', NULL, 1, '2026-09-12 06:55:12'),
(97, 'Jasmine', NULL, 'Velasco', '09171000045', '$2y$10$r3Ivs3ju3cDFNRpgb5S2KenWjFbPn8NbAhLZmKSvEsWE5mimBtXNK', 1, 'QR-GYDUR', NULL, 1, '2026-09-12 06:55:12'),
(98, 'Alvin', NULL, 'Smith', '09171000046', '$2y$10$68ofqXnrlF.HyOv/5qaQmuWJWDOzQM19UwZy5gWyAswv9k03Zesfi', 1, 'QR-JVPC9', NULL, 1, '2026-09-12 06:55:12'),
(99, 'Joy', NULL, 'Saldana', '09171000047', '$2y$10$tDhHGsw9gSbWurXukaCn2Oda0h3k1qTZKnrYTgJ27AXwTvECd2V9.', 1, 'QR-TPD2V', NULL, 1, '2026-09-12 06:55:12'),
(100, 'Erwin', NULL, 'Gonzales', '09171000048', '$2y$10$uYBQkXYxra9n/FPN9YZ2fexBjiEYFkByFeOOP1iJjqk6ZRZikdpUK', 1, 'QR-Z59P3', NULL, 1, '2026-09-12 06:55:12'),
(101, 'Angela', NULL, 'Lim', '09171000049', '$2y$10$SqcH2awJyKfVbJo.LAK.FOJcsoEjddeWAWug446TDRGZrWvySGaTa', 1, 'QR-QU63Q', NULL, 1, '2026-09-12 06:55:12');

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
(1, 'sms_mode', 'auto', '2026-09-12 15:02:27'),
(2, 'auto_sms_interval', '60', '2026-08-29 15:04:30'),
(3, 'auto_sms_datetime', '2026-09-12 15:03:00', '2026-09-12 15:02:27'),
(4, 'auto_sms_last_run', '2026-09-12 15:03:00', '2026-09-12 15:03:03'),
(5, 'gate_camera_config', 'default', '2026-09-01 23:09:43'),
(6, 'gate_scan_active', '1', '2026-09-01 23:18:21'),
(7, 'gate_scan_token', '4556d7b9339d4769706eea80175fc6ad1724178e1a68ca31', '2026-09-01 23:18:21'),
(8, 'gate_scan_started_by', '1|Admin ', '2026-09-01 23:18:21');

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
(4, 1, 3, 'Reminder: juan cruz (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-08-31 22:02:03'),
(5, 52, 52, 'Reminder: Your child Maria Santos has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:02'),
(6, 53, 53, 'Reminder: Your child Ana Garcia has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:02'),
(7, 54, 54, 'Reminder: Your child Luz Flores has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:02'),
(8, 54, 3, 'Reminder: Luz Flores (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:02'),
(9, 55, 55, 'Reminder: Your child Rosa Villanueva has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:02'),
(10, 56, 56, 'Reminder: Your child Elena Castillo has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(11, 57, 57, 'Reminder: Your child Sofia Lopez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(12, 57, 4, 'Reminder: Sofia Lopez (Grade 2 - B) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(13, 58, 58, 'Reminder: Your child Andrea Rivera has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(14, 59, 59, 'Reminder: Your child Bianca Padilla has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(15, 60, 60, 'Reminder: Your child Jasmine Ocampo has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(16, 61, 61, 'Reminder: Your child Camille Velasco has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(17, 62, 62, 'Reminder: Your child Isabel Go has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(18, 63, 63, 'Reminder: Your child Grace Duran has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(19, 64, 64, 'Reminder: Your child Nina Pineda has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(20, 65, 65, 'Reminder: Your child Clara Cabrera has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(21, 66, 66, 'Reminder: Your child Teresa Gonzales has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(22, 67, 67, 'Reminder: Your child Joy Jimenez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(23, 68, 68, 'Reminder: Your child Liza Morales has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(24, 68, 3, 'Reminder: Liza Morales (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(25, 69, 69, 'Reminder: Your child Kath Reyes has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(26, 70, 70, 'Reminder: Your child Daisy Mendoza has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(27, 71, 71, 'Reminder: Your child Mara Ramos has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(28, 71, 4, 'Reminder: Mara Ramos (Grade 2 - B) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(29, 72, 72, 'Reminder: Your child Shiela Aquino has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(30, 73, 73, 'Reminder: Your child Princess Domingo has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(31, 74, 74, 'Reminder: Your child Angela Marquez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(32, 75, 75, 'Reminder: Your child Melanie Delgado has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(33, 76, 76, 'Reminder: Your child Veronica Rosario has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(34, 77, 77, 'Reminder: Your child Maria Dizon has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(35, 78, 78, 'Reminder: Your child Ana Cruz has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(36, 79, 79, 'Reminder: Your child Luz Parker has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(37, 80, 80, 'Reminder: Your child Rosa Lara has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(38, 81, 81, 'Reminder: Your child Elena Saldana has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(39, 82, 82, 'Reminder: Your child Sofia Espinoza has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(40, 82, 3, 'Reminder: Sofia Espinoza (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(41, 83, 83, 'Reminder: Your child Andrea Hernandez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(42, 84, 84, 'Reminder: Your child Bianca King has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(43, 85, 85, 'Reminder: Your child Jasmine Nuñez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(44, 85, 4, 'Reminder: Jasmine Nuñez (Grade 2 - B) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(45, 86, 86, 'Reminder: Your child Camille Dela Cruz has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(46, 87, 87, 'Reminder: Your child Isabel Torres has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(47, 88, 88, 'Reminder: Your child Grace Bautista has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(48, 89, 89, 'Reminder: Your child Nina Navarro has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(49, 90, 90, 'Reminder: Your child Clara Salazar has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(50, 91, 91, 'Reminder: Your child Teresa Guzman has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(51, 92, 92, 'Reminder: Your child Joy Cortez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(52, 93, 93, 'Reminder: Your child Liza Santiago has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(53, 94, 94, 'Reminder: Your child Kath Manalo has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(54, 95, 95, 'Reminder: Your child Daisy Fernandez has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(55, 96, 96, 'Reminder: Your child Mara Smith has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(56, 96, 3, 'Reminder: Mara Smith (Grade 1 - A) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(57, 97, 97, 'Reminder: Your child Shiela Mercado has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(58, 98, 98, 'Reminder: Your child Princess Beltran has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(59, 99, 99, 'Reminder: Your child Angela Fajardo has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(60, 99, 4, 'Reminder: Angela Fajardo (Grade 2 - B) has not been picked up yet and is still at school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(61, 100, 100, 'Reminder: Your child Melanie Ibarra has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03'),
(62, 101, 101, 'Reminder: Your child Veronica Lim has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch', 'sent', 1, '2026-09-12 15:03:03');

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
(52, 'Maria', NULL, 'Santos', 'Kindergarten - A', NULL, 1, '2026-09-12 06:55:10', '2026-09-12 15:03:02'),
(53, 'Ana', NULL, 'Garcia', 'Kindergarten - B', NULL, 1, '2026-09-12 06:55:10', '2026-09-12 15:03:02'),
(54, 'Luz', NULL, 'Flores', 'Grade 1 - A', NULL, 1, '2026-09-12 06:55:10', '2026-09-12 15:03:02'),
(55, 'Rosa', NULL, 'Villanueva', 'Grade 1 - B', NULL, 1, '2026-09-12 06:55:10', '2026-09-12 15:03:02'),
(56, 'Elena', NULL, 'Castillo', 'Grade 2 - A', NULL, 1, '2026-09-12 06:55:10', '2026-09-12 15:03:03'),
(57, 'Sofia', NULL, 'Lopez', 'Grade 2 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(58, 'Andrea', NULL, 'Rivera', 'Grade 3 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(59, 'Bianca', NULL, 'Padilla', 'Grade 3 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(60, 'Jasmine', NULL, 'Ocampo', 'Grade 4 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(61, 'Camille', NULL, 'Velasco', 'Grade 4 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(62, 'Isabel', NULL, 'Go', 'Grade 5 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(63, 'Grace', NULL, 'Duran', 'Grade 5 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(64, 'Nina', NULL, 'Pineda', 'Grade 6 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(65, 'Clara', NULL, 'Cabrera', 'Grade 6 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(66, 'Teresa', NULL, 'Gonzales', 'Kindergarten - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(67, 'Joy', NULL, 'Jimenez', 'Kindergarten - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(68, 'Liza', NULL, 'Morales', 'Grade 1 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(69, 'Kath', NULL, 'Reyes', 'Grade 1 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(70, 'Daisy', NULL, 'Mendoza', 'Grade 2 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(71, 'Mara', NULL, 'Ramos', 'Grade 2 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(72, 'Shiela', NULL, 'Aquino', 'Grade 3 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(73, 'Princess', NULL, 'Domingo', 'Grade 3 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(74, 'Angela', NULL, 'Marquez', 'Grade 4 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(75, 'Melanie', NULL, 'Delgado', 'Grade 4 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(76, 'Veronica', NULL, 'Rosario', 'Grade 5 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(77, 'Maria', NULL, 'Dizon', 'Grade 5 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(78, 'Ana', NULL, 'Cruz', 'Grade 6 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(79, 'Luz', NULL, 'Parker', 'Grade 6 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(80, 'Rosa', NULL, 'Lara', 'Kindergarten - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(81, 'Elena', NULL, 'Saldana', 'Kindergarten - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(82, 'Sofia', NULL, 'Espinoza', 'Grade 1 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(83, 'Andrea', NULL, 'Hernandez', 'Grade 1 - B', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(84, 'Bianca', NULL, 'King', 'Grade 2 - A', NULL, 1, '2026-09-12 06:55:11', '2026-09-12 15:03:03'),
(85, 'Jasmine', NULL, 'Nuñez', 'Grade 2 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(86, 'Camille', NULL, 'Dela Cruz', 'Grade 3 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(87, 'Isabel', NULL, 'Torres', 'Grade 3 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(88, 'Grace', NULL, 'Bautista', 'Grade 4 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(89, 'Nina', NULL, 'Navarro', 'Grade 4 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(90, 'Clara', NULL, 'Salazar', 'Grade 5 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(91, 'Teresa', NULL, 'Guzman', 'Grade 5 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(92, 'Joy', NULL, 'Cortez', 'Grade 6 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(93, 'Liza', NULL, 'Santiago', 'Grade 6 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(94, 'Kath', NULL, 'Manalo', 'Kindergarten - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(95, 'Daisy', NULL, 'Fernandez', 'Kindergarten - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(96, 'Mara', NULL, 'Smith', 'Grade 1 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(97, 'Shiela', NULL, 'Mercado', 'Grade 1 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(98, 'Princess', NULL, 'Beltran', 'Grade 2 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(99, 'Angela', NULL, 'Fajardo', 'Grade 2 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(100, 'Melanie', NULL, 'Ibarra', 'Grade 3 - A', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03'),
(101, 'Veronica', NULL, 'Lim', 'Grade 3 - B', NULL, 1, '2026-09-12 06:55:12', '2026-09-12 15:03:03');

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
(52, 52, 52, 'Father', '2026-09-12 06:55:10'),
(53, 53, 53, 'Mother', '2026-09-12 06:55:10'),
(54, 54, 54, 'Guardian', '2026-09-12 06:55:10'),
(55, 55, 55, 'Father', '2026-09-12 06:55:10'),
(56, 56, 56, 'Mother', '2026-09-12 06:55:11'),
(57, 57, 57, 'Guardian', '2026-09-12 06:55:11'),
(58, 58, 58, 'Father', '2026-09-12 06:55:11'),
(59, 59, 59, 'Mother', '2026-09-12 06:55:11'),
(60, 60, 60, 'Guardian', '2026-09-12 06:55:11'),
(61, 61, 61, 'Father', '2026-09-12 06:55:11'),
(62, 62, 62, 'Mother', '2026-09-12 06:55:11'),
(63, 63, 63, 'Guardian', '2026-09-12 06:55:11'),
(64, 64, 64, 'Father', '2026-09-12 06:55:11'),
(65, 65, 65, 'Mother', '2026-09-12 06:55:11'),
(66, 66, 66, 'Guardian', '2026-09-12 06:55:11'),
(67, 67, 67, 'Father', '2026-09-12 06:55:11'),
(68, 68, 68, 'Mother', '2026-09-12 06:55:11'),
(69, 69, 69, 'Guardian', '2026-09-12 06:55:11'),
(70, 70, 70, 'Father', '2026-09-12 06:55:11'),
(71, 71, 71, 'Mother', '2026-09-12 06:55:11'),
(72, 72, 72, 'Guardian', '2026-09-12 06:55:11'),
(73, 73, 73, 'Father', '2026-09-12 06:55:11'),
(74, 74, 74, 'Mother', '2026-09-12 06:55:11'),
(75, 75, 75, 'Guardian', '2026-09-12 06:55:11'),
(76, 76, 76, 'Father', '2026-09-12 06:55:11'),
(77, 77, 77, 'Mother', '2026-09-12 06:55:11'),
(78, 78, 78, 'Guardian', '2026-09-12 06:55:11'),
(79, 79, 79, 'Father', '2026-09-12 06:55:11'),
(80, 80, 80, 'Mother', '2026-09-12 06:55:11'),
(81, 81, 81, 'Guardian', '2026-09-12 06:55:11'),
(82, 82, 82, 'Father', '2026-09-12 06:55:11'),
(83, 83, 83, 'Mother', '2026-09-12 06:55:11'),
(84, 84, 84, 'Guardian', '2026-09-12 06:55:12'),
(85, 85, 85, 'Father', '2026-09-12 06:55:12'),
(86, 86, 86, 'Mother', '2026-09-12 06:55:12'),
(87, 87, 87, 'Guardian', '2026-09-12 06:55:12'),
(88, 88, 88, 'Father', '2026-09-12 06:55:12'),
(89, 89, 89, 'Mother', '2026-09-12 06:55:12'),
(90, 90, 90, 'Guardian', '2026-09-12 06:55:12'),
(91, 91, 91, 'Father', '2026-09-12 06:55:12'),
(92, 92, 92, 'Mother', '2026-09-12 06:55:12'),
(93, 93, 93, 'Guardian', '2026-09-12 06:55:12'),
(94, 94, 94, 'Father', '2026-09-12 06:55:12'),
(95, 95, 95, 'Mother', '2026-09-12 06:55:12'),
(96, 96, 96, 'Guardian', '2026-09-12 06:55:12'),
(97, 97, 97, 'Father', '2026-09-12 06:55:12'),
(98, 98, 98, 'Mother', '2026-09-12 06:55:12'),
(99, 99, 99, 'Guardian', '2026-09-12 06:55:12'),
(100, 100, 100, 'Father', '2026-09-12 06:55:12'),
(101, 101, 101, 'Mother', '2026-09-12 06:55:12');

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
(3, 'SHANA', 'JOY', 'MATILLANO', '1788007862_cec08cf549e13d5b9e37.png', '09995011147', '$2y$10$UFuCAeZCCd/5qC6RmqSnMuYxOovUyg1IupTat2/Qx0DaftPh5IKSW', 1, 'Grade 1 - A', 1, '2026-08-29 12:51:02'),
(4, 'Ghean', 'Dela', 'rfd', '1788190004_0d58fcd03898973d0c74.jpg', '123', '$2y$10$83izkiBe6SXpoVJx7BSM9.lDy84oRQ.hfkhGzZEMw/DH.6qbFUM0O', 1, 'Grade 2 - B', 1, '2026-08-31 15:26:30');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `sms_notification_logs`
--
ALTER TABLE `sms_notification_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
