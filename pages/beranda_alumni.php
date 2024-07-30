<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
	header("Location: login.php");
	exit;
}

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

// Query untuk mendapatkan notifikasi yang terkait dengan pengguna yang sedang login
$query_notifikasi = "
    SELECT n.pesan, n.created_at 
    FROM notifikasi n
    JOIN pengajuan p ON n.id_pengajuan = p.id_pengajuan
    WHERE p.id_user = ? 
    ORDER BY n.created_at DESC 
    LIMIT 5
";
$total_notifikasi = "
    SELECT n.pesan, n.created_at 
    FROM notifikasi n
    JOIN pengajuan p ON n.id_pengajuan = p.id_pengajuan
    WHERE p.id_user = ? 
    ORDER BY n.created_at DESC
";
$id_user = $_SESSION['id_user'];
if ($stmt = $conn->prepare($query_notifikasi)) {
	$stmt->bind_param("i", $id_user);
	$stmt->execute();
	$result_notifikasi = $stmt->get_result();
	$stmt->close();
} else {
	echo "Error: " . $conn->error;
}
if ($stmt = $conn->prepare($total_notifikasi)) {
	$stmt->bind_param("i", $id_user);
	$stmt->execute();
	$modal_notifikasi = $stmt->get_result();
	$stmt->close();
} else {
	echo "Error: " . $conn->error;
}

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
	<title>Informasi</title>
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
						<article class="card-header d-flex justify-content-between align-items-center">
							<span>Informasi Pengajuan Anda</span>
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
						<h5 class="modal-title" id="allNotificationsModalLabel">Informasi Pengajuan</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</article>
					<article class="modal-body">
						<ul>
							<?php while ($notifikasi = $modal_notifikasi->fetch_assoc()) { ?>
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
	</main>
</body>

</html>