-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 02:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazaar_khuji_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `username`) VALUES
(1, 'shakil@shahin.com', '123456', 'Shakil');

-- --------------------------------------------------------

--
-- Table structure for table `bazaar`
--

CREATE TABLE `bazaar` (
  `bazaarID` int(11) NOT NULL,
  `bazaarname` varchar(255) DEFAULT NULL,
  `bazaarlocation` varchar(255) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `bazaarIMG` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bazaar`
--

INSERT INTO `bazaar` (`bazaarID`, `bazaarname`, `bazaarlocation`, `EmployeeID`, `bazaarIMG`) VALUES
(13, 'asd', 'ff', 9, 0x75706c6f6164732f4661744261742e6a7067),
(14, 'vvv', 'af', 5, 0x75706c6f6164732f4661696c2e706e67),
(15, 'vvv', 'af', 10, 0x75706c6f6164732f5370696465724d616e2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `customer_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Age`, `Email`, `PhoneNumber`, `customer_password`) VALUES
(9, 'NotPlasma', 8, 'NotPlasma@notplasma.com', '12345655', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_text` text DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_text`, `customerID`) VALUES
(2, 'GoodApp', 9);

-- --------------------------------------------------------

--
-- Table structure for table `market_representative`
--

CREATE TABLE `market_representative` (
  `EmployeeID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `employee_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market_representative`
--

INSERT INTO `market_representative` (`EmployeeID`, `Name`, `Age`, `Email`, `PhoneNumber`, `Salary`, `employee_password`) VALUES
(5, 'Tahmid Hossain Jit', 112, 'tahmidhosssafaainjit@gmail.com', '01731943333', 22245454.00, '22'),
(9, 'Tahmid Hossain Jit', 234, 'tahmidffhos234234sffffainjit@gmail.comasdasd', '01731943333', 99999999.99, 'asdasdasd'),
(10, 'a', 2323, 'bbcd@acd', '034354545', 32343.00, 'ffa'),
(13, 'aff', 2323, 'bbfcffzaacvd@acd', '2323', 32343.00, '334');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productPicture` blob DEFAULT NULL,
  `productPrice` decimal(10,2) DEFAULT NULL,
  `bazaarID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productPicture`, `productPrice`, `bazaarID`) VALUES
(5, 'sad', 0x75706c6f6164732f36353730373432363664313161322e36393833343036342e706e67, 2323.00, 14),
(6, 'sad', 0x75706c6f6164732f36353730373432623734353836362e34383936303536332e6a7067, 2323.00, 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bazaar`
--
ALTER TABLE `bazaar`
  ADD PRIMARY KEY (`bazaarID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `market_representative`
--
ALTER TABLE `market_representative`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `bazaarID` (`bazaarID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bazaar`
--
ALTER TABLE `bazaar`
  MODIFY `bazaarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `market_representative`
--
ALTER TABLE `market_representative`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bazaar`
--
ALTER TABLE `bazaar`
  ADD CONSTRAINT `bazaar_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `market_representative` (`EmployeeID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`bazaarID`) REFERENCES `bazaar` (`bazaarID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
