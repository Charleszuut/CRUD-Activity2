-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 10:32 AM
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
-- Database: `fitness_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `fitness`
--

CREATE TABLE `fitness` (
  `ExerciseID` int(11) NOT NULL,
  `ExerciseName` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `sets` int(11) NOT NULL DEFAULT 0,
  `reps` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fitness`
--

INSERT INTO `fitness` (`ExerciseID`, `ExerciseName`, `description`, `status`, `created_at`, `sets`, `reps`, `user_id`) VALUES
(17, 'asd', '123', 0, '2025-02-26 16:56:54', 4, 12, 3),
(18, 'Dumbell Back ROw', 'red', 0, '2025-02-26 16:58:49', 3, 12, 1),
(19, 'asdasd', '23', 0, '2025-02-26 16:59:10', 2, 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$rQdDiqPpDWMkUc2fsJj6xOV2q0QyLwSsRGSAJVGTA8lEOpP.y7VC6'),
(3, 'admin2', '$2y$10$Z/EaEOj4EOKLHgE/q8EFnuYk1vlGjO/mAN.6cM6ZHQDFRAmO1i2I6'),
(4, 'admin3', '$2y$10$Xr0RAduDDReOklx7DWzi7.J0jgeDOWtycQvY9kOrmrc8JqQBy5o6K'),
(7, 'admin4', '$2y$10$.jmvzcHEmT.O9YCuNDN.Fe4C94fZHzYMFh.seiSGetdTMk2Q35u16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fitness`
--
ALTER TABLE `fitness`
  ADD PRIMARY KEY (`ExerciseID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fitness`
--
ALTER TABLE `fitness`
  MODIFY `ExerciseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
