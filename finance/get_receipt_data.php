<?php
require_once 'connection.php'; // เชื่อมต่อฐานข้อมูล

if (isset($_GET['receipt_id'])) {
    $receipt_id = $_GET['receipt_id'];
    $sql = "SELECT * FROM receipt WHERE receipt_id = :receipt_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':receipt_id', $receipt_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo json_encode($row);
    } else {
        echo json_encode(array()); // ส่งข้อมูลเปล่ากลับหา JavaScript ถ้าไม่พบข้อมูล
    }
}
