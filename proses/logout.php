<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == true) {
    unset($_SESSION['role']);
    unset($_SESSION['id_user']);
    session_destroy();
    header('Location: ../pages/login.php');
} else {
    header('Location: ../pages/login.php');
}