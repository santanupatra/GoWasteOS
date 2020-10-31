-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2020 at 01:54 PM
-- Server version: 5.7.32-0ubuntu0.16.04.1
-- PHP Version: 7.1.33-21+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goWasteOs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `user_type` enum('C','SP') DEFAULT NULL,
  `transaction_type` enum('D','C') DEFAULT NULL COMMENT 'D=Debit, C=Credit',
  `total_service_charge` decimal(10,2) DEFAULT NULL,
  `municipality_charge` decimal(10,2) DEFAULT NULL,
  `total_amount_transferred` decimal(10,2) DEFAULT NULL,
  `booking_id` varchar(255) DEFAULT NULL,
  `booking_view_id` varchar(255) DEFAULT NULL,
  `is_active` tinyint(2) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `user_type`, `transaction_type`, `total_service_charge`, `municipality_charge`, `total_amount_transferred`, `booking_id`, `booking_view_id`, `is_active`, `created_date`) VALUES
(1, '17', 'SP', 'C', '30000.00', '3000.00', '30000.00', '1', 'BOOK0001', 1, '2020-10-31 08:16:09'),
(2, '18', 'C', 'D', '30000.00', '3000.00', '33000.00', '1', 'BOOK0001', 1, '2020-10-31 08:16:09'),
(3, '17', 'SP', 'C', '40000.00', '4000.00', '40000.00', '2', 'BOOK0002', 1, '2020-10-31 08:16:44'),
(4, '18', 'C', 'D', '40000.00', '4000.00', '44000.00', '2', 'BOOK0002', 1, '2020-10-31 08:16:44'),
(5, '15', 'SP', 'C', '33000.00', '3300.00', '33000.00', '3', 'BOOK0003', 1, '2020-10-31 08:17:18'),
(6, '16', 'C', 'D', '33000.00', '3300.00', '36300.00', '3', 'BOOK0003', 1, '2020-10-31 08:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `view_id` varchar(255) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `waste_size` varchar(255) DEFAULT NULL,
  `service_provider_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `service_provided_city_id` varchar(255) DEFAULT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `price_id` varchar(255) NOT NULL,
  `service_charge` decimal(10,2) DEFAULT NULL,
  `service_status` enum('P','C','C&R') NOT NULL DEFAULT 'P',
  `service_loaction` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(2) NOT NULL DEFAULT '0',
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `view_id`, `booking_date`, `booking_time`, `waste_size`, `service_provider_id`, `customer_id`, `service_provided_city_id`, `service_id`, `price_id`, `service_charge`, `service_status`, `service_loaction`, `payment_status`, `is_active`, `created_date`) VALUES
(1, 'BOOK0001', '2020-11-30', '13:44:00', '15,000 Liters', '17', '18', '3', '1', '4', '30000.00', 'P', 'Owerri Airport, Airport Road, Nigeria', 1, 1, '2020-10-31 08:16:09'),
(2, 'BOOK0002', '2020-11-01', '13:46:00', '10,000 Liters', '17', '18', '2', '1', '7', '40000.00', 'P', 'Orlu Junction, Ihiala-Orlu Road, Ihiala, Nigeria', 1, 1, '2020-10-31 08:16:44'),
(3, 'BOOK0003', '2020-11-19', '13:46:00', '6,000-7,500 Liters', '15', '16', '1', '1', '10', '33000.00', 'P', 'Okigwe Road, Owerri, Nigeria', 1, 1, '2020-10-31 08:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `is_active`, `created_date`) VALUES
(1, 'OKIGWE', 1, '2020-10-31 08:04:00'),
(2, 'ORLU', 1, '2020-10-31 08:04:08'),
(3, 'OWERRI', 1, '2020-10-31 08:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `leftmenu_list`
--

CREATE TABLE `leftmenu_list` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leftmenu_list`
--

INSERT INTO `leftmenu_list` (`id`, `name`, `status`) VALUES
(1, 'Manage Dashboard', 'active'),
(2, 'Manage Settings', 'active'),
(3, 'Manage Sub Admin', 'active'),
(4, 'Manage City', 'active'),
(5, 'Manage Service Provider', 'active'),
(6, 'Manage Customer', 'active'),
(7, 'Manage Service', 'active'),
(8, 'Manage Booking', 'active'),
(9, 'Manage Review', 'active'),
(10, 'Manage Account', 'active'),
(11, 'Manage Price', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(255) DEFAULT NULL,
  `booking_view_id` varchar(255) DEFAULT NULL,
  `service_charge` float(10,2) NOT NULL,
  `municipality_charge` float(10,2) NOT NULL,
  `total_amount` float(10,2) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(2) DEFAULT '0',
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `booking_view_id`, `service_charge`, `municipality_charge`, `total_amount`, `currency`, `transaction_id`, `payment_method`, `payment_status`, `is_active`, `createdDate`) VALUES
(1, '1', 'BOOK0001', 30000.00, 3000.00, 33000.00, 'NGN', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-31 08:16:09'),
(2, '2', 'BOOK0002', 40000.00, 4000.00, 44000.00, 'NGN', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-31 08:16:44'),
(3, '3', 'BOOK0003', 33000.00, 3300.00, 36300.00, 'NGN', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-31 08:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `service_id`, `city_id`, `size`, `price`, `category`, `is_active`, `created_date`) VALUES
(1, '1', '3', '4,000', 15000.00, 'A', 1, '2020-10-31 08:07:26'),
(2, '1', '3', '6,000-7,500', 25000.00, 'B', 1, '2020-10-31 08:08:14'),
(3, '1', '3', '10,000', 27000.00, 'C', 1, '2020-10-31 08:08:44'),
(4, '1', '3', '15,000', 30000.00, 'D', 1, '2020-10-31 08:09:08'),
(5, '1', '2', '4,000', 25000.00, 'A', 1, '2020-10-31 08:10:05'),
(6, '1', '2', '6,000-7,500', 33000.00, 'B', 1, '2020-10-31 08:10:46'),
(7, '1', '2', '10,000', 40000.00, 'C', 1, '2020-10-31 08:11:10'),
(8, '1', '2', '15,000', 40000.00, 'D', 1, '2020-10-31 08:11:34'),
(9, '1', '1', '4,000', 25000.00, 'A', 1, '2020-10-31 08:12:38'),
(10, '1', '1', '6,000-7,500', 33000.00, 'B', 1, '2020-10-31 08:13:00'),
(11, '1', '1', '10,000', 40000.00, 'C', 1, '2020-10-31 08:13:37'),
(12, '1', '1', '15,000', 40000.00, 'D', 1, '2020-10-31 08:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `to_id` varchar(255) DEFAULT NULL,
  `from_id` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `comment` text,
  `booking_id` varchar(255) DEFAULT NULL,
  `is_reviewer_customer` tinyint(2) DEFAULT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `to_id`, `from_id`, `rating`, `comment`, `booking_id`, `is_reviewer_customer`, `is_active`, `created_date`) VALUES
(1, '18', '17', '5', 'Good!', '1', 0, 1, '2020-10-31 08:19:44'),
(2, '17', '18', '5', 'Good!', '1', 1, 1, '2020-10-31 08:20:03'),
(3, '18', '17', '1', 'Bad!', '2', 0, 1, '2020-10-31 08:20:37'),
(4, '17', '18', '1', 'Bad!', '2', 1, 1, '2020-10-31 08:20:51'),
(5, '16', '15', '5', 'Good!', '3', 0, 1, '2020-10-31 08:21:07'),
(6, '15', '16', '5', 'Good!', '3', 1, 1, '2020-10-31 08:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `unit` enum('Tons','Liters') DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `isActive` tinyint(2) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `content`, `image`, `price`, `unit`, `city_id`, `isActive`, `createdDate`) VALUES
(1, 'SWERAGE MANAGEMENT', 'SWERAGE-MANAGEMENT', NULL, NULL, '0.00', 'Liters', '3,2,1', 1, '2020-10-31 08:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `municipalityCharge` float(10,2) DEFAULT '0.00',
  `siteEmail` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `municipalityCharge`, `siteEmail`, `phoneNumber`, `address`) VALUES
(1, 10.00, 'info@goWasteOs.com', '123456', 'KOlkata');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `view_id` varchar(255) DEFAULT NULL,
  `type` enum('C','SP','A','SA') DEFAULT 'C' COMMENT 'C=Customer, SP= Service Provider, A=Admin',
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `subadmin_access_ids` varchar(256) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `view_id`, `type`, `firstName`, `lastName`, `email`, `password`, `address`, `city_id`, `company_name`, `phoneNumber`, `profilePicture`, `subadmin_access_ids`, `rating`, `isAdmin`, `isActive`, `isDeleted`, `createdDate`) VALUES
(1, NULL, 'A', 'Admin', NULL, 'admin@admin.com', '$2y$10$N9Hynmn2J4i.h/XdmHUS9OaZivRz/QV5SWu05y134iSPAuDoKG21S', NULL, '', '', NULL, 'userImg/5f9042156e140.png', NULL, NULL, 1, 1, 0, '2020-10-15 20:28:33'),
(14, NULL, 'SA', 'Sub', 'Admin', 'subadmin@gmail.com', '$2y$10$hOzCqwBBNkwryVhdicqsS.zeDtSzikjhG.LqiFJNXLllIkwnuIQAe', NULL, NULL, NULL, '(123) 456-7890', 'userImg/5f90420a88e31.png', '1,4', NULL, 1, 1, 0, '2020-10-21 14:13:30'),
(15, NULL, 'SP', 'Sonali', 'Bhaumik', 'sonali.bhaumik@cbnits.com', NULL, 'Milan Bazar, Samarpally, Krishnapur, Kestopur, Calcutta, West Bengal, India', '1', '', '(123) 456-7890', 'userImg/5f9042ac8f0cb.png', NULL, '5', 0, 1, 0, '2020-10-21 14:16:12'),
(16, NULL, 'C', 'Sharmistha', 'Ghosh', 'sharmistha.ghosh@cbnits.com', NULL, 'Paikpara, Calcutta, West Bengal, India', '1', NULL, '(123) 456-7890', 'userImg/5f9042ec8de32.png', NULL, '5', 0, 1, 0, '2020-10-21 14:17:16'),
(17, NULL, 'SP', 'Asmita', 'Mukherjee', 'asmita@gmail.com', NULL, 'Kolkata, West Bengal, India', '1', 'testing the tester', '(123) 456-7890', 'userImg/5f904343d9dbc.png', NULL, '3', 0, 1, 0, '2020-10-21 14:18:43'),
(18, NULL, 'C', 'Pausali', 'Karmakar', 'paushali@gmail.com', NULL, 'Kolkata, West Bengal, India', '1', NULL, '(123) 456-7890', 'userImg/5f904378dc056.png', NULL, '3', 0, 1, 0, '2020-10-21 14:19:36'),
(19, NULL, 'SA', 'Dayo', 'aliyu', 'olagoaste@gmail.com', '$2y$10$vgl/7auBt2aMl2y8ouWpj.hdqdLdF13nnFXdCJEKwzSENvUCiOWmG', NULL, NULL, NULL, '(080) 375-894', '', '2', NULL, 1, 0, 0, '2020-10-26 09:20:56'),
(20, NULL, 'SP', 'Sonali', 'Saha', 's@gmail.com', '$2y$10$BcwvxdSpbN0B/M6BfxXYZusWskaktqMpGrSSbTij/V/xZzyhkQbJa', 'Kolkata, West Bengal, India', '1', 'test', '(123) 456-7890', '', NULL, NULL, 0, 0, 0, '2020-10-28 10:34:19'),
(22, NULL, 'C', 'sonali', 'mukherjee', 'sd@gmail.com', '$2y$10$o5DRtfi245f63kLxZEfMjuhMWNBza4uJWcUuRcc5JHJVGYDz8Nfn2', 'Kolobrzeg, Poland', '1', NULL, '(123) 456-7890', '', NULL, NULL, 0, 0, 0, '2020-10-28 10:39:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leftmenu_list`
--
ALTER TABLE `leftmenu_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leftmenu_list`
--
ALTER TABLE `leftmenu_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
