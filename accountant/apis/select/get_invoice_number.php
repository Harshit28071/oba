<?php
include($_SERVER['DOCUMENT_ROOT'] . '/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$details = [];
session_start();
if ($_SESSION["s_role"] == "Accountant") {
    $cid = $_POST["customerId"];
    $year = date("Y");
    $invoiceId = 0;
    $stmt = $conn->prepare("SELECT b.name FROM `customer` a left join city b on a.city = b.id where a.id = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $stmt->bind_result($city);
    while ($stmt->fetch()) {
        $cityName = $city;
    }
    $stmt->close();

    $temp = $year . '/' . $cityName . '/'; 

        $stmt = $conn->prepare("SELECT CAST(REPLACE(invoice_number, '" . $temp . "', '') AS UNSIGNED) as i from invoice where invoice_number like '%" . $temp . "%' and year = ? order by i desc limit 1");
        $stmt->bind_param("i", $year);
        $stmt->execute();
        $stmt->bind_result($invoice_number);
        while ($stmt->fetch()) {

            $invoiceId = $invoice_number;
        }
    
    $data[0] = $temp;
    $data[1] = ($invoiceId + 1);
    $stmt->close();
    $conn->close();


    echo json_encode($data);
} else {
    echo 0;
}
?>