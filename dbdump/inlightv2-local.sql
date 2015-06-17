-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2015 at 03:13 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inlightv2`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAccount`(OUT `_error` VARCHAR(100),IN `_ID` INT(10),IN `_placement_ID` INT(10),IN `_position` VARCHAR(5),IN `_type` VARCHAR(10),IN `_amount` INT(10),IN `_username` VARCHAR(100))
func:BEGIN

DECLARE acc_count INT DEFAULT 0;
DECLARE _user_ID INT DEFAULT 0;
DECLARE tmp1 INT DEFAULT 0;

DECLARE finished INT DEFAULT 0;
DECLARE ancestors TEXT DEFAULT '';
DECLARE pointer_val INT DEFAULT _placement_ID;
DECLARE pointer CURSOR FOR SELECT ID FROM `users` WHERE ID = pointer_val;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
SET _error = "";

-- check if account is 7 
SELECT COUNT(a.ID) INTO acc_count FROM users AS a, users AS b WHERE a.name = b.name AND b.ID = _ID AND b._status = 1;
IF acc_count > 6 THEN SET _error = "USER-MAX"; LEAVE func; END IF;
-- check if crossline
SELECT COUNT(a.user_ID) INTO tmp1 FROM `user-meta` as a WHERE a.ancestors LIKE CONCAT('%', _ID,'%') AND a.user_ID = _placement_ID;
IF tmp1 = 0 THEN SET _error = "CROSSLINE"; LEAVE func; END IF; 
-- check if valid placement id
SELECT COUNT(a.user_ID) INTO tmp1 FROM `user-meta` as a WHERE a.placement_ID = _placement_ID AND a.position = _position;
IF tmp1 > 0 THEN SET _error = "OCCUPIED"; LEAVE func; END IF; 


INSERT INTO `users`(`name`,`password`,`email`,`mobile`,`address`,`username`,`photo`)
SELECT `name`,`password`,`email`,`mobile`,`address`,_username,`photo` FROM `users` WHERE ID = _ID;
SET _user_ID = LAST_INSERT_ID();

-- // but first get the ancestors
	-- start sa loop
	OPEN pointer;
	runtiltop : LOOP
		SET ancestors = CONCAT(ancestors,pointer_val);
		SET ancestors = CONCAT(ancestors,',');

		IF pointer_val = 1 THEN LEAVE runtiltop; END IF;
		IF finished = 1 THEN LEAVE runtiltop; END IF;
		
		SELECT a.placement_ID INTO pointer_val FROM `user-meta` AS a WHERE a.user_ID = pointer_val;				
	END LOOP runtiltop;
	CLOSE pointer;

INSERT INTO `user-meta`(`user_ID`,`sponsor_ID`,`placement_ID`,`position`,`ancestors`,`_type`,`date_reg`)
VALUES(_user_ID,_ID,_placement_ID,_position,ancestors,_type,CURDATE());

INSERT INTO `transactions` (status,user_ID,`type`,date_trans, amount, notes)
VALUES (1,_ID,"Add Account",CURDATE(),_amount,"COMMISSION DEDUCTION");

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `status` int(1) DEFAULT NULL,
  `user_ID` int(10) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `date_trans` date DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `notes` text,
  `count` int(4) DEFAULT NULL COMMENT 'for act codes only',
  `acc_type` varchar(20) DEFAULT NULL COMMENT 'for act codes only',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`ID`, `status`, `user_ID`, `type`, `date_trans`, `amount`, `notes`, `count`, `acc_type`) VALUES
