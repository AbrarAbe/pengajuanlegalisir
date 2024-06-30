<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login_alumni.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$footerFile = '../components/footer.html';
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

$id_user = $_SESSION['id_user'];
$query = "SELECT Pengajuan.*, Status.keterangan FROM Pengajuan JOIN Status ON Pengajuan.id_status = Status.id_status 
            WHERE Pengajuan.id_user = '$id_user'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($tableFile); ?>
    <title>Daftar Pengajuan</title>
</head>

<body class="background-radial-gradient">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container justify-content-center align-items-center py-5 my-5">
        <?php @include ($alertFile); ?>
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-4">
                    <label class="form-label">
                        <span style="font-size: 1.5rem;">Status Pengajuan legalisir Anda</span></label>
                </header>
            </section>
            <section class="card-body py1 px-3">
                <article class="data_table px-4">
                    <table id="table-s3" class="table display table-custom table-hover table-bordered">
                        <thead class="thead-glass">
                            <tr>
                                <th width="5%">ID</th>
                                <th>Nama</th>
                                <th>Metode Pengambilan</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th width="20%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id_pengajuan']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['metode_pengambilan']; ?></td>
                                    <td><?php echo $row['total_harga']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    </td>
                                    <td>
                                        <article class="d-grid gap-2">
                                            <a href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>"
                                                id="detail" class="button-2">Lihat Detail
                                            </a>
                                        </article>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
            </section>
            <article class="mx-4 my-4 px-3">
                <a href="beranda_alumni.php" class="button-3">Kembali ke Beranda</a>
            </article>
        </section>
    </main>
    <!-- Footer -->
    <?php @include ($footerFile); ?>
    <!-- Footer -->
</body>

</html>

<?php
mysqli_close($conn);
?>