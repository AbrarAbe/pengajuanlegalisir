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
						<a href="beranda_staf.php" class="nav-link"><span class="fa fa-home mr-4"></span>Beranda</a>
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
						<a id="theme-toggle" href="" class="nav-link"><span id="theme-icon"
								class="fa fa-sun ml-1 mr-4"></span>Ganti Tema</a>
					</li>
					<li>
						<a href="../proses/logout.php" class="nav-link preload-link"><span
								class="fa fa-right-from-bracket ml-1 mr-4"></span>Keluar</a>
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
		</section>
	</main>
</body>

</html>