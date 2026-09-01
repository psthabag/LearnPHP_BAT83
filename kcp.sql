-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2026 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kcp`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `img_id` int(11) NOT NULL,
  `img_category` varchar(50) NOT NULL,
  `img_title` varchar(100) NOT NULL,
  `img_desc` varchar(300) NOT NULL,
  `imagepath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`img_id`, `img_category`, `img_title`, `img_desc`, `imagepath`) VALUES
(1, 'Landscape', 'Lamtang Valley Trek', 'Langtang Valley Trekking is a captivating adventure that takes you through the stunning landscapes of Nepal\'s Langtang region. Nestled in the Himalayas, this trek offers a perfect blend of natural beauty, cultural immersion, and moderate hiking challenges. As you journey through picturesque villages', 'images/gallery/1788249202_images.jpg'),
(2, 'Landscape', 'Annapurna View', 'Annapurna View', 'images/gallery/1788249676_Annapurna_Massif_Aerial_View.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `std_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `imagepath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`std_id`, `name`, `address`, `phone`, `imagepath`) VALUES
(1, 'Lipi Adhikari', 'Pokhara', '983434', 'uploads/1788247095_logo7.png'),
(2, 'Pranisha B.K.', 'Pokhara', '989898', 'uploads/1788247141_logo7.png'),
(3, 'Shreeya Acharya', 'Pokhara', '989898', 'uploads/1788247176_logo7.png'),
(4, 'Smriti Gautam', 'Pokhara', '989898', 'uploads/1788247427_logo7.png'),
(5, 'Lilam Luthra', 'Pokhara', '98989', 'uploads/1788247884_logo7.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`std_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
