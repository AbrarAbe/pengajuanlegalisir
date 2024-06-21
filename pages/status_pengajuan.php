<?php
session_start();
include '../config.php';

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login_alumni.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$stmt = $conn->prepare("SELECT * FROM Pengajuan WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

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
    <title>Status Pengajuan</title>
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
                            <a class="nav-link" href="form_pengajuan.php">Form Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="status_pengajuan.php">Status Pengajuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../proses/logout.php">Logout</a>
                        </li>
                    </ul>
                </nav>
            </nav>
        </nav>
    </header>

    <!-- Section: Design Block -->
    <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
        <section id="radius-shape-3" class="position-absolute shadow-5-strong"></section>
        <section class="card bg-glass d-flex mb-3 px-3 py-4">
            <article class="card-body py-1 px-md-5">
                <header class="form-outline mb-3">
                    <label class="form-label form-label-white d-flex" class="form-label form-label-white d-flex">
                        <span style="font-size: 1.5rem;">Status Pengajuan legalisir</span></label>
                </header>
                <div class="table-responsive">
                    <table class="mt-4 table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th>Nama</th>
                                <th>Metode Pengambilan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($row['metode_pengambilan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['id_status']); ?></td>
                                    <td><a target="frmmenu"
                                            href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>">Detail</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <article aria-hidden="true">
                <iframe src="" name="frmmenu" width="100%" height="600vh"></iframe>
            </article>
            </article> 
        </section>
    </main>
</body>

</html>