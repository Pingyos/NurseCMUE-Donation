<?php 
if(isset($_GET['id'])){
require_once 'connection.php';
//ประกาศตัวแปรรับค่าจาก param method get
$id = $_GET['id'];
$stmt = $conn->prepare('DELETE FROM receipt_offline WHERE id=:id');
$stmt->bindParam(':id', $id , PDO::PARAM_INT);
$stmt->execute();

//  sweet alert 
echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

  if($stmt->rowCount() ==1){
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "showdata_offline.php";
              });
            }, 200);
        </script>';
    }else{
       echo '<script>
             setTimeout(function() {
              swal({
                  title: "Del Data Error",
                  type: "error"
              }, function() {
                  window.location = "showdata_offline.php";
              });
            }, 200);
        </script>';
    }
$conn = null;
} //isset
?>