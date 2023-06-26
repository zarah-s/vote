-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 07, 2023 at 08:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votex`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification` text NOT NULL,
  `to` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notification`, `to`, `date`) VALUES
(1, 'hello everyone', 2, '2023-02-28 12:17:10'),
(2, 'hey', 2, '2023-03-07 20:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position`) VALUES
(1, 'President'),
(2, 'Governor'),
(3, 'senator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `profile_picture` varchar(256) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `manifesto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `profile_picture`, `level`, `position`, `bio`, `manifesto`) VALUES
(1, 'vicki', 'adminreacttask@manaknight.co', '&lt;?$password?&gt;', 'uploads/img.jpg', 0, NULL, NULL, NULL),
(2, 'vicki', 'adminreacttask@manaknight.co', '&lt;?$password?&gt;', 'uploads/img.jpg', 1, 1, 'dadas', 'adsfads'),
(3, 'vicki', 'adminreacttask@manaknight.co', '&lt;?$password?&gt;', 'uploads/img.jpg', 0, 1, 'sadfasd', 'adfasd'),
(4, 'vicki', 'adminreacttask@manaknight.co', '&lt;?$password?&gt;', 'uploads/img.jpg', 0, NULL, NULL, NULL),
(5, 'vicki', 'adminreacttask@manaknight.co', '&lt;?$password?&gt;', 'uploads/img.jpg', 1, 2, 'sdkfasdjh', 'lkjfaldfa'),
(6, 'vicki', 'adminreacttask@manaknight.co', '&lt;?$password?&gt;', 'uploads/img.jpg', 0, NULL, NULL, NULL),
(7, 'vic', 'vic@gmail.com', '', 'uploads/img.jpg', 1, 1, 'just a friend', 'i promise the future of the youths'),
(8, 'admin', 'admin@gmail.com', '$2y$10$uT3tSTeT5GzL5KbOkSg37OOBFYQdHQeIkcLckVbjCi5h8IK7ORD8a', NULL, 2, NULL, NULL, NULL),
(9, 'asdfa', 'asdfa@sadfa.sdf', '$2y$10$EnOZfcFtou.H1YtKdIiWDegWlcVvK5rh9aE7cR5y./wlAZ10X8S0W', 'uploads/64078f21908c1.jpg', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `voting` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `voting`, `position`) VALUES
(1, 5, 2, 1),
(2, 5, 5, 2),
(3, 6, 2, 1),
(4, 6, 5, 2),
(5, 7, 2, 1),
(6, 7, 5, 2),
(7, 9, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
