-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2020 at 12:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `m_r_email` text NOT NULL,
  `m_item` text NOT NULL,
  `m_cost` mediumint(9) NOT NULL,
  `m_nonveg` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`m_r_email`, `m_item`, `m_cost`, `m_nonveg`) VALUES
('tt@g.c', 'Chicken Tikka', 230, 1),
('tt@g.c', 'Chicken Masala', 563, 1),
('gg@g.g', 'White Sauce Pasta', 65, 0),
('gg@g.g', 'White Sauce Pasta with Chicken', 160, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cust_email` varchar(64) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cust_email`, `amount`, `created_at`) VALUES
(1201, 'tester@rnav.com', '1356', '2020-10-20 09:31:14'),
(1202, 'tester@rnav.com', '2252', '2020-10-20 09:32:53'),
(1203, 'tester@rnav.com', '793', '2020-10-21 17:59:21'),
(1204, 'tester@rnav.com', '858', '2020-10-21 18:02:39'),
(1205, 'tester@rnav.com', '230', '2020-10-21 18:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `orders_old`
--

CREATE TABLE `orders_old` (
  `o_r_email` text NOT NULL,
  `o_c_email` text NOT NULL,
  `o_m_item` text NOT NULL,
  `o_quan` smallint(6) NOT NULL,
  `o_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_old`
--

INSERT INTO `orders_old` (`o_r_email`, `o_c_email`, `o_m_item`, `o_quan`, `o_time`) VALUES
('gg@g.g', 'tester@rnav.com', 'White Sauce Pasta with Chicken', 1, '2020-09-10 12:21:42'),
('gg@g.g', 'tester@rnav.com', 'White Sauce Pasta with Chicken', 1, '2020-09-10 12:23:31'),
('gg@g.g', 'tester@rnav.com', 'White Sauce Pasta with Chicken', 1, '2020-09-10 12:23:51'),
('tt@g.c', 'tester@rnav.com', 'Chicken Tikka', 2, '2020-09-10 12:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `rest_email` varchar(64) NOT NULL,
  `item_name` text NOT NULL,
  `item_qty` decimal(10,0) UNSIGNED NOT NULL,
  `item_unit_cost` decimal(10,0) NOT NULL,
  `item_total_cost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `rest_email`, `item_name`, `item_qty`, `item_unit_cost`, `item_total_cost`) VALUES
(1, 1201, 'tt@g.c', 'Chicken Masala', '2', '563', '1126'),
(2, 1201, 'tt@g.c', 'Chicken Tikka', '1', '230', '230'),
(3, 1202, 'tt@g.c', 'Chicken Masala', '4', '563', '2252'),
(4, 1203, 'tt@g.c', 'Chicken Masala', '1', '563', '563'),
(5, 1203, 'tt@g.c', 'Chicken Tikka', '1', '230', '230'),
(6, 1204, 'tt@g.c', 'Chicken Masala', '1', '563', '563'),
(7, 1204, 'tt@g.c', 'Chicken Tikka', '1', '230', '230'),
(8, 1204, 'gg@g.g', 'White Sauce Pasta', '1', '65', '65'),
(9, 1205, 'tt@g.c', 'Chicken Tikka', '1', '230', '230');

-- --------------------------------------------------------

--
-- Table structure for table `user_cus`
--

CREATE TABLE `user_cus` (
  `c_name` text NOT NULL,
  `c_email` text NOT NULL,
  `c_pwd` text NOT NULL,
  `c_phone` varchar(10) NOT NULL,
  `c_add` text DEFAULT NULL,
  `c_nonveg` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_cus`
--

INSERT INTO `user_cus` (`c_name`, `c_email`, `c_pwd`, `c_phone`, `c_add`, `c_nonveg`) VALUES
('Arnav Tester', 'tester@rnav.com', 'bananana', '9408597448', '193, Yellow Blue, Green Red', 1),
('test2', 'haha@ha.ha', 'bananana', '9999999999', 'akjsd ak fe', 0),
('test2', 'arna@agfs.com', 'asasdadasd', '9789568754', 'dwqjbdowd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_res`
--

CREATE TABLE `user_res` (
  `r_name` text NOT NULL,
  `r_email` text NOT NULL,
  `r_pwd` text NOT NULL,
  `r_add` text NOT NULL,
  `r_phone1` varchar(10) NOT NULL,
  `r_phone2` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_res`
--

INSERT INTO `user_res` (`r_name`, `r_email`, `r_pwd`, `r_add`, `r_phone1`, `r_phone2`) VALUES
('Throw', 'tt@g.c', 'testrest', 'aksldn', '7777777777', '8888888888'),
('ABC', 'gg@g.g', 'popopopo', 'paosaspd', '9898989898', '9899898565');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cus`
--
ALTER TABLE `user_cus`
  ADD UNIQUE KEY `c_email` (`c_email`) USING HASH;

--
-- Indexes for table `user_res`
--
ALTER TABLE `user_res`
  ADD UNIQUE KEY `r_email` (`r_email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1206;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
