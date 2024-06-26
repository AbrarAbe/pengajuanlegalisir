<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'dekan') {
    header("Location: ../pages/login_admin.php");
    exit;
}

$id_pengajuan = $_GET['id'];

$query = "UPDATE Pengajuan SET id_status = 3 WHERE id_pengajuan = '$id_pengajuan'"; // Status 3 = "Disahkan"

if (mysqli_query($conn, $query)) {
    $_SESSION['alert_message'] = "Pengajuan berhasil disahkan.";
    header("Location: ../pages/detail_pengajuan.php");
} else {
    $_SESSION['warning_message'] = "Pengajuan gagal disahkan.";
    header("Location: ../pages/detail_pengajuan.php");
}