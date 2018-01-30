-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2018 at 09:52 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.0.26

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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_approve_withdrawal` (`this_withdrawal_transaction_id` INTEGER, `this_reference_id` VARCHAR(200))  BEGIN

	SELECT 	A.status
	INTO @w_status
	FROM	withdrawal_transaction AS A
	WHERE	
		A.withdrawal_transaction_id = this_withdrawal_transaction_id;
		
	IF @w_status <> 'PENDING' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Transaction is not pending.';		
	ELSE 
		UPDATE withdrawal_transaction
		SET 	status = 'APPROVED',
				reference_id = this_reference_id,
				approve_date = CURRENT_TIMESTAMP
		WHERE withdrawal_transaction_id = this_withdrawal_transaction_id;
		
	END IF;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_check_email` (IN `this_email` VARCHAR(100), OUT `is_email_already_exist` BOOLEAN)  BEGIN

	SELECT count(A.email) > 0 INTO is_email_already_exist
	FROM user_info AS A
	WHERE UPPER(A.email) = UPPER (this_email);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_create_ads` (`this_code` VARCHAR(200), `this_ad_type` INTEGER, `this_currency_type` INTEGER, `this_duration` INTEGER, `this_duration_unit` VARCHAR(200), `this_url` VARCHAR(200), `this_content` VARCHAR(200), `this_amount` DOUBLE(20,2), `this_user_no` INTEGER)  BEGIN

	SELECT 
		COUNT(A.code) > 0
	INTO @is_not_unique_code
	FROM transaction_type AS A
	WHERE A.code = this_code;
	
	IF @is_not_unique_code THEN
		SET @message_text =  concat('The code "', this_code, '" is aldready exist.');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
	
	INSERT INTO transaction_type(
		code, 
		ads_type_id, 
		currency_type_id, 
		duration, 
		duration_unit, 
		amount, 
		url,
		content
	) VALUES (
		this_code		,		
	   this_ad_type			,
	   this_currency_type	,
	   this_duration			,
	   this_duration_unit	,
	   this_amount	,
		this_url		,
		this_content
	);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_create_user_registration` (`this_email` VARCHAR(100), `this_password` VARCHAR(50), `this_firstname` VARCHAR(100), `this_lastname` VARCHAR(100), `this_gender` VARCHAR(100), `this_address` VARCHAR(200), `this_mobile_no` VARCHAR(100), `this_birthdate` DATE, `this_user_type_no` INT)  BEGIN
	DECLARE this_user_no INT DEFAULT 0;

	CALL	procedure_check_email(
		this_email,
		@is_email_already_exist
	);
	
	-- CHECK IF USER ALREADY EXIST
	IF @is_email_already_exist THEN
		 SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Email already exist.';
	END IF;
	
	-- INSERT USER INFORMATION
	INSERT INTO user_info(
		email,
		password,
		type_no,
		firstname,
		lastname,
		gender,
		address,
		mobile_number,
		birthday
	) VALUES (
		this_email,
		MD5(this_password),
		this_user_type_no,
		this_firstname,
		this_lastname,
		this_gender,
		this_address,
		this_mobile_no,
		this_birthdate
	);
	
	SELECT A.user_no
	INTO 	@this_user_no 
	FROM user_info  AS A
	WHERE A.email = this_email;
	
	INSERT INTO user_wallet(
		user_no					,
		currency_type_id		
	) VALUES
	(@this_user_no ,1),
	(@this_user_no ,2);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_deposit_ads` (IN `this_user_no` INTEGER, IN `this_trasaction_code` VARCHAR(100), OUT `this_url` VARCHAR(300))  BEGIN
	SELECT 	transaction_type_id,
				amount,
				currency_type_id,
				duration,
				duration_unit,
				content	
	INTO 	@id, @amount, @currency_id	,@time_duration, @unit,this_url
	FROM transaction_type
	WHERE code = this_trasaction_code;
	
	/*	CHECK IF USER ALREADY CLAIM */
	SELECT count(A.transaction_id) > 0
	INTO @is_already_claimed
	FROM deposit_transactions AS A
	INNER JOIN transaction_type AS B
		USING(transaction_type_id)
	WHERE  A.user_no = this_user_no AND
			 A.end_time >= CURRENT_TIMESTAMP AND 
			 B.transaction_type_id = @id;
			 
	IF @id IS NULL THEN
		SET @message_text =  concat(this_trasaction_code,' code does not exist.');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
			 
	IF @is_already_claimed THEN
		SET @message_text =  concat('You already claim in this ad please wait for ', @time_duration, ' ', @unit,'(s)');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
	
	INSERT INTO deposit_transactions(
		user_no					,
		transaction_type_id	,
		end_time	
	)VALUES(
		this_user_no,
		@id,
		CASE @unit
			WHEN 'MINUTE' THEN
				CURRENT_TIMESTAMP + INTERVAL @time_duration MINUTE
			ELSE
				CURRENT_TIMESTAMP + INTERVAL @time_duration SECOND
		END 
	);
	
	UPDATE user_wallet AS A
	SET amount = A.amount + @amount
	WHERE A.user_no = this_user_no AND
			A.currency_type_id = @currency_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_login_user` (IN `this_email` VARCHAR(100), IN `this_password` VARCHAR(100))  BEGIN
	
	UPDATE user_info AS A
	SET is_online = TRUE
	WHERE 
		UPPER(A.email) = UPPER (this_email) AND
		A.password = md5(this_password); 
	
	SELECT  	A.user_no,
				A.email,
				A.type_no,
				B.name AS user_type,
				CONCAT(A.firstname, " ",  A.lastname) AS name,
				A.img_source AS profile_pic
	FROM user_info AS A
	INNER JOIN user_type AS B
		USING (type_no)
	WHERE 
		UPPER(A.email) = UPPER (this_email) AND
		A.password = md5(this_password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_logout_user` (IN `this_user_no` INTEGER)  BEGIN
	
	UPDATE user_info AS A
	SET is_online = FALSE
	WHERE 
		A.user_no = this_user_no;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_request_withdrawal` (`this_user_no` INTEGER, `this_amount` DOUBLE(20,2))  BEGIN
	SELECT
		A.peso_address,
		A.verify
	INTO @address, @verify
	FROM user_info AS A
	WHERE A.user_no = this_user_no;
	
	SELECT 
		A.amount
	INTO @amount
	FROM user_wallet AS A
	WHERE A.currency_type_id = 1 AND
			A.user_no = this_user_no;
	
	IF NOT @verify THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Your account is not yet verified. Please verfiy your email address first.';			
	END IF;
	
	IF this_amount < 1000 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Amount must be at least 1000 pesos.';			
	END IF;
	
	IF @amount < this_amount THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Balance must be greater the requested amount.';			
	END IF;
	
	IF @address = '' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Empty address';			
	END IF;
	
	INSERT INTO withdrawal_transaction(
		user_no,			
		status,			
		amount,
		peso_address
	)	VALUES(
		this_user_no,
		'PENDING',
		this_amount,
		@address
	);
	
	UPDATE user_wallet AS A
	SET	amount = A.amount - this_amount
	WHERE A.currency_type_id = 1 AND
			A.user_no = this_user_no;
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_update_ads` (`this_id` INTEGER, `this_code` VARCHAR(200), `this_ad_type` INTEGER, `this_currency_type` INTEGER, `this_duration` INTEGER, `this_duration_unit` VARCHAR(200), `this_url` VARCHAR(200), `this_content` VARCHAR(200), `this_amount` DOUBLE(20,2), `this_user_no` INTEGER)  BEGIN

	SELECT 
		COUNT(A.code) > 1
	INTO @is_not_unique_code
	FROM transaction_type  AS A
	WHERE A.code = this_code;
	
	IF @is_not_unique_code THEN
		SET @message_text =  concat('The code "', this_code, '" is aldready exist.');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
	
	UPDATE transaction_type AS A
	SET 
		code = this_code,		
	   ads_type_id = this_ad_type,
	   currency_type_id = this_currency_type,
		duration  = this_duration,
		duration_unit = this_duration_unit,
		amount = this_amount,
		url = this_url,
		content = this_content
	WHERE A.transaction_type_id = this_id;
	
END$$

DELIMITER ;

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
  `name` varchar(20) DEFAULT NULL,
  `icon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency_type`
--

INSERT INTO `currency_type` (`currency_type_id`, `name`, `icon`) VALUES
(1, 'PHP', 'fa-ruble'),
(2, 'POINTS', 'fa-star-o');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `_day` int(31) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`_day`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

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
-- Table structure for table `refer`
--

CREATE TABLE `refer` (
  `referedBy` int(11) NOT NULL,
  `user_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer`
--

INSERT INTO `refer` (`referedBy`, `user_no`) VALUES
(1, 3);

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

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`transaction_type_id`, `code`, `ads_type_id`, `currency_type_id`, `duration`, `duration_unit`, `amount`, `url`, `content`) VALUES
(1, 'REWARD-P', 2, 2, 30, 'MINUTE', 10, 'http://ho.lazada.com.ph/SHUrUY?url=https%3A%2F%2Fwww.lazada.com.ph%2Fcherry-mobile-onrev-5-in-display-4gb-black-46709123.html%3Foffer_id%3D%7Boffer_id%7D%26affiliate_id%3D%7Baffiliate_id%7D%26offer_name%3D%7Boffer_name%7D%26affiliate_name%3D%7Baffiliate_name%7D%26transaction_id%3D%7Btransaction_id%7D', ''),
(2, 'REWARD-M', 1, 1, 30, 'MINUTE', 0.1, 'http://ho.lazada.com.ph/SHUrUY?url=https%3A%2F%2Fwww.lazada.com.ph%2Fcherry-mobile-flare-p1-gold-64697209.html%3Foffer_id%3D%7Boffer_id%7D%26affiliate_id%3D%7Baffiliate_id%7D%26offer_name%3D%7Boffer_name%7D%26affiliate_name%3D%7Baffiliate_name%7D%26transaction_id%3D%7Btransaction_id%7D', ''),
(3, 'QUIZ', 1, 2, 5, 'SECOND', 2.5, '', '');

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
(1, 'albert.sandig1@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 'Albert', 'Sandig', 22, '1995-11-15', 'Male', 'purok baho tae', '+639359430897', 'https://scontent.fceb2-2.fna.fbcdn.net/v/t1.0-9/26112453_1739534646077527_8819383326079284985_n.jpg?oh=fe60f2feaa98247195eff7c281e1c0c1&oe=5AE247EE', '', '2018-01-15 10:16:55', 1, 1),
(3, 'amycurambao@yahoo.com', '4112a42d8da2c7651e166a588e6dce64', 3, 'Amy', 'Curambao', 23, '1994-12-29', 'Female', ' \"', '+631231231232', '', 'SADSADAS2312SADASDASFA213213', '2018-01-15 11:19:31', 0, 1),
(4, 'sepejoan11@gmail.com', 'af0e41f8c0215e198dbeaf0c76942123', 3, 'Joan', 'Sepe', NULL, '0000-00-00', 'Female', '', '+630936332091', NULL, NULL, '2018-01-19 08:49:56', 1, 0);

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
  `currency_type_id` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`user_no`, `currency_type_id`, `amount`) VALUES
(1, 1, 10000),
(1, 2, 10000),
(3, 1, 10000.1),
(3, 2, 10030),
(4, 1, 0),
(4, 2, 0);

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
-- Indexes for table `refer`
--
ALTER TABLE `refer`
  ADD KEY `referedBy` (`referedBy`),
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
ALTER TABLE `user_info` ADD FULLTEXT KEY `email_3` (`email`,`firstname`,`lastname`,`address`,`mobile_number`);

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
  MODIFY `transaction_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaction_type`
--
ALTER TABLE `transaction_type`
  MODIFY `transaction_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `refer`
--
ALTER TABLE `refer`
  ADD CONSTRAINT `refer_ibfk_1` FOREIGN KEY (`referedBy`) REFERENCES `user_info` (`user_no`),
  ADD CONSTRAINT `refer_ibfk_2` FOREIGN KEY (`user_no`) REFERENCES `user_info` (`user_no`);

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
