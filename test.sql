-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2018 at 09:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_magazines`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_issues`
--

CREATE TABLE `ci_issues` (
  `issue_id` int(10) UNSIGNED NOT NULL,
  `publication_id` int(10) UNSIGNED NOT NULL,
  `issue_number` int(10) UNSIGNED NOT NULL,
  `issue_date_publication` date NOT NULL,
  `issue_cover` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_publications`
--

CREATE TABLE `ci_publications` (
  `publication_id` int(10) UNSIGNED NOT NULL,
  `publication_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_issues`
--
ALTER TABLE `ci_issues`
  ADD PRIMARY KEY (`issue_id`),
  ADD KEY `fk_publishing_id` (`publication_id`);

--
-- Indexes for table `ci_publications`
--
ALTER TABLE `ci_publications`
  ADD PRIMARY KEY (`publication_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ci_issues`
--
ALTER TABLE `ci_issues`
  MODIFY `issue_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ci_publications`
--
ALTER TABLE `ci_publications`
  MODIFY `publication_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ci_issues`
--
ALTER TABLE `ci_issues`
  ADD CONSTRAINT `fk_publishing_id` FOREIGN KEY (`publication_id`) REFERENCES `ci_publications` (`publication_id`);
COMMIT;

INSERT INTO `ci_publications` (`publication_id`, `publication_name`) VALUES
(1, 'Gollapudi veeraswami son'),
(2, 'S chand publication'),
(3, 'Mc donalds'),
(4, 'times of india');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;