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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrasi Alumni</title>
</head>

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
    <title>Registrasi Alumni</title>
</head>

<body class="background-radial-gradient">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <header>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top mask-custom shadow-0">
            <nav class="container-fluid">
                <a class="navbar-brand" href="../index.php"><span style="color: #2FDAD1;">E-</span>Legalisir</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <nav class="collapse navbar-collapse" id="navbarSupportedContent">
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
                </nav>
            </nav>
        </nav>
    </header>

    <!-- Section: Design Block -->
    <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5 vh-100">
        <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
        <section id="radius-shape-3" class="position-absolute shadow-5-strong" style="z-index: -1"></section>
        <section class="row gx-lg-5 align-items-center">
            <section class="col-lg-6 mb-4 mb-lg-0">
                <header>
                    <h1 class="mb-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Pesan Legalisir ijazah <br /> anda <span style="color: hsl(218, 81%, 75%)">dari rumah</span>
                    </h1>
                </header>
                <article>
                    <p class="opacity-70" style="color: hsl(218, 81%, 85%)">
                        Aplikasi Legalisir Ijazah dan Transkrip Akademik adalah fasilitas website
                        yang disediakan untuk keperluan legalisir di Universitas Muhammadiyah Bengkulu.<br>
                        Dapatkan legalisir anda <span style="color: hsl(218, 85%, 62%)">kapanpun dan dimanapun</span>
                        tanpa keluar rumah!
                        <br />Tertarik untuk mencoba? Yuk segera daftar!
                    </p>
                </article>
            </section>

            <!--Register Card-->
            <section class="col-lg-6 mb-5 mb-lg-0 position-relative my-4">
                <article class="card bg-glass">
                    <article class="card-body px-4 py-5 px-md-5">
                        <form action="" method="post">
                            <header class="form-outline mb-4">
                                <label class="form-label form-label-white letter-spacing d-flex"><span
                                        style="font-size: 1.5rem;">Daftarkan akun anda</span></label>
                            </header>
                            <!-- Username input -->
                            <article class="form-outline mb-2">
                                <label class="form-label form-label-white letter-spacing d-flex" for="username">Username
                                    :</label>
                                <input type="username" id="username" name="username" class="form-control input-glass"
                                    required />
                            </article>
                            <!-- Email input -->
                            <article class="form-outline mb-2">
                                <label class="form-label form-label-white letter-spacing d-flex" for="username">Email
                                    :</label>
                                <input type="email" id="email" name="email" class="form-control input-glass" required />
                            </article>
                            <!-- Password input -->
                            <article class="form-outline">
                                <label class="form-label form-label-white letter-spacing d-flex" for="password">Password
                                    :</label>
                                <input type="password" id="password" name="password" class="form-control input-glass"
                                    aria-describedby="passwordHelpBlock" required>
                            </article>
                            <article id="passwordHelpBlock" class="form-text mb-4 d-flex" style="color:whitesmoke;">
                                Must be 8-20 characters long.
                            </article>
                            <!-- Submit button -->
                            <article class="d-grid gap-2">
                                <button type="submit" name="submit"
                                    class="btn btn-primary btn-block mb-4">Register</button>
                            </article>

                            <?php
                            include '../config.php';

                            if (isset($_POST['submit'])) {
                                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                                $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
                                $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
                            
                                $sql = "SELECT * FROM User WHERE email = ?";
                                if ($stmt = $conn->prepare($sql)) {
                                    $stmt->bind_param("s", $email);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if ($result->num_rows > 0) {
                                        echo '<article class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Email sudah ada !</strong> <a href="login_alumni.php">Masuk</a> atau gunakan email lain.
                                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </article>';
                                    } else {
                                        $stmt = $conn->prepare("INSERT INTO User (username, email, password, role) VALUES (?, ?, ?, 'alumni')");
                                        $stmt->bind_param("sss", $username, $email, $password);
                                        if ($stmt->execute()) {
                                            echo '<article class="alert alert-success alert-dismissible fade show" role="alert">
                                                          <strong>Berhasil !</strong> Akun anda berhasil terdaftar! Anda dapat <a href="login_alumni.php">login</a> sekarang.
                                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </article>';
                                        } else {
                                            echo '<article class="alert alert-danger alert-dismissible fade show" role="alert">
                                                          <strong>Gagal !</strong> Gagal daftar akun. Harap ulangi lagi.
                                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </article>';
                                        }
                                    }
                                }
                                $stmt->close();
                            }
                            ?>

                        </form>
                    </article>
                </article>
            </section>
        </section>
    </main>
</body>

</html>