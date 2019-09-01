-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2019 at 11:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `power_consumption`
--

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `userid` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `transformerid` bigint(20) NOT NULL,
  `phoneno` bigint(11) NOT NULL,
  `adharno` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `reading` float NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`userid`, `name`, `transformerid`, `phoneno`, `adharno`, `address`, `reading`, `amount`) VALUES
(1, 'barath ', 148, 8056229223, 123423423256, 'india', 220, 5214),
(2, 'abinaya', 148, 9840141817, 308174476503, 'india', 200, 5000),
(3, 'akshaya', 148, 9865471232, 410568024444, 'india', 210, 5097),
(4, 'aishu', 149, 9658412325, 658945725455, 'india', 150, 4000),
(5, 'revathy', 149, 2147483647, 658945548545, 'india', 180, 4567),
(6, 'surya', 150, 9658744567, 254875548545, 'india', 125, 3675),
(7, 'pramoj', 150, 9677872770, 584698745632, 'india', 450, 9000),
(8, 'shriram', 151, 7958465215, 113216106122, 'india', 230, 5545),
(9, 'ganesh', 151, 9586742541, 312358465896, 'india', 110, 2563),
(10, 'priya', 151, 9804141895, 312350283936, 'india', 156, 4258);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `userid` bigint(20) NOT NULL,
  `transformerid` bigint(20) DEFAULT NULL,
  `voltage` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`userid`, `transformerid`, `voltage`, `timestamp`) VALUES
(1, 148, 9.66, '2019-08-31 10:36:09'),
(2, 148, 5.46, '2019-08-31 10:56:31'),
(1, 148, 9.8, '2019-08-31 19:35:08'),
(1, 148, 9.2, '2019-08-31 19:35:08'),
(1, 148, 9.14, '2019-08-31 19:35:08'),
(2, 148, 0.15, '2019-08-31 19:35:08'),
(2, 148, 0.48, '2019-08-31 19:35:08'),
(2, 148, 0.59, '2019-08-31 19:35:08'),
(1, 148, 9.8, '2019-08-31 19:38:02'),
(1, 148, 9.8, '2019-08-31 19:38:03'),
(1, 148, 9.8, '2019-08-31 19:38:03'),
(1, 148, 9.8, '2019-08-31 19:38:03'),
(2, 148, 0.78, '2019-08-31 19:38:03'),
(2, 148, 0.98, '2019-08-31 19:38:03'),
(2, 148, 0.97, '2019-08-31 19:38:03'),
(2, 148, 1.87, '2019-08-31 19:38:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `userid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
