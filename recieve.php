<?php
$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data !== null) {
    $response = array(
        "resCode" => "00",
        "resDesc" => "",
        "transactionId" => "",
        "confirmId" => ""
    );
    echo json_encode($response);
} else {
    echo "ข้อผิดพลาดในการแปลง JSON หรือไม่มี JSON ที่ส่งมา";
}
