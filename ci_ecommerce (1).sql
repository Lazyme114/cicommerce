-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 04:03 AM
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
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `blog_url` varchar(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_keywords` text NOT NULL,
  `blog_descriptions` text NOT NULL,
  `blog_content` text NOT NULL,
  `date_published` date DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `blog_url`, `blog_title`, `blog_keywords`, `blog_descriptions`, `blog_content`, `date_published`, `author`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'firt-blog-trys', 'Firt Blog Trys', 'This is blog entry keyword', 'This is blog entry keyword', '<font face=\"Arial, Verdana\"><span xss=\"removed\">This is blog entry keyword</span></font>', '2020-03-24', 'Joe Bloggs ss', '7tC9XbCFSgt8SB3R.jpg', '2020-03-01 08:44:12', '2020-03-01 15:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('90aevrmc5t1itj1vv3nhru8760derv2v', '127.0.0.1', 1583074762, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538333037343736323b7570646174655f63617465676f72797c623a313b),
('c6iv7ltrp6i01e9d6b4fu35mnblv9rqs', '127.0.0.1', 1583075058, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538333037343736323b7570646174655f63617465676f72797c623a313b),
('i5r967ehgc2dog1jn4rv5dpf9iu23cc2', '127.0.0.1', 1583072354, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538333037323335343b7570646174655f63617465676f72797c623a313b),
('nsffhe8r9sk90cr3f8ffe908nam16eei', '127.0.0.1', 1583074453, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538333037343435333b7570646174655f63617465676f72797c623a313b);

-- --------------------------------------------------------

--
-- Table structure for table `store_accounts`
--

CREATE TABLE `store_accounts` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_accounts`
--

INSERT INTO `store_accounts` (`id`, `first_name`, `last_name`, `company`, `address1`, `address2`, `town`, `country`, `postcode`, `telephone`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Sujan', 'Shrestha', 'Lazyme114 Co.', 'Address1', 'address2', 'my town', 'my country', '1234', '9328923421', 'lazyme114@gmail.com', '$2y$11$G4oEvzixzp9eEc0Y63V9au2wkHJBBsRzbUWSp0nhTQyPZy0zbbtni', '2020-02-28 23:10:04', '2020-02-29 06:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `id` int(11) NOT NULL,
  `category_title` varchar(255) NOT NULL,
  `category_url` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `priority` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`id`, `category_title`, `category_url`, `parent_id`, `priority`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Guitars', 'guitars', 0, 2, '2020-02-29 02:34:54', '2020-03-01 13:56:11', NULL),
(2, 'Fender Guitars', 'fender-guitars', 1, 2, '2020-02-29 02:35:24', '2020-02-29 13:08:47', NULL),
(3, 'FX Pedels ', 'fx-pedels', 0, 1, '2020-02-29 02:49:53', '2020-03-01 14:09:59', NULL),
(4, 'Pickups', 'pickups', 0, 3, '2020-02-29 02:50:07', '2020-02-29 13:09:23', NULL),
(5, 'Folk Instruments', 'folk-instruments', 0, 4, '2020-02-29 02:50:24', '2020-02-29 13:08:28', NULL),
(6, 'Accessories', 'accessories', 0, 5, '2020-02-29 02:50:39', '2020-02-29 13:08:28', NULL),
(7, 'Gibson Guitars', 'gibson-guitars', 1, 1, '2020-02-29 02:53:57', '2020-02-29 13:08:47', NULL),
(8, 'Ibanaze Guitars', 'ibanaze-guitars', 1, 3, '2020-02-29 02:54:15', '2020-02-29 13:08:47', NULL),
(9, 'Jackson Guitars', 'jackson-guitars', 1, 4, '2020-02-29 02:54:41', '2020-02-29 13:08:47', NULL),
(10, 'BC Rich', 'bc-rich', 1, 5, '2020-02-29 02:55:02', '2020-02-29 13:08:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store_cat_assigns`
--

CREATE TABLE `store_cat_assigns` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_cat_assigns`
--

INSERT INTO `store_cat_assigns` (`id`, `item_id`, `category_id`) VALUES
(1, 4, 10),
(5, 4, 2);

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
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `item_title`, `item_url`, `item_price`, `item_description`, `big_pic`, `small_pic`, `was_price`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Product 3', 'product-3', '150.00', 'This is a product 3', '', '', '125.00', 0, NULL, '2020-02-28 05:44:52', NULL),
(5, 'Gold Watch', 'gold-watch', '100.00', '<font face=\"Arial, Verdana\"><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</span></font><div><font face=\"Arial, Verdana\"><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</span></font></div><div><font face=\"Arial, Verdana\"><span xss=removed><br></span></font></div><div><font face=\"Arial, Verdana\"><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</span></font></div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</div><div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore recusandae commodi ut modi error, incidunt eligendi. Ad eum nostrum quisquam eligendi consequatur. Eveniet corporis, voluptas dolor earum eaque quasi atque?</div>', '1031506.jpg', '1031506.jpg', '200.00', 1, '2020-02-28 07:11:54', '2020-02-28 15:08:07', NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `webpages`
--

CREATE TABLE `webpages` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_keywords` text NOT NULL,
  `page_descriptions` text NOT NULL,
  `page_content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webpages`
--

INSERT INTO `webpages` (`id`, `page_url`, `page_title`, `page_keywords`, `page_descriptions`, `page_content`, `created_at`, `updated_at`) VALUES
(1, '', 'Homepage', 'Homepage', 'This is Homepage', 'Here goes homepage content', '2020-03-01 08:14:24', '2020-03-01 12:59:41'),
(2, 'contact-us', 'Contact Us', 'Contact us', 'This is contact us page', 'contact us content', '2020-03-01 08:15:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `store_accounts`
--
ALTER TABLE `store_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_cat_assigns`
--
ALTER TABLE `store_cat_assigns`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `webpages`
--
ALTER TABLE `webpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_accounts`
--
ALTER TABLE `store_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `store_cat_assigns`
--
ALTER TABLE `store_cat_assigns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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

--
-- AUTO_INCREMENT for table `webpages`
--
ALTER TABLE `webpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
