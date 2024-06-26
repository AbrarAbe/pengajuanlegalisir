<?php
session_start();
include '../config.php'; // Koneksi ke database

if (isset($_GET['id_pengajuan'])) {
    $id_pengajuan = $_GET['id_pengajuan'];

    // Hapus pengajuan dari database
    $query = "DELETE FROM Pengajuan WHERE id_pengajuan = '$id_pengajuan'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['error_message'] = "Pengajuan berhasil dihapus.";
        header("Location: ../pages/list_pengajuan_staf.php");
    } else {
        $_SESSION['warning_message'] = "Terjadi kesalahan saat menghapus pengajuan.";
        header("Location: ../pages/list_pengajuan_staf.php");
    }

    mysqli_close($conn);
} else {
    $_SESSION['error_message'] = "ID Pengajuan tidak ditemukan.";
}

header("Location: ../pages/list_pengajuan_staf.php");
exit();