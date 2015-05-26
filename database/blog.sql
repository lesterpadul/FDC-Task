-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2015 at 11:58 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(100) NOT NULL,
  `to_id` int(100) DEFAULT NULL,
  `from_id` int(100) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `created`, `modified`) VALUES
(1, 'The titles', 'This is the post body.', '2015-05-26 08:12:08', '2015-05-26 03:05:33'),
(2, 'A title once again', 'And the post body follows.sasd', '2015-05-26 08:12:08', '2015-05-26 02:43:29'),
(3, 'Title strikes back', 'This is really exciting! Not.', '2015-05-26 08:12:08', '2015-05-26 02:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `password` text,
  `image` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `birthday` datetime DEFAULT '0000-00-00 00:00:00',
  `hobby` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `last_login_time` datetime DEFAULT '0000-00-00 00:00:00',
  `created_ip` varchar(20) DEFAULT NULL,
  `modified_ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `gender`, `password`, `image`, `status`, `birthday`, `hobby`, `created`, `modified`, `last_login_time`, `created_ip`, `modified_ip`) VALUES
(1, 'Lester Padulasdasdasd', 'padullester@gmail.com', '1', 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', 'images (1)1432631134.jpg', '1', '2015-05-11 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit ess\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2015-05-26 01:21:52', '2015-05-26 11:57:11', '2015-05-26 11:56:55', NULL, '127.0.0.1'),
(3, '123123123', 'asasd@asd.com', NULL, 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '0000-00-00 00:00:00', NULL, '2015-05-26 01:03:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', NULL),
(4, '123123123', 'asasd@asd.com', NULL, 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '0000-00-00 00:00:00', NULL, '2015-05-26 01:04:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '127.0.0.1', NULL),
(5, '123123123', 'asasd@asd.com', NULL, 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '0000-00-00 00:00:00', NULL, '2015-05-26 01:05:30', '2015-05-26 09:05:30', '2015-05-26 09:05:30', '127.0.0.1', NULL),
(6, 'John Doe', 'johndoe@gmail.com', NULL, 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '0000-00-00 00:00:00', NULL, '2015-05-26 01:05:48', '2015-05-26 09:05:57', '2015-05-26 09:05:57', '127.0.0.1', NULL),
(7, 'Testers', 'tester@gmail.com', '', 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '2015-05-07 00:00:00', '123123', '2015-05-26 01:11:18', '2015-05-26 09:11:34', '2015-05-26 09:11:23', '127.0.0.1', '127.0.0.1'),
(8, 'user1', 'user1@gmail.com', '', 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '2015-05-14 00:00:00', 'a hobby', '2015-05-26 01:51:16', '2015-05-26 09:59:57', '2015-05-26 09:54:23', '127.0.0.1', '127.0.0.1'),
(9, 'tester2', 'padullester@gmail.com', '1', 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', 'images1432627269.jpg', '1', '2015-05-02 00:00:00', 'a hobby', '2015-05-26 02:00:46', '2015-05-26 10:01:09', '2015-05-26 10:00:46', '127.0.0.1', '127.0.0.1'),
(10, 'Testing123', 'pasdasd@dasd.com', NULL, 'c449d02b572e7820f9a87b4062112911d306c19ce3e1c7357161828678f86a0b17bb979c6faf073caab51b0216ca1a6b1b257d920335cbd576466311dae80e35', NULL, '1', '0000-00-00 00:00:00', NULL, '2015-05-26 03:55:12', '2015-05-26 11:55:12', '2015-05-26 11:55:12', '127.0.0.1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
