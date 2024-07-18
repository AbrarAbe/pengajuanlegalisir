<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'alumni') {
    header('Location: beranda_alumni.php');
} else if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'staf') {
    header('Location: beranda_staf.php');
} else if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'dekan') {
    header('Location: beranda_dekan.php');
    exit;
}

$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer_default.html';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($scriptsFile); ?>
    <title>Registrasi Admin</title>
</head>

<body class="bg-custom">
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
            <article class="container d-grid p-4">
                <h1><a href="../index.php" class="logo nav-link mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-4">
                    <li>
                        <a href="../index.php" class="nav-link"><span class="fa fa-home mr-4"></span>Beranda</a>
                    </li>
                    <li>
                        <a href="login.php" class="nav-link preload-link"><span
                                class="fa fa-right-to-bracket mr-4"></span>
                            Masuk</a>
                    </li>
                    <li>
                        <a href="register_alumni.php" class="nav-link preload-link"><span
                                class="fa fa-user-plus mr-4"></span>Daftar</a>
                    </li>
                    <li class="active">
                        <a href="register_admin.php" class="nav-link"><span class="fa fa-user-plus mr-4"></span>Daftar
                            Admin</a>
                    </li>
                </ul>
                <?php @include ($footerFile); ?>
            </article>
        </nav>

        <!-- Section Block -->
        <section class="container d-flex justify-content-center align-items-stretch py-5 px-4">
            <section class="row d-flex justify-content-center align-items-center">
                <article class="col-lg-6 mb-2 mb-lg-0 my-3">
                    <header>
                        <h1 class="mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                            Pesan Legalisir ijazah <br /> anda <span style="color: hsl(218, 81%, 75%)">dari rumah</span>
                        </h1>
                    </header>
                    <p>
                        Aplikasi Legalisir Ijazah dan Transkrip Akademik adalah fasilitas website
                        yang disediakan untuk keperluan legalisir di Universitas Muhammadiyah Bengkulu.
                        Dapatkan legalisir anda <span style="color: hsl(218, 85%, 62%)">kapanpun dan dimanapun</span>
                        tanpa keluar rumah!<br>
                        <br />Tertarik untuk mencoba? Yuk segera daftar!
                    </p>
                </article>

                <!--Register Card-->
                <aside class="col-lg-6 mb-5 mb-lg-0" style="font-size:0.8rem">
                    <article class="custom-card bg-glass-dark">
                        <article class="card-body px-4 py-5 px-md-5">
                            <form action="../proses/proses_register_admin.php" method="post">
                                <header class="form-outline mb-4">
                                    <label class="form-label form-label-white letter-spacing d-flex"><span
                                            style="font-size: 1.5rem;">Daftarkan akun anda</span></label>
                                </header>
                                <!-- Username input -->
                                <article class="form-outline mb-2">
                                    <label class="form-label form-label-white letter-spacing d-flex"
                                        for="username">Username
                                        :</label>
                                    <article class="input-group">
                                        <span class="input-group-text input-glass" id="iconuser"><i
                                                class="nf nf-oct-person_fill"></i></span>
                                        <input type="text" id="username" name="username"
                                            class="form-control input-glass" required />
                                    </article>
                                </article>
                                <!-- Email input -->
                                <article class="form-outline mb-3">
                                    <label class="form-label form-label-white letter-spacing d-flex"
                                        for="username">Email
                                        :</label>
                                    <article class="input-group">
                                        <span class="input-group-text input-glass" id="iconemail">@</span>
                                        <input type="email" id="email" name="email" class="form-control input-glass"
                                            required />
                                    </article>
                                </article>
                                <!-- Role input -->
                                <article class="form-outline mb-2 d-flex gap-2">
                                    <input type="radio" class="btn-check" name="role" id="option1" autocomplete="off"
                                        checked value="staf">
                                    <label class="btn" for="option1" style="font-size:0.8rem">Staf</label>
                                    <input type="radio" class="btn-check" name="role" id="option2" autocomplete="off"
                                        value="dekan">
                                    <label class="btn" for="option2" style="font-size:0.8rem">Dekan/Wakil</label>
                                </article>
                                <!-- Password input -->
                                <article class="form-outline mb-2">
                                    <label class="form-label letter-spacing d-flex" for="password">Password
                                        :</label>
                                    <article class="input-group">
                                        <input type="password" id="password" name="password"
                                            class="form-control input-glass" aria-describedby="passwordHelpBlock"
                                            pattern=".{8,}" required>
                                        <a class="input-group-text input-glass" style="text-decoration:none"
                                            onclick="showPass()">
                                            <i id="toggleIcon" class="nf nf-fa-eye_slash"></i>
                                        </a>
                                    </article>
                                </article>
                                <article id="passwordHelpBlock" class="col-auto form-text mb-3 d-flex"
                                    style="color:whitesmoke;">
                                    Must be 8-20 characters long.
                                </article>
                                <!-- Checkbox -->
                                <article class="form-check d-flex mb-4">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="checkbox"
                                        unchecked required />
                                    <label class="form-check-label form-label-white d-flex" for="checkbox">
                                        Dengan mendaftar anda menyetujui syarat dan ketentuan yang berlaku
                                    </label>
                                </article>
                                <!-- Submit button -->
                                <article class="d-grid gap-2">
                                    <button id="submit" type="submit" name="submit" id="submitBtn"
                                        class="preload-submit button-3 mb-3">Daftar</button>
                                </article>
                                <!-- Redirect -->
                                <article id="redirect" class="form-outline mb-2 d-flex justify-content-center">
                                    <label class="form-label d-flex mr-1 " for="alamat">Sudah Punya Akun ?</label>
                                    <a href="login.php" style="text-decoration:none;">Login
                                        disini</a>
                                </article>
                            </form>
                            <?php @include ($alertFile); ?>
                        </article>
                    </article>
                </aside>
            </section>
        </section>
    </main>
</body>

</html>