-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2020 at 01:07 PM
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
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `bannerTitle` varchar(255) DEFAULT NULL,
  `bannerContent` mediumtext,
  `bannerImage` varchar(255) DEFAULT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `bannerTitle`, `bannerContent`, `bannerImage`, `updatedDate`, `isActive`, `createdDate`) VALUES
(1, 'Home page header banner', '<h1>\r\n	Custom products, always manufactured with care</h1>\r\n', 'banner/5f7caab43f49f.png', NULL, 1, '2020-09-28 16:27:00'),
(2, 'Home page ', '<h3>\r\n	ADDITIVE MANUFACTURING / 3D PRINTING</h3>\r\n<p>\r\n	Create products that delight. Offer customization, variety, and personalized products to your customers.&nbsp;</p>\r\n', 'banner/5f720f22ae60f.jpg', NULL, 1, '2020-09-28 16:28:18'),
(3, 'Home page Contact form', '<p>\r\n	Contact form</p>\r\n', 'banner/5f7dd1f9157e1.JPG', NULL, 1, '2020-09-28 16:30:17'),
(4, 'Home page slider text', '<h3>\r\n	Any Shape Cookie Cutters</h3>\r\n<p>\r\n	Cadly helps @AnyShapeCookieCutters offer a huge library of cookie cutters through their Shopify page. Using plant-based plastic, an FDA-approved food safe coating, and careful processes, Cadly ships cookie cutters to customers across Canada.</p>\r\n', '', NULL, 1, '2020-09-29 19:06:40'),
(5, 'Disclaimer', '<p>\r\n	Cadly offers custom 3D design and printing services to be used in prototyping and specified end uses. Cadly Additive Inc. is not liable for any unauthorized use of products.</p>\r\n', '', NULL, 1, '2020-10-06 19:32:13'),
(6, 'Footer text', '<p>\r\n	Additive is changing the way products are made, and Cadly helps you apply this tech to your online business. Reach out today.</p>\r\n', '', NULL, 1, '2020-10-06 19:33:16');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `is_active`, `created_date`) VALUES
(2, 'kolkata', 1, '2020-10-14 18:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL,
  `pageName` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `orders` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `pageName`, `slug`, `content`, `orders`, `isActive`, `createdDate`) VALUES
