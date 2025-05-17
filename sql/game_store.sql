-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 17, 2025 lúc 12:47 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `game_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_sp`
--

CREATE TABLE `loai_sp` (
  `idlsp` int(11) NOT NULL,
  `tenlsp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loai_sp`
--

INSERT INTO `loai_sp` (`idlsp`, `tenlsp`) VALUES
(1, 'Action'),
(2, 'RPG'),
(3, 'Turn Base'),
(4, 'FPS'),
(5, 'FAMILY'),
(6, 'Máy chơi game');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `order_id` varchar(50) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `order_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `ten_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id_role`, `ten_role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'guest');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `masp` varchar(255) NOT NULL,
  `tensp` varchar(255) NOT NULL,
  `idlsp` int(11) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  `gia` int(11) DEFAULT NULL,
  `slnhap` int(11) DEFAULT NULL,
  `slban` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `masp`, `tensp`, `idlsp`, `mota`, `hinhanh`, `gia`, `slnhap`, `slban`) VALUES
(26, 'MC1', 'Máy game One Xplayer', 6, 'Hãng sản xuất: One Netbook\r\nĐời máy: One Xplayer \r\nTình trạng: New/fullBOX\r\nCác phiên bản: i7-1195G7(SSD1TB)  AMD Ryzen® 5800U (SSD-1TB)  MINI 7&quot; i7-1195G7 (SSD1TB)\r\nChú ý: Máy chưa có sẵn khách Order cọc trước 5.000.000 vnđ sau 10-15 ngày sẽ nhận má', 'img_68284b84db9ed.jpg', 25000000, 30, 5),
(27, 'A1', 'Devil May Cry 5', 1, 'Game hành động chặt chém đỉnh cao với đồ họa đẹp và gameplay tốc độ.', 'img_68284fa14b85b.jpg', 850000, 70, 3),
(28, 'A2', 'Sekiro: Shadows Die Twice', 1, 'Game hành động lén lút, thông minh, đòi hỏi kỹ năng né đỡ và phản đòn chính xác.', 'img_68285112038f3.jpg', 900000, 50, 2),
(29, 'A3', 'DOOM Eternal', 1, 'Game bắn súng góc nhìn thứ nhất với nhịp độ nhanh và âm nhạc mạnh mẽ.', 'img_682850052f8a1.jpg', 800000, 60, 5),
(30, 'A4', 'Hollow Knight', 1, 'Game hành động đi cảnh phong cách Metroidvania với thế giới sâu sắc.', 'img_68284e70709b9.jpg', 250000, 90, 76),
(31, 'A5', 'Yakuza: Like a Dragon', 1, 'Game hành động phiêu lưu với yếu tố nhập vai và cốt truyện hấp dẫn.', 'img_6828517275345.jpg', 750000, 40, 22),
(42, 'RPG1', 'The Witcher 3: Wild Hunt', 2, 'Game nhập vai hành động thế giới mở với cốt truyện sâu sắc và đồ họa đẹp.', 'img_682854c264e1a.jpg', 650000, 100, 1),
(43, 'RPG2', 'Elden Ring', 2, 'Game nhập vai thế giới mở cực kỳ thử thách từ FromSoftware.', 'img_682854d10b243.jpg', 1200000, 80, 4),
(44, 'RPG3', 'Persona 5 Royal', 2, 'JRPG học đường nổi bật với gameplay theo lượt và cốt truyện hấp dẫn.', 'img_6828553bcca32.jpg', 750000, 90, 10),
(45, 'RPG4', 'Final Fantasy VII Remake', 2, 'Phiên bản làm lại của game huyền thoại với đồ họa hiện đại và lối chơi mới.', 'img_6828554ba12db.jpg', 890000, 70, 2),
(46, 'RPG5', 'Dragon Age: Inquisition', 2, 'Game RPG phương Tây với chiến thuật tổ đội và thế giới mở rộng lớn.', 'img_6828555d288a3.jpg', 600000, 50, 30),
(47, 'RPG6', 'Cyberpunk 2077', 2, 'RPG hành động đặt trong thế giới tương lai với các lựa chọn phong phú.', 'img_6828556ec4afe.jpg', 800000, 60, 12),
(48, 'RPG7', 'Divinity: Original Sin 2', 2, 'RPG theo lượt với khả năng tương tác môi trường và cốt truyện nhiều nhánh.', 'img_6828557f89b9c.jpg', 720000, 40, 12),
(49, 'RPG8', 'Mass Effect Legendary Edition', 2, 'Bộ ba game nhập vai khoa học viễn tưởng với yếu tố lựa chọn sâu sắc.', 'img_6828558b8c2a0.jpg', 950000, 45, 11),
(50, 'RPG9', 'Tales of Arise', 2, 'JRPG phong cách anime với chiến đấu thời gian thực mượt mà.', 'img_6828559831150.jpg', 790000, 55, 12),
(51, 'RPG10', 'Skyrim Special Edition', 2, 'Game nhập vai thế giới mở huyền thoại với khả năng mod phong phú.', 'img_682855ac40f8c.jpg', 680000, 100, 45),
(52, 'A6', 'God of War', 1, 'Game hành động chặt chém lấy bối cảnh thần thoại Bắc Âu.', 'img_682858a42b760.jpg', 950000, 70, 1),
(53, 'A7', 'Celeste', 1, 'Game đi cảnh giàu cảm xúc với gameplay chính xác và thử thách.', 'img_682858b221ef9.jpg', 180000, 120, 35),
(54, 'A8', 'Street Fighter V', 1, 'Game đối kháng nổi tiếng với nhiều nhân vật và kỹ năng.', 'img_682858be81dac.jpg', 700000, 80, 66),
(55, 'A9', 'Call of Duty: Modern Warfare', 1, 'Game FPS hiện đại với đồ họa cao cấp và chế độ chơi mạng phong phú.', 'img_682858cb5fcfc.jpg', 1000000, 55, 33),
(56, 'A10', 'Tekken 7', 1, 'Game đối kháng 3D với cơ chế chiến đấu chuyên sâu và nhiều nhân vật.', 'img_682858d7c9cb4.jpg', 750000, 85, 22),
(57, 'T1', 'Fire Emblem: Three Houses', 3, 'Game chiến thuật theo lượt kết hợp yếu tố nhập vai và quản lý học viện.', 'img_68285b2b43dd2.jpg', 850000, 60, 44),
(58, 'T2', 'XCOM 2', 3, 'Game chiến thuật theo lượt với yếu tố sci-fi và quản lý đội hình chống người ngoài hành tinh.', 'img_68285b3e432d3.jpg', 600000, 80, 11),
(59, 'T3', 'Divinity: Original Sin 2', 3, 'Game RPG đánh theo lượt, cốt truyện phong phú và cơ chế tương tác tự do.', 'img_68285b51e3100.jpg', 720000, 50, 1),
(60, 'T4', 'Persona 5 Royal', 3, 'JRPG nổi tiếng với lối chơi theo lượt và cốt truyện học đường hấp dẫn.', 'img_68285b62de3d7.jpg', 750000, 70, 12),
(61, 'T5', 'Triangle Strategy', 3, 'Game chiến thuật theo lượt phong cách HD-2D với nhiều lựa chọn ảnh hưởng cốt truyện.', 'img_68285b72e9769.jpg', 800000, 40, 30),
(62, 'T6', 'Octopath Traveler', 3, 'JRPG với hệ thống chiến đấu theo lượt và đồ họa độc đáo.', 'img_68285b7e7b0d9.jpg', 670000, 55, 12),
(63, 'T7', 'Final Fantasy Tactics', 3, 'Game chiến thuật theo lượt cổ điển với chiều sâu chiến lược và cốt truyện phức tạp.', 'img_68285b8dcb42a.jpg', 550000, 30, 14),
(64, 'T8', 'Wasteland 3', 3, 'Game RPG hậu tận thế với chiến đấu theo lượt và yếu tố quyết định cốt truyện.', 'img_68285b9acf09a.jpg', 690000, 45, 12),
(65, 'T9', 'Gears Tactics', 3, 'Spin-off chiến thuật theo lượt của dòng game Gears of War.', 'img_68285bafba54c.jpg', 700000, 35, 32),
(66, 'T10', 'Into the Breach', 3, 'Game chiến thuật theo lượt với trận chiến nhỏ gọn, đậm tính toán logic.', 'img_68285bbfef8be.jpg', 250000, 100, 11),
(67, 'F1', 'Mario Kart 8 Deluxe', 5, 'Game đua xe vui nhộn phù hợp với mọi lứa tuổi, hỗ trợ chơi nhiều người.', 'img_6828677c160bd.jpg', 900000, 40, 34),
(68, 'F2', 'Overcooked! 2', 5, 'Game nấu ăn hỗn loạn đầy hài hước, khuyến khích teamwork trong gia đình.', 'img_68286788a1fb4.jpg', 450000, 60, 54),
(69, 'F3', 'Animal Crossing: New Horizons', 5, 'Game mô phỏng cuộc sống thư giãn, xây dựng đảo và giao lưu bạn bè.', 'img_6828679557d86.jpg', 950000, 35, 23),
(70, 'F4', 'Just Dance 2024', 5, 'Game nhảy theo nhạc, vui nhộn, lý tưởng cho tiệc gia đình.', 'img_682867a3cb83f.jpg', 800000, 30, 21),
(71, 'F5', 'Lego Marvel Super Heroes', 5, 'Game hành động hài hước dành cho mọi độ tuổi, đặc biệt là fan Marvel.', 'img_682867b48179a.jpg', 700000, 50, 32),
(72, 'F6', 'Super Mario Party', 5, 'Game party với nhiều mini-game đa dạng, chơi cùng gia đình cực kỳ vui.', 'img_682867c1e3abb.jpg', 850000, 45, 32),
(73, 'F7', 'Minecraft', 5, 'Game xây dựng thế giới mở nổi tiếng, kích thích sáng tạo và phù hợp với mọi lứa tuổi.', 'img_682867ce43756.jpg', 780000, 60, 55),
(74, 'F8', 'Lego City Undercover', 5, 'Game phiêu lưu thế giới mở với phong cách hài hước.', 'img_682867de7568b.jpg', 600000, 40, 24),
(75, 'F9', 'Paw Patrol: On a Roll', 5, 'Game đơn giản dành cho trẻ em, dựa theo loạt phim hoạt hình Paw Patrol.', 'img_682867ed10135.jpg', 480000, 35, 11),
(76, 'F10', 'Lego Harry Potter Collection', 5, 'Kết hợp hành động và giải đố, lấy cảm hứng từ truyện Harry Potter.', 'img_682867fc20686.jpg', 650000, 50, 44),
(77, 'M1', 'PlayStation 5', 6, 'Máy chơi game thế hệ mới của Sony với ổ đĩa và tay cầm DualSense.', 'img_68286307bc5b7.jpg', 13900000, 20, 2),
(78, 'M2', 'Xbox Series X', 6, 'Máy chơi game mạnh mẽ nhất của Microsoft hỗ trợ 4K và Game Pass.', 'img_682863221a691.jpg', 13500000, 15, 22),
(79, 'M3', 'Nintendo Switch OLED', 6, 'Phiên bản nâng cấp của Switch với màn hình OLED và dock mới.', 'img_6828632fba275.jpg', 9500000, 25, 11),
(80, 'M4', 'Steam Deck', 6, 'Máy chơi game cầm tay của Valve chạy SteamOS, hỗ trợ chơi game PC.', 'img_6828634457fe4.jpg', 11500000, 10, 5),
(81, 'M5', 'PlayStation 4 Slim', 6, 'Phiên bản gọn nhẹ của PS4, vẫn hỗ trợ nhiều tựa game đình đám.', 'img_68286356a6935.jpg', 6900000, 30, 13),
(82, 'F1', 'Mario Kart 8 Deluxe', 5, 'Game đua xe vui nhộn phù hợp với mọi lứa tuổi, hỗ trợ chơi nhiều người.', 'img_6828677c160bd.jpg', 900000, 40, 34),
(83, 'F2', 'Overcooked! 2', 5, 'Game nấu ăn hỗn loạn đầy hài hước, khuyến khích teamwork trong gia đình.', 'img_68286788a1fb4.jpg', 450000, 60, 54),
(84, 'F3', 'Animal Crossing: New Horizons', 5, 'Game mô phỏng cuộc sống thư giãn, xây dựng đảo và giao lưu bạn bè.', 'img_6828679557d86.jpg', 950000, 35, 23),
(85, 'F4', 'Just Dance 2024', 5, 'Game nhảy theo nhạc, vui nhộn, lý tưởng cho tiệc gia đình.', 'img_682867a3cb83f.jpg', 800000, 30, 21),
(86, 'F5', 'Lego Marvel Super Heroes', 5, 'Game hành động hài hước dành cho mọi độ tuổi, đặc biệt là fan Marvel.', 'img_682867b48179a.jpg', 700000, 50, 32),
(87, 'F6', 'Super Mario Party', 5, 'Game party với nhiều mini-game đa dạng, chơi cùng gia đình cực kỳ vui.', 'img_682867c1e3abb.jpg', 850000, 45, 32),
(88, 'F7', 'Minecraft', 5, 'Game xây dựng thế giới mở nổi tiếng, kích thích sáng tạo và phù hợp với mọi lứa tuổi.', 'img_682867ce43756.jpg', 780000, 60, 55),
(89, 'F8', 'Lego City Undercover', 5, 'Game phiêu lưu thế giới mở với phong cách hài hước.', 'img_682867de7568b.jpg', 600000, 40, 24),
(90, 'F9', 'Paw Patrol: On a Roll', 5, 'Game đơn giản dành cho trẻ em, dựa theo loạt phim hoạt hình Paw Patrol.', 'img_682867ed10135.jpg', 480000, 35, 11),
(91, 'F10', 'Lego Harry Potter Collection', 5, 'Kết hợp hành động và giải đố, lấy cảm hứng từ truyện Harry Potter.', 'img_682867fc20686.jpg', 650000, 50, 44);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `PWD` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `username`, `PWD`, `email`, `roles`) VALUES
(1, 'drill', '$2y$10$MyPhqftiu8viiiuvMskM2OLPdZKUJkTqT91zbg/GMw2x6xevVwBqK', 'drill@gmail.com', 2),
(2, 'admin123', '$2y$10$WPNCqz5ikeLNbojxczke1emWbgeAQHaGWorvWkvsAtWNY.0IU..uq', 'nhozlong089@gmail.com', 1),
(3, 'qwe', '$2y$10$OcSg6LeAtKheelXz.lMmTu8kN0H0e3T5.4eo/Qxeu4L8g.xiqnvV6', 'qwe123@yahoo.com', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  ADD PRIMARY KEY (`idlsp`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlsp` (`idlsp`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_roleuser` (`roles`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_sp`
--
ALTER TABLE `loai_sp`
  MODIFY `idlsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`idlsp`) REFERENCES `loai_sp` (`idlsp`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_roleuser` FOREIGN KEY (`roles`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
