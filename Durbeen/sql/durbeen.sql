-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 01:47 PM
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
-- Database: `durbeen`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(255) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `bio` text DEFAULT NULL,
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
(1, 1, '', '1995-10-01', 'Male', '8801830872455', '', '', 'Rajshahi Cantt. TSO', '', '', '', '', '', ''),
(2, 2, '', '0001-11-11', 'Male', '', '', '', '', '', '', '', '', '', ''),
(3, 3, NULL, '0001-11-11', 'Male', NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(4, 4, NULL, '0001-11-11', 'Male', NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(5, 5, NULL, '0001-11-11', 'Male', NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(6, 6, NULL, '0001-11-11', 'Male', NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(7, 7, '', '0001-11-11', 'Male', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `post_giver_id` int(255) NOT NULL,
  `comn_giver_id` int(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `pro_pic` varchar(1000) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dislike_post`
--

CREATE TABLE `dislike_post` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `unique_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(255) NOT NULL,
  `grp_name` varchar(1000) NOT NULL,
  `pro_pic` varchar(1000) NOT NULL,
  `admin_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `grp_name`, `pro_pic`, `admin_id`) VALUES
(1, 'Study House Dept of Chemistry 59', '667bd5ff3a8c0_2024-Jun-10-49-03_images (1).jpeg', 1),
(2, 'Team Noob', '667b0d1d93a22_2024-Jun-20-31-57_images.jpeg', 1),
(3, 'Valorant Players', '667b0fe387a80_2024-Jun-20-43-47_DRACO-spacecraft_nuclear-powered_1medium-scaled.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE `like_post` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `unique_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(255) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `time` varchar(1000) NOT NULL,
  `post` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `unique_id` int(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `pro_pic` varchar(1000) NOT NULL,
  `cov_pic` varchar(1000) NOT NULL,
  `active` int(255) NOT NULL DEFAULT 1,
  `visit` int(255) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`unique_id`, `name`, `email`, `password`, `pro_pic`, `cov_pic`, `active`, `visit`) VALUES
(1, 'Md Mehrab Alam  Shayikh', 'mshayikh114@gmail.com', '1', '66741f8fa4d7d_2024-Jun-14-24-47_WhatsApp Image 2024-05-31 at 22.49.38_bdbcb653.jpg', 'cov_pic.jpg', 1, 22),
(2, 'MD AHSANUZZAMAN', 'ahsan@gmail.com', '1', '66741fa88f943_2024-Jun-14-25-12_R (1).jpeg', 'cov_pic.jpg', 0, 14),
(3, 'Shakil Hossain', 'shakil@gmail.com', '1', '66741fbbb94d6_2024-Jun-14-25-31_spacecraft-1.jpg', 'cov_pic.jpg', 0, 6),
(4, 'Tarek Ahmed', 'tarek@gmail.com', '1', '66741fd54126b_2024-Jun-14-25-57_BepiColombo_s_cruise_configuration_pillars.jpg', 'cov_pic.jpg', 0, 2),
(5, 'Jasim Uddin', 'jasim@gmail.com', '1', '667707a09a3f3_2024-Jun-19-19-28_hr5thcthmw1z4jzqi8ac.webp', 'cov_pic.jpg', 0, 1),
(6, 'Shamim Reaza', 'shamim@gmail.com', '1', '667707c84b536_2024-Jun-19-20-08_R.jpeg', 'cov_pic.jpg', 0, 1),
(7, 'Jewel Ahmed', 'jewel@gmail.com', '1', '66770897b812c_2024-Jun-19-23-35_OIP.jpeg', 'cov_pic.jpg', 0, 3);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dislike_post`
--
ALTER TABLE `dislike_post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `like_post`
--
ALTER TABLE `like_post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `unique_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
