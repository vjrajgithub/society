-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2017 at 07:39 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `society`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_block`
--

CREATE TABLE IF NOT EXISTS `add_block` (
  `blockId` bigint(40) NOT NULL AUTO_INCREMENT,
  `blockNumber` varchar(200) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`blockId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_billing`
--

CREATE TABLE IF NOT EXISTS `admin_billing` (
  `billingId` bigint(40) NOT NULL AUTO_INCREMENT,
  `billId` bigint(40) NOT NULL,
  `memberId` bigint(40) NOT NULL,
  `month` varchar(50) NOT NULL,
  `billcharge` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`billingId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `appnotification`
--

CREATE TABLE IF NOT EXISTS `appnotification` (
  `notificationId` bigint(40) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(40) NOT NULL,
  `message` varchar(500) NOT NULL,
  `readStatus` enum('Yes','No') NOT NULL,
  `postDate` datetime NOT NULL,
  `readStatusDate` datetime NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`notificationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `buy_sell`
--

CREATE TABLE IF NOT EXISTS `buy_sell` (
  `id` bigint(40) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(40) NOT NULL,
  `item` varchar(250) NOT NULL,
  `itemdetail` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `itemImage` varchar(250) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventId` bigint(40) NOT NULL AUTO_INCREMENT,
  `eventName` varchar(250) NOT NULL,
  `image_url` varchar(250) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `id` bigint(40) NOT NULL AUTO_INCREMENT,
  `facilityId` bigint(40) NOT NULL,
  `memberId` bigint(40) NOT NULL,
  `facilityCharge` varchar(50) NOT NULL,
  `chargePer_hour` varchar(50) NOT NULL,
  `multipleDayes` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `family_member`
--

CREATE TABLE IF NOT EXISTS `family_member` (
  `familyMemberId` bigint(40) NOT NULL AUTO_INCREMENT,
  `professionId` bigint(40) NOT NULL,
  `familyMemberName` varchar(250) NOT NULL,
  `familyRelation` varchar(150) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`familyMemberId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_bill`
--

CREATE TABLE IF NOT EXISTS `master_bill` (
  `billId` bigint(40) NOT NULL AUTO_INCREMENT,
  `billName` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`billId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `master_bill`
--

INSERT INTO `master_bill` (`billId`, `billName`, `status`, `cDate`) VALUES
(1, 'Water', 'Active', '2017-04-03 18:30:00'),
(2, 'Electricity', 'Active', '2017-04-03 18:30:00'),
(3, 'Maintenance', 'Active', '2017-04-03 18:30:00'),
(4, 'Late Charges', 'Active', '2017-04-03 18:30:00'),
(5, 'Additional charges', 'Active', '2017-04-03 18:30:00'),
(6, 'Arreas', 'Active', '2017-04-03 18:30:00'),
(7, 'Festival charges', 'Active', '2017-04-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_city`
--

CREATE TABLE IF NOT EXISTS `master_city` (
  `cityId` bigint(40) NOT NULL AUTO_INCREMENT,
  `stateId` bigint(40) NOT NULL,
  `countryId` bigint(40) NOT NULL,
  `cityName` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`cityId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_complain`
--

CREATE TABLE IF NOT EXISTS `master_complain` (
  `complainId` bigint(40) NOT NULL AUTO_INCREMENT,
  `complainName` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`complainId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `master_complain`
--

INSERT INTO `master_complain` (`complainId`, `complainName`, `status`, `cDate`) VALUES
(1, 'Plumbing', 'Active', '2017-04-02 18:30:00'),
(2, 'Electrical', 'Active', '2017-04-02 18:30:00'),
(3, 'Cleaniness', 'Active', '2017-04-02 18:30:00'),
(4, 'common area', 'Active', '2017-04-02 18:30:00'),
(5, 'Lifts', 'Active', '2017-04-02 18:30:00'),
(6, 'car parking', 'Active', '2017-04-02 18:30:00'),
(7, 'Garden', 'Active', '2017-04-02 18:30:00'),
(8, 'Security', 'Active', '2017-04-02 18:30:00'),
(9, 'Intercom', 'Active', '2017-04-02 18:30:00'),
(10, 'Others', 'Active', '2017-04-02 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_country`
--

CREATE TABLE IF NOT EXISTS `master_country` (
  `countryId` bigint(40) NOT NULL AUTO_INCREMENT,
  `countryName` varchar(150) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`countryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_designation`
--

CREATE TABLE IF NOT EXISTS `master_designation` (
  `designationId` bigint(20) NOT NULL AUTO_INCREMENT,
  `designationName` varchar(150) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`designationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `master_designation`
--

INSERT INTO `master_designation` (`designationId`, `designationName`, `status`, `cDate`) VALUES
(1, 'President', 'Active', '2017-04-02 18:30:00'),
(2, 'Secretary', 'Active', '2017-04-02 18:30:00'),
(3, 'Treasurer', 'Active', '2017-04-02 18:30:00'),
(4, 'Vice president ', 'Active', '2017-04-02 18:30:00'),
(5, 'Member', 'Active', '2017-04-02 18:30:00'),
(6, 'Executive Member', 'Active', '2017-04-02 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_empdesignation`
--

CREATE TABLE IF NOT EXISTS `master_empdesignation` (
  `empId` bigint(40) NOT NULL AUTO_INCREMENT,
  `empDesignation` varchar(250) NOT NULL,
  `cDate` timestamp NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`empId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `master_empdesignation`
--

INSERT INTO `master_empdesignation` (`empId`, `empDesignation`, `cDate`, `status`) VALUES
(1, 'Security Guard', '2017-10-03 18:30:00', 'Active'),
(2, 'Lift Man', '2017-10-03 18:30:00', 'Active'),
(3, 'Electrician', '2017-10-03 18:30:00', 'Active'),
(4, 'Plumber', '2017-10-03 18:30:00', 'Active'),
(5, 'Manager', '2017-10-03 18:30:00', 'Active'),
(6, 'Peon', '2017-10-03 18:30:00', 'Active'),
(7, 'Accountant', '2017-10-03 18:30:00', 'Active'),
(8, 'Care Taker', '2017-10-03 18:30:00', 'Active'),
(9, 'Cleaner', '2017-10-03 18:30:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_facility`
--

CREATE TABLE IF NOT EXISTS `master_facility` (
  `facilityId` bigint(40) NOT NULL AUTO_INCREMENT,
  `facilityName` varchar(150) NOT NULL,
  `status` enum('Default','Inactive') NOT NULL,
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`facilityId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `master_facility`
--

INSERT INTO `master_facility` (`facilityId`, `facilityName`, `status`, `cDate`) VALUES
(1, 'Pool', 'Default', '2017-04-09 18:30:00'),
(2, 'Function Hall', 'Default', '2017-04-09 18:30:00'),
(3, 'Gym', 'Default', '2017-04-09 18:30:00'),
(4, 'Park', 'Default', '2017-04-09 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_flat`
--

CREATE TABLE IF NOT EXISTS `master_flat` (
  `flatId` bigint(40) NOT NULL AUTO_INCREMENT,
  `flatType` varchar(250) NOT NULL,
  `area` double NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`flatId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_membertype`
--

CREATE TABLE IF NOT EXISTS `master_membertype` (
  `mId` bigint(40) NOT NULL AUTO_INCREMENT,
  `memberType` varchar(150) NOT NULL,
  `cDate` timestamp NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`mId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `master_membertype`
--

INSERT INTO `master_membertype` (`mId`, `memberType`, `cDate`, `status`) VALUES
(1, 'Owner', '2017-10-03 18:30:00', 'Active'),
(2, 'Tenant', '2017-10-03 18:30:00', 'Active'),
(3, 'Owner Family', '2017-10-03 18:30:00', 'Active'),
(4, 'Care Taker', '2017-10-03 18:30:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_profession`
--

CREATE TABLE IF NOT EXISTS `master_profession` (
  `professionId` bigint(40) NOT NULL AUTO_INCREMENT,
  `professionName` varchar(250) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`professionId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_servicelist`
--

CREATE TABLE IF NOT EXISTS `master_servicelist` (
  `serviceId` bigint(40) NOT NULL AUTO_INCREMENT,
  `serviceName` varchar(150) NOT NULL,
  `cDate` timestamp NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`serviceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `master_servicelist`
--

INSERT INTO `master_servicelist` (`serviceId`, `serviceName`, `cDate`, `status`) VALUES
(1, 'Lifts', '2017-04-09 18:30:00', 'Active'),
(2, 'Plubming', '2017-04-09 18:30:00', 'Active'),
(3, 'Security', '2017-04-09 18:30:00', 'Active'),
(4, 'Wifi', '2017-04-09 18:30:00', 'Active'),
(5, 'Electrical', '2017-04-09 18:30:00', 'Active'),
(6, 'Water tanks', '2017-04-09 18:30:00', 'Active'),
(7, 'Water Motor', '2017-04-09 18:30:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_society`
--

CREATE TABLE IF NOT EXISTS `master_society` (
  `societyId` bigint(40) NOT NULL AUTO_INCREMENT,
  `societyName` varchar(250) NOT NULL,
  `societyAddress` varchar(350) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`societyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `master_state`
--

CREATE TABLE IF NOT EXISTS `master_state` (
  `stateId` bigint(40) NOT NULL AUTO_INCREMENT,
  `countryId` bigint(40) NOT NULL,
  `stateName` varchar(150) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`stateId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `my_complain`
--

CREATE TABLE IF NOT EXISTS `my_complain` (
  `id` bigint(40) NOT NULL AUTO_INCREMENT,
  `complainId` bigint(40) NOT NULL,
  `memberId` bigint(40) NOT NULL,
  `complain` varchar(500) NOT NULL,
  `nature` enum('Complain','Suggestion','Request') DEFAULT NULL,
  `complaintType` enum('Individual','Society') DEFAULT NULL,
  `complainstatus` enum('Resolve','Pending') NOT NULL,
  `assignComplain` varchar(200) NOT NULL,
  `workerName` varchar(200) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `my_wall`
--

CREATE TABLE IF NOT EXISTS `my_wall` (
  `wallId` bigint(40) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(40) NOT NULL,
  `message` varchar(500) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`wallId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE IF NOT EXISTS `rent` (
  `id` bigint(40) NOT NULL AUTO_INCREMENT,
  `memberId` bigint(40) NOT NULL,
  `flatNumber` varchar(50) NOT NULL,
  `flatDetail` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `flatImage` varchar(250) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `serviceform`
--

CREATE TABLE IF NOT EXISTS `serviceform` (
  `serviceId` bigint(40) NOT NULL AUTO_INCREMENT,
  `serviceName` varchar(150) NOT NULL,
  `serviceProvider` varchar(150) NOT NULL,
  `contactNumber` int(20) NOT NULL,
  `mobileNumber` int(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `amc_Start_Date` datetime NOT NULL,
  `amc_End_Date` datetime NOT NULL,
  `amc_Amount` datetime NOT NULL,
  `cDate` timestamp NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`serviceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `society_gallery`
--

CREATE TABLE IF NOT EXISTS `society_gallery` (
  `galleryId` bigint(40) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(40) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image_url` varchar(250) NOT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`galleryId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `society_member`
--

CREATE TABLE IF NOT EXISTS `society_member` (
  `memberId` bigint(40) NOT NULL AUTO_INCREMENT,
  `mId` bigint(40) NOT NULL,
  `countryId` bigint(40) NOT NULL,
  `stateId` bigint(40) NOT NULL,
  `cityId` bigint(40) NOT NULL,
  `societyId` bigint(40) NOT NULL,
  `professionId` bigint(40) NOT NULL,
  `vehicleId` bigint(40) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `middleName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `flatNumber` varchar(50) NOT NULL,
  `BlockNumber` varchar(50) NOT NULL,
  `floorNumber` varchar(50) NOT NULL,
  `membershipNumber` varchar(50) NOT NULL,
  `parkingNumber` varchar(50) NOT NULL,
  `mobileNumber` int(20) NOT NULL,
  `landlineNumber` int(20) NOT NULL,
  `emergencyContactNumber` int(20) NOT NULL,
  `emergencyContactName` varchar(150) NOT NULL,
  `intercomNumber` varchar(50) NOT NULL,
  `userName` varchar(150) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`memberId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `vehicleId` bigint(40) NOT NULL AUTO_INCREMENT,
  `vehicleName` varchar(250) NOT NULL,
  `vehicleType` enum('Two Wheeler','Four Wheeler') NOT NULL,
  `vehicleNumber` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `cDate` timestamp NOT NULL,
  PRIMARY KEY (`vehicleId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
