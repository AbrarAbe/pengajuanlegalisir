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

$navbarFile = 'components/navbar_index.html';
$headFile = 'components/head_index.html';
$alertFile = 'components/alert.html';

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <title>E-Legalisir</title>
</head>

<body class="bg-custom-green">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container position-absolute top-50 start-50 translate-middle">
        <section class="row gx-lg-5 align-items-center">
            <article class="container px-5 mb-lg-0 py-5">
                <header>
                    <h1 class="mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Pesan Legalisir ijazah anda <span style="color: hsl(218, 43%, 45%);">dari rumah</span>
                    </h1>
                </header>
                <p>
                    Aplikasi Legalisir Ijazah dan Transkrip Akademik adalah fasilitas website
                    yang disediakan untuk keperluan legalisir di Universitas Muhammadiyah Bengkulu.<br>
                    Dapatkan legalisir anda kapanpun dan dimanapun <span style="color: hsl(218, 49%, 35%)">tanpa keluar
                        rumah!</span>
                    <br />Tertarik untuk mencoba? Yuk segera daftar!
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
    <!-- Footer -->
    <footer class="container-fluid bg-glass position-absolute top-100 transform-bottom text-center py-4">
        <!-- Grid container -->
        <div class="container">

            <!-- Section: Text -->
            <section class="mb-4">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                    distinctio earum repellat quaerat voluptatibus placeat nam,
                    commodi optio pariatur est quia magnam eum harum corrupti dicta,
                    aliquam sequi voluptate quas.
                </p>
            </section>

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2024 Copyright:
                <a class="text-light" href="https://ft.umb.ac.id/">Fakultas Teknik UMB</a>
            </div>
            <!-- Copyright -->

    </footer>
    <!-- Footer -->
</body>

</html>