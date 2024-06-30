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
    <title>Login Alumni</title>
</head>

<body class="bg-custom-green">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <section class="custom-card d-flex justify-content-center align-items-center bg-glass-dark mb-3 p-4">
            <article class="container-fluid g-3 d-flex align-items-center">
                <figure class="col-6 d-none d-lg-flex justify-content-center">
                    <img src="../assets/icon/umb.png" alt="Trendy Pants and Shoes"
                        class="w-75 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5 px-2" />
                </figure>
                <aside class="card-body py-4 px-md-4">
                    <form action="../proses/proses_login_alumni.php" method="post">
                        <header class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex">
                                <span style="font-size: 2rem;">Login Alumni</span></label>
                        </header>
                        <!-- Username / Email input -->
                        <article class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex" for="username">Username
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
                            <label class="form-label form-label-white letter-spacing d-flex" for="password">Password
                                :</label>
                            <article class="input-group">
                                <input type="password" id="password" name="password" class="form-control input-glass"
                                    aria-describedby="passwordHelpBlock" required>
                                <a class="input-group-text input-glass" style="text-decoration:none" onclick="apala()">
                                    <i id="toggleIcon" class="nf nf-fa-eye_slash"></i>
                                </a>
                            </article>
                        </article>
                        <!-- 2 column grid layout for inline styling -->
                        <article class="row mb-4">
                            <article class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <article class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox" checked />
                                    <label class="form-check-label " for="checkbox" style="color:whitesmoke;">
                                        Ingat saya </label>
                                </article>
                            </article>
                            <article class="col">
                                <!-- Simple link -->
                                <a href="#!">Lupa password?</a>
                            </article>
                        </article>
                        <!-- Submit button -->
                        <article class="d-grid gap-2">
                            <button type="submit" name="submit" class="button-3 mb-4">Login</button>
                        </article>

                        <?php @include ($alertFile); ?>

                    </form>
                </aside>
            </article>
        </section>
    </main>
    <!-- footer -->
    <?php @include ($footerFile); ?>
    <!-- footer -->
</body>

</html>