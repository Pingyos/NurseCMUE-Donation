<?php
if (
  isset($_POST['name_Title'])
  && isset($_POST['rec_fullname'])
  && isset($_POST['rec_tel'])
  && isset($_POST['rec_email'])
  && isset($_POST['rec_idname'])
  && isset($_POST['address'])
  && isset($_POST['road'])
  && isset($_POST['provinces'])
  && isset($_POST['amphures'])
  && isset($_POST['districts'])
  && isset($_POST['zip_code'])
  && isset($_POST['rec_date'])
  && isset($_POST['rec_money'])
  && isset($_POST['payby'])
  && isset($_POST['edo_name'])
  && isset($_POST['edo_pro_id'])
  && isset($_POST['edo_description'])
  && isset($_POST['edo_objective'])
) {

  //ไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';
  //sql insert
  $stmt = $conn->prepare("INSERT INTO receipt_offline
      (name_Title,
      rec_fullname,
      rec_tel,
      rec_email,
      rec_idname,
      address,
      road,
      provinces,
      amphures,
      districts,
      zip_code,
      rec_date,
      edo_name,
      rec_money,
      payby,
      edo_pro_id,
      edo_description,
      edo_objective)
      VALUES
      (:name_Title,
      :rec_fullname,
      :rec_tel,
      :rec_email,
      :rec_idname,
      :address,
      :road,
      :provinces,
      :amphures,
      :districts,
      :zip_code,
      :rec_date,
      :edo_name,
      :rec_money,
      :payby,
      :edo_pro_id,
      :edo_description,
      :edo_objective)");
  //bindParam data type
  $stmt->bindParam(':name_Title', $_POST['name_Title'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_fullname', $_POST['rec_fullname'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_tel', $_POST['rec_tel'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_email', $_POST['rec_email'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_idname', $_POST['rec_idname'], PDO::PARAM_STR);
  $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
  $stmt->bindParam(':road', $_POST['road'], PDO::PARAM_STR);
  $stmt->bindParam(':provinces', $_POST['provinces'], PDO::PARAM_STR);
  $stmt->bindParam(':amphures', $_POST['amphures'], PDO::PARAM_STR);
  $stmt->bindParam(':districts', $_POST['districts'], PDO::PARAM_STR);
  $stmt->bindParam(':zip_code', $_POST['zip_code'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_date', $_POST['rec_date'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_money', $_POST['rec_money'], PDO::PARAM_STR);
  $stmt->bindParam(':payby', $_POST['payby'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_description', $_POST['edo_description'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_objective', $_POST['edo_objective'], PDO::PARAM_STR);
  $result = $stmt->execute();
  //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
  echo '
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
  if ($result) {
    echo '<script>
      swal({
          title: "บันทึกข้อมูลบริจาคสำเร็จ", 
          text: "กรุณารอสักครู่ กำลัง Generator ใบเสร็จ",
          type: "success", 
          timer: 2000, 
          showConfirmButton: false 
        }, function(){
          window.location.href = "showdata_offline.php"; 
          });
    </script>';
  } else {
    echo '<script>
      swal({
        title: "เกิดข้อผิดพลาด",
        type: "error"
      }, function() {
        window.location = "donate_no_receipt.php";
      });
    </script>';
  }
} //isset
