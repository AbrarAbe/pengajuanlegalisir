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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Status Pengajuan</title>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Aplikasi Pengajuan Legalisir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-sm mt-5">
        <h2>Status Pengajuan</h2>
        <table class=" mt-5 table table-bordered" style="fontsize:0.3rem;">
            <thead>
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
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><a target="frmmenu" href="detail_pengajuan.php?id=<?php echo $row['id_pengajuan']; ?>">Detail</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5 fa fa-align-justify" aria-hidden="true">
        <iframe src="" name="frmmenu" width="100%" height="500vh"></iframe>
    </div>
</body>

</html>