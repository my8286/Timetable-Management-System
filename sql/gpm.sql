-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 06:45 PM
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
-- Database: `gpm`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject`
--

CREATE TABLE `assign_subject` (
  `subject_id` int(11) NOT NULL,
  `shift` varchar(5) NOT NULL,
  `type` varchar(5) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `dept` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_subject`
--

INSERT INTO `assign_subject` (`subject_id`, `shift`, `type`, `batch`, `dept`) VALUES
(1, 'fs', 'pr', 'a', 'if'),
(1, 'fs', 'pr', 'b', 'if'),
(1, 'fs', 'pr', 'c', 'if'),
(1, 'fs', 'th', 'null', 'if'),
(1, 'ss', 'pr', 'a', 'if'),
(1, 'ss', 'pr', 'b', 'if'),
(1, 'ss', 'pr', 'c', 'if'),
(1, 'ss', 'th', 'null', 'if'),
(4, 'fs', 'pr', 'a', 'if'),
(4, 'fs', 'pr', 'b', 'if'),
(4, 'fs', 'pr', 'c', 'if'),
(4, 'fs', 'th', 'null', 'if'),
(4, 'ss', 'pr', 'a', 'if'),
(4, 'ss', 'pr', 'b', 'if'),
(4, 'ss', 'pr', 'c', 'if'),
(4, 'ss', 'th', 'null', 'if'),
(5, 'fs', 'pr', 'a', 'if'),
(5, 'fs', 'pr', 'b', 'if'),
(5, 'fs', 'pr', 'c', 'if'),
(5, 'ss', 'pr', 'a', 'if'),
(5, 'ss', 'pr', 'b', 'if'),
(5, 'ss', 'pr', 'c', 'if'),
(6, 'fs', 'pr', 'a', 'if'),
(6, 'fs', 'pr', 'b', 'if'),
(6, 'fs', 'pr', 'c', 'if'),
(6, 'fs', 'th', 'null', 'if'),
(6, 'ss', 'pr', 'a', 'if'),
(6, 'ss', 'pr', 'b', 'if'),
(6, 'ss', 'pr', 'c', 'if'),
(6, 'ss', 'th', 'null', 'if'),
(7, 'fs', 'pr', 'a', 'if'),
(7, 'fs', 'pr', 'b', 'if'),
(7, 'fs', 'pr', 'c', 'if'),
(7, 'fs', 'th', 'null', 'if'),
(7, 'ss', 'pr', 'a', 'if'),
(7, 'ss', 'pr', 'b', 'if'),
(7, 'ss', 'pr', 'c', 'if'),
(7, 'ss', 'th', 'null', 'if'),
(8, 'fs', 'pr', 'a', 'if'),
(8, 'fs', 'pr', 'b', 'if'),
(8, 'fs', 'pr', 'c', 'if'),
(8, 'fs', 'th', 'null', 'if'),
(8, 'ss', 'pr', 'a', 'if'),
(8, 'ss', 'pr', 'b', 'if'),
(8, 'ss', 'pr', 'c', 'if'),
(8, 'ss', 'th', 'null', 'if'),
(9, 'fs', 'pr', 'a', 'if'),
(9, 'fs', 'pr', 'b', 'if'),
(9, 'fs', 'pr', 'c', 'if'),
(9, 'fs', 'th', 'null', 'if'),
(9, 'ss', 'pr', 'a', 'if'),
(9, 'ss', 'pr', 'b', 'if'),
(9, 'ss', 'pr', 'c', 'if'),
(9, 'ss', 'th', 'null', 'if'),
(10, 'fs', 'pr', 'a', 'if'),
(10, 'fs', 'pr', 'b', 'if'),
(10, 'fs', 'pr', 'c', 'if'),
(10, 'fs', 'th', 'null', 'if'),
(10, 'ss', 'pr', 'a', 'if'),
(10, 'ss', 'pr', 'b', 'if'),
(10, 'ss', 'pr', 'c', 'if'),
(10, 'ss', 'th', 'null', 'if'),
(11, 'fs', 'th', 'null', 'if'),
(11, 'ss', 'th', 'null', 'if'),
(12, 'fs', 'th', 'null', 'if'),
(12, 'ss', 'th', 'null', 'if'),
(13, 'fs', 'pr', 'a', 'if'),
(13, 'fs', 'pr', 'b', 'if'),
(13, 'fs', 'pr', 'c', 'if'),
(13, 'fs', 'th', 'null', 'if'),
(13, 'ss', 'pr', 'a', 'if'),
(13, 'ss', 'pr', 'b', 'if'),
(13, 'ss', 'pr', 'c', 'if'),
(13, 'ss', 'th', 'null', 'if'),
(14, 'fs', 'pr', 'a', 'if'),
(14, 'fs', 'pr', 'b', 'if'),
(14, 'fs', 'pr', 'c', 'if'),
(14, 'fs', 'th', 'null', 'if'),
(14, 'ss', 'pr', 'a', 'if'),
(14, 'ss', 'pr', 'b', 'if'),
(14, 'ss', 'pr', 'c', 'if'),
(14, 'ss', 'th', 'null', 'if'),
(15, 'fs', 'pr', 'a', 'if'),
(15, 'fs', 'pr', 'b', 'if'),
(15, 'fs', 'pr', 'c', 'if'),
(15, 'fs', 'th', 'null', 'if'),
(15, 'ss', 'pr', 'a', 'if'),
(15, 'ss', 'pr', 'b', 'if'),
(15, 'ss', 'pr', 'c', 'if'),
(15, 'ss', 'th', 'null', 'if'),
(16, 'fs', 'pr', 'a', 'if'),
(16, 'fs', 'pr', 'b', 'if'),
(16, 'fs', 'pr', 'c', 'if'),
(16, 'ss', 'pr', 'a', 'if'),
(16, 'ss', 'pr', 'b', 'if'),
(16, 'ss', 'pr', 'c', 'if'),
(17, 'fs', 'pr', 'a', 'if'),
(17, 'fs', 'pr', 'b', 'if'),
(17, 'fs', 'pr', 'c', 'if'),
(17, 'ss', 'pr', 'a', 'if'),
(17, 'ss', 'pr', 'b', 'if'),
(17, 'ss', 'pr', 'c', 'if');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `value` varchar(30) NOT NULL,
  `field` varchar(30) NOT NULL,
  `dept` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `main_table`
