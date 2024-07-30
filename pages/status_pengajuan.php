<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login.php");
    exit;
}

$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer.html';
$themeFile = '../components/theme.html';

include '../config.php';
$id_user = $_SESSION['id_user'];
$query = "SELECT pengajuan.*, status.keterangan FROM pengajuan JOIN status ON pengajuan.id_status = status.id_status 
            WHERE pengajuan.id_user = '$id_user'";
$result = mysqli_query($conn, $query);
?>

<!doctype html>
<html lang="en">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($scriptsFile); ?>
    <?php @include ($themeFile); ?>
    <title>Status Pengajuan</title>
</head>

<body>
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <nav id="sidebar" class="nav-bg-light">
            <article class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </article>
            <article class="container d-grid p-4 position-fixed" style="max-width: 270px">
                <h1><a href="../index.php" class="logo nav-link mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="beranda_alumni.php" class="nav-link"><span class="fa fa-home mr-4"></span>Beranda</a>
                    </li>
                    <li>
                        <a href="form_pengajuan.php" class="nav-link preload-link"><span
                                class="fa fa-id-card mr-4"></span>Form Pengajuan</a>
                    </li>
                    <li class="active">
                        <a href="status_pengajuan.php" class="nav-link"><span class="fa fa-chart-simple mr-4"></span>
                            Status Pengajuan</a>
                    </li>
                    <li>
                        <a id="theme-toggle" class="nav-link"><span id="theme-icon"
                                class="fa fa-sun mr-4"></span>Ganti Tema</a>
                    </li>
                    <li>
                        <a href="../proses/logout.php" class="nav-link preload-link"><span
                                class="fa fa-right-from-bracket mr-4"></span>Keluar</a>
                    </li>
                </ul>
                <!-- Footer -->
                <?php @include ($footerFile); ?>
                <!-- Footer -->
            </article>
        </nav>
        <!-- Page Content  -->
        <section id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-5">Status Pengajuan</h2>
            <?php @include ($alertFile); ?>
            <article class="data_table" style="font-size:0.8rem">
                <table id="table-s" class="table display table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-start">ID</th>
                            <th>Nama</th>
                            <th>Metode Pengambilan</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="text-start"><?php echo $row['id_pengajuan']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['metode_pengambilan']; ?></td>
                                <td class="text-center">
                                    <?php switch ($row['keterangan']) {
                                        case 'Menunggu Validasi':
                                            echo "<span class='badge badge-warning d-flex justify-content-center align-items-center py-2 px-2'>Menunggu validasi</span>";
                                            break;
                                        case 'Divalidasi':
                                            echo "<span class='badge badge-primary d-flex justify-content-center align-items-center py-2 px-2'>Divalidasi</span>";
                                            break;
                                        case 'Disahkan':
                                            echo "<span class='badge badge-info d-flex justify-content-center align-items-center py-2 px-2'>Disahkan</span>";
                                            break;
                                        case 'Ditolak':
                                            echo "<span class='badge badge-danger d-flex justify-content-center align-items-center py-2 px-2'>Ditolak</span>";
                                            break;
                                        case 'Selesai':
                                            echo "<span class='badge badge-success d-flex justify-content-center align-items-center py-2 px-2'>Selesai</span>";
                                            break;
                                        case 'Penentuan Ekspedisi':
                                            echo "<span class='badge badge-orange d-flex justify-content-center align-items-center py-2 px-2'>Sedang diperiksa</span>";
                                            break;
                                        case 'Menunggu Pembayaran':
                                            echo "<span class='badge badge-purple d-flex justify-content-center align-items-center py-2 px-2'>Menunggu pembayaran</span>";
                                            break;
                                    }
                                    ; ?>
                                </td>
                                <td>
                                    <article class="d-grid">
                                        <a href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>" id="detail"
                                            class="button-4 preload-link px-2">Lihat Detail
                                        </a>
                                    </article>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </article>
        </section>
    </main>
</body>

</html>