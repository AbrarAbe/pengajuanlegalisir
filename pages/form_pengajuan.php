<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location: login_alumni.php");
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
    <title>Form Pengajuan</title>
</head>

<body class="background-radial-gradient">
    <header>
        <!-- Navbar -->
        <?php @include ($navbarFile); ?>
    </header>

    <!-- Section: Design Block -->
    <main class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <section id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></section>
        <section id="radius-shape-3" class="position-absolute shadow-5-strong"></section>
        <?php @include ($alertFile); ?>
        <section class="card bg-glass d-flex mb-3 px-3 py-5">
            <section class="card-body py-1 px-md-5">
                <header class="form-outline mb-4">
                    <label class="form-label form-label-white d-flex">
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

                    <article class="form-outline mb-3 d-flex gap-2">
                        <input type="radio" class="btn-check" name="metode_pengambilan" id="ambil" autocomplete="off"
                            checked value="ambil di prodi" onchange="toggleEkspedisi()">
                        <label class="btn form-label-white" style="color:white;" for="ambil">Ambil di
                            prodi 📦</label>
                        <input type="radio" class="btn-check" name="metode_pengambilan" id="kirim" autocomplete="off"
                            value="kirim ke alamat" onchange="toggleEkspedisi()">
                        <label class="btn" style="color:white;" for="kirim">Kirim ke alamat ✈️</label>
                    </article>
                    <article id="ekspedisi_article" style="display: none;">
                        <article class="form-outline mb-2">
                            <label class="form-label form-label-white d-flex" for="alamat">Alamat
                                Pengiriman:</label>
                            <textarea class="form-control input-glass" id="alamat" name="alamat" rows="4"
                                placeholder="Alamat Lengkap"></textarea>
                        </article>
                        <label class="form-label form-label-white d-flex">Pilihan
                            Ekspedisi Pengiriman:</label>
                        <article class="form-outline mb-3 d-flex gap-2">
                            <input type="radio" class="btn-check" name="ekspedisi" id="jnt" checked value="JNE"
                                data-harga="15000" onchange="updateTotal()">
                            <label class="btn form-label-white" style="color:white;" for="jnt">JNE - Rp.
                                15.000</label>
                            <input type="radio" class="btn-check" name="ekspedisi" id="pos" value="POS"
                                data-harga="20000" onchange="updateTotal()">
                            <label class="btn form-label-white" style="color:white;" for="pos">POS - Rp.
                                20.000</label>
                            <input type="radio" class="btn-check" name="ekspedisi" id="tiki" value="TIKI"
                                data-harga="25000" onchange="updateTotal()">
                            <label class="btn form-label-white" style="color:white;" for="tiki">TIKI - Rp.
                                25.000</label>
                        </article>
                    </article>
                    <input type="hidden" id="ekspedisi_harga_input" name="ekspedisi_harga" value="0">
                    <article class="form-outline mb-2">
                        <label class="form-label form-label-white d-flex" for="jumlah_legalisir_ijazah">Jumlah
                            Legalisir
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
                        <label for="total_harga">Total Harga:</label>
                        <p id="total_harga">0</p>
                        <input type="hidden" id="total_harga_input" name="total_harga" value="0">
                    </article>
                    <article class="form-outline mb-4">
                        <label class="form-label form-label-white d-flex" for="bukti_pembayaran">Upload
                            Bukti Pembayaran (PDF/JPG/PNG):</label>
                        <input type="file" class="form-control input-glass" id="bukti_pembayaran"
                            name="bukti_pembayaran" accept=".jpg, .jpeg, .png, .hevc" required>
                    </article>
                    <article class="d-grid">
                        <button type="submit" name="submit" class="button-3 my-2">Submit</button>
                    </article>
                </form>
            </section>
        </section>
    </main>
</body>

</html>