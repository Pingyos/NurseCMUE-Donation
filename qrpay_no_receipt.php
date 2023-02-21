<!doctype html>
<html lang="en">

<?php require_once('head.php'); ?>

<body>

    <?php require_once('header.php');
    require_once('nav.php');
    ?>
    <main>
        <section class="donate-section">
            <div class="section-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mx-auto">
                        <form class="custom-form donate-form">
                            <div class="row">
                                <div align="center">
                                    <h3 class="mt-1">สแกนเพื่อจ่ายเงิน</h3>
                                </div>

                                <div align="center">
                                    <?php require_once('qrgenerator_no_receipt.php'); ?>
                                </div>

                                <div align="center">
                                    <h5 class="mt-1">สแกนได้ด้วยแอปของทุกธนาคาร</h5>
                                    <img src="images/icons/logobank.png" class="featured-block-image img-fluid" alt="">
                                </div>
                                <div align="center">
                                    <div class="col-lg-12 col-12 mt-2">
                                        <a href="index.php" class="custom-btn btn">กลับหน้าหลัก</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php require_once('footer.php'); ?>

</body>

</html>