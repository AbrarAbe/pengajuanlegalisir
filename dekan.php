<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/abrar.css">
    <title>Dashboard Dekan</title>
</head>

<body>
    <!-- pemanbahan div -->
    <div class="container2">
        <h2>Persetujuan Pengajuan Legalisir</h2></br></br>
        <table>
            <tr>
                <th>Nomor Pengajuan</th>
                <th>Nama Alumni</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            include 'db_connection.php';

            $result = $conn->query("SELECT P.id_pengajuan, A.nama, P.email, S.keterangan 
                                FROM Pengajuan P 
                                JOIN Alumni A ON P.id_alumni = A.id_alumni 
                                JOIN Status S ON P.id_status = S.id_status 
                                WHERE P.id_status = 2");

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id_pengajuan']}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['keterangan']}</td>
                    <td><a href='persetujuan_pengajuan.php?id={$row['id_pengajuan']}'class='button1'>Setujui</a></td>
                  </tr>";
            }
            $conn->close();
            ?>
        </table>
</body>

</html>