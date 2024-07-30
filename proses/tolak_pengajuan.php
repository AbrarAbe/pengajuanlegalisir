<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan')) {
    header("Location: ../pages/login.php");
    exit;
}

$id_pengajuan = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// Ambil nama pengguna berdasarkan id_pengajuan
$query_nama = "SELECT p.nama FROM pengajuan p JOIN user u ON p.id_user = u.id_user WHERE p.id_pengajuan = ?";
if ($stmt_nama = $conn->prepare($query_nama)) {
    $stmt_nama->bind_param("i", $id_pengajuan);
    $stmt_nama->execute();
    $result_nama = $stmt_nama->get_result();
    if ($row = $result_nama->fetch_assoc()) {
        $nama_pengguna = $row['nama'];
    } else {
        $_SESSION['danger_message'] = "Pengajuan tidak ditemukan.";
        header("Location: ../pages/list_pengajuan_staf.php");
        exit;
    }
    $stmt_nama->close();
} else {
    $_SESSION['danger_message'] = "Terjadi kesalahan pada query.";
    header("Location: ../pages/list_pengajuan_staf.php");
    exit;
}

// Update status pengajuan
$query = "UPDATE pengajuan SET id_status = 4 WHERE id_pengajuan = ?";
if ($stmt_update = $conn->prepare($query)) {
    $stmt_update->bind_param("i", $id_pengajuan);
    if ($stmt_update->execute()) {
        $_SESSION['error_message'] = "Pengajuan berhasil ditolak.";
        if ($_SESSION['role'] == 'staf') {
            // Menambahkan notifikasi
            $pesan = "Pengajuan atas nama <span class='text-primary'>$nama_pengguna</span> ditolak oleh Admin";
            tambahNotifikasi($pesan, $id_pengajuan);
            header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        } elseif ($_SESSION['role'] == 'dekan') {
            // Menambahkan notifikasi
            $pesan = "Pengajuan atas nama <span class='text-primary'>$nama_pengguna</span> ditolak oleh Dekan";
            tambahNotifikasi($pesan, $id_pengajuan);
            header("Location: ../pages/detail_pengajuan.php?id=$id_pengajuan");
        }
    } else {
        $_SESSION['warning_message'] = "Pengajuan gagal ditolak.";
        if ($_SESSION['role'] == 'staf') {
            header("Location: ../pages/list_pengajuan_staf.php");
        } elseif ($_SESSION['role'] == 'dekan') {
            header("Location: ../pages/list_pengajuan_dekan.php");
        }
    }
    $stmt_update->close();
} else {
    $_SESSION['danger_message'] = "Terjadi kesalahan pada query.";
    if ($_SESSION['role'] == 'staf') {
        header("Location: ../pages/list_pengajuan_staf.php");
    } elseif ($_SESSION['role'] == 'dekan') {
        header("Location: ../pages/list_pengajuan_dekan.php");
    }
}

mysqli_close($conn);

function tambahNotifikasi($pesan, $id_pengajuan) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (pesan, id_pengajuan) VALUES (?, ?)");
    $stmt->bind_param("si", $pesan, $id_pengajuan);
    $stmt->execute();
    $stmt->close();
}
?>
