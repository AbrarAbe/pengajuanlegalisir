<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_pengajuan = filter_var($_POST['id_pengajuan'], FILTER_SANITIZE_NUMBER_INT);

    // Validasi input
    if (empty($id_pengajuan)) {
        $_SESSION['error_message'] = "Pengajuan tidak valid.";
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        exit;
    }

    // Pastikan file bukti pembayaran diunggah
    if (isset($_FILES['bukti_pembayaran']) && !empty($_FILES['bukti_pembayaran']['tmp_name'])) {
        $bukti_pembayaran = addslashes(file_get_contents($_FILES['bukti_pembayaran']['tmp_name']));

        // Update data di database
        $query = "UPDATE pengajuan SET bukti_pembayaran = '$bukti_pembayaran', id_status = 1 WHERE id_pengajuan = '$id_pengajuan'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['success_message'] = "Bukti pembayaran berhasil diunggah.";
            header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        } else {
            $_SESSION['error_message'] = "Bukti pembayaran gagal diunggah.";
            header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        }
    } else {
        $_SESSION['error_message'] = "File bukti pembayaran harus diunggah.";
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
    }

    mysqli_close($conn);
} else {
    header("Location: ../pages/login.php");
    exit;
}
