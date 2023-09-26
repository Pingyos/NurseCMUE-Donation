<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') { // รับข้อมูลผ่าน GET
    if (isset($_GET['start_date']) || isset($_GET['end_date']) || isset($_GET['status_user']) || isset($_GET['status_receipt']) || isset($_GET['edo_description'])) {
        // ดึงค่าจาก $_GET และนำมาใช้ตามต้องการ
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $selected_status_user = isset($_GET['status_user']) ? $_GET['status_user'] : null;
        $selected_status_receipt = isset($_GET['status_receipt']) ? $_GET['status_receipt'] : null;
        $selected_edo_description = isset($_GET['edo_description']) ? $_GET['edo_description'] : null;
        $sql = "SELECT id_receipt, status_user, rec_idname, name_title, rec_name, rec_surname, address, rec_tel, rec_date_out, rec_time, payby, amount, rec_email, road, districts, amphures, provinces, zip_code, rec_date_s, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_receipt, resDesc,pdflink, dateCreate FROM receipt_offline WHERE 1=1 ";

        if (!empty($start_date)) {
            $sql .= "AND rec_date_out >= :start_date ";
        }

        if (!empty($end_date)) {
            $sql .= "AND rec_date_out <= :end_date ";
        }

        if (!empty($selected_status_user)) {
            $sql .= "AND status_user = :status_user ";
        }

        if (!empty($selected_status_receipt)) {
            $sql .= "AND status_receipt = :status_receipt ";
        }

        if (!empty($selected_edo_description)) {
            $sql .= "AND edo_description = :edo_description ";
        }

        // ตัวอย่างการเชื่อมต่อฐานข้อมูลและทำคิวรี
        require_once 'connection.php';

        $stmt = $conn->prepare($sql);

        if (!empty($start_date)) {
            $stmt->bindParam(':start_date', $start_date);
        }

        if (!empty($end_date)) {
            $stmt->bindParam(':end_date', $end_date);
        }

        if (!empty($selected_status_user)) {
            $stmt->bindParam(':status_user', $selected_status_user);
        }

        if (!empty($selected_status_receipt)) {
            $stmt->bindParam(':status_receipt', $selected_status_receipt);
        }

        if (!empty($selected_edo_description)) {
            $stmt->bindParam(':edo_description', $selected_edo_description);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            require_once '../vendor/autoload.php';

            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $columns = ['เลขที่ใบเสร็จ', 'เลขประจำตัวผู้เสียภาษี', 'ชื่อ-สกุล', 'ที่อยู่', 'เบอร์โทรศัพท์', 'อีเมล์', 'วันที่บริจาค', 'เวลา', 'ชำระโดย', 'จำนวนเงิน', 'ใบเสร็จ'];
            $col = 'A';

            foreach ($columns as $column) {
                $sheet->setCellValue($col . '1', $column);
                $col++;
            }
            $row = 2;
            foreach ($results as $result) {
                $col = 'A';
                $sheet->setCellValue($col . $row, $result['id_receipt']);
                $col++;
                $sheet->setCellValue($col . $row, $result['rec_idname']);
                $col++;
                $sheet->setCellValue($col . $row, $result['name_title'] . ' ' . $result['rec_name'] . ' ' . $result['rec_surname']);
                $col++;
                $sheet->setCellValue($col . $row, $result['address'] . ' ' . $result['road'] . ' ' . $result['districts'] . ' ' . $result['amphures'] . ' ' . $result['provinces'] . ' ' . $result['zip_code']);
                $col++;
                $sheet->setCellValue($col . $row, $result['rec_tel']);
                $col++;
                $sheet->setCellValue($col . $row, $result['rec_email']);
                $col++;
                $sheet->setCellValue($col . $row, $result['rec_date_out']);
                $col++;
                $sheet->setCellValue($col . $row, $result['rec_time']);
                $col++;
                $sheet->setCellValue($col . $row, $result['payby']);
                $col++;
                $sheet->setCellValue($col . $row, $result['amount']);
                $col++;
                $sheet->setCellValue($col . $row, $result['pdflink']);
                $row++;
            }

            // ตั้งค่าการส่งออกไฟล์ Excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="data.xlsx"');
            header('Cache-Control: max-age=0');

            // สร้าง Writer และส่งออกไฟล์ Excel
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            exit;
        } else {
            echo "No data found.";
        }
    }
}
