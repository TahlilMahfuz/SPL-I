-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 06:02 PM
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
-- Database: `servicelagbe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `phone`, `address`, `password`, `dt`) VALUES
(10, 'tahlil', 'tahlilmahfuz@yahoo.com', '01782333333', 'dhaka', '$2y$10$LsF03T0Nm7X.u28gtJGocuZhOCs729mPOhejITiavaqJ1BW94rJL6', '2022-10-19 07:58:51'),
(11, 'tahlil', 'k@yahoo.com', '01782333333', 'dhaka', '$2y$10$z8TTF2F234da5IbexIDsZuse0bZ7Q7PsGzrvJcZpnFLK2aj3BtIAm', '2022-10-19 08:05:21'),
(12, 'admintest', 'admintest@gmail.com', '01782633834', 'dhaka', '$2y$10$dt4RWxy5vZqyMtL96Av7/OYmDKO9WN6fESPR7quJ7GBmMrQusjbIm', '2022-10-19 08:21:36'),
(13, 'tahlil', 'ka@yahoo.com', '01782333333', 'dhaka', '$2y$10$q4grB/IzMkxNOKZeuFet6e/3nBe82A7RKMMdcYaSxK6PARNoKQR3m', '2022-10-19 10:27:17'),
(14, 'BossTahlil', 't@gmail.com', '01782333333', 'dhaka', '$2y$10$khWN002l306wr6fYki5AH.VI4h4hQdlCK55zhGt4H1NeR/KyXYxI.', '2022-10-19 10:31:11'),
(15, 'AdminTahlil', 'tahlilkfaiyaz@gmail.com', '01782333333', 'dhaka', '$2y$10$QNWflORAP3QUNmHaFikLi.6vZVDvejWg0uBOGzqE5Volt10IncEvq', '2022-10-19 11:55:23'),
(16, 'tahlil', 'tahlilk@gmail.com', '01782333333', 'dhaka', '$2y$10$anJJa0WwdqJO/.ShRG3K9eM1.gHl6c3yst6zd0pe3FLZBdhuhpC3a', '2022-10-19 12:31:53'),
(17, 'tahlil', 'tmz@gmail.com', '01782333333', 'dhaka', '$2y$10$CAx/6GDct01mJCaP7Iz8j.DXowOVOrcnxRoMgJ08Dvm55HyRhad2O', '2022-10-19 14:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `approvedserviceproviders`
--

CREATE TABLE `approvedserviceproviders` (
  `approvedproviderid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `servicetype` varchar(30) NOT NULL,
  `servicecount` int(11) NOT NULL DEFAULT 0,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `rating` float NOT NULL DEFAULT 4.5,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approvedserviceproviders`
--

INSERT INTO `approvedserviceproviders` (`approvedproviderid`, `username`, `servicetype`, `servicecount`, `availability`, `rating`, `email`, `phone`, `address`, `password`, `dt`) VALUES
(41, 'providerTest', 'Ac Service', 0, 0, 2, 'providertest@gmail.com', '12313123124', 'dhaka', '$2y$10$rYBM4AjLmrIJ34Ou7aZUVuSS6Vkki2ZOEK36vWRJoM3YH3Fh/Bdj.', '2022-10-19 11:56:41'),
(42, 'ProviderTahlil', 'Car Care', 0, 1, 4.5, 'tahlilkfaiyaz@gmail.com', '12313123124', 'dhaka', '$2y$10$dcRtf5LB0ai28R8o4U5SL.9BTqmHkhVsWdWojC2FYxX8VPf1G1Pme', '2022-10-19 12:33:23'),
(44, 'ProviderTahlil', 'Ac Service', 0, 1, 4.5, 'p@gmail.com', '12313123124', 'dhaka', '$2y$10$3ksqMoakl..TPAhNvEqrG.VgE0DJk/XGJUwCh8OvZp9mlVrhnYQCS', '2022-10-19 14:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `serviceproviders`
--

CREATE TABLE `serviceproviders` (
  `providerid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `serviceproviders`
--

