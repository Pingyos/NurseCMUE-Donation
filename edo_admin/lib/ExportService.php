<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
require 'vendor/autoload.php';


class ExportService
{

    public function exportExcel($postResult, $columnResult)
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle("excelsheet");
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->SetCellValue('A1', 'ที่');
        $spreadsheet->getActiveSheet()->SetCellValue('B1', 'เลขที่ใบเสร็จ');
        $spreadsheet->getActiveSheet()->SetCellValue('C1', 'ประเภทผู้บริจาค');
        $spreadsheet->getActiveSheet()->SetCellValue('D1', 'เลขประจำตัวผู้เสียภาษี');
        $spreadsheet->getActiveSheet()->SetCellValue('E1', 'คำนำหน้า');
        $spreadsheet->getActiveSheet()->SetCellValue('F1', 'ชื่อ-สกุล');
        $spreadsheet->getActiveSheet()->SetCellValue('G1', 'ที่อยู่');
        $spreadsheet->getActiveSheet()->SetCellValue('H1', 'เบอร์โทรศัพท์');
        $spreadsheet->getActiveSheet()->SetCellValue('I1', 'อีเมล์');
        $spreadsheet->getActiveSheet()->SetCellValue('J1', 'วันที่บริจาค');
        $spreadsheet->getActiveSheet()->SetCellValue('K1', 'เวลา');
        $spreadsheet->getActiveSheet()->SetCellValue('L1', 'ชำระโดย');
        $spreadsheet->getActiveSheet()->SetCellValue('M1', 'จำนวนเงิน');
        // นับจำนวนแถวที่มีข้อมูลในคอลัมน์ M
        $rowCount = count($postResult);

        // สร้างสูตรสำหรับรวมยอดเงินแบบอัตโนมัติ
        $totalAmountFormula = '=SUM(M2:M' . ($rowCount + 1) . ')';

        // กำหนดเซลล์รวมยอดเงิน
        $spreadsheet->getActiveSheet()->SetCellValue('M' . ($rowCount + 2), $totalAmountFormula);

        // กำหนดรูปแบบการแสดงผลของเซลล์รวมยอดเงิน
        $spreadsheet->getActiveSheet()->getStyle('M' . ($rowCount + 2))->getNumberFormat()->setFormatCode('#,##0.00');

        // ปรับแต่งรูปแบบตารางให้เหมาะสม (ตัวหนาในเซลล์สุดท้ายของคอลัมน์จำนวนเงิน)
        $spreadsheet->getActiveSheet()->getStyle('M1:M' . ($rowCount + 2))->getFont()->setBold(true);

        // ปรับแต่งความกว้างของคอลัมน์จำนวนเงิน
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);


        $spreadsheet->getActiveSheet()
            ->getStyle("A1:M1")
            ->getFont()
            ->setBold(true);
        $rowCount = 2;
        if (!empty($postResult)) {
            foreach ($postResult as $k => $v) {
                $spreadsheet->getActiveSheet()->setCellValue("A" . $rowCount, $postResult[$k]["id"]);
                $recDate = new DateTime($postResult[$k]["rec_date_out"]);
                $thaiYear = (int) $recDate->format('Y') + 543;
                $receiptNumber = $thaiYear . '-' . $postResult[$k]["edo_pro_id"] . '-E' . sprintf("%04d", $postResult[$k]["id"]);
                $spreadsheet->getActiveSheet()->setCellValue("B" . $rowCount, $receiptNumber);
                $spreadsheet->getActiveSheet()->setCellValue("C" . $rowCount, $postResult[$k]["status_donat"]);
                $spreadsheet->getActiveSheet()->setCellValue("D" . $rowCount, $postResult[$k]["rec_idname"]);
                $spreadsheet->getActiveSheet()->setCellValue("E" . $rowCount, $postResult[$k]["name_title"]);
                $spreadsheet->getActiveSheet()->setCellValue("F" . $rowCount, $postResult[$k]["rec_name"] . " " . $postResult[$k]["rec_surname"]);
                $spreadsheet->getActiveSheet()->setCellValue("G" . $rowCount, $postResult[$k]["address"] . " " . $postResult[$k]["road"] . " " . $postResult[$k]["provinces"] . " " . $postResult[$k]["amphures"] . " " . $postResult[$k]["districts"] . " " . $postResult[$k]["zip_code"]);
                $spreadsheet->getActiveSheet()->setCellValue("H" . $rowCount, $postResult[$k]["rec_tel"]);
                $spreadsheet->getActiveSheet()->setCellValue("I" . $rowCount, $postResult[$k]["rec_email"]);
                $spreadsheet->getActiveSheet()->setCellValue("J" . $rowCount, $postResult[$k]["rec_date_out"]);
                $spreadsheet->getActiveSheet()->setCellValue("K" . $rowCount, $postResult[$k]["rec_time"]);
                $spreadsheet->getActiveSheet()->setCellValue("L" . $rowCount, $postResult[$k]["payby"]);
                $spreadsheet->getActiveSheet()->setCellValue("M" . $rowCount, $postResult[$k]["amount"]);
                // $spreadsheet->getActiveSheet()->setCellValue("B" . $rowCount, $postResult[$k]["edo_pro_id"] . " " . $postResult[$k]["rec_surname"]);
                $rowCount++;
            }
            $spreadsheet->getActiveSheet()
                ->getStyle('A:F')
                ->getAlignment()
                ->setWrapText(true);

            $spreadsheet->getActiveSheet()
                ->getRowDimension($rowCount)
                ->setRowHeight(-1);
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        header('Content-Type: text/xls');
        $fileName = 'exported_excel_' . time() . '.xls';
        $headerContent = 'Content-Disposition: attachment;filename="' . $fileName . '"';
        header($headerContent);
        $writer->save('php://output');
    }
}
