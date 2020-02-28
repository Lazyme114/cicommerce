-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2020 at 04:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_url` varchar(255) NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_description` text NOT NULL,
  `big_pic` varchar(255) NOT NULL,
  `small_pic` varchar(255) NOT NULL,
  `was_price` decimal(7,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `item_title`, `item_url`, `item_price`, `item_description`, `big_pic`, `small_pic`, `was_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Product 1', 'product-1', '550.00', 'This is a product', '', '', '750.00', NULL, '2020-02-27 14:08:51', NULL),
(2, 'Product 2 update', 'product-2-update', '555.00', 'thijhg jhg vjhhjk', '', '', '455.00', NULL, '2020-02-27 14:09:03', NULL),
(3, 'test', 'test', '100.00', 'sljdkfasd', '', '', '100.00', NULL, '2020-02-27 14:09:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
