-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2025 at 03:46 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u376016718_bansudagtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `email_token` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `rsbsa` varchar(255) DEFAULT NULL,
  `fourps` varchar(255) DEFAULT NULL,
  `indigenous` varchar(255) DEFAULT NULL,
  `tribe_name` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `sex` enum('MALE','FEMALE') DEFAULT NULL,
  `arb` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `tot_male` int(11) DEFAULT NULL,
  `tot_female` int(11) DEFAULT NULL,
  `farmer_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'not_verified',
  `active_not` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `verification_token`, `email_token`, `firstname`, `middlename`, `lastname`, `suffix`, `fullname`, `role`, `contact`, `email`, `password`, `birthdate`, `rsbsa`, `fourps`, `indigenous`, `tribe_name`, `pwd`, `sex`, `arb`, `region`, `province`, `municipality`, `barangay`, `org_name`, `tot_male`, `tot_female`, `farmer_type`, `status`, `active_not`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, 'admin@admin.com', '$2y$12$tFNqf53J8Fk/EanDbIlmyOuSj4ib.Ru6mYTk.LZ4R8MvaOFtgV.gO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'verified', 'Active'),
(2, NULL, NULL, 'SAMUEL', 'ABELLA', 'DE CHAVEZ', NULL, 'SAMUEL ABELLA DE CHAVEZ ', 'user', '09923224324', 'bonzbar21@gmail.com', '$2y$12$D2Kz7EB/X.Y5soedUfn/eOLSBPht.2ZIZFrhN8acrymICiYBuCYQW', '1994-09-06', '13-16-46-131-313131', 'YES', 'NO', NULL, 'NO', 'MALE', 'NO', 'MIMAROPA', 'ORIENTAL MINDORO', 'BANSUD', 'POBLACION', NULL, NULL, NULL, 'INDIVIDUAL', 'verified', 'Active'),
(6, NULL, NULL, 'JAYFERSON', 'I.', 'RELOX', NULL, 'JAYFERSON I. RELOX ', 'user', NULL, 'jayferson.relox@gmail.com', NULL, NULL, '51-11-63-131-894331', NULL, 'NO', NULL, NULL, NULL, NULL, 'MINDORO ORIENTAL', NULL, NULL, NULL, NULL, NULL, NULL, 'INDIVIDUAL', 'verified', 'Active'),
(8, '9kEtXgVm5Xx00W4n7sNr2YneJlawFC53lDHRUjoyy0i13ee3K4ixa3qBMP6y', NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, 'jepoyrelox@gmail.com', '$2y$12$vCuDDyLVJMVDywBln0jCHORmKco9QZ15MTwmRak8cnHedd8HgT8ne', NULL, '13-14-63-113-131344', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'verified', 'Active'),
(12, 'JCNikDft5FMZ0H5cQ9HOhVEB3K1P6xTiCUiVQxwri4sumQyLleM29qarkJPh', 'a0621628d0cc2f7762ec2a1700c92ddc1e1042c44eae4fbb1076ddbb4ed335aba55ecb2a52c9ae847ed940ec2a53308def06', NULL, NULL, NULL, NULL, '   ', 'user', NULL, 'sarahelmenzo13@gmail.com', '$2y$12$gFA8BCofh1JBtNYS34Wn3es8Rfe7jFoFLYlJ2RF2pf1KStqdv7cTG', '2001-11-13', '64-64-61-131-313494', 'YES', 'NO', NULL, 'NO', 'MALE', 'NO', 'IV-B', 'ORIENTAL MINDORO', 'CALAPAN', 'MASIPIT', NULL, NULL, NULL, 'INDIVIDUAL', 'verified', 'Active'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-000001', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Inactive'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-044-000002', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active'),
(16, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-000003', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active'),
(17, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-000005', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active'),
(18, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-00004', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active'),
(19, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-000006', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active'),
(20, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-000007', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active'),
(21, NULL, NULL, NULL, NULL, NULL, NULL, '   ', 'user', NULL, NULL, NULL, NULL, '01-02-03-040-000007', NULL, 'YES', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'not_verified', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `title`, `content`) VALUES
(1, 'TEST', 'TEST'),
(2, 'TEST', 'TEST');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_user`
--

