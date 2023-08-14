-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 08:01 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
  `cov_pic` varchar(1000) NOT NULL,
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

INSERT INTO `about` (`id`, `unique_id`, `bio`, `cov_pic`, `phone_no`, `religion`, `country`, `city`, `question_one`, `answer_one`, `question_two`, `answer_two`, `question_three`, `answer_three`) VALUES
(1, 1, '', 'cov_pic.jpg', '', '', '', '', '', '', '', '', '', ''),
(2, 2, NULL, 'cov_pic.jpg', NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(3, 3, NULL, 'cov_pic.jpg', NULL, NULL, NULL, NULL, '', '', '', '', '', ''),
(4, 4, '', 'cov_pic.jpg', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(255) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `unique_id_comn` int(255) NOT NULL,
  `name_comn` varchar(1000) NOT NULL,
  `pro_pic_comn` varchar(1000) NOT NULL,
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

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `unique_id`, `image`, `time`, `post`) VALUES
(3, 1, '6257197d49925_2022-Apr-00-42-05_32.jpg', 'Asia/Dhaka time: 14-Apr-2022-Thu-00:42:05', 'ok ok ok nice Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.'),
(4, 1, '62571aecc854f_2022-Apr-00-48-12_2.jpg', 'Asia/Dhaka time: 14-Apr-2022-Thu-00:48:12', 'Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `unique_id` int(255) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `date_birth` varchar(1000) NOT NULL,
  `gender` varchar(1000) NOT NULL,
  `pro_pic` varchar(1000) NOT NULL,
  `active` int(255) NOT NULL,
  `visit` int(255) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`unique_id`, `name`, `email`, `password`, `date_birth`, `gender`, `pro_pic`, `active`, `visit`) VALUES
(1, 'Md Mehrab Alam Shayikh', 'mshayikh114@gmail.com', '11111111', '2022-03-30', 'Male', '62514efeb855d_2022-Apr-11-16-46_shayikh.png', 1, 5),
(2, 'Munna', 'munna@gmail.com', '11111111', '2022-04-20', 'Male', '62514f1f96446_2022-Apr-11-17-19_munna.png', 0, 2),
(3, 'Tarek', 'tarek@gmail.com', '11111111', '2022-04-07', 'Male', '6252eb5f4ebe7_2022-Apr-16-36-15_tarek.png', 0, 1),
(4, 'mishu', 'mishu@gmail.com', '11111111', '2022-04-21', 'Male', '6252eb7596099_2022-Apr-16-36-37_mishu.jpg', 0, 2);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dislike_post`
--
ALTER TABLE `dislike_post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `like_post`
--
ALTER TABLE `like_post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `unique_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
