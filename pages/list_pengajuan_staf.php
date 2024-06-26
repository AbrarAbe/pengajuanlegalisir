<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
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

$query = "SELECT p.*, s.keterangan FROM Pengajuan p JOIN Status s ON p.id_status = s.id_status";
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
        <?php
        if (isset($_SESSION['alert_message'])) {
            echo '<article class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['alert_message'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">' . '</button>' . '</article>';
            unset($_SESSION['alert_message']);
        }
        ?>
        <section class="card bg-glass d-flex mb-4 py-5">
            <section class="card-body py-1 px-md-4">
                <header class="form-outline px-3">
                    <label class="form-label d-flex">
                        <span style="font-size: 1.5rem;">Daftar Pengajuan legalisir</span></label>
                </header>
            </section>
            <section class="card-body py-1">
                <article class="table-responsive px-4">
                    <article class="data_table">
                        <table id="table-s" class="table display table-custom table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">ID</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>Netode Pengambilan</th>
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
                                                    class="button-29"><i class="nf nf-fa-trash"></i></a>
                                            </article>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </article>
                </article>
                <article class="py-3 px-4">
                    <a href="beranda_staf.php" class="button-3">Kembali ke Beranda</a>
                </article>
            </section>
        </section>
    </main>
</body>

</html>

<?php
mysqli_close($conn);
?>