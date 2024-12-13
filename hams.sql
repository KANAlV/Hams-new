-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 08:52 PM
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
  `uid` varchar(50) DEFAULT NULL,
  `addedBy` varchar(30) NOT NULL,
  `discarded` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`bed_id`, `no`, `room`, `status`, `uid`, `addedBy`, `discarded`) VALUES
(1, '0001', '101', 1, '8286418476103', 'root', 0),
(2, '0002', '101', 0, '8286418476100', 'root', 0),
(3, '0003', NULL, 0, NULL, 'root', 0),
(4, '0004', NULL, 0, NULL, 'root', 0),
(5, '0005', NULL, 0, NULL, 'root', 0),
(12, '0006', NULL, 0, '8286418476100', 'root', 1),
(13, '0007', NULL, 0, '8286418476107', 'root', 0);

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
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `equip_id` int(50) NOT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `type` varchar(300) NOT NULL,
  `expiry` date DEFAULT NULL,
  `expired` int(1) NOT NULL DEFAULT 0,
  `stock` varchar(11) NOT NULL,
  `discarded` int(1) NOT NULL DEFAULT 0,
  `addedBy` varchar(30) NOT NULL DEFAULT 'error',
  `date added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`equip_id`, `uid`, `name`, `manufacturer`, `type`, `expiry`, `expired`, `stock`, `discarded`, `addedBy`, `date added`) VALUES
(1, NULL, 'opmaTool', 'opmanufacture', 'ToolExample', '2025-01-25', 0, '12', 1, 'root', '2024-12-11 02:46:35'),
(2, '8286418476101', 'opmatest', 'opmatest', '', '2025-01-20', 0, '20', 1, 'root', '2024-12-12 22:32:32'),
(3, '8286418476101', 'opmatest', 'opmatest', '', '2024-12-15', 0, '20', 1, 'root', '2024-12-12 22:36:03'),
(4, '8286418476102', 'opmaGamit', 'opmaGamit', 'ToolExample', '2024-12-15', 0, '29', 0, 'root', '2024-12-13 05:38:17');

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
  `expiry` date NOT NULL,
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
(1, '', 'bioflu', 'unilab', 'Antifungals', '2025-01-25', 0, '20', 0, 'root', '2024-12-13 08:56:16'),
(2, '', 'bioflu', 'unilab', 'Antifungals', '2025-01-15', 0, '15', 0, 'root', '2024-12-13 08:57:26'),
(3, '', 'bioflu', 'unilab', 'Antifungals', '2025-01-20', 0, '20', 0, 'root', '2024-12-13 08:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `req_id` int(11) NOT NULL,
  `note` varchar(50) DEFAULT NULL,
  `uid` varchar(50) DEFAULT NULL,
  `qty` int(10) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `type` varchar(300) DEFAULT NULL,
  `table_name` varchar(50) NOT NULL,
  `expiry` varchar(30) DEFAULT NULL,
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

INSERT INTO `requests` (`req_id`, `note`, `uid`, `qty`, `description`, `manufacturer`, `type`, `table_name`, `expiry`, `operation`, `approved`, `approved_by`, `date_approved`, `req_by`, `date_added`, `rmv_id`) VALUES
(1, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 17:34:14', 'root', '2024-10-05 14:28:41', NULL),
(2, NULL, NULL, 2, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 18:38:00', 'root', '2024-10-05 14:28:41', NULL),
(3, NULL, NULL, 3, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 15:36:33', 'root', '2024-10-05 14:28:41', NULL),
(4, NULL, NULL, 4, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 15:36:33', 'root', '2024-10-05 14:28:41', NULL),
(5, NULL, NULL, 5, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-10-08 15:36:33', 'acc1', '2024-10-05 14:28:41', NULL),
(6, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:32', 'root', '2024-10-09 18:44:03', NULL),
(7, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:34', 'root', '2024-10-09 18:44:03', NULL),
(8, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:36', 'root', '2024-10-09 18:44:03', NULL),
(9, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-01 17:57:42', 'root', '2024-10-09 18:44:03', NULL),
(10, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-02 10:24:47', 'root', '2024-11-02 10:24:21', NULL),
(11, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-02 10:24:48', 'root', '2024-11-02 10:24:21', NULL),
(12, NULL, NULL, 8, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-04 15:34:41', 'root', '2024-11-02 10:34:25', NULL),
(13, NULL, NULL, 5, 'Enervon', NULL, NULL, 'medicine', '', '-', 1, 'root', '2024-11-06 20:50:06', 'acc1', '2024-11-04 16:08:32', NULL),
(14, NULL, NULL, 5, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-06 20:49:51', 'root', '2024-11-06 18:37:27', NULL),
(15, NULL, NULL, 5, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-06 20:50:31', 'root', '2024-11-06 20:50:19', NULL),
(16, NULL, NULL, 5, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-06 20:53:43', 'root', '2024-11-06 20:50:47', NULL),
(17, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 01:58:30', 'root', '2024-11-07 01:58:24', NULL),
(18, NULL, NULL, 1, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:01:04', 'root', '2024-11-07 02:00:35', NULL),
(19, NULL, NULL, 2, 'Enervon', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:02:22', 'root', '2024-11-07 02:00:43', NULL),
(20, NULL, NULL, 5, 'gamot ni coarl', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:05:36', 'root', '2024-11-07 02:00:48', NULL),
(21, NULL, NULL, 5, 'gamot ni opma', NULL, NULL, 'medicine', '', '+', 1, 'root', '2024-11-07 02:05:44', 'root', '2024-11-07 02:00:52', NULL),
(22, NULL, NULL, 65, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:23', 'root', '2024-11-07 13:45:18', NULL),
(23, NULL, NULL, 60, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:33', 'root', '2024-11-07 13:45:35', NULL),
(24, NULL, NULL, 60, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:44', 'root', '2024-11-07 13:45:39', NULL),
(25, NULL, NULL, 65, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 13:46:57', 'root', '2024-11-07 13:46:51', NULL),
(26, NULL, NULL, 60, 'O', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:01:14', 'root', '2024-11-07 14:01:07', NULL),
(27, NULL, NULL, 20, 'A', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:01:44', 'root', '2024-11-07 14:01:33', NULL),
(28, NULL, NULL, 2, 'A', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:07:26', 'root', '2024-11-07 14:07:15', NULL),
(29, NULL, NULL, 1, 'B', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:07:39', 'root', '2024-11-07 14:07:31', NULL),
(30, NULL, NULL, 5, 'A', NULL, NULL, 'blood_UID', '', '-', 1, 'root', '2024-11-07 14:09:26', 'root', '2024-11-07 14:09:23', NULL),
(31, NULL, NULL, 5, 'A', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:10:02', 'root', '2024-11-07 14:09:55', NULL),
(32, NULL, NULL, 5, 'B', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:11:37', 'root', '2024-11-07 14:10:09', NULL),
(33, NULL, NULL, 5, 'B', NULL, NULL, 'blood_UID', '', '+', 1, 'root', '2024-11-07 14:11:34', 'root', '2024-11-07 14:11:28', NULL),
(34, NULL, NULL, 15, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', 'medicine', '02/04/2025', '+', 1, 'root', '2024-11-29 19:39:43', 'root', '2024-11-29 19:39:43', NULL),
(35, NULL, NULL, 20, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', 'medicine', '03/05/2025', '+', 1, 'root', '2024-12-01 16:09:35', 'root', '2024-12-01 16:09:35', NULL),
(36, NULL, NULL, 30, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', 'medicine', '02/12/2025', '+', 1, 'root', '2024-12-01 16:18:17', 'root', '2024-12-01 16:17:34', NULL),
(37, NULL, NULL, 32, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', 'medicine', '02/11/2025', '+', 1, 'root', '2024-12-01 16:23:47', 'root', '2024-12-01 16:23:36', NULL),
(38, NULL, NULL, 50, 'gamot ni coarl', 'carlmano', 'Dental and oral agents', 'medicine', '01/14/2025', '+', 1, 'root', '2024-12-01 16:24:24', 'root', '2024-12-01 16:24:16', NULL),
(39, NULL, NULL, 1, 'gamot ni opma', 'opmanufacture', 'Central nervous system agents / Dental and oral agents', 'medicine', '02/04/2025', '+', 1, 'root', '2024-12-01 16:24:50', 'root', '2024-12-01 16:24:44', NULL),
(40, NULL, NULL, 35, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', 'medicine', '02/12/2025', '+', 1, 'root', '2024-12-01 16:28:23', 'root', '2024-12-01 16:27:08', NULL),
(41, NULL, NULL, 50, 'opma-medicine', 'manuf', 'Analgesics / Anesthetics', 'medicine', '12/18/2024', '+', 1, 'root', '2024-12-01 16:28:12', 'root', '2024-12-01 16:27:37', NULL),
(42, NULL, NULL, 20, 'opma-medicine', 'opmanufacturer', 'Analgesics / Anticonvulsants / Antidepressants / Antifungals / Antispasticity agents', 'medicine', '01/21/2025', '+', 1, 'root', '2024-12-01 16:29:20', 'root', '2024-12-01 16:28:57', NULL),
(43, NULL, NULL, 15, 'opmadrug', 'opmanufacturer', '', 'medicine', '12/11/2024', '+', 1, 'root', '2024-12-01 16:29:43', 'root', '2024-12-01 16:29:32', NULL),
(45, NULL, NULL, 11, 'opmadrug', 'opmanufacture', 'Analgesics / Anesthetics / Anti-addiction agents', 'medicine', '02/01/2025', 'rmv', 1, 'root', '2024-12-01 19:47:32', 'root', '2024-12-01 19:44:48', NULL),
(50, NULL, NULL, 15, 'opmadrug', 'opmanufacturer', '', 'medicine', '12/11/2024', 'rmv', 1, 'root', '2024-12-01 20:21:18', 'root', '2024-12-01 20:20:13', 24),
(51, NULL, NULL, 12, 'opmaTool', 'opmanufacture', 'ToolExample', 'equipments', '12/10/2024', '+', 1, 'root', '2024-12-11 02:46:35', 'root', '2024-12-11 02:42:07', NULL),
(52, NULL, NULL, 25, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '03/18/2025', '+', 1, 'root', '2024-12-12 00:54:24', 'root', '2024-12-12 00:53:29', NULL),
(53, NULL, NULL, 25, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '03/18/2025', 'rmv', 1, 'root', '2024-12-12 01:03:46', 'root', '2024-12-12 01:03:37', 25),
(54, NULL, '8286418476100', 32, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/05/2025', '+', 1, 'root', '2024-12-12 01:16:10', 'root', '2024-12-12 01:12:50', NULL),
(55, NULL, '8286418476100', 20, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '12/24/2024', '+', 1, 'root', '2024-12-12 01:52:43', 'root', '2024-12-12 01:52:35', NULL),
(56, NULL, '8286418476100', 20, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '12/24/2024', 'rmv', 1, 'root', '2024-12-12 02:09:29', 'root', '2024-12-12 02:04:29', 27),
(57, NULL, '8286418476100', 32, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/05/2025', 'rmv', 1, 'root', '2024-12-12 02:10:38', 'root', '2024-12-12 02:10:30', 26),
(58, NULL, '8286418476100', 12, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/19/2025', '+', 1, 'root', '2024-12-12 02:12:15', 'root', '2024-12-12 02:11:57', NULL),
(59, NULL, '8286418476100', 12, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/19/2025', 'rmv', 1, 'root', '2024-12-12 02:19:21', 'root', '2024-12-12 02:12:37', 28),
(60, NULL, '8286418476100', 12, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/19/2025', 'rmv', 1, 'root', '2024-12-12 02:19:11', 'root', '2024-12-12 02:13:30', 28),
(61, NULL, '8286418476100', 32, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/05/2025', 'rmv', 1, 'root', '2024-12-12 02:19:49', 'root', '2024-12-12 02:19:32', 26),
(62, NULL, '8286418476100', 20, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '12/24/2024', 'rmv', 1, 'root', '2024-12-12 02:19:40', 'root', '2024-12-12 02:19:35', 27),
(63, NULL, '8286418476100', 20, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '12/24/2024', 'rmv', 1, 'root', '2024-12-12 02:22:28', 'root', '2024-12-12 02:22:22', 27),
(64, NULL, '8286418476100', 12, 'opmatest', 'opmatest', 'Antifungals', 'medicine', '02/19/2025', 'rmv', 1, 'root', '2024-12-12 02:22:48', 'root', '2024-12-12 02:22:43', 28),
(65, NULL, NULL, 12, 'opmaTool', 'opmanufacture', 'ToolExample', 'equipments', '12/10/2024', 'rmv', 1, 'root', '2024-12-12 22:26:58', 'root', '2024-12-12 22:26:50', 1),
(66, NULL, '8286418476101', 20, 'opmatest', 'opmatest', '', 'equipments', '04/08/2025', '+', 1, 'root', '2024-12-12 22:32:32', 'root', '2024-12-12 22:28:33', NULL),
(67, NULL, '8286418476101', 20, 'opmatest', 'opmatest', '', 'equipments', '04/08/2025', 'rmv', 1, 'root', '2024-12-12 22:33:33', 'root', '2024-12-12 22:33:27', 2),
(68, NULL, '8286418476101', 20, 'opmatest', 'opmatest', '', 'equipments', '02/18/2025', '+', 1, 'root', '2024-12-12 22:36:03', 'root', '2024-12-12 22:35:46', NULL),
(69, NULL, '8286418476101', 20, 'opmatest', 'opmatest', '', 'equipments', '02/18/2025', 'rmv', 1, 'root', '2024-12-12 22:37:21', 'root', '2024-12-12 22:37:13', 3),
(86, NULL, '8286418476100', NULL, '0006', NULL, NULL, 'beds', NULL, '+', 1, 'root', '2024-12-13 01:33:30', 'root', '2024-12-13 01:30:03', NULL),
(88, NULL, '8286418476100', NULL, '0006', NULL, NULL, 'beds', NULL, 'rmv', 1, 'root', '2024-12-13 02:38:05', 'root', '2024-12-13 02:33:22', 12),
(91, NULL, '8286418476102', NULL, '0001', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 03:19:37', 'root', '2024-12-13 03:07:11', NULL),
(92, NULL, '8286418476103', NULL, '0001', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 03:14:29', 'root', '2024-12-13 03:13:37', NULL),
(94, NULL, '8286418476102', NULL, '0001', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 03:21:44', 'root', '2024-12-13 03:21:37', 1),
(95, NULL, '8286418476103', NULL, '0001', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 03:22:20', 'root', '2024-12-13 03:22:03', 1),
(96, NULL, '8286418476102', NULL, '0001', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 03:25:28', 'root', '2024-12-13 03:25:20', 1),
(97, NULL, '8286418476103', NULL, '0001', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 03:25:45', 'root', '2024-12-13 03:25:39', 1),
(98, NULL, '8286418476100', NULL, '0002', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-13 05:09:44', 'root', '2024-12-13 05:09:37', 2),
(99, NULL, '8286418476102', 30, 'opmaGamit', 'opmaGamit', 'ToolExample', 'equipments', '03/17/2025', '+', 1, 'root', '2024-12-13 05:38:17', 'root', '2024-12-13 05:38:01', NULL),
(100, NULL, NULL, 1, 'opmaGamit', NULL, NULL, 'equipments', NULL, '-', 1, 'root', '2024-12-13 05:39:04', 'acc3', '2024-12-13 05:38:42', NULL),
(101, NULL, '8286418476104', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '02/12/2025', '+', 1, 'root', '2024-12-13 05:41:05', 'root', '2024-12-13 05:40:53', NULL),
(102, NULL, NULL, 5, 'bioflu', NULL, NULL, 'medicine', NULL, '-', 1, 'root', '2024-12-13 05:41:40', 'acc3', '2024-12-13 05:41:31', NULL),
(103, NULL, '8286418476104', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '02/18/2025', '+', 1, 'root', '2024-12-13 08:37:33', 'root', '2024-12-13 08:37:20', NULL),
(104, NULL, NULL, 5, 'bioflu', NULL, NULL, 'medicine', NULL, '-', 1, 'root', '2024-12-13 08:38:11', 'acc3', '2024-12-13 08:38:04', NULL),
(105, NULL, NULL, 5, 'bioflu', NULL, NULL, 'medicine', NULL, '-', 1, 'root', '2024-12-13 08:39:15', 'acc3', '2024-12-13 08:39:08', NULL),
(106, NULL, '8286418476104', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '12/14/2024', '+', 1, 'root', '2024-12-13 08:42:43', 'root', '2024-12-13 08:42:37', NULL),
(107, NULL, NULL, 5, 'bioflu', NULL, NULL, 'medicine', NULL, '-', 1, 'root', '2024-12-13 08:44:18', 'acc3', '2024-12-13 08:44:01', NULL),
(108, NULL, '8286418476106', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '01/25/2025', '+', 1, 'root', '2024-12-13 08:51:58', 'root', '2024-12-13 08:51:50', NULL),
(109, NULL, '', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '01/25/2025', '+', 1, 'root', '2024-12-13 08:56:16', 'root', '2024-12-13 08:56:10', NULL),
(110, NULL, '', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '01/15/2025', '+', 1, 'root', '2024-12-13 08:57:26', 'root', '2024-12-13 08:56:54', NULL),
(111, NULL, '', 20, 'bioflu', 'unilab', 'Antifungals', 'medicine', '01/20/2025', '+', 1, 'root', '2024-12-13 08:57:34', 'root', '2024-12-13 08:57:17', NULL),
(112, NULL, NULL, 5, 'bioflu', NULL, NULL, 'medicine', NULL, '-', 1, 'root', '2024-12-13 08:59:12', 'acc3', '2024-12-13 08:59:06', NULL),
(113, NULL, '8286418476100', NULL, '0002', NULL, NULL, 'beds', NULL, 'edit', 1, 'root', '2024-12-14 03:12:30', 'root', '2024-12-13 10:40:31', 2),
(114, NULL, '8286418476107', NULL, '0007', NULL, NULL, 'beds', NULL, '+', 1, 'root', '2024-12-14 03:14:51', 'root', '2024-12-14 03:14:44', NULL),
(115, NULL, NULL, NULL, '116', NULL, NULL, 'room', NULL, '+', 1, 'root', '2024-12-14 03:37:55', 'root', '2024-12-14 03:37:00', NULL),
(116, NULL, NULL, NULL, '117', NULL, NULL, 'room', NULL, '+', 1, 'root', '2024-12-14 03:51:45', 'root', '2024-12-14 03:51:38', NULL);

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
(1, 101, 'WARD', 2, 1, 0),
(2, 102, 'STANDARD_PRIVATE', 0, 0, 0),
(3, 103, 'STANDARD_PRIVATE', 0, 0, 0),
(4, 104, 'STANDARD_PRIVATE', 1, 1, 0),
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
(15, 115, '', 0, 0, 0),
(24, 116, '', 0, 0, NULL),
(25, 117, '', 0, 0, NULL);

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
  `aprvl` tinyint(1) NOT NULL DEFAULT 0,
  `typ` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_uid`, `profile`, `acc_name`, `acc_pwd`, `surname`, `first_name`, `m_i`, `suffix`, `occupation`, `status`, `date_added`, `addedBy`, `level`, `stf`, `bb`, `med`, `equip`, `rm`, `bd`, `acc`, `ui`, `aprvl`, `typ`) VALUES