--

CREATE TABLE `main_table` (
  `sr_no` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `day` varchar(5) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `year` varchar(5) NOT NULL,
  `shift` varchar(5) NOT NULL,
  `type` varchar(5) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `dept` varchar(5) NOT NULL,
  `dept2` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_table`
--

INSERT INTO `main_table` (`sr_no`, `start_time`, `end_time`, `day`, `teacher_id`, `subject_id`, `room_id`, `year`, `shift`, `type`, `batch`, `dept`, `dept2`, `semester`) VALUES
(1, 8, 9, 'mon', 7, 10, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(2, 9, 10, 'mon', 7, 10, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(3, 8, 9, 'tue', 7, 10, 4, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(4, 9, 10, 'tue', 7, 10, 4, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(5, 8, 9, 'wed', 1, 4, 4, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(6, 9, 10, 'wed', 1, 4, 4, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(7, 14, 15, 'fri', 25, 6, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(8, 14, 15, 'thu', 1, 4, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(9, 13, 14, 'mon', 1, 4, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(10, 8, 9, 'tue', 25, 6, 5, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(11, 9, 10, 'tue', 25, 6, 5, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(12, 8, 9, 'mon', 6, 5, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(13, 9, 10, 'mon', 6, 5, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(14, 8, 9, 'thu', 6, 5, 4, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(15, 9, 10, 'thu', 6, 5, 4, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(16, 8, 9, 'wed', 6, 5, 5, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(17, 9, 10, 'wed', 6, 5, 5, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(18, 8, 9, 'wed', 7, 10, 6, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(19, 9, 10, 'wed', 7, 10, 6, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(20, 8, 9, 'mon', 25, 6, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(21, 9, 10, 'mon', 25, 6, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(22, 15, 16, 'mon', 1, 4, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(23, 15, 16, 'tue', 25, 6, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(24, 8, 9, 'fri', 25, 6, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(25, 8, 9, 'thu', 1, 4, 5, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(26, 9, 10, 'thu', 1, 4, 5, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(27, 8, 9, 'thu', 5, 7, 6, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(28, 9, 10, 'thu', 5, 7, 6, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(29, 8, 9, 'tue', 5, 7, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(30, 9, 10, 'tue', 5, 7, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(31, 14, 15, 'mon', 5, 7, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(32, 14, 15, 'tue', 5, 7, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(33, 10, 11, 'tue', 5, 7, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(34, 11, 12, 'tue', 5, 7, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(35, 10, 11, 'tue', 8, 8, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(36, 11, 12, 'tue', 8, 8, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(37, 10, 11, 'thu', 8, 8, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(38, 11, 12, 'thu', 8, 8, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(39, 10, 11, 'wed', 8, 8, 4, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(40, 11, 12, 'wed', 8, 8, 4, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(41, 9, 10, 'fri', 8, 8, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(42, 15, 16, 'wed', 8, 8, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(43, 12, 13, 'fri', 8, 8, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(44, 10, 11, 'tue', 4, 8, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(45, 11, 12, 'tue', 4, 8, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(46, 10, 11, 'wed', 4, 8, 5, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(47, 11, 12, 'wed', 4, 8, 5, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(48, 10, 11, 'wed', 9, 9, 6, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(49, 11, 12, 'wed', 9, 9, 6, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(50, 10, 11, 'thu', 9, 9, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(51, 11, 12, 'thu', 9, 9, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(52, 10, 11, 'fri', 8, 8, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(53, 11, 12, 'fri', 8, 8, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(54, 10, 11, 'fri', 9, 9, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(55, 11, 12, 'fri', 9, 9, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(56, 14, 15, 'wed', 9, 9, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(57, 10, 11, 'mon', 9, 9, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(58, 13, 14, 'fri', 9, 9, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(59, 10, 11, 'thu', 12, 9, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(60, 11, 12, 'thu', 12, 9, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(61, 10, 11, 'fri', 12, 9, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(62, 11, 12, 'fri', 12, 9, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(63, 12, 13, 'tue', 9, 9, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(64, 13, 14, 'tue', 9, 9, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(65, 12, 13, 'tue', 1, 4, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(66, 13, 14, 'tue', 1, 4, 5, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(67, 12, 13, 'tue', 7, 10, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(68, 13, 14, 'tue', 7, 10, 6, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(69, 12, 13, 'thu', 7, 10, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(70, 13, 14, 'thu', 7, 10, 4, 'sy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(71, 12, 13, 'wed', 25, 6, 4, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(72, 13, 14, 'wed', 25, 6, 4, 'sy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(73, 12, 13, 'wed', 7, 10, 5, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(74, 13, 14, 'wed', 7, 10, 5, 'sy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(75, 11, 12, 'mon', 7, 10, 1, 'sy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(76, 10, 11, 'fri', 6, 11, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(77, 14, 15, 'tue', 6, 11, 2, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(78, 11, 12, 'mon', 6, 11, 2, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(79, 13, 14, 'wed', 12, 12, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(80, 13, 14, 'thu', 12, 12, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(81, 13, 14, 'fri', 12, 12, 2, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(82, 8, 9, 'tue', 1, 17, 7, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(83, 9, 10, 'tue', 1, 17, 7, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(84, 8, 9, 'wed', 10, 13, 7, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(85, 9, 10, 'wed', 10, 13, 7, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(86, 8, 9, 'thu', 10, 13, 7, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(87, 9, 10, 'thu', 10, 13, 7, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(88, 8, 9, 'fri', 10, 13, 4, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(89, 9, 10, 'fri', 10, 13, 4, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(90, 10, 11, 'tue', 10, 13, 7, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(91, 11, 12, 'tue', 10, 13, 7, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(92, 8, 9, 'mon', 10, 13, 7, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(93, 9, 10, 'mon', 10, 13, 7, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(94, 14, 15, 'mon', 10, 13, 2, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(95, 11, 12, 'fri', 10, 13, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(96, 12, 13, 'mon', 10, 13, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(97, 8, 9, 'mon', 1, 17, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(98, 9, 10, 'mon', 1, 17, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(99, 8, 9, 'tue', 11, 14, 8, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(100, 9, 10, 'tue', 11, 14, 8, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(101, 8, 9, 'wed', 11, 14, 8, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(102, 9, 10, 'wed', 11, 14, 8, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(103, 12, 13, 'tue', 11, 14, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(104, 12, 13, 'wed', 11, 14, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(105, 12, 13, 'thu', 11, 14, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(106, 8, 9, 'wed', 2, 15, 9, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(107, 9, 10, 'wed', 2, 15, 9, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(108, 8, 9, 'mon', 2, 15, 9, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(109, 9, 10, 'mon', 2, 15, 9, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(110, 8, 9, 'tue', 13, 16, 9, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(111, 9, 10, 'tue', 13, 16, 9, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(112, 12, 13, 'fri', 2, 15, 2, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(113, 13, 14, 'mon', 2, 15, 2, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(114, 13, 14, 'tue', 2, 15, 1, 'ty', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(115, 8, 9, 'thu', 11, 14, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(116, 9, 10, 'thu', 11, 14, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(117, 8, 9, 'thu', 13, 16, 9, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(118, 9, 10, 'thu', 13, 16, 9, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(119, 8, 9, 'fri', 2, 15, 5, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(120, 9, 10, 'fri', 2, 15, 5, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(121, 10, 11, 'tue', 13, 16, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(122, 11, 12, 'tue', 13, 16, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(123, 8, 9, 'fri', 13, 16, 6, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(124, 9, 10, 'fri', 13, 16, 6, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(125, 10, 11, 'wed', 13, 16, 7, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(126, 11, 12, 'wed', 13, 16, 7, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(127, 10, 11, 'wed', 10, 13, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(128, 11, 12, 'wed', 10, 13, 8, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(129, 10, 11, 'wed', 1, 17, 9, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(130, 11, 12, 'wed', 1, 17, 9, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(131, 10, 11, 'thu', 13, 16, 7, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(132, 11, 12, 'thu', 13, 16, 7, 'ty', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(133, 10, 11, 'thu', 1, 17, 8, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(134, 11, 12, 'thu', 1, 17, 8, 'ty', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(135, 10, 11, 'tue', 2, 17, 9, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(136, 11, 12, 'tue', 2, 17, 9, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(137, 10, 11, 'thu', 2, 17, 9, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(138, 11, 12, 'thu', 2, 17, 9, 'ty', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(139, 16, 17, 'mon', 1, 4, 4, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(140, 17, 18, 'mon', 1, 4, 4, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(141, 16, 17, 'tue', 17, 10, 4, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(142, 17, 18, 'tue', 17, 10, 4, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(143, 16, 17, 'wed', 15, 7, 4, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(144, 17, 18, 'wed', 15, 7, 4, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(145, 12, 13, 'mon', 15, 7, 10, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(146, 12, 13, 'fri', 15, 7, 10, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(147, 13, 14, 'tue', 17, 10, 2, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(148, 13, 14, 'mon', 3, 8, 3, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(149, 11, 12, 'wed', 19, 9, 2, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(150, 16, 17, 'tue', 16, 5, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(151, 17, 18, 'tue', 16, 5, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(152, 16, 17, 'mon', 20, 8, 5, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(153, 17, 18, 'mon', 20, 8, 5, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(154, 16, 17, 'thu', 20, 8, 4, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(155, 17, 18, 'thu', 20, 8, 4, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(156, 16, 17, 'wed', 20, 8, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(157, 17, 18, 'wed', 20, 8, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(158, 16, 17, 'fri', 20, 8, 4, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(159, 17, 18, 'fri', 20, 8, 4, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(160, 14, 15, 'tue', 20, 8, 4, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(161, 15, 16, 'tue', 20, 8, 4, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(162, 16, 17, 'thu', 15, 7, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(163, 17, 18, 'thu', 15, 7, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(164, 16, 17, 'wed', 25, 6, 6, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(165, 17, 18, 'wed', 25, 6, 6, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(166, 16, 17, 'fri', 19, 9, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(167, 17, 18, 'fri', 19, 9, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(168, 16, 17, 'thu', 1, 4, 6, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(169, 17, 18, 'thu', 1, 4, 6, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(170, 11, 12, 'thu', 3, 8, 1, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(171, 13, 14, 'fri', 19, 9, 3, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(172, 11, 12, 'tue', 19, 9, 2, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(173, 16, 17, 'mon', 22, 9, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(174, 17, 18, 'mon', 22, 9, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(175, 16, 17, 'tue', 22, 9, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(176, 17, 18, 'tue', 22, 9, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(177, 14, 15, 'tue', 19, 9, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(178, 15, 16, 'tue', 19, 9, 5, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(179, 14, 15, 'tue', 17, 10, 6, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(180, 15, 16, 'tue', 17, 10, 6, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(181, 16, 17, 'fri', 17, 10, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(182, 17, 18, 'fri', 17, 10, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(183, 14, 15, 'thu', 17, 10, 4, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(184, 15, 16, 'thu', 17, 10, 4, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(185, 14, 15, 'wed', 15, 7, 4, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(186, 15, 16, 'wed', 15, 7, 4, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(187, 14, 15, 'wed', 17, 10, 5, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(188, 15, 16, 'wed', 17, 10, 5, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(189, 10, 11, 'wed', 3, 8, 2, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(190, 12, 13, 'fri', 16, 11, 3, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(191, 11, 12, 'mon', 16, 11, 3, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(192, 13, 14, 'wed', 3, 13, 3, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(193, 11, 12, 'wed', 22, 12, 1, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(194, 12, 13, 'mon', 22, 12, 3, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(195, 12, 13, 'wed', 22, 12, 2, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(196, 16, 17, 'tue', 3, 13, 7, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(197, 17, 18, 'tue', 3, 13, 7, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(198, 16, 17, 'wed', 3, 13, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(199, 17, 18, 'wed', 3, 13, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(200, 16, 17, 'thu', 3, 13, 7, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(201, 17, 18, 'thu', 3, 13, 7, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(202, 16, 17, 'fri', 3, 13, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(203, 17, 18, 'fri', 3, 13, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(204, 12, 13, 'thu', 3, 13, 2, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(205, 11, 12, 'tue', 3, 13, 1, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(206, 16, 17, 'mon', 16, 11, 1, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(207, 14, 15, 'wed', 20, 13, 6, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(208, 15, 16, 'wed', 20, 13, 6, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(209, 14, 15, 'thu', 20, 13, 5, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(210, 15, 16, 'thu', 20, 13, 5, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(211, 16, 17, 'wed', 21, 14, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(212, 17, 18, 'wed', 21, 14, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(213, 16, 17, 'tue', 21, 14, 8, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(214, 17, 18, 'tue', 21, 14, 8, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(215, 16, 17, 'thu', 21, 14, 8, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(216, 17, 18, 'thu', 21, 14, 8, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(217, 13, 14, 'fri', 21, 14, 10, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(218, 13, 14, 'mon', 21, 14, 10, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(219, 13, 14, 'thu', 21, 14, 3, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(220, 16, 17, 'thu', 24, 15, 9, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(221, 17, 18, 'thu', 24, 15, 9, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(222, 16, 17, 'tue', 24, 15, 9, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(223, 17, 18, 'tue', 24, 15, 9, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(224, 14, 15, 'tue', 3, 17, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(225, 15, 16, 'tue', 3, 17, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(226, 14, 15, 'fri', 3, 17, 4, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(227, 15, 16, 'fri', 3, 17, 4, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(228, 14, 15, 'wed', 3, 17, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(229, 15, 16, 'wed', 3, 17, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(230, 12, 13, 'tue', 3, 17, 7, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(231, 13, 14, 'tue', 3, 17, 7, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(232, 14, 15, 'tue', 2, 17, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(233, 15, 16, 'tue', 2, 17, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(234, 14, 15, 'wed', 2, 17, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(235, 15, 16, 'wed', 2, 17, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(236, 14, 15, 'thu', 2, 15, 6, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(237, 15, 16, 'thu', 2, 15, 6, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(238, 10, 11, 'wed', 2, 15, 1, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(239, 15, 16, 'mon', 2, 15, 3, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(240, 11, 12, 'fri', 2, 15, 2, 'ty', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(241, 16, 17, 'fri', 23, 16, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(242, 17, 18, 'fri', 23, 16, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(243, 14, 15, 'thu', 23, 16, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(244, 15, 16, 'thu', 23, 16, 7, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(245, 16, 17, 'wed', 23, 16, 9, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(246, 17, 18, 'wed', 23, 16, 9, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(247, 12, 13, 'tue', 23, 16, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(248, 13, 14, 'tue', 23, 16, 8, 'ty', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(249, 14, 15, 'fri', 23, 16, 5, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(250, 15, 16, 'fri', 23, 16, 5, 'ty', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(251, 14, 15, 'tue', 23, 16, 9, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(252, 15, 16, 'tue', 23, 16, 9, 'ty', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(253, 14, 15, 'wed', 25, 6, 9, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(254, 15, 16, 'wed', 25, 6, 9, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(255, 14, 15, 'thu', 19, 9, 8, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(256, 15, 16, 'thu', 19, 9, 8, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(257, 14, 15, 'thu', 25, 6, 9, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(258, 15, 16, 'thu', 25, 6, 9, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(259, 15, 16, 'mon', 25, 6, 2, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(260, 14, 15, 'mon', 25, 6, 3, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(261, 12, 13, 'tue', 25, 6, 2, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(262, 14, 15, 'fri', 17, 10, 6, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(263, 15, 16, 'fri', 17, 10, 6, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(264, 14, 15, 'fri', 19, 9, 7, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(265, 15, 16, 'fri', 19, 9, 7, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(266, 14, 15, 'fri', 1, 4, 8, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(267, 15, 16, 'fri', 1, 4, 8, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(268, 10, 11, 'tue', 1, 4, 1, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(269, 11, 12, 'mon', 1, 4, 10, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(270, 11, 12, 'fri', 1, 4, 3, 'sy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(271, 16, 17, 'mon', 14, 1, 7, 'fy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(272, 17, 18, 'mon', 14, 1, 7, 'fy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(273, 16, 17, 'fri', 14, 1, 9, 'fy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(274, 17, 18, 'fri', 14, 1, 9, 'fy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(275, 14, 15, 'mon', 14, 1, 5, 'fy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(276, 15, 16, 'mon', 14, 1, 5, 'fy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(277, 12, 13, 'tue', 14, 1, 9, 'fy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(278, 13, 14, 'tue', 14, 1, 9, 'fy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(279, 12, 13, 'mon', 14, 1, 4, 'fy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(280, 13, 14, 'mon', 14, 1, 4, 'fy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(281, 12, 13, 'wed', 14, 1, 6, 'fy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(282, 13, 14, 'wed', 14, 1, 6, 'fy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(283, 17, 18, 'thu', 14, 1, 1, 'fy', 'ss', 'th', 'null', 'if', 'if', 'odd'),
(284, 8, 9, 'fri', 4, 1, 7, 'fy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(285, 9, 10, 'fri', 4, 1, 7, 'fy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(286, 10, 11, 'mon', 4, 1, 4, 'fy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(287, 11, 12, 'mon', 4, 1, 4, 'fy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(288, 10, 11, 'fri', 4, 1, 7, 'fy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(289, 11, 12, 'fri', 4, 1, 7, 'fy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(290, 12, 13, 'mon', 4, 1, 5, 'fy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(291, 13, 14, 'mon', 4, 1, 5, 'fy', 'fs', 'pr', 'a', 'if', 'if', 'odd'),
(292, 12, 13, 'wed', 4, 1, 7, 'fy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(293, 13, 14, 'wed', 4, 1, 7, 'fy', 'fs', 'pr', 'b', 'if', 'if', 'odd'),
(294, 12, 13, 'thu', 4, 1, 5, 'fy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(295, 13, 14, 'thu', 4, 1, 5, 'fy', 'fs', 'pr', 'c', 'if', 'if', 'odd'),
(296, 8, 9, 'tue', 4, 1, 1, 'fy', 'fs', 'th', 'null', 'if', 'if', 'odd'),
(297, 12, 13, 'wed', 20, 8, 8, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(298, 13, 14, 'wed', 20, 8, 8, 'sy', 'ss', 'pr', 'a', 'if', 'if', 'odd'),
(299, 12, 13, 'wed', 16, 5, 9, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(300, 13, 14, 'wed', 16, 5, 9, 'sy', 'ss', 'pr', 'b', 'if', 'if', 'odd'),
(301, 12, 13, 'thu', 16, 5, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd'),
(302, 13, 14, 'thu', 16, 5, 6, 'sy', 'ss', 'pr', 'c', 'if', 'if', 'odd');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `type` varchar(5) NOT NULL,
  `dept` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_no`, `type`, `dept`) VALUES
