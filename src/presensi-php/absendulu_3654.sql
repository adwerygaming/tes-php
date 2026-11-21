-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2026 at 07:28 AM
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
-- Database: `absendulu_3654`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `lecture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`lecture_id`, `user_id`, `created_at`) VALUES
(1500288, 100001, '2026-11-18 06:04:50'),
(1500288, 100002, '2026-11-18 06:04:57'),
(1500288, 100003, '2026-11-18 06:05:05'),
(1500288, 100004, '2026-11-18 06:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `displayName` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `birthDate` date NOT NULL,
  `profilePhotoPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `displayName`, `email`, `password`, `birthDate`, `profilePhotoPath`) VALUES
(900001, 'Admin M', 'admin@amikom.ac.id', 'indomierebus26', '2026-11-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `room_code` varchar(11) NOT NULL,
  `attendance_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `name`, `lecturer_id`, `datetime`, `room_code`, `attendance_code`) VALUES
(1500288, 'Pemrograman Web Lanjut', 900001, '2026-11-18 07:00:00', 'L 2.4.1', 'nIyoRe');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `displayName` varchar(256) NOT NULL,
  `birthDate` date NOT NULL,
  `bio` text DEFAULT NULL,
  `profilePicturePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `displayName`, `birthDate`, `bio`, `profilePicturePath`) VALUES
(100001, 'masdepan@amikom.ac.id', 'baksogoreng', 'Dhevan Adhitya Prasetyo', '2007-11-01', '', 'uploads/profile/user_100001_1794973283.jpg'),
(100002, 'f.rahmat@amikom.ac.id', 'baksogoreng', 'Fikki Rahmat Maulana', '2007-11-01', '', 'uploads/profile/user_100002_1794973319.png'),
(100003, 'muchlas@amikom.ac.id', 'baksogoreng', 'Muchlas', '2007-11-01', '', 'uploads/profile/user_100003_1794973298.png'),
(100004, 'k.waguri@amikom.ac.id', 'whenyhmybini', 'Kaoruko Waguri', '2009-09-09', '', 'uploads/profile/user_100004_1794977837.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD UNIQUE KEY `lecture_id` (`lecture_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `lectures_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
