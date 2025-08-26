-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 07:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tblacademicyear`
--

CREATE TABLE `tblacademicyear` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblacademicyear`
--

INSERT INTO `tblacademicyear` (`id`, `year`) VALUES
(101, 2025);

-- --------------------------------------------------------

--
-- Table structure for table `tblcity`
--

CREATE TABLE `tblcity` (
  `id` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcity`
--

INSERT INTO `tblcity` (`id`, `city`, `state`, `country`) VALUES
(0, '', '', ''),
(1, 'Surat', 'Gujarat', 'India'),
(2, 'Bardoli', 'Gujarat', 'India'),
(3, 'Mumbai', 'Maharastra', 'India'),
(4, 'Bharuch', 'Gujarat', 'India'),
(5, 'Madgaon', 'Goa', 'India'),
(6, 'Udaipur', 'Rajasthan', 'India'),
(7, 'Amritsar', 'Punjab', 'India'),
(8, 'Faridabad', 'Haryana', 'India'),
(9, 'Chennai', 'Tamil Nadu', 'India'),
(10, 'Kochi', 'Kerala', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `instituteid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`id`, `name`, `status`, `instituteid`) VALUES
(1, 'BscIT', 'Active', 1001),
(2, 'BscIT(Honors)', 'Active', 1001),
(3, 'MscIT', 'Active', 1001);

-- --------------------------------------------------------

--
-- Table structure for table `tbldivision`
--

CREATE TABLE `tbldivision` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldivision`
--

INSERT INTO `tbldivision` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `tblevalutioncriteria`
--

CREATE TABLE `tblevalutioncriteria` (
  `id` int(11) NOT NULL,
  `eventsubcatagoryid` int(11) NOT NULL,
  `criteria` varchar(10) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventcatagory`
--

CREATE TABLE `tbleventcatagory` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventcatagory`
--

INSERT INTO `tbleventcatagory` (`id`, `name`, `status`) VALUES
(101, 'Dance', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbleventcordinator`
--

