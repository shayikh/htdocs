-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 06:41 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahsan_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `1 allow`
--

CREATE TABLE `1 allow` (
  `id` int(255) UNSIGNED NOT NULL,
  `unique_id_fr` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 chats`
--

CREATE TABLE `1 chats` (
  `id` int(255) UNSIGNED NOT NULL,
  `unique_id_fr` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 cov_pic`
--

CREATE TABLE `1 cov_pic` (
  `id` int(255) UNSIGNED NOT NULL,
  `cov_pic` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 follow`
--

CREATE TABLE `1 follow` (
  `id` int(255) UNSIGNED NOT NULL,
  `unique_id_fr` int(255) DEFAULT NULL
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
  `id` int(255) UNSIGNED NOT NULL,
  `grp_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 notify`
--

CREATE TABLE `1 notify` (
  `id` int(255) UNSIGNED NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `sender_id` int(255) DEFAULT NULL,
  `seen` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `1 pro_pic`
--

CREATE TABLE `1 pro_pic` (
  `id` int(255) UNSIGNED NOT NULL,
  `pro_pic` varchar(1000) DEFAULT NULL,
  `watch` tinyint(1) DEFAULT 1
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `1 allow`
--
ALTER TABLE `1 allow`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 chats`
--
ALTER TABLE `1 chats`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 cov_pic`
--
ALTER TABLE `1 cov_pic`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 follow`
--
ALTER TABLE `1 follow`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `1 msg_grp`
--
ALTER TABLE `1 msg_grp`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 notify`
--
ALTER TABLE `1 notify`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `1 pro_pic`
--
ALTER TABLE `1 pro_pic`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
