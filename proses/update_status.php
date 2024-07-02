<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: ../pages/login_admin.php");
    exit;
}

$id_pengajuan = $_GET['id'];

$query = "UPDATE pengajuan SET id_status = 5 WHERE id_pengajuan = '$id_pengajuan'"; // Status 5 = "Selesai"

if (mysqli_query($conn, $query)) {
        $_SESSION['alert_message'] = "Berhasil memperbarui status";
        header("Location: ../pages/list_pengajuan_disahkan.php");
} else {
        $_SESSION['warning_message'] = "Gagal memperbarui status";
        header("Location: ../pages/list_pengajuan_disahkan.php");
}
