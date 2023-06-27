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
                    <img src="images/banner.jpg" class="custom-block-image img-fluid" alt="">
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <?php
                    if (isset($_GET['edo_id'])) {
                        require_once 'connection.php';
                        $stmt = $conn->prepare("SELECT * FROM pro_edo WHERE edo_id=?");
                        $stmt->execute([$_GET['edo_id']]);
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <div class="col-lg-5 col-12 mb-5 mb-lg-0">
                        <img src="images/group-people-volunteering-foodbank-poor-people.jpg" class="custom-text-box-image img-fluid" alt="">
                    </div>
                    <div class="col-lg-7 col-12">
                        <div class="custom-text-box">
                            <h3 class="mb-2"><?= $row['edo_name']; ?></h3>

                            <h5 class="mb-3"><?= $row['edo_tex']; ?></h5>

                            <p class="mb-0"><?= $row['edo_description1']; ?></p>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="custom-text-box mb-lg-0">
                                    <h5 class="mb-3">วัตถุประสงค์</h5>
                                    <p>รายละเอียดวัตถุประสงค์ ขอโครงการ</p>
                                    <ul class="custom-list mt-2">
                                        <?php if (!empty($row['edo_name2'])) : ?>
                                            <li class="custom-list-item d-flex">
                                                <i class="bi-check custom-text-box-icon me-2"></i>
                                                <?= $row['edo_name2']; ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($row['edo_name3'])) : ?>
                                            <li class="custom-list-item d-flex">
                                                <i class="bi-check custom-text-box-icon me-2"></i>
                                                <?= $row['edo_name3']; ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (!empty($row['edo_name4'])) : ?>
                                            <li class="custom-list-item d-flex">
                                                <i class="bi-check custom-text-box-icon me-2"></i>
                                                <?= $row['edo_name4']; ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h2></h2>
                        <div class="col-lg-12 col-12" >
                            <a href="#section_4" class="custom-btn btn smoothscroll">บริจาคโดยไม่ประสงค์ออกนาม</a>
                            <a href="donateion.php?edo_id=<?= $row['edo_id']; ?>" class="custom-btn btn smoothscroll">บริจาคเพื่อลดหย่อนภาษี</a>
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