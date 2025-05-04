-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 04, 2024 at 09:06 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_sp`
--

DROP TABLE IF EXISTS `chitiet_sp`;
CREATE TABLE IF NOT EXISTS `chitiet_sp` (
  `idctsp` int(11) NOT NULL AUTO_INCREMENT,
  `idsp` int(11) NOT NULL,
  `tenct` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `hinhct` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `thongtinct` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idctsp`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiet_sp`
--

INSERT INTO `chitiet_sp` (`idctsp`, `idsp`, `tenct`, `hinhct`, `thongtinct`) VALUES
(1, 5, 'Acer TravelMate B3 TMB311 31 P49D N5030 (NX.VNFSV.005)', 'hinh2.jpg', 'Model\r\n\r\nLaptop MSI Prestige 14 A11SC 203VN\r\n\r\nCPU\r\n\r\nIntel® i7-1195G7 Gen 11th (2.9GHz upto 5.0GHz, 4 Cores, 8 Threads, 12MB Cache)\r\n\r\nRAM\r\n\r\n16GB LPDDR4 4267MHz Onboard\r\n\r\nỔ cứng\r\n\r\nSSD 512GB M.2 PCIe (1 slot)\r\n\r\nCD/DVD\r\n\r\nNone\r\n\r\nCard VGA\r\n\r\nNvidia GeForce® GTX 1650 4GB GDDR6 + Intel® Iris® Xe Graphics\r\n\r\nMàn hình\r\n\r\n14.1-inch FHD (1920x1080), tấm nền IPS, 100% sRGB, viền mỏng, chống chói, góc mở 180*.\r\n\r\nKết nối\r\n\r\nKiller Wi-Fi 6E 802.11ax + Bluetooth 5.2\r\n\r\nTích hợp\r\n\r\n2 x USB Type-C (support Thunderbolt™4 / DisplayPort / PowerDelivery)\r\n1 x USB 3.1\r\n1 x MicroSD Reader Card\r\n1 x Camera HD 720P\r\n1 x FingerPrint\r\n1 x Jack Audio™ 3.5mm with Hi-Res Audio\r\n2 x Speaker \r\n\r\nBàn phím\r\n\r\nChiclet keyboard with Led\r\n\r\nPin\r\n\r\n52WHrs Li-ion Battery\r\n\r\nTrọng lượng\r\n\r\n1.29 kg\r\n\r\nKích thước\r\n\r\n319 x 219 x 15.9 mm (Dài x Rộng x Dày)\r\n\r\nHệ điều hành\r\n\r\nWindows 10 bản quyền\r\n\r\nMàu sắc\r\n\r\nMàu trắng (White)\r\n\r\nTình trạng\r\n\r\nMới 100%, hàng chính hãng, đầy đủ phụ kiện\r\n\r\nThời gian bảo hành\r\n\r\nBảo hành 24 tháng chính hãng tại TTBH MSI toàn quốc'),
(2, 5, 'HP 340s G7 i3 1005G1 (240Q4PA)', 'hình.jpg', 'Model\r\n\r\nLaptop MSI Prestige 14 A11SC 203VN\r\n\r\nCPU\r\n\r\nIntel® i7-1195G7 Gen 11th (2.9GHz upto 5.0GHz, 4 Cores, 8 Threads, 12MB Cache)\r\n\r\nRAM\r\n\r\n16GB LPDDR4 4267MHz Onboard\r\n\r\nỔ cứng\r\n\r\nSSD 512GB M.2 PCIe (1 slot)\r\n\r\nCD/DVD\r\n\r\nNone\r\n\r\nCard VGA\r\n\r\nNvidia GeForce® GTX 1650 4GB GDDR6 + Intel® Iris® Xe Graphics\r\n\r\nMàn hình\r\n\r\n14.1-inch FHD (1920x1080), tấm nền IPS, 100% sRGB, viền mỏng, chống chói, góc mở 180*.\r\n\r\nKết nối\r\n\r\nKiller Wi-Fi 6E 802.11ax + Bluetooth 5.2\r\n\r\nTích hợp\r\n\r\n2 x USB Type-C (support Thunderbolt™4 / DisplayPort / PowerDelivery)\r\n1 x USB 3.1\r\n1 x MicroSD Reader Card\r\n1 x Camera HD 720P\r\n1 x FingerPrint\r\n1 x Jack Audio™ 3.5mm with Hi-Res Audio\r\n2 x Speaker \r\n\r\nBàn phím\r\n\r\nChiclet keyboard with Led\r\n\r\nPin\r\n\r\n52WHrs Li-ion Battery\r\n\r\nTrọng lượng\r\n\r\n1.29 kg\r\n\r\nKích thước\r\n\r\n319 x 219 x 15.9 mm (Dài x Rộng x Dày)\r\n\r\nHệ điều hành\r\n\r\nWindows 10 bản quyền\r\n\r\nMàu sắc\r\n\r\nMàu trắng (White)\r\n\r\nTình trạng\r\n\r\nMới 100%, hàng chính hãng, đầy đủ phụ kiện\r\n\r\nThời gian bảo hành\r\n\r\nBảo hành 24 tháng chính hãng tại TTBH MSI toàn quốc'),
(3, 5, 'HP 340s G7 i3 1005G1 2023', 'hinh2.jpg', 'Model\r\n\r\nLaptop MSI Prestige 14 A11SC 203VN\r\n\r\nCPU\r\n\r\nIntel® i7-1195G7 Gen 11th (2.9GHz upto 5.0GHz, 4 Cores, 8 Threads, 12MB Cache)\r\n\r\nRAM\r\n\r\n16GB LPDDR4 4267MHz Onboard\r\n\r\nỔ cứng\r\n\r\nSSD 512GB M.2 PCIe (1 slot)\r\n\r\nCD/DVD\r\n\r\nNone\r\n\r\nCard VGA\r\n\r\nNvidia GeForce® GTX 1650 4GB GDDR6 + Intel® Iris® Xe Graphics\r\n\r\nMàn hình\r\n\r\n14.1-inch FHD (1920x1080), tấm nền IPS, 100% sRGB, viền mỏng, chống chói, góc mở 180*.\r\n\r\nKết nối\r\n\r\nKiller Wi-Fi 6E 802.11ax + Bluetooth 5.2\r\n\r\nTích hợp\r\n\r\n2 x USB Type-C (support Thunderbolt™4 / DisplayPort / PowerDelivery)\r\n1 x USB 3.1\r\n1 x MicroSD Reader Card\r\n1 x Camera HD 720P\r\n1 x FingerPrint\r\n1 x Jack Audio™ 3.5mm with Hi-Res Audio\r\n2 x Speaker \r\n\r\nBàn phím\r\n\r\nChiclet keyboard with Led\r\n\r\nPin\r\n\r\n52WHrs Li-ion Battery\r\n\r\nTrọng lượng\r\n\r\n1.29 kg\r\n\r\nKích thước\r\n\r\n319 x 219 x 15.9 mm (Dài x Rộng x Dày)\r\n\r\nHệ điều hành\r\n\r\nWindows 10 bản quyền\r\n\r\nMàu sắc\r\n\r\nMàu trắng (White)\r\n\r\nTình trạng\r\n\r\nMới 100%, hàng chính hãng, đầy đủ phụ kiện\r\n\r\nThời gian bảo hành\r\n\r\nBảo hành 24 tháng chính hãng tại TTBH MSI toàn quốc'),
(4, 5, 'MacBook Air M1 2020 7-core GPU', 'hinh2.jpg', 'Model\r\n\r\nLaptop MSI Prestige 14 A11SC 203VN\r\n\r\nCPU\r\n\r\nIntel® i7-1195G7 Gen 11th (2.9GHz upto 5.0GHz, 4 Cores, 8 Threads, 12MB Cache)\r\n\r\nRAM\r\n\r\n16GB LPDDR4 4267MHz Onboard\r\n\r\nỔ cứng\r\n\r\nSSD 512GB M.2 PCIe (1 slot)\r\n\r\nCD/DVD\r\n\r\nNone\r\n\r\nCard VGA\r\n\r\nNvidia GeForce® GTX 1650 4GB GDDR6 + Intel® Iris® Xe Graphics\r\n\r\nMàn hình\r\n\r\n14.1-inch FHD (1920x1080), tấm nền IPS, 100% sRGB, viền mỏng, chống chói, góc mở 180*.\r\n\r\nKết nối\r\n\r\nKiller Wi-Fi 6E 802.11ax + Bluetooth 5.2\r\n\r\nTích hợp\r\n\r\n2 x USB Type-C (support Thunderbolt™4 / DisplayPort / PowerDelivery)\r\n1 x USB 3.1\r\n1 x MicroSD Reader Card\r\n1 x Camera HD 720P\r\n1 x FingerPrint\r\n1 x Jack Audio™ 3.5mm with Hi-Res Audio\r\n2 x Speaker \r\n\r\nBàn phím\r\n\r\nChiclet keyboard with Led\r\n\r\nPin\r\n\r\n52WHrs Li-ion Battery\r\n\r\nTrọng lượng\r\n\r\n1.29 kg\r\n\r\nKích thước\r\n\r\n319 x 219 x 15.9 mm (Dài x Rộng x Dày)\r\n\r\nHệ điều hành\r\n\r\nWindows 10 bản quyền\r\n\r\nMàu sắc\r\n\r\nMàu trắng (White)\r\n\r\nTình trạng\r\n\r\nMới 100%, hàng chính hãng, đầy đủ phụ kiện\r\n\r\nThời gian bảo hành\r\n\r\nBảo hành 24 tháng chính hãng tại TTBH MSI toàn quốc');

-- --------------------------------------------------------

--
-- Table structure for table `dathang`
--

DROP TABLE IF EXISTS `dathang`;
CREATE TABLE IF NOT EXISTS `dathang` (
  `idkh` int(11) NOT NULL AUTO_INCREMENT,
  `tenkh` text COLLATE utf8_unicode_ci NOT NULL,
  `gt` text COLLATE utf8_unicode_ci NOT NULL,
  `diachi` text COLLATE utf8_unicode_ci NOT NULL,
  `dienthoai` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `Ngaysinh` text COLLATE utf8_unicode_ci NOT NULL,
  `cmnd` text COLLATE utf8_unicode_ci NOT NULL,
  `thanhtoan` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idkh`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dathang`
--

INSERT INTO `dathang` (`idkh`, `tenkh`, `gt`, `diachi`, `dienthoai`, `email`, `Ngaysinh`, `cmnd`, `thanhtoan`) VALUES
(1, 'Nguyễn Đăng', '1', 'Nguyễn Hữu Cảnh Q7', '0907538649', 'dang@hotec.edu.vn', '1/1/2002', '32534546546', '3');

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

DROP TABLE IF EXISTS `don_hang`;
CREATE TABLE IF NOT EXISTS `don_hang` (
  `iddh` int(11) NOT NULL AUTO_INCREMENT,
  `idkh` int(11) NOT NULL,
  `idsp` int(11) NOT NULL,
  `ngaydh` text COLLATE utf8_unicode_ci NOT NULL,
  `sl` int(11) NOT NULL,
  PRIMARY KEY (`iddh`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`iddh`, `idkh`, `idsp`, `ngaydh`, `sl`) VALUES
(29, 126, 1, '28/09/2022 - 08:34:12', 3),
(28, 125, 9, '27/09/2022 - 00:12:05', 3),
(27, 125, 1, '27/09/2022 - 00:12:05', 2),
(30, 127, 1, '04/03/2024 - 06:50:50', 1),
(31, 127, 9, '04/03/2024 - 06:50:50', 1),
(32, 127, 4, '04/03/2024 - 06:50:50', 1),
(33, 128, 1, '04/03/2024 - 07:59:30', 1),
(34, 128, 2, '04/03/2024 - 07:59:30', 1),
(35, 129, 1, '04/03/2024 - 08:00:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

DROP TABLE IF EXISTS `khach_hang`;
CREATE TABLE IF NOT EXISTS `khach_hang` (
  `idkh` int(11) NOT NULL AUTO_INCREMENT,
  `tenkh` text COLLATE utf8_unicode_ci NOT NULL,
  `dcgiaohang` text COLLATE utf8_unicode_ci NOT NULL,
  `diachi` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idkh`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`idkh`, `tenkh`, `dcgiaohang`, `diachi`, `email`) VALUES
