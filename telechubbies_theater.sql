-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 34.87.179.193
-- Generation Time: May 19, 2020 at 09:00 AM
-- Server version: 5.7.25-google-log
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telechubbies_theater`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinemabranch`
--

CREATE TABLE `cinemabranch` (
  `Branch_ID` int(6) NOT NULL COMMENT 'six digit integer ID for specific branch',
  `Manager_ID` int(6) DEFAULT NULL COMMENT 'employee ID for the manager of given branch',
  `Location` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT 'address of cinema branch',
  `Region` enum('NORTH','SOUTH','EAST','WEST') COLLATE utf8_unicode_ci NOT NULL COMMENT 'region the branch belongs to'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cinemabranch`
--

INSERT INTO `cinemabranch` (`Branch_ID`, `Manager_ID`, `Location`, `Region`) VALUES
(1, 0, 'Prototype Lane.', 'NORTH'),
(2, 0, 'Central Rama 3', 'EAST'),
(3, 0, 'Central Rama 2', 'WEST');

-- --------------------------------------------------------

--
-- Table structure for table `clockinout`
--

CREATE TABLE `clockinout` (
  `Employee_ID` int(6) NOT NULL COMMENT 'id for employee clocking',
  `Type` tinyint(4) NOT NULL COMMENT '0 for clock IN 1 for clock OUT',
  `DateTime` datetime NOT NULL COMMENT 'date and time of clocking'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clockinout`
--

INSERT INTO `clockinout` (`Employee_ID`, `Type`, `DateTime`) VALUES
(0, 0, '2020-05-09 05:47:16'),
(0, 1, '2020-05-09 05:51:43'),
(0, 0, '2020-05-17 14:37:00'),
(0, 1, '2020-05-17 14:37:06'),
(0, 0, '2020-05-17 15:28:45'),
(0, 1, '2020-05-17 15:28:52'),
(0, 0, '2020-05-17 15:36:52'),
(0, 1, '2020-05-17 15:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `Discount_ID` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'eight characters discount id',
  `PercentDiscount` tinyint(4) NOT NULL COMMENT 'percent of discount given by discount (0 - 100)',
  `DiscountDetails` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'details of discount',
  `DiscountCondition` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'discount conditions'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`Discount_ID`, `PercentDiscount`, `DiscountDetails`, `DiscountCondition`) VALUES
('DISCOUNT', 20, 'none', 'testing purposes only'),
('FREE4ALL', 100, 'A test discount code to get frees stuff.', 'Customer must be developer.'),
('FREEEEE', 100, 'none', 'none'),
('FRI50', 50, '50% discount code for customers who buy tickets on Friday', 'none'),
('TESTCODE', 50, 'This is a test discount code to test the discount capabilities of the project.', 'Customer must not be a customer, but rather a developer.'),
('TESTING', 15, 'Testing purposes only', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `employeeevaluation`
--

CREATE TABLE `employeeevaluation` (
  `Employee_ID` int(6) NOT NULL COMMENT 'six digit integer ID for employee',
  `DateTime` datetime NOT NULL COMMENT 'date and time of evaluation',
  `Manager_ID` int(6) NOT NULL COMMENT 'employee id of evaluating manager',
  `Details` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'evaluation details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employeeevaluation`
--

INSERT INTO `employeeevaluation` (`Employee_ID`, `DateTime`, `Manager_ID`, `Details`) VALUES
(0, '2020-05-18 09:06:32', 0, 'Did a great job of repairing the broken projector mid showing within 5 minutes. Customers were only mildly inconvenienced.'),
(1, '2020-05-17 00:00:00', 0, 'Database testing, evaluating employee 1 by employee 0 (manager)'),
(2, '2020-05-18 09:21:57', 0, 'Did a great job of  subduing burglar who tried to rob the concession stand and the ticket counter. May have to pay compensation for injuries afflicted on the burglar, taken out of his salary.'),
(4, '2020-05-11 00:00:00', 0, 'Database systems testing, second evaluation.'),
(4, '2020-05-18 10:58:03', 0, 'Good job solving that customer yesterday. You displayed great communication and problem solving skills. Keep up the good work!');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `Employee_ID` int(6) NOT NULL COMMENT 'six digit integer ID for employee',
  `Branch_ID` int(6) NOT NULL COMMENT 'branch this employee belongs to',
  `ID_Card_Number` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '13 digit integer for employee''s THAI id number',
  `Employee_Name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'full name of employee',
  `Gender` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'biological gender at birth of employee',
  `DateOfBirth` date NOT NULL COMMENT 'dob of employee',
  `PhoneNumber` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'employee''s home address',
  `Email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'password for logging into intranet system, non encrypted',
  `Position_ID` int(6) NOT NULL COMMENT 'id for employee''s position',
  `WorkHours` int(11) NOT NULL COMMENT 'number of hours employee is required to work per week'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Employee_ID`, `Branch_ID`, `ID_Card_Number`, `Employee_Name`, `Gender`, `DateOfBirth`, `PhoneNumber`, `Address`, `Email`, `Password`, `Position_ID`, `WorkHours`) VALUES
(0, 1, '9999999999999', 'Pepper Potts', 'M', '2020-05-01', '0999999998', 'address', 'manager@mail.com', 'telechubbies', 1, 0),
(1, 2, '1111111111111', 'Jane Doe', 'F', '2020-05-07', '00000000000', 'no', 'tech@mail.com', 'telechubbies', 4, 30),
(2, 2, '0000000000000', 'John Wick', 'M', '2000-01-01', '0991561203', 'He has no adddress', 'security@mail.com', 'telechubbies', 7, 60),
(4, 1, '0123456789123', 'Tony Stark', 'M', '1950-02-02', '0123456789', 'Stark Tower\'\'\'', 'tech.stark@mail.com', 'telechubbies', 4, 99);

-- --------------------------------------------------------

--
-- Table structure for table `expenseitems`
--

CREATE TABLE `expenseitems` (
  `Expense_ID` int(6) NOT NULL,
  `ExpenseType` enum('SALARY','EQUIPMENT','OTHER') COLLATE utf8_unicode_ci NOT NULL COMMENT 'type of expense item',
  `Amount` int(11) NOT NULL COMMENT 'amount of money of this item',
  `Quantity` int(11) NOT NULL COMMENT 'quantity of item',
  `Details` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'details of this item'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenseitems`
--

INSERT INTO `expenseitems` (`Expense_ID`, `ExpenseType`, `Amount`, `Quantity`, `Details`) VALUES
(3, 'EQUIPMENT', 9000, 5, 'Projection system repairs'),
(3, 'SALARY', 90000, 5, 'Technician salaries'),
(6, 'EQUIPMENT', 5000, 3, 'Security Equipment'),
(13, 'SALARY', 90000, 3, 'Monthly salary for technicians'),
(13, 'EQUIPMENT', 12000, 1, 'Projector repairs ');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `Expense_ID` int(6) NOT NULL COMMENT 'a six digit integer for a given expense',
  `Manager_ID` int(6) NOT NULL COMMENT 'id for manager confirming the expense',
  `DateTime` datetime NOT NULL COMMENT 'date and time of expense'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`Expense_ID`, `Manager_ID`, `DateTime`) VALUES
(0, 0, '2020-05-05 00:00:00'),
(2, 0, '2020-05-07 11:40:50'),
(3, 0, '2020-05-09 08:41:20'),
(4, 0, '2020-05-18 08:31:26'),
(5, 0, '2020-05-18 08:32:55'),
(6, 0, '2020-05-18 06:48:14'),
(7, 0, '2020-05-18 15:02:32'),
(8, 0, '2020-05-18 15:04:15'),
(9, 0, '2020-05-18 15:05:00'),
(10, 0, '2020-05-18 15:08:29'),
(11, 0, '2020-05-18 15:09:16'),
(12, 0, '2020-05-18 15:10:01'),
(13, 0, '2020-05-18 16:31:34'),
(14, 0, '2020-05-18 18:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `filmrolls`
--

CREATE TABLE `filmrolls` (
  `Roll_ID` int(6) NOT NULL COMMENT 'six digit integer ID for specific roll',
  `Movie_ID` int(6) NOT NULL COMMENT 'id for movie the roll is for',
  `Branch_ID` int(6) NOT NULL COMMENT 'id for branch the roll belongs to',
  `LeaseDate` date NOT NULL COMMENT 'date when the lease begins/film roll was purchased',
  `Distributor` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'distributor the roll is purchased/leased from',
  `LeasePeriod` int(11) DEFAULT NULL COMMENT 'number of days the lease is valid for (null if purchased)',
  `Amount` int(11) NOT NULL COMMENT 'cost of one roll',
  `Expense_ID` int(6) NOT NULL COMMENT 'the expense this filmroll is bought with'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filmrolls`
--

INSERT INTO `filmrolls` (`Roll_ID`, `Movie_ID`, `Branch_ID`, `LeaseDate`, `Distributor`, `LeasePeriod`, `Amount`, `Expense_ID`) VALUES
(1, 1, 1, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(2, 1, 1, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(3, 1, 1, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(4, 1, 1, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(5, 1, 1, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(6, 1, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(7, 1, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(8, 1, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(9, 1, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(10, 1, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(11, 1, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(12, 1, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(13, 1, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(14, 1, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(15, 1, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(16, 2, 2, '2020-05-05', 'CJ Entertainment', NULL, 0, 0),
(17, 2, 2, '2020-05-05', 'CJ Entertainment', NULL, 0, 0),
(18, 2, 3, '2020-05-05', 'CJ Entertainment', NULL, 0, 0),
(19, 2, 3, '2020-05-05', 'CJ Entertainment', NULL, 0, 0),
(20, 3, 3, '2020-05-05', 'Paramount Pictures', NULL, 0, 0),
(21, 3, 3, '2020-05-05', 'Paramount Pictures', NULL, 0, 0),
(22, 3, 3, '2020-05-05', 'Paramount Pictures', NULL, 0, 0),
(23, 3, 2, '2020-05-05', 'Paramount Pictures', NULL, 0, 0),
(24, 4, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(25, 4, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(26, 4, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(27, 5, 2, '2020-05-05', 'Sony Pictures Releasing', NULL, 0, 0),
(28, 5, 2, '2020-05-05', 'Sony Pictures Releasing', NULL, 0, 0),
(29, 5, 3, '2020-05-05', 'Sony Pictures Releasing', NULL, 0, 0),
(30, 5, 3, '2020-05-05', 'Sony Pictures Releasing', NULL, 0, 0),
(31, 6, 2, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(32, 6, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(33, 6, 3, '2020-05-05', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(34, 7, 2, '2020-05-05', 'Universal Pictures', NULL, 0, 0),
(35, 7, 3, '2020-05-05', 'Universal Pictures', NULL, 0, 0),
(36, 7, 3, '2020-05-05', 'Universal Pictures', NULL, 0, 0),
(67, 8, 2, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(68, 8, 2, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(69, 8, 2, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(70, 8, 2, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(71, 8, 2, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 0, 0),
(72, 9, 3, '2020-05-06', 'Sony Pictures Releasing', NULL, 0, 0),
(73, 9, 3, '2020-05-06', 'Sony Pictures Releasing', NULL, 0, 0),
(74, 9, 3, '2020-05-06', 'Sony Pictures Releasing', NULL, 0, 0),
(75, 8, 1, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 9300, 2),
(76, 8, 1, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 9300, 2),
(77, 8, 1, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 9300, 2),
(78, 8, 1, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 9300, 2),
(79, 8, 1, '2020-05-06', 'Walt Disney Studios Motion Pictures', NULL, 9300, 2),
(80, 4, 2, '2020-05-25', 'Walt Disney Studios Motion Pictures', 1, 5000, 4),
(81, 4, 2, '2020-05-25', 'Walt Disney Studios Motion Pictures', 1, 5000, 4),
(82, 4, 2, '2020-05-25', 'Walt Disney Studios Motion Pictures', 1, 5000, 4),
(83, 4, 2, '2020-05-25', 'Walt Disney Studios Motion Pictures', 1, 5000, 4),
(84, 4, 2, '2020-05-25', 'Walt Disney Studios Motion Pictures', 1, 5000, 4),
(85, 4, 2, '2020-05-20', 'Walt Disney Studios Motion Pictures', 2, 5000, 5),
(86, 4, 2, '2020-05-20', 'Walt Disney Studios Motion Pictures', 2, 5000, 5),
(87, 4, 2, '2020-05-20', 'Walt Disney Studios Motion Pictures', 2, 5000, 5),
(88, 4, 2, '2020-05-20', 'Walt Disney Studios Motion Pictures', 2, 5000, 5),
(89, 4, 2, '2020-05-20', 'Walt Disney Studios Motion Pictures', 2, 5000, 5),
(90, 9, 3, '2020-05-18', 'Walt Disney Studios Motion Pictures', 1, 10000, 7),
(91, 9, 3, '2020-05-18', 'Walt Disney Studios Motion Pictures', 1, 10000, 7),
(92, 9, 3, '2020-05-18', 'Walt Disney Studios Motion Pictures', 1, 10000, 7),
(93, 10, 2, '2020-05-18', 'Walt Disney Studios Motion Pictures', 2, 9000, 8),
(94, 10, 2, '2020-05-18', 'Walt Disney Studios Motion Pictures', 2, 9000, 8),
(95, 10, 2, '2020-05-18', 'Walt Disney Studios Motion Pictures', 2, 9000, 8),
(96, 11, 2, '2020-05-18', 'Sony Pictures Releasing', NULL, 10000, 9),
(97, 11, 2, '2020-05-18', 'Sony Pictures Releasing', NULL, 10000, 9),
(98, 11, 3, '2020-05-18', 'Sony Pictures Releasing', 2, 12000, 10),
(99, 11, 3, '2020-05-18', 'Sony Pictures Releasing', 2, 12000, 10),
(100, 12, 2, '2020-05-18', 'Paramount Pictures', 2, 9000, 11),
(101, 13, 2, '2020-05-18', 'Universal Pictures', 1, 12000, 12),
(102, 10, 3, '2020-05-18', 'Walt Disney Studios Motion Pictures', 3, 12000, 14),
(103, 10, 3, '2020-05-18', 'Walt Disney Studios Motion Pictures', 3, 12000, 14);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(6) NOT NULL COMMENT 'six digit integer ID for item',
  `ItemName` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name of item',
  `ItemPrice` int(11) NOT NULL COMMENT 'price of item',
  `Image` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'link to product image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `ItemPrice`, `Image`) VALUES
(-2, 'Ticket (Couple Seat)', 300, NULL),
(-1, 'Ticket (Standard Seat)', 200, NULL),
(1, 'Popcorn, Large', 299, 'popcorn-l.jpg'),
(2, 'Popcorn, Medium', 239, 'popcorn-m.jpg'),
(3, 'Popcorn, Small', 199, 'popcorn-s.jpg'),
(4, 'Soft Drink, Small', 59, 'soft-drink-s.jpg'),
(5, 'Snickers, Medium', 59, 'snickers-m.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `itemsold`
--

CREATE TABLE `itemsold` (
  `TransactionID` int(6) NOT NULL COMMENT 'transaction id of transaction in which this item belongs',
  `ItemID` int(6) NOT NULL COMMENT 'id of item purchased in transaction',
  `Quantity` int(3) NOT NULL COMMENT 'number of item purchased'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemsold`
--

INSERT INTO `itemsold` (`TransactionID`, `ItemID`, `Quantity`) VALUES
(4, 3, 1),
(5, 1, 3),
(5, 2, 1),
(5, 3, 5),
(5, 4, 1),
(6, 3, 2),
(7, 1, 1),
(7, 2, 1),
(7, 3, 1),
(7, 4, 1),
(8, -1, 6),
(8, 3, 1),
(9, 5, 1),
(10, 5, 999),
(11, 1, 1),
(11, 2, 1),
(11, 3, 1),
(11, 5, 1),
(12, 4, 1),
(12, 5, 1),
(13, 1, 3),
(13, 4, 1),
(14, 1, 2),
(14, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `Job_ID` int(6) NOT NULL COMMENT 'id identifying specific job',
  `Employee_ID` int(6) NOT NULL COMMENT 'id of employee doing maintenanace',
  `DateTime` datetime NOT NULL COMMENT 'date time of maintenance job',
  `Details` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'details of job',
  `Job_Type` enum('REPAIR','CLEANING','GENERAL','OTHER') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'keyword describing job'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`Job_ID`, `Employee_ID`, `DateTime`, `Details`, `Job_Type`) VALUES
(1, 1, '2020-05-16 16:09:00', 'Systems testing of the maintenance logging.', 'OTHER'),
(2, 4, '2020-05-16 16:10:00', 'Maintaining database', 'GENERAL'),
(3, 2, '2020-05-20 15:30:00', 'Cleaning theater', 'CLEANING');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `RegisterBranch_ID` int(6) NOT NULL COMMENT 'six digit integer id for branch member is registered to',
  `Member_ID` int(6) NOT NULL COMMENT 'six digit integer id for member',
  `Member_Name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Member_Type` enum('REGULAR','GOLD','PLATINUM') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'can be REGULAR, GOLD, PLATINUM',
  `RegisterDate` date NOT NULL COMMENT 'date member registered',
  `Point` int(11) NOT NULL DEFAULT '0' COMMENT 'number of points member currently has',
  `Contact_Info` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'contact information for member',
  `DateOfBirth` date NOT NULL COMMENT 'date of birth of member',
  `Email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'member''s email',
  `Password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'member''s password (non-encrypted)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`RegisterBranch_ID`, `Member_ID`, `Member_Name`, `Member_Type`, `RegisterDate`, `Point`, `Contact_Info`, `DateOfBirth`, `Email`, `Password`) VALUES
(1, 1, 'John Doe', 'PLATINUM', '2020-04-24', 0, 'nope not gonna give you', '2020-04-23', 'johndoe@mail.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `TransactionID` int(6) NOT NULL COMMENT 'six digit integer ID for transaction',
  `DateTime` datetime NOT NULL COMMENT 'date and time when transaction was made',
  `PaymentMethod` enum('CASH','DEBIT','CREDIT','ONLINE') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'method of payment',
  `Member_ID` int(6) DEFAULT NULL COMMENT 'member id of customer, if applicable',
  `Discount_ID` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'discount id if applicable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`TransactionID`, `DateTime`, `PaymentMethod`, `Member_ID`, `Discount_ID`) VALUES
(1, '0000-00-00 00:00:00', '', NULL, NULL),
(4, '2020-05-02 17:38:55', 'CASH', 1, 'FREE4ALL'),
(5, '2020-05-04 07:29:36', 'CASH', 1, 'FREE4ALL'),
(6, '2020-05-04 10:09:02', 'CASH', 1, NULL),
(7, '2020-05-04 15:17:07', 'CASH', 1, 'TESTCODE'),
(8, '2020-05-06 18:43:32', 'CASH', 1, 'FREE4ALL'),
(9, '2020-05-16 11:22:12', 'CASH', NULL, NULL),
(10, '2020-05-16 14:46:11', 'CASH', NULL, NULL),
(11, '2020-05-18 11:36:36', 'CASH', 1, NULL),
(12, '2020-05-18 17:55:41', 'CASH', 1, 'TESTCODE'),
(13, '2020-05-18 18:01:04', 'CASH', 1, 'FREE4ALL'),
(14, '2020-05-18 18:14:05', 'CASH', 1, 'TESTCODE');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `Movie_ID` int(6) NOT NULL COMMENT 'six digit integer ID for movie',
  `MovieStudio` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'movie studio the movie release from',
  `Movie_Name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name  of movie',
  `ReleaseYear` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'release date/year of movie',
  `Genre` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'genre movie belongs to (only one, for simplicity)',
  `Subgenre` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'subgenres for showing on the movie showings',
  `Director` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name of director of movie',
  `Cast` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'names of main cast in movie',
  `Synopsis` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'synopsis of movie',
  `Rating` enum('G','PG','PG-13','R','NC-17') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'MPAA rating of movie',
  `Runtime` int(11) NOT NULL COMMENT 'runtime of movie in minutes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`Movie_ID`, `MovieStudio`, `Movie_Name`, `ReleaseYear`, `Genre`, `Subgenre`, `Director`, `Cast`, `Synopsis`, `Rating`, `Runtime`) VALUES
(1, 'Pixar Animation Studios', 'Onward', '2020', 'Animation', 'Fantasy Adventure', 'Dan Scanlon', 'Tom Holland, Chris Pratt, Julia Louis-Dreyfus, Octavia Spencer', 'Teenage elf brothers Ian and Barley embark on a magical quest to spend one more day with their late father. Like any good adventure, their journey is filled with cryptic maps, impossible obstacles and unimaginable discoveries. But when dear Mom finds out her sons are missing, she teams up with the legendary manticore to bring her beloved boys back home.', 'PG', 0),
(2, 'Barunson E&A', 'Parasite', '2019', 'Drama', 'Comedy Thriller', 'Bong Joon-ho', 'Song Kang-ho,\r\nLee Sun-kyun,\r\nCho Yeo-jeong,\r\nChoi Woo-shik,\r\nPark So-dam,\r\nLee Jung-eun,\r\nJang Hye-jin', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 'R', 0),
(3, 'Sega Sammy Group, Original Film, Marza Animation Planet, Blur Studio', 'Sonic the Hedgehog', '2020', 'Comedy', 'Adventure Action', 'Jeff Fowler', 'James Marsden,\r\nBen Schwartz,\r\nTika Sumpter,\r\nJim Carrey', 'The world needed a hero -- it got a hedgehog. Powered with incredible speed, Sonic embraces his new home on Earth -- until he accidentally knocks out the power grid, sparking the attention of uncool evil genius Dr. Robotnik. Now, it\'s supervillain vs. supersonic in an all-out race across the globe to stop Robotnik from using Sonic\'s unique power to achieve world domination.', 'PG', 0),
(4, 'Walt Disney Pictures, Jason T. Reed Productions, Good Fear', 'Mulan', '2020', 'Action', 'Drama', 'Niki Caro', 'Liu Yifei,\r\nDonnie Yen,\r\nJason Scott Lee,\r\nYoson An,\r\nGong Li,\r\nJet Li', 'To save her ailing father from serving in the Imperial Army, a fearless young woman disguises herself as a man to battle northern invaders in China.', 'PG-13', 0),
(5, 'Columbia Pictures, 2.0 Entertainment, Don Simpson/Jerry Bruckheimer Films, Overbrook Entertainment', 'Bad Boys for Life', '2020', 'Action', 'Comedy', '	\r\nAdil El Arbi,\r\nBilall Fallah', 'Will Smith,\r\nMartin Lawrence,\r\nPaola Núñez,\r\nVanessa Hudgens,\r\nAlexander Ludwig,\r\nCharles Melton,\r\nJacob Scipio,\r\nKate del Castillo,\r\nNicky Jam,\r\nJoe Pantoliano', 'The wife and son of a Mexican drug lord embark on a vengeful quest to kill all those involved in his trial and imprisonment -- including Miami Detective Mike Lowrey. When Mike gets wounded, he teams up with partner Marcus Burnett and AMMO -- a special tactical squad -- to bring the culprits to justice. But the old-school, wisecracking cops must soon learn to get along with their new elite counterparts if they are to take down the vicious cartel that threatens their lives.', 'R', 0),
(6, '	\r\nLucasfilm Ltd.,\r\nBad Robot Productions', 'Star Wars: The Rise of Skywalker', '2019', 'Sci-fi', 'Adventure', 'J. J. Abrams', 'Carrie Fisher,\r\nMark Hamill,\r\nAdam Driver,\r\nDaisy Ridley,\r\nJohn Boyega,\r\nOscar Isaac,\r\nAnthony Daniels,\r\nNaomi Ackie', 'When it\'s discovered that the evil Emperor Palpatine did not die at the hands of Darth Vader, the rebels must race against the clock to find out his whereabouts. Finn and Poe lead the Resistance to put a stop to the First Order\'s plans to form a new Empire, while Rey anticipates her inevitable confrontation with Kylo Ren. Warning: Some flashing-lights scenes in this film may affect photosensitive viewers.', 'PG-13', 0),
(7, 'DreamWorks Pictures,\r\nReliance Entertainment,\r\nNew Republic Pictures,\r\nMogambo,\r\nNeal Street Productions,\r\nAmblin Partners', '1917', '2019', 'Drama', 'War', 'Sam Mendes', 'George MacKay,\r\nDean-Charles Chapman,\r\nMark Strong,\r\nAndrew Scott,\r\nRichard Madden,\r\nClaire Duburcq,\r\nColin Firth,\r\nBenedict Cumberbatch', 'During World War I, two British soldiers -- Lance Cpl. Schofield and Lance Cpl. Blake -- receive seemingly impossible orders. In a race against time, they must cross over into enemy territory to deliver a message that could potentially save 1,600 of their fellow comrades -- including Blake\'s own brother.', 'R', 0),
(8, 'Marvel Studios', 'Avengers: Endgame', '2019', 'Action', 'Superhero', 'Anthony Russo, Joe Russo', 'Robert Downey Jr., Chris Evans, Mark Ruffalo, Chris Hemsworth, Scarlett Johansson, Jeremy Renner, Don Cheadle, Paul Rudd, Brie Larson, Karen Gillan, Danai Gurira, Benedict Wong, Jon Favreau, Bradley Cooper, Gwyneth Paltrow, Josh Brolin', 'Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos -- the evil demigod who decimated the planet and the universe.', 'PG-13', 182),
(9, 'Columbia Pictures, Seven Bucks Productions, Hartbeat Productions, Matt Tolmach Productions ', 'Jumanji: The Next Level', '2019', 'Adventure', 'Fantasy Comedy', 'Jake Kasdan', 'Dwayne Johnson, Jack Black, Kevin Hart, Karen Gillan, Nick Jonas, Awkwafina, Danny Glover, Danny DeVito', 'When Spencer goes back into the fantastical world of Jumanji, pals Martha, Fridge and Bethany re-enter the game to bring him home. But the game is now broken -- and fighting back. Everything the friends know about Jumanji is about to change, as they soon discover there\'s more obstacles and more danger to overcome.', 'PG-13', 123),
(10, 'Walt Disney Pictures, Walt Disney Animation Studios ', 'Frozen II', '2019', 'Animation', 'Fantasy', 'Chris Buck, Jennifer Lee', 'Kristen Bell, Idina Menzel, Josh Gad, Jonathan Groff', 'Elsa the Snow Queen has an extraordinary gift -- the power to create ice and snow. But no matter how happy she is to be surrounded by the people of Arendelle, Elsa finds herself strangely unsettled. After hearing a mysterious voice call out to her, Elsa travels to the enchanted forests and dark seas beyond her kingdom -- an adventure that soon turns into a journey of self-discovery.', 'PG', 103),
(11, 'Columbia Pictures, Sony Pictures Animation, Marvel Entertainment ', 'Spider-Man: Into the Spider-Verse', '2018', 'Action', 'Superhero Animation', 'Bob Persichetti, Peter Ramsey, Rodney Rothman', 'Shameik Moore, Jake Johnson, Hailee Steinfeld, Mahershala Ali, Brian Tyree Henry, Lily Tomlin, Luna Lauren Velez, John Mulaney, Kimiko Glenn', 'Bitten by a radioactive spider in the subway, Brooklyn teenager Miles Morales suddenly develops mysterious powers that transform him into the one and only Spider-Man. When he meets Peter Parker, he soon realizes that there are many others who share his special, high-flying talents. Miles must now use his newfound skills to battle the evil Kingpin, a hulking madman who can open portals to other universes and pull different versions of Spider-Man into our world.', 'PG', 116),
(12, 'Skydance Media, Don Simpson/Jerry Bruckheimer Films ', 'Top Gun: Maverick', '2020', 'Action', 'Drama', 'Joseph Kosinski', 'Tom Cruise, Miles Teller, Jennifer Connelly, Jon Hamm, Glen Powell, Lewis Pullman, Ed Harris, Val Kilmer', 'Pete \"Maverick\" Mitchell keeps pushing the envelope after years of service as one of the Navy\'s top aviators. He must soon confront the past while training a new squad of graduates for a dangerous mission that demands the ultimate sacrifice.', 'PG-13', 162),
(13, 'Columbia Pictures, Blumhouse Productions ', 'Fantasy Island', '2020', 'Horror', 'Fantasy Mystery Thriller', 'Jeff Wadlow', 'Michael Peña,\r\nMaggie Q,\r\nLucy Hale,\r\nAustin Stowell,\r\nPortia Doubleday,\r\nJimmy O. Yang,\r\nRyan Hansen,\r\nMichael Rooker', 'The enigmatic Mr Roarke makes the secret dreams of his lucky guests come true at a luxurious but remote tropical resort, but when the fantasies turn into nightmares, the guests have to solve the island\'s mystery in order to escape with their lives.', 'PG-13', 108);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `Position_ID` int(6) NOT NULL COMMENT 'six digit integer ID for the position',
  `Position_Name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'name of position',
  `Salary` int(11) NOT NULL COMMENT 'salary of position',
  `Job_Details` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'detail of position'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`Position_ID`, `Position_Name`, `Salary`, `Job_Details`) VALUES
(1, 'Manager', 99000, 'The manager manages, and does other managerial-related tasks.'),
(2, 'Janitor', 35000, 'The janitor cleans and does other janitorial-related tasks.'),
(3, 'Cashier_Concession', 43000, 'Does cash-related stuff at the concession stand.'),
(4, 'Technician', 70000, 'The technician does technical-related stuff.'),
(5, 'Projectionist', 65000, 'The projectionist takes care of projection-related tasks.'),
(6, 'Cashier_Ticket', 45000, 'Does cash-related stuff at the ticket booth.'),
(7, 'Security', 40000, 'Does security-related tasks in and around the cinemas.');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `Theater_ID` int(6) NOT NULL COMMENT 'id of theater the seat is in',
  `DateTime` datetime NOT NULL COMMENT 'Date and time for the showing the seat is in',
  `Seat_No` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'seat number within the theater',
  `Seat_Type` enum('REG','LNG','HNM') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'type of seat in theater',
  `Booking_ID` int(6) NOT NULL COMMENT 'the booking id of the booking this booked seat belongs to'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`Theater_ID`, `DateTime`, `Seat_No`, `Seat_Type`, `Booking_ID`) VALUES
(13, '2020-05-20 16:00:00', '2G', 'REG', 41),
(13, '2020-05-20 16:00:00', '3G', 'REG', 41),
(13, '2020-05-20 16:00:00', '4D', 'REG', 14),
(13, '2020-05-20 16:00:00', '4H', 'REG', 28),
(13, '2020-05-20 16:00:00', '5B', 'HNM', 14),
(13, '2020-05-20 16:00:00', '5D', 'REG', 14),
(13, '2020-05-20 16:00:00', '5H', 'REG', 28),
(13, '2020-05-20 16:00:00', '6B', 'HNM', 14),
(13, '2020-05-20 16:00:00', '6D', 'REG', 14),
(13, '2020-05-20 16:00:00', '6H', 'REG', 28),
(13, '2020-05-20 16:00:00', '8B', 'HNM', 17),
(13, '2020-05-20 16:00:00', '8H', 'REG', 41),
(13, '2020-05-20 16:00:00', '9B', 'HNM', 17),
(13, '2020-05-20 16:00:00', '9D', 'REG', 17),
(13, '2020-06-07 17:10:00', '10I', 'REG', 22),
(13, '2020-06-07 17:10:00', '1D', 'REG', 23),
(13, '2020-06-07 17:10:00', '1E', 'REG', 23),
(13, '2020-06-07 17:10:00', '3E', 'REG', 23),
(13, '2020-06-07 17:10:00', '3G', 'REG', 22),
(13, '2020-06-07 17:10:00', '4H', 'REG', 44),
(13, '2020-06-07 17:10:00', '4J', 'REG', 22),
(13, '2020-06-07 17:10:00', '5H', 'REG', 44),
(13, '2020-06-07 17:10:00', '6H', 'REG', 44),
(13, '2020-06-07 17:10:00', '7D', 'REG', 22),
(13, '2020-06-07 17:10:00', '7J', 'REG', 22),
(13, '2020-06-07 17:10:00', '8I', 'REG', 22),
(13, '2020-06-07 17:10:00', '9B', 'HNM', 22),
(14, '2020-05-20 16:00:00', '10D', 'REG', 50),
(14, '2020-05-20 16:00:00', '1G', 'REG', 18),
(14, '2020-05-20 16:00:00', '2G', 'REG', 18),
(14, '2020-05-20 16:00:00', '3G', 'REG', 18),
(14, '2020-05-20 16:00:00', '5B', 'HNM', 18),
(14, '2020-05-20 16:00:00', '6B', 'HNM', 18),
(14, '2020-05-20 16:00:00', '8D', 'REG', 50),
(14, '2020-05-20 16:00:00', '9D', 'REG', 50),
(15, '2020-05-25 17:00:00', '5A', 'HNM', 19),
(15, '2020-05-25 17:00:00', '6A', 'HNM', 19),
(15, '2020-06-11 17:40:00', '4I', 'REG', 30),
(15, '2020-06-11 17:40:00', '4J', 'REG', 30),
(15, '2020-06-11 17:40:00', '5I', 'REG', 30),
(15, '2020-06-11 17:40:00', '5J', 'REG', 30),
(15, '2020-06-11 17:40:00', '6G', 'REG', 43),
(15, '2020-06-11 17:40:00', '7G', 'REG', 43),
(15, '2020-06-11 17:40:00', '8G', 'REG', 43),
(17, '2020-05-29 00:15:00', '2H', 'REG', 49),
(17, '2020-05-29 00:15:00', '3H', 'REG', 49),
(17, '2020-05-29 00:15:00', '4H', 'REG', 49),
(17, '2020-05-29 00:15:00', '5H', 'REG', 49),
(17, '2020-06-04 20:10:00', '4G', 'REG', 37),
(17, '2020-06-04 20:10:00', '5G', 'REG', 37),
(17, '2020-06-04 20:10:00', '6G', 'REG', 37),
(17, '2020-06-04 20:10:00', '6J', 'REG', 39),
(17, '2020-06-04 20:10:00', '7G', 'REG', 37),
(17, '2020-06-04 20:10:00', '7J', 'REG', 39),
(17, '2020-06-04 20:10:00', '8J', 'REG', 39),
(17, '2020-06-06 10:20:00', '3I', 'REG', 24),
(17, '2020-06-06 10:20:00', '4I', 'REG', 24),
(17, '2020-06-06 10:20:00', '5I', 'REG', 24),
(17, '2020-06-06 10:20:00', '6I', 'REG', 24),
(20, '2020-05-28 10:40:00', '4H', 'REG', 33),
(20, '2020-05-28 10:40:00', '5H', 'REG', 33),
(20, '2020-05-28 10:40:00', '6H', 'REG', 33),
(21, '2020-06-09 10:30:00', '7E', 'REG', 26),
(21, '2020-06-09 10:30:00', '8E', 'REG', 26),
(21, '2020-06-09 10:30:00', '9E', 'REG', 26),
(21, '2020-06-11 15:30:00', '2I', 'REG', 46),
(21, '2020-06-11 15:30:00', '3I', 'REG', 46),
(21, '2020-06-11 15:30:00', '7I', 'REG', 25),
(21, '2020-06-11 15:30:00', '8I', 'REG', 25),
(21, '2020-06-11 15:30:00', '9I', 'REG', 25),
(24, '2020-06-05 19:10:00', '10I', 'REG', 48),
(24, '2020-06-05 19:10:00', '8I', 'REG', 48),
(24, '2020-06-05 19:10:00', '9I', 'REG', 48),
(25, '2020-06-07 14:40:00', '9G', 'REG', 29),
(31, '2020-05-31 02:20:00', '3J', 'REG', 31),
(31, '2020-05-31 02:20:00', '4J', 'REG', 31),
(31, '2020-05-31 02:20:00', '5J', 'REG', 31),
(31, '2020-05-31 02:20:00', '6J', 'REG', 31),
(31, '2020-05-31 02:20:00', '7J', 'REG', 31),
(31, '2020-05-31 02:20:00', '8J', 'REG', 31),
(31, '2020-06-01 13:50:00', '6I', 'REG', 32),
(31, '2020-06-01 13:50:00', '7I', 'REG', 32),
(31, '2020-06-10 16:00:00', '2I', 'REG', 45),
(31, '2020-06-10 16:00:00', '3I', 'REG', 45),
(31, '2020-06-10 16:00:00', '4I', 'REG', 45),
(31, '2020-06-10 16:00:00', '5I', 'REG', 45),
(31, '2020-06-10 16:00:00', '6I', 'REG', 45),
(31, '2020-06-10 16:00:00', '7I', 'REG', 45),
(31, '2020-06-10 16:00:00', '8I', 'REG', 45),
(31, '2020-06-10 16:00:00', '9I', 'REG', 45),
(32, '2020-05-26 11:40:00', '5J', 'REG', 38),
(32, '2020-05-26 11:40:00', '6J', 'REG', 38),
(32, '2020-05-26 11:40:00', '7J', 'REG', 38),
(32, '2020-05-26 11:40:00', '8J', 'REG', 38),
(33, '2020-05-26 11:40:00', '10G', 'REG', 34),
(33, '2020-05-26 11:40:00', '8G', 'REG', 34),
(33, '2020-05-26 11:40:00', '9G', 'REG', 34),
(33, '2020-06-09 10:55:00', '10E', 'REG', 40),
(33, '2020-06-09 10:55:00', '8E', 'REG', 40),
(33, '2020-06-09 10:55:00', '9E', 'REG', 40),
(33, '2020-06-13 15:15:00', '3I', 'REG', 20),
(33, '2020-06-13 15:15:00', '4I', 'REG', 20),
(33, '2020-06-13 15:15:00', '5I', 'REG', 20),
(33, '2020-06-13 15:15:00', '6I', 'REG', 20),
(34, '2020-06-02 20:30:00', '6H', 'REG', 35),
(34, '2020-06-02 20:30:00', '7H', 'REG', 35),
(35, '2020-06-01 00:15:00', '10I', 'REG', 42),
(35, '2020-06-01 00:15:00', '8I', 'REG', 42),
(35, '2020-06-01 00:15:00', '9I', 'REG', 42),
(35, '2020-06-08 15:20:00', '1H', 'REG', 21),
(35, '2020-06-08 15:20:00', '3E', 'REG', 21),
(35, '2020-06-08 15:20:00', '4E', 'REG', 21),
(35, '2020-06-08 15:20:00', '6J', 'REG', 21),
(35, '2020-06-08 15:20:00', '8H', 'REG', 21),
(35, '2020-06-11 11:00:00', '5J', 'REG', 47),
(35, '2020-06-11 11:00:00', '6J', 'REG', 27),
(35, '2020-06-11 11:00:00', '7J', 'REG', 27),
(35, '2020-06-11 11:00:00', '8J', 'REG', 27),
(36, '2020-05-26 16:15:00', '10H', 'REG', 36),
(36, '2020-05-26 16:15:00', '1H', 'REG', 36),
(36, '2020-05-26 16:15:00', '2H', 'REG', 36),
(36, '2020-05-26 16:15:00', '3H', 'REG', 36),
(36, '2020-05-26 16:15:00', '4H', 'REG', 36),
(36, '2020-05-26 16:15:00', '5H', 'REG', 36),
(36, '2020-05-26 16:15:00', '6H', 'REG', 36),
(36, '2020-05-26 16:15:00', '7H', 'REG', 36),
(36, '2020-05-26 16:15:00', '8H', 'REG', 36),
(36, '2020-05-26 16:15:00', '9H', 'REG', 36);

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `DateTime` datetime NOT NULL COMMENT 'date and time of the showing',
  `Theater_ID` int(6) NOT NULL COMMENT 'id for theater showing is in',
  `Roll_ID` int(6) NOT NULL COMMENT 'id for film roll being used',
  `Audio` enum('EN','TH') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'audio system the showing is in in format LNx.x'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`DateTime`, `Theater_ID`, `Roll_ID`, `Audio`) VALUES
('2020-05-20 16:00:00', 13, 6, 'EN'),
('2020-05-20 16:00:00', 14, 16, 'EN'),
('2020-05-25 00:10:00', 13, 16, 'EN'),
('2020-05-25 11:30:00', 26, 25, 'TH'),
('2020-05-25 17:00:00', 15, 34, 'EN'),
('2020-05-26 10:30:00', 25, 72, 'EN'),
('2020-05-26 11:40:00', 27, 74, 'EN'),
('2020-05-26 11:40:00', 32, 25, 'TH'),
('2020-05-26 13:20:00', 15, 34, 'TH'),
('2020-05-26 13:30:00', 27, 29, 'EN'),
('2020-05-26 16:15:00', 36, 36, 'TH'),
('2020-05-27 18:30:00', 30, 32, 'EN'),
('2020-05-28 10:40:00', 20, 71, 'EN'),
('2020-05-28 15:45:00', 32, 22, 'TH'),
('2020-05-28 22:00:00', 33, 29, 'TH'),
('2020-05-29 00:15:00', 17, 17, 'EN'),
('2020-05-29 00:15:00', 28, 26, 'TH'),
('2020-05-29 13:50:00', 32, 29, 'TH'),
('2020-05-29 19:00:00', 29, 33, 'TH'),
('2020-05-30 19:30:00', 15, 101, 'TH'),
('2020-05-31 02:20:00', 31, 14, 'TH'),
('2020-05-31 18:20:00', 33, 33, 'TH'),
('2020-06-01 00:15:00', 35, 14, 'EN'),
('2020-06-01 10:30:00', 18, 94, 'TH'),
('2020-06-01 13:50:00', 31, 35, 'EN'),
('2020-06-01 21:30:00', 35, 18, 'EN'),
('2020-06-02 17:20:00', 25, 99, 'EN'),
('2020-06-02 20:30:00', 34, 33, 'EN'),
('2020-06-03 13:20:00', 17, 101, 'TH'),
('2020-06-04 12:30:00', 19, 27, 'TH'),
('2020-06-04 20:10:00', 17, 27, 'EN'),
('2020-06-05 19:10:00', 24, 67, 'EN'),
('2020-06-06 10:20:00', 17, 94, 'EN'),
('2020-06-06 11:20:00', 27, 32, 'TH'),
('2020-06-07 10:50:00', 34, 26, 'EN'),
('2020-06-07 14:40:00', 25, 99, 'EN'),
('2020-06-07 17:10:00', 13, 88, 'EN'),
('2020-06-08 15:20:00', 35, 98, 'EN'),
('2020-06-09 10:30:00', 21, 31, 'TH'),
('2020-06-09 10:55:00', 33, 21, 'TH'),
('2020-06-10 16:00:00', 26, 33, 'TH'),
('2020-06-10 16:00:00', 31, 91, 'TH'),
('2020-06-11 11:00:00', 35, 22, 'TH'),
('2020-06-11 15:30:00', 21, 100, 'EN'),
('2020-06-11 17:40:00', 15, 100, 'EN'),
('2020-06-12 18:10:00', 29, 26, 'EN'),
('2020-06-13 15:15:00', 33, 14, 'EN'),
('2020-06-14 15:15:00', 34, 29, 'EN'),
('2020-06-15 18:30:00', 22, 100, 'TH'),
('2020-06-16 10:40:00', 19, 17, 'EN');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `Theater_ID` int(6) NOT NULL COMMENT 'six digit integer ID for theater',
  `No` int(11) NOT NULL COMMENT 'number for theater within branch',
  `Branch_ID` int(6) NOT NULL COMMENT 'cinema branch ID to which theater belongs',
  `Theater_Type` enum('STD','3DM','4DX','DIG') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'type of projection system in theater'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`Theater_ID`, `No`, `Branch_ID`, `Theater_Type`) VALUES
(1, 1, 1, 'STD'),
(2, 2, 1, 'STD'),
(3, 3, 1, 'STD'),
(4, 4, 1, '3DM'),
(5, 5, 1, '3DM'),
(6, 6, 1, '3DM'),
(7, 7, 1, '4DX'),
(8, 8, 1, '4DX'),
(9, 9, 1, '4DX'),
(10, 10, 1, 'DIG'),
(11, 11, 1, 'DIG'),
(12, 12, 1, 'DIG'),
(13, 1, 2, 'STD'),
(14, 2, 2, 'STD'),
(15, 3, 2, 'STD'),
(16, 4, 2, 'STD'),
(17, 5, 2, 'STD'),
(18, 6, 2, 'STD'),
(19, 7, 2, 'STD'),
(20, 8, 2, 'STD'),
(21, 9, 2, 'STD'),
(22, 10, 2, 'STD'),
(23, 11, 2, 'STD'),
(24, 12, 2, 'STD'),
(25, 1, 3, 'STD'),
(26, 2, 3, 'STD'),
(27, 3, 3, 'STD'),
(28, 4, 3, 'STD'),
(29, 5, 3, 'STD'),
(30, 6, 3, 'STD'),
(31, 7, 3, 'STD'),
(32, 8, 3, 'STD'),
(33, 9, 3, '3DM'),
(34, 10, 3, '3DM'),
(35, 11, 3, '3DM'),
(36, 12, 3, '3DM');

-- --------------------------------------------------------

--
-- Table structure for table `ticketbooking`
--

CREATE TABLE `ticketbooking` (
  `Booking_ID` int(6) NOT NULL COMMENT 'six digit integer ID for movie ticket booking',
  `MovieDateTime` datetime NOT NULL COMMENT 'date and time for the movie booked',
  `DateTime` datetime NOT NULL COMMENT 'date and time for when the booking was made',
  `PaymentMethod` enum('CASH','DEBIT','CREDIT','ONLINE') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'method of payment !!changed from the ER diagram',
  `Cost` int(11) NOT NULL COMMENT 'the amount of money paid in the given booking',
  `Member_ID` int(6) DEFAULT NULL COMMENT 'six-digit member id for person booking',
  `Theater_ID` int(6) NOT NULL COMMENT 'six digit integer ID for theater',
  `Discount_ID` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'discount id if applicable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticketbooking`
--

INSERT INTO `ticketbooking` (`Booking_ID`, `MovieDateTime`, `DateTime`, `PaymentMethod`, `Cost`, `Member_ID`, `Theater_ID`, `Discount_ID`) VALUES
(1, '2020-05-06 18:00:00', '2020-05-06 19:19:41', 'CASH', 600, NULL, 13, NULL),
(2, '2020-05-06 18:00:00', '2020-05-06 19:37:24', 'CASH', 400, NULL, 13, NULL),
(3, '2020-05-06 18:00:00', '2020-05-06 19:38:17', 'CASH', 1200, 1, 15, 'FREE4ALL'),
(4, '2020-05-06 18:00:00', '2020-05-06 19:51:48', 'CASH', 600, NULL, 17, 'TESTCODE'),
(5, '2020-05-06 18:00:00', '2020-05-06 19:56:38', 'CASH', 400, 1, 14, NULL),
(6, '2020-05-08 16:00:00', '2020-05-07 14:14:15', 'CASH', 600, 1, 1, NULL),
(7, '2020-05-11 16:00:00', '2020-05-09 08:39:28', 'CASH', 400, 1, 1, 'FREE4ALL'),
(8, '2020-05-30 16:00:00', '2020-05-16 07:24:00', 'CASH', 600, NULL, 24, 'TESTCODE'),
(9, '2020-06-01 16:00:00', '2020-05-16 16:05:33', 'CASH', 800, NULL, 13, NULL),
(10, '2020-05-30 16:00:00', '2020-05-17 09:55:20', 'CASH', 600, NULL, 24, NULL),
(11, '2020-05-30 16:00:00', '2020-05-17 12:27:59', 'CASH', 1000, NULL, 24, NULL),
(12, '2020-05-30 16:00:00', '2020-05-17 12:29:37', 'CASH', 1000, NULL, 24, NULL),
(13, '2020-05-30 16:00:00', '2020-05-17 18:23:22', 'CASH', 800, 1, 24, NULL),
(14, '2020-05-20 16:00:00', '2020-05-18 11:21:23', 'CASH', 1200, NULL, 13, NULL),
(15, '2020-05-20 16:00:00', '2020-05-18 11:24:36', 'CASH', 1200, NULL, 14, NULL),
(16, '2020-05-20 16:00:00', '2020-05-18 11:29:53', 'CASH', 1200, NULL, 14, NULL),
(17, '2020-05-20 16:00:00', '2020-05-18 11:36:01', 'CASH', 800, 1, 13, NULL),
(18, '2020-05-20 16:00:00', '2020-05-18 11:38:31', 'DEBIT', 1200, 1, 14, NULL),
(19, '2020-05-25 17:00:00', '2020-05-18 14:12:40', 'CASH', 600, 1, 15, NULL),
(20, '2020-06-13 15:15:00', '2020-05-18 17:16:59', 'CASH', 800, 1, 33, NULL),
(21, '2020-06-08 15:20:00', '2020-05-18 17:18:22', 'CASH', 1000, 1, 35, NULL),
(22, '2020-06-07 17:10:00', '2020-05-18 17:19:37', 'CREDIT', 1500, 1, 13, NULL),
(23, '2020-06-07 17:10:00', '2020-05-18 17:20:25', 'CASH', 600, 1, 13, NULL),
(24, '2020-06-06 10:20:00', '2020-05-18 17:20:55', 'CASH', 800, 1, 17, NULL),
(25, '2020-06-11 15:30:00', '2020-05-18 17:21:18', 'CASH', 600, 1, 21, NULL),
(26, '2020-06-09 10:30:00', '2020-05-18 17:21:55', 'CASH', 600, 1, 21, NULL),
(27, '2020-06-11 11:00:00', '2020-05-18 17:22:19', 'CASH', 600, 1, 35, NULL),
(28, '2020-05-20 16:00:00', '2020-05-18 17:24:18', 'DEBIT', 600, 1, 13, NULL),
(29, '2020-06-07 14:40:00', '2020-05-18 17:25:59', 'CASH', 200, 1, 25, NULL),
(30, '2020-06-11 17:40:00', '2020-05-18 17:26:24', 'CASH', 800, 1, 15, NULL),
(31, '2020-05-31 02:20:00', '2020-05-18 17:29:28', 'CASH', 1200, 1, 31, NULL),
(32, '2020-06-01 13:50:00', '2020-05-18 17:30:13', 'DEBIT', 400, 1, 31, NULL),
(33, '2020-05-28 10:40:00', '2020-05-18 17:30:59', 'CASH', 600, 1, 20, NULL),
(34, '2020-05-26 11:40:00', '2020-05-18 17:33:27', 'CASH', 600, 1, 33, NULL),
(35, '2020-06-02 20:30:00', '2020-05-18 17:34:28', 'CASH', 400, 1, 34, NULL),
(36, '2020-05-26 16:15:00', '2020-05-18 17:35:52', 'CREDIT', 2000, 1, 36, NULL),
(37, '2020-06-04 20:10:00', '2020-05-18 17:36:19', 'CASH', 800, 1, 17, NULL),
(38, '2020-05-26 11:40:00', '2020-05-18 17:39:09', 'CASH', 800, 1, 32, NULL),
(39, '2020-06-04 20:10:00', '2020-05-18 17:39:50', 'DEBIT', 600, 1, 17, NULL),
(40, '2020-06-09 10:55:00', '2020-05-18 17:43:50', 'CASH', 600, NULL, 33, NULL),
(41, '2020-05-20 16:00:00', '2020-05-18 17:44:21', 'CASH', 200, NULL, 13, NULL),
(42, '2020-06-01 00:15:00', '2020-05-18 17:45:05', 'CASH', 600, NULL, 35, NULL),
(43, '2020-06-11 17:40:00', '2020-05-18 17:45:24', 'CASH', 600, NULL, 15, NULL),
(44, '2020-06-07 17:10:00', '2020-05-18 17:45:45', 'CASH', 600, NULL, 13, NULL),
(45, '2020-06-10 16:00:00', '2020-05-18 17:46:09', 'CASH', 1600, NULL, 31, NULL),
(46, '2020-06-11 15:30:00', '2020-05-18 17:46:28', 'CASH', 400, NULL, 21, NULL),
(47, '2020-06-11 11:00:00', '2020-05-18 17:47:37', 'DEBIT', 400, NULL, 35, NULL),
(48, '2020-06-05 19:10:00', '2020-05-18 17:47:57', 'CASH', 600, NULL, 24, NULL),
(49, '2020-05-29 00:15:00', '2020-05-18 17:48:35', 'CASH', 400, NULL, 17, NULL),
(50, '2020-05-20 16:00:00', '2020-05-18 18:20:48', 'CASH', 600, NULL, 14, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `validdiscount`
--

CREATE TABLE `validdiscount` (
  `Discount_ID` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'discount id for discount entry is referring to',
  `Branch_ID` int(6) NOT NULL COMMENT 'branch this discount is valid at'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `validdiscount`
--

INSERT INTO `validdiscount` (`Discount_ID`, `Branch_ID`) VALUES
('DISCOUNT', 1),
('FREE4ALL', 1),
('FREEEEE', 1),
('FRI50', 1),
('TESTING', 1),
('DISCOUNT', 2),
('FRI50', 2),
('TESTCODE', 2),
('TESTING', 2),
('DISCOUNT', 3),
('TESTCODE', 3),
('TESTING', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinemabranch`
--
ALTER TABLE `cinemabranch`
  ADD PRIMARY KEY (`Branch_ID`),
  ADD KEY `Manager` (`Manager_ID`);

--
-- Indexes for table `clockinout`
--
ALTER TABLE `clockinout`
  ADD PRIMARY KEY (`Employee_ID`,`DateTime`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`Discount_ID`);

--
-- Indexes for table `employeeevaluation`
--
ALTER TABLE `employeeevaluation`
  ADD PRIMARY KEY (`Employee_ID`,`DateTime`,`Manager_ID`),
  ADD KEY `EvaluationManager` (`Manager_ID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Employee_ID`),
  ADD KEY `Position` (`Position_ID`),
  ADD KEY `LoginEmail` (`Email`),
  ADD KEY `EmployeeBranch` (`Branch_ID`);

--
-- Indexes for table `expenseitems`
--
ALTER TABLE `expenseitems`
  ADD KEY `ItemExpenseID` (`Expense_ID`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`Expense_ID`),
  ADD KEY `SpendingManager` (`Manager_ID`);

--
-- Indexes for table `filmrolls`
--
ALTER TABLE `filmrolls`
  ADD PRIMARY KEY (`Roll_ID`),
  ADD KEY `FilmRollMovie` (`Movie_ID`),
  ADD KEY `FilmRollBranch` (`Branch_ID`),
  ADD KEY `FilmRollExpense` (`Expense_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `itemsold`
--
ALTER TABLE `itemsold`
  ADD PRIMARY KEY (`TransactionID`,`ItemID`),
  ADD KEY `Item` (`ItemID`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`Job_ID`),
  ADD KEY `MaintenanceEmployee` (`Employee_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_ID`),
  ADD UNIQUE KEY `EmployeeEmail` (`Email`),
  ADD KEY `MemberBranch` (`RegisterBranch_ID`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `DiscountCode` (`Discount_ID`),
  ADD KEY `Member` (`Member_ID`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`Movie_ID`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`Position_ID`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`Theater_ID`,`DateTime`,`Seat_No`),
  ADD KEY `SeatShowtime_Theater` (`DateTime`),
  ADD KEY `Seat_No` (`Seat_No`),
  ADD KEY `SeatBooking` (`Booking_ID`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`DateTime`,`Theater_ID`),
  ADD KEY `ShowingRoll` (`Roll_ID`),
  ADD KEY `ShowingTheater` (`Theater_ID`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`Theater_ID`),
  ADD KEY `TheaterBranch` (`Branch_ID`);

--
-- Indexes for table `ticketbooking`
--
ALTER TABLE `ticketbooking`
  ADD PRIMARY KEY (`Booking_ID`),
  ADD KEY `BookingDateTime` (`MovieDateTime`),
  ADD KEY `BookingTheater` (`Theater_ID`),
  ADD KEY `Discount` (`Discount_ID`),
  ADD KEY `BookingMember` (`Member_ID`);

--
-- Indexes for table `validdiscount`
--
ALTER TABLE `validdiscount`
  ADD PRIMARY KEY (`Discount_ID`,`Branch_ID`),
  ADD KEY `ValidBranch` (`Branch_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cinemabranch`
--
ALTER TABLE `cinemabranch`
  MODIFY `Branch_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for specific branch', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `Employee_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for employee', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `Expense_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'a six digit integer for a given expense', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `filmrolls`
--
ALTER TABLE `filmrolls`
  MODIFY `Roll_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for specific roll', AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for item', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `Job_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'id identifying specific job', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Member_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer id for member', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `TransactionID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for transaction', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `Movie_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for movie', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `Position_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for the position', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `Theater_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for theater', AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ticketbooking`
--
ALTER TABLE `ticketbooking`
  MODIFY `Booking_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'six digit integer ID for movie ticket booking', AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cinemabranch`
--
ALTER TABLE `cinemabranch`
  ADD CONSTRAINT `Manager` FOREIGN KEY (`Manager_ID`) REFERENCES `employees` (`Employee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clockinout`
--
ALTER TABLE `clockinout`
  ADD CONSTRAINT `ClockingEmployee` FOREIGN KEY (`Employee_ID`) REFERENCES `employees` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `employeeevaluation`
--
ALTER TABLE `employeeevaluation`
  ADD CONSTRAINT `EvaluationEmployee` FOREIGN KEY (`Employee_ID`) REFERENCES `employees` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `EvaluationManager` FOREIGN KEY (`Manager_ID`) REFERENCES `employees` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `EmployeeBranch` FOREIGN KEY (`Branch_ID`) REFERENCES `cinemabranch` (`Branch_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `Position` FOREIGN KEY (`Position_ID`) REFERENCES `positions` (`Position_ID`);

--
-- Constraints for table `expenseitems`
--
ALTER TABLE `expenseitems`
  ADD CONSTRAINT `ItemExpenseID` FOREIGN KEY (`Expense_ID`) REFERENCES `expenses` (`Expense_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `SpendingManager` FOREIGN KEY (`Manager_ID`) REFERENCES `employees` (`Employee_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `filmrolls`
--
ALTER TABLE `filmrolls`
  ADD CONSTRAINT `FilmRollBranch` FOREIGN KEY (`Branch_ID`) REFERENCES `cinemabranch` (`Branch_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FilmRollExpense` FOREIGN KEY (`Expense_ID`) REFERENCES `expenses` (`Expense_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FilmRollMovie` FOREIGN KEY (`Movie_ID`) REFERENCES `movie` (`Movie_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `itemsold`
--
ALTER TABLE `itemsold`
  ADD CONSTRAINT `Item` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ParentTransaction` FOREIGN KEY (`TransactionID`) REFERENCES `merchandise` (`TransactionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `MaintenanceEmployee` FOREIGN KEY (`Employee_ID`) REFERENCES `employees` (`Employee_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `MemberBranch` FOREIGN KEY (`RegisterBranch_ID`) REFERENCES `cinemabranch` (`Branch_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD CONSTRAINT `DiscountCode` FOREIGN KEY (`Discount_ID`) REFERENCES `discount` (`Discount_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `Member` FOREIGN KEY (`Member_ID`) REFERENCES `member` (`Member_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `SeatBooking` FOREIGN KEY (`Booking_ID`) REFERENCES `ticketbooking` (`Booking_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SeatShowtime_DateTime` FOREIGN KEY (`Theater_ID`) REFERENCES `showtimes` (`Theater_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SeatShowtime_Theater` FOREIGN KEY (`DateTime`) REFERENCES `showtimes` (`DateTime`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SeatTheater` FOREIGN KEY (`Theater_ID`) REFERENCES `theater` (`Theater_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `ShowingRoll` FOREIGN KEY (`Roll_ID`) REFERENCES `filmrolls` (`Roll_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ShowingTheater` FOREIGN KEY (`Theater_ID`) REFERENCES `theater` (`Theater_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `theater`
--
ALTER TABLE `theater`
  ADD CONSTRAINT `TheaterBranch` FOREIGN KEY (`Branch_ID`) REFERENCES `cinemabranch` (`Branch_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `ticketbooking`
--
ALTER TABLE `ticketbooking`
  ADD CONSTRAINT `BookingMember` FOREIGN KEY (`Member_ID`) REFERENCES `member` (`Member_ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `Discount` FOREIGN KEY (`Discount_ID`) REFERENCES `discount` (`Discount_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `validdiscount`
--
ALTER TABLE `validdiscount`
  ADD CONSTRAINT `DiscountCode1` FOREIGN KEY (`Discount_ID`) REFERENCES `discount` (`Discount_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ValidBranch` FOREIGN KEY (`Branch_ID`) REFERENCES `cinemabranch` (`Branch_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
