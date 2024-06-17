<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'alumni') {
        header('Location: beranda_alumni.php');
} else if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'staf') {
        header('Location: beranda_staf.php');
} else if (isset($_SESSION['id_user']) && $_SESSION['role'] === 'dekan') {
        header('Location: beranda_dekan.php');
        exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Registrasi Admin</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Registrasi Admin</h2>
        <form action="" method="post" class="signin-form">
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="role">Role :</label>
                <select name="role" id="role" class="form-control">
                    <option value="staf">Staf</option>
                    <option value="dekan">Dekan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
            <?php
            include '../config.php';

            if (isset($_POST['submit'])) {
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
                $role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
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
                        $stmt = $conn->prepare("INSERT INTO User (username, email, password, role) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $username, $email, $password, $role);
                        if ($stmt->execute()) {
                            echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Berhasil!</strong> Akun anda berhasil terdaftar! Anda dapat <a href="../pages/login_admin.php">login</a> sekarang.
                    </div>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Gagal!</strong> Gagal daftar akun. Harap ulangi lagi!
                    </div>';
                        }
                    }
                }
                $stmt->close();
            }
            ?>
        </form>
    </div>
</body>

</html>