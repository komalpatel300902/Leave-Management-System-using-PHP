-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2016 at 12:47 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `EmpName` varchar(50),
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `Dept` varchar(50) NOT NULL,
  `SetSickLeave` int(11) NOT NULL DEFAULT 15,
  `SetCasualLeave` int(11) NOT NULL DEFAULT 15,
 `SetEarnLeave` int(11) NOT NULL DEFAULT 30,
  `SetCommutionLeave` int(11) NOT NULL DEFAULT 30,
  `SetCompassionateLeave` int(11) NOT NULL DEFAULT 30,
  `SetNursingLeave` int(11) NOT NULL DEFAULT 30,
  `SetStudyLeave` int(11) NOT NULL DEFAULT 30,
  `SetMaternityLeave` int(11) NOT NULL DEFAULT 30,
  `SetPaternityLeave` int(11) 15,
  `email` varchar(50),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `Dept`, `SetSickLeave`, `SetCasualLeave`, `SetEarnLeave`,`SetCommutionLeave`,`SetCompassionateLeave`,`SetNursingLeave`,`SetStudyLeave`,`SetMaternityLeave`,`SetPaternityLeave`) VALUES
(1, 'cse_hod', 'cse_hod', 'CSE', 20, 25, 10),
(2, 'et&t_hod', 'et&t_hod', 'ET&T', 11, 11, 11),
(3, 'mech_hod', 'mech_hod', 'MECH', 15, 10, 30),
(4, 'civil_hod', 'civil_hod', 'CIVIL', 15, 10, 30),
(5, 'eee_hod', 'eee_hod', 'EEE', 15, 10, 30),
(6, 'cosc_hod', 'ef4999d1761ed18bf1a96c80fe81a0a117cace25', 'COSC', 15, 10, 30),
(7, 'ch_hod', '72c5a4143e012d2d999449d7d42bbc63d5693779', 'CH', 15, 10, 30);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `empid` varchar(30) UNIQUE,
  `UserName` varchar(50) NOT NULL,
  `EmpPass` varchar(200) NOT NULL,
  `EmpName` varchar(50) NOT NULL,
  `EmpEmail` varchar(40) NOT NULL,
  `Dept` varchar(30) NOT NULL,
  `EarnLeave` int(5) UNSIGNED NOT NULL,
  `SickLeave` int(5) UNSIGNED NOT NULL,
  `CasualLeave` int(5) UNSIGNED NOT NULL,
  `CommutionLeave` int(5) UNSIGNED NOT NULL,
  `CompassionateLeave` int(5) UNSIGNED NOT NULL,
  `NursingLeave` int(5) UNSIGNED NOT NULL,
  `StudyLeave` int(5) UNSIGNED NOT NULL,
  `MaternityLeave` int(5) UNSIGNED NOT NULL,
  `DateOfJoin` date NOT NULL,
  `Random` int(15) NOT NULL,
  `Designation` varchar(40) NOT NULL,
  `EmpFee` varchar(40) NOT NULL,
  `EmpType` varchar(40) NOT NULL,
  `UpdateStatus` date NOT NULL,
  `DateOfBirth` date NOT NULL,
  `gender` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leaves`
--

CREATE TABLE `emp_leaves` (
  `id` int(11) NOT NULL,
  `EmpName` varchar(50) NOT NULL,
  `LeaveType` varchar(60) NOT NULL,
  `RequestDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LeaveDays` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Requested',
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Dept` varchar(10) NOT NULL,
  `principal_status` varchar(30)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `joining_request` SELECT * FROM `employees`;

CREATE TABLE `principal` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50),
)

create table `hod_leaves` select * from `emp_leaves`;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `joining_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_leaves`
--
ALTER TABLE `emp_leaves`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hod_leaves`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `joining_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emp_leaves`
--
ALTER TABLE `emp_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  ALTER TABLE `hod_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
--  Engagement table for engagement of the teacher
--
CREATE TABLE ENGAGEMENTRECORD(
    DATES VARCHAR(15),
    DAY VARCHAR(30),
    PERIOD VARCHAR(3),
    SEM VARCHAR(3),
    BRANCH VARCHAR(20),
    SUBJECT VARCHAR(20),
    ENGAGED_BY_FACULTY_NAME VARCHAR(30));
    