<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section class="donate-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <div class="row">

                                <div class="custom-form donate-form">
                                    <label class="control-label">จำนวนเงิน</label>
                                    <input type="text" name="rec_money" class="form-control" required>
                                </div>

                                <fieldset class="custom-form donate-form" id="rec_status">
                                    <div class="row mt-4" required>
                                        <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                            <div class="form-check form-check-radio">
                                                <input type="radio" id="watch-me" value="yes" name="rec_status" class="form-check-input" required>
                                                <label class="form-check-label" for="watch-me">กรณีที่ต้องการนำใบเสร็จไปลดหย่อนภาษี</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                            <div class="form-check form-check-radio">
                                                <input type="radio" id="watch-me-maybe" value="no" name="rec_status" class="form-check-input">
                                                <label class="form-check-label" for="MemberMaybe">กรณีที่ไม่ต้องการใบเสร็จไปลดหย่อนภาษี</label>
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
                                            <div class="col-lg-6 col-12 mt-2">
                                                <label class="control-label">จังหวัด</label>
                                                <select class="form-control" name="province" id="province"></select>
                                            </div>
                                            <div class="col-lg-6 col-12 mt-2">
                                                <label class="control-label">อำเภอ/เขต</label>
                                                <select class="form-control" name="district" id="district">
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-12 mt-2">
                                                <label class="control-label">ตำบล/แขวง</label>
                                                <select class="form-control" name="subdistrict" id="subdistrict">
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="show-me-2" class="medium-12">
                                    </div>

                                </fieldset>
                                <div class="col-lg-12 col-12 mt-2">
                                    <button type="submit" class="form-control mt-4">ยืนยันข้อมูล</button>
                                    <?php echo '<pre>';
                                    print_r($_POST);
                                    echo '</pre>'; ?>
                                </div>
                            </div>
                        </form>
                        <!-- <?php require_once('donate_no_recript_add.php'); ?> -->
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
                    $('#show-me-2').hide();
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
</body>

</html>