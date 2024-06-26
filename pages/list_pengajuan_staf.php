<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
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

//tabel belum divalidasi
$query = "SELECT p.*, s.keterangan 
          FROM Pengajuan p 
          JOIN Status s ON p.id_status = s.id_status 
          WHERE p.id_status = 1 "; // Status 'Menunggu divalidasi' (1)
$result = mysqli_query($conn, $query);

//tabel telah divalidasi
$query2 = "SELECT p.*, s.keterangan 
          FROM Pengajuan p 
          JOIN Status s ON p.id_status = s.id_status 
          WHERE p.id_status = 2"; // Status 'Divalidasi' (5)
$result2 = mysqli_query($conn, $query2);

//tabel telah divalidasi
$query3 = "SELECT p.*, s.keterangan 
          FROM Pengajuan p 
          JOIN Status s ON p.id_status = s.id_status 
          WHERE p.id_status = 4"; // Status 'Ditolak' (5)
$result3 = mysqli_query($conn, $query3);
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
        <?php @include ($alertFile); ?>
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Pengajuan Masuk</span></label>
                </header>
            </section>
            <!-- Tabel Pengajuan Masuk -->
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-s" class="table display table-custom table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">ID</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Metode Pengambilan</th>
                                <th>Status</th>
                                <th width="15%">Detail</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['id_pengajuan']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['npm']; ?></td>
                                    <td><?php echo $row['metode_pengambilan']; ?></td>
                                    <td><?php echo $row['keterangan']; ?></td>
                                    <td>
                                        <article>
                                            <a href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>"
                                                id="detail" class="button-2">Lihat
                                                Detail
                                            </a>
                                        </article>
                                    </td>
                                    <td>
                                        <article>
                                            <a href="#" onclick="confirmDelete(<?php echo $row['id_pengajuan']; ?>)"
                                                class="d-grid button-29"><i class="nf nf-fa-trash"></i></a>
                                        </article>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
                <article class="py-3 px-4">
                    <a href="beranda_staf.php" class="button-3">Kembali ke Beranda</a>
                </article>
            </section>
        </section>
        <!-- Tabel Pengajuan Divalidasi -->
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Pengajuan Divalidasi</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-s2" class="table display table-custom table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">ID</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Metode Pengambilan</th>
                                <th>Status</th>
                                <th width="15%">Detail</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row2 = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row2['id_pengajuan']; ?></td>
                                    <td><?php echo $row2['nama']; ?></td>
                                    <td><?php echo $row2['npm']; ?></td>
                                    <td><?php echo $row2['metode_pengambilan']; ?></td>
                                    <td><?php echo $row2['keterangan']; ?></td>
                                    <td>
                                        <article>
                                            <a href="detail_pengajuan.php?id=<?php echo $row2['id_pengajuan']; ?>"
                                                id="detail" class="button-2">Lihat
                                                Detail
                                            </a>
                                        </article>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
            </section>
        </section>
        <!-- Tabel Pengajuan Ditolak -->
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Pengajuan Ditolak</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-s3" class="table display table-custom table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">ID</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Metode Pengambilan</th>
                                <th>Status</th>
                                <th width="15%">Detail</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row3 = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row3['id_pengajuan']; ?></td>
                                    <td><?php echo $row3['nama']; ?></td>
                                    <td><?php echo $row3['npm']; ?></td>
                                    <td><?php echo $row3['metode_pengambilan']; ?></td>
                                    <td><?php echo $row3['keterangan']; ?></td>
                                    <td>
                                        <article>
                                            <a href="detail_pengajuan.php?id=<?php echo $row3['id_pengajuan']; ?>"
                                                id="detail" class="button-2">Lihat
                                                Detail
                                            </a>
                                        </article>
                                    </td>
                                    <td>
                                        <article>
                                            <a href="#" onclick="confirmDelete(<?php echo $row['id_pengajuan']; ?>)"
                                                class="button-29"><i class="nf nf-fa-trash"></i></a>
                                        </article>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
            </section>
        </section>
    </main>
</body>

</html>

<?php
mysqli_close($conn);
?>