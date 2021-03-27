-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 27, 2021 at 11:35 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamquadbi_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `age_id` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `age_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age_address` text COLLATE utf8_unicode_ci NOT NULL,
  `age_tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `age_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age_imgtype` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`age_id`, `age_name`, `age_address`, `age_tel`, `age_email`, `age_imgtype`) VALUES
('601110c626', 'Quad B', '61 หมู่ 10 ขอนแก่น', '0801643333', 'boy1556@hotmail.in.th', 'png');

-- --------------------------------------------------------

--
-- Table structure for table `bp_list`
--

CREATE TABLE `bp_list` (
  `bpl_id` varchar(20) NOT NULL,
  `pro_id` varchar(10) NOT NULL,
  `bpl_count` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bp_list`
--

INSERT INTO `bp_list` (`bpl_id`, `pro_id`, `bpl_count`) VALUES
('05442c02e17118e89c9e', '602fc3f6e9', '1'),
('38bf887566af0350401b', '6023ffe4cd', '1'),
('9d17668a4c0a0dd64903', '6023ffe4cd', '5'),
('c738c9793004ea2c54f5', '6023ffe4cd', '3'),
('ce81ee87f2f183eebf95', '6023ffe4cd', '1'),
('ce81ee87f2f183eebf95', '602fc3f6e9', '2');

-- --------------------------------------------------------

--
-- Table structure for table `buy_product`
--

