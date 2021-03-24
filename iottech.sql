-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2021 at 06:24 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iottech`
--

-- --------------------------------------------------------

--
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `sales` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `expenses` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chart`
--

INSERT INTO `chart` (`id`, `year`, `sales`, `profit`, `expenses`) VALUES
(58, 1990, '100', '20', '80'),
(59, 1995, '100', '10', '20'),
(60, 1990, '4254', '42', '25'),
(61, 2002, '4254', '42', '25'),
(62, 2015, '9500', '20000', '75000'),
(63, 2016, '11000', '25000', '85000'),
(64, 2018, '5000', '10000', '40000'),
(65, 2019, '200000', '50000', '150000'),
(66, 2020, '500000', '100000', '400000');

-- --------------------------------------------------------

--
-- Table structure for table `sourtarg`
--

CREATE TABLE `sourtarg` (
  `id` int(11) NOT NULL,
  `source` double(11,4) NOT NULL,
  `target` double(11,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sourtarg`
--

INSERT INTO `sourtarg` (`id`, `source`, `target`) VALUES
(1, 0.0000, 0.000),
(2, 3.0303, 0.002),
(3, 6.0606, 0.004),
(4, 9.0909, 0.006),
(5, 12.1212, 0.008),
(6, 15.1515, 0.010),
(7, 18.1818, 0.012),
(8, 21.2121, 0.014),
(9, 24.2424, 0.016),
(10, 27.2727, 0.018),
(11, 30.3030, 0.020),
(12, 33.3333, 0.022),
(13, 36.3636, 0.024),
(14, 39.3939, 0.026);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sourtarg`
--
ALTER TABLE `sourtarg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `sourtarg`
--
ALTER TABLE `sourtarg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
