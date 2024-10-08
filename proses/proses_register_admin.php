<?php
session_start();
include '../config.php';

if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $status = 'nonaktif'; // Set status to 'nonaktif'

    $sql = "SELECT * FROM user WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['warning_message'] = "<strong>Email sudah ada!</strong> <a href='register_admin.php'>Login</a> atau gunakan email lain.";
            header("Location: ../pages/register_admin.php");
        } else {
            $stmt = $conn->prepare("INSERT INTO user (username, email, password, role, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $email, $password, $role, $status);
            if ($stmt->execute()) {
                $_SESSION['info_message'] = "<strong>Berhasil!</strong> Akun Anda berhasil terdaftar! Anda dapat login sekarang.";
                header("Location: ../pages/login.php");
            } else {
                $_SESSION['error_message'] = "<strong>Gagal!</strong> Gagal daftar akun. Harap ulangi lagi.";
                header("Location: ../pages/register_admin.php");
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>
