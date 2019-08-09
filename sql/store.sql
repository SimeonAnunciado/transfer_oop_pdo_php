-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 12:29 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`, `branch`, `created_at`) VALUES
(1, 'bulacan', '$2y$10$sZVsYAzKaXk/Cx1/GG.ubuOKT25C7VrBpe8S/6y2EMHQG/SbFi2E.', 'bulacan', '2019-08-03 17:40:27'),
(2, 'novaliches', '$2y$10$mm40V9b8T8E54xSimDBsDeHBJQ9Qv4OuXtwqLLpBF9Dv5YJK2AQyO', 'novaliches', '2019-08-03 17:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_qtty` varchar(255) NOT NULL,
  `product_srp` varchar(255) NOT NULL,
  `product_branch` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `product_description`, `product_qtty`, `product_srp`, `product_branch`, `created_at`) VALUES
(18, 201979604, 'piatos', 'cheesy flavor', '15', '12', 'bulacan', '2019-08-04 01:31:29'),
(19, 201955004, 'chicharon bulaklak', 'test qwe', '15', '23', 'novaliches', '2019-08-04 01:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `store_branch`
--

CREATE TABLE `store_branch` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_branch`
--

INSERT INTO `store_branch` (`id`, `branch_name`, `created_at`) VALUES
(1, 'bulacan', '2019-08-03 21:20:36'),
(2, 'novaliches', '2019-08-03 21:20:36'),
(3, 'valenzuela', '2019-08-03 21:20:48'),
(4, 'pasig', '2019-08-03 21:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_transaction`
--

CREATE TABLE `transfer_transaction` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `from_branch` varchar(255) NOT NULL,
  `to_branch` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer_transaction`
--

INSERT INTO `transfer_transaction` (`id`, `product_code`, `from_branch`, `to_branch`, `status`, `created_at`) VALUES
(25, '201979604', 'novaliches', 'bulacan', 1, '2019-08-04 01:31:48'),
(26, '201955004', 'novaliches', 'bulacan', 0, '2019-08-04 01:35:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_branch`
--
ALTER TABLE `store_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_transaction`
--
ALTER TABLE `transfer_transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `store_branch`
--
ALTER TABLE `store_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfer_transaction`
--
ALTER TABLE `transfer_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
