<?php 
session_start();
session_destroy();
 header('Location: ../oauth/login.php');
?>