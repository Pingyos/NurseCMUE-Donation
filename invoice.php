<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>โครงการ</th>
                                        <th>ดูใบเสร็จรับเงิน</th>
                                        <th>ดาวน์โหลดใบเสร็จรับเงิน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'database_connection.php';
                                    $display_query = "SELECT T1.id, T1.rec_fullname, T1.edo_name FROM receipt T1";
                                    $results = mysqli_query($con, $display_query);
                                    $count = mysqli_num_rows($results);
                                    if ($count > 0) {
                                        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $data_row['rec_fullname']; ?></td>
                                                <td><?php echo $data_row['edo_name']; ?></td>
                                                <td>
                                                    <a href="pdf_maker.php?id=<?php echo $data_row['id']; ?>&ACTION=VIEW" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View PDF</a>
                                                </td>
                                                <td>
                                                    <a href="pdf_maker.php?id=<?php echo $data_row['id']; ?>&ACTION=DOWNLOAD" class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
</body>

</html>