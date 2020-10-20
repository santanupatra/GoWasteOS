-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2020 at 01:00 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `view_id` varchar(255) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
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

INSERT INTO `bookings` (`id`, `view_id`, `booking_date`, `booking_time`, `service_provider_id`, `customer_id`, `service_provided_city_id`, `service_loaction`, `service_id`, `service_charge`, `service_status`, `payment_status`, `is_active`, `created_date`) VALUES
(1, 'BOOK0001', '2020-10-20', '07:05:00', '4', '5', '2', 'vvvvvvvvvvvv', '4', '249.99', 'P', 1, 1, '2020-10-20 07:07:29');

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
(2, 'kolkata', 1, '2020-10-14 18:16:43');

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
(1, '1', 'BOOK0001', 249.99, 0.00, 249.99, 'Cent', 'XXXXX-XXXX-XXXX', '1', 0, 1, '2020-10-20 07:07:29');

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
  `type` enum('C','SP','A') DEFAULT 'C' COMMENT 'C=Customer, SP= Service Provider, A=Admin',
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `view_id`, `type`, `firstName`, `lastName`, `email`, `password`, `address`, `city_id`, `phoneNumber`, `profilePicture`, `isAdmin`, `isActive`, `isDeleted`, `createdDate`) VALUES
(1, NULL, 'A', 'Admin', NULL, 'admin@admin.com', '$2y$10$N9Hynmn2J4i.h/XdmHUS9OaZivRz/QV5SWu05y134iSPAuDoKG21S', NULL, '', NULL, 'userImg/5f8d61043429d.png', 1, 1, 0, '2020-10-15 20:28:33'),
(3, NULL, 'C', 'Sarmistha', 'Ghosh', 'sonali.bhaumik@cbnits.com', NULL, NULL, '', '1234567', 'userImg/5f8952a7c21ab.jpg', 0, 1, 0, '2020-10-15 15:24:41'),
(4, NULL, 'SP', 'Sonali', NULL, 'sonali.bhaumik2@cbnits.com', NULL, NULL, '', '1234567', 'userImg/5f89534773479.jpg', 0, 1, 0, '2020-10-15 17:24:05'),
(5, NULL, 'C', 'Sarmistha', 'Ghosh', 'sonali.bhaumikm@cbnits.com', NULL, NULL, '', '1234567', '', 0, 1, 0, '2020-10-19 05:55:28'),
(6, NULL, 'SP', 'test', 'User', 'sonali.bhaumik2saas@cbnits.com', NULL, NULL, '', '1234567', '', 0, 1, 0, '2020-10-19 06:04:19'),
(7, NULL, 'SP', 'kolkata', NULL, 'sonali.bhaumikmm1@cbnits.com', NULL, NULL, '', '1234567', '', 0, 1, 0, '2020-10-19 06:05:17'),
(8, NULL, 'SP', 'check', NULL, 'sonali.bhaumixxk2@cbnits.com', NULL, NULL, '', '1234567', 'userImg/5f8d9de543d4f.jpg', 0, 1, 0, '2020-10-19 14:08:37');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
