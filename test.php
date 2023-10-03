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
  && isset($_POST['status_receipt'])
  && isset($_POST['other_description'])
  && isset($_POST['resDesc'])
  && isset($_POST['pdflink'])
) {
  // เชื่อมต่อฐานข้อมูล
  require_once 'connection.php';

  // SQL INSERT ข้อมูลลงในตาราง receipt_offline
  $stmtReceiptOffline = $conn->prepare("INSERT INTO receipt_offline (
    name_title,
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
    other_description,
    status_receipt,
    resDesc,
    pdflink,
    comment
  ) VALUES (
    :name_title,
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
    :other_description,
    :status_receipt,
    :resDesc,
    :pdflink,
    :comment
  )");

  // Bind parameters for receipt_offline
  $stmtReceiptOffline->bindParam(':name_title', $_POST['name_title'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_name', $_POST['rec_name'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_surname', $_POST['rec_surname'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_tel', $_POST['rec_tel'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_email', $_POST['rec_email'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_idname', $_POST['rec_idname'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':road', $_POST['road'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':provinces', $_POST['provinces'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':amphures', $_POST['amphures'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':districts', $_POST['districts'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':zip_code', $_POST['zip_code'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_date_s', $_POST['rec_date_s'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':rec_date_out', $_POST['rec_date_out'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':amount', $_POST['amount'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':payby', $_POST['payby'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':edo_description', $_POST['edo_description'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':edo_objective', $_POST['edo_objective'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':status_donat', $_POST['status_donat'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':status_user', $_POST['status_user'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':other_description', $_POST['other_description'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':status_receipt', $_POST['status_receipt'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':resDesc', $_POST['resDesc'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':pdflink', $_POST['pdflink'], PDO::PARAM_STR);
  $stmtReceiptOffline->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);

  // Execute the SQL statement for receipt_offline
  $resultReceiptOffline = $stmtReceiptOffline->execute();

  if ($resultReceiptOffline) {
    // หา ID ล่าสุดที่เพิ่งเพิ่มลงใน receipt_offline
    $lastInsertedId = $conn->lastInsertId();

    // ประกาศตัวแปรสำหรับสร้าง ID ของ receipt
    $id_year = date('Y') + 543;
    $id_suffix = $_POST['edo_pro_id'] . 'E' . str_pad($lastInsertedId, 4, '0', STR_PAD_LEFT);

    // URL สำหรับ PDF โดยใช้ ID ล่าสุด
    $pdf_url = "https://app.nurse.cmu.ac.th/edonation/edo_admin/pdf_maker_offline.php?id=$lastInsertedId&ACTION=VIEW";

    // SQL UPDATE ในตาราง receipt_offline เพื่ออัปเดต ID และ URL ของ PDF
    $updateSql = "UPDATE receipt_offline SET id_receipt = '{$id_year}{$id_suffix}', pdflink = :pdf_url WHERE id = :lastInsertedId";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':lastInsertedId', $lastInsertedId, PDO::PARAM_INT);
    $updateStmt->bindParam(':pdf_url', $pdf_url, PDO::PARAM_STR);
    $updateStmt->execute();

    // ดำเนินการเพิ่มข้อมูลในตาราง receipt ด้วยข้อมูลจาก receipt_offline
    $insertSql = "INSERT INTO receipt (id, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate)
      SELECT id, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate
      FROM receipt_offline WHERE id = :lastInsertedId";

    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bindParam(':lastInsertedId', $lastInsertedId, PDO::PARAM_INT);
    $insertResult = $insertStmt->execute();

    if ($insertResult) {
      // บันทึกสำเร็จ
      echo '<script>
        alert("บันทึกข้อมูลสำเร็จ");
        window.location.href = "showdata_offline.php";
      </script>';
    } else {
      // ไม่สามารถบันทึกในตาราง receipt ได้
      echo '<script>
        alert("ไม่สามารถบันทึกข้อมูลในตาราง receipt ได้");
        window.location.href = "donate_no_receipt.php";
      </script>';
    }
  } else {
    // ไม่สามารถบันทึกในตาราง receipt_offline ได้
    echo '<script>
      alert("ไม่สามารถบันทึกข้อมูลในตาราง receipt_offline ได้");
      window.location.href = "donate_no_receipt.php";
    </script>';
  }
}
?>
