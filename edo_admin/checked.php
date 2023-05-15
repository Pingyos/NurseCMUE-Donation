<?php
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>โครงการ</th>
                                            <th>รายละเอียด</th>
                                            <th>ดาวน์โหลด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require '../database_connection.php';

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
                                                        <a href="pdf_maker1.php?id=<?php echo $data_row['id']; ?>&ACTION=VIEW" target="_blank" class="btn btn-success">
                                                            <i class="fa fa-file-pdf-o"></i> ดูรายละเอียด
                                                        </a>
                                                        <?php
                                                        // Get the record ID and password from the POST data
                                                        if (isset($_POST['id'])) {
                                                            $id = $_POST['id'];
                                                            $password = $_POST['password'];

                                                            // Connect to the database
                                                            $mysqli = new mysqli("localhost", "root", "", "nurse_edo");

                                                            // Prepare a statement to check if the password is valid for the given record ID
                                                            $stmt = $mysqli->prepare("SELECT * FROM receipt WHERE id = ? and password = ?");
                                                            $stmt->bind_param("ss", $id, $password);
                                                            $stmt->execute();

                                                            // Check if the query returned any rows
                                                            if ($stmt->fetch()) {
                                                                // If the password is valid, return "valid"
                                                                echo "valid";
                                                            } else {
                                                                // If the password is invalid, return "invalid"
                                                                echo "invalid";
                                                            }

                                                            // Close the statement and database connection
                                                            $stmt->close();
                                                            $mysqli->close();
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="pdf_maker1.php?id=<?php echo $data_row['id']; ?>&ACTION=DOWNLOAD" target="_blank" class="btn btn-warning"><i class="fa fa-download"></i> ดาวน์โหลด</a>
                                                    </td>
                                                </tr>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


</body>

</html>