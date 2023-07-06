<?php
// session_start();

// // ตรวจสอบสถานะการเข้าสู่ระบบ
// if (isset($_SESSION['login_info'])) {
//     // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
//     $login_info = $_SESSION['login_info'];
//     // เชื่อมต่อฐานข้อมูล
//     $servername = "localhost";
//     $username = "edonation";
//     $password = "edonate@FON";
//     $dbname = "edonation";
//     // สร้างการเชื่อมต่อ
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // ตรวจสอบการเชื่อมต่อ
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
//     // เพิ่มข้อมูลผู้ใช้ลงในตาราง users
//     $firstname = $login_info['firstname_EN'];
//     $lastname = $login_info['lastname_EN'];
//     $cmuitaccount = $login_info['cmuitaccount'];
//     $login_time = date("Y-m-d H:i:s"); // เวลาที่ล็อกอิน

//     $sql = "INSERT INTO users (firstname, lastname,  cmuitaccount, login_time)
//             VALUES ('$firstname', '$lastname',  '$cmuitaccount', '$login_time')";

//     if ($conn->query($sql) === TRUE) {
//         // echo "User data has been saved to the database.";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }
//     // ปิดการเชื่อมต่อฐานข้อมูล
//     $conn->close();
// } else {
//     // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
//     header("Location: login.php");
//     exit;
// }
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="row">
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT SUM(amount) AS total_amount05 FROM receipt_offline WHERE edo_pro_id = 121205");
                    $stmt->execute();
                    $result = $stmt->fetch();
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT SUM(amount) AS total_amount06 FROM receipt_offline WHERE edo_pro_id = 121206");
                    $stmt->execute();
                    $result = $stmt->fetch();
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT SUM(amount) AS total_amount07 FROM receipt_offline WHERE edo_pro_id = 121207");
                    $stmt->execute();
                    $result = $stmt->fetch();
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
</body>
<?php require_once 'scripts.php'; ?>

</html>