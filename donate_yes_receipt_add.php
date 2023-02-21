<?php

if (
  isset($_POST['name_Title'])
  && isset($_POST['fullname'])
  && isset($_POST['idname'])
  && isset($_POST['tel'])
  && isset($_POST['email'])
  && isset($_POST['addhome'])
  && isset($_POST['road'])
  && isset($_POST['provinces'])
  && isset($_POST['amphures'])
  && isset($_POST['districts'])
  && isset($_POST['zip_code'])
  && isset($_POST['money'])
) {

  //ไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';
  //sql insert
  $stmt = $conn->prepare("INSERT INTO inputdonat_receipt
      (name_Title,fullname,idname,tel, email, addhome, road, provinces, amphures, districts, zip_code, money)
      VALUES
      (:name_Title,:fullname, :idname, :tel, :email, :addhome, :road, :provinces, :amphures, :districts, :zip_code, :money)");
  //bindParam data type
  $stmt->bindParam(':name_Title', $_POST['name_Title'], PDO::PARAM_STR);
  $stmt->bindParam(':fullname', $_POST['fullname'], PDO::PARAM_STR);
  $stmt->bindParam(':idname', $_POST['idname'], PDO::PARAM_STR);
  $stmt->bindParam(':tel', $_POST['tel'], PDO::PARAM_STR);
  $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  $stmt->bindParam(':addhome', $_POST['addhome'], PDO::PARAM_STR);
  $stmt->bindParam(':road', $_POST['road'], PDO::PARAM_STR);
  $stmt->bindParam(':provinces', $_POST['provinces'], PDO::PARAM_STR);
  $stmt->bindParam(':amphures', $_POST['amphures'], PDO::PARAM_STR);
  $stmt->bindParam(':districts', $_POST['districts'], PDO::PARAM_STR);
  $stmt->bindParam(':zip_code', $_POST['zip_code'], PDO::PARAM_STR);
  $stmt->bindParam(':money', $_POST['money'], PDO::PARAM_STR);
  $result = $stmt->execute();
  $conn = null; //close connect db
  //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
  if ($result) {
    echo '<script>
      swal({
          title: "บันทึกข้อมูลสำเร็จ", 
          text: "กำลังไปหน้าชำระเงิน",
          type: "success", //success, warning, danger
          timer: 2000, //ระยะเวลา redirect 3000 = 3 วิ เพิ่มลดได้
          showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function(){
          window.location.href = "qrpay_yes_receipt.php"; //หน้าเพจที่เราต้องการให้ redirect ไป  
          });
    </script>';
  } else {
    echo '<script>
    setTimeout(function() {
      swal({
      title: "เกิดข้อผิดพลาด",
      type: "error"
      }, function() {
      window.location = "donate_yes_receipt.php"; //หน้าที่ต้องการให้กระโดดไป
      });
    }, 1000);
  </script>';
  } //else ของ if result

} //isset
