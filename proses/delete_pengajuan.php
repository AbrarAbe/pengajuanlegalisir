<?php
session_start();
include '../config.php'; // Koneksi ke database

if (isset($_GET['id_pengajuan'])) {
    $id_pengajuan = $_GET['id_pengajuan'];

    // Hapus pengajuan dari database
    $query = "DELETE FROM Pengajuan WHERE id_pengajuan = '$id_pengajuan'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['alert_message'] = "Pengajuan berhasil dihapus.";
    } else {
        $_SESSION['alert_message'] = "Terjadi kesalahan saat menghapus pengajuan.";
    }

    mysqli_close($conn);
} else {
    $_SESSION['alert_message'] = "ID Pengajuan tidak ditemukan.";
}

header("Location: ../pages/list_pengajuan_staf.php");
exit();