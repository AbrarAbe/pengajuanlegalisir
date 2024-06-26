<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user']; // Ambil ID pengguna dari sesi
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $tahun_lulus = $_POST['tahun_lulus'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $scan_ijazah = addslashes(file_get_contents($_FILES['ijazah']['tmp_name']));
    $scan_transkrip = addslashes(file_get_contents($_FILES['transkrip']['tmp_name']));
    $metode_pengambilan = $_POST['metode_pengambilan'];
    $jumlah_legalisir_ijazah = $_POST['jumlah_legalisir_ijazah'];
    $jumlah_legalisir_transkrip = $_POST['jumlah_legalisir_transkrip'];
    $ekspedisi = isset($_POST['ekspedisi']) ? $_POST['ekspedisi'] : null;
    $ekspedisi_harga = isset($_POST['ekspedisi_harga']) ? $_POST['ekspedisi_harga'] : 0;
    $total_harga = $_POST['total_harga'];
    $bukti_pembayaran = addslashes(file_get_contents($_FILES['bukti_pembayaran']['tmp_name']));
    $id_status = 1; // Status awal adalah "Menunggu Validasi"

    $query = "INSERT INTO Pengajuan (id_user, npm, nama, tahun_lulus, email, scan_ijazah, scan_transkrip, metode_pengambilan, alamat_pengiriman, jumlah_legalisir_ijazah, jumlah_legalisir_transkrip, ekspedisi, ekspedisi_harga, total_harga, bukti_pembayaran, id_status) 
              VALUES ('$id_user', '$npm', '$nama', '$tahun_lulus', '$email', '$scan_ijazah', '$scan_transkrip', '$metode_pengambilan', '$alamat', '$jumlah_legalisir_ijazah', '$jumlah_legalisir_transkrip', '$ekspedisi', '$ekspedisi_harga', '$total_harga', '$bukti_pembayaran', '$id_status')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['alert_message'] = "Pengajuan berhasil dikirim.";
        header("Location: ../pages/form_pengajuan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
        header("Location: ../pages/form_pengajuan.php");
    }

    mysqli_close($conn);
}