CREATE TABLE `buy_product` (
  `buy_id` varchar(20) NOT NULL,
  `dev_id` varchar(20) NOT NULL,
  `buy_sum` int(7) NOT NULL,
  `buy_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy_product`
--

INSERT INTO `buy_product` (`buy_id`, `dev_id`, `buy_sum`, `buy_datetime`) VALUES
('05442c02e17118e89c9e', '53:EB:6C:0C', 7, '2021-03-16 22:58:04'),
('38bf887566af0350401b', '53:EB:6C:0C', 40, '2021-03-15 14:32:57'),
('9d17668a4c0a0dd64903', '53:EB:6C:0C', 200, '2021-03-12 10:44:17'),
('c738c9793004ea2c54f5', 'EA:AD:BF:80', 120, '2021-03-02 13:57:50'),
('ce81ee87f2f183eebf95', 'EA:AD:BF:80', 54, '2021-02-23 13:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `dev_id` varchar(20) NOT NULL,
  `dev_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`dev_id`, `dev_name`) VALUES
('53:EB:6C:0C', 'การ์ด RFID'),
('EA:AD:BF:80', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` varchar(13) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_username` text NOT NULL,
  `emp_password` text NOT NULL,
  `emp_rule` char(1) NOT NULL,
  `emp_address` text NOT NULL,
  `emp_tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_username`, `emp_password`, `emp_rule`, `emp_address`, `emp_tel`) VALUES
('1400300058695', 'john cena', 'johncena', '346536b5968c33dba7c2aba40b085178', '1', 'บ้านเลขที่ 61 หมู่ 10 ต.ท่าศาลา', '1234567898'),
('1409901446532', 'รักดี', 'admin', '25f9e794323b453885f5181f1b624d0b', '0', 'หกฟกฟหกห', '1234567898');

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `eve_id` varchar(10) NOT NULL,
  `eve_name` varchar(30) NOT NULL,
  `eve_address` text NOT NULL,
  `eve_theme` text NOT NULL,
  `eve_limit` int(7) NOT NULL,
  `eve_price` int(7) NOT NULL,
  `eve_hasimg` char(1) NOT NULL,
  `eve_imgtype` text,
  `eve_timestart` datetime NOT NULL,
  `eve_timeend` datetime DEFAULT NULL,
  `emp_create` varchar(13) NOT NULL,
  `emp_lastedit` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`eve_id`, `eve_name`, `eve_address`, `eve_theme`, `eve_limit`, `eve_price`, `eve_hasimg`, `eve_imgtype`, `eve_timestart`, `eve_timeend`, `emp_create`, `emp_lastedit`) VALUES
('600ec54ca2', 'มกรา', 'ฟหกฟหก', 'ฟหกหฟก', 1, 10, '1', 'jpg', '2021-02-12 20:19:00', '2021-02-15 20:19:00', '1400300058695', '1409901446532'),
('60103173e7', 'ดูท้องฟ้า', 'โรงแรมโฆษะ ขอนแก่น 250-252 ถนน ศรีจันทร์ ตำบลในเมือง อำเภอเมืองขอนแก่น ขอนแก่น 40000', 'ชุดเล่น', 100, 0, '1', 'jpeg', '2021-03-12 22:12:00', '2021-03-22 22:12:00', '1409901446532', '1409901446532'),
('601a97cac1', 'ใหม่ล่าสุด', 'จังหวัดขอนแก่น', 'ตามสบาย', 10, 10, '1', 'jpg', '2021-03-12 19:30:00', '2021-03-22 19:30:00', '1409901446532', '1409901446532');

-- --------------------------------------------------------

--
-- Table structure for table `event_user`
--

CREATE TABLE `event_user` (
  `euse_id` varchar(13) NOT NULL,
  `euse_username` varchar(50) NOT NULL,
  `euse_password` text NOT NULL,
  `euse_name` varchar(50) NOT NULL,
  `euse_email` text NOT NULL,
  `euse_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_user`
--

INSERT INTO `event_user` (`euse_id`, `euse_username`, `euse_password`, `euse_name`, `euse_email`, `euse_address`) VALUES
('1400300058696', 'boyphongsakorn', '346536b5968c33dba7c2aba40b085178', 'พงศกร วิเศษธร', 'boy1556@hotmail.com', 'บ้านเลขที่ 61 หมู่ 10'),
('1409901446532', 'Wittayakorn', 'b59c67bf196a4758191e42f76670ceba', 'วิทยากร ผลมาตย์', 'prem17062539@gmail.com', 'Do'),
('1472583691472', 'sudarat', 'e9c61ce0c7d16bf75600096f97b00e29', 'สุดารัตน์ ชิณวัง', 'sudarat.ci@rmuti.ac.th', 'มหาสารคาม'),
('5555555555555', 'boytest', '346536b5968c33dba7c2aba40b085178', 'พงศธร', 'ongamecrafttv@gmail.com', 'ขอนแก่น');

-- --------------------------------------------------------

--
-- Table structure for table `jeeventhis`
--

CREATE TABLE `jeeventhis` (
  `jee_id` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  `euse_id` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  `eve_id` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `jee_inevent` datetime NOT NULL,
  `jee_exitevent` datetime NOT NULL,
  `dev_id` varchar(20) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jeeventhis`
--

INSERT INTO `jeeventhis` (`jee_id`, `euse_id`, `eve_id`, `jee_inevent`, `jee_exitevent`, `dev_id`) VALUES
('60466bbec6afa', '5555555555555', '601a97cac1', '2021-03-09 01:23:58', '2021-03-09 01:24:09', 'EA:AD:BF:80'),
('60466bd2730ed', '5555555555555', '601a97cac1', '2021-03-10 01:24:18', '2021-03-10 01:24:26', 'EA:AD:BF:80'),
('604ae32dadd66', '5555555555555', '601a97cac1', '2021-03-12 10:42:37', '0000-00-00 00:00:00', 'EA:AD:BF:80');

-- --------------------------------------------------------

--
-- Table structure for table `joinevent`
--

CREATE TABLE `joinevent` (
  `joe_id` varchar(13) NOT NULL,
  `euse_id` varchar(13) NOT NULL,
  `eve_id` varchar(10) NOT NULL,
  `joe_inevent` datetime NOT NULL,
  `joe_exitevent` datetime NOT NULL,
  `dev_id` varchar(20) NOT NULL,
  `joe_money` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `joinevent`
--

INSERT INTO `joinevent` (`joe_id`, `euse_id`, `eve_id`, `joe_inevent`, `joe_exitevent`, `dev_id`, `joe_money`) VALUES
('6024bda217788', '1400300058696', '60103173e7', '2021-02-11 12:16:18', '0000-00-00 00:00:00', '53:EB:6C:0C', 133),
('60466bbec6afa', '5555555555555', '601a97cac1', '2021-03-12 10:42:37', '0000-00-00 00:00:00', 'EA:AD:BF:80', 100);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` varchar(13) NOT NULL,
  `euse_id` varchar(13) NOT NULL,
  `pay_bank` text NOT NULL,
  `pay_money` int(7) NOT NULL,
  `pay_typeimg` text NOT NULL,
  `pay_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `euse_id`, `pay_bank`, `pay_money`, `pay_typeimg`, `pay_datetime`) VALUES
('6024b82f79ed9', '1400300058696', '1', 10, 'jpg', '2020-12-04 07:06:00'),
('6024bcc685697', '1400300058696', '1', 10, 'jpg', '2020-12-04 07:06:00'),
('6034a5dc05be6', '5555555555555', '1', 10, 'png', '2020-12-04 07:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` varchar(10) NOT NULL,
  `pro_name` varchar(30) NOT NULL,
  `pro_price` int(7) NOT NULL,
  `pro_count` int(7) NOT NULL,
  `pro_unit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `pro_price`, `pro_count`, `pro_unit`) VALUES
('6023ffe4cd', 'น้ำโค๊ด 1 ลิตร', 40, 1, 'ขวด'),
('602fc3f6e9', 'น้ำเปล่า', 7, 7, 'ขวด'),
('6050c4cfc4', 'น้ำส้ม', 15, 20, '1');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `reg_id` varchar(13) NOT NULL,
  `euse_id` varchar(13) NOT NULL,
  `eve_id` varchar(10) NOT NULL,
  `reg_datetime` datetime NOT NULL,
  `reg_payin` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`reg_id`, `euse_id`, `eve_id`, `reg_datetime`, `reg_payin`) VALUES
('6024b82f79ed9', '1400300058696', '600ec54ca2', '2021-02-11 11:53:03', '1'),
('6024bcb971bb7', '1400300058696', '60103173e7', '2021-02-11 12:12:25', '1'),
('6024bcc685697', '1400300058696', '601a97cac1', '2021-02-11 12:12:38', '1'),
('6034a5d203e98', '5555555555555', '60103173e7', '2021-02-23 13:50:58', '1'),
('6034a5dc05be6', '5555555555555', '601a97cac1', '2021-02-23 13:51:08', '1');

-- --------------------------------------------------------

--
-- Table structure for table `topup`
--

CREATE TABLE `topup` (
  `top_id` varchar(10) NOT NULL,
  `dev_id` varchar(20) NOT NULL,
  `top_price` int(7) NOT NULL,
  `top_datetime` datetime NOT NULL,
  `emp_id` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topup`
--

INSERT INTO `topup` (`top_id`, `dev_id`, `top_price`, `top_datetime`, `emp_id`) VALUES
('6034a73808', 'EA:AD:BF:80', 1000, '2021-02-23 13:56:56', '1409901446532'),
('603de16bd5', 'EA:AD:BF:80', 100, '2021-03-02 13:55:39', '1409901446532'),
('603de1e2d5', 'EA:AD:BF:80', 100, '2021-03-02 13:57:38', '1409901446532'),
('604ae343a7', 'EA:AD:BF:80', 100, '2021-03-12 10:42:59', '1409901446532'),
('604ae384d8', '53:EB:6C:0C', 200, '2021-03-12 10:44:04', '1409901446532'),
('604f0d97a1', '53:EB:6C:0C', 40, '2021-03-15 14:32:39', '1409901446532'),
('604f0dc34e', '53:EB:6C:0C', 40, '2021-03-15 14:33:23', '1409901446532'),
('6050d37804', '53:EB:6C:0C', 100, '2021-03-16 22:49:12', '1409901446532');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`age_id`);

--
-- Indexes for table `bp_list`
--
ALTER TABLE `bp_list`
  ADD PRIMARY KEY (`bpl_id`,`pro_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `buy_product`
--
ALTER TABLE `buy_product`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `euse_id` (`dev_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`dev_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`eve_id`),
  ADD KEY `emp_lastedit` (`emp_lastedit`),
  ADD KEY `emp_create` (`emp_create`);

--
-- Indexes for table `event_user`
--
ALTER TABLE `event_user`
  ADD PRIMARY KEY (`euse_id`);

--
-- Indexes for table `jeeventhis`
--
ALTER TABLE `jeeventhis`
  ADD PRIMARY KEY (`jee_id`),
  ADD KEY `dev_id` (`dev_id`),
  ADD KEY `euse_id` (`euse_id`),
  ADD KEY `eve_id` (`eve_id`);

--
-- Indexes for table `joinevent`
--
ALTER TABLE `joinevent`
  ADD PRIMARY KEY (`joe_id`),
  ADD KEY `euse_id` (`euse_id`),
  ADD KEY `eve_id` (`eve_id`),
  ADD KEY `dev_id` (`dev_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `euse_id` (`euse_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`reg_id`),
  ADD KEY `euse_id` (`euse_id`),
  ADD KEY `eve_id` (`eve_id`);

--
-- Indexes for table `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`top_id`),
  ADD KEY `euse_id` (`dev_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bp_list`
--
ALTER TABLE `bp_list`
  ADD CONSTRAINT `bp_list_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `buy_product`
--
ALTER TABLE `buy_product`
  ADD CONSTRAINT `buy_product_ibfk_1` FOREIGN KEY (`dev_id`) REFERENCES `device` (`dev_id`);

--
-- Constraints for table `event_list`
--
ALTER TABLE `event_list`
  ADD CONSTRAINT `event_list_ibfk_1` FOREIGN KEY (`emp_lastedit`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `event_list_ibfk_2` FOREIGN KEY (`emp_create`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `jeeventhis`
--
ALTER TABLE `jeeventhis`
  ADD CONSTRAINT `jeeventhis_ibfk_1` FOREIGN KEY (`dev_id`) REFERENCES `device` (`dev_id`),
  ADD CONSTRAINT `jeeventhis_ibfk_2` FOREIGN KEY (`euse_id`) REFERENCES `event_user` (`euse_id`),
  ADD CONSTRAINT `jeeventhis_ibfk_3` FOREIGN KEY (`eve_id`) REFERENCES `event_list` (`eve_id`);

--
-- Constraints for table `joinevent`
--
ALTER TABLE `joinevent`
  ADD CONSTRAINT `joinevent_ibfk_1` FOREIGN KEY (`euse_id`) REFERENCES `event_user` (`euse_id`),
  ADD CONSTRAINT `joinevent_ibfk_2` FOREIGN KEY (`eve_id`) REFERENCES `event_list` (`eve_id`),
  ADD CONSTRAINT `joinevent_ibfk_3` FOREIGN KEY (`dev_id`) REFERENCES `device` (`dev_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`euse_id`) REFERENCES `event_user` (`euse_id`);

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`euse_id`) REFERENCES `event_user` (`euse_id`),
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`eve_id`) REFERENCES `event_list` (`eve_id`);

--
-- Constraints for table `topup`
--
ALTER TABLE `topup`
  ADD CONSTRAINT `topup_ibfk_1` FOREIGN KEY (`dev_id`) REFERENCES `device` (`dev_id`),
  ADD CONSTRAINT `topup_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
