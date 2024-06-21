<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $email = $_POST['email'];
    $alamat_pengiriman = isset($_POST['alamat_pengiriman']) ? $_POST['alamat_pengiriman'] : null; // Handle null value
    $metode_pengambilan = $_POST['metode_pengambilan'];
    $jumlah_legalisir_ijazah = $_POST['jumlah_legalisir_ijazah'];
    $jumlah_legalisir_transkrip = $_POST['jumlah_legalisir_transkrip'];
    $ekspedisi_pengiriman = isset($_POST['ekspedisi_pengiriman']) ? $_POST['ekspedisi_pengiriman'] : null; // Handle null value
    $total_harga = $_POST['total_harga'];
    $id_status = 1; // Default status, misalnya "Menunggu Validasi"

    // Upload Scan Ijazah
    $ijazah = file_get_contents($_FILES['ijazah']['tmp_name']);
    // Upload Scan Transkrip
    $transkrip = file_get_contents($_FILES['transkrip']['tmp_name']);
    // Upload Bukti Pembayaran
    $bukti_pembayaran = file_get_contents($_FILES['bukti_pembayaran']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO Pengajuan (id_user, npm, nama, tahun_lulus, email, alamat_pengiriman, scan_ijazah, scan_transkrip, metode_pengambilan, jumlah_legalisir_ijazah, jumlah_legalisir_transkrip, ekspedisi_pengiriman, total_harga, bukti_pembayaran, id_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssbbsiisibi", $_SESSION['id_user'], $npm, $nama, $tahun_lulus, $email, $alamat_pengiriman, $ijazah, $transkrip, $metode_pengambilan, $jumlah_legalisir_ijazah, $jumlah_legalisir_transkrip, $ekspedisi_pengiriman, $total_harga, $bukti_pembayaran, $id_status);

    if ($stmt->execute()) {
        echo "Pengajuan berhasil diajukan.";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();

}

