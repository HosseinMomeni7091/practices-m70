-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2022 at 08:10 PM
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
-- Database: `chatroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `massage_id` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `massage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`massage_id`, `Username`, `massage`) VALUES
(1, 'admin', 'salam\r\n'),
(2, 'admin', 'C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/eUvElt.jpg'),
(3, 'admin', 'C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/Dmqruw.jpg'),
(4, 'hossein', 'salam az hossein'),
(5, 'hossein', 'C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/MzItnA.jpg'),
(6, 'admin', 'salam az admin2'),
(7, 'admin', 'C:\\xampp\\htdocs\\Train\\HW\\M70\\HW\\13\\Chat\\Back/../Storage/upload/tuVfaZ.png');

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `image_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `other_profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`image_id`, `username`, `other_profile_image`) VALUES
(1, 'admin', '\"C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/JpLtTH.jpg\"'),
(2, 'admin', '\"C:/xampp/htdocs/Train/CW/CW15.1400.12.27/Storage/upload/wfTGUN.jpg\"');

-- --------------------------------------------------------

--
-- Table structure for table `seenstatus`
--

CREATE TABLE `seenstatus` (
  `seen_id` int(11) NOT NULL,
  `massage_id` int(11) DEFAULT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seenstatus`
--

INSERT INTO `seenstatus` (`seen_id`, `massage_id`, `user_id`) VALUES
(1, 4, 'admin'),
(2, 4, 'hossein'),
(177, 5, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `main_profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `bio`, `password`, `email`, `permission`, `main_profile_image`) VALUES
('admin', 'admin', 'admin hastam', 'admin', 'admin@gmail.com', 'admin', '1'),
('hossein', 'hossein', 'im hossein', '5300005533', 'hossein.momeni1991@gmail.com', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`massage_id`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `seenstatus`
--
ALTER TABLE `seenstatus`
  ADD PRIMARY KEY (`seen_id`),
  ADD KEY `massage_id` (`massage_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `massage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seenstatus`
--
ALTER TABLE `seenstatus`
  MODIFY `seen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD CONSTRAINT `chatroom_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `users` (`username`);

--
-- Constraints for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD CONSTRAINT `profile_images_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Constraints for table `seenstatus`
--
ALTER TABLE `seenstatus`
  ADD CONSTRAINT `seenstatus_ibfk_1` FOREIGN KEY (`massage_id`) REFERENCES `chatroom` (`massage_id`),
  ADD CONSTRAINT `seenstatus_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
