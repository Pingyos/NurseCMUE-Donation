<?php
// ตรวจสอบสถานะการเข้าสู่ระบบ
if (isset($_SESSION['login_info'])) {
    // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
    $login_info = $_SESSION['login_info'];
} else {
    // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
    header("Location: login.php");
    exit;
}
?>
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <?php echo $login_info['firstname_EN'] . " " . $login_info['lastname_EN'] . "<br>"; ?>
            </div>
        </div>
    </div>
</header>