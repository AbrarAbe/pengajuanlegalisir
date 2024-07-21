<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'dekan') {
	header("Location: login.php");
	exit;
}

include '../config.php';

// Query untuk menghitung jumlah pengajuan
$query_masuk = "SELECT COUNT(*) as total_masuk FROM pengajuan WHERE id_status IN (2)";
$query_disahkan = "SELECT COUNT(*) as total_disahkan FROM pengajuan WHERE id_status IN (3)";
$query_selesai = "SELECT COUNT(*) as total_selesai FROM pengajuan WHERE id_status IN (4)";
$query_ditolak = "SELECT COUNT(*) as total_ditolak FROM pengajuan WHERE id_status IN (5)";

$result_masuk = $conn->query($query_masuk);
$result_disahkan = $conn->query($query_disahkan);
$result_selesai = $conn->query($query_selesai);
$result_ditolak = $conn->query($query_ditolak);

$total_masuk = $result_masuk->fetch_assoc()['total_masuk'];
$total_disahkan = $result_disahkan->fetch_assoc()['total_disahkan'];
$total_selesai = $result_selesai->fetch_assoc()['total_selesai'];
$total_ditolak = $result_ditolak->fetch_assoc()['total_ditolak'];

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
$query_notifikasi = "SELECT * FROM notifikasi ORDER BY created_at DESC LIMIT 10";
$result_notifikasi = $conn->query($query_notifikasi);

$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer.html';
$themeFile = '../components/theme.html';
?>

<!doctype html>
<html lang="en">

<head>
	<?php @include ($headFile); ?>
	<?php @include ($scriptsFile); ?>
	<?php @include ($themeFile); ?>
	<title>Beranda</title>
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
					<li class="active">
						<a href="beranda_dekan.php" class="nav-link"><span class="fa fa-home mr-4"></span>Dashboard</a>
					</li>
					<li>
						<a href="list_pengajuan_dekan.php" class="nav-link preload-link"><span
								class="fa fa-id-card mr-4"></span>List Pengesahan</a>
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
            <h2 class="mb-5">Dashboard Dekan</h2>
            <?php @include ($alertFile); ?>
            <section class="row">
                <article class="col-md-3">
                    <article class="card text-white bg-primary mb-3">
                        <article class="card-header">Belum Disahkan</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_masuk; ?></h5>
                        </article>
                    </article>
                </article>
                <article class="col-md-3">
                    <article class="card text-white bg-warning mb-3">
                        <article class="card-header">Sudah Disahkan</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_disahkan; ?></h5>
                        </article>
                    </article>
                </article>
                <article class="col-md-3">
                    <article class="card text-white bg-danger mb-3">
                        <article class="card-header">Ditolak</article>
                        <article class="card-body">
                            <h5 class="card-title"><?php echo $total_ditolak; ?></h5>
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
            </section>
            <section class="row mt-4 g-3">
                <!-- Notifikasi Terbaru -->
                <article class="col-md-8">
                    <article class="card">
                        <article class="card-header">Notifikasi Terbaru</article>
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
	</main>
</body>

</html>