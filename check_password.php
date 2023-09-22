<?php
require_once 'connection.php';

$data = json_decode(file_get_contents("php://input"));

if ($data && isset($data->password) && isset($data->id)) {
    $userPassword = $data->password;
    $id = $data->id;

    $sql = "SELECT rec_idname FROM receipt_offline WHERE rec_idname = '$userPassword' AND id = $id";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {

        $response = array('success' => true, 'message' => 'กรุณากรอกมหายเลขบัตรที่ถูกต้อง');

        $pdfUrl = "pdf_maker.php?id=$id&ACTION=VIEW";

        // เพิ่ม URL เปลี่ยนเส้นทางใน JSON response
        $response['pdfUrl'] = $pdfUrl;
    } else {
        $response = array('success' => false, 'message' => 'กรุณากรอกมหายเลขบัตรที่ถูกต้อง');
    }
} else {
    $response = array('success' => false, 'message' => 'ยกเลิกการเปิดใบเสร็จรับเงิน');
}

header('Content-Type: application/json');
echo json_encode($response);
