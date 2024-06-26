<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan' && $_SESSION['role'] != 'alumni')) {
    header("Location: login_admin.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$tableFile = '../components/datatables.html';
// path ke file navbar berdasarkan role
if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'alumni':
            $navbarFile = '../components/navbar_alumni.html';
            break;
        case 'staf':
            $navbarFile = '../components/navbar_staf.html';
            break;
        case 'dekan':
            $navbarFile = '../components/navbar_dekan.html';
            break;
        default:
            $navbarFile = '../components/navbar_default.html';
            break;
    }
} else {
    $navbarFile = '../components/navbar_default.html'; // Jika pengguna tidak login, gunakan navbar default
}

include '../config.php'; // File ini harus memiliki koneksi database Anda

$id_pengajuan = $_GET['id'];
$query = "SELECT p.*, s.keterangan FROM Pengajuan p JOIN Status s ON p.id_status = s.id_status WHERE p.id_pengajuan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_pengajuan);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($tableFile); ?>
    <title>Detail Pengajuan</title>
</head>

<body class="background-radial-gradient">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
        <section id="radius-shape-3" class="position-absolute shadow-5-strong" style="z-index: -2"></section>
        <?php @include ($alertFile); ?>
        <section class="card bg-glass d-flex px-3 py-5">
            <article class="card-body py-1 px-md-5">
                <header class='row g-3 mb-4'>
                    <article class='d-flex'>
                        <button class='button-3' onclick='history.back()'><</button>
                    </article>
                    <article class="form-outline">
                        <label class="form-label form-label-white d-flex">
                            <span style="font-size: 1.5rem;">Detail Pengajuan legalisir</span></label>
                    </article>
                </header>
                <section>
                <?php if ($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <article class='data_tables'>
                            <table class='table dt[-head|-body]-left table-custom table-hover table-bordered'>
                                <tr>
                                    <th width='30%'>NPM</th>
                                    <td>$row[npm]</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>$row[nama]</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td>$row[tahun_lulus]</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>$row[email]</td>
                                </tr>
                                <tr>
                                    <th>Metode Pengambilan</th>
                                    <td>$row[metode_pengambilan]</td>
                                </tr>
                                <tr>
                                    <th>Alamat Pengiriman</th>
                                    <td>$row[alamat_pengiriman]</td>
                                </tr>
                                <tr>
                                    <th>Ekspedisi Pengiriman</th>
                                    <td>$row[ekspedisi]</td>
                                </tr>
                                <tr>
                                    <th>Total Harga</th>
                                    <td>$row[total_harga]</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>$row[keterangan]</td>
                                </tr>
                            </table>
                        </article>";
                    if ($_SESSION['role'] == 'alumni') {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Menunggu Validasi')) {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a class='button-1 mb-2' href='../proses/validasi_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Validasi Pengajuan</a>
                                            <a class='button-5' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'dekan' && ($row['keterangan'] == 'Divalidasi')) {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Ditolak')) {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a href='#' onclick='confirmDelete($row[id_pengajuan])' class='button-5 mb-2'>Hapus Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Disahkan')) {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a class='button-1 mb-2' href='../proses/update_status.php?id=" . $row['id_pengajuan'] . "'>Update Status Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    
                    } elseif ($_SESSION['role'] == 'staf') {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'dekan' && ($row['keterangan'] == 'Divalidasi')) {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a class='btn btn-success btn-block mb-2' href='../proses/approve_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Sahkan Pengajuan</a>
                                            <a class='btn btn-danger btn-block' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'dekan' && ($row['keterangan'] == 'Disahkan')) {
                        echo "
                            <article class='d-flex mb-4' style='font-size: 1.5rem;'>Dokumen</article>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    }
                } else {
                    echo "Pengajuan tidak ditemukan.";
                }
                mysqli_close($conn);
                ?>

                </section>
            </article>
        </section>
        </section>
    </main>
</body>

</html>