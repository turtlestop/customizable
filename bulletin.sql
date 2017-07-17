-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 13, 2016 at 10:19 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bulletin`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulletin`
--

CREATE TABLE `bulletin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `msg` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulletin`
--

INSERT INTO `bulletin` (`id`, `name`, `msg`, `timestamp`, `image`) VALUES
(77, 'Matthew', 'We can add also upload images.', '2016-07-11 19:42:59', 'imageuploads/5783f6c3a5dbf.jpg'),
(79, 'Marco', 'Another message!', '2016-07-11 19:48:38', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('pelican', 'elephant');

-- --------------------------------------------------------

--
-- Table structure for table `pdfdocs`
--

CREATE TABLE `pdfdocs` (
  `id` int(11) NOT NULL,
  `filepath` text NOT NULL,
  `filename` text NOT NULL,
  `columncat` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pdfdocs`
--

INSERT INTO `pdfdocs` (`id`, `filepath`, `filename`, `columncat`) VALUES
(16, 'pdfs/building/Entire building map.pdf', 'Building Map', 'building'),
(17, 'pdfs/building/Phone Instructions.pdf', 'Phone Instructions', 'building'),
(20, 'pdfs/today/TNSprodsched.pdf', 'Production Menu', 'today'),
(24, 'pdfs/staff/CREWFACEBOOK.pdf', 'Crew Photos', 'staff'),
(25, 'pdfs/staff/Staff Face Book.pdf', 'Staff Photos', 'staff'),
(26, 'pdfs/staff/Intern Facebook.pdf', 'Intern Photos', 'staff'),
(27, 'pdfs/staff/Contact Sheet.pdf', 'Contact Sheet', 'staff'),
(29, 'pdfs/forms/checkrequest.pdf', 'Check Request', 'forms'),
(39, 'pdfs/calendar/calendar.pdf', 'Calendar', 'calendar'),
(42, 'pdfs/today/LunchMenu.pdf', 'Lunch Menu', 'today'),
(43, 'pdfs/forms/pettycash.pdf', 'Check Request', 'forms'),
(44, 'pdfs/forms/AMEXreceipt.pdf', 'Amex Receipt', 'forms'),
(45, 'pdfs/staff/Extension list.pdf', 'Extension List', 'staff'),
(46, 'pdfs/calendar/future.pdf', 'The Future', 'calendar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulletin`
--
ALTER TABLE `bulletin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdfdocs`
--
ALTER TABLE `pdfdocs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulletin`
--
ALTER TABLE `bulletin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `pdfdocs`
--
ALTER TABLE `pdfdocs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