(1, '208', 'th', 'if'),
(2, '209', 'th', 'if'),
(3, '210', 'th', 'if'),
(4, '301', 'pr', 'if'),
(5, '302a', 'pr', 'if'),
(6, '302b', 'pr', 'if'),
(7, 'nac1', 'pr', 'if'),
(8, 'nac2a', 'pr', 'if'),
(9, 'nac2b', 'pr', 'if'),
(10, 'new', 'new', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(10) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `dept` varchar(5) NOT NULL,
  `year` varchar(5) NOT NULL,
  `type` varchar(5) NOT NULL,
  `practical_time` int(11) NOT NULL,
  `theory_time` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `subject_code`, `dept`, `year`, `type`, `practical_time`, `theory_time`, `semester`, `status`) VALUES
(13, 'ajava', 'if15302', 'if', 'ty', 'both', 4, 3, 'odd', 1),
(16, 'awt', 'it16311', 'if', 'ty', 'pr', 4, 0, 'odd', 0),
(1, 'bit', 'it16201', 'if', 'fy', 'both', 4, 1, 'odd', 1),
(7, 'cpm', 'it16302', 'if', 'sy', 'both', 2, 2, 'odd', 1),
(9, 'dbms', 'it16303', 'if', 'sy', 'both', 4, 3, 'odd', 1),
(6, 'dc', 'it16205', 'if', 'sy', 'both', 2, 3, 'odd', 1),
(4, 'dt', 'it16204', 'if', 'sy', 'both', 2, 3, 'odd', 1),
(11, 'is', 'it16309', 'if', 'ty', 'th', 0, 3, 'odd', 0),
(14, 'los', 'it16310', 'if', 'ty', 'both', 2, 3, 'odd', 1),
(8, 'oops', 'it16206', 'if', 'sy', 'both', 4, 3, 'odd', 1),
(5, 'pp', 'it16301', 'if', 'sy', 'pr', 2, 0, 'odd', 0),
(17, 'prj', 'it16312', 'if', 'ty', 'pr', 4, 0, 'odd', 0),
(15, 'PY', 'it16401', 'if', 'ty', 'both', 2, 3, 'odd', 1),
(12, 'se', 'if15301', 'if', 'ty', 'th', 0, 3, 'odd', 0),
(3, 'sw', 'nc16102', 'if', 'fy', 'pr', 4, 0, 'odd', 0),
(10, 'uid', 'it16304', 'if', 'sy', 'both', 4, 1, 'odd', 1),
(2, 'yoga', 'nc16101', 'if', 'fy', 'pr', 2, 0, 'odd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `teacher_code` varchar(10) NOT NULL,
  `dept` varchar(5) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `designation` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `first_name`, `middle_name`, `last_name`, `gender`, `teacher_code`, `dept`, `phone_no`, `email`, `designation`, `password`) VALUES
