<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

$id_pengajuan = $_GET['id'];
$query = "SELECT * FROM Pengajuan WHERE id_pengajuan = '$id_pengajuan'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>Cetak Dokumen Pengajuan</h2>";
    echo "<a href='print_document.php?type=ijazah&id=" . $row['id_pengajuan'] . "' target='_blank'>Cetak Ijazah</a><br>";
    echo "<a href='print_document.php?type=transkrip&id=" . $row['id_pengajuan'] . "' target='_blank'>Cetak Transkrip</a><br>";
    echo "<a href='print_document.php?type=pembayaran&id=" . $row['id_pengajuan'] . "' target='_blank'>Cetak Bukti Pembayaran</a><br>";

    echo "<form action='update_status.php' method='post'>";
    echo "<input type='hidden' name='id_pengajuan' value='" . $row['id_pengajuan'] . "'>";
    echo "<label for='status'>Ubah Status Pengajuan:</label>";
    echo "<select name='status' id='status'>";
    echo "<option value='6'>Selesai</option>";
    echo "<option value='7'>Dikirim</option>";
    echo "</select>";
    echo "<button type='submit'>Update Status</button>";
    echo "</form>";
} else {
    echo "Pengajuan tidak ditemukan.";
}

mysqli_close($conn);
?>
