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
                                    <h5 class="mb-3"><?= $row['rec_fullname']; ?></h5>
                                </div>
                                <div class="col-lg-3 col-12 mt-2">
                                    <label class="control-label">เบอร์โทรศัพท์</label>
                                    <h5 class="mb-3"><?= $row['rec_tel']; ?></h5>
                                </div>
                                <div class="col-lg-3 col-12 mt-2">
                                    <label class="control-label">เลขบัตรประชาชน</label>
                                    <h5 class="mb-3"><?= $row['rec_idname']; ?></h5>
                                </div>
                                <div class="col-lg-3 col-12 mt-2">
                                    <label class="control-label">จำนวนเงิน</label>
                                    <h5 class="mb-3"><?= $row['rec_money']; ?></h5>
                                </div>
                                <div class="col-lg-8 col-12 mt-2">
                                    <label class="control-label">โครงการ</label>
                                    <h5 class="mb-3"><?= $row['p_name_TH']; ?></h5>
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
                                <p>1</p>
                            </div>

                            <div id="date-show-form" class=" medium-12">
                                <p>2</p>
                            </div>

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
                                            $('#date-show-form').show();
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
        $(document).ready(function() {
            // show/hide forms based on selected radio button
            $('input[type="radio"][name="DonationFrequency"]').change(function() {
                if ($(this).attr('id') == 'cancel') {
                    $('#form1').show();
                    $('#form2').hide();
                } else if ($(this).attr('id') == 'take') {
                    $('#form2').show();
                    $('#form1').hide(); // hide form1
                }
            });

            // pre-select the "cancel" button
            $('#cancel').prop('checked', true);
        });
    </script>

</body>

</html>