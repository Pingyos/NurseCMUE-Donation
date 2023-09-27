<?php
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
    && isset($_FILES['img_file']) // เพิ่มตรวจสอบการอัปโหลดไฟล์
    && isset($_FILES['img_banner'])

) {
    // ตรวจสอบความถูกต้องของข้อมูลอื่นๆ ตามต้องการ

    // เพิ่มการตรวจสอบไฟล์รูปภาพและบันทึกไฟล์
    $img_file = $_FILES['img_file'];
    $img_banner = $_FILES['img_banner'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
    if ($img_file['error'] === UPLOAD_ERR_OK && $img_banner['error'] === UPLOAD_ERR_OK) {
        // ตรวจสอบประเภทของไฟล์ (รูปภาพเท่านั้น)
        $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($img_file['type'], $allowed_image_types) && in_array($img_banner['type'], $allowed_image_types)) {
            // กำหนดตำแหน่งเก็บไฟล์รูปภาพ
            $img_file_path = '../images/causes/' . $img_file['name'];
            $img_banner_path = '../images/causes/' . $img_banner['name'];


            // บันทึกไฟล์รูปภาพไปยังเครื่องแม่ข่าย
            if (move_uploaded_file($img_file['tmp_name'], $img_file_path) && move_uploaded_file($img_banner['tmp_name'], $img_banner_path)) {
                // กำหนดค่าใหม่ให้กับตัวแปร
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

                // ตรวจสอบความถูกต้องของค่าอื่น ๆ และอัปเดตในฐานข้อมูล
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
                    img_file = :img_file,
                    img_banner = :img_banner,
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
                $stmt->bindParam(':img_file', $img_file_path, PDO::PARAM_STR); // ใช้ตำแหน่งไฟล์ที่บันทึกไว้
                $stmt->bindParam(':img_banner', $img_banner_path, PDO::PARAM_STR);
                $stmt->bindParam(':dateCreate', $dateCreate, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                $result = $stmt->execute();

                if ($result) {
                    // แจ้งเตือนเฉพาะกรณีอัปโหลดข้อมูลสำเร็จ
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
                            window.location = "pro_edo.php.php";
                        });
                    </script>';
                    exit();
                } else {
                    // แจ้งเตือนเมื่ออัปเดตข้อมูลผิดพลาดและแนบข้อความในการอัปโหลดรูปภาพ
                    echo '
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
                    <script>
                        swal({
                            title: "เกิดข้อผิดพลาดในการอัปเดตข้อมูล",
                            text: "ไม่สามารถอัปเดตข้อมูลได้ โปรดแนบรูปภาพที่ถูกต้อง",
                            type: "error"
                        }, function() {
                            window.location = "pro_edo.php.php";
                        });
                    </script>';
                }
            } else {
                // แจ้งเตือนเมื่อเกิดข้อผิดพลาดในการอัปโหลดรูปภาพ
                echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
                <script>
                    swal({
                        title: "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ",
                        text: "โปรดแนบรูปภาพที่ถูกต้อง",
                        type: "error"
                    });
                </script>';
            }
        } else {
            // แจ้งเตือนเมื่อประเภทของไฟล์ไม่ถูกต้อง
            echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
            <script>
                swal({
                    title: "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ",
                    text: "โปรดแนบรูปภาพในรูปแบบ JPEG, PNG หรือ GIF เท่านั้น",
                    type: "error"
                });
            </script>';
        }
    } else {
        // แจ้งเตือนเมื่อเกิดข้อผิดพลาดในการอัปโหลดไฟล์
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
        <script>
            swal({
                title: "เกิดข้อผิดพลาดในการอัปโหลดไฟล์",
                text: "โปรดตรวจสอบไฟล์และลองใหม่อีกครั้ง",
                type: "error"
            });
        </script>';
    }
}
