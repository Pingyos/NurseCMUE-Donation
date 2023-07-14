<?php
require_once 'connection.php';

$json = file_get_contents('php://input');
$data = json_decode($json, true);

// บันทึกข้อมูลลงในฐานข้อมูล
$stmt = $conn->prepare("INSERT INTO json (status1) VALUES (:json)");
$stmt->bindParam(':json', $json);
if ($stmt->execute()) {
    echo "บันทึกข้อมูลลงในฐานข้อมูลเรียบร้อยแล้ว";
} else {
    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->errorInfo()[2];
}

$conn = null;
