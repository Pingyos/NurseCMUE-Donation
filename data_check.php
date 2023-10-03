<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data !== null) {
    $amount = $data['amount'];
    $id = $data['id'];
    $rec_date_out = $data['rec_date_out'];
    $id_receipt = $data['id_receipt'];
    $pdo = new PDO('mysql:host=localhost;dbname=edonation', 'root', '');

    $sql = "SELECT * FROM json_confirm WHERE amount = :amount AND date = :rec_date_out AND billPaymentRef1 = :id_receipt";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':rec_date_out', $rec_date_out);
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
            // เพิ่มข้อมูลใหม่ในตาราง receipt จาก receipt_offline
            $insertSql = "INSERT INTO receipt (id, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate)
                          SELECT id, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate
                          FROM receipt_offline WHERE id = :id AND resDesc = 'success'
                          ORDER BY dateCreate DESC
                          LIMIT 1";
            $insertStmt = $pdo->prepare($insertSql);
            $insertStmt->bindParam(':id', $id);
            $insertResult = $insertStmt->execute();

            if ($insertResult) {
                $response = [
                    'message' => 'success',
                    'id' => $id,
                    'amount' => $amount,
                    'rec_date_out' => $rec_date_out,
                    'id_receipt' => $id_receipt
                ];
            } else {
                $response = [
                    'message' => 'ไม่สามารถบันทึกข้อมูลในตาราง receipt ได้'
                ];
            }
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
