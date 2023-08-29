<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="cta-section section-padding section-bg">
            <div class="container">
                <img src="images/banner.jpg" class="col-lg-12 col-md-5 col-12" alt="">
            </div>
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
                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="text" name="rec_name" value="ไม่ประสงค์ออกนาม" class="form-control" readonly>
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="number" id="amountInput" name="amount" class="form-control" placeholder="จำนวนเงินบริจาค" step="0.01" required>
                        </div>
                        <script>
                            const amountInput = document.getElementById('amountInput');

                            amountInput.addEventListener('input', () => {
                                if (amountInput.value.includes('.')) {
                                    const parts = amountInput.value.split('.');
                                    if (parts[1].length > 2) {
                                        parts[1] = parts[1].substring(0, 2);
                                        amountInput.value = parts.join('.');
                                    }
                                }
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
                        <input type="text" name="status_receipt" value="no" hidden>
                        <?php
                        require_once 'connection.php';

                        try {
                            $last_id_query = "SELECT MAX(id) AS max_id FROM receipt_offline;";
                            $last_id_result = $conn->query($last_id_query);

                            if ($last_id_result) {
                                $last_id_row = $last_id_result->fetch(PDO::FETCH_ASSOC);
                                $last_id = $last_id_row['max_id'];
                                $id_receipt = date('Y') + 543 . '-' . $row['edo_pro_id'] . '-E' . str_pad($last_id, 4, '0', STR_PAD_LEFT);
                            } else {
                                echo "Error querying database: " . $conn->errorInfo()[2];
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        ?>
                        <input type="text" name="id_receipt" value="<?= $id_receipt ?>" hidden>

                        <input type="text" name="rec_date_out" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="rec_date_s" hidden>
                        <input type="text" name="name_title" hidden>
                        <input type="text" name="payby" value="online" hidden>
                        <input type="text" name="rec_surname" hidden>
                        <input type="text" name="rec_tel" value="-" hidden>
                        <input type="text" name="rec_idname" value="-" hidden>
                        <input type="text" name="rec_email" hidden>
                        <input type="text" name="address" hidden>
                        <input type="text" name="road" hidden>
                        <input type="text" name="provinces" hidden>
                        <input type="text" name="amphures" hidden>
                        <input type="text" name="districts" hidden>
                        <input type="text" name="zip_code" hidden>
                        <input type="text" name="comment" hidden>

                    </div>
                    <button type="submit" class="form-control">ยืนยัน</button>
                    <?php require_once('donateion_add.php'); ?>
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