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
                                        <?php
                                        require_once 'connection.php';
                                        $stmt = $conn->prepare("SELECT * FROM receipt WHERE status_donat = 'online'");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        $result = array_reverse($result);
                                        $countrow = 1;
                                        foreach ($result as $t1) {
                                        ?>
                                            <tr>
                                                <td><?= $countrow ?></td>
                                                <td>
                                                    <?php if ($t1['receipt_cc'] === 'cancel') : ?>
                                                        <span style="text-decoration: line-through;">
                                                            <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                        </span>
                                                    <?php else : ?>
                                                        <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                    <?php endif; ?>
                                                    <br>
                                                    <span style="color: orange;"><?= date('d/m/Y', strtotime($t1['rec_date_out'])); ?></span> /
                                                    <span style="color: orange;">E<?= str_pad($t1['receipt_id'], 4, '0', STR_PAD_LEFT); ?></span> /
                                                    <span style="color: orange;"><?= $t1['rec_time']; ?></span>
                                                </td>
                                                <td>
                                                    <?php if ($t1['receipt_cc'] === 'cancel') : ?>
                                                        <span style="text-decoration: line-through;">
                                                            <?= $t1['edo_name']; ?><?= $t1['other_description']; ?>
                                                        </span>
                                                    <?php else : ?>
                                                        <?= $t1['edo_name']; ?><?= $t1['other_description']; ?>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= number_format($t1['amount'], 2, '.', ','); ?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="View" href="<?= ($t1['receipt_cc'] == 'cancel') ? 'pdf_recrip_cc.php?receipt_id=' . $t1['receipt_id'] : 'pdf_maker_offline.php?receipt_id=' . $t1['receipt_id'] ?>&ACTION=VIEW" target="_blank"> <span class="btn-inner">
                                                            <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon btn-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="<?php echo ($t1['status_user'] === 'person') ? 'receipt_person_edit.php?receipt_id=' . $t1['receipt_id'] : 'receipt_corporation_edit.php?receipt_id=' . $t1['receipt_id']; ?>">
                                                        <span class="btn-inner">
                                                            <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="cancel" href="javascript:void(0);" onclick="confirmcancel('<?= $t1['receipt_id']; ?>')">
                                                        <span class="btn-inner">
                                                            <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </span>
                                                        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                                                        <script>
                                                            function confirmcancel(receipt_id) {
                                                                swal({
                                                                        title: "คำเตือน",
                                                                        text: "เมื่อคุณกด 'ยืนยันการยกเลิก' ระบบจะทำงานยกเลิกใบเสร็จรับเงิน และจะไม่สามารถนำกลับมาได้อีก",
                                                                        type: "warning",
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: "#DD6B55",
                                                                        confirmButtonText: "ยืนยันการยกเลิก",
                                                                        cancelButtonText: "เลิกทำ",
                                                                        closeOnConfirm: false
                                                                    },
                                                                    function(isConfirm) {
                                                                        if (isConfirm) {
                                                                            window.location = "receipt_cancel.php?receipt_id=" + receipt_id;
                                                                        }
                                                                    });
                                                            }
                                                        </script>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $countrow++;
                                        }
                                        ?>
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