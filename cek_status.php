<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/abrar.css">
    <title>Cek Status Legalisir</title>
</head>

<body>
    <!-- pemanbahan div -->
    <div class="container2">
        <h2>Status Pengajuan Legalisir</h2></br></br>
        <table>
            <tr>
                <th>Nomor Pengajuan</th>
                <th>NPM</th>
                <th>Nama</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
            </tr>
            <?php
            include 'db_connection.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $email = $_POST['email'];

                $stmt = $conn->prepare("SELECT P.id_pengajuan, A.npm, A.nama, P.tgl_masuk, S.keterangan 
                            FROM Pengajuan P 
                            JOIN Alumni A ON P.id_alumni = A.id_alumni 
                            JOIN Status S ON P.id_status = S.id_status 
                            WHERE P.email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>{$row['id_pengajuan']}</td>
                    <td>{$row['npm']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['tgl_masuk']}</td>
                    <td>{$row['keterangan']}</td>
                  </tr>";
                    }
                } else {
                    echo "Tidak ada pengajuan ditemukan untuk email tersebut.";
                }
                $stmt->close();
            }
            $conn->close();
            ?>
        </table><br><br>
        <a class="button" href="status_pengajuan.php">Kembali</a>
    </div>
</body>

</html>