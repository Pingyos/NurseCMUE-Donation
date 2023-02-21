<?php
include_once ('../inc/connect.php');
$sql = "SELECT
t1.`code`,
t1.name_th
FROM
province AS t1
ORDER BY CONVERT (t1.name_th USING tis620) ASC";
$result = mysqli_query($connect, $sql);
$cnt = 0;
foreach ($result as $index => $value) :
    $arr[$cnt]['code'] = $value['code'];
    $arr[$cnt]['name'] = $value['name_th'];
    $cnt++;
endforeach;
echo json_encode($arr);
?>