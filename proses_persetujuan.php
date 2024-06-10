<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pengajuan = $_POST['id_pengajuan'];
    $approval = $_POST['approval'];
    
    if ($approval == 'approve') {
        $status = 3; // Approved by Dean
    } else {
        $status = 4; // Rejected by Dean
    }
    
    $stmt = $conn->prepare("UPDATE Pengajuan SET id_status = ? WHERE id_pengajuan = ?");
    $stmt->bind_param("ii", $status, $id_pengajuan);
    $stmt->execute();
    
    echo "Pengajuan berhasil diupdate.";
}
$conn->close();
?>
