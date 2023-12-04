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
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">ออกใบเสร็จสำหรับบุคคล</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="selectnaem" class="control-label mb-1">ข้อมูลผู้บริจาค</label>
                                                <select id="selectnaem" class="form-control" onchange="displaySelectedData()">
                                                    <option>เลือกข้อมูลผู้บริจาค</option>
                                                    <?php
                                                    require_once 'connection.php';
                                                    try {
                                                        $query = "SELECT DISTINCT name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code FROM receipt WHERE status_receipt = 'yes'";
                                                        $result = $conn->query($query);
                                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                            $full_name = $row['name_title'] . ' ' . $row['rec_name'] . ' ' . $row['rec_surname'] . ' ' . $row['rec_tel'] . ' ' . $row['rec_email'] . ' ' . $row['rec_idname'] . ' ' . $row['address'] . ' ' . $row['road'] . ' ' . $row['districts'] . ' ' . $row['amphures'] . ' ' . $row['provinces'] . ' ' . $row['zip_code'];
                                                            echo "<option value='" . $full_name . "'>" . $full_name . "</option>";
                                                        }
                                                    } catch (PDOException $e) {
                                                        echo "Query failed: " . $e->getMessage();
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function displaySelectedData() {
                                            var select = document.getElementById("selectnaem");
                                            var selectedOption = select.options[select.selectedIndex].text;

                                            // ตัวแปรที่จะใช้เก็บค่าที่ได้จากการ split
                                            var selectedTitle, selectedName, selectedSurname, selectedTel, selectedEmail, selectedIdName, selectedAddress, selectedRoad, provincesInput, amphuresInput, districtsInput, selectedZipCode;

                                            // ให้ค่าตามลำดับที่คุณต้องการ
                                            selectedTitle = selectedOption.split(" ")[0]; // คำนำหน้า
                                            selectedName = selectedOption.split(" ")[1]; // ชื่อ
                                            selectedSurname = selectedOption.split(" ")[2]; // สกุล
                                            selectedTel = selectedOption.split(" ")[3]; // เบอร์โทรศัพท์
                                            selectedEmail = selectedOption.split(" ")[4]; // อีเมล์
                                            selectedIdName = selectedOption.split(" ")[5]; // เลขบัตรประชาชน
                                            selectedAddress = selectedOption.split(" ")[6]; // ที่อยู่
                                            selectedRoad = selectedOption.split(" ")[7]; // ถนน
                                            provincesInput = selectedOption.split(" ")[8]; // จังหวัด
                                            amphuresInput = selectedOption.split(" ")[9]; // อำเภอ
                                            districtsInput = selectedOption.split(" ")[10]; // ตำบล
                                            selectedZipCode = selectedOption.split(" ")[11]; // รหัสไปรษณีย์

                                            // กำหนดค่าลงใน element ต่าง ๆ
                                            document.getElementById("selectedTitle").value = selectedTitle;
                                            document.getElementById("selectedName").value = selectedName;
                                            document.getElementById("selectedSurname").value = selectedSurname;
                                            document.getElementById("selectedTel").value = selectedTel;
                                            document.getElementById("selectedEmail").value = selectedEmail;
                                            document.getElementById("selectedIdName").value = selectedIdName;
                                            document.getElementById("selectedAddress").value = selectedAddress;
                                            document.getElementById("selectedRoad").value = selectedRoad;
                                            document.getElementById("provincesInput").value = provincesInput;
                                            document.getElementById("amphuresInput").value = amphuresInput;
                                            document.getElementById("districtsInput").value = districtsInput;
                                            document.getElementById("selectedZipCode").value = selectedZipCode;
                                        }
                                    </script>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="name_title" class="control-label mb-1">คำนำหน้าชื่อ <span style="color:red;"></span></label>
                                                <input type="text" name="name_title" class="form-control" id="selectedTitle" list="cars">
                                                <datalist id="cars">
                                                    <option value="นาย" />
                                                    <option value="นาง" />
                                                    <option value="นางสาว" />
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_name" class="control-label mb-1">ชื่อ <span style="color:red;"></span></label>
                                                <input type="text" name="rec_name" class="form-control" id="selectedName" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_surname" class="control-label mb-1">สกุล <span style="color:red;"></span></label>
                                                <input type="text" name="rec_surname" class="form-control" id="selectedSurname" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_tel" class="control-label mb-1">เบอร์โทรศัพท์</label>
                                                <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*" id="selectedTel">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_email" class="control-label mb-1">อีเมล์</label>
                                                <input type="text" name="rec_email" class="form-control" id="selectedEmail">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_idname" class="control-label mb-1">เลขบัตรประชาชน <span style="color:red;"></span></label>
                                                <input type="text" name="rec_idname" class="form-control" id="selectedIdName" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="address" class="control-label mb-1">ที่อยู่ <span style="color:red;"></span></label>
                                                <input type="text" name="address" class="form-control" id="selectedAddress">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="road" class="control-label mb-1">ถนน</label>
                                                <input type="text" name="road" class="form-control" id="selectedRoad">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="provinces" class="control-label mb-1">จังหวัด <span style="color:red;"></span></label>
                                                <input type="text" name="provinces" class="form-control" id="provincesInput">

                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="amphures" class="control-label mb-1">อำเภอ <span style="color:red;"></span></label>
                                                <input type="text" name="amphures" id="amphuresInput" class="form-control">

                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="districts" class="control-label mb-1">ตำบล <span style="color:red;"></span></label>
                                                <input type="text" name="districts" id="districtsInput" class="form-control">

                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="zip_code" class="control-label mb-1">รหัสไปรษณีย์</label>
                                                <input type="text" name="zip_code" class="form-control" id="selectedZipCode">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_date-s" class="control-label mb-1">วันที่รับเงิน <span style="color:red;">*</span></label>
                                                <input type="date" name="rec_date_s" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="rec_date-out" class="control-label mb-1">วันที่ออกใบเสร็จ <span style="color:red;">*</span></label>
                                                <input type="date" name="rec_date_out" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="amount" class="control-label mb-1">จำนวนเงินที่บริจาค <span style="color:red;">*</span></label>
                                                <input type="text" name="amount" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
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
                                                    objectiveInput.value = otherDescriptionInput.value;
                                                });
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
                                        <input type="hidden" name="status_receipt" value="yes" class="form-control">
                                        <input type="hidden" name="resDesc" value="success" class="form-control">
                                        <input type="hidden" name="ref1" value="0" class="form-control">
                                        <input type="hidden" name="id_receipt" value="0" class="form-control">
                                        <input type="hidden" name="pdflink" value="https://app.nurse.cmu.ac.th/edonation/finance/pdf_maker_offline.php?id=id&ACTION=VIEW">
                                        <input type="hidden" name="receipt_cc" value="confirm">
                                        <hr>
                                        <div class="btn-group col-12" id="buttonContainer">
                                            <button type="submit" class="btn btn-success btn-block gray-button">ยืนยันการออกใบเสร็จ(บุคคล)</button>
                                        </div>
                                </form>
                                <?php
                                // require_once 'recript_add.php';
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