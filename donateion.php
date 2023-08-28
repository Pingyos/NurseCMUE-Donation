<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="cta-section section-padding section-bg">
            <img src="images/banner.jpg" class="col-lg-12 col-md-5 col-12" alt="">
            <?php
            if (isset($_GET['edo_id'])) {
                require_once 'connection.php';
                $stmt = $conn->prepare("SELECT * FROM pro_edo WHERE edo_id=?");
                $stmt->execute([$_GET['edo_id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <div class="col-lg-8 col-12 mx-auto">
                <form class="custom-form contact-form" action="#" method="post" role="form">
                    <h5 class="mb-4"><?= $row['edo_name']; ?>
                        <p><?= $row['edo_tex']; ?></p>
                    </h5>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="name_title" class="form-control" list="cars" placeholder="คำนำหน้าชื่อ *" required>
                            <datalist id="cars">
                                <option value="นาย" />
                                <option value="นาง" />
                                <option value="นางสาว" />
                            </datalist>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_name" class="form-control" placeholder="ชื่อ *" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_surname" class="form-control" placeholder="สกุล *" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_tel" class="form-control" placeholder="เบอร์โทรศัพท์ *" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_idname" class="form-control" placeholder="เลขบัตรประชาชน *" maxlength="13" pattern="[0-9]{13}" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_email" class="form-control" placeholder="อีเมล์">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="address" class="form-control" placeholder="ที่อยู่ *" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="road" class="form-control" placeholder="ถนน">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="provinces" class="form-control" id="provincesInput" placeholder="จังหวัด *" required>
                        </div>
                        <script>
                            document.getElementById('provincesInput').addEventListener('blur', function() {
                                var inputElement = this;
                                var inputValue = inputElement.value.trim();
                                var prefix = 'จ. ';

                                // ตรวจสอบว่าข้อมูลที่กรอกเข้ามาไม่ใช่ค่าว่าง และยังไม่มีคำนำหน้า "จ." อยู่แล้ว
                                if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                    inputElement.value = prefix + inputValue;
                                }
                            });
                        </script>


                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="amphures" class="form-control" id="amphuresInput" placeholder="อำเภอ *" required>
                        </div>
                        <script>
                            document.getElementById('amphuresInput').addEventListener('blur', function() {
                                var inputElement = this;
                                var inputValue = inputElement.value.trim();
                                var prefix = 'อ. ';

                                // ตรวจสอบว่าข้อมูลที่กรอกเข้ามาไม่ใช่ค่าว่าง และยังไม่มีคำนำหน้า "จ." อยู่แล้ว
                                if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                    inputElement.value = prefix + inputValue;
                                }
                            });
                        </script>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="districts" class="form-control" id="districtsInput" placeholder="ตำบล *" required>
                        </div>
                        <script>
                            document.getElementById('districtsInput').addEventListener('blur', function() {
                                var inputElement = this;
                                var inputValue = inputElement.value.trim();
                                var prefix = 'ต. ';

                                // ตรวจสอบว่าข้อมูลที่กรอกเข้ามาไม่ใช่ค่าว่าง และยังไม่มีคำนำหน้า "จ." อยู่แล้ว
                                if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                    inputElement.value = prefix + inputValue;
                                }
                            });
                        </script>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="text" name="amount" class="form-control" placeholder="จำนวนเงินบริจาค *" required>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" name="edo_name" value="<?= $row['edo_name']; ?>" hidden>
                        <input type="text" name="edo_pro_id" value="<?= $row['edo_pro_id']; ?>" hidden>
                        <input type="text" name="edo_description" value="<?= $row['edo_description']; ?>" hidden>
                        <input type="text" name="edo_objective" value="<?= $row['edo_objective']; ?>" hidden>
                        <input type="text" name="status_donat" value="online" hidden>
                        <input type="text" name="status_user" value="person" hidden>
                        <input type="text" name="status_receipt" value="yes" hidden>
                        <input type="text" name="rec_date_out" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="payby" value="เงินโอน" hidden>
                        <input type="text" name="rec_date_s" hidden>
                        <input type="text" name="comment" hidden>
                    </div>
                    <button type="submit" class="form-control">ยืนยัน</button>
                    <?php require_once('donateion_add.php'); ?>
                    <!-- <?php echo '<pre>';
                            print_r($_POST);
                            echo '</pre>';
                            ?> -->
                </form>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>

</body>

</html>