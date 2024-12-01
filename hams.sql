-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 02:54 PM
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
-- Database: `hams`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `bed_id` int(50) NOT NULL,
  `no` varchar(30) NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `uid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_id`, `no`, `room`, `status`, `uid`) VALUES
(1, '0001', '101', 0, '8286418476101'),
(2, '0002', '101', 0, '8286418476102'),
(3, '0003', NULL, 0, '8286418476103'),
(4, '0004', NULL, 0, '8286418476104'),
(5, '0005', NULL, 0, '8286418476105');

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE `blood` (
  `blood_id` int(50) NOT NULL,
  `type` varchar(11) NOT NULL,
  `rh` char(1) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `uid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`blood_id`, `type`, `rh`, `amount`, `uid`) VALUES
(1, 'O', '+', 120, '8286418476132'),
(2, 'O', '-', 17, '8286418476133'),
(3, 'A', '+', 25, '8286418476134'),
(4, 'A', '-', 45, '8286418476135'),
(5, 'B', '+', 30, '8286418476136'),
(6, 'B', '-', 20, '8286418476137'),
(7, 'AB', '+', 20, '8286418476138'),
(8, 'AB', '-', 20, '8286418476139');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equip_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equip_id`, `name`, `stock`, `uid`) VALUES
(1, 'syringe', 10, '8286418476144 '),
(2, 'scalpel', 10, '8286418476145'),
(3, 'face mask', 100, '8286418476146');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `med_id` int(50) NOT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `type` varchar(300) NOT NULL,
  `expiry` varchar(30) NOT NULL,
  `expired` int(1) NOT NULL DEFAULT 0,
  `stock` varchar(11) NOT NULL,
  `discarded` int(1) NOT NULL DEFAULT 0,
  `addedBy` varchar(30) NOT NULL DEFAULT 'error',
  `date added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`med_id`, `uid`, `name`, `manufacturer`, `type`, `expiry`, `expired`, `stock`, `discarded`, `addedBy`, `date added`) VALUES
(2, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/02/2025', 0, '12', 0, 'root', '2024-11-28 13:58:49'),
(3, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/03/2025', 0, '13', 0, 'root', '2024-11-28 14:03:55'),
(4, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/04/2025', 0, '14', 0, 'root', '2024-11-28 14:04:33'),
(5, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/05/2025', 0, '15', 0, 'root', '2024-11-28 14:05:19'),
(6, NULL, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', '02/09/2025', 0, '20', 0, 'root', '2024-11-28 16:02:02'),
(7, NULL, 'opmadrug', 'opmanufacturer', '', '02/27/2025', 0, '35', 0, 'root', '2024-11-28 16:04:09'),
(8, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/28/2025', 0, '35', 0, 'root', '2024-11-28 16:04:37'),
(9, NULL, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', '11/30/2024', 0, '77', 0, 'root', '2024-11-28 16:06:12'),
(10, NULL, 'opma-medicine', 'opmanufacturer', 'Analgesics / Anticonvulsants / Antidepressants / Antifungals / Antispasticity agents', '04/01/2025', 0, '30', 0, 'root', '2024-11-28 16:39:52'),
(11, NULL, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', '02/26/2025', 0, '15', 0, 'root', '2024-11-28 16:40:22'),
(12, NULL, 'enervon', 'unilab', 'Electrolytes, minerals, metals, vitamins', '03/04/2025', 0, '20', 0, 'root', '2024-11-28 16:43:13'),
(13, NULL, 'bioflu', 'unilab', 'Antifungals', '04/02/2025', 0, '15', 0, 'root', '2024-11-28 16:44:49'),
(14, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/04/2025', 0, '15', 0, 'root', '2024-11-30 00:44:16'),
(15, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '02/04/2025', 0, '15', 0, 'root', '2024-12-01 16:09:45'),
(16, NULL, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', '03/05/2025', 0, '20', 0, 'root', '2024-12-01 16:09:52'),
(17, NULL, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', '02/12/2025', 0, '30', 0, 'root', '2024-12-01 16:18:17'),
(18, NULL, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', '02/11/2025', 0, '32', 0, 'root', '2024-12-01 16:23:47'),
(19, NULL, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', '01/14/2025', 0, '50', 0, 'root', '2024-12-01 16:24:24'),
(20, NULL, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', '02/04/2025', 0, '1', 0, 'root', '2024-12-01 16:24:50'),
(21, NULL, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', '12/18/2024', 0, '50', 0, 'root', '2024-12-01 16:28:12'),
(22, NULL, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', '02/12/2025', 0, '35', 0, 'root', '2024-12-01 16:28:23'),
(23, NULL, 'opma-medicine', 'opmanufacturer', 'Analgesics / Anticonvulsants / Antidepressants / Antifungals / Antispasticity agents', '01/21/2025', 0, '20', 0, 'root', '2024-12-01 16:29:20'),
(24, NULL, 'opmadrug', 'opmanufacturer', '', '12/11/2024', 0, '15', 1, 'root', '2024-12-01 16:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `type` varchar(300) DEFAULT NULL,
  `table_name` varchar(50) NOT NULL,
  `expiry` varchar(30) NOT NULL,
  `operation` varchar(5) NOT NULL DEFAULT '-',
  `approved` int(1) NOT NULL DEFAULT 0,
  `approved_by` varchar(50) DEFAULT NULL,
  `date_approved` datetime NOT NULL DEFAULT current_timestamp(),
  `req_by` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `rmv_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`req_id`, `qty`, `description`, `manufacturer`, `type`, `table_name`, `expiry`, `operation`, `approved`, `approved_by`, `date_approved`, `req_by`, `date_added`, `rmv_id`) VALUES
