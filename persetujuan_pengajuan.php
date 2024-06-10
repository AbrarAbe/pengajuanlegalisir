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
        echo "<h2>Persetujuan Pengajuan Legalisir</h2>
              <form action='proses_persetujuan.php' method='post'>
              <input type='hidden' name='id_pengajuan' value='{$row['id_pengajuan']}'>
              Nama: {$row['nama']}<br>
              Email: {$row['email']}<br>
              Status: {$row['keterangan']}<br>
              <label for='approval'>Approval:</label>
              <input type='radio' name='approval' value='approve' required> Setujui<br>
              <input type='radio' name='approval' value='reject'> Tolak<br>
              <input type='submit' value='Proses'>
              </form>";
    } else {
        echo "Pengajuan tidak ditemukan.";
    }
    $stmt->close();
}
$conn->close();
?>
