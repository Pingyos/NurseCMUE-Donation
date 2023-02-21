<main>
        <section class="donate-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <div class="row">
                                <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="DonationFrequency" id="Donation_NO_receipt" checked>

                                        <label class="form-check-label" for="Donation_NO_receipt">
                                            ไม่ต้องการใบเสร็จ
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-6 form-check-group form-check-group-donation-frequency">
                                    <div class="form-check form-check-radio">
                                        <input class="form-check-input" type="radio" name="DonationFrequency" id="Donation_ON_receipt">

                                        <label class="form-check-label" for="Donation_ON_receipt">
                                            ต้องการใบเสร็จ
                                        </label>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-12 col-12 mt-2">
                                    <input type="text" name="project" id="project" class="form-control" placeholder="โครงการทุนการศึกษาเพื่อนักศึกษาพยาบาล มช." required>
                                </div> -->

                                <div class="col-lg-4 col-12 mt-2">
                                    <input type="text" name="name_Title" class="form-control" placeholder="คำนำหน้า" required>
                                </div>

                                <div class="col-lg-8 col-12 mt-2">
                                    <input type="text" name="fullname" class="form-control" placeholder="ชื่อ/สกุล" required>
                                </div>

                                <div class="col-lg-5 col-12 mt-2">
                                    <input type="text" name="tel" class="form-control" placeholder="เบอร์โทรติดต่อ">
                                </div>

                                <div class="col-lg-7 col-12 mt-2">
                                    <input type="email" name="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="อีเมล์">
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                    <input type="text" name="money" class="form-control" placeholder="จำนวนเงิน" required>
                                </div>

                                <div class="col-lg-12 col-12 mt-2">
                                    <button type="submit" name="submit" class="form-control mt-4">ยืนยันข้อมูล</button>
                                </div>
                            </div>
                        </form>
                        <?php require_once('inputform.php'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>