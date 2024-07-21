<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT * FROM user WHERE (username=? OR email=?) AND (role='alumni' OR role='staf' OR role='dekan')");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'alumni') {
            // Update status to 'aktif'
            $stmt = $conn->prepare("UPDATE user SET status = 'aktif' WHERE id_user = ?");
            $stmt->bind_param("i", $user['id_user']);
            $stmt->execute();
            header("Location: ../pages/beranda_alumni.php");
        } else if ($user['role'] == 'staf') {
            header("Location: ../pages/beranda_staf.php");
        } else {
            header("Location: ../pages/beranda_dekan.php");
        }
    } else {
        $_SESSION['warning_message'] = "Username atau password salah.";
        header("Location: ../pages/login.php");
    }
    $stmt->close();
}
$conn->close();
