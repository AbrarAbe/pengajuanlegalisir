<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_pengajuan = filter_var($_POST['id_pengajuan'], FILTER_SANITIZE_NUMBER_INT);
    $ekspedisi = filter_var($_POST['ekspedisi'], FILTER_SANITIZE_STRING);
    $ekspedisi_harga = filter_var($_POST['ekspedisi_harga'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Validasi input
    if (empty($id_pengajuan) || empty($ekspedisi) || empty($ekspedisi_harga)) {
        $_SESSION['error_message'] = "Semua field harus diisi.";
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        exit;
    }

    // Update data di database
    $query = "UPDATE pengajuan SET ekspedisi = '$ekspedisi', ekspedisi_harga = '$ekspedisi_harga', total_harga = total_harga + '$ekspedisi_harga', id_status = 7 WHERE id_pengajuan = '$id_pengajuan'";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success_message'] = "Ekspedisi berhasil diperbarui.";
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
    } else {
        $_SESSION['error_message'] = "Ekspedisi gagal diperbarui.";
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
    }

    mysqli_close($conn);
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>