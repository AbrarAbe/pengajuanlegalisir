<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $email = $_POST['email'];
    $metode_pengambilan = $_POST['metode_pengambilan'];
    $jumlah_legalisir_ijazah = $_POST['jumlah_legalisir_ijazah'];
    $jumlah_legalisir_transkrip = $_POST['jumlah_legalisir_transkrip'];
    $ekspedisi = $_POST['ekspedisi'];
    $total_harga = 3000 * $jumlah_legalisir_ijazah + 3000 * $jumlah_legalisir_transkrip; // Contoh perhitungan harga

    $scan_ijazah = file_get_contents($_FILES['scan_ijazah']['tmp_name']);
    $scan_transkrip = isset($_FILES['scan_transkrip']['tmp_name']) ? file_get_contents($_FILES['scan_transkrip']['tmp_name']) : null;
    $bukti_pembayaran = file_get_contents($_FILES['bukti_pembayaran']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO Pengajuan (id_user, npm, nama, tahun_lulus, email, scan_ijazah, scan_transkrip, metode_pengambilan, jumlah_legalisir_ijazah, jumlah_legalisir_transkrip, ekspedisi, total_harga, bukti_pembayaran, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("issssssssisss", $_SESSION['id_user'], $npm, $nama, $tahun_lulus, $email, $scan_ijazah, $scan_transkrip, $metode_pengambilan, $jumlah_legalisir_ijazah, $jumlah_legalisir_transkrip, $ekspedisi, $total_harga, $bukti_pembayaran);

    if ($stmt->execute()) {
        header("Location: ../pages/status_pengajuan.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

