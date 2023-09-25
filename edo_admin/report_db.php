<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') { // รับข้อมูลผ่าน GET
    if (isset($_GET['start_date']) || isset($_GET['end_date']) || isset($_GET['status_user']) || isset($_GET['status_receipt']) || isset($_GET['edo_description'])) {
        // ดึงค่าจาก $_GET และนำมาใช้ตามต้องการ
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $selected_status_user = isset($_GET['status_user']) ? $_GET['status_user'] : null;
        $selected_status_receipt = isset($_GET['status_receipt']) ? $_GET['status_receipt'] : null;
        $selected_edo_description = isset($_GET['edo_description']) ? $_GET['edo_description'] : null;
        $sql = "SELECT id_receipt, status_user, rec_idname, name_title, rec_name, rec_surname, address, rec_tel, rec_date_out, rec_time, payby, amount FROM receipt_offline WHERE 1=1 ";

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

        // ตรวจสอบว่ามีข้อมูลที่ค้นพบหรือไม่
        if (!empty($results)) {

            require_once '../vendor/autoload.php';

            // สร้างสเปรดชีต Excel
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // กำหนดหัวของตาราง
            $columns = ['ID Receipt', 'Status User', 'Rec ID Name', 'ชื่อ-สกุล', 'Address', 'Rec Tel', 'Rec Date Out', 'Rec Time', 'Pay By', 'Amount'];
            $col = 'A';

            foreach ($columns as $column) {
                $sheet->setCellValue($col . '1', $column);
                $col++;
            }


            $row = 2;

            foreach ($results as $result) {
                $col = 'A';

                // รวม name_title และ rec_name เป็น 'ชื่อ-สกุล'
                $full_name = $result['name_title'] . ' ' . $result['rec_name'] . ' ' . $result['rec_surname'];
                unset($result['name_title']); // ไม่ต้องใช้งาน name_title แล้ว
                unset($result['rec_name']); // ไม่ต้องใช้งาน rec_name แล้ว
                unset($result['rec_surname']); // ไม่ต้องใช้งาน rec_surname แล้ว

                $result['ชื่อ-สกุล'] = $full_name;

                foreach ($result as $value) {
                    $sheet->setCellValue($col . $row, $value);
                    $col++;
                }

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
