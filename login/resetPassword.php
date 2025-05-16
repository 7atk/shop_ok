<?php

include('../configg.php');
if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
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
<form action="index.php?page=resetPassword" method="post" >
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
  </div>
     <button type="submit" class="btn btn-primary">Submit</button>
</form>