(126, 'Nguyễn Đăng', '32432', 'Nguyễn Hữu Cảnh Q7', 'dang@hotec.edu.vn'),
(125, 'Nguyễn Đăng', '0904567890', 'Nguyễn Hữu Cảnh Q7', 'dang@hotec.edu.vn'),
(127, 'Đăng', '35435435', 'tân Bình TPHCM', 'dang@gmail.comvn'),
(128, 'Đăng', '123456', 'tân Bình TPHCM', 'dang@gmail.comvn'),
(129, 'Đăng', '123456', 'tân Bình TPHCM', 'nguyengiaquangdang@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `loai_sp`
--

DROP TABLE IF EXISTS `loai_sp`;
CREATE TABLE IF NOT EXISTS `loai_sp` (
  `idlsp` int(11) NOT NULL AUTO_INCREMENT,
  `tenloai` text COLLATE utf8_unicode_ci NOT NULL,
  `ghichu` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idlsp`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loai_sp`
--

INSERT INTO `loai_sp` (`idlsp`, `tenloai`, `ghichu`) VALUES
(1, 'Asus', 'Nhật bản trên 20 năm'),
(2, 'Panasonic', 'Nhật bản'),
(3, 'LG Electronics', 'LG Electronics'),
(4, 'Sony', 'Công ty công nghiệp Sony, gọi tắt là Sony'),
(5, 'Samsung', 'Samsung electronics là một trong số ít công ty vẫn giữ khả năng phát triển nhờ dẫn đầu công nghệ kỹ thuật số'),
(6, 'Asanzo', 'Công ty Asanzo Việt Nam'),
(7, 'Daikin Vietnam', 'Daikin Vietnam'),
(8, 'Toshiba', 'Toshiba là một trong những thương hiệu hàng đầu thế giới '),
(10, 'Panasonic', 'Nhật bản'),
(9, 'Electrolux', 'Những sản phẩm của Electrolux được thiết kế để phù hợp');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `product_desc` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `product_img_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `product_desc`, `product_img_name`, `price`) VALUES
(1, 'PD1001', 'Android Phone FX1', 'Di sertakan secara rambang yang lansung tidak munasabah. Jika anda ingin menggunakan Lorem Ipsum, anda perlu memastikan bahwa tiada apa yang', 'android-phone.jpg', '200.50'),
(2, 'PD1002', 'Television DXT', 'Ia menggunakan kamus yang mengandungi lebih 200 ayat Latin, bersama model dan struktur ayat Latin, untuk menghasilkan Lorem Ipsum yang munasabah.', 'lcd-tv.jpg', '500.85'),
(3, 'PD1003', 'External Hard Disk', 'Ada banyak versi dari mukasurat-mukasurat Lorem Ipsum yang sedia ada, tetapi kebanyakkannya telah diubahsuai, lawak jenaka diselitkan, atau ayat ayat yang', 'external-hard-disk.jpg', '100.00'),
(4, 'PD1004', 'Wrist Watch GE2', 'Memalukan akan terselit didalam di tengah tengah kandungan text. Semua injin Lorem Ipsum didalam Internet hanya mengulangi text, sekaligus menjadikan injin kami sebagai yang terunggul dan tepat sekali di Internet.', 'wrist-watch.jpg', '400.30');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

DROP TABLE IF EXISTS `san_pham`;
CREATE TABLE IF NOT EXISTS `san_pham` (
  `idsp` int(250) NOT NULL AUTO_INCREMENT,
  `idlsp` int(11) NOT NULL,
  `tensp` text COLLATE utf8_unicode_ci NOT NULL,
  `hinhsp` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `thongtinsp` text COLLATE utf8_unicode_ci NOT NULL,
  `gianhap` double NOT NULL,
  PRIMARY KEY (`idsp`)
) ENGINE=MyISAM AUTO_INCREMENT=5557 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`idsp`, `idlsp`, `tensp`, `hinhsp`, `thongtinsp`, `gianhap`) VALUES
(1, 1, 'Acer TravelMate B3 TMB31131', 'hinh1.jpg', 'Màn hình: 11.6\", HD\r\n\r\nCPU: Celeron, N4020, 1.1GHz\r\n\r\nCard: Intel UHD 600\r\n\r\nPin: 3-cell, 48Wh\r\n\r\nKhối lượng: 1.4 kg', 4900000),
(2, 1, 'Acer Aspire 7 Gaming A715', 'hinh2.jpg', 'Acer Aspire 7 Gaming A715 42G R4XX R5 5500U\r\nMàn hình: 15.6\", Full HD\r\n\r\nCPU: Ryzen 5, 5500U, 2.1GHz\r\n\r\nCard: GTX 1650 4GB\r\n\r\nPin: 48Wh\r\n\r\nKhối lượng: 2.1 kg', 9000000),
(3, 2, 'Lenovo Ideapad 1 11IGL05', 'hinh3.jpg', 'Gaming G15 5511 i5 11400H \r\nMàn hình: 15.6\", 2K, 240Hz\r\n\r\nCPU: i7, 11800H, 2.30 GHz\r\n\r\nCard: RTX 3070 8GB\r\n\r\nPin: 6-cell Li-ion, 86 Wh\r\n\r\nKhối lượng: 2.69 kg', 58000000),
(4, 2, 'Dell Vostro 3510 i3 1115G4', 'hinh2.jpg', 'Màn hình: 15.6\", 2K, 240Hz\r\n\r\nCPU: i7, 11800H, 2.30 GHz\r\n\r\nCard: RTX 3070 8GB\r\n\r\nPin: 6-cell Li-ion, 86 Wh\r\n\r\nKhối lượng: 2.69 kg', 58000000),
(5, 2, 'Vostro 3400 i7 1165G7', 'hinh2.jpg', 'Dell Vostro 3400 i7 1165G7 (V4I7015W1)\r\nRAM 8 GB SSD 512 GB\r\n25.190.000₫ -6%\r\n23.590.000₫\r\nQuà 250.000₫\r\nMàn hình: 14\", Full HD\r\n\r\nCPU: i7, 1165G7, 2.8GHz\r\n\r\nCard: MX330 2GB\r\n\r\nPin: 3-cell, 42Wh\r\n\r\nKhối lượng: 1.64 kg', 25000000),
(6, 2, 'Gaming G15 5515 R5 5600H', 'hinh2.jpg', 'Gaming G15 5515 R5 5600H (P105F004DGR)\r\n24.690.000₫\r\nQuà 100.000₫\r\n\r\nMàn hình: 15.6\", Full HD, 120Hz\r\n\r\nCPU: Ryzen 5, 5600H, 3.3GHz\r\n\r\nCard: RTX 3050 4GB\r\n\r\nPin: 3-cell, 56Wh\r\n\r\nKhối lượng: 2.8 kg', 25000000),
(7, 2, 'Vostro 5410 i5 11320H', 'hinh1.jpg', 'Vostro 5410 i5 11320H\r\nMàn hình: 14\", Full HD\r\n\r\nCPU: i5, 11320H, 3.2GHz\r\n\r\nCard: Intel Iris Xe\r\n\r\nPin: 4-cell, 54Wh\r\n\r\nKhối lượng: 1.44 kg', 22000000),
(8, 2, 'Dell Gaming G15 5515 R5 5600H (P105F004CGR)', 'hinh2.jpg', 'Dell Gaming G15 5515 R5 5600H (P105F004CGR)\r\nMàn hình: 15.6\", Full HD, 120Hz\r\n\r\nCPU: Ryzen 5, 5600H, 3.3GHz\r\n\r\nCard: RTX 3050 4GB\r\n\r\nPin: 3-cell, 56Wh\r\n\r\nKhối lượng: 2.8 kg', 26000000),
(9, 2, 'HP 340s G7 i3 1005G1', 'hinh3.jpg', 'HP 340s G7 i3 1005G1\r\nMàn hình: 14\", Full HD\r\n\r\nCPU: i3, 1005G1, 1.2GHz\r\n\r\nCard: Intel UHD\r\n\r\nPin: 3-cell, 41Wh\r\n\r\nKhối lượng: 1.38 kg', 10000000),
(11, 2, 'Laptop MSI Prestige', 'hinh2.jpg', 'Laptop MSI Prestige 14 A11SC 203VN (White) | \r\ni7-1195G7 Gen 11th | 16GB DDR4 | SSD 512GB PCle | \r\nVGA Nvidia GTX 1650 4GB | \r\n14.1 FHD IPS | Win10', 19000000),
(222, 1, 'Cá kiển đẹp', 'hinh1.jpg', 'Cá kiển hiếm có trên VN', 5000000),
(224, 3, 'khẩu trang KF94 chuyến ', 'tomhum.jpg', 'Xả lỗ nghỉ bán\r\nCòn 200t khẩu trang KF94 chuyến cuối\r\nXả sốc GIÁ #79k/1 thùg 300 cái MỘT THÙG 300 cái ạ ( chưa đến 1k một cái ạ)\r\n   Hàg 4 lớp xịn xò. .bao.dày đẹp chuẩn ảnh', 10000000),
(225, 3, 'khẩu trang KF94 chuyến ', 'tomhum.jpg', 'Xả lỗ nghỉ bán\r\nCòn 200t khẩu trang KF94 chuyến cuối\r\nXả sốc GIÁ #79k/1 thùg 300 cái MỘT THÙG 300 cái ạ ( chưa đến 1k một cái ạ)\r\n   Hàg 4 lớp xịn xò. .bao.dày đẹp chuẩn ảnh', 10000000),
(226, 1, 'Daikin việt nam', 'than-cua-tuyet-.jpg', 'Mỹ nói gì về lực lượng Nga', 90000),
(128, 4, 'khẩu trang KF94 chuyến ', 'tomhum.jpg', 'Mỹ nói gì về lực lượng Nga', 10000000),
(333, 7, 'khẩu trang KF94 chuyến ', 'tomhum.jpg', 'Mỹ nói gì về lực lượng Nga', 10000000),
(5555, 7, 'khẩu trang KF94 chuyến ', 'tomhum.jpg', 'Mỹ nói gì về lực lượng Nga', 10000000),
(5556, 3, 'máy lạnh', 'bd.jpg', 'Hội Liên hiệp Phụ nữ Quận 4 với Lễ phát động các hoạt động chào mừng kỷ niệm 114 năm Ngày Quốc tế Phụ nữ 8/3, 1984 năm cuộc khởi nghĩa Hai Bà Trưng và tiết mục Đồng diễn Áo dài với sự tham dự của 500 hội viên phụ nữ tại Quảng trường Công viên Khánh Hội', 9000000),
(559, 3, 'tôm hùm', 'tomhum.jpg', 'Tôm hùm', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(4, 'qdang', 'dang@hotec.edu.vn', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loai_sp`
--
ALTER TABLE `loai_sp` ADD FULLTEXT KEY `tenloai` (`tenloai`);
ALTER TABLE `loai_sp` ADD FULLTEXT KEY `ghichu` (`ghichu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
