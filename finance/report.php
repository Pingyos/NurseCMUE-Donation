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
                                <strong class="card-title">รายงานสรุป</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data" id="your_form_id">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="showall" class="control-label mb-1">ปีงบประมาณ</label>
                                                <select class="form-control" name="showall" id="showall">
                                                    <option value="receipt" <?php if (isset($_POST['showall']) && $_POST['showall'] === 'receipt') echo 'selected'; ?>>2567</option>
                                                    <option value="receipt_2566" <?php if (isset($_POST['showall']) && $_POST['showall'] === 'receipt_2566') echo 'selected'; ?>>2566</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="start_date" class="control-label mb-1">วันที่เริ่ม</label>
                                                <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="end_date" class="control-label mb-1">วันที่สิ้นสุด</label>
                                                <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="status_user" class="control-label mb-1">ประเภทผู้บริจาค</label>
                                                <select class="form-control" name="status_user" id="status_user">
                                                    <option value="" disabled <?php echo empty($_POST['status_user']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT status_user FROM receipt";
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

                                        <div class="form-group col-lg-3 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="status_receipt" class="control-label mb-1">ประเภทการบริจาค</label>
                                                <select class="form-control" name="status_receipt" id="status_receipt">
                                                    <option value="" disabled <?php echo empty($_POST['status_receipt']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT status_receipt FROM receipt";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($checkings as $checking) {
                                                        $status_receipt = $checking['status_receipt'];
                                                        $selected = isset($_POST['status_receipt']) && $_POST['status_receipt'] === $status_receipt ? 'selected' : '';
                                                        $status_receipt_text = ($status_receipt === 'no') ? 'ไม่ประสงค์ออกนาม' : 'บริจาคเพื่อรับใบเสร็จ';
                                                        echo "<option value='$status_receipt' $selected>$status_receipt_text</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="edo_pro_id" class="control-label mb-1">โครงการ</label>
                                                <select class="form-control" name="edo_pro_id" id="edo_pro_id">
                                                    <option value="" disabled <?php echo empty($_POST['edo_pro_id']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT edo_pro_id FROM receipt ORDER BY edo_pro_id ASC";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($checkings as $checking) {
                                                        $edo_pro_id = $checking['edo_pro_id'];
                                                        $selected = isset($_POST['edo_pro_id']) && $_POST['edo_pro_id'] === $edo_pro_id ? 'selected' : '';
                                                        $additional_info = '';

                                                        // เพิ่มข้อมูลเพิ่มเติมตาม edo_pro_id ที่คุณต้องการ
                                                        switch ($edo_pro_id) {
                                                            case '121205':
                                                                $additional_info = 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่';
                                                                break;
                                                            case '121206':
                                                                $additional_info = 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่';
                                                                break;
                                                            case '121207':
                                                                $additional_info = 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ';
                                                                break;
                                                            case '121208':
                                                                $additional_info = 'โครงการบริจาคเพิ่มเติม';
                                                                break;
                                                        }

                                                        echo "<option value='$edo_pro_id' $selected>$edo_pro_id - $additional_info</option>";
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-3 col-6">
                                            <div class="form-group">
                                                <label for="receipt_cc" class="control-label mb-1">สถานะใบเสร็จรับเงิน</label>
                                                <select class="form-control" name="receipt_cc" id="receipt_cc">
                                                    <option value="" disabled <?php echo empty($_POST['receipt_cc']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                    <?php
                                                    require_once 'connection.php';

                                                    $sql = "SELECT DISTINCT receipt_cc FROM receipt";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($checkings as $checking) {
                                                        $receipt_cc = $checking['receipt_cc'];
                                                        $selected = isset($_POST['receipt_cc']) && $_POST['receipt_cc'] === $receipt_cc ? 'selected' : '';

                                                        $status_receipt_cc_text = ($receipt_cc === 'cancel') ? 'ใบเสร็จที่ยกเลิก' : 'ปกติ';

                                                        echo "<option value='$receipt_cc' $selected>$status_receipt_cc_text</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    &nbsp;
                                    <hr>
                                    <div class="btn-group col-3">
                                        <button type="submit" name="display_data" class="btn btn-primary">ค้นหา</button>
                                        &nbsp;
                                        <button type="button" id="export_data" class="btn btn-success">ออกรายงาน</button>
                                        &nbsp;
                                        <button type="button" id="clear_data" class="btn btn-danger">ล้างค่า</button>
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var clearButton = document.getElementById("clear_data");
                                            clearButton.addEventListener("click", function() {
                                                // รองรับทุกชนิดของฟิลด์อินพุต เช่น text, textarea, select
                                                var form = document.getElementById("your_form_id");
                                                var elements = form.elements;

                                                for (var i = 0; i < elements.length; i++) {
                                                    if (elements[i].type === "text" || elements[i].type === "textarea" || elements[i].type === "select-one") {
                                                        elements[i].value = ""; // ล้างค่าข้อมูลในฟิลด์
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <script>
                                        document.getElementById("export_data").addEventListener("click", function() {
                                            var start_date = document.getElementById("start_date").value;
                                            var end_date = document.getElementById("end_date").value;
                                            var status_user = document.getElementById("status_user").value;
                                            var status_receipt = document.getElementById("status_receipt").value;
                                            var edo_pro_id = document.getElementById("edo_pro_id").value;
                                            var receipt_cc = document.getElementById("receipt_cc").value;
                                            var showall = document.getElementById("showall").value; // เพิ่มการดึงค่า showall

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
                                            if (edo_pro_id) {
                                                url += "edo_pro_id=" + encodeURIComponent(edo_pro_id) + "&";
                                            }
                                            if (receipt_cc) {
                                                url += "receipt_cc=" + encodeURIComponent(receipt_cc) + "&";
                                            }
                                            if (showall) {
                                                url += "showall=" + encodeURIComponent(showall); // เพิ่มค่า showall ใน URL
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

                                                $sql = "SELECT * FROM ";

                                                if (isset($_POST['showall']) && !empty($_POST['showall'])) {
                                                    $selected_table = $_POST['showall'];
                                                    $sql .= $selected_table;
                                                } else {
                                                    $sql .= "receipt"; // หากไม่มีการเลือกตาราง ให้ใช้ "receipt" เป็นค่าเริ่มต้น
                                                }

                                                $sql .= " WHERE 1=1";

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

                                                if (isset($_POST['edo_pro_id']) && !empty($_POST['edo_pro_id'])) {
                                                    $selected_edo_pro_id = $_POST['edo_pro_id'];
                                                    $sql .= " AND edo_pro_id = :edo_pro_id";
                                                }

                                                if (isset($_POST['receipt_cc']) && !empty($_POST['receipt_cc'])) {
                                                    $selected_receipt_cc = $_POST['receipt_cc'];
                                                    $sql .= " AND receipt_cc = :receipt_cc";
                                                }

                                                $sql .= " ORDER BY receipt_id DESC"; // เพิ่มการเรียงลำดับล่าสุดที่นี่

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

                                                if (isset($selected_edo_pro_id)) {
                                                    $stmt->bindParam(':edo_pro_id', $selected_edo_pro_id);
                                                }
                                                if (isset($selected_receipt_cc)) {
                                                    $stmt->bindParam(':receipt_cc', $selected_receipt_cc);
                                                }

                                                $stmt->execute();
                                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th style="width: 150px;">เลขที่ใบเสร็จ</th>
                                                            <th>ชื่อ-สกุล</th>
                                                            <th>ที่อยู่</th>
                                                            <th>วันที่บริจาค</th>
                                                            <th>ชำระโดย</th>
                                                            <th>จำนวนเงิน</th>
                                                            <th>รายละเอียด</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1;
                                                        ?>
                                                        <?php foreach ($results as $row) : ?>
                                                            <tr>
                                                                <td><?php echo $i++; ?></td>
                                                                <td>
                                                                    <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        <span style="text-decoration: line-through;">
                                                                        <?php endif; ?>
                                                                        <?php echo $row['id_receipt']; ?>
                                                                        <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        <span style="text-decoration: line-through;">
                                                                        <?php endif; ?>
                                                                        <?php echo $row['name_title']; ?> <?php echo $row['rec_name']; ?> <?php echo $row['rec_surname']; ?>
                                                                        <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        <span style="text-decoration: line-through;">
                                                                        <?php endif; ?>
                                                                        <?php echo $row['address']; ?> <?php echo $row['road']; ?> <?php echo $row['districts']; ?> <?php echo $row['amphures']; ?> <?php echo $row['provinces']; ?>
                                                                        <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        <span style="text-decoration: line-through;">
                                                                        <?php endif; ?>
                                                                        <?php $originalDate = $row['rec_date_out'];
                                                                        $newDate = date('d/m/Y', strtotime($originalDate));
                                                                        $newDateParts = explode('/', $newDate);
                                                                        if (count($newDateParts) === 3) {
                                                                            $newDateParts[2] = intval($newDateParts[2]) + 543;
                                                                            $newDate = implode('/', $newDateParts);
                                                                        }
                                                                        echo $newDate;
                                                                        ?>
                                                                        <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        <span style="text-decoration: line-through;">
                                                                        <?php endif; ?>
                                                                        <?php echo $row['payby']; ?>
                                                                        <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        <span style="text-decoration: line-through;">
                                                                        <?php endif; ?>
                                                                        <?php echo number_format($row['amount'], 2, '.', ','); ?>
                                                                        <?php if ($row['receipt_cc'] === 'cancel') : ?>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="View" href="<?= ($row['receipt_cc'] == 'cancel') ? 'pdf_recrip_cc.php?receipt_id=' . $row['receipt_id'] . '&showall=' . $_POST['showall'] : 'pdf_maker_report.php?receipt_id=' . $row['receipt_id'] . '&showall=' . $_POST['showall'] ?>&ACTION=VIEW" target="_blank"> <span class="btn-inner">
                                                                            <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </a>
                                                                </td>
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