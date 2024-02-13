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
$order_id = $data["order_id"];
$cityName = '';
$invoiceId = 0;
if ($order_id == null || $order_id == "") {
    $order_id = 0;
}

$year = date("Y");
$products = "[";


for ($i = 0; $i < sizeof($item); $i++) {

    if ($i > 0) {
        $products = $products . ',';
    }
    $products = $products . '{"id":' . $item[$i]["id"] . ', "punit":"' . $item[$i]["punit"] . '", "quantity":' . $item[$i]["quantity"] . ', "itemPrice":' . $item[$i]["itemPrice"] . ', "discount":' . $item[$i]["discount"] . '}';
}
$products = $products . ']';


$stmt = $conn->prepare("SELECT b.name FROM `customer` a left join city b on a.city = b.id where a.id = ?");
$stmt->bind_param("i", $cid);
$stmt->execute();
$stmt->bind_result($city);
while ($stmt->fetch()) {
    $cityName = $city;
}
$stmt->close();

$temp = '/' . $cityName . '/';

$stmt = $conn->prepare("SELECT count(id) as id from invoice where invoice_number like '%" . $temp . "%' and year = ?");
$stmt->bind_param("i", $year);
$stmt->execute();
$stmt->bind_result($invoice);
while ($stmt->fetch()) {

    $invoiceId = $invoice;
}
$stmt->close();

$invoiceNumber = $year . $temp . ($invoiceId + 1);


$stmt = $conn->prepare("INSERT INTO `invoice`(`order_id`,`party_id`,  `amount`,products,`invoice_number`,`year`) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("iidssi", $order_id, $cid, $amount, $products, $invoiceNumber, $year);
$stmt->execute();

if ($order_id !=0) {
    $stmt = $conn->prepare("update orders set order_status='Completed',invoice_id = ? where id= ?");
    $stmt->bind_param("si", $invoiceNumber,$order_id);
    $stmt->execute();
}
$stmt->close();
$conn->close();
echo json_encode($invoiceNumber);
