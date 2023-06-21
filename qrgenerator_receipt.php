<!doctype html>
<html lang="en">

<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 mx-auto">
                    <form class="custom-form donate-form">
                        <center>
                            <div class="col-lg-12 col-12">
                                <h3 class="mb-3">ขั้นตอนชำระเงินผ่านบริจาค</h3>
                                <h5 class="mb-3">ตรวจสอบรายละเอียด</h5>
                            </div>
                        </center>
                        <div class="row"></div>
                        <?php
                        require_once 'connection.php';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $stmt = $conn->prepare("SELECT * FROM receipt_online WHERE id = :id");
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            // // แสดงข้อมูล ID ที่ได้จากฐานข้อมูล
                            // echo "ID: " . $row['id'];
                        }
                        ?>

                        <div class="row">
                            <div class="col-lg-3 col-12 mt-2">
                                <label class="control-label">ชื่อ-สกุล</label>
                                <input type="text" name="rec_name" value="<?= $row['name_title']; ?> <?= $row['rec_name']; ?> <?= $row['rec_surname']; ?>" class="form-control" readonly>
                            </div>

                            <div class="col-lg-3 col-12 mt-2">
                                <label class="control-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="rec_fullname" value="<?= $row['rec_tel']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-3 col-12 mt-2">
                                <label class="control-label">เลขบัตรประชาชน</label>
                                <input type="text" name="rec_fullname" value="<?= $row['rec_idname']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-3 col-12 mt-2">
                                <label class="control-label">จำนวนเงิน</label>
                                <input type="text" name="rec_fullname" value="<?= $row['rec_money']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-8 col-12 mt-2">
                                <label class="control-label">รายละเอียดโครงการ</label>
                                <input type="text" name="rec_fullname" value="<?= $row['edo_name']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-4 col-12 mt-2">
                                <label class="control-label">ประเภทลดหย่อนภาษี</label>
                                <input type="text" name="rec_fullname" value="<?= $row['edo_tex']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        <div id="date-show-form" class=" medium-12">
                            <center>
                                <div id="qrCodeContainer">
                                    <?php
                                    require_once("libcache/PromptPayQR.php");
                                    require_once("connection.php");

                                    // ตรวจสอบว่ามีค่า id ที่ส่งมาใน URL หรือไม่
                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];

                                        $stmt = $conn->prepare("SELECT * FROM receipt_online WHERE id = ?");
                                        $stmt->execute([$id]);
                                        $row = $stmt->fetch();

                                        if ($row) {
                                            $amount = $row['rec_money'];

                                            $PromptPayQR = new PromptPayQR();
                                            $PromptPayQR->size = 7;
                                            $PromptPayQR->id = '5665690444';
                                            $PromptPayQR->amount = $amount;
                                            echo '<img id="qrCodeImage" src="' . $PromptPayQR->generate() . '" />';
                                        } else {
                                            echo "ไม่พบข้อมูล: $id";
                                        }
                                    } else {
                                        echo "ไม่พบข้อมูล ID";
                                    }
                                    ?>
                                </div>
                                <div id="countdownTimer"></div>

                                <div id="countdownTimer"></div>

                                <script>
                                    function showQRCodeForDuration() {
                                        var qrCodeImage = document.getElementById('qrCodeImage');
                                        var amount = <?php echo $amount; ?>;
                                        var countdown = 320; // จำนวนวินาทีที่นับถอยหลัง

                                        qrCodeImage.style.display = 'block';

                                        // ฟังก์ชันสำหรับแสดงเวลาออกทางหน้าจอในรูปแบบนาฬิกานับถอยหลังและข้อความว่า QR code จะหมดอายุในเวลาเท่าไร
                                        function updateCountdownTimer() {
                                            var countdownTimer = document.getElementById('countdownTimer');

                                            if (countdown >= 0) {
                                                // แสดงเวลาออกทางหน้าจอและข้อความว่า QR code จะหมดอายุในเวลาเท่าไร
                                                countdownTimer.innerHTML = "QR code จะหมดอายุใน " + countdown + " วินาที";
                                                countdown--;
                                                setTimeout(updateCountdownTimer, 1000); // นับถอยหลังทุกๆ 1 วินาที (1000 มิลลิวินาที)
                                            } else {
                                                qrCodeImage.style.display = 'none';
                                                amount = 0;
                                            }
                                        }

                                        updateCountdownTimer();

                                        setTimeout(function() {
                                            qrCodeImage.style.display = 'none';
                                            amount = 0;
                                        }, countdown * 1000); // หลังจากเวลาผ่านไป countdown วินาที
                                    }

                                    window.onload = showQRCodeForDuration;
                                </script>
                            </center>
                        </div>
                </div>
                </form>
            </div>
        </div>
        </div>
        </div>
    </main>
    <?php require_once('footer.php'); ?>
    <script src=" js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>