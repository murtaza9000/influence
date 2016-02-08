-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2016 at 12:22 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `influence`
--

-- --------------------------------------------------------

--
-- Table structure for table `domain`
--

CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` text,
  `publisher_id` int(11) unsigned NOT NULL,
  `priority` int(255) NOT NULL,
  `click_rate` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publisher_id` (`publisher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `domain`
--

INSERT INTO `domain` (`id`, `url`, `publisher_id`, `priority`, `click_rate`) VALUES
(1, 'http://www.automark.pk', 1, 0, 12344),
(2, 'www.ieeekhi.com', 2, 2, 0),
(9, 'salurl', 1, 0, 12),
(12, 'salurl2', 1, 0, 2),
(19, 'mu6', 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `influencer`
--

CREATE TABLE IF NOT EXISTS `influencer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `ban` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `influencer`
--

INSERT INTO `influencer` (`id`, `name`, `ban`) VALUES
(1, 'Murtaza', 1),
(2, 'iqbal', 1);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id`, `name`) VALUES
(1, 'Salmam'),
(2, 'murtaza');

-- --------------------------------------------------------

--
-- Table structure for table `viral_links`
--

CREATE TABLE IF NOT EXISTS `viral_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `click_rate` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `viral_links`
--

INSERT INTO `viral_links` (`id`, `url`, `click_rate`) VALUES
(21, '123', 1234),
(22, 'tst', 7888),
(23, 'www.ieeekhi.com', 13.3),
(24, 'musta', 13);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `domain_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
