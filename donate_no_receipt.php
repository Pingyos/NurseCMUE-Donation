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
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <h5 class="mb-3">บริจาคแบบไม่ลดหย่อนภาษีและไม่รับใบเสร็จ</h5>
                                </div>
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

                                <div class="col-lg-12 col-12 mt-2">
                                    <button type="submit" name="submit" class="form-control mt-4">ยืนยันข้อมูล</button>
                                </div>
                            </div>
                        </form>
                        <?php require_once('donate_no_recript_add.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>

</body>

</html>