-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2012 at 07:41 PM
-- Server version: 5.5.23
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `m8db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `name` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`name`, `title`, `description`, `location`, `id`) VALUES
('Admin', 'M8 Admin Panel', 'This the the location where you can edit various settings, and monitor the status of M8', '/Resources/Core/index.php', 1),
('AnotherTest', 'AnotherTest', 'No description currently', '/Resources/Site/Code/AnotherTest.php', 2),
('AnotherTestb', 'AnotherTestb', 'No description currently', '/Resources/Site/Code/AnotherTestb.php', 3),
('Test', 'Test', 'No description currently', '/Resources/Site/Code/Test.php', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` text NOT NULL,
  `hash` text NOT NULL,
  `level` int(11) NOT NULL,
  `sessionhash` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `hash`, `level`, `sessionhash`, `id`) VALUES
('admin', '$2a$15$p1sD941DBOS.aUqWiWJ39OUMfsvD4sFqcyY8dFiLnkelTxHeRdmuS', 0, '921838198ec7561483c16c1a91eabc6d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `variables`
--

CREATE TABLE IF NOT EXISTS `variables` (
  `name` text NOT NULL,
  `type` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `text` text,
  `boolean` int(11) DEFAULT NULL,
  `location` text,
  `zone` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `variables`
--

INSERT INTO `variables` (`name`, `type`, `num`, `text`, `boolean`, `location`, `zone`, `id`) VALUES
('testtext', 1, NULL, 'Yay', NULL, NULL, NULL, 1),
('testlocation', 2, NULL, NULL, NULL, 'http://www.apple.com', NULL, 2),
('testzone', 3, NULL, NULL, NULL, NULL, 'Zone, Data, Here', 3),
('testboolean', 4, NULL, NULL, 1, NULL, NULL, 4),
('overview', 1, NULL, '#M8 Overview', NULL, NULL, NULL, 5),
('pages', 1, NULL, '#M8 Pages', NULL, NULL, NULL, 6),
('variables', 1, NULL, '#M8 Variables', NULL, NULL, NULL, 7),
('settings', 1, NULL, '#M8 Settings', NULL, NULL, NULL, 8),
('test', 0, 15, NULL, NULL, NULL, NULL, 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
