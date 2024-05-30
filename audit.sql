-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 08:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(99) NOT NULL,
  `first` varchar(99) NOT NULL,
  `last` varchar(99) NOT NULL,
  `username` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `first`, `last`, `username`, `password`) VALUES
(14, 'Admin', '', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `year_established` varchar(255) DEFAULT NULL,
  `num_of_storey` int(11) DEFAULT NULL,
  `building_type` varchar(255) DEFAULT NULL,
  `building_structure` varchar(255) DEFAULT NULL,
  `design_occupancy` varchar(255) DEFAULT NULL,
  `physical_condition` text DEFAULT NULL,
  `vulnerability` text DEFAULT NULL,
  `report_images` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `door1` varchar(64) NOT NULL,
  `door2` varchar(64) NOT NULL,
  `door3` varchar(64) NOT NULL,
  `entrance1` varchar(64) NOT NULL,
  `entrance2` varchar(65) NOT NULL,
  `corridor1` varchar(64) NOT NULL,
  `corridor2` varchar(64) NOT NULL,
  `corridor3` varchar(64) NOT NULL,
  `corridor4` varchar(64) NOT NULL,
  `signage1` varchar(64) NOT NULL,
  `signage2` varchar(64) NOT NULL,
  `signage3` varchar(64) NOT NULL,
  `signage4` varchar(64) NOT NULL,
  `washroom1` varchar(64) NOT NULL,
  `washroom2` varchar(64) NOT NULL,
  `washroom3` varchar(64) NOT NULL,
  `washroom4` varchar(64) NOT NULL,
  `washroom5` varchar(64) NOT NULL,
  `washroom6` varchar(64) NOT NULL,
  `washroom7` varchar(64) NOT NULL,
  `washroom8` varchar(64) NOT NULL,
  `washroom9` varchar(64) NOT NULL,
  `washroom10` varchar(64) NOT NULL,
  `washroom11` varchar(64) NOT NULL,
  `ramps1` varchar(64) NOT NULL,
  `ramps2` varchar(64) NOT NULL,
  `ramps3` varchar(64) NOT NULL,
  `ramps4` varchar(64) NOT NULL,
  `ramps5` varchar(64) NOT NULL,
  `ramps6` varchar(64) NOT NULL,
  `ramps7` varchar(64) NOT NULL,
  `ramps8` varchar(64) NOT NULL,
  `ramps9` varchar(64) NOT NULL,
  `parking1` varchar(64) NOT NULL,
  `parking2` varchar(64) NOT NULL,
  `parking3` varchar(64) NOT NULL,
  `elevator1` varchar(64) NOT NULL,
  `elevator2` varchar(64) NOT NULL,
  `elevator3` varchar(64) NOT NULL,
  `stairs1` varchar(64) NOT NULL,
  `stairs2` varchar(64) NOT NULL,
  `stairs3` varchar(64) NOT NULL,
  `stairs4` varchar(64) NOT NULL,
  `stairs5` varchar(64) NOT NULL,
  `recommendation` varchar(100) NOT NULL,
  `physical1` varchar(64) NOT NULL,
  `physical2` varchar(64) NOT NULL,
  `physical3` varchar(64) NOT NULL,
  `physical4` varchar(64) NOT NULL,
  `renovated` varchar(64) NOT NULL,
  `rvs` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `company`, `building_name`, `location`, `year_established`, `num_of_storey`, `building_type`, `building_structure`, `design_occupancy`, `physical_condition`, `vulnerability`, `report_images`, `images`, `door1`, `door2`, `door3`, `entrance1`, `entrance2`, `corridor1`, `corridor2`, `corridor3`, `corridor4`, `signage1`, `signage2`, `signage3`, `signage4`, `washroom1`, `washroom2`, `washroom3`, `washroom4`, `washroom5`, `washroom6`, `washroom7`, `washroom8`, `washroom9`, `washroom10`, `washroom11`, `ramps1`, `ramps2`, `ramps3`, `ramps4`, `ramps5`, `ramps6`, `ramps7`, `ramps8`, `ramps9`, `parking1`, `parking2`, `parking3`, `elevator1`, `elevator2`, `elevator3`, `stairs1`, `stairs2`, `stairs3`, `stairs4`, `stairs5`, `recommendation`, `physical1`, `physical2`, `physical3`, `physical4`, `renovated`, `rvs`) VALUES
