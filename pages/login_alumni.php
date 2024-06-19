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
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/buttons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Alumni</title>
</head>

<body class="background-radial-gradient">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <header>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php"><span style="color: #2FDAD1;">E-</span>Legalisir</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register_alumni.php">Register</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu bg-nav">
                                <li><a class="dropdown-item" href="login_alumni.php">Alumni</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="login_admin.php">Admin</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Section: Design Block -->
    <section class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 vh-100">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-3" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass mb-3 px-4">
            <div class="col g-0 d-flex align-items-center">
                <div class="col-lg-8 d-none d-lg-flex px-2">
                    <img src="../assets/img/pic.png" alt="Trendy Pants and Shoes"
                        class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                </div>
                <div class="card-body py-5 px-md-5">
                    <form action="../proses/proses_login_alumni.php" method="post">
                        <div class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex">
                                <span style="font-size: 2rem;">Login Alumni</span></label>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex" for="username">Username
                                atau
                                email :</label>
                            <input type="text" id="username" name="username" class="form-control input-glass" />
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label form-label-white letter-spacing d-flex" for="password">Password
                                :</label>
                            <input type="password" id="password" name="password" class="form-control input-glass" />
                        </div>
                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox" checked />
                                    <label class="form-check-label " for="checkbox" style="color:whitesmoke;">
                                        Ingat saya </label>
                                </div>
                            </div>
                            <div class="col">
                                <!-- Simple link -->
                                <a href="#!">Lupa password?</a>
                            </div>
                        </div>
                        <!-- Submit button -->
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Login</button>
                        </div>

                        <?php
                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['error_message'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">' . '</button>' . '</div>';
                            unset($_SESSION['error_message']);
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
</body>

</html>