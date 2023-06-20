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
                            <?php
                            require_once 'connection.php';
                            $stmt = $conn->prepare("SELECT* FROM pro_offline");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $t1)
                            ?>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="name_Title" class="control-label mb-1">คำนำหน้าชื่อ</label>
                                                <input type="text" name="name_Title" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_fullname" class="control-label mb-1">ชื่อ-สกุล</label>
                                                <input type="text" name="rec_fullname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_tel" class="control-label mb-1">เบอร์โทรศัพท์</label>
                                                <input type="text" name="rec_tel" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_email" class="control-label mb-1">อีเมล์</label>
                                                <input type="text" name="rec_email" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_idname" class="control-label mb-1">เลขบัตรประชาชน</label>
                                                <input type="text" name="rec_idname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">ที่อยู่</label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="road" class="control-label mb-1">ถนน</label>
                                                <input type="text" name="road" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="provinces" class="control-label mb-1">จังหวัด</label>
                                                <input type="text" name="provinces" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="amphures" class="control-label mb-1">อำเภอ</label>
                                                <input type="text" name="amphures" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="districts" class="control-label mb-1">ตำบล</label>
                                                <input type="text" name="districts" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="zip_code" class="control-label mb-1">รหัสไปรษณีย์</label>
                                                <input type="text" name="zip_code" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_date" class="control-label mb-1">วันที่ออกใบเสร็จ</label>
                                                <input type="date" name="rec_date" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_name" class="control-label mb-1">โครงการ </label>
                                                <select name="edo_name" id="edo_name" class="form-control" required>
                                                    <option value="">เลือกโครงการ</option>
                                                    <?php
                                                foreach ($result as $t1) {
                                                    echo "<option value='" . $t1['edo_name'] . "' data-id='" . $t1['edo_pro_id'] . "'>" . $t1['edo_name'] . "</option>";
                                                }
                                                    ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="edo_pro_id" id="edo_pro_id">
                                            <input type="hidden" name="edo_description" id="edo_description">
                                            <input type="hidden" name="edo_objective" id="edo_objective">
                                        </div>

                                        <script>
                                            // เลือกตัวองค์ประกอบที่เกี่ยวข้อง
                                            var edoNameSelect = document.getElementById('edo_name');
                                            var edoProIdInput = document.getElementById('edo_pro_id');
                                            var edoDescriptionInput = document.getElementById('edo_description');
                                            var edoObjectiveInput = document.getElementById('edo_objective');

                                            // ดักจับเหตุการณ์เมื่อมีการเลือกค่าใน edo_name
                                            edoNameSelect.addEventListener('change', function() {
                                                // รับค่าที่ถูกเลือก
                                                var selectedOption = edoNameSelect.options[edoNameSelect.selectedIndex];
                                                var selectedEdoName = selectedOption.value;
                                                var selectedEdoProId = selectedOption.getAttribute('data-id');

                                                // กำหนดค่าให้กับ hidden input elements
                                                edoProIdInput.value = selectedEdoProId;
                                                edoDescriptionInput.value = selectedEdoName;
                                                edoObjectiveInput.value = selectedEdoName;
                                            });
                                        </script>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_money" class="control-label mb-1">จำนวนเงินที่บริจาค</label>
                                                <input type="text" name="rec_money" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="payby" class="control-label mb-1">ชำระแบบ</label>
                                                <input type="text" name="payby" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">ออกใบเสร็จ</button>
                                </form>
                                <?php require_once 'recript_add.php'; ?>
                                <?php
                                echo '<pre>';
                                print_r($_POST);
                                echo '</pre>';
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