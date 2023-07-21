<?php
$data = array(
    "payeeProxyId" => "099400042317932",
    "payeeProxyType" => "BILLERID",
    "payeeAccountNumber" => "5663043447",
    "payeeName" => "FACULTY OF NURSE CMU.",
    "payerAccountNumber" => "5665597175",
    "payerAccountName" => "ภัทรพล คำหล้า",
    "payerName" => "ภัทรพล คำหล้า",
    "sendingBankCode" => "014",
    "receivingBankCode" => "014",
    "amount" => "100.00",
    "transactionId" => "de26c7290cfe47dda9388dcd8fb2da0f",
    "transactionDateandTime" => "2023-06-13T11:16:35.004+07:00",
    "billPaymentRef1" => "1213010000001",
    "billPaymentRef2" => "1571100113031",
    "currencyCode" => "764",
    "channelCode" => "PMH",
    "transactionType" => "Domestic Transfers"
);

// Convert JSON data to string
$jsonData = json_encode($data);

// Create QR Payment payload
$payload = "000201" // Payload Format Indicator
    . "010212" // Application Template
    . "29" // PromptPay ID
    . "6304" // รหัสธนาคารที่ทำรายการพร้อมเพย์
    . $jsonData; // ข้อมูลอื่นๆ

// Calculate Checksum (CRC-CCITT)
$checksum = checksum_crc_ccitt($payload);

// Generate QR Code image URL
$qrcodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($payload . $checksum);

// Prepare response JSON
$response = array(
    "payload" => $payload,
    "checksum" => $checksum,
    "qrcodeUrl" => $qrcodeUrl
);

// Send response JSON
header("Content-Type: application/json");
echo json_encode($response);
