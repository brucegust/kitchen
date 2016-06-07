-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2013 at 06:58 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trinity`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar_category`
--

CREATE TABLE IF NOT EXISTS `calendar_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `calendar_category`
--

INSERT INTO `calendar_category` (`id`, `name`, `description`) VALUES
(2, 'Senior Adults', 0x53656e696f72204164756c74207363686564756c65),
(3, 'Adults', 0x4164756c74207363686564756c65),
(4, 'Students', 0x53747564656e74206d696e6973747279207363686564756c65),
(5, 'Children', 0x4368696c6472656e2773206d696e69737472792063616c656e646172),
(6, 'Worship', 0x576f7273686970207465616d207363686564756c65);
