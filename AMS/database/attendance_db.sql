-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 08:57 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `std_roll_no` int(11) NOT NULL,
  `student_name` varchar(32) CHARACTER SET latin1 NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) CHARACTER SET latin1 NOT NULL,
  `email` varchar(64) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Session` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `semester` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `Program` varchar(40) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`std_roll_no`, `student_name`, `dob`, `gender`, `email`, `phone`, `address`, `Session`, `semester`, `Program`) VALUES
(12, 'Ndakwa David', '1995-06-07', 'male', 'ndakwadavid@gmail.com', '0790136785', 'bungoma', '2015-2019', '8th', 'BSCS'),
(15, 'Josephine', '1997-06-27', 'female', 'josephine@gmail.com', '099877555', 'Kisumu', '2017-2021', '4th', 'IT'),
(16, 'Alloice', '1997-05-06', 'male', 'alloice@gmail.com', '09887776655', 'Kisumu', '2015-2019', '8th', 'BSCS'),
(17, 'Bin Bonny', '1998-02-23', 'male', 'bin@gmail.com', '099767', 'nairobi', '2017-2021', '4th', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `Unitid` int(11) NOT NULL,
  `Unitname` varchar(32) NOT NULL,
  `lecturername` varchar(64) NOT NULL,
  `field` varchar(8) NOT NULL,
  `semester` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_table`
--

INSERT INTO `subject_table` (`Unitid`, `Unitname`, `lecturername`, `field`, `semester`) VALUES
(12, 'C++', 'Arnold Peter', 'BSCS', '8th'),
(15, 'OOP', 'Audrey Mbogho', 'BSCS', '8th'),
(16, 'MP', 'Zachary Mwangi', 'MCS', '4th'),
(17, 'Java', 'Arnold Peter', 'IT', '4th');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_table`
--

CREATE TABLE `teacher_table` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(8) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `degree` varchar(32) NOT NULL,
  `salary` varchar(64) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_table`
--

INSERT INTO `teacher_table` (`id`, `first_name`, `last_name`, `dob`, `gender`, `email`, `phone`, `degree`, `salary`, `address`) VALUES
(6, 'Peninnah', 'Limo', '1970-03-12', 'Female', 'peninnah@gmail.com', '079076553', 'P.HD', '100000', 'Kilifi'),
(8, 'Arnold', 'Peter', '1975-06-02', 'male', 'arnold@gmail.com', '079909877676', 'Master', '50000', 'Nairobi'),
(9, 'Zachary', 'Mwangi', '1975-06-02', 'male', 'zachary@gmail.com', '079909877', 'Master', '50000', 'Nairobi'),
(10, 'Audrey', 'Mbogho', '1971-10-21', 'female', 'audrey@gmail.com', '07236785', 'Professor', '200000', 'Kilifi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `confirmpassword` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` int(32) NOT NULL,
  `usertype` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `activate` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `resettoken` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resetcomplete` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `username`, `email`, `password`, `confirmpassword`, `mobile_no`, `usertype`, `activate`, `resettoken`, `resetcomplete`) VALUES
(1, 'Arnold', 'Arnoldpeter', 'arnold@gmail.com', '2b6d3a9a9f9d03e2338eca760ca3652b', '', 797556785, 'Lecturer', '6c43fa13763', 'a7bfa110bb246e6bada9202e60781b2f42f1447dc1e1d696d9126541b56ac91c', 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`std_roll_no`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`Unitid`);

--
-- Indexes for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `std_roll_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subject_table`
--
ALTER TABLE `subject_table`
  MODIFY `Unitid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teacher_table`
--
ALTER TABLE `teacher_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