CREATE TABLE `tbleventcordinator` (
  `id` int(11) NOT NULL,
  `eventsubcatagoryid` int(11) NOT NULL,
  `facultyid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventschedule`
--

CREATE TABLE `tbleventschedule` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(20) NOT NULL,
  `eventcoordinatorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventsubcatagory`
--

CREATE TABLE `tbleventsubcatagory` (
  `id` int(11) NOT NULL,
  `eventcatagoryid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dateofjoining` date NOT NULL,
  `designation` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `id` int(11) NOT NULL,
  `participantid` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblinstitute`
--

CREATE TABLE `tblinstitute` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `academicyearid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblinstitute`
--

INSERT INTO `tblinstitute` (`id`, `name`, `status`, `academicyearid`) VALUES
(1001, 'BMIIT', 'Active', 101);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotification`
--

CREATE TABLE `tblnotification` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `subject/title` varchar(10) NOT NULL,
  `imagelocation` varchar(30) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblparticipants`
--

CREATE TABLE `tblparticipants` (
  `id` int(11) NOT NULL,
  `enro` int(11) NOT NULL,
  `eventsubcatagoryid` int(11) NOT NULL,
  `team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `participantid` int(11) NOT NULL,
  `position` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`id`, `name`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4'),
(5, 'Semester 5'),
(6, 'Semester 6');

-- --------------------------------------------------------

--
-- Table structure for table `tblsemesterdivision`
--

CREATE TABLE `tblsemesterdivision` (
  `id` int(11) NOT NULL,
  `semesterid` int(11) NOT NULL,
  `divisionid` int(11) NOT NULL,
  `academicyearid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `enro` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `semesterid` int(11) NOT NULL,
  `divisionid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `cityid` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `contact` int(11) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblacademicyear`
--
ALTER TABLE `tblacademicyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcity`
--
ALTER TABLE `tblcity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instituteid` (`instituteid`);

--
-- Indexes for table `tbldivision`
--
ALTER TABLE `tbldivision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblevalutioncriteria`
--
ALTER TABLE `tblevalutioncriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventsubcatagoryid` (`eventsubcatagoryid`);

--
-- Indexes for table `tbleventcatagory`
--
ALTER TABLE `tbleventcatagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbleventcordinator`
--
ALTER TABLE `tbleventcordinator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facultyid` (`facultyid`),
  ADD KEY `eventsubcatagoryid` (`eventsubcatagoryid`);

--
-- Indexes for table `tbleventschedule`
--
ALTER TABLE `tbleventschedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventcoordinatorid` (`eventcoordinatorid`);

--
-- Indexes for table `tbleventsubcatagory`
--
ALTER TABLE `tbleventsubcatagory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventcatagoryid` (`eventcatagoryid`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participantid` (`participantid`);

--
-- Indexes for table `tblinstitute`
--
ALTER TABLE `tblinstitute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academicyearid` (`academicyearid`);

--
-- Indexes for table `tblnotification`
--
ALTER TABLE `tblnotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblparticipants`
--
ALTER TABLE `tblparticipants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enro` (`enro`),
  ADD KEY `eventsubcatagoryid` (`eventsubcatagoryid`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participantid` (`participantid`);

--
-- Indexes for table `tblsemester`
--
ALTER TABLE `tblsemester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsemesterdivision`
--
ALTER TABLE `tblsemesterdivision`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semesterid` (`semesterid`),
  ADD KEY `divisionid` (`divisionid`),
  ADD KEY `academicyearid` (`academicyearid`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`enro`),
  ADD KEY `userid` (`userid`),
  ADD KEY `semesterid` (`semesterid`),
  ADD KEY `divisionid` (`divisionid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailid` (`emailid`),
  ADD KEY `departmentid` (`departmentid`),
  ADD KEY `cityid` (`cityid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `enro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  ADD CONSTRAINT `tbldepartment_ibfk_1` FOREIGN KEY (`instituteid`) REFERENCES `tblinstitute` (`id`);

--
-- Constraints for table `tblevalutioncriteria`
--
ALTER TABLE `tblevalutioncriteria`
  ADD CONSTRAINT `tblevalutioncriteria_ibfk_1` FOREIGN KEY (`eventsubcatagoryid`) REFERENCES `tbleventsubcatagory` (`id`);

--
-- Constraints for table `tbleventcordinator`
--
ALTER TABLE `tbleventcordinator`
  ADD CONSTRAINT `tbleventcordinator_ibfk_1` FOREIGN KEY (`facultyid`) REFERENCES `tblfaculty` (`id`),
  ADD CONSTRAINT `tbleventcordinator_ibfk_2` FOREIGN KEY (`eventsubcatagoryid`) REFERENCES `tbleventsubcatagory` (`id`);

--
-- Constraints for table `tbleventschedule`
--
ALTER TABLE `tbleventschedule`
  ADD CONSTRAINT `tbleventschedule_ibfk_1` FOREIGN KEY (`eventcoordinatorid`) REFERENCES `tbleventcordinator` (`id`);

--
-- Constraints for table `tbleventsubcatagory`
--
ALTER TABLE `tbleventsubcatagory`
  ADD CONSTRAINT `tbleventsubcatagory_ibfk_1` FOREIGN KEY (`eventcatagoryid`) REFERENCES `tbleventcatagory` (`id`);

--
-- Constraints for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD CONSTRAINT `tblfaculty_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbluser` (`id`);

--
-- Constraints for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD CONSTRAINT `tblfeedback_ibfk_1` FOREIGN KEY (`participantid`) REFERENCES `tblparticipants` (`id`);

--
-- Constraints for table `tblinstitute`
--
ALTER TABLE `tblinstitute`
  ADD CONSTRAINT `tblinstitute_ibfk_1` FOREIGN KEY (`academicyearid`) REFERENCES `tblacademicyear` (`id`);

--
-- Constraints for table `tblparticipants`
--
ALTER TABLE `tblparticipants`
  ADD CONSTRAINT `tblparticipants_ibfk_1` FOREIGN KEY (`enro`) REFERENCES `tblstudent` (`enro`),
  ADD CONSTRAINT `tblparticipants_ibfk_2` FOREIGN KEY (`eventsubcatagoryid`) REFERENCES `tbleventsubcatagory` (`id`);

--
-- Constraints for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD CONSTRAINT `tblresult_ibfk_1` FOREIGN KEY (`participantid`) REFERENCES `tblparticipants` (`id`);

--
-- Constraints for table `tblsemesterdivision`
--
ALTER TABLE `tblsemesterdivision`
  ADD CONSTRAINT `tblsemesterdivision_ibfk_1` FOREIGN KEY (`semesterid`) REFERENCES `tblsemester` (`id`),
  ADD CONSTRAINT `tblsemesterdivision_ibfk_2` FOREIGN KEY (`divisionid`) REFERENCES `tbldivision` (`id`),
  ADD CONSTRAINT `tblsemesterdivision_ibfk_3` FOREIGN KEY (`academicyearid`) REFERENCES `tblacademicyear` (`id`);

--
-- Constraints for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD CONSTRAINT `tblstudent_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tbluser` (`id`),
  ADD CONSTRAINT `tblstudent_ibfk_3` FOREIGN KEY (`semesterid`) REFERENCES `tblsemester` (`id`),
  ADD CONSTRAINT `tblstudent_ibfk_4` FOREIGN KEY (`divisionid`) REFERENCES `tbldivision` (`id`);

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `tbluser_ibfk_1` FOREIGN KEY (`departmentid`) REFERENCES `tbldepartment` (`id`),
  ADD CONSTRAINT `tbluser_ibfk_2` FOREIGN KEY (`cityid`) REFERENCES `tblcity` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
