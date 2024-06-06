-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 07:23 PM
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
  `dp_percentage` enum('0%','20%','30%','50%','') NOT NULL,
  `yearduration` enum('5','10','15','') NOT NULL,
  `monthly_payment` decimal(10,2) NOT NULL,
  `BHK` enum('1','2','3','4','5') NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('Available','Sold','Pending','') DEFAULT NULL,
  `date_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`houseId`, `item_name`, `location`, `price`, `type`, `dp_percentage`, `yearduration`, `monthly_payment`, `BHK`, `image`, `status`, `date_input`) VALUES
(1, 'BahayniKuya', 'Manila, Russia', 1000000.00, 'house', '20%', '10', 8485.24, '3', 'pbbhouse.jpg', 'Sold', '2024-06-02 15:49:01'),
(2, 'BahaysaUP', 'Manila, Sorsogon', 3000000.00, 'house', '0%', '5', 56613.70, '3', 'UP.jpg', 'Sold', '2024-06-02 17:01:22'),
(3, 'Bahaymalupet', 'Manila, Masbate', 2000000.00, 'house', '50%', '15', 7907.94, '5', '343379361_949323989538153_338218676191563127_n.jpg', NULL, '2024-06-02 17:10:12');

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
  `Status` enum('Processing','Done','Cancelled','') NOT NULL,
  `Date_Input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `user_id`, `houseId`, `Fullname`, `Email_Address`, `Contact_Number`, `Bank`, `Payment_Method`, `Account_Number`, `Deposit_Amount`, `Reference_Number`, `Note`, `Status`, `Date_Input`) VALUES
(1, 2, 1, 'sample1', 'sample1@gmail.com', 91278127, 'BDO', 'Debit', 1234567899, 0.00, '81D9W5V9P', 'YES', '', '2024-06-02 23:49:01'),
(2, 3, 2, 'sample2', 'sample2@gmail.com', 9509298483, 'Chinabank', 'Debit', 231232323, 0.00, '67K2O0R9J', 'Balloons', '', '2024-06-03 01:01:22');

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
(2, 'Customer', 'sample1', 'sample1@gmail.com', 'sample1', '12345', '2010-01-01', 'Male', 'sample1sample1', 9813359149, '2024-05-28 17:44:10'),
(3, 'Customer', 'sample2', 'sample2@gmail.com', 'sample2', '12345', '2005-10-10', 'Male', 'sampleaddress2', 9509298483, '2024-06-02 19:18:42');

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
  MODIFY `houseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `reportId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

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
