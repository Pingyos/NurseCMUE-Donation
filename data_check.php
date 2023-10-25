<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data !== null) {
    $amount = $data['amount'];
    $id = $data['id'];
    $rec_date_out = $data['rec_date_out'];
    $ref1 = $data['ref1'];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=edonation;charset=utf8', 'root', '');
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
                    $insertSql = "INSERT INTO receipt (id, id_receipt, ref1, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, receipt_cc, dateCreate)
                                  SELECT id, id_receipt, ref1, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, receipt_cc, dateCreate
                                  FROM receipt_offline WHERE id = :id AND resDesc = 'success'
                                  ORDER BY dateCreate DESC
                                  LIMIT 1";
                    $insertStmt = $pdo->prepare($insertSql);
                    $insertStmt->bindParam(':id', $id);
                    $insertResult = $insertStmt->execute();

                    if ($insertResult) {
                        $selectProIdSql = "SELECT id_receipt, edo_pro_id, edo_description, payby, receipt_id, rec_email, name_title, rec_name, rec_surname, rec_date_out, rec_time, status_donat FROM receipt WHERE id = :id";
                        $selectProIdStmt = $pdo->prepare($selectProIdSql);
                        $selectProIdStmt->bindParam(':id', $id);
                        $selectProIdStmt->execute();
                        $row = $selectProIdStmt->fetch(PDO::FETCH_ASSOC);

                        if ($row !== false) {
                            $edo_pro_id = $row['edo_pro_id'];
                            $receipt_id = $row['receipt_id']; // รับค่า receipt_id จากตาราง receipt
                            $email_receiver = $row['rec_email'];
                            $name_title = $row['name_title'];
                            $rec_name = $row['rec_name'];
                            $rec_surname = $row['rec_surname'];
                            $rec_date_out = $row['rec_date_out'];
                            $rec_time = $row['rec_time'];
                            $status_donat = $row['status_donat'];
                            $edo_description = $row['edo_description'];
                            $payby = $row['payby'];
                            $id_receipt = $row['id_receipt'];

                            // สร้าง id_receipt ใหม่
                            $id_year = "2567";
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
                                function notify_message($sMessage, $Token)
                                {
                                    $chOne = curl_init();
                                    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                                    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
                                    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
                                    curl_setopt($chOne, CURLOPT_POST, 1);
                                    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
                                    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $Token . '',);
                                    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
                                    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
                                    $result = curl_exec($chOne);
                                    if (curl_error($chOne)) {
                                        echo 'error:' . curl_error($chOne);
                                    }
                                    curl_close($chOne);
                                }
                                // 6GxKHxqMlBcaPv1ufWmDiJNDucPJSWPQ42sJwPOsQQL bot test
                                // VnaAYBFqNRPYNLKLeBA3Uk9kFFyFsYdUbw8SmU9HNWf 
                                $sToken = ["6GxKHxqMlBcaPv1ufWmDiJNDucPJSWPQ42sJwPOsQQL"]; // เพิ่ม Token ของคุณที่นี่
                                $sMessage .= "โครงการ: " . $edo_description . "\n";
                                $sMessage .= "\n";
                                $sMessage .= "เลขที่ใบเสร็จ: " . $receipt . "\n";
                                $sMessage .= "ผู้บริจาค: " . $name_title . " " . $rec_name . " " . $rec_surname . "\n";
                                $sMessage .= "\n";
                                $sMessage .= "จำนวน: " . $amount . " บาท\n";
                                $sMessage .= "วันที่โอน: " . $rec_date_out . " " . $rec_time . "\n";
                                $sMessage .= "ชำระโดย: " . $payby . "\n";

                                // เรียกใช้งานฟังก์ชัน notify_message สำหรับทุก Token
                                foreach ($sToken as $Token) {
                                    notify_message($sMessage, $Token);
                                }
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
