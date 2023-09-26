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
// // ตรวจสอบการlogin
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
                                <strong class="card-title">รายงานสรุป</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="start_date" class="control-label mb-1">วันที่เริ่ม</label>
                                                <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="end_date" class="control-label mb-1">วันที่สิ้นสุด</label>
                                                <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="status_user" class="control-label mb-1">ประเภทผู้บริจาค</label>
                                                <select class="form-control" name="status_user" id="status_user">
                                                    <option value="" disabled <?php echo empty($_POST['status_user']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT status_user FROM receipt_offline";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($checkings as $checking) {
                                                        $status_user = $checking['status_user'];
                                                        $selected = isset($_POST['status_user']) && $_POST['status_user'] === $status_user ? 'selected' : '';
                                                        $status_user_text = ($status_user === 'person') ? 'บุคคลทั่วไป' : 'นิติบุคคล';

                                                        echo "<option value='$status_user' $selected>$status_user_text</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="status_receipt" class="control-label mb-1">ประเภทการบริจาค</label>
                                                <select class="form-control" name="status_receipt" id="status_receipt">
                                                    <option value="" disabled <?php echo empty($_POST['status_receipt']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT status_receipt FROM receipt_offline";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($checkings as $checking) {
                                                        $status_receipt = $checking['status_receipt'];
                                                        $selected = isset($_POST['status_receipt']) && $_POST['status_receipt'] === $status_receipt ? 'selected' : '';

                                                        // แปลงค่า status_receipt เป็นข้อความที่เหมาะสม
                                                        $status_receipt_text = ($status_receipt === 'no') ? 'ไม่ประสงค์ออกนาม' : 'บริจาคเพื่อรับใบเสร็จ';

                                                        echo "<option value='$status_receipt' $selected>$status_receipt_text</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-12 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="edo_description" class="control-label mb-1">โครงการ</label>
                                                <select class="form-control" name="edo_description" id="edo_description">
                                                    <option value="" disabled <?php echo empty($_POST['edo_description']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT edo_description FROM receipt_offline";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($checkings as $checking) {
                                                        $edo_description = $checking['edo_description'];
                                                        $selected = isset($_POST['edo_description']) && $_POST['edo_description'] === $edo_description ? 'selected' : '';
                                                        echo "<option value='$edo_description' $selected>$edo_description</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    &nbsp;
                                    <hr>
                                    <div class="btn-group col-12">
                                        <button type="submit" name="display_data" class="btn btn-primary">ค้นหา</button>
                                        <button type="button" id="export_data" class="btn btn-success">Export</button>
                                    </div>
                                    <script>
                                        document.getElementById("export_data").addEventListener("click", function() {
                                            var start_date = document.getElementById("start_date").value;
                                            var end_date = document.getElementById("end_date").value;
                                            var status_user = document.getElementById("status_user").value;
                                            var status_receipt = document.getElementById("status_receipt").value;
                                            var edo_description = document.getElementById("edo_description").value;
                                            var url = "report_db.php?";
                                            if (start_date) {
                                                url += "start_date=" + encodeURIComponent(start_date) + "&";
                                            }
                                            if (end_date) {
                                                url += "end_date=" + encodeURIComponent(end_date) + "&";
                                            }
                                            if (status_user) {
                                                url += "status_user=" + encodeURIComponent(status_user) + "&";
                                            }
                                            if (status_receipt) {
                                                url += "status_receipt=" + encodeURIComponent(status_receipt) + "&";
                                            }
                                            if (edo_description) {
                                                url += "edo_description=" + encodeURIComponent(edo_description);
                                            }
                                            window.location.href = url;
                                        });
                                    </script>
                                </form>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            if (isset($_POST['display_data'])) {
                                                require_once 'connection.php';

                                                $sql = "SELECT * FROM receipt_offline WHERE 1=1";

                                                if (isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])) {
                                                    $start_date = $_POST['start_date'];
                                                    $end_date = $_POST['end_date'];
                                                    $sql .= " AND rec_date_out BETWEEN :start_date AND :end_date";
                                                }

                                                if (isset($_POST['status_user']) && !empty($_POST['status_user'])) {
                                                    $selected_status_user = $_POST['status_user'];
                                                    $sql .= " AND status_user = :status_user";
                                                }

                                                if (isset($_POST['status_receipt']) && !empty($_POST['status_receipt'])) {
                                                    $selected_status_receipt = $_POST['status_receipt'];
                                                    $sql .= " AND status_receipt = :status_receipt";
                                                }

                                                if (isset($_POST['edo_description']) && !empty($_POST['edo_description'])) {
                                                    $selected_edo_description = $_POST['edo_description'];
                                                    $sql .= " AND edo_description = :edo_description";
                                                }

                                                $sql .= " ORDER BY id DESC"; // เพิ่มการเรียงลำดับล่าสุดที่นี่

                                                $stmt = $conn->prepare($sql);

                                                if (isset($start_date) && isset($end_date)) {
                                                    $stmt->bindParam(':start_date', $start_date);
                                                    $stmt->bindParam(':end_date', $end_date);
                                                }

                                                if (isset($selected_status_user)) {
                                                    $stmt->bindParam(':status_user', $selected_status_user);
                                                }

                                                if (isset($selected_status_receipt)) {
                                                    $stmt->bindParam(':status_receipt', $selected_status_receipt);
                                                }

                                                if (isset($selected_edo_description)) {
                                                    $stmt->bindParam(':edo_description', $selected_edo_description);
                                                }

                                                $stmt->execute();
                                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>เลขที่ใบเสร็จ</th>
                                                            <th>เลขประจำตัวผู้เสียภาษี</th>
                                                            <th>ชื่อ-สกุล</th>
                                                            <th>ที่อยู่</th>
                                                            <th>วันที่บริจาค</th>
                                                            <th>ชำระโดย</th>
                                                            <th>จำนวนเงิน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        ?>
                                                        <?php foreach ($results as $row) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td><?php echo $row['id_receipt']; ?></td>

                                                                <td><?php echo $row['rec_idname']; ?></td>
                                                                <td><?php echo $row['name_title']; ?> <?php echo $row['rec_name']; ?> <?php echo $row['rec_surname']; ?></td>
                                                                <td><?php echo $row['address']; ?> <?php echo $row['road']; ?> <?php echo $row['districts']; ?> <?php echo $row['amphures']; ?> <?php echo $row['provinces']; ?></td>
                                                                <td><?php echo $row['rec_date_out']; ?></td>
                                                                <td><?php echo $row['payby']; ?></td>
                                                                <td><?php echo $row['amount']; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                        <?php
                                            } else {
                                                echo "No data found.";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
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