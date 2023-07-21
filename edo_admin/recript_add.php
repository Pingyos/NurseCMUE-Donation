<?php
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
  && isset($_POST['rec_date_s'])
  && isset($_POST['rec_date_out'])
  && isset($_POST['amount'])
  && isset($_POST['payby'])
  && isset($_POST['edo_name'])
  && isset($_POST['edo_pro_id'])
  && isset($_POST['edo_description'])
  && isset($_POST['edo_objective'])
  && isset($_POST['comment'])
  && isset($_POST['status_donat'])
  && isset($_POST['status_user'])
  && isset($_POST['status'])
  && isset($_POST['notified'])
) {

  //ไฟล์เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';
  //sql insert
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
  rec_date_s,
  rec_date_out,
  edo_name,
  amount,
  payby,
  edo_pro_id,
  edo_description,
  edo_objective,
  status_donat,
  status_user,
  status,
  notified,
  comment)
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
  :rec_date_s,
  :rec_date_out,
  :edo_name,
  :amount,
  :payby,
  :edo_pro_id,
  :edo_description,
  :edo_objective,
  :status_donat,
  :status_user,
  :status,
  :notified,
  :comment)");
  //bindParam data type
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
  $stmt->bindParam(':rec_date_s', $_POST['rec_date_s'], PDO::PARAM_STR);
  $stmt->bindParam(':rec_date_out', $_POST['rec_date_out'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
  $stmt->bindParam(':amount', $_POST['amount'], PDO::PARAM_STR);
  $stmt->bindParam(':payby', $_POST['payby'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_description', $_POST['edo_description'], PDO::PARAM_STR);
  $stmt->bindParam(':edo_objective', $_POST['edo_objective'], PDO::PARAM_STR);
  $stmt->bindParam(':status_donat', $_POST['status_donat'], PDO::PARAM_STR);
  $stmt->bindParam(':status_user', $_POST['status_user'], PDO::PARAM_STR);
  $stmt->bindParam(':status', $_POST['status'], PDO::PARAM_STR);
  $stmt->bindParam(':notified', $_POST['notified'], PDO::PARAM_STR);
  $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
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
          text: "กรุณารอสักครู่",
          type: "success", 
          timer: 2000, 
          showConfirmButton: false 
        }, function(){
          window.location.href = "showdata_offline.php"; 
          });
    </script>';
    $sToken = ["6GxKHxqMlBcaPv1ufWmDiJNDucPJSWPQ42sJwPOsQQL"];
    $sMessage = "แจ้งบริจาค\r\n";
    $sMessage .= "รายการที่บริจาค: " . $row['edo_pro_id'] . "\n";
    $sMessage .= "เลขที่ใบเสร็จ: " . $row['id'] . "\n";
    $sMessage .= "ผู้โอน: " . $row['name_title'] . " " . $row['rec_name'] . " " . $row['rec_surname'] . "\n";
    $sMessage .= "เลข ปชช: " . $row['rec_idname'] . "\n";
    $sMessage .= "จาก: \n";
    $sMessage .= "จำนวน: " . $row['amount'] . " บาท\n";
    $sMessage .= "วันที่โอน: " . $row['rec_date_out'] . " " . $row['rec_time'] . "\n";
    $sMessage .= "บริจาคผ่านระบบ: " . $row['status_donat'] . "\n";

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
    foreach ($sToken as $Token) {
      notify_message($sMessage, $Token);
    }
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
