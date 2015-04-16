-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2015 at 06:56 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testingcenterdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
`appointment_id` int(11) NOT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `checkin_time` datetime DEFAULT NULL,
  `checkout_time` datetime DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `start_time`, `end_time`, `checkin_time`, `checkout_time`, `exam_id`, `seat_number`) VALUES
(1, 123, '2015-03-07 22:14:00', '2015-02-20 00:00:00', NULL, NULL, 1, 1),
(2, 1, NULL, NULL, NULL, NULL, 1, NULL),
(3, 2, NULL, NULL, NULL, NULL, 1, NULL),
(6, 1, '2015-04-01 09:00:00', '0000-00-00 00:00:00', NULL, NULL, 1, 2),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
`exam_id` int(11) NOT NULL,
  `exam_name` varchar(45) DEFAULT NULL,
  `instructor_id` int(45) DEFAULT NULL,
  `allowance_time` int(11) DEFAULT NULL,
  `comments` varchar(1000) DEFAULT '',
  `allowed_items` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `exam_name`, `instructor_id`, `allowance_time`, `comments`, `allowed_items`) VALUES
(1, 'operatying systems final', NULL, 90, NULL, NULL),
(2, 'Algorithms', NULL, 120, NULL, NULL),
(3, 'Software Engineering 1', NULL, 60, 'No notes.', 'Calculator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email_address` varchar(45) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_address`, `role`) VALUES
(1, 'test1', 'person1', 'fdjsl@jfd.com', 2),
(2, 'testtwo', 'persontwo', 'fdl@jklfd.com', 2),
(3, 'test3', 'person3', 'fdjksljfe@jfkdl.com', 2),
(4, 'test4', 'person4', 'fifjdsl@jfdl.com', NULL),
(5, 'test5', 'person5', 'test5@person5.com', NULL),
(123, 'test', 'person', 'test@person.com', 1),
(213, 'test2', 'person2', 'test2@perosn.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
 ADD PRIMARY KEY (`appointment_id`), ADD KEY `exam_id` (`exam_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
 ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`),
ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
