-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 17, 2025 at 05:03 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `ID` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Issue Type` enum('Study Material Issues','Technical Issues','Security Issues','Others') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`ID`, `Email`, `Issue Type`) VALUES
('CID96434b', 'karnamfarha34@gmail.com', ''),
('CID393be4', 'afiakhanam26@gmail.com', ''),
('CID700afa', 'pinjarimohammedashraf@gmail.com', ''),
('CID136284', 'nidakhan1125@gmail.com', ''),
('CID434235', 'pinjariarshiya2727@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

DROP TABLE IF EXISTS `description`;
CREATE TABLE IF NOT EXISTS `description` (
  `ID` varchar(50) NOT NULL,
  `Issue Type` enum('Study Material Issue','Technical Issue','Security Issue','Others') NOT NULL,
  `Describe the Issue` text NOT NULL,
  KEY `fk_complaint` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`ID`, `Issue Type`, `Describe the Issue`) VALUES
('CID434235', 'Study Material Issue', 'Problem re-directing to links'),
('CID136284', 'Study Material Issue', 'Problem re-directing to links'),
('CID393be4', 'Study Material Issue', 'Problem re-directing to links'),
('CID96434b', 'Study Material Issue', 'Problem re-directing to links'),
('CID700afa', 'Security Issue', 'Login Issue');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
