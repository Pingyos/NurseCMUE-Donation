<?php
require_once('lib-crc16.inc.php');

$invoiceId = 75085;
$client_Id = 2025;
$amount = 50;

$qrcode00 = '000201';
$qrcode01 = '010212';

$qrcode3000 = '0016A000000677010112';
$qrcode3001 = '0115099400258783792';
$qrcode3002 = 'INV' . str_pad($invoiceId, 10, '0', STR_PAD_LEFT);
$qrcode3003 = 'CID' . str_pad($client_Id, 10, '0', STR_PAD_LEFT);
$qrcode30 = $qrcode3000 . $qrcode3001 . $qrcode3002 . $qrcode3003;
$qrcode30 = '30' . str_pad(strlen($qrcode30), 2, '0', STR_PAD_LEFT) . $qrcode30;

$qrcode54 = '54' . str_pad(strlen($amount), 2, '0', STR_PAD_LEFT) . $amount;
$qrcode58 = '5802TH';
$qrcode62 = '62100706SCB001';
$qrcode63 = '6304';

$qrcode = $qrcode00 . $qrcode01 . $qrcode30 . $qrcode54 . $qrcode58 . $qrcode62 . $qrcode63;

$checkSum = CRC16HexDigest($qrcode);
$result = $qrcode . $checkSum . '68';

echo 'QR Code Data: ' . $result;
?>
