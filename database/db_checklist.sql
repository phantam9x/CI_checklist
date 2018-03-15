-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2018 at 05:56 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_checklist`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `use_id` int(11) NOT NULL,
  `use_id_fb` varchar(230) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `use_fullname` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `use_password` varchar(32) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `use_avatar` varchar(230) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `use_salt` varchar(32) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `use_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `use_name` varchar(16) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`use_id`, `use_id_fb`, `use_fullname`, `use_password`, `use_avatar`, `use_salt`, `use_created_at`, `use_name`) VALUES
(2, '206381270113575', 'Phan Văn Tâm', '', 'public/images/don-vi-mb-gb-tb-bao-nhieu-kb-mb.jpg', '', '2018-03-09 05:19:22', '');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `wor_id` int(11) NOT NULL,
  `wor_title` varchar(230) COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `wor_time_start` time DEFAULT NULL,
  `wor_time_stop` time DEFAULT NULL,
  `wor_type` int(11) DEFAULT NULL,
  `wor_note` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `wor_status` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'pending',
  `wor_time` int(11) NOT NULL,
  `wor_created_at` int(11) NOT NULL,
  `wor_created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`wor_id`, `wor_title`, `wor_time_start`, `wor_time_stop`, `wor_type`, `wor_note`, `wor_status`, `wor_time`, `wor_created_at`, `wor_created_by`) VALUES
(14, 'Làm việc ', '05:00:00', '06:30:00', 1, '- Triển khai trang index show list công việc theo tháng', 'yes', 1, 1520610530, 2),
(15, 'Dọn rẹp - cá nhân', '06:30:00', '07:00:00', 4, '', 'yes', 1, 1520610624, 2),
(16, 'Lên công ty', '07:00:00', '14:00:00', 2, '- Đổi lại mật khẩu thẻ ngân hàng\r\n- Hoàn thành việc hiển thị danh sách công việc theo tháng', 'yes', 1, 1520610758, 2),
(17, 'Tham gia lễ hội xuân hồng', '14:00:00', '16:00:00', 2, '- Tham gia hiến máu tại: \r\n  Viện huyết học truyền máu TW phố Phạm Văn Bạch Yên Hòa Cầu', 'yes', 1, 1520610970, 2),
(18, 'Làm việc ', '16:00:00', '19:00:00', 2, '', 'no', 1, 1520611447, 2),
(19, 'Rọn rẹp - cá nhân', '19:00:00', '21:00:00', 3, '', 'yes', 1, 1520611607, 2),
(20, 'Làm việc ', '21:00:00', '23:00:00', 2, '', 'no', 1, 1520611705, 2),
(21, 'Ngủ', '23:00:00', '05:00:00', 2, '', 'no', 1, 1520611731, 2),
(22, 'Làm việc ', '08:00:00', '14:00:00', 2, '- Đây là công việc test', 'pending', 2, 1520647161, 1),
(23, 'Làm việc ', '08:00:00', '14:00:00', 4, '- Đây là công việc test', 'pending', 2, 1520647161, 1),
(24, 'Làm việc ', '08:00:00', '14:00:00', 4, '- Đây là công việc test', 'pending', 2, 1520647287, 1),
(27, 'Hoàn  thành modulechecklist', '14:30:00', '16:30:00', 1, '', 'yes', 2, 1520753720, 2),
(28, 'Phân tích làm module quản lý chi tiêu', '16:50:00', '18:00:00', 1, '', 'yes', 2, 1520761815, 2),
(29, 'Công việc cá nhân', '18:00:00', '19:30:00', 2, '', 'yes', 2, 1520761988, 2),
(30, 'Đọc sách và thể dục buổi tối', '19:30:00', '21:00:00', 4, 'Địa điểm: \r\n- Vườn hoa Hà Đông', 'yes', 2, 1520762119, 2),
(31, 'Study language english', '21:00:00', '23:00:00', 1, '', 'yes', 2, 1520762243, 2),
(32, 'Đi ngủ và dậy sớm vào sáng hôm sau ', '23:30:00', '05:00:00', 3, '- Viết checklist cho ngày hôm sau ', 'yes', 2, 1520784381, 2),
(33, 'Study languages english', '05:00:00', '05:30:00', 2, 'Ghi nhớ cách phát âm của 12 phụ âm English', 'pending', 1, 1520785393, 2),
(34, 'Code module quản lý chi tiêu cá nhân', '05:30:00', '06:50:00', 4, '- Thiết kế giao diện và phân tích Database', 'yes', 3, 1520785490, 2),
(35, 'Study languages english', '05:00:00', '05:30:00', 2, 'Ghi nhớ cách phát âm của 12 phụ âm English', 'yes', 3, 1520785506, 2),
(36, 'Ân uống vệ sinh cá nhân chuẩn bị đi làm ', '06:50:00', '07:20:00', 3, 'Thực đơn: \r\n- Mỳ gói ', 'yes', 3, 1520785656, 2),
(37, 'Đi làm', '07:20:00', '12:00:00', 1, '- Nói với anh Điệp về nhu cầu công việc của mình ', 'yes', 3, 1520785716, 2),
(38, 'Nghỉ và ngủ trưa', '12:00:00', '13:00:00', 2, '', 'yes', 3, 1520785881, 2),
(39, 'Làm việc buổi chiều', '13:00:00', '18:00:00', 1, '- Hoàn thành Module finance \r\n+ Nguồn thu nhập\r\n+ Các quỹ \r\n+ Chi tiêu ', 'yes', 3, 1520785915, 2),
(40, 'Ăn uống và dọn rẹp cá nhân', '18:00:00', '20:00:00', 2, '', 'yes', 3, 1520786001, 2),
(41, 'Làm việc ', '20:00:00', '22:00:00', 2, '- Chờ việc từ công ty\r\n+ Nghiên cứu về kiotviet \r\n- Hoàn thành module income (xong)\r\n* Ngủ sớm vì hơi mệt', 'yes', 3, 1520786091, 2),
(42, 'Viết checklist cho ngày mới', '23:00:00', '23:30:00', 1, '', 'yes', 3, 1520786153, 2),
(43, 'Ngủ và thức dậy ngày hôm sau', '23:30:00', '05:00:00', 1, '- Ngủ đến 7h mới dậy', 'no', 3, 1520786189, 2),
(44, 'Làm việc buổi sáng', '05:00:00', '06:30:00', 3, '- Phân tích quản lý tiền theo quỹ', 'pending', 1, 1520866843, 2),
(45, 'Làm việc buổi sáng', '05:00:00', '06:30:00', 4, '- Phân tích quản lý tiền theo quỹ', 'no', 4, 1520866852, 2),
(46, 'Ăn sáng và chuẩn bị đi làm', '06:40:00', '07:20:00', 3, '- Mang cho anh Thắng quyển Đắc nhân tâm', 'yes', 4, 1520866955, 2),
(47, 'Làm việc tai công ty', '07:20:00', '18:00:00', 1, '- Tham khảo cách quản lý của kiot việt\r\n + Khách hàng \r\n+ Nhà cung cấp\r\n+ Sản phẩm', 'yes', 4, 1520867001, 2),
(48, 'Ăn tối và giải trí', '18:00:00', '20:00:00', 3, '', 'yes', 4, 1520867093, 2),
(49, 'Làm việc buổi tối', '20:00:00', '22:00:00', 1, '', 'no', 4, 1520867118, 2),
(50, 'Study language english', '22:00:00', '23:00:00', 1, '- Học phát âm 12 phụ âm tiếng anh ', 'no', 4, 1520867155, 2),
(51, 'Viết checklist cho ngày mới', '23:00:00', '23:20:00', 4, '', 'no', 4, 1520867174, 2),
(52, 'Ngủ và thức dậy ngày hôm sau', '23:20:00', '05:00:00', 1, '', 'no', 4, 1520867207, 2),
(53, 'Làm việc và rọn rẹp buổi sáng', '06:20:00', '07:20:00', 4, '', 'pending', 1, 1520983370, 2),
(54, 'Làm việc và rọn rẹp buổi sáng', '06:20:00', '07:20:00', 2, '', 'yes', 5, 1520983390, 2),
(55, 'Lên công ty', '07:20:00', '18:00:00', 3, '', 'yes', 5, 1520983425, 2),
(56, 'Ăn uống và dọn rẹp cá nhân buổi tối', '18:00:00', '20:00:00', 2, '', 'yes', 5, 1520983470, 2),
(57, 'Làm việc buổi tối', '20:00:00', '22:00:00', 2, '', 'no', 5, 1520983491, 2),
(58, 'Study language english', '22:00:00', '22:30:00', 2, '', 'no', 5, 1520983512, 2),
(59, 'Viết checklist cho ngày mới', '22:30:00', '23:00:00', 2, '', 'no', 5, 1520983529, 2),
(62, 'Lên công ty', '07:30:00', '18:00:00', 1, '- Ngiên cứu và ghi chép lại cách quản lý của Kiotviet\r\n+ Quản lý khách hàng & nhà cung cấp (ok)\r\n+ Quản lý sản phẩm (ok)\r\n+ Quản lý giao dịch (ok)\r\n+ Quản lý chi nhánh (ok)\r\n- Ưng dụng viết Checklist\r\n+ Sử dụng Vuejs và API để tạo ứng dung một trang', 'active', 6, 1521073064, 2),
(63, 'Rọn rẹp - cá nhân', '18:00:00', '20:30:00', 1, '', 'pending', 6, 1521073111, 2),
(64, 'Làm việc buổi tối', '20:30:00', '22:00:00', 1, '', 'pending', 6, 1521073138, 2),
(65, 'Study language english', '22:00:00', '22:30:00', 1, '', 'pending', 6, 1521073155, 2),
(66, 'Viết checklist và giải trí', '22:30:00', '23:10:00', 3, '', 'pending', 6, 1521073217, 2);

-- --------------------------------------------------------

--
-- Table structure for table `work_time`
--

CREATE TABLE `work_time` (
  `wot_id` int(11) NOT NULL,
  `wot_day` int(2) NOT NULL,
  `wot_month` int(2) NOT NULL,
  `wot_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `work_time`
--

INSERT INTO `work_time` (`wot_id`, `wot_day`, `wot_month`, `wot_year`) VALUES
(1, 10, 3, 2018),
(2, 11, 3, 2018),
(3, 12, 3, 2018),
(4, 13, 3, 2018),
(5, 14, 3, 2018),
(6, 15, 3, 2018);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`wor_id`);

--
-- Indexes for table `work_time`
--
ALTER TABLE `work_time`
  ADD PRIMARY KEY (`wot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `wor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `work_time`
--
ALTER TABLE `work_time`
  MODIFY `wot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
