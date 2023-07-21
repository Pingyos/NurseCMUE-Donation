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
                                <h3 class="mb-3">ตรวจสอบรายละเอียด</h3>
                                <h5 class="mb-3">ยืนยันข้อมูล</h5>
                            </div>
                        </center>
                        <?php
                        require_once 'connection.php';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $stmt = $conn->prepare("SELECT * FROM receipt_offline WHERE id = :id");
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($row['status'] == 1) {
                                // สร้างลิงก์ใบเสร็จรับเงิน
                                $receiptLink = "pdf_maker.php?id=" . $row['id'] . "&ACTION=VIEW";
                                // เปิดใบเสร็จรับเงินโดยอัตโนมัติ
                                echo '<script>window.location.href = "' . $receiptLink . '";</script>';
                            }
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
                                <input type="text" name="rec_fullname" value="<?= number_format($row['amount'], 2, '.', ','); ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <label class="control-label">รายละเอียดโครงการ</label>
                                <input type="text" name="rec_fullname" value="<?= $row['edo_name']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        <center>
                            <div class="col-lg-12 col-12">
                                <h5 class="mb-3">สแกนเพื่อชำระเงิน</h5>
                            </div>
                        </center>
                        <div class="container">
                            <div class="row">
                                <center>
                                    <div class="col-lg-3 col-12 mb-5 mb-lg-0">
                                        <?php
                                        // ตรวจสอบว่ามีไฟล์ QR Code ในโฟลเดอร์ "qecodepayment" หรือไม่
                                        $qrCodeFolder = "qecodepayment";
                                        $latestQRCode = getLatestQRCode($qrCodeFolder);

                                        if ($latestQRCode !== null) {
                                            // แสดงรูปภาพ QR Code ล่าสุด
                                            echo '<img src="' . $qrCodeFolder . '/' . $latestQRCode . '" alt="Latest QR Code">';
                                        } else {
                                            echo '<p>No QR Code found in the folder.</p>';
                                        }

                                        function getLatestQRCode($folderPath)
                                        {
                                            $latestFile = null;
                                            $latestTime = 0;
                                            $dir = opendir($folderPath);
                                            while (($file = readdir($dir)) !== false) {
                                                $filePath = $folderPath . '/' . $file;
                                                // ตรวจสอบให้แน่ใจว่าเป็นไฟล์และเวลาแก้ไขล่าสุดใหม่กว่าเวลาก่อนหน้า
                                                if (is_file($filePath) && filemtime($filePath) > $latestTime) {
                                                    $latestFile = $file;
                                                    $latestTime = filemtime($filePath);
                                                }
                                            }
                                            closedir($dir);
                                            return $latestFile;
                                        }
                                        ?>
                                    </div>
                                </center>

                            </div>
                        </div>
                        <br>
                        <script>
                            // รีเฟรชหน้าเว็บและสร้าง URL ใหม่
                            function refreshPage() {
                                var id = <?php echo $id; ?>; // ดึงค่า id จาก PHP

                                var url = "http://localhost/git/NurseCMUE-Donation/qrgenerator_receipt.php?id=" + id;
                                window.location.href = url;
                            }
                        </script>

                        <!-- ปุ่มรีเฟรช -->
                        <button type="button" class="form-control" onclick="refreshPage()">รีเฟรช</button>

                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
    <?php require_once('footer.php'); ?>
    <script src=" js/main.js"></script>
</body>

</html>