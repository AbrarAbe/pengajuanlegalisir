<?php
include '../config.php';
$id_pengajuan = $_GET['id'];
$type = $_GET['type'];

$result = $conn->query("SELECT $type FROM Pengajuan WHERE id_pengajuan='$id_pengajuan'");
$row = $result->fetch_assoc();

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="' . $type . '.pdf"');
echo $row[$type];
