<?php

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();

if (
  isset($_POST['name_Title'])
  && isset($_POST['name_Title_other'])
  && isset($_POST['rec_fullname'])
  && isset($_POST['rec_tel'])
  && isset($_POST['rec_email'])
  && isset($_POST['rec_idname'])
  && isset($_POST['address'])
  && isset($_POST['rec_money'])
  && isset($_POST['road'])
  && isset($_POST['provinces'])
  && isset($_POST['amphures'])
  && isset($_POST['districts'])
  && isset($_POST['zip_code'])
  && isset($_POST['edo_name'])
  && isset($_POST['edo_tex'])
  && isset($_POST['rec_status'])

) {

  //ไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';
  //sql insert
  $stmt = $conn->prepare("INSERT INTO receipt
      (name_Title,rec_fullname,rec_tel, rec_email, rec_idname, address, name_Title_other, rec_money, road, provinces, amphures, districts, zip_code, edo_name, edo_tex, rec_status)
      VALUES
      (:name_Title,:rec_fullname,:rec_tel, :rec_email, :rec_idname, :address, :name_Title_other, :rec_money, :road, :provinces, :amphures, :districts, :zip_code, :edo_name, :edo_tex,:rec_status )");
  //bindParam data type
  $stmt->bindParam(':name_Title', $_POST['name_Title'], PDO::PARAM_STR);
  $stmt->bindParam(':name_Title_other', $_POST['name_Title_other'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_fullname', $_POST['rec_fullname'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_tel', $_POST['rec_tel'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_email', $_POST['rec_email'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_idname', $_POST['rec_idname'], PDO::PARAM_STR);
  $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_money', $_POST['rec_money'], PDO::PARAM_STR);
  $stmt->bindParam(':road', $_POST['road'], PDO::PARAM_STR);
  $stmt->bindParam(':provinces', $_POST['provinces'], PDO::PARAM_STR);
  $stmt->bindParam(':amphures', $_POST['amphures'], PDO::PARAM_STR);
  $stmt->bindParam(':districts', $_POST['districts'], PDO::PARAM_STR);
  $stmt->bindParam(':zip_code', $_POST['zip_code'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_tex', $_POST['edo_tex'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_status', $_POST['rec_status'], PDO::PARAM_STR);
  $result = $stmt->execute();
  $conn = null; //close connect db
  //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
  if ($result) {
    echo '<script>
      swal({
          title: "บันทึกข้อมูลบริจาคสำเร็จ", 
          text: "ระบบจะทำการ Generator cq code เพื่อให้ท่านได้ชำระเงิน กรุณารอสักครู่",
          type: "success", //success, warning, danger
          timer: 3000, //ระยะเวลา redirect 3000 = 3 วิ เพิ่มลดได้
          showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function(){
          window.location.href = "qrgenerator_receipt.php"; //หน้าเพจที่เราต้องการให้ redirect ไป  
          });
    </script>';
  } else {
    echo '<script>
    setTimeout(function() {
      swal({
      title: "เกิดข้อผิดพลาด",
      type: "error"
      }, function() {
      window.location = "donate_no_receipt.php"; //หน้าที่ต้องการให้กระโดดไป
      });
    }, 1000);
  </script>';
  } //else ของ if result

} //isset
