<?php
include 'connection.php';
$action = $_POST['action'];

if ($action == 'get_district') {
    $sql = "SELECT * FROM th_district WHERE province_id = '" . $_POST['province_id'] . "' ORDER BY CONVERT(name_th USING tis620) ASC";
    $query = $conn->query($sql);
    $district_data = "<option value=''>เลือกอำเภอ</option>";

    while ($district = $query->fetch(PDO::FETCH_ASSOC)) {
        $district_data .= "<option value='" . $district['district_id'] . "'>" . $district['name_th'] . "</option>";
    }

    echo json_encode($district_data);
    exit();
}

if ($action == 'get_subdistrict') {
    $sql = "SELECT * FROM th_subdistrict WHERE district_id = '" . $_POST['district_id'] . "' ORDER BY CONVERT(name_th USING tis620) ASC";
    $query = $conn->query($sql);
    $subdistrict_data = "<option value=''>เลือกตำบล</option>";

    while ($subdistrict = $query->fetch(PDO::FETCH_ASSOC)) {
        $subdistrict_data .= "<option value='" . $subdistrict['subdistrict_id'] . "'>" . $subdistrict['name_th'] . "</option>";
    }

    echo json_encode($subdistrict_data);
    exit();
}

if ($action == 'get_zipcode') {
    $sql = "SELECT * FROM th_subdistrict WHERE subdistrict_id = '" . $_POST['subdistrict_id'] . "'";
    $query = $conn->query($sql);
    $subdistrict = $query->fetch(PDO::FETCH_ASSOC);
    $zipcode_data = $subdistrict['zipcode'];
    echo json_encode($zipcode_data);
    exit();
}
