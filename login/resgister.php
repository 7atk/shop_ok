<?php


	$connect = mysqli_connect('localhost','admin123','admin123','admin123') or die("Không thể kết nối đến database");
	mysqli_set_charset($connect,"utf8");

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
      $result = mysqli_query($connect, $sql);
      if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.');</script>";
      } else {
        // Kiểm tra xem email đã tồn tại chưa
        $sql = "SELECT * FROM users WHERE EMAIL='$email'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
          echo "<script>alert('Email đã tồn tại. Vui lòng chọn email khác.');</script>";
        }elseif
         ($pass1 != $pass2) {
             echo "<script>alert('Mật khẩu không khớp. Vui lòng nhập lại.');</script>";
        } else {
          // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
          $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);
          // Thực hiện thêm người dùng mới vào cơ sở dữ liệu
          $sql = "INSERT INTO users (USERNAME, PASSWORD, EMAIL) VALUES ('$user_name', '$hashed_password', '$email')";
          if (mysqli_query($connect, $sql)) {
            echo "<script>alert('Đăng ký thành công!');</script>";
            // Chuyển hướng đến trang đăng nhập hoặc trang khác
            echo "<script>location.href='index.php?page=login';</script>";
          } else {
            echo "<script>alert('Lỗi: " . mysqli_error($connect) . "');</script>";
          }
        } 
      }
    }

	?>

<div class="container mt-3">
  <h2>Stacked form</h2>
  <form action="" method="post">
    <div class="mb-3 mt-3">
      <label for="Username">Username:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter email" name="user_name" required>
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
    <button type="submit" class="btn btn-primary" name="dangky">Submit</button>
  </form>
</div>

</body>
</html>
