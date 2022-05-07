-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 07:58 AM
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
-- Database: `hw12index1`
--

-- --------------------------------------------------------

--
-- Table structure for table `BRANCHES`
--

CREATE TABLE `branches` (
  `Branch_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Date of Foundation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `BRANCHES`
--

INSERT INTO `BRANCHES` (`Branch_ID`, `Name`, `City`, `Date of Foundation`) VALUES
(1, 'semnan1', 'semnan', '2022-02-02'),
(2, 'semnan2', 'semnan', '2022-02-02'),
(3, 'esfahan1', 'esfahan', '2022-02-03'),
(4, 'esfahan2', 'esfahan', '2022-02-03'),
(5, 'tehran1', 'tehran', '2022-02-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BRANCHES`
--
ALTER TABLE `BRANCHES`
  ADD PRIMARY KEY (`Branch_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BRANCHES`
--
ALTER TABLE `BRANCHES`
  MODIFY `Branch_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
