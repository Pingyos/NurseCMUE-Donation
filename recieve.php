<?php
$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data !== null) {
    // การเชื่อมต่อฐานข้อมูล
    require_once 'connection.php';

    // ทำการเตรียมคำสั่ง SQL INSERT
    $stmt = $conn->prepare("INSERT INTO json_confirm 
    (payeeProxyId, payeeProxyType, payeeAccountNumber, payeeName, 
    payerAccountNumber, payerAccountName, payerName, sendingBankCode, 
    receivingBankCode, amount, transactionId, transactionDateandTime, 
    billPaymentRef1, billPaymentRef2, currencyCode, channelCode, 
    transactionType)
    VALUES
    (:payeeProxyId, :payeeProxyType, :payeeAccountNumber, :payeeName, 
    :payerAccountNumber, :payerAccountName, :payerName, :sendingBankCode, 
    :receivingBankCode, :amount, :transactionId, :transactionDateandTime, 
    :billPaymentRef1, :billPaymentRef2, :currencyCode, :channelCode, 
    :transactionType)");

    // ผูกค่า JSON กับพารามิเตอร์ในคำสั่ง SQL
    $stmt->bindParam(':payeeProxyId', $data->payeeProxyId, PDO::PARAM_STR);
    $stmt->bindParam(':payeeProxyType', $data->payeeProxyType, PDO::PARAM_STR);
    $stmt->bindParam(':payeeAccountNumber', $data->payeeAccountNumber, PDO::PARAM_STR);
    $stmt->bindParam(':payeeName', $data->payeeName, PDO::PARAM_STR);
    $stmt->bindParam(':payerAccountNumber', $data->payerAccountNumber, PDO::PARAM_STR);
    $stmt->bindParam(':payerAccountName', $data->payerAccountName, PDO::PARAM_STR);
    $stmt->bindParam(':payerName', $data->payerName, PDO::PARAM_STR);
    $stmt->bindParam(':sendingBankCode', $data->sendingBankCode, PDO::PARAM_STR);
    $stmt->bindParam(':receivingBankCode', $data->receivingBankCode, PDO::PARAM_STR);
    $stmt->bindParam(':amount', $data->amount, PDO::PARAM_STR);
    $stmt->bindParam(':transactionId', $data->transactionId, PDO::PARAM_STR);
    $stmt->bindParam(':transactionDateandTime', $transactionDateandTime, PDO::PARAM_STR);
    $stmt->bindParam(':billPaymentRef1', $data->billPaymentRef1, PDO::PARAM_STR);
    $stmt->bindParam(':billPaymentRef2', $data->billPaymentRef2, PDO::PARAM_STR);
    $stmt->bindParam(':currencyCode', $data->currencyCode, PDO::PARAM_STR);
    $stmt->bindParam(':channelCode', $data->channelCode, PDO::PARAM_STR);
    $stmt->bindParam(':transactionType', $data->transactionType, PDO::PARAM_STR);

    // ทำการ execute คำสั่ง SQL
    $result = $stmt->execute();

    if ($result) {
        $response = array(
            "resCode" => "00",
            "resDesc" => "success",
            "transactionId" => $data->transactionId,
            "confirmId" => $conn->lastInsertId()
        );
        echo json_encode($response);
    } else {
        $response = array(
            "resCode" => "99",
            "resDesc" => "เกิดข้อผิดพลาดในการบันทึกข้อมูล"
        );
        echo json_encode($response);
    }
} else {
    echo "ข้อผิดพลาดในการแปลง JSON หรือไม่มี JSON ที่ส่งมา";
}
