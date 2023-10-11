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
                                <strong class="card-title">เพิ่มรายละเอียดข้อมูล</strong>
                            </div>
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_tex" class="control-label mb-1">ลดหย่อนภาษี </label>
                                                <input type="text" name="edo_tex" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_pro_id" class="control-label mb-1">เลขที่โครงการ </label>
                                                <input type="text" name="edo_pro_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_name" class="control-label mb-1">ชื่อโครงการ </label>
                                                <input type="text" name="edo_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_description" class="control-label mb-1">ชื่อโครงการ แสดงในใบเสร็จ </label>
                                                <input type="text" name="edo_description" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_objective" class="control-label mb-1">ชื่อโครงการ แสดงในใบอนุโมทนาบัตร </label>
                                                <input type="text" name="edo_objective" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_details_objective1" class="control-label mb-1">วัตถุประสงค์ ข้อที่ 1 </label>
                                                <input type="text" name="edo_details_objective1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_details_objective2" class="control-label mb-1">วัตถุประสงค์ ข้อที่ 2 </label>
                                                <input type="text" name="edo_details_objective2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_details_objective3" class="control-label mb-1">วัตถุประสงค์ ข้อที่ 3 </label>
                                                <input type="text" name="edo_details_objective3" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="edo_details_objective4" class="control-label mb-1">วัตถุประสงค์ ข้อที่ 4 </label>
                                                <input type="text" name="edo_details_objective4" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="textarea-input" class=" form-control-label">รายละเอียดโครงการ</label>
                                            <textarea name="edo_details" id="edo_details" rows="9" class="form-control"></textarea>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="img_file" class="form-control-label">รูปภาพโครงการ</label>
                                                <input type="file" id="img_file" name="img_file" class="form-control-file">
                                            </div>
                                        </div>

                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="img_banner" class="form-control-label">รูปภาพการลดหย่อนภาษี</label>
                                                <input type="file" id="img_banner" name="img_banner" class="form-control-file">
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="img_file" class="control-label mb-1">ตัวอย่าง รูปภาพโครงการ</label>
                                                <img src="../images/causes/<?= $row['img_file']; ?>" alt="รูปภาพโครงการ" class="img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="form-group">
                                                <label for="img_banner" class="control-label mb-1">ตัวอย่าง รูปภาพการลดหย่อนภาษี </label>
                                                <img src="../images/causes/<?= $row['img_banner']; ?>" alt="รูปภาพโครงการ" class="img-thumbnail">
                                            </div>
                                        </div> -->
                                    </div>
                                    <br>
                                    <div class="btn-group col-12">
                                        <button type="submit" class="btn btn-success btn-block">ยืนยัน</button>
                                    </div>
                                </form>
                                <?php
                                // echo '<pre>';
                                // print_r($_POST);
                                // echo '</pre>';
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