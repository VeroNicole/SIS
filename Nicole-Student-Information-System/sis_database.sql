-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 12:30 PM
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
-- Database: `sis_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `collid` int(11) NOT NULL,
  `collfullname` varchar(100) NOT NULL,
  `collshortname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`collid`, `collfullname`, `collshortname`) VALUES
(1, 'Southern Leyte State University - San Juan', 'SLSU San Juan'),
(2, 'Southern Leyte State University - SOGOD', 'SLSU MAIN'),
(3, 'Southern Leyte State University - Tomas Oppus', 'SLSU Tomas Oppus'),
(4, 'Southern Leyte State University - Hinunangan', 'SLSU Hinunangan'),
(5, 'Southern Leyte State University - Maasin', 'SLSU Maasin');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `deptid` int(11) NOT NULL,
  `deptfullname` varchar(100) NOT NULL,
  `deptshortname` varchar(20) DEFAULT NULL,
  `deptcollid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`deptid`, `deptfullname`, `deptshortname`, `deptcollid`) VALUES
(5002, 'Information and Technology', 'Infotech', 1);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `progid` int(11) NOT NULL,
  `progfullname` varchar(100) NOT NULL,
  `progshortname` varchar(20) DEFAULT NULL,
  `progcollid` int(11) NOT NULL,
  `progcolldeptid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`progid`, `progfullname`, `progshortname`, `progcollid`, `progcolldeptid`) VALUES
(1, 'A', 'A', 1, 5002);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studid` int(11) NOT NULL,
  `studfirstname` varchar(50) NOT NULL,
  `studlastname` varchar(50) NOT NULL,
  `studmidname` varchar(50) DEFAULT NULL,
  `studprogid` int(11) NOT NULL,
  `studcollid` int(11) NOT NULL,
  `studyear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studid`, `studfirstname`, `studlastname`, `studmidname`, `studprogid`, `studcollid`, `studyear`) VALUES
(2024000001, 'Nicole', 'Vero', 'p', 1001, 1, 2),
(2024000002, 'Nicole', 'Vero', 'P.', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(2, 'nicole', '$2y$10$QmOI9zu1MPfXgpKVvMFSA.nRKvh0otvacbf2CIYMRmpcqZpSsFGmK'),
(3, 'nicole', '$2y$10$6CEGRv/dJeD6hbFwceKZvugIHievMe5M2D.4leaCWXNrnjJWl8Xgm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`collid`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`deptid`),
  ADD KEY `fk_department_college_id` (`deptcollid`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`progid`),
  ADD KEY `fk_program_college_id` (`progcollid`),
  ADD KEY `fk_program_college_department_id` (`progcolldeptid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studid`),
  ADD KEY `fk_student_college_id` (`studcollid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `fk_department_college_id` FOREIGN KEY (`deptcollid`) REFERENCES `colleges` (`collid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `fk_program_college_department_id` FOREIGN KEY (`progcolldeptid`) REFERENCES `departments` (`deptid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_program_college_id` FOREIGN KEY (`progcollid`) REFERENCES `colleges` (`collid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_student_college_id` FOREIGN KEY (`studcollid`) REFERENCES `colleges` (`collid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
