<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
	header("Location: login.php");
	exit;
}

$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer.html';
$themeFile = '../components/theme.html';
$logoutModalFile = '../components/logout_modal.html';

include '../config.php';
$query = "SELECT p.*, s.keterangan 
          FROM pengajuan p 
          JOIN status s ON p.id_status = s.id_status 
          WHERE p.id_status IN (3,5) "; // Status 'Disahkan' (3), 'Selesai' (5)
$result = mysqli_query($conn, $query);
?>

<!doctype html>
<html lang="en">

<head>
	<?php @include($headFile); ?>
	<?php @include($scriptsFile); ?>
	<?php @include($themeFile); ?>
	<title>List Pengajuan</title>
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
						<a href="beranda_staf.php" class="nav-link"><span class="fa fa-home mr-4"></span>Dashboard</a>
					</li>
					<li>
						<a href="list_pengajuan_staf.php" class="nav-link preload-link"><span
								class="fa fa-id-card mr-4"></span>List Pengajuan</a>
					</li>
					<li class="active">
						<a href="list_pengajuan_disahkan.php" class="nav-link"><span
								class="fa fa-file-lines ml-1 mr-4"></span> Legalisir</a>
					</li>
					<li>
						<a id="theme-toggle" class="nav-link"><span id="theme-icon" class="fa fa-sun ml-1 mr-4"></span>
							Ganti Tema</a>
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
			<h2 class="mb-5">Legalisir</h2>
			<?php @include($alertFile); ?>
			<article class="data_table" style="font-size:0.8rem">
				<table id="table-sp" class="table display table-hover table-bordered">
					<thead class="table-primary">
						<tr>
							<th class="text-start">ID</th>
							<th class="text-start">NPM</th>
							<th>Nama</th>
							<th>Prodi</th>
							<th>Pengambilan</th>
							<th>Status</th>
							<th>Detail</th>
						</tr>
					</thead>
					<tbody>
						<?php while ($row = mysqli_fetch_assoc($result)) { ?>
							<tr>
								<td class="text-start"><?php echo $row['id_pengajuan']; ?></td>
								<td class="text-start"><?php echo $row['npm']; ?></td>
								<td><?php echo $row['nama']; ?></td>
								<td><?php echo $row['prodi']; ?></td>
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
									}
									; ?>
								</td>
								<td>
									<article>
										<a href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>" id="detail"
											class="button-4 preload-link px-2 text-nowrap">Lihat
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
		<?php @include($logoutModalFile); ?>
	</main>
</body>

</html>