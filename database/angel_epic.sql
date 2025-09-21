-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2025 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angel_epic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_pwd` varchar(10) DEFAULT NULL,
  `admin_time` int(50) DEFAULT NULL,
  `admin_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_pwd`, `admin_time`, `admin_status`) VALUES
(1, 'chagan@gmail.com', '123456', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(10) NOT NULL,
  `cat_nm` varchar(100) DEFAULT NULL,
  `cat_img` longtext DEFAULT NULL,
  `cat_time` varchar(100) DEFAULT NULL,
  `cat_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `c_id` int(10) NOT NULL,
  `c_fnm` varchar(100) DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_phone` varchar(10) DEFAULT NULL,
  `c_msg` longtext DEFAULT NULL,
  `c_time` varchar(100) DEFAULT NULL,
  `c_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `latest`
--

CREATE TABLE `latest` (
  `po_id` int(50) NOT NULL,
  `po_nm` varchar(100) DEFAULT NULL,
  `po_description` longtext DEFAULT NULL,
  `po_img` longtext DEFAULT NULL,
  `po_time` varchar(60) DEFAULT NULL,
  `po_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_cat` varchar(100) DEFAULT NULL,
  `p_nm` varchar(100) DEFAULT NULL,
  `p_price` int(50) DEFAULT NULL,
  `p_img` longtext DEFAULT NULL,
  `p_short_desc` longtext DEFAULT NULL,
  `p_weight` varchar(100) DEFAULT NULL,
  `p_description` longtext DEFAULT NULL,
  `p_add_info` longtext DEFAULT NULL,
  `p_time` varchar(60) DEFAULT NULL,
  `p_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `s_id` int(10) NOT NULL,
  `s_fnm` varchar(100) DEFAULT NULL,
  `s_email` varchar(100) DEFAULT NULL,
  `s_pwd` varchar(6) DEFAULT NULL,
  `s_time` varchar(50) DEFAULT NULL,
  `s_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`s_id`, `s_fnm`, `s_email`, `s_pwd`, `s_time`, `s_status`) VALUES
(1, 'Chagan Andani', 'chagan@gmail.com', '123456', '1758466761', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `o_id` int(4) NOT NULL,
  `o_fnm` varchar(100) DEFAULT NULL,
  `o_lnm` varchar(100) DEFAULT NULL,
  `o_country` varchar(100) DEFAULT NULL,
  `o_address_line1` longtext DEFAULT NULL,
  `o_address_line2` longtext DEFAULT NULL,
  `o_city` varchar(100) DEFAULT NULL,
  `o_state` varchar(100) DEFAULT NULL,
  `o_pincode` varchar(100) DEFAULT NULL,
  `o_phone` varchar(10) DEFAULT NULL,
  `o_email` varchar(100) DEFAULT NULL,
  `o_pid` longtext DEFAULT NULL,
  `o_uid` int(4) DEFAULT NULL,
  `o_order_key` varchar(100) DEFAULT NULL,
  `o_payment` varchar(255) DEFAULT NULL,
  `o_time` varchar(100) DEFAULT NULL,
  `o_status` varchar(10) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `latest`
--
ALTER TABLE `latest`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `latest`
--
ALTER TABLE `latest`
  MODIFY `po_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `o_id` int(4) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
