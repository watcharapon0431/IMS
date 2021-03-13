-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 04:49 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL COMMENT 'ตีย์ประเภทรายการ',
  `category_name` varchar(200) NOT NULL COMMENT 'ชื่อประเภทรายการ',
  `category_type` int(11) NOT NULL COMMENT 'รายรับ->1/รายจ่าย->2',
  `category_status` int(1) NOT NULL COMMENT 'สถานะการใช้งานประเภทรายการ',
  `category_sequence` int(1) NOT NULL COMMENT 'ลำดับประเภทรายการ',
  `category_create_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `category_modify_date` datetime NOT NULL COMMENT 'วันที่แก้ไข'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_type`, `category_status`, `category_sequence`, `category_create_date`, `category_modify_date`) VALUES
(1, 'ใช้หนี้', 2, 1, 1, '0000-00-00 00:00:00', '2021-03-09 15:23:49'),
(2, 'เงินเดือน', 1, 1, 2, '0000-00-00 00:00:00', '2021-03-09 15:46:46'),
(3, 'อาหาร', 2, 1, 3, '0000-00-00 00:00:00', '2021-03-11 17:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `list_id` int(11) NOT NULL COMMENT 'คีย์รายการรายรับ-รายจ่าย',
  `list_cost` int(11) NOT NULL COMMENT 'จำนวนเงิน',
  `list_user_id` int(11) NOT NULL COMMENT 'คีย์ของผู้ใช้งาน',
  `list_category_id` int(11) NOT NULL COMMENT 'ประเภทรายการรายรับ-รายจ่าย',
  `list_detail` varchar(200) NOT NULL COMMENT 'รายละเอียดรายการรายรับ-รายจ่าย',
  `list_create_date` datetime NOT NULL COMMENT 'วันที่สร้าง',
  `list_type` tinyint(3) NOT NULL COMMENT 'รายรับ->1/รายจ่าย->2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL COMMENT 'คีย์รายการที่ต้องทำ',
  `note_user_id` int(11) NOT NULL COMMENT 'คีย์ของผู้ใช้งาน',
  `note_to_do_list` varchar(200) NOT NULL COMMENT 'รายการที่ต้องทำ',
  `note_type` tinyint(3) NOT NULL COMMENT 'ครั้งเดียว->1/ประจำ->2',
  `note_create_date` date NOT NULL COMMENT 'วันที่สร้างรายการ',
  `note_read_date` date NOT NULL COMMENT 'วันที่อ่านรายการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `summary_list`
--

CREATE TABLE `summary_list` (
  `sl_id` int(11) NOT NULL COMMENT 'คีย์ของรายการสรุป',
  `sl_income` double NOT NULL COMMENT 'รายการสรุปรายรับ',
  `sl_expend` double NOT NULL COMMENT 'รายการสรุปรายจ่าย',
  `sl_balance` double NOT NULL COMMENT 'รายการสรุปคงเหลือ',
  `sl_user_id` int(11) NOT NULL COMMENT 'คีย์ผู้ใช้งาน',
  `sl_month` int(4) NOT NULL COMMENT 'รายการสรุปของเดือน',
  `sl_year` int(4) NOT NULL COMMENT 'รายการสรุปของปี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL COMMENT 'คีย์ผู้ใช้งาน',
  `user_username` varchar(255) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `user_password` varchar(255) NOT NULL COMMENT 'รหัสผ่านผู้ใช้งาน',
  `user_fname` varchar(255) NOT NULL COMMENT 'ชื่อจริงผู้ใช้งาน',
  `user_lname` varchar(255) NOT NULL COMMENT 'นามสกุลผู้ใช้งาน',
  `user_position` int(11) NOT NULL COMMENT 'ตำแหน่งผู้ใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_password`, `user_fname`, `user_lname`, `user_position`) VALUES
(1, '61160006', '61160006', 'อลงกรณ์', 'ทวีวงค์', 2),
(2, '61160073', '61160073', 'วัชรพล', 'วิเชียรฉาย', 2),
(3, '61160074', '61160074', 'วิชภัทร์', 'หาญเหี้ยม', 2),
(4, '61160176', '61160176', 'ณัฐปคัลภ์', 'ลิลา', 2),
(5, '61160285', '61160285', 'เตชินี', 'ตึกโพธิ์', 2),
(6, '61160296', '61160296', 'อภิสิทธิ์', 'แก้วการุณ', 2),
(7, 'Admin', 'Admin', 'Admin', 'ครับผม', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `list_user_id` (`list_user_id`) USING BTREE,
  ADD KEY `list_category_id` (`list_category_id`) USING BTREE;

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `note_user_id` (`note_user_id`);

--
-- Indexes for table `summary_list`
--
ALTER TABLE `summary_list`
  ADD PRIMARY KEY (`sl_id`),
  ADD KEY `sl_user_id` (`sl_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ตีย์ประเภทรายการ', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'คีย์รายการรายรับ-รายจ่าย';

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'คีย์รายการที่ต้องทำ';

--
-- AUTO_INCREMENT for table `summary_list`
--
ALTER TABLE `summary_list`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของรายการสรุป';

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ผู้ใช้งาน', AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list`
--
ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`list_user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `list_ibfk_2` FOREIGN KEY (`list_category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`note_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `summary_list`
--
ALTER TABLE `summary_list`
  ADD CONSTRAINT `sl_user_id` FOREIGN KEY (`sl_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
