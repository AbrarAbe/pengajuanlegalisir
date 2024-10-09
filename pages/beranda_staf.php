<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: login.php");
    exit;
}

include '../config.php';

// Query untuk menghitung jumlah pengajuan
$query_masuk = "SELECT COUNT(*) as total_masuk FROM pengajuan WHERE id_status IN (1,6)";
$query_diproses = "SELECT COUNT(*) as total_diproses FROM pengajuan WHERE id_status IN (2,3,4,5,7)";
$query_selesai = "SELECT COUNT(*) as total_selesai FROM pengajuan WHERE id_status IN (5)";
$query_total = "SELECT COUNT(*) as total_total FROM pengajuan WHERE id_status IN (1,2,3,4,5,6,7)";

$result_masuk = $conn->query($query_masuk);
$result_diproses = $conn->query($query_diproses);
$result_selesai = $conn->query($query_selesai);
$result_total = $conn->query($query_total);

$total_masuk = $result_masuk->fetch_assoc()['total_masuk'];
$total_diproses = $result_diproses->fetch_assoc()['total_diproses'];
$total_selesai = $result_selesai->fetch_assoc()['total_selesai'];
$total_total = $result_total->fetch_assoc()['total_total'];

// Query untuk menghitung pengguna aktif berdasarkan tanggal pendaftaran
$query_pengguna_aktif = "SELECT COUNT(*) as total_pengguna_aktif FROM user WHERE status = 'aktif'";

// Query untuk menghitung statistik pengguna berdasarkan role
$query_pengguna = "SELECT COUNT(*) as total_pengguna FROM user WHERE role = 'alumni'";

// Query untuk menghitung pengguna baru berdasarkan tanggal pendaftaran
$query_pengguna_baru = "SELECT COUNT(*) as total_pengguna_baru FROM user WHERE DATE(created_at) = CURDATE()";

$result_pengguna_aktif = $conn->query($query_pengguna_aktif);
$result_pengguna = $conn->query($query_pengguna);
$result_pengguna_baru = $conn->query($query_pengguna_baru);

$total_pengguna_aktif = $result_pengguna_aktif->fetch_assoc()['total_pengguna_aktif'];
$total_pengguna = $result_pengguna->fetch_assoc()['total_pengguna'];
$total_pengguna_baru = $result_pengguna_baru->fetch_assoc()['total_pengguna_baru'];

// Query untuk mengambil notifikasi terbaru
$query_notifikasi = "SELECT * FROM notifikasi ORDER BY created_at DESC LIMIT 5";
$total_notifikasi = "SELECT * FROM notifikasi ORDER BY created_at DESC";
$modal_notifikasi = $conn->query($total_notifikasi);
$result_notifikasi = $conn->query($query_notifikasi);

$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer.html';
$themeFile = '../components/theme.html';
$logoutModalFile = '../components/logout_modal.html';
?>

<!doctype html>
<html lang="en">

<head>
    <?php @include($headFile); ?>
    <?php @include($scriptsFile); ?>
    <?php @include($themeFile); ?>
    <title>Beranda</title>
</head>

