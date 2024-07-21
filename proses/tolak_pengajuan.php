<?php

include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan')) {
    header("Location: ../pages/login.php");
    exit;
}

$id_pengajuan = $_GET['id'];

$query = "UPDATE pengajuan SET id_status = 4 WHERE id_pengajuan = '$id_pengajuan'"; // Status 4 = "Ditolak"

if (mysqli_query($conn, $query)) {
    $_SESSION['alert_message'] = "Pengajuan berhasil ditolak.";
    if ($_SESSION['role'] == 'staf') {
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
    }
    if ($_SESSION['role'] == 'dekan') {
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
    }
} else {
    $_SESSION['danger_message'] = "Pengajuan gagal ditolak.";
    if ($_SESSION['role'] == 'staf') {
        header("Location: ../pages/list_pengajuan_staf.php");
    }
    if ($_SESSION['role'] == 'dekan') {
        header("Location: ../pages/list_pengajuan_dekan.php");
    }
}

mysqli_close($conn);
