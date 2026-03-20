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
-- Database: `durbeen_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `1 allow`
--

CREATE TABLE `1 allow` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 allow`
--

INSERT INTO `1 allow` (`id`, `unique_id_fr`) VALUES
(1, 1),
(2, 2),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `1 chats`
--

CREATE TABLE `1 chats` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL,
  `chat_type` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 chats`
--

INSERT INTO `1 chats` (`id`, `unique_id_fr`, `chat_type`) VALUES
(37, 1, 2),
(45, 2, 2),
(46, 3, 3),
(47, 1, 1),
(48, 3, 2),
(49, 4, 2),
(50, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `1 cov_pic`
--

CREATE TABLE `1 cov_pic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `cov_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 follow`
--

CREATE TABLE `1 follow` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 follow`
--

INSERT INTO `1 follow` (`id`, `unique_id_fr`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `1 msg_grp`
--

CREATE TABLE `1 msg_grp` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `grp_id` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 msg_grp`
--

INSERT INTO `1 msg_grp` (`id`, `grp_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `1 notify`
--

CREATE TABLE `1 notify` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `sender_id` bigint(255) DEFAULT NULL,
  `seen` tinyint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 pro_pic`
--

CREATE TABLE `1 pro_pic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `pro_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `1 pro_pic`
--

INSERT INTO `1 pro_pic` (`id`, `pro_pic`) VALUES
(1, '6985608aaa0ef_06_Feb_2026_Fri_09_31_22_am.jpg'),
(2, '69ac0f286c0c5_07_Mar_2026_Sat_05_42_32_pm.webp');

-- --------------------------------------------------------

--
-- Table structure for table `2 allow`
--

CREATE TABLE `2 allow` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2 allow`
--

INSERT INTO `2 allow` (`id`, `unique_id_fr`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `2 chats`
--

CREATE TABLE `2 chats` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL,
  `chat_type` smallint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2 chats`
--

INSERT INTO `2 chats` (`id`, `unique_id_fr`, `chat_type`) VALUES
(1, 2, 1),
(19, 1, 2),
(26, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `2 cov_pic`
--

CREATE TABLE `2 cov_pic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `cov_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `2 follow`
--

CREATE TABLE `2 follow` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2 follow`
--

INSERT INTO `2 follow` (`id`, `unique_id_fr`) VALUES
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `2 msg_grp`
--

CREATE TABLE `2 msg_grp` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `grp_id` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `2 msg_grp`
--

INSERT INTO `2 msg_grp` (`id`, `grp_id`) VALUES
(7, 1),
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `2 notify`
--

CREATE TABLE `2 notify` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `sender_id` bigint(255) DEFAULT NULL,
  `seen` tinyint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `2 pro_pic`
--

CREATE TABLE `2 pro_pic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `pro_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `3 allow`
--

CREATE TABLE `3 allow` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3 allow`
--

INSERT INTO `3 allow` (`id`, `unique_id_fr`) VALUES
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `3 chats`
--

CREATE TABLE `3 chats` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL,
  `chat_type` smallint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3 chats`
--

INSERT INTO `3 chats` (`id`, `unique_id_fr`, `chat_type`) VALUES
(1, 3, 1),
(11, 1, 2),
(13, 1, 3),
(14, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `3 cov_pic`
--

CREATE TABLE `3 cov_pic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `cov_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `3 follow`
--

CREATE TABLE `3 follow` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `unique_id_fr` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3 follow`
--

INSERT INTO `3 follow` (`id`, `unique_id_fr`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `3 msg_grp`
--

CREATE TABLE `3 msg_grp` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `grp_id` bigint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3 msg_grp`
--

INSERT INTO `3 msg_grp` (`id`, `grp_id`) VALUES
(1, 1),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `3 notify`
--

CREATE TABLE `3 notify` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `sender_id` bigint(255) DEFAULT NULL,
  `seen` tinyint(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `3 notify`
--

INSERT INTO `3 notify` (`id`, `sender`, `sender_id`, `seen`) VALUES
(21, 'Md Mehrab Alam Shayikh', 1, 0),
(22, 'Md Mehrab Alam Shayikh', 1, 0),
(23, 'Md Mehrab Alam Shayikh', 1, 0),
(24, 'Md Mehrab Alam Shayikh', 1, 0),
(25, 'Md Mehrab Alam Shayikh', 1, 0),
(26, 'Md Mehrab Alam Shayikh', 1, 0),
(27, 'Md Mehrab Alam Shayikh', 1, 0),
(28, 'Md Mehrab Alam Shayikh', 1, 0),
(29, 'Md Mehrab Alam Shayikh', 1, 0),
(30, 'Md Mehrab Alam Shayikh', 1, 0),
(31, 'Md Mehrab Alam Shayikh', 1, 0),
(32, 'Md Mehrab Alam Shayikh', 1, 0),
(33, 'Md Mehrab Alam Shayikh', 1, 0),
(34, 'Md Mehrab Alam Shayikh', 1, 0),
(35, 'Md Mehrab Alam Shayikh', 1, 0),
(36, 'Md Mehrab Alam Shayikh', 1, 0),
(37, 'Md Mehrab Alam Shayikh', 1, 0),
(38, 'Md Mehrab Alam Shayikh', 1, 0),
(39, 'Md Mehrab Alam Shayikh', 1, 0),
(40, 'Md Mehrab Alam Shayikh', 1, 0),
(41, 'Md Mehrab Alam Shayikh', 1, 0),
(42, 'Md Mehrab Alam Shayikh', 1, 0),
(43, 'Md Mehrab Alam Shayikh', 1, 0),
(44, 'Md Mehrab Alam Shayikh', 1, 0),
(45, 'Md Mehrab Alam Shayikh', 1, 0),
(46, 'Md Mehrab Alam Shayikh', 1, 0),
(47, 'Md Mehrab Alam Shayikh', 1, 0),
(48, 'Md Mehrab Alam Shayikh', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `3 pro_pic`
--

CREATE TABLE `3 pro_pic` (
  `id` bigint(255) UNSIGNED NOT NULL,
  `pro_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `1 allow`
--
ALTER TABLE `1 allow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 chats`
--
ALTER TABLE `1 chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 cov_pic`
--
ALTER TABLE `1 cov_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 follow`
--
ALTER TABLE `1 follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 msg_grp`
--
ALTER TABLE `1 msg_grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 notify`
--
ALTER TABLE `1 notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `1 pro_pic`
--
ALTER TABLE `1 pro_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 allow`
--
ALTER TABLE `2 allow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 chats`
--
ALTER TABLE `2 chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 cov_pic`
--
ALTER TABLE `2 cov_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 follow`
--
ALTER TABLE `2 follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 msg_grp`
--
ALTER TABLE `2 msg_grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 notify`
--
ALTER TABLE `2 notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `2 pro_pic`
--
ALTER TABLE `2 pro_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 allow`
--
ALTER TABLE `3 allow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 chats`
--
ALTER TABLE `3 chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 cov_pic`
--
ALTER TABLE `3 cov_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 follow`
--
ALTER TABLE `3 follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 msg_grp`
--
ALTER TABLE `3 msg_grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 notify`
--
ALTER TABLE `3 notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `3 pro_pic`
--
ALTER TABLE `3 pro_pic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1 allow`
--
ALTER TABLE `1 allow`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `1 chats`
--
ALTER TABLE `1 chats`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `1 cov_pic`
--
ALTER TABLE `1 cov_pic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 follow`
--
ALTER TABLE `1 follow`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `1 msg_grp`
--
ALTER TABLE `1 msg_grp`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `1 notify`
--
ALTER TABLE `1 notify`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 pro_pic`
--
ALTER TABLE `1 pro_pic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `2 allow`
--
ALTER TABLE `2 allow`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `2 chats`
--
ALTER TABLE `2 chats`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `2 cov_pic`
--
ALTER TABLE `2 cov_pic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `2 follow`
--
ALTER TABLE `2 follow`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `2 msg_grp`
--
ALTER TABLE `2 msg_grp`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `2 notify`
--
ALTER TABLE `2 notify`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `2 pro_pic`
--
ALTER TABLE `2 pro_pic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `3 allow`
--
ALTER TABLE `3 allow`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `3 chats`
--
ALTER TABLE `3 chats`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `3 cov_pic`
--
ALTER TABLE `3 cov_pic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `3 follow`
--
ALTER TABLE `3 follow`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `3 msg_grp`
--
ALTER TABLE `3 msg_grp`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `3 notify`
--
ALTER TABLE `3 notify`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `3 pro_pic`
--
ALTER TABLE `3 pro_pic`
  MODIFY `id` bigint(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
