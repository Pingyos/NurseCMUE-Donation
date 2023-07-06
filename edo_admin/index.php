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
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT COUNT(*) AS total_records05, SUM(amount) AS total_amount05 FROM receipt_offline WHERE edo_pro_id = 121205");
                    $stmt->execute();
                    $result = $stmt->fetch();

                    // แสดงผลจำนวน records และผลรวมเงินทั้งหมด
                    $total_records05 = $result['total_records05'];
                    $total_amount05 = $result['total_amount05'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษา</div>
                                            <div class="stat-text">฿ <?php echo $total_amount05; ?></div>
                                            <div class="stat-heading"><?php echo $total_records05; ?> ราย</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT COUNT(*) AS total_records06, SUM(amount) AS total_amount06 FROM receipt_offline WHERE edo_pro_id = 121206");
                    $stmt->execute();
                    $result = $stmt->fetch();

                    // แสดงผลจำนวน records และผลรวมเงินทั้งหมด
                    $total_records06 = $result['total_records06'];
                    $total_amount06 = $result['total_amount06'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ</div>
                                            <div class="stat-text">฿ <?php echo $total_amount06; ?></div>
                                            <div class="stat-heading"><?php echo $total_records06; ?> ราย</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT COUNT(*) AS total_records07, SUM(amount) AS total_amount07 FROM receipt_offline WHERE edo_pro_id = 121207");
                    $stmt->execute();
                    $result = $stmt->fetch();
                    // แสดงผลจำนวน records และผลรวมเงินทั้งหมด
                    $total_records07 = $result['total_records07'];
                    $total_amount07 = $result['total_amount07'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ</div>
                                            <div class="stat-text">฿ <?php echo $total_amount07; ?></div>
                                            <div class="stat-heading"><?php echo $total_records07; ?> ราย</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once 'connection.php';

                    // สร้างคำสั่ง SQL สำหรับดึงจำนวนข้อมูลที่มี status_donat = offline
                    $sql = "SELECT COUNT(*) AS total_recordsoffline FROM receipt_offline WHERE status_donat = 'offline'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetch();

                    // แสดงผลจำนวนข้อมูล
                    $total_recordsoffline = $result['total_recordsoffline'];
                    ?>

                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-5">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">จำนวนผู้บริจาค (Offline)</div>
                                            <div class="stat-text"><?php echo $total_recordsoffline; ?> คน</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    require_once 'connection.php';

                    // สร้างคำสั่ง SQL สำหรับดึงจำนวนข้อมูลที่มี status_donat = offline
                    $sql = "SELECT COUNT(*) AS total_recordsonline FROM receipt_offline WHERE status_donat = 'online'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetch();

                    // แสดงผลจำนวนข้อมูล
                    $total_recordsonline = $result['total_recordsonline'];
                    ?>

                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-5">
                                        <i class="pe-7s-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">จำนวนผู้บริจาค (Online)</div>
                                            <div class="stat-text"><?php echo $total_recordsonline; ?> คน</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once 'connection.php';
                    // สร้างคำสั่ง SQL สำหรับดึงจำนวนข้อมูล
                    $sql = "SELECT COUNT(*) AS total_records FROM receipt_offline";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetch();
                    // แสดงผลจำนวนข้อมูล
                    $total_records = $result['total_records'];
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-5">
                                        <i class="ti-user text-primary border-primary"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">จำนวนผู้บริจาค</div>
                                            <div class="stat-text"><?php echo $total_records; ?> คน</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT SUM(amount) AS total_amountsum FROM receipt_offline");
                    $stmt->execute();
                    $result = $stmt->fetch();
                    $total_amountsum = $result['total_amountsum'];
                    ?>
                    <div class="col-lg-8 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">ยอดเงินรวม</div>
                                            <div class="stat-text">฿ <?php echo $total_amountsum; ?></div>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
</body>

</html>