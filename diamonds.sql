-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diamonds`
--

-- --------------------------------------------------------

--
-- Структура на таблица `bijou`
--

CREATE TABLE IF NOT EXISTS `bijou` (
  `bijou_id` int(11) NOT NULL,
  `bijou_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `bijou`
--

INSERT INTO `bijou` (`bijou_id`, `bijou_type`) VALUES
(5, 'bracelet'),
(2, 'earring'),
(1, 'necklace'),
(4, 'parure'),
(3, 'ring');

-- --------------------------------------------------------

--
-- Структура на таблица `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int(11) NOT NULL,
  `color_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `color`
--

INSERT INTO `color` (`color_id`, `color_type`) VALUES
(9, 'aqua'),
(12, 'black'),
(6, 'blue'),
(10, 'brown'),
(8, 'green'),
(11, 'grey'),
(7, 'lila'),
(4, 'orange'),
(5, 'pink'),
(1, 'red'),
(2, 'white'),
(3, 'yellow');

-- --------------------------------------------------------

--
-- Структура на таблица `metal`
--

CREATE TABLE IF NOT EXISTS `metal` (
  `metal_id` int(11) NOT NULL,
  `metal_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `metal`
--

INSERT INTO `metal` (`metal_id`, `metal_type`) VALUES
(2, 'gold'),
(1, 'silver');

-- --------------------------------------------------------

--
-- Структура на таблица `orderedproducts`
--

CREATE TABLE IF NOT EXISTS `orderedproducts` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_price` double(8,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `orderedproducts`
--

INSERT INTO `orderedproducts` (`id`, `order_id`, `product_id`, `product_count`, `product_price`) VALUES
(1, 11, 42, 1, 1250.00),
(2, 11, 30, 2, 3100.00),
(3, 12, 30, 1, 3100.00),
(4, 12, 25, 1, 1200.00),
(5, 13, 30, 1, 3100.00),
(6, 13, 42, 1, 1250.00),
(7, 14, 40, 2, 1100.00),
(8, 14, 38, 2, 1500.00),
(9, 14, 27, 2, 4200.00),
(10, 15, 38, 2, 1500.00),
(11, 15, 25, 1, 1200.00),
(12, 15, 30, 1, 3100.00);

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `status` bit(1) NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `orders`
--

INSERT INTO `orders` (`order_id`, `user`, `status`, `date_ordered`) VALUES
(11, 1, b'1', '2016-04-25 16:18:10'),
(12, 1, b'0', '2016-05-05 11:24:11'),
(13, 2, b'0', '2016-05-06 06:06:27'),
(14, 2, b'0', '2016-05-07 05:59:35'),
(15, 3, b'1', '2016-05-07 16:18:33');

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_img` varchar(50) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `metal` int(11) DEFAULT NULL,
  `bijou` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `promo` int(11) DEFAULT '0',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_img`, `color`, `metal`, `bijou`, `price`, `promo`, `date_added`) VALUES
(19, 'Cherry Blossoms', '1459927726.jpe', 1, 2, 3, 1000.00, 0, '2016-04-06 07:28:46'),
(25, 'Shine Butterfly', '1460184518.jpg', 2, 1, 3, 1200.00, 0, '2016-04-09 06:48:38'),
(27, 'Hearts', '1460221685.jpg', 2, 1, 2, 4200.00, 0, '2016-04-09 17:08:05'),
(30, 'Sky Heart', '1460223552.jpg', 6, 1, 1, 3100.00, 0, '2016-04-09 04:39:12'),
(31, 'Aqua Dreams', '1460224973.jpg', 12, 2, 4, 1200.00, 0, '2016-04-09 05:02:53'),
(38, 'Golden Heart', '1460267462.png', 3, 2, 5, 1500.00, 0, '2016-04-10 04:51:03'),
(39, 'Aqua Dreams', '1460267604.png', 9, 2, 5, 1250.00, 0, '2016-04-10 04:53:24'),
(40, 'Cocoa Dreams', '1460269152.png', 10, 2, 2, 1100.00, 0, '2016-04-10 05:19:12'),
(41, 'Pearl earrings', '1460269787.png', 11, 1, 2, 5000.00, 0, '2016-04-10 05:29:47'),
(42, 'Pink Dreams', '1461478314.jpg', 5, 1, 1, 1250.00, 0, '2016-04-24 05:11:54'),
(43, 'Grass Parure', '1463160785.jpg', 8, 2, 4, 1150.00, 0, '2016-05-13 16:33:05'),
(44, 'edd', '1463652762.jpg', 1, 1, 1, 150.00, 0, '2016-05-19 09:12:42');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `tel_number` varchar(15) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  `reg_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `tel_number`, `mail`, `user_name`, `user_pass`, `isAdmin`, `reg_date`) VALUES
(1, 'анелия', 'петрова', '0885489574', 'anelia@abv.com', 'anelia1', '9748786a087c0b54e4c2968cd68baf65', b'0', '2016-03-16 08:27:14'),
(2, 'bobi', 'velikova', '0896548418', 'bobinka@abv.com', 'admin', '8a416ea72cb5feee2b23b87da000d01a', b'1', '2016-03-08 06:26:23'),
(3, 'Ани', 'Ву', '16541685', 'bobi@slf.ru', 'bobinka', '3b59a82a96ca59f00b92d1772af8cbe5', b'0', '2016-05-07 17:13:53'),
(9, 'рали', 'рачева', '2156416853', 'scandal@fenk.bg', 'ralichka', '864c210268a3dbb628bd0a3479e5a5d7', b'0', '2016-05-07 19:12:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bijou`
--
ALTER TABLE `bijou`
  ADD PRIMARY KEY (`bijou_id`), ADD UNIQUE KEY `bijou_type` (`bijou_type`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`), ADD UNIQUE KEY `color_type` (`color_type`);

--
-- Indexes for table `metal`
--
ALTER TABLE `metal`
  ADD PRIMARY KEY (`metal_id`), ADD UNIQUE KEY `metal_type` (`metal_type`);

--
-- Indexes for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  ADD PRIMARY KEY (`id`), ADD KEY `order_id` (`order_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`), ADD KEY `user` (`user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`), ADD KEY `products_ibfk_1` (`color`), ADD KEY `products_ibfk_2` (`metal`), ADD KEY `products_ibfk_3` (`bijou`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bijou`
--
ALTER TABLE `bijou`
  MODIFY `bijou_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `metal`
--
ALTER TABLE `metal`
  MODIFY `metal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `orderedproducts`
--
ALTER TABLE `orderedproducts`
ADD CONSTRAINT `orderedproducts_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
ADD CONSTRAINT `orderedproducts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Ограничения за таблица `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`);

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`color`) REFERENCES `color` (`color_id`) ON UPDATE NO ACTION,
ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`metal`) REFERENCES `metal` (`metal_id`) ON UPDATE NO ACTION,
ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`bijou`) REFERENCES `bijou` (`bijou_id`) ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
