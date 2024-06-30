<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT * FROM User WHERE (username=? OR email=?) AND role='alumni'");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../pages/beranda_alumni.php");
    } else {
        $_SESSION['warning_message'] = "Username atau password salah.";
        header("Location: ../pages/login_alumni.php");
        exit();
    }
    $stmt->close();
}
$conn->close();
