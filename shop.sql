-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2019 at 09:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `product_price` float NOT NULL,
  `product_image` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_price`, `product_image`) VALUES
(1, 'Apple', 0.3, 'apple.jpg'),
(2, 'beer', 2, 'beer.jpg'),
(3, 'water', 1, 'water.jpg'),
(4, 'cheese', 3.74, 'cheese.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `rating`) VALUES
(2, 1, 3),
(3, 1, 3),
(4, 2, 3),
(5, 2, 3),
(6, 3, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 3),
(11, 1, 3),
(12, 1, 3),
(13, 1, 3),
(14, 1, 3),
(15, 2, 3),
(16, 2, 3),
(17, 2, 3),
(18, 2, 3),
(19, 1, 3),
(20, 1, 2),
(21, 2, 4),
(22, 1, 4),
(23, 1, 4),
(24, 2, 3),
(25, 2, 4),
(26, 2, 4),
(27, 2, 4),
(28, 4, 3),
(29, 4, 3),
(30, 4, 3),
(31, 1, 4),
(32, 1, 4),
(33, 1, 3),
(34, 1, 3),
(35, 1, 3),
(36, 1, 3),
(37, 1, 3),
(38, 1, 2),
(39, 3, 3),
(40, 3, 3),
(41, 3, 5),
(42, 4, 2),
(43, 4, 2),
(44, 4, 4),
(45, 1, 3),
(46, 1, 3),
(47, 1, 4),
(48, 1, 3),
(49, 1, 3),
(50, 1, 2),
(51, 3, 3),
(52, 2, 4),
(53, 1, 4),
(54, 1, 3),
(55, 4, 4),
(56, 1, 3),
(57, 2, 4),
(58, 3, 2),
(59, 2, 3),
(60, 1, 3),
(61, 1, 2),
(62, 1, 3),
(63, 1, 3),
(64, 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_ibfk_1` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
