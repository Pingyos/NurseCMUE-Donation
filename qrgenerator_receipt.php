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
                                    <?php
                                    require_once 'lib-crc16.inc.php';
                                    require_once 'connection.php';


                                    // คำนวณค่า $amount จากตาราง receipt_offline โดยใช้ id ล่าสุด
                                    $sql = "SELECT amount, rec_date_out, edo_pro_id, id FROM receipt_offline ORDER BY id DESC LIMIT 1";

                                    try {
                                        $stmt = $conn->query($sql);
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $amount = $row["amount"];

                                        // ดึงข้อมูลอื่น ๆ ที่ต้องการสำหรับ qrcode3002
                                        $rec_date_out = $row["rec_date_out"];
                                        $edo_pro_id = $row["edo_pro_id"];
                                        $id = $row["id"];

                                        // แปลงวันที่ให้เหลือเฉพาะปี (พ.ศ.)
                                        $rec_date_out_year = (int)date('Y', strtotime($rec_date_out)) + 543;
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                        $amount = 0; // ให้กำหนดค่าเริ่มต้นให้กับ $amount ถ้าเกิดข้อผิดพลาดในการดึงข้อมูล
                                    }

                                    // ต่อไปให้ทำการคำนวณ QR Code
                                    $amountFormatted = number_format($amount, 2, '.', '');
                                    $amountWithPadding = str_pad($amountFormatted, 10, '0', STR_PAD_LEFT);
                                    $qrcode00 = '000201';
                                    $qrcode01 = '010212';
                                    $qrcode3000 = '30630016A000000677010112';
                                    $qrcode3001 = '0115099400258783792';
                                    $qrcode3002 = '0215' . $rec_date_out_year . $edo_pro_id . 'E' . str_pad($id, 4, '0', STR_PAD_LEFT);
                                    $qrcode3003 = '03010';
                                    $qrcode30 = $qrcode3000 . $qrcode3001 . $qrcode3002 . $qrcode3003;

                                    $qrcode53 = '5303764';
                                    $qrcode54 = '5410' . ($amountWithPadding);
                                    $qrcode58 = '5802TH';
                                    $qrcode62 = '62100706SCB001';
                                    $qrcode63 = '6304';
                                    $qrcode = $qrcode00 . $qrcode01 . $qrcode30 . $qrcode53 . $qrcode54 . $qrcode58 . $qrcode63;
                                    $checkSum = CRC16HexDigest($qrcode);

                                    $qrcodeFull = $qrcode . $checkSum;

                                    // แสดงผลทางหน้าจอ
                                    // echo $qrcodeFull;
                                    require_once 'phpqrcode/qrlib.php';

                                    $codeContents = $qrcodeFull;

                                    $tempDir = "qecodepayment/";

                                    $fileName = 'qrcode_' . md5($codeContents) . '.png';

                                    $pngAbsoluteFilePath = $tempDir . $fileName;

                                    $urlRelativeFilePath = $tempDir . $fileName;

                                    // กำหนดขนาดรูปภาพ QR code ที่ต้องการ (เช่น 250x250)
                                    $qrCodeSize = 350;

                                    // กำหนดความละเอียดในระดับ Q
                                    $qrCodeECLevel = QR_ECLEVEL_Q;

                                    // สร้างรูปภาพ QR code ที่มีขนาดตามที่กำหนดและความละเอียด Q
                                    if (!file_exists($pngAbsoluteFilePath)) {
                                        QRcode::png($codeContents, $pngAbsoluteFilePath, $qrCodeECLevel, $qrCodeSize);
                                    }
                                    echo '<img src="' . $urlRelativeFilePath . '" width="' . $qrCodeSize . '" height="' . $qrCodeSize . '" />';
                                    ?>
                                </center>
                            </div>
                        </div>
                        <br>
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