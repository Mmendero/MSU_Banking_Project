-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 08:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group6_banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` char(6) NOT NULL,
  `cUsername` varchar(50) DEFAULT NULL,
  `cPassword` varchar(255) NOT NULL,
  `cEmail` varchar(50) DEFAULT NULL,
  `cFname` varchar(50) NOT NULL,
  `cLname` varchar(50) NOT NULL,
  `cAddress` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `cUsername`, `cPassword`, `cEmail`, `cFname`, `cLname`, `cAddress`) VALUES
('955337', 'sarmientob1', '$2y$10$JKFlxUhFJ2LwxQ8a3QZ96O7dFRUSguCsKEvYP2eXY/ir/1JEiGbIi', 'sarmientob1@montclair.edu', 'Brianna', 'Sarmiento', '1 Normal Ave Montclair, NJ 07345'),
('957255', 'mmendero', '$2y$10$NWFx40skPQ0RE4dUPvAzRuO7tzRlyX/X.Ttq/QbWHL.pAKow3e1r2', '12@fsad.com', 'edw1d', '223432', '43242 432243, NJ 07329');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `cUsername` (`cUsername`),
  ADD UNIQUE KEY `cEmail` (`cEmail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO `G6_admin`@`localhost` IDENTIFIED BY PASSWORD '*C285157A2629417E8D3ABE8323336295368ECB63';

GRANT ALL PRIVILEGES ON `group6_banking`.* TO `G6_admin`@`localhost`;
