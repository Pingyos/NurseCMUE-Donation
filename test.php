<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Table</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</head>

<body>
    <table id="myTable" class="display" style="width: 100%;">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ-นามสกุล</th>
                <th>รายชื่อโครงการ</th>
                <th>ใบเสร็จรับเงิน</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'connection.php';
            $stmt = $conn->prepare("SELECT * FROM receipt_offline");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $result = array_reverse($result); // เรียงลำดับข้อมูลใหม่โดยพลิกลำดับของอาร์เรย์
            $countrow = 1;
            foreach ($result as $t1) {
            ?>
                <tr>
                    <td><?= $countrow ?></td>
                    <td><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></td>
                    <td><?= $t1['edo_name']; ?></td>

                    <td>
                        <a href="pdf_maker.php?id=<?php echo $t1['id']; ?>&ACTION=VIEW" target="_blank" class="custom-btn1 btn"><i class="fa fa-file-pdf-o"></i> เปิด</a>
                    </td>
                </tr>
            <?php $countrow++;
            }
            ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>
</body>

</html>