INSERT INTO `serviceproviders` (`providerid`, `username`, `email`, `phone`, `address`, `password`, `dt`) VALUES
(70, 'ProviderShakkhor', 'shakkhor@gmail.com', '12313123124', 'dhaka', '$2y$10$e8FTRV/vXVXnQ21FEY93M.Y7WPWRvVH/Ssr.9da62pBKOqGocd52C', '2022-10-19 12:20:09'),
(71, 'ProviderTahlil', 'pa@gamil.com', '11314412521', 'dhaka', '$2y$10$t5NC1rfEXEUBZcg5DtWOIu5XsKyy.2aO8fRzOaEcyoD3VoFS0P.5K', '2022-10-19 12:20:19'),
(74, 'ProviderTahlil', 'test@gmail.com', '12313123124', 'dhaka', '$2y$10$i6o0qBY2hCy/q7JVxBHHFenOuzcHJIurywnf73N4yeu9nXP6Pcb0q', '2022-10-19 14:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `servicetype` varchar(30) NOT NULL,
  `servicecost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`servicetype`, `servicecost`) VALUES
('Ac Service', 2000),
('Electric Service', 2000),
('Emergency Service', 2000),
('Hairdresser', 2000),
('plumbing', 2000);

-- --------------------------------------------------------

--
-- Table structure for table `userprovider`
--

CREATE TABLE `userprovider` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `userlocation` varchar(100) DEFAULT NULL,
  `detailedlocation` varchar(4000) NOT NULL,
  `providerid` int(11) NOT NULL,
  `userphone` varchar(20) NOT NULL,
  `providerusername` varchar(50) NOT NULL,
  `provideremail` varchar(50) NOT NULL,
  `providerphone` varchar(20) NOT NULL,
  `provideraddress` varchar(100) NOT NULL,
  `servicetype` varchar(30) NOT NULL,
  `servicecost` double NOT NULL,
  `appointstatus` tinyint(4) NOT NULL DEFAULT 0,
  `comment` varchar(100) NOT NULL,
  `token` varchar(20) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprovider`
--

INSERT INTO `userprovider` (`orderid`, `userid`, `useremail`, `userlocation`, `detailedlocation`, `providerid`, `userphone`, `providerusername`, `provideremail`, `providerphone`, `provideraddress`, `servicetype`, `servicecost`, `appointstatus`, `comment`, `token`, `dt`) VALUES
(27, 20, '', 'dhaka', '', 44, '12314151515', 'ProviderTahlil', 'p@gmail.com', '12313123124', 'dhaka', 'Ac Service', 2000, 2, '', '', '2022-12-28 16:34:06'),
(28, 20, '', 'dhaka', '', 41, '12314151515', 'providerTest', 'providertest@gmail.com', '12313123124', 'dhaka', 'Ac Service', 2000, 2, '', '', '2022-12-28 20:46:21'),
(29, 20, 'tahlilmahfuz@iut-dha', 'dhaka', '', 41, '12314151515', 'providerTest', 'providertest@gmail.com', '12313123124', 'dhaka', 'Ac Service', 2000, 2, '', '', '2022-12-29 22:23:43'),
(30, 20, 'tahlilmahfuz@iut-dhaka.edu', 'dhaka', 'ni', 41, '12314151515', 'providerTest', 'providertest@gmail.com', '12313123124', 'dhaka', 'Ac Service', 2000, 0, '', '', '2022-12-29 22:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `dt`, `token`) VALUES
(4, 'Tawfiq', 'tawfiq@gmail.com', '01612696601', '$2y$10$r5MbAAi2B4H5VCe0U/ZRQeWJXVSZyeLAG9zzHZTuKbJ2JjUVyCsla', '2022-09-21 11:04:08', NULL),
(5, 'Shakkhor', 'shakkhor@gmail.com', '01782633444', '$2y$10$ty3DEiI4ebyiq2W4GDxb/u5CrTCmA6OGgBLbUNewbcNalTxhUM1q.', '2022-09-21 13:04:33', NULL),
(8, 'Mahfuz', 'mahfuz@gmail.com', '12312415145', '$2y$10$mYjFBaVvtbwresOQjtp3vuerNtQghboAB/tPciOEtk6bIuRUAzlLC', '2022-09-21 16:23:18', NULL),
(9, 'elahi', 'elahi@gmail.com', '74295626359', '$2y$10$oYifnPGM1vwMbeXSI/dGi.6echrhP11TT/RbLZkUq4INdOr/K44QO', '2022-09-21 20:08:27', NULL),
(15, 'Tahlil_Mahfuz', 'tahlilkfaiyaz@gmail.com', '01782633834', '$2y$10$UanPgfRDUYhWRAT0AQto0.85SKIYDZsX134V5gCp599LQTC/Zg6M.', '2022-10-18 22:12:18', NULL),
(16, 'tah', 't@gmail.com', '01782633834', '$2y$10$e0JK8PvGVK6WDIwxxw7diOSHE3W0apJo8/Csb.e.lW9tQhftnv1ey', '2022-10-19 06:51:45', NULL),
(17, 'faiyaz1', 'faiyaz1@gmail.com', '01782633834', '$2y$10$.zrT8bp9ttWdfRt2FNh1oOYJpM05z5.jw6.TPMUDKspNIT1i9Nro.', '2022-10-19 06:56:58', NULL),
(18, 'tahlilmahfuz', 'ta@gmail.com', '01744258204', '$2y$10$Ukl8FUWNBsjgn15CpVW2p.Qjd1eKBtaXdi5SssCuQD3jToqOyoGy2', '2022-10-19 07:31:09', NULL),
(20, 'tahlil', 'tahlilmahfuz@iut-dhaka.edu', '12314151515', '$2y$10$Gj4whwpT2jnj7w.vn4QT/upcM7yhDCkKTAqNMWsIMsYoKcQHvjU9W', '2022-10-19 12:27:40', NULL),
(21, 'tahlil', 'muaztahlil@gmail.com', '41694619536', '$2y$10$eeKjA1oP3FZI9MBc8j7sfuA7S5aHmH8iEr/1mqkOIOLjZ8GANCXsO', '2022-10-19 14:46:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvedserviceproviders`
--
ALTER TABLE `approvedserviceproviders`
  ADD PRIMARY KEY (`approvedproviderid`);

--
-- Indexes for table `serviceproviders`
--
ALTER TABLE `serviceproviders`
  ADD PRIMARY KEY (`providerid`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`servicetype`);

--
-- Indexes for table `userprovider`
--
ALTER TABLE `userprovider`
  ADD PRIMARY KEY (`orderid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `approvedserviceproviders`
--
ALTER TABLE `approvedserviceproviders`
  MODIFY `approvedproviderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `serviceproviders`
--
ALTER TABLE `serviceproviders`
  MODIFY `providerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `userprovider`
--
ALTER TABLE `userprovider`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
