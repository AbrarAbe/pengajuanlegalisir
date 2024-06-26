<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user'])) {
    header("Location: ../pages/login_admin.php");
    exit;
}

$id_pengajuan = $_GET['id'];
$type = $_GET['type'];

$query = "SELECT $type FROM Pengajuan WHERE id_pengajuan = '$id_pengajuan'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    header('Content-Type: ' . $type);
    header('Content-Disposition: inline; filename="' . $type . '"');
    echo $row[$type];
} else {
    $_SESSION['alert_message'] = "Dokumen tidak ditemukan";
    header("Location: ../pages/detail_pengajuan.php");
}

mysqli_close($conn);
?>