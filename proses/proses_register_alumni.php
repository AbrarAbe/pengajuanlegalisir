<?php
session_start();
include '../config.php';

if (isset($_POST['submit'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $status = 'nonaktif'; // Set status to 'nonaktif'

    $sql = "SELECT * FROM user WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $_SESSION['warning_message'] = "<strong>Email sudah ada!</strong> <a href='register_admin.php'>Masuk</a> atau gunakan email lain.";
            header("Location: ../pages/register_alumni.php");
        } else {
            $stmt = $conn->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, 'alumni')");
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                // Mendapatkan ID pengguna yang baru saja terdaftar
                $id_user = $stmt->insert_id;

                // Menambahkan notifikasi
                $pesan = "Pengguna baru dengan ID <span class='text-danger'>$id_user</span> telah terdaftar ";
                tambahNotifikasi($pesan);

                $_SESSION['info_message'] = "<strong>Berhasil!</strong> Akun Anda berhasil terdaftar! Anda dapat login sekarang.";
                header("Location: ../pages/login.php");
            } else {
                $_SESSION['error_message'] = "<strong>Gagal!</strong> Gagal daftar akun. Harap ulangi lagi.";
                header("Location: ../pages/register_alumni.php");
            }
        }
    }
    $stmt->close();
}
$conn->close();

function tambahNotifikasi($pesan) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifikasi (pesan) VALUES (?)");
    $stmt->bind_param("s", $pesan);
    $stmt->execute();
    $stmt->close();
}
