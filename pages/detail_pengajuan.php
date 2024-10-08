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
$themeFile = '../components/theme.html';
$logoutModalFile = '../components/logout_modal.html';
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
$query = "
    SELECT p.*, s.keterangan, u.email
    FROM pengajuan p
    JOIN status s ON p.id_status = s.id_status
    JOIN user u ON p.id_user = u.id_user
    WHERE p.id_pengajuan = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_pengajuan);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en">

<head>
    <?php @include($headFile); ?>
    <?php @include($scriptsFile); ?>
    <?php @include($themeFile); ?>
    <title>Detail Pengajuan</title>
</head>

<body>
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <!-- Navbar -->
        <?php @include($navbarFile); ?>
        <!-- Page Content  -->
        <section id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4">Detail Pengajuan</h2>
            <?php @include($alertFile); ?>
            </header>
            <section>
                <?php if ($row = mysqli_fetch_assoc($result)) {
                    if ($row['metode_pengambilan'] == 'Ambil di Fakultas') {
                        echo "
                        <article class='mb-5' style='font-size:0.8rem'>
                            <table class='table dt[-head|-body] text-start table-striped table-bordered'>
                                <tr>
                                    <th width='25%'>ID Pengajuan</th>
                                    <td>$row[id_pengajuan]</td>
                                </tr>
                                <tr>
                                    <th>Nomor Pokok Mahasiswa</th>
                                    <td>$row[npm]</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>$row[nama]</td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
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
                                    <th>Nomor Telp / WA</th>
                                    <td>$row[nomor_telepon]</td>
                                </tr>
                                <tr>
                                    <th>Metode Pengambilan</th>
                                    <td>$row[metode_pengambilan]</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Legalisir Ijazah</th>
                                    <td>$row[jumlah_legalisir_ijazah]<span class='ml-2 text-secondary'>x Rp3000</span></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Legalisir Transkrip</th>
                                    <td>$row[jumlah_legalisir_transkrip]<span class='ml-2 text-secondary'>x Rp3000</span></td>
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
                    } else {
                        if ($row['keterangan'] == 'Penentuan Ekspedisi') {
                            echo "
                        <article class='mb-5' style='font-size:0.8rem'>
                            <table class='table dt[-head|-body] text-start table-striped table-bordered'>
                                <tr>
                                    <th width='25%'>ID Pengajuan</th>
                                    <td>$row[id_pengajuan]</td>
                                </tr>
                                <tr>
                                    <th>Nomor Pokok Mahasiswa</th>
                                    <td>$row[npm]</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>$row[nama]</td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
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
                                    <th>Nomor Telp / WA</th>
                                    <td>$row[nomor_telepon]</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Legalisir Ijazah</th>
                                    <td>$row[jumlah_legalisir_ijazah]<span class='ml-2 text-secondary'>x Rp3000</span></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Legalisir Transkrip</th>
                                    <td>$row[jumlah_legalisir_transkrip]<span class='ml-2 text-secondary'>x Rp3000</span></td>
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
                                    <td>$row[ekspedisi]<span class='ml-2 text-secondary'>*belum ditentukan oleh Admin</span></td>
                                </tr>
                                <tr>
                                    <th>Harga Pengiriman</th>
                                    <td>$row[ekspedisi_harga]<span class='ml-2 text-secondary'>*belum ditentukan oleh Admin</span></td>
                                </tr>
                                <tr>
                                    <th>Harga Sementara</th>
                                    <td>$row[total_harga]</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>$row[keterangan]</td>
                                </tr>
                            </table>
                        </article>";
                        } else {
                            echo "
                        <article class='mb-4' style='font-size:0.8rem'>
                            <table class='table dt[-head|-body] text-start table-striped table-bordered'>
                                <tr>
                                    <th width='25%'>ID Pengajuan</th>
                                    <td>$row[id_pengajuan]</td>
                                </tr>
                                <tr>
                                    <th>Nomor Pokok Mahasiswa</th>
                                    <td>$row[npm]</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>$row[nama]</td>
                                </tr>
                                <tr>
                                    <th>Program Studi</th>
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
                                    <th>Jumlah Legalisir Ijazah</th>
                                    <td>$row[jumlah_legalisir_ijazah]<span class='ml-2 text-secondary'>x Rp3000</span></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Legalisir Transkrip</th>
                                    <td>$row[jumlah_legalisir_transkrip]<span class='ml-2 text-secondary'>x Rp3000</span></td>
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
                                    <td>$row[ekspedisi]<span class='ml-2 text-secondary'>*ditentukan oleh Admin</span></td>
                                </tr>
                                <tr>
                                    <th>Harga Pengiriman</th>
                                    <td>$row[ekspedisi_harga]<span class='ml-2 text-secondary'>*ditentukan oleh Admin</span></td>
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
                        }
                    }
                    switch ($_SESSION['role']) {
                        case 'alumni':
                            if ($row['metode_pengambilan'] == 'COD/Bayar di Tempat') {
                                echo "
                                    <h2 class='mb-4'>Dokumen</h2>
                                    <article class='row g-3 mb-4'>
                                        <article class='col-sm-8 d-flex gap-2'>
                                            <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                            <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a></br>
                                        </article>
                                        <article class='col-sm'>
                                            <article class='d-grid'>
                                                <a class='button-6 text-wrap preload-link' href='status_pengajuan.php'>Kembali</a>
                                            </article>
                                        </article>
                                    </article>
                                ";
                            } else {
                                echo "
                                    <h2 class='mb-4'>Dokumen</h2>
                                    <article class='row g-3 mb-4'>
                                        <article class='col-sm-8 d-flex gap-2'>
                                            <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                            <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                            <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                        </article>
                                        <article class='col-sm'>
                                            <article class='d-grid'>
                                                <a class='button-6 text-wrap preload-link' href='status_pengajuan.php'>Kembali</a>
                                            </article>
                                        </article>
                                    </article>
                                ";
                            }
                            break;

                        case 'staf':
                            if ($row['metode_pengambilan'] == 'COD/Bayar di Tempat') {
                                if ($row['keterangan'] == 'Penentuan Ekspedisi') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3 mb-4'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a><br>
                                            </article>
                                        </article>
                                        <h2 class='mb-4'>Update Ekspedisi</h2>
                                        <form action='../proses/update_ekspedisi.php' method='post'>
                                            <!-- ID Pengajuan -->
                                            <input type='number' class='form-control mb-2' id='id_pengajuan' name='id_pengajuan' 
                                                value='$row[id_pengajuan]' required placeholder='ID Pengajuan' style='display:none;'>
                                            <!-- Ekspedisi Pengiriman -->
                                            <article class='form-outline mb-3'>
                                                <label class='form-label d-flex' for='ekspedisi'>Ekspedisi Pengiriman :</label>
                                                <input type='text' class='form-control' list='eksList' id='ekspedisi' name='ekspedisi' required placeholder='Ekspedisi'>
                                                <datalist id='eksList'>
                                                    <option value='J&T Express'>
                                                    <option value='JNE'>
                                                    <option value='Shopee Xpress'>
                                                    <option value='SiCepat'>
                                                    <option value='Anteraja'>
                                                    <option value='GoSend'>
                                                    <option value='Grab Xpress'>
                                                    <option value='TIKI'>
                                                    <option value='Ninja Xpress'>
                                                    <option value='POS Indonesia'>
                                                    <option value='Lion Parcel'>
                                                    <option value='Paxel'>
                                                </datalist>
                                            </article>
                                            <!-- Harga Pengiriman -->
                                            <article class='form-outline mb-4'>
                                                <label class='form-label d-flex' for='ekspedisi_harga'>Harga Pengiriman :</label>
                                                <input type='number' class='form-control' id='ekspedisi_harga' name='ekspedisi_harga' oninput='checkNegative(this)' min='4' required placeholder='Harga Pengiriman'>
                                            </article>
                                            <!-- Submit btn -->
                                            <article class='d-grid'>
                                                <button type='submit' name='submit' id='submitBtn' class='preload-submit button-82-pushable'
                                                    role='button'>
                                                    <span class='button-82-shadow'></span>
                                                    <span class='button-82-edge'></span>
                                                    <span class='button-82-front text'>
                                                        Update
                                                    </span>
                                                </button>
                                            </article>
                                        </form>
                                    ";
                                } else if ($row['keterangan'] == 'Menunggu Validasi') {
                                    echo "
                                        <h2 class='mb-2'>Dokumen</h2>
                                        <label class='mb-4 text-danger'>harap periksa dokumen sebelum melakukan validasi</label>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-1 mb-2 preload-link' href='../proses/validasi_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Validasi Pengajuan</a>
                                                    <a class='button-5 preload-link' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else if ($row['keterangan'] == 'Divalidasi') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' href='list_pengajuan_disahkan.php'>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else if ($row['keterangan'] == 'Ditolak') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a href='#' onclick='confirmDelete($row[id_pengajuan])' class='button-5 mb-2 text-wrap'>Hapus Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else if ($row['keterangan'] == 'Disahkan') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-1 mb-2 text-wrap preload-link' href='../proses/update_status.php?id=" . $row['id_pengajuan'] . "'>Update Status Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else if ($row['keterangan'] == 'Selesai') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' href='list_pengajuan_disahkan.php>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3 mb-4'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' onclick=history.back()' style='color:white;'>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                }
                            } else {
                                if ($row['keterangan'] == 'Menunggu Validasi') {
                                    echo "
                                        <h2 class='mb-2'>Dokumen</h2>
                                        <label class='mb-4 text-danger'>harap periksa dokumen sebelum melakukan validasi</label>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-1 mb-2 preload-link' href='../proses/validasi_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Validasi Pengajuan</a>
                                                    <a class='button-5 preload-link' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } elseif ($row['keterangan'] == 'Divalidasi') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' href='list_pengajuan_disahkan.php'>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } elseif ($row['keterangan'] == 'Ditolak') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a href='#' onclick='confirmDelete($row[id_pengajuan])' class='button-5 mb-2 text-wrap'>Hapus Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } elseif ($row['keterangan'] == 'Disahkan') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-1 mb-2 text-wrap preload-link' href='../proses/update_status.php?id=" . $row['id_pengajuan'] . "'>Update Status Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } elseif ($row['keterangan'] == 'Selesai') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Cetak Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Cetak Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Cetak Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' href='list_pengajuan_disahkan.php>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3 mb-4'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' onclick=history.back()' style='color:white;'>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                }
                            }
                            break;

                        case 'dekan':
                            if ($row['metode_pengambilan'] == 'COD/Bayar di Tempat') {
                                if ($row['keterangan'] == 'Divalidasi') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a></br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-1 text-wrap mb-2 preload-link' href='../proses/approve_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Sahkan Pengajuan</a>
                                                    <a class='button-5 text-wrap preload-link' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else if ($row['keterangan'] == 'Disahkan') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3 mb-4'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a></br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' onclick=history.back()' style='color:white;'>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                }
                            } else {
                                if ($row['keterangan'] == 'Divalidasi') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-1 text-wrap mb-2 preload-link' href='../proses/approve_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Sahkan Pengajuan</a>
                                                    <a class='button-5 text-wrap preload-link' href='../proses/tolak_pengajuan.php?id=" . $row['id_pengajuan'] . "'>Tolak Pengajuan</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                } else if ($row['keterangan'] == 'Disahkan') {
                                    echo "
                                        <h2 class='mb-4'>Dokumen</h2>
                                        <article class='row g-3 mb-4'>
                                            <article class='col-sm-8 d-flex gap-2'>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'>Lihat Ijazah</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_document.php?type=scan_transkrip&id=" . $row['id_pengajuan'] . "'>Lihat Transkrip</a>
                                                <a class='button-2 text-wrap preload-link' href='../proses/view_photo.php?type=bukti_pembayaran&id=" . $row['id_pengajuan'] . "'>Lihat Bukti Pembayaran</a><br>
                                            </article>
                                            <article class='col-sm'>
                                                <article class='d-grid'>
                                                    <a class='button-6 text-wrap preload-link' onclick=history.back()' style='color:white;'>Kembali</a>
                                                </article>
                                            </article>
                                        </article>
                                    ";
                                }
                            }

                    }

                } else {
                    echo "
                        <article class='row g-3 mb-4 my-1'>
                            <article class='col-sm-8 d-flex gap-2'>
                                <p>Pengajuan tidak ditemukan :(</p>
                            </article>
                            <article class='col-sm'>
                                <article class='d-grid'>
                                    <a class='button-6 text-wrap preload-link' onclick=history.back()' style='color:white;'>Kembali</a>
                                </article>
                            </article>
                        </article>
                    ";
                }
                mysqli_close($conn);
                ?>
            </section>
        </section>
		<?php @include($logoutModalFile); ?>
    </main>
</body>

</html>