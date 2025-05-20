-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2025 at 01:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesebm`
--
CREATE DATABASE IF NOT EXISTS `thesebm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `thesebm`;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `auteurs` varchar(255) NOT NULL,
  `soumis_par` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `doi` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `attestation` varchar(1023) NOT NULL,
  `publication` varchar(1023) NOT NULL,
  `rapport` varchar(1023) NOT NULL,
  `thesard_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `reference`, `titre`, `auteurs`, `soumis_par`, `lieu`, `doi`, `date`, `type`, `numero`, `volume`, `attestation`, `publication`, `rapport`, `thesard_id`) VALUES
(30, '123-123-1234', 'Vi quick cheatsheet reference', 'someone', 'Zakaria Bettar', 'usa', 'abc/123', '2002-05-01', 'Communication', '-', '-', 'uploads/attestations/vi_cheat_sheet.pdf', 'uploads/publications/vi_cheat_sheet.pdf', 'uploads/rapports/vi_cheat_sheet.pdf', 23),
(31, '098-45', 'Chapitre 4 Java', 'Benlangour', 'Zakaria Bettar', 'Fdaroo wa9ila', 'xyz-78/ac', '2024-09-04', 'Chapitre', '4', '-', 'uploads/attestations/Chapitre 4.pdf', 'uploads/publications/Chapitre 4.pdf', 'uploads/rapports/Chapitre 4.pdf', 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(16) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `password`, `role`, `active`) VALUES
(23, 'Zakaria', 'Bettar', 'zakster@tutamail.com', '$2y$10$r8ROdVv38dAZQSx1xHm6ZukQBvEAWZ2ByRY0Q/tFUtijrcAjbrWGe', 'thesard', 1),
(24, 'Said', 'Shehab', 'ss.89@gmail.com', '$2y$10$oMAIUM/rimfH98WPnFVaLuLO5z2sOBI3DtTlGcjN4ERPkLXQTyCM2', 'thesard', 1),
(25, 'Prof', 'DeProf', 'prof@prof.com', '$2y$10$zTHQEV7qPH1y3jVIzEIFsOtW7hEBZSINxdfanyxAPG6rkhFY0kfBC', 'professeur', 1),
(26, 'Lucas', 'Gage', 'lg@lg.lg', '$2y$10$wRlSk.TDgfP55mUR.V1L4uTTxiA95S6LfoQBiebTkFDgVO0Uz0fXy', 'thesard', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN_thesard_id` (`thesard_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `thesard_id` FOREIGN KEY (`thesard_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
