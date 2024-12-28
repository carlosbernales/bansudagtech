-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2024 at 03:37 AM
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
  `contact` varchar(255) DEFAULT NULL,
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
(1, 'Admin', NULL, 'Admin', NULL, 'Admin  Admin ', 'admin', NULL, 'admin@admin.com', '$2y$12$8KAHM0a5B0q5bVxTVKV4cOxBB1lfobCrZ.XojQtFnZ5KQKx4qR0.q', NULL, '23-45-79-92-81', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'INDIVIDUAL'),
(2, 'wqewqe', 'adas', 'dasdas', 'Jr.', 'wqewqe adas dasdas Jr.', 'user', '2345678', 'carlosbernales24@gmail.com', '$2y$12$3EiOYw.R5UhzoHbhyAEBtezV1tQNai7SQXmv7njgrRlpAO4MNc95y', '2024-12-21', 'sd-sf-sg-fg-s2', 'YES', 'NO', NULL, 'YES', 'MALE', 'YES', 'asfsdfsdfsd', 'asdasd', 'asdasdasd', 'sdasd', 'asdasdas', 3, 2, 'GROUP'),
(6, 'Carlos', 'Laurel', 'Bernales', 'Jr.', 'Carlos Laurel Bernales Jr.', 'user', '09951776920', 'bernalescarlos480@gmail.com', '$2y$12$F4HwmqfEgQK3ijidyvyPJOUNAn6dbil5I/p4vVSEHCe.c8tARzeh2', '2024-12-28', '32-13-21-27-8d-fs', 'NO', 'YES', 'Mangyan', 'NO', 'MALE', 'NO', 'MIMAROPA', 'ORIENTAL MINDORO', 'CALAPAN', 'MASIPIT', 'WALA', 3, 2, 'INDIVIDUAL');

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
(3, 'dfdgdg', 'fgdgdfgdfg'),
(5, 'dad', 'asdsadsad'),
(6, 'sdasd', 'asdasdsad'),
(7, 'WALA', 'adasdadadasdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_user`
--

CREATE TABLE `announcement_user` (
  `id` int NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('viewed','unread') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `announcement_user`
--

INSERT INTO `announcement_user` (`id`, `title`, `content`, `user_id`, `status`) VALUES
(1, 'dfdgdg', 'fgdgdfgdfg', 1, 'unread'),
(2, 'dfdgdg', 'fgdgdfgdfg', 2, 'unread'),
(3, 'adsa', 'dasdasd', 1, 'unread'),
(4, 'adsa', 'dasdasd', 2, 'unread'),
(5, 'dad', 'asdsadsad', 2, 'unread'),
(6, 'sdasd', 'asdasdsad', 2, 'unread'),
(7, 'sdasd', 'asdasdsad', 6, 'unread'),
(8, 'WALA', 'adasdadadasdasdasd', 2, 'unread'),
(9, 'WALA', 'adasdadadasdasdasd', 6, 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `assistance`
--

CREATE TABLE `assistance` (
  `id` int NOT NULL,
  `assistance_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `assistance`
--

INSERT INTO `assistance` (`id`, `assistance_type`) VALUES
(2, 'Seeds'),
(3, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `calamity_images`
--

CREATE TABLE `calamity_images` (
  `id` int NOT NULL,
  `cal_fk_id` int NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calamity_images`
--

INSERT INTO `calamity_images` (`id`, `cal_fk_id`, `image`) VALUES
(3, 2, 'calamity_676cc6a4092ba.jpg'),
(4, 2, 'calamity_676cc6a40db60.jpg'),
(5, 2, 'calamity_676cc6a41015f.jpg'),
(6, 3, 'calamity_676cc6c8e478b.jpg'),
(7, 3, 'calamity_676cc6c8e6ec4.jpg'),
(8, 3, 'calamity_676cc6c8e9016.jpg'),
(9, 4, 'calamity_676cc7788c681.jpg'),
(10, 4, 'calamity_676cc7788f32f.jpg'),
(11, 5, 'calamity_676f56b8072f9.jpg'),
(12, 5, 'calamity_676f56b80824d.jpg'),
(13, 5, 'calamity_676f56b808e50.jpg');

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
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Pending',
  `email` varchar(255) NOT NULL,
  `date_reported` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `calamity_report`
--

INSERT INTO `calamity_report` (`id`, `user_id`, `rsbsa`, `calamity_type`, `farmer_type`, `birthdate`, `region`, `province`, `municipality`, `barangay`, `org_name`, `tot_male`, `tot_female`, `sex`, `indigenous`, `tribe_name`, `pwd`, `arb`, `fourps`, `crop_type`, `partially_damage`, `totally_damage`, `total_area`, `livestock_type`, `animal_type`, `age_class`, `no_heads`, `remarks`, `lastname`, `firstname`, `middlename`, `suffix`, `fullname`, `location`, `assistance_type`, `date_provided`, `status`, `email`, `date_reported`) VALUES
(2, 2, 'sd-sf-sg-fg-s2', 'Typhoon', 'GROUP', '2024-12-21', 'asfsdfsdfsd', 'asdasd', 'asdasdasd', 'sdasd', 'asdasdas', 3, 2, 'MALE', 'NO', NULL, 'YES', 'YES', 'YES', 'RICE', 3, NULL, 2, NULL, NULL, NULL, NULL, NULL, 'dasdas', 'wqewqe', 'adas', 'Jr.', 'wqewqe adas dasdas Jr.', '95J9+2C Calapan, Oriental Mindoro, Philippines', 'Cash', '2024-12-25', 'Completed', 'sarahelmenzo13@gmail.com', '2024-12-25 10:59:47'),
(3, 2, 'sd-sf-sg-fg-s2', 'Typhoon', 'GROUP', '2024-12-21', 'asfsdfsdfsd', 'asdasd', 'asdasdasd', 'sdasd', 'asdasdas', 3, 2, 'MALE', 'NO', NULL, 'YES', 'YES', 'YES', NULL, NULL, NULL, NULL, 'BACKYARD', 'PIG', 3, 6, NULL, 'dasdas', 'wqewqe', 'adas', 'Jr.', 'wqewqe adas dasdas Jr.', '85XV+68 Calapan, Oriental Mindoro, Philippines', 'Seeds', '2024-12-24', 'Completed', 'sarahelmenzo13@gmail.com', '2024-12-24 11:00:24'),
(4, 2, 'sd-sf-sg-fg-s2', 'Typhoon', 'GROUP', '2024-12-21', 'asfsdfsdfsd', 'asdasd', 'asdasdasd', 'sdasd', 'asdasdas', 3, 2, 'MALE', 'NO', NULL, 'YES', 'YES', 'YES', 'WHEAT', 3, 3, 2, NULL, NULL, NULL, NULL, NULL, 'dasdas', 'wqewqe', 'adas', 'Jr.', 'wqewqe adas dasdas Jr.', '031 Tawagan Rd, Calapan, Oriental Mindoro, Philippines', 'Seeds', '2024-12-27', 'Completed', 'sarahelmenzo13@gmail.com', '2024-12-26 11:03:20'),
(5, 6, '32-13-21-27-8d-fs', 'Typhoon', 'INDIVIDUAL', '2024-12-28', 'MIMAROPA', 'ORIENTAL MINDORO', 'CALAPAN', 'MASIPIT', 'WALA', 3, 2, 'MALE', 'YES', 'Mangyan', 'NO', 'NO', 'NO', 'CORN', 7, 9, 8, NULL, NULL, 32, 3, NULL, 'Bernales', 'Carlos', 'Laurel', 'Jr.', 'Carlos Laurel Bernales Jr.', '203bde brg pag asa, Bansud, Oriental Mindoro, Philippines', NULL, NULL, 'Pending', 'bernalescarlos480@gmail.com', '2024-12-28 09:39:04');

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
  `farm_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `livestock_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `forms_farm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `user_id`, `rsbsa`, `fullname`, `commodity`, `farm_type`, `livestock_type`, `forms_farm`, `location`) VALUES
(1, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'CROP', 'WHEAT', NULL, NULL, '031 Tawagan Rd, Calapan, Oriental Mindoro, Philippines'),
(2, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'CROP', 'RICE', NULL, NULL, '95J9+2C Calapan, Oriental Mindoro, Philippines'),
(3, 2, 'sd-sf-sg-fg-s2', 'wqewqe adas dasdas Jr.', 'LIVESTOCK', NULL, 'PIG', 'BACKYARD', '85XV+68 Calapan, Oriental Mindoro, Philippines'),
(5, 6, '32-13-21-27-8d-fs', 'Carlos Laurel Bernales Jr.', 'CROP', 'CORN', NULL, NULL, '203bde brg pag asa, Bansud, Oriental Mindoro, Philippines'),
(6, 6, '32-13-21-27-8d-fs', 'Carlos Laurel Bernales Jr.', 'LIVESTOCK', NULL, 'GOAT', 'BACKYARD', 'RC6M+47 Bansud, Oriental Mindoro, Philippines');

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
(1, 1, 'farm_676698e30232a5.00722337.jfif'),
(2, 1, 'farm_676698e3039399.97535099.jfif'),
(3, 2, 'farm_67669a58d316d2.67095029.jfif'),
(4, 2, 'farm_67669a58d5d909.39552930.jfif'),
(5, 2, 'farm_67669a58d673d8.30410061.jfif'),
(6, 3, 'farm_67669afb6d4199.10961043.jfif'),
(7, 3, 'farm_67669afb6e3276.55918978.jfif'),
(8, 3, 'farm_67669afb6f0120.25075207.jfif'),
(11, 5, 'farm_676f555f570be4.00784003.jpg'),
(12, 5, 'farm_676f555f5d5094.60521889.jpg'),
(13, 6, 'farm_676f55c86a94a7.33995399.jpg'),
(14, 6, 'farm_676f55c86b83d8.96279908.jpg'),
(15, 6, 'farm_676f55c86c8585.30123200.jpg');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assistance`
--
ALTER TABLE `assistance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calamity_images`
--
ALTER TABLE `calamity_images`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcement_user`
--
ALTER TABLE `announcement_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `assistance`
--
ALTER TABLE `assistance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `calamity_images`
--
ALTER TABLE `calamity_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `calamity_report`
--
ALTER TABLE `calamity_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `farms_images`
--
ALTER TABLE `farms_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
