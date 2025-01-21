-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 08:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_reg`
--

CREATE TABLE `admin_reg` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_reg`
--

INSERT INTO `admin_reg` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `agent_reg`
--

CREATE TABLE `agent_reg` (
  `agent_id` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `agent_email` varchar(255) NOT NULL,
  `agent_pass` varchar(255) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_reg`
--

INSERT INTO `agent_reg` (`agent_id`, `agent_name`, `agent_email`, `agent_pass`, `branch_id`) VALUES
(1, 'Ahmad', 'ahmad@gmail.com', '$2y$10$mr.kxO6X0brfhIRBL79pAeSozRKD/uW9PFMXNOwSjPBo5kDL/RN9G', 1),
(2, 'Ahmad', 'ahmad@gmail.com', '$2y$10$mqCb6iZc4l29RynmLdYI6uReJTNLQ1oCvvWneHZ4.UTaFZ1lr9xhS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `bill_amount` int(11) NOT NULL,
  `bill_date` int(11) NOT NULL,
  `cretedby` varchar(255) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `reciver_name` varchar(255) NOT NULL,
  `reciver_emil` varchar(255) NOT NULL,
  `reciver_address` varchar(255) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `branch_address`) VALUES
(1, 'Johar Branch', 'Block 6 Johar Karachi, Pakistan'),
(2, 'UP Branch', 'Block 2 UP Karachi, Pakistan'),
(3, 'Surjani Branch', 'Block 4 Surjani Town Karachi, Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `courier_id` int(11) NOT NULL,
  `sender_cnic` int(15) NOT NULL,
  `receiver_cnic` int(15) NOT NULL,
  `delivery_date` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`courier_id`, `sender_cnic`, `receiver_cnic`, `delivery_date`, `status`, `agent_id`, `branch_id`) VALUES
(3, 2147483647, 2147483647, '2024-08-31', 'Pending', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_reg`
--

CREATE TABLE `customer_reg` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_cnic` int(15) NOT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_pass` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_reg`
--

INSERT INTO `customer_reg` (`customer_id`, `customer_name`, `customer_cnic`, `customer_address`, `customer_email`, `customer_pass`) VALUES
(1, 'Ali Ahmed', 2147483647, '456 Oak Street', 'ali.ahmed@example.com', 'password123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_reg`
--
ALTER TABLE `admin_reg`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `agent_reg`
--
ALTER TABLE `agent_reg`
  ADD PRIMARY KEY (`agent_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `courier_id` (`courier_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`courier_id`),
  ADD KEY `agent_id` (`agent_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `customer_reg`
--
ALTER TABLE `customer_reg`
  ADD PRIMARY KEY (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_reg`
--
ALTER TABLE `admin_reg`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agent_reg`
--
ALTER TABLE `agent_reg`
  MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `courier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_reg`
--
ALTER TABLE `customer_reg`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agent_reg`
--
ALTER TABLE `agent_reg`
  ADD CONSTRAINT `agent_reg_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `courier` (`courier_id`),
  ADD CONSTRAINT `bill_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer_reg` (`customer_id`);

--
-- Constraints for table `courier`
--
ALTER TABLE `courier`
  ADD CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agent_reg` (`agent_id`),
  ADD CONSTRAINT `courier_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
