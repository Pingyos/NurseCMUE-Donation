<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data !== null) {
    $amount = $data['amount'];
    $id = $data['id'];
    $rec_date_out = $data['rec_date_out'];
    $ref1 = $data['ref1'];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=edonation', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ตรวจสอบว่ามีข้อมูลที่ตรงกันในตาราง json_confirm
        $sql = "SELECT * FROM json_confirm WHERE amount = :amount AND date = :rec_date_out AND billPaymentRef1 = :ref1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':rec_date_out', $rec_date_out);
        $stmt->bindParam(':ref1', $ref1);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // มีข้อมูลที่ตรงกันในตาราง json_confirm

            // อัปเดตค่า resDesc เป็น 'success' ในตาราง receipt_offline
            $updateSql = "UPDATE receipt_offline SET resDesc = 'success' WHERE id = :id";
            $updateStmt = $pdo->prepare($updateSql);
            $updateStmt->bindParam(':id', $id);
            $updateResult = $updateStmt->execute();

            if ($updateResult) {
                // ตรวจสอบว่าข้อมูลซ้ำกันในตาราง receipt หรือไม่
                $checkDuplicateSql = "SELECT id FROM receipt WHERE id = :id";
                $checkStmt = $pdo->prepare($checkDuplicateSql);
                $checkStmt->bindParam(':id', $id);
                $checkStmt->execute();

                if ($checkStmt->rowCount() === 0) {
                    // ไม่มีข้อมูลซ้ำกัน สามารถเพิ่มรายการใหม่ลงในตาราง receipt ได้

                    // คัดลอกข้อมูลจาก receipt_offline ไปยัง receipt
                    $insertSql = "INSERT INTO receipt (id, id_receipt, ref1, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate)
                                  SELECT id, id_receipt, ref1, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate
                                  FROM receipt_offline WHERE id = :id AND resDesc = 'success'
                                  ORDER BY dateCreate DESC
                                  LIMIT 1";
                    $insertStmt = $pdo->prepare($insertSql);
                    $insertStmt->bindParam(':id', $id);
                    $insertResult = $insertStmt->execute();

                    if ($insertResult) {
                        // ค้นหา edo_pro_id และ receipt_id จากตาราง receipt
                        $selectProIdSql = "SELECT edo_pro_id, receipt_id FROM receipt WHERE id = :id";
                        $selectProIdStmt = $pdo->prepare($selectProIdSql);
                        $selectProIdStmt->bindParam(':id', $id);
                        $selectProIdStmt->execute();
                        $row = $selectProIdStmt->fetch(PDO::FETCH_ASSOC);

                        if ($row !== false) {
                            $edo_pro_id = $row['edo_pro_id'];
                            $receipt_id = $row['receipt_id']; // รับค่า receipt_id จากตาราง receipt

                            // สร้าง id_receipt ใหม่
                            $id_year = date('Y') + 543;
                            $id_suffix = $edo_pro_id . '-E' . str_pad($receipt_id, 4, '0', STR_PAD_LEFT);
                            $receipt = $id_year . '-' . $id_suffix;

                            $pdf_url = "https://app.nurse.cmu.ac.th/edonation/edo_admin/pdf_maker.php?receipt_id={$receipt_id}&ACTION=VIEW";
                            // อัปเดตค่า id_receipt
                            $updateIdSql = "UPDATE receipt SET id_receipt = :receipt, pdflink = :pdf_url WHERE id = :id";
                            $updateIdStmt = $pdo->prepare($updateIdSql);
                            $updateIdStmt->bindParam(':receipt', $receipt);
                            $updateIdStmt->bindParam(':pdf_url', $pdf_url);
                            $updateIdStmt->bindParam(':id', $id);
                            $updateIdResult = $updateIdStmt->execute();

                            if ($updateIdResult) {
                                $response = [
                                    'message' => 'success',
                                    'id' => $id,
                                    'amount' => $amount,
                                    'rec_date_out' => $rec_date_out,
                                    'ref1' => $ref1
                                ];
                            } else {
                                $response = [
                                    'message' => 'ไม่สามารถอัปเดตค่า id_receipt ได้'
                                ];
                            }
                        } else {
                            $response = [
                                'message' => 'ไม่พบข้อมูล edo_pro_id และ receipt_id จากตาราง receipt'
                            ];
                        }
                    } else {
                        $response = [
                            'message' => 'ไม่สามารถบันทึกข้อมูลในตาราง receipt ได้'
                        ];
                    }
                } else {
                    $response = [
                        'message' => 'ข้อมูลซ้ำกันในตาราง receipt'
                    ];
                }
            } else {
                $response = [
                    'message' => 'ไม่สามารถอัปเดตข้อมูลในฐานข้อมูลได้'
                ];
            }
        } else {
            $response = [
                'message' => 'ไม่พบข้อมูลที่ตรงกันในฐานข้อมูล'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . $e->getMessage();
    }
} else {
    echo 'ไม่สามารถแปลงข้อมูล JSON ได้';
}
