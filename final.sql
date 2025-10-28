-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2025 at 01:37 PM
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
-- Database: `final`
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
(1, 2024),
(2, 2025),
(3, 2026);

-- --------------------------------------------------------

--
-- Table structure for table `tblcity`
--

CREATE TABLE `tblcity` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `status` varchar(8) NOT NULL,
  `instituteid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`id`, `name`, `status`, `instituteid`) VALUES
(1, 'Bachelor of Science(Information Technology)', 'Active', 1),
(2, 'Master of Science(Information Technology)', 'Active', 1),
(3, 'Bachelor of Technology', 'Active', 2),
(4, 'Master of Technology', 'Active', 2),
(5, 'Master of Computer Application', 'Active', 3),
(6, 'Bachelor of Computer Application', 'Active', 4),
(7, 'Bachelor of Pharmacy', 'Active', 5),
(8, 'Master of Pharmacy', 'Active', 5),
(9, 'Ph.D.(Pharmacy)', 'Active', 5),
(10, 'Bachelor of Journalism and Mass Communication', 'Active', 6),
(11, 'Bachelor of Arts(Psychology)', 'Active', 6),
(12, 'Master of Journalism and Mass Communication', 'Active', 6),
(13, 'Master of Arts(Psychology)', 'Active', 6),
(14, 'Bachelor of Physiotherapy', 'Active', 7),
(15, 'Master of Physiotherapy', 'Active', 7),
(16, 'Bachelor of Science(Agriculture)', 'Active', 8),
(17, 'Bachelor of Science(Mathematics)', 'Active', 9),
(18, 'Master of Science(Mathematics)', 'Active', 9),
(19, 'Bachelor of Science(Data Science and Data Analytics)', 'Active', 9),
(20, 'Bachelor of Science(Data Science and Artificial Intelligence)', 'Active', 9),
(21, 'Bachelor of Science(Computer Science and Computational Mathematics)', 'Active', 9),
(22, 'Bachelor of Science(Physics)', 'Active', 10),
(23, 'Master of Science(Physics)', 'Active', 10),
(24, 'Ph.D.(Physics)', 'Active', 10),
(25, 'Bachelor of Arts(Engllish)', 'Active', 11),
(26, 'Master of Arts(Engllish)', 'Active', 11),
(27, 'Ph.D.(English)', 'Active', 11),
(28, 'Bachelor of Science(Biotechnology)', 'Active', 12),
(29, 'Bachelor of Science(Microbiology)', 'Active', 12),
(30, 'Master of Science(Biotechnology)', 'Active', 12),
(31, 'Master of Science(Microbiology)', 'Active', 12),
(32, 'Bachelor of Business Administration', 'Active', 13),
(33, 'Bachelor of Design(Fashion Design & Technology)', 'Active', 14),
(34, 'Diploma in Fashion Design', 'Active', 14),
(35, 'Master of Design (Fashion Management)', 'Active', 14),
(36, 'Bachelor of Business Administration', 'Active', 22),
(37, 'Bachelor of Science(Information Technology)', 'Active', 15),
(38, 'Master of Science(Information Technology)', 'Active', 15),
(39, 'Bachelor of Technology', 'Active', 16),
(40, 'Master of Technology', 'Active', 16),
(41, 'Bachelor of Computer Application', 'Active', 17),
(42, 'Bachelor of Pharmacy', 'Active', 18),
(43, 'Master of Pharmacy', 'Active', 18),
(44, 'Ph.D.(Pharmacy)', 'Active', 18),
(45, 'Bachelor of Journalism and Mass Communication', 'Active', 19),
(46, 'Bachelor of Arts(Psychology)', 'Active', 19),
(47, 'Master of Journalism and Mass Communication', 'Active', 19),
(48, 'Master of Arts(Psychology)', 'Active', 19),
(49, 'Bachelor of Physiotherapy', 'Active', 20),
(50, 'Master of Physiotherapy', 'Active', 20),
(51, 'Bachelor of Science(Agriculture)', 'Active', 21),
(52, 'Bachelor of Business Administration', 'Active', 22);

-- --------------------------------------------------------

--
-- Table structure for table `tbldivision`
--

CREATE TABLE `tbldivision` (
  `id` int(11) NOT NULL,
  `name` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblevalutioncriteria`
--

