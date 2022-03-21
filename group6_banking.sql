-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 10:38 PM
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_number` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `balance` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_number`, `type`, `balance`) VALUES
(0, '', 0),
(0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `acc_request`
--

CREATE TABLE `acc_request` (
  `ID` int(50) NOT NULL,
  `acc_type` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_request`
--

INSERT INTO `acc_request` (`ID`, `acc_type`, `username`, `password`, `email`, `fname`, `lname`, `address`) VALUES
(597854, 'Savings', 'mendu', '$2y$10$m5Tql5NmjUmanKuVRtjDUuuC7BxyHF9O9RbAFXAO4esHVJCE0zqxW', 'dasd@dsadc.ocm', 'w', 'w', 'w w, w 0239012');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'mmendero', 'g6banking');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(50) NOT NULL,
  `acc_number` int(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `acc_number`, `username`, `password`, `email`, `fname`, `lname`, `address`) VALUES
(955337, 0, 'sarmientob1', '$2y$10$JKFlxUhFJ2LwxQ8a3QZ96O7dFRUSguCsKEvYP2eXY/ir/1JEiGbIi', 'sarmientob1@montclair.edu', 'Brianna', 'Sarmiento', '1 Normal Ave Montclair, NJ 07345'),
(957255, 0, 'mmendero', '$2y$10$NWFx40skPQ0RE4dUPvAzRuO7tzRlyX/X.Ttq/QbWHL.pAKow3e1r2', '12@fsad.com', 'edw1d', '223432', '43242 432243, NJ 07329'),
(649352, 0, 'mendeero', '$2y$10$1QmH6QQBn4OfRb9MXsU2T.3b.ddFx6T29.nR4qFKweoY5oJV56PIm', 'das@msad.com', 'k', 'k', 'k k, k k'),
(957256, 0, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(50) NOT NULL,
  `account_number` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `recipient_acc` int(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_request`
--
ALTER TABLE `acc_request`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cUsername` (`username`),
  ADD UNIQUE KEY `cEmail` (`email`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `cUsername` (`username`),
  ADD UNIQUE KEY `cEmail` (`email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_request`
--
ALTER TABLE `acc_request`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=957256;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=957257;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Permissions
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, INDEX, ALTER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON *.* TO `G6_admin`@`localhost` IDENTIFIED BY PASSWORD '*C285157A2629417E8D3ABE8323336295368ECB63';

GRANT ALL PRIVILEGES ON `group6_banking`.* TO `G6_admin`@`localhost`;