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
                                <strong class="card-title">ออกใบเสร็จสำหรับบุคคล</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="name_title" class="control-label mb-1">คำนำหน้าชื่อ <span style="color:red;">*</span></label>
                                                <input type="text" name="name_title" class="form-control" list="cars" required>
                                                <datalist id="cars">
                                                    <option value="นาย" />
                                                    <option value="นาง" />
                                                    <option value="นางสาว" />
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_name" class="control-label mb-1">ชื่อ <span style="color:red;">*</span></label>
                                                <input type="text" name="rec_name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_surname" class="control-label mb-1">สกุล <span style="color:red;">*</span></label>
                                                <input type="text" name="rec_surname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_tel" class="control-label mb-1">เบอร์โทรศัพท์</label>
                                                <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_email" class="control-label mb-1">อีเมล์</label>
                                                <input type="text" name="rec_email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_idname" class="control-label mb-1">เลขบัตรประชาชน <span style="color:red;">*</span></label>
                                                <input type="text" required tabindex="1" placeholder="x-xxxxx-xxxxx-xx-x" name="rec_idname" id="rec_idname" size="25" value="" class="form-control" onkeyup="autoTab(this)" minlength="13" maxlength="20" />
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
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">ที่อยู่ <span style="color:red;">*</span></label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="road" class="control-label mb-1">ถนน</label>
                                                <input type="text" name="road" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="provinces" class="control-label mb-1">จังหวัด <span style="color:red;">*</span></label>
                                                <input type="text" name="provinces" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="amphures" class="control-label mb-1">อำเภอ <span style="color:red;">*</span></label>
                                                <input type="text" name="amphures" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="districts" class="control-label mb-1">ตำบล <span style="color:red;">*</span></label>
                                                <input type="text" name="districts" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="zip_code" class="control-label mb-1">รหัสไปรษณีย์</label>
                                                <input type="text" name="zip_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_date-s" class="control-label mb-1">วันที่รับเงิน <span style="color:red;">*</span></label>
                                                <input type="date" name="rec_date_s" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="rec_date-out" class="control-label mb-1">วันที่ออกใบเสร็จ <span style="color:red;">*</span></label>
                                                <input type="date" name="rec_date_out" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="amount" class="control-label mb-1">จำนวนเงินที่บริจาค <span style="color:red;">*</span></label>
                                                <input type="text" name="amount" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <div class="form-group">
                                                <label for="payby" class="control-label mb-1">ชำระโดย <span style="color:red;">*</span></label>
                                                <input type="text" name="payby" class="form-control" list="pay" required>
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
                                                </select>
                                            </div>
                                            <input type="hidden" name="edo_pro_id" id="edo_pro_id">
                                            <input type="hidden" name="edo_description" id="edo_description">
                                            <input type="hidden" name="edo_objective" id="edo_objective">
                                        </div>

                                        <script>
                                            // เมื่อเลือกตัวเลือกใน <select>
                                            document.getElementById('edo_name').addEventListener('change', function() {
                                                var selectedOption = this.options[this.selectedIndex];

                                                // รับค่าจาก data attributes และกำหนดค่าให้กับตัวแปรที่ต้องการ
                                                document.getElementById('edo_pro_id').value = selectedOption.getAttribute('data-pro-id');
                                                document.getElementById('edo_description').value = selectedOption.getAttribute('data-description');
                                                document.getElementById('edo_objective').value = selectedOption.getAttribute('data-objective');
                                            });
                                        </script>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="comment" class="control-label mb-1">หมายเหตุ</label>
                                                <input type="text" name="comment" class="form-control">
                                            </div>
                                        </div>
                                        <input type="hidden" name="status_donat" value="offline" class="form-control">
                                        <input type="hidden" name="status_user" value="person" class="form-control">
                                    </div>
                                    <hr>
                                    <div class="btn-group col-12">
                                        <button type="submit" class="btn btn-success btn-block">ยืนยันการออกใบเสร็จ(บุคคล)</button>
                                    </div>
                                </form>
                                <?php require_once 'recript_add.php'; ?>
                                <!-- <?php
                                        echo '<pre>';
                                        print_r($_POST);
                                        echo '</pre>';
                                        ?> -->
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