<body>
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <nav id="sidebar" class="nav-bg-light" style="min-height:100vh">
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
                    <li class="active">
                        <a href="beranda_staf.php" class="nav-link"><span class="fa fa-home mr-4"></span>Dashboard</a>
                    </li>
                    <li>
                        <a href="list_pengajuan_staf.php" class="nav-link preload-link"><span
                                class="fa fa-id-card mr-4"></span>List Pengajuan</a>
                    </li>
                    <li>
                        <a href="list_pengajuan_disahkan.php" class="nav-link preload-link"><span
                                class="fa fa-file-lines ml-1 mr-4"></span> Legalisir</a>
                    </li>
                    <li>
                        <a id="theme-toggle" class="nav-link"><span id="theme-icon"
                                class="fa fa-sun ml-1 mr-4"></span>Ganti Tema</a>
                    </li>
                    <li>
                        <a href="" class="nav-link" onclick="openModal()" id="openModal" data-bs-toggle="modal"
                            data-bs-target="#logoutModal"><span class="fa fa-right-from-bracket mr-4"></span>Keluar</a>
                    </li>
                </ul>
                <!-- Footer -->
                <?php @include($footerFile); ?>
                <!-- Footer -->
            </article>
        </nav>
        <!-- Page Content  -->
        <section id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-5">Dashboard Admin</h2>
            <?php @include($alertFile); ?>
            <section class="row">
                <article class="col-md-3">
                    <article class="card text-white bg-primary mb-3">
                        <article class="card-header">Pengajuan Masuk</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_masuk; ?></h5>
                        </article>
                    </article>
                </article>
                <article class="col-md-3">
                    <article class="card text-white bg-warning mb-3">
                        <article class="card-header">Sedang Diproses</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_diproses; ?></h5>
                        </article>
                    </article>
                </article>
                <article class="col-md-3">
                    <article class="card text-white bg-success mb-3">
                        <article class="card-header">Selesai</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_selesai; ?></h5>
                        </article>
                    </article>
                </article>
                <article class="col-md-3">
                    <article class="card text-white bg-danger mb-3">
                        <article class="card-header">Total Pengajuan</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_total; ?></h5>
                        </article>
                    </article>
                </article>
            </section>
            <section class="row mt-4 g-3">
                <!-- Notifikasi Terbaru -->
                <article class="col-md-8">
                    <article class="card">
                        <article class="card-header d-flex justify-content-between align-items-center">
                            <span>Log Aktivitas</span>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#allNotificationsModal">
                                Lihat Semua
                            </button>
                        </article>
                        <article class="card-body">
                            <ul>
                                <?php while ($notifikasi = $result_notifikasi->fetch_assoc()) { ?>
                                    <li><?php echo $notifikasi['pesan'] . " pada " . $notifikasi['created_at']; ?></li>
                                <?php } ?>
                            </ul>
                        </article>
                    </article>
                </article>
                <!-- Statistik Pengguna -->
                <aside class="col-md-4">
                    <article class="card">
                        <article class="card-header">Statistik Pengguna</article>
                        <article class="card-body">
                            <p>Sedang aktif : <?php echo $total_pengguna_aktif; ?> <i
                                    class="fa-solid fa-circle align-middle"
                                    style="color: #45C734; font-size:0.8rem; font-align:center"></i></p>
                            <p>Pengguna baru: <?php echo $total_pengguna_baru; ?></p>
                            <p>Jumlah pengguna : <?php echo $total_pengguna; ?></p>
                        </article>
                    </article>
                </aside>
            </section>
        </section>
        <!-- Modal untuk menampilkan semua notifikasi -->
        <article class="modal fade" id="allNotificationsModal" tabindex="-1"
            aria-labelledby="allNotificationsModalLabel" aria-hidden="true">
            <article class="modal-dialog modal-lg modal-dialog-scrollable">
                <article class="modal-content">
                    <article class="modal-header">
                        <h5 class="modal-title" id="allNotificationsModalLabel">Log Aktivitas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </article>
                    <article class="modal-body">
                        <ul>
                            <?php
                            // Reset result set pointer dan ambil notifikasi lagi untuk modal
                            $modal_notifikasi->data_seek(0);
                            while ($notifikasi = $modal_notifikasi->fetch_assoc()) { ?>
                                <li><?php echo $notifikasi['pesan'] . " pada " . $notifikasi['created_at']; ?></li>
                            <?php } ?>
                        </ul>
                    </article>
                    <article class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </article>
                </article>
            </article>
        </article>
        <div class="modal fade" id="logoutModal" aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-light px-1 mx-5">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetPasswordModalLabel">Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-block" id="firstStepModal">
                        <p>Anda yakin ingin keluar ?</p>
                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <a href="../proses/logout.php" type="button"
                                    class="button-3 d-grid text-white preload-link" style="background-color:grey"
                                    data-bs-dismiss="modal" aria-label="Close">Keluar</a>
                            </div>
                            <div class="col-md-6">
                                <a type="button" class="button-3 d-grid text-white" data-bs-dismiss="modal"
                                    aria-label="Close">Tidak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>