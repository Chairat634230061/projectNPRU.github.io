-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2024 at 12:29 AM
-- Server version: 10.6.15-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project7_chairatNPRU`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_activity`
--

CREATE TABLE `add_activity` (
  `name_activity` varchar(255) NOT NULL COMMENT 'ชื่อกิจกรรม',
  `name_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `collect_hours` int(5) NOT NULL COMMENT 'เก็บชั่วโมง',
  `name_location` varchar(255) NOT NULL COMMENT 'สถานที่',
  `id` int(10) NOT NULL,
  `activity_date1` varchar(255) NOT NULL COMMENT 'วันเริ่ม',
  `activity_date2` varchar(255) NOT NULL COMMENT 'สิ้นสุด',
  `participant_limit` int(11) NOT NULL COMMENT 'จำนวนคน',
  `participant_count` int(11) NOT NULL COMMENT 'จำนวนคนเข้า'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `add_activity`
--

INSERT INTO `add_activity` (`name_activity`, `name_time`, `collect_hours`, `name_location`, `id`, `activity_date1`, `activity_date2`, `participant_limit`, `participant_count`) VALUES
('พิธีไหว้ครู', '2023-07-16 04:55:24', 8, 'เทศบาล1', 1, '2024-05-01', '2024-05-02', 2, 0),
('กวาดวัด', '2023-10-04 09:02:41', 5, 'วัดใหม่', 2, '2024-05-01', '2024-05-06', 5, 0),
('ทำความสะอาด', '2024-05-07 19:27:16', 8, 'วัดสว่างชาติ', 3, '2024-05-08', '2024-05-09', 5, 0),
('กวาดโรงอาหาร', '2024-05-21 03:48:56', 3, 'อาคาร1', 58, '2024-05-21', '2024-05-22', 5, 0),
('ทำความสะอาดพื้น', '2024-05-21 07:33:36', 2, 'อาคาร1', 59, '2024-05-21', '2024-05-23', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `info_student`
--

CREATE TABLE `info_student` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL COMMENT 'ชื่อนักศึกษา',
  `lastname` varchar(255) NOT NULL COMMENT 'นามสกุลนักศึกษา',
  `collect_hours` int(5) NOT NULL COMMENT 'ชั่วโมง',
  `studentID` int(10) NOT NULL COMMENT 'รหัสนักศึกษา',
  `img` varchar(255) NOT NULL COMMENT 'รูป',
  `name_time` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'ชั่วโมงที่บันทึก',
  `name_message` varchar(100) NOT NULL COMMENT 'อธิบาย',
  `user_status` varchar(255) NOT NULL COMMENT 'สถานะ',
  `user_confirm` varchar(255) NOT NULL COMMENT 'รับรองสถานะ',
  `activity2` varchar(255) NOT NULL COMMENT 'กิจกรรมเพิ่มเอง',
  `img_confirm` varchar(255) NOT NULL COMMENT 'รูปเอกสารรับรอง',
  `activity_date1` varchar(255) NOT NULL COMMENT 'เริ่มต้น',
  `activity_date2` varchar(255) NOT NULL COMMENT 'สิ้นสุด',
  `participant_count` int(11) NOT NULL COMMENT 'จำนวนคนเข้า ',
  `participant_limit` int(11) NOT NULL COMMENT 'จำนวนจำกัด',
  `mr_ms` varchar(255) NOT NULL COMMENT 'คำนำหน้า',
  `name_location` varchar(255) NOT NULL COMMENT 'สถานที่',
  `studygroup` varchar(255) NOT NULL COMMENT 'หมู่เรียน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info_student`
--

INSERT INTO `info_student` (`id`, `firstname`, `lastname`, `collect_hours`, `studentID`, `img`, `name_time`, `name_message`, `user_status`, `user_confirm`, `activity2`, `img_confirm`, `activity_date1`, `activity_date2`, `participant_count`, `participant_limit`, `mr_ms`, `name_location`, `studygroup`) VALUES
(188, 'ภาคิน', 'อับดุลเลาะ', 8, 634230063, '636400229.jpg', '2024-05-21 16:37:35', 'เก็บขยะ', '', '', 'เก็บขยะ', '1517571568.png', '2024-05-21', '2024-05-22', 0, 0, 'นาย', 'วัดใหม่', '63/43'),
(190, 'ชัยรัตน์', 'ดวงสอาด', 5, 634230061, '1746770778.jpg', '2024-05-21 17:14:03', 'เก็บขยะวัดใหม่', '', '', 'เก็บขยะ', '541966891.png', '2024-05-22', '2024-05-24', 0, 0, 'นาย', 'วัดใหม่', '63/44');

-- --------------------------------------------------------

--
-- Table structure for table `join_activity`
--

CREATE TABLE `join_activity` (
  `name_activity` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `studentID` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `activity_date1` varchar(255) NOT NULL,
  `activity_date2` varchar(255) NOT NULL,
  `participant_count` int(11) NOT NULL,
  `participant_limit` int(11) NOT NULL,
  `name_location` varchar(255) NOT NULL,
  `collect_hours` int(11) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `mr_ms` varchar(255) NOT NULL,
  `studygroup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `join_activity`
--

INSERT INTO `join_activity` (`name_activity`, `firstname`, `lastname`, `studentID`, `img`, `activity_date1`, `activity_date2`, `participant_count`, `participant_limit`, `name_location`, `collect_hours`, `user_status`, `id`, `mr_ms`, `studygroup`) VALUES
('พิธีไหว้ครู', 'ชัยรัตน์', 'ดวงสอาด', 634230061, '', '2024-05-01', '2024-05-02', 0, 0, 'เทศบาล1', 0, '', 92, 'นาย', '63/44');

-- --------------------------------------------------------

--
-- Table structure for table `studentuser`
--

CREATE TABLE `studentuser` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `studentID` int(10) NOT NULL,
  `studygroup` varchar(255) NOT NULL COMMENT 'หมู่เรียน',
  `mr_ms` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentuser`
--

INSERT INTO `studentuser` (`id`, `email`, `password`, `firstname`, `lastname`, `urole`, `studentID`, `studygroup`, `mr_ms`) VALUES
(1, '5555@gmail.com', '$2y$10$zv.5MMVFp8.AjyCbOLz3uek5hLPMXE6feycor8qlvk25AoqJhr/si', 'ชัยรัตน์', 'ดวงสอาด', 'user1', 634230061, '63/44', 'นาย'),
(14, '0000@gmail.com', '$2y$10$1rWd1aNHOkKkIRg1yEHNN.PHMB3oSNQa5toNy9SfblhdL4thjC59q', 'พิธีกร', 'คงมะคา', 'user3', 634230045, '63/44', 'นาย'),
(15, '1111@gmail.com', '$2y$10$dc7fstX0os2l1L2PSDaRg.eMPXUz1YVze9Gxnpxn6La.Rs4RBTAxm', 'วงศธร', 'กันสิริ', 'user2', 634230046, '63/44', 'นาย'),
(17, '3333@gmail.com', '$2y$10$/ZYHASjy5xOQqe/MNI8Ufety2UoBqJdRGSJr.uH3UlUKtvmfpproq', 'ภาคิน', 'อับดุลเลาะ', 'user634230063', 634230063, '63/43', 'นาย'),
(19, 'idooy1231@gmail.com', '$2y$10$de.pumIdTs4NvRBAJanBmehS8XZHSOvLQgmCrtF5K4eUUsywqCrCS', 'ชัยรัตน์', 'ดวงสอาด', 'user634230000', 634230000, '63/44', 'นาย');

-- --------------------------------------------------------

--
-- Table structure for table `successful`
--

CREATE TABLE `successful` (
  `id` int(11) NOT NULL,
  `collect_hours` int(5) NOT NULL,
  `name_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `studentID` int(10) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name_message` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `activity2` varchar(255) NOT NULL,
  `img_confirm` varchar(255) NOT NULL,
  `name_activity` varchar(255) NOT NULL COMMENT 'กิจกรรมที่เข้าร่วม',
  `mr_ms` varchar(255) NOT NULL,
  `name_location` varchar(255) NOT NULL,
  `studygroup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `successful`
--

INSERT INTO `successful` (`id`, `collect_hours`, `name_time`, `studentID`, `img`, `name_message`, `user_status`, `lastname`, `firstname`, `activity2`, `img_confirm`, `name_activity`, `mr_ms`, `name_location`, `studygroup`) VALUES
(83, 8, '2024-05-21 14:57:56', 634230061, '1773724683.jpg', '', 'อนุมัติ', 'ดวงสอาด', 'ชัยรัตน์', '', '', 'ทำความสะอาด', 'นาย', '', '63/44'),
(85, 35, '2024-05-21 15:21:33', 634230063, '122131436.jpg', '', 'อนุมัติ', 'อับดุลเลาะ', 'ภาคิน', '', '', 'กวาดวัด', 'นาย', '', '63/43'),
(86, 14, '2024-05-21 15:22:15', 634230063, '234367746.jpg', '', 'อนุมัติ', 'อับดุลเลาะ', 'ภาคิน', '', '', 'กวาดโรงอาหาร', 'นาย', '', '63/43'),
(87, 37, '2024-05-21 15:28:32', 634230045, '1182729394.jpg', '', 'อนุมัติ', 'คงมะคา', 'พิธีกร', '', '', 'พิธีไหว้ครู', 'นาย', '', '63/44'),
(88, 5, '2024-05-21 16:20:10', 634230061, '1711249834.jpg', '', 'อนุมัติ', 'ดวงสอาด', 'ชัยรัตน์', '', '', 'พิธีไหว้ครู', 'นาย', '', '63/44'),
(89, 36, '2024-05-21 16:20:27', 634230046, '487332472.jpg', '', 'อนุมัติ', 'กันสิริ', 'วงศธร', '', '', 'พิธีไหว้ครู', 'นาย', '', '63/44'),
(187, 5, '2024-05-21 16:35:13', 634230061, '811538383.jpg', 'ทำความสะอาบบริเวณวัดใหม่', 'อนุมัติ', 'ดวงสอาด', 'ชัยรัตน์', 'ทำความสะอาดห้องน้ำ', '1917427786.png', '', 'นาย', 'วัดใหม่', '63/44');

-- --------------------------------------------------------

--
-- Table structure for table `unsuccessful`
--

CREATE TABLE `unsuccessful` (
  `studentID` int(10) NOT NULL,
  `collect_hours` int(5) NOT NULL,
  `name_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img` varchar(255) NOT NULL,
  `name_message` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `activity2` varchar(255) NOT NULL,
  `img_confirm` varchar(255) NOT NULL,
  `name_activity` varchar(255) NOT NULL,
  `mr_ms` varchar(255) NOT NULL,
  `name_location` varchar(255) NOT NULL,
  `studygroup` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unsuccessful`
--

INSERT INTO `unsuccessful` (`studentID`, `collect_hours`, `name_time`, `img`, `name_message`, `user_status`, `id`, `firstname`, `lastname`, `activity2`, `img_confirm`, `name_activity`, `mr_ms`, `name_location`, `studygroup`) VALUES
(634230063, 5, '2024-05-21 14:49:33', '1912625148.jpg', '', 'ไม่อนุมัติ', 77, 'ภาคิน', 'อับดุลเรอะ', '', '', 'กวาดวัด', 'นาย', '', ''),
(634230061, 5, '2024-05-21 17:12:21', '670488969.jpg', '', 'ไม่อนุมัติ', 91, 'ชัยรัตน์', 'ดวงสอาด', '', '', 'พิธีไหว้ครู', 'นาย', '', '63/44'),
(634230061, 5, '2024-05-21 16:38:31', '381595860.jpg', 'กวาดวัดใหม่', 'ไม่อนุมัติ', 189, 'ชัยรัตน์', 'ดวงสอาด', 'กวาดวัด', '684722847.png', '', 'นาย', 'วัดใหม่', '63/44');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL COMMENT 'เบอร์',
  `urole` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mr_ms` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `email`, `password`, `firstname`, `number`, `urole`, `lastname`, `mr_ms`) VALUES
(63, '5555@gmail.com', '$2y$10$s4EYDz7PaEFJsDZWK.dxAeFcpMblbVovxV2h7UI7MgJZjXuRH8jca', 'ชัยรัตน์', '0959029699', 'admin', 'ดวงสอาด', 'นาย'),
(60, '12345@gmail.com', '$2y$10$k1K.0gg.IU1LOoqzBrx.vObC/FLawCDo9UaKWOn2KJrTf5CVitqka', 'วงศธร', '0959029699', 'admin', 'กันสิริ', 'นาย'),
(59, '1234@gmail.com', '$2y$10$N52I9vbIPfC1ikAatw13judS6iBfTdGqJjenzrLQffNkgSyoYatdK', 'พิธีกร', '0959029699', 'admin', 'คงมะคา', 'นาย'),
(64, 'idooy1231@gmail.com', '$2y$10$1wxoAlbaHIyQaDB/4QroAO63Js8DXNCuO/9nTX2cFVwut11H9Npcu', 'ชัยรัตน์', '0959029699', 'admin', 'ดวงสอาด', 'นาย');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_activity`
--
ALTER TABLE `add_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_student`
--
ALTER TABLE `info_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `join_activity`
--
ALTER TABLE `join_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentuser`
--
ALTER TABLE `studentuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `successful`
--
ALTER TABLE `successful`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unsuccessful`
--
ALTER TABLE `unsuccessful`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_activity`
--
ALTER TABLE `add_activity`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `info_student`
--
ALTER TABLE `info_student`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `join_activity`
--
ALTER TABLE `join_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `studentuser`
--
ALTER TABLE `studentuser`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `successful`
--
ALTER TABLE `successful`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `unsuccessful`
--
ALTER TABLE `unsuccessful`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
