-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 03:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_ismis`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignedsubjects`
--

CREATE TABLE `assignedsubjects` (
  `assignedSubjects_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignedsubjects`
--

INSERT INTO `assignedsubjects` (`assignedSubjects_id`, `faculty_id`, `subject_id`, `time_id`) VALUES
(1, 6, 1, 1),
(2, 4, 2, 22),
(3, 5, 3, 7),
(4, 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `auth_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`auth_id`, `person_id`) VALUES
(2, 1),
(4, 1),
(1, 2),
(3, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `fname` varchar(32) DEFAULT NULL,
  `mi` char(1) DEFAULT NULL,
  `lname` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `contact` mediumtext DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `person_type` enum('Faculty','Student') DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `fname`, `mi`, `lname`, `email`, `contact`, `birthdate`, `address`, `person_type`, `status`) VALUES
(1, 'Christian', 'M', 'Maderazo', 'christianmaderazo@gmail.com', '12345', '0001-01-01', 'Talamban', 'Faculty', 'Active'),
(2, 'Lourence', 'E', 'Linao', 'lourencelinao13@gmail.com', '123', '0001-01-01', 'Firing Range Road', 'Student', 'Active'),
(3, 'Jamiel', 'N', 'Catalan', 'jamielcatalan@gmail.com', '12345', '0001-01-01', 'Firing Range Road', 'Student', 'Active'),
(4, 'Glenn', 'G', 'Pepito', 'glennpepito@gmail.com', '1234', '0001-01-01', 'Talamban', 'Faculty', 'Active'),
(5, 'Keenan', 'K', 'Mendiola', 'keenanmendiola@gmail.com', '1234', '0001-12-31', 'Talamban', 'Faculty', 'Active'),
(6, 'Christine', 'M', 'Pena', 'christinepena@gmail.com', '1234', '0001-12-03', 'Talamban', 'Faculty', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule`
--

CREATE TABLE `student_schedule` (
  `studentSchedule_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subjectSchedule_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(8) DEFAULT NULL,
  `subject_name` varchar(32) DEFAULT NULL,
  `max_students` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `max_students`) VALUES
(1, '1', 'Data Structures and Algorithims', 30),
(2, '2', 'Information Management', 30),
(3, '3', 'Web Development II', 30),
(4, '4', 'Object Oriented Programming', 30);

-- --------------------------------------------------------

--
-- Table structure for table `subject_schedule`
--

CREATE TABLE `subject_schedule` (
  `subjectSchedule_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL,
  `numberOfStudents` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_schedule`
--

INSERT INTO `subject_schedule` (`subjectSchedule_id`, `subject_id`, `faculty_id`, `time_id`, `numberOfStudents`) VALUES
(1, 1, 6, 1, 0),
(2, 2, 4, 22, 0),
(3, 3, 5, 7, 0),
(4, 4, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `time_id` int(11) NOT NULL,
  `days` varchar(3) NOT NULL,
  `time` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`time_id`, `days`, `time`) VALUES
(1, 'MWF', '7:30-8:30'),
(2, 'MWF', '8:30-9:30'),
(3, 'MWF', '9:30-10:30'),
(4, 'MWF', '10:30-11:30'),
(5, 'MWF', '11:30-12:30'),
(6, 'MWF', '12:30-1:30'),
(7, 'MWF', '1:30-2:30'),
(8, 'MWF', '2:30-3:30'),
(9, 'MWF', '3:30-4:30'),
(10, 'MWF', '4:30-5:30'),
(11, 'MWF', '5:30-6:30'),
(12, 'MWF', '6:30-7:30'),
(13, 'TTH', '7:30-8:30'),
(14, 'TTH', '8:30-9:30'),
(15, 'TTH', '9:30-10:30'),
(16, 'TTH', '10:30-11:30'),
(17, 'TTH', '11:30-12:30'),
(18, 'TTH', '12:30-1:30'),
(19, 'TTH', '1:30-2:30'),
(20, 'TTH', '2:30-3:30'),
(21, 'TTH', '3:30-4:30'),
(22, 'TTH', '4:30-5:30'),
(23, 'TTH', '5:30-6:30'),
(24, 'TTH', '6:30-7:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` int(11) NOT NULL,
  `password` varchar(32) DEFAULT 'P@ssw0rd',
  `user_type` enum('Administrator','Faculty','Student') DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `user_type`, `status`) VALUES
(1, 'P@ssw0rd', 'Administrator', 'Active'),
(2, 'P@ssw0rd', 'Student', 'Active'),
(3, 'P@ssw0rd', 'Student', 'Active'),
(4, 'P@ssw0rd', 'Faculty', 'Active'),
(5, 'P@ssw0rd', 'Faculty', 'Active'),
(6, 'P@ssw0rd', 'Faculty', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignedsubjects`
--
ALTER TABLE `assignedsubjects`
  ADD PRIMARY KEY (`assignedSubjects_id`),
  ADD KEY `fk1_assignedSubjects` (`faculty_id`),
  ADD KEY `fk2_assignedSubjects` (`subject_id`),
  ADD KEY `fk3_assignedSubjects` (`time_id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_id`),
  ADD KEY `fk_auth` (`person_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`studentSchedule_id`),
  ADD KEY `fk1_student_schedule` (`student_id`),
  ADD KEY `fk2_student_schedule` (`subjectSchedule_id`),
  ADD KEY `fk3_student_schedule` (`time_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  ADD PRIMARY KEY (`subjectSchedule_id`),
  ADD KEY `fk1_subject_schedule` (`subject_id`),
  ADD KEY `fk2_subject_schedule` (`faculty_id`),
  ADD KEY `fk3_subject_schedule` (`time_id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignedsubjects`
--
ALTER TABLE `assignedsubjects`
  MODIFY `assignedSubjects_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_schedule`
--
ALTER TABLE `student_schedule`
  MODIFY `studentSchedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  MODIFY `subjectSchedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignedsubjects`
--
ALTER TABLE `assignedsubjects`
  ADD CONSTRAINT `fk1_assignedSubjects` FOREIGN KEY (`faculty_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `fk2_assignedSubjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `fk3_assignedSubjects` FOREIGN KEY (`time_id`) REFERENCES `time` (`time_id`);

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk_auth` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `fk1_student_schedule` FOREIGN KEY (`student_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `fk2_student_schedule` FOREIGN KEY (`subjectSchedule_id`) REFERENCES `subject_schedule` (`subjectSchedule_id`),
  ADD CONSTRAINT `fk3_student_schedule` FOREIGN KEY (`time_id`) REFERENCES `subject_schedule` (`time_id`);

--
-- Constraints for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  ADD CONSTRAINT `fk1_subject_schedule` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `fk2_subject_schedule` FOREIGN KEY (`faculty_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `fk3_subject_schedule` FOREIGN KEY (`time_id`) REFERENCES `time` (`time_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`username`) REFERENCES `person` (`person_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
