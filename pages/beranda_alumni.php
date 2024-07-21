<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
	header("Location: login.php");
	exit;
}

include '../config.php';

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
						<a href="beranda_alumni.php" class="nav-link"><span class="fa fa-home mr-4"></span>Beranda</a>
					</li>
					<li>
						<a href="form_pengajuan.php" class="nav-link preload-link"><span
								class="fa fa-id-card mr-4"></span>Form Pengajuan</a>
					</li>
					<li>
						<a href="status_pengajuan.php" class="nav-link preload-link"><span
								class="fa fa-chart-simple mr-4"></span> Status Pengajuan</a>
					</li>
					<li>
						<a id="theme-toggle" class="nav-link"><span id="theme-icon" class="fa fa-sun mr-4"></span>Ganti
							Tema</a>
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
			<h2 class="mb-4">Beranda</h2>
			<?php @include ($alertFile); ?>
			<article class="container px-5 mb-lg-0 py-5 justify-content-center">
				<h1 class="text-center">Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
			</article>
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