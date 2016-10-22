-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2016 at 05:31 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS fortunefx;

CREATE DATABASE fortunefx;

USE fortunefx;

GRANT ALL PRIVILEGES
  ON fortunefx.*
  TO 'fortune_fx'@'localhost'
  IDENTIFIED BY 'fxfortune123'; 
  
--
-- Table structure for table `security_questions`
--

CREATE TABLE `security_questions` (
  `q_id` int(11) NOT NULL,
  `question` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_questions`
--

INSERT INTO `security_questions` (`q_id`, `question`) VALUES
(1, 'What is the name of your favorite childhood friend?'),
(2, 'In what city or town was your first job?'),
(3, 'In what city or town did your mother and father meet?'),
(4, 'What school did you attend for sixth grade?');

-- --------------------------------------------------------

--
-- Table structure for table `trading_type`
--

CREATE TABLE `trading_type` (
  `trading_type_id` char(1) NOT NULL,
  `description` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trading_type`
--

INSERT INTO `trading_type` (`trading_type_id`, `description`) VALUES
('B', 'Buy'),
('S', 'Sell');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `confirmation_number` varchar(150) NOT NULL,
  `date` varchar(50) NOT NULL,
  `transaction_type_id` varchar(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `confirmation_number`, `date`, `transaction_type_id`, `user_id`) VALUES
(17, 'PAY-55V7082808731554AK7HZLUA', 'Sep 07 2016 02:21 PM', 'D', 15),
(18, 'PAY-95N66001PX618574RK7HZMEI', 'Sep 07 2016 02:22 PM', 'D', 15),
(19, 'PAY-3U0849608W281153KK7H2FKY', 'Sep 07 2016 03:16 PM', 'D', 15),
(36, 'PAY-9JS68456TA870391HK7IXELI', 'Sep 09 2016 12:14 AM', 'D', 15),
(37, 'PAY-1X012489UU860394NK7IXGRA', 'Sep 09 2016 12:18 AM', 'D', 15),
(45, 'PAY-ef4a482420ff8915229dc3571f81c792', 'Sep 14 2016 02:31 PM', 'O', 15),
(46, 'PAY-c5f97920b9cce7d8e8c222f6a60754ee', 'Sep 14 2016 02:33 PM', 'O', 15),
(47, 'PAY-70a204190e65ce6ca43c84ef2cbbe9ec', 'Sep 14 2016 02:33 PM', 'O', 15),
(48, 'PAY-612a63e812d94d8baa1ba8ac7115ff6a', 'Sep 14 2016 02:41 PM', 'O', 15),
(49, 'PAY-de41363cd764d6c81bce5778131c67ba', 'Sep 14 2016 03:01 PM', 'O', 15),
(50, 'PAY-52M32922RH313624NK7MPFKA', 'Sep 14 2016 04:48 PM', 'D', 10),
(61, 'PAY-ad92b9e3020cadb3879d6c5841223712', 'Sep 19 2016 04:22 PM', 'O', 10),
(62, 'PAY-2D1700436U9680533K7Y3NMA', 'Oct 03 2016 12:39 PM', 'D', 15),
(63, 'PAY-9B284022EF705311DK72E3SI', 'Oct 05 2016 11:48 AM', 'D', 10),
(64, 'PAY-55d53e645ced07b8067bd0603eda629a', 'Oct 06 2016 11:46 PM', 'O', 10),
(65, 'PAY-d3b2cbee835d3224c046fc2531bdab70', 'Oct 06 2016 11:47 PM', 'O', 10),
(66, 'PAY-d171a2a7f8a7a2100b816b591fbb9b97', 'Oct 06 2016 11:48 PM', 'O', 10),
(67, 'PAY-885789d06485d205e74f04aaf05fdc3d', 'Oct 06 2016 11:51 PM', 'O', 10),
(68, 'PAY-e6e478d252a8c75132da97723102cb98', 'Oct 08 2016 10:38 PM', 'O', 15),
(69, 'PAY-61e979b096928c938805a3e45b42b05c', 'Oct 08 2016 10:56 PM', 'O', 15),
(70, 'PAY-ffa6b73cee44aeb6c541c76bbe242f9e', 'Oct 08 2016 10:57 PM', 'O', 15),
(71, 'PAY-aaa09585c5f9a570d7ee3591de2289d6', 'Oct 08 2016 10:59 PM', 'O', 15),
(72, 'PAY-bb24239f148616b95239b3a19b2db492', 'Oct 08 2016 11:00 PM', 'O', 15),
(73, 'PAY-24969d6210d1f1ddbfc328247dd3f9be', 'Oct 08 2016 11:06 PM', 'O', 15),
(74, 'PAY-db6e505f16419a392fe1486fb9a72571', 'Oct 08 2016 11:08 PM', 'O', 15),
(75, 'PAY-4174f2c4d9bc151c3389a2391676ad7a', 'Oct 08 2016 11:12 PM', 'O', 15),
(76, 'PAY-de7b61c89dcf82e34aa338fae297b857', 'Oct 08 2016 11:13 PM', 'O', 15),
(77, 'PAY-397ffc81c22041a0d49286e494f193f7', 'Oct 08 2016 11:14 PM', 'O', 15),
(78, 'PAY-689b773dc21367052b83cd91ea12d993', 'Oct 08 2016 11:16 PM', 'O', 15),
(79, 'PAY-81b79072cc4cf84a3693675dba7d8e83', 'Oct 08 2016 11:20 PM', 'O', 15),
(80, 'PAY-970ffd4c405f80a246a99db4568864e7', 'Oct 08 2016 11:24 PM', 'O', 15),
(81, 'PAY-ec6eea35d9b29c569e1ef946c848d46c', 'Oct 08 2016 11:27 PM', 'O', 15),
(82, 'PAY-30ec3bf59a5871cc46d02f6f37e24445', 'Oct 08 2016 11:29 PM', 'O', 15),
(83, 'PAY-dd5ce73fe0c6bf7d7fa553348e88d78b', 'Oct 08 2016 11:32 PM', 'O', 15),
(84, 'PAY-8074ffb801d5f9240c5f348cc96396a7', 'Oct 08 2016 11:42 PM', 'O', 15),
(85, 'PAY-8489b0b0533a83a2947939f5bd8a4cde', 'Oct 08 2016 11:51 PM', 'O', 15),
(86, 'PAY-acf1dce765e64effba8d1d7528ea33e6', 'Oct 08 2016 11:53 PM', 'O', 15),
(87, 'PAY-05a63016a753ac53ea35b8011ecb9883', 'Oct 08 2016 11:54 PM', 'O', 15),
(88, 'PAY-f0120936843dd1f5e53190365726c18c', 'Oct 08 2016 11:56 PM', 'O', 15),
(89, 'PAY-e3b09a6eb3ee4330127c8da61f17a9e6', 'Oct 09 2016 02:29 PM', 'O', 10),
(90, 'PAY-cd19f09d05cc07016313daa9a9ce7d92', 'Oct 09 2016 02:57 PM', 'O', 15),
(91, 'PAY-51b47a3a9644b4df4536b4d6d78aca36', 'Oct 09 2016 03:14 PM', 'O', 15),
(92, 'PAY-d28cfa502ddf0b4954d5a2e242679ac6', 'Oct 09 2016 03:16 PM', 'O', 15),
(93, 'PAY-2a394ce7aacdf4ed54cf416b636cf8ca', 'Oct 09 2016 03:16 PM', 'O', 15),
(94, 'PAY-7e4fc4b9f74dd0e8d8772f56231bc738', 'Oct 10 2016 03:03 AM', 'O', 15),
(95, 'PAY-7WM3245678158322EK75OJHA', 'Oct 10 2016 11:45 AM', 'D', 10),
(96, 'PAY-11dc9e66ad457ff9d64adb41995851fb', 'Oct 10 2016 11:49 AM', 'O', 10),
(97, 'PAY-cf5ab9ef869cc2a8c4b9bbeef29e634f', 'Oct 10 2016 12:09 PM', 'O', 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_deposit`
--

CREATE TABLE `transaction_deposit` (
  `amount` decimal(15,2) NOT NULL,
  `description` varchar(150) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `deposit_type_id` char(1) NOT NULL DEFAULT 'D'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_deposit`
--

INSERT INTO `transaction_deposit` (`amount`, `description`, `transaction_id`, `deposit_type_id`) VALUES
('120.00', 'Fund Deposit', 17, 'D'),
('40.00', 'Fund Deposit', 18, 'D'),
('35.00', 'Fund Deposit', 19, 'D'),
('1000.00', 'Fund Deposit', 36, 'D'),
('1500.00', 'Fund Deposit', 37, 'D'),
('1000.00', 'Fund Deposit', 50, 'D'),
('120.00', 'Fund Deposit', 62, 'D'),
('120.00', 'Fund Deposit', 63, 'D'),
('200.00', 'Fund Deposit', 95, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_deposit_type`
--

CREATE TABLE `transaction_deposit_type` (
  `deposit_type_id` char(1) NOT NULL DEFAULT 'D'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_deposit_type`
--

INSERT INTO `transaction_deposit_type` (`deposit_type_id`) VALUES
('D');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_order`
--

CREATE TABLE `transaction_order` (
  `transaction_id` int(11) NOT NULL,
  `product` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `type_id` char(1) NOT NULL,
  `amount` int(11) NOT NULL,
  `deal_rate` decimal(9,5) NOT NULL,
  `status` varchar(7) NOT NULL,
  `pl` decimal(15,4) NOT NULL,
  `unrealized_pl` decimal(15,4) NOT NULL,
  `open_time` int(10) UNSIGNED NOT NULL,
  `close_time` int(10) UNSIGNED NOT NULL,
  `order_type_id` char(1) NOT NULL DEFAULT 'O'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_order`
--

INSERT INTO `transaction_order` (`transaction_id`, `product`, `description`, `type_id`, `amount`, `deal_rate`, `status`, `pl`, `unrealized_pl`, `open_time`, `close_time`, `order_type_id`) VALUES
(45, 'CADCHF', 'Bought CADCHF @ 0.7429', 'B', 1000, '0.74290', 'close', '0.0000', '0.0000', 1473827501, 1475926151, 'O'),
(46, 'NZDUSD', 'Sold NZDUSD @ 0.7262', 'S', 1000, '0.72620', 'close', '0.0000', '0.0000', 1473827596, 1475926518, 'O'),
(47, 'USDNOK', 'Sold USDNOK @ 8.2681', 'S', 1000, '8.26810', 'close', '0.0000', '0.0000', 1473827624, 1475927710, 'O'),
(48, 'GBPAUD', 'Sold GBPAUD @ 1.7641', 'S', 1000, '1.76410', 'close', '0.0000', '0.0000', 1473828069, 1475926363, 'O'),
(49, 'USDNOK', 'Sold USDNOK @ 8.2645', 'S', 30000, '8.26450', 'close', '7.3125', '7.3125', 1473829274, 1473855405, 'O'),
(61, 'AUDUSD', 'Bought AUDUSD @ 0.7539', 'B', 30000, '0.75390', 'close', '185.5560', '0.0000', 1474266125, 1475983410, 'O'),
(64, 'EURUSD', 'Sold EURUSD @ 1.1183', 'S', 100000, '1.11830', 'close', '-302.9100', '0.0000', 1475757994, 1475983499, 'O'),
(65, 'AUDUSD', 'Bought AUDUSD @ 0.7574', 'B', 100000, '0.75740', 'close', '157.9200', '0.0000', 1475758058, 1475983420, 'O'),
(66, 'EURJPY', 'Bought EURJPY @ 116.1460', 'B', 100000, '116.14600', 'close', '-1098.2400', '0.0000', 1475758101, 1475983570, 'O'),
(67, 'GBPCHF', 'Bought GBPCHF @ 1.2366', 'B', 100000, '1.23660', 'close', '-2771.7300', '0.0000', 1475758280, 1475983561, 'O'),
(68, 'AUDUSD', 'Sold AUDUSD @ 0.7586', 'S', 50000, '0.75860', 'close', '0.0000', '0.0000', 1475926710, 1475927186, 'O'),
(69, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 100000, '0.75890', 'close', '0.0000', '0.0000', 1475927777, 1475927788, 'O'),
(70, 'EURUSD', 'Bought EURUSD @ 1.1206', 'B', 100000, '1.12060', 'close', '0.0000', '0.0000', 1475927833, 1475927855, 'O'),
(71, 'EURJPY', 'Bought EURJPY @ 115.2920', 'B', 80000, '115.29200', 'close', '0.0000', '0.0000', 1475927938, 1475927948, 'O'),
(72, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 50000, '0.75890', 'close', '0.0000', '0.0000', 1475928036, 1475928073, 'O'),
(73, 'AUDUSD', 'Sold AUDUSD @ 0.7586', 'S', 80000, '0.75860', 'close', '0.0000', '0.0000', 1475928404, 1475928420, 'O'),
(74, 'AUDUSD', 'Sold AUDUSD @ 0.7586', 'S', 80000, '0.75860', 'close', '0.0000', '0.0000', 1475928498, 1475928516, 'O'),
(75, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 30000, '0.75890', 'close', '0.0000', '0.0000', 1475928775, 1475928790, 'O'),
(76, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 50000, '0.75890', 'close', '0.0000', '0.0000', 1475928811, 1475928820, 'O'),
(77, 'EURCZK', 'Bought EURCZK @ 27.0460', 'B', 30000, '27.04600', 'close', '0.0000', '0.0000', 1475928866, 1475928875, 'O'),
(78, 'EURNOK', 'Bought EURNOK @ 9.0763', 'B', 30000, '9.07630', 'close', '0.0000', '0.0000', 1475928982, 1475928993, 'O'),
(79, 'EURAUD', 'Bought EURAUD @ 1.4744', 'B', 30000, '1.47440', 'close', '0.0000', '0.0000', 1475929215, 1475929229, 'O'),
(80, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 80000, '0.75890', 'close', '0.0000', '0.0000', 1475929436, 1475929446, 'O'),
(81, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 50000, '0.75890', 'close', '0.0000', '0.0000', 1475929664, 1475929683, 'O'),
(82, 'EURNZD', 'Bought EURNZD @ 1.5627', 'B', 1000, '1.56270', 'close', '0.0000', '0.0000', 1475929784, 1475929809, 'O'),
(83, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 80000, '0.75890', 'close', '0.0000', '0.0000', 1475929956, 1475930551, 'O'),
(84, 'EURJPY', 'Bought EURJPY @ 115.2920', 'B', 50000, '115.29200', 'close', '0.0000', '0.0000', 1475930540, 1475930593, 'O'),
(85, 'EURGBP', 'Sold EURGBP @ 0.9007', 'S', 30000, '0.90070', 'close', '0.0000', '0.0000', 1475931093, 1475931418, 'O'),
(86, 'USDCAD', 'Bought USDCAD @ 1.3299', 'B', 30000, '1.32990', 'close', '0.0000', '0.0000', 1475931186, 1475931345, 'O'),
(87, 'EURNZD', 'Bought EURNZD @ 1.5627', 'B', 1000, '1.56270', 'close', '0.0000', '0.0000', 1475931262, 1475931289, 'O'),
(88, 'AUDCHF', 'Bought AUDCHF @ 0.7437', 'B', 30000, '0.74370', 'close', '0.0000', '0.0000', 1475931364, 1475985370, 'O'),
(89, 'EURGBP', 'Bought EURGBP @ 0.9007', 'B', 100000, '0.90070', 'close', '0.0000', '0.0000', 1475983783, 1475983893, 'O'),
(90, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 10000, '0.75890', 'close', '-3.9480', '-3.9480', 1475985428, 0, 'O'),
(91, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 5000, '0.75890', 'close', '-1.9740', '0.0000', 1475986473, 1475986522, 'O'),
(92, 'AUDUSD', 'Bought AUDUSD @ 0.7589', 'B', 5000, '0.75890', 'open', '0.0000', '-1.9740', 1475986563, 0, 'O'),
(93, 'EURJPY', 'Bought EURJPY @ 115.2920', 'B', 5000, '115.29200', 'open', '0.0000', '-0.2560', 1475986572, 0, 'O'),
(94, 'EURUSD', 'Sold EURUSD @ 1.1200', 'S', 100000, '1.12000', 'open', '0.0000', '-79.0200', 1476028993, 0, 'O'),
(96, 'AUDUSD', 'Bought AUDUSD @ 0.7597', 'B', 50000, '0.75970', 'open', '0.0000', '-13.1660', 1476060582, 0, 'O'),
(97, 'EURAUD', 'Sold EURAUD @ 1.4720', 'S', 20000, '1.47200', 'close', '-18.0054', '0.0000', 1476061770, 1476062709, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_order_type`
--

CREATE TABLE `transaction_order_type` (
  `order_type_id` char(1) NOT NULL DEFAULT 'O'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_order_type`
--

INSERT INTO `transaction_order_type` (`order_type_id`) VALUES
('O');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `transaction_type_id` varchar(1) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`transaction_type_id`, `description`) VALUES
('D', 'Fund Deposit'),
('O', 'Order');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `title_salute` varchar(4) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `phone` varchar(12) NOT NULL,
  `country` varchar(70) NOT NULL,
  `address_1` varchar(200) NOT NULL,
  `address_2` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `suburb` varchar(100) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `base_currency` varchar(3) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `account_balance` decimal(15,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `title_salute`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `phone`, `country`, `address_1`, `address_2`, `state`, `suburb`, `post_code`, `base_currency`, `email_id`, `password`, `created`, `is_active`, `last_login`, `is_admin`, `account_balance`) VALUES
(10, 'Mr', 'Saurya', 'Dhwoj', 'Acharya', '1990-01-21', '416749696', 'Australia', 'Unit 7, 14 Hillstreet', 'Campsie', 'NSW', 'Campsie', '2194', 'AUD', 'cool.saurez@gmail.com', '$2y$12$enfEGvMiSogyZ9S3TGcvnO5nkYJwwOjxhqOVtDOJQy7eBvgvfwcby', '2016-08-10 09:40:31', 1, NULL, 0, '1182.39'),
(15, 'Mrs', 'Smita ', '', 'Basnet', '1990-08-03', '0450232134', 'Australia', 'Unit 7, 14 Hillstreet', 'Campsie', 'NSW', 'Campsie', '2194', 'AUD', 'smita.sb11@gmail.com', '$2y$12$2x65gmTloZrLOFuCDz/mQu7QX4u8ekBp7ONxN1TLHtx0GU8lCOLV2', '2016-09-01 13:32:38', 1, NULL, 0, '2394.35'),
(16, 'Mr', 'Govinda', '', 'Thapa', '1990-02-01', '422331233', 'Nepal', 'Shaftesbury Street', '', 'NSW', 'Carlton', '2020', 'AUD', 'govinda.thapa1992@yahoo.com', '$2y$12$CkYTMVRDFCeQo4najAvudemTaFPlH7trBQ6Rtp/.kX88inYxx7oUi', '2016-10-02 14:57:19', 0, NULL, 0, '0.00'),
(17, 'Mr', 'Admin', '', 'Admin', '0000-00-00', '', 'Australia', '', '', '', '', '', '', 'admin', '$2y$12$2x65gmTloZrLOFuCDz/mQu7QX4u8ekBp7ONxN1TLHtx0GU8lCOLV2', '2016-10-09 05:03:55', 1, NULL, 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_account_summary`
--

CREATE TABLE `user_account_summary` (
  `user_id` int(11) NOT NULL,
  `marginal_balance` decimal(15,4) NOT NULL,
  `realized_pl` decimal(15,4) NOT NULL,
  `unrealized_pl` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_activation`
--

CREATE TABLE `user_activation` (
  `activation_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_expire` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activation`
--

INSERT INTO `user_activation` (`activation_id`, `token`, `user_id`, `is_expire`) VALUES
(3, '84d6f66dc99a7d995e006539eb4704dd', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_card_detail`
--

CREATE TABLE `user_card_detail` (
  `card_id` int(11) NOT NULL,
  `card_holder_name` varchar(200) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `ccv` int(4) NOT NULL,
  `expiry` varchar(12) NOT NULL,
  `card_type` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_card_detail`
--

INSERT INTO `user_card_detail` (`card_id`, `card_holder_name`, `card_number`, `ccv`, `expiry`, `card_type`, `user_id`) VALUES
(7, 'Saurya Dhwoj Acharya', '5555555555554444', 321, '05 / 2021', 'mastercard', 10),
(12, 'Saurya Basnet', '5326555208821834', 630, '05 / 2019', 'mastercard', 15),
(13, 'Govinda Thapa', '5105105105105100', 232, '02 / 2020', 'mastercard', 16);

-- --------------------------------------------------------

--
-- Table structure for table `user_password_reset`
--

CREATE TABLE `user_password_reset` (
  `reset_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `time` int(10) UNSIGNED NOT NULL,
  `expire` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_security_answer`
--

CREATE TABLE `user_security_answer` (
  `answer_id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_security_answer`
--

INSERT INTO `user_security_answer` (`answer_id`, `q_id`, `user_id`, `answer`) VALUES
(7, 4, 10, 'Kumudini'),
(12, 2, 15, 'Kathmandu'),
(13, 2, 16, 'Sydney');

-- --------------------------------------------------------

--
-- Table structure for table `user_visit`
--

CREATE TABLE `user_visit` (
  `visit_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `platform` varchar(150) NOT NULL,
  `browser` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_visit`
--

INSERT INTO `user_visit` (`visit_id`, `time`, `platform`, `browser`) VALUES
(1, '2016-10-09 10:46:18', 'Windows', 'Chrome'),
(2, '2016-10-09 10:50:16', 'Windows', 'Chrome'),
(3, '2016-10-09 10:52:21', 'Windows', 'Chrome'),
(4, '2016-10-09 10:52:49', 'Windows', 'Chrome'),
(5, '2016-10-09 11:29:33', 'Windows', 'Firefox'),
(6, '2016-10-09 11:29:38', 'Windows', 'Firefox'),
(7, '2016-10-09 11:29:49', 'Windows', 'Internet Explorer'),
(8, '2016-10-09 11:29:59', 'Windows', 'Firefox'),
(9, '2016-10-09 11:30:08', 'Windows', 'Firefox'),
(10, '2016-10-09 11:30:40', 'Windows', 'Chrome'),
(11, '2016-10-09 14:31:52', 'Windows', 'Chrome'),
(12, '2016-10-09 14:32:17', 'Windows', 'Chrome'),
(13, '2016-10-09 14:35:39', 'Windows', 'Chrome'),
(14, '2016-10-09 16:01:49', 'Windows', 'Chrome'),
(15, '2016-10-09 16:02:26', 'Windows', 'Chrome'),
(16, '2016-10-09 16:02:28', 'Windows', 'Chrome'),
(17, '2016-10-09 16:02:36', 'Windows', 'Chrome'),
(18, '2016-10-09 16:03:45', 'Windows', 'Chrome'),
(19, '2016-10-10 00:44:35', 'Windows', 'Chrome'),
(20, '2016-10-10 00:44:37', 'Windows', 'Chrome'),
(21, '2016-10-10 00:44:44', 'Windows', 'Chrome'),
(22, '2016-10-10 00:44:56', 'Windows', 'Chrome'),
(23, '2016-10-10 00:49:09', 'Windows', 'Chrome'),
(24, '2016-10-10 00:50:10', 'Windows', 'Chrome'),
(25, '2016-10-10 00:52:28', 'Windows', 'Chrome'),
(26, '2016-10-10 01:06:44', 'Windows', 'Chrome'),
(27, '2016-10-10 01:08:30', 'Windows', 'Chrome'),
(28, '2016-10-10 01:08:33', 'Windows', 'Chrome'),
(29, '2016-10-10 01:08:43', 'Windows', 'Chrome'),
(30, '2016-10-10 01:08:49', 'Windows', 'Chrome'),
(31, '2016-10-10 01:08:54', 'Windows', 'Chrome'),
(32, '2016-10-10 01:11:20', 'Windows', 'Chrome'),
(33, '2016-10-10 01:18:03', 'Windows', 'Chrome'),
(34, '2016-10-10 01:31:29', 'Windows', 'Chrome'),
(35, '2016-10-10 02:41:06', 'Windows', 'Chrome'),
(36, '2016-10-10 02:41:11', 'Windows', 'Chrome'),
(37, '2016-10-10 02:43:26', 'Windows', 'Chrome'),
(38, '2016-10-10 02:43:56', 'Windows', 'Chrome'),
(39, '2016-10-10 02:44:12', 'Windows', 'Chrome'),
(40, '2016-10-10 02:44:31', 'Windows', 'Chrome'),
(41, '2016-10-10 02:45:07', 'Windows', 'Chrome'),
(42, '2016-10-10 02:45:22', 'Windows', 'Chrome'),
(43, '2016-10-10 02:48:23', 'Windows', 'Chrome'),
(44, '2016-10-10 02:48:40', 'Windows', 'Chrome'),
(45, '2016-10-10 02:48:48', 'Windows', 'Chrome'),
(46, '2016-10-10 02:49:06', 'Windows', 'Chrome'),
(47, '2016-10-10 02:49:17', 'Windows', 'Chrome'),
(48, '2016-10-10 02:51:34', 'Windows', 'Chrome'),
(49, '2016-10-10 02:53:36', 'Windows', 'Chrome'),
(50, '2016-10-10 02:54:26', 'Windows', 'Chrome'),
(51, '2016-10-10 02:54:36', 'Windows', 'Chrome'),
(52, '2016-10-10 02:55:54', 'Windows', 'Chrome'),
(53, '2016-10-10 02:56:21', 'Windows', 'Chrome'),
(54, '2016-10-10 02:58:33', 'Windows', 'Chrome'),
(55, '2016-10-10 02:59:13', 'Windows', 'Chrome'),
(56, '2016-10-10 03:00:24', 'Windows', 'Chrome'),
(57, '2016-10-10 03:01:50', 'Windows', 'Chrome'),
(58, '2016-10-10 03:02:23', 'Windows', 'Chrome'),
(59, '2016-10-10 03:02:47', 'Windows', 'Chrome'),
(60, '2016-10-10 03:03:40', 'Windows', 'Chrome');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `security_questions`
--
ALTER TABLE `security_questions`
  ADD PRIMARY KEY (`q_id`);

--
-- Indexes for table `trading_type`
--
ALTER TABLE `trading_type`
  ADD PRIMARY KEY (`trading_type_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_type_id` (`transaction_type_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_deposit`
--
ALTER TABLE `transaction_deposit`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `deposit_type_id` (`deposit_type_id`);

--
-- Indexes for table `transaction_deposit_type`
--
ALTER TABLE `transaction_deposit_type`
  ADD PRIMARY KEY (`deposit_type_id`);

--
-- Indexes for table `transaction_order`
--
ALTER TABLE `transaction_order`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `order_type_id` (`order_type_id`);

--
-- Indexes for table `transaction_order_type`
--
ALTER TABLE `transaction_order_type`
  ADD PRIMARY KEY (`order_type_id`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`transaction_type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_account_summary`
--
ALTER TABLE `user_account_summary`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_activation`
--
ALTER TABLE `user_activation`
  ADD PRIMARY KEY (`activation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_card_detail`
--
ALTER TABLE `user_card_detail`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  ADD PRIMARY KEY (`reset_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_security_answer`
--
ALTER TABLE `user_security_answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `q_id` (`q_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_visit`
--
ALTER TABLE `user_visit`
  ADD PRIMARY KEY (`visit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `security_questions`
--
ALTER TABLE `security_questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user_activation`
--
ALTER TABLE `user_activation`
  MODIFY `activation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_card_detail`
--
ALTER TABLE `user_card_detail`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  MODIFY `reset_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_security_answer`
--
ALTER TABLE `user_security_answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_visit`
--
ALTER TABLE `user_visit`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_type` (`transaction_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_deposit`
--
ALTER TABLE `transaction_deposit`
  ADD CONSTRAINT `transaction_deposit_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_deposit_ibfk_2` FOREIGN KEY (`deposit_type_id`) REFERENCES `transaction_deposit_type` (`deposit_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_order`
--
ALTER TABLE `transaction_order`
  ADD CONSTRAINT `transaction_order_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_order_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `trading_type` (`trading_type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_order_ibfk_3` FOREIGN KEY (`order_type_id`) REFERENCES `transaction_order_type` (`order_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_account_summary`
--
ALTER TABLE `user_account_summary`
  ADD CONSTRAINT `user_account_summary_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_activation`
--
ALTER TABLE `user_activation`
  ADD CONSTRAINT `user_activation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_card_detail`
--
ALTER TABLE `user_card_detail`
  ADD CONSTRAINT `user_card_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_password_reset`
--
ALTER TABLE `user_password_reset`
  ADD CONSTRAINT `user_password_reset_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_security_answer`
--
ALTER TABLE `user_security_answer`
  ADD CONSTRAINT `user_security_answer_ibfk_1` FOREIGN KEY (`q_id`) REFERENCES `security_questions` (`q_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_security_answer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