CREATE TABLE `announcement_user` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('viewed','unread') NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcement_user`
--

INSERT INTO `announcement_user` (`id`, `title`, `content`, `user_id`, `status`) VALUES
(1, 'TEST', 'TEST', 2, 'viewed'),
(2, 'TEST', 'TEST', 6, 'unread'),
(3, 'TEST', 'TEST', 8, 'unread'),
(4, 'TEST', 'TEST', 12, 'unread'),
(5, 'TEST', 'TEST', 13, 'unread'),
(6, 'TEST', 'TEST', 2, 'viewed'),
(7, 'TEST', 'TEST', 6, 'unread'),
(8, 'TEST', 'TEST', 8, 'unread'),
(9, 'TEST', 'TEST', 12, 'unread'),
(10, 'TEST', 'TEST', 13, 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `assistance`
--

CREATE TABLE `assistance` (
  `id` int(11) NOT NULL,
  `assistance_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistance`
--

INSERT INTO `assistance` (`id`, `assistance_type`) VALUES
(3, 'CASH ASSISTANCE'),
(4, 'SEEDS');

-- --------------------------------------------------------

--
-- Table structure for table `calamity_images`
--

CREATE TABLE `calamity_images` (
  `id` int(11) NOT NULL,
  `cal_fk_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calamity_images`
--

INSERT INTO `calamity_images` (`id`, `cal_fk_id`, `image`) VALUES
(4, 2, 'calamity_6778e84c19c66.png'),
(5, 3, 'calamity_6778e84cab570.png'),
(6, 4, 'calamity_677f314e5efca.jpg'),
(7, 5, 'calamity_6780ca12e7f48.jpg'),
(8, 5, 'calamity_6780ca12e8328.jpg'),
(9, 5, 'calamity_6780ca12e84f4.jpg'),
(10, 6, 'calamity_6783324309023.jpg'),
(11, 7, 'calamity_67833266afca8.jpg'),
(12, 7, 'calamity_67833266aff95.jpg'),
(13, 8, 'calamity_67833e3595737.jpg'),
(14, 8, 'calamity_67833e35959c1.jpg'),
(15, 9, 'calamity_67833fb4b86bc.jpg'),
(16, 9, 'calamity_67833fb4b8922.jpg'),
(17, 10, 'calamity_6783406f38f1b.jpg'),
(18, 10, 'calamity_6783406f391de.jpg'),
(19, 10, 'calamity_6783406f393b1.jpg'),
(20, 11, 'calamity_678340ebd146a.jpg'),
(21, 11, 'calamity_678340ebd16d5.jpg'),
(22, 11, 'calamity_678340ebd185c.jpg'),
(23, 12, 'calamity_6784eda3a3fe4.jpg'),
(24, 12, 'calamity_6784eda3a424b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `calamity_report`
--

CREATE TABLE `calamity_report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rsbsa` varchar(255) DEFAULT NULL,
  `calamity_type` varchar(255) DEFAULT NULL,
  `farmer_type` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `tot_male` int(11) DEFAULT NULL,
  `tot_female` int(11) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `indigenous` varchar(255) DEFAULT NULL,
  `tribe_name` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `arb` varchar(255) DEFAULT NULL,
  `fourps` varchar(255) DEFAULT NULL,
  `crop_type` varchar(255) DEFAULT NULL,
  `partially_damage` int(11) DEFAULT NULL,
  `totally_damage` int(11) DEFAULT NULL,
  `total_area` int(11) DEFAULT NULL,
  `livestock_type` varchar(255) DEFAULT NULL,
  `animal_type` varchar(255) DEFAULT NULL,
  `age_class` int(11) DEFAULT NULL,
  `no_heads` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `assistance_type` varchar(255) DEFAULT NULL,
  `other_assistances` varchar(255) DEFAULT NULL,
  `date_provided` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `email` varchar(255) NOT NULL,
  `date_reported` datetime DEFAULT current_timestamp(),
  `notification_status` enum('unread','viewed') NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calamity_report`
--

