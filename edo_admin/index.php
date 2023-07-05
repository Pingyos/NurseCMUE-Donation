<?php
session_start();

// ตรวจสอบสถานะการเข้าสู่ระบบ
if (isset($_SESSION['login_info'])) {
    // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
    $login_info = $_SESSION['login_info'];
    echo "Welcome, " . $login_info['firstname_EN'] . " " . $login_info['lastname_EN'] . "!<br>";
    echo "Organization: " . $login_info['organization_name_EN'] . "<br>";
    echo "CMU IT Account: " . $login_info['cmuitaccount'] . "<br>";
} else {
    // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
    header("Location: login.php");
    exit;
}
require_once 'head.php'; ?>
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