(1, '', 'default-avatar.jpg', 'root', '$2y$10$GNM3qcX3C1dBMbXSMbcGNeXsJaoPnu8RM1kzJ5SQ.Hv3JQq4byFry', 'Diocampo', 'Ivan Winzle', 'S.', '', 'root', 0, '2024-09-07 15:41:55', 'Database', 4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '', 'default-avatar.jpg', 'acc1', '$2y$10$S5bTvjd/sI2isOSKqwBcKudSdZ5S5AztYeaDgYi46qYD7O89c6hLm', 'Bunyi', 'Carl Andrei', 'L.', '', 'superuser', 0, '2024-09-07 17:36:26', 'Database', 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(3, '', 'default-avatar.jpg', 'acc2', '$2y$10$zLB.28baUdIKx8yt04qZ9ev.3GBCvSLxRzODrQ4Azd9HcjjgDAe5.', 'Mirasol', 'Adrian', '', '', 'normal', 0, '2024-09-07 17:42:26', 'Database', 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0),
(4, '', 'default-avatar.jpg', 'acc4', '$2y$10$qorsU4oORDRBE4rzkLqFXOpjOw4VEeG/z1mhseAHTbkIDKKx5HfAy', 'Opmacoid', 'Navi', '', '', 'test', 0, '2024-11-21 12:43:00', 'root', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '', 'default-avatar.jpg', 'acc5', '$2y$10$IjCw3LBSb9xNSUce.g30f.F.nCoIqQ0cno4ddYdCjgf3fXMpe1Sx6', 'Opma', 'Nav Elznie', 'S.', 'Jr', 'test', 0, '2024-11-21 13:35:30', 'root', 2, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0),
(6, '8286418476105', 'default-avatar.jpg', 'acc3', '$2y$10$B4sjESwkHnJ1ogOcZYQWqeAqQJ7S10B6xTZaRfU8zPg2Zx0IakYM6', 'Bungi', 'Coarl', '', '', 'test', 0, '2024-11-21 19:04:24', 'root', 1, 1, 1, 0, 1, 1, 0, 0, 1, 0, 0),
(7, '', 'default-avatar.jpg', 'acc6', '$2y$10$a3pYl3dPWy16U0NDuRfSo.dU/ipIIvM4TQSxopFAnOdwTYTJBrJDS', 'Miraculo', 'Yan Yan', 'Z.', '', 'test', 0, '2024-11-21 19:43:53', 'root', 2, 1, 0, 1, 0, 1, 0, 0, 0, 1, 0),
(8, '', 'default-avatar.jpg', 'acc7', '$2y$10$fJscSXq3U8icqSPhN1YQKuAMzCXKt.IPjH7jSuomg8FtcPBR8O2lW', 'Muyco', 'Jan Pauline', 'M.', '', 'test', 0, '2024-11-22 19:37:00', 'root', 2, 1, 0, 1, 1, 0, 1, 0, 0, 1, 0),
(9, '', 'default-avatar.jpg', 'acc8', '$2y$10$CxFfKSIVwsH5cDi1rFc2ZODI9pp9UKiEBwQcO2VrEcFGbdHpfHZmW', 'Muyco', 'Fatima', '', '', 'test', 0, '2024-11-23 00:13:44', 'root', 2, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0),
(10, '', 'default-avatar.jpg', 'acc9', '$2y$10$Zs12eX9T86dIBBHQFPIOXezat9hNsIYq9YD8WcOhq9kjFwwdgT9uq', 'Tabancura', 'Jian', '', '', 'test', 0, '2024-11-23 02:59:56', 'root', 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0),
(11, '', 'default-avatar.jpg', 'acc10', '$2y$10$inKHfHPdmYtZxRtmJ3pB..gISHhqZR9K5BllznAf1V99KxPJZnvYG', 'Tabancura', 'Jericha', NULL, '', 'test', 0, '2024-11-23 03:00:40', 'root', 2, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0),
(13, '', 'default-avatar.jpg', 'acc11', '$2y$10$1H57uRwEGkM6qznZOLSi1.4FFgcHEznAYH3t10k1aeqx9524dfvbC', 'Winchester', 'Dean', '', '', 'hunter', 0, '2024-11-23 03:14:59', 'root', 2, 0, 1, 0, 1, 1, 1, 0, 1, 0, 0),
(20, '', 'default-avatar.jpg', 'acc12', '$2y$10$IC1MIz720rIQYU5acImPNu/dOV4ErWpmYesMfpF9lDIkYAPPcRlxK', 'Winchester', 'Sam', '', '', 'hunter', 0, '2024-11-23 03:41:51', 'root', 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0),
(21, '', 'default-avatar.jpg', 'acc13', '$2y$10$199Fgr2pQc54uHDghCmVSOBo05W9lYP8arStSZbr8QEHONhyJ4yjW', 'Crownguard', 'Luxanna', '', '', 'mage', 0, '2024-11-23 03:47:44', 'root', 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0),
(22, '', 'default-avatar.jpg', 'acc14', '$2y$10$fZvxqUWOpegVTOIJiPcZyOxeuEf1RiauYBEsKcvBaD6GwzzI0XLli', 'Crownguard', 'Garren', '', '', 'tank', 0, '2024-11-23 14:42:59', 'root', 2, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(50) NOT NULL,
  `table` varchar(15) NOT NULL,
  `type` varchar(50) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `addedBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `table`, `type`, `dateAdded`, `addedBy`) VALUES
(1, 'medicine', 'Analgesics', '2024-12-11 00:47:56', 'root'),
(2, 'medicine', 'Anesthetics', '2024-12-11 00:47:56', 'root'),
(3, 'medicine', 'Anti-addiction agents', '2024-12-11 00:47:56', 'root'),
(4, 'medicine', 'Antibacterials', '2024-12-11 00:47:56', 'root'),
(5, 'medicine', 'Anticonvulsants', '2024-12-11 00:47:56', 'root'),
(6, 'medicine', 'Antidementia agents', '2024-12-11 00:47:56', 'root'),
(7, 'medicine', 'Antidepressants', '2024-12-11 00:47:56', 'root'),
(8, 'medicine', 'Antiemetics', '2024-12-11 00:47:56', 'root'),
(9, 'medicine', 'Antifungals', '2024-12-11 00:47:56', 'root'),
(10, 'medicine', 'Antigout agents', '2024-12-11 00:47:56', 'root'),
(11, 'medicine', 'Antimigraine agents', '2024-12-11 00:47:56', 'root'),
(12, 'medicine', 'Antimyasthenic agents', '2024-12-11 00:47:56', 'root'),
(13, 'medicine', 'Antimycobacterials', '2024-12-11 00:47:56', 'root'),
(14, 'medicine', 'Antineoplastics', '2024-12-11 00:47:56', 'root'),
(15, 'medicine', 'Antiparasitics', '2024-12-11 00:47:56', 'root'),
(16, 'medicine', 'Antiparkinson agents', '2024-12-11 00:47:56', 'root'),
(17, 'medicine', 'Antipsychotics', '2024-12-11 00:51:44', 'root'),
(18, 'medicine', 'Antispasticity agents', '2024-12-11 00:51:44', 'root'),
(19, 'medicine', 'Antivirals', '2024-12-11 00:51:44', 'root'),
(20, 'medicine', 'Anxiolytics', '2024-12-11 00:51:44', 'root'),
(21, 'medicine', 'Bipolar agents', '2024-12-11 00:51:44', 'root'),
(22, 'medicine', 'Blood glucose regulators', '2024-12-11 00:51:44', 'root'),
(23, 'medicine', 'Blood products', '2024-12-11 00:51:44', 'root'),
(24, 'medicine', 'Cardiovascular agents', '2024-12-11 00:51:44', 'root'),
(25, 'medicine', 'Central nervous system agents', '2024-12-11 00:51:44', 'root'),
(26, 'medicine', 'Dental and oral agents', '2024-12-11 00:51:44', 'root'),
(27, 'medicine', 'Dermatological agents', '2024-12-11 00:51:44', 'root'),
(28, 'medicine', 'Electrolytes, minerals, metals, vitamins', '2024-12-11 00:51:44', 'root'),
(29, 'medicine', 'Gastrointestinal agents', '2024-12-11 00:51:44', 'root'),
(30, 'medicine', 'Genetic/enzyme/protein disorder agents', '2024-12-11 00:51:44', 'root'),
(31, 'medicine', 'Genitourinary agents', '2024-12-11 00:51:44', 'root'),
(32, 'medicine', 'Hormonal agents (adrenal)', '2024-12-11 00:51:44', 'root'),
(33, 'medicine', 'Hormonal agents (pituitary)', '2024-12-11 00:54:33', 'root'),
(34, 'medicine', 'Hormonal agents (prostaglandins)', '2024-12-11 00:54:33', 'root'),
(35, 'medicine', 'Hormonal agents (sex hormones)', '2024-12-11 00:54:33', 'root'),
(36, 'medicine', 'Hormonal agents (thyroid)', '2024-12-11 00:54:33', 'root'),
(37, 'medicine', 'Hormone suppressant (adrenal)', '2024-12-11 00:54:33', 'root'),
(38, 'medicine', 'Hormone suppressant (pituitary)', '2024-12-11 00:54:33', 'root'),
(39, 'medicine', 'Hormone suppressant (thyroid)', '2024-12-11 00:54:33', 'root'),
(40, 'medicine', 'Immunological agents', '2024-12-11 00:54:33', 'root'),
(41, 'medicine', 'Inflammatory bowel disease agents', '2024-12-11 00:54:33', 'root'),
(42, 'medicine', 'Metabolic bone disease agents', '2024-12-11 00:54:33', 'root'),
(43, 'medicine', 'Ophthalmic agents', '2024-12-11 00:54:33', 'root'),
(44, 'medicine', 'Otic agents', '2024-12-11 00:54:33', 'root'),
(45, 'medicine', 'Respiratory tract agents', '2024-12-11 00:54:33', 'root'),
(46, 'medicine', 'Skeletal muscle relaxants', '2024-12-11 00:54:33', 'root'),
(47, 'medicine', 'Sleep disorder agents', '2024-12-11 00:54:33', 'root'),
(48, 'equipments', 'ToolExample', '2024-12-11 02:40:22', 'root'),
(50, 'room', 'SingleBed', '2024-12-14 03:50:24', 'root'),
(51, 'room', 'DoubleBed', '2024-12-14 03:50:33', 'root');

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
(1, '8286418476100', '0002', 'beds'),
(2, '8286418476101', 'test', 'equipments'),
(3, '8286418476102', 'opmaGamit', 'equipments'),
(4, '8286418476103', '0001', 'beds'),
(5, '8286418476104', 'bioflu', 'medicine'),
(6, '8286418476105', 'Bungi, Coarl ', 'staff'),
(7, '8286418476106', 'bioflu', 'medicine'),
(8, '8286418476107', '0007', 'bed'),
(9, '8286418476108', NULL, NULL),
(10, '8286418476109', NULL, NULL),
(11, '8286418476110', NULL, NULL),
(12, '8286418476111', NULL, NULL),
(13, '8286418476112', NULL, NULL),
(14, '8286418476113', NULL, NULL),
(15, '8286418476114', NULL, NULL),
(16, '8286418476115', NULL, NULL),
(17, '8286418476116', NULL, NULL),
(18, '8286418476117', NULL, NULL),
(19, '8286418476118', NULL, NULL),
(20, '8286418476119', NULL, NULL),
(21, '8286418476120', NULL, NULL);

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
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
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
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

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
  MODIFY `bed_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `blood`
--
ALTER TABLE `blood`
  MODIFY `blood_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `equip_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `med_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `uid`
--
ALTER TABLE `uid`
  MODIFY `Q_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
