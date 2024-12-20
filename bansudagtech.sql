-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2024 at 11:24 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bansudagtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `middlename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `suffix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `contact` int DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `rsbsa` varchar(255) DEFAULT NULL,
  `fourps` varchar(255) DEFAULT NULL,
  `indigenous` varchar(255) DEFAULT NULL,
  `tribe_name` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `sex` enum('MALE','FEMALE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `arb` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `tot_male` int DEFAULT NULL,
  `tot_female` int DEFAULT NULL,
  `farmer_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `fullname`, `role`, `contact`, `email`, `password`, `birthdate`, `rsbsa`, `fourps`, `indigenous`, `tribe_name`, `pwd`, `sex`, `arb`, `region`, `province`, `municipality`, `barangay`, `org_name`, `tot_male`, `tot_female`, `farmer_type`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, 'admin@admin.com', '$2y$12$TNnzK8GMWWhwwQWsoNqKvun.QkLLNr06EOSulxNgT1tLUhdlQEt1O', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(2, 'wqewqe', 'adas', 'dasdas', 'Jr.', 'wqewqe adas dasdas Jr.', 'user', 2345678, 'sarahelmenzo13@gmail.com', '$2y$12$gCP36oz8VULIlvm5Lx8I3ecufdDJXr9YTDZ6JuPBpqUj7oaPyTP3m', NULL, 'sd-sf-sg-fg-s2', 'YES', 'NO', NULL, 'YES', 'MALE', 'YES', 'asfsdfsdfsd', 'asdasd', 'asdasdasd', 'sdasd', 'asdasdas', 3, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `content`) VALUES
(3, 'dfdgdg', 'fgdgdfgdfg');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_user`
--

CREATE TABLE `announcement_user` (
  `int` int NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('viewed','unread') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcement_user`
--

INSERT INTO `announcement_user` (`int`, `title`, `content`, `user_id`, `status`) VALUES
(1, 'dfdgdg', 'fgdgdfgdfg', 1, 'unread'),
(2, 'dfdgdg', 'fgdgdfgdfg', 2, 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `calamity_mages`
--

CREATE TABLE `calamity_mages` (
  `id` int NOT NULL,
  `cal_fk_id` int NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calamity_report`
--

CREATE TABLE `calamity_report` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `rsbsa` varchar(255) DEFAULT NULL,
  `calamity_type` varchar(255) DEFAULT NULL,
  `farmer_type` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `tot_male` int DEFAULT NULL,
  `tot_female` int DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `indigenous` varchar(255) DEFAULT NULL,
  `tribe_name` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `arb` varchar(255) DEFAULT NULL,
  `fourps` varchar(255) DEFAULT NULL,
  `crop_type` varchar(255) DEFAULT NULL,
  `partially_damage` int DEFAULT NULL,
  `totally_damage` int DEFAULT NULL,
  `total_area` int DEFAULT NULL,
  `livestock_type` varchar(255) DEFAULT NULL,
  `animal_type` varchar(255) DEFAULT NULL,
  `age_class` int DEFAULT NULL,
  `no_heads` int DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `assistance_type` varchar(255) DEFAULT NULL,
  `date_provided` date DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `rsbsa` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `commodity` varchar(255) NOT NULL,
  `farm_type` varchar(255) NOT NULL,
  `forms_farm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `user_id`, `rsbsa`, `fullname`, `commodity`, `farm_type`, `forms_farm`, `location`) VALUES
(4, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'LIVESTOCK', 'SHEEP', '', 'VG43+76 Lakesland NSW, Australia'),
(5, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'CROP', 'CORN', '', '203bde brg pag asa, Bansud, Oriental Mindoro, Philippines'),
(6, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'LIVESTOCK', 'PIG', 'BACKYARD', '3HG3+78 Silverdale NSW, Australia'),
(7, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'CROP', 'WHEAT', NULL, 'X8J4+2F Kanangra NSW, Australia');

-- --------------------------------------------------------

--
-- Table structure for table `farms_images`
--

CREATE TABLE `farms_images` (
  `id` int NOT NULL,
  `farms_fk_id` int NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farms_images`
--

INSERT INTO `farms_images` (`id`, `farms_fk_id`, `image`) VALUES
(7, 4, 'farm_6764c7a3b26520.40637925.jpg'),
(8, 4, 'farm_6764c7a3b3a155.30621911.jpg'),
(9, 5, 'farm_6764e7251fe817.72840370.jpg'),
(10, 5, 'farm_6764e72522e9f9.66566891.jpg'),
(11, 5, 'farm_6764e72525a485.39099922.jpg'),
(12, 6, 'farm_67654bf2a1d920.24366742.jfif'),
(13, 6, 'farm_67654bf2a2d431.08038333.jfif'),
(14, 6, 'farm_67654bf2a3d9f7.68365411.jfif'),
(15, 7, 'farm_67654c3a7607b2.39238711.jfif'),
(16, 7, 'farm_67654c3a773686.79680650.jfif'),
(17, 7, 'farm_67654c3a78a188.66633182.jfif'),
(18, 7, 'farm_67654c3a79a876.31444706.jfif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement_user`
--
ALTER TABLE `announcement_user`
  ADD PRIMARY KEY (`int`);

--
-- Indexes for table `calamity_mages`
--
ALTER TABLE `calamity_mages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calamity_report`
--
ALTER TABLE `calamity_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farms_images`
--
ALTER TABLE `farms_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcement_user`
--
ALTER TABLE `announcement_user`
  MODIFY `int` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `calamity_mages`
--
ALTER TABLE `calamity_mages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calamity_report`
--
ALTER TABLE `calamity_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `farms_images`
--
ALTER TABLE `farms_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
