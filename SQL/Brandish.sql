-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2022 at 01:28 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brandish`
--

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` datetime NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`token`, `expiry_date`, `email`) VALUES
('d3b6d44eb07bf1fb04fbed10ae7ded24', '2022-04-04 00:00:00', ''),
('e64057b25fcc3f4cbf38ff8c5f02d518', '2022-04-04 00:00:00', ''),
('b842acc134d1000ca2618694fbfd5263', '2022-04-04 00:00:00', ''),
('d653c290d02c94469dcdac6aac4d007f', '2022-04-04 15:15:12', ''),
('76f094e8b3397a1a9067354ab29e26c6', '2022-04-04 15:15:23', ''),
('abd82d24d3d31b3225b2d3c759ae6d10', '2022-04-04 15:26:12', 'aimane223@gmail.com'),
('ad7a92e4cd0776cd3af133eb777c697e', '2022-04-04 15:28:12', 'aimane223@gmail.com'),
('5116850e10ea55642bb09f2321f18b85', '2022-04-04 15:30:08', 'aimane223@gmail.com'),
('2b1302016a16bf947037c33387a743b3', '2022-04-04 15:31:19', 'aimane223@gmail.com'),
('a536b178452ab14f8ad82f756bd018a1', '2022-04-15 16:50:17', 'aimane223@gmail.com'),
('b2fa961db7c1f77c7803240c49c65b0d', '2022-04-15 16:57:25', 'aimane223@gmail.com'),
('958369fcd85ebc4541f0b2e3fddba0cc', '2022-04-15 17:00:59', 'aimane223@gmail.com'),
('9fd593d96befb9bdc8722d9b371ee468', '2022-04-15 17:02:04', 'aimane223@gmail.com'),
('fab12d97aa5c1abc53923093e769d773', '2022-04-16 11:43:02', 'aimane223@gmail.com'),
('679d8fa982341d4c44e668a9104f62ee', '2022-04-16 12:23:44', 'aimane223@gmail.com'),
('954119220af2d13c0caaada6222a31f2', '2022-04-16 12:27:04', 'aimane223@gmail.com'),
('9228f58da87d4585d785fee9f39c8a4a', '2022-04-16 12:27:48', 'aimane223@gmail.com'),
('776cff3381681f0404bf4677a73291ff', '2022-04-16 12:29:50', 'aimane223@gmail.com'),
('3938e44adb803345dfa0d1a36cde1d4a', '2022-04-16 12:31:34', 'aimane223@gmail.com'),
('2af21bedc7c95fce640419d783fcb31a', '2022-04-16 12:33:27', 'aimane223@gmail.com'),
('fd6604ff903e96ed774a34e8c179becd', '2022-04-16 12:39:35', 'aimane223@gmail.com'),
('7d9d93314f259f2938aada6822bbf67d', '2022-04-16 12:39:54', 'aimane223@gmail.com'),
('3f312ddbcc84426d870767b6bc11c825', '2022-04-16 12:41:25', 'aimane223@gmail.com'),
('e4b2bdf76c2d898fabb7af597c904611', '2022-04-16 12:42:02', 'aimane223@gmail.com'),
('4bb1552354360104420048bf1b458e34', '2022-04-16 12:45:55', 'aimane223@gmail.com'),
('cf97f495c46d8e1f2e7aa5388884dbfa', '2022-04-16 12:46:29', 'aimane223@gmail.com'),
('2aff1d58be473c4030baf7d0a4653848', '2022-04-16 12:46:49', 'aimane223@gmail.com'),
('e884c94c8e31c82f4690bc1ffc37a794', '2022-04-16 12:48:48', 'aimane223@gmail.com'),
('1e054af9073efb72d60337e3eeecf49c', '2022-04-16 12:50:23', 'aimane223@gmail.com'),
('dc75d896107f5f617acdbca2064adc34', '2022-04-16 12:51:08', 'aimane223@gmail.com'),
('7df45c77bc3b7b5fddccb31b728faf61', '2022-04-16 12:51:34', 'aimane223@gmail.com'),
('d7a0c50f31adeb25be11dab71a92e552', '2022-04-16 12:52:17', 'aimane223@gmail.com'),
('8b78e0cf00a49bf8e8473e9e636eb622', '2022-04-16 12:53:49', 'aimane223@gmail.com'),
('358317b6a3544da0f8b045054cddaf05', '2022-04-16 12:55:09', 'aimane223@gmail.com'),
('de3233fc4fb5dca75a94058db74d88f4', '2022-04-16 12:55:32', 'aimane223@gmail.com'),
('747236229629a1e63d635ca8e93a251a', '2022-04-16 12:57:00', 'aimane223@gmail.com'),
('5974f581713ee21e85785f053b96e948', '2022-04-16 12:58:45', 'aimane223@gmail.com'),
('18b8410fbffa9b512afbb27b121f96ba', '2022-04-16 13:01:50', 'aimane223@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `profilepicture` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `education` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `profilepicture`, `bio`, `education`) VALUES
(4, 'Aimane', 'Maadal', 'aimane223@gmail.com', '$2y$12$9eyQpYIdhXBE.RMHeEhMt.ZnSitv4aq1I7hUSAHdxZ7xmSP4z2i1e', '0', NULL, NULL),
(5, 'jan', 'a', 'aimane223@thomasmore.be', '$2y$12$Ywths.GkShTFWK/kIRVu.ORr16QesHoHEyLQH/CEn6ZFtmDetV92e', '', NULL, NULL),
(6, 'Alejandro', 'De Wolf', 'r0851847@student.thomasmore.be', '$2y$12$jUnSDBXPp4SprchX1jk4Su3d2w6ffMLamodmZrTjKW7k/qs51R1IS', 'pexels-photo-2379004.jpeg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
