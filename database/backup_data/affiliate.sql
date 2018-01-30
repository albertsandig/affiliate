-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2017 at 04:20 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `affiliate`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_check_email`(
	IN 	this_email VARCHAR(100),
	OUT	is_email_already_exist BOOLEAN
)
BEGIN

	SELECT count(A.email) > 0 INTO is_email_already_exist
	FROM user_credential AS A
	WHERE UPPER(A.email) = UPPER (this_email);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_create_user_registration`(
	this_email VARCHAR(100),
	this_password VARCHAR(50),
	this_firstname VARCHAR(100),
	this_lastname VARCHAR(100),
	this_gender VARCHAR(100),
	this_address VARCHAR(200),
	this_mobile_no VARCHAR(100),
	this_birthdate DATE,
	this_user_type_no INT
)
BEGIN
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
	
	-- INSERT USER CREDENTIAL
	INSERT INTO user_credential(
		email,
		password,
		type_no
	) VALUES (
		this_email,
		MD5(this_password),
		this_user_type_no
	);
	
	SELECT user_no INTO this_user_no
	FROM user_credential
	WHERE 
		email = this_email;
		
	-- INSERT USER INFORMATION
	INSERT INTO user_info(
		user_no,
		firstname,
		lastname,
		gender,
		address,
		mobile_number,
		birthday
	) VALUES (
		this_user_no,
		this_firstname,
		this_lastname,
		this_gender,
		this_address,
		this_mobile_no,
		this_birthdate
	);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_login_user`(
	IN 	this_email VARCHAR(100),
	IN		this_password VARCHAR(100)
)
BEGIN
	
	UPDATE user_credential AS A
	SET is_online = TRUE
	WHERE 
		UPPER(A.email) = UPPER (this_email) AND
		A.password = md5(this_password); 
	
	SELECT  	A.user_no,
				A.email,
				A.type_no,
				C.name AS user_type,
				CONCAT(B.firstname, " ",  B.lastname) AS name,
				B.img_source AS profile_pic
	FROM user_credential AS A
	LEFT JOIN user_info AS B
		USING (user_no)
	INNER JOIN user_type AS C
		USING (type_no)
	WHERE 
		UPPER(A.email) = UPPER (this_email) AND
		A.password = md5(this_password);
	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procedure_logout_user`(
	IN 	this_user_no INTEGER
)
BEGIN
	
	UPDATE user_credential AS A
	SET is_online = FALSE
	WHERE 
		A.user_no = this_user_no;
	
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_credential`
--

CREATE TABLE IF NOT EXISTS `user_credential` (
  `user_no` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type_no` int(11) NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_no`),
  UNIQUE KEY `email` (`email`),
  KEY `type_no` (`type_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_credential`
--

INSERT INTO `user_credential` (`user_no`, `email`, `password`, `type_no`, `is_online`) VALUES
(1, 'albert.sandig1@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 0),
(4, 'admin@yahoo.com', '3325b3371681e9381a2c8610f34aaae7', 1, 0),
(9, 'amycurambao@yahoo.com', 'd9b7484e319a6097eaa4575b61b5f899', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_no` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `verify` tinyint(1) DEFAULT '0',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_source` text,
  UNIQUE KEY `user_no` (`user_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_no`, `firstname`, `lastname`, `age`, `birthday`, `gender`, `address`, `mobile_number`, `verify`, `create_date`, `img_source`) VALUES
(9, 'Amy', 'Curambao', NULL, '0000-00-00', 'Female', '', '', 0, '2017-10-31 01:40:53', 'https://i.pinimg.com/736x/36/b6/c1/36b6c14f9719de74db3c863b20857750--no-facebook-profile-pictures.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `type_no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`type_no`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type_no`, `name`) VALUES
(2, 'ADMINISTRATOR'),
(1, 'SUPERUSER'),
(3, 'USER');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_credential`
--
ALTER TABLE `user_credential`
  ADD CONSTRAINT `user_credential_ibfk_1` FOREIGN KEY (`type_no`) REFERENCES `user_type` (`type_no`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `user_credential` (`user_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
