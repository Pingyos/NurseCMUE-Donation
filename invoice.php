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
                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>โครงการ</th>

                                        <th>ใบเสร็จรับเงิน</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'database_connection.php';

                                    $display_query = "SELECT T1.id, T1.rec_fullname, T1.edo_name, T1.rec_date FROM receipt T1";
                                    $results = mysqli_query($con, $display_query);
                                    $count = mysqli_num_rows($results);

                                    if ($count > 0) {
                                        // Format date in Thai language
                                        $thai_months = array(
                                            "01" => "มกราคม",
                                            "02" => "กุมภาพันธ์",
                                            "03" => "มีนาคม",
                                            "04" => "เมษายน",
                                            "05" => "พฤษภาคม",
                                            "06" => "มิถุนายน",
                                            "07" => "กรกฎาคม",
                                            "08" => "สิงหาคม",
                                            "09" => "กันยายน",
                                            "10" => "ตุลาคม",
                                            "11" => "พฤศจิกายน",
                                            "12" => "ธันวาคม"
                                        );

                                        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                                            // Retrieve date value from database
                                            $date = $data_row['rec_date'];

                                            // Format date in Thai language
                                            $year = date('Y', strtotime($date)) + 543;
                                            $month = date('m', strtotime($date));
                                            $month_thai = $thai_months[$month];
                                            $day = date('d', strtotime($date));
                                    ?>
                                            <tr>
                                                <td><?php echo $data_row['rec_fullname']; ?><br><span style="font-size: 14px;">
                                                        <?php echo $day . ' ' . $month_thai . ' ' . $year; ?>
                                                    </span>
                                                </td>
                                                <td><?php echo $data_row['edo_name']; ?></td>
                                                <td>
                                                    <a href="pdf_maker.php?id=<?php echo $data_row['id']; ?>&ACTION=VIEW" target="_blank" class="custom-btn1 btn"><i class="fa fa-file-pdf-o"></i> ดู</a>
                                                    <a href="pdf_maker.php?id=<?php echo $data_row['id']; ?>&ACTION=DOWNLOAD" target="_blank" class="custom-btn1 btn"><i class="fa fa-download"></i> ดาวน์โหลด</a>
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
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>