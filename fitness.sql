-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2025 at 04:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `fitness`
--

CREATE TABLE `fitness` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fitness`
--

INSERT INTO `fitness` (`id`, `title`, `description`, `status`, `created_at`) VALUES
(2, 'Bulgarian Split Squat', '4 sets of 12. Pay attention to form, close to perfect.', 0, '0000-00-00 00:00:00'),
(3, 'Romanian Deadlift', '4 sets of 8 reps. Attention to back engagement, must have better form.', 0, '0000-00-00 00:00:00'),
(4, 'Lying Leg Raises', '4 sets of 8-12 reps. Pay attention to back, make sure to fully engage abdominal muscles and not arch', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fitness`
--
ALTER TABLE `fitness`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fitness`
--
ALTER TABLE `fitness`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
