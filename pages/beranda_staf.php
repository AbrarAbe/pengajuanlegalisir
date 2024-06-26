<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'staf') {
    header("Location: login_admin.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
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
    <title>Beranda Staf</title>
</head>

<body class="background-radial-gradient">
    <main>
        <header>
            <!-- Navbar -->
            <?php @include ($navbarFile); ?>
        </header>

        <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 vh-100">
            <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
            <section id="radius-shape-3" class="position-absolute shadow-5-strong" style="z-index: -1"></section>
            <section class="container bg-transparent aria-hidden="true">
                <article>
                    <iframe src="beranda.php" name="frmmenu"></iframe>
                </article>
            </section>
        </main>
    </main>
</body>

</html>