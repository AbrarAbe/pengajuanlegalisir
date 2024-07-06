<?php
session_start();

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan' && $_SESSION['role'] != 'alumni')) {
    header("Location: login.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer.html';
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

include '../config.php';
$id_pengajuan = $_GET['id'];
$query = "SELECT p.*, s.keterangan FROM pengajuan p JOIN status s ON p.id_status = s.id_status WHERE p.id_pengajuan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_pengajuan);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($scriptsFile); ?>
    <title>Detail Pengajuan</title>
</head>

<body>
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
        <!-- Page Content  -->
        <section id="content" class="p-4 p-md-5 pt-5">
            <?php @include ($alertFile); ?>
            <h2 class="mb-4">Detail Pengajuan</h2>
            </header>
            <section>
                <?php if ($row = mysqli_fetch_assoc($result)) {
                    echo "
                        <article class='data_tables mb-4' style='font-size:0.8rem'>
                            <table class='table dt[-head|-body] text-start table-striped table-bordered'>
                                <tr>
                                    <th width='25%'>Nomor Pokok Mahasiswa</th>
                                    <td>$row[npm]</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>$row[nama]</td>
                                </tr>
                                <tr>
                                    <th>Program Srudi</th>
                                    <td>$row[prodi]</td>
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
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Menunggu Validasi')) {
                        echo "
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a class='button-1 mb-2 preload-link' href='../proses/validasi_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Validasi Pengajuan</a>
                                            <a class='button-5 preload-link' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Divalidasi')) {
                        echo "
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Ditolak')) {
                        echo "
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a href='#' onclick='confirmDelete($row[id_pengajuan])' class='button-5 mb-2 preload-link'>Hapus Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'staf' && ($row['keterangan'] == 'Disahkan')) {
                        echo "
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
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
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'dekan' && ($row['keterangan'] == 'Divalidasi')) {
                        echo "
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                    </article>
                                    <article class='col-sm'>
                                        <article class='d-grid'>
                                            <a class='button-1 mb-2 preload-link' href='../proses/approve_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Sahkan Pengajuan</a>
                                            <a class='button-5 preload-link' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                        </article>
                                    </article>
                                </article>
                            </article>
                        ";
                    } elseif ($_SESSION['role'] == 'dekan' && ($row['keterangan'] == 'Disahkan')) {
                        echo "
                            <h2 class='mb-4'>Dokumen</h2>
                                <article class='row g-3'>
                                    <article class='col-sm-8 d-flex gap-2'>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                        <a class='button-6 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
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
        </section>
    </main>
</body>

</html>