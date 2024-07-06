<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: ../pages/login.php");
    exit;
}

$id_pengajuan = $_GET['id'];

$query = "UPDATE pengajuan SET id_status = 2 WHERE id_pengajuan = '$id_pengajuan'"; // Status 2 = "Divalidasi"

if (mysqli_query($conn, $query)) {
    $_SESSION['alert_message'] = "Pengajuan berhasil divalidasi.";
    header("Location: ../pages/list_pengajuan_staf.php");
} else {
    $_SESSION['warning_message'] = "Pengajuan gagal divalidasi.";
    header("Location: ../pages/list_pengajuan_staf.php");
}