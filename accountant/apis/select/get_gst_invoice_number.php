<?php
include($_SERVER['DOCUMENT_ROOT'] . '/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$details = [];
session_start();
if ($_SESSION["s_role"] == "Accountant") {
    $fName = $_POST["firmName"];
    $year = getCurrentFinancalYear();
    $invoiceId = 0;
  

    $temp = $year . '/' . $fName . '/GST/'; 

        $stmt = $conn->prepare("SELECT CAST(REPLACE(invoice_number, '" . $temp . "', '') AS UNSIGNED) as i from gst_invoice where invoice_number like '" . $temp . "%' and financial_year = ? order by i desc limit 1");
        $stmt->bind_param("s", $year);
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
function getCurrentFinancalYear(){
    if (date('m') <= 3) {//Upto June 2014-2015
        $financial_year = (date('Y')-1) . '-' . date('Y');
    } else {//After June 2015-2016
        $financial_year = date('Y') . '-' . (date('Y') + 1);
    }
    return $financial_year;
}
?>
