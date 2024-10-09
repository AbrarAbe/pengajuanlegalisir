<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $npm = filter_var($_POST['npm'], FILTER_SANITIZE_NUMBER_INT);
    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $prodi = filter_var($_POST['prodi'], FILTER_SANITIZE_STRING);
    $tahun_lulus = filter_var($_POST['tahun_lulus'], FILTER_SANITIZE_NUMBER_INT);
    $nomor_telepon = filter_var($_POST['nomor_telepon'], FILTER_SANITIZE_STRING);
    $alamat_pengiriman = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);
    $metode_pengambilan = filter_var($_POST['metode_pengambilan'], FILTER_SANITIZE_STRING);
    $jumlah_legalisir_ijazah = filter_var($_POST['jumlah_legalisir_ijazah'], FILTER_SANITIZE_NUMBER_INT);
    $jumlah_legalisir_transkrip = filter_var($_POST['jumlah_legalisir_transkrip'], FILTER_SANITIZE_NUMBER_INT);
    $total_harga = filter_var($_POST['total_harga'], FILTER_SANITIZE_STRING);
    $bukti_pembayaran = null;

    // Ukuran maksimum 4MB dalam byte (4MB = 4 * 1024 * 1024)
    $max_size = 4 * 1024 * 1024;

    // Validasi ukuran file ijazah
    if ($_FILES['ijazah']['size'] > $max_size) {
        $_SESSION['error_message'] = "Ukuran file ijazah melebihi 4MB.";
        header("Location: ../pages/form_pengajuan.php");
        exit;
    }

    // Validasi ukuran file transkrip
    if ($_FILES['transkrip']['size'] > $max_size) {
        $_SESSION['error_message'] = "Ukuran file transkrip melebihi 4MB.";
        header("Location: ../pages/form_pengajuan.php");
        exit;
    }

    // Proses file ijazah dan transkrip jika ukuran valid
    $scan_ijazah = addslashes(file_get_contents($_FILES['ijazah']['tmp_name']));
    $scan_transkrip = addslashes(file_get_contents($_FILES['transkrip']['tmp_name']));

    // Tetapkan id_status berdasarkan metode pengambilan
    if ($metode_pengambilan === 'Ambil di Fakultas') {
        $id_status = 1; // Menunggu Validasi
    } else if ($metode_pengambilan === 'COD/Bayar di Tempat') {
        $id_status = 6; // Penentuan Ekspedisi
    }

    // Hanya handle file upload jika file diupload
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == UPLOAD_ERR_OK) {
        // Validasi ukuran file bukti pembayaran jika diperlukan
        $bukti_pembayaran = addslashes(file_get_contents($_FILES['bukti_pembayaran']['tmp_name']));
    }

    $query = "INSERT INTO pengajuan (id_user, npm, nama, prodi, tahun_lulus, nomor_telepon, scan_ijazah, scan_transkrip, metode_pengambilan, alamat_pengiriman, jumlah_legalisir_ijazah, jumlah_legalisir_transkrip, total_harga, bukti_pembayaran, id_status) 
              VALUES ('$id_user', '$npm', '$nama', '$prodi', '$tahun_lulus', '$nomor_telepon', '$scan_ijazah', '$scan_transkrip', '$metode_pengambilan', '$alamat_pengiriman', '$jumlah_legalisir_ijazah', '$jumlah_legalisir_transkrip', '$total_harga', '$bukti_pembayaran', '$id_status')";

    if (mysqli_query($conn, $query)) {

        // Mendapatkan id_pengajuan terakhir
        $id_pengajuan = mysqli_insert_id($conn);

        // Menambahkan notifikasi
        $pesan = "Pengajuan masuk atas nama <span class='text-primary'>$nama</span> ";
        tambahNotifikasi($pesan, $id_pengajuan);

        $_SESSION['alert_message'] = "Pengajuan berhasil dikirim.";
        header("Location: ../pages/status_pengajuan.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Pengajuan gagal dikirim: " . mysqli_error($conn);
        header("Location: ../pages/form_pengajuan.php");
        exit;
    }

    mysqli_close($conn);
}

// Fungsi untuk menambah notifikasi
function tambahNotifikasi($pesan, $id_pengajuan) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (pesan, id_pengajuan) VALUES (?, ?)");
    $stmt->bind_param("si", $pesan, $id_pengajuan);
    $stmt->execute();
    $stmt->close();
}