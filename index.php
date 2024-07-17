<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'alumni') {
    header('Location: pages/beranda_alumni.php');
} else if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'staf') {
    header('Location: pages/beranda_staf.php');
} else if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'dekan') {
    header('Location: pages/beranda_dekan.php');
    exit;
}

$headFile = 'components/head_index.html';
$alertFile = 'components/alert.html';
$footerFile = 'components/footer_default.html';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <title>E-Legalisir</title>
</head>

<body class="bg-custom poppins">
    <main class="wrapper d-flex align-items-stretch">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <nav id="sidebar" class="nav-bg-light" style="min-height:100vh">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="container d-grid p-4">
                <h1><a href="index.php" class="logo nav-link mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-4">
                    <li class="active">
                        <a href="index.php" class="nav-link"><span class="fa fa-home mr-4"></span>Beranda</a>
                    </li>
                    <li>
                        <a href="pages/login.php" class="nav-link preload-link"><span
                                class="fa fa-right-to-bracket mr-4"></span>
                            Masuk</a>
                    </li>
                    <li>
                        <a href="pages/register_alumni.php" class="nav-link preload-link"><span
                                class="fa fa-user-plus mr-4"></span>Daftar</a>
                    </li>
                </ul>
                <?php @include ($footerFile); ?>
            </div>
        </nav>

        <!-- Section Block -->
        <section class="container gx-lg-5 d-flex justify-content-center align-items-center">
            <article class="container mb-lg-0">
			<?php @include ($alertFile); ?>
                <header>
                    <h1 class="mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Pesan Legalisir ijazah anda <span style="color: hsl(218, 43%, 45%);">dari rumah</span>
                    </h1>
                </header>
                <p>
                    Aplikasi Legalisir Ijazah dan Transkrip Akademik adalah fasilitas website
                    yang disediakan untuk keperluan legalisir di Universitas Muhammadiyah Bengkulu.<br>
                    Dapatkan legalisir anda kapanpun dan dimanapun <span style="color: hsl(218, 49%, 35%)">tanpa keluar
                        rumah!</span><br>
                    <br />Tertarik untuk mencoba? Yuk segera <a href="pages/register_alumni.php"
                        style="text-decoration: none;">daftar</a>!
                </p>
            </article>
        </section>
        <!--<section class="col g-3 d-flex align-items-center justify-content-center px-5 gap-3">
            <article class="col-sm button-card bg-glass col-sm justify-content-center align-items-center d-flex">
                placeholder
            </article>
            <article class="col-sm button-card bg-glass ol-sm justify-content-center align-items-center d-flex">
                placeholder
            </article>
            <article class="col-sm button-card bg-glass col-sm justify-content-center align-items-center d-flex">
                placeholder
            </article>
        </section>-->
    </main>
</body>

</html>