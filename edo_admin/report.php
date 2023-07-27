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
                                <strong class="card-title">รายงานการบริจาค</strong>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label class="control-label mb-1" for="edo_name">โครงการ</label>
                                            <select name="edo_name" id="edo_name" class="form-control">
                                                <?php require_once 'connection.php'; ?>
                                                <?php
                                                // Query to get distinct edo_names from receipt_offline table
                                                $query = "SELECT DISTINCT edo_name FROM receipt_offline";
                                                $stmt = $conn->query($query);
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $edoName = $row['edo_name'];
                                                    echo "<option value=\"$edoName\">$edoName</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label class="control-label mb-1" for="edo_name">วันที่เริ่มต้น</label>
                                            <input type="date" name="date_s" id="date_s" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label class="control-label mb-1" for="edo_name">วันที่สิ้นสุด</label>
                                            <?php
                                            $oneMonthAgo = date('Y-m-d', strtotime('-1 month'));
                                            ?>
                                            <input type="date" name="date_e" id="date_e" class="form-control" value="<?php echo $oneMonthAgo; ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="btn-group col-12">
                                    <button type="submit" class="btn btn-success btn-block">แสดงข้อมูล</button>
                                </div>
                                <?php
                                // require_once 'recript_add.php';
                                echo '<pre>';
                                print_r($_POST);
                                echo '</pre>';
                                ?>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>โครงการ</th>
                                            <th>จำนวนเงิน</th>
                                            <th>รายละเอียดใบเสร็จ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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