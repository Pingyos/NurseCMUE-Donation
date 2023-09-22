<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data !== null) {
    $amount = $data['amount'];
    $id = $data['id'];
    $rec_idname = $data['rec_idname'];
    $id_receipt = $data['id_receipt'];
    $pdo = new PDO('mysql:host=localhost;dbname=edonation', 'root', '');

    $sql = "SELECT * FROM json_confirm WHERE amount = :amount AND billPaymentRef2 = :rec_idname AND billPaymentRef1 = :id_receipt";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':rec_idname', $rec_idname);
    $stmt->bindParam(':id_receipt', $id_receipt);

    $stmt->execute();
    $found = false;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $found = true;
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
                'id_receipt' => $id_receipt
            ];
        } else {
            $response = [
                'message' => 'ไม่สามารถอัปเดตข้อมูลในฐานข้อมูลได้'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        break;
    }

    if (!$found) {
        $response = [
            'message' => 'ไม่พบข้อมูลที่ตรงกันในฐานข้อมูล'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo 'ไม่สามารถแปลงข้อมูล JSON ได้';
}
