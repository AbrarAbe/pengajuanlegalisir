<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: login_admin.php");
    exit;
}

$id_pengajuan = $_GET['id'];
$action = $_GET['action'];

$status = '';
if ($action == 'Silahkan ambil di prodi') {
    $status = 'Silahkan ambil di prodi';
} elseif ($action == 'Sedang dikirim ke alamat anda') {
    $status = 'Sedang dikirim ke alamat anda';
}

if ($status) {
    $stmt = $conn->prepare("UPDATE Pengajuan SET status = ? WHERE id_pengajuan = ?");
    $stmt->bind_param("si", $status, $id_pengajuan);

    if ($stmt->execute()) {
        header("Location: daftar_pengajuan.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

