<?Php
 require_once("libcache/PromptPayQR.php");
 require_once("connection.php");
 $stmt = $conn->query("SELECT * FROM inputdonat_receipt ORDER BY id DESC LIMIT 0, 1");
 $row = $stmt->fetch();
 $amount = $row['money'];

 $PromptPayQR = new PromptPayQR(); // new object
$PromptPayQR->size = 7; // Set QR code size to 8
$PromptPayQR->id = '5665695135'; // PromptPay ID
$PromptPayQR->amount = $amount; // Set amount (not necessary)
echo '<img src="' . $PromptPayQR->generate() . '" />';
?>