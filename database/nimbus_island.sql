-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 12:03 AM
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

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `title`, `statement`, `type`, `reply`, `date`, `email`) VALUES
(1, 'error1', 'eygeohwb', 'high', 'completed\r', '2023-09-22', 'giya@gmail.com'),
(2, 'tttt', 'ddddddd', 'high', '0', '2023-09-22', 'giya@gmail.com'),
(3, 'bbbvvv', 'jbouhhvbhhbhbhbb', 'high', '0', '2023-09-22', 'vimalanil4442@gmail.com'),
(4, '12rfmllnknf', 'cddervve', 'medium', 'kggvzduhhv', '2023-09-22', 'vimalanil4442@gmail.com');

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
(45, 'doncarlo', 'carlo@gmail.com', 'Carlo2733', 'user', 'active'),
(44, 'john', 'john@gmail.com', 'John2733', 'user', 'active');

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
(45, 'carlo@gmail.com', 'Carlo', 'Ancelotti', 'doncarlo', 'Carlo2733', '0000-00-00', 'user', 'uploads/651c8e0a84b3f-photo_2023-10-04_03-25-10.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_email`);

--
-- Indexes for table `signin`
--
ALTER TABLE `signin`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signin`
--
ALTER TABLE `signin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
