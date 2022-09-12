-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 05:43 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store_database`
--
CREATE DATABASE IF NOT EXISTS `book_store_database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `book_store_database`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(12) NOT NULL,
  `book_isbn` varchar(20) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_categories` varchar(100) NOT NULL,
  `book_rating` float NOT NULL DEFAULT '0',
  `book_rating_time` int(11) NOT NULL DEFAULT '0',
  `book_price` float NOT NULL,
  `book_quantity` int(11) NOT NULL,
  `book_detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_isbn`, `book_title`, `book_author`, `book_categories`, `book_rating`, `book_rating_time`, `book_price`, `book_quantity`, `book_detail`) VALUES
(1, '985-1', 'book1', 'author1', 'Novel', 3.79, 14, 15, 43, 'book1 testing for update from detail 5/6'),
(2, '985-2', 'book2', 'author2', 'Novel', 4, 3, 10, 39, 'book2 testing for novel'),
(3, '985-3', 'book3', 'author3', 'Recipe', 3.75, 3, 20, 50, 'book3 testing for recipe'),
(4, '985-4', 'book4', 'author4', 'Technology', 5, 1, 40, 30, 'Testing for add book'),
(7, '985-5', 'book5', 'author5', 'Recipe', 4.5, 2, 50, 50, 'test for 0 rate');

-- --------------------------------------------------------

--
-- Table structure for table `book_in_cart`
--

CREATE TABLE `book_in_cart` (
  `cart_id` int(12) NOT NULL,
  `book_id` int(12) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `sum_price` float NOT NULL,
  `add_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_in_cart`
--

INSERT INTO `book_in_cart` (`cart_id`, `book_id`, `quantity`, `sum_price`, `add_date`) VALUES
(1, 1, 2, 30, '2022-02-21 11:29:30'),
(1, 2, 2, 20, '2022-02-20 11:29:30'),
(1, 4, 1, 40, '2022-05-19 08:28:27'),
(2, 3, 1, 20, '2022-03-10 11:29:30'),
(3, 4, 2, 80, '2022-05-28 06:42:49'),
(5, 1, 2, 30, '2022-05-28 06:48:17'),
(5, 3, 1, 20, '2022-05-28 09:15:31'),
(7, 1, 2, 30, '2022-06-05 03:38:09'),
(9, 1, 2, 30, '2022-06-26 11:22:37'),
(9, 2, 1, 10, '2022-06-26 11:22:47'),
(10, 1, 2, 30, '2022-06-19 06:32:51'),
(11, 1, 1, 15, '2022-06-23 03:29:59'),
(13, 1, 2, 30, '2022-06-23 03:37:55'),
(14, 1, 3, 45, '2022-06-25 04:51:57'),
(19, 1, 2, 30, '2022-06-27 06:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(12) NOT NULL,
  `cart_status` varchar(20) NOT NULL DEFAULT 'pending',
  `user_id` int(12) NOT NULL,
  `total_price` float NOT NULL,
  `payment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `cart_status`, `user_id`, `total_price`, `payment_date`) VALUES
(1, 'paid', 3, 90, '2022-06-06 10:05:36'),
(2, 'paid', 4, 20, '2022-03-15 11:29:30'),
(3, 'confirmed', 4, 80, '2022-06-06 10:08:51'),
(5, 'confirmed', 5, 50, NULL),
(6, 'pending', 1, 0, NULL),
(7, 'paid', 5, 30, '2022-06-07 10:44:36'),
(8, 'pending', 4, 0, NULL),
(9, 'confirmed', 5, 40, '2022-06-26 11:23:27'),
(10, 'pending', 3, 30, NULL),
(11, 'confirmed', 6, 15, '2022-06-23 03:30:21'),
(12, 'pending', 6, 0, NULL),
(13, 'confirmed', 7, 30, '2022-06-23 03:38:22'),
(14, 'confirmed', 7, 45, '2022-06-25 04:52:39'),
(15, 'pending', 7, 0, NULL),
(17, 'pending', 5, 0, NULL),
(18, 'pending', 2, 0, NULL),
(19, 'confirmed', 8, 30, '2022-06-27 06:19:47'),
(20, 'pending', 8, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(12) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `admin` int(2) NOT NULL,
  `credit_card_no` int(12) NOT NULL,
  `bank` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Email`, `user_name`, `contact_no`, `address`, `password`, `admin`, `credit_card_no`, `bank`) VALUES
(1, 'admin1@gmail.com', 'admin1', 111, 'No. a1, Pahang', '1', 1, 1, 'Maybank'),
(2, 'admin2@gmail.com', 'admin2', 444, 'No. a2, Pahang', '1', 1, 2, 'Maybank'),
(3, 'user1@gmail.com', 'user1', 222, 'No. u1, Pahang', '2', 0, 200, 'Ambank'),
(4, 'user2@gmail.com', 'user2', 123, 'No. u2, Pahang', '2', 0, 222, 'Public Bank'),
(5, 'user3@gmail.com', 'user3', 555, 'No. u33, Pahang', '3', 0, 333, 'Public Bank'),
(6, 'user5@gmail.com', 'user5', 115, 'No. u5, Pahang', '1', 0, 555, 'Maybank'),
(7, 'user6@gmail.com', 'user6', 116, 'No. 6, Pahang.', '1', 0, 166, 'Bank Islam'),
(8, 'u7@gmail.com', 'user7', 177, 'no u7 Pahang', '11', 0, 777, 'Bank Islam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_in_cart`
--
ALTER TABLE `book_in_cart`
  ADD PRIMARY KEY (`cart_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_in_cart`
--
ALTER TABLE `book_in_cart`
  ADD CONSTRAINT `book_in_cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `shopping_cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_in_cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
