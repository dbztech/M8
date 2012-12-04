-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2012 at 07:57 PM
-- Server version: 5.1.66-community
-- PHP Version: 5.4.0

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
  `devredirect` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`name`, `title`, `description`, `location`, `devredirect`, `id`) VALUES
('Admin', 'M8 Admin Panel', 'This the the location where you can edit various settings, and monitor the status of M8', '/Resources/Core/index.php', NULL, 1),
('index', 'MPAror Home', 'No description currently', '/Resources/Site/Code/index.php', NULL, 5),
('CreateUser', 'CreateUser', 'No description currently', '/Resources/Site/Code/CreateUser.php', NULL, 6),
('Team', 'Team', 'No description currently', '/Resources/Site/Code/Team.php', NULL, 7),
('Sponsors', 'Sponsors', 'No description currently', '/Resources/Site/Code/Sponsors.php', NULL, 8),
('Robot', 'Robot', 'No description currently', '/Resources/Site/Code/Robot.php', NULL, 9),
('Search', 'Search', 'No description currently', '/Resources/Site/Code/Search.php', NULL, 10),
('Media', 'Media', 'No description currently', '/Resources/Site/Code/Media.php', NULL, 11);

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
('admin', '$2a$15$p1sD941DBOS.aUqWiWJ39OUMfsvD4sFqcyY8dFiLnkelTxHeRdmuS', 0, '7e8c9055d709dc923b426bd2915acf4a', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `variables`
--

INSERT INTO `variables` (`name`, `type`, `num`, `text`, `boolean`, `location`, `zone`, `id`) VALUES
('nav slide content', 1, NULL, 'This is super content. I am talking right now through out new CMS M8. The interface is really simple and there are only a <i>FEW</i> bugs', NULL, NULL, NULL, 10);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
