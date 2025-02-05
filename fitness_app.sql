-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 12:30 PM
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
  `reps` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fitness`
--

INSERT INTO `fitness` (`ExerciseID`, `ExerciseName`, `description`, `status`, `created_at`, `sets`, `reps`) VALUES
(13, 'Dumbell Back ROw', 'Keep form upright', 1, '2025-02-04 21:45:24', 4, 12),
(14, 'Deadlift', 'Brace Core, Activate shoulder blades and back', 0, '2025-02-04 21:46:00', 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fitness`
--
ALTER TABLE `fitness`
  ADD PRIMARY KEY (`ExerciseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fitness`
--
ALTER TABLE `fitness`
  MODIFY `ExerciseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
