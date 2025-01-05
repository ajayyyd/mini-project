-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 03:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blooddrive`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindata`
--

CREATE TABLE `admindata` (
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admindata`
--

INSERT INTO `admindata` (`uname`, `email`, `pwd`) VALUES
('abhijith', 'abhi@gmail.com', 'abhijith'),
('ajay', 'ajay@gmail.com', 'ajay');

-- --------------------------------------------------------

--
-- Table structure for table `donordata`
--

CREATE TABLE `donordata` (
  `uname` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `age` smallint(2) NOT NULL,
  `bldgrp` varchar(3) NOT NULL,
  `phno` bigint(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `availability` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donordata`
--

INSERT INTO `donordata` (`uname`, `name`, `age`, `bldgrp`, `phno`, `email`, `availability`, `district`, `city`) VALUES
(NULL, 'Ajay Dhanesh', 21, 'A+', 9447014616, 'ajaykammattathil@gmail.com', 'available', 'idukki', 'thodupuzha');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`uname`, `email`, `pwd`, `status`) VALUES
('abhijith', 'abhijith@gmail.com', 'abhi', ''),
('ajay', 'ajaykammattathil@gmail.com', 'ajay', 'login'),
('anto', 'anto@gmail', 'anto', ''),
('coolman', 'coolman@gmail.com', 'cool', ''),
('daren james', 'daren@gmail.com', 'daren', ''),
('marco', 'marco@gmail.com', 'marco', ''),
('rekha', 'reka@gmail.com', 'rekha', ''),
('tony', 'tony@gmail.com', 'tony', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`uname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `donordata`
--
ALTER TABLE `donordata`
  ADD UNIQUE KEY `phno` (`phno`),
  ADD KEY `fk_uname` (`uname`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`uname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donordata`
--
ALTER TABLE `donordata`
  ADD CONSTRAINT `fk_uname` FOREIGN KEY (`uname`) REFERENCES `userdata` (`uname`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
