<?php
    include('libs/config.php');  
    try
    {
        global $conn;
        $table="<b> Thành công! <b></br>";
        $i=1;
        
         $sql="CREATE TABLE IF NOT EXISTS NHANVIEN(
            MANV INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            TENNV varchar(200) NOT NULL, 
            USERNAME TEXT NOT NULL,  
            PWD VARCHAR(100)
        )"; 
        $conn->exec($sql);
        if(isset($conn))
            $table .= $i++ ." - Nhân viên";
        
        $sql="CREATE TABLE IF NOT EXISTS LOAI_SP(
            IDLSP INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            TENLOAI varchar(200),                 
            GHICHU TEXT
        )";
        $conn->exec($sql);
        if(isset($conn))
            $table .="</br>" .$i++ ." - Loại sản phẩm";

        $sql="CREATE TABLE IF NOT EXISTS SAN_PHAM(
                IDSP INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                IDLSP INT(11) UNSIGNED NOT NULL,
                TENSP varchar(200),                 
                THONGTINSP TEXT,
                HINHSP VARCHAR(100), 
                GIANHAP double,
                CONSTRAINT pk_loai_sp FOREIGN KEY (IDLSP) REFERENCES LOAI_SP(IDLSP)
        )";
        $conn->exec($sql);
        if(isset($conn))
            $table .="</br>" .$i++ ." - Sản phẩm";
      
        $sql="CREATE TABLE IF NOT EXISTS CT_SANPHAM(
            ID INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            IDSP int(11) UNSIGNED  NOT NULL,  
            TOMTAT TEXT NOT NULL, 
            THONGTIN TEXT NULL, 
            HINHANH VARCHAR(100), 
            CONSTRAINT pk_sp_ctsp FOREIGN KEY (IDSP) REFERENCES SAN_PHAM(IDSP)
        )";
        $conn->exec($sql);
        if(isset($conn))
            $table .="</br>" .$i++ ." - Chi tiết sản phẩm";
              
        $sql="CREATE TABLE IF NOT EXISTS KHACH_HANG(
            IDKH INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,            
            TENKH varchar(200), 
            DCGIAOHANG varchar(200), 
            DIACHI varchar(200),            
            EMAIL varchar(200)
        )";
        $conn->exec($sql); 
        if(isset($conn))
            $table .="</br>" .$i++ ." - Khách hàng";
        //Ngaydh = .date('d/m/Y - H:i:s').
        $sql="CREATE TABLE IF NOT EXISTS DON_HANG(
            IDDH INt(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
            IDKH INT UNSIGNED NOT NULL,
            IDSP INT UNSIGNED NOT NULL,  
            NGAYDH TEXT,  
            SL INT(11),
            CONSTRAINT pk_KH_DH FOREIGN KEY (IDKH) REFERENCES KHACH_HANG(IDKH),
            CONSTRAINT pk_SP_DH FOREIGN KEY (IDSP) REFERENCES SAN_PHAM(IDSP)
        )";
        $conn->exec($sql);  
        if(isset($conn))
            $table .="</br>" .$i++ ." - Đơn hàng";
            
         // Nếu mọi thứ thành công thì commit    
        echo "<br><b>Có tất cả $i bảng thêm vào $table</b>";
    }
    catch(PDOException $e){
        // Nếu xuất hiện lỗi thì rollback lại các thao tác
        echo "<br>" . $e->getMessage();
    }
    $conn = null;
?>