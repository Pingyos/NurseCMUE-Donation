<?php
session_start();
if (!isset($_SESSION['login_info'])) {
    header('Location: login.php');
    exit;
}
require_once 'connect.php';

$json = $_SESSION['login_info'];
$email = $json['cmuitaccount']; // ใช้ชื่อคอลัมน์ใหม่ "email"

// Query to retrieve the user's status_oauth
$sql = "SELECT status_oauth FROM cmuitaccount WHERE email = :email"; // ใช้ชื่อคอลัมน์ใหม่ "email"
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $status_oauth = $result['status_oauth'];

    // Check if status_oauth is 1, 2, or 3
    if ($status_oauth == 1) {
        header('Location: test.php');
        exit;
    } elseif ($status_oauth == 2) {
        header('Location: ../finance/index.php');
        exit;
    } elseif ($status_oauth == 3) {
        header('Location: ../store/index.php');
        exit;
    } else {
        // Handle other cases as needed
        header('Location: login.php');
        exit;
    }
} else {
    // If the email is not found in the database, redirect to login page
    header('Location: login.php');
    exit;
}
