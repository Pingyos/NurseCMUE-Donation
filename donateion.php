<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="cta-section section-padding section-bg">
            <?php
            if (isset($_GET['edo_id'])) {
                require_once 'connection.php';
                $stmt = $conn->prepare("SELECT * FROM pro_edo WHERE edo_id=?");
                $stmt->execute([$_GET['edo_id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $imageURL = "images/" . $row['img_banner'];
            ?>
                    <div class="container">
                        <img src="<?= $imageURL; ?>" class="custom-text-box-image img-fluid" alt="">
                    </div>
            <?php
                }
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

                        <script>
                            const recTelInput = document.querySelector('input[name="rec_tel"]');

                            recTelInput.addEventListener("input", function() {
                                let value = this.value;
                                value = value.replace(/\D/g, ''); // ลบอักขระที่ไม่ใช่ตัวเลข

                                if (value.length < 8) {
                                    // หากมีน้อยกว่า 8 ตัวเลขให้แสดงข้อความแจ้งเตือน
                                    recTelInput.setCustomValidity("กรุณากรอกเบอร์โทรศัพท์ที่ถูกต้อง");
                                } else if (value.length > 10) {
                                    // หากมีมากกว่า 10 ตัวเลขให้ตัดทิ้งส่วนที่เกิน
                                    value = value.slice(0, 10);
                                    recTelInput.setCustomValidity("");
                                } else {
                                    recTelInput.setCustomValidity("");
                                }

                                this.value = value;
                            });
                        </script>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="number" name="rec_idname" id="rec_idname" class="form-control" placeholder="เลขบัตรประชาชน *" min="0" required>
                        </div>

                        <script>
                            const recIdnameInput = document.getElementById("rec_idname");

                            recIdnameInput.addEventListener("input", function() {
                                let value = this.value;
                                value = value.replace(/\D/g, ''); // ลบอักขระที่ไม่ใช่ตัวเลข

                                if (value < 0) {
                                    value = '';
                                }
                                if (value.length < 13) {
                                    // หากมีน้อยกว่า 13 ตัวเลขให้แสดงข้อความแจ้งเตือน
                                    recIdnameInput.setCustomValidity("กรุณากรอกเลขบัตรประชาชนให้ถูกต้อง");
                                } else {
                                    recIdnameInput.setCustomValidity("");
                                }

                                this.value = value;
                            });
                        </script>


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
                            <input type="number" name="zip_code" id="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
                        </div>

                        <script>
                            document.getElementById("zip_code").addEventListener("input", function() {
                                let value = this.value;
                                value = value.replace(/\D/g, '');
                                this.value = value;
                            });
                        </script>

                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="text" id="amountInput" name="amount" class="form-control" placeholder="จำนวนเงินบริจาค *" required>
                        </div>

                        <script>
                            const amountInput = document.getElementById('amountInput');

                            amountInput.addEventListener('input', () => {
                                let value = amountInput.value;
                                if (value.charAt(0).match(/[^0-9]/)) {
                                    value = value.substring(1); // ลบอักขระพิเศษที่อยู่ที่ตำแหน่งแรก
                                }
                                const cleanedValue = value.replace(/[^0-9.]/g, ''); // ลบทุกอักขระที่ไม่ใช่ตัวเลขหรือจุดทศนิยม

                                const parts = cleanedValue.split('.');
                                if (parts[0].length > 7) {
                                    parts[0] = parts[0].substring(0, 7);
                                }

                                if (parts.length > 1) {
                                    // มีทศนิยม
                                    if (parts[1].length > 2) {
                                        parts[1] = parts[1].substring(0, 2);
                                    }
                                }

                                amountInput.value = parts.join('.');
                            });
                        </script>
                    </div>
                    <div class="row">
                        <input type="text" name="edo_name" value="<?= $row['edo_name']; ?>" hidden>
                        <input type="text" name="edo_pro_id" value="<?= $row['edo_pro_id']; ?>" hidden>
                        <input type="text" name="edo_description" value="<?= $row['edo_description']; ?>" hidden>
                        <input type="text" name="edo_objective" value="<?= $row['edo_objective']; ?>" hidden>
                        <input type="text" name="status_donat" value="online" hidden>
                        <input type="text" name="status_user" value="person" hidden>
                        <input type="text" name="status_receipt" value="yes" hidden>
                        <input type="text" name="id_receipt" value="<?= $id_receipt ?>" hidden>
                        <input type="text" name="rec_date_out" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="payby" value="QR CODE" hidden>
                        <input type="text" name="rec_date_s" hidden>
                        <input type="text" name="other_description" hidden>
                        <input type="text" name="comment" hidden>
                        <?php
                        require_once 'connection.php';
                        $sql = "SELECT MAX(id) AS max_id, edo_pro_id FROM receipt_offline";

                        $stmt = $conn->query($sql);

                        if ($stmt->rowCount() > 0) {
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $maxId = $row["max_id"] + 1;
                            $edo_pro_id = $row["edo_pro_id"];

                            if ($maxId !== null && $edo_pro_id !== null) {
                                $id_receipt = date('Y') + 543 . '-' . $edo_pro_id . '-E' . str_pad($maxId, 4, '0', STR_PAD_LEFT);
                            }
                        } else {
                            echo "ไม่พบข้อมูลในตาราง";
                        }
                        ?>
                        <input type="text" name="id_receipt" value="<?= $id_receipt; ?>" hidden>
                    </div>
                    <button type="submit" class="form-control">ยืนยัน</button>
                    <?php
                    require_once('donateion_add.php');
                    // echo '<pre>';
                    // print_r($_POST);
                    // echo '</pre>';
                    ?>

                </form>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>

</body>

</html>