-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 11:47 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affiliate2`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads_type`
--

CREATE TABLE `ads_type` (
  `ads_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads_type`
--

INSERT INTO `ads_type` (`ads_type_id`, `name`) VALUES
(1, 'LAZADA'),
(2, 'PROPELLER');

-- --------------------------------------------------------

--
-- Table structure for table `currency_type`
--

CREATE TABLE `currency_type` (
  `currency_type_id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_type`
--

INSERT INTO `currency_type` (`currency_type_id`, `name`) VALUES
(1, 'MONEY'),
(2, 'POINTS');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `_day` int(31) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_transactions`
--

CREATE TABLE `deposit_transactions` (
  `transaction_id` int(200) NOT NULL,
  `user_no` int(200) NOT NULL,
  `transaction_type_id` int(11) DEFAULT NULL,
  `deposit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_no` int(11) NOT NULL,
  `event_name` varchar(40) NOT NULL,
  `started_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ended_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `event_no` int(11) NOT NULL,
  `user_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE `transaction_type` (
  `transaction_type_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `ads_type_id` int(11) NOT NULL,
  `currency_type_id` int(11) NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `duration_unit` varchar(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_no` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type_no` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `img_source` text,
  `peso_address` varchar(200) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_online` tinyint(1) DEFAULT '0',
  `verify` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_no`, `email`, `password`, `type_no`, `firstname`, `lastname`, `age`, `birthday`, `gender`, `address`, `mobile_number`, `img_source`, `peso_address`, `create_date`, `is_online`, `verify`) VALUES
(1, 'albert.sandig1@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-15 10:16:55', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type_no` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_no`, `name`) VALUES
(2, 'ADMINISTRATOR'),
(1, 'SUPERUSER'),
(3, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `user_no` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `currency_type_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`user_no`, `name`, `currency_type_id`, `amount`) VALUES
(1, 'PHILIPPINE MONEY', 1, 0),
(1, 'POINTS', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_transaction`
--

CREATE TABLE `withdrawal_transaction` (
  `withdrawal_transaction_id` int(200) NOT NULL,
  `user_no` int(200) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `reference_id` varchar(200) DEFAULT NULL,
  `peso_address` varchar(200) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads_type`
--
ALTER TABLE `ads_type`
  ADD PRIMARY KEY (`ads_type_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `currency_type`
--
ALTER TABLE `currency_type`
  ADD PRIMARY KEY (`currency_type_id`);

--
-- Indexes for table `deposit_transactions`
--
ALTER TABLE `deposit_transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transaction_type_id` (`transaction_type_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_no`),
  ADD UNIQUE KEY `event_name` (`event_name`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD KEY `event_no` (`event_no`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD PRIMARY KEY (`transaction_type_id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `currency_type_id` (`currency_type_id`),
  ADD KEY `ads_type_id` (`ads_type_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_no`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `peso_address` (`peso_address`),
  ADD KEY `type_no` (`type_no`);
ALTER TABLE `user_info` ADD FULLTEXT KEY `email_2` (`email`,`firstname`,`lastname`,`address`,`mobile_number`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type_no`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD KEY `currency_type_id` (`currency_type_id`),
  ADD KEY `user_no` (`user_no`);

--
-- Indexes for table `withdrawal_transaction`
--
ALTER TABLE `withdrawal_transaction`
  ADD PRIMARY KEY (`withdrawal_transaction_id`),
  ADD UNIQUE KEY `reference_id` (`reference_id`),
  ADD KEY `user_no` (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads_type`
--
ALTER TABLE `ads_type`
  MODIFY `ads_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currency_type`
--
ALTER TABLE `currency_type`
  MODIFY `currency_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deposit_transactions`
--
ALTER TABLE `deposit_transactions`
  MODIFY `transaction_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `type_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdrawal_transaction`
--
ALTER TABLE `withdrawal_transaction`
  MODIFY `withdrawal_transaction_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit_transactions`
--
ALTER TABLE `deposit_transactions`
  ADD CONSTRAINT `deposit_transactions_ibfk_1` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_type` (`transaction_type_id`),
  ADD CONSTRAINT `deposit_transactions_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_info` (`user_no`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user_info` (`user_no`);

--
-- Constraints for table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`event_no`) REFERENCES `event` (`event_no`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_info` (`user_no`);

--
-- Constraints for table `transaction_type`
--
ALTER TABLE `transaction_type`
  ADD CONSTRAINT `transaction_type_ibfk_1` FOREIGN KEY (`currency_type_id`) REFERENCES `currency_type` (`currency_type_id`),
  ADD CONSTRAINT `transaction_type_ibfk_2` FOREIGN KEY (`ads_type_id`) REFERENCES `ads_type` (`ads_type_id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`type_no`) REFERENCES `user_type` (`type_no`);

--
-- Constraints for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD CONSTRAINT `user_wallet_ibfk_1` FOREIGN KEY (`currency_type_id`) REFERENCES `currency_type` (`currency_type_id`),
  ADD CONSTRAINT `user_wallet_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_info` (`user_no`);

--
-- Constraints for table `withdrawal_transaction`
--
ALTER TABLE `withdrawal_transaction`
  ADD CONSTRAINT `withdrawal_transaction_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_info` (`user_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
