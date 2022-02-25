-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2022 at 03:24 PM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarmieb1_OnlineBankingSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `customerID` char(6) NOT NULL,
  `cUsername` varchar(50) DEFAULT NULL,
  `cPassword` varchar(255) NOT NULL,
  `cEmail` varchar(50) DEFAULT NULL,
  `cFname` varchar(50) NOT NULL,
  `cLname` varchar(50) NOT NULL,
  `cAddress` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`customerID`, `cUsername`, `cPassword`, `cEmail`, `cFname`, `cLname`, `cAddress`) VALUES
('955337', 'sarmientob1', '$2y$10$JKFlxUhFJ2LwxQ8a3QZ96O7dFRUSguCsKEvYP2eXY/ir/1JEiGbIi', 'sarmientob1@montclair.edu', 'Brianna', 'Sarmiento', '1 Normal Ave Montclair, NJ 07345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `cUsername` (`cUsername`),
  ADD UNIQUE KEY `cEmail` (`cEmail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
