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
                                <strong class="card-title">รายชื่อบริจาคผ่านเว็บไซต์</strong>
                            </div>
                            <div class="card-body">
                                <div id="show-me" class="form-group col-lg-12 col-md-3 col-12">
                                    <div class="row">
                                        <?php
                                        require_once 'connection.php';

                                        $sql = "SELECT DISTINCT edo_description FROM receipt_offline";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        echo '<div class="form-group col-12">';
                                        echo '<label for="edo_description" class="control-label mb-1">โครงการ <span style="color:red;">*</span></label>';
                                        echo '<select name="edo_description" id="edo_description" class="form-control">';
                                        echo '<option value="" selected>โครงการ</option>';

                                        $selectededo_descriptions = array();
                                        foreach ($checkings as $checking) {
                                            $edo_description = $checking['edo_description'];

                                            if (!in_array($edo_description, $selectededo_descriptions)) {
                                                echo '<option value="' . $edo_description . '">' . $edo_description . '</option>';
                                                $selectededo_descriptions[] = $edo_description;
                                            }
                                        }

                                        echo '</select>';
                                        echo '</div>';


                                        $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : date('Y-m-d');

                                        $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : date('Y-m-d');

                                        $startDateObj = new DateTime($startDate);
                                        $endDateObj = new DateTime($endDate);

                                        $startDateObj->modify('-1 day');

                                        $startDate = $startDateObj->format('Y-m-d');

                                        echo '<div class="form-group col-lg-6 col-md-3 col-12">';
                                        echo '<label for="startDate" class="control-label mb-1">วันที่เริ่มต้น <span style="color:red;">*</span></label>';
                                        echo '<input type="date" name="startDate" id="startDate" class="form-control" value="' . $startDate . '">';
                                        echo '</div>';
                                        echo '<div class="form-group col-lg-6 col-md-3 col-12">';
                                        echo '<label for="endDate" class="control-label mb-1">วันที่สิ้นสุด <span style="color:red;">*</span></label>';
                                        echo '<input type="date" name="endDate" id="endDate" class="form-control" value="' . $endDate . '">';
                                        echo '</div>';

                                        ?>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-3 col-12">
                                            <button type="button" class="btn btn-success" id="showDataButton">
                                                <span><i class="menu-icon fa fa-search"></i> แสดงข้อมูล</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <table class="table" id="data-table">
                                                <thead>
                                                    <tr>
                                                        <th>คอลัมน์ 1</th>
                                                        <th>คอลัมน์ 2</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- ในส่วนนี้จะถูกเติมข้อมูลเมื่อกดปุ่ม "แสดงข้อมูล" -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3">
                                        <button class="btn btn-primary" id="exportBtn">
                                            <i class="menu-icon fa fa-file-pdf-o"></i><span> ส่งออก </span>
                                        </button>
                                    </div>

                                    <script>
                                        document.getElementById('showDataButton').addEventListener('click', function() {
                                            var start_date = document.getElementById('start_date').value;
                                            var end_date = document.getElementById('end_date').value;
                                            var edo_description = document.getElementById('edo_description').value;

                                            var url = 'fetch_data.php?start_date=' + start_date + '&end_date=' + end_date + '&edo_description=' + edo_description;

                                            fetch(url)
                                                .then(response => response.json())
                                                .then(data => {
                                                    var dataTable = document.getElementById('data-table').getElementsByTagName('tbody')[0];

                                                    while (dataTable.rows.length > 0) {
                                                        dataTable.deleteRow(0);
                                                    }

                                                    data.forEach(function(rowData) {
                                                        var newRow = dataTable.insertRow();
                                                        var cell1 = newRow.insertCell(0);
                                                        var cell2 = newRow.insertCell(1);

                                                        cell1.innerHTML = rowData.rec_date_out;
                                                        cell2.innerHTML = rowData.edo_description;
                                                    });
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching data:', error);
                                                });
                                        });

                                        document.getElementById('exportBtn').addEventListener('click', function() {
                                            var edo_description = document.querySelector('#show-me select[name="edo_description"]').value;
                                            var startDate = document.querySelector('#show-me input[name="startDate"]').value;
                                            var endDate = document.querySelector('#show-me input[name="endDate"]').value;
                                            var url = `export_to_excel.php?&edo_description=${edo_description}&startDate=${startDate}&endDate=${endDate}`;
                                            url += `&timestamp=${Date.now()}`;
                                            window.open(url, '_blank');
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php

        ?>


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