-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 24, 2026 at 12:06 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `module`, `action`, `record_id`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'Products', 'Create', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 02:27:45'),
(2, 1, 'Products', 'Update', 51, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 02:28:24'),
(3, 1, 'Products', 'Update', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 02:44:07'),
(4, 1, 'Products', 'Update', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 02:46:39'),
(5, 1, 'Products', 'Update', 3, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:51:42'),
(6, 1, 'Products', 'Update', 4, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:52:18'),
(7, 1, 'Products', 'Update', 5, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:52:53'),
(8, 1, 'Products', 'Update', 6, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:53:36'),
(9, 1, 'Products', 'Update', 7, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:54:09'),
(10, 1, 'Products', 'Update', 8, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:55:05'),
(11, 1, 'Products', 'Update', 9, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:55:48'),
(12, 1, 'Products', 'Update', 10, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:56:20'),
(13, 1, 'Products', 'Update', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:57:05'),
(14, 1, 'Products', 'Update', 12, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:57:59'),
(15, 1, 'Products', 'Update', 13, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 03:59:40'),
(16, 1, 'Products', 'Update', 14, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 04:00:42'),
(17, 1, 'Products', 'Update', 15, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 04:01:22'),
(18, 1, 'Products', 'Update', 16, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 04:02:26'),
(19, 1, 'Products', 'Update', 17, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 04:03:08'),
(20, 1, 'Products', 'Update', 18, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:22:50'),
(21, 1, 'Products', 'Update', 19, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:23:32'),
(22, 1, 'Products', 'Update', 20, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:24:15'),
(23, 1, 'Products', 'Update', 21, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:28:17'),
(24, 1, 'Products', 'Update', 22, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:29:07'),
(25, 1, 'Products', 'Update', 23, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:32:12'),
(26, 1, 'Products', 'Update', 24, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:33:05'),
(27, 1, 'Products', 'Update', 25, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:33:59'),
(28, 1, 'Products', 'Update', 26, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:37:41'),
(29, 1, 'Products', 'Update', 27, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:38:13'),
(30, 1, 'Products', 'Update', 28, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:39:41'),
(31, 1, 'Products', 'Update', 29, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:40:16'),
(32, 1, 'Products', 'Update', 30, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 12:41:09'),
(33, 1, 'Products', 'Update', 31, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:34:19'),
(34, 1, 'Products', 'Update', 32, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:35:13'),
(35, 1, 'Products', 'Update', 33, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:36:47'),
(36, 1, 'Products', 'Update', 34, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:37:36'),
(37, 1, 'Products', 'Update', 35, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:38:57'),
(38, 1, 'Products', 'Update', 36, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:40:32'),
(39, 1, 'Products', 'Update', 37, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:46:20'),
(40, 1, 'Products', 'Update', 38, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:47:03'),
(41, 1, 'Products', 'Update', 39, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:47:45'),
(42, 1, 'Products', 'Update', 40, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:48:31'),
(43, 1, 'Products', 'Update', 41, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:49:40'),
(44, 1, 'Products', 'Update', 42, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:50:43'),
(45, 1, 'Products', 'Update', 43, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:51:57'),
(46, 1, 'Products', 'Update', 44, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:53:11'),
(47, 1, 'Products', 'Update', 45, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:54:04'),
(48, 1, 'Products', 'Update', 46, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:55:36'),
(49, 1, 'Products', 'Update', 47, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:56:27'),
(50, 1, 'Products', 'Update', 48, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:57:41'),
(51, 1, 'Products', 'Update', 49, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:58:34'),
(52, 1, 'Products', 'Update', 50, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-17 23:59:20'),
(53, 1, 'Categories', 'Update', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 12:17:34'),
(54, 1, 'Brands', 'Create', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 12:17:58'),
(55, 1, 'Brands', 'Update', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 12:25:29'),
(56, 1, 'Purchases', 'Create', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 13:00:30'),
(57, 1, 'Purchases', 'Update', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 13:08:51'),
(58, 1, 'Purchases', 'Update', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-20 13:09:15'),
(59, 1, 'Sales', 'Create', 11, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 00:01:43'),
(60, 1, 'Sales', 'Create', 12, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 00:03:00'),
(61, 1, 'Sales', 'Create', 13, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 00:04:02'),
(62, 1, 'Sales', 'Create', 14, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 12:32:29'),
(63, 1, 'Sales', 'Update', 9, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 12:33:11'),
(64, 1, 'Sales', 'Create', 15, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 12:35:32'),
(65, 1, 'Inventory', 'Stock In', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 12:57:51'),
(66, 1, 'Inventory', 'Stock Out', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 13:00:30'),
(67, 1, 'Inventory', 'Stock Out', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 13:01:07'),
(68, 1, 'Inventory', 'Stock In', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 13:02:27'),
(69, 1, 'Inventory', 'Adjustment', 3, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 13:08:16'),
(70, 1, 'Inventory', 'Adjustment', 4, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-21 13:09:11'),
(71, 1, 'Inventory', 'Adjustment', 5, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:25:01'),
(72, 1, 'Inventory', 'Adjustment', 6, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 02:50:42'),
(73, 1, 'Inventory', 'Adjustment', 7, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 12:28:11'),
(74, 1, 'Inventory', 'Transfer', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 12:37:50'),
(75, 1, 'Inventory', 'Transfer', 2, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-22 12:43:22'),
(76, 1, 'Users', 'Create', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-23 02:50:34'),
(77, 1, 'Categories', 'Update', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-23 22:46:06'),
(78, 1, 'Brands', 'Update', 10, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-23 22:46:32'),
(79, 1, 'Purchases', 'Update', 10, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-23 22:48:33'),
(80, 1, 'Sales', 'Create', 16, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-23 22:49:29'),
(81, 1, 'Sales', 'Create', 17, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', '2026-07-23 22:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nike', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(2, 'Adidas', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 'Apple', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(4, 'Samsung', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(5, 'Sony', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(6, 'LG', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(7, 'Panasonic', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(8, 'Xiaomi', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(9, 'Dell', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(10, 'HP', '6a6299c88df04_1784846792.webp', '', 'active', '2026-07-17 01:20:08', '2026-07-23 22:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Electronics', 'electronics', '6a6299ae824db_1784846766.webp', 'Electronics', 'active', '2026-07-17 01:20:08', '2026-07-23 22:46:06'),
(2, NULL, 'Clothing', 'clothing', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, NULL, 'Food & Beverages', 'food-beverages', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(4, NULL, 'Office Supplies', 'office-supplies', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(5, NULL, 'Health & Beauty', 'health-beauty', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(6, NULL, 'Home & Living', 'home-living', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(7, NULL, 'Sports & Outdoors', 'sports-outdoors', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(8, NULL, 'Automotive', 'automotive', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(9, NULL, 'Books & Media', 'books-media', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(10, NULL, 'Toys & Games', 'toys-games', NULL, NULL, 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_code` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Philippines',
  `credit_limit` decimal(15,2) DEFAULT '0.00',
  `balance` decimal(15,2) DEFAULT '0.00',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_code`, `first_name`, `last_name`, `company`, `email`, `phone`, `address`, `city`, `country`, `credit_limit`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CUST-0001', 'Juan', 'Dela Cruz', 'Dela Cruz Enterprises', 'juan.dela cruz@email.com', '09170000001', '1 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(2, 'CUST-0002', 'Maria', 'Santos', 'Santos Enterprises', 'maria.santos@email.com', '09170000002', '2 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 'CUST-0003', 'Pedro', 'Reyes', 'Reyes Enterprises', 'pedro.reyes@email.com', '09170000003', '3 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(4, 'CUST-0004', 'Ana', 'Gonzales', 'Gonzales Enterprises', 'ana.gonzales@email.com', '09170000004', '4 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(5, 'CUST-0005', 'Jose', 'Lopez', 'Lopez Enterprises', 'jose.lopez@email.com', '09170000005', '5 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(6, 'CUST-0006', 'Elena', 'Martinez', 'Martinez Enterprises', 'elena.martinez@email.com', '09170000006', '6 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(7, 'CUST-0007', 'Carlos', 'Hernandez', 'Hernandez Enterprises', 'carlos.hernandez@email.com', '09170000007', '7 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(8, 'CUST-0008', 'Luz', 'Garcia', 'Garcia Enterprises', 'luz.garcia@email.com', '09170000008', '8 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(9, 'CUST-0009', 'Antonio', 'Rodriguez', 'Rodriguez Enterprises', 'antonio.rodriguez@email.com', '09170000009', '9 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(10, 'CUST-0010', 'Rosa', 'Perez', 'Perez Enterprises', 'rosa.perez@email.com', '09170000010', '10 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(11, 'CUST-0011', 'Manuel', 'Tan', 'Tan Enterprises', 'manuel.tan@email.com', '09170000011', '11 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(12, 'CUST-0012', 'Cristina', 'Lim', 'Lim Enterprises', 'cristina.lim@email.com', '09170000012', '12 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(13, 'CUST-0013', 'Francisco', 'Ong', 'Ong Enterprises', 'francisco.ong@email.com', '09170000013', '13 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(14, 'CUST-0014', 'Teresa', 'Sy', 'Sy Enterprises', 'teresa.sy@email.com', '09170000014', '14 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(15, 'CUST-0015', 'Andres', 'Chua', 'Chua Enterprises', 'andres.chua@email.com', '09170000015', '15 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(16, 'CUST-0016', 'Gloria', 'Go', 'Go Enterprises', 'gloria.go@email.com', '09170000016', '16 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(17, 'CUST-0017', 'Ricardo', 'Co', 'Co Enterprises', 'ricardo.co@email.com', '09170000017', '17 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(18, 'CUST-0018', 'Lourdes', 'Uy', 'Uy Enterprises', 'lourdes.uy@email.com', '09170000018', '18 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(19, 'CUST-0019', 'Eduardo', 'Dizon', 'Dizon Enterprises', 'eduardo.dizon@email.com', '09170000019', '19 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(20, 'CUST-0020', 'Carmen', 'Romualdez', 'Romualdez Enterprises', 'carmen.romualdez@email.com', '09170000020', '20 Customer St', 'Manila', 'Philippines', '0.00', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(21, 'CUST-9105', 'Clydey', 'Ednalan', 'clydey inc', 'clydey@test.com', '545345', 'new', 'Olongapo City', 'Philippines', '100.00', '0.00', 'active', '2026-07-22 12:50:46', '2026-07-22 12:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `expense_date` date NOT NULL,
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_category_id`, `user_id`, `title`, `amount`, `expense_date`, `notes`, `created_at`) VALUES
(1, 2, 1, 'Vehicle fuel', '427.69', '2026-07-03', NULL, '2026-07-17 01:20:08'),
(2, 5, 1, 'Equipment repair', '348.63', '2026-06-30', NULL, '2026-07-17 01:20:08'),
(3, 3, 1, 'Equipment repair', '416.98', '2026-07-03', NULL, '2026-07-17 01:20:08'),
(4, 9, 1, 'Monthly rent', '488.90', '2026-06-19', NULL, '2026-07-17 01:20:08'),
(5, 1, 1, 'Water bill', '252.38', '2026-07-06', NULL, '2026-07-17 01:20:08'),
(6, 10, 1, 'Monthly rent', '391.80', '2026-07-15', NULL, '2026-07-17 01:20:08'),
(7, 9, 1, 'Monthly rent', '88.82', '2026-07-04', NULL, '2026-07-17 01:20:08'),
(8, 3, 1, 'Monthly rent', '43.01', '2026-06-18', NULL, '2026-07-17 01:20:08'),
(9, 9, 1, 'Equipment repair', '184.19', '2026-07-02', NULL, '2026-07-17 01:20:08'),
(10, 1, 1, 'Vehicle fuel', '484.13', '2026-07-04', NULL, '2026-07-17 01:20:08'),
(11, 3, 1, 'Water bill', '154.20', '2026-06-29', NULL, '2026-07-17 01:20:08'),
(12, 8, 1, 'Vehicle fuel', '355.56', '2026-06-19', NULL, '2026-07-17 01:20:08'),
(13, 1, 1, 'Internet service', '144.31', '2026-06-20', NULL, '2026-07-17 01:20:08'),
(14, 6, 1, 'Electric bill', '37.42', '2026-07-09', '', '2026-07-17 01:20:08'),
(15, 8, 1, 'Office supplies', '455.32', '2026-06-23', NULL, '2026-07-17 01:20:08'),
(16, 2, 1, 'Insurance premium', '248.79', '2026-06-30', NULL, '2026-07-17 01:20:08'),
(17, 9, 1, 'Electric bill', '308.21', '2026-07-03', NULL, '2026-07-17 01:20:08'),
(18, 6, 1, 'Vehicle fuel', '201.49', '2026-07-08', NULL, '2026-07-17 01:20:08'),
(19, 10, 1, 'Internet service', '488.99', '2026-06-24', NULL, '2026-07-17 01:20:08'),
(20, 3, 1, 'Water bill', '347.06', '2026-06-27', NULL, '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Utilities', NULL, '2026-07-17 01:20:08'),
(2, 'Rent', NULL, '2026-07-17 01:20:08'),
(3, 'Salaries', NULL, '2026-07-17 01:20:08'),
(4, 'Marketing', NULL, '2026-07-17 01:20:08'),
(5, 'Transportation', NULL, '2026-07-17 01:20:08'),
(6, 'Maintenance', NULL, '2026-07-17 01:20:08'),
(7, 'Office Supplies', NULL, '2026-07-17 01:20:08'),
(8, 'Insurance', NULL, '2026-07-17 01:20:08'),
(9, 'Taxes', NULL, '2026-07-17 01:20:08'),
(10, 'Miscellaneous', NULL, '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '0',
  `reserved_quantity` int(11) DEFAULT '0',
  `available_quantity` int(11) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `warehouse_id`, `quantity`, `reserved_quantity`, `available_quantity`, `updated_at`) VALUES
(1, 1, 1, 39, 0, 39, '2026-07-23 22:49:29'),
(2, 1, 2, 531, 0, 531, '2026-07-22 12:43:22'),
(3, 1, 3, 479, 0, 479, '2026-07-17 01:20:08'),
(4, 2, 1, 99, 0, 99, '2026-07-23 22:50:05'),
(5, 2, 2, 462, 0, 462, '2026-07-17 01:20:08'),
(6, 2, 3, 49, 0, 49, '2026-07-17 01:20:08'),
(7, 3, 1, 91, 0, 91, '2026-07-23 22:50:05'),
(8, 3, 2, 353, 0, 353, '2026-07-17 01:20:08'),
(9, 3, 3, 11, 0, 11, '2026-07-17 01:20:08'),
(10, 4, 1, 219, 0, 219, '2026-07-23 22:50:05'),
(11, 4, 2, 222, 0, 222, '2026-07-17 01:20:08'),
(12, 4, 3, 478, 0, 478, '2026-07-17 01:20:08'),
(13, 5, 1, 66, 0, 66, '2026-07-23 22:50:05'),
(14, 5, 2, 157, 0, 157, '2026-07-17 01:20:08'),
(15, 5, 3, 312, 0, 312, '2026-07-17 01:20:08'),
(16, 6, 1, 285, 0, 285, '2026-07-23 22:50:05'),
(17, 6, 2, 415, 0, 415, '2026-07-17 01:20:08'),
(18, 6, 3, 418, 0, 418, '2026-07-17 01:20:08'),
(19, 7, 1, 134, 0, 134, '2026-07-23 22:50:05'),
(20, 7, 2, 378, 0, 378, '2026-07-17 01:20:08'),
(21, 7, 3, 487, 0, 487, '2026-07-17 01:20:08'),
(22, 8, 1, 167, 0, 167, '2026-07-23 22:50:05'),
(23, 8, 2, 149, 0, 149, '2026-07-17 01:20:08'),
(24, 8, 3, 283, 0, 283, '2026-07-17 01:20:08'),
(25, 9, 1, 344, 0, 344, '2026-07-17 01:20:08'),
(26, 9, 2, 262, 0, 262, '2026-07-17 01:20:08'),
(27, 9, 3, 429, 0, 429, '2026-07-17 01:20:08'),
(28, 10, 1, 315, 0, 315, '2026-07-17 01:20:08'),
(29, 10, 2, 222, 0, 222, '2026-07-17 01:20:08'),
(30, 10, 3, 244, 0, 244, '2026-07-17 01:20:08'),
(31, 11, 1, 455, 0, 455, '2026-07-17 01:20:08'),
(32, 11, 2, 110, 0, 110, '2026-07-17 01:20:08'),
(33, 11, 3, 248, 0, 248, '2026-07-17 01:20:08'),
(34, 12, 1, 379, 0, 379, '2026-07-21 12:32:29'),
(35, 12, 2, 296, 0, 296, '2026-07-17 01:20:08'),
(36, 12, 3, 207, 0, 207, '2026-07-17 01:20:08'),
(37, 13, 1, 316, 0, 316, '2026-07-17 01:20:08'),
(38, 13, 2, 162, 0, 162, '2026-07-17 01:20:08'),
(39, 13, 3, 392, 0, 392, '2026-07-17 01:20:08'),
(40, 14, 1, 94, 0, 94, '2026-07-17 01:20:08'),
(41, 14, 2, 67, 0, 67, '2026-07-17 01:20:08'),
(42, 14, 3, 410, 0, 410, '2026-07-17 01:20:08'),
(43, 15, 1, 485, 0, 485, '2026-07-21 12:32:29'),
(44, 15, 2, 347, 0, 347, '2026-07-17 01:20:08'),
(45, 15, 3, 356, 0, 356, '2026-07-17 01:20:08'),
(46, 16, 1, 433, 0, 433, '2026-07-17 01:20:08'),
(47, 16, 2, 232, 0, 232, '2026-07-17 01:20:08'),
(48, 16, 3, 387, 0, 387, '2026-07-17 01:20:08'),
(49, 17, 1, 123, 0, 123, '2026-07-17 01:20:08'),
(50, 17, 2, 337, 0, 337, '2026-07-17 01:20:08'),
(51, 17, 3, 189, 0, 189, '2026-07-17 01:20:08'),
(52, 18, 1, 166, 0, 166, '2026-07-17 01:20:08'),
(53, 18, 2, 439, 0, 439, '2026-07-17 01:20:08'),
(54, 18, 3, 382, 0, 382, '2026-07-17 01:20:08'),
(55, 19, 1, 144, 0, 144, '2026-07-17 01:20:08'),
(56, 19, 2, 450, 0, 450, '2026-07-17 01:20:08'),
(57, 19, 3, 298, 0, 298, '2026-07-17 01:20:08'),
(58, 20, 1, 202, 0, 202, '2026-07-17 01:20:08'),
(59, 20, 2, 16, 0, 16, '2026-07-17 01:20:08'),
(60, 20, 3, 137, 0, 137, '2026-07-17 01:20:08'),
(61, 21, 1, 40, 0, 40, '2026-07-17 01:20:08'),
(62, 21, 2, 476, 0, 476, '2026-07-17 01:20:08'),
(63, 21, 3, 480, 0, 480, '2026-07-17 01:20:08'),
(64, 22, 1, 306, 0, 306, '2026-07-17 01:20:08'),
(65, 22, 2, 111, 0, 111, '2026-07-17 01:20:08'),
(66, 22, 3, 377, 0, 377, '2026-07-17 01:20:08'),
(67, 23, 1, 403, 0, 403, '2026-07-17 01:20:08'),
(68, 23, 2, 369, 0, 369, '2026-07-17 01:20:08'),
(69, 23, 3, 77, 0, 77, '2026-07-17 01:20:08'),
(70, 24, 1, 272, 0, 272, '2026-07-17 01:20:08'),
(71, 24, 2, 73, 0, 73, '2026-07-17 01:20:08'),
(72, 24, 3, 67, 0, 67, '2026-07-17 01:20:08'),
(73, 25, 1, 445, 0, 445, '2026-07-17 01:20:08'),
(74, 25, 2, 156, 0, 156, '2026-07-17 01:20:08'),
(75, 25, 3, 302, 0, 302, '2026-07-17 01:20:08'),
(76, 26, 1, 241, 0, 241, '2026-07-17 01:20:08'),
(77, 26, 2, 356, 0, 356, '2026-07-17 01:20:08'),
(78, 26, 3, 380, 0, 380, '2026-07-17 01:20:08'),
(79, 27, 1, 342, 0, 342, '2026-07-17 01:20:08'),
(80, 27, 2, 426, 0, 426, '2026-07-17 01:20:08'),
(81, 27, 3, 490, 0, 490, '2026-07-17 01:20:08'),
(82, 28, 1, 211, 0, 211, '2026-07-17 01:20:08'),
(83, 28, 2, 360, 0, 360, '2026-07-17 01:20:08'),
(84, 28, 3, 309, 0, 309, '2026-07-17 01:20:08'),
(85, 29, 1, 323, 0, 323, '2026-07-17 01:20:08'),
(86, 29, 2, 292, 0, 292, '2026-07-17 01:20:08'),
(87, 29, 3, 356, 0, 356, '2026-07-17 01:20:08'),
(88, 30, 1, 235, 0, 235, '2026-07-17 01:20:08'),
(89, 30, 2, 45, 0, 45, '2026-07-17 01:20:08'),
(90, 30, 3, 226, 0, 226, '2026-07-17 01:20:08'),
(91, 31, 1, 55, 0, 55, '2026-07-17 01:20:08'),
(92, 31, 2, 341, 0, 341, '2026-07-17 01:20:08'),
(93, 31, 3, 342, 0, 342, '2026-07-17 01:20:08'),
(94, 32, 1, 231, 0, 231, '2026-07-17 01:20:08'),
(95, 32, 2, 397, 0, 397, '2026-07-17 01:20:08'),
(96, 32, 3, 495, 0, 495, '2026-07-17 01:20:08'),
(97, 33, 1, 476, 0, 476, '2026-07-17 01:20:08'),
(98, 33, 2, 211, 0, 211, '2026-07-17 01:20:08'),
(99, 33, 3, 475, 0, 475, '2026-07-17 01:20:08'),
(100, 34, 1, 178, 0, 178, '2026-07-17 01:20:08'),
(101, 34, 2, 147, 0, 147, '2026-07-17 01:20:08'),
(102, 34, 3, 390, 0, 390, '2026-07-17 01:20:08'),
(103, 35, 1, 252, 0, 252, '2026-07-17 01:20:08'),
(104, 35, 2, 87, 0, 87, '2026-07-17 01:20:08'),
(105, 35, 3, 102, 0, 102, '2026-07-17 01:20:08'),
(106, 36, 1, 159, 0, 159, '2026-07-17 01:20:08'),
(107, 36, 2, 317, 0, 317, '2026-07-17 01:20:08'),
(108, 36, 3, 301, 0, 301, '2026-07-17 01:20:08'),
(109, 37, 1, 349, 0, 349, '2026-07-17 01:20:08'),
(110, 37, 2, 205, 0, 205, '2026-07-17 01:20:08'),
(111, 37, 3, 450, 0, 450, '2026-07-17 01:20:08'),
(112, 38, 1, 79, 0, 79, '2026-07-17 01:20:08'),
(113, 38, 2, 68, 0, 68, '2026-07-17 01:20:08'),
(114, 38, 3, 282, 0, 282, '2026-07-17 01:20:08'),
(115, 39, 1, 356, 0, 356, '2026-07-17 01:20:08'),
(116, 39, 2, 122, 0, 122, '2026-07-17 01:20:08'),
(117, 39, 3, 202, 0, 202, '2026-07-17 01:20:08'),
(118, 40, 1, 146, 0, 146, '2026-07-17 01:20:08'),
(119, 40, 2, 175, 0, 175, '2026-07-17 01:20:08'),
(120, 40, 3, 56, 0, 56, '2026-07-17 01:20:08'),
(121, 41, 1, 421, 0, 421, '2026-07-17 01:20:08'),
(122, 41, 2, 96, 0, 96, '2026-07-17 01:20:08'),
(123, 41, 3, 158, 0, 158, '2026-07-17 01:20:08'),
(124, 42, 1, 71, 0, 71, '2026-07-17 01:20:08'),
(125, 42, 2, 162, 0, 162, '2026-07-17 01:20:08'),
(126, 42, 3, 42, 0, 42, '2026-07-17 01:20:08'),
(127, 43, 1, 328, 0, 328, '2026-07-17 01:20:08'),
(128, 43, 2, 492, 0, 492, '2026-07-17 01:20:08'),
(129, 43, 3, 288, 0, 288, '2026-07-17 01:20:08'),
(130, 44, 1, 271, 0, 271, '2026-07-17 01:20:08'),
(131, 44, 2, 138, 0, 138, '2026-07-17 01:20:08'),
(132, 44, 3, 388, 0, 388, '2026-07-17 01:20:08'),
(133, 45, 1, 76, 0, 76, '2026-07-17 01:20:08'),
(134, 45, 2, 274, 0, 274, '2026-07-17 01:20:08'),
(135, 45, 3, 194, 0, 194, '2026-07-17 01:20:08'),
(136, 46, 1, 102, 0, 102, '2026-07-17 01:20:08'),
(137, 46, 2, 187, 0, 187, '2026-07-17 01:20:08'),
(138, 46, 3, 440, 0, 440, '2026-07-17 01:20:08'),
(139, 47, 1, 285, 0, 285, '2026-07-17 01:20:08'),
(140, 47, 2, 352, 0, 352, '2026-07-17 01:20:08'),
(141, 47, 3, 236, 0, 236, '2026-07-17 01:20:08'),
(142, 48, 1, 354, 0, 354, '2026-07-17 01:20:08'),
(143, 48, 2, 193, 0, 193, '2026-07-17 01:20:08'),
(144, 48, 3, 164, 0, 164, '2026-07-17 01:20:08'),
(145, 49, 1, 260, 0, 260, '2026-07-17 01:20:08'),
(146, 49, 2, 443, 0, 443, '2026-07-17 01:20:08'),
(147, 49, 3, 299, 0, 299, '2026-07-17 01:20:08'),
(148, 50, 1, 485, 0, 485, '2026-07-17 01:20:08'),
(149, 50, 2, 318, 0, 318, '2026-07-17 01:20:08'),
(150, 50, 3, 367, 0, 367, '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `operating_system` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `login_time`, `logout_time`, `ip_address`, `browser`, `operating_system`) VALUES
(1, 1, '2026-07-17 09:22:13', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(2, 1, '2026-07-17 09:22:17', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(3, 1, '2026-07-17 09:22:26', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(4, 1, '2026-07-17 09:22:32', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(5, 1, '2026-07-17 09:23:25', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(6, 1, '2026-07-17 09:23:35', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(7, 1, '2026-07-17 09:23:43', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(8, 1, '2026-07-17 09:23:50', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(9, 1, '2026-07-17 09:24:05', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(10, 1, '2026-07-17 09:24:33', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(11, 1, '2026-07-17 09:24:40', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(12, 1, '2026-07-17 09:25:08', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(13, 1, '2026-07-17 09:25:14', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(14, 1, '2026-07-17 10:14:03', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(15, 1, '2026-07-17 10:14:26', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(16, 1, '2026-07-17 10:14:27', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(17, 1, '2026-07-17 10:14:53', '2026-07-17 10:14:58', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(18, 1, '2026-07-17 10:15:24', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(19, 1, '2026-07-17 10:17:17', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(20, 1, '2026-07-17 10:21:56', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(21, 1, '2026-07-17 10:22:01', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(22, 1, '2026-07-17 10:34:39', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(23, 1, '2026-07-17 10:34:55', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(24, 1, '2026-07-17 10:35:00', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(25, 1, '2026-07-17 10:35:16', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(26, 1, '2026-07-17 10:35:20', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(27, 1, '2026-07-17 10:35:37', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(28, 1, '2026-07-17 10:35:44', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(29, 1, '2026-07-17 10:36:20', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(30, 1, '2026-07-17 10:36:31', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(31, 1, '2026-07-17 10:36:35', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(32, 1, '2026-07-17 10:36:41', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(33, 1, '2026-07-17 10:37:22', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(34, 1, '2026-07-17 10:37:46', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(35, 1, '2026-07-17 13:23:09', NULL, '::1', 'curl/8.7.1', 'Unknown'),
(36, 1, '2026-07-17 20:08:01', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(37, 1, '2026-07-18 07:30:07', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(38, 1, '2026-07-20 09:00:55', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(39, 1, '2026-07-20 20:15:06', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(40, 1, '2026-07-20 20:58:38', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(41, 1, '2026-07-21 07:03:00', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(42, 1, '2026-07-21 07:53:50', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(43, 1, '2026-07-21 20:04:27', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(44, 1, '2026-07-22 10:23:15', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(45, 1, '2026-07-22 10:49:47', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(46, 1, '2026-07-22 19:39:31', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(47, 1, '2026-07-22 20:35:09', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(48, 1, '2026-07-23 06:44:39', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(49, 1, '2026-07-23 10:19:37', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(50, 1, '2026-07-23 10:32:25', '2026-07-23 10:51:26', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(51, 3, '2026-07-23 10:52:41', '2026-07-23 10:53:18', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(52, 1, '2026-07-23 10:53:27', '2026-07-23 10:54:24', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(53, 1, '2026-07-24 06:39:45', '2026-07-24 06:40:05', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(54, 1, '2026-07-24 06:42:04', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown'),
(55, 1, '2026-07-24 06:56:51', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` text,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'Low Stock Alert', 'Product \'Laptop Stand\' has only 11 units remaining (min: 14)', 1, '2026-07-17 02:27:45'),
(2, 1, 'Low Stock Alert', 'Product \'Notebook Set\' has only 16 units remaining (min: 16)', 1, '2026-07-17 02:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_type` enum('purchase','sale') NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `sales_order_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'Cash',
  `reference_no` varchar(100) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module`, `description`, `created_at`) VALUES
(1, 'users-view', 'Users', NULL, '2026-07-17 01:20:08'),
(2, 'users-create', 'Users', NULL, '2026-07-17 01:20:08'),
(3, 'users-edit', 'Users', NULL, '2026-07-17 01:20:08'),
(4, 'users-delete', 'Users', NULL, '2026-07-17 01:20:08'),
(5, 'roles-view', 'Roles', NULL, '2026-07-17 01:20:08'),
(6, 'roles-create', 'Roles', NULL, '2026-07-17 01:20:08'),
(7, 'roles-edit', 'Roles', NULL, '2026-07-17 01:20:08'),
(8, 'roles-delete', 'Roles', NULL, '2026-07-17 01:20:08'),
(9, 'products-view', 'Products', NULL, '2026-07-17 01:20:08'),
(10, 'products-create', 'Products', NULL, '2026-07-17 01:20:08'),
(11, 'products-edit', 'Products', NULL, '2026-07-17 01:20:08'),
(12, 'products-delete', 'Products', NULL, '2026-07-17 01:20:08'),
(13, 'categories-view', 'Categories', NULL, '2026-07-17 01:20:08'),
(14, 'categories-create', 'Categories', NULL, '2026-07-17 01:20:08'),
(15, 'categories-edit', 'Categories', NULL, '2026-07-17 01:20:08'),
(16, 'categories-delete', 'Categories', NULL, '2026-07-17 01:20:08'),
(17, 'brands-view', 'Brands', NULL, '2026-07-17 01:20:08'),
(18, 'brands-create', 'Brands', NULL, '2026-07-17 01:20:08'),
(19, 'brands-edit', 'Brands', NULL, '2026-07-17 01:20:08'),
(20, 'brands-delete', 'Brands', NULL, '2026-07-17 01:20:08'),
(21, 'purchases-view', 'Purchases', NULL, '2026-07-17 01:20:08'),
(22, 'purchases-create', 'Purchases', NULL, '2026-07-17 01:20:08'),
(23, 'purchases-edit', 'Purchases', NULL, '2026-07-17 01:20:08'),
(24, 'purchases-delete', 'Purchases', NULL, '2026-07-17 01:20:08'),
(25, 'sales-view', 'Sales', NULL, '2026-07-17 01:20:08'),
(26, 'sales-create', 'Sales', NULL, '2026-07-17 01:20:08'),
(27, 'sales-edit', 'Sales', NULL, '2026-07-17 01:20:08'),
(28, 'sales-delete', 'Sales', NULL, '2026-07-17 01:20:08'),
(29, 'inventory-view', 'Inventory', NULL, '2026-07-17 01:20:08'),
(30, 'inventory-adjust', 'Inventory', NULL, '2026-07-17 01:20:08'),
(31, 'reports-view', 'Reports', NULL, '2026-07-17 01:20:08'),
(32, 'settings-view', 'Settings', NULL, '2026-07-17 01:20:08'),
(33, 'settings-edit', 'Settings', NULL, '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `sku` varchar(50) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `qr_code` text,
  `name` varchar(200) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `image` varchar(255) DEFAULT 'default.png',
  `description` text,
  `purchase_price` decimal(15,2) DEFAULT '0.00',
  `selling_price` decimal(15,2) DEFAULT '0.00',
  `tax` decimal(5,2) DEFAULT '0.00',
  `discount` decimal(5,2) DEFAULT '0.00',
  `minimum_stock` int(11) DEFAULT '10',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `unit_id`, `supplier_id`, `sku`, `barcode`, `qr_code`, `name`, `slug`, `image`, `description`, `purchase_price`, `selling_price`, `tax`, `discount`, `minimum_stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 7, 3, 4, 'SKU-00001', 'BR6a59834850fba', NULL, 'Wireless Mouse', 'wireless-mouse-1', '6a5996f74ddc2_1784256247.jpg', '', '432.90', '497.84', '0.00', '0.00', 7, 'active', '2026-07-17 01:20:08', '2026-07-17 02:44:07'),
(2, 7, 5, 3, 4, 'SKU-00002', 'BR6a5983485149f', NULL, 'USB-C Hub', 'usb-c-hub-2', '6a59978f0ce53_1784256399.jpeg', '', '284.58', '392.72', '0.00', '0.00', 20, 'active', '2026-07-17 01:20:08', '2026-07-17 02:46:39'),
(3, 10, 5, 4, 2, 'SKU-00003', 'BR6a59834851882', NULL, 'Laptop Stand', 'laptop-stand-3', '6a59a6ceeb5f9_1784260302.webp', '', '170.62', '192.80', '0.00', '0.00', 14, 'active', '2026-07-17 01:20:08', '2026-07-17 03:51:42'),
(4, 2, 7, 3, 4, 'SKU-00004', 'BR6a59834851af0', NULL, 'Mechanical Keyboard', 'mechanical-keyboard-4', '6a59a6f2c4543_1784260338.webp', '', '387.20', '429.79', '0.00', '0.00', 10, 'active', '2026-07-17 01:20:08', '2026-07-17 03:52:18'),
(5, 10, 5, 2, 1, 'SKU-00005', 'BR6a59834851d4e', NULL, 'HDMI Cable', 'hdmi-cable-5', '6a59a7150b06d_1784260373.jpg', '', '200.12', '240.14', '0.00', '0.00', 17, 'active', '2026-07-17 01:20:08', '2026-07-17 03:52:53'),
(6, 1, 3, 4, 4, 'SKU-00006', 'BR6a5983485205d', NULL, 'Bluetooth Speaker', 'bluetooth-speaker-6', '6a59a74024849_1784260416.webp', '', '84.11', '95.04', '0.00', '0.00', 9, 'active', '2026-07-17 01:20:08', '2026-07-17 03:53:36'),
(7, 6, 8, 8, 2, 'SKU-00007', 'BR6a59834852356', NULL, 'Smart Watch Band', 'smart-watch-band-7', '6a59a7617f5d0_1784260449.jpg', '', '151.48', '212.07', '0.00', '0.00', 18, 'active', '2026-07-17 01:20:08', '2026-07-17 03:54:09'),
(8, 6, 9, 4, 3, 'SKU-00008', 'BR6a59834852610', NULL, 'Phone Case', 'phone-case-8', '6a59a79957cc3_1784260505.webp', '', '119.03', '145.22', '0.00', '0.00', 8, 'active', '2026-07-17 01:20:08', '2026-07-17 03:55:05'),
(9, 7, 2, 1, 1, 'SKU-00009', 'BR6a598348528ae', NULL, 'Screen Protector', 'screen-protector-9', '6a59a7c429d1a_1784260548.webp', '', '429.62', '532.73', '0.00', '0.00', 17, 'active', '2026-07-17 01:20:08', '2026-07-17 03:55:48'),
(10, 2, 10, 7, 4, 'SKU-00010', 'BR6a59834852b1f', NULL, 'Power Bank', 'power-bank-10', '6a59a7e413ec4_1784260580.jpg', '', '351.00', '445.77', '0.00', '0.00', 20, 'active', '2026-07-17 01:20:08', '2026-07-17 03:56:20'),
(11, 6, 1, 1, 3, 'SKU-00011', 'BR6a59834852db0', NULL, 'T-Shirt', 't-shirt-11', '6a59a810f3e5e_1784260624.webp', '', '393.31', '456.24', '0.00', '0.00', 15, 'active', '2026-07-17 01:20:08', '2026-07-17 03:57:05'),
(12, 1, 8, 7, 3, 'SKU-00012', 'BR6a5983485301d', NULL, 'Denim Jacket', 'denim-jacket-12', '6a59a84732d89_1784260679.webp', '', '235.98', '311.49', '0.00', '0.00', 20, 'active', '2026-07-17 01:20:08', '2026-07-17 03:57:59'),
(13, 4, 8, 4, 2, 'SKU-00013', 'BR6a5983485327b', NULL, 'Running Shoes', 'running-shoes-13', '6a59a8ac9bf94_1784260780.webp', '', '499.01', '643.72', '0.00', '0.00', 12, 'active', '2026-07-17 01:20:08', '2026-07-17 03:59:40'),
(14, 8, 6, 4, 5, 'SKU-00014', 'BR6a59834853576', NULL, 'Backpack', 'backpack-14', '6a59a8ea227a5_1784260842.webp', '', '161.86', '213.66', '0.00', '0.00', 20, 'active', '2026-07-17 01:20:08', '2026-07-17 04:00:42'),
(15, 2, 7, 7, 5, 'SKU-00015', 'BR6a598348537d3', NULL, 'Sunglasses', 'sunglasses-15', '6a59a912d9c24_1784260882.jpg', '', '440.94', '520.31', '0.00', '0.00', 6, 'active', '2026-07-17 01:20:08', '2026-07-17 04:01:22'),
(16, 7, 4, 4, 5, 'SKU-00016', 'BR6a59834853a42', NULL, 'Coffee Maker', 'coffee-maker-16', '6a59a952598d5_1784260946.jpg', '', '363.09', '486.54', '0.00', '0.00', 14, 'active', '2026-07-17 01:20:08', '2026-07-17 04:02:26'),
(17, 6, 10, 2, 1, 'SKU-00017', 'BR6a59834853f5d', NULL, 'Water Bottle', 'water-bottle-17', '6a59a97c4543d_1784260988.webp', '', '118.86', '139.07', '0.00', '0.00', 8, 'active', '2026-07-17 01:20:08', '2026-07-17 04:03:08'),
(18, 6, 3, 7, 2, 'SKU-00018', 'BR6a59834854347', NULL, 'Yoga Mat', 'yoga-mat-18', '6a5a1e9aa21d0_1784290970.jpg', '', '483.03', '569.98', '0.00', '0.00', 10, 'active', '2026-07-17 01:20:08', '2026-07-17 12:22:50'),
(19, 3, 8, 8, 4, 'SKU-00019', 'BR6a59834854626', NULL, 'Desk Lamp', 'desk-lamp-19', '6a5a1ec4476cb_1784291012.webp', '', '122.03', '140.33', '0.00', '0.00', 18, 'active', '2026-07-17 01:20:08', '2026-07-17 12:23:32'),
(20, 2, 9, 2, 1, 'SKU-00020', 'BR6a598348548f3', NULL, 'Notebook Set', 'notebook-set-20', '6a5a1eefb461a_1784291055.png', '', '375.70', '424.54', '0.00', '0.00', 16, 'active', '2026-07-17 01:20:08', '2026-07-17 12:24:15'),
(21, 3, 3, 3, 2, 'SKU-00021', 'BR6a59834854b8b', NULL, 'Hand Sanitizer', 'hand-sanitizer-21', '6a5a1fe189efc_1784291297.jpeg', '', '79.40', '90.52', '0.00', '0.00', 5, 'active', '2026-07-17 01:20:08', '2026-07-17 12:28:17'),
(22, 8, 1, 7, 3, 'SKU-00022', 'BR6a59834854f5f', NULL, 'Vitamin C', 'vitamin-c-22', '6a5a2013a8851_1784291347.webp', '', '161.88', '226.63', '0.00', '0.00', 8, 'active', '2026-07-17 01:20:08', '2026-07-17 12:29:07'),
(23, 9, 3, 3, 2, 'SKU-00023', 'BR6a598348552a4', NULL, 'Face Mask', 'face-mask-23', '6a5a20ccc3433_1784291532.jpg', '', '124.58', '166.94', '0.00', '0.00', 9, 'active', '2026-07-17 01:20:08', '2026-07-17 12:32:12'),
(24, 10, 3, 3, 5, 'SKU-00024', 'BR6a598348555cf', NULL, 'Shampoo', 'shampoo-24', '6a5a2101486eb_1784291585.webp', '', '479.10', '632.41', '0.00', '0.00', 11, 'active', '2026-07-17 01:20:08', '2026-07-17 12:33:05'),
(25, 4, 7, 5, 2, 'SKU-00025', 'BR6a598348559f8', NULL, 'Toothpaste', 'toothpaste-25', '6a5a213705c66_1784291639.jpg', '', '107.94', '128.45', '0.00', '0.00', 12, 'active', '2026-07-17 01:20:08', '2026-07-17 12:33:59'),
(26, 4, 10, 2, 2, 'SKU-00026', 'BR6a59834855ccb', NULL, 'Throw Pillow', 'throw-pillow-26', '6a5a22152b1b1_1784291861.jpeg', '', '335.18', '429.03', '0.00', '0.00', 9, 'active', '2026-07-17 01:20:08', '2026-07-17 12:37:41'),
(27, 10, 6, 7, 4, 'SKU-00027', 'BR6a59834855e70', NULL, 'Wall Clock', 'wall-clock-27', '6a5a22355fe76_1784291893.webp', '', '393.34', '432.67', '0.00', '0.00', 8, 'active', '2026-07-17 01:20:08', '2026-07-17 12:38:13'),
(28, 3, 2, 1, 1, 'SKU-00028', 'BR6a59834855fd7', NULL, 'Photo Frame', 'photo-frame-28', '6a5a228de43dc_1784291981.png', '', '456.33', '634.30', '0.00', '0.00', 7, 'active', '2026-07-17 01:20:08', '2026-07-17 12:39:41'),
(29, 3, 3, 8, 2, 'SKU-00029', 'BR6a598348561e8', NULL, 'Storage Box', 'storage-box-29', '6a5a22b062aee_1784292016.webp', '', '196.39', '235.67', '0.00', '0.00', 11, 'active', '2026-07-17 01:20:08', '2026-07-17 12:40:16'),
(30, 2, 10, 7, 5, 'SKU-00030', 'BR6a59834856347', NULL, 'Area Rug', 'area-rug-30', '6a5a22e59f50d_1784292069.jpeg', '', '357.53', '396.86', '0.00', '0.00', 5, 'active', '2026-07-17 01:20:08', '2026-07-17 12:41:09'),
(31, 10, 4, 1, 5, 'SKU-00031', 'BR6a598348564aa', NULL, 'Basketball', 'basketball-31', '6a5abbfbd62b1_1784331259.jpg', '', '318.98', '354.07', '0.00', '0.00', 6, 'active', '2026-07-17 01:20:08', '2026-07-17 23:34:19'),
(32, 3, 1, 6, 3, 'SKU-00032', 'BR6a5983485660d', NULL, 'Jump Rope', 'jump-rope-32', '6a5abc319bedc_1784331313.webp', '', '74.63', '84.33', '0.00', '0.00', 10, 'active', '2026-07-17 01:20:08', '2026-07-17 23:35:13'),
(33, 9, 10, 7, 4, 'SKU-00033', 'BR6a59834856777', NULL, 'Resistance Bands', 'resistance-bands-33', '6a5abc8f7ce98_1784331407.jpeg', '', '135.82', '186.07', '0.00', '0.00', 16, 'active', '2026-07-17 01:20:08', '2026-07-17 23:36:47'),
(34, 4, 1, 6, 4, 'SKU-00034', 'BR6a598348568ee', NULL, 'Water Jug', 'water-jug-34', '6a5abcc0db6ef_1784331456.webp', '', '142.13', '179.08', '0.00', '0.00', 8, 'active', '2026-07-17 01:20:08', '2026-07-17 23:37:36'),
(35, 4, 1, 7, 4, 'SKU-00035', 'BR6a59834856a57', NULL, 'Camping Tent', 'camping-tent-35', '6a5abd11718a6_1784331537.jpeg', '', '335.70', '389.41', '0.00', '0.00', 13, 'active', '2026-07-17 01:20:08', '2026-07-17 23:38:57'),
(36, 9, 5, 8, 3, 'SKU-00036', 'BR6a59834856bbe', NULL, 'Car Charger', 'car-charger-36', '6a5abd7069b51_1784331632.jpeg', '', '132.79', '169.97', '0.00', '0.00', 14, 'active', '2026-07-17 01:20:08', '2026-07-17 23:40:32'),
(37, 9, 7, 2, 3, 'SKU-00037', 'BR6a59834856d36', NULL, 'Air Freshener', 'air-freshener-37', '6a5abecc9e616_1784331980.webp', '', '258.05', '307.08', '0.00', '0.00', 13, 'active', '2026-07-17 01:20:08', '2026-07-17 23:46:20'),
(38, 4, 1, 6, 2, 'SKU-00038', 'BR6a59834856f0a', NULL, 'Tire Inflator', 'tire-inflator-38', '6a5abef75e076_1784332023.webp', '', '430.54', '520.95', '0.00', '0.00', 12, 'active', '2026-07-17 01:20:08', '2026-07-17 23:47:03'),
(39, 3, 2, 5, 3, 'SKU-00039', 'BR6a59834857278', NULL, 'Dash Cam', 'dash-cam-39', '6a5abf21b3453_1784332065.webp', '', '66.06', '84.56', '0.00', '0.00', 13, 'active', '2026-07-17 01:20:08', '2026-07-17 23:47:45'),
(40, 9, 7, 8, 4, 'SKU-00040', 'BR6a5983485763c', NULL, 'Car Mat', 'car-mat-40', '6a5abf4fac914_1784332111.jpg', '', '326.37', '378.59', '0.00', '0.00', 20, 'active', '2026-07-17 01:20:08', '2026-07-17 23:48:31'),
(41, 10, 3, 5, 3, 'SKU-00041', 'BR6a598348577af', NULL, 'Novel', 'novel-41', '6a5abf94061c4_1784332180.jpeg', '', '338.42', '402.72', '0.00', '0.00', 17, 'active', '2026-07-17 01:20:08', '2026-07-17 23:49:40'),
(42, 2, 5, 1, 4, 'SKU-00042', 'BR6a5983485791b', NULL, 'Cookbook', 'cookbook-42', '6a5abfd33fea5_1784332243.jpg', '', '308.61', '388.85', '0.00', '0.00', 20, 'active', '2026-07-17 01:20:08', '2026-07-17 23:50:43'),
(43, 6, 5, 5, 1, 'SKU-00043', 'BR6a59834857a76', NULL, 'Wall Art Print', 'wall-art-print-43', '6a5ac01d28a46_1784332317.jpeg', '', '490.71', '662.46', '0.00', '0.00', 6, 'active', '2026-07-17 01:20:08', '2026-07-17 23:51:57'),
(44, 7, 6, 7, 4, 'SKU-00044', 'BR6a59834857bb9', NULL, 'Journal', 'journal-44', '6a5ac0672ef45_1784332391.jpg', '', '209.44', '261.80', '0.00', '0.00', 6, 'active', '2026-07-17 01:20:08', '2026-07-17 23:53:11'),
(45, 8, 7, 8, 3, 'SKU-00045', 'BR6a59834857ddc', NULL, 'Pen Set', 'pen-set-45', '6a5ac09c69c3f_1784332444.jpg', '', '403.12', '520.02', '0.00', '0.00', 12, 'active', '2026-07-17 01:20:08', '2026-07-17 23:54:04'),
(46, 7, 3, 3, 3, 'SKU-00046', 'BR6a59834857f34', NULL, 'Board Game', 'board-game-46', '6a5ac0f8137fb_1784332536.jpg', '', '175.82', '239.12', '0.00', '0.00', 14, 'active', '2026-07-17 01:20:08', '2026-07-17 23:55:36'),
(47, 9, 4, 3, 5, 'SKU-00047', 'BR6a59834858170', NULL, 'Puzzle Set', 'puzzle-set-47', '6a5ac12b80f97_1784332587.jpeg', '', '294.91', '362.74', '0.00', '0.00', 7, 'active', '2026-07-17 01:20:08', '2026-07-17 23:56:27'),
(48, 3, 6, 2, 3, 'SKU-00048', 'BR6a59834858329', NULL, 'Action Figure', 'action-figure-48', '6a5ac17529175_1784332661.jpg', '', '82.34', '93.04', '0.00', '0.00', 14, 'active', '2026-07-17 01:20:08', '2026-07-17 23:57:41'),
(49, 8, 1, 5, 1, 'SKU-00049', 'BR6a59834858559', NULL, 'Building Blocks', 'building-blocks-49', '6a5ac1aa6a9f3_1784332714.jpg', '', '483.81', '556.38', '0.00', '0.00', 14, 'active', '2026-07-17 01:20:08', '2026-07-17 23:58:34'),
(50, 1, 2, 1, 4, 'SKU-00050', 'BR6a59834858706', NULL, 'Remote Car', 'remote-car-50', '6a5ac1d813b1f_1784332760.jpg', '', '350.25', '469.34', '0.00', '0.00', 13, 'active', '2026-07-17 01:20:08', '2026-07-17 23:59:20'),
(51, 1, 4, 1, 1, 'SKU-234234', '12345678', NULL, 'Bosch GLL100 Self-Leveling Cross-Line Laser', 'bosch-gll100-self-leveling-cross-line-laser-51', '6a59932181d85_1784255265.jpeg', 'Bosch GLL100 Self-Leveling Cross-Line Laser updated', '200.00', '210.00', '1.00', '1.00', 1, 'active', '2026-07-17 02:27:45', '2026-07-17 02:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `purchase_price` decimal(15,2) DEFAULT '0.00',
  `tax` decimal(15,2) DEFAULT '0.00',
  `discount` decimal(15,2) DEFAULT '0.00',
  `total` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`id`, `purchase_order_id`, `product_id`, `quantity`, `purchase_price`, `tax`, `discount`, `total`) VALUES
(1, 1, 5, 9, '7.80', '0.00', '0.00', '70.20'),
(2, 1, 20, 32, '37.64', '0.00', '0.00', '1204.48'),
(3, 1, 3, 8, '46.13', '0.00', '0.00', '369.04'),
(4, 1, 47, 36, '27.17', '0.00', '0.00', '978.12'),
(5, 2, 29, 10, '15.42', '0.00', '0.00', '154.20'),
(6, 2, 10, 40, '31.99', '0.00', '0.00', '1279.60'),
(7, 2, 14, 5, '18.46', '0.00', '0.00', '92.30'),
(8, 2, 10, 25, '7.51', '0.00', '0.00', '187.75'),
(9, 3, 47, 40, '37.38', '0.00', '0.00', '1495.20'),
(10, 3, 21, 20, '9.42', '0.00', '0.00', '188.40'),
(11, 3, 34, 23, '17.49', '0.00', '0.00', '402.27'),
(12, 3, 8, 39, '9.83', '0.00', '0.00', '383.37'),
(13, 4, 14, 36, '24.93', '0.00', '0.00', '897.48'),
(14, 4, 6, 34, '9.51', '0.00', '0.00', '323.34'),
(15, 4, 29, 48, '15.81', '0.00', '0.00', '758.88'),
(16, 4, 47, 13, '37.10', '0.00', '0.00', '482.30'),
(17, 5, 10, 33, '35.23', '0.00', '0.00', '1162.59'),
(18, 5, 16, 9, '20.68', '0.00', '0.00', '186.12'),
(19, 5, 31, 11, '44.92', '0.00', '0.00', '494.12'),
(20, 5, 49, 34, '7.19', '0.00', '0.00', '244.46'),
(21, 5, 43, 9, '44.29', '0.00', '0.00', '398.61'),
(22, 6, 7, 21, '28.28', '0.00', '0.00', '593.88'),
(23, 6, 27, 40, '44.38', '0.00', '0.00', '1775.20'),
(24, 6, 8, 44, '5.98', '0.00', '0.00', '263.12'),
(25, 7, 32, 7, '11.08', '0.00', '0.00', '77.56'),
(26, 7, 36, 38, '34.87', '0.00', '0.00', '1325.06'),
(27, 7, 7, 49, '25.22', '0.00', '0.00', '1235.78'),
(28, 7, 30, 7, '38.28', '0.00', '0.00', '267.96'),
(29, 7, 23, 45, '35.78', '0.00', '0.00', '1610.10'),
(30, 8, 46, 16, '37.25', '0.00', '0.00', '596.00'),
(31, 8, 10, 9, '46.82', '0.00', '0.00', '421.38'),
(32, 8, 48, 14, '46.96', '0.00', '0.00', '657.44'),
(33, 8, 46, 25, '13.80', '0.00', '0.00', '345.00'),
(34, 9, 6, 27, '31.16', '0.00', '0.00', '841.32'),
(35, 9, 19, 25, '13.06', '0.00', '0.00', '326.50'),
(36, 9, 13, 44, '19.94', '0.00', '0.00', '877.36'),
(37, 9, 29, 49, '35.03', '0.00', '0.00', '1716.47'),
(38, 9, 18, 10, '46.61', '0.00', '0.00', '466.10'),
(47, 11, 4, 1, '387.20', '0.00', '0.00', '387.20'),
(48, 11, 6, 3, '84.11', '0.00', '0.00', '252.33'),
(49, 11, 7, 1, '151.48', '0.00', '0.00', '151.48'),
(50, 10, 17, 20, '6.68', '0.00', '0.00', '133.60'),
(51, 10, 23, 9, '20.66', '0.00', '0.00', '185.94'),
(52, 10, 33, 21, '10.16', '0.00', '0.00', '213.36'),
(53, 10, 2, 8, '284.58', '0.00', '0.00', '2276.64');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `subtotal` decimal(15,2) DEFAULT '0.00',
  `tax` decimal(15,2) DEFAULT '0.00',
  `discount` decimal(15,2) DEFAULT '0.00',
  `shipping_cost` decimal(15,2) DEFAULT '0.00',
  `total` decimal(15,2) DEFAULT '0.00',
  `paid_amount` decimal(15,2) DEFAULT '0.00',
  `due_amount` decimal(15,2) DEFAULT '0.00',
  `payment_status` enum('Paid','Unpaid','Partial') DEFAULT 'Unpaid',
  `status` enum('pending','approved','completed','cancelled') DEFAULT 'pending',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `supplier_id`, `warehouse_id`, `user_id`, `invoice_no`, `purchase_date`, `subtotal`, `tax`, `discount`, `shipping_cost`, `total`, `paid_amount`, `due_amount`, `payment_status`, `status`, `notes`, `created_at`) VALUES
(1, 4, 3, 1, 'PO-20260716-0001', '2026-07-16', '423.69', '50.84', '0.00', '0.00', '474.53', '161.34', '313.19', 'Partial', 'approved', NULL, '2026-07-17 01:20:08'),
(2, 5, 1, 1, 'PO-20260715-0002', '2026-07-15', '701.25', '84.15', '0.00', '0.00', '785.40', '188.50', '596.90', 'Partial', 'pending', NULL, '2026-07-17 01:20:08'),
(3, 5, 3, 1, 'PO-20260714-0003', '2026-07-14', '52.10', '6.25', '0.00', '0.00', '58.35', '58.35', '0.00', 'Paid', 'completed', NULL, '2026-07-17 01:20:08'),
(4, 2, 1, 1, 'PO-20260713-0004', '2026-07-13', '169.02', '20.28', '0.00', '0.00', '189.30', '168.48', '20.82', 'Partial', 'approved', NULL, '2026-07-17 01:20:08'),
(5, 2, 3, 1, 'PO-20260712-0005', '2026-07-12', '634.79', '76.17', '0.00', '0.00', '710.96', '376.81', '334.15', 'Partial', 'pending', NULL, '2026-07-17 01:20:08'),
(6, 4, 3, 1, 'PO-20260711-0006', '2026-07-11', '249.29', '29.91', '0.00', '0.00', '279.20', '279.20', '0.00', 'Paid', 'completed', NULL, '2026-07-17 01:20:08'),
(7, 1, 2, 1, 'PO-20260710-0007', '2026-07-10', '50.05', '6.01', '0.00', '0.00', '56.06', '7.29', '48.77', 'Partial', 'approved', NULL, '2026-07-17 01:20:08'),
(8, 5, 3, 1, 'PO-20260709-0008', '2026-07-09', '645.55', '77.47', '0.00', '0.00', '723.02', '231.37', '491.65', 'Partial', 'pending', NULL, '2026-07-17 01:20:08'),
(9, 2, 3, 1, 'PO-20260708-0009', '2026-07-08', '496.53', '59.58', '0.00', '0.00', '556.11', '556.11', '0.00', 'Paid', 'completed', NULL, '2026-07-17 01:20:08'),
(10, 4, 2, 1, 'PO-20260707-0010', '2026-07-07', '2276.64', '0.00', '0.00', '0.00', '2276.64', '362.84', '1913.80', 'Partial', 'approved', '', '2026-07-17 01:20:08'),
(11, 2, 1, 1, 'PO-20260720-EB818E', '2026-07-20', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Paid', 'completed', '', '2026-07-20 13:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Full system access', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(2, 'Manager', 'Management level access', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 'Staff', 'Limited staff access', '2026-07-17 01:20:08', '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33);

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `selling_price` decimal(15,2) DEFAULT '0.00',
  `discount` decimal(15,2) DEFAULT '0.00',
  `tax` decimal(15,2) DEFAULT '0.00',
  `total` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`id`, `sales_order_id`, `product_id`, `quantity`, `selling_price`, `discount`, `tax`, `total`) VALUES
(1, 1, 23, 1, '21.28', '0.00', '0.00', '21.28'),
(2, 1, 19, 10, '74.01', '0.00', '0.00', '740.10'),
(3, 2, 25, 8, '40.07', '0.00', '0.00', '320.56'),
(4, 2, 36, 9, '20.66', '0.00', '0.00', '185.94'),
(5, 2, 29, 3, '28.65', '0.00', '0.00', '85.95'),
(6, 3, 8, 10, '73.34', '0.00', '0.00', '733.40'),
(7, 3, 30, 1, '80.57', '0.00', '0.00', '80.57'),
(8, 3, 44, 7, '32.46', '0.00', '0.00', '227.22'),
(9, 4, 35, 10, '67.36', '0.00', '0.00', '673.60'),
(10, 4, 36, 4, '33.91', '0.00', '0.00', '135.64'),
(11, 5, 24, 9, '38.64', '0.00', '0.00', '347.76'),
(12, 5, 36, 5, '94.35', '0.00', '0.00', '471.75'),
(13, 5, 1, 4, '31.36', '0.00', '0.00', '125.44'),
(14, 6, 22, 8, '95.19', '0.00', '0.00', '761.52'),
(15, 6, 32, 2, '85.44', '0.00', '0.00', '170.88'),
(16, 6, 44, 6, '97.12', '0.00', '0.00', '582.72'),
(17, 6, 41, 7, '52.68', '0.00', '0.00', '368.76'),
(18, 7, 25, 6, '59.43', '0.00', '0.00', '356.58'),
(19, 7, 32, 6, '75.27', '0.00', '0.00', '451.62'),
(26, 10, 38, 10, '11.19', '0.00', '0.00', '111.90'),
(27, 10, 4, 3, '94.41', '0.00', '0.00', '283.23'),
(28, 10, 26, 10, '27.10', '0.00', '0.00', '271.00'),
(29, 10, 47, 6, '54.18', '0.00', '0.00', '325.08'),
(30, 11, 1, 1, '497.84', '0.00', '0.00', '497.84'),
(31, 12, 2, 1, '392.72', '0.00', '0.00', '392.72'),
(32, 12, 3, 1, '192.80', '0.00', '0.00', '192.80'),
(33, 12, 4, 1, '429.79', '0.00', '0.00', '429.79'),
(34, 13, 5, 1, '240.14', '0.00', '0.00', '240.14'),
(35, 14, 1, 1, '497.84', '0.00', '0.00', '497.84'),
(36, 14, 15, 1, '520.31', '0.00', '0.00', '520.31'),
(37, 14, 51, 1, '210.00', '0.00', '0.00', '210.00'),
(38, 14, 12, 1, '311.49', '0.00', '0.00', '311.49'),
(39, 9, 43, 6, '71.61', '0.00', '0.00', '429.66'),
(40, 9, 10, 3, '26.50', '0.00', '0.00', '79.50'),
(41, 9, 24, 7, '81.42', '0.00', '0.00', '569.94'),
(42, 9, 5, 1, '240.14', '0.00', '0.00', '240.14'),
(43, 15, 2, 1, '392.72', '0.00', '0.00', '392.72'),
(44, 16, 1, 1, '497.84', '0.00', '0.00', '497.84'),
(45, 17, 2, 1, '392.72', '0.00', '0.00', '392.72'),
(46, 17, 3, 1, '192.80', '0.00', '0.00', '192.80'),
(47, 17, 4, 1, '429.79', '0.00', '0.00', '429.79'),
(48, 17, 5, 1, '240.14', '0.00', '0.00', '240.14'),
(49, 17, 6, 1, '95.04', '0.00', '0.00', '95.04'),
(50, 17, 7, 1, '212.07', '0.00', '0.00', '212.07'),
(51, 17, 8, 1, '145.22', '0.00', '0.00', '145.22');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `sale_date` date NOT NULL,
  `subtotal` decimal(15,2) DEFAULT '0.00',
  `tax` decimal(15,2) DEFAULT '0.00',
  `discount` decimal(15,2) DEFAULT '0.00',
  `shipping_cost` decimal(15,2) DEFAULT '0.00',
  `total` decimal(15,2) DEFAULT '0.00',
  `paid_amount` decimal(15,2) DEFAULT '0.00',
  `due_amount` decimal(15,2) DEFAULT '0.00',
  `payment_status` enum('Paid','Unpaid','Partial') DEFAULT 'Unpaid',
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `customer_id`, `warehouse_id`, `user_id`, `invoice_no`, `sale_date`, `subtotal`, `tax`, `discount`, `shipping_cost`, `total`, `paid_amount`, `due_amount`, `payment_status`, `status`, `notes`, `created_at`) VALUES
(1, 15, 3, 1, 'SALE-20260716-0001', '2026-07-16', '658.53', '79.02', '0.00', '0.00', '737.55', '523.66', '213.89', 'Partial', 'completed', NULL, '2026-07-17 01:20:08'),
(2, 6, 2, 1, 'SALE-20260715-0002', '2026-07-15', '322.84', '38.74', '0.00', '0.00', '361.58', '361.58', '0.00', 'Paid', 'completed', NULL, '2026-07-17 01:20:08'),
(3, 11, 2, 1, 'SALE-20260714-0003', '2026-07-14', '795.15', '95.42', '0.00', '0.00', '890.57', '543.25', '347.32', 'Partial', 'completed', NULL, '2026-07-17 01:20:08'),
(4, 9, 2, 1, 'SALE-20260713-0004', '2026-07-13', '138.70', '16.64', '0.00', '0.00', '155.34', '155.34', '0.00', 'Paid', 'cancelled', NULL, '2026-07-17 01:20:08'),
(5, 20, 2, 1, 'SALE-20260712-0005', '2026-07-12', '396.24', '47.55', '0.00', '0.00', '443.79', '430.48', '13.31', 'Partial', 'completed', NULL, '2026-07-17 01:20:08'),
(6, 13, 3, 1, 'SALE-20260711-0006', '2026-07-11', '378.98', '45.48', '0.00', '0.00', '424.46', '424.46', '0.00', 'Paid', 'completed', NULL, '2026-07-17 01:20:08'),
(7, 9, 1, 1, 'SALE-20260710-0007', '2026-07-10', '37.07', '4.45', '0.00', '0.00', '41.52', '20.76', '20.76', 'Partial', 'completed', NULL, '2026-07-17 01:20:08'),
(9, 2, 3, 1, 'SALE-20260708-0009', '2026-07-08', '240.14', '28.82', '0.00', '0.00', '268.96', '151.47', '117.49', 'Partial', 'completed', '', '2026-07-17 01:20:08'),
(10, 3, 3, 1, 'SALE-20260707-0010', '2026-07-07', '388.57', '46.63', '0.00', '0.00', '435.20', '435.20', '0.00', 'Paid', 'completed', NULL, '2026-07-17 01:20:08'),
(11, 1, 1, 1, 'SALE-20260721-7D831E', '2026-07-21', '497.84', '59.74', '0.00', '0.00', '557.58', '1000.00', '-442.42', 'Paid', 'completed', '', '2026-07-21 00:01:43'),
(12, 2, 1, 1, 'SALE-20260721-460CB3', '2026-07-21', '1015.31', '121.84', '0.00', '0.00', '1137.15', '2000.00', '-862.85', 'Paid', 'completed', '', '2026-07-21 00:03:00'),
(13, 3, 1, 1, 'SALE-20260721-29948C', '2026-07-21', '240.14', '28.82', '0.00', '0.00', '268.96', '600.00', '-331.04', 'Paid', 'completed', '', '2026-07-21 00:04:02'),
(14, 2, 1, 1, 'SALE-20260721-DE058F', '2026-07-21', '1539.64', '184.76', '0.00', '0.00', '1724.40', '2000.00', '-275.60', 'Paid', 'completed', '', '2026-07-21 12:32:29'),
(15, 2, 1, 1, 'SALE-20260721-43A88D', '2026-07-21', '392.72', '47.13', '0.00', '0.00', '439.85', '439.85', '0.00', 'Paid', 'pending', '', '2026-07-21 12:35:32'),
(16, 5, 1, 1, 'SALE-20260724-9B7D90', '2026-07-24', '497.84', '59.74', '0.00', '0.00', '557.58', '600.00', '-42.42', 'Paid', 'completed', '', '2026-07-23 22:49:29'),
(17, 21, 1, 1, 'SALE-20260724-D47F06', '2026-07-24', '1707.78', '204.93', '0.00', '0.00', '1912.71', '2000.00', '-87.29', 'Paid', 'completed', '', '2026-07-23 22:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) DEFAULT 'Inventory Management System',
  `company_logo` varchar(255) DEFAULT 'logo.png',
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `currency` varchar(10) DEFAULT '₱',
  `tax_rate` decimal(5,2) DEFAULT '12.00',
  `timezone` varchar(50) DEFAULT 'Asia/Manila',
  `invoice_prefix` varchar(20) DEFAULT 'INV-',
  `low_stock_limit` int(11) DEFAULT '10',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_logo`, `email`, `phone`, `address`, `currency`, `tax_rate`, `timezone`, `invoice_prefix`, `low_stock_limit`, `updated_at`) VALUES
(1, 'Inventory Management System', 'logo.png', 'admin@inventorysystem.com', '0281234567', '123 Business Center, Manila, Philippines', '₱', '12.00', 'Asia/Manila', 'INV-', 10, '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adjustment_date` date NOT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `remarks` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_adjustments`
--

INSERT INTO `stock_adjustments` (`id`, `warehouse_id`, `user_id`, `adjustment_date`, `reason`, `remarks`, `created_at`) VALUES
(1, 1, 1, '2026-07-21', '', '', '2026-07-21 13:05:10'),
(2, 1, 1, '2026-07-21', '', '', '2026-07-21 13:05:40'),
(3, 1, 1, '2026-07-21', '', '', '2026-07-21 13:08:16'),
(4, 1, 1, '2026-07-21', '', '', '2026-07-21 13:09:11'),
(5, 1, 1, '2026-07-22', '', '', '2026-07-22 02:25:01'),
(6, 1, 1, '2026-07-22', '', '', '2026-07-22 02:50:42'),
(7, 1, 1, '2026-07-22', '', '', '2026-07-22 12:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_items`
--

CREATE TABLE `stock_adjustment_items` (
  `id` int(11) NOT NULL,
  `stock_adjustment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `old_quantity` int(11) DEFAULT '0',
  `new_quantity` int(11) DEFAULT '0',
  `difference` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_adjustment_items`
--

INSERT INTO `stock_adjustment_items` (`id`, `stock_adjustment_id`, `product_id`, `old_quantity`, `new_quantity`, `difference`) VALUES
(1, 3, 1, 430, NULL, -430),
(2, 4, 1, NULL, NULL, 0),
(3, 5, 1, NULL, NULL, 0),
(4, 6, 1, NULL, 951, 951),
(5, 7, 1, 951, 100, -851),
(6, 7, 2, 430, 100, -330);

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference_type` varchar(50) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `movement_type` enum('purchase','sale','return','adjustment','transfer_in','transfer_out','damage','opening_stock') NOT NULL,
  `quantity` int(11) NOT NULL,
  `balance_after` int(11) DEFAULT '0',
  `remarks` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_movements`
--

INSERT INTO `stock_movements` (`id`, `product_id`, `warehouse_id`, `user_id`, `reference_type`, `reference_id`, `movement_type`, `quantity`, `balance_after`, `remarks`, `created_at`) VALUES
(1, 4, 1, 1, 'purchase', 11, 'purchase', 1, 0, 'Purchase order #PO-20260720-EB818E', '2026-07-20 13:00:30'),
(2, 6, 1, 1, 'purchase', 11, 'purchase', 3, 0, 'Purchase order #PO-20260720-EB818E', '2026-07-20 13:00:30'),
(3, 1, 1, 1, 'sale', 11, 'sale', -1, 0, 'Sale #SALE-20260721-7D831E', '2026-07-21 00:01:43'),
(4, 2, 1, 1, 'sale', 12, 'sale', -1, 0, 'Sale #SALE-20260721-460CB3', '2026-07-21 00:03:00'),
(5, 3, 1, 1, 'sale', 12, 'sale', -1, 0, 'Sale #SALE-20260721-460CB3', '2026-07-21 00:03:00'),
(6, 4, 1, 1, 'sale', 12, 'sale', -1, 0, 'Sale #SALE-20260721-460CB3', '2026-07-21 00:03:00'),
(7, 5, 1, 1, 'sale', 13, 'sale', -1, 0, 'Sale #SALE-20260721-29948C', '2026-07-21 00:04:02'),
(8, 1, 1, 1, 'sale', 14, 'sale', -1, 0, 'Sale #SALE-20260721-DE058F', '2026-07-21 12:32:29'),
(9, 15, 1, 1, 'sale', 14, 'sale', -1, 0, 'Sale #SALE-20260721-DE058F', '2026-07-21 12:32:29'),
(10, 51, 1, 1, 'sale', 14, 'sale', -1, 0, 'Sale #SALE-20260721-DE058F', '2026-07-21 12:32:29'),
(11, 12, 1, 1, 'sale', 14, 'sale', -1, 0, 'Sale #SALE-20260721-DE058F', '2026-07-21 12:32:29'),
(12, 2, 1, 1, 'sale', 15, 'sale', -1, 0, 'Sale #SALE-20260721-43A88D', '2026-07-21 12:35:32'),
(13, 1, 1, 1, 'adjustment', NULL, 'purchase', 100, 0, '', '2026-07-21 12:57:51'),
(14, 1, 1, 1, 'adjustment', NULL, 'sale', -100, 0, '', '2026-07-21 13:00:30'),
(15, 1, 1, 1, 'adjustment', NULL, 'sale', -100, 0, '', '2026-07-21 13:01:07'),
(16, 1, 1, 1, 'adjustment', NULL, 'purchase', 100, 0, '', '2026-07-21 13:02:27'),
(17, 1, 1, 1, 'adjustment', 3, 'adjustment', -430, 0, 'Stock adjustment', '2026-07-21 13:08:16'),
(18, 1, 1, 1, 'adjustment', 4, 'adjustment', 0, 0, 'Stock adjustment', '2026-07-21 13:09:11'),
(19, 1, 1, 1, 'adjustment', 5, 'adjustment', 0, 0, 'Stock adjustment', '2026-07-22 02:25:01'),
(20, 1, 1, 1, 'adjustment', 6, 'adjustment', 951, 0, 'Stock adjustment', '2026-07-22 02:50:42'),
(21, 1, 1, 1, 'adjustment', 7, 'adjustment', -851, 0, 'Stock adjustment', '2026-07-22 12:28:11'),
(22, 2, 1, 1, 'adjustment', 7, 'adjustment', -330, 0, 'Stock adjustment', '2026-07-22 12:28:11'),
(23, 1, 1, 1, 'transfer', 1, 'transfer_out', -50, 0, 'Transfer to #TRF-20260722-E5BB77', '2026-07-22 12:37:50'),
(24, 1, 2, 1, 'transfer', 1, 'transfer_in', 50, 0, 'Transfer from #TRF-20260722-E5BB77', '2026-07-22 12:37:50'),
(25, 1, 1, 1, 'transfer', 2, 'transfer_out', -10, 0, 'Transfer to #TRF-20260722-A1886C', '2026-07-22 12:43:22'),
(26, 1, 2, 1, 'transfer', 2, 'transfer_in', 10, 0, 'Transfer from #TRF-20260722-A1886C', '2026-07-22 12:43:22'),
(27, 1, 1, 1, 'sale', 16, 'sale', -1, 0, 'Sale #SALE-20260724-9B7D90', '2026-07-23 22:49:29'),
(28, 2, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05'),
(29, 3, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05'),
(30, 4, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05'),
(31, 5, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05'),
(32, 6, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05'),
(33, 7, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05'),
(34, 8, 1, 1, 'sale', 17, 'sale', -1, 0, 'Sale #SALE-20260724-D47F06', '2026-07-23 22:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Philippines',
  `tax_number` varchar(50) DEFAULT NULL,
  `balance` decimal(15,2) DEFAULT '0.00',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `contact_person`, `email`, `phone`, `address`, `city`, `country`, `tax_number`, `balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TechSource Inc.', 'Carlos Mendoza', 'carlos@techsource.com', '09171234567', 'Tech City', 'Manila', 'Philippines', '123-456-789', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(2, 'Global Traders Co.', 'Anna Lopez', 'anna@globaltraders.com', '09181234567', 'Commerce Ave', 'Cebu', 'Philippines', '987-654-321', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 'Prime Distributors', 'Miguel Torres', 'miguel@primedist.com', '09191234567', 'Trade St', 'Makati', 'Philippines', '456-789-123', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(4, 'United Supplies', 'Sofia Garcia', 'sofia@unitedsupplies.com', '09201234567', 'Supply Lane', 'Manila', 'Philippines', '321-654-987', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(5, 'Pacific Goods Inc.', 'Luis Santos', 'luis@pacificgoods.com', '09211234567', 'Pacific Ave', 'Davao', 'Philippines', '654-321-789', '0.00', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` int(11) NOT NULL,
  `from_warehouse_id` int(11) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `transfer_no` varchar(50) NOT NULL,
  `transfer_date` date NOT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `from_warehouse_id`, `to_warehouse_id`, `transfer_no`, `transfer_date`, `status`, `notes`, `created_at`) VALUES
(1, 1, 2, 'TRF-20260722-E5BB77', '2026-07-22', 'completed', '', '2026-07-22 12:37:50'),
(2, 1, 2, 'TRF-20260722-A1886C', '2026-07-22', 'completed', '', '2026-07-22 12:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_items`
--

CREATE TABLE `transfer_items` (
  `id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transfer_items`
--

INSERT INTO `transfer_items` (`id`, `transfer_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 50),
(2, 2, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `short_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Piece', 'pc', 'Individual item', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(2, 'Box', 'box', 'Box of items', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 'Kilogram', 'kg', 'Weight in kilograms', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(4, 'Gram', 'g', 'Weight in grams', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(5, 'Liter', 'L', 'Volume in liters', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(6, 'Meter', 'm', 'Length in meters', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(7, 'Pack', 'pack', 'Pack of items', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(8, 'Dozen', 'dz', '12 pieces', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(9, 'Set', 'set', 'Set of items', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(10, 'Pair', 'pr', 'Pair of items', '2026-07-17 01:20:08', '2026-07-17 01:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'default.png',
  `address` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `avatar`, `address`, `status`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'System', 'Admin', 'admin', 'admin@example.com', '$2y$10$XAU.bFwW01TNs0mxVJQA0uJBA0Fc4mKEk9fvNMwN47Ar55ao8Z5Kq', '09123456789', '6a5e13dc88770_1784550364.jpeg', '', 'active', '2026-07-24 06:56:51', NULL, '2026-07-17 01:20:08', '2026-07-23 22:56:51'),
(2, 2, 'John', 'Manager', 'manager', 'manager@example.com', '$2y$10$XAU.bFwW01TNs0mxVJQA0uJBA0Fc4mKEk9fvNMwN47Ar55ao8Z5Kq', '09123456788', 'default.png', NULL, 'active', NULL, NULL, '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 3, 'Jane', 'Staff', 'staff', 'staff@example.com', '$2y$10$XAU.bFwW01TNs0mxVJQA0uJBA0Fc4mKEk9fvNMwN47Ar55ao8Z5Kq', '09123456787', 'default.png', NULL, 'active', '2026-07-23 10:52:41', NULL, '2026-07-17 01:20:08', '2026-07-23 02:52:41'),
(4, 1, 'Catlin ', 'Ednalan', 'catlin', 'catlin@test.com', '$2y$10$rRefW6RNtw9okThu0HVV5ua4MKKlX/orgUxGaA/VWNb0BUhxy5ncu', '57567567', '6a61817a99714_1784775034.jpeg', 'olongapo city', 'active', NULL, NULL, '2026-07-23 02:50:34', '2026-07-23 02:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Philippines',
  `phone` varchar(20) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `code`, `address`, `city`, `country`, `phone`, `manager`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Main Warehouse', 'WH-001', '123 Main St', 'Olongapo', 'Philippines', '028123456', 'Juan Dela Cruz', 'active', '2026-07-17 01:20:08', '2026-07-22 12:45:12'),
(2, 'Secondary Warehouse', 'WH-002', '456 Oak Ave', 'Cebu City', 'Philippines', '032123456', 'Maria Santos', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08'),
(3, 'North Distribution', 'WH-003', '789 Pine Rd', 'Quezon City', 'Philippines', '028654321', 'Pedro Reyes', 'active', '2026-07-17 01:20:08', '2026-07-17 01:20:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_code` (`customer_code`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_category_id` (`expense_category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_product_warehouse` (`product_id`,`warehouse_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_id` (`purchase_order_id`),
  ADD KEY `sales_order_id` (`sales_order_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_id` (`purchase_order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_order_id` (`sales_order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stock_adjustment_items`
--
ALTER TABLE `stock_adjustment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustment_id` (`stock_adjustment_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfer_no` (`transfer_no`),
  ADD KEY `from_warehouse_id` (`from_warehouse_id`),
  ADD KEY `to_warehouse_id` (`to_warehouse_id`);

--
-- Indexes for table `transfer_items`
--
ALTER TABLE `transfer_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfer_id` (`transfer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_adjustment_items`
--
ALTER TABLE `stock_adjustment_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfer_items`
--
ALTER TABLE `transfer_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD CONSTRAINT `login_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_ibfk_1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `purchase_orders_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `purchase_orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD CONSTRAINT `sales_items_ibfk_1` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD CONSTRAINT `sales_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_orders_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `sales_orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD CONSTRAINT `stock_adjustments_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `stock_adjustments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stock_adjustment_items`
--
ALTER TABLE `stock_adjustment_items`
  ADD CONSTRAINT `stock_adjustment_items_ibfk_1` FOREIGN KEY (`stock_adjustment_id`) REFERENCES `stock_adjustments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustment_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_movements_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `stock_movements_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`from_warehouse_id`) REFERENCES `warehouses` (`id`),
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`to_warehouse_id`) REFERENCES `warehouses` (`id`);

--
-- Constraints for table `transfer_items`
--
ALTER TABLE `transfer_items`
  ADD CONSTRAINT `transfer_items_ibfk_1` FOREIGN KEY (`transfer_id`) REFERENCES `transfers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfer_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
