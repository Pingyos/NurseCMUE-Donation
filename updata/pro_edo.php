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
                                <strong class="card-title">แก้ไขใบเสร็จบุคคล</strong>
                            </div>
                            <?php
                            if (isset($_GET['edo_id'])) {
                                require_once 'connection.php';
                                $stmt = $conn->prepare("SELECT* FROM pro_edo WHERE edo_id=?");
                                $stmt->execute([$_GET['edo_id']]);
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($stmt->rowCount() < 1) {
                                    header('Location: index.php');
                                    exit();
                                }
                            } //isset
                            ?>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_pro_id" class="control-label mb-1">edo_pro_id </label>
                                                <input type="text" name="edo_pro_id" class="form-control" value="<?= $row['edo_pro_id']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_tex" class="control-label mb-1">edo_tex </label>
                                                <input type="text" name="edo_tex" class="form-control" value="<?= $row['edo_tex']; ?>">
                                            </div>
                                        </div>
                                        &nbsp;
                                        <hr>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_name" class="control-label mb-1">edo_name </label>
                                                <input type="text" name="edo_name" class="form-control" value="<?= $row['edo_name']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_description1" class="control-label mb-1">edo_description1 </label>
                                                <input type="text" name="edo_description1" class="form-control" value="<?= $row['edo_description1']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_name2" class="control-label mb-1">edo_name2 </label>
                                                <input type="text" name="edo_name2" class="form-control" value="<?= $row['edo_name2']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_name3" class="control-label mb-1">edo_name3 </label>
                                                <input type="text" name="edo_name3" class="form-control" value="<?= $row['edo_name3']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_name4" class="control-label mb-1">edo_name4 </label>
                                                <input type="text" name="edo_name4" class="form-control" value="<?= $row['edo_name4']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_name5" class="control-label mb-1">edo_name5 </label>
                                                <input type="text" name="edo_name5" class="form-control" value="<?= $row['edo_name5']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="edo_objective" class="control-label mb-1">edo_objective </label>
                                                <input type="text" name="edo_objective" class="form-control" value="<?= $row['edo_objective']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="img_file" class="control-label mb-1">img_file </label>
                                                <input type="text" name="img_file" class="form-control" value="<?= $row['img_file']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="img_banner" class="control-label mb-1">img_banner </label>
                                                <input type="text" name="img_banner" class="form-control" value="<?= $row['img_banner']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="btn-group col-12">
                                        <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
                                    </div>
                                </form>
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