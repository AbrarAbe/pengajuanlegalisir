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
    <title>Login Admin</title>
</head>

<body class="background-radial-gradient">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 vh-100">
        <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
        <section id="radius-shape-3" class="position-absolute shadow-5-strong"></section>
        <section class="card bg-glass mb-3 px-4 py-5">
            <article class="col g-0 d-flex align-items-center">
                <figure class="col-lg-8 d-none d-lg-flex px-2">
                    <img src="../assets/img/pic2.jpg" alt="Trendy Pants and Shoes"
                        class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5 px-4" />
                </figure>
                <aside class="card-body py-4 px-md-4">
                    <form action="../proses/proses_login_admin.php" method="post">
                        <header class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex">
                                <span style="font-size: 2rem;">Login Admin</span></label>
                        </header>
                        <!-- USername / Email input -->
                        <article class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex" for="username">Username
                                atau
                                email :</label>
                            <input type="text" id="username" name="username" class="form-control input-glass"
                                autofocus />
                        </article>
                        <!-- Password input -->
                        <article class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex" for="password">Password
                                :</label>
                            <input type="password" id="password" name="password" class="form-control input-glass" />
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
</body>

</html>