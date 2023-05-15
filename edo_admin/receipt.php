<?php
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="activity" class="control-label mb-1">รายละเอียดโครงการ</label>
                                                <select name="edo_name" required class="form-control">
                                                    <option value="0">-</option>
                                                    <option value="โครงการบริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่">โครงการบริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</option>
                                                    <option value="โครงการระดมพลังเพื่อเร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มช.">โครงการระดมพลังเพื่อเร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มช.</option>
                                                    <option value="โครงการบริจาคเพื่อสาธารณประโยชน์และการกุศลอื่น ๆ">โครงการบริจาคเพื่อสาธารณประโยชน์และการกุศลอื่น ๆ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="control-label">คำนำหน้าชื่อ <span style="color:red;">*</span></label>
                                                <select name="name_Title" class="form-control" onchange="showInput1(this)" required>
                                                    <option value="">ไม่ระบุคำนำหน้า</option>
                                                    <option value="นาย">นาย</option>
                                                    <option value="นาง">นาง</option>
                                                    <option value="นางสาว">นางสาว</option>
                                                    <option value="">อื่นๆ</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="rec_fullname" class="control-label mb-1">ชื่อ-สกุล <span style="color:red;">*</span></label>
                                                <input type="text" name="rec_fullname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="rec_money" class="control-label mb-1">จำนวนเงิน <span style="color:red;">*</span></label>
                                                <input type="text" name="rec_money" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="rec_tel" class="control-label mb-1">เบอร์โทรศัพท์</label>
                                                <input type="text" name="rec_tel" class="form-control" minlength="8" maxlength="10" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="rec_idname" class="control-label mb-1">เลขบัตรประชาชน</label>
                                                <input type="text" name="rec_idname" class="form-control" minlength="12" maxlength="13" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">ที่อยู่</label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="road" class="control-label mb-1">ถนน</label>
                                                <input type="text" name="road" class="form-control">
                                            </div>
                                        </div>
                                        <?php
                                        require_once('../ajax_db.php');
                                        $sql_provinces = "SELECT * FROM provinces";
                                        $query = mysqli_query($con, $sql_provinces);
                                        ?>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1">จังหวัด <span style="color:red;">*</span></label>
                                                <select class="form-control" name="provinces" id="provinces" required>
                                                    <option value="" selected disabled></option>
                                                    <?php foreach ($query as $value) { ?>
                                                        <option value="<?= $value['id'] ?>"><?= $value['name_th'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="control-label">อำเภอ <span style="color:red;">*</span></label>
                                                <select class="form-control" name="amphures" id="amphures" required>
                                                    <option selected disabled></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label class="control-label">ตำบล <span style="color:red;">*</span></label>
                                                <select class="form-control" name="districts" id="districts" required>
                                                    <option selected disabled></option>
                                                </select>
                                            </div>
                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                            <script type="text/javascript">
                                                $('#provinces').change(function() {
                                                    var id_province = $(this).val();

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../ajax_db.php",
                                                        data: {
                                                            id: id_province,
                                                            function: 'provinces'
                                                        },
                                                        success: function(data) {
                                                            $('#amphures').html(data);
                                                            $('#districts').html(' ');
                                                            $('#districts').val(' ');
                                                            $('#zip_code').val(' ');
                                                        }
                                                    });
                                                });

                                                $('#amphures').change(function() {
                                                    var id_amphures = $(this).val();

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../ajax_db.php",
                                                        data: {
                                                            id: id_amphures,
                                                            function: 'amphures'
                                                        },
                                                        success: function(data) {
                                                            $('#districts').html(data);
                                                        }
                                                    });
                                                });

                                                $('#districts').change(function() {
                                                    var id_districts = $(this).val();

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "../ajax_db.php",
                                                        data: {
                                                            id: id_districts,
                                                            function: 'districts'
                                                        },
                                                        success: function(data) {
                                                            $('#zip_code').val(data)
                                                        }
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="date_s" class="control-label mb-1">วันที่ออกเอกสาร</label>
                                                <input type="date" name="date_s" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="by" class="control-label mb-1">การรับเงิน</label>
                                                <input type="text" name="by" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-12 mt-2">
                                            <button type="submit" class="btn btn-primary btn-block">ออกใบเสร็จ</button>
                                            <?php echo '<pre>';
                                            print_r($_POST);
                                            echo '</pre>';
                                            ?>
                                        </div>
                                    </div>
                                </form>
                                <?php require_once 'recript_add.php'; ?>
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