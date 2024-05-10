-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2024 at 08:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `outfitt`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `clothing_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `nameClothing` varchar(100) NOT NULL,
  `kind` varchar(2222) NOT NULL,
  `color` varchar(2222) NOT NULL,
  `notes` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`clothing_id`, `photo`, `nameClothing`, `kind`, `color`, `notes`, `timestamp`, `id`) VALUES
(7, '660c2b9e79a66.jpg', '33', 'shirt', 'red', '', '2024-04-02 16:00:30', 2),
(8, '660c2ba583064.jpeg', 'taeri', 'shirt', 'red', '', '2024-04-02 16:00:37', 2),
(9, '660c2baabc00c.jpeg', 'bb', 'shirt', 'red', '', '2024-04-02 16:00:43', 2),
(10, '660c2bb24a80e.jpg', 'luv', 'shirt', 'red', '', '2024-04-02 16:00:50', 2),
(11, '660c2bb99f827.jpg', 'df', 'shirt', 'red', '', '2024-04-02 16:00:57', 2),
(12, '660c3a3bc9e93.jpg', 'screenshot', 'shirt', 'red', '', '2024-04-02 17:02:51', 2),
(13, '660c3a444bfde.jpg', 'df', 'shirt', 'red', '', '2024-04-02 17:03:00', 2),
(14, '660c3a4ef2a59.jpg', 'fgdhfd', 'shirt', 'red', '', '2024-04-02 17:03:10', 2),
(15, '660c3a6170a36.jpg', 'df', 'shirt', 'red', '', '2024-04-02 17:03:29', 2),
(16, '660c3a672f5b7.jpg', 'taeri', 'shirt', 'red', '', '2024-04-02 17:03:35', 2),
(17, '660c3a8d02885.jpg', 'same?', 'shirt', 'red', '', '2024-04-02 17:04:13', 2),
(18, '660c3ac2040b3.jpeg', 'bb', 'shirt', 'red', '', '2024-04-02 17:05:06', 1),
(19, '660c3acf35992.jpeg', 'tae', 'shirt', 'red', '', '2024-04-02 17:05:19', 1),
(20, '660c3ad985f77.jpg', 'ri', 'shirt', 'red', '', '2024-04-02 17:05:29', 1),
(21, '660c3ae00c084.jpg', 'l', 'shirt', 'red', '', '2024-04-02 17:05:36', 1),
(22, '660c83ff1e1c9.jpg', 'bus', 'shorts', 'gray', 'oversized\r\ncotton\r\n', '2024-04-02 22:17:35', 1),
(23, '6619a3f1172f3.png', 'black jeans', 'pants', 'black', 'black jeans\r\nkind of tight but roomy', '2024-04-12 21:13:21', 2),
(24, '6619b03b020a8.png', 'White Button up', 'shirt', 'white', 'slim fit', '2024-04-12 22:05:47', 3),
(25, '6619b07680c3b.png', 'Tanned leather jacket', 'jacket', 'brown', 'Kind of thick \r\nideal for fall\r\non the bottom left drawer', '2024-04-12 22:06:46', 3),
(26, '6619b08cf11b9.png', 'cowboy hat', 'accessories', 'brown', 'for cowboy activities', '2024-04-12 22:07:08', 3),
(27, '6619baf675744.png', 'jeans', 'pants', 'blue', 'Blue jeans\r\nslim fit', '2024-04-12 22:51:34', 4),
(28, '6619bb37835a8.png', 'Harley Davidson', 'shirt', 'black', 'Vintage harley davidson tshirt\r\nstored in the bottom left drawer', '2024-04-12 22:52:39', 4),
(29, '6619bb63d3181.png', 'Black leather jacket', 'jacket', 'black', 'Kind of thick suitable for colder weather', '2024-04-12 22:53:23', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Username`, `Email`, `Age`, `Password`) VALUES
(1, 'audrey', 'laughingass@gmail.com', 79, 'LaughingGas123!'),
(2, 'user', 'user@user.com', 24, 'User!234'),
(3, 'test', 'test@test.com', 24, 'Test!234'),
(4, 'test1', 'test1@test.com', 21, 'Test!234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`clothing_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `clothing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
