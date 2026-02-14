-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2026 at 03:15 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `durbeen_message`
--

-- --------------------------------------------------------

--
-- Table structure for table `1 to 1`
--

CREATE TABLE `1 to 1` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `message` longtext DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 to 1`
--

INSERT INTO `1 to 1` (`id`, `message`, `image`, `time`) VALUES
(1, '', '698b4164f41b5_10_Feb_2026_Tue_08_32_04_pm.jpeg', 'Asia/Dhaka time: 10-Feb-2026-Tue-08:32:04 pm'),
(2, 'f', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:18:19 pm'),
(3, 'f', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:20:58 pm'),
(4, 'y', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:21:47 pm'),
(5, 't', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:50:42 pm');

-- --------------------------------------------------------

--
-- Table structure for table `1 to 2`
--

CREATE TABLE `1 to 2` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `sender` bigint(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL,
  `seen` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 to 2`
--

INSERT INTO `1 to 2` (`id`, `sender`, `message`, `image`, `time`, `seen`) VALUES
(1, 1, 'a', '', 'Asia/Dhaka time: 06-Feb-2026-Fri-09:33:03 am', 'Seen'),
(2, 1, 'ss', '', 'Asia/Dhaka time: 06-Feb-2026-Fri-09:43:26 am', 'Seen'),
(3, 1, '', '698564ee6cabe_06_Feb_2026_Fri_09_50_06_am.jpeg', 'Asia/Dhaka time: 06-Feb-2026-Fri-09:50:06 am', 'Unseen'),
(5, 1, 'b', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:20:16 pm', 'Unseen'),
(6, 1, 'f', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:20:54 pm', 'Unseen'),
(7, 1, 't', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:50:46 pm', 'Unseen');

-- --------------------------------------------------------

--
-- Table structure for table `1 to 3`
--

CREATE TABLE `1 to 3` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `sender` bigint(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL,
  `seen` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 to 3`
--

INSERT INTO `1 to 3` (`id`, `sender`, `message`, `image`, `time`, `seen`) VALUES
(9, 1, 'Hello, i want to follow you. Please allow me so that i can follow you', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:21:01 pm', 'Unseen'),
(10, 1, 'Hello, i want to follow you. Please allow me so that i can follow you', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:21:10 pm', 'Unseen'),
(11, 1, 'Hello, i want to follow you. Please allow me so that i can follow you', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:21:25 pm', 'Unseen'),
(12, 1, 'Hello, i want to follow you. Please allow me so that i can follow you', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:21:41 pm', 'Unseen'),
(13, 1, 'Hello, i want to follow you. Please allow me so that i can follow you', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:21:54 pm', 'Unseen'),
(14, 1, 'h', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:50:38 pm', 'Unseen'),
(15, 1, 'Hello, i want to follow you. Please allow me so that i can follow you', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:50:56 pm', 'Unseen');

-- --------------------------------------------------------

--
-- Table structure for table `2 to 2`
--

CREATE TABLE `2 to 2` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `message` longtext DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `3 to 3`
--

CREATE TABLE `3 to 3` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `message` longtext DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group 1`
--

CREATE TABLE `group 1` (
  `id` int(255) UNSIGNED NOT NULL,
  `senderName` varchar(1000) DEFAULT NULL,
  `senderId` varchar(1000) DEFAULT NULL,
  `senderProPic` varchar(1000) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 1`
--

INSERT INTO `group 1` (`id`, `senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES
(1, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', '', '6985650db1c7c_06_Feb_2026_Fri_09_50_37_am.jpeg', 'Asia/Dhaka time: 06-Feb-2026-Fri-09:50:37 am'),
(6, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', 'f', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:20:31 pm'),
(7, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', 'f', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:27:40 pm');

-- --------------------------------------------------------

--
-- Table structure for table `group 1 members`
--

CREATE TABLE `group 1 members` (
  `id` int(255) UNSIGNED NOT NULL,
  `memberId` varchar(1000) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 1 members`
--

INSERT INTO `group 1 members` (`id`, `memberId`, `admin`) VALUES
(1, '1', 1),
(8, '2', 1),
(9, '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `group 2`
--

CREATE TABLE `group 2` (
  `id` int(255) UNSIGNED NOT NULL,
  `senderName` varchar(1000) DEFAULT NULL,
  `senderId` varchar(1000) DEFAULT NULL,
  `senderProPic` varchar(1000) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 2`
--

INSERT INTO `group 2` (`id`, `senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES
(1, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', 'g', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:18:15 pm'),
(2, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', 'f', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:20:28 pm'),
(3, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', 't', '', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:50:50 pm');

-- --------------------------------------------------------

--
-- Table structure for table `group 2 members`
--

CREATE TABLE `group 2 members` (
  `id` int(255) UNSIGNED NOT NULL,
  `memberId` varchar(1000) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 2 members`
--

INSERT INTO `group 2 members` (`id`, `memberId`, `admin`) VALUES
(1, '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1 to 1`
--
ALTER TABLE `1 to 1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 to 2`
--
ALTER TABLE `1 to 2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 to 3`
--
ALTER TABLE `1 to 3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 to 2`
--
ALTER TABLE `2 to 2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 to 3`
--
ALTER TABLE `3 to 3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 1`
--
ALTER TABLE `group 1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 1 members`
--
ALTER TABLE `group 1 members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 2`
--
ALTER TABLE `group 2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 2 members`
--
ALTER TABLE `group 2 members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1 to 1`
--
ALTER TABLE `1 to 1`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `1 to 2`
--
ALTER TABLE `1 to 2`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `1 to 3`
--
ALTER TABLE `1 to 3`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `2 to 2`
--
ALTER TABLE `2 to 2`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `3 to 3`
--
ALTER TABLE `3 to 3`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group 1`
--
ALTER TABLE `group 1`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group 1 members`
--
ALTER TABLE `group 1 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `group 2`
--
ALTER TABLE `group 2`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group 2 members`
--
ALTER TABLE `group 2 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
