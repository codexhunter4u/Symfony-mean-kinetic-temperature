-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2022 at 11:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comakeit`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221031171615', '2022-10-31 23:05:21', 104);

-- --------------------------------------------------------

--
-- Table structure for table `mean_kinetic_temperature`
--

CREATE TABLE `mean_kinetic_temperature` (
  `id` int(11) NOT NULL,
  `data_set_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_energy` decimal(5,2) NOT NULL,
  `kinetic_temperature` decimal(5,2) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mean_kinetic_temperature`
--

INSERT INTO `mean_kinetic_temperature` (`id`, `data_set_name`, `activation_energy`, `kinetic_temperature`, `ip`, `created_at`) VALUES
(20, 'sample.xlsx', '83.14', '60.43', '::1', '2022-11-01 09:45:18'),
(21, 'sample.xlsx', '83.14', '60.43', '::1', '2022-11-01 10:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temperature_details`
--

CREATE TABLE `temperature_details` (
  `id` int(11) NOT NULL,
  `kinetic_temperature_id` int(11) NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temperature_details`
--

INSERT INTO `temperature_details` (`id`, `kinetic_temperature_id`, `time`, `temperature`) VALUES
(1, 20, '10:10:00', '28.00'),
(2, 20, '10:12:00', '24.00'),
(3, 20, '10:15:00', '32.00'),
(4, 20, '10:20:00', '33.00'),
(5, 20, '10:40:00', '23.00'),
(6, 20, '10:50:00', '88.00'),
(7, 20, '11:10:00', '19.00'),
(8, 20, '11:30:00', '20.00'),
(9, 20, '11:40:00', '20.00'),
(10, 20, '12:01:00', '77.00'),
(11, 20, '12:24:00', '66.00'),
(12, 20, '12:30:00', '27.00'),
(13, 20, '12:40:00', '25.00'),
(14, 20, '14:45:00', '24.00'),
(15, 20, '16:50:00', '26.00'),
(16, 21, '10:10:00', '28.00'),
(17, 21, '10:12:00', '24.00'),
(18, 21, '10:15:00', '32.00'),
(19, 21, '10:20:00', '33.00'),
(20, 21, '10:40:00', '23.00'),
(21, 21, '10:50:00', '88.00'),
(22, 21, '11:10:00', '19.00'),
(23, 21, '11:30:00', '20.00'),
(24, 21, '11:40:00', '20.00'),
(25, 21, '12:01:00', '77.00'),
(26, 21, '12:24:00', '66.00'),
(27, 21, '12:30:00', '27.00'),
(28, 21, '12:40:00', '25.00'),
(29, 21, '14:45:00', '24.00'),
(30, 21, '16:50:00', '26.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mean_kinetic_temperature`
--
ALTER TABLE `mean_kinetic_temperature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `temperature_details`
--
ALTER TABLE `temperature_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7042E4B8C20B656C` (`kinetic_temperature_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mean_kinetic_temperature`
--
ALTER TABLE `mean_kinetic_temperature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temperature_details`
--
ALTER TABLE `temperature_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `temperature_details`
--
ALTER TABLE `temperature_details`
  ADD CONSTRAINT `FK_7042E4B8C20B656C` FOREIGN KEY (`kinetic_temperature_id`) REFERENCES `mean_kinetic_temperature` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
