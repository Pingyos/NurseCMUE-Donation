<?php
// require_once 'session.php';
require_once 'head.php'; ?>
<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="show-me-2">
                            <div class="card-header">
                                <strong class="card-title">แก้ไขเสร็จนิติบุคคล</strong>
                            </div>
                            <?php
                            if (isset($_GET['receipt_id'])) {
                                require_once 'connection.php';
                                $stmt = $conn->prepare("SELECT* FROM receipt WHERE receipt_id=?");
                                $stmt->execute([$_GET['receipt_id']]);
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
                                if ($stmt->rowCount() < 1) {
                                    header('Location: index.php');
                                    exit();
                                }
                            } //isset
                            ?>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_name" class="control-label mb-1">นิติบุคลล/บริษัท </label>
                                                <input type="text" name="rec_name" class="form-control" value="<?= $row['rec_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_idname" class="control-label mb-1">เลขประจำตัวผู้เสียภาษี </label>
                                                <input type="number" name="rec_idname" class="form-control" pattern="[0-9]*" value="<?= $row['rec_idname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_tel" class="control-label mb-1">เบอร์โทรศัพท์</label>
                                                <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*" value="<?= $row['rec_tel']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3 ">
                                            <div class="form-group">
                                                <label for="rec_email" class="control-label mb-1">อีเมล์</label>
                                                <input type="text" name="rec_email" value="<?= $row['rec_email']; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">ที่อยู่ </label>
                                                <input type="text" name="address" class="form-control" value="<?= $row['address']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="road" class="control-label mb-1">ถนน</label>
                                                <input type="text" name="road" class="form-control" value="<?= $row['road']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="provinces" class="control-label mb-1">จังหวัด </label>
                                                <input type="text" name="provinces" class="form-control" value="<?= $row['provinces']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="amphures" class="control-label mb-1">อำเภอ </label>
                                                <input type="text" name="amphures" class="form-control" value="<?= $row['amphures']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="districts" class="control-label mb-1">ตำบล </label>
                                                <input type="text" name="districts" class="form-control" value="<?= $row['districts']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="zip_code" class="control-label mb-1">รหัสไปรษณีย์</label>
                                                <input type="text" name="zip_code" class="form-control" value="<?= $row['zip_code']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_date-s" class="control-label mb-1">วันที่รับเงิน </label>
                                                <input type="date" name="rec_date_s" class="form-control" value="<?= $row['rec_date_s']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_date-out" class="control-label mb-1">วันที่ออกใบเสร็จ </label>
                                                <input type="date" name="rec_date_out" class="form-control" value="<?= $row['rec_date_out']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="amount" class="control-label mb-1">จำนวนเงินที่บริจาค </label>
                                                <input type="text" name="amount" class="form-control" value="<?= $row['amount']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="payby" class="control-label mb-1">ชำระโดย </label>
                                                <input type="text" name="payby" class="form-control" list="pay" value="<?= $row['payby']; ?>">
                                                <datalist id="pay">
                                                    <option value="เงินสด / Cash" />
                                                    <option value="โอน / Prompt Pay" />
                                                    <option value="เช็ค / Cheque" />
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_description" class="control-label mb-1">โครงการ</label>
                                                <input type="text" name="edo_description" class="form-control" value="<?= $row['edo_description']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_pro_id" class="control-label mb-1">หมายเลขโครงการ</label>
                                                <input type="text" name="edo_pro_id" class="form-control" value="<?= $row['edo_pro_id']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="comment" class="control-label mb-1">หมายเหตุ</label>
                                                <input type="text" name="comment" class="form-control" value="<?= $row['comment']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="name_title" value="<?= $row['name_title']; ?>">
                                    <input type="hidden" name="rec_surname" value="<?= $row['rec_surname']; ?>">
                                    <input type="hidden" name="resDesc" value="success">
                                    <input type="hidden" name="status_donat" value="offline">
                                    <input type="hidden" name="status_user" value="corporation">
                                    <input type="hidden" name="status_receipt" value="yes" class="form-control">
                                    <input type="hidden" name="pdflink" value="<?= $row['pdflink']; ?>">
                                    <input type="hidden" name="ref1" value="<?= $row['ref1']; ?>">
                                    <input type="hidden" name="id_receipt" value="<?= $row['id_receipt']; ?>">
                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                    <input type="hidden" name="edo_objective" value="<?= $row['edo_objective']; ?>">
                                    <input type="hidden" name="edo_name" value="<?= $row['edo_name']; ?>">
                                    <input type="hidden" name="other_description" value="<?= $row['other_description']; ?>">
                                    <input type="hidden" name="receipt_cc" value="<?= $row['receipt_cc']; ?>">
                                    <hr>
                                    <div class="btn-group col-12">
                                        <button type="submit" class="btn btn-primary btn-block">ยืนยันการออกใบเสร็จ(นิติบุคคล)</button>
                                    </div>
                                </form>
                                <?php
                                require_once 'recript_edit.php';
                                // echo '<pre>';
                                // print_r($_POST);
                                // echo '</pre>';
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>
</body>

</html>