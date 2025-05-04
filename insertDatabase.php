<?php
    include('libs/config.php');  
    try
    {
        global $conn;
               
        $sql="INSERT INTO NHANVIEN (TENNV,USERNAME,PWD) VALUES(N'Nguyễn Đăng','dang','123')";
        $conn->exec($sql); 
        $sql="INSERT INTO `loai_sp` (`idlsp`, `tenloai`, `ghichu`) VALUES";
        $sql .="(1, 'Asus', 'Nhật bản trên 20 năm'),";
        $sql .="(2, 'Panasonic', 'Nhật bản'),";
        $sql .="(3, 'LG Electronics', 'LG Electronics'),";
        $sql .="(4, 'Sony', 'Công ty công nghiệp Sony, gọi tắt là Sony'),";
        $sql .="(5, 'Samsung', 'Samsung electronics là một trong số ít công ty vẫn giữ khả năng phát triển nhờ dẫn đầu công nghệ kỹ thuật số'),";
        $sql .="(6, 'Asanzo', 'Công ty Asanzo Việt Nam'),";
        $sql .="(7, 'Daikin Vietnam', 'Daikin Vietnam'),";
        $sql .="(8, 'Toshiba', 'Toshiba là một trong những thương hiệu hàng đầu thế giới '),";
        $sql .="(10, 'Panasonic', 'Nhật bản'),";
        $sql .="(9, 'Electrolux', 'Những sản phẩm của Electrolux được thiết kế để phù hợp');";
        $conn->exec($sql); 

        $sql="
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
            (222, 1, 'Cá kiển đẹp', 'hinh1.jpg', 'Cá kiển hiếm có trên VN', 5000000);";
        $conn-> exec($sql);
        
        // Nếu mọi thứ thành công thì commit
       // $conn->commit();       
    }
    catch(PDOException $e){
        // Nếu xuất hiện lỗi thì rollback lại các thao tác
       // $conn->rollback();
        echo "<br>" . $e->getMessage();
    }
    $conn = null;
?>