-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2015 at 09:35 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c645_1_ecotronic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brandName`) VALUES
(1, 'Bosch'),
(2, 'Siemens'),
(3, 'V-ZUG'),
(4, 'Bauknecht'),
(5, 'Miele'),
(6, 'Fors'),
(7, 'Electrolux'),
(8, 'Liebherr'),
(9, 'Electrolux/Fust'),
(10, 'Gaggenau'),
(11, 'AEG'),
(12, 'Novamatic'),
(13, 'Gorenje'),
(14, 'Samsung'),
(15, 'Miele/Fust'),
(16, 'Hoover'),
(17, 'Blomberg'),
(18, 'Schulthess'),
(19, 'Haier'),
(20, 'Solis'),
(21, 'Primotecq'),
(22, 'Rotel'),
(23, 'Tefal'),
(24, 'Melitta'),
(25, 'Russell Hobbs'),
(26, 'WMF'),
(27, 'Braun'),
(28, 'Philips'),
(29, 'Unold'),
(30, 'Severin'),
(31, 'WESCO'),
(32, 'Necono AG'),
(33, 'Venta'),
(34, 'Stylies'),
(35, 'Stadler Form'),
(36, 'Turmix'),
(37, 'Boneco'),
(38, 'Solis'),
(39, 'Stöckli'),
(40, 'Dirt Devil'),
(41, 'TRISA'),
(42, 'Kärcher'),
(43, 'Rowenta'),
(44, 'Dyson'),
(45, 'Mio-Star'),
(46, 'KISS'),
(47, 'NESPRESSO/Turmix'),
(48, 'NESPRESSO/Koenig'),
(49, 'DELIZIO'),
(50, 'Tchibo'),
(51, 'NESPRESSO/Delingo'),
(52, 'Krups'),
(53, 'Koenig'),
(54, 'Tchibo / Saeco');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `efficiencyClassId` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `energyPrice` decimal(10,0) NOT NULL,
  `energyConsumption` int(11) NOT NULL,
  `serialNumber` varchar(200) NOT NULL,
  `productionYear` year(4) NOT NULL,
  `manufacturerLink` varchar(300) NOT NULL,
  `shopLink` varchar(300) NOT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `discountStart` date DEFAULT NULL,
  `discountEnd` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `efficiencyclass`
--

CREATE TABLE IF NOT EXISTS `efficiencyclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `className` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `efficiencyclass`
--

INSERT INTO `efficiencyclass` (`id`, `className`) VALUES
(1, 'A'),
(2, 'A+'),
(3, 'A++'),
(4, 'A+++'),
(5, 'A+++/A'),
(6, 'A++/B');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `typeName`) VALUES
(1, 'Oven'),
(2, 'Steamer'),
(3, 'Freezer'),
(4, 'Dish Washer'),
(5, 'Coffee Machine'),
(7, 'Fridge'),
(8, 'Humidifier'),
(9, 'Vacuum Cleaner'),
(10, 'Washing Machine'),
(11, 'Laundry Dryer'),
(13, 'Kitchen Hood');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
