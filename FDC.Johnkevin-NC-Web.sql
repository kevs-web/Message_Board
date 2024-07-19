-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 19, 2024 at 08:55 AM
-- Server version: 8.0.38
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employees`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `from_user_id` int NOT NULL,
  `content` text NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_user_id`, `from_user_id`, `content`, `status`, `created_at`) VALUES
(1, 2, 5, 'wewerer', 1, '2024-07-19 03:02:42'),
(2, 4, 5, 'helloooooo', 1, '2024-07-19 03:03:37'),
(3, 2, 5, 'hi', 1, '2024-07-19 06:12:39'),
(4, 3, 5, 'hi', 1, '2024-07-19 06:34:38'),
(5, 4, 5, 'oi', 1, '2024-07-19 06:48:45'),
(6, 3, 2, 'oi', 1, '2024-07-19 06:52:47'),
(7, 3, 2, 'pre', 1, '2024-07-19 06:53:05'),
(8, 3, 2, 'oi pre', 1, '2024-07-19 06:53:50'),
(9, 3, 2, 'musta', 1, '2024-07-19 06:53:58'),
(10, 1, 2, 'hello', 1, '2024-07-19 06:58:45'),
(11, 3, 2, 'bro', 1, '2024-07-19 07:04:58'),
(12, 5, 6, 'bro', 1, '2024-07-19 08:01:10'),
(13, 5, 6, 'yeag bro', 1, '2024-07-19 08:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `last_activity` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `last_activity`) VALUES
(2, 'kevin@gmail.com', '9a5865c9c47e8e8e159316bdc0885779fbc94960', '2024-07-19 15:05:21'),
(3, '123@gmail.com', '9a5865c9c47e8e8e159316bdc0885779fbc94960', '2024-07-19 16:14:07'),
(4, 'kevin1@gmail.com', '9a5865c9c47e8e8e159316bdc0885779fbc94960', '2024-07-19 02:57:31'),
(5, '1234@gmail.com', '9a5865c9c47e8e8e159316bdc0885779fbc94960', '2024-07-19 02:57:47'),
(6, 'kevin14@gmail.com', '9a5865c9c47e8e8e159316bdc0885779fbc94960', '2024-07-19 08:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `birthdate` varchar(150) DEFAULT NULL,
  `hubby` text,
  `profile` text,
  `created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `gender`, `birthdate`, `hubby`, `profile`, `created`) VALUES
(1, 2, 'john\r\n', 'Male', '2024/08/13', 'reading only', '6699d37213701cat2.jpg', '2024-07-19 10:42:43'),
(2, 3, 'gold15', 'Male', '2003/07/01', '', '669a269d592fbw.jpg', '2024-07-19 10:48:08'),
(3, 4, 'kevin', NULL, NULL, NULL, NULL, '2024-07-19 10:57:31'),
(4, 5, 'kaiden', NULL, NULL, NULL, NULL, '2024-07-19 10:57:47'),
(5, 6, 'kevin123', 'Male', '2011/07/31', 'reading manga', '669a1d3c9b48dcat.jpeg', '2024-07-19 16:00:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
