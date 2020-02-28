-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 28, 2020 at 01:11 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `item_title`, `item_url`, `item_price`, `item_description`, `big_pic`, `small_pic`, `was_price`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Product 3', 'product-3', '150.00', 'This is a product 3', '', '', '125.00', 0, NULL, '2020-02-28 05:44:52', NULL),
(5, 'Gold Watch', 'gold-watch', '100.00', '<font face=\"Arial, Verdana\"><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</span></font><div><font face=\"Arial, Verdana\"><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</span></font></div><div><font face=\"Arial, Verdana\"><span xss=removed><br></span></font></div><div><font face=\"Arial, Verdana\"><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</span></font></div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</div>', '934096.jpg', '934096.jpg', '200.00', 1, '2020-02-28 07:11:54', '2020-02-28 11:58:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_item_colors`
--

CREATE TABLE `store_item_colors` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_item_colors`
--

INSERT INTO `store_item_colors` (`id`, `item_id`, `color`) VALUES
(7, 5, 'Gold'),
(8, 5, 'Purple Gold'),
(9, 5, 'Old Gold');

-- --------------------------------------------------------

--
-- Table structure for table `store_item_sizes`
--

CREATE TABLE `store_item_sizes` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_item_sizes`
--

INSERT INTO `store_item_sizes` (`id`, `item_id`, `size`) VALUES
(5, 5, '46 mm'),
(6, 5, '42 mm'),
(7, 5, '40 mm'),
(8, 5, '36 mm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_item_colors`
--
ALTER TABLE `store_item_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_item_sizes`
--
ALTER TABLE `store_item_sizes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `store_item_colors`
--
ALTER TABLE `store_item_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `store_item_sizes`
--
ALTER TABLE `store_item_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
