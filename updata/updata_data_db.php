<?php
require_once 'connection.php';

if (
    isset($_POST['edo_tex'])
    && isset($_POST['edo_pro_id'])
    && isset($_POST['edo_name'])
    && isset($_POST['edo_description'])
    && isset($_POST['edo_objective'])
    && isset($_POST['edo_details_objective1'])
    && isset($_POST['edo_details_objective2'])
    && isset($_POST['edo_details_objective3'])
    && isset($_POST['edo_details_objective4'])
    && isset($_POST['edo_details'])
    && isset($_POST['dateCreate'])
) {
    $edo_tex = $_POST['edo_tex'];
    $edo_pro_id = $_POST['edo_pro_id'];
    $edo_name = $_POST['edo_name'];
    $edo_description = $_POST['edo_description'];
    $edo_objective = $_POST['edo_objective'];
    $edo_details_objective1 = $_POST['edo_details_objective1'];
    $edo_details_objective2 = $_POST['edo_details_objective2'];
    $edo_details_objective3 = $_POST['edo_details_objective3'];
    $edo_details_objective4 = $_POST['edo_details_objective4'];
    $edo_details = $_POST['edo_details'];
    $dateCreate = $_POST['dateCreate'];
    $id = $_POST['id'];

    $stmt = $conn->prepare(
        "UPDATE pro_offline SET
        edo_tex = :edo_tex,
        edo_pro_id = :edo_pro_id,
        edo_name = :edo_name,
        edo_description = :edo_description,
        edo_objective = :edo_objective,
        edo_details_objective1 = :edo_details_objective1,
        edo_details_objective2 = :edo_details_objective2,
        edo_details_objective3 = :edo_details_objective3,
        edo_details_objective4 = :edo_details_objective4,
        edo_details = :edo_details,
        dateCreate = :dateCreate
        WHERE id = :id"
    );

    $stmt->bindParam(':edo_tex', $edo_tex, PDO::PARAM_STR);
    $stmt->bindParam(':edo_pro_id', $edo_pro_id, PDO::PARAM_STR);
    $stmt->bindParam(':edo_name', $edo_name, PDO::PARAM_STR);
    $stmt->bindParam(':edo_description', $edo_description, PDO::PARAM_STR);
    $stmt->bindParam(':edo_objective', $edo_objective, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective1', $edo_details_objective1, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective2', $edo_details_objective2, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective3', $edo_details_objective3, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective4', $edo_details_objective4, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details', $edo_details, PDO::PARAM_STR);
    $stmt->bindParam(':dateCreate', $dateCreate, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $result = $stmt->execute();

    if ($result) {
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
        <script>
            swal({
                title: "อัปเดตข้อมูลสำเร็จ",
                text: "",
                type: "success"
            }, function() {
                window.location = "updata_data.php";
            });
        </script>';
        exit();
    } else {
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
        <script>
            swal({
                title: "เกิดข้อผิดพลาดในการอัปเดตข้อมูล",
                text: "ไม่สามารถอัปเดตข้อมูลได้",
                type: "error"
            }, function() {
                window.location = "updata_data.php";
            });
        </script>';
    }
} else {
    echo "ข้อมูลไม่ครบถ้วน";
}
