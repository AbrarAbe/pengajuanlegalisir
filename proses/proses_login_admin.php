<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT * FROM user WHERE (username=? OR email=?) AND (role='staf' OR role='dekan')");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'staf') {
            header("Location: ../pages/beranda_staf.php");
        } else {
            header("Location: ../pages/beranda_dekan.php");
        }
    } else {
        $_SESSION['warning_message'] = "username atau password salah.";
        header("Location: ../pages/login_admin.php");
    }
    $stmt->close();
}
$conn->close();
