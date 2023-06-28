<?php 
$json = file_get_contents('php://input');
$data = json_decode($json);
$jsonData = json_encode($data);
echo $jsonData;
