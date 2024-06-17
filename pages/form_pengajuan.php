<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login_alumni.php");
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Beranda Staf</title>
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
    <div class="container mt-5">
        <h2>Form Pengajuan Legalisir Ijazah dan Transkrip Akademik</h2>
        <form action="../proses/proses_submit_pengajuan.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="npm">NPM:</label>
                <input type="text" class="form-control" name="npm" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tahun_lulus">Tahun Lulus:</label>
                <input type="text" class="form-control" name="tahun_lulus" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="scan_ijazah">Upload Scan Ijazah (PDF):</label>
                <input type="file" class="form-control-file" name="scan_ijazah" accept=".pdf" required>
            </div>
            <div class="form-group">
                <label for="scan_transkrip">Upload Scan Transkrip (PDF):</label>
                <input type="file" class="form-control-file" name="scan_transkrip" accept=".pdf">
            </div>
            <div class="form-group">
                <label for="metode_pengambilan">Metode Pengambilan:</label>
                <select class="form-control" name="metode_pengambilan" required>
                    <option value="ambil ditempat">Ambil di Tempat</option>
                    <option value="dikirim ke alamat">Dikirim ke Alamat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_legalisir_ijazah">Jumlah Legalisir Ijazah (Rp3000 per lembar):</label>
                <input type="number" class="form-control" name="jumlah_legalisir_ijazah" required>
            </div>
            <div class="form-group">
                <label for="jumlah_legalisir_transkrip">Jumlah Legalisir Transkrip (Rp3000 per lembar),-:</label>
                <input type="number" class="form-control" name="jumlah_legalisir_transkrip" required>
            </div>
            <div class="form-group">
                <label for="ekspedisi">Pilihan Ekspedisi:</label>
                <select class="form-control" name="ekspedisi" required>
                    <option value="JNE">JNE</option>
                    <option value="TIKI">TIKI</option>
                    <option value="POS">POS</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="text" class="form-control" name="total_harga" readonly>
            </div>
            <div class="form-group">
                <label for="bukti_pembayaran">Upload Bukti Pembayaran :</label>
                <input type="file" class="form-control-file" name="bukti_pembayaran" accept=".jpg, .png" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-5 fa fa-align-justify" aria-hidden="true">
        <iframe src="" name="frmmenu" width="100%" height="500vh"></iframe>
    </div>
</body>
</html>
