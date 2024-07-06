<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login.php");
    exit;
}

$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$scriptsFile = '../components/scripts.html';
$footerFile = '../components/footer.html';
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <?php @include ($headFile); ?>
    <?php @include ($scriptsFile); ?>
    <title>Beranda</title>
</head>

<body>
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <nav id="sidebar" class="nav-bg">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="container d-grid p-4 position-fixed" style="max-width: 270px">
                <h1><a href="../index.php" class="logo nav-link mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="beranda_alumni.php" class="nav-link"><span class="fa fa-home mr-4"></span>Home</a>
                    </li>
                    <li class="active">
                        <a href="form_pengajuan.php" class="nav-link"><span class="fa fa-id-card mr-4"></span>Form
                            Pengajuan</a>
                    </li>
                    <li>
                        <a href="status_pengajuan.php" class="nav-link preload-link"><span
                                class="fa fa-chart-simple mr-4"></span> Status Pengajuan</a>
                    </li>
                    <li>
                        <a href="login.php" class="nav-link preload-link"><span
                                class="fa fa-solid fa-gear mr-4"></span>Pengaturan</a>
                    </li>
                    <li>
                        <a href="../proses/logout.php" class="nav-link preload-link"><span
                                class="fa fa-right-from-bracket mr-4"></span>Logout</a>
                    </li>
                </ul>
                <!-- Footer -->
                <?php @include ($footerFile); ?>
                <!-- Footer -->
            </div>
        </nav>
        <!-- Page Content  -->
        <section id="content" class="p-4 p-md-5 pt-5">
            <?php @include ($alertFile); ?>
            <h2 class="mb-4">Form Pengajuan Legalisir</h2>
            <!-- Form -->
            <form action="../proses/proses_submit_pengajuan.php" method="post" enctype="multipart/form-data"
                class="poppins">

                <!-- NPM -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="npm">NPM :</label>
                    <input type="text" class="form-control" id="npm" name="npm" required
                        placeholder="Nomor Pokok Mahasiswa" autofocus>
                </article>

                <!-- Nama -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="nama">Nama
                        Lengkap :</label>
                    <input type="text" class="form-control" id="nama" name="nama" required placeholder="Nama Lengkap">
                </article>

                <!-- Prodi -->
                <label class="form-label d-flex" for="prodi">Program Studi :</label>
                <article class="form-outline mb-2 d-flex gap-2">
                    <input type="radio" class="btn-check" name="prodi" id="option1" autocomplete="off" checked
                        value="Teknik Informatika">
                    <label class="btn" for="option1">Teknik
                        Informatika</label>
                    <input type="radio" class="btn-check" name="prodi" id="option2" autocomplete="off"
                        value="Sistem Informasi">
                    <label class="btn" for="option2">Sistem Informasi</label>
                    <input type="radio" class="btn-check" name="prodi" id="option3" autocomplete="off"
                        value="Arsitektur">
                    <label class="btn" for="option3">Arsitektur</label>
                </article>

                <!-- Tahun Lulus -->
                <article class="form-outline mb-3">
                    <label for="tahun_lulus" class="form-label d-flex">Tahun Lulus</label>
                    <input type="text" class="form-control" list="tahunList" id="tahun_lulus" name="tahun_lulus"
                        placeholder="Ex 20241" required>
                    <datalist id="tahunList">
                        <option value="20242">
                        <option value="20241">
                        <option value="20232">
                        <option value="20231">
                        <option value="20222">
                        <option value="20221">
                    </datalist>
                </article>

                <!-- Email -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        placeholder="Ex user@gmail.com">
                </article>

                <!-- Ijazah -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="ijazah">Upload Scan Ijazah
                        (PDF) :</label>
                    <input type="file" class="form-control" id="ijazah" name="ijazah" accept=".pdf" required>
                </article>

                <!-- Transkrip -->
                <article class="form-outline mb-4">
                    <label class="form-label d-flex" for="transkrip">Upload
                        Transkrip (PDF) :</label>
                    <input type="file" class="form-control" id="transkrip" name="transkrip" accept=".pdf">
                </article>

                <!-- Metode Pengambilan -->
                <article class="form-outline mb-2 d-flex gap-2">
                    <input type="radio" class="btn-check" name="metode_pengambilan" id="ambil" autocomplete="off"
                        checked value="ambil di prodi" onchange="toggleEkspedisi()">
                    <label class="btn" for="ambil">Ambil di
                        prodi 📦</label>
                    <input type="radio" class="btn-check" name="metode_pengambilan" id="kirim" autocomplete="off"
                        value="kirim ke alamat" onchange="toggleEkspedisi()">
                    <label class="btn" for="kirim">Kirim ke alamat ✈️</label>
                </article>
                <article id="ekspedisi_article" style="display : none;">

                    <!-- Alamat -->
                    <article class="form-outline mb-3">
                        <label class="form-label d-flex" for="alamat">Alamat
                            Pengiriman :</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="4"
                            placeholder="Alamat Lengkap"></textarea>
                    </article>

                    <!-- Expedisi -->
                    <label class="form-label d-flex">Pilihan
                        Ekspedisi Pengiriman :</label>
                    <article class="form-outline mb-3 d-flex gap-2">
                        <input type="radio" class="btn-check" name="ekspedisi" id="jne" value="JNE" data-harga="15000"
                            checked onchange="updateTotal()">
                        <label class="btn" for="jne">JNE - Rp.
                            25.000</label>
                        <input type="radio" class="btn-check" name="ekspedisi" id="pos" value="POS" data-harga="20000"
                            onchange="updateTotal()">
                        <label class="btn" for="pos">POS - Rp.
                            20.000</label>
                        <input type="radio" class="btn-check" name="ekspedisi" id="JNT" value="JNT" data-harga="25000"
                            onchange="updateTotal()">
                        <label class="btn" for="JNT">JNT - Rp.
                            35.000</label>
                    </article>
                </article>

                <!-- Jumlah Legalisir Ijazah -->
                <input type="hidden" id="ekspedisi_harga_input" name="ekspedisi_harga" value="0">
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="jumlah_legalisir_ijazah">Jumlah
                        Legalisir
                        Ijazah :</label>
                    <input type="number" class="form-control" id="jumlah_legalisir_ijazah"
                        name="jumlah_legalisir_ijazah" min="1" required oninput="checkNegative(this); updateTotal()">
                </article>

                <!-- Jumlah Legalisir Transkrip -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="jumlah_legalisir_transkrip">Jumlah
                        Legalisir Transkrip :</label>
                    <input type="number" class="form-control" id="jumlah_legalisir_transkrip"
                        name="jumlah_legalisir_transkrip" min="1" required oninput="checkNegative(this); updateTotal()">
                </article>

                <!-- Total Harga -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="total_harga">Total Harga :</label>
                    <p class="d-flex">Rp. <span class="d-flex" id="total_harga">0</span></p>
                    <input type="hidden" id="total_harga_input" name="total_harga" value="0">
                </article>

                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="bukti_pembayaran">Nomor Rekening
                        Fakultas
                        Teknik :</label>
                    <article class="card d-flex justify-content-center align-items-center" style="height:75px">
                        Placeholder</article>
                </article>

                <!-- Bukti Pembayaran -->
                <article class="form-outline mb-5">
                    <label class="form-label d-flex" for="bukti_pembayaran">Upload
                        Bukti Pembayaran (PDF/JPG/PNG) :</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                        accept=".jpg, .jpeg, .png, .hevc" required>
                </article>
                <article class="d-grid">
                    <button type="submit" name="submit" id="submitBtn" class="preload-submit button-82-pushable"
                        role="button">
                        <span class="button-82-shadow"></span>
                        <span class="button-82-edge"></span>
                        <span class="button-82-front text">
                            Submit
                        </span>
                    </button>
                </article>
            </form>
        </section>
    </main>
</body>

</html>