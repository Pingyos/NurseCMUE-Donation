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
                                    <label class="control-label">First Name</label>
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
                                <div class="col-lg-8 col-12 mt-2">
                                    <label class="control-label">รายละเอียดโครงการ</label>
                                    <input type="text" name="rec_fullname" value="<?= $row['edo_name']; ?>" class="form-control" readonly>
                                </div>
                                <div class="col-lg-4 col-12 mt-2">
                                    <label class="control-label">ประเภทลดหย่อนภาษี</label>
                                    <input type="text" name="rec_fullname" value="<?= $row['edo_tex']; ?>" class="form-control" readonly>
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
                                        $PromptPayQR = new PromptPayQR();
                                        $PromptPayQR->size = 7;
                                        $PromptPayQR->id = '5665690444'; 
                                        $PromptPayQR->amount = $amount; 
                                        echo '<img src="' . $PromptPayQR->generate() . '" />';
                                        ?>
                                    </div>
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