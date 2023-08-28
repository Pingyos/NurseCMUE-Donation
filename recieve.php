<?php
require_once 'connection.php';

$json = file_get_contents('php://input');
$data = json_decode($json);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    echo "Invalid JSON data.";
    exit;
}

try {
    $statement = $conn->prepare("INSERT INTO json_cf (json_data) VALUES (:json_data)");
    $jsonData = json_encode($data);
    $statement->bindParam(':json_data', $jsonData, PDO::PARAM_STR);
    $statement->execute();
    echo "Data successfully saved.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
