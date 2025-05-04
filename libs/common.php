<?php
include('config.php');
// Hàm lấy tất cả sinh viên
function SelectAll($select)
{    
    global $conn;      
    try {        
        $stmt = $conn->prepare($select);
        $stmt->execute();    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);// Khai báo fetch kiểu mảng kết hợp
        $arr = $stmt->fetchAll(); //Lấy tất cả đưa vào mảng      
        $stmt->closeCursor(); //Close kết nối

    } catch (PDOException $e) {
        echo "</br>Error: " . $e->getMessage();
    }    
    return $arr;
}
function Execute($sql)
{
    global $conn;
    $row = 0;
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->rowCount();
    } catch(PDOException $e){
        error_log("Database Error: " . $e->getMessage());
        // echo "<div class='text-danger'>Lỗi cơ sở dữ liệu</div>"; // nếu muốn hiển thị
    }
    return $row;
}

function Execute_GetID_Insert($sql)
{    
    global $conn;     // Gọi tới biến toàn cục $conn      
    try {   // Thực hiện thêm record
        $conn->exec($sql);     
        $last_id = $conn->lastInsertId();      
        //$stmt = $conn->prepare($sql);       
       // $stmt->execute();        
      //  echo $last_id. " records INSERT successfully";   
    }
    catch(PDOException $e){
        echo "</br>Error: " . $e->getMessage();
    }   
    return $last_id;//Trả về id vừa thêm
}
function save($sql, $para=[]){
	global $conn;
	try{
		$st=$conn->prepare($sql);
		$st->execute($para);
	}catch(PDOException $e){
        echo "</br>Error: " . $e->getMessage();
    }   
}
//Xử lý thêm
//$sql="INSERT INTO THANHVIEN('MA','TEN') VALUES (?,?)";
//$kq=save($sql,[$ma, $ten]);
?>