(3, 1, 1, 'Widthraw', '2015-05-22', 10, '-', 0, NULL),
(11, 1, 1, 'Add Account', '2015-05-25', 3480, 'COMMISSION DEDUCTION', 0, NULL),
(19, 0, 1, 'Buy Codes', '2015-05-26', 34900, '-', 5, 'Ultimate'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(21, 1, 1, 'Add Account', '2015-05-29', 6980, 'COMMISSION DEDUCTION', NULL, NULL),
(22, 1, 1, 'Add Account', '2015-05-29', 1, 'COMMISSION DEDUCTION', NULL, NULL),
(23, 1, 1, 'Add Account', '2015-05-29', 1, 'COMMISSION DEDUCTION', NULL, NULL),
(24, 1, 1, 'Add Account', '2015-05-29', 1, 'COMMISSION DEDUCTION', NULL, NULL),
(25, 1, 1, 'Add Account', '2015-05-29', 1, 'COMMISSION DEDUCTION', NULL, NULL),
(26, 1, 1, 'Widthraw', '2015-06-06', 3000, '-', NULL, NULL),
(27, 1, 1, 'Add Account', '2015-06-06', 6980, 'COMMISSION DEDUCTION', NULL, NULL),
(28, 1, 1, 'Buy Codes', '2015-06-06', 17400, 'COMMISSION DEDUCTION', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user-codes`
--

CREATE TABLE IF NOT EXISTS `user-codes` (
  `user_ID` int(10) NOT NULL,
  `codes` varchar(10) NOT NULL,
  `code_type` varchar(10) DEFAULT NULL,
  `buy-date` date NOT NULL,
  `status` int(1) NOT NULL,
  `used_by` int(11) NOT NULL,
  `use-date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user-codes`
--

INSERT INTO `user-codes` (`user_ID`, `codes`, `code_type`, `buy-date`, `status`, `used_by`, `use-date`) VALUES
(1, 'd07aa264-0', 'Basic', '2015-05-26', 0, 0, '0000-00-00'),
(1, 'd0862a1f-0', 'Basic', '2015-05-26', 0, 0, '0000-00-00'),
(1, '476d5208-0', 'Premier', '2015-06-06', 0, 0, '0000-00-00'),
(1, '477ac729-0', 'Premier', '2015-06-06', 0, 0, '0000-00-00'),
(1, '4781a4d6-0', 'Premier', '2015-06-06', 0, 0, '0000-00-00'),
(1, '4790c448-0', 'Premier', '2015-06-06', 0, 0, '0000-00-00'),
(1, '4795ee45-0', 'Premier', '2015-06-06', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user-meta`
--

CREATE TABLE IF NOT EXISTS `user-meta` (
  `user_ID` int(10) NOT NULL,
  `sponsor_ID` int(10) NOT NULL,
  `placement_ID` int(10) NOT NULL,
  `position` varchar(5) DEFAULT NULL COMMENT 'Left | Right',
  `ancestors` text,
  `_type` varchar(10) DEFAULT NULL,
  `date_reg` date DEFAULT NULL,
  UNIQUE KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user-meta`
--

INSERT INTO `user-meta` (`user_ID`, `sponsor_ID`, `placement_ID`, `position`, `ancestors`, `_type`, `date_reg`) VALUES
(1, 0, 0, '0', '0', 'Ultimate', NULL),
(2, 1, 1, 'Left', '1,', 'Ultimate', NULL),
(3, 1, 1, 'Right', '1,', 'Ultimate', NULL),
(107, 2, 2, 'left', '2,1,', 'Ultimate', NULL),
(110, 1, 3, 'Right', '3,1,', 'Ultimate', NULL),
(111, 1, 107, 'Left', '107,2,1,', 'Ultimate', NULL),
(123, 1, 107, 'Right', '107,2,1,', 'Ultimate', '2015-05-29'),
(124, 1, 3, 'Left', '3,1,', 'Premier', '2015-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `user-payment`
--

CREATE TABLE IF NOT EXISTS `user-payment` (
  `user_ID` int(10) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `amount` int(7) NOT NULL,
  `code` text NOT NULL COMMENT 'only applicable for activation code payment type',
  `receipt_url` text NOT NULL,
  `date_payed` date DEFAULT NULL,
  UNIQUE KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user-payment`
--

INSERT INTO `user-payment` (`user_ID`, `payment_type`, `amount`, `code`, `receipt_url`, `date_payed`) VALUES
(0, '', 0, '', '', NULL),
(1, 'Activation Code', 1000, '12312', 'Avatar-The-Legend-Of-Korra-Wallpaper (1).jpg', NULL),
(2, 'BPI', 6000, '', 'The-Legend-Of-Korra-HD.jpg', NULL),
(3, 'Activation Code', 0, '123123', '', NULL),
(15, 'code', 6000, 'zxcv', '', NULL),
(16, 'code', 6000, 'zxcv', '', NULL),
(17, 'Activation Code', 6000, '123123', '', NULL),
(18, 'code', 6000, 'zxcv', '', NULL),
(19, 'Activation Code', 6000, '123123', '', NULL),
(20, 'Activation Code', 6000, '123123', '', NULL),
(21, 'Activation Code', 6000, '123123', '', NULL),
(22, 'Activation Code', 6000, '123123', '', NULL),
(23, 'Activation Code', 6000, '123123', '', NULL),
(24, 'Activation Code', 6000, '123123', '', NULL),
(25, 'Activation Code', 6000, '123123', '', NULL),
(26, 'Activation Code', 0, '123123', '', NULL),
(27, 'Activation Code', 6000, '123123', '', NULL),
(28, 'Activation Code', 6000, 'sdfsdf', '', NULL),
(29, 'code', 6000, 'zxcv', '', NULL),
(30, 'code', 6000, 'zxcv', '', NULL),
(31, 'code', 6000, 'zxcv', '', NULL),
(52, 'code', 6000, 'zxcv', '', NULL),
(66, 'code', 6000, 'zxcv', '', NULL),
(67, 'code', 6000, 'zxcv', '', NULL),
(68, 'code', 6000, 'zxcv', '', NULL),
(69, 'code', 6000, 'zxcv', '', NULL),
(70, 'code', 6000, 'zxcv', '', NULL),
(71, 'code', 6000, 'zxcv', '', NULL),
(72, 'code', 6000, 'zxcv', '', NULL),
(73, 'code', 6000, 'zxcv', '', NULL),
(74, 'code', 6000, 'zxcv', '', NULL),
(75, 'code', 6000, 'zxcv', '', NULL),
(76, 'code', 6000, 'zxcv', '', NULL),
(77, 'code', 6000, 'zxcv', '', NULL),
(78, 'code', 6000, 'zxcv', '', NULL),
(79, 'code', 6000, 'zxcv', '', NULL),
(80, 'code', 6000, 'zxcv', '', NULL),
(81, 'code', 6000, 'zxcv', '', NULL),
(82, 'code', 6000, 'zxcv', '', NULL),
(84, 'code', 6000, 'zxcv', '', NULL),
(85, 'code', 6000, 'zxcv', '', NULL),
(86, 'code', 6000, 'zxcv', '', NULL),
(87, 'code', 6000, 'zxcv', '', NULL),
(88, 'code', 6000, 'zxcv', '', NULL),
(89, 'code', 6000, 'zxcv', '', NULL),
(91, 'code', 6000, 'zxcv', '', NULL),
(92, 'code', 6000, 'zxcv', '', NULL),
(93, 'code', 6000, 'zxcv', '', NULL),
(94, 'code', 6000, 'zxcv', '', NULL),
(95, 'code', 6000, 'zxcv', '', NULL),
(96, 'code', 6000, 'zxcv', '', NULL),
(107, 'code', 6000, 'zxcv', '', NULL),
(108, 'Activation Code', 0, '123123', '', NULL),
(109, 'Activation Code', 0, '123123', '', NULL),
(110, 'Activation Code', 6000, 'asdfasdf', '', NULL),
(111, 'Activation Code', 6000, '172893', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL DEFAULT 'avatar.png',
  `_status` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `password`, `email`, `mobile`, `address`, `username`, `photo`, `_status`) VALUES
(1, 'ROD', '123', 'elanzstudio@gmail.com', '09234082016', 'P4B73L36 IOWA DRIVE DECA HOMES MINTAL', 'rodu', 'avatar-korra-the-legend-of-anime-452466 (1).jpg', 1),
(2, 'DUne', 'dune123', 'dune.albores@yahoo.com', '123123', 'asdfas', 'dune', 'Avatar-The-Legend-Of-Korra-Wallpaper (2).jpg', 1),
(3, 'ROD', 'a', 'akosipau@me.com', '1', 'a', 'a', 'avatar.png', 1),
(107, 'ROD', 't', 't', 't', 't', 't', 'avatar.png', 1),
(110, 'ROD', 'h', 'h@h.ccomo', 'h', 'h', 'h', 'avatar.png', 1),
(111, 'ROD', 'e', 'elanzstudio@gmail.com', '09234082016', 'P4B73L36 IOWA DRIVE DECA HOMES MINTAL', 'e', 'avatar.png', 1),
(123, 'ROD', '123', 'elanzstudio@gmail.com', '09234082016', 'P4B73L36 IOWA DRIVE DECA HOMES MINTAL', 'a', 'avatar-korra-the-legend-of-anime-452466 (1).jpg', 0),
(124, 'ROD', '123', 'elanzstudio@gmail.com', '09234082016', 'P4B73L36 IOWA DRIVE DECA HOMES MINTAL', 'rodu2', 'avatar-korra-the-legend-of-anime-452466 (1).jpg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
