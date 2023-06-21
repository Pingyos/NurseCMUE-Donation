<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <center>
                                <div class="col-lg-12 col-12">
                                    <h5 class="mb-3">ร่วมบริจาค คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</h5>
                                </div>
                                <?php
                                if (isset($_GET['edo_id'])) {
                                    require_once 'connection.php';
                                    $stmt = $conn->prepare("SELECT * FROM pro_edo WHERE edo_id=?");
                                    $stmt->execute([$_GET['edo_id']]);
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $edo_name = $row['edo_name'];
                                    $edo_tex = $row['edo_tex'];
                                    $edo_pro_id = $row['edo_pro_id'];
                                    $edo_description = $row['edo_description'];
                                    $edo_objective = $row['edo_objective'];
                                }
                                ?>
                                <div class="col-lg-12 col-12">
                                    <h3 class="mb-3"><?= $row['edo_name']; ?></h3>
                                    <h3 class="mb-3"><?= $row['edo_tex']; ?></h3>
                                </div>
                            </center>

                            <fieldset id="date">
                                <!--  -->
                                <div class="row mt-4">
                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input type="radio" id="date-show-1" value="yes" name="date" class="form-check-input">
                                            <label class="form-check-label" for="date-show-1">รายละเอียดโครงการ</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input type="radio" id="date-show-2" value="no" name="date" class="form-check-input" checked="checked">
                                            <label class="form-check-label" for="date-show-2">บริจาค</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="date-show-date" class=" medium-12">
                                    <div class="container">
                                        <?php
                                        if (isset($_GET['edo_id'])) {
                                            require_once 'connection.php';
                                            $stmt = $conn->prepare("SELECT * FROM pro_edo WHERE edo_id=?");
                                            $stmt->execute([$_GET['edo_id']]);
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-lg-4 col-12 mb-5 mb-lg-0">
                                                <img src="images/group-people-volunteering-foodbank-poor-people.jpg" class="custom-text-box-image img-fluid" alt="">
                                            </div>
                                            <div class="col-lg-8 col-12">
                                                <div class="custom-text-box">
                                                    <h5 class="mb-2"><?= $row['edo_name']; ?></h5>
                                                    <h5 class="mb-0"><?= $row['edo_name1']; ?></h5>
                                                    <p class="mb-0"><?= $row['edo_slogan1']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_description1']; ?></p>
                                                    <h5 class="mb-0"><?= $row['edo_name2']; ?></h5>
                                                    <p class="mb-0"><?= $row['edo_slogan2']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_description2']; ?></p>
                                                    <h5 class="mb-0"><?= $row['edo_name3']; ?></h5>
                                                    <p class="mb-0"><?= $row['edo_slogan3']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_description3']; ?></p>
                                                    <h5 class="mb-0"><?= $row['edo_name4']; ?></h5>
                                                    <p class="mb-0"><?= $row['edo_slogan4']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_description4']; ?></p>
                                                    <h5>วัตถุประสงค์</h5>
                                                    <p class="mb-0"><?= $row['edo_objective1']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_objective2']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_objective3']; ?></p>
                                                    <p class="mb-0"><?= $row['edo_objective4']; ?></p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div id="date-show-form" class=" medium-12">
                                    <input type="text" name="edo_name" value="<?= $edo_name; ?>" hidden>
                                    <input type="text" name="edo_tex" value="<?= $edo_tex; ?>" hidden>
                                    <input type="text" name="edo_pro_id" value="<?= $edo_pro_id; ?>" hidden>
                                    <input type="text" name="edo_description" value="<?= $edo_description; ?>" hidden>
                                    <input type="text" name="edo_objective" value="<?= $edo_objective; ?>" hidden>
                                    <input type="text" name="payby" value="โอน" hidden>
                                    <div id="show-me-2" class="medium-12">
                                        <div class="col-lg-12 col-12 mt-2">
                                            <label class="control-label">จำนวนเงินที่ท่านประสงค์จะบริจาค <span style="color:red;">*</span></label>
                                            <input type="number" name="rec_money" class="form-control" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">คำนำหน้าชื่อ <span style="color:red;">*</span></label>
                                                <input type="text" name="name_title" class="form-control" list="cars" required>
                                                <datalist id="cars">
                                                    <option value="นาย" />
                                                    <option value="นาง" />
                                                    <option value="นางสาว" />
                                                </datalist>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">ชื่อ <span style="color:red;">*</span></label>
                                                <input type="text" name="rec_name" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">สกุล <span style="color:red;">*</span></label>
                                                <input type="text" name="rec_surname" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">เบอร์โทรศัพท์ <span style="color:red;">*</span></label>
                                                <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">อีเมล์</label>
                                                <input type="text" name="rec_email" class="form-control">
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">เลขบัตรประชาชน<span style="color:red;">*</span></label>
                                                <input type="number" required tabindex="1" placeholder="x-xxxxx-xxxxx-xx-x" name="rec_idname" id="rec_idname" size="25" value="" class="form-control" onkeyup="autoTab(this)" minlength="13" maxlength="20" />
                                            </div>
                                            <script>
                                                function autoTab(obj) {
                                                    var pattern = new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
                                                    var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
                                                    var returnText = new String("");
                                                    var obj_l = obj.value.length;
                                                    var obj_l2 = obj_l - 1;
                                                    for (i = 0; i < pattern.length; i++) {
                                                        if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                                                            returnText += obj.value + pattern_ex;
                                                            obj.value = returnText;
                                                        }
                                                    }
                                                    if (obj_l >= pattern.length) {
                                                        obj.value = obj.value.substr(0, pattern.length);
                                                    }
                                                }
                                            </script>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">ที่อยู่ <span style="color:red;">*</span></label>
                                                <input type="text" name="address" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">ถนน </label>
                                                <input type="text" name="road" class="form-control">
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">จังหวัด <span style="color:red;">*</span></label>
                                                <input type="text" name="provinces" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">อำเภอ <span style="color:red;">*</span></label>
                                                <input type="text" name="amphures" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">ตำบล <span style="color:red;">*</span></label>
                                                <input type="text" name="districts" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4 col-12 mt-2">
                                                <label class="control-label">รหัสไปรษณีย์</label>
                                                <input type="text" name="zip_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="form-control mt-4">ยืนยันข้อมูล</button>
                                    <?php require_once 'donate_no_recript_add.php'; ?>
                                    <?php echo '<pre>';
                                    print_r($_POST);
                                    echo '</pre>';
                                    ?>
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
        </section>
    </main>
    <?php require_once('footer.php'); ?>
</body>

</html>