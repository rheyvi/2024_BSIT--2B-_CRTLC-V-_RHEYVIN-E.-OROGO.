-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 07:59 AM
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
-- Database: `househunt`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `houseId` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `type` enum('flat','shop','house','') NOT NULL,
  `BHK` enum('1','2','3','4','5') NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`houseId`, `item_name`, `location`, `price`, `type`, `BHK`, `image`, `date_input`) VALUES
(1, 'BahayniKuya', 'Manila', 9999999.99, 'house', '3', 'pbbhouse.jpg', '2024-05-30 07:03:56'),
(2, 'BahayniPeterParker', 'NewYork Manila', 800000.00, 'house', '5', 'peter-parker-house.jpg', '2024-05-30 07:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `reportId` int(11) NOT NULL,
  `StartMonthYear` date NOT NULL,
  `EndMonthYear` date NOT NULL,
  `TotalClients` int(255) NOT NULL,
  `TotalSales` double(15,3) NOT NULL,
  `dateinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `houseId` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `Contact_Number` bigint(255) NOT NULL,
  `Bank` enum('BDO','Landbank','Chinabank','') NOT NULL,
  `Payment_Method` enum('Debit','Credit','','') NOT NULL,
  `Account_Number` bigint(255) NOT NULL,
  `Deposit_Amount` decimal(14,2) NOT NULL,
  `Reference_Number` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Note` varchar(255) NOT NULL,
  `Status` enum('Processing','Done','','') NOT NULL,
  `Date_Input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `user_id`, `houseId`, `Fullname`, `Email_Address`, `Contact_Number`, `Bank`, `Payment_Method`, `Account_Number`, `Deposit_Amount`, `Reference_Number`, `Note`, `Status`, `Date_Input`) VALUES
(1, 1, 1, 'Joshua Gumbao', 'joshua@gmail.com', 9104936881, 'Chinabank', 'Debit', 1234567899, 49999.00, '14X0H5I4A', 'HALF PAYMENT', '', '2024-05-30 15:07:42'),
(2, 1, 2, 'Jake Mariscotes', 'jake@gmail.com', 9813312112, 'Landbank', 'Debit', 123454321, 400000.00, '22V0B3V3E', 'Call me later', '', '2024-05-30 15:11:28'),
(3, 1, 2, 'Christian Factor', 'christianmarlon@gmail.com', 9813359149, 'BDO', 'Credit', 1234567882, 400000.00, '34T1K9F3N', 'mommywantsyou', '', '2024-05-30 15:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_type` enum('Customer','Admin') NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `Sex` enum('Male','Female','','') NOT NULL,
  `Address` text NOT NULL,
  `Phone_Number` bigint(15) NOT NULL,
  `Date_Login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `Fullname`, `Email_Address`, `Username`, `Password`, `Birthday`, `Sex`, `Address`, `Phone_Number`, `Date_Login`) VALUES
(1, 'Admin', 'Hon Ezekiel Bognalbal', 'honezekielbognalbal18@gmail.com', 'admin12345', '12345', '2004-05-18', 'Male', 'Tabaco City Quinastillojan', 9509296565, '2024-05-14 23:59:52'),
(2, 'Customer', 'sample1', 'sample1@gmail.com', 'sample1', '12345', '2010-01-01', 'Male', 'sample1sample1', 9813359149, '2024-05-28 17:44:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `userId` (`user_id`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`houseId`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`reportId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`),
  ADD KEY `houseId` (`houseId`),
  ADD KEY `payment_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `houseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`houseId`) REFERENCES `houses` (`houseId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
