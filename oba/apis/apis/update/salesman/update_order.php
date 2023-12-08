<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');

$data = json_decode(file_get_contents("php://input"),true);
$item =$data["products"];
$oid = $data["orderId"];
$amount = $data["totalAmount"];
$sid = $_SESSION["s_id"];


if(sizeof($item) > 0){
    $stmt = $conn->prepare("delete from `order_item_mapping` where order_id in (select id from orders where id = ? and salesman_id = ? and invoice_id = 0)");
    $stmt->bind_param("ii",$oid,$sid);
    $stmt->execute();

$stmt = $conn->prepare("update `orders` set amount = ? where id = ? and salesman_id = ? and invoice_id = 0");
$stmt->bind_param("dii",$amount,$oid,$sid);
$stmt->execute();

for($i=0;$i<sizeof($item);$i++){
    $stmt = $conn->prepare("INSERT INTO `order_item_mapping`( `order_id`, `product_id`, `unit`, `quantity`, `price`) VALUES (?,?,?,?,?)");
$stmt->bind_param("iisdd",$oid,$item[$i]["id"],$item[$i]["punit"],$item[$i]["quantity"],$item[$i]["itemPrice"]);
$stmt->execute();
}

$stmt->close();
$conn->close();
echo json_encode($oid);
}else{
    echo json_encode(0);
}


?>