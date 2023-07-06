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
                                    <img src="images/slide/DSC_3595.jpg" class="carousel-image img-fluid" alt="...">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slide/DSC_7972.jpg" class="carousel-image img-fluid" alt="...">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slide/DSC_8450.jpg" class="carousel-image img-fluid" alt="...">
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

        <section class="cta-section section-padding section-bg">
            <img src="images/banner.jpg" class="col-lg-12 col-md-5 col-12" alt="">
        </section>

        <section class="section-padding" id="section_2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>โครงการ</h2>
                    </div>
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT * FROM pro_edo");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $t1) {
                        $edoId = $t1['edo_id'];
                        $imageURL = "images/causes" . $t1['img_file'];
                    ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block-wrap">
                                <img src="images/causes/<?= $t1['img_file']; ?>" class="custom-block-image img-fluid" alt="">
                                <div class="custom-block">
                                    <div class="custom-block-body">
                                        <h5 class="mb-3"><?= $t1['edo_name']; ?></h5>
                                        <p><?= $t1['edo_tex']; ?></p>
                                    </div>
                                    <a href="donate_details.php?edo_id=<?= $edoId; ?>" class="custom-btn btn">บริจาค</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="about-section section-padding" id="section_4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="images/bannerdonation.jpg" class="custom-text-box-image img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="images/bannerdonation.jpg" class="custom-text-box-image img-fluid" alt="">
                    </div>
                </div>
            </div>
            <br>
            <div class="col-lg-12 col-12 text-center mb-4">
                <h5>ในกรณีที่ไม่สามารถบริจาคผ่าน e-donation ได้ ให้ติดต่อ</h5>
                <p>โทรศัพท์ 053-949075</p>
                <p>นางสาวชนิดา ต้นพิพัฒน์ งานการเงิน การคลังและพัสดุ คณะพยาบาลศาสตร์</p>
            </div>
        </section>
    </main>

    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>

</body>

</html>