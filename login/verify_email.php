<?php
session_start();
$email=$_SESSION['email'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendVerificationEmail($userEmail, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com'; // Email gửi
        $mail->Password = 'your_app_password';    // Mật khẩu ứng dụng
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Cấu hình người gửi và người nhận
        $mail->setFrom('your_email@gmail.com', 'Your Website');
        $mail->addAddress($userEmail);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Mã xác thực của bạn';
        $mail->Body    = "Mã xác thực của bạn là: <b>$verificationCode</b>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email không gửi được: {$mail->ErrorInfo}");
        return false;
    }
}

// Ví dụ sử dụng
$code = rand(100000, 999999);  // Mã gồm 6 chữ số
sendVerificationEmail('example@email.com', $code);
