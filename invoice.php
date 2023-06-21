<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <table class="table table-striped" id="">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>โครงการ</th>
                                        <th>ใบเสร็จรับเงิน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once 'connection.php';
                                    $stmt = $conn->prepare("SELECT * FROM receipt_online");
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
                                            <td><?= $t1['rec_money']; ?></td>
                                            <td><?= $t1['rec_date_out']; ?></td>
                                            <td>
                                                <a href="pdf_maker.php?id=<?php echo $t1['id']; ?>&ACTION=VIEW" target="_blank" class="custom-btn1 btn"><i class="fa fa-file-pdf-o"></i> เปิด</a>
                                                <a href="pdf_maker.php?id=<?php echo $t1['id']; ?>&ACTION=DOWNLOAD" target="_blank" class="custom-btn1 btn"><i class="fa fa-download"></i> ดาวน์โหลด</a>
                                            </td>
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
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>