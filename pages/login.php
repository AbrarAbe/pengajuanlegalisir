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
    <?php @include($headFile); ?>
    <?php @include($scriptsFile); ?>
    <title>Login</title>
</head>

<body class="bg-custom">
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <section id="preloaderSubmit" class="preloader-submit">
            <article class="loader"></article>
        </section>
        <nav id="sidebar" class="nav-bg-light" style="min-height:100vh">
            <article class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </article>
            <article class="container d-grid p-4">
                <h1><a href="../index.php" class="logo nav-link cursor-pointer mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-4">
                    <li>
                        <a href="../index.php" class="nav-link cursor-pointer"><span class="fa fa-home mr-4"></span>Beranda</a>
                    </li>
                    <li class="active">
                        <a href="login.php" class="nav-link cursor-pointer"><span class="fa fa-right-to-bracket mr-4"></span>
                            Masuk</a>
                    </li>
                    <li>
                        <a href="register_alumni.php" class="nav-link cursor-pointer preload-link"><span
                                class="fa fa-user-plus mr-4"></span>Daftar</a>
                    </li>
                </ul>
                <?php @include($footerFile); ?>
            </article>
        </nav>

        <!-- Section Block -->
        <section class="container d-flex justify-content-center align-items-center px-5 py-5">
            <section class="custom-card bg-glass-dark mb-3 p-5">
                <article class="row d-flex justify-content-center align-items-center">
                    <figure class="col-5 d-none d-lg-flex justify-content-center mr-3">
                        <img src="../assets/images/umb.png" alt="Trendy Pants and Shoes"
                            class="w-75 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5 px-2" />
                    </figure>
                    <aside class=" col-auto" style="font-size:0.8rem">
                        <form id="loginForm" action="../proses/proses_login.php" method="post">
                            <header class="form-outline mb-4">
                                <label class="form-label form-label-white d-flex letter-spacing">
                                    <span style="font-size: 2rem;">Login</span></label>
                            </header>
                            <!-- Username / Email input -->
                            <article class="form-outline mb-4">
                                <label class="form-label form-label-white d-flex" for="username">Username
                                    atau
                                    email :</label>
                                <article class="input-group">
                                    <span class="input-group-text input-glass" id="iconuser"><i
                                            class="nf nf-oct-person_fill"></i></span>
                                    <input type="text" id="username" name="username" class="form-control input-glass"
                                        autofocus <?php if (isset($_SESSION['email'])) {
                                            echo 'value="' . $_SESSION['email'] . '"';
                                        } ?> />
                                </article>
                            </article>
                            <!-- Password input -->
                            <article class="form-outline mb-4">
                                <label class="form-label form-label-white d-flex" for="password">Password :</label>
                                <article class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control input-glass" aria-describedby="passwordHelpBlock" required>
                                    <a class="input-group-text input-glass" style="text-decoration:none"
                                        onclick="showPass()">
                                        <i id="toggleIcon" class="nf nf-fa-eye_slash"></i>
                                    </a>
                                </article>
                            </article>
                            <article class="row mb-4 d-flex justify-content-center">
                                <!-- Checkbox -->
                                <article class="col-auto">
                                    <article class="form-check">
                                        <form method="POST" action="../proses/ingat_saya.php">
                                            <input class="form-check-input" type="checkbox" id="remember_me"
                                                name="remember_me" unchecked />
                                        </form>
                                        <label class="form-check-label " for="checkbox" style="color:whitesmoke;">
                                            Ingat saya </label>
                                    </article>
                                </article>

                                <!-- Lupa password -->
                                <article class="col-auto">
                                    <a href="" onclick="openModal()" id="openModal" data-bs-toggle="modal"
                                        data-bs-target="#resetPasswordModal" style="text-decoration:none;">Lupa
                                        password?</a>
                                </article>
                            </article>
                            <!-- Submit button -->
                            <article class="d-grid gap-2">
                                <button type="submit" name="submit" id="submitBtn"
                                    class="preload-submit button-3 text-uppercase mb-3">Masuk</button>
                            </article>
                        </form>
                        <!-- Redirect -->
                        <article id="redirect" class="form-outline mb-2 d-flex justify-content-center">
                            <label class="form-label d-flex mr-1 " for="alamat">Belum Punya Akun ?</label>
                            <a href="register_alumni.php" style="text-decoration:none;">Daftar
                                disini</a>
                        </article>
                    </aside>
                    <?php @include($alertFile); ?>
                </article>
            </section>
            <!-- Reset Password Modal -->
            <div class="modal fade" id="resetPasswordModal" aria-labelledby="resetPasswordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-glass-dark px-1 mx-5">
                        <div class="modal-header">
                            <h5 class="modal-title" id="resetPasswordModalLabel">Lupa Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-block" id="firstStepModal">
                            <p>Silakan pilih metode reset password:</p>
                            <a type="button" class="button-3 d-grid text-uppercase mb-2 mt-5"
                                id="openSecondStepModal">Reset melalui
                                email</a>
                            <a href="#" type="button" href="#" class="button-3 text-uppercase text-white d-grid"
                                id="hubungiAdmin" style="background-color:grey">Hubungi Admin</a>
                        </div>
                        <div class="modal-body d-none" id="secondStepModal">
                            <form method="POST">
                                <article class="form-outline mb-4">
                                    <label class="form-label form-label-white d-flex" for="username">
                                        Masukkan alamat email anda :</label>
                                    <article class="input-group">
                                        <span class="input-group-text input-glass" id="iconemail"><i
                                                class="nf nf-oct-email">@</i></span>
                                        <input type="text" id="emailReset" name="emailReset"
                                            class="form-control input-glass" autofocus />
                                    </article>
                                </article>
                                <a href="#" type="submit" name="submitResetViaEmail"
                                    class="button-3 text-uppercase text-white d-grid mb-2 mt-5 text-white"
                                    id="openThirdStepModal">Kirim kode verifikasi</a>
                            </form>
                            <?php

                            //@TODO : proses send otp ke email
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (isset($_POST["submitResetViaEmail"])) {
                                    $emailReset = filter_var($_POST['emailReset'], FILTER_SANITIZE_EMAIL);
                                    $_SESSION["email"] = $emailReset; // Simpan ke sesi
                                    // ... (Kode untuk mengirim kode verifikasi) ...
                                }
                            }
                            ?>
                            <a type="button" class="button-3 text-uppercase d-grid" id="backToFirstModal"
                                style="background-color:grey">Kembali</a>
                        </div>
                        <div class="modal-body d-none" id="thirdStepModal">
                            <article class="form-outline mb-4">
                                <label class="form-label form-label-white d-flex" for="username">Silahkan cek kode OTP
                                    yang dikirim ke email
                                    <?php if (isset($_SESSION['email'])) {
                                        echo $_SESSION['email'];
                                    } {
                                        unset($_SESSION['email']);
                                    } ?> : </label>
                                <label class="form-label form-label-white d-flex" for="username">Masukkan alamat email
                                    Anda: </label>
                                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                                    <input class="m-2 text-center form-control rounded" type="text" id="first"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="second"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="third"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="fourth"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="fifth"
                                        maxlength="1" />
                                    <input class="m-2 text-center form-control rounded" type="text" id="sixth"
                                        maxlength="1" />
                                </div>
                            </article>
                            </article>
                            <a href="#" type="button"
                                class="button-3 text-uppercase text-white d-grid mb-2 mt-5 preload-link text-white"
                                id="sumbmitOTP" data-bs-dismiss="modal" aria-label="Close">Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>