<?php
session_start();
include 'db.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: login_admin.php");
    exit;
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id_pengajuan = $_GET['id'];
    $status = $_GET['status'];

    // Tentukan id_status berdasarkan status yang diterima
    $id_status = 0;
    if ($status == 'selesai') {
        $id_status = 5; // id_status untuk 'Selesai'
    }

    // Update status pengajuan
    $query = "UPDATE Pengajuan SET id_status = ? WHERE id_pengajuan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_status, $id_pengajuan);
    if ($stmt->execute()) {
        echo "Status pengajuan berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui status pengajuan.";
    }

    $stmt->close();
} else {
    echo "ID pengajuan atau status tidak valid.";
}

mysqli_close($conn);

// Redirect kembali ke halaman daftar pengajuan
header("Location: list_pengajuan_disahkan.php");
exit;
?>
