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
                        <style>
                            .card-body .btn-group {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100%;
                            }

                            .square-button {
                                /* ค่าอื่นๆ ที่คุณต้องการใส่ */
                                display: grid;
                                place-items: center;
                                width: 400px;
                                height: 400px;
                                border-radius: 0;
                            }

                            .button-content {
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                text-align: center;
                            }
                        </style>
                        <div class="card">
                            <div class="card-body">
                                <div class="btn-group d-flex align-items-center justify-content-center">
                                    <a href="receipt_person.php" class="btn btn-outline-success square-button mobile-button">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fa fa-user fa-lg"></i>
                                            <h2>บุคคล</h2>
                                        </div>
                                    </a>
                                    <a href="receipt_corporation.php" class="btn btn-outline-primary square-button mobile-button">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fa fa-users fa-lg"></i>
                                            <h2>นิติบุคคล</h2>
                                        </div>
                                    </a>
                                </div>

                                <style>
                                    @media (max-width: 767px) {
                                        .mobile-button {
                                            width: 100%;
                                            margin-bottom: 10px;
                                        }
                                    }
                                </style>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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