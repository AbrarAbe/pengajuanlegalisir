<?php
session_start();
if (!isset($_SESSION['id_user']) || ($_SESSION['role'] != 'alumni' && $_SESSION['role'] != 'staf' && $_SESSION['role'] != 'dekan')) {
    header("Location: ../index.php");
    exit;
}

$headFile = '../components/head.html';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <?php @include ($headFile); ?>
</head>

<body class="bg-transparent">
    <main>
        <section>
            <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
        </section>
    </main>
</body>

</html>