<?php
if (
  isset($_POST['rec_money'])
  && isset($_POST['edo_name'])
  && isset($_POST['edo_tex'])
  && isset($_POST['edo_pro_id'])
  && isset($_POST['rec_out'])
  && isset($_POST['rec_out_oj'])
  && isset($_POST['name_Title'])
  && isset($_POST['name_Title_other'])
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
  && isset($_POST['date_s'])
  && isset($_POST['by'])
) {

  //ไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';
  //sql insert
  $stmt = $conn->prepare("INSERT INTO receipt
      (rec_money,
      edo_name,
      edo_tex,
      edo_pro_id,
      rec_out,
      rec_out_oj,
      name_Title,
      name_Title_other,
      rec_fullname,
      rec_tel,
      rec_email,
      rec_idname,
      address,
      road,
      provinces,
      amphures,
      districts,
      zip_code),
      by,
      date_s
      VALUES
      (:rec_money,
      :edo_name,
      :edo_tex,
      :edo_pro_id,
      :rec_out,
      :rec_out_oj,
      :name_Title,
      :name_Title_other,
      :rec_fullname,
      :rec_tel,
      :rec_email,
      :rec_idname,
      :address,
      :road,
      :provinces,
      :amphures,
      :districts,
      :date_s,
      :by,
      :zip_code)");
  //bindParam data type
  $stmt->bindParam(':rec_money', $_POST['rec_money'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_tex', $_POST['edo_tex'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_out', $_POST['rec_out'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_out_oj', $_POST['rec_out_oj'], PDO::PARAM_STR);
  $stmt->bindParam(':name_Title', $_POST['name_Title'], PDO::PARAM_STR);
  $stmt->bindParam(':name_Title_other', $_POST['name_Title_other'], PDO::PARAM_STR);
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
  $stmt->bindParam(':date_s', $_POST['date_s'], PDO::PARAM_STR);
  $stmt->bindParam(':by', $_POST['by'], PDO::PARAM_STR);
  $result = $stmt->execute();
  //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
  if ($result) {
    echo '<script>
      swal({
          title: "บันทึกข้อมูลบริจาคสำเร็จ", 
          text: "ระบบจะทำการ Generator cq code เพื่อให้ท่านได้ชำระเงิน กรุณารอสักครู่",
          type: "success", 
          timer: 3000, 
          showConfirmButton: false 
        }, function(){
          window.location.href = "qrgenerator_receipt.php?id=' . $id . '"; 
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
  //else ของ if result

} //isset
