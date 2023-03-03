-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 06:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `graduationreconstructure`
--

-- --------------------------------------------------------

--
-- Table structure for table `regist_location`
--

CREATE TABLE `regist_location` (
  `location_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสจุดลงทะเบียน',
  `location_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อจุดลงทะเบียน',
  `location_center` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9.084604067195292, 99.36422966671171' COMMENT 'จุดศูนย์กลาง(lat, lng)',
  `location_radius` decimal(7,2) NOT NULL DEFAULT 500.00 COMMENT 'รัศมีพื้นที่(m)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regist_phase`
--

CREATE TABLE `regist_phase` (
  `phase_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสเวลาลงทะเบียน',
  `phase_date` date NOT NULL COMMENT 'วันที่ลงทะเบียน',
  `phase_start` time NOT NULL COMMENT 'เวลาเริ่ม',
  `phase_end` time NOT NULL COMMENT 'เวลาสิ้นสุด',
  `location_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสจุดลงทะเบียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regist_record`
--

CREATE TABLE `regist_record` (
  `regist_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสการลงทะเบียน',
  `std_id` int(5) NOT NULL COMMENT 'รหัสบัณฑิต',
  `phase_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสเวลาลงทะเบียน',
  `regist_timestamp` datetime NOT NULL COMMENT 'เวลาลงทะเบียน',
  `regist_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'พิกัดลงทะเบียน',
  `regist_type` enum('ลงทะเบียนด้วยตนเอง','ลงทะเบียนโดยเจ้าหน้าที่') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ลงทะเบียนด้วยตนเอง' COMMENT 'ประเภทการลงทะเบียน',
  `user_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสเจ้าหน้าที่ผู้ลงทะเบียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

CREATE TABLE `student_account` (
  `std_id` int(5) NOT NULL COMMENT 'รหัสบัณฑิต',
  `std_student_id` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสนักศึกษา',
  `std_prefix` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `std_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `std_lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สกุล',
  `std_gender` enum('ชาย','หญิง') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'เพศ',
  `std_card_id` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสประจำตัวประชาชน',
  `std_tel` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'โทรศัพท์',
  `std_gpa` decimal(3,2) DEFAULT NULL COMMENT 'เกรดเฉลี่ย',
  `std_group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'กลุ่มเรียน',
  `std_major` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สาขาวิชา/เอกวิชา',
  `std_faculty` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'คณะ/สังกัด',
  `std_program` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อหลักสูตร',
  `std_pro` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อหลักสูตรย่อ',
  `std_level` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'วุฒิการศึกษา',
  `std_hornors` int(1) DEFAULT NULL COMMENT 'เกียรตินิยม',
  `std_edited_prefix` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'คำนำหน้าพิเศษ',
  `std_order` int(5) DEFAULT NULL COMMENT 'ลำดับบัณฑิต',
  `std_section` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ภาคเช้า/บ่าย',
  `std_section_order` int(5) DEFAULT NULL COMMENT 'ลำดับภาค',
  `std_anotation_preg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุกรณีตั้งครรภ์',
  `std_anotation_body` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุกรณีร่างกายไม่สมบูรณ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสบัญชี',
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Username',
  `user_password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รหัสผ่าน',
  `user_level` enum('Admin','Faculty','Officer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Officer' COMMENT 'ระดับบัญชี',
  `user_department` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'คณะ/หน่วยงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regist_location`
--
ALTER TABLE `regist_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `regist_phase`
--
ALTER TABLE `regist_phase`
  ADD PRIMARY KEY (`phase_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `regist_record`
--
ALTER TABLE `regist_record`
  ADD PRIMARY KEY (`regist_id`),
  ADD KEY `phase_id` (`phase_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `student_account`
--
ALTER TABLE `student_account`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `regist_phase`
--
ALTER TABLE `regist_phase`
  ADD CONSTRAINT `regist_phase_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `regist_location` (`location_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `regist_record`
--
ALTER TABLE `regist_record`
  ADD CONSTRAINT `regist_record_ibfk_1` FOREIGN KEY (`phase_id`) REFERENCES `regist_phase` (`phase_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `regist_record_ibfk_2` FOREIGN KEY (`std_id`) REFERENCES `student_account` (`std_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `regist_record_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
