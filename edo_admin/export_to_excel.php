<?php
require_once 'connection.php'; // เรียกใช้ไฟล์ connection.php

try {
    $edo_description = $_GET['edo_description'];
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];

    $query = "SELECT * FROM receipt_offline WHERE rec_date_out >= :start_date AND rec_date_out <= :end_date AND edo_description = :edo_description";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':start_date', $startDate);
    $stmt->bindParam(':end_date', $endDate);
    $stmt->bindParam(':edo_description', $edo_description);
    $stmt->execute();

    // Set CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="exported_data.csv"');

    // Open output stream for writing CSV
    $output = fopen('php://output', 'w');

    // Write headers to the CSV
    $headers = array("Column1", "Column2", "Column3", /* ... */); // Replace with actual column names
    fputcsv($output, $headers);

    // Loop through data and populate rows
    while ($row_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row_data);
    }

    // Close the output stream
    fclose($output);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