(54, 'Cavite State University', 'College of Engineering and Information Technology', 'Indang', '1985', 6, 'Composite Steel-Concrete', 'Rolled Section', 'School', '', 'SchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchoolSchool', 'uploads/664b6c1539ea5_Cavite_State_University.png__50499.png,uploads/664b6c153a069_ready.jpeg', 'uploads/664b6c1539ca6_ready.jpeg', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Comply', 'Comply', 'Not Applicable', 'Not Applicable', 'Comply', 'Not Applicable', 'Comply', 'Not Comply', 'Not Comply', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Comply', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Comply', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Comply', 'Not Applicable', 'Not Applicable', 'Not Applicable', 'Comply', 'SchoolSchoolSchoolSchoolSchoolSchool', 'Presence of minor structural defects', 'Presence of minor structural defects', 'Presence of some severe defect found (see photos)', 'Presence of multiple severe defects requiring investigation', 'Not Renovated', '2'),
(56, '', '', '', '', 0, '', '', '', '', '', 'uploads/664adeccf1e94_Activity Diagram (w_o edit).drawio.png,uploads/664adeccf2008_Activity diagram.drawio.png', 'uploads/664adeccf190d_Activity Diagram (w_o edit).drawio.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(57, '', '', '', '', 0, '', '', '', '', '', 'uploads/664af17932b02_Activity Diagram (w_o edit).drawio.png,uploads/664af17932f16_Activity diagram.drawio.png', 'uploads/664af17932879_Activity diagram.drawio.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(59, '', '', '', '', 0, '', '', '', '', '', 'uploads/664af5878bdb8_Activity diagram.drawio.png', 'uploads/664af5878baf9_Activity Diagram (w_o edit).drawio.png', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(67, 'com1', 'asd', 'asd', 'asd', 0, 'Reinforced Concrete Shear Wall', 'Build-up Section', 'School', '', 'asdasdsa', 'uploads/664b31fd71ea7_Cavite_State_University.png__50499.png,uploads/664b31fd7225a_ready.jpeg', 'uploads/664b31fd7188b_Cavite_State_University.png__50499.png', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'asdasda', 'Presence of minor structural defects', 'Presence of minor structural defects', 'No adverse defects', 'Presence of minor structural defects', 'Not Renovated', '12312'),
(69, '', '', '', '', 0, '', '', 'ASDASD', '', 'asda', 'uploads/664b33d7a0554_Cavite_State_University.png__50499.png', 'uploads/664b33d7a0350_Cavite_State_University.png__50499.png', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'asdasd', 'No adverse defects', 'Presence of some severe defect found (see photos)', 'Presence of some severe defect found (see photos)', 'Presence of minor structural defects', 'Renovated', '123'),
(70, 'Cavite State University', 'asdasd', 'asdas', 'aasda', 0, 'Steel Frame', 'Build-up Section', 'asda', '', 'asdasdas', '', 'uploads/664b4e1d0e4a4_building 2.JPG', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'asdasdasd', 'Presence of minor structural defects', 'Presence of minor structural defects', 'Presence of minor structural defects', 'Presence of minor structural defects', 'Not Renovated', ''),
(71, 'Cavite State University', 'asdasd', 'asdas', 'aasda', 0, 'Steel Frame', 'Build-up Section', 'asda', '', 'asdasd', '', 'uploads/664b4891dd586_ready.jpeg', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'asdasd', 'Presence of multiple severe defects requiring investigation', 'Presence of multiple severe defects requiring investigation', 'Presence of minor structural defects', 'Presence of some severe defect found (see photos)', 'Not Renovated', 'asdasd'),
(72, 'Cavite State University', 'try', 'try', '2222', 2, 'Reinforced Concrete Shear Wall', 'Rolled Section', 'try', '', 'trytrytry', 'uploads/66546eef0687c_Activity Diagram Admin.drawio.png,uploads/66546eef06a7d_Activity Diagram Attendee.drawio.png,uploads/66546eef06c2a_Activity Diagram Implementor.drawio.png', 'uploads/66546eef0649c_Activity Diagram Admin.drawio.png', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'Comply', 'trytry', 'Presence of minor structural defects', 'Presence of minor structural defects', 'Presence of some severe defect found (see photos)', 'Presence of minor structural defects', 'Renovated', '22');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `companyName`) VALUES
(25, 'Cavite State University'),
(55, 'add532'),
(56, 'add34'),
(58, 'asdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
