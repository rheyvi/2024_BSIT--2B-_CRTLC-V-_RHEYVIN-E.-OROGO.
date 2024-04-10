-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 09:54 AM
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
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentId` int(11) NOT NULL,
  `UserId` int(250) NOT NULL,
  `DateAndTime` datetime(4) NOT NULL,
  `UserLocation` text NOT NULL,
  `MeetingPlace` text NOT NULL,
  `ContactInformation` bigint(15) NOT NULL,
  `Status` text NOT NULL,
  `DateInput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentId`, `UserId`, `DateAndTime`, `UserLocation`, `MeetingPlace`, `ContactInformation`, `Status`, `DateInput`) VALUES
(1, 1, '2024-02-27 08:00:00.0000', 'Naga, Camarines Sur ', 'Daet, Camarines Norte', 950929656, '', '2024-02-27 00:03:24'),
(2, 2, '2024-02-27 09:00:00.0000', 'Tigaon, Camarines Sur', 'Naga, Camarines Sur', 509296565, '', '2024-02-27 00:05:33'),
(3, 5, '2024-02-27 08:00:00.0000', 'zone 3 hahahahah tabaco city', 'popo and kupa place', 950929656, '', '2024-03-07 12:26:12');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `MessageId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `messagetext` text NOT NULL,
  `dateinput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `money`
--

CREATE TABLE `money` (
  `ReportId` int(11) NOT NULL,
  `TotalClients` int(250) NOT NULL,
  `StartMonthYear` date NOT NULL,
  `EndMonthYear` date NOT NULL,
  `TotalSales` double(15,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `money`
--

INSERT INTO `money` (`ReportId`, `TotalClients`, `StartMonthYear`, `EndMonthYear`, `TotalSales`) VALUES
(1, 3, '2024-01-01', '2024-01-31', 1200300.000);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewId` int(11) NOT NULL,
  `userId` int(250) NOT NULL,
  `houseitemNum` int(250) NOT NULL,
  `Comment` text NOT NULL,
  `DatePosted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewId`, `userId`, `houseitemNum`, `Comment`, `DatePosted`) VALUES
(1, 1, 35, 'This is very good house with a very good hotdog with egg side dish and a mommy', '2024-02-27 00:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionId` int(250) NOT NULL,
  `AppointmentId` int(250) NOT NULL,
  `houseitemNum` int(250) NOT NULL,
  `accountName` varchar(255) NOT NULL,
  `accountNumber` bigint(255) NOT NULL,
  `TransactionDate` date NOT NULL,
  `TransactionAmount` double(10,3) NOT NULL,
  `PaymentStatus` varchar(250) NOT NULL,
  `referenceNumber` bigint(255) NOT NULL,
  `DateInput` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`TransactionId`, `AppointmentId`, `houseitemNum`, `accountName`, `accountNumber`, `TransactionDate`, `TransactionAmount`, `PaymentStatus`, `referenceNumber`, `DateInput`) VALUES
(1, 1, 35, 'Honezekiel\r\n', 123456789, '2024-02-27', 4000000.000, 'Not paid', 987654321, '2024-02-27 00:08:02'),
(2, 1, 13, 'Jake ', 90123948182, '2024-02-27', 2000000.000, 'Half paid', 543219876, '2024-03-07 15:10:08'),
(3, 2, 12, 'Jacob Mira', 871839173, '2024-03-07', 2000000.000, 'half paid', 90123948132, '2024-03-07 15:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Email_Address` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `Sex` enum('Male','Female','','') NOT NULL,
  `Address` text NOT NULL,
  `Phone_Number` bigint(15) NOT NULL,
  `Date_Login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `Fullname`, `Email_Address`, `Password`, `Username`, `Birthday`, `Sex`, `Address`, `Phone_Number`, `Date_Login`) VALUES
(1, 'Hon Ezekiel Bognalbal', 'minatozaki1414@gmail.com', 'honhon12345', 'honhongwapo', '0000-00-00', 'Male', 'Purok 3 Quinastillojan, Tabaco City', 9509296565, '2024-02-22 23:47:28'),
(2, 'Solano', 'solano@gmail.com', '12345', 'Solano', '2004-05-18', 'Male', 'Tigaon, Camarines Sur', 9509296565, '2024-02-22 23:54:06'),
(3, 'Hon Ezekiel Noble Bognalbal', 'minatozaki1414@gmail.com', 'hon12345', 'honhonpogi', '1995-05-18', 'Female', 'zone 8 san antonio tabaco city', 9509296565, '2024-02-22 23:56:37'),
(4, 'Jacob Mira Goodboi', 'jacobmira@gmail.com', 'jacob11111', 'jacobisthekey', '2000-01-01', 'Male', 'Zone 3 Ubaliw Polangui', 9123818293, '2024-02-27 00:01:37'),
(5, 'April Boy Ozmakapa', 'april12345@gmail.com', 'test123', 'aprilboy11', '2000-01-01', 'Male', 'zone 1 hahahahaha tabaco city', 9123818293, '2024-03-07 12:24:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`MessageId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`ReportId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionId`),
  ADD KEY `AppointmentId` (`AppointmentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppointmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `MessageId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `money`
--
ALTER TABLE `money`
  MODIFY `ReportId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TransactionId` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`AppointmentId`) REFERENCES `appointment` (`AppointmentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
