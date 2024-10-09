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
$themeFile = '../components/theme.html';
$logoutModalFile = '../components/logout_modal.html';
?>

<!doctype html>
<html lang="en">

<head>
    <?php @include($headFile); ?>
    <?php @include($scriptsFile); ?>
    <?php @include($themeFile); ?>
    <title>Form Pengajuan</title>
</head>

<body>
    <main class="wrapper d-flex align-items-stretch poppins">
        <section id="preloaderLink" class="preloader d-flex">
            <article class="loader"></article>
        </section>
        <nav id="sidebar" class="nav-bg-light">
            <article class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </article>
            <article class="container d-grid p-4 position-fixed" style="max-width: 270px">
                <h1><a href="../index.php" class="logo nav-link mb-1">E-Legalisir <span>Legalisir Ijazah dan
                            Transkrip</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="beranda_alumni.php" class="nav-link"><span class="fa fa-home mr-4"></span>Beranda</a>
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
                        <a id="theme-toggle" class="nav-link"><span id="theme-icon" class="fa fa-sun mr-4"></span>Ganti
                            Tema</a>
                    </li>
                    <li>
                        <a href="" class="nav-link" onclick="openModal()" id="openModal" data-bs-toggle="modal"
                            data-bs-target="#logoutModal"><span class="fa fa-right-from-bracket mr-4"></span>Keluar</a>
                    </li>
                </ul>
                <!-- Footer -->
                <?php @include($footerFile); ?>
                <!-- Footer -->
            </article>
        </nav>
        <!-- Page Content  -->
        <section id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4">Form Pengajuan Legalisir</h2>
            <?php @include($alertFile); ?>
            <!-- Form -->
            <form action="../proses/proses_submit_pengajuan.php" method="post" enctype="multipart/form-data">

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
                    <label for="tahun_lulus" class="form-label d-flex" for="tahun_lulus">Tahun Lulus</label>
                    <input type="number" class="form-control" list="tahunList" id="tahun_lulus" name="tahun_lulus"
                        placeholder="Ex 20241" required>
                    <datalist id="tahunList">
                        <option value="20251">
                        <option value="20242">
                        <option value="20241">
                        <option value="20232">
                        <option value="20231">
                        <option value="20222">
                        <option value="20221">
                    </datalist>
                </article>

                <!-- Email 
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required
                        placeholder="Ex user@gmail.com">
                </article> -->

                <!-- Nomor Telepon -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="phone">Nomor Telp / WhatsApp:</label>
                    <input type="tel" class="form-control" id="phone" name="nomor_telepon" required>
                </article>

                <!-- Ijazah -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="ijazah">Upload Scan Ijazah
                        (PDF) :</label>
                    <input type="file" class="form-control" id="ijazah" name="ijazah" accept=".pdf" required>
                </article>

                <!-- Transkrip -->
                <article class="form-outline mb-4">
                    <label class="form-label d-flex" for="transkrip">Upload Scan
                        Transkrip (PDF) :</label>
                    <input type="file" class="form-control" id="transkrip" name="transkrip" accept=".pdf">
                </article>

                <!-- Metode Pengambilan -->
                <article class="form-outline mb-2 d-flex gap-2">
                    <input type="radio" class="btn-check" name="metode_pengambilan" id="ambil" autocomplete="off"
                        checked value="Ambil di Fakultas" onchange="metodePengiriman()">
                    <label class="btn" for="ambil">Ambil di
                        Fakultas 📦</label>
                    <input type="radio" class="btn-check" name="metode_pengambilan" id="kirim" autocomplete="off"
                        value="COD/Bayar di Tempat" onchange="metodePengiriman()">
                    <label class="btn" for="kirim">COD ✈️</label>
                </article>

                <!--<article id="hint" class="form-outline mb-3" style="display:none">
                    <label class="form-label d-flex text-danger">*ongkos kirim ditanggung alumni</label>
                </article>-->

                <!-- Jumlah Legalisir Ijazah -->
                <input type="hidden" id="ekspedisi_harga_input" name="ekspedisi_harga" value="0">
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="jumlah_legalisir_ijazah">Jumlah
                        Legalisir
                        Ijazah (Rp5000 per lembar) :</label>
                    <input type="number" class="form-control" id="jumlah_legalisir_ijazah"
                        name="jumlah_legalisir_ijazah" min="1" required oninput="checkNegative(this); updateTotal()">
                </article>

                <!-- Jumlah Legalisir Transkrip -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="jumlah_legalisir_transkrip">Jumlah
                        Legalisir Transkrip (Rp5000 per lembar) :</label>
                    <input type="number" class="form-control" id="jumlah_legalisir_transkrip"
                        name="jumlah_legalisir_transkrip" min="1" required oninput="checkNegative(this); updateTotal()">
                </article>

                <!-- Total Harga -->
                <article class="form-outline mb-3">
                    <label class="form-label d-flex" for="total_harga">Total Harga :</label>
                    <p class="d-flex">Rp<span class="d-flex" id="total_harga">0</span><span id="warningPengiriman"
                            class="text-danger mx-2">*harga belum termasuk ongkos kirim</span>
                    </p>
                    <input type="hidden" id="total_harga_input" name="total_harga" value="0">
                </article>

                <!-- Nomor Rekening -->
                <article id="nomorRekening" class="form-outline mb-3" style="display:block">
                    <label class="form-label d-flex" for="bukti_pembayaran">Nomor Rekening
                        Fakultas
                        Teknik :</label>
                    <article class="card d-flex justify-content-between align-items-center py-3" height="5em"><span
                            class="pb-2">Bank Mega Syariah</span><span class="fw-bold" style="letter-spacing:0.5rem;">
                            2010354847</span></article>
                </article>

                <!-- Bukti Pembayaran -->
                <article id="buktiPembayaran" class="form-outline mb-5" style="display:block">
                    <label class="form-label d-flex" for="bukti_pembayaran">Upload
                        Bukti Pembayaran (JPG/JPEG/PNG) :</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                        accept=".jpg, .jpeg, .png">
                </article>

                <!-- Alamat -->
                <article id="alamatPengiriman" class="form-outline mb-5" style="display:none">
                    <label class="form-label d-flex" for="alamat">Alamat
                        Pengiriman :</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="4"
                        placeholder="Alamat Lengkap"></textarea>
                </article>

                <!-- Submit -->
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
		<?php @include($logoutModalFile); ?>
    </main>
</body>

</html>