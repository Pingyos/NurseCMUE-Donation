<?php 
session_start();
if (isset($_SESSION['login_info'])) {
    $login_info = $_SESSION['login_info'];
} else {
    header("Location: ../oauth/login.php");
    exit;
}
