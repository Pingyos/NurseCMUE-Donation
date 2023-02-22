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
                                    <h2 class="mb-3">ร่วมบริจาค คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</h2>
                                </div>
                                <?php
                                if (isset($_GET['edo_id'])) {
                                    require_once 'connection.php';
                                    $stmt = $conn->prepare("SELECT * FROM pro_edo WHERE edo_id=?");
                                    $stmt->execute([$_GET['edo_id']]);
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                }
                                ?>
                                <div class="col-lg-12 col-12">
                                    <h5 class="mb-3"><?= $row['edo_name']; ?></h5>
                                    <h7 class="mb-3"><?= $row['edo_tex']; ?></h7>
                                </div>
                            </center>

                            <fieldset id="Member">
                                <div class="row mt-4">
                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input type="radio" id="date-show-1" value="yes" name="Member" class="form-check-input">
                                            <label class="form-check-label" for="date-show-1">รายละเอียด</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                        <div class="form-check form-check-radio">
                                            <input type="radio" id="date-show-2" value="no" name="Member" class="form-check-input" checked="checked">
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

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="date-show-form" class=" medium-12">
                                    <div class="col-lg-12 col-12 mt-2">
                                        <input type="text" name="rec_money" class="form-control" placeholder="จำนวนเงินที่ท่านประสงค์จะบริจาค" required>
                                    </div>
                                    <fieldset id="rec_status">
                                        <div class="row mt-4">
                                            <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                                <div class="form-check form-check-radio">
                                                    <input type="radio" id="watch-me" value="no" name="rec_status" class="form-check-input">
                                                    <label class="form-check-label" for="watch-me">กรณีที่ไม่ต้องการนำใบเสร็จไปลดหย่อนภาษี</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                                <div class="form-check form-check-radio">
                                                    <input type="radio" id="watch-me-maybe" value="yes" name="rec_status" class="form-check-input" required checked="checked">
                                                    <label class="form-check-label" for="watch-me-maybe">กรณีที่ต้องการนำใบเสร็จไปลดหย่อนภาษี</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="show-me" class=" medium-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">คำนำหน้าชื่อ</label>
                                                    <select name="name_Title" class="form-control" onchange="showInput(this)">
                                                        <option value="">ไม่ระบุคำนำหน้า</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นางสาว">นาง</option>
                                                        <option value="นางสาว">นางสาว</option>
                                                        <option value="other">อื่นๆ</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">คำนำหน้าชื่ออื่นๆ</label>
                                                    <input type="text" name="name_Title_other" id="name_Title_other" class="form-control" style="display: none;">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">ชื่อ-สกุล</label>
                                                    <input type="text" name="rec_fullname" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">เบอร์โทรศัพท์</label>
                                                    <input type="text" name="rec_tel" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div id="show-me-2" class="medium-12">
                                            <div class="row">
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">คำนำหน้าชื่อ</label>
                                                    <select name="name_Title" class="form-control" onchange="showInput(this)">
                                                        <option value="">ไม่ระบุคำนำหน้า</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นางสาว">นาง</option>
                                                        <option value="นางสาว">นางสาว</option>
                                                        <option value="other">อื่นๆ</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">คำนำหน้าชื่ออื่นๆ</label>
                                                    <input type="text" name="name_Title_other" id="name_Title_other" class="form-control" style="display: none;">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">ชื่อ-สกุล</label>
                                                    <input type="text" name="rec_fullname" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">เบอร์โทรศัพท์</label>
                                                    <input type="text" name="rec_tel" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">อีเมล์</label>
                                                    <input type="email" name="rec_email" pattern="[^ @]*@[^ @]*" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">เลขบัตรประชาชน</label>
                                                    <input type="text" name="rec_idname" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">ที่อยู่</label>
                                                    <input type="text" name="address" class="form-control">
                                                </div>
                                                <div class="col-lg-6 col-12 mt-2">
                                                    <label class="control-label">ถนน</label>
                                                    <input type="text" name="road" class="form-control">
                                                </div>

                                                <?php
                                                require_once('ajax_db.php');
                                                $sql_provinces = "SELECT * FROM provinces";
                                                $query = mysqli_query($con, $sql_provinces);
                                                ?>
                                                <div class="col-lg-6 col-6 mt-2">
                                                    <label class="control-label">จังหวัด</label>
                                                    <select class="form-control" name="provinces" id="provinces" required>
                                                        <option value="" selected disabled></option>
                                                        <?php foreach ($query as $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name_th'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-6 mt-2">
                                                    <label class="control-label">อำเภอ</label>
                                                    <select class="form-control" name="amphures" id="amphures" required>
                                                        <option selected disabled></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-6 mt-2">
                                                    <label class="control-label">ตำบล</label>
                                                    <select class="form-control" name="districts" id="districts" required>
                                                        <option selected disabled></option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-6 mt-2">
                                                    <label class="control-label">รหัสไปรษณีย์</label>
                                                    <input type="text" name="zip_code" id="zip_code" class="form-control">
                                                </div>
                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                                <script type="text/javascript">
                                                    $('#provinces').change(function() {
                                                        var id_province = $(this).val();

                                                        $.ajax({
                                                            type: "POST",
                                                            url: "ajax_db.php",
                                                            data: {
                                                                id: id_province,
                                                                function: 'provinces'
                                                            },
                                                            success: function(data) {
                                                                $('#amphures').html(data);
                                                                $('#districts').html(' ');
                                                                $('#districts').val(' ');
                                                                $('#zip_code').val(' ');
                                                            }
                                                        });
                                                    });

                                                    $('#amphures').change(function() {
                                                        var id_amphures = $(this).val();

                                                        $.ajax({
                                                            type: "POST",
                                                            url: "ajax_db.php",
                                                            data: {
                                                                id: id_amphures,
                                                                function: 'amphures'
                                                            },
                                                            success: function(data) {
                                                                $('#districts').html(data);
                                                            }
                                                        });
                                                    });

                                                    $('#districts').change(function() {
                                                        var id_districts = $(this).val();

                                                        $.ajax({
                                                            type: "POST",
                                                            url: "ajax_db.php",
                                                            data: {
                                                                id: id_districts,
                                                                function: 'districts'
                                                            },
                                                            success: function(data) {
                                                                $('#zip_code').val(data)
                                                            }
                                                        });

                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <script>
                                            function showHide(input) {
                                                var attrVal = $(input).attr('id');
                                                switch (attrVal) {
                                                    case 'watch-me':
                                                        $('#show-me-2').hide();
                                                        $('#show-me').show();
                                                        break;
                                                    case "watch-me-maybe":
                                                        $('#show-me').hide();
                                                        $('#show-me-2').show();
                                                        break;
                                                    default:
                                                        $('#show-me-2').show();
                                                        $('#show-me').hide();
                                                        break;
                                                }
                                            }
                                            $(document).ready(function() {
                                                $('input[type="radio"]').each(function() {
                                                    showHide(this);
                                                });
                                                $('input[type="radio"]').click(function() {
                                                    showHide(this);
                                                });
                                            });
                                        </script>
                                    </fieldset>
                                    <div class="col-lg-12 col-12 mt-2">
                                        <button type="submit" class="form-control mt-4">ยืนยันข้อมูล</button>
                                        <!-- <?php echo '<pre>';
                                        print_r($_POST);
                                        echo '</pre>'; ?> -->
                                    </div>
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
                        <?php require_once('donate_no_recript_add.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="service/province.service.js" type="text/javascript"></script>
    <script>
        function showInput(selectElement) {
            var inputElement = document.getElementById("name_Title_other");
            if (selectElement.value === "other") {
                inputElement.style.display = "block";
                inputElement.setAttribute("required", true);
            } else {
                inputElement.style.display = "none";
                inputElement.removeAttribute("required");
            }
        }
    </script>



</body>

</html>