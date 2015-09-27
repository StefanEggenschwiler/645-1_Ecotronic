-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2015 at 12:52 PM
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
CREATE DATABASE IF NOT EXISTS `c645_1_ecotronic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `c645_1_ecotronic`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
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

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

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
  (28, 'Philips'),
  (31, 'WESCO'),
  (40, 'Dirt Devil'),
  (41, 'TRISA'),
  (42, 'Kärcher'),
  (43, 'Rowenta'),
  (44, 'Dyson'),
  (45, 'Mio-Star'),
  (55, 'Fust');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `efficiencyClassId` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `energyPrice` decimal(10,2) NOT NULL,
  `energyConsumption` decimal(10,2) NOT NULL,
  `serialNumber` varchar(200) NOT NULL,
  `productionYear` year(4) NOT NULL,
  `manufacturerLink` varchar(300) NOT NULL,
  `shopLink` varchar(300) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `discountStart` date DEFAULT NULL,
  `discountEnd` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`typeId`) REFERENCES type(id),
  FOREIGN KEY (`brandId`) REFERENCES brand(id),
  FOREIGN KEY (`efficiencyClassId`) REFERENCES efficiencyclass(id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=294 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `typeId`, `brandId`, `efficiencyClassId`, `image`, `model`, `price`, `energyPrice`, `energyConsumption`, `serialNumber`, `productionYear`, `manufacturerLink`, `shopLink`, `discount`, `discountStart`, `discountEnd`) VALUES
  (NULL, 1, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/bosch_hbg656.jpg', 'HBG656ES1C', '3220.00', '281.00', '0.87', 'GZ90F-2MNOG-58ADN-RWIIO', 1996, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 2, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/siemens_hb634gbs1.jpg', 'HB 634GBS/W1', '2010.00', '281.00', '0.87', '3JZWU-24ZZZ-2F8LB-BTRS8', 1990, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 2, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/siemens_hb655.jpg', 'HB 655GBS/W1C', '2250.00', '281.00', '0.87', 'UZACN-V27JW-NAD2O-9GT6E', 2000, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/bosch_hbg655.jpg', 'HBG655Bx1C', '2250.00', '281.00', '0.87', '4SDBH-LGAT6-BWMN6-0VMSY', 1970, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/bosch_hbg634bs1.jpg', 'HBG634Bx1', '2010.00', '281.00', '0.87', '4CK1S-K7EQO-P2IEF-I8Y6P', 1993, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 3, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/vzug_combair_sl_60.jpg', 'Combair SL BC-SL/60', '3930.00', '281.00', '0.86', '1C4EW-RQJ8Q-ZYA5V-BQCUO', 2008, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 4, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/bauknecht_blvms8100.jpg', 'BLVMS 8100 sw / BIVMS 8100 IXL / BLVMS 8100 IXL', '2490.00', '284.00', '0.89', '4VMAW-F9BGH-7N5IJ-HVHTK', 2011, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 3, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/vzug_combair_s_60.jpg', 'Combair S BC-S/60', '2250.00', '288.00', '0.79', 'U633K-7SU5Z-VXJ32-Q7OK3', 1976, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 5, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/miele_h2261_60.jpg', 'H 2261-1-60 B', '1390.00', '293.00', '0.99', 'A4CR0-YC3HR-FKRRF-5GPPC', 2000, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 4, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/bauknecht_blve8101.jpg', 'BLVE 8101 IXL', '2190.00', '302.00', '0.89', 'R33YP-YVGP4-NQHXW-WA7KJ', 2008, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 4, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/bauknecht_blve8200.jpg', 'BLVE 8200', '1860.00', '304.00', '0.90', 'C5QC5-M3IYF-PJNJ6-7KFLP', 1993, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 5, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/miele_h6660_60.jpg', 'H 6660-60 B', '2750.00', '317.00', '1.05', '2KQUW-5IGYY-SMN2R-8Y36L', 1986, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 5, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/miele_h6460_60.jpg', 'H 6460-60 B', '2090.00', '317.00', '1.05', '57LUS-LJT4K-ABRU6-SRM26', 2003, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 1, 5, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/backofen/miele_h2661_60.jpg', 'H 2661-60 B', '1590.00', '317.00', '1.05', 'MAZS3-O6HPL-6YQV0-RVV41', 1984, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 4, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/bauknecht_stc8363.jpg', 'STC 8363', '5240.00', '169.00', '0.47', 'V55K2-40LAB-XXH9O-X64FE', 1983, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 3, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/vzug_combi_steam_hsl.jpg', 'Combi-Steam HSL', '5280.00', '169.00', '0.47', 'GWQBC-CP7EF-QGPFL-ZU0PB', 2014, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 6, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/fors_fcst_sl_60.jpg', 'FCST-SL', '4890.00', '169.00', '0.47', 'FUELE-DOV55-5DCIA-69A1W', 1997, 'http://fors.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 6, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/fors_fcst_xsl_60.jpg', 'FCST-XSL', '4990.00', '191.00', '0.53', 'UWMK1-SYW68-ZT36A-062ZQ', 1982, 'http://fors.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 3, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/vzug_combi_steam_xsl.jpg', 'Combi-Steam XSL / F', '5330.00', '191.00', '0.53', 'WNOO5-E29RS-ND7XL-UHFO0', 1971, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 6, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/fors_fcss_60.jpg', 'FCSS-60', '4890.00', '239.00', '0.63', 'D2QTD-IDBH7-QIBV7-VZRLC', 1972, 'http://fors.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 4, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/bauknecht_sth8603.jpg', 'STH 8563', '5360.00', '239.00', '0.63', 'K8EMI-01AB8-O56RC-TUXGC', 1995, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 3, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/vzug_combair_steam_se.jpg', 'Combair-Steam SL / SE', '4710.00', '239.00', '0.63', 'M0DY4-GXBAS-ODHHO-AKGIT', 2008, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/bosch_csg636bs1.jpg', 'CSG636BS1 / CSG656xx1', '3490.00', '241.00', '0.61', '8B65Q-N3VGL-RUDSW-EYARD', 1976, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 2, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/siemens_cs636gbs1.jpg', 'CS636GBS1 / CS656GBx1 / CS658GRx1', '3490.00', '241.00', '0.61', 'P14F4-YHR47-SMU2X-0U77C', 1980, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/bosch_hsg636bs1.jpg', 'HSG636Bx1 / HSG636ES1C / HSG 656XS1', '3910.00', '281.00', '0.69', 'UGMKQ-2AZ2T-C2L48-XHSX3', 1992, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 2, 2, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/steamer/siemens_hs636gds1c.jpg', 'HS636GDS1C / HS658GXS1C', '4050.00', '281.00', '0.69', '5XQT2-5E6W3-7TGQQ-F3I39', 2000, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 7, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/sg214n.jpg', 'SG 2570 N', '1698.00', '438.00', '146.00', '7SMU2-X0U77-C7UGM-KQ2AZ', 1973, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 7, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/electrolux_sg2500nop.jpg', 'SG2500NOP', '1799.00', '438.00', '146.00', 'TC2L4-8XHSX-3H5XQ-T25E6', 2010, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 7, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/electrolux_sg215n.jpg', 'SG215N', '2460.00', '438.00', '146.00', '37TGQ-QF3I3-9NFU0-IX3VG', 2015, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 9, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/euf2642.jpg', 'EUF 2642 FW NoFrost', '2169.00', '438.00', '146.00', 'GMV30-FL6D1-YQLNT-QA0HM', 1995, 'http://www.fust.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 5, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/miele_f12020_s3.jpg', 'F 12020 S-3', '925.00', '300.00', '100.00', 'BVEZA-9IN5I-X7MY4-OXH2O', 2005, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gp1486.jpg', 'GP 1486', '1450.00', '300.00', '100.00', 'E8BDJ-L7HAL-D9G8H-HDYLB', 2012, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 2, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gs29vvw.jpg', 'GS29VVW40', '2390.00', '387.00', '129.00', 'QAIF1-PBRUD-D7MGZ-NCHSF', 1990, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gnp2666.jpg', 'GNP 2666', '2690.00', '435.00', '145.00', 'L2EXD-IV9WC-QESAA-T3KEH', 1991, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gp3013.jpg', 'GP 3013', '2150.00', '483.00', '161.00', 'VEVYF-5Y50Z-66RQI-MFRGL', 1981, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 5, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/fn12540.jpg', 'FN 12540 S-1', '1695.00', '486.00', '162.00', 'WYMXI-HVOE0-W8Y0T-S0F72', 2010, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gnp3166.jpg', 'GNP 3166 GNP 3113', '2550.00', '486.00', '162.00', 'R5BFZ-980JN-1GEVG-310OT', 1989, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 1, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gsn51aw40.jpg', 'GSN51AW40 / 41', '2930.00', '522.00', '174.00', 'QGW02-08TM1-69HRI-BAWNH', 1973, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 3, 2, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/gefrierschrank/gs51naw40.jpg', 'GS51NAW40 / 41', '3070.00', '522.00', '174.00', 'ODOGU-2FJJK-OXK8W-O3U1E', 2009, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 3, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/vzug_adora_60slwp.jpg', 'Adora 60 SL GS 60SLWP-di/Vi', '5350.00', '558.00', '137.00', 'FU0IX-3VGZG-MV30F-L6D1Y', 2003, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 55, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/adora-1455fsl.jpg', 'GS Adora 1460 FSL', '3399.00', '697.00', '196.00', 'LNTQA-0HMJB-VEZA9-IN5IX', 1978, 'http://www.fust.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 3, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/vzug_adora_60sl_di.jpg', 'Adora 60 SL GS 60 SL-di/Vi', '3850.00', '697.00', '196.00', 'MY4OX-H2ORE-8BDJL-7HALD', 1982, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 3, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/vzug_adora_60sl_di_b.jpg', 'Adora 60 SL GS 60 SL-di/Vi B', '4180.00', '725.00', '204.00', 'G8HHD-YLBXQ-AIF1P-BRUDD', 1979, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 1, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/bosch_sbi88ts03h.jpg', 'SMI / SBI 88TS03H/E', '3010.00', '759.00', '211.00', 'MGZNC-HSFGL-2EXDI-V9WCQ', 1988, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 6, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/fors_lv460.jpg', 'LV 460 Si / Svi ', '2850.00', '767.00', '204.00', 'RQIMF-RGL9W-YMXIH-VOE0W', 1980, 'http://fors.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 3, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/vzug_adora_60s_si.jpg', 'Adora 60 S GS 60 Si/di/Vi', '3280.00', '767.00', '204.00', 'Y0TS0-F72VR-5BFZ9-80JN1', 1991, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 2, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/siemens_sx66m037ch.jpg', 'SN / SX 66M037CH', '2250.00', '862.00', '234.00', 'EVG31-0OTEQ-GW020-8TM16', 1981, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 10, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/df260.jpg', 'DF 260', '2670.00', '870.00', '234.00', 'HRIBA-WNH2O-DOGU2-FJJKO', 2012, 'http://www.gaggenau.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 4, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/bauknecht_gsi8994.jpg', 'GSI 8994', '2890.00', '870.00', '234.00', 'K8WO3-U1EUT-L72ZI-OGNAV', 1980, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 1, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/bosch_smi69n75eu.jpg', 'SMI / SBI 69N75EU', '2340.00', '871.00', '237.00', 'OVG3F-QGAPU-IJWNO-2U5KK', 2009, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 2, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/siemens_sn56p592eu.jpg', 'SN / SX 56P592EU', '2340.00', '871.00', '237.00', 'TA9TM-FV0Z2-MCXS8-5WQX8', 2009, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 5, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/miele_g16700.jpg', 'G 16700-60 SCi ', '2495.00', '874.00', '237.00', 'GEZA1-W7544-9XRB0-KK6RK', 1998, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 5, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/miele_g26365.jpg', 'G 26365-60 SCVi', '2095.00', '874.00', '237.00', 'WEUJ9-8XDF4-RR5FS-SMY01', 1997, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 7, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/electrolux_ga60slvs.jpg', 'GA60SLVS', '2950.00', '902.00', '239.00', '2WL9L-E2CW0-J2TNM-5PUES', 1988, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 11, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/aeg_gs60gvs.jpg', 'FAVORIT GS60GVS', '2205.00', '908.00', '241.00', 'IGR86-W72RB-X7RT2-J4YDE', 1984, 'http://www.aeg.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 4, 7, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/geschirrspüler/electrolux_ga60glvs.jpg', 'GA60GLVS', '2460.00', '908.00', '241.00', 'V3MC4-WKMT1-16J8F-FEOJD', 2015, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 1, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/bosch_kil22ad40.jpg', 'KIL22AD40', '2030.00', '294.00', '98.00', '2PZLZ-K91EV-17N2D-BL5U3', 1994, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 7, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/ik1345.jpg', 'IK1345S', '1950.00', '297.00', '99.00', 'LLSCB-72DTQ-6G3TT-XKI8N', 1980, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 13, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/gorenje_rbi5093.jpg', 'RBI 5093 AW', '1460.00', '300.00', '100.00', 'G5XJP-ROHVR-6J1FA-MSGC8', 1982, 'http://www.gorenje.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 4, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/bauknecht_kvi2951.jpg', 'KVI 2951', '1840.00', '312.00', '104.00', '18D0X-8G5C9-H8ZLW-F24P9', 1984, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 12, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/eki1225.jpg', 'EKI 1225-IB', '1799.00', '360.00', '120.00', '6CUYK-SSPPJ-5SDIL-XX74B', 1981, 'http://www.fust.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/ikp1654.jpg', 'IKP 1654', '2290.00', '306.00', '102.00', 'LEOM4-I8YS0-QJ10D-9U4UF', 2002, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 1, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/bosch_kil42ad40.jpg', 'KIL42AD40', '2240.00', '345.00', '115.00', 'FFVJJ-S0UI5-LLY91-8YB5R', 1976, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 2, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/siemens_ki42lad40.jpg', 'KI42LAD40', '2240.00', '345.00', '115.00', '1AMKN-ASVVI-Q3XSF-UIFC9', 2009, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 7, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/ik2070.jpg', 'IK2070S', '2350.00', '345.00', '115.00', 'CGVPT-7T8QL-N7F2I-SQLYR', 2015, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 4, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/bauknecht_kvie2262.jpg', 'KVIE 2262', '2350.00', '354.00', '118.00', 'N4A17-K49QD-GG651-Z202P', 1983, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 3, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/vzug_perfect_60i_eco.jpg', 'Perfect 60i eco', '2380.00', '354.00', '118.00', 'J9XDT-UJ9GI-UFIJO-UMLGZ', 2009, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 5, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/k34443.jpg', 'K 34443 iF', '1695.00', '360.00', '120.00', 'XXTT8-ISMQ1-VT6TK-IQPTA', 1977, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/ikp2354.jpg', 'IKP 2354', '2490.00', '366.00', '122.00', '23ANP-D2Y04-Q9TAV-BFDKB', 2003, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 8, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/ikbp2354.jpg', 'IKBP 2354', '2790.00', '393.00', '131.00', 'CFY2N-KI98J-ONMGN-3RW7Y', 1975, 'http://www.liebherr.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 2, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/siemens_ki22lad40.jpg', 'KI22LAD40', '2030.00', '300.00', '100.00', 'ZH1OA-9PUWQ-TOGNO-LZ66J', 1976, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 3, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/vzug_ideal_eco.jpg', 'Ideal 60i eco', '1990.00', '315.00', '105.00', '2M1ZJ-V13A9-0LKNW-23D7M', 1972, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 1, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/bosch_kil32ad40.jpg', 'KIL32AD40', '2130.00', '318.00', '106.00', '9VU6O-ESPHQ-4CYCV-A06OA', 2014, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 7, 2, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/kühlschrankeinbau/siemens_ki32lad40.jpg', 'KI32LAD40', '2130.00', '318.00', '106.00', 'RLJN0-8SEFP-83YLL-23Z45', 2006, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 7, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/electrolux_zufclassic.jpg', 'UltraFlex ZUFCLASSIW', '299.00', '50.20', '25.10', '7SCPO-8F4GF-6A7O3-85V4M', 1970, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 40, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dirt_devel_rebel_24.jpg', 'Rebel 24HE', '149.00', '50.40', '25.20', 'CRI0X-XIVZ5-OTBDN-JB1HA', 2006, 'http://www.dirtdevil.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/miele_complete_c3_silence.jpg', 'Complete C3 Silence Parquet Ecoline Plus', '449.00', '50.40', '25.20', '6TS36-P733R-B3B2A-ZV8W2', 1979, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 41, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/trisa_t7083.jpg', 'Professional Clean T7083', '349.00', '51.00', '25.50', 'CB79Z-AQK80-I1Q8V-6J5OX', 1982, 'http://www.trisa.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 40, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dirt_devel_rebel_25.jpg', 'Rebel 25HFC', '169.00', '51.00', '25.40', 'H8R0G-EOCSJ-3DOH1-OWKXD', 1998, 'http://www.dirtdevil.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/miele_complete_c3_celebration.jpg', 'Complete C3 Celebration Parquet EcoLine Plus', '399.00', '51.20', '25.60', 'MS1K1-0RYMM-5IQ3B-H7CTJ', 1987, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/miele_complete_c3_electro.jpg', 'Complete C3 Electro EcoLine', '549.00', '51.40', '25.70', 'WRX4O-QDR7U-24EPR-KQCNY', 1979, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 7, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/electrolux_ultraflex_a.jpg', 'UltraFlex ZUFFLEXA', '389.00', '51.60', '25.80', 'FGMAZ-EDWO6-MKJ25-77QBB', 2003, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 42, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/kaercher_vc6.jpg', 'VC 6 Premium', '469.00', '51.60', '25.80', 'FZVQU-HCB7O-O28VC-26XCW', 2002, 'http://www.kaercher.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 7, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/electrolux_ultrasilencer_zusgreen.jpg', 'UltraSilencer ZUSGREEN+', '429.00', '52.00', '26.00', '73O2J-L0Y9C-ZM895-SRTNN', 2004, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 40, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dirt_devel_rebel_74.jpg', 'Rebel 74HE', '129.00', '52.00', '25.80', '02WHA-HTUNI-36I7X-AV72K', 1980, 'http://www.dirtdevil.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 40, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dirt_devel_rebel_75.jpg', 'Rebel 75HFC', '159.00', '52.00', '25.90', 'LQUHY-MF6DY-77GGH-4AC5T', 1992, 'http://www.dirtdevil.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 41, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/trisa_t6801.jpg', 'Classic Clean T6801', '199.00', '53.00', '26.50', 'CIS4O-G1S29-ZLPTL-4BGEG', 1976, 'http://www.trisa.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 28, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/philips_fc9920.jpg', 'FC9920', '500.00', '53.40', '26.70', '1B7VV-THRTV-UH8YE-BY1QX', 1985, 'http://www.philips.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/miele_complete_c3_brilliant.jpg', 'Complete C3 Brilliant EcoLine', '649.00', '53.40', '26.70', 'LYJ6L-NWVHX-789C6-MD11V', 2006, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 43, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/rowenta_ro5913.jpg', 'RO5913', '339.00', '54.00', '27.00', 'KIC01-TUY2N-R4P9X-GKCNH', 2005, 'http://www.rowenta.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 43, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/rowenta_ro5729.jpg', 'RO5729', '299.00', '54.00', '27.00', '4T3VC-RTY7B-LOETW-264QR', 1982, 'http://www.rowenta.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 1, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/bosch_bgs5sil.jpg', 'Relaxxx Silence', '350.00', '54.00', '27.00', 'LHTU1-7VOTB-ZYSTQ-E9598', 1974, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 40, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dirt_devel_rebel_55.jpg', 'Rebel 55HFC', '219.00', '54.00', '27.00', 'A55NP-HFRDT-QRRBB-ITJVC', 1972, 'http://www.dirtdevil.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 40, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dirt_devel_rebel_54.jpg', 'Rebel 54HF', '199.00', '54.00', '27.20', 'KM3E0-B4CY4-AU0TV-D9KSW', 1982, 'http://www.dirtdevil.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 43, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/rowenta_ro8324.jpg', 'RO8324', '429.00', '54.00', '27.00', '3CV6N-DBKY9-NJ7TU-N3EE0', 2011, 'http://www.rowenta.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 45, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/miostar_v_cleaner.jpg', 'V-Cleaner 750-HD', '249.00', '54.00', '26.90', 'T98BH-WEK6A-3CAWF-VMOZW', 1995, 'http://www.melectronics.ch/s/de/brand/MIO-STAR/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 44, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dyson_dc37c.jpg', 'DC37c', '599.00', '54.00', '27.00', '4VMW6-NS0CG-KRKUP-GBXFY', 1995, 'http://www.dyson.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 44, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/dyson_dc33c.jpg', 'DC33c', '499.00', '54.00', '27.00', 'AGLR2-Z8XSQ-7HKYC-E1B06', 1981, 'http://www.dyson.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/miele_compact_c2_excellence.jpg', 'Compact C2 Excellence EcoLine', '299.00', '55.00', '27.50', '32QTZ-SLT63-PVFAJ-1X71Y', 1990, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 28, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/philips_fc8728.jpg', 'FC8728/19', '499.00', '55.60', '27.80', '8PO46-HSQEV-FIQS6-4IR3S', 1998, 'http://www.philips.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 28, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/philips_fc8722.jpg', 'FC8722/19', '350.00', '55.60', '27.80', 'QTAC5-FSL1H-0NS46-EGX15', 1989, 'http://www.philips.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 28, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/philips_fc9197_91.jpg', 'FC9197', '349.00', '55.60', '27.80', 'ZSSQW-4MTRA-IM50S-O5IBW', 1988, 'http://www.philips.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 7, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/electrolux_ultraone_zuoorigwr.jpg', 'UltraOne ZUOGREEN+', '529.00', '56.00', '28.00', 'GFSZ4-YAG7A-VXX7J-003PS', 2001, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 2, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/siemens_vsz5sen1ch.jpg', 'VSZ5SEN1CH', '419.00', '56.00', '28.00', 'REUML-1A3FM-PSLM6-XXZC9', 2006, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 2, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/siemens_vsz4g332ch.jpg', 'VSZ4G332CH', '299.00', '56.00', '28.00', '78Y07-HSXI6-XF1X4-SBSKX', 1981, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 1, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/bosch_bgl4332ch.jpg', 'BGL4332CH', '299.00', '56.00', '28.00', 'DZ4CR-M9KL6-NEXV6-RCF56', 2014, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 14, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/samsung_vc07f80.jpg', 'VC07F80HUUK/SW', '579.00', '56.00', '28.00', '1FKDG-DFNWS-QE21Y-Q6Y18', 2014, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 14, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/samsung_vc07f70.jpg', 'VC07F70HNUR/SW', '379.00', '56.00', '28.00', 'WGZNQ-7KXRP-41TY6-PBGW4', 1970, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 14, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/samsung_vc07f50.jpg', 'VC07F50VNRB/SW', '279.00', '56.00', '28.00', '4T0BF-2M1D8-NJEEB-NH6BQ', 1975, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 9, 14, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/staubsauger/samsung_vc07f60.jpg', 'VC07F60WNUR/SW', '239.00', '56.00', '28.00', 'NXL8D-TMBI7-MCMUZ-SSXIK', 1998, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 7, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/electrolux_wasl2e202.jpg', 'WASL2 E202 WASL6 E202', '3430.00', '945.00', '105.00', 'GNHVD-GRJ46-L5KRK-G0OTM', 1984, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 14, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/samsung_ww10h9600.jpg', 'WW10H9600EW/WS', '2699.00', '1047.00', '119.00', 'WXEUX-Y0FOJ-6EOQ3-MT6HE', 1999, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 5, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/miele_wmv900_60.jpg', 'WMV 900-60', '3290.00', '1050.00', '130.00', 'XLM3L-4MM9A-87IST-CHW7Y', 2003, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 14, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/samsung_ww12h8400.jpg', 'WW12H8400EW/WS', '2499.00', '1125.00', '141.00', 'APJC6-82YB2-ZMW3A-YNMF2', 2007, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 1, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/bosch_way28742ch.jpg', 'WAY28742CH', '3160.00', '1129.00', '152.00', 'JEI26-MDNC3-A9EBC-57640', 1974, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 1, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/bosch_way32742ch.jpg', 'WAY32742CH WAY32842CH', '3350.00', '1129.00', '152.00', '8Q3XD-Q3048-78GU7-VSN9U', 1976, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 2, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/siemens_wm14y792ch.jpg', 'WM14Y792CH', '3430.00', '1129.00', '152.00', '94GXQ-ZK6OL-IB654-CVDRP', 2006, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 2, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/siemens_wm16y792ch.jpg', 'WM16Y792CH WM16Y892CH', '3350.00', '1129.00', '152.00', 'H9DL7-ZTBRR-1KUWF-GPB1L', 1972, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 5, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/miele_wkr500_70.jpg', 'WKR 500-70 WMR 500-60', '2690.00', '1182.00', '174.00', 'AA13P-6DJW5-QNP6O-3GQC4', 1970, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 5, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/miele_wkr900_70.jpg', 'WKR 900-70', '3190.00', '1182.00', '174.00', 'S9GQT-LAFSV-DG58W-OW9LE', 1991, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 15, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/miele_fust_wks500_70.jpg', 'WKS 500-70', '2890.00', '1182.00', '174.00', '1OHU6-VAJQD-NGCYX-23RWE', 1995, 'http://www.fust.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 16, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/dyn10146-p8.jpg', 'DYN 10146 P8-S', '2390.00', '1350.00', '192.00', 'KZVTL-ZHIIA-NQLOE-0II6I', 1993, 'http://www.hoover.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 16, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/dst10166.jpg', 'DST 10146PG/L-S', '2590.00', '1491.00', '239.00', 'OYSBH-7Y4RW-LNWHS-5PX5B', 1994, 'http://www.hoover.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 10, 16, 5, 'http://www.topten.ch/uploads/icons/list/products/haushalt/waschmaschinen/dyn11146.jpg', 'DYN 11146 PG8', '2490.00', '1557.00', '261.00', 'QSD7U-904QO-I2DMJ-F77B0', 1981, 'http://www.hoover.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 1, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/bosch_wty887w4ch.jpg', 'WTY887W4CH', '4130.00', '474.00', '158.00', 'DUNTN-Q3TFM-ISFUA-UW8HK', 1994, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 4, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/bauknecht_trpc88530.jpg', 'TRPC 88530', '3390.00', '528.00', '176.00', '5H0JG-BUOFF-34ZSE-MFUTE', 1998, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 2, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/siemens_wt47w790.jpg', 'WT47W790CH', '3570.00', '528.00', '176.00', 'MY4VJ-X32KB-YJ67Y-4D6T5', 1997, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 1, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/bosch_wty87740.jpg', 'WTY87740CH', '3570.00', '528.00', '176.00', 'DRITC-HHH68-ZLIPA-ME5AI', 1990, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 11, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/aeg_tb7053tw.jpg', 'LAVATHERM TB7053TW', '2510.00', '531.00', '177.00', '8ARR8-6BXT9-M09EP-N8XZX', 2013, 'http://www.aeg.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 7, 4, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/electrolux_twgl5e203.jpg', 'TWGL 5E 203', '2715.00', '531.00', '177.00', 'PHF62-L82UC-YFF7P-EL40P', 2003, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 17, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/blomberg_tkf8451.jpg', 'TKF 8451 AG50', '2490.00', '696.00', '232.00', 'J1MOH-CTRD1-JT7PH-8GGWT', 1973, 'http://www.blomberginternational.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 18, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/schulthess_spirit620.jpg', 'Spirit 620', '3390.00', '699.00', '233.00', 'UGXI0-FESIH-KCGVB-4FBXM', 1995, 'http://www.schulthess.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 15, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/miele_fust_tks300_50.jpg', 'TKS 300-50', '2790.00', '699.00', '233.00', '0BTDP-R61K5-N3DSP-OBKCC', 1975, 'http://www.fust.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 2, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/siemens_wt47w590.jpg', 'WT47W590CH', '2930.00', '699.00', '233.00', 'SZ80B-NVOIR-FC6BF-ROS05', 2009, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 14, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/samsung_dv80f5.jpg', 'DV80F5E5HGW ', '2499.00', '705.00', '235.00', '4Q61S-Q34RL-NEJD0-Q1PWG', 2005, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 14, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/samsung_dv80h8100.jpg', 'DV80H8100 HW/WS', '2199.00', '705.00', '235.00', 'NKEOU-QY9CK-XGRUO-Q6R12', 1978, 'http://www.samsung.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 19, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/haier_hd80_a82.jpg', 'HD80-A82', '1399.00', '705.00', '235.00', '1DYWV-HBW0R-NAO0X-MJML2', 2010, 'http://www.haier.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 11, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/aeg_tp6060tw.jpg', 'LAVATHERM TP6060TW', '2420.00', '705.00', '235.00', 'EN5EO-JZAC9-6AP8T-MMGHZ', 1990, 'http://www.aeg.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 5, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/miele_tkb600_50.jpg', 'TKB 600-50', '1890.00', '705.00', '235.00', 'EAM01-S9NU5-28QWT-285P0', 1984, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 5, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/miele_tmg600_40.jpg', 'TMG 600-40', '2390.00', '705.00', '235.00', 'IFFE2-85HFU-I1NHD-1CT2X', 1998, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 6, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/fors_tp8536.jpg', 'TP 8536', '2990.00', '705.00', '235.00', '4FP14-TTQZ2-89GJF-QQ1DQ', 1997, 'http://fors.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 4, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/bauknecht_trpc86520.jpg', 'TRPC 86520', '2890.00', '705.00', '235.00', 'YJE73-W9AUW-G20JJ-AY9N4', 1992, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 4, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/bauknecht_trwp8711.jpg', 'TRWP 8711', '3150.00', '705.00', '235.00', '1DC0C-R4B5G-7RXIS-8NJM0', 2005, 'http://www.bauknecht.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 12, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/novamatic_tw7768.jpg', 'TW 7768 (by Elux)', '2899.00', '705.00', '235.00', 'NVY8F-BGKY5-APU3U-55DYT', 1993, 'http://www.fust.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 7, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/electrolux_twl4e204.jpg', 'TWL 4E 204', '2460.00', '705.00', '235.00', 'OY609-P97TJ-H9KAU-P9BRN', 1973, 'http://www.electrolux.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 2, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/siemens_wt45w590.jpg', 'WT45W590CH', '3360.00', '705.00', '235.00', 'G9PQ2-SXHZB-Y1JBV-LKR9W', 1990, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 11, 1, 3, 'http://www.topten.ch/uploads/icons/list/products/haushalt/tumbler/bosch_wty887w4ch.jpg', 'WTW85540CH', '3330.00', '705.00', '235.00', '3740A-B1KUP-U0PX9-OC3HD', 2003, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/bosch_DIB098E50.jpg', 'DIB098E50', '3140.00', '99.00', '33.00', 'IX0JN-NRMD5-0ZDS7-QWFDH', 2000, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 5, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/miele_DA6690D.jpg', 'DA 6690 D Puristic Edition 6000', '3750.00', '100.00', '33.30', 'EW9VJ-UQ97L-X186I-WZ1I4', 1983, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 1, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/bosch_DIB097A50.jpg', 'DIB097A50', '2690.00', '102.00', '34.00', '5KDHY-QVEHN-DF5C2-DXHOL', 1983, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 2, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/siemens_LF97BA542.jpg', 'LF97BA542', '2470.00', '102.00', '34.10', '4FX8V-1P7SQ-S6I8J-L3PRG', 1978, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/miele_DA420V-6.jpg', 'DA 420 V-6 Puristic Varia', '4060.00', '109.00', '36.40', 'YU8T4-KVMZC-VOPY6-L2S8G', 1981, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 5, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/miele_DA424V-6.jpg', 'DA 424 V-6 Puristic Varia', '4380.00', '109.00', '36.40', 'P2UYZ-3UFIC-3EM7N-25P45', 1991, 'http://www.miele.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 2, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/siemens_LF98BF542.jpg', 'LF98BF542', '3030.00', '112.00', '37.30', 'BMVEY-PY95G-MYUJK-SHZ1M', 1973, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 31, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/wesco_fhe_quadro7.jpg', 'FHE quadro 7-100', '3830.00', '114.00', '38.00', 'EQS2V-V4F07-YMXW6-N6P4Y', 2010, 'http://www.wesco.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 31, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/wesco_fhe_quadro5.jpg', 'FHE quadro 5-100', '3620.00', '114.00', '38.00', 'VLHL1-ZQGH3-O2XBS-GKG0A', 1975, 'http://www.wesco.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 2, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/siemens_LF21BA582.jpg', 'LF21BA582', '4120.00', '116.00', '38.70', 'UTLTD-71CCL-NZM01-EJVCU', 2014, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 2, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/siemens_LF91BA582.jpg', 'LF91BA582', '3620.00', '119.00', '39.60', '6307E-F45HX-W3WNL-XM9VX', 1976, 'http://www.siemens.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 31, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/wesco_fhe_quadro5.jpg', 'FHE quadro 5-120', '3890.00', '123.00', '41.00', 'SZ0EV-NHVL2-7JIYI-VRK8T', 2012, 'http://www.wesco.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 31, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/wesco_fhe_quadro7.jpg', 'FHE quadro 7-120', '4100.00', '126.00', '42.00', 'LQU38-UXV9W-KBUSO-2QTR7', 1977, 'http://www.wesco.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 3, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/v-zug_DI-Premira.jpg', 'DI Premira PQ 10', '3770.00', '126.00', '42.00', 'TSBS5-7HVO0-B4QNW-R54UJ', 1981, 'http://www.vzug.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 1, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/bosch_DIB091U52.jpg', 'DIB091U52', '3120.00', '141.00', '47.00', 'U8LXT-NQHI7-4TWHH-7FK2I', 1974, 'http://www.bosch.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 10, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/gaggenau_AI442160.jpg', 'AI 442 160', '4090.00', '147.00', '49.00', '2J3C3-6T67O-Z0I8G-ULLK5', 1996, 'http://www.gaggenau.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 10, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/gaggenau_AI442120.jpg', 'AI 442 120', '4280.00', '150.00', '50.00', 'Y6W02-LJ14Q-27UVX-NGV3X', 2001, 'http://www.gaggenau.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 10, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/gaggenau_AI442100.jpg', 'AI 442 100', '4650.00', '153.00', '51.00', '215QC-QXB0N-BOWRX-IEIV2', 1984, 'http://www.gaggenau.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 10, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/gaggenau_AI230190.jpg', 'AI 230 190', '3180.00', '156.00', '52.00', 'WQ0ZD-KMAW1-KJY63-MIMXT', 1972, 'http://www.gaggenau.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 10, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/gaggenau_AI240190.jpg', 'AI 240 190', '3180.00', '156.00', '52.00', 'F90I8-UJD3V-9LL2H-OVN3K', 1993, 'http://www.gaggenau.com/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 31, 2, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/wesco_fhe_scala110.jpg', 'FHE scala 110', '3550.00', '159.00', '53.00', 'CEQLC-96OE0-AXQI4-W133O', 1995, 'http://www.wesco.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL),
  (NULL, 13, 31, 1, 'http://www.topten.ch/uploads/icons/list/products/haushalt/dunstabzugshauben/wesco_fh_muro_vetro.jpg', 'FH muro vetro', '2450.00', '177.00', '59.00', 'L6VZD-VKJ94-DZMEC-H9O5R', 1996, 'http://www.wesco.ch/', 'http://www.melectronics.ch/', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `efficiencyclass`
--

DROP TABLE IF EXISTS `efficiencyclass`;
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

DROP TABLE IF EXISTS `type`;
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
  (7, 'Fridge'),
  (9, 'Vacuum Cleaner'),
  (10, 'Washing Machine'),
  (11, 'Laundry Dryer'),
  (13, 'Kitchen Hood');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
