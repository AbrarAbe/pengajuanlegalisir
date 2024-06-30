<?php
session_start();
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'alumni') {
    header("Location : login_alumni.php");
    exit;
}

$navbarFile = '';
$headFile = '../components/head.html';
$alertFile = '../components/alert.html';
$footerFile = '../components/footer.html';
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

    <!-- Section : Design Block -->
    <main class="container-fluid g-3 justify-content-center align-items-start mb-5" style="padding:50px 0 50px 0">
        <?php @include ($alertFile); ?>
        <section class="container justify-content-center align-items-center mb-3 py-5 px-4">
            <section class="card bg-glass d-flex mb-3 py-5 justify-content-center">
                <section class="card-body px-5 justify-content-center align-items-center">
                    <header class="form-outline mb-4">
                        <label class="form-label form-label-white d-flex">
                            <span style="font-size : 1.5rem;">Form Pengajuan legalisir</span></label>
                    </header>

                    <!-- Form -->
                    <form action="../proses/proses_submit_pengajuan.php" method="post" enctype="multipart/form-data">

                        <!-- NPM -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="npm">NPM :</label>
                            <input type="text" class="form-control input-glass" id="npm" name="npm" required
                                placeholder="Nomor Pokok Mahasiswa" autofocus>
                        </article>

                        <!-- Nama -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="nama">Nama
                                Lengkap :</label>
                            <input type="text" class="form-control input-glass" id="nama" name="nama" required
                                placeholder="Nama Lengkap">
                        </article>

                        <!-- Prodi -->
                        <label class="form-label form-label-white d-flex" for="prodi">Program Studi :</label>
                        <article class="form-outline mb-3 d-flex gap-2">
                            <input type="radio" class="btn-check" name="prodi" id="option1" autocomplete="off" checked
                                value="Teknik Informatika">
                            <label class="btn form-label-white" style="color:white;" for="option1">Teknik
                                Informatika</label>
                            <input type="radio" class="btn-check" name="prodi" id="option2" autocomplete="off"
                                value="Sistem Informasi">
                            <label class="btn" style="color:white;" for="option2">Sistem Informasi</label>
                            <input type="radio" class="btn-check" name="prodi" id="option3" autocomplete="off"
                                value="Arsitektur">
                            <label class="btn" style="color:white;" for="option3">Arsitektur</label>
                        </article>

                        <!-- Tahun Lulus -->
                        <article class="form-outline mb-3">
                            <label for="tahun_lulus" class="form-label form-label-white d-flex">Tahun Lulus</label>
                            <input type="text" class="form-control input-glass" list="tahunList" id="tahun_lulus"
                                name="tahun_lulus" placeholder="Ex 20241" required>
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
                            <label class="form-label form-label-white d-flex" for="email">Email :</label>
                            <input type="email" class="form-control input-glass" id="email" name="email" required
                                placeholder="Ex user@gmail.com">
                        </article>

                        <!-- Ijazah -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="ijazah">Upload Scan Ijazah
                                (PDF) :</label>
                            <input type="file" class="form-control input-glass" id="ijazah" name="ijazah" accept=".pdf"
                                required>
                        </article>

                        <!-- Transkrip -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="transkrip">Upload
                                Transkrip (PDF) :</label>
                            <input type="file" class="form-control input-glass" id="transkrip" name="transkrip"
                                accept=".pdf">
                        </article>

                        <!-- Metode Pengambilan -->
                        <article class="form-outline mb-3 d-flex gap-2">
                            <input type="radio" class="btn-check" name="metode_pengambilan" id="ambil"
                                autocomplete="off" checked value="ambil di prodi" onchange="toggleEkspedisi()">
                            <label class="btn form-label-white" style="color :white;" for="ambil">Ambil di
                                prodi 📦</label>
                            <input type="radio" class="btn-check" name="metode_pengambilan" id="kirim"
                                autocomplete="off" value="kirim ke alamat" onchange="toggleEkspedisi()">
                            <label class="btn" style="color :white;" for="kirim">Kirim ke alamat ✈️</label>
                        </article>
                        <article id="ekspedisi_article" style="display : none;">

                            <!-- Alamat -->
                            <article class="form-outline mb-3">
                                <label class="form-label form-label-white d-flex" for="alamat">Alamat
                                    Pengiriman :</label>
                                <textarea class="form-control input-glass" id="alamat" name="alamat" rows="4"
                                    placeholder="Alamat Lengkap"></textarea>
                            </article>

                            <!-- Expedisi -->
                            <label class="form-label form-label-white d-flex">Pilihan
                                Ekspedisi Pengiriman :</label>
                            <article class="form-outline mb-3 d-flex gap-2">
                                <input type="radio" class="btn-check" name="ekspedisi" id="jne" value="JNE"
                                    data-harga="15000" checked onchange="updateTotal()">
                                <label class="btn form-label-white" style="color :white;" for="jne">JNE - Rp.
                                    15.000</label>
                                <input type="radio" class="btn-check" name="ekspedisi" id="pos" value="POS"
                                    data-harga="20000" onchange="updateTotal()">
                                <label class="btn form-label-white" style="color :white;" for="pos">POS - Rp.
                                    20.000</label>
                                <input type="radio" class="btn-check" name="ekspedisi" id="tiki" value="TIKI"
                                    data-harga="25000" onchange="updateTotal()">
                                <label class="btn form-label-white" style="color :white;" for="tiki">TIKI - Rp.
                                    25.000</label>
                            </article>
                        </article>

                        <!-- Jumlah Legalisir Ijazah -->
                        <input type="hidden" id="ekspedisi_harga_input" name="ekspedisi_harga" value="0">
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="jumlah_legalisir_ijazah">Jumlah
                                Legalisir
                                Ijazah :</label>
                            <input type="number" class="form-control input-glass" id="jumlah_legalisir_ijazah"
                                name="jumlah_legalisir_ijazah" min="1" required
                                oninput="checkNegative(this); updateTotal()">
                        </article>

                        <!-- Jumlah Legalisir Transkrip -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="jumlah_legalisir_transkrip">Jumlah
                                Legalisir Transkrip :</label>
                            <input type="number" class="form-control input-glass" id="jumlah_legalisir_transkrip"
                                name="jumlah_legalisir_transkrip" min="1" required
                                oninput="checkNegative(this); updateTotal()">
                        </article>

                        <!-- Total Harga -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="total_harga">Total Harga :</label>
                            <p class="d-flex">Rp. <span class="d-flex" id="total_harga">0</span></p>
                            <input type="hidden" id="total_harga_input" name="total_harga" value="0">
                        </article>

                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="bukti_pembayaran">Nomor Rekening
                                Fakultas
                                Teknik :</label>
                            <article class="card d-flex input-glass justify-content-center align-items-center"
                                style="height:75px">Placeholder</article>
                        </article>

                        <!-- Bukti Pembayaran -->
                        <article class="form-outline mb-3">
                            <label class="form-label form-label-white d-flex" for="bukti_pembayaran">Upload
                                Bukti Pembayaran (PDF/JPG/PNG) :</label>
                            <input type="file" class="form-control input-glass" id="bukti_pembayaran"
                                name="bukti_pembayaran" accept=".jpg, .jpeg, .png, .hevc" required>
                        </article>
                        <article class="d-grid">
                            <button type="submit" name="submit" class="button-3 my-2">Submit</button>
                        </article>
                    </form>
                </section>
            </section>
        </section>
    </main>
    <!-- footer -->
    <?php @include ($footerFile); ?>
    <!-- footer -->
</body>

</html>