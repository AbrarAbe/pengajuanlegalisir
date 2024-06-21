<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login_alumni.php");
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
    <title>Beranda Alumni</title>
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
    <title>Beranda Alumni</title>
    <script>
        function updateTotal() {
            const legalisirIjazah = parseInt(document.getElementById('jumlah_legalisir_ijazah').value) || 0;
            const legalisirTranskrip = parseInt(document.getElementById('jumlah_legalisir_transkrip').value) || 0;
            const ekspedisi = parseInt(document.getElementById('ekspedisi_pengiriman').value) || 0;

            const hargaIjazah = 10000; // Misalnya harga per legalisir ijazah adalah 10.000
            const hargaTranskrip = 5000; // Misalnya harga per legalisir transkrip adalah 5.000

            const totalHarga = (legalisirIjazah * hargaIjazah) + (legalisirTranskrip * hargaTranskrip) + ekspedisi;

            document.getElementById('total_harga').innerText = totalHarga;
            document.getElementById('total_harga_input').value = totalHarga; // Update hidden input value
        }

        function toggleEkspedisi() {
            const metode = document.querySelector('input[name="metode_pengambilan"]:checked').value;
            const ekspedisiArticle = document.getElementById('ekspedisi_article');
            ekspedisiArticle.style.display = metode === 'kirim ke alamat' ? 'block' : 'none';
        }
    </script>
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
        <section class="card bg-glass d-flex mb-3 px-3 py-5">
            <article class="card-body py-1 px-md-5">
                <header class="form-outline mb-4">
                    <label class="form-label form-label-white d-flex" class="form-label form-label-white d-flex">
                        <span style="font-size: 1.5rem;">Form Pengajuan legalisir</span></label>
                </header>
                <form action="../proses/proses_submit_pengajuan.php" method="post" enctype="multipart/form-data">
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="npm">NPM:</label>
                        <input type="text" class="form-control input-glass" id="npm" name="npm" required
                            placeholder="Nomor Pokok Mahasiswa" autofocus>
                    </article>
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="nama">Nama
                            Lengkap:</label>
                        <input type="text" class="form-control input-glass" id="nama" name="nama" required
                            placeholder="Nama Lengkap">
                    </article>
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="tahun_lulus">Tahun
                            Lulus:</label>
                        <input type="text" class="form-control input-glass" id="tahun_lulus" name="tahun_lulus" required
                            placeholder="Ex 20241">
                    </article>
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="email">Email:</label>
                        <input type="email" class="form-control input-glass" id="email" name="email" required
                            placeholder="Ex user@gmail.com">
                    </article>
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="ijazah">Upload Scan Ijazah
                            (PDF):</label>
                        <input type="file" class="form-control input-glass" id="ijazah" name="ijazah" accept=".pdf"
                            required>
                    </article>
                    <article class="form-outline mb-3">
                        <label class="form-label form-label-white d-flex" for="transkrip">Upload
                            Transkrip (PDF):</label>
                        <input type="file" class="form-control input-glass" id="transkrip" name="transkrip"
                            accept=".pdf">
                    </article>

                    <article class="form-outline mb-3 d-flex">
                        <input type="radio" class="btn-check" name="metode_pengambilan" id="ambil" autocomplete="off"
                            checked value="ambil di prodi" onchange="toggleEkspedisi()">
                        <label class="btn form-label-white" style="color:white;" for="ambil">Ambil di
                            prodi</label>
                        <input type="radio" class="btn-check" name="metode_pengambilan" id="kirim" autocomplete="off"
                            value="kirim ke alamat" onchange="toggleEkspedisi()">
                        <label class="btn" style="color:white;" for="kirim">Kirim ke alamat</label>
                    </article>
                    <article id="ekspedisi_article" style="display: none;">
                        <article class="form-outline mb-2">
                            <label class="form-label form-label-white d-flex" for="alamat_pengiriman">Alamat
                                Pengiriman:</label>
                            <textarea class="form-control input-glass" id="alamat_pengiriman" name="alamat_pengiriman"
                                rows="4" required placeholder="Alamat Lengkap"></textarea>
                        </article>
                        <article class="form-outline mb-2">
                            <label class="form-label form-label-white d-flex" for="ekspedisi_pengiriman">Pilihan
                                Ekspedisi Pengiriman:</label>
                            <select class="form-control input-glass" id="ekspedisi_pengiriman"
                                name="ekspedisi_pengiriman" onchange="updateTotal()">
                                <option value="0">Pilih Ekspedisi</option>
                                <option value="15000">JNE - Rp. 15.000</option>
                                <option value="20000">POS - Rp. 20.000</option>
                                <option value="25000">TIKI - Rp. 25.000</option>
                            </select>
                        </article>
                    </article>
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="jumlah_legalisir_ijazah">Jumlah Legalisir
                            Ijazah:</label>
                        <input type="number" class="form-control input-glass" id="jumlah_legalisir_ijazah"
                            name="jumlah_legalisir_ijazah" required oninput="updateTotal()">
                    </article>
                    <article class="form-outline mb-3">
                        <label class="form-label form-label-white d-flex" for="jumlah_legalisir_transkrip">Jumlah
                            Legalisir Transkrip:</label>
                        <input type="number" class="form-control input-glass" id="jumlah_legalisir_transkrip"
                            name="jumlah_legalisir_transkrip" required oninput="updateTotal()">
                    </article>
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="total_harga">Total
                            Harga:</label>
                        <article class="mb-2 d-flex">
                            <label class="form-label d-flex px-1" name="rp" readonly>Rp</label>
                            <label class="form-label" id="total_harga" name="total_harga" readonly>0</la>
                        </article>
                    </article>
                    <article class="form-outline mb-4">
                        <label class="form-label form-label-white d-flex" for="bukti_pembayaran">Upload
                            Bukti Pembayaran (PDF/JPG/PNG):</label>
                        <input type="file" class="form-control input-glass" id="bukti_pembayaran"
                            name="bukti_pembayaran" accept=".pdf, .jpg, .jpeg, .png" required>
                    </article>
                    <article class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Submit</button>
                    </article>
                </form>
            </article>
        </section>
    </main>
</body>

</html>