<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == true) {
    unset($_SESSION['role']);
    unset($_SESSION['id_user']);
    session_destroy();
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}