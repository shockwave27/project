-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 12:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nimbus_island`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `statement` varchar(500) NOT NULL,
  `type` varchar(30) NOT NULL,
  `reply` varchar(50) NOT NULL,
  `date` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_details` text NOT NULL,
  `food_availability` int(11) NOT NULL,
  `food_price` int(11) NOT NULL,
  `food_photo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `food_name`, `food_details`, `food_availability`, `food_price`, `food_photo`) VALUES
(18, 'food1', 'no', 0, 123, 'uploads/26541668.jpg'),
(19, 'food34', 'no', 0, 123, 'uploads/26541668.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`, `user_status`) VALUES
(47, 'basil', 'basil@gmail.com', 'Basil2733', 'user', 'inactive'),
(45, 'doncarlo', 'carlo@gmail.com', 'Carlo2733', 'user', 'active'),
(44, 'john', 'john@gmail.com', 'John2733', 'user', 'active'),
(48, 'john_prasad', 'johnprasad2733@gmail.com', 'John2733', 'user', 'active'),
(46, 'pauly', 'paulson877@gmail.com', 'Paulson2255', 'user', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `ride_id` int(11) NOT NULL,
  `ride_name` varchar(50) NOT NULL,
  `ride_details` text NOT NULL,
  `ride_availability` int(11) NOT NULL,
  `ride_price` int(11) NOT NULL,
  `ride_photo` varchar(300) NOT NULL,
  `ride_type` varchar(100) NOT NULL,
  `basic` varchar(30) NOT NULL,
  `fastrack` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`ride_id`, `ride_name`, `ride_details`, `ride_availability`, `ride_price`, `ride_photo`, `ride_type`, `basic`, `fastrack`) VALUES
(35, 'Roller Coasters', 'Roller coasters are one of the most iconic and thrilling amusement park rides.\r\nThey feature a track with various elements like loops, corkscrews, and steep drops that create intense G-forces.\r\nRiders sit in cars or trains that are secured to the track, allowing for high-speed and often gravity-defying maneuvers.', 0, 12, 'uploads/pexels-brett-sayles-14388572.jpg', 'Thrill Rides', 'yes', 'yes'),
(36, 'Carouse', 'A classic flat ride featuring a circular platform with mounted animal figures, such as horses, that move up and down as the ride spins.\r\nOften found in traditional amusement parks and designed for riders of all ages, including young children.', 0, 10, 'uploads/pexels-deva-darshan-2695402.jpg', 'Flat Rides', 'yes', ''),
(39, 'ride 4', 'hahah nothing', 0, 13, 'uploads/pexels-inga-seliverstova-3243241.jpg', 'Thrill Rides', '', ''),
(40, 'giant wheel', 'no', 0, 23, 'uploads/pexels-isabelle-taylor-1376407.jpg', 'Flat Rides', '', ''),
(43, 'ride6', 'nn', 0, 34, 'uploads/pexels-jimmy-chan-2537536.jpg', 'adrenaline boost', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ridecategory`
--

CREATE TABLE `ridecategory` (
  `category_id` int(11) NOT NULL,
  `category_type` varchar(100) NOT NULL,
  `category_description` text NOT NULL,
  `category_priority` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ridecategory`
--

INSERT INTO `ridecategory` (`category_id`, `category_type`, `category_description`, `category_priority`) VALUES
(3, 'Thrill Rides', 'Thrill rides are a category of amusement park attractions designed to provide intense, exhilarating, and adrenaline-pumping experiences for riders. These rides often incorporate high speeds, steep drops, sudden changes in motion, and other elements that create a sense of excitement and fear', 'primary'),
(4, 'Flat Rides', 'Flat rides are a category of amusement park attractions that typically feature a flat, stationary base while the ride itself rotates or moves in various ways to provide entertainment and thrills. Unlike roller coasters or drop towers, flat rides do not typically involve traveling along a track or a predetermined path.', ''),
(5, 'adrenaline boost', 'naah', '');

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

CREATE TABLE `signin` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_dob` date NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `user_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`user_id`, `user_email`, `first_name`, `last_name`, `user_name`, `user_password`, `user_dob`, `user_type`, `user_pic`) VALUES
(44, 'john@gmail.com', 'John', 'Prasad', 'john', 'John2733', '0000-00-00', 'user', 'uploads/651c85182f1b8-photo_2023-08-27_00-30-02.jpg'),
(45, 'carlo@gmail.com', 'Carlo', 'Ancelotti', 'doncarlo', 'Carlo2733', '0000-00-00', 'user', '651fd444e30e5-jpg'),
(46, 'paulson877@gmail.com', 'Paulson', 'Eldho', 'pauly', 'Paulson2255', '0000-00-00', 'user', 'uploads/651cff913b0c3-photo_2023-10-04_03-25-10.jpg'),
(47, 'basil@gmail.com', 'Basil', 'Saju', 'basil', 'Basil2733', '0000-00-00', 'user', 'uploads/651d21e6d293f-photo_2023-10-04_03-25-10.jpg'),
(48, 'johnprasad2733@gmail.com', 'john', 'prasad', 'john_prasad', 'John2733', '0000-00-00', 'user', 'uploads/653a9e4923999-IMG_20230922_213359__1_-01-01 (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `t_uniq_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name_on_card` varchar(100) NOT NULL,
  `card_number` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `no_of_tickets` int(11) DEFAULT NULL,
  `rides` longtext NOT NULL,
  `pay_date` date NOT NULL,
  `book_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `t_uniq_id`, `user_id`, `user_name`, `full_name`, `email`, `name_on_card`, `card_number`, `price`, `no_of_tickets`, `rides`, `pay_date`, `book_date`) VALUES
(56, 2310282359470048, 48, 'john_prasad', 'john', 'johnprasad2733@gmail.com', '', 0, '25.00', 1, 'Roller Coasters, ride 4', '2023-10-28', '1970-01-01'),
(57, 2310290046000048, 48, 'john_prasad', 'john', 'johnprasad2733@gmail.com', 'john', 3056, '50.00', 2, 'Roller Coasters, ride 4, Carouse', '2023-10-29', '2023-10-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_email`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `ridecategory`
--
ALTER TABLE `ridecategory`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `ridecategory`
--
ALTER TABLE `ridecategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `signin`
--
ALTER TABLE `signin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
