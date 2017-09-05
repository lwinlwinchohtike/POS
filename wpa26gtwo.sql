-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2017 at 10:35 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpa26gtwo`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Foods', 0, '2017-08-18 04:49:08', '2017-08-18 05:54:05'),
(2, 'Drinks', 0, '2017-08-18 05:09:50', '2017-08-18 05:54:01'),
(3, 'Snacks', 0, '2017-08-18 05:53:54', '2017-08-18 06:06:03'),
(4, 'Fruits', 0, '2017-08-18 05:56:50', '2017-08-18 06:19:11'),
(5, 'Coffee', 0, '2017-08-18 05:56:59', '2017-08-18 07:37:07'),
(6, 'Stationery', 0, '2017-08-18 05:59:02', '2017-08-18 06:19:41'),
(7, 'Hair-Care', 0, '2017-08-18 05:59:41', '2017-08-18 05:59:41'),
(8, 'Skin-Care', 0, '2017-08-18 06:01:25', '2017-08-18 06:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phonenumber`, `photo`, `address`, `company_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Walk in Customer', 'customer@gmail.com', '000000000', NULL, 'No.1, Ygn.', 'A', 0, '2017-08-18 04:49:09', '2017-08-18 05:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `in_out_qty` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_id`, `user_id`, `in_out_qty`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100, 'Add Qty from Product', '2017-08-18 04:54:34', '2017-08-18 04:54:34'),
(2, 1, 1, 0, 'Edit Qty from Product', '2017-08-18 04:54:50', '2017-08-18 04:54:50'),
(3, 2, 1, 100, 'Add Qty from Product', '2017-08-18 04:55:30', '2017-08-18 04:55:30'),
(4, 2, 1, 0, 'Edit Qty from Product', '2017-08-18 04:55:44', '2017-08-18 04:55:44'),
(5, 1, 1, 0, 'Edit Qty from Product', '2017-08-18 08:18:11', '2017-08-18 08:18:11'),
(6, 3, 1, 100, 'Add Qty from Product', '2017-08-18 08:20:18', '2017-08-18 08:20:18'),
(7, 4, 1, 100, 'Add Qty from Product', '2017-08-18 08:23:14', '2017-08-18 08:23:14'),
(8, 5, 1, 100, 'Add Qty from Product', '2017-08-18 08:24:06', '2017-08-18 08:24:06'),
(9, 6, 1, 100, 'Add Qty from Product', '2017-08-18 08:25:14', '2017-08-18 08:25:14'),
(10, 7, 1, 100, 'Add Qty from Product', '2017-08-18 08:26:34', '2017-08-18 08:26:34'),
(11, 8, 1, 100, 'Add Qty from Product', '2017-08-18 08:27:19', '2017-08-18 08:27:19'),
(12, 9, 1, 100, 'Add Qty from Product', '2017-08-18 08:28:53', '2017-08-18 08:28:53'),
(13, 10, 1, 100, 'Add Qty from Product', '2017-08-18 08:31:06', '2017-08-18 08:31:06'),
(14, 11, 1, 100, 'Add Qty from Product', '2017-08-18 08:31:45', '2017-08-18 08:31:45'),
(15, 12, 1, 100, 'Add Qty from Product', '2017-08-18 08:32:50', '2017-08-18 08:32:50'),
(16, 13, 1, 100, 'Add Qty from Product', '2017-08-18 08:35:39', '2017-08-18 08:35:39'),
(17, 14, 1, 100, 'Add Qty from Product', '2017-08-18 08:36:19', '2017-08-18 08:36:19'),
(18, 15, 1, 100, 'Add Qty from Product', '2017-08-18 08:37:50', '2017-08-18 08:37:50'),
(19, 16, 1, 100, 'Add Qty from Product', '2017-08-18 08:38:42', '2017-08-18 08:38:42'),
(20, 15, 1, 0, 'Edit Qty from Product', '2017-08-18 08:39:30', '2017-08-18 08:39:30'),
(21, 17, 1, 100, 'Add Qty from Product', '2017-08-18 08:40:25', '2017-08-18 08:40:25'),
(22, 18, 1, 100, 'Add Qty from Product', '2017-08-18 08:41:04', '2017-08-18 08:41:04'),
(23, 19, 1, 100, 'Add Qty from Product', '2017-08-18 08:44:04', '2017-08-18 08:44:04'),
(24, 20, 1, 100, 'Add Qty from Product', '2017-08-18 08:44:48', '2017-08-18 08:44:48'),
(25, 21, 1, 100, 'Add Qty from Product', '2017-08-18 08:45:30', '2017-08-18 08:45:30'),
(26, 22, 1, 100, 'Add Qty from Product', '2017-08-18 08:46:15', '2017-08-18 08:46:15'),
(27, 23, 1, 100, 'Add Qty from Product', '2017-08-18 08:46:56', '2017-08-18 08:46:56'),
(28, 24, 1, 100, 'Add Qty from Product', '2017-08-18 08:48:28', '2017-08-18 08:48:28'),
(29, 25, 1, 100, 'Add Qty from Product', '2017-08-18 08:56:50', '2017-08-18 08:56:50'),
(30, 26, 1, 100, 'Add Qty from Product', '2017-08-18 08:57:39', '2017-08-18 08:57:39'),
(31, 27, 1, 100, 'Add Qty from Product', '2017-08-18 08:58:47', '2017-08-18 08:58:47'),
(32, 28, 1, 100, 'Add Qty from Product', '2017-08-18 08:59:40', '2017-08-18 08:59:40'),
(33, 29, 1, 100, 'Add Qty from Product', '2017-08-18 09:00:24', '2017-08-18 09:00:24'),
(34, 30, 1, 100, 'Add Qty from Product', '2017-08-18 09:01:08', '2017-08-18 09:01:08'),
(35, 31, 1, 100, 'Add Qty from Product', '2017-08-18 09:03:19', '2017-08-18 09:03:19'),
(36, 32, 1, 100, 'Add Qty from Product', '2017-08-18 09:04:27', '2017-08-18 09:04:27'),
(37, 33, 1, 100, 'Add Qty from Product', '2017-08-18 09:05:18', '2017-08-18 09:05:18'),
(38, 34, 1, 100, 'Add Qty from Product', '2017-08-18 09:07:20', '2017-08-18 09:07:20'),
(39, 35, 1, 100, 'Add Qty from Product', '2017-08-18 09:07:59', '2017-08-18 09:07:59'),
(40, 36, 1, 100, 'Add Qty from Product', '2017-08-18 09:08:53', '2017-08-18 09:08:53'),
(41, 37, 1, 100, 'Add Qty from Product', '2017-08-18 09:10:33', '2017-08-18 09:10:33'),
(42, 38, 1, 100, 'Add Qty from Product', '2017-08-18 09:11:42', '2017-08-18 09:11:42'),
(43, 38, 1, 0, 'Edit Qty from Product', '2017-08-18 09:12:18', '2017-08-18 09:12:18'),
(44, 39, 1, 100, 'Add Qty from Product', '2017-08-18 09:13:29', '2017-08-18 09:13:29'),
(45, 39, 1, 0, 'Edit Qty from Product', '2017-08-18 09:14:29', '2017-08-18 09:14:29'),
(46, 1, 1, 0, 'Edit Qty from Product', '2017-08-18 09:16:09', '2017-08-18 09:16:09'),
(47, 2, 1, 0, 'Edit Qty from Product', '2017-08-18 09:20:51', '2017-08-18 09:20:51'),
(48, 2, 1, 0, 'Edit Qty from Product', '2017-08-18 09:22:52', '2017-08-18 09:22:52'),
(49, 3, 1, 0, 'Edit Qty from Product', '2017-08-18 09:23:15', '2017-08-18 09:23:15'),
(50, 3, 1, -1, 'SALE1', '2017-08-18 09:25:10', '2017-08-18 09:25:10'),
(51, 8, 1, -1, 'SALE1', '2017-08-18 09:25:10', '2017-08-18 09:25:10'),
(52, 10, 1, 100, 'PURCHASE1', '2017-08-18 09:26:59', '2017-08-18 09:26:59'),
(53, 2, 1, 100, 'PURCHASE1', '2017-08-18 09:26:59', '2017-08-18 09:26:59'),
(54, 5, 1, 100, 'PURCHASE1', '2017-08-18 09:26:59', '2017-08-18 09:26:59'),
(55, 13, 2, -1, 'SALE2', '2017-08-18 09:29:23', '2017-08-18 09:29:23'),
(56, 16, 2, -2, 'SALE2', '2017-08-18 09:29:23', '2017-08-18 09:29:23'),
(57, 7, 2, 50, 'PURCHASE2', '2017-08-18 09:30:18', '2017-08-18 09:30:18'),
(58, 10, 3, 50, 'PURCHASE3', '2017-08-18 09:31:47', '2017-08-18 09:31:47'),
(59, 27, 3, 50, 'PURCHASE3', '2017-08-18 09:31:48', '2017-08-18 09:31:48'),
(60, 22, 3, 50, 'PURCHASE4', '2017-08-18 09:32:24', '2017-08-18 09:32:24'),
(61, 14, 3, -10, 'SALE3', '2017-08-18 09:32:53', '2017-08-18 09:32:53'),
(62, 25, 3, -1, 'SALE4', '2017-08-18 09:33:32', '2017-08-18 09:33:32'),
(63, 39, 3, -1, 'SALE4', '2017-08-18 09:33:32', '2017-08-18 09:33:32'),
(64, 18, 3, -1, 'SALE4', '2017-08-18 09:33:33', '2017-08-18 09:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `retail_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_id`, `model_type`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `order_column`, `created_at`, `updated_at`) VALUES
(3, 1, 'App\\Customer', 'customers', 'customer1', 'user.png', 'image/png', 'media', 8882, '[]', '[]', 3, '2017-08-18 05:03:44', '2017-08-18 05:03:44'),
(4, 1, 'App\\Supplier', 'suppliers', 'supplier1', 'user.png', 'image/png', 'media', 8882, '[]', '[]', 4, '2017-08-18 05:06:25', '2017-08-18 05:06:25'),
(6, 4, 'App\\Product', 'products', 'product4', 'food_1.jpg', 'image/jpeg', 'media', 15175, '[]', '[]', 6, '2017-08-18 08:23:14', '2017-08-18 08:23:14'),
(7, 5, 'App\\Product', 'products', 'product5', 'food_2.jpg', 'image/jpeg', 'media', 36296, '[]', '[]', 7, '2017-08-18 08:24:06', '2017-08-18 08:24:06'),
(8, 6, 'App\\Product', 'products', 'product6', 'food_3.jpg', 'image/jpeg', 'media', 37961, '[]', '[]', 8, '2017-08-18 08:25:14', '2017-08-18 08:25:14'),
(9, 7, 'App\\Product', 'products', 'product7', 'drink_1.jpeg', 'image/jpeg', 'media', 31563, '[]', '[]', 9, '2017-08-18 08:26:34', '2017-08-18 08:26:34'),
(10, 8, 'App\\Product', 'products', 'product8', 'drink_2.jpg', 'image/jpeg', 'media', 433617, '[]', '[]', 10, '2017-08-18 08:27:19', '2017-08-18 08:27:19'),
(11, 9, 'App\\Product', 'products', 'product9', 'drink_3.jpeg', 'image/jpeg', 'media', 123118, '[]', '[]', 11, '2017-08-18 08:28:53', '2017-08-18 08:28:53'),
(12, 10, 'App\\Product', 'products', 'product10', 'drink_4.jpg', 'image/jpeg', 'media', 317828, '[]', '[]', 12, '2017-08-18 08:31:05', '2017-08-18 08:31:05'),
(13, 11, 'App\\Product', 'products', 'product11', 'drink_5.jpeg', 'image/jpeg', 'media', 36105, '[]', '[]', 13, '2017-08-18 08:31:45', '2017-08-18 08:31:45'),
(14, 12, 'App\\Product', 'products', 'product12', 'drink_6.jpeg', 'image/jpeg', 'media', 40873, '[]', '[]', 14, '2017-08-18 08:32:50', '2017-08-18 08:32:50'),
(15, 13, 'App\\Product', 'products', 'product13', 'snack_1.png', 'image/png', 'media', 163425, '[]', '[]', 15, '2017-08-18 08:35:38', '2017-08-18 08:35:38'),
(16, 14, 'App\\Product', 'products', 'product14', 'snack_2.jpeg', 'image/jpeg', 'media', 12996, '[]', '[]', 16, '2017-08-18 08:36:19', '2017-08-18 08:36:19'),
(17, 15, 'App\\Product', 'products', 'product15', 'snack_3.jpg', 'image/jpeg', 'media', 27729, '[]', '[]', 17, '2017-08-18 08:37:50', '2017-08-18 08:37:50'),
(18, 16, 'App\\Product', 'products', 'product16', 'snack_4.jpg', 'image/jpeg', 'media', 17540, '[]', '[]', 18, '2017-08-18 08:38:42', '2017-08-18 08:38:42'),
(19, 17, 'App\\Product', 'products', 'product17', 'snack_5.jpeg', 'image/jpeg', 'media', 7763, '[]', '[]', 19, '2017-08-18 08:40:24', '2017-08-18 08:40:24'),
(20, 18, 'App\\Product', 'products', 'product18', 'snack_6.png', 'image/png', 'media', 71509, '[]', '[]', 20, '2017-08-18 08:41:04', '2017-08-18 08:41:04'),
(21, 19, 'App\\Product', 'products', 'product19', 'fruit_1.png', 'image/png', 'media', 47888, '[]', '[]', 21, '2017-08-18 08:44:04', '2017-08-18 08:44:04'),
(22, 20, 'App\\Product', 'products', 'product20', 'fruit_2.jpg', 'image/jpeg', 'media', 11505, '[]', '[]', 22, '2017-08-18 08:44:48', '2017-08-18 08:44:48'),
(23, 21, 'App\\Product', 'products', 'product21', 'fruit_3', 'image/jpeg', 'media', 28698, '[]', '[]', 23, '2017-08-18 08:45:30', '2017-08-18 08:45:30'),
(24, 22, 'App\\Product', 'products', 'product22', 'fruit_4.png', 'image/png', 'media', 51830, '[]', '[]', 24, '2017-08-18 08:46:15', '2017-08-18 08:46:15'),
(25, 23, 'App\\Product', 'products', 'product23', 'fruit_5.jpg', 'image/jpeg', 'media', 405360, '[]', '[]', 25, '2017-08-18 08:46:56', '2017-08-18 08:46:56'),
(26, 24, 'App\\Product', 'products', 'product24', 'fruit_6.jpg', 'image/jpeg', 'media', 17032, '[]', '[]', 26, '2017-08-18 08:48:28', '2017-08-18 08:48:28'),
(27, 25, 'App\\Product', 'products', 'product25', 'cofe_1.jpg', 'image/jpeg', 'media', 12915, '[]', '[]', 27, '2017-08-18 08:56:50', '2017-08-18 08:56:50'),
(28, 26, 'App\\Product', 'products', 'product26', 'cofe_2.jpg', 'image/jpeg', 'media', 41389, '[]', '[]', 28, '2017-08-18 08:57:39', '2017-08-18 08:57:39'),
(29, 27, 'App\\Product', 'products', 'product27', 'cofe_3.jpeg', 'image/jpeg', 'media', 18047, '[]', '[]', 29, '2017-08-18 08:58:47', '2017-08-18 08:58:47'),
(30, 28, 'App\\Product', 'products', 'product28', 'cofe_4.jpg', 'image/jpeg', 'media', 22889, '[]', '[]', 30, '2017-08-18 08:59:40', '2017-08-18 08:59:40'),
(31, 29, 'App\\Product', 'products', 'product29', 'cofe_5.png', 'image/png', 'media', 187490, '[]', '[]', 31, '2017-08-18 09:00:24', '2017-08-18 09:00:24'),
(32, 30, 'App\\Product', 'products', 'product30', 'cofe_6.jpg', 'image/jpeg', 'media', 28917, '[]', '[]', 32, '2017-08-18 09:01:08', '2017-08-18 09:01:08'),
(33, 31, 'App\\Product', 'products', 'product31', 'st.jpg', 'image/jpeg', 'media', 56525, '[]', '[]', 33, '2017-08-18 09:03:19', '2017-08-18 09:03:19'),
(34, 32, 'App\\Product', 'products', 'product32', 'st_1.jpg', 'image/jpeg', 'media', 12047, '[]', '[]', 34, '2017-08-18 09:04:27', '2017-08-18 09:04:27'),
(35, 33, 'App\\Product', 'products', 'product33', 'st_5.jpg', 'image/jpeg', 'media', 24288, '[]', '[]', 35, '2017-08-18 09:05:18', '2017-08-18 09:05:18'),
(36, 34, 'App\\Product', 'products', 'product34', 'hc_4.jpg', 'image/jpeg', 'media', 17409, '[]', '[]', 36, '2017-08-18 09:07:20', '2017-08-18 09:07:20'),
(37, 35, 'App\\Product', 'products', 'product35', 'hc_5.jpg', 'image/jpeg', 'media', 16233, '[]', '[]', 37, '2017-08-18 09:07:59', '2017-08-18 09:07:59'),
(38, 36, 'App\\Product', 'products', 'product36', 'hc_6.jpg', 'image/jpeg', 'media', 6786, '[]', '[]', 38, '2017-08-18 09:08:53', '2017-08-18 09:08:53'),
(39, 37, 'App\\Product', 'products', 'product37', 'sc_1.jpg', 'image/jpeg', 'media', 22564, '[]', '[]', 39, '2017-08-18 09:10:33', '2017-08-18 09:10:33'),
(40, 38, 'App\\Product', 'products', 'product38', 'sc_5.jpg', 'image/jpeg', 'media', 12811, '[]', '[]', 40, '2017-08-18 09:11:42', '2017-08-18 09:11:42'),
(41, 39, 'App\\Product', 'products', 'product39', 'sc_3.jpg', 'image/jpeg', 'media', 20343, '[]', '[]', 41, '2017-08-18 09:13:29', '2017-08-18 09:13:29'),
(42, 1, 'App\\Product', 'products', 'product1', 'food_4.jpg', 'image/jpeg', 'media', 177596, '[]', '[]', 42, '2017-08-18 09:16:09', '2017-08-18 09:16:09'),
(44, 2, 'App\\Product', 'products', 'product2', 'food_7.jpg', 'image/jpeg', 'media', 87326, '[]', '[]', 43, '2017-08-18 09:22:52', '2017-08-18 09:22:52'),
(45, 3, 'App\\Product', 'products', 'product3', 'food_8.jpg', 'image/jpeg', 'media', 27659, '[]', '[]', 44, '2017-08-18 09:23:15', '2017-08-18 09:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(134, '2014_10_12_000000_create_users_table', 1),
(135, '2014_10_12_100000_create_password_resets_table', 1),
(136, '2017_05_06_121145_create_blogs_table', 1),
(137, '2017_05_27_110711_add_user_id_to_blogs', 1),
(138, '2017_05_27_120522_add_is_admin_to_users', 1),
(139, '2017_06_03_122131_create_roles_table', 1),
(140, '2017_06_03_122252_create_role_users_table', 1),
(141, '2017_06_18_043038_create_payments_table', 1),
(142, '2017_06_18_044242_create_items_table', 1),
(143, '2017_06_18_050101_create-categories-table', 1),
(144, '2017_06_18_055012_create_customers_table', 1),
(145, '2017_06_18_065306_create_suppliers_table', 1),
(146, '2017_06_21_112322_create_media_table', 1),
(147, '2017_06_22_155709_create_products_table', 1),
(148, '2017_06_24_075431_create_inventories_table', 1),
(149, '2017_06_28_094033_create_sales_table', 1),
(150, '2017_06_28_094136_create_sale_products_table', 1),
(151, '2017_07_13_102100_create_purchase_table', 1),
(152, '2017_07_13_102139_create_purchase_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 0, '2017-08-18 04:49:08', '2017-08-18 05:43:31'),
(2, 'Visa', 0, '2017-08-18 09:27:30', '2017-08-18 09:27:30'),
(3, 'Master', 0, '2017-08-18 09:27:41', '2017-08-18 09:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `retail_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `purchase_price`, `retail_price`, `quantity`, `description`, `photo`, `category_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'OREO', '0001', '400.00', '500.00', 100, 'foods', NULL, 1, 0, '2017-08-18 04:54:34', '2017-08-18 09:16:09'),
(2, 'MC-Nugget', '0002', '400.00', '500.00', 200, 'foods', NULL, 1, 0, '2017-08-18 04:55:29', '2017-08-18 09:26:59'),
(3, 'PHI-Cheese', '0003', '2500.00', '3000.00', 99, 'pizza', NULL, 1, 0, '2017-08-18 08:20:18', '2017-08-18 09:25:10'),
(4, 'SB Jam', '0004', '800.00', '1000.00', 100, 'jam', NULL, 1, 0, '2017-08-18 08:23:14', '2017-08-18 08:23:14'),
(5, 'Rice', '0005', '2500.00', '3000.00', 200, 'rice', NULL, 1, 0, '2017-08-18 08:24:06', '2017-08-18 09:26:59'),
(6, 'Dry Tea Leaf', '0006', '800.00', '1000.00', 100, 'tea leaf', NULL, 1, 0, '2017-08-18 08:25:14', '2017-08-18 08:25:14'),
(7, 'Cola', '0007', '400.00', '500.00', 150, 'cola', NULL, 2, 0, '2017-08-18 08:26:33', '2017-08-18 09:30:18'),
(8, 'Fanta', '0008', '400.00', '500.00', 99, 'fanta', NULL, 2, 0, '2017-08-18 08:27:19', '2017-08-18 09:25:11'),
(9, 'Pepsi', '0009', '400.00', '500.00', 100, 'pepsi', NULL, 2, 0, '2017-08-18 08:28:53', '2017-08-18 08:28:53'),
(10, 'Sprite', '0010', '400.00', '500.00', 250, 'sprite', NULL, 2, 0, '2017-08-18 08:31:05', '2017-08-18 09:31:47'),
(11, '7 Up', '0011', '400.00', '500.00', 100, '7up', NULL, 2, 0, '2017-08-18 08:31:45', '2017-08-18 08:31:45'),
(12, 'Sunkist', '0012', '400.00', '500.00', 100, 'sunkist', NULL, 2, 0, '2017-08-18 08:32:50', '2017-08-18 08:32:50'),
(13, 'Crackers', '0013', '800.00', '1000.00', 99, 'ritz', NULL, 3, 0, '2017-08-18 08:35:38', '2017-08-18 09:29:23'),
(14, 'Biscuits', '0014', '1000.00', '1200.00', 90, 'ritz bs', NULL, 3, 0, '2017-08-18 08:36:19', '2017-08-18 09:32:53'),
(15, 'Semper-Chips', '0015', '400.00', '500.00', 100, 'chips', NULL, 3, 0, '2017-08-18 08:37:50', '2017-08-18 08:39:30'),
(16, 'Breton-Bites', '0016', '800.00', '1000.00', 98, 'chips', NULL, 3, 0, '2017-08-18 08:38:42', '2017-08-18 09:29:23'),
(17, 'Lays-Chips', '0017', '400.00', '500.00', 100, 'chips', NULL, 3, 0, '2017-08-18 08:40:24', '2017-08-18 08:40:24'),
(18, 'Ruffles-Chips', '0018', '700.00', '1000.00', 99, 'chips', NULL, 3, 0, '2017-08-18 08:41:04', '2017-08-18 09:33:33'),
(19, 'Apple', '0019', '500.00', '600.00', 100, 'fruits', NULL, 4, 0, '2017-08-18 08:44:04', '2017-08-18 08:44:04'),
(20, 'Banana', '0020', '800.00', '1000.00', 100, 'fruits', NULL, 4, 0, '2017-08-18 08:44:48', '2017-08-18 08:44:48'),
(21, 'Kiwi', '0021', '1500.00', '2000.00', 100, 'fruits', NULL, 4, 0, '2017-08-18 08:45:30', '2017-08-18 08:45:30'),
(22, 'Pineapple', '0022', '800.00', '1000.00', 150, 'fruits', NULL, 4, 0, '2017-08-18 08:46:15', '2017-08-18 09:32:24'),
(23, 'Strawberry', '0023', '1800.00', '2000.00', 100, 'fruits', NULL, 4, 0, '2017-08-18 08:46:56', '2017-08-18 08:46:56'),
(24, 'Raspberry', '0024', '2000.00', '2500.00', 100, 'fruits', NULL, 4, 0, '2017-08-18 08:48:28', '2017-08-18 08:48:28'),
(25, 'Kopio', '0025', '2500.00', '3000.00', 99, 'cofe', NULL, 5, 0, '2017-08-18 08:56:50', '2017-08-18 09:33:32'),
(26, 'Gold', '0026', '3500.00', '4000.00', 100, 'cofe', NULL, 5, 0, '2017-08-18 08:57:39', '2017-08-18 08:57:39'),
(27, '2bi', '0027', '3000.00', '3500.00', 150, 'cofe', NULL, 5, 0, '2017-08-18 08:58:47', '2017-08-18 09:31:48'),
(28, 'Mac', '0028', '2500.00', '3000.00', 100, 'cofe', NULL, 5, 0, '2017-08-18 08:59:40', '2017-08-18 08:59:40'),
(29, 'Super', '0029', '2500.00', '3000.00', 100, 'cofe', NULL, 5, 0, '2017-08-18 09:00:24', '2017-08-18 09:00:24'),
(30, 'Nescafe', '0030', '3000.00', '3500.00', 100, 'cofe', NULL, 5, 0, '2017-08-18 09:01:08', '2017-08-18 09:01:08'),
(31, 'Pen', '0031', '800.00', '1000.00', 100, 'st', NULL, 6, 0, '2017-08-18 09:03:19', '2017-08-18 09:03:19'),
(32, 'Office-File', '0032', '1800.00', '2000.00', 100, 'st', NULL, 6, 0, '2017-08-18 09:04:26', '2017-08-18 09:04:26'),
(33, 'Note Book', '0033', '800.00', '1000.00', 100, 'st', NULL, 6, 0, '2017-08-18 09:05:18', '2017-08-18 09:05:18'),
(34, 'Olive-Oil', '0034', '3000.00', '3500.00', 100, 'hc', NULL, 7, 0, '2017-08-18 09:07:20', '2017-08-18 09:07:20'),
(35, 'Loreal', '0035', '4500.00', '5000.00', 100, 'hc', NULL, 7, 0, '2017-08-18 09:07:59', '2017-08-18 09:07:59'),
(36, 'KoKo-Care', '0036', '3000.00', '3500.00', 100, 'hc', NULL, 7, 0, '2017-08-18 09:08:53', '2017-08-18 09:08:53'),
(37, 'LANEIGE', '0037', '12000.00', '15000.00', 100, 'sc', NULL, 8, 0, '2017-08-18 09:10:33', '2017-08-18 09:10:33'),
(38, 'ELEMIS', '0038', '15000.00', '20000.00', 100, 'sc', NULL, 8, 0, '2017-08-18 09:11:42', '2017-08-18 09:12:18'),
(39, 'E LAUDER', '0039', '10000.00', '12000.00', 99, 'sc', NULL, 8, 0, '2017-08-18 09:13:28', '2017-08-18 09:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `user_id`, `payment_id`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Purchase Order by SuperAdmin', '2017-08-18 09:26:58', '2017-08-18 09:26:58'),
(2, 1, 2, 1, 'purchased by Admin', '2017-08-18 09:30:18', '2017-08-18 09:30:18'),
(3, 1, 3, 1, 'Purchased by salesperson', '2017-08-18 09:31:47', '2017-08-18 09:31:47'),
(4, 1, 3, 1, 'Purchased by salesperson', '2017-08-18 09:32:24', '2017-08-18 09:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `purchase_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_purchase` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `purchase_id`, `product_id`, `purchase_price`, `quantity`, `total_purchase`, `created_at`, `updated_at`) VALUES
(1, 1, 10, '400.00', 100, '40000.00', '2017-08-18 09:26:59', '2017-08-18 09:26:59'),
(2, 1, 2, '400.00', 100, '40000.00', '2017-08-18 09:26:59', '2017-08-18 09:26:59'),
(3, 1, 5, '2500.00', 100, '250000.00', '2017-08-18 09:26:59', '2017-08-18 09:26:59'),
(4, 2, 7, '400.00', 50, '20000.00', '2017-08-18 09:30:18', '2017-08-18 09:30:18'),
(5, 3, 10, '400.00', 50, '20000.00', '2017-08-18 09:31:47', '2017-08-18 09:31:47'),
(6, 3, 27, '3000.00', 50, '150000.00', '2017-08-18 09:31:47', '2017-08-18 09:31:47'),
(7, 4, 22, '800.00', 50, '40000.00', '2017-08-18 09:32:24', '2017-08-18 09:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super admin', '{"view-role": "true", "view-user": "true", "view-sales": "true", "create-role": "true", "create-user": "true", "delete-role": "true", "delete-user": "true", "update-role": "true", "update-user": "true", "view-product": "true", "view-category": "true", "view-customer": "true", "view-purchase": "true", "view-supplier": "true", "create-product": "true", "delete-product": "true", "update-product": "true", "create-category": "true", "create-customer": "true", "create-supplier": "true", "delete-category": "true", "delete-customer": "true", "delete-supplier": "true", "update-category": "true", "update-customer": "true", "update-supplier": "true", "view-sales-report": "true", "view-payment-method": "true", "view-purchase-report": "true", "create-payment-method": "true", "delete-payment-method": "true", "update-payment-method": "true", "view-product-tracking": "true"}', '2017-08-18 04:49:07', '2017-08-18 05:39:28'),
(2, 'Admin', 'admin', '{"view-user": true, "view-sales": true, "create-user": true, "delete-user": true, "update-user": true, "view-product": true, "view-category": true, "view-customer": true, "view-purchase": true, "view-supplier": true, "create-product": true, "delete-product": true, "update-product": true, "create-category": true, "create-customer": true, "create-supplier": true, "delete-category": true, "delete-customer": true, "delete-supplier": true, "update-category": true, "update-customer": true, "update-supplier": true, "view-sales-report": true, "view-purchase-report": true}', '2017-08-18 04:49:08', '2017-08-18 04:49:08'),
(3, 'Sales Person', 'sales person', '{"view-sales": true, "view-product": true, "view-customer": true, "view-purchase": true, "create-product": true, "delete-product": true, "update-product": true, "create-customer": true, "delete-customer": true, "update-customer": true}', '2017-08-18 04:49:08', '2017-08-18 04:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `user_id`, `payment_id`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, '2017-08-18 09:25:10', '2017-08-18 09:25:10'),
(2, 1, 2, 1, 'Sale by Admin', '2017-08-18 09:29:23', '2017-08-18 09:29:23'),
(3, 1, 3, 1, 'Sales by saleperson', '2017-08-18 09:32:53', '2017-08-18 09:32:53'),
(4, 1, 3, 1, 'Sales by saleperson', '2017-08-18 09:33:32', '2017-08-18 09:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `sale_products`
--

CREATE TABLE `sale_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sale_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `purchase_price` decimal(15,2) NOT NULL,
  `retail_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_purchase` decimal(15,2) NOT NULL,
  `total_retail` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_products`
--

INSERT INTO `sale_products` (`id`, `sale_id`, `product_id`, `purchase_price`, `retail_price`, `quantity`, `total_purchase`, `total_retail`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2500.00', '3000.00', 1, '2500.00', '3000.00', '2017-08-18 09:25:10', '2017-08-18 09:25:10'),
(2, 1, 8, '400.00', '500.00', 1, '400.00', '500.00', '2017-08-18 09:25:10', '2017-08-18 09:25:10'),
(3, 2, 13, '800.00', '1000.00', 1, '800.00', '1000.00', '2017-08-18 09:29:23', '2017-08-18 09:29:23'),
(4, 2, 16, '800.00', '1000.00', 2, '1600.00', '2000.00', '2017-08-18 09:29:23', '2017-08-18 09:29:23'),
(5, 3, 14, '1000.00', '1200.00', 10, '10000.00', '12000.00', '2017-08-18 09:32:53', '2017-08-18 09:32:53'),
(6, 4, 25, '2500.00', '3000.00', 1, '2500.00', '3000.00', '2017-08-18 09:33:32', '2017-08-18 09:33:32'),
(7, 4, 39, '10000.00', '12000.00', 1, '10000.00', '12000.00', '2017-08-18 09:33:32', '2017-08-18 09:33:32'),
(8, 4, 18, '700.00', '1000.00', 1, '700.00', '1000.00', '2017-08-18 09:33:33', '2017-08-18 09:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suppliername` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `company_name`, `suppliername`, `email`, `phoneno`, `photo`, `address`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'AA', 'Supplier1', 'supplier@gmail.com', '000000000', NULL, 'No.1 ,Ygn.', 0, '2017-08-18 04:49:09', '2017-08-18 05:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_super`, `is_delete`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', '$2y$10$0bt3DV4luBQLkDsLaMVT.uvlj5RVbJjQGyp5nd4z/QcQ3qBLzyy/q', 1, 0, 'QHpVEgOZ8Jps23lmH5wu7bO4KdTXScWyFq28A3YuK8hVsusZFBEAqNbsqGhp', '2017-08-18 04:49:08', '2017-08-18 04:49:08', 1),
(2, 'Admin', 'admin@gmail.com', '$2y$10$dqNrvzhIwapWKr/gEsxwx.Os6TjvFXZtKSbq4L2bEgo5VdJviR5Ou', 0, 0, 'Pz80mxFeaITIbRPJGUB8ZFvgnpQ8rFwkbiUt2AE9MZXpkQYxpF9EmDTfU4uI', '2017-08-18 04:49:08', '2017-08-18 04:49:08', 1),
(3, 'Sales Person', 'salesperson@gmail.com', '$2y$10$f9SVhI/76XL5hOT89MFKJO/ZVLVyOGwK6eSRAmJpkjfzeSL47VRZW', 0, 0, '2UIb5IqoKWi6qygjAl1WXbuB1GaD52ikwQLKEXtOhFcMkAXBxqgaF44dw5ha', '2017-08-18 04:49:08', '2017-08-18 04:49:08', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_product_id_foreign` (`product_id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_code_unique` (`code`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_products_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD UNIQUE KEY `role_users_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_users_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indexes for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_products_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sale_products`
--
ALTER TABLE `sale_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD CONSTRAINT `purchase_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchase_products_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`);

--
-- Constraints for table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD CONSTRAINT `sale_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sale_products_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
