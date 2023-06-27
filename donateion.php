<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="cta-section section-padding section-bg">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <img src="images/banner_L.jpg" class="custom-block-image img-fluid" alt="">
                </div>
            </div>
            <br>
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
                    </h5>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="name_title" class="form-control" list="cars" placeholder="คำนำหน้าชื่อ">
                            <datalist id="cars">
                                <option value="นาย" />
                                <option value="นาง" />
                                <option value="นางสาว" />
                            </datalist>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_name" class="form-control" placeholder="ชื่อ">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_surname" class="form-control" placeholder="สกุล">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_tel" class="form-control" placeholder="เบอร์โทรศัพท์">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_idname" class="form-control" placeholder="เลขบัตรประชาชน">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_email" class="form-control" placeholder="อีเมล์">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="address" class="form-control" placeholder="ที่อยู่">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="road" class="form-control" placeholder="ถนน">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="provinces" class="form-control" placeholder="จังหวัด">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="amphures" class="form-control" placeholder="อำเภอ">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="districts" class="form-control" placeholder="ตำบล">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="text" name="rec_money" class="form-control" placeholder="จำนวนเงินบริจาค">
                        </div>
                    </div>
                    <button type="submit" class="form-control">ยืนยัน</button>
                    <?php echo '<pre>';
                    print_r($_POST);
                    echo '</pre>';
                    ?>
                </form>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>

</body>

</html>