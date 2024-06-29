<?php
session_start();
include '../config.php'; // File ini harus memiliki koneksi database Anda

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'dekan') {
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

// Query hanya untuk pengajuan yang telah divalidasi oleh staf
$query = "SELECT p.*, s.keterangan 
          FROM Pengajuan p 
          JOIN Status s ON p.id_status = s.id_status 
          WHERE p.id_status = 2"; // Status 'Divalidasi' (2)
$result = mysqli_query($conn, $query);
$query2 = "SELECT p.*, s.keterangan 
          FROM Pengajuan p 
          JOIN Status s ON p.id_status = s.id_status 
          WHERE p.id_status = 3"; // Status 'Disahkan' (3)
$result2 = mysqli_query($conn, $query2);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($tableFile); ?>
    <title>Pengesahan Legalisir</title>
</head>

<body class="bg-custom-blue">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container justify-content-center align-items-center py-5 my-5">
        <?php @include ($alertFile); ?>
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Daftar Pengesahan legalisir</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-s3" class="table display table-custom table-hover table-bordered">
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
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Telah Disahkan</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="data_table px-4">
                    <table id="table-p" class="table display table-custom table-hover table-bordered">
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
    </main>
    <!-- footer -->
    <?php @include ($footerFile); ?>
    <!-- footer -->
</body>

</html>

<?php
mysqli_close($conn);
?>