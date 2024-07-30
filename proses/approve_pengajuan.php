<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'dekan') {
    header("Location: ../pages/login.php");
    exit;
}

$id_pengajuan = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
// Ambil nama pengguna berdasarkan id_pengajuan
$query_nama = "SELECT p.nama FROM pengajuan p JOIN user u ON p.id_user = u.id_user WHERE p.id_pengajuan = ?";
$stmt_nama = $conn->prepare($query_nama);
$stmt_nama->bind_param("i", $id_pengajuan);
$stmt_nama->execute();
$result_nama = $stmt_nama->get_result();
$nama_pengguna = $result_nama->fetch_assoc()['nama'];
$stmt_nama->close();

$query = "UPDATE pengajuan SET id_status = 3 WHERE id_pengajuan = ?"; // Status 3 = "Disahkan"

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $id_pengajuan);
    if ($stmt->execute()) {
        // Menambahkan notifikasi
        $pesan = "Pengajuan atas nama <span class=text-primary>$nama_pengguna</span> disahkan oleh Dekan";
        tambahNotifikasi($pesan, $id_pengajuan);

        $_SESSION['alert_message'] = "Pengajuan berhasil disahkan.";
        header("Location: ../pages/list_pengajuan_dekan.php");
    } else {
        $_SESSION['warning_message'] = "Pengajuan gagal disahkan.";
        header("Location: ../pages/list_pengajuan_dekan.php");
    }
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}
function tambahNotifikasi($pesan, $id_pengajuan) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (pesan, id_pengajuan) VALUES (?, ?)");
    $stmt->bind_param("si", $pesan, $id_pengajuan);
    $stmt->execute();
    $stmt->close();
}
