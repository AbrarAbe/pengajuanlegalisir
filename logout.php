<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    unset($_SESSION['loggedin']);
    unset($_SESSION['username']);
    unset($_SESSION['level']);
    session_destroy();
    header('Location: index.php');
} else {
    header('Location: login.php');
}
?>