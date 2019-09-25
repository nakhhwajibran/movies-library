-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2019 at 07:25 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_list`
--

CREATE TABLE `movie_list` (
  `id` int(56) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 3,
  `img_src` varchar(255) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_list`
--

INSERT INTO `movie_list` (`id`, `title`, `year`, `rating`, `img_src`, `status`, `created`, `modified`) VALUES
(1, 'Avenger 1', 2016, 5, 'avenger.png', 1, '2019-09-24 16:21:56', '2019-09-23 11:25:09'),
(2, 'Avenger 2', 2017, 2, 'avenger2.png', 1, '2019-09-24 16:32:30', '2019-09-23 11:25:09'),
(3, 'Avenger - Age of Ultron', 2018, 1, 'ultron.png', 1, '2019-09-24 16:32:32', '2019-09-23 11:25:09'),
(4, 'X-men The Future Past', 2015, 4, 'x-men.png', 1, '2019-09-24 16:22:00', '2019-09-23 11:25:09'),
(5, 'Thor', 2019, 2, 'thor.png', 1, '2019-09-24 16:32:34', '2019-09-23 11:25:09'),
(6, 'Student of the year', 2015, 3, 'student.png', 1, '2019-09-23 11:25:09', '2019-09-23 11:25:09'),
(7, 'Student of the Year 2', 2019, 5, 'student2.png', 1, '2019-09-24 16:22:04', '2019-09-23 11:25:09'),
(8, 'IT', 2017, 1, 'it.png', 1, '2019-09-24 16:32:39', '2019-09-23 11:25:09'),
(9, 'IT 2', 2019, 4, 'it2.png', 1, '2019-09-24 16:22:06', '2019-09-23 11:25:09'),
(10, 'Transformer 2', 2014, 3, 'transformer.png', 1, '2019-09-23 11:25:09', '2019-09-23 11:25:09'),
(11, 'X-men', 2014, 3, 'x-men1.png', 1, '2019-09-23 11:25:09', '2019-09-23 11:25:09'),
(12, 'Thor 2', 2018, 3, 'thor2.png', 1, '2019-09-23 11:25:09', '2019-09-23 11:25:09'),
(13, 'Dangal', 2018, 5, 'dangal.png', 1, '2019-09-24 16:22:13', '2019-09-23 11:25:09'),
(14, 'Race 2', 2015, 3, 'race.png', 1, '2019-09-23 11:25:09', '2019-09-23 11:25:09'),
(15, 'Rang De Bansati', 2016, 3, 'rang.png', 1, '2019-09-23 11:28:39', '2019-09-23 11:28:39'),
(16, 'Bahubali', 2017, 5, 'bahubali.png', 1, '2019-09-24 16:22:18', '2019-09-23 11:28:39'),
(17, 'Bahubali 2', 2018, 4, 'bahubali2.png', 1, '2019-09-24 16:22:23', '2019-09-23 11:28:39'),
(18, 'X-men 2', 2015, 4, 'x-men2.png', 1, '2019-09-24 16:22:20', '2019-09-23 11:28:39'),
(19, 'Mission Mangal', 2019, 5, 'mission.png', 1, '2019-09-24 16:22:28', '2019-09-23 11:28:39'),
(20, 'Mission Impossible ', 2015, 3, 'impossible.png', 1, '2019-09-23 11:28:39', '2019-09-23 11:28:39'),
(21, 'Chennai Express', 2019, 3, 'chennai.png', 1, '2019-09-24 16:22:43', '2019-09-23 11:28:39'),
(22, 'P.K', 2017, 4, 'pk.png', 1, '2019-09-24 16:22:35', '2019-09-23 11:28:39'),
(23, 'Junglee', 2019, 3, 'junglee.png', 1, '2019-09-24 16:22:46', '2019-09-23 16:16:36'),
(24, 'Junglee2 ', 2019, 5, 'junglee2.png', 1, '2019-09-24 16:22:30', '2019-09-24 12:09:31'),
(25, 'Kabir Singh', 2019, 5, 'kabir.png', 1, '2019-09-24 13:17:28', '2019-09-24 13:17:28'),
(26, 'kabir2 ', 2019, 3, 'kabir2.png', 0, '2019-09-24 16:50:02', '2019-09-24 13:19:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_list`
--
ALTER TABLE `movie_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie_list`
--
ALTER TABLE `movie_list`
  MODIFY `id` int(56) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