INSERT INTO `calamity_report` (`id`, `user_id`, `rsbsa`, `calamity_type`, `farmer_type`, `birthdate`, `region`, `province`, `municipality`, `barangay`, `org_name`, `tot_male`, `tot_female`, `sex`, `indigenous`, `tribe_name`, `pwd`, `arb`, `fourps`, `crop_type`, `partially_damage`, `totally_damage`, `total_area`, `livestock_type`, `animal_type`, `age_class`, `no_heads`, `remarks`, `lastname`, `firstname`, `middlename`, `suffix`, `fullname`, `location`, `assistance_type`, `other_assistances`, `date_provided`, `status`, `email`, `date_reported`, `notification_status`) VALUES
(2, 8, '12-31-14-44-14-13', 'TYPHOON', NULL, NULL, NULL, NULL, 'BANSUD', 'POBLACION', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RICE', NULL, NULL, NULL, NULL, NULL, 45, NULL, 'NONE', NULL, NULL, NULL, NULL, '   ', '833 Strong Republic Nautical Hwy, Bansud, Oriental Mindoro, Philippines', 'CASH ASSISTANCE', NULL, '2025-01-11', 'Ongoing', 'jepoyrelox@gmail.com', '2024-12-31 07:50:36', 'viewed'),
(3, 8, '12-31-14-44-14-13', 'TYPHOON', NULL, NULL, NULL, NULL, 'BANSUD', 'POBLACION', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'RICE', NULL, NULL, NULL, NULL, NULL, 45, NULL, 'NONE', NULL, NULL, NULL, NULL, '   ', '833 Strong Republic Nautical Hwy, Bansud, Oriental Mindoro, Philippines', 'CASH ASSISTANCE', 'NON', '2025-01-11', 'Pending', 'jepoyrelox@gmail.com', '2025-01-04 07:50:36', 'viewed'),
(4, 2, '12-31-14-44-14-12', 'FLOOD', 'INDIVIDUAL', '1994-09-06', 'MIMAROPA', 'ORIENTAL MINDORO', 'BANSUD', 'MALO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'RICE', 8438408, 93041122, 32133, 'COMMERCIAL', 'PIG', 32, 11, 'NONE', 'DE CHAVEZ', 'SAMUEL', 'ABELLA', NULL, 'SAMUEL ABELLA DE CHAVEZ ', 'VF3C+W5 Bansud, Oriental Mindoro, Philippines', 'CASH ASSISTANCE', NULL, '2025-01-11', 'Ongoing', 'bonzbar21@gmail.com', '2025-01-09 02:15:42', 'viewed'),
(5, 12, '64-64-61-131-313494', 'DROUGHT', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'SALCEDO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'CORN', 7, 9, 8, NULL, NULL, NULL, NULL, 'NONE', NULL, NULL, NULL, NULL, '   ', '95H3+JF Calapan, Oriental Mindoro, Philippines', 'SEEDS', NULL, '2025-01-10', 'Pending', 'sarahelmenzo13@gmail.com', '2025-01-14 07:19:46', 'viewed'),
(6, 12, '64-64-61-131-313494', 'DROUGHT', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'SALCEDO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'CORN', 7, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '   ', '95H3+JF Calapan, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Shortlisted', 'sarahelmenzo13@gmail.com', '2025-01-10 03:08:51', 'viewed'),
(7, 12, '64-64-61-131-313494', 'DROUGHT', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'SALCEDO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'CORN', 7, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '   ', '95H3+JF Calapan, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Pending', 'sarahelmenzo13@gmail.com', '2025-01-12 03:09:26', 'viewed'),
(8, 12, '64-64-61-131-313494', 'FLOOD', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'BATO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', NULL, NULL, NULL, NULL, 'BACKYARD', 'GOAT', 32, 3, NULL, NULL, NULL, NULL, NULL, '   ', 'VC64+2J Bansud, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Pending', 'sarahelmenzo13@gmail.com', '2025-01-12 03:59:49', 'viewed'),
(9, 12, '64-64-61-131-313494', 'FLOOD', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'BATO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'CORN', 7, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '   ', '95H3+JF Calapan, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Pending', 'sarahelmenzo13@gmail.com', '2025-01-12 04:06:12', 'viewed'),
(10, 12, '64-64-61-131-313494', 'FLOOD', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'BATO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', NULL, NULL, NULL, NULL, 'BACKYARD', 'GOAT', 32, 67, NULL, NULL, NULL, NULL, NULL, '   ', 'VC64+2J Bansud, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Pending', 'sarahelmenzo13@gmail.com', '2024-02-13 04:09:19', 'viewed'),
(11, 12, '64-64-61-131-313494', 'FLOOD', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'MALO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'CORN', 7, 9, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '   ', '95H3+JF Calapan, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Shortlisted', 'sarahelmenzo13@gmail.com', '2024-01-24 04:11:23', 'viewed'),
(12, 12, '64-64-61-131-313494', 'FLOOD', 'INDIVIDUAL', '2001-11-13', 'IV-B', 'ORIENTAL MINDORO', 'BANSUD', 'MALO', NULL, NULL, NULL, 'MALE', 'NO', NULL, 'NO', 'NO', 'YES', 'CORN', 2, 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '   ', '95H3+JF Calapan, Oriental Mindoro, Philippines', NULL, NULL, NULL, 'Pending', 'sarahelmenzo13@gmail.com', '2024-12-24 10:40:35', 'unread');

-- --------------------------------------------------------

--
-- Table structure for table `farms`
--

CREATE TABLE `farms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rsbsa` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `commodity` varchar(255) NOT NULL,
  `farm_type` varchar(255) DEFAULT NULL,
  `livestock_type` varchar(255) DEFAULT NULL,
  `forms_farm` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `farm_area` varchar(255) DEFAULT NULL,
  `area_planted` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `fourps` varchar(255) DEFAULT NULL,
  `indigenous` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farms`
--

INSERT INTO `farms` (`id`, `user_id`, `rsbsa`, `fullname`, `commodity`, `farm_type`, `livestock_type`, `forms_farm`, `location`, `email`, `region`, `municipality`, `province`, `barangay`, `farm_area`, `area_planted`, `firstname`, `middlename`, `lastname`, `suffix`, `sex`, `contact`, `fourps`, `indigenous`, `pwd`, `birthdate`) VALUES
(4, 8, '12-31-14-44-14-13', '   ', 'CROP', 'RICE', NULL, NULL, '833 Strong Republic Nautical Hwy, Bansud, Oriental Mindoro, Philippines', 'jepoyrelox@gmail.com', 'IV', 'BANSUD', 'ORIENTAL MINDORO', 'POBLACION', 'AF', 'dsa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 9, '13-10-98-69-67', '   ', 'CROP', 'RICE', NULL, NULL, '95GH+Q8P, OMPH Road, Calapan, Oriental Mindoro, Philippines', 'sarahelmenzo13@gmail.com', 'MIMAROPA', 'CALAPAN', 'ORIENTAL MINDORO', 'MASIPIT', '32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 2, '12-31-14-44-14-12', 'SAMUEL ABELLA DE CHAVEZ ', 'CROP', 'RICE', 'PIG', 'COMMERCIAL', 'VF3C+W5 Bansud, Oriental Mindoro, Philippines', 'bonzbar21@gmail.com', 'MIMAROPA', 'BANSUD', 'ORIENTAL MINDORO', 'POBLACION', '1000SQM', 'MALAYA', 'SAMUEL', 'ABELLA', 'DE CHAVEZ', NULL, 'MALE', '09923224324', 'YES', 'NO', 'NO', '1994-09-06'),
(8, 12, '64-64-61-131-313494', '   ', 'CROP', 'CORN', NULL, NULL, '95H3+JF Calapan, Oriental Mindoro, Philippines', 'sarahelmenzo13@gmail.com', 'IV-B', 'CALAPAN', 'ORIENTAL MINDORO', 'SALCEDO', '23', NULL, NULL, NULL, NULL, NULL, 'MALE', NULL, 'YES', 'NO', 'NO', '2001-11-13'),
(9, 12, '64-64-61-131-313494', '   ', 'LIVESTOCK', NULL, 'GOAT', 'BACKYARD', 'VC64+2J Bansud, Oriental Mindoro, Philippines', 'sarahelmenzo13@gmail.com', 'IV-B', 'BANSUD', 'ORIENTAL MINDORO', 'MALO', '23', NULL, NULL, NULL, NULL, NULL, 'MALE', NULL, 'YES', 'NO', 'NO', '2001-11-13'),
(10, 12, '64-64-61-131-313494', '   ', 'CROP', 'RICE', NULL, NULL, 'VF55+QWP, Bansud, Oriental Mindoro, Philippines', 'sarahelmenzo13@gmail.com', 'IV-B', 'BANSUD', 'ORIENTAL MINDORO', 'BATO', '123', '333', NULL, NULL, NULL, NULL, 'MALE', NULL, 'YES', 'NO', 'NO', '2001-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `farms_images`
--

CREATE TABLE `farms_images` (
  `id` int(11) NOT NULL,
  `farms_fk_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farms_images`
--

INSERT INTO `farms_images` (`id`, `farms_fk_id`, `image`) VALUES
(7, 4, 'farm_6778e7d8e3c296.04603941.png'),
(8, 5, 'farm_6779f94c5786c7.46072918.jpg'),
(9, 5, 'farm_6779f94c57bb57.49718553.jpg'),
(10, 5, 'farm_6779f94c57d528.63006175.jpg'),
(11, 6, 'farm_677cd62542e115.98296627.jpg'),
(14, 8, 'farm_6780c9f6738469.71395709.jpg'),
(15, 8, 'farm_6780c9f673af95.49860388.jpg'),
(16, 9, 'farm_678270711c63a5.48592579.jpg'),
(17, 9, 'farm_678270711c9d15.55898930.jpg'),
(18, 10, 'farm_6784f059848dc5.03389259.jpg'),
(19, 10, 'farm_6784f05984c061.63701366.jpg'),
(20, 10, 'farm_6784f05984dd85.33163426.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `weather_alert`
--

CREATE TABLE `weather_alert` (
  `id` int(11) NOT NULL,
  `farm_fk_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `commodity` varchar(255) DEFAULT NULL,
  `farm_type` varchar(255) DEFAULT NULL,
  `livestock_type` varchar(255) DEFAULT NULL,
  `temperature` varchar(255) DEFAULT NULL,
  `date_checked` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weather_alert`
--

INSERT INTO `weather_alert` (`id`, `farm_fk_id`, `user_id`, `email`, `commodity`, `farm_type`, `livestock_type`, `temperature`, `date_checked`) VALUES
(1, 1, 5, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.98', '2025-01-04'),
(2, 4, 8, 'jepoyrelox@gmail.com', 'CROP', 'RICE', NULL, '24.37', '2025-01-05'),
(3, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '23.41', '2025-01-05'),
(4, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.97', '2025-01-06'),
(5, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.41', '2025-01-07'),
(6, 4, 8, 'jepoyrelox@gmail.com', 'CROP', 'RICE', NULL, '24.39', '2025-01-10'),
(7, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '24.74', '2025-01-10'),
(8, 7, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'CORN', NULL, '24.65', '2025-01-10'),
(9, 6, 2, 'bonzbar21@gmail.com', 'CROP', 'RICE', 'PIG', '24.39', '2025-01-10'),
(10, 8, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'CORN', NULL, '24.95', '2025-01-11'),
(11, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '24.95', '2025-01-11'),
(12, 10, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.39', '2025-01-18'),
(13, 6, 2, 'bonzbar21@gmail.com', 'CROP', 'RICE', 'PIG', '28.39', '2025-01-18'),
(14, 9, 12, 'sarahelmenzo13@gmail.com', 'LIVESTOCK', NULL, 'GOAT', '28.18', '2025-01-18'),
(15, 4, 8, 'jepoyrelox@gmail.com', 'CROP', 'RICE', NULL, '28.39', '2025-01-18'),
(16, 9, 12, 'sarahelmenzo13@gmail.com', 'LIVESTOCK', NULL, 'GOAT', '28.48', '2025-01-19'),
(17, 4, 8, 'jepoyrelox@gmail.com', 'CROP', 'RICE', NULL, '28.41', '2025-01-19'),
(18, 6, 2, 'bonzbar21@gmail.com', 'CROP', 'RICE', 'PIG', '28.41', '2025-01-19'),
(19, 10, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.41', '2025-01-19'),
(20, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.04', '2025-01-31'),
(21, 8, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'CORN', NULL, '28.14', '2025-01-31'),
(22, 8, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'CORN', NULL, '28.61', '2025-02-01'),
(23, 5, 9, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.39', '2025-02-01'),
(24, 6, 2, 'bonzbar21@gmail.com', 'CROP', 'RICE', 'PIG', '28.61', '2025-02-13'),
(25, 9, 12, 'sarahelmenzo13@gmail.com', 'LIVESTOCK', NULL, 'GOAT', '28.18', '2025-02-13'),
(26, 10, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'RICE', NULL, '28.61', '2025-02-13'),
(27, 4, 8, 'jepoyrelox@gmail.com', 'CROP', 'RICE', NULL, '28.61', '2025-02-13'),
(28, 8, 12, 'sarahelmenzo13@gmail.com', 'CROP', 'CORN', NULL, '28.06', '2025-02-13');

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
-- Indexes for table `weather_alert`
--
ALTER TABLE `weather_alert`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcement_user`
--
ALTER TABLE `announcement_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assistance`
--
ALTER TABLE `assistance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `calamity_images`
--
ALTER TABLE `calamity_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `calamity_report`
--
ALTER TABLE `calamity_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `farms`
--
ALTER TABLE `farms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `farms_images`
--
ALTER TABLE `farms_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `weather_alert`
--
ALTER TABLE `weather_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
