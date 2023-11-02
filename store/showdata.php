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
                                <strong class="card-title">รายละเอียดของที่ระลึก</strong>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    require_once 'connection.php';

                                    // ดึงข้อมูล items ของแต่ละ Set
                                    $seta = $conn->prepare("SELECT items FROM storage WHERE name = 'Set A'");
                                    $seta->execute();
                                    $result = $seta->fetch();

                                    $setb = $conn->prepare("SELECT items FROM storage WHERE name = 'Set B'");
                                    $setb->execute();
                                    $setb_result = $setb->fetch();

                                    $setc = $conn->prepare("SELECT items FROM storage WHERE name = 'Set C'");
                                    $setc->execute();
                                    $setc_result = $setc->fetch();

                                    $setd = $conn->prepare("SELECT items FROM storage WHERE name = 'Set D'");
                                    $setd->execute();
                                    $setd_result = $setd->fetch();
                                    ?>

                                    <!-- Set A -->
                                    <!-- Set A -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card" <?php if ($result['items'] < 21) echo 'style="background-color: #cd3545;"'; ?>>
                                            <div class="card-body" style="height: 130px;">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="stat-heading">Set A จานรองแก้วเซรามิค</div>
                                                        <div class="stat-text"><?= $result['items'] ?> ชิ้น</div>
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../images/service/right9.jpg" alt="Image" style="height: 100px; width: 100px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Set B -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card" <?php if ($setb_result['items'] < 21) echo 'style="background-color: #cd3545;"'; ?>>
                                            <div class="card-body" style="height: 130px;">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="stat-heading">Set B Griptok</div>
                                                        <div class="stat-text"><?= $setb_result['items'] ?> ชิ้น</div>
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../images/service/right10.jpg" alt="Image" style="height: 100px; width: 110px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Set C -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card" <?php if ($setc_result['items'] < 21) echo 'style="background-color: #cd3545;"'; ?>>
                                            <div class="card-body" style="height: 130px;">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="stat-heading">Set C ชุดเข็มกลัด</div>
                                                        <div class="stat-text"><?= $setc_result['items'] ?> ชิ้น</div>
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="../images/service/right11.jpg" alt="Image" style="height: 100px; width: 110px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Set D -->
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card" <?php if ($setd_result['items'] < 21) echo 'style="background-color: #cd3545;"'; ?>>
                                            <div class="card-body" style="height: 130px;">
                                                <div class="row">
                                                    <!-- <div class="col-8">
                                                        <div class="stat-heading">Set D</div>
                                                        <div class="stat-text"><?= $setd_result['items'] ?> ชิ้น</div>
                                                    </div>
                                                     <div class="col-4">
                                                        <img src="../images/service/right11.jpg" alt="Image" style="height: 100px; width: 100px;">
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>ที่อยู่</th>
                                            <th>สถานะ</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once 'connection.php';
                                        $stmt = $conn->prepare("SELECT * FROM store WHERE status_receipt = 'yes' AND resDesc = 'success' AND receipt_cc = 'confirm' AND amount > 999.99 ORDER BY items ASC");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        $countrow = 1;
                                        foreach ($result as $t1) {
                                        ?>
                                            <tr>
                                                <td><?= $countrow ?></td>
                                                <td>
                                                    <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                    <br>
                                                    <?= number_format($t1['amount'], 2, '.', ','); ?> |
                                                    <span class="badge rounded-pill bg-warning text-dark"> Set <?= $t1['items_set']; ?></span>
                                                    <br>
                                                    <span style="color: orange;"><?= $t1['id_receipt']; ?></span> | <span style="color: black;"><?= $t1['rec_tel']; ?></span>
                                                </td>

                                                <td>
                                                    <?= $t1['address']; ?> <?= $t1['road']; ?> <?= $t1['districts']; ?> <?= $t1['amphures']; ?> <?= $t1['provinces']; ?> <?= $t1['zip_code']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($t1['items'] == 1) {
                                                        echo '<span class="badge rounded-pill bg-warning text-dark">รอดำเนินการ</span>';
                                                    } elseif ($t1['items'] == 2) {
                                                        echo '<span class="badge rounded-pill bg-success">จัดส่งแล้ว</span>';
                                                    } elseif ($t1['items'] == 3) {
                                                        echo '<span class="badge rounded-pill bg-danger">ยกเลิก</span>';
                                                    }
                                                    ?>
                                                    |
                                                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="cancel" href="javascript:void(0);" onclick="confirmCheck('<?= $t1['receipt_id']; ?>')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M5 12l5 5l10 -10"></path>
                                                        </svg>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#largeModal<?= $t1['id']; ?>">
                                                                <i class="bx bx-edit-alt me-1"></i> View
                                                            </a>

                                                            <!-- <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete('<?= $t1['receipt_id']; ?>')">
                                                                <i class="bx bx-trash me-1"></i> Delete
                                                            </a>
                                                            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                            <script>
                                                                function confirmDelete(receipt_id) {
                                                                    swal({
                                                                            title: "คำเตือน",
                                                                            text: "เมื่อคุณกด 'Delete' ระบบจะลบข้อมูลและไม่สามารถกู้คืนได้อีก",
                                                                            type: "warning",
                                                                            showCancelButton: true,
                                                                            confirmButtonColor: "#DD6B55",
                                                                            confirmButtonText: "Delete",
                                                                            cancelButtonText: "Cancel",
                                                                            closeOnConfirm: false
                                                                        },
                                                                        function(isConfirm) {
                                                                            if (isConfirm) {
                                                                                // ทำงานเมื่อยืนยันการลบ
                                                                                window.location = "delete.php?receipt_id=" + receipt_id;
                                                                            }
                                                                        });
                                                                }
                                                            </script> -->
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="largeModal<?= $t1['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="largeModalLabel">รายละเอียดรายการ | ที่อยู่จัดส่ง</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>ชื่อผู้รับ : <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></p>
                                                                    <p>ที่อยู่จัดส่ง : <?= $t1['address']; ?> <?= $t1['road']; ?> <?= $t1['districts']; ?> <?= $t1['amphures']; ?> <?= $t1['provinces']; ?> <?= $t1['zip_code']; ?></p>
                                                                    <p>เบอร์โทรติดต่อ : <?= $t1['rec_tel']; ?></p>
                                                                    <hr>
                                                                    <p>จำนวนเงิน : <?= number_format($t1['amount'], 2, '.', ','); ?> บาท</p>
                                                                    <p>รายการของที่ระลึก : <span class="badge rounded-pill bg-warning text-dark"> Set <?= $t1['items_set']; ?></span></p>
                                                                    <p>วันที่/เวลา : <?= $t1['dateCreate']; ?></p>
                                                                    <p>หมายเลขอ้างอิง : <?= $t1['ref1']; ?> | <?php
                                                                                                                if ($t1['items'] == 1) {
                                                                                                                    echo '<span class="badge rounded-pill bg-warning text-dark">รอดำเนินการ</span>';
                                                                                                                } elseif ($t1['items'] == 2) {
                                                                                                                    echo '<span class="badge rounded-pill bg-success">จัดส่งแล้ว</span>';
                                                                                                                } elseif ($t1['items'] == 3) {
                                                                                                                    echo '<span class="badge rounded-pill bg-danger">ยกเลิก</span>';
                                                                                                                }
                                                                                                                ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                    <script>
                                                        function confirmCheck(receipt_id) {
                                                            swal({
                                                                    title: "คำเตือน",
                                                                    text: "ยืนยันการส่งของที่ระลึง",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#DD6B55",
                                                                    confirmButtonText: "ยืนยัน",
                                                                    cancelButtonText: "ยกเลิก",
                                                                    closeOnConfirm: false
                                                                },
                                                                function(isConfirm) {
                                                                    if (isConfirm) {
                                                                        window.location = "check_items.php?receipt_id=" + receipt_id;
                                                                    }
                                                                });
                                                        }
                                                    </script>
                                                </td>
                                            <?php $countrow++;
                                        }
                                            ?>
                                    </tbody>
                                </table>
                                <!-- Modal -->


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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../finance/assets/js/main.js"></script>
    <script src="../finance/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../finance/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../finance/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../finance/assets/js/init/datatables-init.js"></script>
</body>

</html>