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

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$footerFile = '../components/footer_default.html';
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
    <title>Registrasi Admin</title>
</head>

<body class="bg-custom-green">
    <section id="preloaderSubmit" class="preloader-submit">
        <article class="loader"></article>
    </section>
    <section id="preloaderLink" class="preloader d-flex">
        <article class="loader"></article>
    </section>
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container d-flex justify-content-center align-items-center vh-100 px-5">
        <section class="row gx-lg-5 d-flex justify-content-center align-items-center py-5">
            <article class="col-lg-5 mb-2 mb-lg-0">
                <header>
                    <h1 class="mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Pesan Legalisir ijazah <br /> anda <span style="color: hsl(218, 81%, 75%)">dari rumah</span>
                    </h1>
                </header>
                <p>
                    Aplikasi Legalisir Ijazah dan Transkrip Akademik adalah fasilitas website
                    yang disediakan untuk keperluan legalisir di Universitas Muhammadiyah Bengkulu.<br>
                    Dapatkan legalisir anda <span style="color: hsl(218, 85%, 62%)">kapanpun dan dimanapun</span>
                    tanpa keluar rumah!
                    <br />Tertarik untuk mencoba? Yuk segera daftar!
                </p>
            </article>

            <!--Register Card-->
            <aside class="col-lg-7 mb-lg-0 my-4">
                <article class="custom-card bg-glass-dark">
                    <article class="card-body px-3 py-4 px-md-5">
                        <form action="../proses/proses_register_admin.php" method="post">
                            <header class="form-outline mb-4">
                                <label class="form-label form-label-white letter-spacing d-flex"><span
                                        style="font-size: 1.5rem;">Daftarkan akun anda</span></label>
                            </header>
                            <!-- Username input -->
                            <article class="form-outline mb-2">
                                <label class="form-label form-label-white letter-spacing d-flex" for="username">Username
                                    :</label>
                                <article class="input-group">
                                    <span class="input-group-text input-glass" id="iconuser"><i
                                            class="nf nf-oct-person_fill"></i></span>
                                    <input type="text" id="username" name="username" class="form-control input-glass"
                                        required />
                                </article>
                            </article>
                            <!-- Email input -->
                            <article class="form-outline mb-2">
                                <label class="form-label form-label-white letter-spacing d-flex" for="username">Email
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
                                <label class="btn form-label-white letter-spacing" style="color:white;"
                                    for="option1">Staf</label>
                                <input type="radio" class="btn-check" name="role" id="option2" autocomplete="off"
                                    value="dekan">
                                <label class="btn" style="color:white;" for="option2">Dekan</label>
                            </article>
                            <!-- Password input -->
                            <article class="form-outline mb-2">
                                <label class="form-label form-label-white letter-spacing d-flex" for="password">Password
                                    :</label>
                                <article class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control input-glass" aria-describedby="passwordHelpBlock" required>
                                    <a class="input-group-text input-glass" style="text-decoration:none"
                                        onclick="apala()">
                                        <i id="toggleIcon" class="nf nf-fa-eye_slash"></i>
                                    </a>
                                </article>
                                <article id="passwordHelpBlock" class="col-auto form-text mb-4 d-flex"
                                    style="color:whitesmoke;">
                                    Must be 8-20 characters long.
                                </article>
                            </article>
                            <!-- Checkbox -->
                            <article class="form-check d-flex mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="checkbox" unchecked
                                    required />
                                <label class="form-check-label form-label-white d-flex" for="checkbox">
                                    engan mendaftar anda menyetujui syarat dan ketentuan yang berlaku
                                </label>
                            </article>
                            <!-- Submit button -->
                            <article class="d-grid gap-2">
                                <button id="submit" type="submit" name="submit" id="submitBtn"
                                    class="preload-submit button-register2 mb-4">Daftar</button>
                            </article>

                            <?php @include ($alertFile); ?>

                        </form>
                    </article>
                </article>
            </aside>
        </section>
    </main>
    <!-- Footer -->
    <?php @include ($footerFile); ?>
    <!-- Footer -->
</body>

</html>