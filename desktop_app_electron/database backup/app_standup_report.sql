-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2020 at 09:47 AM
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
(1, 'VN0001', 'PlanVN1', 'Nhận dạng kí tự quang học (OCR – Optical Charater Recognition) là phần mềm máy tính xử lí và cho phép chuyển đổi tài liệu dạng ảnh (các ảnh đầu ra của máy scanner, máy ảnh, file PDF…) thành tài liệu có thể biên tập được (file word…). OCR thực hiện được điều này nhờ công nghệ xử lí ngôn ngữ tự nhiên (NLP), giúp nhận dạng các chữ cái và kí tự, sau đó sao chép chúng theo định dạng và thứ tự được viết.\r\n\r\nĐối với việc trích xuất các trường thông tin cần thiết trong giấy tờ tuy thân như chứng minh nhân dân, giấy phép lái xe… khi đưa tài liệu lên hệ thống, người dùng chọn lựa và xác định các vùng cần bóc tách. Sau đó, hệ thống được OCR nhận dạng để chuyển sang dạng text và tự động trích xuất các trường thông tin cần thiết.', 'Nhận dạng kí tự quang học (OCR – Optical Charater Recognition) là phần mềm máy tính xử lí và cho phép chuyển đổi tài liệu dạng ảnh (các ảnh đầu ra của máy scanner, máy ảnh, file PDF…) thành tài liệu có thể biên tập được (file word…). OCR thực hiện được điều này nhờ công nghệ xử lí ngôn ngữ tự nhiên (NLP), giúp nhận dạng các chữ cái và kí tự, sau đó sao chép chúng theo định dạng và thứ tự được viết.\r\n\r\nĐối với việc trích xuất các trường thông tin cần thiết trong giấy tờ tuy thân như chứng minh nhân dân, giấy phép lái xe… khi đưa tài liệu lên hệ thống, người dùng chọn lựa và xác định các vùng cần bóc tách. Sau đó, hệ thống được OCR nhận dạng để chuyển sang dạng text và tự động trích xuất các trường thông tin cần thiết.', 'Nhận dạng kí tự quang học (OCR – Optical Charater Recognition) là phần mềm máy tính xử lí và cho phép chuyển đổi tài liệu dạng ảnh (các ảnh đầu ra của máy scanner, máy ảnh, file PDF…) thành tài liệu có thể biên tập được (file word…). OCR thực hiện được điều này nhờ công nghệ xử lí ngôn ngữ tự nhiên (NLP), giúp nhận dạng các chữ cái và kí tự, sau đó sao chép chúng theo định dạng và thứ tự được viết.\r\n\r\nĐối với việc trích xuất các trường thông tin cần thiết trong giấy tờ tuy thân như chứng minh nhân dân, giấy phép lái xe… khi đưa tài liệu lên hệ thống, người dùng chọn lựa và xác định các vùng cần bóc tách. Sau đó, hệ thống được OCR nhận dạng để chuyển sang dạng text và tự động trích xuất các trường thông tin cần thiết.', '2020-07-28 04:31:52', '2020-07-28 07:40:01'),
(2, 'VN0042', 'PlanVN2', 'Định làm việc này trước', 'Chiều cuối giờ', 'Không có gì', '2020-07-28 04:31:57', '2020-07-27 07:40:12'),
(3, 'VN0043', 'Kế hoạch là sẽ làm việc AAA', 'Test1', 'Test2', 'Test3', '2020-07-28 04:32:09', '2020-07-28 07:40:15'),
(4, 'VN0044', 'A2', 'A3', 'A4', 'A5', '2020-07-28 04:32:11', '2020-07-29 07:40:20'),
(5, 'VN0042', 'b1', 'b2', 'b3', 'b4', '2020-07-28 07:42:04', '2020-07-28 07:42:04'),
(6, 'VN0001', 'c1', 'c2', 'c3', 'c4', '2020-07-28 07:46:54', '2020-07-28 07:46:54');

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
(8, 'VN0001', 'vantuant2', 'Trần Văn Tuấn', 'ngsdfsf2@gmail.com', '1970-01-14', '123', 'nguyen thi nham', '$2y$10$TgUVY.65iFAW4dacxUSNYe2ZhrHTlZeNXcllOy/.TcKgByBsp3p/C', 3, 0, '2020-07-14 00:32:15', '2020-07-14 00:32:15'),
(10, 'VN0043', 'nguyenson2231', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1970-01-21', '123', 'nguyen thi nham', '$2y$10$IMqQPOw37S5laUN.YvQm1.ddfXvitiIgBj31/N9FVZ5xK6qn07R4C', 3, 0, '2020-07-14 00:58:41', '2020-07-14 00:58:41'),
(11, 'VN0044', 'nguyentung23', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', NULL, '123', 'nguyen thi nham', '$2y$10$KkycmVNdjKSxwf7VEjdUxOvY0.yMM4MTrPCZ3qtjORgWq25TlDcDa', 3, 0, '2020-07-14 01:32:44', '2020-07-14 01:32:44'),
(12, 'nv0087', 'tunglam23', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1973-01-17', '123', 'nguyen thi nham', '$2y$10$54xb8mOkki53irK4vASVSeou22k.B9eK.q2xmEuUCF3aCsz12wEQ6', 3, 0, '2020-07-14 02:21:57', '2020-07-14 02:21:57'),
(13, 'nv0088', 'ngothin23', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1970-01-01', '123', 'nguyen thi nham', '$2y$10$74PRPYy9aqMpxBKoUv5ToeGbS.FwxkkwGG6ullDVvC7Sfdt/h6VeO', 3, 0, '2020-07-14 02:22:18', '2020-07-14 02:22:18'),
(14, 'nv0089', 'soncao12', 'nguyễn văn sơn3', 'ngsdfsf2@gmail.com', '1970-01-01', '123', 'nguyen thi nham', '$2y$10$xb5EGr2qjp8JVNpCIOKxTuOspskbNT2FkYE3HAG/ZMARKKxG4KNBe', 3, 0, '2020-07-14 02:22:54', '2020-07-14 02:22:54'),
(15, 'VN0099', 'member1', 'Nguyen quoc Hoan', 'vantuant2@gmail.com', '1970-01-01', '357997234', 'ngõ 189 Nguyễn Ngọc Vũ - Trung Hòa - Cầu Giấy - Hà Nội', '$2y$10$a5cTeYQXqjkK4y9vFHH5d.fqzIYZBeQ/sKvNe64S.gEAQzkihmDS.', 3, 0, '2020-07-15 00:17:39', '2020-07-15 00:17:39'),
(16, 'NV00101', 'thuhang12', 'nguyen thu hang', 'gndn@gmail.com', '2020-07-22', NULL, NULL, '', 3, 0, '2020-07-13 08:56:10', '2020-07-15 08:56:10'),
(17, 'nv01ooo', 'nguyen thi hue', 'sdfsd@gmail.com', '', '2020-07-19', '12312312', 'fsdfs', '', 3, 0, '2020-07-13 08:56:10', '2020-07-08 08:56:10'),
(18, 'NG9001', 'trang22', 'nguyen thu trang', 'vantrang@gmail.com', '2020-07-13', '423424234', NULL, '', 3, 0, '2020-07-05 08:57:33', '2020-07-08 08:57:33'),
(19, 'nv001', 'le thu huong', 'rwer22', 'nguyen772@gmail.com', '2020-07-12', 'vvxc', 'tg@gmail.com', 'bx', 3, 0, '2020-07-19 08:57:33', '2020-07-20 08:57:33'),
(21, 'NV100', 'admin', 'SSV', 'vs@gmail.com', '1970-01-01', NULL, NULL, '$2y$10$F.0LRs1vrUWqyPFpHJL6IueYFuiV29qHezqwQbaLCz9u.cio1NWx6', 1, NULL, '2020-07-28 07:37:21', '2020-07-28 07:37:21');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
