<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user']; // Ambil ID pengguna dari sesi
    $npm = filter_var($_POST['npm'], FILTER_SANITIZE_STRING);
    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $prodi = filter_var($_POST['prodi'], FILTER_SANITIZE_STRING);
    $tahun_lulus = filter_var($_POST['tahun_lulus'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $alamat = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);
    $scan_ijazah = addslashdes(file_get_contents($_FILES['ijazah']['tmp_name']));
    $scan_transkrip = addslashes(file_get_contents($_FILES['transkrip']['tmp_name']));
    $metode_pengambilan = filter_var($_POST['metode_pengambilan'], FILTER_SANITIZE_STRING);
    $jumlah_legalisir_ijazah = filter_var($_POST['jumlah_legalisir_ijazah'], FILTER_SANITIZE_STRING);
    $jumlah_legalisir_transkrip = filter_var($_POST['jumlah_legalisir_transkrip'], FILTER_SANITIZE_STRING);
    $ekspedisi = isset($_POST['ekspedisi']) ? $_POST['ekspedisi'] : null;
    $ekspedisi_harga = isset($_POST['ekspedisi_harga']) ? $_POST['ekspedisi_harga'] : 0;
    $total_harga = $_POST['total_harga'];
    $bukti_pembayaran = addslashes(file_get_contents($_FILES['bukti_pembayaran']['tmp_name']));
    $id_status = 1; // Status awal adalah "Menunggu Validasi"

    $query = "INSERT INTO pengajuan (id_user, npm, nama, prodi, tahun_lulus, email, scan_ijazah, scan_transkrip, metode_pengambilan, alamat_pengiriman, jumlah_legalisir_ijazah, jumlah_legalisir_transkrip, ekspedisi, ekspedisi_harga, total_harga, bukti_pembayaran, id_status) 
              VALUES ('$id_user', '$npm', '$nama', '$prodi' , '$tahun_lulus', '$email', '$scan_ijazah', '$scan_transkrip', '$metode_pengambilan', '$alamat', '$jumlah_legalisir_ijazah', '$jumlah_legalisir_transkrip', '$ekspedisi', '$ekspedisi_harga', '$total_harga', '$bukti_pembayaran', '$id_status')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['info_message'] = "Pengajuan berhasil dikirim.";
        header("Location: ../pages/status_pengajuan.php");
    } else {
        $_SESSION['error_message'] = "Pengajuan gagal dikirim.";
        header("Location: ../pages/form_pengajuan.php");
    }

    mysqli_close($conn);
}