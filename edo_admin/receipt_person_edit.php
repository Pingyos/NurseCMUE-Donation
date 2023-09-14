<?php
// session_start();

// // ตรวจสอบสถานะการเข้าสู่ระบบ
// if (isset($_SESSION['login_info'])) {
//     // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
//     $login_info = $_SESSION['login_info'];
// } else {
//     // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
//     header("Location: login.php");
//     exit;
// }
// ตรวจสอบการlogin
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
                                <strong class="card-title">แก้ไขใบเสร็จบุคคล</strong>
                            </div>
                            <?php
                            if (isset($_GET['id'])) {
                                require_once 'connection.php';
                                $stmt = $conn->prepare("SELECT* FROM receipt_offline WHERE id=?");
                                $stmt->execute([$_GET['id']]);
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
                                                <label for="name_title" class="control-label mb-1">คำนำหน้าชื่อ </label>
                                                <input type="text" name="name_title" class="form-control" list="cars" value="<?= $row['name_title']; ?>">
                                                <datalist id="cars">
                                                    <option value="นาย" />
                                                    <option value="นาง" />
                                                    <option value="นางสาว" />
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_name" class="control-label mb-1">ชื่อ </label>
                                                <input type="text" name="rec_name" class="form-control" value="<?= $row['rec_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_surname" class="control-label mb-1">สกุล </label>
                                                <input type="text" name="rec_surname" class="form-control" value="<?= $row['rec_surname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_tel" class="control-label mb-1">เบอร์โทรศัพท์</label>
                                                <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*" value="<?= $row['rec_tel']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_email" class="control-label mb-1">อีเมล์</label>
                                                <input type="text" name="rec_email" class="form-control" value="<?= $row['rec_email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="rec_idname" class="control-label mb-1">เลขบัตรประชาชน </label>
                                                <input type="text" tabindex="1" placeholder="x-xxxxx-xxxxx-xx-x" name="rec_idname" id="rec_idname" size="25" value="<?= $row['rec_idname']; ?>" class="form-control" onkeyup="autoTab(this)" minlength="13" maxlength="20" />
                                            </div>
                                            <script>
                                                function autoTab(obj) {
                                                    var pattern = new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
                                                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
                                                    var returnText = new String("");
                                                    var obj_l = obj.value.length;
                                                    var obj_l2 = obj_l - 1;
                                                    for (i = 0; i < pattern.length; i++) {
                                                        if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                                                            returnText += obj.value + pattern_ex;
                                                            obj.value = returnText;
                                                        }
                                                    }
                                                    if (obj_l >= pattern.length) {
                                                        obj.value = obj.value.substr(0, pattern.length);
                                                    }
                                                }
                                            </script>
                                        </div>
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
                                    </div>
                                    <br>
                                    <div class="row">
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
                                    </div>
                                    <br>
                                    <div class="row">
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
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="amount" class="control-label mb-1">จำนวนเงินที่บริจาค </label>
                                                <input type="text" name="amount" class="form-control" value="<?= $row['amount']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-3">
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
                                                <label for="comment" class="control-label mb-1">หมายเหตุ</label>
                                                <input type="text" name="comment" class="form-control" value="<?= $row['comment']; ?>">
                                            </div>
                                        </div>
                                        <input type="text" name="status_donat" value="offline" hidden>
                                        <input type="text" name="status_user" value="person" hidden>
                                        <input type="hidden" name="status_receipt" value="yes" class="form-control">
                                        <input type="hidden" name="resDesc" value="success">
                                        <input type="text" name="id" value="<?= $row['id']; ?>" hidden>
                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="edo_name" class="control-label mb-1">โครงการ <span style="color:red;">*</span></label>
                                                <select name="edo_name" id="edo_name" class="form-control" required>
                                                    <option value="">เลือกโครงการ</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    try {
                                                        $query = "SELECT edo_name, edo_pro_id, edo_description, edo_objective FROM pro_offline";
                                                        $result = $conn->query($query);

                                                        // สร้างตัวเลือก
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='" . $row['edo_name'] . "' data-pro-id='" . $row['edo_pro_id'] . "' data-description='" . $row['edo_description'] . "' data-objective='" . $row['edo_objective'] . "'>" . $row['edo_name'] . "</option>";
                                                        }
                                                    } catch (PDOException $e) {
                                                        echo "Query failed: " . $e->getMessage();
                                                    }
                                                    ?>
                                                    <option value="">อื่นๆ</option>
                                                </select>
                                            </div>
                                            &nbsp;
                                            <div class="form-group" id="otherFields" style="display: none;">
                                                <label for="other_description" class="control-label mb-1">โครงการอื่นๆ <span style="color:red;">*</span></label>
                                                <input type="text" name="other_description" class="form-control" placeholder="โปรดระบุชื่อโครงการ">
                                            </div>
                                            <input type="hidden" name="edo_pro_id" id="edo_pro_id">
                                            <input type="hidden" name="edo_description" id="edo_description">
                                            <input type="hidden" name="edo_objective" id="edo_objective">
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var edoNameSelect = document.getElementById('edo_name');
                                                var edoProIdInput = document.getElementsByName('edo_pro_id')[0];
                                                var descriptionInput = document.getElementById('edo_description');
                                                var objectiveInput = document.getElementById('edo_objective');
                                                var otherDescriptionInput = document.getElementsByName('other_description')[0];
                                                var otherFieldsDiv = document.getElementById('otherFields');

                                                edoNameSelect.addEventListener('change', function() {
                                                    var selectedOption = edoNameSelect.options[edoNameSelect.selectedIndex];

                                                    descriptionInput.value = selectedOption.getAttribute('data-description');

                                                    if (selectedOption.value === '') {
                                                        otherFieldsDiv.style.display = 'block';
                                                        edoProIdInput.value = '121208';
                                                        objectiveInput.value = otherDescriptionInput.value; // รับค่าจาก otherDescriptionInput
                                                    } else {
                                                        otherFieldsDiv.style.display = 'none';
                                                        edoProIdInput.value = selectedOption.getAttribute('data-pro-id');
                                                        objectiveInput.value = selectedOption.getAttribute('data-objective');
                                                    }
                                                });

                                                otherDescriptionInput.addEventListener('input', function() {
                                                    descriptionInput.value = otherDescriptionInput.value;
                                                    objectiveInput.value = otherDescriptionInput.value; // รับค่าจาก otherDescriptionInput
                                                });
                                            });
                                        </script>

                                        <script>
                                            document.getElementById('edo_name').addEventListener('change', function() {
                                                var selectedOption = this.options[this.selectedIndex];
                                                document.getElementById('edo_pro_id').value = selectedOption.getAttribute('data-pro-id');
                                                document.getElementById('edo_description').value = selectedOption.getAttribute('data-description');
                                                document.getElementById('edo_objective').value = selectedOption.getAttribute('data-objective');
                                            });
                                        </script>

                                    </div>
                                    <hr>
                                    <div class="btn-group col-12">
                                        <button type="submit" class="btn btn-success btn-block">ยืนยันการออกใบเสร็จ(บุคคล)</button>
                                    </div>
                                </form>
                                <?php require_once 'recript_edit.php'; ?>
                            </div>
                        </div>
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