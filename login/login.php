<?php
if (!isset($_SESSION))
  session_start();
  // $connect = mysqli_connect('localhost','root','','game_store') or die("Không thể kết nối đến database");
	// mysqli_set_charset($connect,"utf8");
//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
  //Lấy dữ liệu nhập vào
  $username = addslashes($_POST['txtuser']);
  $password = addslashes($_POST['txtpwd']);

  //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
  if (!$username || !$password) {
    $msg = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
  } else {
    // mã hóa pasword
    //$password = md5($password);
    $sql = "SELECT USERNAME,PWD,roles FROM users WHERE USERNAME='$username'";
    $lists = SelectAll($sql);

    if (count($lists) == 0) {
      $msg = "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại.";
    } else {
      foreach ($lists as $item)
        $mk = $item["PWD"];
        $role = $item["roles"];
      //So sánh 2 mật khẩu có trùng khớp hay không
      if (!password_verify($password, $mk)) {
        $msg = " Mật khẩu không đúng. Vui lòng nhập lại.";
      } else {
        //Lưu tên đăng nhập
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
      
        // echo "<script>window.alert('Login thành công');</script>";    
        // echo "Bạn vừa thêm: " .$id;           
         echo "<script>location.href='index.php';</script>";
        
      }
    }
  }
}
disconnect_db();
?>
<div class="container  bg_img rounded-3" style="max-width:98.5%; height: 48vh;">
  <div class="row justify-content-md-center" style="padding: 50px;">
    <div class="col-4" style="padding: 20px;">
      <div class="bg-wrap">
        <form method="post" action="#!">
          <div class="container text-danger text-center fst-italic"><?php echo !empty($msg) ? $msg : '';  ?></div>
          <div class="row gy-3 gy-md-4 overflow-hidden">
            <div class="col-12">
              <!-- <label for="txtuser" class="form-label">Username <span class="text-danger">*</span></label> -->
               <h6 class="text-left text-dark">Username:</h6>
              <div class="input-group">
                <!-- <span class="input-group-text">
                  <span class="input-group-text">@</span>
                </span> -->
                <input type="text" class="form-control" name="txtuser" id="txtuser" value=""  required>
              </div>
            </div>
            <div class="col-12">
            <h6 class="text-left text-dark">Password:</h6>
              <!-- <label for="password" class="form-label">Password <span class="text-danger">*</span></label> -->
              <div class="input-group">
                <!-- <span class="input-group-text">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                  </svg> -->
                </span>
                
                <input type="password" class="form-control" name="txtpwd" id="password" value="" required>
              </div>
            </div>
            <div class="col-12">
              <div class="d-grid">
                <button class="btn btn-primary btn-lg" type="submit" name="dangnhap">Log In</button>
              </div>
            </div>
          </div>
        </form>
        <div class="row" >
          <div class="col-12 " >
            <hr class="mt-2 mb-2 border-secondary-subtle">
            <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center ">
              <a href="index.php?page=register" class="link-warning text-decoration-none">Create new account</a>
              <a href="index.php?page=resetPassword" class="link-warning text-decoration-none">Forgot password</a>
            </div>
            
          </div>
          <div class="row">
            <!-- //kiểm tra nếu tồn tại biến $_GET["page"] = "register" thì gọi register.php vào -->
			<?php
			if(isset($_GET["page"]) && $_GET["page"] == "register")
				include "register.php";
			?>
		</div>
        </div>
      </div>
    </div>
  </div>
</div>


<style>
.bg-wrap {
  background: rgba(255, 255, 255, 0.4); /* nền trắng mờ */
  padding: 20px;
  border-radius: 10px;
  backdrop-filter: blur(5px); /* làm mờ background phía sau */
  -webkit-backdrop-filter: blur(5px); /* hỗ trợ Safari */

}
.bg_img {
  background: url('https://wallpapercave.com/wp/wp8137708.png') no-repeat center center fixed;

}
</style>

