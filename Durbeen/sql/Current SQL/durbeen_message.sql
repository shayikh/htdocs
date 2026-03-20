-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 08:30 AM
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
(14, '', '69a593b52b3a3_02_Mar_2026_Mon_07_42_13_pm.jfif', 'The time in Asia/Dhaka is 02-Mar-2026-Mon-07:42:13 pm');

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
(28, 1, '', '69a593b62afa4_02_Mar_2026_Mon_07_42_14_pm.jfif', 'The time in Asia/Dhaka is 02-Mar-2026-Mon-07:42:14 pm', 'Unseen');

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
(8, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', '', '69a2e2ca344b3_28_Feb_2026_Sat_06_42_50_pm_grp_id_2.jfif', 'The time in Asia/Dhaka is 28-Feb-2026-Sat-06:42:50 pm');

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

-- --------------------------------------------------------

--
-- Table structure for table `group 3`
--

CREATE TABLE `group 3` (
  `id` int(255) UNSIGNED NOT NULL,
  `senderName` varchar(1000) DEFAULT NULL,
  `senderId` varchar(1000) DEFAULT NULL,
  `senderProPic` varchar(1000) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group 3 members`
--

CREATE TABLE `group 3 members` (
  `id` int(255) UNSIGNED NOT NULL,
  `memberId` varchar(1000) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 3 members`
--

INSERT INTO `group 3 members` (`id`, `memberId`, `admin`) VALUES
(1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `group 4`
--

CREATE TABLE `group 4` (
  `id` int(255) UNSIGNED NOT NULL,
  `senderName` varchar(1000) DEFAULT NULL,
  `senderId` varchar(1000) DEFAULT NULL,
  `senderProPic` varchar(1000) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group 4 members`
--

CREATE TABLE `group 4 members` (
  `id` int(255) UNSIGNED NOT NULL,
  `memberId` varchar(1000) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 4 members`
--

INSERT INTO `group 4 members` (`id`, `memberId`, `admin`) VALUES
(1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `group 5`
--

CREATE TABLE `group 5` (
  `id` int(255) UNSIGNED NOT NULL,
  `senderName` varchar(1000) DEFAULT NULL,
  `senderId` varchar(1000) DEFAULT NULL,
  `senderProPic` varchar(1000) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 5`
--

INSERT INTO `group 5` (`id`, `senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES
(4, 'Md Mehrab Alam Shayikh', '1', '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg', '', '69a593b433a2a_02_Mar_2026_Mon_07_42_12_pm.jfif', 'The time in Asia/Dhaka is 02-Mar-2026-Mon-07:42:12 pm');

-- --------------------------------------------------------

--
-- Table structure for table `group 5 members`
--

CREATE TABLE `group 5 members` (
  `id` int(255) UNSIGNED NOT NULL,
  `memberId` varchar(1000) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 5 members`
--

INSERT INTO `group 5 members` (`id`, `memberId`, `admin`) VALUES
(1, '1', 1),
(2, '3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `group 6`
--

CREATE TABLE `group 6` (
  `id` int(255) UNSIGNED NOT NULL,
  `senderName` varchar(1000) DEFAULT NULL,
  `senderId` varchar(1000) DEFAULT NULL,
  `senderProPic` varchar(1000) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 6`
--

INSERT INTO `group 6` (`id`, `senderName`, `senderId`, `senderProPic`, `message`, `image`, `time`) VALUES
(1, 'Md Mehrab Alam Shayikh', '1', '69ac0375a0929_07_Mar_2026_Sat_04_52_37_pm.jpeg', 'world war 3\r\n', '69ad785aebe45_08_Mar_2026_Sun_07_23_38_pm.jpg', 'Asia/Dhaka time: 08-Mar-2026-Sun-07:23:38 pm'),
(2, 'Md Mehrab Alam Shayikh', '1', '69ac0375a0929_07_Mar_2026_Sat_04_52_37_pm.jpeg', 'mahdi', '69ad786f16f4d_08_Mar_2026_Sun_07_23_59_pm.jpg', 'Asia/Dhaka time: 08-Mar-2026-Sun-07:23:59 pm');

-- --------------------------------------------------------

--
-- Table structure for table `group 6 members`
--

CREATE TABLE `group 6 members` (
  `id` int(255) UNSIGNED NOT NULL,
  `memberId` varchar(1000) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group 6 members`
--

INSERT INTO `group 6 members` (`id`, `memberId`, `admin`) VALUES
(1, '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1 to 1`
--
ALTER TABLE `1 to 1`
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
-- Indexes for table `group 3`
--
ALTER TABLE `group 3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 3 members`
--
ALTER TABLE `group 3 members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 4`
--
ALTER TABLE `group 4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 4 members`
--
ALTER TABLE `group 4 members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 5`
--
ALTER TABLE `group 5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 5 members`
--
ALTER TABLE `group 5 members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 6`
--
ALTER TABLE `group 6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group 6 members`
--
ALTER TABLE `group 6 members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1 to 1`
--
ALTER TABLE `1 to 1`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `1 to 3`
--
ALTER TABLE `1 to 3`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `group 1 members`
--
ALTER TABLE `group 1 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `group 2`
--
ALTER TABLE `group 2`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `group 2 members`
--
ALTER TABLE `group 2 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group 3`
--
ALTER TABLE `group 3`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group 3 members`
--
ALTER TABLE `group 3 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group 4`
--
ALTER TABLE `group 4`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group 4 members`
--
ALTER TABLE `group 4 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group 5`
--
ALTER TABLE `group 5`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group 5 members`
--
ALTER TABLE `group 5 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group 6`
--
ALTER TABLE `group 6`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group 6 members`
--
ALTER TABLE `group 6 members`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