(1, 'About Us', 'about-us', '<div class=\"col-md-5 about_image\">\r\n	<img alt=\"\" src=\"https://cdn.shopify.com/s/files/1/0250/1122/4623/files/img28_352x440.jpg?v=1589381457\" /></div>\r\n<div class=\"col-md-7 about-content\">\r\n	<p>\r\n		Cadly is a grassroots additive manufacturing company based in the tech hub of Waterloo, Ontario. In December 2019 we started getting requests from friends and family to print different items. We wanted to make them the absolute best products we could to show them the benefits of 3D printing. We were fascinated with the potential of the technology, and struck by how few people were actually using it as a means of production. After creating everything from custom logo coasters to face shields to prototype helmet clips, we got a pretty good sense of what products were well-suited to large scale production using this technology.</p>\r\n	<p>\r\n		Fast forward to today, and Cadly has kept the mission of creating awesome products that use the advantages of 3D printing. Now, we work with online brands looking to expand their product lines. Offering 3D printed items, running customized promotions, and social media giveaways are just some of the ways our partners have used additive to grow.</p>\r\n	<p>\r\n		We are a team that cares and puts 100% into every product. That won&#39;t change.&nbsp;</p>\r\n</div>\r\n', 1, 1, '2020-09-28 16:37:52'),
(2, 'Legal', 'legal', '<h2 class=\"page-title\">\r\n	Legal</h2>\r\n<div class=\"lefgal-content-area\">\r\n	<span>Media credit to: </span>\r\n	<ul>\r\n		<li>\r\n			https://l.messenger.com/l.php?u=https%3A%2F%2Fwww.flaticon.com%2Fauthors%2Fsmashicons&amp;h=AT26SQ_RF05JfkdoJZQjAMh0yZ5pT9p0Q_eip9oT-qpgCgBCM_MbMZ0o1ZUDG9n0ZyA0J5irhFvfvhwAMsiKwxDRC_JfvbqVCm9VxzBXcGqqE9Dkb6khmjQddPqm5BcE_bHmBz3kCqc</li>\r\n		<li>\r\n			https://l.messenger.com/l.php?u=https%3A%2F%2Fwww.flaticon.com%2F&amp;h=AT26SQ_RF05JfkdoJZQjAMh0yZ5pT9p0Q_eip9oT-qpgCgBCM_MbMZ0o1ZUDG9n0ZyA0J5irhFvfvhwAMsiKwxDRC_JfvbqVCm9VxzBXcGqqE9Dkb6khmjQddPqm5BcE_bHmBz3kCqc</li>\r\n		<li>\r\n			https://l.messenger.com/l.php?u=https%3A%2F%2Fwww.flaticon.com%2Fauthors%2Fnikita-golubev&amp;h=AT26SQ_RF05JfkdoJZQjAMh0yZ5pT9p0Q_eip9oT-qpgCgBCM_MbMZ0o1ZUDG9n0ZyA0J5irhFvfvhwAMsiKwxDRC_JfvbqVCm9VxzBXcGqqE9Dkb6khmjQddPqm5BcE_bHmBz3kCqc</li>\r\n		<li>\r\n			https://l.messenger.com/l.php?u=https%3A%2F%2Fwww.flaticon.com%2Fauthors%2Ffreepik&amp;h=AT26SQ_RF05JfkdoJZQjAMh0yZ5pT9p0Q_eip9oT-qpgCgBCM_MbMZ0o1ZUDG9n0ZyA0J5irhFvfvhwAMsiKwxDRC_JfvbqVCm9VxzBXcGqqE9Dkb6khmjQddPqm5BcE_bHmBz3kCqc</li>\r\n	</ul>\r\n</div>\r\n', 2, 1, '2020-09-30 18:15:15'),
(3, 'Products', 'product', '<div class=\"col-md-5 about_image\">\r\n	<img alt=\"\" src=\"http://scriptwebsolution.in/project/cadly/img/product-logo.png\" /></div>\r\n<div class=\"col-md-7 about-content\">\r\n	<p>\r\n		<strong>How do we make the best cookie cutter product every time?<br />\r\n		</strong></p>\r\n	<p>\r\n		Excellent industry and manufacturing partners, careful designs, and time/ care with post-processing.</p>\r\n	<p>\r\n		Making excellent plastic products requires careful execution at every stage from planning, to design, to testing, to production. We will work with you to find the product strategy that works best for you and your customers.&nbsp;</p>\r\n	<p>\r\n		Click the links below to see our cookie cutter partners.&nbsp;</p>\r\n	<p>\r\n		<a class=\"cmn-btn\" href=\"https://any-shape-cookie-cutters.myshopify.com\" target=\"_blank\">Any Shape Cookie Cutters</a>&nbsp;<a class=\"cmn-btn\" href=\"https://www.instagram.com/anyshapecookiecutters\" target=\"_blank\">Instagram Any Shape Cookie Cutters</a></p>\r\n	<p>\r\n		<a class=\"cmn-btn\" href=\"https://www.instagram.com/cadlycreations\" target=\"_blank\">Instagram Cadly Creations</a></p>\r\n</div>\r\n', 3, 1, '2020-10-01 18:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `comment` text,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text CHARACTER SET utf8,
  `answer` text CHARACTER SET utf8,
  `listOrder` int(11) DEFAULT NULL,
  `createDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `listOrder`, `createDate`, `isDeleted`, `isActive`) VALUES
(2, 'Where is Cadly located?', 'We operate out of Waterloo, Canada with shipping solutions across North America.', 1, '2020-09-30 04:07:06', NULL, 1),
(3, 'How can I create a new product?', 'Product ideas come from all over the place. We are happy to work with businesses that have an existing audience with a full product line, and individuals in the early stages of looking to sell products online.', 2, '2020-09-30 18:17:31', NULL, 1),
(4, 'How fast can orders be delivered?', 'This depends on certain factors including volume, print/post-processing time, and location. For more detail please email jquirke@cadly.ca', 3, '2020-09-30 18:17:58', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productTitle` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productTitle`, `slug`, `description`, `isActive`, `isDeleted`, `createdDate`) VALUES
(3, 'Baking', 'Baking', '<p>\r\n	Create custom cookie cutters and baking products with 3D printing. Perfect for home cooking, resale, or small businesses. We follow careful processes and apply FDA approved food safe coating for all baking products.&nbsp;</p>\r\n', 1, 0, '2020-09-29 19:38:09'),
(5, 'E-commerce', 'E-commerce', '<p>\r\n	Do you have a following on social media? Many influencers struggle to ID ways beyond advertising to grow their brand, and want a partner that is readily available and can be easily contacted. Instead of dropshipping from overseas with <strong>long wait times and no customer service</strong>, use additive to get awesome products to your audience. Whether your brand is focused on training aids, cookie cutters, or animal memes, we can help you offer relevant products that your following will love.&nbsp;</p>\r\n', 1, 0, '2020-09-30 18:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `originalpath` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `productId`, `originalpath`, `isActive`, `createdDate`) VALUES
(7, 1, 'productImg/01601490221.webp', 1, '2020-09-30 18:23:41'),
(8, 1, 'productImg/11601490221.jpg', 1, '2020-09-30 18:23:42'),
(9, 1, 'productImg/21601490222.jpg', 1, '2020-09-30 18:23:42'),
(10, 1, 'productImg/31601490222.jpg', 1, '2020-09-30 18:23:42'),
(11, 2, 'productImg/01601490334.jpg', 1, '2020-09-30 18:25:34'),
(12, 2, 'productImg/11601490335.jpg', 1, '2020-09-30 18:25:35'),
(13, 2, 'productImg/21601490335.png', 1, '2020-09-30 18:25:35'),
(14, 3, 'productImg/01601490529.jpg', 1, '2020-09-30 18:28:49'),
(15, 3, 'productImg/11601490530.jpg', 1, '2020-09-30 18:28:50'),
(16, 3, 'productImg/21601490530.jpg', 1, '2020-09-30 18:28:50'),
(17, 3, 'productImg/31601490530.jpg', 1, '2020-09-30 18:28:50'),
(18, 4, 'productImg/01601491121.jpg', 1, '2020-09-30 18:38:41'),
(19, 4, 'productImg/11601491121.jpg', 1, '2020-09-30 18:38:41'),
(20, 5, 'productImg/01601491346.jpg', 1, '2020-09-30 18:42:26'),
(21, 5, 'productImg/11601491347.jpg', 1, '2020-09-30 18:42:27'),
(22, 7, 'productImg/01602516959.jpg', 1, '2020-10-12 15:35:59');

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
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `content`, `image`, `isActive`, `createdDate`) VALUES
(2, '3D Printing', '3D-Printing', '3D printing or Additive Manufacturing is changing the way goods are produced. Using 3D printing you can offer customized products with branded logos, names, initials, or anything else. We help you find out how your online business can grow with 3D printing. ', 'banner/5f74c4a52d944.webp', 1, '2020-09-30 17:47:17'),
(3, '3D Design', '3D-Design', 'Before you can ship products, you need a CAD file to tell the printer what to make. This design process is as much art as it is science. We work closely with customers to ensure that these designs create products that the end-user will love. Reach out today for a free consultation and our design team will bring your product to life.', 'banner/5f74c4d5605f6.webp', 1, '2020-09-30 17:48:05'),
(4, 'Project Coordination', 'Project-Coordination', 'Creating a product from scratch is hard. With our team of experts that manage your 3D project start to finish, you can save significant time and resources. We will take you from design to prototype to production to get awesome new products on your online store that customers will love.', 'banner/5f74c50738c68.webp', 1, '2020-09-30 17:48:55');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `siteName` varchar(255) DEFAULT NULL,
  `siteEmail` varchar(255) DEFAULT NULL,
  `favIcon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebookUrl` varchar(255) DEFAULT NULL,
  `twitterUrl` varchar(255) DEFAULT NULL,
  `instagramUrl` varchar(255) DEFAULT NULL,
  `youtubeUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `siteEmail`, `favIcon`, `logo`, `phoneNumber`, `fax`, `address`, `facebookUrl`, `twitterUrl`, `instagramUrl`, `youtubeUrl`) VALUES
