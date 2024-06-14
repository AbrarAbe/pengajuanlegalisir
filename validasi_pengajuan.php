<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/abrar.css">
    <title>Dashboard Staf</title>
</head>

<body>
    <!-- pemanbahan div -->
    <div class="login-container">
        <h2>Validasi Pengajuan Legalisir</h2></br></br>
        <?php
        include 'db_connection.php';

        if (isset($_GET['id'])) {
            $id_pengajuan = $_GET['id'];

            $stmt = $conn->prepare("SELECT P.id_pengajuan, A.nama, P.email, S.keterangan 
                            FROM Pengajuan P 
                            JOIN Alumni A ON P.id_alumni = A.id_alumni 
                            JOIN Status S ON P.id_status = S.id_status 
                            WHERE P.id_pengajuan = ?");
            $stmt->bind_param("i", $id_pengajuan);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nama = $row['nama'];
                $email = $row['email'];
                $keterangan = $row['keterangan'];

                ?>
                <!-- Menampilkan formulir dengan data pelamar yang telah ditemukan -->
                <form action="" method="post">
                    <!-- Penambahan form deskripsi -->
                    <label for="nama">Nama :</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" readonly><br>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly><br>
                    <label for="keterangan">Keterangan :</label>
                    <textarea id="keterangan" name="keterangan" readonly><?php echo $keterangan; ?></textarea><br>
                    <!-- mengubah tampilan tombol -->
                    <a class="button" href="staf.php">Kembali</a>
                    <!-- Link download CV and foto -->
                    <a class="button1 mgr">Lihat CV</a>
                </form>
                <?php
            } else {
                echo "Pengajuan tidak ditemukan.";
            }


            $stmt->close();
        }
        $conn->close();
        ?>
        </table>
    </div>
</body>

</html>