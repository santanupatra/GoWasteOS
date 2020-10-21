-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2020 at 07:55 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-19+ubuntu18.04.1+deb.sury.org+1

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

INSERT INTO `accounts` (`id`, `user_id`, `transaction_type`, `total_service_charge`, `municipality_charge`, `total_amount_transferred`, `booking_id`, `booking_view_id`, `is_active`, `created_date`) VALUES
(1, '17', 'C', '2500.00', '300.00', '2500.00', '1', 'BOOK0001', 1, '2020-10-21 14:20:30'),
(2, '18', 'D', '2500.00', '300.00', '2800.00', '1', 'BOOK0001', 1, '2020-10-21 14:20:30'),
(3, '17', 'C', '11250.00', '1350.00', '11250.00', '2', 'BOOK0002', 1, '2020-10-21 14:21:30'),
(4, '16', 'D', '11250.00', '1350.00', '12600.00', '2', 'BOOK0002', 1, '2020-10-21 14:21:30'),
(5, '15', 'C', '20000.00', '2400.00', '20000.00', '3', 'BOOK0003', 1, '2020-10-21 14:21:59'),
(6, '18', 'D', '20000.00', '2400.00', '22400.00', '3', 'BOOK0003', 1, '2020-10-21 14:21:59'),
(7, '15', 'C', '25000.00', '3000.00', '25000.00', '4', 'BOOK0004', 1, '2020-10-21 14:22:33'),
(8, '18', 'D', '25000.00', '3000.00', '28000.00', '4', 'BOOK0004', 1, '2020-10-21 14:22:33');

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
  `service_loaction` varchar(255) DEFAULT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `service_charge` decimal(10,2) DEFAULT NULL,
  `service_status` enum('P','C','C&R') NOT NULL DEFAULT 'P',
  `payment_status` tinyint(2) NOT NULL DEFAULT '0',
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `view_id`, `booking_date`, `booking_time`, `waste_size`, `service_provider_id`, `customer_id`, `service_provided_city_id`, `service_loaction`, `service_id`, `service_charge`, `service_status`, `payment_status`, `is_active`, `created_date`) VALUES
(1, 'BOOK0001', '2020-10-24', '10:00:00', '20', '17', '18', '1', 'Kolkata, West Bengal, India', '7', '125.00', 'P', 1, 1, '2020-10-21 14:20:30'),
(2, 'BOOK0002', '2020-10-26', '12:30:00', '50', '17', '16', '1', 'Kolkata, West Bengal, India', '6', '225.00', 'P', 1, 1, '2020-10-21 14:21:30'),
(3, 'BOOK0003', '2020-10-28', '11:00:00', '50', '15', '18', '1', 'Kolkata, West Bengal, India', '3', '400.00', 'P', 1, 1, '2020-10-21 14:21:59'),
(4, 'BOOK0004', '2020-10-29', '08:30:00', '50', '15', '18', '1', 'Kolkata, West Bengal, India', '5', '500.00', 'P', 1, 1, '2020-10-21 14:22:33');

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
(1, 'kolkata', 1, '2020-10-21 14:14:00'),
(2, 'Mumbai', 1, '2020-10-21 14:14:07'),
(3, 'Delhi', 1, '2020-10-21 14:14:14'),
(4, 'Pune', 1, '2020-10-21 14:14:20'),
(5, 'Hydrabad', 1, '2020-10-21 14:14:27'),
(6, 'Amritsar', 1, '2020-10-21 14:14:45');

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
(9, 'Manage Review', 'active');

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
(1, '1', 'BOOK0001', 2500.00, 300.00, 2800.00, 'Cent', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-21 14:20:30'),
(2, '2', 'BOOK0002', 11250.00, 1350.00, 12600.00, 'Cent', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-21 14:21:30'),
(3, '3', 'BOOK0003', 20000.00, 2400.00, 22400.00, 'Cent', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-21 14:21:59'),
(4, '4', 'BOOK0004', 25000.00, 3000.00, 28000.00, 'Cent', 'XXXXX-XXXX-XXXX', 'Cash', 1, 1, '2020-10-21 14:22:33');

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
  `is_active` tinyint(2) NOT NULL DEFAULT '1',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `to_id`, `from_id`, `rating`, `comment`, `is_active`, `created_date`) VALUES
(1, '18', '17', '5', 'good', 1, '2020-10-21 14:23:08'),
(2, '18', '15', '5', 'good!', 1, '2020-10-21 14:23:29'),
(3, '15', '16', '5', 'good!', 1, '2020-10-21 14:23:43'),
(4, '16', '18', '4', 'good!', 1, '2020-10-21 14:23:57');

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
  `isActive` tinyint(2) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `content`, `image`, `price`, `isActive`, `createdDate`) VALUES
(2, 'Disposal by Incineration', 'Disposal-by-Incineration', 'This process involves the burning of wastes in airtight incinerators. This process is cheap and very efficient as it reduces the size of the wastes by up to 95%. The by-products of incineration such as heat and ash can be used for energy creation and hydroponic purposes respectively. The energy can later be used to provide power in the industry. This method is commonly used for toxic and hazardous wastes.', 'service_image/5f8d52aa680f3.jpg', '500.00', 1, '2020-09-30 17:47:17'),
(3, 'Recycling and Reusing:', 'Recycling-and-Reusing', 'Recycling and reusing is another effective means of disposing of wastes. Wastes such as glass, rubber, plastic or wood can be transformed through industrial processing into other useful products that can be used again. You could also reuse items such as plastic bottles and paper bags instead of throwing them away. This will greatly reduce the amount of waste you have and also help you save money that you could have used to purchase new plastic bottles or paper bags.', 'service_image/5f8d526f164b5.png', '400.00', 1, '2020-09-30 17:48:05'),
(4, 'Vermicomposting', 'Vermicomposting', 'This is another type of waste disposal that involves the use of worms to help decompose wastes. A specific type of worms is used to feed on the wastes and digest them. This process not only helps with waste disposal but also helps improve soil nutrition. The excretion of the worms adds nutrients to the soil, this improves the quality of the soil leading to a better growth of plants.', 'service_image/5f8d522f50aef.jpg', '249.99', 1, '2020-09-30 17:48:55'),
(5, 'Biogas and Fertilizer Generation', 'Biogas-and-Fertilizer-Generation', 'Organic wastes can be used to create compost that will, later on, be decomposed naturally into nutrient-rich fertilizer. This is mostly used by farmers or homeowners with a large amount of organic waste. The type of fertilizer formed is advantageous to plants since it’s all organic. Biodegradable wastes can also be used to create biogas. Bio-degradation companies turn these wastes into biogas by using fungi and bacteria to decay the wastes. The biogas generated is later then used as fuel. This method is very efficient for organic and biodegradable wastes.', 'service_image/5f8d52042e097.jpg', '500.00', 1, '2020-10-19 08:27:58'),
(6, 'Hygienic Landfill', 'Hygienic-Landfill', 'This process involves non-recyclable wastes. The selected area of the landfill should have low levels of groundwater and should have non-porous soil. The area should not be prone to flooding too. A base first created to prevent harmful chemicals from reaching the water zone below. After that, the wastes are carefully separated and spread out on the protective base. Later on, layers of soil are spread on top of the waste and compacted. The Landfill area can then serve as a leisure ground or park at least until the wastes decompose. This could take up to more than 25 years hence no construction should take place in the landfill area', 'service_image/5f8d51cac70c8.jpg', '225.00', 1, '2020-10-19 08:40:39'),
(7, 'Disposal in Water Bodies', 'Disposal-in-Water-Bodies', 'Hazardous wastes such as radioactive substances are usually dumped into large water bodies such as oceans and seas. These type of toxic wastes sink deep into the water to avoid their contamination from reaching human beings.\r\n\r\nThe above 6 methods are so far the most effective and reliable methods to dispose of waste products. In addition to that, they are safe as they reduce the risk and chances of human and animal contamination.\r\n\r\nIf you’re looking for rubbish removal company in UK, you can contact 020 8099 9819 immediately, our team will arrive with Man and Van to collect wastes at your place.', '', '125.00', 1, '2020-10-19 08:50:23');

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
(1, 12.00, 'info@goWasteOs.com', '123456', 'KOlkata');

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
(14, NULL, 'SA', 'Sub', 'Admin', 'subadmin@gmail.com', '$2y$10$hOzCqwBBNkwryVhdicqsS.zeDtSzikjhG.LqiFJNXLllIkwnuIQAe', NULL, NULL, NULL, '(123) 456-7890', 'userImg/5f90420a88e31.png', '1,4,5,7,9', NULL, 1, 1, 0, '2020-10-21 14:13:30'),
(15, NULL, 'SP', 'sonali', 'bhaumik', 'sonali.bhaumik@cbnits.com', NULL, 'Milan Bazar, Samarpally, Krishnapur, Kestopur, Calcutta, West Bengal, India', '1', '', '(123) 456-7890', 'userImg/5f9042ac8f0cb.png', NULL, '5', 0, 1, 0, '2020-10-21 14:16:12'),
(16, NULL, 'C', 'Sharmistha', 'Ghosh', 'sharmistha.ghosh@cbnits.com', NULL, 'Paikpara, Calcutta, West Bengal, India', '1', NULL, '(123) 456-7890', 'userImg/5f9042ec8de32.png', NULL, '4', 0, 1, 0, '2020-10-21 14:17:16'),
(17, NULL, 'SP', 'asmita', NULL, 'asmita@gmail.com', NULL, 'Kolkata, West Bengal, India', '1', '', '(123) 456-7890', 'userImg/5f904343d9dbc.png', NULL, NULL, 0, 1, 0, '2020-10-21 14:18:43'),
(18, NULL, 'C', 'pausali', NULL, 'paushali@gmail.com', NULL, 'Kolkata, West Bengal, India', '1', NULL, '(123) 456-7890', 'userImg/5f904378dc056.png', NULL, '5', 0, 1, 0, '2020-10-21 14:19:36');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leftmenu_list`
--
ALTER TABLE `leftmenu_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
