<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'dekan') {
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

// Query hanya untuk pengajuan yang telah divalidasi oleh staf
$query = "SELECT p.*, s.keterangan 
          FROM Pengajuan p 
          JOIN Status s ON p.id_status = s.id_status 
          WHERE p.id_status IN (2, 3)"; // Status 'Divalidasi' (2) dan 'Disahkan' (3)
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($tableFile); ?>
    <title>Daftar Pengajuan</title>
</head>

<body class="bg-custom">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
        <section id="radius-shape-3" class="position-absolute shadow-5-strong" style="z-index: -2"></section>
        <section class="card bg-glass d-flex mb-4 px-3 py-5">
            <section class="card-body py-1 px-md-5">
                <header class="form-outline mb-3">
                    <label class="form-label form-label-white d-flex">
                        <span style="font-size: 1.5rem;">Daftar Pengajuan legalisir</span></label>
                </header>
                <article class="table-responsive">
                    <table class="table table-bordered border-primary table-custom input-glass table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider table-divider-color">
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id_pengajuan']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td>
                                        <article class="d-grid gap-2"><a
                                                href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>"
                                                id="detail" target="frmmenu" class="btn btn-outline-info btn-block"
                                                onclick="document.getElementById('frmmenu').style.display='block'">Lihat
                                                Detail</a></article>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
                <article>
                    <button class="button-34" onclick="window.location.href='beranda_dekan.php';">Kembali ke
                        Beranda</button>
                </article>
            </section>
        </section>
        <section class="bg-transparent" id="frmmenu" style="display: none">
            <iframe src="" name="frmmenu" width="100%" height="700vh"></iframe>
        </section>
    </main>
</body>

</html>

<?php
mysqli_close($conn);
?>