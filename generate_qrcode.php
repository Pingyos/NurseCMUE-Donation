<?php
require_once 'lib-crc16.inc.php';

// ตัวแปร amount ที่กำหนดให้เป็นจำนวนเงิน
$amount = 1000.75;

// ให้ $amount เป็นเลขทศนิยม 2 ตำแหน่ง
$amountFormatted = number_format($amount, 2, '.', ''); // จะได้ "100.00"

// ให้ $amountFormatted เป็นสตริงที่มีทั้งหมด 8 หลัก โดยใส่เลข 0 ด้านหน้า
$amountWithPadding = str_pad($amountFormatted, 8, '0', STR_PAD_LEFT); // จะได้ "00100.00"

$qrcode00 = '000201';
$qrcode01 = '010212';
$qrcode3000 = '30630016A000000677010112';
$qrcode3001 = '0115099400258783792';
$qrcode3002 = '02152566121200E0001';
$qrcode3003 = '03010';
$qrcode30 = $qrcode3000 . $qrcode3001 . $qrcode3002 . $qrcode3003;

$qrcode53 = '5303764';
$qrcode54 = '5408' . ($amountWithPadding);
$qrcode58 = '5802TH';
$qrcode62 = '62100706SCB001';
$qrcode63 = '6304';
$qrcode = $qrcode00 . $qrcode01 . $qrcode30 . $qrcode53 . $qrcode54 . $qrcode58 . $qrcode63;
$checkSum = CRC16HexDigest($qrcode);

$qrcodeFull = $qrcode . $checkSum;

// ส่งค่า qrcodeFull ไปยังหน้า generate_png.php ผ่าน URL parameter
header("Location: generate_png.php?qrcode=$qrcodeFull");
exit;
