<?php
require_once 'connection.php';
$rec_idname = $_GET['rec_idname'];
$rec_date_out = $_GET['rec_date_out'];
$timeout = time() + 200;

function checkForData($conn)
{
    global $rec_idname, $rec_date_out, $timeout;
    while (time() <= $timeout) {
        $sql = "SELECT * FROM json_confirm WHERE billPaymentRef2 = :rec_idname AND date = :rec_date_out";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rec_idname', $rec_idname);
        $stmt->bindParam(':rec_date_out', $rec_date_out);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                $id = $_GET['id'];
                echo '
                                        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                        <script>
                                            $(document).ready(function() {
                                                swal({
                                                    title: "ชำระเงินเสร็จสิ้น",
                                                    text: "ระบบกำลังเปิดใบเสร็จ",
                                                    type: "success",
                                                    timer: 5000,
                                                    showConfirmButton: false
                                                });
                                                setTimeout(function() {
                                                    window.location.href = "pdf_maker.php?id=' . $id . '&ACTION=VIEW";
                                                }, 3000);
                                            });
                                        </script>';
                exit;
            }
        }
    }
    echo 'hello';
}

checkForData($conn);
