<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_s']) || $_SESSION['role'] != 'staf') {
    header("Location: login_admin.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$tableFile = '../components/datatables.html';
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

//tabel belum divalidasi
$query = "SELECT p.*, s.keterangan 
          FROM pengajuan p 
          JOIN status s ON p.id_status = s.id_status 
          WHERE p.id_status = 1 "; // Status 'Menunggu divalidasi' (1)
$result = mysqli_query($conn, $query);

//tabel telah divalidasi
$query2 = "SELECT p.*, s.keterangan 
          FROM pengajuan p 
          JOIN status s ON p.id_status = s.id_status 
          WHERE p.id_status = 2"; // Status 'Divalidasi' (5)
$result2 = mysqli_query($conn, $query2);

//tabel telah divalidasi
$query3 = "SELECT p.*, s.keterangan 
          FROM pengajuan p 
          JOIN status s ON p.id_status = s.id_status 
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

<body class="background-radial-gradient">
    <section id="preloaderLink" class="preloader d-flex">
        <article class="loader"></article>
    </section>
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container justify-content-center align-items-center py-5 my-5">
        <?php @include ($alertFile); ?>
        <section class="card bg-glass d-flex mb-4 py-5">
            <section id="tbMasuk" style="display:block" class="mb-4">
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
                            <thead class="thead-glass">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>NPM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Metode Pengambilan</th>
                                    <th>Status</th>
                                    <th width="15%">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['id_pengajuan']; ?></td>
                                        <td><?php echo $row['npm']; ?></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['prodi']; ?></td>
                                        <td><?php echo $row['metode_pengambilan']; ?></td>
                                        <td><?php echo $row['keterangan']; ?></td>
                                        <td>
                                            <article>
                                                <a href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>"
                                                    id="detail" class="button-2 preload-link"">Lihat
                                                    Detail
                                                </a>
                                            </article>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </article><!--
                    <article class="col d-flex gap-2 g-3 justify-content-between px-4 mt-4">
                        <button class="button-5" onclick="toggle_tbDitolak()">Pengajuan Ditolak</button>
                        <button class="button-3" onclick="toggle_tbDivalidasi()">Pengajuan Divalidasi</button>
                    </article>-->
                </section>
            </section>
        </section>
        <!-- Tabel Pengajuan Divalidasi -->
        <section id="tbDivalidasi" style="display:block" class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Pengajuan Divalidasi</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-s4" class="table display table-custom table-hover table-bordered">
                        <thead class="thead-glass">
                            <tr>
                                <th width="5%">ID</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Metode Pengambilan</th>
                                <th>Status</th>
                                <th width="15%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                <tr>
                                    <td><?php echo $row2['id_pengajuan']; ?></td>
                                    <td><?php echo $row2['npm']; ?></td>
                                    <td><?php echo $row2['nama']; ?></td>
                                    <td><?php echo $row2['prodi']; ?></td>
                                    <td><?php echo $row2['metode_pengambilan']; ?></td>
                                    <td><?php echo $row2['keterangan']; ?></td>
                                    <td>
                                        <article>
                                            <a href="detail_pengajuan.php?id=<?php echo $row2['id_pengajuan']; ?>"
                                                id="detail" class="button-2 preload-link"">Lihat
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
        <section id="tbDitolak" style="display:block" class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Pengajuan Ditolak</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-a" class="table display table-custom table-hover table-bordered tabel-striped">
                        <thead class="thead-glass">
                            <tr>
                                <th width="5%">ID</th>
                                <th>NPM</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Metode Pengambilan</th>
                                <th>Status</th>
                                <th width="15%">Detail</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                <tr>
                                    <td><?php echo $row3['id_pengajuan']; ?></td>
                                    <td><?php echo $row3['npm']; ?></td>
                                    <td><?php echo $row3['nama']; ?></td>
                                    <td><?php echo $row3['prodi']; ?></td>
                                    <td><?php echo $row3['metode_pengambilan']; ?></td>
                                    <td><?php echo $row3['keterangan']; ?></td>
                                    <td>
                                        <article>
                                            <a href="detail_pengajuan.php?id=<?php echo $row3['id_pengajuan']; ?>"
                                                id="detail" class="button-2 preload-link"">Lihat
                                                Detail
                                            </a>
                                        </article>
                                    </td>
                                    <td>
                                        <article>
                                            <a href="#" onclick="confirmDelete(<?php echo $row3['id_pengajuan']; ?>)"
                                                class="button-2 preload-link"9 d-flex"><i class="nf nf-fa-trash"></i></a>
                                        </article>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </article>
            </section>
        </section>
        </section>
    </main>
    <!-- footer -->
    <?php @include ($footerFile); ?>
    <!-- footer -->
</body>

</html>

<?php
mysqli_close($conn);
?>