<?php
session_start();

if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan' && $_SESSION['role'] != 'alumni')) {
    header("Location: login_admin.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
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

include '../config.php';
$id_pengajuan = $_GET['id'];
$query = "SELECT p.*, s.keterangan FROM Pengajuan p JOIN Status s ON p.id_status = s.id_status WHERE p.id_pengajuan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_pengajuan);
$stmt->execute();
$result = $stmt->get_result();
$pengajuan = $result->fetch_assoc();

if (!$pengajuan) {
    echo "Pengajuan tidak ditemukan.";
    exit;
}
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
        <section class="card bg-glass d-flex px-3 py-5">
            <article class="card-body py-1 px-md-5">
                <header class="form-outline mb-3">
                    <label class="form-label form-label-white d-flex">
                        <span style="font-size: 1.5rem;">Detail Pengajuan legalisir</span></label>
                </header>
                <table border="1" class="table table-custom">
                    <tr>
                        <th width="30%">NPM</th>
                        <td><?php echo $pengajuan['npm']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $pengajuan['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Lulus</th>
                        <td><?php echo $pengajuan['tahun_lulus']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $pengajuan['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Metode Pengambilan</th>
                        <td><?php echo $pengajuan['metode_pengambilan']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat Pengiriman</th>
                        <td><?php echo $pengajuan['alamat_pengiriman']; ?></td>
                    </tr>
                    <tr>
                        <th>Ekspedisi Pengiriman</th>
                        <td><?php echo $pengajuan['ekspedisi']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Harga</th>
                        <td><?php echo $pengajuan['total_harga']; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?php echo $pengajuan['keterangan']; ?></td>
                    </tr>
                </table>

                <span style="font-size: 1.5rem;">Dokumen</span>
                <article class="row g-3 py-3">
                    <article class="col-sm-8 gap-">
                        <a class="button-2"
                        href="../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . '"'; ?>&type=ijazah">Lihat Scan
                            Ijazah</a>
                            <a class='btn btn-outline-warning btn-block mb-2' href='../proses/view_document.php?type=scan_ijazah&id=" . $row['id_pengajuan'] . "'> 🎓 Lihat Ijazah</a>
                        <a class="button-2"
                            href="../proses/view_photo.php?id=<?php echo $pengajuan['id_pengajuan']; ?>">Lihat
                            Bukti
                            Pembayaran</a>
                    </article>

                    <article class="col-sm">
                        <article class="d-grid">
                            <?php if ($pengajuan['keterangan'] != 'Menunggu Validasi') { ?>
                                <article class="d-grid gap-2">
                                    <a name="id_pengajuan" value="<?php echo $pengajuan['id_pengajuan']; ?>"
                                        class="btn btn-success btn-block mb-2"
                                        href="../proses/uddate_status.php?id=" . $row[' id_pengajuan'] . "'>Update Status Pengajuan</a>
                                                                        </article>
                            <?php } ?>
                
                            <?php if ($pengajuan['keterangan'] != 'Disahkan') { ?>
                                <article class="d-grid gap-2">
                                    <a type=" hidden" name="id_pengajuan"
                                        value="<?php echo $pengajuan['id_pengajuan']; ?>"
                                        class="btn btn-success btn-block mb-2"
                                        href='../proses/validasi_pengajuan.php?id=" . $row[' id_pengajuan'] . "'>Validasi Pengajuan</a>
                                    <a type=" hidden" name="id_pengajuan"
                                        value="<?php echo $pengajuan['id_pengajuan']; ?>"
                                        class="btn btn-success btn-block mb-2"
                                        href='../proses/tolak_pengajuan.php?id=" . $row[' id_pengajuan'] . "'>Tolak Pengajuan</a>
                                        </article>
                            <?php } ?>
                        </article>
                    </article>

                <a href=" javascript:history.back()">Kembali</a>

                            </article>
        </section>
    </main>
</body>

</html>

<?php
$stmt->close();
mysqli_close($conn);
?>