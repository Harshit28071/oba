<?php
include($_SERVER['DOCUMENT_ROOT'] . '/new/oba/common/database.php');
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
    header("location:/new/oba/common/user_login.php");
}
$db = new Database();
$conn = $db->connect();
$urlredirect = "../../admin/pages/user_login.php";
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"), true);


$item = $data["products"];
$cid = $data["customerId"];
$amount = $data["totalAmount"];
$firmId = $data["firmId"];
$firmName = $data["firmName"];
$taxType = $data["taxType"];
$invoiceNumber =$data["invoiceNumber"];
$date = $data["date"];
$cityName = '';
$invoiceId = $data["invoiceId"];

$year = date("Y");
$products = "[";


for ($i = 0; $i < sizeof($item); $i++) {

    if ($i > 0) {
        $products = $products . ',';
    }
    $products = $products . '{"id":' . $item[$i]["id"] . ', "punit":"' . $item[$i]["punit"] . '", "quantity":' . $item[$i]["quantity"] . ', "itemPrice":' . $item[$i]["itemPrice"] . ', "gst":' . $item[$i]["gst"] .  ', "hsn":' . $item[$i]["hsn"]. ', "taxAmount":' . $item[$i]["taxAmount"].'}';
}
$products = $products . ']';

$fy = getCurrentFinancalYear();
/*$temp = $fy."/".$firmName."/GST/";


$stmt = $conn->prepare("SELECT count(id) as id from gst_invoice where financial_year = ? and firm_id = ?");
$stmt->bind_param("ss", $fy,$firmId);
$stmt->execute();
$stmt->bind_result($invoice);
while ($stmt->fetch()) {

    $invoiceId = $invoice;
}
$stmt->close();

$invoiceNumber = $temp . ($invoiceId + 1);
*/
$temp = explode("/",$invoiceNumber);
if(count($temp) == 4 && $date !='' ){


$stmt = $conn->prepare("INSERT INTO `gst_invoice`(`firm_id`,`party_id`, `amount`,products,`invoice_number`,`financial_year`,tax_type,`date`,invoice_id) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("iidssssss", $firmId, $cid, $amount, $products, $invoiceNumber, $fy,$taxType,$date,$invoiceId);
$stmt->execute();

$stmt->close();
$conn->close();
echo json_encode($invoiceNumber);
}else{
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
 
