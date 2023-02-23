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

                        <div class="row">
                            <?php
                            require_once 'connection.php';
                            $stmt = $conn->query("SELECT * FROM receipt ORDER BY id DESC LIMIT 1");
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="row">
                                <div class="col-lg-3 col-12 mt-2">
                                    <label class="control-label">ชื่อ-สกุล</label>
                                    <input type="text" name="rec_fullname" value="<?= $row['rec_fullname']; ?>" class="form-control" readonly>
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
                                <div class="col-lg-6 col-12 mt-2">
                                    <label class="control-label">รายละเอียดโครงการ</label>
                                    <input type="text" name="rec_fullname" value="<?= $row['edo_name']; ?>" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6 col-12 mt-2">
                                    <label class="control-label">ประเภทลดหย่อนภาษี</label>
                                    <input type="text" name="rec_fullname" value="<?= $row['edo_tex']; ?>" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <fieldset id="Member">
                            <div class="row mt-4">
                                <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                    <div class="form-check form-check-radio">
                                        <input type="radio" id="date-show-1" value="yes" name="Member" class="form-check-input">
                                        <label class="form-check-label" for="date-show-1">ชำระผ่านเลขบัญชี</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                    <div class="form-check form-check-radio">
                                        <input type="radio" id="date-show-2" value="no" name="Member" class="form-check-input" checked="checked">
                                        <label class="form-check-label" for="date-show-2">ชำระผ่าน QC CODE</label>
                                    </div>
                                </div>
                            </div>


                            <div id="date-show-date" class=" medium-12">
                                <div class="row">
                                    <center>
                                        <div class="col-lg-12 col-12 mt-2">
                                            <h3>ขอบคุณที่ร่วมบริจาค</h3>
                                            <h6>ท่านสามารถแนบเอกสารแจ้งโอนในภายหลัง โดยการตรวจสอบ E-mail ที่ท่านลงทะเบียนไว้</h6>
                                        </div>
                                    </center>
                                    <div class="row">
                                        <div class="col-lg-6 col-12 ">
                                            <div class="custom-text-box">
                                                <div class="col-lg-6 col-12 text-center">
                                                    <img src="images/icon_bank/scb.png" width="60" height="60">
                                                </div>
                                                <div class="form-group mt-2 ">
                                                    <label for="university"><span>ชื่อบัญชี: </span>คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</label>
                                                </div>
                                                <div id="sample" class="form-group">
                                                    <label for="university"><span>เลขที่บัญชี: </span>566-569044-4</label>
                                                </div>
                                                <button onclick="copyText()">คัดลอกเลขที่บัญชี</button>
                                                <script>
                                                    function copyText() {
                                                        navigator.clipboard.writeText("566-569044-4");
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="date-show-form" class=" medium-12">
                                <center>
                                    <div class="col-lg-6 col-12 mt-2">
                                        <?Php
                                        require_once("libcache/PromptPayQR.php");
                                        require_once("connection.php");
                                        $stmt = $conn->query("SELECT * FROM receipt ORDER BY id DESC LIMIT 1");
                                        $row = $stmt->fetch();
                                        $amount = $row['rec_money'];

                                        $PromptPayQR = new PromptPayQR(); // new object
                                        $PromptPayQR->size = 7; // Set QR code size to 8
                                        $PromptPayQR->id = '5665690444'; // PromptPay ID
                                        $PromptPayQR->amount = $amount; // Set amount (not necessary)
                                        echo '<img src="' . $PromptPayQR->generate() . '" />';
                                        ?>
                                    </div>
                                </center>
                            </div>

                            <!-- <div class="col-lg-12 col-12 mt-2">
                                <?php
                                require_once 'connection.php';
                                $stmt = $conn->prepare("SELECT* FROM receipt");
                                $stmt->execute();
                                $result = $stmt->fetchAll();
                                foreach ($result as $t2)
                                ?>
                                <a href="mindphp02.php?id=<?= $t2['id']; ?>" class="custom-btn btn">ใบเสร็จรับเงิน</a>
                            </div> -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showHide1(input) {
            var attrVal = $(input).attr('id');
            switch (attrVal) {
                case 'date-show-1':
                    $('#date-show-form').hide();
                    $('#date-show-date').show();
                    break;
                case "date-show-2":
                    $('#date-show-date').hide();
                    $('#date-show-form').show();
                    break;
                default:
                    $('#date-show-form').hide();
                    $('#date-show-date').hide();
                    break;
            }
        }
        $(document).ready(function() {
            $('input[type="radio"]').each(function() {
                showHide1(this);
            });
            $('input[type="radio"]').click(function() {
                showHide1(this);
            });
        });
    </script>

</body>

</html>