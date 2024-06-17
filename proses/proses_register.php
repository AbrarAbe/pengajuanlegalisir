<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $sql = "SELECT * FROM User WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> Email sudah ada.
            </div>';
        } else {
            $apa = $conn->prepare("INSERT INTO User (username, email, password, role) VALUES (?, ?, ?, 'alumni')");
            $apa->bind_param("sss", $username, $email, $password);
            if ($apa->execute()) {
                echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Berhasil!</strong> Akun anda berhasil terdaftar! Anda dapat <a href="login.php">Masuk</a> sekarang.
        </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Gagal!</strong> Gagal daftar akun. Harap ulangi lagi!
        </div>';
            }
        }
    }
}
$stmt->close();