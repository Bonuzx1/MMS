-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2018 at 05:32 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `approve`
--

CREATE TABLE `approve` (
  `approvedid` int(10) NOT NULL,
  `requestid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL,
  `dateapproved` date NOT NULL,
  `isscheduled` tinyint(1) NOT NULL,
  `iscompleted` int(1) NOT NULL,
  `iscancelled` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `assetid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `departmentid` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `locationid` int(10) NOT NULL,
  `supplierid` int(10) NOT NULL,
  `notes` text NOT NULL,
  `purchaseprice` float NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`assetid`, `name`, `departmentid`, `status`, `locationid`, `supplierid`, `notes`, `purchaseprice`, `isdeleted`, `notified`) VALUES
(2, 'Fan', '4', 0, 1, 1, 'Nothing to write about this', 115.97, 0, 0),
(3, 'asa', '4', 1, 1, 0, '', 22.5, 1, 0),
(5, 'er', '2', 0, 2, 1, '', 0, 1, 0),
(6, 'qqwqqqq', '2', 1, 1, 1, 'qweqqw32', 1212, 1, 0),
(7, 'Phone', '2', 1, 3, 1, 'A test work', 900, 1, 0),
(8, 'Another one', '4', 1, 1, 1, 'What is the problem here?', 8988, 1, 0),
(9, 'simply another one', '5', 1, 3, 1, 'just testing the location that is giving 1 all the time', 982, 1, 0),
(10, 'a simple test', '1', 1, 2, 2, 'it was actually the supplier', 9900, 1, 0),
(11, 'aaa', '3', 1, 2, 0, '23', 443, 1, 0),
(12, 'to test', '4', 1, 2, 1, 'no notes, really', 988.2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assetstaff`
--

CREATE TABLE `assetstaff` (
  `assetstaffid` int(10) NOT NULL,
  `assetid` int(10) NOT NULL,
  `staffid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `locationid` int(10) NOT NULL,
  `phonenumber` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `locationid`, `phonenumber`, `email`, `status`) VALUES
