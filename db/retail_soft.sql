-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2017 at 11:04 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `retail_soft`
--

-- --------------------------------------------------------

--
-- Table structure for table `compony_info`
--

CREATE TABLE IF NOT EXISTS `compony_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `address` text,
  `pin_code` int(6) DEFAULT NULL,
  `mobile_one` varchar(12) DEFAULT NULL,
  `mobile_two` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(20) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `logo` text,
  `owner_fname` varchar(25) NOT NULL,
  `owner_lname` varchar(25) DEFAULT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` date DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `compony_info`
--

INSERT INTO `compony_info` (`id`, `name`, `address`, `pin_code`, `mobile_one`, `mobile_two`, `email`, `website`, `gst_no`, `logo`, `owner_fname`, `owner_lname`, `delete_flag`, `created_by`, `created_on`) VALUES
(1, 'BJ Ent', 'Mumbai', 400701, '999999999', '8547768914', 'bj@gmail.com', 'bj.com', '89542233300', '3dc6bdcb0052a4c47195ce0ead51a35f.jpg', 'Bhushan', 'Mahajan', 0, NULL, NULL),
(2, 'New Inc', 'Mumbai', 400701, '8956522120', '415151222', 'new@gmail.com', 'new.com', '15612313333', '859a57d81bd577862a58fa1e6e4a01f5.jpg', 'New', 'Comp', 0, NULL, NULL),
(3, 'Infobeam', 'Nasik', 55662233, '21546353213', '1214789865', 'ne@gmail.com', 'ne.com', '566478932', 'dc6ede9a478abde97b9bba35a0324ee4.jpg', 'New', 'Onwer', 0, NULL, NULL),
(4, 'HCl', 'Pune', 654578, '2546578212', '121512100', 'hcl@gmail.com', 'hcl.com', '6545212', 'fb64328db8b17bd9aa6b3861662a1aee.jpg', 'Harsh', 'Desv', 0, NULL, NULL),
(5, 'Reliance', 'Nariman Point', 400001, '65487825', '32154512', 'ril@gmail.com', 'ril.com', '6547545212', '4624ded21de8d3f97944517676705ea3.jpg', 'Mukesh', 'Ambani', 0, NULL, NULL),
(6, 'Tata', 'Mumbaiu', 656523, '145312333', '1231321233', 'tat@gmail.com', 'tata.com', '14651233', '5bc3c038095adbc38844f51fd5413ef5.jpg', 'Ratan', 'Tata', 0, NULL, NULL),
(9, 'Test New ', 'Mumbai', 400701, '2351333333', '', '', '', '1561323333', '', 'Pravin', 'Deore', 0, NULL, NULL),
(10, 'Comapny', 'Navi Mumbai', 400701, '12652131323', '', '', '', '8546513333', '', 'Jayesh', 'P', 1, NULL, NULL),
(11, 'Comapny Name', 'Koper', 1531321333, '125151231333', '', '', '', '1851532133', '', 'Ashish', 'G', 0, NULL, NULL),
(12, 'axczxccx', 'vcxvcxb', 2147483647, '156132133', '', '', '', '3185415213', '', 'zjnjkn jm', 'sdfsdfer', 1, NULL, NULL),
(13, 'jnjknmk ', 'hbhnb', 561232233, '54561453632', '', '', '', '12132333', '', 'gvbbh', 'asdg', 0, NULL, NULL),
(14, NULL, 'Mumbai', 456153, '1256125456', NULL, 'kushal@gmail.com', NULL, '212313213', NULL, 'Kushal', 'D', 1, NULL, NULL),
(15, 'Govind Furniture', 'Dabhadi, Malegaon', 423201, '9998866666', '', 'pravin.n@gmail.com', '', 'YU0098675', 'c731841269f77659d7e2d66c5fd84a89.jpg', 'Pravin', 'Nikam', 0, '0000-00-00', '2017-08-13'),
(16, 'yashwant steel', 'a/\\p. dabhadi', 423201, '9890208149', '', 'pravinnikam851991@gmail.com', '', '27aampgn1570n', '7f1256753011cc9df4705d9b02ec4caa.jpg', 'pravin', 'nikam', 0, '0000-00-00', '2017-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `custumer_table`
--

CREATE TABLE IF NOT EXISTS `custumer_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `address` text,
  `mobile` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pin_code` int(6) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '0=cust, 1=vender, 2=both',
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(20) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `custumer_table`
--

INSERT INTO `custumer_table` (`id`, `fname`, `lname`, `address`, `mobile`, `email`, `pin_code`, `gst_no`, `type`, `delete_flag`, `created_by`, `created_on`) VALUES
(1, 'Rohan', 'H', 'Pune', '1561323333', 'rohan@gmail.com', 15621333, '231230s2000', 1, 1, NULL, NULL),
(2, 'Chetan', 'P', 'Malegaon', '74845633633', 'C@gmail.com', 485463133, '15212222', 1, 1, NULL, NULL),
(3, 'Amit', 'K', 'Pune', '74238432849', 'jagtap.bhushan7@gmail.com', 423203, '84327483248', 1, 0, '1', '2017-08-12'),
(4, 'Girna', 'Giranar', 'Satana Naka, Malegaon', '9881232322', 'girna@gmail.com', 423203, 'PO823283822', 0, 0, '1', '2017-08-13'),
(5, 'om gurudev steel', 'datta patil', 'malegaon', '8793786182', 'cgdhvhvhv@fgg.c', 423203, 'aaasaxataaa', 1, 0, '1', '2017-08-19'),
(6, 'om tredars', 'chandak', 'nasik', '9422326042', 'ssexe@sdfds.c', 422205, 'aaaaaaa', 0, 0, '1', '2017-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `gernal`
--

CREATE TABLE IF NOT EXISTS `gernal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `batch` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `unit_measure` varchar(20) DEFAULT NULL,
  `sell_price` text,
  `purchase_price` text,
  `qty` int(11) DEFAULT NULL,
  `barcode` varchar(100) NOT NULL,
  `discount_perc` int(11) DEFAULT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `compony_info_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `number`, `name`, `unit_measure`, `sell_price`, `purchase_price`, `qty`, `barcode`, `discount_perc`, `delete_flag`, `compony_info_id`, `created_by`, `created_on`) VALUES
(1, '1', 'Chiars', 'Pisces', '1500', '1200', 100, 'AOP1245678', 2, 0, 1, 1, '2017-08-12'),
(2, '2', 'Cupbord', 'Pisces', '3500', '3000', 50, 'TY09888', 0, 0, 4, 1, '2017-08-12'),
(3, '3', 'shocase', 'Pisces', '5200', '4500', 20, '', 0, 0, 16, 1, '2017-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details_order`
--

CREATE TABLE IF NOT EXISTS `sales_details_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `line_amount` int(11) DEFAULT NULL,
  `gst_prec` int(11) DEFAULT NULL,
  `gst_line_amount` int(11) DEFAULT NULL,
  `line_total` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_header`
--

CREATE TABLE IF NOT EXISTS `sales_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'order_id',
  `comp_id` int(11) DEFAULT NULL,
  `cust_id` int(11) DEFAULT NULL,
  `cust_address` text,
  `cust_pin` int(11) DEFAULT NULL,
  `cust_mobile` varchar(15) DEFAULT NULL,
  `cust_email` varchar(50) DEFAULT NULL,
  `cust_gst_no` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `amount_exlcuding_gst` int(11) DEFAULT NULL,
  `discont` varchar(110) DEFAULT NULL,
  `sgst` varchar(50) DEFAULT NULL,
  `cgst` varchar(50) DEFAULT NULL,
  `total_amount` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_line`
--

CREATE TABLE IF NOT EXISTS `sales_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_header_id` tinyint(4) DEFAULT NULL,
  `item_id` tinyint(4) DEFAULT NULL,
  `item_sales_price` varchar(100) DEFAULT NULL,
  `item_qty` varchar(10000) DEFAULT NULL,
  `item_disc` varchar(100) DEFAULT NULL,
  `item_line_amount` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE IF NOT EXISTS `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `shipping_charge` int(11) DEFAULT NULL,
  `pre_post` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `unit_measure`
--

CREATE TABLE IF NOT EXISTS `unit_measure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) DEFAULT NULL,
  `qty` int(11) DEFAULT '1',
  `description` varchar(100) DEFAULT NULL,
  `delete_flag` tinyint(4) NOT NULL DEFAULT '0',
  `created_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `unit_measure`
--

INSERT INTO `unit_measure` (`id`, `type`, `qty`, `description`, `delete_flag`, `created_on`, `created_by`) VALUES
(1, 'KG', 1, NULL, 1, '2017-08-12', 1),
(2, 'KG', 1, NULL, 1, '2017-08-12', 1),
(3, 'KG', 1, 'Kilogram', 0, '2017-08-12', 1),
(4, 'Pisces', 1, 'Pisces by qty', 0, '2017-08-12', 1),
(5, 'Case', 12, 'Case of 12 items', 0, '2017-08-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_deatils`
--

CREATE TABLE IF NOT EXISTS `user_deatils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `address_one` text,
  `address_two` text,
  `pin_code` int(6) DEFAULT NULL,
  `mobile_one` varchar(12) DEFAULT NULL,
  `mobile_two` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_deatils`
--

INSERT INTO `user_deatils` (`id`, `fname`, `lname`, `address_one`, `address_two`, `pin_code`, `mobile_one`, `mobile_two`, `email`, `user_name`, `password`, `is_active`, `created_by`, `created_on`) VALUES
(1, 'Bhushan', 'Jagtap', 'Ghansoli, Navi Mumbai', 'Malegaon, Nashik', 400701, '8956564053', '932660394', 'jagtap.bhushan@gmail.com', 'bhushanrj', '123456', 1, 1, '2017-07-22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
