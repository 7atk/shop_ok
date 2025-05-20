<?php

// include('../common.php');
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = selectAll($sql);
    if (count($result) > 0) {
        // // Generate a unique token for password reset
        // $token = bin2hex(random_bytes(50));
        // $sql = "UPDATE users SET token='$token' WHERE email='$email'";
        // mysqli_query($connect, $sql);
        
        // // Send the password reset link to the user's email
        // $resetLink = "http://yourwebsite.com/resetPassword.php?token=$token";
        // mail($email, "Password Reset", "Click here to reset your password: $resetLink");
        $_SESSION['email'] = $email;
       
        echo "<script>location.href='login/verify_email.php';</script>";
        // echo "<div class='alert alert-success'>A password reset link has been sent to your email.</div>";
    } else {
        echo "<div class='alert alert-danger'>Email not found.</div>";
    }
} 
?>
 <div class="container  bg_img rounded-3" style="max-width:98.5%; height: 48vh;">
  <div class="row justify-content-md-center" style="padding: 50px;">
    <div class="col-4" style="padding: 20px;">
      <div class="bg-wrap">
<form action="index.php?page=resetPassword" method="post" >
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
  </div>
     <button type="submit" class="btn btn-primary">Submit</button>
</form>
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

