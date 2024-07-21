<?php
session_start();
include '../config.php';

if (isset($_SESSION['id_user']) && $_SESSION['role'] == true) {

    $id_user = $_SESSION['id_user'];

    // Update status to 'nonaktif'
    $stmt = $conn->prepare("UPDATE user SET status = 'nonaktif' WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $stmt->close();

    unset($_SESSION['role']);
    unset($_SESSION['id_user']);
    session_destroy();
    header('Location: ../pages/login.php');
} else {
    header('Location: ../pages/login.php');
}