(2, 'madhuri', 's', 'arade', 'female', 'msa', 'if', '1234567890', 'msa@gmail.com', 'professor', ''),
(3, 'namrata', 'a', 'wankhede', 'female', 'naw', 'if', '1234567890', 'naw@gmail.com', 'professor', ''),
(1, 'rajesh', 'a', 'patil', 'male', 'rap', 'if', '1234567890', 'hod@gmail.com', 'hod', '123'),
(4, 'visitor1', 'visitor1', 'visitor1', 'female', 'v1', 'if', '1234567890', 'v1@gmail.com', 'visitor', ''),
(13, 'visitor10', 'visitor10', 'visitor10', 'female', 'v10', 'if', '1234567890', 'v10@gmail.com', 'visitor', ''),
(14, 'visitor11', 'visitor11', 'visitor11', 'female', 'v11', 'if', '1234567890', 'v11@gmail.com', 'visitor', ''),
(15, 'visitor12', 'visitor12', 'visitor12', 'female', 'v12', 'if', '1234567890', 'v12@gmail.com', 'visitor', ''),
(16, 'visitor13', 'visitor13', 'visitor13', 'female', 'v13', 'if', '1234567890', 'v13@gmail.com', 'visitor', ''),
(17, 'visitor14', 'visitor14', 'visitor14', 'female', 'v14', 'if', '1234567890', 'v14@gmail.com', 'visitor', ''),
(18, 'visitor15', 'visitor15', 'visitor15', 'female', 'v15', 'if', '1234567890', 'v15@gmail.com', 'visitor', ''),
(19, 'visitor16', 'visitor16', 'visitor16', 'female', 'v16', 'if', '1234567890', 'v16@gmail.com', 'visitor', ''),
(20, 'visitor17', 'visitor17', 'visitor17', 'female', 'v17', 'if', '1234567890', 'v17@gmail.com', 'visitor', ''),
(21, 'visitor18', 'visitor18', 'visitor18', 'female', 'v18', 'if', '1234567890', 'v18@gmail.com', 'visitor', ''),
(22, 'visitor19', 'visitor19', 'visitor19', 'female', 'v19', 'if', '1234567890', 'v19@gmail.com', 'visitor', ''),
(5, 'visitor2', 'visitor2', 'visitor2', 'female', 'v2', 'if', '1234567890', 'v2@gmail.com', 'visitor', ''),
(23, 'visitor', 'visitor', 'visitor', 'female', 'v20', 'if', '1234567890', 'v20@gmail.com', 'visitor', ''),
(24, 'visitor', 'Visitor', 'visitor', 'female', 'v21', 'if', '1234567890', 'v21@gmail.com', 'visitor', ''),
(6, 'visitor3', 'visitor3', 'visitor3', 'female', 'v3', 'if', '1234567890', 'v3@gmail.com', 'visitor', ''),
(7, 'visitor4', 'visitor4', 'visitor4', 'female', 'v4', 'if', '1234567890', 'v4@gmail.com', 'visitor', ''),
(8, 'visitor5', 'visitor5', 'visitor5', 'female', 'v5', 'if', '1234567890', 'v5@gmail.com', 'visitor', ''),
(9, 'visitor6', 'visitor6', 'visitor6', 'female', 'v6', 'if', '1234567890', 'v6@gmail.com', 'visitor', ''),
(10, 'visitor7', 'visitor7', 'visitor7', 'female', 'v7', 'if', '1234567890', 'v7@gmail.com', 'visitor', ''),
(11, 'visitor8', 'visitor8', 'visitor8', 'female', 'v8', 'if', '1234567890', 'v8@gmail.com', 'visitor', ''),
(12, 'visitor9', 'visitor9', 'visitor9', 'female', 'v9', 'if', '1234567890', 'v9@gmail.com', 'visitor', ''),
(25, 'visitorec', 'visitorec', 'visitorec', 'female', 'vec', 'if', '1234567890', 'vec@gmail.com', 'visitor', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `shift` varchar(5) NOT NULL,
  `type` varchar(5) NOT NULL,
  `batch` varchar(5) NOT NULL,
  `dept` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`teacher_id`, `subject_id`, `shift`, `type`, `batch`, `dept`) VALUES
