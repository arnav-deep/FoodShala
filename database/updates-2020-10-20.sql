-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2020 at 04:07 PM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `hacktoberfest_food_shala`
--


--
-- Rename the old `orders` table to keep a backup
--

RENAME TABLE `hacktoberfest_food_shala`.`orders`
TO `hacktoberfest_food_shala`.`orders_old`;


--
-- Fix duplicate item in menu
--

UPDATE `menu` SET m_item = "Chicken Masala" WHERE m_cost = 563;


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `cust_email` varchar(64) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cust_email`, `amount`, `created_at`) VALUES
(1201, 'tester@rnav.com', '1356', '2020-10-20 09:31:14'),
(1202, 'tester@rnav.com', '2252', '2020-10-20 09:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
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
(3, 1202, 'tt@g.c', 'Chicken Masala', '4', '563', '2252');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1203;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;
