<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/abrar.css">
    <title>Form Pengajuan</title>
</head>

<body>
    <div class="container">
            <h2>Form Pengajuan Legalisir Ijazah dan Transkrip Akademik</h2></br></br>
            <form action="submit_pengajuan.php" method="post" enctype="multipart/form-data">
                <label for="npm">NPM :</label>
                <input type="text" name="npm" required placeholder="Nomor Pokok Mahasiswa"><br>
                <label for="nama">Nama Lengkap :</label>
                <input type="text" name="nama" required placeholder="Nama Lengkap"><br>
                <label for="email">Email :</label>
                <input type="email" name="email" required placeholder="ex. aa@gmail.com"><br>
                <label for="tahun_lulus">Tahun Lulus :</label>
                <input type="text" name="tahun_lulus" required placeholder="ex. 20241"><br>
                <label for="ijazah">Upload Scan Ijazah (PDF) :</label>
                <input type="file" name="ijazah" accept=".pdf" required><br>
                <label for="transkrip">Upload Scan Transkrip (PDF) :</label>
                <input type="file" name="transkrip" accept=".pdf"><br>
                <label for="bukti_pemnbayaran">Upload Bukti Pembayaran :</label>
                <input type="file" name="bukti_pembayaran" accept=".jpg"><br>
                <label for="metode_pengambilan">Metode Pengambilan :</label>
                <select name="metode_pengambilan" required>
                    <option value="ambil">Ambil di Tempat</option>
                    <option value="kirim">Dikirim ke Alamat</option>
                </select><br>
                <label for="alamat_pengiriman">Alamat Pengiriman :</label>
                <textarea name="alamat_pengiriman" rows="4" required placeholder="Alamat Pengiriman"></textarea><br>
                <input class="mgr" type="submit" value="Submit">
            </form><br>
            <a>Sudah mengajukan legalisir ? </a><a href="status_pengajuan.php">Cek Status Pengajuan</a>
    </div>
</body>

</html>