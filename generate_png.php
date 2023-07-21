<?php
include('phpqrcode/qrlib.php');

// รับค่า qrcodeFull จาก URL parameter
if (isset($_GET['qrcode'])) {
    $qrcodeFull = $_GET['qrcode'];

    $tempDir = "phpqrcode";
    $fileName = 'qrcode_' . md5($qrcodeFull) . '.png';
    $pngAbsoluteFilePath = $tempDir . '/' . $fileName;
    $urlRelativeFilePath = $tempDir . '/' . $fileName;

    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($qrcodeFull, $pngAbsoluteFilePath);
        echo 'File generated!';
        echo '<hr />';

        // บันทึก QR code เป็นไฟล์ PNG ในไดเรกทอรี qecodepayment
        $qrcodeDir = "qecodepayment";
        $pngFinalFilePath = $qrcodeDir . '/' . $fileName;
        copy($pngAbsoluteFilePath, $pngFinalFilePath);
        echo 'QR Code saved to: ' . $pngFinalFilePath;
    } else {
        echo 'File already generated! We can use this cached file to speed up site on common codes!';
        echo '<hr />';

        // ถ้ามีไฟล์ PNG ในไดเรกทอรี qecodepayment แล้ว ให้ใช้ไฟล์นี้แทน
        $pngFinalFilePath = $qrcodeDir . '/' . $fileName;
    }

    echo 'Server PNG File: ' . $pngAbsoluteFilePath;
    echo '<hr />';

    echo '<img src="' . $urlRelativeFilePath . '" />';
} else {
    echo 'QR code data not found.';
}
