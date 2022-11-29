-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 07:13 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `drink_items`
--

CREATE TABLE `drink_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `drink_name` varchar(100) NOT NULL,
  `s-price` decimal(10,2) NOT NULL,
  `s-size` varchar(100) NOT NULL,
  `l-price` decimal(10,2) NOT NULL,
  `l-size` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drink_items`
--

INSERT INTO `drink_items` (`id`, `drink_name`, `s-price`, `s-size`, `l-price`, `l-size`, `category_id`, `status`) VALUES
(9, 'Latte', '300.00', '12oz', '410.00', '16oz', 4, 'ENABLE'),
(10, 'Cappuchino', '300.00', '12oz', '410.00', '16oz', 4, 'ENABLE'),
(11, 'Mocha', '320.00', '12oz', '435.00', '16oz', 4, 'ENABLE'),
(12, 'Instant Coffee', '180.00', '12oz', '200.00', '16oz', 4, 'ENABLE'),
(13, 'Brewed Coffee', '210.00', '12oz', '270.00', '16oz', 4, 'ENABLE'),
(14, 'Tea/Mint', '180.00', '12oz', '200.00', '16oz', 4, 'ENABLE'),
(15, 'Herbal Tea', '190.00', '12oz', '245.00', '16oz', 4, 'ENABLE'),
(16, 'Hot Chocolate', '255.00', '12oz', '290.00', '16oz', 4, 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`id`, `category_name`) VALUES
(1, 'Breakfast'),
(2, 'Board Walk Hot Panini'),
(3, 'Board Walk Salads'),
(4, 'Hot Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `food_name`, `description`, `price`, `category_id`, `status`) VALUES
(1, 'EGG BT', 'Two Eggs any style, with Bacon & Toasts', '500.00', 1, 'ENABLE'),
(2, 'EGG SB', 'Two Eggs any style, Sausage & Bagels', '500.00', 1, 'ENABLE'),
(3, 'EGG BP', 'Two Eggs any style, Bacon & Pancakes', '500.00', 1, 'ENABLE'),
(4, 'EGG BH', 'Two Eggs any style, Sausage & Hashbrowns', '500.00', 1, 'ENABLE'),
(5, 'Deli Omelettes', 'Omelettes are made to order embodied with Onion, Green Pepper, Cheese and a choice\r\nof Ham, Bacon or Mushrooms. NB: Chicken or Turkey slice is available upon request', '550.00', 1, 'ENABLE'),
(6, 'Egg Tortilla', 'Scramble eggs and melted Cheese with a choice of any three - Green Pepper, \r\nHam/Bacon, Onion, Tomato, Mushrooms', '550.00', 1, 'ENABLE'),
(7, 'SouthWest Chicken Salad Panini', 'Chopped Breast of Chicken, Chili Powder, Cheese, and specialty \r\ndressing', '730.00', 2, 'ENABLE'),
(8, 'Signature Chunky Chicken Salad', 'Juicy Marinated Chicken Breast combined with Pineapple chunks\r\nand Honey Roasted Peanuts', '750.00', 3, 'ENABLE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drink_items`
--
ALTER TABLE `drink_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drink_items`
--
ALTER TABLE `drink_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
