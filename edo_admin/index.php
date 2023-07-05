<?php
session_start();

// ตรวจสอบสถานะการเข้าสู่ระบบ
if (isset($_SESSION['login_info'])) {
    // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
    $login_info = $_SESSION['login_info'];
    echo "Welcome, " . $login_info['firstname_EN'] . " " . $login_info['lastname_EN'] . "!<br>";
    echo "Organization: " . $login_info['organization_name_EN'] . "<br>";
    echo "CMU IT Account: " . $login_info['cmuitaccount'] . "<br>";

    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "edonation";
    $password = "edonate@FON";
    $dbname = "edonation";

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // เพิ่มข้อมูลผู้ใช้ลงในตาราง users
    $firstname = $login_info['firstname_EN'];
    $lastname = $login_info['lastname_EN'];
    $organization = $login_info['organization_name_EN'];
    $cmuitaccount = $login_info['cmuitaccount'];
    $login_time = date("Y-m-d H:i:s"); // เวลาที่ล็อกอิน

    $sql = "INSERT INTO users (firstname, lastname, organization, cmuitaccount, login_time)
            VALUES ('$firstname', '$lastname', '$organization', '$cmuitaccount', '$login_time')";

    if ($conn->query($sql) === TRUE) {
        echo "User data has been saved to the database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
} else {
    // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
    header("Location: login.php");
    exit;
}
require_once 'head.php'; ?>

<!--CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(255),
  lastname VARCHAR(255),
  organization VARCHAR(255),
  cmuitaccount VARCHAR(255),
  login_time DATETIME
);
 -->

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <h4>อยู่ระหว่างการพัฒนา</h4>
            </div>
        </div>
    </div>
</body>
<?php require_once 'scripts.php'; ?>

</html>