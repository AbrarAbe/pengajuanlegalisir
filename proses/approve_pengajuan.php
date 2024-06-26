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
    echo "Pengajuan berhasil disahkan.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
header("Location: ../pages/list_pengajuan_dekan.php");
exit;