CREATE TABLE `tblevalutioncriteria` (
  `id` int(11) NOT NULL,
  `eventsubcatagoryid` int(11) DEFAULT NULL,
  `criteria` varchar(30) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventcatagory`
--

CREATE TABLE `tbleventcatagory` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `academicyearid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventcatagory`
--

INSERT INTO `tbleventcatagory` (`id`, `name`, `academicyearid`) VALUES
(1, 'Dance', 1),
(2, 'Music', 1),
(3, 'Theatre', 1),
(4, 'Fine Arts', 1),
(5, 'Dance', 2),
(6, 'Music', 2),
(7, 'Theatre', 2),
(8, 'Literary', 2),
(9, 'Fine Arts', 2),
(10, 'Diverse', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbleventcordinator`
--

CREATE TABLE `tbleventcordinator` (
  `id` int(11) NOT NULL,
  `eventsubcatagoryid` int(11) DEFAULT NULL,
  `facultyid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventschedule`
--

CREATE TABLE `tbleventschedule` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `venue` varchar(50) NOT NULL,
  `eventcoordinatorid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventsubcatagory`
--

CREATE TABLE `tbleventsubcatagory` (
  `id` int(11) NOT NULL,
  `eventcatagoryid` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(5) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbleventsubcatagory`
--

INSERT INTO `tbleventsubcatagory` (`id`, `eventcatagoryid`, `name`, `type`, `status`) VALUES
(79, 5, 'UTU Best Dancer', 'Solo', 'Upcoming'),
(80, 5, 'Classical Dance', 'Solo', 'Upcoming'),
(81, 5, 'Folk Dance', 'Group', 'Upcoming'),
(82, 5, 'Bollywood Dance', 'Group', 'Upcoming'),
(83, 6, 'Light Indian Vocal', 'Solo', 'Upcoming'),
(84, 6, 'Western Vocal', 'Solo', 'Upcoming'),
(85, 6, 'Bollywood Vocal', 'Solo', 'Upcoming'),
(86, 6, 'Indian Song', 'Group', 'Upcoming'),
(87, 6, 'Western Song', 'Group', 'Upcoming'),
(88, 7, 'Mono Acting', 'Solo', 'Upcoming'),
(89, 7, 'Mimicry', 'Solo', 'Upcoming'),
(90, 7, 'Mime', 'Group', 'Upcoming'),
(91, 7, 'Skit', 'Group', 'Upcoming'),
(92, 7, 'Short Film Making', 'Group', 'Upcoming'),
(93, 7, 'Script Writing', 'Solo', 'Upcoming'),
(94, 8, 'Elocution', 'Solo', 'Upcoming'),
(95, 8, 'Poem Recitation', 'Solo', 'Upcoming'),
(96, 8, 'Film Review', 'Solo', 'Upcoming'),
(97, 8, 'Extempore', 'Solo', 'Upcoming'),
(98, 8, 'Quiz', 'Group', 'Upcoming'),
(99, 8, 'Debate', 'Group', 'Upcoming'),
(100, 8, 'Ad Making', 'Group', 'Upcoming'),
(101, 9, 'Poster Making', 'Solo', 'Upcoming'),
(102, 9, 'On the Spot Painting', 'Solo', 'Upcoming'),
(103, 9, 'Brushless Painting', 'Solo', 'Upcoming'),
(104, 9, 'Cartooning', 'Solo', 'Upcoming'),
(105, 9, 'Clay Modelling', 'Solo', 'Upcoming'),
(106, 9, 'Rangoli', 'Solo', 'Upcoming'),
(107, 9, 'Mehndi', 'Solo', 'Upcoming'),
(108, 9, 'Installation', 'Group', 'Upcoming'),
(109, 9, 'Spot Photography', 'Solo', 'Upcoming'),
(110, 9, 'Documentary Film', 'Group', 'Upcoming'),
(111, 10, 'Fashion Show', 'Group', 'Upcoming'),
(112, 10, 'Uth Icon', 'Solo', 'Upcoming'),
(113, 10, 'Photo Story', 'Solo', 'Upcoming'),
(114, 10, 'Show Reels', 'Group', 'Upcoming'),
(115, 10, 'Digital Canvas', 'Solo', 'Upcoming'),
(116, 10, 'UTU Shark Tank', 'Group', 'Upcoming'),
(117, 1, 'UTU Best Dancer', 'Solo', 'Upcoming'),
(118, 1, 'Classical Dance', 'Solo', 'Upcoming'),
(119, 1, 'Folk Dance', 'Group', 'Upcoming'),
(120, 1, 'Bollywood Dance', 'Group', 'Upcoming'),
(121, 2, 'Light Indian Vocal', 'Solo', 'Upcoming'),
(122, 2, 'Western Vocal', 'Solo', 'Upcoming'),
(123, 2, 'Bollywood Vocal', 'Solo', 'Upcoming'),
(124, 2, 'Indian Song', 'Group', 'Upcoming'),
(125, 2, 'Western Song', 'Group', 'Upcoming'),
(126, 3, 'Mono Acting', 'Solo', 'Upcoming'),
(127, 3, 'Mimicry', 'Solo', 'Upcoming'),
(128, 3, 'Mime', 'Group', 'Upcoming'),
(129, 3, 'Skit', 'Group', 'Upcoming'),
(130, 3, 'Short Film Making', 'Group', 'Upcoming'),
(131, 3, 'Script Writing', 'Solo', 'Upcoming'),
(132, 4, 'Elocution', 'Solo', 'Upcoming'),
(133, 4, 'Poem Recitation', 'Solo', 'Upcoming'),
(134, 4, 'Film Review', 'Solo', 'Upcoming'),
(135, 4, 'Extempore', 'Solo', 'Upcoming'),
(136, 4, 'Quiz', 'Group', 'Upcoming'),
(137, 4, 'Debate', 'Group', 'Upcoming'),
(138, 4, 'Ad Making', 'Group', 'Upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `dateofjoining` date NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `id` int(11) NOT NULL,
  `participantid` int(11) DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblinstitute`
--

CREATE TABLE `tblinstitute` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(8) NOT NULL,
  `academicyearid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblinstitute`
--

INSERT INTO `tblinstitute` (`id`, `name`, `status`, `academicyearid`) VALUES
(1, 'Babu Madhav Institute of Information Technology', 'Active', 2),
(2, 'Chhotubhai Gopalbhai Patel Institute of Technology', 'Active', 2),
(3, 'Shrimad Rajchandra Institute of Management and Computer Application', 'Active', 2),
(4, 'Bhulabhai Vanmalibhai Patel Institute of Computer Science', 'Active', 2),
(5, 'Maliba Pharmacy College', 'Active', 2),
(6, 'The Department of Humanities', 'Active', 2),
(7, 'Shrimad Rajchandra College of Physiotherapy', 'Active', 2),
(8, 'Kishorbhai Institute of Agriculture Sciences and Research Centre', 'Active', 2),
(9, 'Department of Mathematics', 'Active', 2),
(10, 'Department of Physics', 'Active', 2),
(11, 'Department of English', 'Active', 2),
(12, 'C. G. Bhakta Institute of Biotechnology', 'Active', 2),
(13, 'Bhulabhai Vanmalibhai Patel Institute of Management', 'Active', 2),
(14, 'Jaymin School of Fashion Design and Technology', 'Active', 2),
(15, 'Babu Madhav Institute of Information Technology', 'Active', 1),
(16, 'Chhotubhai Gopalbhai Patel Institute of Technology', 'Active', 1),
(17, 'Bhulabhai Vanmalibhai Patel Institute of Computer Science', 'Active', 1),
(18, 'Maliba Pharmacy College', 'Active', 1),
(19, 'The Department of Humanities', 'Active', 1),
(20, 'Shrimad Rajchandra College of Physiotherapy', 'Active', 1),
(21, 'Kishorbhai Institute of Agriculture Sciences and Research Centre', 'Active', 1),
(22, 'Bhulabhai Vanmalibhai Patel Institute of Management', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblparticipants`
--

CREATE TABLE `tblparticipants` (
  `id` int(11) NOT NULL,
  `enro` varchar(20) DEFAULT NULL,
  `eventsubcatagoryid` int(11) DEFAULT NULL,
  `team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `participantid` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsemesterdivision`
--

CREATE TABLE `tblsemesterdivision` (
  `id` int(11) NOT NULL,
  `semesterid` int(11) DEFAULT NULL,
  `divisionid` int(11) DEFAULT NULL,
  `academicyearid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `enro` varchar(20) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `semdivid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `cityid` int(11) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `contact` bigint(20) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `password` varchar(21) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `academicyearid` (`academicyearid`);

--
-- Indexes for table `tbleventcordinator`
--
ALTER TABLE `tbleventcordinator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eventsubcatagoryid` (`eventsubcatagoryid`),
  ADD KEY `facultyid` (`facultyid`);

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
  ADD KEY `semdivid` (`semdivid`);

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
-- AUTO_INCREMENT for table `tblacademicyear`
--
ALTER TABLE `tblacademicyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcity`
--
ALTER TABLE `tblcity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldepartment`
--
ALTER TABLE `tbldepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbldivision`
--
ALTER TABLE `tbldivision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblevalutioncriteria`
--
ALTER TABLE `tblevalutioncriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbleventcatagory`
--
ALTER TABLE `tbleventcatagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbleventcordinator`
--
ALTER TABLE `tbleventcordinator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbleventschedule`
--
ALTER TABLE `tbleventschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbleventsubcatagory`
--
ALTER TABLE `tbleventsubcatagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinstitute`
--
ALTER TABLE `tblinstitute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblparticipants`
--
ALTER TABLE `tblparticipants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsemester`
--
ALTER TABLE `tblsemester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsemesterdivision`
--
ALTER TABLE `tblsemesterdivision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `tbleventcatagory`
--
ALTER TABLE `tbleventcatagory`
  ADD CONSTRAINT `tbleventcatagory_ibfk_1` FOREIGN KEY (`academicyearid`) REFERENCES `tblacademicyear` (`id`);

--
-- Constraints for table `tbleventcordinator`
--
ALTER TABLE `tbleventcordinator`
  ADD CONSTRAINT `tbleventcordinator_ibfk_1` FOREIGN KEY (`eventsubcatagoryid`) REFERENCES `tbleventsubcatagory` (`id`),
  ADD CONSTRAINT `tbleventcordinator_ibfk_2` FOREIGN KEY (`facultyid`) REFERENCES `tblfaculty` (`id`);

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
  ADD CONSTRAINT `tblstudent_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblstudent_ibfk_2` FOREIGN KEY (`semdivid`) REFERENCES `tblsemesterdivision` (`id`);

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
