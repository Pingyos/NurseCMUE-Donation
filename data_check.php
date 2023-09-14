<?php
require_once 'connection.php';
$rec_idname = $_GET['rec_idname'];
$rec_date_out = $_GET['rec_date_out'];
$timeout = time() + 200;

function checkForData($conn)
{
    global $rec_idname, $rec_date_out, $timeout;
    while (time() <= $timeout) {
        $sql = "SELECT * FROM json_confirm WHERE billPaymentRef2 = :rec_idname AND date = :rec_date_out";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rec_idname', $rec_idname);
        $stmt->bindParam(':rec_date_out', $rec_date_out);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                $id = $_GET['id'];
                // ส่งข้อความเป็น JSON กลับไป
                $response = array(
                    'success' => true,
                    'message' => 'ชำระเงินเสร็จสิ้น'
                );
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }
    }
    // ถ้าไม่พบข้อมูลตรงกัน ส่งข้อความ "hello" กลับไป
    echo 'hello';
}

checkForData($conn);
