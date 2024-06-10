<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/abrar.css">
    <title>Submit</title>
</head>

<body>

    <div class="container">
        <?php
        include 'db_connection.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $npm = $_POST['npm'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $tahun_lulus = $_POST['tahun_lulus'];
            $metode_pengambilan = $_POST['metode_pengambilan'];
            $alamat_pengiriman = $_POST['alamat_pengiriman'];
            $tgl_masuk = date('Y-m-d');

            $ijazah = file_get_contents($_FILES['ijazah']['tmp_name']);
            $transkrip = file_get_contents($_FILES['transkrip']['tmp_name']);
            $bukti_pembayaran = file_get_contents($_FILES['bukti_pembayaran']['tmp_name']);

            // Insert Alumni if not exists
            $stmt = $conn->prepare("SELECT id_alumni FROM Alumni WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 0) {
                $stmt = $conn->prepare("INSERT INTO Alumni (npm, nama, email, tahun_lulus) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $npm, $nama, $email, $tahun_lulus);
                $stmt->execute();
                $id_alumni = $stmt->insert_id;
            } else {
                $stmt->bind_result($id_alumni);
                $stmt->fetch();
            }

            // Insert Pengajuan
            $stmt = $conn->prepare("INSERT INTO Pengajuan (id_alumni, tgl_masuk, email, metode_pengambilan, alamat_pengiriman, id_status) VALUES (?, ?, ?, ?, ?, 1)");
            $stmt->bind_param("issss", $id_alumni, $tgl_masuk, $email, $metode_pengambilan, $alamat_pengiriman);
            $stmt->execute();
            $id_pengajuan = $stmt->insert_id;

            // Insert Dokumen
            $stmt = $conn->prepare("INSERT INTO Dokumen (id_pengajuan, ijazah, transkrip, bukti_pembayaran) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $id_pengajuan, $ijazah, $transkrip, $bukti_pembayaran);
            $stmt->execute();

            echo "Pengajuan berhasil disubmit. <br><br><a class='button' href='form_pengajuan.php'>Kembali</a>";
        }
        $conn->close();
        ?>
</body>
</div>

</html>