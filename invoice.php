<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>
<?php require_once('header.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <table id="myTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>โครงการ</th>
                                        <th>รายละเอียดใบเสร็จ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once 'connection.php';
                                    $stmt = $conn->prepare("SELECT * FROM receipt_offline WHERE status_donat = 'online' AND status_receipt = 'yes'");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    $result = array_reverse($result); // เรียงลำดับข้อมูลใหม่โดยพลิกลำดับของอาร์เรย์
                                    $countrow = 1;
                                    foreach ($result as $t1) {
                                    ?>
                                        <tr>
                                            <td><?= $countrow ?></td>
                                            <td>
                                                <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                <br>
                                                <span style="color: orange;"><?= date('d/m/Y', strtotime($t1['rec_date_out'])); ?></span> /
                                                <span style="color: orange;">E<?= str_pad($t1['id'], 4, '0', STR_PAD_LEFT); ?></span>
                                            </td>
                                            <td><?= $t1['edo_name']; ?></td>
                                            <td>
                                                <button class="custom-btn1 btn" onclick="viewReceipt('<?= $t1['id']; ?>', '<?= $t1['rec_idname']; ?>')">ดูใบเสร็จ</button>
                                            </td>
                                            <script>
                                                function viewReceipt(receiptId, recIdName) {
                                                    var enteredId = prompt('กรุณากรอกเลขบัตรประชาชน:');
                                                    if (enteredId === recIdName) {
                                                        var pdfUrl = 'pdf_maker.php?id=' + receiptId + '&ACTION=VIEW';
                                                        window.open(pdfUrl, '_blank');
                                                    } else {
                                                        alert('เลขบัตรประชาชนไม่ถูกต้อง กรุณากรอกใหม่');
                                                    }
                                                }
                                            </script>
                                        </tr>
                                    <?php $countrow++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<script>
    $(document).ready(function() {
        $("#myTable").DataTable();
    });
</script>

</html>