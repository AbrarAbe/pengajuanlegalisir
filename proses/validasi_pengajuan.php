<?php
session_start();
include 'config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: ../pages/login_staf_dekan.php");
    exit;
}

$id_pengajuan = $_GET['id'];
$stmt = $conn->prepare("UPDATE Pengajuan SET status = 'divalidasi' WHERE id_pengajuan = ?");
$stmt->bind_param("i", $id_pengajuan);

if ($stmt->execute()) {
    header("Location: ../pages/daftar_pengajuan.php");
} else {
    echo "Error: " . $stmt->error;
}
?>
