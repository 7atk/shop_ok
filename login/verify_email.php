<?php
// Include database connection
include('../configg.php');
$email = $_SESSION['email'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate input
    if ( empty($newPassword) || empty($confirmPassword)) {
        die('All fields are required.');
    }

    if ($newPassword !== $confirmPassword) {
        die('Passwords do not match.');
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update the password in the database
    $stmt = $connect->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param('ss', $hashedPassword, $email);

    if ($stmt->execute()) {
        // echo 'Password updated successfully.';
        // Optionally, redirect to login page or another page
        // header('Location: login.php');
        echo '<script>alert("Password updated successfully.");</script>';
        echo '<script>window.location.href=("http://localhost/shop_ok/index.php");</script>';
    } else {
        echo 'Error updating password: ' . $stmt->error;
    }
}
?>

<!-- HTML Form -->
<form method="POST" action="">
    <!-- <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br> -->
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required>
    <br>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br>
    <button type="submit" name="submit">Update Password</button>
</form>