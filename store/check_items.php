<?php
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">
                <?php
                if (isset($_GET['receipt_id'])) {
                    require_once 'connection.php';
                    $receipt_id = $_GET['receipt_id'];
                    $newItemsValue = 2;
                    $itemsSetValue = 1;

                    $conn->beginTransaction(); // Start a transaction

                    $stmt1 = $conn->prepare('UPDATE store SET items=:newItemsValue WHERE receipt_id=:receipt_id');
                    $stmt1->bindParam(':newItemsValue', $newItemsValue, PDO::PARAM_INT);
                    $stmt1->bindParam(':receipt_id', $receipt_id, PDO::PARAM_INT);

                    $stmt2 = $conn->prepare('UPDATE storage 
        SET items = CASE
            WHEN items_set IN (SELECT items_set FROM store WHERE receipt_id=:receipt_id) THEN items - :itemsSetValue
            ELSE items
        END');
                    $stmt2->bindParam(':itemsSetValue', $itemsSetValue, PDO::PARAM_INT);
                    $stmt2->bindParam(':receipt_id', $receipt_id, PDO::PARAM_INT);

                    if ($stmt1->execute() && $stmt2->execute()) {
                        $conn->commit(); // Commit the transaction

                        // Check the count of items for each items_set in storage
                        $stmt3 = $conn->prepare('SELECT items_set, MAX(items) AS max_items FROM storage GROUP BY items_set');
                        $stmt3->execute();
                        $itemsSets = $stmt3->fetchAll(PDO::FETCH_ASSOC);

                        // Send notifications for items_sets with max items less than or equal to 20
                        foreach ($itemsSets as $itemsSet) {
                            if ($itemsSet['max_items'] <= 20) {
                                // Calculate remaining item count
                                $remainingItemCount = 20 - $itemsSet['max_items'];

                                // Fetch the item count from the database for the current items_set
                                $stmt4 = $conn->prepare('SELECT items FROM storage WHERE items_set = :items_set');
                                $stmt4->bindParam(':items_set', $itemsSet['items_set'], PDO::PARAM_STR);
                                $stmt4->execute();
                                $itemData = $stmt4->fetch(PDO::FETCH_ASSOC);
                                $itemCount = $itemData['items'];

                                // Send a notification for this items_set with the correct item count
                                $sToken = ["6GxKHxqMlBcaPv1ufWmDiJNDucPJSWPQ42sJwPOsQQL"];
                                $sMessage = "จำนวนของที่ระลึง Set " . $itemsSet['items_set'] . " ใกล้จะหมดแล้ว";
                                $sMessage .= "\n";
                                $sMessage .= " จำนวนที่เหลือคือ " . $itemCount . " ชิ้น";

                                foreach ($sToken as $Token) {
                                    notify_message($sMessage, $Token);
                                }
                            }
                        }

                        echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script>
    swal({
        title: "อัพเดตข้อมูลการจัดส่งของที่ระลึกสำเร็จ",
        text: "กรุณารอสักครู่",
        type: "success",
        timer: 1000,
        showConfirmButton: false
    }, function() {
        window.location.href = "showdata.php";
    });
</script>';
                    } else {
                        $conn->rollBack(); // Roll back the transaction
                        echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<script>
    swal({
        title: "อัพเดตข้อมูลการจัดส่งของที่ระลึกไม่สำเร็จ",
        text: "กรุณาลองอีกครั้ง",
        type: "error",
        timer: 3000,
        showConfirmButton: false
    }, function() {
        window.location.href = "showdata.php";
    });
</script>';
                    }

                    $conn = null;
                }

                function notify_message($sMessage, $Token)
                {
                    $chOne = curl_init();
                    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($chOne, CURLOPT_POST, 1);
                    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
                    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $Token . '',);
                    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($chOne);
                    if (curl_error($chOne)) {
                        echo 'error:' . curl_error($chOne);
                    }
                    curl_close($chOne);
                }
                ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../finance/assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="../finance/assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="../finance/assets/js/init/fullcalendar-init.js"></script>
</body>

</html>