(1, 4, 'fs', 'pr', 'a', 'if'),
(1, 4, 'fs', 'pr', 'b', 'if'),
(1, 4, 'fs', 'pr', 'c', 'if'),
(1, 4, 'fs', 'th', 'null', 'if'),
(1, 4, 'ss', 'pr', 'a', 'if'),
(1, 4, 'ss', 'pr', 'b', 'if'),
(1, 4, 'ss', 'pr', 'c', 'if'),
(1, 4, 'ss', 'th', 'null', 'if'),
(1, 17, 'fs', 'pr', 'a', 'if'),
(1, 17, 'fs', 'pr', 'b', 'if'),
(2, 15, 'fs', 'pr', 'a', 'if'),
(2, 15, 'fs', 'pr', 'b', 'if'),
(2, 15, 'fs', 'pr', 'c', 'if'),
(2, 15, 'fs', 'th', 'null', 'if'),
(2, 15, 'ss', 'pr', 'a', 'if'),
(2, 15, 'ss', 'th', 'null', 'if'),
(2, 17, 'fs', 'pr', 'c', 'if'),
(2, 17, 'ss', 'pr', 'a', 'if'),
(3, 8, 'ss', 'th', 'null', 'if'),
(3, 13, 'ss', 'pr', 'a', 'if'),
(3, 13, 'ss', 'pr', 'b', 'if'),
(3, 13, 'ss', 'th', 'null', 'if'),
(3, 17, 'ss', 'pr', 'b', 'if'),
(3, 17, 'ss', 'pr', 'c', 'if'),
(4, 1, 'fs', 'pr', 'a', 'if'),
(4, 1, 'fs', 'pr', 'b', 'if'),
(4, 1, 'fs', 'pr', 'c', 'if'),
(4, 1, 'fs', 'th', 'null', 'if'),
(4, 8, 'fs', 'pr', 'c', 'if'),
(5, 7, 'fs', 'pr', 'a', 'if'),
(5, 7, 'fs', 'pr', 'b', 'if'),
(5, 7, 'fs', 'pr', 'c', 'if'),
(5, 7, 'fs', 'th', 'null', 'if'),
(6, 5, 'fs', 'pr', 'a', 'if'),
(6, 5, 'fs', 'pr', 'b', 'if'),
(6, 5, 'fs', 'pr', 'c', 'if'),
(6, 11, 'fs', 'th', 'null', 'if'),
(7, 10, 'fs', 'pr', 'a', 'if'),
(7, 10, 'fs', 'pr', 'b', 'if'),
(7, 10, 'fs', 'pr', 'c', 'if'),
(7, 10, 'fs', 'th', 'null', 'if'),
(8, 8, 'fs', 'pr', 'a', 'if'),
(8, 8, 'fs', 'pr', 'b', 'if'),
(8, 8, 'fs', 'th', 'null', 'if'),
(9, 9, 'fs', 'pr', 'a', 'if'),
(9, 9, 'fs', 'pr', 'b', 'if'),
(9, 9, 'fs', 'th', 'null', 'if'),
(10, 13, 'fs', 'pr', 'a', 'if'),
(10, 13, 'fs', 'pr', 'b', 'if'),
(10, 13, 'fs', 'pr', 'c', 'if'),
(10, 13, 'fs', 'th', 'null', 'if'),
(11, 14, 'fs', 'pr', 'a', 'if'),
(11, 14, 'fs', 'pr', 'b', 'if'),
(11, 14, 'fs', 'pr', 'c', 'if'),
(11, 14, 'fs', 'th', 'null', 'if'),
(12, 9, 'fs', 'pr', 'c', 'if'),
(12, 12, 'fs', 'th', 'null', 'if'),
(13, 16, 'fs', 'pr', 'a', 'if'),
(13, 16, 'fs', 'pr', 'b', 'if'),
(13, 16, 'fs', 'pr', 'c', 'if'),
(14, 1, 'ss', 'pr', 'a', 'if'),
(14, 1, 'ss', 'pr', 'b', 'if'),
(14, 1, 'ss', 'pr', 'c', 'if'),
(14, 1, 'ss', 'th', 'null', 'if'),
(15, 7, 'ss', 'pr', 'a', 'if'),
(15, 7, 'ss', 'pr', 'b', 'if'),
(15, 7, 'ss', 'pr', 'c', 'if'),
(15, 7, 'ss', 'th', 'null', 'if'),
(16, 5, 'ss', 'pr', 'a', 'if'),
(16, 5, 'ss', 'pr', 'b', 'if'),
(16, 5, 'ss', 'pr', 'c', 'if'),
(16, 11, 'ss', 'th', 'null', 'if'),
(17, 10, 'ss', 'pr', 'a', 'if'),
(17, 10, 'ss', 'pr', 'b', 'if'),
(17, 10, 'ss', 'pr', 'c', 'if'),
(17, 10, 'ss', 'th', 'null', 'if'),
(19, 9, 'ss', 'pr', 'a', 'if'),
(19, 9, 'ss', 'pr', 'b', 'if'),
(19, 9, 'ss', 'th', 'null', 'if'),
(20, 8, 'ss', 'pr', 'a', 'if'),
(20, 8, 'ss', 'pr', 'b', 'if'),
(20, 8, 'ss', 'pr', 'c', 'if'),
(20, 13, 'ss', 'pr', 'c', 'if'),
(21, 14, 'ss', 'pr', 'a', 'if'),
(21, 14, 'ss', 'pr', 'b', 'if'),
(21, 14, 'ss', 'pr', 'c', 'if'),
(21, 14, 'ss', 'th', 'null', 'if'),
(22, 9, 'ss', 'pr', 'c', 'if'),
(22, 12, 'ss', 'th', 'null', 'if'),
(23, 16, 'ss', 'pr', 'a', 'if'),
(23, 16, 'ss', 'pr', 'b', 'if'),
(23, 16, 'ss', 'pr', 'c', 'if'),
(24, 15, 'ss', 'pr', 'b', 'if'),
(24, 15, 'ss', 'pr', 'c', 'if'),
(25, 6, 'fs', 'pr', 'a', 'if'),
(25, 6, 'fs', 'pr', 'b', 'if'),
(25, 6, 'fs', 'pr', 'c', 'if'),
(25, 6, 'fs', 'th', 'null', 'if'),
(25, 6, 'ss', 'pr', 'a', 'if'),
(25, 6, 'ss', 'pr', 'b', 'if'),
(25, 6, 'ss', 'pr', 'c', 'if'),
(25, 6, 'ss', 'th', 'null', 'if');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_subject`
--
ALTER TABLE `assign_subject`
  ADD UNIQUE KEY `subject_id` (`subject_id`,`shift`,`type`,`batch`,`dept`) USING BTREE;

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`dept`,`field`) USING BTREE;

--
-- Indexes for table `main_table`
--
ALTER TABLE `main_table`
  ADD UNIQUE KEY `composit_unique` (`start_time`,`end_time`,`day`,`subject_id`,`teacher_id`,`room_id`,`year`,`shift`,`type`,`dept`,`batch`,`dept2`,`semester`) USING BTREE,
  ADD KEY `sr_no` (`sr_no`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD UNIQUE KEY `composite_unique` (`room_no`,`type`,`dept`),
  ADD KEY `sr_no` (`room_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD UNIQUE KEY `composit_unique` (`subject_name`,`subject_code`,`dept`,`year`,`type`,`practical_time`,`theory_time`,`semester`) USING BTREE,
  ADD KEY `sr_no` (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD UNIQUE KEY `composit_unique` (`teacher_code`,`dept`,`designation`) USING BTREE,
  ADD KEY `sr_no` (`teacher_id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD UNIQUE KEY `composit_unique` (`teacher_id`,`subject_id`,`shift`,`type`,`batch`,`dept`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `main_table`
--
ALTER TABLE `main_table`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