(1, 'hsdhf', 3, '08129472189', 'xzchs@bs.com', 1),
(2, 'eben', 2, '86756453', 'ebe@eben.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentid` int(10) NOT NULL,
  `departmentname` varchar(30) NOT NULL,
  `departmentnotes` text NOT NULL,
  `isfunctional` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentid`, `departmentname`, `departmentnotes`, `isfunctional`) VALUES
(1, 'Buidings', 'this is an edit department test run', 1),
(2, 'Electricals', '', 0),
(3, 'Plumbing', '', 0),
(4, 'Refrigerations&Airconditions', '', 1),
(5, 'Roads&Culverts', '', 0),
(6, 'My House', '', 0),
(7, 'nakjs', 'kjbklj', 0),
(8, 'bonuz', 'kjrwkrjk', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationid` int(10) NOT NULL,
  `locationname` varchar(30) NOT NULL,
  `notes` text NOT NULL,
  `isavailable` tinyint(1) NOT NULL DEFAULT '1',
  `isinuse` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationid`, `locationname`, `notes`, `isavailable`, `isinuse`) VALUES
(1, 'Old Block Room1', 'sfgdhkjfagsdjhfgbdkjfbajdkshafbskjdgfdjkgaljdgfaure', 1, 1),
(2, 'New Block Roo', 'hfkgjdghkjrgbekuyyyyyfgyruegkeeeeeeeeeeewauirehgfuerhgfuveilghfiuaehuihrglaiurewhgvr', 1, 1),
(3, 'wefew', 'retsgert', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestid` int(10) NOT NULL,
  `customerid` int(10) NOT NULL,
  `assetid` int(10) NOT NULL,
  `description` varchar(200) NOT NULL,
  `datecreated` date NOT NULL,
  `datedue` date NOT NULL,
  `isactive` int(1) NOT NULL,
  `isapproved` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(10) NOT NULL,
  `assetid` varchar(10) NOT NULL,
  `frequencytype` int(10) NOT NULL,
  `maintenancetype` text NOT NULL,
  `prioritytype` text NOT NULL,
  `cost` float NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `staffid` int(10) NOT NULL,
  `iscanceled` tinyint(1) NOT NULL DEFAULT '0',
  `notified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `assetid`, `frequencytype`, `maintenancetype`, `prioritytype`, `cost`, `startdate`, `enddate`, `color`, `staffid`, `iscanceled`, `notified`) VALUES
(165, '7', 0, '2', '1', 50, '2018-01-12 00:00:00', '2018-01-14 00:00:00', '#f6856c', 2, 1, 0),
(166, '8', 1, '2', '1', 900, '2018-01-26 00:00:00', '2018-04-26 00:00:00', '#f6856c', 0, 0, 0),
(167, '5', 1, '1', '2', 98, '2018-01-26 00:00:00', '2018-01-26 00:00:00', '#cace1e', 7, 1, 1),
(168, '2', 1, '2', '2', 23, '2018-01-29 00:00:00', '2018-01-29 00:00:00', '#cace1e', 4, 1, 1),
(169, '2', 2, '2', '1', 50, '2018-01-05 00:00:00', '2018-03-05 00:00:00', '#f6856c', 4, 1, 1),
(170, '2', 2, '1', '2', 200, '2018-01-31 00:00:00', '2018-01-31 00:00:00', '#cace1e', 6, 0, 1),
(171, '2', 2, '1', '2', 200, '2018-02-07 00:00:00', '2018-02-07 00:00:00', '#cace1e', 6, 0, 1),
(172, '2', 2, '1', '2', 200, '2018-02-14 00:00:00', '2018-02-14 00:00:00', '#cace1e', 6, 0, 1),
(173, '2', 2, '1', '2', 500, '2018-02-21 00:00:00', '2018-02-21 00:00:00', '#cace1e', 6, 0, 1),
(174, '2', 2, '1', '2', 200, '2018-02-28 00:00:00', '2018-02-28 00:00:00', '#cace1e', 6, 0, 1),
(175, '2', 2, '1', '2', 200, '2018-03-07 00:00:00', '2018-03-07 00:00:00', '#cace1e', 6, 0, 1),
(176, '2', 2, '1', '2', 200, '2018-03-14 00:00:00', '2018-03-14 00:00:00', '#cace1e', 6, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `departmentid` int(10) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `active` int(1) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `name`, `dob`, `gender`, `departmentid`, `contact`, `email`, `active`, `isdeleted`) VALUES
(1, 'gloria sandra', '1979-08-03', 'male', 2, '0262423224', 'sandra@gmail.com', 0, 1),
(2, 'gloria ebortttt', '1990-08-03', 'male', 3, '324242', 'gloria@yahoo.com', 0, 0),
(4, 'ghkfhg', '0000-00-00', 'Female', 2, '5', 'jkhdkjfhkj@kkj.sd', 1, 1),
(5, 'dsgff', '1992-10-11', 'Male', 1, '45656', 'bonuzx1@gmial.com', 0, 0),
(6, 'dsgff', '1992-10-11', 'Male', 1, '45656', 'bonuzx1@gmial.com', 1, 1),
(7, 'asfa', '1992-10-11', 'Male', 1, '9087', 'ad@ksjnck.com', 1, 0),
(8, 'eqe', '1992-10-11', 'Female', 1, '22435235', 'fserws@adsd.com', 0, 1),
(9, 'eqe', '1992-10-11', 'Female', 1, '22435235', 'fserws@adsd.com', 1, 0),
(10, 'eqe', '1992-10-11', 'Female', 1, '22435235', 'fserws@adsd.com', 0, 1),
(11, 'eqe', '1992-10-11', 'Female', 1, '22435235', 'fserws@adsd.com', 0, 0),
(12, 'eqe', '1992-10-11', 'Female', 1, '22435235', 'fserws@adsd.com', 0, 1),
(13, '3333', '2018-02-16', 'Male', 3, '098877', 'grte@com', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierid` int(11) NOT NULL,
  `suppliername` varchar(30) NOT NULL,
  `Address` varchar(80) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `inpartnership` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierid`, `suppliername`, `Address`, `phone`, `inpartnership`) VALUES
(1, 'Olakayode Ademola Ajayi', 'NO 32, down the street', '0267251427', 1),
(2, 'MySupllier LTD', 'i dont have one,hoping to get one soon', '098765434567890', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE `supply` (
  `supplyid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `notes` text NOT NULL,
  `supplierid` int(10) NOT NULL,
  `purchaseprice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`supplyid`, `name`, `status`, `notes`, `supplierid`, `purchaseprice`) VALUES
(1, 'Dustbierrt', 1, 'i dont know. i24ts just a tqqeqestwr', 1, 456712000),
(2, 'Hand Fan', 1, 'testing from error gotten', 2, 45364),
(3, 'sdf', 0, 'sdfsd', 1, 234.9);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `active`) VALUES
(1, 'admini', 'eben', 1),
(2, 'sandy11', 'qwerty123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approve`
--
ALTER TABLE `approve`
  ADD PRIMARY KEY (`approvedid`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`assetid`);

--
-- Indexes for table `assetstaff`
--
ALTER TABLE `assetstaff`
  ADD PRIMARY KEY (`assetstaffid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierid`);

--
-- Indexes for table `supply`
--
ALTER TABLE `supply`
  ADD PRIMARY KEY (`supplyid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approve`
--
ALTER TABLE `approve`
  MODIFY `approvedid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `assetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `assetstaff`
--
ALTER TABLE `assetstaff`
  MODIFY `assetstaffid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supply`
--
ALTER TABLE `supply`
  MODIFY `supplyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
