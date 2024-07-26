<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $npm = filter_var($_POST['npm'], FILTER_SANITIZE_NUMBER_INT);
    $nama = filter_var($_POST['nama'], FILTER_SANITIZE_STRING);
    $prodi = filter_var($_POST['prodi'], FILTER_SANITIZE_STRING);
    $tahun_lulus = filter_var($_POST['tahun_lulus'], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $alamat_pengiriman = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);
    $metode_pengambilan = filter_var($_POST['metode_pengambilan'], FILTER_SANITIZE_STRING);
    $jumlah_legalisir_ijazah = filter_var($_POST['jumlah_legalisir_ijazah'], FILTER_SANITIZE_NUMBER_INT);
    $jumlah_legalisir_transkrip = filter_var($_POST['jumlah_legalisir_transkrip'], FILTER_SANITIZE_NUMBER_INT);
    $total_harga = filter_var($_POST['total_harga'], FILTER_SANITIZE_STRING);
    $bukti_pembayaran = null;

    $max_file_size = 2 * 1024 * 1024; // 2MB

    // Function to handle file upload and return the file content
    function handleFileUpload($file, $max_file_size) {
        if ($file['size'] > $max_file_size) {
            $_SESSION['error_message'] = "File terlalu besar. Maksimal ukuran file adalah 2MB.";
            header("Location: ../pages/form_pengajuan.php");
            exit();
        }
        return addslashes(file_get_contents($file['tmp_name']));
    }

    // Handle file uploads
    $scan_ijazah = handleFileUpload($_FILES['ijazah'], $max_file_size);
    $scan_transkrip = handleFileUpload($_FILES['transkrip'], $max_file_size);
    if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == UPLOAD_ERR_OK) {
        $bukti_pembayaran = handleFileUpload($_FILES['bukti_pembayaran'], $max_file_size);
    }

    // Tetapkan id_status berdasarkan metode pengambilan
    if ($metode_pengambilan === 'ambil di prodi') {
        $id_status = 1; // Menunggu Validasi
    } else if ($metode_pengambilan === 'kirim ke alamat') {
        $id_status = 6; // Penentuan Ekspedisi
    }

    $query = "INSERT INTO pengajuan (id_user, npm, nama, prodi, tahun_lulus, email, scan_ijazah, scan_transkrip, metode_pengambilan, alamat_pengiriman, jumlah_legalisir_ijazah, jumlah_legalisir_transkrip, total_harga, bukti_pembayaran, id_status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssissssiiissi", $id_user, $npm, $nama, $prodi, $tahun_lulus, $email, $scan_ijazah, $scan_transkrip, $metode_pengambilan, $alamat_pengiriman, $jumlah_legalisir_ijazah, $jumlah_legalisir_transkrip, $total_harga, $bukti_pembayaran, $id_status);

    if ($stmt->execute()) {
        // Menambahkan notifikasi
        $pesan = "Pengajuan masuk atas nama <span class=text-primary>$nama</span> ";
        tambahNotifikasi($pesan);

        $_SESSION['info_message'] = "Pengajuan berhasil dikirim.";
        header("Location: ../pages/status_pengajuan.php");
    } else {
        $_SESSION['error_message'] = "Pengajuan gagal dikirim.";
        header("Location: ../pages/form_pengajuan.php");
    }

    $stmt->close();
    $conn->close();
}

function tambahNotifikasi($pesan)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (pesan) VALUES (?)");
    $stmt->bind_param("s", $pesan);
    $stmt->execute();
    $stmt->close();
}
?>
