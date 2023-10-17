<?php
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

if ($data !== null) {
    $amount = $data['amount'];
    $id = $data['id'];
    $rec_idname = $data['rec_idname'];
    $ref1 = $data['ref1'];
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=edonation', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ตรวจสอบว่ามีข้อมูลที่ตรงกันในตาราง json_confirm
        $sql = "SELECT * FROM json_confirm WHERE amount = :amount AND billPaymentRef2 = :rec_idname AND billPaymentRef1 = :ref1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':rec_idname', $rec_idname);
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
                            $id_year = "2567";
                            $id_suffix = $edo_pro_id . '-E' . str_pad($receipt_id, 4, '0', STR_PAD_LEFT);
                            $receipt = $id_year . '-' . $id_suffix;

                            // อัปเดตค่า id_receipt
                            $pdf_url = "https://app.nurse.cmu.ac.th/edonation/edo_admin/pdf_maker.php?receipt_id={$receipt_id}&ACTION=VIEW";
                            $updateIdSql = "UPDATE receipt SET id_receipt = :receipt, pdflink = :pdf_url WHERE id = :id";
                            $updateIdStmt = $pdo->prepare($updateIdSql);
                            $updateIdStmt->bindParam(':receipt', $receipt);
                            $updateIdStmt->bindParam(':pdf_url', $pdf_url);
                            $updateIdStmt->bindParam(':id', $id);
                            $updateIdResult = $updateIdStmt->execute();

                            if ($updateIdResult) {
                                require_once "phpmailer/PHPMailerAutoload.php";
                                $mail = new PHPMailer;
                                $mail->CharSet = "utf-8";
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->Port = 587;
                                $mail->SMTPSecure = 'tls';
                                $mail->SMTPAuth = true;

                                $gmail_username = "60143219@g.cmru.ac.th"; // Replace with your Gmail
                                $gmail_password = "pingyos150070"; // Replace with your Gmail password

                                $sender = "Edo Support"; // Sender's name
                                $email_sender = "noreply@ibsone.com"; // Sender's email
                                $email_receiver = "phatcharapon.p@cmu.ac.th"; // Recipient's email

                                $subject = "Your Subject Here"; // Email subject

                                $mail->Username = $gmail_username;
                                $mail->Password = $gmail_password;
                                $mail->setFrom($email_sender, $sender);
                                $mail->addAddress($email_receiver);
                                $mail->Subject = $subject;

                                $email_content = "
                                <!DOCTYPE html>
                                <html>
                                    <head>
                                        <meta charset=utf-8'/>
                                        <title>ทดสอบการส่ง Email</title>
                                    </head>
                                    <body>
                                        <h1 style='background: #3b434c;padding: 10px 0 20px 10px;margin-bottom:10px;font-size:30px;color:white;' >
                                        ขอขอบคุณสำหรับการบริจาค
                                        </h1>
                                        <div style='padding:20px;'>
                                            <div style='text-align:center;margin-bottom:50px;'>
                                                <img src='https://app.nurse.cmu.ac.th/edonation/TCPDF/testedo.jpg' style='width:50%' />					
                                            </div>
                                                <div style='margin-top:30px;'>
                                                <hr>
                                                <address>
                                                    <h4>ติดต่อสอบถาม</h4>
                                                    <p>NurseCMUE-Donation</p>
                                                    <p>053-949075</p>
                                                </address>
                                            </div>
                                        </div>
                                        <div style='background: #3b434c;color: #a2abb7;padding:30px;'>
                                            <div style='text-align:center'> 
                                                2023 © NurseCMUE-Donation
                                            </div>
                                        </div>
                                    </body>
                                </html>
                            ";

                                $mail->msgHTML($email_content);

                                if (!$mail->send()) {
                                    echo "Email sending failed: " . $mail->ErrorInfo;
                                } else {
                                    echo "Email sent successfully.";
                                    exit;
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
                        'message' => 'success'
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
        exit;
    } catch (PDOException $e) {
        echo 'เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: ' . $e->getMessage();
    }
} else {
    echo 'ไม่สามารถแปลงข้อมูล JSON ได้';
}
