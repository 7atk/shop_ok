<?php


	// $connect = mysqli_connect('localhost','root','','game_store') or die("Không thể kết nối đến database");
	// mysqli_set_charset($connect,"utf8");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
		if(isset($_POST["dangky"])){
			$email = $_POST["email"];
			$pass1 = $_POST["pswd"];
      $pass2 = $_POST["repswd"];
      $user_name = trim($_POST["user_name"]);
            
			
			
			// Kiểm tra xem tên đăng nhập đã tồn tại chưa   
      $sql = "SELECT * FROM users WHERE USERNAME='$user_name'";
      $result =SelectAll($sql);
      // if (mysqli_num_rows($result) > 0) {
      if (count($result) > 0) {
        echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.');</script>";
      } else {
        // Kiểm tra xem email đã tồn tại chưa
        $sql = "SELECT * FROM users WHERE EMAIL='$email'";
        $result = SelectAll($sql);
        // if (mysqli_num_rows($result) > 0) {
        if (count($result) > 0) {
          echo "<script>alert('Email đã tồn tại. Vui lòng chọn email khác.');</script>";
        }elseif
         ($pass1 != $pass2) {
             echo "<script>alert('Mật khẩu không khớp. Vui lòng nhập lại.');</script>";
        } else {
          // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
          $roles = 2; // Giá trị mặc định cho vai trò người dùng
          $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
          // Thực hiện thêm người dùng mới vào cơ sở dữ liệu
          $sql = "INSERT INTO users (USERNAME, PWD, EMAIL,roles) VALUES ('$user_name', '$hashed_password', '$email', '$roles')";
          $result=execute($sql);
          if (  $result) {
            echo "<script>alert('Đăng ký thành công!');</script>";
            // Chuyển hướng đến trang đăng nhập hoặc trang khác
            echo "<script>location.href='index.php?page=login';</script>";
          } else {
            echo "<script>alert('Lỗi: ');</script>";
          }
        } 
      }
    }

	?>


  <div class="container  bg_img rounded-3" style="max-width:98.5%; height: 48vh;">
  <div class="row justify-content-md-center" >
    <div class="col-4" >
      <div class="bg-wrap h">
  <h2>Stacked form</h2> 
  <form action="" method="post">
    <div class="mb-3 mt-3">
      <label for="Username">Username:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter Username" name="user_name" required>
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd"required>
    </div>
    <div class="mb-3">
      <label for="pwd">Password Again:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password Again" name="repswd"required>
    </div>
    <div class="mb-3">
      <label for="pwd">Email:</label>
      <input type="Email" class="form-control" id="email" placeholder="Email" name="email"required>
    </div>
    <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
    <button  type="submit" class="btn btn-primary " name="dangky">Submit</button>
  </form>
</div>
</div>
    </div>
  </div>
</div>
</body>
</html>
<style>
.bg-wrap {
  background: rgba(255, 255, 255, 0.4); /* nền trắng mờ */
  padding: 20px;
  border-radius: 10px;
  backdrop-filter: blur(5px); /* làm mờ background phía sau */
  -webkit-backdrop-filter: blur(5px); /* hỗ trợ Safari */
 height: 48vh;
  width: 100%;
  margin: auto;
}
.bg_img {
  background: url('https://wallpapercave.com/wp/wp8137708.png') no-repeat center center fixed;

}

</style>
