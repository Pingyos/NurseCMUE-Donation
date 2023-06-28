<?php
// ไฟล์เชื่อมต่อฐานข้อมูล
require_once 'connection.php';

if (
  isset($_POST['name_title'])
  && isset($_POST['rec_name'])
  && isset($_POST['rec_surname'])
  && isset($_POST['rec_tel'])
  && isset($_POST['rec_email'])
  && isset($_POST['rec_idname'])
  && isset($_POST['address'])
  && isset($_POST['road'])
  && isset($_POST['provinces'])
  && isset($_POST['amphures'])
  && isset($_POST['districts'])
  && isset($_POST['zip_code'])
  && isset($_POST['rec_money'])
  && isset($_POST['edo_name'])
  && isset($_POST['edo_pro_id'])
  && isset($_POST['edo_description'])
  && isset($_POST['edo_objective'])
  && isset($_POST['status_donat'])
  && isset($_POST['status_user'])
  && isset($_POST['rec_date_out'])
) {
  // SQL INSERT statement
  $stmt = $conn->prepare("INSERT INTO receipt_offline
    (name_title,
    rec_name,
    rec_surname,
    rec_tel,
    rec_email,
    rec_idname,
    address,
    road,
    provinces,
    amphures,
    districts,
    zip_code,
    edo_name,
    rec_money,
    edo_pro_id,
    edo_description,
    edo_objective,
    status_donat,
    rec_date_out,
    status_user)
    VALUES
    (:name_title,
    :rec_name,
    :rec_surname,
    :rec_tel,
    :rec_email,
    :rec_idname,
    :address,
    :road,
    :provinces,
    :amphures,
    :districts,
    :zip_code,
    :edo_name,
    :rec_money,
    :edo_pro_id,
    :edo_description,
    :edo_objective,
    :status_donat,
    :rec_date_out,
    :status_user)");

  // Bind parameter values
  $stmt->bindParam(':name_title', $_POST['name_title'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_name', $_POST['rec_name'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_surname', $_POST['rec_surname'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_tel', $_POST['rec_tel'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_email', $_POST['rec_email'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_idname', $_POST['rec_idname'], PDO::PARAM_STR);
  $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
  $stmt->bindParam(':road', $_POST['road'], PDO::PARAM_STR);
  $stmt->bindParam(':provinces', $_POST['provinces'], PDO::PARAM_STR);
  $stmt->bindParam(':amphures', $_POST['amphures'], PDO::PARAM_STR);
  $stmt->bindParam(':districts', $_POST['districts'], PDO::PARAM_STR);
  $stmt->bindParam(':zip_code', $_POST['zip_code'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_money', $_POST['rec_money'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_description', $_POST['edo_description'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_objective', $_POST['edo_objective'], PDO::PARAM_STR);
  $stmt->bindParam(':status_donat', $_POST['status_donat'], PDO::PARAM_STR);
  $stmt->bindParam(':status_user', $_POST['status_user'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_date_out', $_POST['rec_date_out'], PDO::PARAM_STR);

  // Execute the query
  $result = $stmt->execute();

  // Check if data insertion was successful
  if ($result) {
    $id = $conn->lastInsertId();
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
      swal({
        title: "บันทึกข้อมูลบริจาคสำเร็จ",
        text: "กรุณารอสักครู่",
        type: "success",
        timer: 2000,
        showConfirmButton: false
      }, function(){
        window.location.href = "qrgenerator_receipt.php?id=' . $id . '";
      });
    </script>';
  } else {
    // Error message
    echo '
    <script>
      swal({
        title: "เกิดข้อผิดพลาด",
        type: "error"
      }, function() {
        window.location = "index.php";
      });
    </script>';
  }
}
