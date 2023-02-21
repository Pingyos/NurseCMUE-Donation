<?php

  if (isset($_POST['name_Title']) 
  && isset($_POST['rec_fullname'])  
  && isset($_POST['rec_tel']) 
  && isset($_POST['rec_email'])  
  && isset($_POST['rec_idname'])
  && isset($_POST['address'])
  
  ) {

  //ไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';
      //sql insert
      $stmt = $conn->prepare("INSERT INTO receipt
      (name_Title,rec_fullname,rec_tel, rec_email, rec_idname, address)
      VALUES
      (:name_Title,:rec_fullname,:rec_tel, :rec_email, :rec_idname, :address)");
      //bindParam data type
      $stmt->bindParam(':name_Title', $_POST['name_Title'], PDO::PARAM_STR);
      $stmt->bindParam(':rec_fullname', $_POST['rec_fullname'], PDO::PARAM_STR);
      $stmt->bindParam(':rec_tel', $_POST['rec_tel'], PDO::PARAM_STR);
      $stmt->bindParam(':rec_email', $_POST['rec_email'], PDO::PARAM_STR);
      $stmt->bindParam(':rec_idname', $_POST['rec_idname'], PDO::PARAM_STR);
      $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
      $result = $stmt->execute();
      $conn = null; //close connect db
  //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
  if($result){
  echo '<script>
      swal({
          title: "บันทึกข้อมูลสำเร็จ", 
          text: "กำลังไปหน้าชำระเงิน",
          type: "success", //success, warning, danger
          timer: 2000, //ระยะเวลา redirect 3000 = 3 วิ เพิ่มลดได้
          showConfirmButton: false //ปิดการแสดงปุ่มคอนเฟิร์ม ถ้าแก้เป็น true จะแสดงปุ่ม ok ให้คลิกเหมือนเดิม
        }, function(){
          window.location.href = "qrpay_no_receipt.php"; //หน้าเพจที่เราต้องการให้ redirect ไป  
          });
    </script>';
  }else{
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


  ?>
