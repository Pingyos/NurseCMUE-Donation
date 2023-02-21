<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section class="donate-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <h5 class="mb-3">ข้อมูลที่อยู่การออกและจัดส่งใบเสร็จรับเงิน</h5>
                                    <h7 class="mb-3" >หมายเหตุ กรุณาใส่ชื่อ-นามสุกล ให้ถูกต้องสำหรับออกใบเสร็จลดหย่อนภาษี                           
                                    </h7>
                                </div>
                                <div class="col-lg-4 col-12 mt-2">
                                    <select name="name_Title" class="form-control" required>
                                        <option value="">ไม่ระบุคำนำหน้า</option>
                                        <option 1="">นาย</option>
                                        <option 2="">นางสาว</option>
                                        <option 3="">เด็กหญิง</option>
                                        <option 4="">เด็กชาย</option>
                                    </select>
                                </div>
                                <div class="col-lg-8 col-12 mt-2">
                                    <input type="text" name="fullname" class="form-control" placeholder="ชื่อ/สกุล/นิติบุคคล*" required>
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                    <input type="text" name="idname" class="form-control" placeholder="เลขบัตรประชาชน*" required>
                                </div>

                                <div class="col-lg-5 col-12 mt-2">
                                    <input type="text" name="tel" class="form-control" placeholder="เบอร์โทรติดต่อ">
                                </div>

                                <div class="col-lg-7 col-12 mt-2">
                                    <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="อีเมล์">
                                </div>

                                <div class="col-lg-6 col-6 mt-2">
                                    <input type="text" name="addhome" class="form-control" placeholder="ที่อยู่*" required>
                                </div>

                                <div class="col-lg-6 col-6 mt-2">
                                    <input type="text" name="road" class="form-control" placeholder="ถนน">
                                </div>

                                <?php require_once('dropdownprovinces.php'); ?>

                                <div class="col-lg-12 col-12 mt-2">
                                    <input type="text" name="money" class="form-control" placeholder="จำนวนเงิน*" required>
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                    <button type="submit" name="submit" class="form-control mt-4">ยืนยันข้อมูล</button>
                                </div>
                            </div>
                        </form>
                        <?php require_once('donate_yes_receipt_add.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>

</body>

</html>