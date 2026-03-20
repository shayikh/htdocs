-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 08:29 AM
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
-- Database: `durbeen`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` bigint(255) NOT NULL,
  `unique_id` bigint(255) NOT NULL,
  `bio` longtext DEFAULT NULL,
  `date_birth` varchar(1000) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone_no` varchar(1000) DEFAULT NULL,
  `religion` varchar(1000) DEFAULT NULL,
  `country` varchar(1000) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `question_one` text NOT NULL,
  `answer_one` text NOT NULL,
  `question_two` text NOT NULL,
  `answer_two` text NOT NULL,
  `question_three` text NOT NULL,
  `answer_three` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `unique_id`, `bio`, `date_birth`, `gender`, `phone_no`, `religion`, `country`, `city`, `question_one`, `answer_one`, `question_two`, `answer_two`, `question_three`, `answer_three`) VALUES
(1, 1, '', '0001-11-11', 'Male', '', '', '', '', '', '', '', '', '', ''),
(2, 2, '', '0001-11-11', 'Male', '', '', '', '', '', '', '', '', '', ''),
(3, 3, '', '0002-02-22', 'Male', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(255) NOT NULL,
  `post_id` bigint(255) NOT NULL,
  `post_giver_id` bigint(255) NOT NULL,
  `comn_giver_id` bigint(255) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `post_giver_id`, `comn_giver_id`, `time`, `comment`) VALUES
(6, 2, 1, 1, 'Asia/Dhaka time: 07-Mar-2026-Sat-04:52:23 pm', 'ok'),
(8, 2, 1, 2, 'Asia/Dhaka time: 07-Mar-2026-Sat-07:48:41 pm', 'rrg'),
(9, 2, 1, 2, 'Asia/Dhaka time: 07-Mar-2026-Sat-07:48:43 pm', 'hrhr'),
(10, 1, 1, 2, 'Asia/Dhaka time: 07-Mar-2026-Sat-07:48:48 pm', 'hrhrh'),
(11, 1, 1, 2, 'Asia/Dhaka time: 07-Mar-2026-Sat-07:48:50 pm', 'reh'),
(12, 2, 1, 1, 'Asia/Dhaka time: 07-Mar-2026-Sat-07:50:03 pm', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `dislike_post`
--

CREATE TABLE `dislike_post` (
  `id` bigint(255) NOT NULL,
  `post_id` bigint(255) NOT NULL,
  `unique_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislike_post`
--

INSERT INTO `dislike_post` (`id`, `post_id`, `unique_id`) VALUES
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(255) NOT NULL,
  `grp_name` varchar(1000) NOT NULL,
  `pro_pic` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `grp_name`, `pro_pic`) VALUES
(1, 'কিয়ামতের পদধ্বনি', '698560989975b_06_Feb_2026_Fri_09_31_36_am_6981f3f859d13_03_Feb_2026_Tue_07_11_20_pm.jpeg'),
(2, 'Extraterrestrial Intelligence', '699070d917e35_14_Feb_2026_Sat_06_55_53_pm.jpg'),
(3, 'Halal Haram', '69a4424125d95_01_Mar_2026_Sun_07_42_25_pm_images (1).jfif'),
(4, 'Salsabil', '69a4424b2159c_01_Mar_2026_Sun_07_42_35_pm_images.jfif'),
(5, 'Barycenter of Science: Physics', '69a442540af3a_01_Mar_2026_Sun_07_42_44_pm_hq720.jpg'),
(6, 'Jannat', '69ad768c98efb_08_Mar_2026_Sun_07_15_56_pm_images.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE `like_post` (
  `id` bigint(255) NOT NULL,
  `post_id` bigint(255) NOT NULL,
  `unique_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_post`
--

INSERT INTO `like_post` (`id`, `post_id`, `unique_id`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint(255) NOT NULL,
  `unique_id` bigint(255) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) NOT NULL,
  `post` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `unique_id`, `image`, `time`, `post`) VALUES
(1, 1, '699072786f3a1_14_Feb_2026_Sat_07_02_48_pm.jpg', 'Asia/Dhaka time: 14-Feb-2026-Sat-07:02:48 pm', ''),
(2, 1, '69aacc203a642_06_Mar_2026_Fri_06_44_16_pm.jpg', 'Asia/Dhaka time: 06-Mar-2026-Fri-06:44:16 pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `unique_id` bigint(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `pro_pic` varchar(1000) NOT NULL,
  `cov_pic` varchar(1000) NOT NULL,
  `active` tinyint(255) NOT NULL DEFAULT 1,
  `visit` bigint(255) DEFAULT 1,
  `locking` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`unique_id`, `name`, `email`, `password`, `pro_pic`, `cov_pic`, `active`, `visit`, `locking`) VALUES
(1, 'Md Mehrab Alam Shayikh', 'mshayikh114@gmail.com', '1', '69ac0375a0929_07_Mar_2026_Sat_04_52_37_pm.jpeg', 'cov_pic.jpg', 0, 38, 0),
(2, 'Shakil Hossain', 'shakil@gmail.com', '1', '6990722781fca_14_Feb_2026_Sat_07_01_27_pm.jpg', 'cov_pic.jpg', 0, 8, 0),
(3, 'Ahsan Zaman', 'ahsan@gmail.com', '1', '69907109b558f_14_Feb_2026_Sat_06_56_41_pm.jpg', 'cov_pic.jpg', 0, 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislike_post`
--
ALTER TABLE `dislike_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`unique_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dislike_post`
--
ALTER TABLE `dislike_post`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `like_post`
--
ALTER TABLE `like_post`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `unique_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
