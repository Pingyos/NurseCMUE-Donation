<?php 
require_once 'connection.php';
$receipt_id = $_GET['receipt_id'];
$pdflink = "https://app.nurse.cmu.ac.th/edonation/edo_admin/pdf_recrip_cc.php?receipt_id=$receipt_id&ACTION=VIEW";
$amount = 0; // ค่า amount ที่คุณต้องการอัปเดต

$updateSql = "UPDATE receipt SET receipt_cc = 'cancel', amount = :amount, pdflink = :pdflink WHERE receipt_id = :receipt_id";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bindParam(':receipt_id', $receipt_id);
$updateStmt->bindParam(':amount', $amount);
$updateStmt->bindParam(':pdflink', $pdflink);

$updateResult = $updateStmt->execute();

if ($updateResult) {
    // สำเร็จ
    echo '
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script>
        function showSweetAlert() {
            $(document).ready(function () {
                Swal.fire({
                    title: "ยกเลิกใบเสร็จ สำเร็จ", 
                    text: "ใบเสร็จนี้ถูกยกเลิกแล้ว",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                }).then(function () {
                    window.location.href = "showdata_offline.php"; 
                });
            });
        }

        showSweetAlert();
    </script>';
} else {
    // ไม่สำเร็จ
    echo '
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script>
        function showSweetAlert() {
            $(document).ready(function () {
                Swal.fire({
                    title: "ยกเลิกใบเสร็จ ไม่สำเร็จ", 
                    text: "กรุณารอสักครู่",
                    icon: "error",
                    timer: 3000,
                    showConfirmButton: false
                }).then(function () {
                    window.location.href = "showdata_offline.php"; 
                });
            });
        }

        showSweetAlert();
    </script>';
}
