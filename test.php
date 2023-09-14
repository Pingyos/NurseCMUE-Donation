<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                    <script>
                        $(document).ready(function() {
                            // แสดงคำเตือนเพื่อประโยชน์ในการลดหย่อนภาษี
                            swal({
                                title: "เพื่อประโยชน์ในการลดหย่อนภาษี",
                                text: "กรุณาใช้บัญชีอิเล็กทรอนิกส์ของตัวท่านเอง",
                                type: "warning",
                                showConfirmButton: true,
                                confirmButtonText: "ตกลง"
                            }).then(function(result) {
                                if (result.value) {
                                    <?php
                                    require_once 'connection.php';
                                    $rec_idname = $_GET['rec_idname'];
                                    $rec_date_out = $_GET['rec_date_out'];

                                    $sql = "SELECT * FROM json_confirm WHERE billPaymentRef2 = :rec_idname AND date = :rec_date_out";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':rec_idname', $rec_idname, PDO::PARAM_STR);
                                    $stmt->bindParam(':rec_date_out', $rec_date_out, PDO::PARAM_STR);

                                    while (true) {
                                        $stmt->execute();
                                        if ($stmt->rowCount() > 0) {
                                            echo '
                                                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                <script>
                                                    $(document).ready(function() {
                                                        swal({
                                                            title: "คำเตือน",
                                                            text: "มีข้อมูลเข้ามาแล้ว",
                                                            type: "warning"
                                                        }, function() {
                                                        window.location.href = "invoice.php";
                                                        });
                                                    });
                                                </script>';
                                            break;
                                        } else {
                                            sleep(5);
                                        }
                                    }
                                    ?>
                                }
                            });
                        });
                    </script>