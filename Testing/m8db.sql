-- phpMyAdmin SQL Dump
-- version 4.0.0-dev
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2012 at 10:29 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`name`, `title`, `description`, `location`, `id`) VALUES
('Admin', 'M8 Admin Panel', 'This the the location where you can edit various settings, and monitor the status of M8', '/Resources/Core/index.php', 1),
('AnotherTest', 'AnotherTest', 'No description currently', '/Resources/Site/Code/AnotherTest.php', 2),
('AnotherTestb', 'AnotherTestb', 'No description currently', '/Resources/Site/Code/AnotherTestb.php', 3),
('Test', 'Test', 'No description currently', '/Resources/Site/Code/Test.php', 4),
('index', 'index', 'No description currently', '/Resources/Site/Code/index.php', 5),
('CreateUser', 'CreateUser', 'No description currently', '/Resources/Site/Code/CreateUser.php', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `hash`, `level`, `sessionhash`, `id`) VALUES
('admin', '$2a$15$p1sD941DBOS.aUqWiWJ39OUMfsvD4sFqcyY8dFiLnkelTxHeRdmuS', 0, '$2a$12$4g3t81ZU6Nl.i3R63LwaxehPXnQiKyGrC9Gvvva1nxUwS2SJWUQbe', 1),
('Username', '$2a$12$evRxPrlplARpXHAbhfIa9efGaErbECZM7MXaK767fwoSE4BMO8z0.', 0, '$2a$12$fl..0tqsI1qCCiS9I7mjEuYaoD0vJDcoptSj4e4u7MWPkN0xCMreu', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `variables`
--

INSERT INTO `variables` (`name`, `type`, `num`, `text`, `boolean`, `location`, `zone`, `id`) VALUES
('indextext', 1, NULL, 'This is the index page loaded by M8 <br /> It can be found in /Resources/Site/Code/index.php', NULL, NULL, NULL, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
