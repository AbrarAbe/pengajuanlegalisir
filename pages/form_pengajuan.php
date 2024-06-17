<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Form Pengajuan Legalisir</title>
</head>
<body>
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
</body>
</html>
