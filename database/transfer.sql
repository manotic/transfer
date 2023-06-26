-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 11:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` bigint(5) NOT NULL,
  `region_id` bigint(5) NOT NULL,
  `district` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `region_id`, `district`) VALUES
(1, 1, 'Ilala'),
(2, 1, 'Kigamboni'),
(3, 1, 'Kinondoni'),
(4, 1, 'Temeke'),
(5, 1, 'Ubungo'),
(11, 2, 'Morogoro mjini'),
(12, 2, 'Morogoro vijijini'),
(13, 2, 'Mvomero'),
(14, 2, 'Kilosa'),
(15, 2, 'Kilombero'),
(16, 2, 'Ulanga'),
(17, 2, 'Malinyi'),
(18, 2, 'Gairo'),
(19, 3, 'Busekelo'),
(20, 3, 'Chunya'),
(21, 3, 'Kyela'),
(22, 3, 'Mbarali'),
(23, 3, 'Mbeya mjini'),
(24, 3, 'Mbeya vijijini'),
(25, 3, 'Rungwe'),
(26, 13, 'Kasulu'),
(27, 13, 'Kigoma mjini'),
(29, 13, 'Kibondo'),
(30, 13, 'Manyovu');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` bigint(5) NOT NULL,
  `region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`region_id`, `region`) VALUES
(1, 'Dar Es Salaam'),
(2, 'Morogoro'),
(3, 'Mbeya'),
(13, 'Kigoma');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` bigint(5) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `student_class` varchar(50) NOT NULL,
  `cur_school` varchar(100) NOT NULL,
  `cur_region` bigint(5) NOT NULL,
  `cur_district` bigint(5) NOT NULL,
  `tran_school` varchar(100) NOT NULL,
  `tran_region` bigint(5) NOT NULL,
  `tran_district` bigint(5) NOT NULL,
  `attach` varchar(50) NOT NULL,
  `parent_id` bigint(5) NOT NULL,
  `status` bigint(5) NOT NULL,
  `tran_level` bigint(5) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `set_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(5) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` bigint(5) NOT NULL,
  `region_id` bigint(5) DEFAULT NULL,
  `district_id` bigint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `region_id`, `district_id`) VALUES
(8, '', '', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
