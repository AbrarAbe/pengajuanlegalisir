<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/abrar.css">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <div class="login-container">
        <form action="" method=" post">
            <label for="username">Username :</label>
            <input type="text" name="username" required><br>
            <label for="password">Password :</label>
            <input type="password" name="password" required><br>
            <button type="submit" name="submit">login</button>
        </form>
    </div>
</body>

<?php
session_start();
require ('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_user, username, password, level FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user, $username, $stored_password, $level);

        if ($stmt->fetch()) {
            if ($password == $stored_password) {
                $_SESSION['user_id'] = $id_user;
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $level;
                if ($level == 'Staf') {
                    header("Location: staf.php");
                } elseif ($level == 'Dekan') {
                    header("Location: dekan.php");
                }
            } else {
                echo "Password salah.";
            }
        }
    } else {
        echo 'Username salah';
    }
    $stmt->close();
    $conn->close();
}

?>

</html>