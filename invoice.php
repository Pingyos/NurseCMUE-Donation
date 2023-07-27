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

                            <body>
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
                                        $stmt = $conn->prepare("SELECT * FROM receipt_offline WHERE status_donat = 'online'");
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
                                                    <button type="button" data-toggle="modal" data-target="#mediumModal" class="custom-btn1 btn">รหัสผ่าน</button>
                                                    <a href="pdf_maker.php?id=<?php echo $t1['id']; ?>&ACTION=VIEW" target="_blank" class="custom-btn1 btn">ใบเสร็จ</a>
                                                </td>
                                            </tr>
                                        <?php $countrow++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </body>
                        </form>
                        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mediumModalLabel">กรุณาใส่รหัสผ่าน</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="password" id="passwordInput" class="form-control" placeholder="กรอกรหัสผ่าน">
                                        <!-- ส่งค่า rec_idname ที่เกี่ยวข้องกับ id ที่ต้องการเปิดใน input hidden -->
                                        <input type="hidden" id="recIdInput" value="<?php echo $t1['rec_idname']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="checkPassword()">ยืนยัน</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function checkPassword() {

                                var enteredPassword = document.getElementById("passwordInput").value;
                                var correctPassword = document.getElementById("recIdInput").value;
                                if (enteredPassword === correctPassword) {
                                    var idToOpen = <?php echo $t1['id']; ?>;
                                    var recIdToOpen = correctPassword;
                                    var url = "pdf_maker.php?id=" + idToOpen + "&rec_idname=" + recIdToOpen + "&ACTION=VIEW";
                                    window.open(url, "_blank");
                                } else {
                                    alert("รหัสผ่านไม่ถูกต้อง");
                                }
                            }
                        </script>
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