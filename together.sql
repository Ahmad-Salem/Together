-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2016 at 10:12 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `together`
--

-- --------------------------------------------------------

--
-- Table structure for table `foundations`
--

CREATE TABLE `foundations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone_number1` varchar(255) NOT NULL,
  `telephone_number2` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `photo_value` blob NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `log` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fax` varchar(255) NOT NULL,
  `site_link` varchar(255) NOT NULL,
  `blue_mark` enum('0','1') NOT NULL DEFAULT '0',
  `signup_date` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `note_check` datetime NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `user_level` enum('a','b','c','d') NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foundations`
--

INSERT INTO `foundations` (`id`, `name`, `email`, `password`, `telephone_number1`, `telephone_number2`, `photo`, `photo_value`, `address`, `country`, `city`, `lat`, `log`, `description`, `fax`, `site_link`, `blue_mark`, `signup_date`, `ip`, `last_login`, `note_check`, `activated`, `user_level`) VALUES
(5, 'masirelkhar', 'masir_elkhar@gmail.com', '0128193632', '01281936322', '', '', '', 'Egypt_cairo_alrish_elmassaaex', 'Egypt', 'cairo', '30.0444196', '31.2357116', 'wewillmangethefuturxxxxooooo''''''''''''''', '0128193632', 'http://www.w3schools.com/php/func_mysqli_real_escape_string.asp', '0', '2016-10-26 00:07:20', '1', '2016-11-11 18:41:41', '2016-10-26 00:07:20', '0', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone_number1` varchar(255) NOT NULL,
  `telephone_number2` varchar(255) NOT NULL,
  `gender` enum('m','f') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `photo_value` blob NOT NULL,
  `adderss` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `log` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `blue_mark` enum('0','1') NOT NULL DEFAULT '0',
  `signup_date` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `note_check` datetime NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `user_level` enum('a','b','c','d') NOT NULL DEFAULT 'a'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `telephone_number1`, `telephone_number2`, `gender`, `photo`, `photo_value`, `adderss`, `country`, `city`, `lat`, `log`, `description`, `blue_mark`, `signup_date`, `ip`, `last_login`, `note_check`, `activated`, `user_level`) VALUES
(12, 'Ahmad', 'Salem', 'Ah.salem.ali@gmail.com', '0128193632', '012819363225', '', 'm', '', '', 'cairo_alarish_radio stree', 'Egypt', 'cairo', '30.0444196', '31.2357116', 'i''m a software engineer and i love programming and playing football .... ', '0', '2016-10-26 23:37:25', '1', '2016-11-11 18:39:20', '2016-10-26 23:37:25', '0', 'a'),
(13, 'mohammed', 'gabr', 'mohammed@gmail.com', '0128193632', '', '', 'm', '', '', '', 'Egypt', 'cairo', '', '', 'i''m mohmmed gabr', '0', '2016-11-07 06:51:47', '127.0.0.1', '2016-11-07 06:52:30', '2016-11-07 06:51:47', '0', 'a'),
(14, 'fatma', 'zohery', 'fatma.zohery@gmail.com', '0128193632', '0128193632', '', 'f', '', '', 'Egypt_cairo_alrish_elmassaaed', 'Egypt', 'cairo', '30.0444196', '31.2357116', 'i''m fatama zohery and guess what the respect made me loose a lot!!!', '0', '2016-11-11 11:35:37', '1', '2016-11-11 11:42:30', '2016-11-11 11:35:37', '0', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foundations`
--
ALTER TABLE `foundations`
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
-- AUTO_INCREMENT for table `foundations`
--
ALTER TABLE `foundations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