(1, 'Cadly', 'info@goWasteOs.com', 'siteLogo/5f70cc24013b7.png', 'siteLogo/5f70cc24012c2.png', '123456', '123456', 'KOlkata', 'https://www.facebook.com/cadlycreations', 'https://twitter.com/cadlycreations', 'https://www.instagram.com/cadlycreations', 'https://www.youtube.com/');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `title` text,
  `image` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `orderNumber` int(11) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `txnId` varchar(255) DEFAULT NULL,
  `paymentMethod` varchar(255) DEFAULT NULL,
  `paymentStatus` tinyint(1) DEFAULT NULL,
  `type` enum('normal','product') NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` enum('C','SP','A') DEFAULT 'C' COMMENT 'C=Customer, SP= Service Provider, A=Admin',
  `utype` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
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

INSERT INTO `users` (`id`, `type`, `utype`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `profilePicture`, `isAdmin`, `isActive`, `isDeleted`, `createdDate`) VALUES
(1, 'A', NULL, 'Sonali', NULL, 'admin@admin.com', '$2y$10$N9Hynmn2J4i.h/XdmHUS9OaZivRz/QV5SWu05y134iSPAuDoKG21S', NULL, NULL, 1, 1, 0, '2020-10-15 20:28:33'),
(3, 'C', NULL, 'Sarmistha', 'Ghosh', 'sonali.bhaumik@cbnits.com', NULL, '1234567', '', 0, 1, 0, '2020-10-15 15:24:41'),
(4, 'SP', NULL, 'Sonali', NULL, 'sonali.bhaumik2@cbnits.com', NULL, '1234567', '', 0, 1, 0, '2020-10-15 17:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT 'C' COMMENT 'C=Customer, SP= Service Provider, A=Admin',
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `createdDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users1`
--

INSERT INTO `users1` (`id`, `type`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `profilePicture`, `isAdmin`, `isActive`, `isDeleted`, `createdDate`) VALUES
(1, 'A', 'Sonali', 'Bhaumik', 'admin@admin.com', '$2y$10$N9Hynmn2J4i.h/XdmHUS9OaZivRz/QV5SWu05y134iSPAuDoKG21S', NULL, 'userImg/5f8732d627174.jpg', 1, 1, 0, '2020-09-27 22:57:08'),
(2, 'SP', 'Subha', 'Ghosh', 'wat.subhamoy@gmail.com', '$2y$10$GeMVxA4QANb.tHxAnisxceAblj42kjvgEwXC9SqhwQ.3dIPn7e7jy', '9851103612', NULL, 0, 1, 0, '2020-10-03 04:26:53'),
(3, 'C', 'sonali', 'bhaumik', 'sonali.bhaumik@cbnits.com', '$2y$10$N9Hynmn2J4i.h/XdmHUS9OaZivRz/QV5SWu05y134iSPAuDoKG21S', '1234567', NULL, 0, 1, 0, '2020-10-14 12:09:39'),
(4, 'C', 'Sonali', 'Saha', 'sonali.bhaumik1@cbnits.com', NULL, '1234567', 'userImg/5f8832de32043.jpg', 0, 1, 0, '2020-10-15 11:30:38'),
(8, 'C', 'Sarmistha', 'Ghosh', 'sonali.bhaumik2@cbnits.com', NULL, '1234567', '', 0, 1, 0, '2020-10-15 14:55:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
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
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
