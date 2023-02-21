<!doctype html>
<html lang="en">

<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>

    <main>

        <section class="hero-section hero-section-full-height">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 col-12 p-0">
                        <div id="hero-slide" class="carousel carousel-fade slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="images/slide/DSC_8450.jpg" class="carousel-image img-fluid" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>โครงการ</h1>

                                        <p>ส่งต่อความดีเพื่อสังคม</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slide/DSC_3595.jpg" class="carousel-image img-fluid" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>โครงการบริจาค</h1>
                                        <p>เพื่อนร่วมวิชาชีพพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slide/DSC_7972.jpg" class="carousel-image img-fluid" alt="...">

                                    <div class="carousel-caption d-flex flex-column justify-content-end">
                                        <h1>โครงการบริจาค</h1>

                                        <p>เพื่อผู้ยากไร้และผู้ด้อยโอกาสในสังคม</p>
                                    </div>
                                </div>
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#hero-slide" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#hero-slide" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="section-padding" id="section_2">
            <div class="container py-2">
                <div class="container">
                    <div class="row portfolio-container">
                        <?php
                        require_once 'connection.php';
                        $stmt = $conn->prepare("SELECT* FROM pro_edo");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $t1) {
                        ?>
                            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" >
                                <div class="col-lg-12 col-md-6 col-12 mb-4 ">
                                    <div class="custom-block-wrap">
                                        <img src="images/causes/DSC_2926.jpg" class="custom-block-image img-fluid" alt="">
                                        <div class="custom-block">
                                            <div class="custom-block-body">
                                                <h5 class="mb-3"><?= $t1['edo_name_TH']; ?></h5>
                                                <p><?= $t1['edo_1']; ?></p>
                                                <p><?= $t1['edo_2']; ?></p>
                                                </p>
                                                <h7><?= $t1['edo_tex']; ?></h7>
                                            </div>
                                            <a href="donate_no_receipt.php?edo_id=<?= $t1['edo_id']; ?>" class="custom-btn btn">บริจาค</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="cta-section section-padding section-bg">
            <div class="container">
                <div class="row justify-content-center align-items-center">

                    <div class="col-lg-6 col-12">
                        <h2 class="mb-0">คณะพยาบาลศาสตร์<br>ขอขอบคุณ ผู้ที่ร่วมบริจาค</h2>

                    </div>
                </div>
        </section>

        <section class="section-padding section-bg" id="section_3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="images/group-people-volunteering-foodbank-poor-people.jpg" class="custom-text-box-image img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="custom-text-box">
                            <h2 class="mb-2">คณะพยาบาลศาสตร์</h2>
                            <h5 class="mb-3">มหาวิทยาลัยเชียงใหม่</h5>
                            <p class="mb-0">มีวัตถุประสงค์เพื่อเพิ่มช่องทางการรับเงินบริจาค ของมหาวิทยาลัยสำหรับผู้มีจิตศรัทธา นักศึกษาเก่า นักศึกษาปัจจุบัน บุคลากรปัจจุบัน ผู้เกษียณอายุในการบริจาคให้กับกองทุน มูลนิธิ และโครงการต่าง ๆ</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-section section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-5 col-12">
                        <img src="images/IMG_0048.jpg" class="about-image ms-lg-auto bg-light shadow-lg img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 col-md-7 col-12">
                        <div class="custom-text-block">
                            <h2 class="mb-0">จะได้รับการจัดสรรอย่างคุ้มค่าสำหรับการดำเนินงานที่ก่อให้เกิดประโยชน์สูงสุด</h2>
                            <p class="text-muted mb-lg-1 mb-md-1">ผศ. ดร.ธานี แก้วธรรมานุกูล</p>
                            <p class="text-muted mb-lg-4 mb-md-1">คณบดีคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</p>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="testimonial-section section-padding section-bg">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 col-12 mx-auto">
                        <h2 class="mb-lg-3">เงินบริจาคที่ได้รับจากทุกท่าน</h2>

                        <div id="testimonial-carousel" class="carousel carousel-fade slide" data-bs-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="carousel-caption">
                                        <h4 class="carousel-title">จะได้รับการจัดสรรอย่างคุ้มค่าสำหรับการดำเนินงานที่ก่อให้เกิดประโยชน์สูงสุด</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="contact-section section-padding" id="section_4">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 ms-auto mb-5 mb-lg-0">
                        <div class="contact-info-wrap">

                            <div class="contact-info">
                                <h5 class="mb-3">ที่อยู่ติดต่อ</h5>

                                <p class="d-flex mb-2">
                                    <i class="bi-geo-alt me-2"></i>
                                    110/406 คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่
                                    ถนนอินทวโรรส ตำบลสุเทพ อำเภอเมือง จังหวัดเชียงใหม่ 50200
                                </p>

                                <p class="d-flex mb-2">
                                    <i class="bi-telephone me-2"></i>

                                    <a href="tel: 120-240-9600">
                                        053-935024
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <i class="bi-envelope me-2"></i>

                                    <a href="mailto:info@yourgmail.com">
                                        edonation@gmail.com
                                    </a>
                                </p>

                                <a href="#section_2" class="custom-btn btn mt-3">บริจาค</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <iframe class="position-absolute w-100 h-100" style="object-fit: cover;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1099.2262701636307!2d98.97619296178715!3d18.78892395938322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a8443849f9f%3A0x488466f957ec8374!2z4LiE4LiT4Liw4Lie4Lii4Liy4Lia4Liy4Lil4Lio4Liy4Liq4LiV4Lij4LmMIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4ouC5gOC4iuC4teC4ouC4h-C5g-C4q-C4oeC5iA!5e1!3m2!1sth!2sth!4v1671595106286!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>


</body>

</html>