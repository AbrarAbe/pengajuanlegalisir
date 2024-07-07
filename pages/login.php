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
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="container d-grid p-4">
                <h1><a href="../index.php" class="logo nav-link mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-4">
                    <li>
                        <a href="../index.php" class="nav-link"><span class="fa fa-home mr-4"></span>Home</a>
                    </li>
                    <li class="active">
                        <a href="login.php" class="nav-link"><span
                                class="fa fa-right-to-bracket mr-4"></span>
                            Login</a>
                    </li>
                    <li>
                        <a href="register_alumni.php" class="nav-link preload-link"><span
                                class="fa fa-user-plus mr-4"></span>Register</a>
                    </li>
                </ul>
                <?php @include ($footerFile); ?>
            </div>
        </nav>

        <!-- Section Block -->
        <section class="container d-flex justify-content-center align-items-center px-5 py-5">
            <section class="custom-card bg-glass-dark mb-3 p-5">
                <article class="row d-flex justify-content-center align-items-center">
                    <figure class="col-5 d-none d-lg-flex justify-content-center mr-3">
                        <img src="../assets/images/umb.png" alt="Trendy Pants and Shoes"
                            class="w-75 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5 px-2" />
                    </figure>
                    <aside class=" col-auto"  style="font-size:0.8rem">
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
                                        autofocus />
                                </article>
                            </article>
                            <!-- Password input -->
                            <article class="form-outline mb-4">
                                <label class="form-label form-label-white d-flex" for="password">Password
                                    :</label>
                                <article class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control input-glass" aria-describedby="passwordHelpBlock" required>
                                    <a class="input-group-text input-glass" style="text-decoration:none"
                                        onclick="showPass()">
                                        <i id="toggleIcon" class="nf nf-fa-eye_slash"></i>
                                    </a>
                                </article>
                            </article>
                            <!-- 2 column grid layout for inline styling -->
                            <article class="row mb-4">
                                <article class="col-auto d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <article class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkbox"
                                            checked />
                                        <label class="form-check-label " for="checkbox" style="color:whitesmoke;">
                                            Ingat saya </label>
                                    </article>
                                </article>
                                <article class="col-auto ">
                                    <!-- Simple link -->
                                    <a href="#!" style="text-decoration:none;">Lupa password?</a>
                                </article>
                            </article>
                            <!-- Submit button -->
                            <article class="d-grid gap-2">
                                <button type="submit" name="submit" id="submitBtn"
                                    class="preload-submit button-3 mb-4">Login</button>
                            </article>
                        </form>
                    </aside>
                    <?php @include ($alertFile); ?>
                </article>
            </section>
        </section>
    </main>
</body>

</html>