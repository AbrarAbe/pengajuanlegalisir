<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login_alumni.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$footerFile = '../components/footer.html';
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
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <title>Beranda Alumni</title>
</head>

<body class="background-radial-gradient">
    <section id="preloaderLink" class="preloader d-flex">
        <article class="loader"></article>
    </section>
    </section>
    <main>
        <header>
            <!-- Navbar -->
            <?php @include ($navbarFile); ?>
        </header>
        <!-- Section: Design Block -->
        <main class="container justify-content-center align-items-center d-flex vh-100 py-5">
            <section class="row gx-lg-5 align-items-center">
                <article class="container px-5 mb-lg-0 py-5 justify-content-center">
                    <h1 class="text-center">Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
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
        <?php @include ($footerFile); ?>
        <!-- Footer -->
</body>

</html>