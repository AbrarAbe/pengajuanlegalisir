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

    // Fungsi untuk menangani upload file dan memeriksa ukurannya
    function handleFileUpload($file, $max_file_size) {
        if ($file['size'] > $max_file_size) {
            $_SESSION['error_message'] = "File terlalu besar. Maksimal ukuran file adalah 2MB.";
            header("Location: ../pages/detail_pengajuan.php?id=" . $_POST['id_pengajuan']);
            exit();
        }
        return addslashes(file_get_contents($file['tmp_name']));
    }

    $max_file_size = 2 * 1024 * 1024; // 2MB

    // Pastikan file bukti pembayaran diunggah
    if (isset($_FILES['bukti_pembayaran']) && !empty($_FILES['bukti_pembayaran']['tmp_name'])) {
        $bukti_pembayaran = handleFileUpload($_FILES['bukti_pembayaran'], $max_file_size);

        // Update data di database
        $query = "UPDATE pengajuan SET bukti_pembayaran = ?, id_status = 1 WHERE id_pengajuan = ?";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("si", $bukti_pembayaran, $id_pengajuan);
            if ($stmt->execute()) {
                $_SESSION['alert_message'] = "Bukti pembayaran berhasil diunggah.";
                header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
            } else {
                $_SESSION['error_message'] = "Bukti pembayaran gagal diunggah.";
                header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
            }
            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Kesalahan dalam mempersiapkan query.";
            header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        }
    } else {
        $_SESSION['error_message'] = "File bukti pembayaran harus diunggah.";
        header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
    }

    $conn->close();
} else {
    header("Location: ../pages/login.php");
    exit;
}
?>
