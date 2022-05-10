-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 06:37 PM
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
-- Database: `menderm1_msu_banking_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_number` int(255) NOT NULL,
  `cust_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL DEFAULT '0.00',
  `pending` varchar(255) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_number`, `cust_id`, `type`, `balance`, `pending`) VALUES
(23051063, 587424080, 'Savings', 'pl15Rg==', 'pw=='),
(35258490, 1768939813, 'Savings', 'pw==', 'pw=='),
(65342558, 587424080, 'Checkings', 'pw==', 'pw==');

-- --------------------------------------------------------

--
-- Table structure for table `acc_request`
--

CREATE TABLE `acc_request` (
  `ID` int(50) NOT NULL,
  `acc_type` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `ssn` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `ssn` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `username`, `password`, `email`, `fname`, `lname`, `ssn`, `phone`, `address`) VALUES
(587424080, '+gAoHHPbJnM=', '$2y$10$DN7v7iTEF.oYy1dJd5VfquOPJE68dq8fYyJgDraJYtPvwAdNm.5sy', '+gw5Bn/bI3GCP6JBoxfTnZtC0CLUMvKw', '2gw5Bn/bIw==', '2ggjFnLMOw==', 'rlV6XyGLeSjUY/c=', 'pl9+XySKYTHRZv4c', 'pl9+UlDfJnqONKpA/VjUu9YTjn7IZw=='),
(1768939813, '/wghHnjJO26LNQ==', '$2y$10$2/4DCztMlmtReqDBIFnOTexLBSzU5YhvB96cTja1yTgxStX2NEEaq', '/xoiAHvaFHuKMK9I/xv8lw==', '3wghHng=', 'wAI/HnM=', 'pl9+XyOLeSrQaf8=', 'pl9+XyaMZzHWY/UQ', 'pl9+UmTKJnmCJeZpvhbnmZpC0DzWcdOXpVmS1ccS');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

CREATE TABLE `suggestion` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`ID`, `name`, `email`, `phone`, `message`) VALUES
(5, '0h8kEQ==', '8h8iEXz+M3GGOKoKshf+', 'pl9+RiKIZS7UZQ==', '1AwjUm7RITyKMK1B8Qz7n9ZQ0DqfcfGy6gKFh5ZVi7as');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(50) NOT NULL,
  `acc_number` int(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `recipient_acc` int(50) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID`, `acc_number`, `type`, `name`, `recipient_name`, `recipient_acc`, `amount`, `balance`, `date`) VALUES
(122, 23051063, 'Deposit', '7w==', '2gw5Bn/bIw==', 23051063, 'ol19', 'ol19', '2022-05-10 00:00:00'),
(123, 23051063, 'Withdraw', '7Q==', '2gw5Bn/bIw==', 23051063, 'ol19', 'pw==', '2022-05-10 12:34:37'),
(124, 23051063, 'Deposit', '7w==', '2gw5Bn/bIw==', 23051063, 'ol19', 'ol19', '2022-05-10 12:34:56'),
(125, 23051063, 'Deposit', '5A==', '2gw5Bn/bIw==', 23051063, 'oV19', 'plx9Qg==', '2022-05-10 12:35:02'),
(126, 23051063, 'Withdraw', '5A==', '2gw5Bn/bIw==', 23051063, 'ols=', 'pl15Rg==', '2022-05-10 12:35:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_number`);

--
-- Indexes for table `acc_request`
--
ALTER TABLE `acc_request`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99742150;

--
-- AUTO_INCREMENT for table `acc_request`
--
ALTER TABLE `acc_request`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=957297;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1886976573;

--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- User Priveledges --
GRANT ALL PRIVILEGES ON *.* TO `menderm1_G6_Admin`@`localhost` IDENTIFIED BY PASSWORD '*C285157A2629417E8D3ABE8323336295368ECB63' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON `group6_banking`.* TO `menderm1_G6_Admin`@`localhost`;
