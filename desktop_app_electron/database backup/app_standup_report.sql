-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2020 at 12:20 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_standup_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_report`
--

CREATE TABLE `daily_report` (
  `id` int(11) NOT NULL,
  `user_cd` varchar(255) NOT NULL,
  `what_plan` text DEFAULT NULL,
  `how_plan` text DEFAULT NULL,
  `when_plan` text DEFAULT NULL,
  `trouble_plan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daily_report`
--

INSERT INTO `daily_report` (`id`, `user_cd`, `what_plan`, `how_plan`, `when_plan`, `trouble_plan`, `created_at`, `updated_at`) VALUES
(1, 'VN0001', 'a2', 'a4', 'a4', 'a1', '2020-07-17 02:33:55', '2020-07-17 02:33:55'),
(2, 'VN0042', 'Thực hiện task A', 'Định làm việc này trước', 'Chiều cuối giờ', 'Không có gì', '2020-07-17 03:19:42', '2020-07-17 03:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_cd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `del_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_cd`, `username`, `name`, `email`, `birthday`, `telephone`, `address`, `password`, `level`, `del_flag`, `created_at`, `updated_at`) VALUES
(8, 'nv0083', 'vantuant2', 'Trần Văn Tuấn', 'ngsdfsf2@gmail.com', '1970-01-14', '123', 'nguyen thi nham', '$2y$10$TgUVY.65iFAW4dacxUSNYe2ZhrHTlZeNXcllOy/.TcKgByBsp3p/C', 3, 0, '2020-07-14 00:32:15', '2020-07-14 00:32:15'),
(9, 'nv0084', 'ngothinh23', 'nguyễn văn sơn7', 'ngsdfsf2@gmail.com', '1918-02-16', '123', 'nguyen thi nham', '$2y$10$BqWeWnLQfJrQbVV04QnIXOfwPboOiz8EjyJLfyEckNGpmxg6mRY.a', 2, 0, '2020-07-14 00:57:32', '2020-07-14 00:57:32'),
(10, 'nv0085', 'nguyenson2231', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1970-01-21', '123', 'nguyen thi nham', '$2y$10$IMqQPOw37S5laUN.YvQm1.ddfXvitiIgBj31/N9FVZ5xK6qn07R4C', 3, 0, '2020-07-14 00:58:41', '2020-07-14 00:58:41'),
(11, 'nv0086', 'nguyentung23', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', NULL, '123', 'nguyen thi nham', '$2y$10$KkycmVNdjKSxwf7VEjdUxOvY0.yMM4MTrPCZ3qtjORgWq25TlDcDa', 3, 0, '2020-07-14 01:32:44', '2020-07-14 01:32:44'),
(12, 'nv0087', 'tunglam23', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1973-01-17', '123', 'nguyen thi nham', '$2y$10$54xb8mOkki53irK4vASVSeou22k.B9eK.q2xmEuUCF3aCsz12wEQ6', 3, 0, '2020-07-14 02:21:57', '2020-07-14 02:21:57'),
(13, 'nv0088', 'ngothin23', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1970-01-01', '123', 'nguyen thi nham', '$2y$10$74PRPYy9aqMpxBKoUv5ToeGbS.FwxkkwGG6ullDVvC7Sfdt/h6VeO', 3, 1, '2020-07-14 02:22:18', '2020-07-14 02:22:18'),
(14, 'nv0089', 'soncao12', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1970-01-01', '123', 'nguyen thi nham', '$2y$10$xb5EGr2qjp8JVNpCIOKxTuOspskbNT2FkYE3HAG/ZMARKKxG4KNBe', 3, 1, '2020-07-14 02:22:54', '2020-07-14 02:22:54'),
(15, 'VN0099', 'member1', 'Nguyen quoc Hoan', 'vantuant2@gmail.com', '1970-01-01', '357997234', 'ngõ 189 Nguyễn Ngọc Vũ - Trung Hòa - Cầu Giấy - Hà Nội', '$2y$10$a5cTeYQXqjkK4y9vFHH5d.fqzIYZBeQ/sKvNe64S.gEAQzkihmDS.', 3, NULL, '2020-07-15 00:17:39', '2020-07-15 00:17:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_report`
--
ALTER TABLE `daily_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_report`
--
ALTER TABLE `daily_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
