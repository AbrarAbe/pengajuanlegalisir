<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan')) {
    header("Location: ../pageslogin_admin.php");
    exit;
}

$id_pengajuan = $_GET['id'];

$query = "UPDATE Pengajuan SET id_status = 4 WHERE id_pengajuan = '$id_pengajuan'"; // Status 4 = "Ditolak"

if (mysqli_query($conn, $query)) {
    echo "Pengajuan berhasil ditolak.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
if ($_SESSION['role'] == 'staf') {
    header("Location: ../pages/list_pengajuan_staf.php");
} else {
    header("Location: ../pages/list_pengajuan_dekan.php");
}
exit;