(1, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 17:34:14', 'root', '2024-10-05 14:28:41', NULL),
(2, 2, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 18:38:00', 'root', '2024-10-05 14:28:41', NULL),
(3, 3, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 15:36:33', 'root', '2024-10-05 14:28:41', NULL),
(4, 4, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 15:36:33', 'root', '2024-10-05 14:28:41', NULL),
(5, 5, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 15:36:33', 'acc1', '2024-10-05 14:28:41', NULL),
(6, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:32', 'root', '2024-10-09 18:44:03', NULL),
(7, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:34', 'root', '2024-10-09 18:44:03', NULL),
(8, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:36', 'root', '2024-10-09 18:44:03', NULL),
(9, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:42', 'root', '2024-10-09 18:44:03', NULL),
(10, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-02 10:24:47', 'root', '2024-11-02 10:24:21', NULL),
(11, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-02 10:24:48', 'root', '2024-11-02 10:24:21', NULL),
(12, 8, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-04 15:34:41', 'root', '2024-11-02 10:34:25', NULL),
(13, 5, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-06 20:50:06', 'acc1', '2024-11-04 16:08:32', NULL),
(14, 5, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-06 20:49:51', 'root', '2024-11-06 18:37:27', NULL),
(15, 5, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-06 20:50:31', 'root', '2024-11-06 20:50:19', NULL),
(16, 5, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-06 20:53:43', 'root', '2024-11-06 20:50:47', NULL),
(17, 1, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 01:58:30', 'root', '2024-11-07 01:58:24', NULL),
(18, 1, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:01:04', 'root', '2024-11-07 02:00:35', NULL),
(19, 2, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:02:22', 'root', '2024-11-07 02:00:43', NULL),
(20, 5, 'gamot ni coarl', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:05:36', 'root', '2024-11-07 02:00:48', NULL),
(21, 5, 'gamot ni opma', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:05:44', 'root', '2024-11-07 02:00:52', NULL),
(22, 65, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:23', 'root', '2024-11-07 13:45:18', NULL),
(23, 60, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:33', 'root', '2024-11-07 13:45:35', NULL),
(24, 60, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:44', 'root', '2024-11-07 13:45:39', NULL),
(25, 65, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:57', 'root', '2024-11-07 13:46:51', NULL),
(26, 60, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:01:14', 'root', '2024-11-07 14:01:07', NULL),
(27, 20, 'A', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:01:44', 'root', '2024-11-07 14:01:33', NULL),
(28, 2, 'A', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:07:26', 'root', '2024-11-07 14:07:15', NULL),
(29, 1, 'B', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:07:39', 'root', '2024-11-07 14:07:31', NULL),
(30, 5, 'A', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:09:26', 'root', '2024-11-07 14:09:23', NULL),
(31, 5, 'A', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:10:02', 'root', '2024-11-07 14:09:55', NULL),
(32, 5, 'B', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:11:37', 'root', '2024-11-07 14:10:09', NULL),
(33, 5, 'B', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:11:34', 'root', '2024-11-07 14:11:28', NULL),
(34, 15, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', 'medicine', '02/04/2025', '+', 1, 'root', '2024-11-29 19:39:43', 'root', '2024-11-29 19:39:43', NULL),
(35, 20, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', 'medicine', '03/05/2025', '+', 1, 'root', '2024-12-01 16:09:35', 'root', '2024-12-01 16:09:35', NULL),
(36, 30, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', 'medicine', '02/12/2025', '+', 1, 'root', '2024-12-01 16:18:17', 'root', '2024-12-01 16:17:34', NULL),
(37, 32, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', 'medicine', '02/11/2025', '+', 1, 'root', '2024-12-01 16:23:47', 'root', '2024-12-01 16:23:36', NULL),
(38, 50, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', 'medicine', '01/14/2025', '+', 1, 'root', '2024-12-01 16:24:24', 'root', '2024-12-01 16:24:16', NULL),
(39, 1, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', 'medicine', '02/04/2025', '+', 1, 'root', '2024-12-01 16:24:50', 'root', '2024-12-01 16:24:44', NULL),
(40, 35, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', 'medicine', '02/12/2025', '+', 1, 'root', '2024-12-01 16:28:23', 'root', '2024-12-01 16:27:08', NULL),
(41, 50, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', 'medicine', '12/18/2024', '+', 1, 'root', '2024-12-01 16:28:12', 'root', '2024-12-01 16:27:37', NULL),
(42, 20, 'opma-medicine', 'opmanufacturer', 'Analgesics / Anticonvulsants / Antidepressants / Antifungals / Antispasticity agents', 'medicine', '01/21/2025', '+', 1, 'root', '2024-12-01 16:29:20', 'root', '2024-12-01 16:28:57', NULL),
(43, 15, 'opmadrug', 'opmanufacturer', '', 'medicine', '12/11/2024', '+', 1, 'root', '2024-12-01 16:29:43', 'root', '2024-12-01 16:29:32', NULL),
(45, 11, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', 'medicine', '02/01/2025', 'rmv', 1, 'root', '2024-12-01 19:47:32', 'root', '2024-12-01 19:44:48', NULL),
(50, 15, 'opmadrug', 'opmanufacturer', '', 'medicine', '12/11/2024', 'rmv', 1, 'root', '2024-12-01 20:21:18', 'root', '2024-12-01 20:20:13', 24);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(50) NOT NULL,
  `room` int(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `beds` int(11) DEFAULT 0,
  `available` int(11) DEFAULT 0,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room`, `type`, `beds`, `available`, `status`) VALUES
(1, 101, 'WARD', 2, 2, 0),
(2, 102, 'STANDARD_PRIVATE', 0, 0, 0),
(3, 103, 'STANDARD_PRIVATE', 0, 0, 0),
(4, 104, 'STANDARD_PRIVATE', 0, 0, 0),
(5, 105, '', 0, 0, 0),
(6, 106, '', 0, 0, 0),
(7, 107, 'STANDARD_PRIVATE', 0, 0, 0),
(8, 108, '', 0, 0, 0),
(9, 109, '', 0, 0, 0),
(10, 110, '', 0, 0, 0),
(11, 111, '', 0, 0, 0),
(12, 112, '', 0, 0, 0),
(13, 113, '', 0, 0, 0),
(14, 114, '', 0, 0, 0),
(15, 115, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(50) NOT NULL,
  `staff_uid` varchar(50) NOT NULL DEFAULT 'unassigned',
  `profile` varchar(100) NOT NULL DEFAULT 'default-avatar.jpg',
  `acc_name` varchar(30) NOT NULL,
  `acc_pwd` varchar(100) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `m_i` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `occupation` varchar(30) NOT NULL DEFAULT 'error',
  `status` int(11) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `addedBy` varchar(30) NOT NULL DEFAULT '''Database''',
  `level` int(11) NOT NULL DEFAULT 1,
  `stf` tinyint(1) NOT NULL DEFAULT 0,
  `bb` tinyint(1) NOT NULL DEFAULT 0,
  `med` tinyint(1) NOT NULL DEFAULT 0,
  `equip` tinyint(1) NOT NULL DEFAULT 0,
  `rm` tinyint(1) NOT NULL DEFAULT 0,
  `bd` tinyint(1) NOT NULL DEFAULT 0,
  `acc` tinyint(1) NOT NULL DEFAULT 0,
  `ui` tinyint(1) NOT NULL DEFAULT 0,
  `aprvl` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_uid`, `profile`, `acc_name`, `acc_pwd`, `surname`, `first_name`, `m_i`, `suffix`, `occupation`, `status`, `date_added`, `addedBy`, `level`, `stf`, `bb`, `med`, `equip`, `rm`, `bd`, `acc`, `ui`, `aprvl`) VALUES
(1, '', 'default-avatar.jpg', 'root', '$2y$10$GNM3qcX3C1dBMbXSMbcGNeXsJaoPnu8RM1kzJ5SQ.Hv3JQq4byFry', 'Diocampo', 'Ivan Winzle', 'S.', '', 'root', 0, '2024-09-07 15:41:55', 'Database', 4, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '', 'default-avatar.jpg', 'acc1', '$2y$10$S5bTvjd/sI2isOSKqwBcKudSdZ5S5AztYeaDgYi46qYD7O89c6hLm', 'Bunyi', 'Carl Andrei', 'L.', '', 'superuser', 0, '2024-09-07 17:36:26', 'Database', 3, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, '', 'default-avatar.jpg', 'acc2', '$2y$10$zLB.28baUdIKx8yt04qZ9ev.3GBCvSLxRzODrQ4Azd9HcjjgDAe5.', 'Mirasol', 'Adrian', '', '', 'normal', 0, '2024-09-07 17:42:26', 'Database', 1, 0, 1, 0, 1, 0, 0, 0, 0, 0),
(4, '', 'default-avatar.jpg', 'acc4', '$2y$10$qorsU4oORDRBE4rzkLqFXOpjOw4VEeG/z1mhseAHTbkIDKKx5HfAy', 'Opmacoid', 'Navi', '', '', 'test', 0, '2024-11-21 12:43:00', 'root', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '', 'default-avatar.jpg', 'acc5', '$2y$10$IjCw3LBSb9xNSUce.g30f.F.nCoIqQ0cno4ddYdCjgf3fXMpe1Sx6', 'Opma', 'Nav Elznie', 'S.', 'Jr', 'test', 0, '2024-11-21 13:35:30', 'root', 2, 1, 1, 1, 1, 1, 1, 0, 1, 1),
(6, '', 'default-avatar.jpg', 'acc3', '$2y$10$/VFnVaPhYq2YEkVvSChsFukAg5SRlC3H8mspy/Q9thretur588qSG', 'Bungi', 'Coarl', 'L.', '', 'test', 0, '2024-11-21 19:04:24', 'root', 1, 1, 1, 1, 1, 1, 1, 0, 1, 1),
(7, '', 'default-avatar.jpg', 'acc6', '$2y$10$a3pYl3dPWy16U0NDuRfSo.dU/ipIIvM4TQSxopFAnOdwTYTJBrJDS', 'Miraculo', 'Yan Yan', 'Z.', '', 'test', 0, '2024-11-21 19:43:53', 'root', 2, 1, 0, 1, 0, 1, 0, 0, 0, 1),
(8, '', 'default-avatar.jpg', 'acc7', '$2y$10$fJscSXq3U8icqSPhN1YQKuAMzCXKt.IPjH7jSuomg8FtcPBR8O2lW', 'Muyco', 'Jan Pauline', 'M.', '', 'test', 0, '2024-11-22 19:37:00', 'root', 2, 1, 0, 1, 1, 0, 1, 0, 0, 1),
(9, '', 'default-avatar.jpg', 'acc8', '$2y$10$CxFfKSIVwsH5cDi1rFc2ZODI9pp9UKiEBwQcO2VrEcFGbdHpfHZmW', 'Muyco', 'Fatima', '', '', 'test', 0, '2024-11-23 00:13:44', 'root', 2, 0, 1, 0, 0, 1, 0, 0, 1, 0),
(10, '', 'default-avatar.jpg', 'acc9', '$2y$10$Zs12eX9T86dIBBHQFPIOXezat9hNsIYq9YD8WcOhq9kjFwwdgT9uq', 'Tabancura', 'Jian', '', '', 'test', 0, '2024-11-23 02:59:56', 'root', 1, 1, 1, 1, 0, 0, 0, 0, 1, 1),
(11, '', 'default-avatar.jpg', 'acc10', '$2y$10$inKHfHPdmYtZxRtmJ3pB..gISHhqZR9K5BllznAf1V99KxPJZnvYG', 'Tabancura', 'Jericha', NULL, '', 'test', 0, '2024-11-23 03:00:40', 'root', 2, 0, 0, 0, 1, 1, 1, 0, 0, 0),
(13, '8286418476107', 'default-avatar.jpg', 'acc11', '$2y$10$1H57uRwEGkM6qznZOLSi1.4FFgcHEznAYH3t10k1aeqx9524dfvbC', 'Winchester', 'Dean', '', '', 'hunter', 0, '2024-11-23 03:14:59', 'root', 2, 0, 1, 0, 1, 1, 1, 0, 1, 0),
(20, '8286418476110', 'default-avatar.jpg', 'acc12', '$2y$10$IC1MIz720rIQYU5acImPNu/dOV4ErWpmYesMfpF9lDIkYAPPcRlxK', 'Winchester', 'Sam', '', '', 'hunter', 0, '2024-11-23 03:41:51', 'root', 1, 1, 1, 1, 1, 1, 1, 0, 1, 1),
(21, '8286418476108', 'default-avatar.jpg', 'acc13', '$2y$10$199Fgr2pQc54uHDghCmVSOBo05W9lYP8arStSZbr8QEHONhyJ4yjW', 'Crownguard', 'Luxanna', '', '', 'mage', 0, '2024-11-23 03:47:44', 'root', 0, 1, 1, 1, 1, 1, 1, 0, 1, 1),
(22, '8286418476109', 'default-avatar.jpg', 'acc14', '$2y$10$fZvxqUWOpegVTOIJiPcZyOxeuEf1RiauYBEsKcvBaD6GwzzI0XLli', 'Crownguard', 'Garren', '', '', 'tank', 0, '2024-11-23 14:42:59', 'root', 2, 1, 1, 1, 1, 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `uid`
--

CREATE TABLE `uid` (
  `Q_id` int(50) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `assigned` varchar(50) DEFAULT NULL,
  `table_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uid`
--

INSERT INTO `uid` (`Q_id`, `uid`, `assigned`, `table_name`) VALUES
(1, '8286418476100', 'Enervon', 'medicine'),
(2, '8286418476101', '0001', 'bed'),
(3, '8286418476102', '0002', 'bed'),
(4, '8286418476103', '0003', 'bed'),
(5, '8286418476104', '0004', 'bed'),
(6, '8286418476105', '0005', NULL),
(7, '8286418476106', 'gamot ni coarl', 'medicine'),
(8, '8286418476107', 'Winchester, Dean ', 'staff'),
(9, '8286418476108', 'Crownguard, Luxanna ', 'staff'),
(10, '8286418476109', 'Crownguard, Garren ', 'staff'),
(11, '8286418476110', 'Winchester, Sam ', 'staff'),
(12, '8286418476111', NULL, NULL),
(13, '8286418476112', NULL, NULL),
(14, '8286418476113', NULL, NULL),
(15, '8286418476114', NULL, NULL),
(16, '8286418476115', NULL, NULL),
(17, '8286418476116', NULL, NULL),
(18, '8286418476117', NULL, NULL),
(19, '8286418476118', NULL, NULL),
(20, '8286418476119', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`bed_id`);

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
  ADD PRIMARY KEY (`blood_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equip_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `uid`
--
ALTER TABLE `uid`
  ADD PRIMARY KEY (`Q_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `bed_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blood`
--
ALTER TABLE `blood`
  MODIFY `blood_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equip_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `med_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `uid`
--
ALTER TABLE `uid`
  MODIFY `Q_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
