<?php
require_once 'connection.php';

// ตรวจสอบว่ามีการโหลดหน้าเว็บหรือการรีเฟรชหน้าเว็บ
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // ดึงข้อมูลล่าสุดจากฐานข้อมูลที่มี status = 1 และยังไม่ได้รับการแจ้งเตือน
    $query = "SELECT * FROM receipt_offline WHERE status = 1 AND id NOT IN (SELECT id FROM receipt_offline WHERE notified = 1) ORDER BY id DESC LIMIT 1";
    $result = $conn->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // ตรวจสอบว่ามีข้อมูลที่ต้องแจ้งเตือน
    if ($row) {
        // สร้างข้อความแจ้งเตือน
        $sMessage = "แจ้งบริจาค\r\n";
        $sMessage .= "รายการที่บริจาค: " . $row['edo_pro_id'] . "\n";
        $sMessage .= "เลขที่ใบเสร็จ: " . $row['id'] . "\n";
        $sMessage .= "ผู้โอน: " . $row['name_title'] . " " . $row['rec_name'] . " " . $row['rec_surname'] . "\n";
        $sMessage .= "เลข ปชช: " . $row['rec_idname'] . "\n";
        $sMessage .= "จาก: \n";
        $sMessage .= "จำนวน: " . $row['amount'] . " บาท\n";
        $sMessage .= "วันที่โอน: " . $row['rec_date_out'] . " " . $row['rec_time'] . "\n";
        $sMessage .= "บริจาคผ่านระบบ: " . $row['status_donat'] . "\n";

        // ส่งการแจ้งเตือนไปยัง Line Notify
        $sToken = "6GxKHxqMlBcaPv1ufWmDiJNDucPJSWPQ42sJwPOsQQL";
        notify_message($sMessage, $sToken);

        // อัพเดตสถานะการแจ้งเตือนให้เป็น 1 (แจ้งเตือนแล้ว)
        $updateQuery = "UPDATE receipt_offline SET notified = 1 WHERE id = :id";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bindParam(':id', $row['id']);
        $updateStmt->execute();
    }
}

function notify_message($sMessage, $Token)
{
    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $Token . '');
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);
    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    }
    curl_close($chOne);
}
?>
