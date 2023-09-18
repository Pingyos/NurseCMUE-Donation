<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data !== null) {
    $amount = $data['amount'];
    $id = $data['id'];
    $rec_date_out = $data['rec_date_out'];
    $id_receipt = $data['id_receipt'];
    $rec_idname = $data['rec_idname'];
    $pdo = new PDO('mysql:host=localhost;dbname=edonation', 'root', '');

    $sql = "SELECT * FROM json_confirm 
    WHERE amount = :amount 
    AND date = :rec_date_out 
    AND billPaymentRef1 = :id_receipt 
    AND billPaymentRef2 = :rec_idname
    ORDER BY id DESC
    LIMIT 2";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':rec_idname', $rec_idname);
    $stmt->bindParam(':rec_date_out', $rec_date_out);
    $stmt->bindParam(':id_receipt', $id_receipt);
    $interval = 5;
    $loopCount = 0;


    while (true) {
        $stmt->execute();
        $found = false;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $found = true;
            $loopCount++;
            $updateSql = "UPDATE receipt_offline SET resDesc = 'success' WHERE id = :id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':id', $id);
            $updateResult = $updateStmt->execute();

            if ($updateResult) {
                $response = [
                    'message' => 'success',
                    'id' => $id,
                    'amount' => $amount,
                    'rec_idname' => $rec_idname,
                    'rec_date_out' => $rec_date_out,
                    'id_receipt' => $id_receipt,
                    'loop_count' => $loopCount
                ];
            } else {
                $response = [
                    'message' => 'ไม่สามารถอัปเดตข้อมูลในฐานข้อมูลได้',
                    'loop_count' => $loopCount
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            break 2;
        }

        if (!$found) {
            $loopCount++;
            $response = [
                'message' => 'ไม่พบข้อมูลที่ตรงกันในฐานข้อมูล',
                'loop_count' => $loopCount
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        sleep($interval);
    }
} else {
    echo 'ไม่สามารถแปลงข้อมูล JSON ได้';
}
