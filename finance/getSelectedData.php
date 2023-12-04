<?php
include 'connection.php';

if (isset($_POST['selectedOption'])) {
    $selectedOption = $_POST['selectedOption'];

    // Perform a database query to retrieve the data based on the selected option
    $sql = "SELECT * FROM receipt WHERE 
            name_title = :selectedOption OR
            rec_name = :selectedOption OR
            rec_surname = :selectedOption OR
            rec_tel = :selectedOption OR
            rec_email = :selectedOption OR
            rec_idname = :selectedOption OR
            address = :selectedOption OR
            road = :selectedOption OR
            districts = :selectedOption OR
            amphures = :selectedOption OR
            provinces = :selectedOption OR
            zip_code = :selectedOption";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':selectedOption', $selectedOption);
    $stmt->execute();

    // Fetch the data
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Send the data as JSON
    echo json_encode($data);
}
