<?php
if (
  isset($_POST['name_title']) &&
  isset($_POST['rec_name']) &&
  isset($_POST['rec_surname']) &&
  isset($_POST['rec_tel']) &&
  isset($_POST['rec_email']) &&
  isset($_POST['rec_idname']) &&
  isset($_POST['address']) &&
  isset($_POST['road']) &&
  isset($_POST['provinces']) &&
  isset($_POST['amphures']) &&
  isset($_POST['districts']) &&
  isset($_POST['zip_code']) &&
  isset($_POST['rec_date_s']) &&
  isset($_POST['rec_date_out']) &&
  isset($_POST['amount']) &&
  isset($_POST['payby']) &&
  isset($_POST['edo_name']) &&
  isset($_POST['edo_pro_id']) &&
  isset($_POST['edo_description']) &&
  isset($_POST['edo_objective']) &&
  isset($_POST['comment']) &&
  isset($_POST['status_donat']) &&
  isset($_POST['status_user']) &&
  isset($_POST['status_receipt']) &&
  isset($_POST['other_description']) &&
  isset($_POST['resDesc']) &&
  isset($_POST['pdflink']) &&
  isset($_POST['id_receipt']) &&
  isset($_POST['receipt_cc']) &&
  isset($_POST['ref1'])
) {
  require_once 'connection.php';
  try {
    $conn->beginTransaction();

    // เพิ่มข้อมูลลงในตาราง receipt_offline
    $stmt = $conn->prepare("INSERT INTO receipt_offline
      (name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, provinces, amphures, districts, zip_code, rec_date_s, rec_date_out, edo_name, amount, payby, edo_pro_id, edo_description, edo_objective, status_donat, status_user, other_description, status_receipt, resDesc, pdflink, ref1, id_receipt, receipt_cc, comment)
      VALUES
      (:name_title, :rec_name, :rec_surname, :rec_tel, :rec_email, :rec_idname, :address, :road, :provinces, :amphures, :districts, :zip_code, :rec_date_s, :rec_date_out, :edo_name, :amount, :payby, :edo_pro_id, :edo_description, :edo_objective, :status_donat, :status_user, :other_description, :status_receipt, :resDesc, :pdflink, :ref1, :id_receipt, :receipt_cc, :comment)");

    // ผูกค่าตัวแปรกับพารามิเตอร์ของ PDO
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
    $stmt->bindParam(':other_description', $_POST['other_description'], PDO::PARAM_STR);
    $stmt->bindParam(':status_receipt', $_POST['status_receipt'], PDO::PARAM_STR);
    $stmt->bindParam(':resDesc', $_POST['resDesc'], PDO::PARAM_STR);
    $stmt->bindParam(':pdflink', $_POST['pdflink'], PDO::PARAM_STR);
    $stmt->bindParam(':ref1', $_POST['ref1'], PDO::PARAM_STR);
    $stmt->bindParam(':id_receipt', $_POST['id_receipt'], PDO::PARAM_STR);
    $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
    $stmt->bindParam(':receipt_cc', $_POST['receipt_cc'], PDO::PARAM_STR);

    $result = $stmt->execute();

    if ($result) {
      // อัปเดตคอลัมน์ ref1 ในตาราง receipt_offline
      $id = $conn->lastInsertId();
      $id_year = date('Y') + 543;
      $last_two_digits = substr($id_year, -2);
      $id_suffix = $_POST['edo_pro_id'] . str_pad($id, 7, '0', STR_PAD_LEFT);
      $updateSql = "UPDATE receipt_offline SET ref1 = '{$last_two_digits}{$id_suffix}' WHERE id = :id";
      $updateStmt = $conn->prepare($updateSql);
      $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);
      $updateResult = $updateStmt->execute();

      // เพิ่มข้อมูลลงในตาราง receipt
      if ($updateResult) {
        $moveDataSql = "INSERT INTO receipt (id, ref1, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, receipt_cc, dateCreate)
          SELECT id, ref1, :id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, :edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, receipt_cc, dateCreate
          FROM receipt_offline
          WHERE id = :id";

        $moveDataStmt = $conn->prepare($moveDataSql);
        $moveDataStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $moveDataStmt->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
        $moveDataStmt->bindParam(':id_receipt', $receipt, PDO::PARAM_STR);
        $moveDataResult = $moveDataStmt->execute();

        if ($moveDataResult) {

          $receipt_id = $conn->lastInsertId();
          $year = "2567";
          $suffix = $_POST['edo_pro_id'] . '-E' . str_pad($receipt_id, 4, '0', STR_PAD_LEFT);
          $receipt = $year . '-' . $suffix;
          $pdf_url = "https://app.nurse.cmu.ac.th/edonation/edo_admin/pdf_maker_offline.php?receipt_id={$receipt_id}&ACTION=VIEW";

          $updateReceiptSql = "UPDATE receipt SET id_receipt = :receipt, pdflink = :pdf_url WHERE id = :id";
          $updateReceiptStmt = $conn->prepare($updateReceiptSql);
          $updateReceiptStmt->bindParam(':id', $id, PDO::PARAM_INT);
          $updateReceiptStmt->bindParam(':receipt', $receipt, PDO::PARAM_STR);
          $updateReceiptStmt->bindParam(':pdf_url', $pdf_url, PDO::PARAM_STR);
          $updateReceiptResult = $updateReceiptStmt->execute();

          if ($updateReceiptResult) {
            $conn->commit();
            echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
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
          } else {
            $conn->rollback();
            echo '<script>
                swal({
                    title: "เกิดข้อผิดพลาดในการอัปเดตค่า id_receipt",
                    type: "error"
                }, function() {
                    window.location = "donate_no_receipt.php";
                });
            </script>';
          }
        } else {
          $conn->rollback();
          echo '<script>
                  swal({
                      title: "เกิดข้อผิดพลาดในการบันทึกข้อมูลในตาราง receipt_offline",
                      type: "error"
                  }, function() {
                      window.location = "donate_no_receipt.php";
                  });
              </script>';
        }
      } else {
        $conn->rollback();
        echo '<script>
                swal({
                    title: "เกิดข้อผิดพลาดในการอัปเดตค่า ref1",
                    type: "error"
                }, function() {
                    window.location = "donate_no_receipt.php";
                });
            </script>';
      }
    } else {
      $conn->rollback();
      echo '<script>
                swal({
                    title: "เกิดข้อผิดพลาดในการบันทึกข้อมูลในตาราง receipt_offline",
                    type: "error"
                }, function() {
                    window.location = "donate_no_receipt.php";
                });
            </script>';
    }
  } catch (PDOException $e) {
    $conn->rollback();
    echo '<script>
            swal({
                title: "เกิดข้อผิดพลาดในการทำงาน",
                type: "error"
            }, function() {
                window.location = "donate_no_receipt.php";
            });
        </script>';
    echo "Error: " . $e->getMessage();
  }
}
